<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Conferma Acquisto";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "conferma.php";
$templateParams["show-aside"] = false;


if (isset($_SESSION["ordine"]) && is_array($_SESSION["ordine"])) {
    $templateParams["ordine"] = $_SESSION["ordine"];
    $templateParams["prodotti_ordine"] = $dbh->getProductFromOrder($_SESSION["ordine"]['ID_ordine']);
    unset($_SESSION["ordine"]);
} else {
    $templateParams["errore"] = "Dettagli dell'ordine non trovati.";
}

require("template/base.php");
?>