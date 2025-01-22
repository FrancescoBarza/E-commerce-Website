<?php
require_once("bootstrap.php");
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Verifica se l'ID dell'ordine è presente nella query string
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

// Ottieni i dettagli dell'ordine specifico
$ordine = $dbh->getOrderById($ordine_id);
if (!$ordine) {
    header("Location: ordiniPassati.php");
    exit;
}

// Ottieni i prodotti inclusi nell'ordine
$prodotti_ordine = $dbh->getProductFromOrder($ordine_id);

$templateParams["titolo"] = "Dettagli Ordine " . $ordine["ID_ordine"];
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "info-vecchi-ordini.php"; 

$templateParams["ordine"] = $ordine;
$templateParams["prodotti"] = $prodotti_ordine;

$templateParams["show-aside"] = false;
require("template/base.php");
?>