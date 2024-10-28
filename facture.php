<?php 
  $id = $_GET["id"];
  include "connect.php";
  $req = $connect->prepare("SELECT * FROM livraisons WHERE id = ?");
  $req->execute(array($id));
  $facture = $req->fetch();
  $client = $facture["client"];
  $req = $connect->prepare("SELECT nom, prenom, addresse FROM client WHERE id_client = ?");
  $req->execute(array($client));
  $client = $req->fetch();
  $ok = json_decode($facture["details"], true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Facture</title>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-print-6 text-start">
        <h1>YAHYAOUI HALIMA</h1>
        <p>Marchand ambulant</p>
        <p>8. Rue Mohamed Dhrif Khaznadar</p>
        <p>Bardo - Tel ..: 20 . 516 . 670</p>
        <p>MF.: 1196704 R/C/N/000</p>
        <h3>BON DE LIVRAISON</h3>
      </div>
      <div class="col-lg-6 col-print-6 text-end">
        <h1>يحياوي حليمة</h1>
        <p>تاجر متجول</p>
        <p>نهج محمد ظريف - خزندار - باردو<span>8</span></p>
        <p> 20 . 516 . 670 : الهاتف</p>
        <p> R/C/N/000 الرقم الجبائي : 1196704</p>
        <h5>Date: <?php echo date("Y-m-d") ?> <h5>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="content mb-5">
      <h5>Droit MR.: <?= $client[0]. " ". $client[1] ?></h5>
      <h5>Adresse.: <?= $client[2]?> </h5>
    </div>
  </div>
  <div class="container">
    <table class="table table-bordered text-center">
    <thead>
      <tr>
        <td>Quantité</td>
        <td>Désignation</td>
        <td>Prix Unit.</td>
        <td>Prix TOTAL</td>
      </tr>
    </thead>
    <tbody>
      <?php 
      $total = 0;
      for($i = 0; $i < sizeof($ok); $i++){
      $req = $connect->prepare("SELECT designation_article, prix_article FROM articles WHERE code_article = ?");
      $req->execute(array($ok[$i]["article"]));
      $res = $req->fetch();
        echo "<tr>
        <td>".$ok[$i]['quantite']."</td>
        <td>".$res[0]."</td>
        <td>".$res[1]."</td>
        <td>".$ok[$i]['quantite'] * $res[1]."</td>
      </tr>";
      $total += $ok[$i]['quantite'] * $res[1];
  }
      
      $max = 16 - $req->rowCount();
      while($max--){
        echo "<tr>
        <td>.........................................................</td>
        <td>.........................................................</td>
        <td>.........................................................</td>
        <td>.........................................................</td>
      </tr>";
      }
    ?>

      <tr>
        <td></td>
        <td></td>
        <td>TOTAL : </td>
        <td><?= $total; ?></td>
      </tr>
    </tbody>
  </table>
  </div>

  </div>
  </div>

</body>

</html>