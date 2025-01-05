-- Popolamento Tabella "categoria"
INSERT INTO categoria (ID_categoria, nome_categoria) VALUES
(1, 'Bilancieri da Competizione'),
(2, 'Bilancieri Speciali'),
(3, 'Accessori');

-- Popolamento Tabella "prodotto"
INSERT INTO prodotto (ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria) VALUES
(1, 'Eleiko Brush', 'Mantieni il tuo bilanciere pulito da gesso e sporcizia con una spazzola magnetica per bilancieri. Grazie alla funzione magnetica, la spazzola per bilancieri può essere facilmente attaccata al tuo squat rack o a tutto ciò che è magnetico, tenendolo comodamente a portata di mano. Spazzola la zigrinatura del tuo bilanciere con la spazzola in nylon dopo ogni utilizzo.', 7.00, '200', 0.5, 0.3, 'brush.png', 3),
(2, 'Strength Shop Cambered Bar', 'Bilanciere curvo ideale per powerlifting', 199.99, '50', 25, 2, 'cambered.png', 2),
(3, 'Lacertosus Magnetic Metal Collars', 'Collari per bilanciere per garantire la sicurezza durante lallenamento', 59.99, '300', 0.2, 0.05, 'collars.png', 3),
(4, 'Kabuki Strength Deadlift Bar', 'Bilanciere specifico per stacco da terra', 739.99, '40', 20, 2.42, 'deadliftbar.png', 2),
(5, 'Eleiko IPF Powerlifting Competition Bar', 'Certificato per le competizioni (IPF) e progettato per atleti professionisti e competitivi di powerlifting. Eleiko IPF Powerlifting Competition Bar è specificamente adatto per i tre sollevamenti da competizione di powerlifting: squat, panca piana e stacco da terra. Il bilanciere è dotato di robuste boccole in bronzo e di una speciale aggiunta di grafite che consente al bilanciere di autolubrificarsi, migliorando le prestazioni e la longevità e controllando la rotazione. Si consiglia di spazzolare regolarmente il bilanciere dopo ogni utilizzo (soprattutto quando si utilizza la magnesite) per mantenere il bilanciere al meglio il più a lungo possibile.', 1295.00, '10', 20, 2.2, 'eleiko-comp-bar.png', 1),
(6, 'Eleiko Curl Bar', 'Sebbene sosteniamo l'allenamento funzionale, sappiamo che anche l'isolamento muscolare e l'allenamento mirato hanno un ruolo importante in un programma di allenamento e portiamo il nostro leggendario impegno per qualità, prestazioni e durata all'Eleiko Curl Bar. Impugnatura comoda e posizionamento delle mani insieme a componenti di qualità che forniscono una rotazione ottimale garantiscono un'esperienza utente sicura e confortevole. La forma angolata della barra supporta una varietà di posizioni delle mani per l'allenamento di tricipiti e bicipiti. La guaina leggermente scanalata impedisce ai pesi di scivolare.', 509.00, '15', 12, 1.2, 'eleiko-ez.png', 2),
(7, 'Strength Shop IPF Calibrated Competition Collars', 'Collari certificati IPF per bilancieri da competizione', 169.99, '20', 2.5, 0.094, 'ipf-collars.png', 3),
(8, 'Strength Shop Deadlift Jack', 'Strumento per sollevare il bilanciere durante il carico dei dischi', 169.99, '50', 5, 1.0, 'jack.png', 3),
(9, 'Strength Shop Safety Squat Bar', 'Bilanciere di sicurezza per squat', 259.99, '25', 20.9, 2.26, 'safety.png', 2),
(10, 'Strength Shop EZ Curl Bar', 'Bilanciere EZ economico ma di alta qualità', 119.99, '60', 12, 1.35, 'strength-shop-ez.png', 2),
(11, 'Strength Shop Calibrated Bastard Power Bar', 'Bilanciere da competizione di alta qualità', 479.99, '10', 20, 2.2, 'strength-shop-ipf-bastard.png', 1),
(12, 'Rogue Trap Bar', 'Bilanciere esagonale per stacchi e squat', 457.50, '30', 27, 2.25, 'trap.png', 2);

