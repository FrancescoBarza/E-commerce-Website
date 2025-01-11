<?php
require_once("bootstrap.php");



$templateParams["titolo"] = "LIFT HEAVY Gear";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "scheda_prodotto.php";
$id_prodotto = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$templateParams["prodotto"] = $dbh->getProductById($id_prodotto);
$templateParams["show-aside"] = false;
require("template/base.php");
?>