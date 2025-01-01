<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
        die("Connection failed: " /*. $db->connect_error*/);
        }        
    }
    public function getProduct($n=-1) {
        // Query corretta con il nome della tabella e colonne
        $query = "SELECT ID_prodotto, nome, immagine, descrizione, prezzo, quantita FROM prodotto";
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
        // Query corretta con il nome della tabella e colonne
        $query = "SELECT ID_prodotto, nome, immagine, descrizione, prezzo, quantita FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
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
    
    public function getOrdini($id) { 
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
    public function getOrdineById($id) {
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
    
    public function getProdottiFromOrdine($id) {
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
    public function getDati($id) {
        $query = "SELECT nome, cognome, email 
                  FROM utente 
                  WHERE ID_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function checkLogin($email, $password) {
        $query = "SELECT ID_utente, nome, email, Password 
                  FROM utente 
                  WHERE email = ? AND Password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function inserisciUtente($nome, $cognome, $email, $password) {
        $query = "INSERT INTO utente (nome, cognome, email, Password) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $nome, $cognome, $email, $password);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
    
    public function inserisciProdotto($nome, $immagine, $prezzo, $descrizione, $quantita, $categoria) {
        $query = "INSERT INTO prodotto (nome, immagine, descrizione, prezzo, quantita, ID_categoria) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssdis', $nome, $immagine, $descrizione, $prezzo, $quantita, $categoria);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
    
    public function rifornisciProdotto($idprodotto, $quantita) {
        $query = "UPDATE prodotto SET quantita = quantita + ? WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $quantita, $idprodotto);
        $stmt->execute();
    }
    
    public function updateStato($id, $stato) {
        $query = "UPDATE ordine SET stato_ordine = ? WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $stato, $id);
        $stmt->execute();
        
        return $stmt->affected_rows; // Restituisce il numero di righe aggiornate
    }
    //da vedere meglio
    public function getProdottiByIdCategoria($idcategoria) {
        $query = "SELECT ID_prodotto, nome, immagine, prezzo, quantita 
                  FROM prodotto WHERE ID_categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idcategoria);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function createNewCart($utente) {
        $statoCarrello = "Carrello";
        $totaleCarrello = 0;
        $dataCorrente = date("Y-m-d");
        $query = "INSERT INTO ordine (data_ordine, stato_ordine, prezzo_totale, ID_utente) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssdi', $dataCorrente, $statoCarrello, $totaleCarrello, $utente);
    
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
        $stmt->bind_param('di', $totale, $idOrdine);
    
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
    public function getNotifiche($utente) {
        $query = "SELECT ID_notifica, testo, stato_notifica 
                  FROM notifica WHERE ID_utente = ? 
                  ORDER BY ID_notifica";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $utente);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function insertNotifica($testo, $utente) {
        $stato = 0; // Stato predefinito
        $query = "INSERT INTO notifica (testo, ID_utente, stato_notifica) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $testo, $utente, $stato);
        $stmt->execute();
        
        return $stmt->insert_id; // Restituisce l'ID della notifica appena inserita
    }
    public function deleteNotifica($idnotifica) {
        $query = "DELETE FROM notifica WHERE ID_notifica = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idnotifica);
    
        if (!$stmt->execute()) {
            throw new Exception("Errore nella query DELETE: " . $stmt->error);
        }
    }
    
    
    public function updateStatoNotifiche($utente) {
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

    
    
}

?>