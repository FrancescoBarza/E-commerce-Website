<?php
require_once("bootstrap.php");



$templateParams["titolo"] = "LIFT HEAVY Gear";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "articolo.php";
$id_articolo = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$templateParams["articolo"] = $dbh->getArticlesById($id_articolo);

require("template/base.php");
?>