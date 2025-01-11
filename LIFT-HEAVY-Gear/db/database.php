<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
        die("Connection failed: " /* . $db->connect_error */);
        }        
    }

    public function getCategories() {
        $query = "SELECT ID_categoria, nome_categoria FROM categoria ORDER BY ID_categoria ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = $result->fetch_all(MYSQLI_ASSOC);
        if (empty($categories)) {
            return [];  // Restituisce un array vuoto per gestire l'assenza di categorie
        }
        return $categories;
    }
    
    public function getCategoriesById($id){
        $stmt = $this->db->prepare("SELECT ID_categoria, nome_categoria FROM categoria WHERE ID_categoria = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Restituisce un singolo record come array associativo
    }
    public function getProduct($n=-1) {
        $query = "SELECT ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria FROM prodotto";
        if ($n > 0) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($n > 0) {
            $stmt->bind_param('i', $n);
        }
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id) {
        $query = "SELECT ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProductByCategory($idcategoria){
        $query = "SELECT ID_prodotto, nome, immagine, descrizione, prezzo, quantita FROM prodotto WHERE ID_categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idcategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getRandomProduct($n=12){
        $query = "SELECT ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria FROM prodotto ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProductByIdOnCart($id) {
        // Query corretta con il nome della tabella e colonne
        $query = "SELECT ID_prodotto, nome, immagine, prezzo FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getOrder($id) { 
        $statoCarrello = "Carrello";
        $query = "SELECT ordine.ID_ordine, data_ordine, stato_ordine, prezzo_totale, prodotto.immagine, prodotto.nome 
                  FROM ordine 
                  JOIN utente ON ordine.ID_utente = utente.ID_utente 
                  JOIN ordini_prodotti ON ordine.ID_ordine = ordini_prodotti.ID_ordine 
                  JOIN prodotto ON ordini_prodotti.ID_prodotto = prodotto.ID_prodotto 
                  WHERE ordine.ID_utente = ? AND stato_ordine != ? 
                  GROUP BY ordini_prodotti.ID_ordine";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id, $statoCarrello);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getOrderById($id) {
        $query = "SELECT ordine.ID_ordine, data_ordine, stato_ordine, prezzo_totale, prodotto.immagine, prodotto.nome 
                  FROM ordine 
                  JOIN ordini_prodotti ON ordine.ID_ordine = ordini_prodotti.ID_ordine 
                  JOIN prodotto ON ordini_prodotti.ID_prodotto = prodotto.ID_prodotto 
                  WHERE ordine.ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getProductFromOrder($id) {
        $query = "SELECT prodotto.nome 
                  FROM prodotto 
                  JOIN ordini_prodotti ON ordini_prodotti.ID_prodotto = prodotto.ID_prodotto 
                  WHERE ordini_prodotti.ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getUserDataById($id) {
        $query = "SELECT nome, cognome, email, Password, venditore
                  FROM utente 
                  WHERE ID_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc();
    }
    public function checkLogin($email, $password) {
        $query = "SELECT ID_utente, nome, email, Password, venditore
                  FROM utente 
                  WHERE email = ? AND Password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password); 
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc();
    }
    
    public function addUser($nome, $cognome, $email, $password, $venditore) {
        $query = "INSERT INTO utente (nome, cognome, email, Password, venditore) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $nome, $cognome, $email, $password, $venditore);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
    
    public function editUserData($id_utente, $nome, $cognome, $email, $password) {
        $query = "UPDATE utente 
                  SET nome = ?, cognome = ?, email = ?, password = ? 
                  WHERE ID_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssi', $nome, $cognome, $email, $password, $id_utente);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addProduct($nome, $descrizione, $prezzo, $quantita, $peso, $lunghezza, $immagine, $ID_categoria) {
        $query = "INSERT INTO prodotto (nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssfiffsi', $nome, $descrizione, $prezzo, $quantita, $peso, $lunghezza, $immagine, $ID_categoria);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
    
    public function supplyProduct($idprodotto, $quantita) {
        $query = "UPDATE prodotto SET quantita = quantita + ? WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idprodotto, $quantita);
        $stmt->execute();
    }
    
    public function updateOrderStatus($id, $stato) {
        $query = "UPDATE ordine SET stato_ordine = ? WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id, $stato);
        $stmt->execute();
        
        return $stmt->affected_rows; // Restituisce il numero di righe aggiornate
    }

    public function createNewCart($idutente) {
        $statoCarrello = "Carrello";
        $totaleCarrello = 0;
        $dataCorrente = date("Y-m-d");
        $query = "INSERT INTO ordine (data_ordine, stato_ordine, prezzo_totale, ID_utente) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssfi', $dataCorrente, $statoCarrello, $totaleCarrello, $idutente);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query INSERT: " . $stmt->error);
        }
    
        return $stmt->insert_id; // Restituisce l'ID del nuovo carrello
    }
    public function checkProductOnCart($idOrdine, $idprodotto) {
        $query = "SELECT quantita_prodotto FROM ordini_prodotti WHERE ID_ordine = ? AND ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idOrdine, $idprodotto);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query SELECT: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Restituisce un singolo record
    }
    
    public function createNewProductOnCart($idOrdine, $idprodotto, $quantita) {
        $query = "INSERT INTO ordini_prodotti (ID_ordine, ID_prodotto, quantita_prodotto) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $idOrdine, $idprodotto, $quantita);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query INSERT: " . $stmt->error);
        }
    
        return $stmt->insert_id; // Restituisce l'ID del prodotto appena inserito nel carrello
    }
    public function setQuantityProduct($idOrdine, $idprodotto, $quantita) {
        $query = "UPDATE ordini_prodotti SET quantita_prodotto = ? WHERE ID_ordine = ? AND ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $quantita, $idOrdine, $idprodotto);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query UPDATE: " . $stmt->error);
        }
    
        return $stmt->affected_rows; // Restituisce il numero di righe aggiornate
    }
    public function updateTotalCart($idOrdine, $totale) {
        $query = "UPDATE ordine SET prezzo_totale = prezzo_totale + ? WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('fi', $totale, $idOrdine);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query UPDATE: " . $stmt->error);
        }
    
        return $stmt->affected_rows; // Restituisce il numero di righe aggiornate
    }
    
    public function getPriceProduct($idprodotto) {
        $query = "SELECT prezzo FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idprodotto);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query SELECT: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Restituisce un singolo record
    }
    public function getProductOnCart($currentCart) {
        $query = "SELECT ordini_prodotti.ID_prodotto, quantita_prodotto, prodotto.nome, prodotto.immagine, prodotto.prezzo 
                  FROM ordini_prodotti 
                  JOIN prodotto ON ordini_prodotti.ID_prodotto = prodotto.ID_prodotto 
                  WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $currentCart);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query SELECT: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function removeFromCart($idOrdine, $idprodotto) {
        $query = "DELETE FROM ordini_prodotti WHERE ID_ordine = ? AND ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idOrdine, $idprodotto);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query DELETE: " . $stmt->error);
        }
    }
    public function checkEmptyCart($utente) {
        $statoCarrello = "Carrello";
        $query = "SELECT ID_ordine, prezzo_totale FROM ordine 
                  WHERE ID_utente = ? AND stato_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $utente, $statoCarrello);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNotification($utente) {
        $query = "SELECT ID_notifica, testo, stato_notifica 
                  FROM notifica WHERE ID_utente = ? 
                  ORDER BY ID_notifica";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $utente);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function addNotification($testo, $utente) {
        $stato = 0; // Stato predefinito
        $query = "INSERT INTO notifica (testo, ID_utente, stato_notifica) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sis', $testo, $utente, $stato);
        $stmt->execute();
        
        return $stmt->insert_id; // Restituisce l'ID della notifica appena inserita
    }
    public function deleteNotification($idnotifica) {
        $query = "DELETE FROM notifica WHERE ID_notifica = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idnotifica);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query DELETE: " . $stmt->error);
        }
    }
    
    public function updateNotificationStatus($utente) {
        $letto = 1; // Indica che la notifica è stata letta
        $query = "UPDATE notifica SET stato_notifica = ? WHERE ID_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $letto, $utente);
        $stmt->execute();
    }
    
    public function checkMail($email) {
        $query = "SELECT ID_utente FROM utente WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query SELECT: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Restituisce un singolo record
    }
    
    public function getArticles(){
        $query = "SELECT ID_articolo, titolo_articolo, testo_articolo, data_articolo, immagine_articolo FROM articolo ORDER BY data_articolo DESC ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getArticlesbyId($id){
        $query = "SELECT ID_articolo, titolo_articolo, testo_articolo, data_articolo, immagine_articolo FROM articolo WHERE ID_articolo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}

?>