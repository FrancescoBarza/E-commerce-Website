<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Registrazione";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "form-registrazione.php"; 
$templateParams["errore"] = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $cognome = filter_input(INPUT_POST, "cognome", FILTER_SANITIZE_STRING);
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
            if ($dbh->addUser($nome, $cognome, $email, $password, $is_vendor)) {
                $redirectPath = ($is_vendor == 'Y') ? "areaVenditore.php" : "areaCliente.php";
                header("Location: " . $redirectPath); 
                exit;
            } else {
                $templateParams["errore"] = "Errore durante la registrazione. Riprova più tardi.";
            }
        }
    }
}

require("template/base.php");
?>