<?php
require_once("bootstrap.php");

$userData = $dbh->getUserDataById($_SESSION["ID_utente"]);
if (!$userData) {
    header("Location: login.php");
    exit;
}

$templateParams["titolo"] = "I Miei Prodotti";
$templateParams["titolo-main"] = "GESTIONE PRODOTTI";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "rifornisci-prodotti.php";
$templateParams["lista-prodotti"] = $dbh->getProduct();
$templateParams["userData"] = $dbh->getUserDataById($_SESSION["ID_utente"]);
$templateParams["show-aside"] = false;


require("template/base.php");
?>