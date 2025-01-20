<?php
require_once("bootstrap.php");
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Verifica se l'ID dell'ordine è presente nella query string
if (!isset($_GET["id"])) {
    header("Location: ordiniPassati.php"); // Reindirizza alla pagina degli ordini se l'ID manca
    exit;
}

$ordine_id = $_GET["id"];

// Ottieni i dettagli dell'ordine specifico
$ordine = $dbh->getOrderById($ordine_id);
if (!$ordine) {
    header("Location: ordiniPassati.php"); // Reindirizza se l'ordine non esiste
    exit;
}

// Ottieni i prodotti inclusi nell'ordine
$prodotti_ordine = $dbh->getProductFromOrder($ordine_id);

$templateParams["titolo"] = "Dettagli Ordine " . $ordine["ID_ordine"];
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "info-vecchi-ordini.php"; // Questa riga è ridondante in questo file, ma la lascio per coerenza

$templateParams["ordine"] = $ordine;
$templateParams["prodotti"] = $prodotti_ordine;

$templateParams["show-aside"] = false;
require("template/base.php");
?>