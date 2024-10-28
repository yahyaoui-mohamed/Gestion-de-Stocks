<?php
if ($_SESSION["role"] == 3) {
  header("location: index.php");
}
?>

<?php

$id = $_GET["id"];

$req = $connect->prepare("SELECT * FROM client WHERE id_client = ?");
$req->execute(array($id));
$res = $req->fetch();
?>

<form method="POST">
  <h1>Modifier un client</h1>
  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $tel = $_POST["tel"];
    $req = $connect->prepare("UPDATE client SET nom = ?, prenom = ?, addresse = ?, num_tel = ? WHERE id_client = ?");
    $req->execute(array($nom, $prenom, $adresse, $tel, $id));
    $req = $connect->prepare("SELECT * FROM client WHERE id_client = ?");
    $req->execute(array($id));
    $res = $req->fetch();
    header("location: ?page=client");
  }
  ?>
  <div class="container">
    <div class="row mb-3">
      <div class="col-lg-6">
        <input type="text" class="form-control" name="nom" value="<?= $res[1]; ?>" />
      </div>
      <div class="col-lg-6">
        <input type="text" class="form-control" name="prenom" value="<?= $res[2]; ?>" />
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-6">
        <input type="text" class="form-control" name="adresse" value="<?= $res[3]; ?>" />
      </div>
      <div class="col-lg-6">
        <input type="text" class="form-control" name="tel" value="<?= $res[4]; ?>" />
      </div>
    </div>
    <div class="col-lg-6">
      <input type="submit" class="btn btn-primary" value="Enregistrer" />
    </div>
  </div>

</form>