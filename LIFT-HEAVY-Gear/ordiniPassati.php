<?php
require_once("bootstrap.php");
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
$userData = $dbh->getUserDataById($_SESSION["ID_utente"]);
if (!$userData) {
    header("Location: login.php");
    exit;
}
$templateParams["titolo"] = "Ordini Passati";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome"] = $userData["nome"];
$templateParams["nome-main"] = "ordini-cliente.php";


$ordiniUtente = $dbh->getOrdersByUserId($_SESSION["ID_utente"]);
$templateParams["ordini"] = $ordiniUtente;

$templateParams["show-aside"] = false;
require("template/base.php");
?>