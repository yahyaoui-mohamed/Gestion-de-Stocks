<?php
$id = $_GET["id"];

$req = $connect->prepare("DELETE FROM articles WHERE code_article = ?");
$req->execute(array($id));

header("location:index.php?page=article");