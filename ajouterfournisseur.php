<?php
if ($_SESSION["role"] == 3) {
  header("location: index.php");
}
?>

<form method="POST">
  <?php
  $resp = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom   = $_POST["nom"];
    $prenom     = $_POST["prenom"];
    $addresse = $_POST["addresse"];
    $tel = $_POST["tel"];
    $req = $connect->prepare("INSERT INTO fournisseurs VALUES ('','$nom','$prenom','$addresse','$tel');");
    $res = $req->execute();
    if ($res) {
      $resp = '<div class="alert alert-success"role="alert">Fournisseur ajouter avec succès.</div>';
    } else {
      $resp = '<div class="alert alert-danger" role="alert">Un problème est survenue lors de ta requête.</div>';
    }
  }
  ?>
  <?php
  ?>
  <div class="container">
    <h1 class="main-title">Ajouter un fournisseur</h1>
    <div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Nom" name="nom" required />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Prénom" name="prenom" required />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Addresse" name="addresse" required />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Numéro téléphone" name="tel" required />
        </div>
      </div>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" value="Ajouter" required />
    </div>
  </div>
</form>
<script src="js/main.js">
</script>