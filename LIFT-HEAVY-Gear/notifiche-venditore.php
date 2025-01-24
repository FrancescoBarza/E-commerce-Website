<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Notifiche";
$templateParams["titolo-main"] = "NOTIFICHE";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["show-aside"] = false;



if (!isset($_SESSION["ID_utente"]) || !isset($_SESSION["venditore"]) || $_SESSION["venditore"] !== "Y") {

    header("Location: index.php");
    exit();
}
$templateParams["nome-main"] = "info-notifiche-venditore.php";


$templateParams["prodotti_in_esaurimento"] = $dbh->getProdottiInEsaurimento();





require("template/base.php");
