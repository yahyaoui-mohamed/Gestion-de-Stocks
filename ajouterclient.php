<?php
if ($_SESSION["role"] == 3) {
  header("location: index.php");
}
?>

<form method="post" action="./?page=ajouterclient">
  <?php
  include "connect.php";
  $resp = "";
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $addresse = $_POST["addresse"];
    $tel = $_POST["tel"];
    $req = $connect->prepare("INSERT INTO client VALUES ('','$nom','$prenom','$addresse','$tel'); ");
    $req->execute();
    if ($res) {
      $resp = '<div class="alert alert-success"role="alert">Client ajouter avec succès.</div>';
    } else {
      $resp = '<div class="alert alert-danger" role="alert">Un problème est survenue lors de ta requête.</div>';
    }
  }
  ?>
  <div class="container">
    <h1 class="main-title">Ajouter un client</h1>
    <?php
    echo $resp;
    ?>
    <div class="row">
      <div class="mb-3 col-lg-6">
        <input type="text" class="form-control" placeholder="Nom client" name="nom" />
      </div>
      <div class="mb-3 col-lg-6">
        <input type="text" class="form-control" placeholder="Prenom Client" name="prenom" />
      </div>
    </div>
    <div class="row">
      <div class="mb-3 col-lg-6">
        <input type="text" class="form-control" placeholder="Addresse Client" name="addresse" />
      </div>
      <div class="mb-3 col-lg-6">
        <input type="text" class="form-control" placeholder="Numéro de téléphone" name="tel" />
      </div>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" value="Ajouter" />
    </div>
  </div>
</form>