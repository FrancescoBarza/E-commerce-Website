<?php
require_once("bootstrap.php");
if ($_POST["action"] == 7 || $_POST["action"] == 8) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["ID_utente"])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST["idprodotto"]) && isset($_POST["quantita"])) {
        $idprodotto = htmlspecialchars($_POST["idprodotto"]);
        $quantita = htmlspecialchars($_POST["quantita"]);
        $utente = $_SESSION["ID_utente"];

        // Aggiungi ordine
        $idOrdine = $dbh->checkEmptyCart($utente);
        if (empty($idOrdine)) {
            $newOrderId = $dbh->createNewCart($utente);
            if ($newOrderId) {
                $idOrdine = [['ID_ordine' => $newOrderId]];
            } else {
                error_log("Errore durante la creazione di un nuovo carrello per l'utente: " . $utente);
                // Potresti reindirizzare l'utente o mostrare un messaggio di errore
                exit("Si è verificato un errore durante l'aggiunta al carrello.");
            }
        }

        if (!empty($idOrdine)) {
            //Aggiungi prodotto
            $quantitaProdotto = $dbh->checkProductOnCart($idOrdine[0]["ID_ordine"], $idprodotto);
            if (empty($quantitaProdotto)) {
                $dbh->createNewProductOnCart($idOrdine[0]["ID_ordine"], $idprodotto, $quantita);
            } else {
                if (!empty($quantitaProdotto)) {
                    $quantitaProdotto[0]["quantita_prodotto"] = $quantitaProdotto[0]["quantita_prodotto"] + $quantita;
                    $dbh->setQuantityProduct($idOrdine[0]["ID_ordine"], $idprodotto, $quantitaProdotto[0]["quantita_prodotto"]);
                } else {
                    error_log("Errore: Impossibile recuperare le informazioni sul prodotto nel carrello.");
                    // Gestisci l'errore
                }
            }

            //Aggiorna totale ordine
            $prezzoProdotto = $dbh->getPriceProduct($idprodotto);
            if ($prezzoProdotto) {
                $totale = $prezzoProdotto["prezzo"] * $quantita;
                $dbh->updateTotalCart($idOrdine[0]["ID_ordine"], $totale);
            } else {
                error_log("Errore: Impossibile recuperare il prezzo del prodotto con ID: " . $idprodotto);
                // Gestisci l'errore
            }

            //Da andare nella home o prodotto o preferiti
            if ($_POST["action"] == 7) {
                header("location: index.php");
            } else if ($_POST["action"] == 8) {
                header("location: prodotti.php");
            }
        } else {
            error_log("Errore: Impossibile recuperare o creare l'ID dell'ordine per l'utente: " . $utente);
            // Gestisci l'errore
            exit("Si è verificato un errore durante l'aggiunta al carrello.");
        }
    } else {
        error_log("Errore: idprodotto o quantita mancanti nella richiesta POST.");
        // Gestisci l'errore
        exit("Parametri mancanti per l'aggiunta al carrello.");
    }
}
/*Rimuovi dal carrello*/
if($_POST["action"]==9){
    $idprodotto = htmlspecialchars($_POST["idprodotto"]);
    $utente = $_SESSION["ID_utente"]; // Assumo che la chiave corretta sia ID_utente

    $idOrdine = $dbh->checkEmptyCart($utente);

    if(!empty($idOrdine)){ // Usare empty per verificare se l'array è vuoto
        $idOrdineValue = $idOrdine[0]["ID_ordine"]; // Assumo che la chiave corretta sia ID_ordine
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdineValue, $idprodotto);
        $prezzoProdotto= $dbh->getPriceProduct($idprodotto);

        if ($quantitaProdotto && $prezzoProdotto) { // Verifica che i dati siano stati recuperati correttamente
            $totaleDaSottrarre = -($prezzoProdotto["prezzo"] * $quantitaProdotto[0]["quantita_prodotto"]);
            $rimozioneRiuscita = $dbh->removeFromCart($idOrdineValue, $idprodotto);
            $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);

                // Verifica se il carrello è vuoto dopo la rimozione
                $prodottiNelCarrello = $dbh->getProductOnCart($idOrdineValue);
                if (empty($prodottiNelCarrello)) {
                    // **Directly set the total to 0 using resetTotalCart**
                    $dbh->resetTotalCart($idOrdineValue);
                }
             else {
                error_log("Errore durante la rimozione del prodotto...");
            }
        } else {
            error_log("Errore: Impossibile recuperare la quantità o il prezzo del prodotto.");
        }
    }
    header("location: carrello.php");
}

