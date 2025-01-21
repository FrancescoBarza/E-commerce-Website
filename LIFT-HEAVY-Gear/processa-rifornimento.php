<?php
require_once("bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_prodotto = intval($_POST["id_prodotto"]);
    $quantita_aggiunta = intval($_POST["quantita"]);

    if ($id_prodotto > 0 && $quantita_aggiunta > 0) {
        // Aggiorna la quantità del prodotto nel database
        $dbh->supplyProduct($id_prodotto, $quantita_aggiunta);
    }
}

// Reindirizza alla pagina principale per aggiornare i dati
header("Location: gestioneProdotti.php");
exit;
?>