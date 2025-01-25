<?php
require_once("bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_prodotto = intval($_POST["id_prodotto"]);
    $quantita_aggiunta = intval($_POST["quantita"]);

    if ($id_prodotto > 0 && $quantita_aggiunta > 0) {
        
        $dbh->supplyProduct($id_prodotto, $quantita_aggiunta);
    }
}


header("Location: gestioneProdotti.php");
exit;
?>