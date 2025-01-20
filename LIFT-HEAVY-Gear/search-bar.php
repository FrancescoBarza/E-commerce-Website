<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "LIFT HEAVY Gear";
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

$prodotti = $dbh->searchProducts($searchTerm);
if (empty($prodotti)) {
    $templateParams["titolo-main"] = "Nessun risultato trovato per '$searchTerm'";
} else {
    $templateParams["titolo-main"] = "Risultati per '$searchTerm'";
}

$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "lista_prodotti.php";
$templateParams["lista-prodotti"] = $prodotti;
$templateParams["show-aside"] = true;
$templateParams["articoli"] = $dbh->getArticles();

require("template/base.php");
?>