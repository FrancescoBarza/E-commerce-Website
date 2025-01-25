<?php
require_once("bootstrap.php");

if (!isset($_SESSION["ID_utente"])) {
    header("Location: login.php");
    exit;
}

$templateParams["titolo"] = "Carrello";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "form-carrello.php";
if(isset($_SESSION["ID_utente"])){
    $templateParams["notifica"] = $dbh->getNotification($_SESSION["ID_utente"]);
}

$utente = $_SESSION["ID_utente"];
$currentCart = $dbh->checkEmptyCart($utente);

if(count($currentCart) != 0){
    $templateParams["prodottoCarrello"] = $dbh->getProductOnCart($currentCart[0]["ID_ordine"]);
}
require("template/base.php");
?>