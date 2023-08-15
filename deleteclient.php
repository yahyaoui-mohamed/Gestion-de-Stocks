<?php
$id = $_GET["id"];

$req = $connect->prepare("DELETE FROM client WHERE id_client = ?");
$req->execute(array($id));

header("location:index.php?page=client");