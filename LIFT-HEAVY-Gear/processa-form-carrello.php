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
if ($_POST["action"] == 9) {
    // Rimuovi dal carrello
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["ID_utente"])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST["idprodotto"])) {
        $utente = $_SESSION["ID_utente"];
        $idprodotto = htmlspecialchars($_POST["idprodotto"]);

        $idOrdine = $dbh->checkEmptyCart($utente);

        if (!empty($idOrdine)) {
            $idOrdineValue = $idOrdine[0]["ID_ordine"];
            $quantitaProdotto = $dbh->checkProductOnCart($idOrdineValue, $idprodotto);
    
            if (!empty($quantitaProdotto)) {
                $prezzoProdotto = $dbh->getPriceProduct($idprodotto);
    
                if ($prezzoProdotto) {
                    $totaleDaSottrarre = -($prezzoProdotto["prezzo"] * $quantitaProdotto[0]["quantita_prodotto"]);
                    $rimozioneRiuscita = $dbh->removeFromCart($idOrdineValue, $idprodotto);
                    if ($rimozioneRiuscita) {
                        $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);
    
                        // Verifica se il carrello è vuoto dopo la rimozione
                        $prodottiNelCarrello = $dbh->getProductOnCart($idOrdineValue);
                        if (empty($prodottiNelCarrello)) {
                            // Imposta il prezzo totale a 0
                            $dbh->updateTotalCart($idOrdineValue, -$currentCart[0]["prezzo_totale"]); // Sottraggo il totale corrente per azzerarlo
                        }
                    } else {
                        error_log("Errore durante la rimozione del prodotto...");
                    }
                } else {
                    error_log("Errore: Impossibile recuperare il prezzo...");
                }
            }
        }
        header("location: carrello.php");
    }
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
                        if ($rimozioneRiuscita) {
                            $totaleDaSottrarre = -($prezzoProdotto["prezzo"] * $quantitaProdotto[0]["quantita_prodotto"]);
                            $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);
    
                            // Verifica se il carrello è vuoto dopo la rimozione
                            $prodottiNelCarrello = $dbh->getProductOnCart($idOrdineValue);
                            if (empty($prodottiNelCarrello)) {
                                // Imposta il prezzo totale a 0
                                $dbh->updateTotalCart($idOrdineValue, -$currentCart[0]["prezzo_totale"]); // Sottraggo il totale corrente per azzerarlo
                            }
                        } else {
                            error_log("Errore durante la rimozione del prodotto...");
                        }
                    } else {
                        $aggiornamentoRiuscito = $dbh->setQuantityProduct($idOrdineValue, $idprodotto, $nuovaQuantitaProdotto);
                        if ($aggiornamentoRiuscito) {
                            $totaleDaAggiungere = $prezzoProdotto["prezzo"] * $quantita;
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
