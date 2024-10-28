<?php
if ($_SESSION["role"] == 3) {
  header("location: index.php");
}
?>

<form method="POST" id="livraison_form">
  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $client = $_POST["client"];
    $date = date('Y-m-d H:i:s');
    $details = json_encode($_POST["livraison"]);

    for ($i = 0; $i < sizeof($_POST["livraison"]); $i++) {
      $quant = $_POST["livraison"][$i]["quantite"];
      $article = $_POST["livraison"][$i]["article"];
      $update = $connect->prepare("UPDATE articles SET quantite_article = quantite_article - ? WHERE code_article = ?");
      $update->execute(array($quant, $article));
      $req = $connect->prepare("INSERT INTO livraisons VALUES('','$client','$details','$date')");
      $req->execute();
    }
  }

  ?>
  <div class="container">
    <h1 class="main-title">Ajouter une livraison</h1>
    <button class="btn btn-success mb-3" id="ajout">Ajouter un autre article</button>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <select class="form-select" name="client" id="client" required>
            <option value="">Choisissez un client</option>
            <?php
            $clients = $connect->prepare("SELECT * FROM client");
            $clients->execute();

            while ($resClients = $clients->fetch()) {
            ?>
              <option value="<?= $resClients[0] ?>"><?= $resClients[1] . " " . $resClients[2] ?></option>
            <?php
            }

            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row to-add">
      <div class="col-lg-6">
        <select class="form-select" name="input_article" required>
          <option value="">Choisissez un article</option>
          <?php
          $articles = $connect->prepare("SELECT * FROM articles");
          $articles->execute();

          while ($resArticles = $articles->fetch()) {
          ?>
            <option value="<?= $resArticles[0] ?>"><?= $resArticles[0] . " - " . $resArticles[1] ?></option>
          <?php
          }
          ?>
        </select>
      </div>

      <div class="col-lg-6">
        <div class="mb-3">
          <input type="number" class="form-control" placeholder="Quantité" id="quantiteLivraison" required />
        </div>
      </div>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" value="Ajouter" />
    </div>
  </div>
  </div>

</form>
<script>
  let addBtn = document.getElementById("ajout");
  addBtn.addEventListener("click", function(e) {
    e.preventDefault();
    let el = document.querySelectorAll(".to-add");
    el = el[el.length - 1];
    let copyEl = el.cloneNode(true);
    copyEl.querySelector("#quantiteLivraison").value = "";
    el.after(copyEl);
  });

  document.getElementById("livraison_form").addEventListener("submit", function(e) {
    e.preventDefault();
    let livraison = [];
    let client = $("#client").val();
    $(".to-add").each(function(index) {
      let temp = {};
      let quantite = $(this).find("input")[0].value;
      let article = $(this).find("select").val();
      temp.article = article;
      temp.quantite = quantite;
      livraison.push(temp);
    });
    $.ajax({
      method: "POST",
      data: {
        client,
        livraison
      },

      success: function(data) {
        $("#client").val("");
        $(".to-add").find("input").each((index, el) => {
          el.value = "";
        });
        $(".to-add").find("select").each((index, el) => {
          el.value = "";
        });
      }
    });
  });
</script>