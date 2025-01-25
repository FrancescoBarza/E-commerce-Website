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
                }
            }

            //Aggiorna totale ordine
            $prezzoProdotto = $dbh->getPriceProduct($idprodotto);
            if ($prezzoProdotto) {
                $totale = $prezzoProdotto["prezzo"] * $quantita;
                $dbh->updateTotalCart($idOrdine[0]["ID_ordine"], $totale);
            } else {
                error_log("Errore: Impossibile recuperare il prezzo del prodotto con ID: " . $idprodotto);
            }


            if ($_POST["action"] == 7) {
                header("location: index.php");
            } else if ($_POST["action"] == 8) {
                header("location: prodotti.php");
            }
        } else {
            error_log("Errore: Impossibile recuperare o creare l'ID dell'ordine per l'utente: " . $utente);

            exit("Si è verificato un errore durante l'aggiunta al carrello.");
        }
    } else {
        error_log("Errore: idprodotto o quantita mancanti nella richiesta POST.");

        exit("Parametri mancanti per l'aggiunta al carrello.");
    }
}
/*Rimuovi dal carrello*/
if ($_POST["action"] == 9) {
    $idprodotto = htmlspecialchars($_POST["idprodotto"]);
    $utente = $_SESSION["ID_utente"];

    $idOrdine = $dbh->checkEmptyCart($utente);

    if (!empty($idOrdine)) {
        $idOrdineValue = $idOrdine[0]["ID_ordine"];
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdineValue, $idprodotto);
        $prezzoProdotto = $dbh->getPriceProduct($idprodotto);

        if ($quantitaProdotto && $prezzoProdotto) { 
            $totaleDaSottrarre = - ($prezzoProdotto["prezzo"] * $quantitaProdotto[0]["quantita_prodotto"]);
            $rimozioneRiuscita = $dbh->removeFromCart($idOrdineValue, $idprodotto);
            $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);

            // Verifica se il carrello è vuoto dopo la rimozione
            $prodottiNelCarrello = $dbh->getProductOnCart($idOrdineValue);
            if (empty($prodottiNelCarrello)) {

                $dbh->resetTotalCart($idOrdineValue);
            } else {
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

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["ID_utente"])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST["idprodotto"]) && isset($_POST["quantita"])) {
        $utente = $_SESSION["ID_utente"];
        $idprodotto = htmlspecialchars($_POST["idprodotto"]); 
        $quantita = intval($_POST["quantita"]); 

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
                        $totaleDaSottrarre = - ($prezzoProdotto["prezzo"] * $quantitaProdotto[0]["quantita_prodotto"]);
                        $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);

                        // Verifica se il carrello è vuoto dopo la rimozione
                        $prodottiNelCarrello = $dbh->getProductOnCart($idOrdineValue);
                        if (empty($prodottiNelCarrello)) {

                            $dbh->resetTotalCart($idOrdineValue);
                        } else {
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

$titolareError = $capError = $cartaError = $cvvError = $annoError = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == 12) {

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

    // Esegui le validazioni 
    if (!isset($_POST["titolare"]) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST["titolare"])) {
        $titolareError = "Formato nome non corretto";
    }
    if (!isset($_POST["cap"]) || (!filter_var($_POST["cap"], FILTER_VALIDATE_INT) || strlen($_POST["cap"]) != 5)) {
        $capError = "Il CAP deve essere composto da cinque numeri";
    }
    if (!isset($_POST["numero"]) || (!preg_match("/^[0-9]*$/", $_POST["numero"]) || strlen($_POST["numero"]) != 16)) {
        $cartaError = "Il numero della carta deve essere composto da sedici numeri";
    }
    if (!isset($_POST["cvv"]) || (!filter_var($_POST["cvv"], FILTER_VALIDATE_INT) || strlen($_POST["cvv"]) != 3)) {
        $cvvError = "Il CVV deve essere composto da tre numeri";
    }
    if (!isset($_POST["scadenzaa"]) || (!filter_var($_POST["scadenzaa"], FILTER_VALIDATE_INT) || strlen($_POST["scadenzaa"]) != 4 || $_POST["scadenzaa"] < date("Y"))) {
        $annoError = "Formato anno errato";
    }

    
    if ($titolareError != "" || $capError != "" || $cartaError != "" || $cvvError != "" || $annoError != "") {
        $_SESSION["titolareError"] = $titolareError;
        $_SESSION["capError"] = $capError;
        $_SESSION["cartaError"] = $cartaError;
        $_SESSION["cvvError"] = $cvvError;
        $_SESSION["annoError"] = $annoError;
        $_SESSION["ordine_data"] = $ordineData; // Mantiene i dati inseriti per comodità
        header("Location: carrello.php");
        exit();
    }

    $_SESSION["ordine"] = $ordineData;

    $utente = $_SESSION["ID_utente"];
    $idOrdineToClear = htmlspecialchars($_POST["ID_ordine"]);

    
    $prodottiNelCarrello = $dbh->getProductFromOrder($idOrdineToClear);

    $erroreAggiornamentoQuantita = false;

    if ($prodottiNelCarrello) {
        foreach ($prodottiNelCarrello as $prodotto) {
            $idProdotto = $prodotto['ID_prodotto'];
            $quantitaAcquistata = $prodotto['quantita'];

           
            $currentQuantity = $dbh->getProductQuantity($idProdotto);

            //  Controlla se la quantità acquistata è disponibile
            if ($quantitaAcquistata > $currentQuantity) {
                error_log("Errore: Quantità insufficiente per il prodotto con ID " . $idProdotto . ". Richiesti: " . $quantitaAcquistata . ", Disponibili: " . $currentQuantity);
                $_SESSION["errore_carrello"] = "La quantità richiesta per alcuni prodotti non è disponibile. Riprova modificando il tuo carrello.";
                $erroreAggiornamentoQuantita = true;
                break;
            }

            // Diminuisci la quantità del prodotto nel database SOLO SE c'è abbastanza stock
            if (!$dbh->decreaseProductQuantity($idProdotto, $quantitaAcquistata)) {
                error_log("Errore durante la diminuzione della quantità del prodotto con ID " . $idProdotto);
                $_SESSION["errore_carrello"] = "Si è verificato un errore durante l'aggiornamento della quantità di alcuni prodotti. Riprova o contatta l'assistenza.";
                $erroreAggiornamentoQuantita = true;
                break;
            }
        }
    }

    if ($erroreAggiornamentoQuantita) {
        header("Location: carrello.php");
        exit();
    }


    if (!$erroreAggiornamentoQuantita) {
        $stato = "In Elaborazione";
        if (!$dbh->updateOrderStatus($idOrdineToClear, $stato)) {
            error_log("Errore durante l'aggiornamento dello stato dell'ordine " . $idOrdineToClear . " a 'In Elaborazione'");
            $_SESSION["errore_carrello"] = "Si è verificato un errore durante l'elaborazione dell'ordine. Riprova o contatta l'assistenza.";
            header("Location: carrello.php");
            exit();
        }
    }
    try {
        // Notifica per il cliente
        $testoCliente = "Ordine n." . $idOrdineToClear . " " . $stato;
        $dbh->addNotification($testoCliente, $utente, $idOrdineToClear);

        // Recupera l'ID del venditore
        $venditoreId = $dbh->getVenditoreId();
        $testoVenditore = "Nuovo ordine n." . $idOrdineToClear . " da elaborare.";
        $dbh->addNotification($testoVenditore, $venditoreId, $idOrdineToClear);
    } catch (Exception $e) {
        error_log("Errore durante la creazione delle notifiche: " . $e->getMessage());
        $_SESSION["errore_carrello"] = "Si è verificato un errore durante la creazione delle notifiche. Riprova o contatta l'assistenza.";
        header("Location: carrello.php");
        exit();
    }


    header("Location: conferma-acquisto.php");
    exit();
}
