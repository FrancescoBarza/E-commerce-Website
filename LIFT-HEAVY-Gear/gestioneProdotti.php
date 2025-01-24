<?php
require_once("bootstrap.php");


$templateParams["titolo"] = "I Miei Prodotti";
$templateParams["titolo-main"] = "GESTIONE PRODOTTI";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "rifornisci-prodotti.php";
$templateParams["lista-prodotti"] = $dbh->getProduct();
$templateParams["show-aside"] = false;


require("template/base.php");
?>