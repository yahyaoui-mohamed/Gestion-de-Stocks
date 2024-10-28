<h1>Liste des fournisseurs</h1>

<?php
if ($_SESSION["role"] != 3) {
?>
  <a href="?page=ajouterfournisseur" class="btn btn-primary mb-3">Ajouter un fournisseur</a>
<?php
}
?>


<?php
include "connect.php";
$req = $connect->prepare("SELECT * FROM fournisseurs");
$req->execute();
if ($req->rowCount()) {
  echo
  "
<table class='table-custom'>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Addresse</th>
      <th>Téléphone</th>
    </tr>
  </thead>
  ";
} else {
  echo "<p>Pas d'article pour le moment.</p>";
}
?>
<?php
while ($count = $req->fetch()) {
  echo
  "<tr>
      <td>$count[1]</td>
      <td>$count[2]</td>
      <td>$count[3]</td>
      <td>$count[4]</td>
      <td>
        <a id='show' href='#'><i class='fi fi-rr-eye'></i></a>
  ";
  if ($_SESSION["role"] != 3) {
    echo "
        <a href='?page=updatefournisseur&id=$count[0]'><i class='fi fi-rr-edit'></i></a>
        <a href='?page=deletefournisseur&id=$count[0]'><i class='fi fi-rr-trash'></i></a>
      ";
  }
  "
      </td>
    </tr>";
}


?>

</table>

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