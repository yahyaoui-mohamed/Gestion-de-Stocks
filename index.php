<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("location:login.php");
}
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='css/flaticon.css'>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/jquery.min.js"></script>
  <title>Accueil</title>
</head>

<body>
  <div id="app" class="app">
    <nav class="sidebar">
      <!-- <div class="admin">
        <div class="admin-info">
          <h4>
            Tarek Yahyaoui
          </h4>
        </div>
      </div> -->
      <ul>
        <li <?php echo (!isset($_GET["page"]) ? "class='active'" : "") ?>>
          <a href="./"><i class="fi fi-rr-home"></i> Tableau de bord</a>
        </li>
        <?php
        if ($_SESSION["role"] != 3) {
        ?>
          <li <?php echo (isset($_GET["page"]) &&  ($_GET["page"]  === "utilisateur" || $_GET["page"]  === "ajouterutilisateur" || $_GET["page"]  === "modifierutilisateur" || $_GET["page"]  === "supprimerutilisateur") ? "class='active'" : "") ?>>
            <a href="?page=utilisateur"><i class="fi fi-rr-user"></i> Utilisateurs</a>
          </li>
        <?php
        }
        ?>

        <li <?php echo (isset($_GET["page"]) &&  ($_GET["page"]  === "client" || $_GET["page"]  === "ajouterclient" || $_GET["page"]  === "updateclient") ? "class='active'" : "") ?>>
          <a href="?page=client"><i class="fi fi-rr-users"></i>Client</a>
        </li>
        <li <?php echo (isset($_GET["page"]) &&  ($_GET["page"]  === "article" || $_GET["page"]  === "ajouterarticle" || $_GET["page"]  === "updatearticle") ? "class='active'" : "") ?>>
          <a href="?page=article"><i class="fi fi-rr-box-open"></i>Articles</a>
        </li>
        <li <?php echo (isset($_GET["page"]) &&  ($_GET["page"]  === "achat" || $_GET["page"]  === "ajouterachat" || $_GET["page"]  === "updateachat") ? "class='active'" : "") ?>>
          <a href="?page=achat"><i class="fi fi-rr-coins"></i>Achat</a>
        </li>
        <li <?php echo (isset($_GET["page"]) &&  ($_GET["page"]  === "fournisseur" || $_GET["page"]  === "ajouterfournisseur" || $_GET["page"]  === "updatefournisseur") ? "class='active'" : "") ?>>
          <a href="?page=fournisseur"><i class="fi fi-rr-truck-moving"></i>Fournisseur</a>
        </li>
        <li <?php echo (isset($_GET["page"]) &&  ($_GET["page"]  === "livraison" || $_GET["page"]  === "ajouterlivraison" || $_GET["page"]  === "updatelivraison") ? "class='active'" : "") ?>>
          <a href="?page=livraison"><i class="fi fi-rr-truck-loading"></i>Livraison</a>
        </li>
        <li <?php echo (isset($_GET["page"]) &&  $_GET["page"]  === "parametres" ? "class='active'" : "") ?>>
          <a href="?page=parametres"><i class="fi fi-rr-settings"></i>Paramètres</a>
        </li>
        <li>
          <a href="logout.php"><i class="fi fi-rr-sign-out-alt"></i>Se déconnecter</a>
        </li>
      </ul>
    </nav>

    <div class="content">
      <!-- <div class="search-bar">
        <input type="text" placeholder="Chercher un produit" />
      </div> -->
      <?php
      if (isset($_GET["page"])) {
        if ($_GET["page"] !== "facture")
          include $_GET["page"] . ".php";
      } else {
        $req = $connect->prepare("SELECT * FROM articles");
        $req->execute();
        $articles = $req->rowCount();

        $req = $connect->prepare("SELECT sum(totale_article) FROM articles");
        $req->execute();
        $res = $req->fetch()[0];

        $req = $connect->prepare("SELECT COUNT(*) FROM user WHERE user_priority != 1");
        $req->execute();
        $user = $req->fetch()[0];

      ?>

        <div class="dashboard">
          <div class="stats">

            <div class="stat-item">
              <a class="stat-icon">
                <i class="fi fi-rr-box-open"></i>
              </a>
              <div class="stat-title">
                Articles
              </div>
              <div class="stat-number">
                <?= $articles ?>
              </div>
            </div>

            <div class="stat-item">
              <a class="stat-icon">
                <i class="fi fi-rr-user"></i>
              </a>
              <div class="stat-title">
                Utilisateurs
              </div>
              <div class="stat-number">
                <?= $user ?>
              </div>
            </div>

            <div class="stat-item">
              <a class="stat-icon">
                <i class="fi fi-rr-basket-shopping-simple"></i>
              </a>
              <div class="stat-title">
                Capitales
              </div>
              <div class="stat-number">
                <?= sprintf("%.3f", $res) . "DT"; ?>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>