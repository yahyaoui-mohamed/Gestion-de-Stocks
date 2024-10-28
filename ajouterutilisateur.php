<?php
if ($_SESSION["role"] == 3) {
  header("location: index.php");
}
?>

<form method="POST">
  <?php
  $resp = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom        = $_POST["nom"];
    $prenom     = $_POST["prenom"];
    $email      = $_POST["email"];
    $password   = $_POST["password"];
    $role       = $_POST["role"];
    $req = $connect->prepare("INSERT INTO user VALUES ('','$nom','$prenom','$email','$password','$role');");
    $res = $req->execute();
    if ($res) {
      $resp = '<div class="alert alert-success"role="alert">Utilisateur ajouter avec succès.</div>';
    } else {
      $resp = '<div class="alert alert-danger" role="alert">Un problème est survenue lors de ta requête.</div>';
    }
  }
  ?>
  <?php
  ?>
  <div class="container">
    <h1 class="main-title">Ajouter un utilisateur</h1>
    <?=
    $resp;
    ?>
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
          <input type="email" class="form-control" placeholder="Email" name="email" required />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="mb-3">
        <select class="form-select" name="role">
          <option selected>Choisissez le rôle</option>
          <?php
          if ($_SESSION["role"] == 1) {
            echo "<option value='1'>Super Admin</option>";
            echo "<option value='2'>Admin</option>";
          }
          ?>
          <option value="3">Utilisateur</option>
        </select>
      </div>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" value="Ajouter" required />
    </div>
  </div>
</form>
<script src="js/main.js">
</script>