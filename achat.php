<h1 class="main-title">Liste des achat</h1>

<?php
if ($_SESSION["role"] != 3) {
?>
  <a href='?page=ajouterachat' class='btn btn-primary mb-3'>Ajouter un achat</a>
<?php
}
?>

<?php
$req = $connect->prepare("SELECT * FROM achat;");
$req->execute();
if ($req->rowCount()) {
  echo
  "
  <table class='table-custom'>
  <thead>
    <tr>
      <th scope='col'>Id</th>
      <th scope='col'>Fournisseur</th>
      <th scope='col'>Date</th>
      <th scope='col'></th>
    </tr>
  </thead>
  <tbody>    
  ";
} else {
  echo "<p>Pas d'achat pour le moment.</p>";
}
while ($row = $req->fetch()) {
  $req = $connect->prepare("SELECT nom, prenom FROM fournisseurs WHERE id = ?");
  $req->execute(array($row[1]));
  $fournisseur = $req->fetch();
  echo "
      <tr>
        <td scope='row'>$row[0]</td>
        <td>$fournisseur[0] $fournisseur[1]</td>
        <td>$row[3]</td>
        <td>
          <a href='#'><i class='fi fi-rr-eye'></i></a>
          ";
  if ($_SESSION["role"] != 3) {
    echo "     
          <a href='?page=deleteachat&id=$row[0]'><i class='fi fi-rr-trash'></i></a>
          ";
  }
  "
        </td>
      </tr>
      ";
}
echo "</tbody></table>";
?>