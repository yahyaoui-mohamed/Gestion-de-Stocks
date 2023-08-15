<?php
$id = $_GET["id"];

$req = $connect->prepare("DELETE FROM achat WHERE id = ?");
$req->execute(array($id));

header("location:index.php?page=achat");