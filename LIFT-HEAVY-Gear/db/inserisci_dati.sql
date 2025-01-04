-- Popolamento Tabella "categoria"
INSERT INTO categoria (ID_categoria, nome_categoria) VALUES
(1, 'Bilancieri da Competizione'),
(2, 'Bilancieri Speciali'),
(3, 'Accessori');

-- Popolamento Tabella "prodotto"
INSERT INTO prodotto (ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria) VALUES
(1, 'Eleiko Brush', 'Spazzola per mantenere i bilancieri puliti e senza ruggine', 5.00, '200', 0.5, 0.3, 'brush.png', 3),
(2, 'Strength Shop Cambered Bar', 'Bilanciere curvo ideale per powerlifting', 199.99, '50', 25, 2, 'cambered.png', 2),
(3, 'Lacertosus Magnetic Metal Collars', 'Collari per bilanciere per garantire la sicurezza durante l\'allenamento', 59.99, '300', 0.2, 0.05, 'collars.png', 3),
(4, 'Kabuki Strength Deadlift Bar', 'Bilanciere specifico per stacco da terra', 739.99, '40', 20, 2.42, 'deadliftbar.png', 2),
(5, 'Eleiko IPF Powerlifting Competition Bar', 'Bilanciere da competizione certificato IPF', 1120, '10', 20, 2.2, 'eleiko-comp-bar.png', 1),
(6, 'Eleiko Curl Bar', 'Bilanciere EZ per allenamenti di curl', 509.00, '15',12, 1.2, 'eleiko-ez.png', 2),
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
(3, '2024-12-12', 929.98, 'Carrello', 1),
(4, '2024-12-23', 369.98, 'Pronto per il ritiro', 7),
(5, '2024-12-04', 459.98, 'Consegnato', 3),
(6, '2024-12-05', 369.00, 'Carrello', 6),
(7, '2024-12-07', 920.98, 'In Elaborazione', 1),
(8, '2024-12-16', 1029.98, 'Spedito', 4),
(9, '2024-12-15', 269.98, 'Pronto per il ritiro', 2);

-- Popolamento Tabella "ordini_prodotti" (aggiunta di nuovi dati)
INSERT INTO ordini_prodotti (quantita_prodotto, ID_ordine, ID_prodotto) VALUES
(2, 3, 1), -- Eleiko Brush nell'ordine 3
(1, 3, 6), -- Eleiko Curl Bar nell'ordine 3
(3, 4, 9), -- Strength Shop Safety Squat Bar nell'ordine 4
(2, 4, 7), -- Strength Shop IPF Calibrated Competition Collars nell'ordine 4
(1, 5, 5), -- Eleiko IPF Powerlifting Competition Bar nell'ordine 5
(1, 5, 11), -- Strength Shop Calibrated Bastard Power Bar nell'ordine 5
(4, 7, 2), -- Strength Shop Cambered Bar nell'ordine 7
(2, 7, 10), -- Strength Shop EZ Curl Bar nell'ordine 7
(1, 8, 8), -- Strength Shop Deadlift Jack nell'ordine 8
(1, 8, 4), -- Kabuki Strength Deadlift Bar nell'ordine 8
(1, 9, 3), -- Lacertosus Magnetic Metal Collars nell'ordine 9
(2, 9, 12); -- Rogue Trap Bar nell'ordine 9


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