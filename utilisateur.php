<?php
if ($_SESSION["role"] == 3) {
  header("location: index.php");
}

?>

<h1>Liste des utilisateurs</h1>
<a href="?page=ajouterutilisateur" class="btn btn-primary mb-3">Ajouter un utilisateur</a>
<?php
$req = $connect->prepare("SELECT * FROM user WHERE user_priority != 1;");
$req->execute();
if ($req->rowCount() > 0) {
  echo "
      <table class='table-custom'>
      <thead>
        <tr>
          <th scope='col'>Id</th>
          <th scope='col'>Nom</th>
          <th scope='col'>Prénom</th>
          <th scope='col'>Email</th>
          <th scope='col'>Rôle</th>
          <th scope='col'></th>
        </tr>
      </thead>
    <tbody>";
}
while ($row = $req->fetch()) {
  $role = ($row[5] == 1) ? "Super Admin" : (($row[5] == 2) ? "Admin" : "Utilisateur");

  echo "
      <tr>
        <td scope='row'>$row[0]</td>
        <td>$row[2]</td>
        <td>$row[1]</td>
        <td>$row[4]</td>
        <td>$role</td>
        <td>
          <a href='?page=modifierutilisateur&id=$row[0]'><i class='fi fi-rr-edit'></i></a>
          <a href='?page=supprimerutilisateur&id=$row[0]'><i class='fi fi-rr-trash'></i></a>
        </td>
      </tr>
      ";
}
echo "</tbody></table>";
?>