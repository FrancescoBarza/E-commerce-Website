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
$templateParams["nome"] = $userData["nome"]; // Pass the user's name to the template
$templateParams["nome-main"] = "info-cliente.php";
if (isset($_GET["logout"])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php?logout=success");
    exit;
}

require("template/base.php");
?>