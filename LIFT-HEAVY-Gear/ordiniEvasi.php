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
$templateParams["titolo"] = "Ordini Evasi";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome"] = $userData["nome"];
$templateParams["nome-main"] = "info-ordiniEvasi.php";


$ordini = $dbh->getOrdiniNonConsegnati();
$templateParams["ordini"] = $ordini;

if (isset($_POST['ordine_id']) && isset($_POST['stato'])) {
    $ordineId = $_POST['ordine_id'];
    $nuovoStato = $_POST['stato'];

    $ordine = $dbh->getOrderById($ordineId);
    if (!$ordine) {
        $templateParams["erroreModificaStato"] = "Errore: Ordine non trovato.";
    } else {
        $utenteOrdineId = $ordine["ID_utente"];
        $statoOrdineAttuale = $ordine["stato_ordine"];
        if ($nuovoStato === $statoOrdineAttuale) {
          //do nothing
        } else {
            $success = $dbh->updateOrderStatus($ordineId, $nuovoStato);
            if ($success) {
               
                $notificaTesto = "Il tuo ordine n. " . $ordineId . " è ";
                switch ($nuovoStato) {
                    case "In Elaborazione":
                        $notificaTesto .= "stato ricevuto ed è in fase di elaborazione.";
                        break;
                    case "Spedito":
                        $notificaTesto .= "stato spedito.";
                        break;
                    case "Pronto per il ritiro":
                        $notificaTesto .= "pronto per il ritiro.";
                        break;
                    case "Consegnato":
                        $notificaTesto .= "stato consegnato. Grazie per il tuo acquisto!";
                        break;
                    default:
                        $notificaTesto .= " stato aggiornato allo stato: " . $nuovoStato;
                        break;
                }

                try {
                    $dbh->addNotification($notificaTesto, $utenteOrdineId, $ordineId);
                } catch (Exception $e) {
                    error_log("Errore durante l'aggiunta della notifica: " . $e->getMessage());
                    $templateParams["erroreNotifica"] = "Errore durante la creazione della notifica.";
                }

                header("Location: ordiniEvasi.php");
                exit;
            } else {
                $templateParams["erroreModificaStato"] = "Errore nell'aggiornamento dello stato dell'ordine.";
            }
        }
    }
}

$templateParams["show-aside"] = false;
require("template/base.php");
?>
