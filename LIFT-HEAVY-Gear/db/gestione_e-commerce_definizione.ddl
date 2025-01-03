-- Database Section
-- ________________ 

CREATE DATABASE liftheavy;
USE liftheavy;

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
     CONSTRAINT ID_notifica_ID PRIMARY KEY (ID_notifica)
);

CREATE TABLE ordine (
     ID_ordine INT NOT NULL AUTO_INCREMENT,
     data_ordine DATE NOT NULL,
     prezzo_totale FLOAT(100) NOT NULL,
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
     descrizione VARCHAR(255) NOT NULL,
     prezzo FLOAT(100) NOT NULL,
     quantita INT(5) NOT NULL,
     peso FLOAT(255) NOT NULL,
     lunghezza FLOAT(255) NOT NULL,
     immagine VARCHAR(255) NOT NULL,
     ID_categoria INT NOT NULL,
     CONSTRAINT ID_prodotto_ID PRIMARY KEY (ID_prodotto)
);

CREATE TABLE utente (
     ID_utente INT NOT NULL AUTO_INCREMENT,
     nome VARCHAR(100) NOT NULL,
     cognome VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL,
     Password VARCHAR(100) NOT NULL,
     venditore CHAR,
     CONSTRAINT ID_utente_ID PRIMARY KEY (ID_utente)
);

-- Constraints Section
-- ___________________ 

ALTER TABLE notifica ADD CONSTRAINT REF_notif_utent_FK
     FOREIGN KEY (ID_utente)
     REFERENCES utente (ID_utente);

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
