<?php
$id = $_GET["id"];

$req = $connect->prepare("DELETE FROM user WHERE id = ?");
$req->execute(array($id));

header("location:index.php?page=utilisateur");
