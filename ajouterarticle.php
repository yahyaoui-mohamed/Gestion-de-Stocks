<form method="POST">
  <?php
  $resp = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code   = $_POST["code"];
    $des     = $_POST["designation"];
    $quant = $_POST["quantite"];
    $prix = $_POST["prix"];
    $totale = $_POST["totale"];
    $req = $connect->prepare("INSERT INTO articles VALUES ('$code','$des','$quant','$prix','$totale');");
    $res = $req->execute();
    if ($res) {
      $resp = '<div class="alert alert-success"role="alert">Article ajouter avec succès.</div>';
    } else {
      $resp = '<div class="alert alert-danger" role="alert">Un problème est survenue lors de ta requête.</div>';
    }
  }
  ?>
  <?php
  ?>
  <div class="container">
    <h1 class="main-title">Ajouter un article</h1>
    <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Code Article" name="code" required />
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Désignation" name="designation" required />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="number" class="form-control" placeholder="Quantité" name="quantite" id="qu" required />
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="number" class="form-control" placeholder="Prix unitaire" name="prix" id="pu" required step="0.0001" />
      </div>
    </div>
  </div>
  <div class="mb-3">
    <input type="text" class="form-control" placeholder="Prix totale" name="totale" id="totale" readonly />
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary" value="Ajouter" required />
  </div>
  </div>
</form>
<script src="js/main.js">
</script>