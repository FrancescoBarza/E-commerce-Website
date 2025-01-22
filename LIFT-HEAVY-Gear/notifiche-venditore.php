<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "LIFT HEAVY Gear";
$templateParams["titolo-main"] = "NOTIFICHE";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["show-aside"] = false;

// Verifica se l'utente è un venditore
if (!isset($_SESSION["ID_utente"]) || !isset($_SESSION["venditore"]) || $_SESSION["venditore"] !== "Y") {
    // Se non è un venditore, reindirizza o mostra un messaggio di errore
    header("Location: index.php"); // Reindirizza alla home page
    exit();
}
$templateParams["nome-main"] = "info-notifiche-venditore.php";

// Cerca i prodotti in esaurimento
$templateParams["prodotti_in_esaurimento"] = $dbh->getProdottiInEsaurimento();


require("template/base.php");
?>