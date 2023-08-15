<h1 class="main-title">Liste des achat</h1>
<a href="?page=ajouterachat" class="btn btn-primary mb-3">Ajouter un achat</a>

<table class="table-custom">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Fournisseur</th>
      <th scope="col">Date</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php
    $req = $connect->prepare("SELECT * FROM achat;");
    $req->execute();
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
          <a href='?page=deleteachat&id=$row[0]'><i class='fi fi-rr-trash'></i></a>
        </td>
      </tr>
      ";
    }
    echo "</tbody></table>";
?>