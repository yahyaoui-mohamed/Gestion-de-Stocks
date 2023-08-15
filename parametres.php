<?php 
  $req = $connect->prepare("SELECT * FROM user WHERE user_priority = 1");
  $req->execute();
  $res = $req->fetch();
?>

<form method="POST">
  <?php 
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $username = $_POST["username"];
      $pass = $_POST["newpassword"];
      $req = $connect->prepare("UPDATE user SET user_name = ?, user_password = ? WHERE user_name = ?");
      $req->execute(array($username, $pass, $_SESSION["admin"]));
      $req = $connect->prepare("SELECT * FROM user WHERE user_priority = 1");
      $req->execute();
      $res = $req->fetch();
    }
  
  ?>
<div class="container">
  <h1>Paramètres du compte</h1>
  <div class="row">
    <div class="col-lg-12 mb-3">
      <input type="text" name="username" class="form-control" value="<?= $res[1] ?>"/>
    </div>
    <div class="col-lg-6 mb-3">
      <input type="password" name="newpassword" class="form-control" placeholder="Nouveau mot de passe"/>
    </div>
    <div class="col-lg-6 mb-3">
          <input type="password" name="confirmpassword" class="form-control" placeholder="Confimer mot de passe"/>
    </div>
    <div class="col">
      <input type="submit" value="Enregistrer" class="btn btn-primary"/>
    </div>
  </div>

</div>


</form>