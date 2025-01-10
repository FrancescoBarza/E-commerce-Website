<?php
require_once("bootstrap.php");



$templateParams["titolo"] = "LIFT HEAVY Gear";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "scheda_articolo.php";
$id_articolo = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$templateParams["articolo"] = $dbh->getArticlesById($id_articolo);
$templateParams["articoli"] = $dbh->getArticles();
require("template/base.php");
?>