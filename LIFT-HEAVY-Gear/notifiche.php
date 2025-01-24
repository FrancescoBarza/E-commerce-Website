<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Notifiche";
$templateParams["titolo-main"] = "NOTIFICHE";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "info-notifiche-cliente.php";
$templateParams["show-aside"] = false;
$utente_id = $_SESSION["ID_utente"];

$templateParams["notifiche"] = $dbh->getNotificheNonLette($utente_id);

$templateParams["ordini_utente"] = $dbh->getOrdersByUserId($utente_id);



if (isset($_POST["action"]) && $_POST["action"] == "1" && isset($_POST["notifica_id"])) {
    $notifica_id = $_POST["notifica_id"];
    $stato_letto = isset($_POST["letto"]) && $_POST["letto"] == "letto" ? "Letta" : "Non letta";
    $success = $dbh->aggiornaStatoNotifica($notifica_id, $stato_letto);
    if ($success) {
        header("Location: notifiche.php");
        exit();
    } else {
        echo "Errore durante l'aggiornamento della notifica.";
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "2" && isset($_POST["notifica_id"])) {
    $notifica_id = $_POST["notifica_id"];
    $success = $dbh->segnaNotificaComeLetta($notifica_id);
    if ($success) {
        header("Location: notifiche.php");
        exit();
    } else {
        echo "Errore durante l'eliminazione della notifica.";
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "Richiesta non valida.";
    }
}
require("template/base.php");
