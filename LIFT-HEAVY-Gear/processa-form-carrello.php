<?php
if($_POST["action"]==7 || $_POST["action"]==8){
    if(!isUserLoggedIn()){
        header("location: login.php");
    }
    $idprodotto = htmlspecialchars($_POST["idprodotto"]);
    $quantita = htmlspecialchars($_POST["quantita"]);

    $utente = $_SESSION["idutente"];
    
    // Aggiungi ordine
    if(count($dbh->checkEmptyCart($utente)) == 0){
        $dbh->createNewCart($utente);
    } 
    $idOrdine = $dbh->checkEmptyCart($utente);
        //Aggiungi prodotto
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdine[0]["IdOrdine"], $idprodotto);
        if(count($quantitaProdotto) == 0){
            $dbh->createNewProductOnCart($idOrdine[0]["IdOrdine"], $idprodotto, $quantita);
        }
        else {
            $quantitaProdotto[0]["QuantitaPr"] = $quantitaProdotto[0]["QuantitaPr"] + $quantita;
            $dbh->setQuantityProduct($idOrdine[0]["IdOrdine"], $idprodotto, $quantitaProdotto[0]["QuantitaPr"]);
        }

        //Aggiorna totale ordine
        $prezzoProdotto= $dbh->getPriceProduct($idprodotto);
        $totale = $prezzoProdotto[0]["PrezzoProdotto"] * $quantita;
        $dbh->updateTotalCart($idOrdine[0]["IdOrdine"], $totale);

    //Da andare nella home o prodotto o preferiti
    if($_POST["action"]==7) { 
        header("location: index.php");
    } else if($_POST["action"]==8) {
        header("location: preferiti.php");
    }     
}

/*Rimuovi dal carrello*/
if($_POST["action"]==9){
    $idprodotto = htmlspecialchars($_POST["idprodotto"]);

    $utente = $_SESSION["idutente"];
    
    $idOrdine = $dbh->checkEmptyCart($utente);

    if(count($idOrdine) != 0){
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdine[0]["IdOrdine"], $idprodotto);
        $prezzoProdotto= $dbh->getPriceProduct($idprodotto);
        $totaleDaSottrarre = -($prezzoProdotto[0]["PrezzoProdotto"] * $quantitaProdotto[0]["QuantitaPr"]);
        $dbh->removeFromCart($idOrdine[0]["IdOrdine"], $idprodotto);
        $dbh->updateTotalCart($idOrdine[0]["IdOrdine"], $totaleDaSottrarre);
    }
    header("location: carrello.php");
}

/*Aggiorna carrello*/
if($_POST["action"]==10){
    $idprodotto = htmlspecialchars($_POST["idprodotto"]);
    $quantita = htmlspecialchars($_POST["quantita"]);
    $utente = $_SESSION["idutente"];
    
    $idOrdine = $dbh->checkEmptyCart($utente);

    // Controllo ordine
    if(count($idOrdine) != 0){
        //Aggiungi prodotto
        $quantitaProdotto = $dbh->checkProductOnCart($idOrdine[0]["IdOrdine"], $idprodotto);
        $quantitaProdotto[0]["QuantitaPr"] = $quantitaProdotto[0]["QuantitaPr"] + $quantita;
        $prezzoProdotto= $dbh->getPriceProduct($idprodotto);
        //Controllo che la quantita non sia scesa a 0, in tal caso elimino l'elemento
        if($quantitaProdotto[0]["QuantitaPr"] == 0) {
            $totaleDaSottrarre = $prezzoProdotto[0]["PrezzoProdotto"] * $quantita;
            $dbh->removeFromCart($idOrdine[0]["IdOrdine"], $idprodotto);
            $dbh->updateTotalCart($idOrdine[0]["IdOrdine"], $totaleDaSottrarre);
        } else{
            $dbh->setQuantityProduct($idOrdine[0]["IdOrdine"], $idprodotto, $quantitaProdotto[0]["QuantitaPr"]);
            //Aggiorna totale ordine
            $totale = $prezzoProdotto[0]["PrezzoProdotto"] * $quantita;
            $dbh->updateTotalCart($idOrdine[0]["IdOrdine"], $totale);
        }
        header("location: carrello.php");
    }
}

if($_POST["action"]==11) {
    $idOrdine = htmlspecialchars($_POST["idOrdine"]);
    $utente = $_SESSION["idutente"];
    //Inserire notifica
    //Modificare tutti gli stati nell'ordine
    $stato = "Effettuato";
    $testo = "Ordine ".$idOrdine." ".$stato; 
    $dbh->insertNotifica($testo, $utente);
    $dbh->updateStato($idOrdine, $stato);
    //gestisciOrdine($idOrdine, $utente, 1);

    header("location: carrello.php");
}
?>