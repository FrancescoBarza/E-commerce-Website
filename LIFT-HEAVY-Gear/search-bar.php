<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "LIFT HEAVY Gear";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "search.php";

$templateParams["lista-prodotti"] = $dbh->getRandomProduct();
$templateParams["articoli"] = $dbh->getArticles();



require("template/base.php");
?>