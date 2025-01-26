<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: ");
        }
    }

    public function getCategories()
    {
        $query = "SELECT ID_categoria, nome_categoria FROM categoria ORDER BY ID_categoria ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = $result->fetch_all(MYSQLI_ASSOC);
        if (empty($categories)) {
            return [];
        }
        return $categories;
    }

    public function getCategoriesById($id)
    {
        $stmt = $this->db->prepare("SELECT ID_categoria, nome_categoria FROM categoria WHERE ID_categoria = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function getProduct($n = -1)
    {
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
   
    public function getProdottiInEsaurimento()
    {
        $query = "SELECT ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza FROM prodotto WHERE quantita <= 10";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
   
    public function getNumeroProdottiInEsaurimento()
    {
        $query = "SELECT COUNT(*) AS numero_prodotti_in_esaurimento FROM prodotto WHERE quantita <= 10";
        $result = $this->db->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row["numero_prodotti_in_esaurimento"];
        } else {
            return false;
        }
    }
    public function getProductById($id)
    {
        $query = "SELECT ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProductByCategory($idcategoria)
    {
        $query = "SELECT ID_prodotto, nome, immagine, descrizione, prezzo, quantita FROM prodotto WHERE ID_categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idcategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getRandomProduct($n = 12)
    {
        $query = "SELECT ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria FROM prodotto ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchProducts($searchTerm)
    {
        $query = "SELECT ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria 
                  FROM prodotto 
                  WHERE nome LIKE CONCAT('%', ?, '%')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getProductByIdOnCart($id)
    {
        
        $query = "SELECT ID_prodotto, nome, immagine, prezzo FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrder($id)
    {
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
    public function getOrdersByUserId($userId)
    {
        $query = "SELECT * FROM ordine WHERE ID_utente = ? AND stato_ordine != 'Carrello' ORDER BY data_ordine DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getOrderById($id)
    {
        $query = "SELECT ordine.ID_ordine, ordine.ID_utente, data_ordine, stato_ordine, prezzo_totale, prodotto.immagine, prodotto.nome
                  FROM ordine
                  JOIN ordini_prodotti ON ordine.ID_ordine = ordini_prodotti.ID_ordine
                  JOIN prodotto ON ordini_prodotti.ID_prodotto = prodotto.ID_prodotto
                  WHERE ordine.ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc();
    }
    public function getProductFromOrder($id)
    {
        $query = "SELECT
                    p.ID_prodotto,
                    p.nome AS nome_prodotto,
                    p.descrizione,
                    p.prezzo,
                    p.immagine,
                    op.quantita_prodotto AS quantita
                FROM prodotto p
                JOIN ordini_prodotti op ON p.ID_prodotto = op.ID_prodotto
                WHERE op.ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getUserDataById($id)
    {
        $query = "SELECT nome, cognome, email, Password, venditore
                  FROM utente 
                  WHERE ID_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateUserData($userId, $nome, $cognome, $email, $password = null)
    {
        if ($password) {
            $query = "UPDATE utente SET nome = ?, cognome = ?, email = ?, Password = ? WHERE ID_utente = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssi', $nome, $cognome, $email, $password, $userId);
        } else {
            $query = "UPDATE utente SET nome = ?, cognome = ?, email = ? WHERE ID_utente = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssi', $nome, $cognome, $email, $userId);
        }
        return $stmt->execute();
    }

    public function checkLogin($email, $password)
    {
        $query = "SELECT ID_utente, nome, email, Password, venditore
                  FROM utente 
                  WHERE email = ? AND Password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function checkMail($email)
    {
        $query = "SELECT ID_utente FROM utente WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);

        if (!$stmt->execute()) {
            throw new Exception("Errore nella query SELECT: " . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }

    public function addUser($nome, $cognome, $email, $password, $venditore)
    {
        $query = "INSERT INTO utente (nome, cognome, email, Password, venditore) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $nome, $cognome, $email, $password, $venditore);
        $stmt->execute();

        return $stmt->insert_id;
    }
    public function checkIfVendorExists()
    {
        $query = "SELECT 1 FROM utente WHERE venditore = 'Y'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stmt->store_result(); 

        $num_rows = $stmt->num_rows;

        $stmt->close();

        return $num_rows > 0;
    }

    //QUERY VENDITORE 
    public function addProduct($nome, $descrizione, $prezzo, $quantita, $peso, $lunghezza, $immagine, $ID_categoria)
    {
        $query = "INSERT INTO prodotto (nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssdiidsi', $nome, $descrizione, $prezzo, $quantita, $peso, $lunghezza, $immagine, $ID_categoria);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function supplyProduct($idprodotto, $quantita)
    {
        $query = "UPDATE prodotto SET quantita = quantita + ? WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $quantita, $idprodotto);
        $stmt->execute();
    }
    public function updateOrderStatus($id, $stato)
    {
        $query = "UPDATE ordine SET stato_ordine = ? WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $stato, $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function createNewCart($idutente)
    {
        $statoCarrello = "Carrello";
        $totaleCarrello = 0;
        $dataCorrente = date("Y-m-d");
        $query = "INSERT INTO ordine (data_ordine, stato_ordine, prezzo_totale, ID_utente) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssdi', $dataCorrente, $statoCarrello, $totaleCarrello, $idutente);

        $stmt->execute();

        return $stmt->insert_id; 
    }
    public function checkProductOnCart($idOrdine, $idprodotto)
    {
        $query = "SELECT quantita_prodotto FROM ordini_prodotti WHERE ID_ordine = ? AND ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idOrdine, $idprodotto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function createNewProductOnCart($idOrdine, $idprodotto, $quantita)
    {
        $query = "INSERT INTO ordini_prodotti (ID_ordine, ID_prodotto, quantita_prodotto) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $idOrdine, $idprodotto, $quantita);

        if (!$stmt->execute()) {
            throw new Exception("Errore nella query INSERT: " . $stmt->error);
        }

        return $stmt->insert_id; 
    }
    public function setQuantityProduct($idOrdine, $idprodotto, $quantita)
    {
        $query = "UPDATE ordini_prodotti SET quantita_prodotto = ? WHERE ID_ordine = ? AND ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $quantita, $idOrdine, $idprodotto);

        if (!$stmt->execute()) {
            throw new Exception("Errore nella query UPDATE: " . $stmt->error);
        }

        return $stmt->affected_rows; 
    }
    public function updateTotalCart($idOrdine, $totale)
    {
        error_log("updateTotalCart chiamato con ID Ordine: " . $idOrdine . ", Totale: " . $totale);
        $query = "UPDATE ordine SET prezzo_totale = prezzo_totale + ? WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('di', $totale, $idOrdine); 

        if (!$stmt->execute()) {
            throw new Exception("Errore nella query UPDATE: " . $stmt->error);
        }

        return $stmt->affected_rows;
    }
    public function countProductsInCart($idOrdine)
    {
        $query = "SELECT SUM(quantita_prodotto) AS totale_prodotti
              FROM ordini_prodotti
              WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idOrdine);

        if (!$stmt->execute()) {
            error_log("Errore nella query COUNT: " . $stmt->error);
            return 0;
        }

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            
            return $row['totale_prodotti'] ?: 0;
        } else {
            
            return 0;
        }
    }
    public function resetTotalCart($idOrdine)
    {
        $query = "UPDATE ordine SET prezzo_totale = 0 WHERE ID_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idOrdine);
        return $stmt->execute();
    }
    public function decreaseProductQuantity($prodottoId, $quantita)
    {
        $query = "UPDATE prodotto SET quantita = quantita - ? WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $quantita, $prodottoId);  

        if (!$stmt->execute()) {
            throw new Exception("Errore nell'aggiornamento della quantità del prodotto: " . $stmt->error);
        }
        return $stmt->affected_rows > 0;  
    }
    public function getProductQuantity($prodottoId)
    {
        $query = "SELECT quantita FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $prodottoId);
        $stmt->execute();
        $stmt->bind_result($quantita);
        $stmt->fetch();
        $stmt->close();
        return $quantita;
    }
   
    public function getOrdiniNonConsegnati()
    {
        $query = "SELECT ID_ordine, data_ordine, prezzo_totale, stato_ordine, ID_utente
                  FROM ordine
                  WHERE stato_ordine <> ? AND stato_ordine <> ?";
    
        $stmt = $this->db->prepare($query);
    
        if ($stmt === false) {
            throw new Exception("Errore nella preparazione della query: " . $this->db->error);
        }
    
        $statoConsegnato = 'Consegnato';
        $statoCarrello = 'Carrello';
        $stmt->bind_param("ss", $statoConsegnato, $statoCarrello);
    
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        $ordini = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ordini[] = $row;
            }
        }
    
        $stmt->close();
    
        return $ordini;
    }
    
    public function countOrdiniInElaborazione() {
        $query = "SELECT COUNT(*) as totale_ordini FROM ordine WHERE stato_ordine = ?";
        
        $stmt = $this->db->prepare($query);
        
        if ($stmt === false) {
             throw new Exception("Errore nella preparazione della query: ".$this->db->error);
        }
        
        $stato = "In Elaborazione";
        $stmt->bind_param("s", $stato);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()){
          $totale_ordini = $row["totale_ordini"];
        }else{
         $totale_ordini = 0;
        }
        
        $stmt->close();
 
        return $totale_ordini; 
     }

    public function getPriceProduct($idprodotto)
    {
        $query = "SELECT prezzo FROM prodotto WHERE ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idprodotto);

        if (!$stmt->execute()) {
            throw new Exception("Errore nella query SELECT: " . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }
    public function getProductOnCart($currentCart)
    {
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
    public function removeFromCart($idOrdine, $idprodotto)
    {
        $query = "DELETE FROM ordini_prodotti WHERE ID_ordine = ? AND ID_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idOrdine, $idprodotto);

        if (!$stmt->execute()) {
            throw new Exception("Errore nella query DELETE: " . $stmt->error);
        }
    }
    public function checkEmptyCart($utente)
    {
        $statoCarrello = "Carrello";
        $query = "SELECT ID_ordine, prezzo_totale FROM ordine 
                  WHERE ID_utente = ? AND stato_ordine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $utente, $statoCarrello);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
   
    public function getNotificheNonLette($utente_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM notifica WHERE ID_utente = ? AND stato_notifica = 'Non letta' ORDER BY ID_notifica DESC");
        $stmt->bind_param("i", $utente_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function aggiornaStatoNotifica($notifica_id, $stato)
    {
        $stmt = $this->db->prepare("UPDATE notifica SET stato_notifica = ? WHERE ID_notifica = ?");
        $stmt->bind_param("si", $stato, $notifica_id);
        return $stmt->execute();
    }
    
    public function segnaNotificaComeLetta($notifica_id)
    {
        return $this->aggiornaStatoNotifica($notifica_id, 'Letta');
    }
    
    public function getNumeroNotificheNonLette($utente_id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM notifica WHERE ID_utente = ? AND stato_notifica = 'Non letta'");
        $stmt->bind_param("i", $utente_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    
    public function getNotification($utente)
    {
        $query = "SELECT ID_notifica, testo, stato_notifica 
                  FROM notifica WHERE ID_utente = ? 
                  ORDER BY ID_notifica";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $utente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function addNotification($testo, $utenteId, $ordineId = null)
    {
        $stato = "Non letta";
        $dataCreazione = date("Y-m-d");
        $query = "INSERT INTO notifica (testo, data_creazione, stato_notifica, ID_utente, ID_ordine) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);


        if ($ordineId === null) {
            $stmt->bind_param('sssii', $testo, $dataCreazione, $stato, $utenteId, $ordineId);
        } else {
            $stmt->bind_param('sssii', $testo, $dataCreazione, $stato, $utenteId, $ordineId);
        }

        if (!$stmt->execute()) {
            throw new Exception("Errore nell'inserimento della notifica: " . $stmt->error);
        }
    }


    
    public function deleteNotification($idnotifica)
    {
        $query = "DELETE FROM notifica WHERE ID_notifica = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idnotifica);

        if (!$stmt->execute()) {
            throw new Exception("Errore nella query DELETE: " . $stmt->error);
        }
    }
    
    public function getVenditoreId()
    {
        $query = "SELECT ID_utente FROM utente WHERE venditore = 'Y' LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['ID_utente'];
        }
        throw new Exception("Venditore non trovato.");
    }


    public function updateNotificationStatus($utente)
    {
        $letto = 1; 
        $query = "UPDATE notifica SET stato_notifica = ? WHERE ID_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $letto, $utente);
        $stmt->execute();
    }

    public function getArticles()
    {
        $query = "SELECT ID_articolo, titolo_articolo, testo_articolo, data_articolo, immagine_articolo FROM articolo ORDER BY data_articolo DESC ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getArticlesbyId($id)
    {
        $query = "SELECT ID_articolo, titolo_articolo, testo_articolo, data_articolo, immagine_articolo FROM articolo WHERE ID_articolo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
