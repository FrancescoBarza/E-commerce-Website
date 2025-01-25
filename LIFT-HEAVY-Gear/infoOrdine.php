<?php
require_once("bootstrap.php");
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}


if (!isset($_GET["id"])) {
    header("Location: ordiniPassati.php"); 
    exit;
}
$userData = $dbh->getUserDataById($_SESSION["ID_utente"]);
if (!$userData) {
    header("Location: login.php");
    exit;
}
$ordine_id = $_GET["id"];


$ordine = $dbh->getOrderById($ordine_id);
if (!$ordine) {
    header("Location: ordiniPassati.php");
    exit;
}


$prodotti_ordine = $dbh->getProductFromOrder($ordine_id);

$templateParams["titolo"] = "Dettagli Ordine " . $ordine["ID_ordine"];
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "info-vecchi-ordini.php"; 

$templateParams["ordine"] = $ordine;
$templateParams["prodotti"] = $prodotti_ordine;

$templateParams["show-aside"] = false;
require("template/base.php");
?>