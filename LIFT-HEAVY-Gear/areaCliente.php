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
$templateParams["titolo"] = "Area Cliente";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome"] = $userData["nome"];
$templateParams["nome-main"] = "info-cliente.php";


$numNotificheNonLette = $dbh->getNumeroNotificheNonLette($_SESSION["ID_utente"]);
$templateParams["num_notifiche_non_lette"] = $numNotificheNonLette;

if (isset($_GET["logout"])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php?logout=success");
    exit;
}
$templateParams["show-aside"] = false;
require("template/base.php");
?>