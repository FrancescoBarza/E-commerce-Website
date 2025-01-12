-- Popolamento Tabella "categoria"
INSERT INTO categoria (ID_categoria, nome_categoria) VALUES
(1, 'Bilancieri da Competizione'),
(2, 'Bilancieri Speciali'),
(3, 'Accessori');

-- Popolamento Tabella "prodotto"
INSERT INTO prodotto (ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria) VALUES
(1, 'Eleiko Brush', 'Mantieni il tuo bilanciere pulito da gesso e sporcizia con una spazzola magnetica per bilancieri.\r\n
Grazie alla funzione magnetica, la spazzola per bilancieri può essere facilmente attaccata al tuo squat rack o a tutto ciò che è magnetico, tenendolo comodamente a portata di mano.\r\n
Spazzola la zigrinatura del tuo bilanciere con la spazzola in nylon dopo ogni utilizzo.
', 7.00, '200', 0.5, 0.3, 'brush.png', 3),
(2, 'Strength Shop Cambered Bar', 'Il bilanciere Cambered offre un\'esperienza nuova, che prende di mira i muscoli del core e migliora la stabilità, facilitando in definitiva un\'esperienza di sollevamento più confortevole ed efficiente.\r\n
Specifiche:\n
- Lunghezza totale: 2010mm,\n
- Lunghezza manicotto caricabile: 335 mm,\n
- Peso: 25kg,\n
- Cuscinetto ad aghi,\n
- Zigrinatura: Grossa,\n
- Diametro bilanciere: 35 mm.', 379.99, '50', 25, 2, 'cambered.png', 2),
(3, 'Lacertosus Magnetic Metal Collars', 'Progettati per assicurare solidamente i bumpers e i dischi al bilanciere, garantendo un\'altissima tenuta anche durante i tuoi allenamenti più pesanti.\r\n
Realizzati in alluminio aeronautico con anima in materiale polimerico di elevata qualità, il nuovo Magnetic Metal Collar è dotato di tutte le caratteristiche che lo rendono il collare migliore sul mercato.\r\n
Il sistema di serraggio a leva con sgancio rapido consente la facile installazione su tutti i bilancieri olimpici da 50 mm di diametro,\r\n
la gomma di alta qualità a contatto con il manicotto permette di bloccare con la massima precisione i dischi proteggendo al contempo la finitura del bilanciere.\r\n
L’innovativo sistema magnetico incorporato nel telaio consente di riporre i lock jaw direttamente sui pali del tuo rack per averli sempre a portata di mano.', 59.99, '300', 0.2, 0.05, 'collars.png', 3),
(4, 'Kabuki Strength Deadlift Bar', 'Un design all\'avanguardia sulla geometria per massimizzare la quantità di flessione nella barra prima che si stacchi da terra, bilanciando al contempo la frusta o l\'oscillazione della barra.\r\n
La barra Kabuki PR Deadlift dovrebbe migliorare immediatamente la potenza di trazione di chiunque, ma c\'è un periodo di apprendimento per massimizzare i risultati.\r\n
Specifiche:\n
- Tipo di barra: Barra per stacco da terra,\n
- Prodotto: Oregon, USA,\n
- Resistenza alla trazione: 190k psi,\n
- Peso: 20kg,\n
- Diametro: 27mm,\n
- Lunghezza barra: 241,94 cm,\n
- Lunghezza manica caricabile: 39,37 cm,\n
- Finitura: Black Ice (ossido nero),\n
- Zigrinatura proprietaria: zigrinatura extra aggressiva,\n
- Specifiche USPA-IPL: sì,\n
- Hardware: boccole in bronzo impregnate d\'olio.', 739.99, '40', 20, 2.42, 'deadliftbar.png', 2),
(5, 'Eleiko IPF Powerlifting Competition Bar', 'Certificato per le competizioni (IPF) e progettato per atleti professionisti e competitivi di powerlifting.\r\n
Eleiko IPF Powerlifting Competition Bar è specificamente adatto per i tre sollevamenti da competizione di powerlifting:\r\n
squat, panca piana e stacco da terra.\r\n
Il bilanciere è dotato di robuste boccole in bronzo e di una speciale aggiunta di grafite\r\n
che consente al bilanciere di autolubrificarsi, migliorando le prestazioni e la longevità e controllando la rotazione.\r\n
Si consiglia di spazzolare regolarmente il bilanciere dopo ogni utilizzo (soprattutto quando si utilizza la magnesite)\r\n
per mantenere il bilanciere al meglio il più a lungo possibile.
', 1295.00, '100', 20, 2.2, 'eleiko_comp_bar.png', 1),
(6, 'Eleiko Curl Bar', 'Sebbene sosteniamo l\'allenamento funzionale, sappiamo che anche l\'isolamento muscolare e l\'allenamento mirato hanno un ruolo importante in un programma di allenamento, e portiamo il nostro leggendario impegno per qualità, prestazioni e durata all\'Eleiko Curl Bar.\r\n
Impugnatura comoda e posizionamento delle mani, insieme a componenti di qualità che forniscono una rotazione ottimale, garantiscono un\'esperienza utente sicura e confortevole.\r\n
La forma angolata della barra supporta una varietà di posizioni delle mani per l\'allenamento di tricipiti e bicipiti.\n
La guaina leggermente scanalata impedisce ai pesi di scivolare.
', 509.00, '40', 12, 1.2, 'eleiko_ez.png', 2),
(7, 'Strength Shop IPF Calibrated Competition Collars', 'I collari da competizione di Strength Shop sono attrezzature da competizione all\'avanguardia.\r\n
Questi collari sono realizzati in acciaio massiccio con finitura cromata, pesano 2,5 kg ciascuno.\r\n
Approvato IPF e realizzato con un design funzionale e professionale che offre ampio spazio sulla barra, offrendo al contempo un sistema di fissaggio assolutamente affidabile.\r\n
Con un braccio di leva sottile e un anello di vite interno zigrinato, assicurano una facile maneggevolezza e una pressione sicura e stretta verso le piastre.\r\n
Ideale per le competizioni di powerlifting e per scopi di allenamento seri.\r\n
L\'interno del collare è progettato con un anello di metallo, che protegge il bilanciere.\r\n
Ciò impedisce di danneggiare la superficie delle maniche del bilanciere durante il fissaggio.
', 169.99, '200', 2.5, 0.094, 'ipf_collars.png', 3),
(8, 'Strength Shop Deadlift Jack', 'Il Deadlift Jack è uno strumento robusto con una larghezza totale di 1000 mm e un\'altezza di sollevamento di 250 mm,\r\n
che gli consente di gestire facilmente oltre 500 kg su un bilanciere rigido e oltre 400 kg su un bilanciere per stacco.\r\n
È progettato per funzionare con bilancieri fino a 50 mm di diametro, quindi supporta anche i bilancieri axle!\r\n
Il design solido del piede mantiene le cose stabili quando la barra è caricata e la parte anteriore arrotondata è estremamente comoda quando si accende e si spegne.\r\n
Inoltre, si smonta in quattro pezzi più piccoli, rendendolo super pratico da trasportare alla tua prossima competizione.
', 169.99, '60', 5, 1.0, 'jack.png', 3),
(9, 'Strength Shop Safety Squat Bar', 'Con Safety Squat Bar, il peso è posizionato nel centro di gravità.\r\n
Quando si usa per la prima volta, si potrebbe avere la sensazione che il peso sia un po\'nella parte anteriore, ma in realtà è da qualche parte tra uno squat posteriore e uno squat frontale, in una posizione neutra.\r\n
È ideale anche per l\'allenamento in caso di infortuni o in fase di recupero.\r\n
I sollevatori più forti incorporano questo bilanciere speciale nei loro programmi di allenamento.\r\n
Grazie al suo posizionamento, riuscirai a fare squat con la schiena più eretta e una maggiore pressione sulla catena anteriore.\r\n
Consente di spostare un peso leggermente maggiore rispetto al convenzionale.\n
Specifiche:\n
- Peso: 20,9 kg,\n
- Lunghezza: 226cm,\n
- Diametro manicotto: 50mm,\n
- Lunghezza manica caricabile: 39 cm,\n
- Angolo di campanatura (angolo tra le maniglie e i perni di caricamento della piastra): 45 gradi,\n
- Colore: nero e cromo,\n
- Materiale del cuscinetto: pelle sintetica,\n
- Carico massimo consigliato: 350 kg.
', 259.99, '25', 20.9, 2.26, 'safety.png', 2),
(10, 'Strength Shop EZ Curl Bar', 'Il nostro Riot EZ Curl Bar offre abbastanza spazio per caricare molto peso con maniche lunghe 26 cm\r\n
e una presa solida grazie a un albero del bilanciere leggermente più spesso di 28 mm.\r\n
Con un peso totale di 12 kg, il bilanciere Riot EZ Curl è adatto per l\'allenamento pesante delle braccia, sia che tu faccia curl per bicipiti o skull crusher.\r\n
Le classiche maniglie angolate consentono di cambiare posizione di presa e hanno il vantaggio che queste posizioni sono più facili per le articolazioni.\r\n
Una zigrinatura media fornisce una buona presa.\n
I manicotti hanno un diametro di 50 mm come le barre olimpiche standard.\n
Specifiche:\n
- Peso: 12kg,\n
- Lunghezza totale: 135 cm,\n
- Diametro dell\'albero: 28 mm,\n
- Diametro manicotto: 50mm,\n
- Lunghezza manica caricabile: 26 cm,\n
- Colore: asta nera manicotti cromati.
', 119.99, '100', 12, 1.35, 'strengthshop_ez.png', 2),
(11, 'Strength Shop Calibrated Bastard Power Bar', 'Acciaio inossidabile, boccole in bronzo e zigrinatura grossolana, tutti gli elementi di questa barra sono stati progettati per creare una sensazione equilibrata e raffinata.\r\n
Questo bilanciere è approvato dall\'IPF e calibrata a +/-50 gr di 20 kg.\r\n
Ottimizzato per il powerlifting.\r\n
L\'acciaio inossidabile è uno dei materiali più durevoli utilizzati nella produzione di bilancieri e fornisce un\'eccellente protezione anticorrosione e prestazioni durature con una minore manutenzione richiesta.\n
Specifiche:\n
- Approvato dall\'IPF,\n
- Calibrato a +/-50 grammi del peso dato,\n
- Materiale dell\'albero: acciaio inossidabile solido,\n
- Materiale del manicotto: acciaio nichelato,\n
- Lunghezza del gambo tra le maniche: 131,5 cm,\n
- Zigrinatura centrale: 15 cm,\n
- Lunghezza del manicotto della piastra: 40,5 cm con diametro 2",\n
- Adatto per dischi olimpici,\n
- Peso totale: 20kg,\n
- Lunghezza totale: 2,2 m,\n
- Diametro dell\'albero: 29 mm,\n
- Distanza tra gli anelli: 810 mm,\n
- Zigrinatura centrale: Sì,\n
- Tipo di zigrinatura: Grossolana,\n
- Tipo di manicotto: Boccole in bronzo,\n
- 205K PSI trazione.
 ', 479.99, '150', 20, 2.2, 'strengthshop_ipf_bastard.png', 1),
(12, 'Rogue Trap Bar', 'Completamente rivisto l\'originale Rogue Trap Bar con un design a doppia impugnatura più versatile, manicotti olimpici per tubi SCH 80 e una riduzione del peso del 25%.\r\n
La Trap Bar è prodotta negli Stati Uniti e presenta un telaio esagonale resistente saldato da tubi di acciaio quadrati.\r\n
Durante un allenamento, un atleta può facilmente passare da un set di maniglie all\'altro semplicemente capovolgendo la barra.\r\n
Ciò rende la TB-2 vantaggiosa per rafforzare il blocco, sovraccaricare le scrollate di spalle e/o limitare lo stress delle spalle.\r\n
Consente inoltre ai principianti o agli atleti in riabilitazione di concentrarsi sulla loro gamma di movimento o di sviluppare gradualmente un programma di stacco da terra senza esercitare troppa pressione sulla parte bassa della schiena.
', 457.50, '30', 27, 2.25, 'trapbar.png', 2);

-- Popolamento Tabella "utente"
INSERT INTO utente (ID_utente, nome, cognome, email, password, venditore) VALUES
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
(2, 9, 12); -- Rogue Trap Bar


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
(1,'SHEFFIELD 2024: RECORD INFRANTI E CLASSIFICA','testo' , '2024-12-01', 'article1.png'),
(2,'BILANCIERI SPECIALI: PERCHÉ OGNI PALESTRA DOVREBBE AVERLI','testo' , '2025-01-07', 'article2.png' ),
(3,'BILANCIERE LIBERO E METODO CONIUGATO', 'testo' , '2025-01-16', 'article3.png'),
(4,'DALLA SVEZIA AL MONDO: LA STORIA DEL BILANCIERE DA COMPETIZIONE ELEIKO', 'testo', '2024-12-14', 'article4.png'),
(5,'FIPL: NUOVA ATTREZZATURA DA COMPETIZIONE PER IL POWERLIFTING ITALIANO', 'testo', '2024-12-19', 'article5.png' );