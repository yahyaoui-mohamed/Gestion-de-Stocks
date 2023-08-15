<?php 

$id = $_GET["id"];

$req = $connect->prepare("SELECT * FROM articles WHERE code_article = ?");
$req->execute(array($id));
$res = $req->fetch();
?>

<form method="POST">
  <h1>Modifier un article</h1>
  <?php 
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $code = $_POST["code"];
      $des = $_POST["des"];
      $quantite = $_POST["quantite"];
      $prix = $_POST["prix"];
      $prixt = $_POST["prixt"];
      $req = $connect->prepare("UPDATE articles SET 
      code_article = ?, designation_article	= ?, quantite_article	= ?, prix_article	 = ?, totale_article = ? WHERE code_article = ?");
      $req->execute(array($code,$des,$quantite,$prix,$prixt,$code));
      $req = $connect->prepare("SELECT * FROM articles WHERE code_article = ?");
      $req->execute(array($code));
      $res = $req->fetch();
    }
  ?>
  <div class="container">
    <div class="row mb-3">
      <div class="col-lg-6">
          <input type="text" class="form-control" name="code" value="<?= $res[0]; ?>"/>
      </div>
      <div class="col-lg-6">
          <input type="text" class="form-control" name="des" value="<?= $res[1]; ?>"/>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-6">
          <input type="text" class="form-control" id="quantite" name="quantite" value="<?= $res[2]; ?>"/>
      </div>
      <div class="col-lg-6">
          <input type="text" class="form-control" id="prix" name="prix" value="<?= $res[3]; ?>"/>
      </div>
    </div>
    
    <div class="col mb-3">
      <input type="text" class="form-control" id="prixtotale" name="prixt" readonly value="<?= $res[2]*$res[3]."DT" ?>"/>
    </div>

    <div class="col-lg-6">
          <input type="submit" class="btn btn-primary" value="Enregistrer"/>
    </div>
  </div>

</form>

<script src="js/main.js"></script>