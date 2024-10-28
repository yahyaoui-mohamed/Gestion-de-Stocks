<h1>Liste des livraisons</h1>

<?php
if ($_SESSION["role"] != 3) {
?>
  <a href="?page=ajouterlivraison" class="btn btn-primary mb-3">Ajouter une livraison</a>
<?php
}
?>


<?php
$req = $connect->prepare("SELECT * FROM livraisons;");
$req->execute();
if ($req->rowCount()) {
  echo
  "
  <table class='table-custom'>
    <thead>
      <tr>
        <th scope='col'>Id</th>
        <th scope='col'>Client</th>
        <th scope='col'>Date</th>
        <th scope='col'></th>
      </tr>
    </thead>
  <tbody>
  ";
} else {
  echo "<p>Pas de livraison pour le moment.</p>";
}
while ($row = $req->fetch()) {
  $client = $connect->prepare("SELECT nom, prenom FROM client WHERE id_client = ?");
  $client->execute(array($row[1]));
  $res = $client->fetch();
  echo "
      <tr>
        <td scope='row'>$row[0]</td>
        <td>$res[0] $res[1]</td>
        <td>$row[3]</td>
        <td>
          <a href='#'><i class='fi fi-rr-eye'></i></a>
          ";
  if ($_SESSION["role"] != 3) {
    echo "
            <a href='?page=deletelivraison&id=$row[0]'><i class='fi fi-rr-trash'></i></a>
            <a href='facture.php?id=$row[0]' target='_blank'><i class='fi fi-rr-print'></i></a>
            ";
  }
  "
        </td>
      </tr>
      ";
}
echo "</tbody></table>";
?>