/*Aggiorna carrello*/
if ($_POST["action"] == 10) {
    // Aggiorna carrello
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["ID_utente"])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST["idprodotto"]) && isset($_POST["quantita"])) {
        $utente = $_SESSION["ID_utente"];
        $idprodotto = htmlspecialchars($_POST["idprodotto"]); // Corretto: recupera l'ID del prodotto
        $quantita = intval($_POST["quantita"]); // Assicurati che sia un intero

        $idOrdine = $dbh->checkEmptyCart($utente);

        // Controllo ordine
        if (!empty($idOrdine)) {
            $idOrdineValue = $idOrdine[0]["ID_ordine"];
            $quantitaProdotto = $dbh->checkProductOnCart($idOrdineValue, $idprodotto);
            if (!empty($quantitaProdotto)) {
                $nuovaQuantitaProdotto = $quantitaProdotto[0]["quantita_prodotto"] + $quantita;
                $prezzoProdotto = $dbh->getPriceProduct($idprodotto);

                if ($prezzoProdotto) {
                    if ($nuovaQuantitaProdotto <= 0) {
                        $rimozioneRiuscita = $dbh->removeFromCart($idOrdineValue, $idprodotto);
                        $totaleDaSottrarre = -($prezzoProdotto["prezzo"] * $quantitaProdotto[0]["quantita_prodotto"]);
                        $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);

                            // Verifica se il carrello è vuoto dopo la rimozione
                            $prodottiNelCarrello = $dbh->getProductOnCart($idOrdineValue);
                            if (empty($prodottiNelCarrello)) {
                                // **Directly set the total to 0 using resetTotalCart**
                                $dbh->resetTotalCart($idOrdineValue);
                            }
                        else {
                            error_log("Errore durante la rimozione del prodotto...");
                        }
                    } else {
                        // Calcola la differenza di quantità e aggiorna il totale
                        $differenzaQuantita = $nuovaQuantitaProdotto - $quantitaProdotto[0]["quantita_prodotto"];
                        $totaleDaAggiungere = $prezzoProdotto["prezzo"] * $differenzaQuantita;
                        $aggiornamentoRiuscito = $dbh->setQuantityProduct($idOrdineValue, $idprodotto, $nuovaQuantitaProdotto);
                        if ($aggiornamentoRiuscito) {
                            $dbh->updateTotalCart($idOrdineValue, $totaleDaAggiungere);
                        } else {
                            error_log("Errore durante l'aggiornamento della quantità...");
                        }
                    }
                } else {
                    error_log("Errore: Impossibile recuperare il prezzo...");
                }
            }
            header("location: carrello.php");
        }
    }
}

if ($_POST["action"] == 11) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }
    $utente = $_SESSION["ID_utente"];
    $idOrdine = htmlspecialchars($_POST["ID_ordine"]);
    //Inserire notifica
    //Modificare tutti gli stati nell'ordine
    $stato = "Effettuato";
    $testo = "Ordine " . $idOrdine . " " . $stato;
    $dbh->addNotification($testo, $utente);
    $dbh->updateNotificationStatus($idOrdine, $stato);
    //gestisciOrdine($idOrdine, $utente, 1);

    header("location: carrello.php");
}
if ($_POST["action"] == 12) {
    // Controlla se l'utente è loggato
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }

    // Recupera i dati dal form
    $ordineData = [
        'ID_ordine' => $_POST["ID_ordine"],
        'indirizzo' => ($_POST["address"]),
        'citta' => ($_POST["citta"]),
        'cap' => ($_POST["cap"]),
    ];

    // Salva i dati dell'ordine nella sessione
    $_SESSION["ordine"] = $ordineData;

    // Svuota il carrello
    $utente = $_SESSION["ID_utente"];
    $idOrdineToClear = htmlspecialchars($_POST["ID_ordine"]);

    // Ottieni tutti i prodotti nel carrello
    $prodottiNelCarrello = $dbh->getProductOnCart($idOrdineToClear);

    // Cambia lo stato dell'ordine in "In elaborazione"
    $stato = "In Elaborazione";
    if (!$dbh->updateOrderStatus($idOrdineToClear, $stato)) {
        error_log("Errore durante l'aggiornamento dello stato dell'ordine " . $idOrdineToClear . " a 'In Elaborazione'");
        // Potresti voler gestire questo errore in modo più appropriato
    }

    header("Location: conferma-acquisto.php");
    exit();
}


?>