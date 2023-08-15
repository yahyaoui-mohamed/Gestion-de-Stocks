<form method="post" action="./?page=ajouterclient">
  <?php 
    include "connect.php";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $addresse = $_POST["addresse"];
      $tel = $_POST["tel"];
      $req = $connect->prepare("INSERT INTO client VALUES ('','$nom','$prenom','$addresse','$tel'); ");
      $req->execute();
      header("location:index.php?page=client");
    }
  ?>
  <div class="container">
    <h1 class="main-title">Ajouter un client</h1>
    <div class="row">
      <div class="mb-3 col-lg-6">
          <input type="text" class="form-control" placeholder="Nom client" name="nom"/>
      </div>
      <div class="mb-3 col-lg-6">
          <input type="text" class="form-control" placeholder="Prenom Client" name="prenom"/>
      </div>
    </div>
    <div class="row">
      <div class="mb-3 col-lg-6">
        <input type="text" class="form-control" placeholder="Addresse Client" name="addresse"/>
      </div>
      <div class="mb-3 col-lg-6">
        <input type="text" class="form-control" placeholder="Numéro de téléphone" name="tel"/>
      </div>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Ajouter"/>
    </div>
  </div>
</form>