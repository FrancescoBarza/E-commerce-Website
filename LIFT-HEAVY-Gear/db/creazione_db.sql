-- Database Section
-- ________________

CREATE DATABASE liftheavygear;
USE liftheavygear;

-- Tables Section
-- _____________

CREATE TABLE categoria (
     ID_categoria INT NOT NULL AUTO_INCREMENT,
     nome_categoria VARCHAR(100) NOT NULL,
     CONSTRAINT ID_categoria_ID PRIMARY KEY (ID_categoria)
);

CREATE TABLE notifica (
     ID_notifica INT NOT NULL AUTO_INCREMENT,
     testo VARCHAR(255) NOT NULL,
     data_creazione DATE NOT NULL,
     stato_notifica VARCHAR(100) NOT NULL,
     ID_utente INT NOT NULL,
     ID_ordine INT NULL,  -- Aggiunta della colonna per il riferimento all'ordine
     CONSTRAINT ID_notifica_ID PRIMARY KEY (ID_notifica)
);

CREATE TABLE ordine (
     ID_ordine INT NOT NULL AUTO_INCREMENT,
     data_ordine DATE NOT NULL,
     prezzo_totale FLOAT NOT NULL,
     stato_ordine VARCHAR(255) NOT NULL,
     ID_utente INT NOT NULL,
     CONSTRAINT ID_ordine_ID PRIMARY KEY (ID_ordine)
);

CREATE TABLE ordini_prodotti (
     quantita_prodotto INT NOT NULL,
     ID_ordine INT NOT NULL,
     ID_prodotto INT NOT NULL
);

CREATE TABLE prodotto (
     ID_prodotto INT NOT NULL AUTO_INCREMENT,
     nome VARCHAR(100) NOT NULL,
     descrizione MEDIUMTEXT NOT NULL,
     prezzo FLOAT NOT NULL,
     quantita INT(5) NOT NULL,
     peso FLOAT NOT NULL,
     lunghezza FLOAT NOT NULL,
     immagine VARCHAR(255) NOT NULL,
     ID_categoria INT NOT NULL,
     CONSTRAINT ID_prodotto_ID PRIMARY KEY (ID_prodotto)
);

CREATE TABLE utente (
     ID_utente INT NOT NULL AUTO_INCREMENT,
     nome VARCHAR(100) NOT NULL,
     cognome VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL,
     password VARCHAR(100) NOT NULL,
     venditore CHAR,
     CONSTRAINT ID_utente_ID PRIMARY KEY (ID_utente)
);

CREATE TABLE articolo (
     ID_articolo INT NOT NULL AUTO_INCREMENT,
     titolo_articolo VARCHAR(255) NOT NULL,
     testo_articolo MEDIUMTEXT NOT NULL,
     data_articolo DATE NOT NULL,
     immagine_articolo VARCHAR(255) NOT NULL,
     CONSTRAINT ID_articolo_ID PRIMARY KEY (ID_articolo)
);

-- Constraints Section
-- ___________________

ALTER TABLE notifica ADD CONSTRAINT REF_notif_utent_FK
     FOREIGN KEY (ID_utente)
     REFERENCES utente (ID_utente);

ALTER TABLE notifica ADD CONSTRAINT FK_notifica_ordine  -- Aggiunto il vincolo per ID_ordine
     FOREIGN KEY (ID_ordine)
     REFERENCES ordine (ID_ordine);

ALTER TABLE ordine ADD CONSTRAINT REF_ordin_utent_FK
     FOREIGN KEY (ID_utente)
     REFERENCES utente (ID_utente);

ALTER TABLE ordini_prodotti ADD CONSTRAINT REF_ordin_ordin_FK
     FOREIGN KEY (ID_ordine)
     REFERENCES ordine (ID_ordine);

ALTER TABLE ordini_prodotti ADD CONSTRAINT REF_ordin_prodo_FK
     FOREIGN KEY (ID_prodotto)
     REFERENCES prodotto (ID_prodotto);

ALTER TABLE prodotto ADD CONSTRAINT REF_prodo_categ_FK
     FOREIGN KEY (ID_categoria)
     REFERENCES categoria (ID_categoria);

-- Index Section
-- _____________

CREATE UNIQUE INDEX ID_categoria_IND
     ON categoria (ID_categoria);

CREATE UNIQUE INDEX ID_notifica_IND
     ON notifica (ID_notifica);

CREATE INDEX REF_notif_utent_IND
     ON notifica (ID_utente);

CREATE INDEX REF_notif_ordin_IND  -- Aggiunto l'indice per ID_ordine
     ON notifica (ID_ordine);

CREATE UNIQUE INDEX ID_ordine_IND
     ON ordine (ID_ordine);

CREATE INDEX REF_ordin_utent_IND
     ON ordine (ID_utente);

CREATE INDEX REF_ordin_ordin_IND
     ON ordini_prodotti (ID_ordine);

CREATE INDEX REF_ordin_prodo_IND
     ON ordini_prodotti (ID_prodotto);

CREATE UNIQUE INDEX ID_prodotto_IND
     ON prodotto (ID_prodotto);

CREATE INDEX REF_prodo_categ_IND
     ON prodotto (ID_categoria);

CREATE UNIQUE INDEX ID_utente_IND
     ON utente (ID_utente);

CREATE UNIQUE INDEX ID_articolo_IND
     ON articolo (ID_articolo);