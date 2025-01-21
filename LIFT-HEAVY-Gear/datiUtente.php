<?php
require_once("bootstrap.php");

if (isset($_GET["logout"])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php?logout=success");
    exit;
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $cognome = filter_input(INPUT_POST, "cognome", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = !empty($_POST["password"]) ? $_POST["password"] : null;

    if ($dbh->updateUserData($_SESSION["ID_utente"], $nome, $cognome, $email, $password)) {
        header("Location: datiUtente.php?success=1");
        exit;
    } else {
        $templateParams["errore"] = "Errore durante l'aggiornamento. Riprova più tardi.";
    }
}

$templateParams["titolo"] = "I Miei Dati";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "modifica-dati-utente.php";
$templateParams["userData"] = $dbh->getUserDataById($_SESSION["ID_utente"]);
$templateParams["show-aside"] = false;
require("template/base.php");
