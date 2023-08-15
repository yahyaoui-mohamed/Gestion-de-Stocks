<?php 

$id = $_GET["id"];

$req = $connect->prepare("SELECT * FROM fournisseurs WHERE id = ?");
$req->execute(array($id));
$res = $req->fetch();
?>

<form method="POST">
  <h1>Modifier un fournisseur</h1>
  <?php 
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $addresse = $_POST["addresse"];
      $tel = $_POST["tel"];
      $req = $connect->prepare("UPDATE fournisseurs SET 
      nom = ?, prenom	= ?, addresse	= ?, num_tel	 = ? WHERE id = ?");
      $req->execute(array($nom,$prenom,$addresse,$tel,$id));
      $req = $connect->prepare("SELECT * FROM fournisseurs WHERE id = ?");
      $req->execute(array($id));
      $res = $req->fetch();
    }
  ?>
  <div class="container">
    <div class="row mb-3">
      <div class="col-lg-6">
          <input type="text" class="form-control" name="nom" value="<?= $res[1]; ?>"/>
      </div>
      <div class="col-lg-6">
          <input type="text" class="form-control" name="prenom" value="<?= $res[2]; ?>"/>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-6">
          <input type="text" class="form-control" name="addresse" value="<?= $res[3]; ?>"/>
      </div>
      <div class="col-lg-6">
          <input type="text" class="form-control" name="tel" value="<?= $res[4]; ?>"/>
      </div>
    </div>
    
    <div class="col-lg-6">
          <input type="submit" class="btn btn-primary" value="Enregistrer"/>
    </div>
  </div>

</form>

<script src="js/main.js"></script>