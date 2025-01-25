<?php
require_once("bootstrap.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Raccogli i dati del prodotto dal form
    $nome = $_POST["nome"];
    $descrizione = $_POST["descrizione"];
    $prezzo = floatval($_POST["prezzo"]);
    $quantita = intval($_POST["quantita"]);
    $peso = floatval($_POST["peso"]);
    $lunghezza = floatval($_POST["lunghezza"]);
    $ID_categoria = intval($_POST["categoria"]);

    // Verifica che tutti i parametri abbiano il tipo corretto
if (!is_string($nome)) {
    die("Errore: il nome deve essere una stringa.");
}
if (!is_string($descrizione)) {
    die("Errore: la descrizione deve essere una stringa.");
}
if (!is_float($prezzo)) {
    die("Errore: il prezzo deve essere un numero decimale.");
}
if (!is_int($quantita)) {
    die("Errore: la quantità deve essere un numero intero.");
}
if (!is_float($peso)) {
    die("Errore: il peso deve essere un numero decimale.");
}
if (!is_float($lunghezza)) {
    die("Errore: la lunghezza deve essere un numero decimale.");
}
if (!is_int($ID_categoria)) {
    die("Errore: l'ID categoria deve essere un numero intero.");
}

    
    if (isset($_FILES['immagine']) && $_FILES['immagine']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = UPLOAD_DIR_UPLOADS; 
        $imageName = basename($_FILES['immagine']['name']);
        $uploadFile = $uploadDir . $imageName;
    
      
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($_FILES['immagine']['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Errore: solo immagini con estensione JPEG, PNG o GIF sono consentite.");
        }
    
        // Verifica tipo MIME
        $mime_type = mime_content_type($_FILES['immagine']['tmp_name']);
        if (strpos($mime_type, 'image/') !== 0) {
            die("Il file caricato non è un'immagine valida. Tipo MIME: " . $mime_type);
        }
    
        // Verifica la dimensione dell'immagine
        $maxFileSize = 5 * 1024 * 1024; 
        if ($_FILES['immagine']['size'] > $maxFileSize) {
            die("Errore: l'immagine è troppo grande. La dimensione massima consentita è 5MB.");
        }
    
        
        $imageType = exif_imagetype($_FILES['immagine']['tmp_name']);
        if ($imageType === false) {
            die("Il file caricato non è un'immagine valida (usando exif_imagetype).");
        }
    
        
        if (move_uploaded_file($_FILES['immagine']['tmp_name'], $uploadFile)) {
    // Aggiunta il prodotto nel database
    $result = $dbh->addProduct(
        $nome,
        $descrizione,
        $prezzo,
        $quantita,
        $peso,
        $lunghezza,
        $imageName,
        $ID_categoria
    );
    
    if ($result) {
        // Reindirizza alla pagina di gestione dei prodotti
        header("Location: GestioneProdotti.php");
        exit();
    } else {
        echo "Errore durante l'inserimento del prodotto.";
    }
        } else {
            die("Errore nel caricamento dell'immagine.");
        }
    } else {
        die("Errore durante l'upload dell'immagine.");
    }
    
    
    

    
}
?>