-- Popolamento Tabella "utente"
INSERT INTO utente (ID_utente, nome, cognome, email, Password, venditore) VALUES
(1, 'Mario', 'Rossi', 'mario.rossi@example.com', 'password1', 'Y'),
(2, 'Luca', 'Bianchi', 'luca.bianchi@example.com', 'password2', 'N'),
(3, 'Sofia', 'Verdi', 'sofia.verdi@example.com', 'password3', 'N'),
(4, 'Paolo', 'Viola', 'paolo.viola@example.com', 'password4', 'Y'),
(5, 'Davide', 'Neri', 'davide.neri@example.com', 'password5', 'N'),
(6, 'Francesco', 'Liverani', 'francesco.liverani@example.com', 'password6', 'N'),
(7, 'Piero', 'Gentile', 'piero.gentile@example.com', 'password7', 'Y');


-- Popolamento Tabella "ordine"
INSERT INTO ordine (ID_ordine, data_ordine, prezzo_totale, stato_ordine, ID_utente) VALUES
(1, '2024-12-01', 729.98, 'Spedito', 2),
(2, '2024-12-05', 369.98, 'Consegnato', 5),
(3, '2024-12-12', 519.00, 'Carrello', 1),
(4, '2024-12-23', 1119.95, 'Pronto per il ritiro', 7),
(5, '2024-12-04', 1599.99, 'Consegnato', 3),
(6, '2024-12-05', 0.00, 'Carrello', 6), -- Nessun prodotto
(7, '2024-12-07', 1039.94, 'In Elaborazione', 1),
(8, '2024-12-16', 909.98, 'Spedito', 4),
(9, '2024-12-15', 974.99, 'Pronto per il ritiro', 2);

-- Popolamento Tabella "ordini_prodotti" (aggiunta di nuovi dati)
INSERT INTO ordini_prodotti (quantita_prodotto, ID_ordine, ID_prodotto) VALUES
-- Ordine 1
(2, 1, 2), -- Strength Shop Cambered Bar
(1, 1, 4), -- Kabuki Strength Deadlift Bar

-- Ordine 3
(2, 3, 1), -- Eleiko Brush
(1, 3, 6), -- Eleiko Curl Bar

-- Ordine 4
(3, 4, 9), -- Strength Shop Safety Squat Bar
(2, 4, 7), -- Strength Shop IPF Calibrated Competition Collars

-- Ordine 5
(1, 5, 5), -- Eleiko IPF Powerlifting Competition Bar
(1, 5, 11), -- Strength Shop Calibrated Bastard Power Bar

-- Ordine 7
(4, 7, 2), -- Strength Shop Cambered Bar
(2, 7, 10), -- Strength Shop EZ Curl Bar

-- Ordine 8
(1, 8, 8), -- Strength Shop Deadlift Jack
(1, 8, 4), -- Kabuki Strength Deadlift Bar

-- Ordine 9
(1, 9, 3), -- Lacertosus Magnetic Metal Collars
(2, 9, 12), -- Rogue Trap Bar


-- Popolamento Tabella "notifica" (aggiunta di nuovi dati)
INSERT INTO notifica (ID_notifica, testo, data_creazione, stato_notifica, ID_utente) VALUES
(1, 'Il tuo ordine è pronto per il ritiro', '2024-12-23', 'Non letta', 7),
(2, 'Il tuo ordine è stato consegnato', '2024-12-02', 'Letta', 3),
(3, 'Il tuo ordine è in elaborazione', '2024-12-08', 'Letta', 1),
(4, 'Il tuo ordine è stato spedito', '2024-12-17', 'Non letta', 2),
(5, 'Il tuo ordine è pronto per il ritiro', '2024-12-25', 'Non letta', 4),
(6, 'Il tuo ordine è stato consegnato', '2024-12-03', 'Letta', 5),
(7, 'Il tuo ordine è in elaborazione', '2024-12-09', 'Letta', 1),
(8, 'Il tuo ordine è stato spedito', '2024-12-21', 'Non letta', 2);

-- Popolamento Tabella "articolo"
INSERT INTO articolo (ID_articolo, titolo_articolo, testo_articolo, data_articolo, immagine_articolo) VALUES 
(1,'SHEFFIELD 2024: RECORD INFRANTI E CLASSIFICA', , '2024-12-01', 'article1.png'),
(2,'BILANCIERI SPECIALI: PERCHÉ OGNI PALESTRA DOVREBBE AVERLI', , '2025-01-07', 'article2.png' ),
(3,'BILANCIERE LIBERO E METODO CONIUGATO', , '2025-01-16', 'article3.png'),
(4,'DALLA SVEZIA AL MONDO: LA STORIA DEL BILANCIERE DA COMPETIZIONE ELEIKO', , '2024-12-14', 'article4.png'),
(5,'FIPL: NUOVA ATTREZZATURA DA COMPETIZIONE PER IL POWERLIFTING ITALIANO', , '2024-12-19', 'article5.png' );