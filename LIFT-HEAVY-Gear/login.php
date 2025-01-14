<?php
require_once("bootstrap.php");
$templateParams["titolo"] = "Login";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "form-login.php";
$templateParams["errore"] = "";
// Verifica se il form di login è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    if (empty($email) || empty($password)) {
        $templateParams["errore"] = "Inserisci email e password.";
    } else {
        // Tentativo di autenticazione (ipotizzando un metodo nella classe DatabaseHelper)
        $login_result = $dbh->checkLogin($email, $password);

        if ($login_result) {
            $_SESSION["loggedin"] = true;
            $_SESSION["ID_utente"] = $login_result["ID_utente"];
            $_SESSION["email"] = $login_result["email"];
            $_SESSION["venditore"] = isset($login_result['venditore']) ? $login_result['venditore'] : 'N'; // Default to 'N' if not set
            if ($_SESSION["venditore"] === 'Y') {
                header("Location: areaVenditore.php");
            } else {
                header("Location: areaCliente.php");
            }
            exit;
        } else {
            // Autenticazione fallita
            $templateParams["errore"] = "Credenziali non valide.";
        }
    }
}
$templateParams["show-aside"] = false;
require("template/base.php");
?>