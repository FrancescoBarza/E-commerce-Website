<?php
require_once("bootstrap.php");
if($_POST["action"]==7 || $_POST["action"]==8){
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }
    $idprodotto = htmlspecialchars($_POST["idprodotto"]);
    $quantita = htmlspecialchars($_POST["quantita"]);

    $utente = $_SESSION["ID_utente"];
    
    // Aggiungi ordine
    if(count($dbh->checkEmptyCart($utente)) == 0){
        $dbh->createNewCart($utente);
    } 
    $idOrdine = $dbh->checkEmptyCart($utente);
        //Aggiungi prodotto
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdine[0]["ID_ordine"], $idprodotto);
        if(count($quantitaProdotto) == 0){
            $dbh->createNewProductOnCart($idOrdine[0]["ID_ordine"], $idprodotto, $quantita);
        }
        else {
            $quantitaProdotto[0]["quantita_prodotto"] = $quantitaProdotto[0]["quantita_prodotto"] + $quantita;
            $dbh->setQuantityProduct($idOrdine[0]["ID_ordine"], $idprodotto, $quantitaProdotto[0]["quantita_prodotto"]);
        }

        //Aggiorna totale ordine
        $prezzoProdotto= $dbh->getPriceProduct($idprodotto);
        $totale = $prezzoProdotto[0]["prezzo"] * $quantita;
        $dbh->updateTotalCart($idOrdine[0]["ID_ordine"], $totale);

    //Da andare nella home o prodotto o preferiti
    if($_POST["action"]==7) { 
        header("location: index.php");
    } else if($_POST["action"]==8) {
        header("location: prodotti.php");
    }     
}
/*Rimuovi dal carrello*/
if ($_POST["action"] == 9) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }
    $utente = $_SESSION["ID_utente"];
    $idprodotto = htmlspecialchars($_POST["ID_prodotto"]);

    $idOrdine = $dbh->checkEmptyCart($utente);

    if (!empty($idOrdine)) {
        $idOrdineValue = $idOrdine[0]["ID_ordine"];
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdineValue, $idprodotto);
        if (!empty($quantitaProdotto)) {
            $prezzoProdotto = $dbh->getPriceProduct($idprodotto);
            $totaleDaSottrarre = - ($prezzoProdotto[0]["prezzo"] * $quantitaProdotto[0]["quantita_prodotto"]);
            $dbh->removeFromCart($idOrdineValue, $idprodotto);
            $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);
        }
    }
    header("location: carrello.php");
}

/*Aggiorna carrello*/
if ($_POST["action"] == 10) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }
    $utente = $_SESSION["ID_utente"];
    $idprodotto = htmlspecialchars($_POST["ID_ordine"]);
    $quantita = htmlspecialchars($_POST["quantita"]);

    $idOrdine = $dbh->checkEmptyCart($utente);

    // Controllo ordine
    if (!empty($idOrdine)) {
        $idOrdineValue = $idOrdine[0]["ID_ordine"];
        //Aggiungi prodotto
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdineValue, $idprodotto);
        if (!empty($quantitaProdotto)) {
            $quantitaProdotto[0]["quantita_prodotto"] += $quantita;
            $prezzoProdotto = $dbh->getPriceProduct($idprodotto);
            //Controllo che la quantita non sia scesa a 0
            if ($quantitaProdotto[0]["quantita_prodotto"] <= 0) {
                $dbh->removeFromCart($idOrdineValue, $idprodotto);
                // Totale da sottrarre calcolato con la quantità precedente
                $totaleDaSottrarre = -($prezzoProdotto[0]["prezzo"] * abs($quantitaProdotto[0]["quantita_prodotto"] - $quantita));
                $dbh->updateTotalCart($idOrdineValue, $totaleDaSottrarre);
            } else {
                $dbh->setQuantityProduct($idOrdineValue, $idprodotto, $quantitaProdotto[0]["quantita_prodotto"]);
                //Aggiorna totale ordine
                $totale = $prezzoProdotto[0]["prezzo"] * $quantita;
                $dbh->updateTotalCart($idOrdineValue, $totale);
            }
        }
        header("location: carrello.php");
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
?>