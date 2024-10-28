<?php

if ($_SESSION["role"] == 3) {
  header("location: index.php");
}

$id = $_GET["id"];

$req = $connect->prepare("SELECT * FROM user WHERE id = ?");
$req->execute(array($id));
$res = $req->fetch();
?>

<form method="POST">
  <h1>Modifier un utilisateur</h1>
  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $req = $connect->prepare("UPDATE user SET 
      user_lastname = ?, user_firstname	= ?, user_email	= ?, user_password	= ?, user_priority = ? 
      WHERE id = ?");
    $req->execute(array($nom, $prenom, $email, $password, $role, $id));
    $req = $connect->prepare("SELECT * FROM user WHERE id = ?");
    $req->execute(array($id));
    $res = $req->fetch();
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
        <input type="email" class="form-control" name="email" value="<?= $res[3]; ?>" />
      </div>
      <div class="col-lg-6">
        <input type="password" class="form-control" name="password" value="<?= $res[4]; ?>" />
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-12">
        <select class="form-select" name="role">
          <option>Choisissez le rôle</option>
          <option <?php if ($res[5] == "1") echo "selected"; ?> value="1">Super Admin</option>
          <option <?php if ($res[5] == "2") echo "selected"; ?> value="2">Admin</option>
          <option <?php if ($res[5] == "3") echo "selected"; ?> value="3">Utilisateur</option>
        </select>
      </div>
    </div>


    <div class="col-lg-6">
      <input type="submit" class="btn btn-primary" value="Enregistrer" />
    </div>
  </div>

</form>

<script src="js/main.js"></script>