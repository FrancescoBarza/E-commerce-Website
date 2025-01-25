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

    $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    if (empty($nome) || empty($cognome) || empty($email) || empty($password)) {
        $templateParams["errore"] = "Tutti i campi sono obbligatori.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $templateParams["errore"] = "Email non valida.";
    } elseif (!preg_match($passwordPattern, $password)) {
        $templateParams["errore"] = "La password non è sufficientemente sicura. Deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola, un numero e un carattere speciale.";
    } else {
        if ($dbh->checkMail($email)) {
            $templateParams["errore"] = "Email già registrata.";
        } else {
            if ($is_vendor == 'Y' && $dbh->checkIfVendorExists()) {
                $templateParams["errore"] = "È già presente un account venditore.";
            } else {

                if ($dbh->addUser($nome, $cognome, $email, $password, $is_vendor)) {
                    header("Location: login.php"); 
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