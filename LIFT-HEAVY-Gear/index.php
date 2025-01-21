<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "LIFT HEAVY Gear";
$templateParams["titolo-main"] = "I NOSTRI PRODOTTI";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "lista_prodotti.php";
$templateParams["lista-prodotti"] = $dbh->getRandomProduct(6);

$templateParams["show-aside"] = true;
$templateParams["articoli"] = $dbh->getArticles();



require("template/base.php");
?>