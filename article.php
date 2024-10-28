<h1 class="main-title">Liste des articles</h1>

<?php
if ($_SESSION["role"] != 3) {
?>
  <a href="?page=ajouterarticle" class="btn btn-primary mb-3">Ajouter un article</a>
<?php
}
?>


<?php

$req = $connect->prepare("SELECT * FROM articles;");
$req->execute();
if ($req->rowCount()) {
  echo
  "
<table class='table-custom'>
  <thead>
    <tr>
      <th scope='col'>Code</th>
      <th scope='col'>Désignation</th>
      <th scope='col'>Quantité</th>
      <th scope='col'>Prix unitaire</th>
      <th scope='col'>Prix totales</th>
      <th scope='col'></th>
    </tr>
  </thead>
  <tbody> 
  ";
} else {
  echo "<p>Pas d'article pour le moment.</p>";
}
while ($row = $req->fetch()) {
  echo "
      <tr>
        <td scope='row'>$row[0]</td>
        <td>$row[1]</td>
        <td>$row[2]</td>
        <td>$row[3]</td>
        <td>$row[4]</td>
        <td>
          <a id='show' href='#'><i class='fi fi-rr-eye'></i></a>
          ";
  if ($_SESSION["role"] != 3) {
    echo "
          <a href='?page=updatearticle&id=$row[0]'><i class='fi fi-rr-edit'></i></a>
          <a href='?page=deletearticle&id=$row[0]'><i class='fi fi-rr-trash'></i></a>
      ";
  }
  "
          </td>
      </tr>
      ";
}
echo "</tbody></table>";
?>


<div class="info-card hide">

  <div class="body-card">

    <div class="row">

      <div class="col-lg-6 text-center">
        <div class="avatar">
          <i class="fi fi-rr-user"></i>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="infos">
          <p>Nom: <span>Yahyaoui</span></p>
          <p>Prénom: <span>Mohamed Alaa</span></p>
          <p>Addresse: <span>Tunis</span></p>
          <p>Numéro Téléphone: <span>55048804</span></p>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  let card = document.querySelector(".info-card");
  let showBtn = document.getElementById("show");

  showBtn.addEventListener("click", function(e) {
    e.preventDefault();
    card.classList.toggle("hide");
  });

  document.addEventListener("keydown", function(e) {
    if (e.key === "Escape") {
      card.classList.add("hide");
    }
  });


  document.addEventListener("click", function(e) {
    if (e.target.className === "info-card") {
      card.classList.add("hide");
    }
  });
</script>