<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Registrazione";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "form-registrazione.php";
$templateParams["errore"] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $is_vendor = isset($_POST["venditore"]) ? 'Y' : 'N'; // Convert checkbox to Y/N

    if (empty($nome) || empty($cognome) || empty($email) || empty($password)) {
        $templateParams["errore"] = "Tutti i campi sono obbligatori.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $templateParams["errore"] = "Email non valida.";
    } else {
        if ($dbh->checkMail($email)) {
            $templateParams["errore"] = "Email già registrata.";
        } else {
            //  CONTROLLO PER VENDITORE UNICO
            if ($is_vendor == 'Y' && $dbh->checkIfVendorExists()) {
                $templateParams["errore"] = "È già presente un account venditore.";
            } else {
                if ($dbh->addUser($nome, $cognome, $email, $password, $is_vendor)) {
                    header("Location: login.php"); // Reindirizza sempre a login.php
                    exit;
                } else {
                    $templateParams["errore"] = "Errore durante la registrazione. Riprova più tardi.";
                }
            }
        }
    }
}
$templateParams["show-aside"] = false;
require("template/base.php");
?>