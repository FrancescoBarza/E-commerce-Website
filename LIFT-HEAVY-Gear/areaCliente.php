<?php
require_once("bootstrap.php");
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
$userData = $dbh->getUserDataById($_SESSION["ID_utente"]);
if (!$userData) {
    // Handle the case where user data is not found (e.g., user deleted)
    // You might log the user out or display an error message.
    // For this example, we'll redirect to the login page:
    header("Location: login.php");
    exit;
}
$templateParams["titolo"] = "Area Cliente";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome"] = $userData["nome"]; // Pass the user's name to the template
$templateParams["nome-main"] = "info-cliente.php";


require("template/base.php");
?>