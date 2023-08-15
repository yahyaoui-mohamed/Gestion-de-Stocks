<h1>Supprimer un article</h1>
<?php
$req = $connect->prepare("SELECT * FROM articles");
$req->execute();
while ($res = $req->fetch()) {
?>
<?php
}
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Désignation</th>
      <th scope="col">Quantité</th>
      <th scope="col">Prix unitaire</th>
      <th scope="col">Prix totales</th>
      <th scope="col">Modifier</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $req = $connect->prepare("SELECT * FROM articles;");
    $req->execute();
    while ($row = $req->fetch()) {
      echo "<tr>
  <th scope='row'>$row[0]</th>
  <td>$row[1]</td>
  <td>$row[2]</td>
  <td>$row[3]</td>
  <td>$row[4]</td>
  <td><button class='btn btn-success'>Modifier</button></td>
  <td><button class='btn btn-danger' href='?'>Supprimer</button></td>
</tr>";
    }
    echo "  </tbody>
</table>";
    ?>