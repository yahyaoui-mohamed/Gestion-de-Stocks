<?php
session_start();
if (isset($_SESSION['admin'])) {
  header("location:index.php");
}
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Login</title>
</head>

<body>
  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $req = $connect->prepare("SELECT * FROM user WHERE user_email = ? AND user_password = ?");
    $req->execute(array($email, $pass));
    if ($req->rowCount() > 0) {
      $role = $req->fetch()[5];
      session_start();
      $_SESSION["admin"] = $email;
      $_SESSION["role"] = $role;
      header("location:index.php");
    } else {
      echo "<div class='alert alert-danger' role='alert'>Un problème est survenue lors de ta requête.</div>";
    }
  }

  ?>
  <div id="app" class="app">
    <form class="login-form" method="POST">
      <h1>Se Connecter</h1>
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Email" name="email" autocomplete="off" />
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" placeholder="Mot de passe" name="password" autocomplete="off" />
      </div>
      <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Connecter" />
      </div>
    </form>
  </div>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>