-- Popolamento Tabella "categoria"
INSERT INTO categoria (ID_categoria, nome_categoria) VALUES
(1, 'Bilancieri da Competizione'),
(2, 'Bilancieri Speciali'),
(3, 'Accessori');

-- Popolamento Tabella "prodotto"
INSERT INTO prodotto (ID_prodotto, nome, descrizione, prezzo, quantita, peso, lunghezza, immagine, ID_categoria) VALUES
(1, 'Eleiko Brush', 'Mantieni il tuo bilanciere pulito da gesso e sporcizia con una spazzola magnetica per bilancieri.\r<br>
Grazie alla funzione magnetica, la spazzola per bilancieri può essere facilmente attaccata al tuo squat rack o a tutto ciò che è magnetico, tenendolo comodamente a portata di mano.\r<br>
Spazzola la zigrinatura del tuo bilanciere con la spazzola in nylon dopo ogni utilizzo.
', 6.99, '200', 0.5, 0.3, 'brush.png', 3),
(2, 'Strength Shop Cambered Bar', 'Il bilanciere Cambered offre un\'esperienza nuova, che prende di mira i muscoli del core e migliora la stabilità, facilitando in definitiva un\'esperienza di sollevamento più confortevole ed efficiente.\r<br>
Specifiche:<br>
- Lunghezza totale: 2010mm,<br>
- Lunghezza manicotto caricabile: 335 mm,<br>
- Peso: 25kg,<br>
- Cuscinetto ad aghi,<br>
- Zigrinatura: Grossa,<br>
- Diametro bilanciere: 35 mm.', 379.99, '50', 25, 2, 'cambered.png', 2),
(3, 'Lacertosus Magnetic Metal Collars', 'Progettati per assicurare solidamente i bumpers e i dischi al bilanciere, garantendo un\'altissima tenuta anche durante i tuoi allenamenti più pesanti.\r<br>
Realizzati in alluminio aeronautico con anima in materiale polimerico di elevata qualità, il nuovo Magnetic Metal Collar è dotato di tutte le caratteristiche che lo rendono il collare migliore sul mercato.\r<br>
Il sistema di serraggio a leva con sgancio rapido consente la facile installazione su tutti i bilancieri olimpici da 50 mm di diametro,\r<br>
la gomma di alta qualità a contatto con il manicotto permette di bloccare con la massima precisione i dischi proteggendo al contempo la finitura del bilanciere.\r<br>
L’innovativo sistema magnetico incorporato nel telaio consente di riporre i lock jaw direttamente sui pali del tuo rack per averli sempre a portata di mano.', 59.99, '300', 0.2, 0.05, 'collars.png', 3),
(4, 'Kabuki Strength Deadlift Bar', 'Un design all\'avanguardia sulla geometria per massimizzare la quantità di flessione nella barra prima che si stacchi da terra, bilanciando al contempo la frusta o l\'oscillazione della barra.\r<br>
La barra Kabuki PR Deadlift dovrebbe migliorare immediatamente la potenza di trazione di chiunque, ma c\'è un periodo di apprendimento per massimizzare i risultati.\r<br>
Specifiche:<br>
- Tipo di barra: Barra per stacco da terra,<br>
- Prodotto: Oregon, USA,<br>
- Resistenza alla trazione: 190k psi,<br>
- Peso: 20kg,<br>
- Diametro: 27mm,<br>
- Lunghezza barra: 241,94 cm,<br>
- Lunghezza manica caricabile: 39,37 cm,<br>
- Finitura: Black Ice (ossido nero),<br>
- Zigrinatura proprietaria: zigrinatura extra aggressiva,<br>
- Specifiche USPA-IPL: sì,<br>
- Hardware: boccole in bronzo impregnate d\'olio.', 739.99, '40', 20, 2.42, 'deadliftbar.png', 2),
(5, 'Eleiko IPF Powerlifting Competition Bar', 'Certificato per le competizioni (IPF) e progettato per atleti professionisti e competitivi di powerlifting.\r<br>
Eleiko IPF Powerlifting Competition Bar è specificamente adatto per i tre sollevamenti da competizione di powerlifting:\r<br>
squat, panca piana e stacco da terra.\r<br>
Il bilanciere è dotato di robuste boccole in bronzo e di una speciale aggiunta di grafite\r<br>
che consente al bilanciere di autolubrificarsi, migliorando le prestazioni e la longevità e controllando la rotazione.\r<br>
Si consiglia di spazzolare regolarmente il bilanciere dopo ogni utilizzo (soprattutto quando si utilizza la magnesite)\r<br>
per mantenere il bilanciere al meglio il più a lungo possibile.
', 1295.00, '100', 20, 2.2, 'eleiko_comp_bar.png', 1),
(6, 'Eleiko Curl Bar', 'Sebbene sosteniamo l\'allenamento funzionale, sappiamo che anche l\'isolamento muscolare e l\'allenamento mirato hanno un ruolo importante in un programma di allenamento, e portiamo il nostro leggendario impegno per qualità, prestazioni e durata all\'Eleiko Curl Bar.\r<br>
Impugnatura comoda e posizionamento delle mani, insieme a componenti di qualità che forniscono una rotazione ottimale, garantiscono un\'esperienza utente sicura e confortevole.\r<br>
La forma angolata della barra supporta una varietà di posizioni delle mani per l\'allenamento di tricipiti e bicipiti.<br>
La guaina leggermente scanalata impedisce ai pesi di scivolare.
', 509.00, '40', 12, 1.2, 'eleiko_ez.png', 2),
(7, 'Strength Shop IPF Calibrated Competition Collars', 'I collari da competizione di Strength Shop sono attrezzature da competizione all\'avanguardia.\r<br>
Questi collari sono realizzati in acciaio massiccio con finitura cromata, pesano 2,5 kg ciascuno.\r<br>
Approvato IPF e realizzato con un design funzionale e professionale che offre ampio spazio sulla barra, offrendo al contempo un sistema di fissaggio assolutamente affidabile.\r<br>
Con un braccio di leva sottile e un anello di vite interno zigrinato, assicurano una facile maneggevolezza e una pressione sicura e stretta verso le piastre.\r<br>
Ideale per le competizioni di powerlifting e per scopi di allenamento seri.\r<br>
L\'interno del collare è progettato con un anello di metallo, che protegge il bilanciere.\r<br>
Ciò impedisce di danneggiare la superficie delle maniche del bilanciere durante il fissaggio.
', 169.99, '200', 2.5, 0.094, 'ipf_collars.png', 3),
(8, 'Strength Shop Deadlift Jack', 'Il Deadlift Jack è uno strumento robusto con una larghezza totale di 1000 mm e un\'altezza di sollevamento di 250 mm,\r<br>
che gli consente di gestire facilmente oltre 500 kg su un bilanciere rigido e oltre 400 kg su un bilanciere per stacco.\r<br>
È progettato per funzionare con bilancieri fino a 50 mm di diametro, quindi supporta anche i bilancieri axle!\r<br>
Il design solido del piede mantiene le cose stabili quando la barra è caricata e la parte anteriore arrotondata è estremamente comoda quando si accende e si spegne.\r<br>
Inoltre, si smonta in quattro pezzi più piccoli, rendendolo super pratico da trasportare alla tua prossima competizione.
', 169.99, '60', 5, 1.0, 'jack.png', 3),
(9, 'Strength Shop Safety Squat Bar', 'Con Safety Squat Bar, il peso è posizionato nel centro di gravità.\r<br>
Quando si usa per la prima volta, si potrebbe avere la sensazione che il peso sia un po\'nella parte anteriore, ma in realtà è da qualche parte tra uno squat posteriore e uno squat frontale, in una posizione neutra.\r<br>
È ideale anche per l\'allenamento in caso di infortuni o in fase di recupero.\r<br>
I sollevatori più forti incorporano questo bilanciere speciale nei loro programmi di allenamento.\r<br>
Grazie al suo posizionamento, riuscirai a fare squat con la schiena più eretta e una maggiore pressione sulla catena anteriore.\r<br>
Consente di spostare un peso leggermente maggiore rispetto al convenzionale.<br>
Specifiche:<br>
- Peso: 20,9 kg,<br>
- Lunghezza: 226cm,<br>
- Diametro manicotto: 50mm,<br>
- Lunghezza manica caricabile: 39 cm,<br>
- Angolo di campanatura (angolo tra le maniglie e i perni di caricamento della piastra): 45 gradi,<br>
- Colore: nero e cromo,<br>
- Materiale del cuscinetto: pelle sintetica,<br>
- Carico massimo consigliato: 350 kg.
', 259.99, '25', 20.9, 2.26, 'safety.png', 2),
(10, 'Strength Shop EZ Curl Bar', 'Il nostro Riot EZ Curl Bar offre abbastanza spazio per caricare molto peso con maniche lunghe 26 cm\r<br>
e una presa solida grazie a un albero del bilanciere leggermente più spesso di 28 mm.\r<br>
Con un peso totale di 12 kg, il bilanciere Riot EZ Curl è adatto per l\'allenamento pesante delle braccia, sia che tu faccia curl per bicipiti o skull crusher.\r<br>
Le classiche maniglie angolate consentono di cambiare posizione di presa e hanno il vantaggio che queste posizioni sono più facili per le articolazioni.\r<br>
Una zigrinatura media fornisce una buona presa.<br>
I manicotti hanno un diametro di 50 mm come le barre olimpiche standard.<br>
Specifiche:<br>
- Peso: 12kg,<br>
- Lunghezza totale: 135 cm,<br>
- Diametro dell\'albero: 28 mm,<br>
- Diametro manicotto: 50mm,<br>
- Lunghezza manica caricabile: 26 cm,<br>
- Colore: asta nera manicotti cromati.
', 119.99, '100', 12, 1.35, 'strengthshop_ez.png', 2),
(11, 'Strength Shop Calibrated Bastard Power Bar', 'Acciaio inossidabile, boccole in bronzo e zigrinatura grossolana, tutti gli elementi di questa barra sono stati progettati per creare una sensazione equilibrata e raffinata.\r<br>
Questo bilanciere è approvato dall\'IPF e calibrata a +/-50 gr di 20 kg.\r<br>
Ottimizzato per il powerlifting.\r<br>
L\'acciaio inossidabile è uno dei materiali più durevoli utilizzati nella produzione di bilancieri e fornisce un\'eccellente protezione anticorrosione e prestazioni durature con una minore manutenzione richiesta.<br>
Specifiche:<br>
- Approvato dall\'IPF,<br>
- Calibrato a +/-50 grammi del peso dato,<br>
- Materiale dell\'albero: acciaio inossidabile solido,<br>
- Materiale del manicotto: acciaio nichelato,<br>
- Lunghezza del gambo tra le maniche: 131,5 cm,<br>
- Zigrinatura centrale: 15 cm,<br>
- Lunghezza del manicotto della piastra: 40,5 cm con diametro 2",<br>
- Adatto per dischi olimpici,<br>
- Peso totale: 20kg,<br>
- Lunghezza totale: 2,2 m,<br>
- Diametro dell\'albero: 29 mm,<br>
- Distanza tra gli anelli: 810 mm,<br>
- Zigrinatura centrale: Sì,<br>
- Tipo di zigrinatura: Grossolana,<br>
- Tipo di manicotto: Boccole in bronzo,<br>
- 205K PSI trazione.
 ', 479.99, '150', 20, 2.2, 'strengthshop_ipf_bastard.png', 1),
(12, 'Rogue Trap Bar', 'Completamente rivisto l\'originale Rogue Trap Bar con un design a doppia impugnatura più versatile, manicotti olimpici per tubi SCH 80 e una riduzione del peso del 25%.\r<br>
La Trap Bar è prodotta negli Stati Uniti e presenta un telaio esagonale resistente saldato da tubi di acciaio quadrati.\r<br>
Durante un allenamento, un atleta può facilmente passare da un set di maniglie all\'altro semplicemente capovolgendo la barra.\r<br>
Ciò rende la TB-2 vantaggiosa per rafforzare il blocco, sovraccaricare le scrollate di spalle e/o limitare lo stress delle spalle.\r<br>
Consente inoltre ai principianti o agli atleti in riabilitazione di concentrarsi sulla loro gamma di movimento o di sviluppare gradualmente un programma di stacco da terra senza esercitare troppa pressione sulla parte bassa della schiena.
', 457.50, '30', 27, 2.25, 'trapbar.png', 2);

-- Popolamento Tabella "utente"
INSERT INTO utente (ID_utente, nome, cognome, email, password, venditore) VALUES
(1, 'Mario', 'Rossi', 'mario.rossi@example.com', 'P@ssw0rd111!', 'Y'),
(2, 'Luca', 'Bianchi', 'luca.bianchi@example.com', 'P@ssw0rd112!', 'N'),
(3, 'Sofia', 'Verdi', 'sofia.verdi@example.com', 'P@ssw0rd113!', 'N'),
(4, 'Davide', 'Neri', 'davide.neri@example.com', 'P@ssw0rd114!', 'N'),
(5, 'Francesco', 'Liverani', 'francesco.liverani@example.com', 'password6', 'N');

-- Popolamento Tabella "articolo"
INSERT INTO articolo (ID_articolo, titolo_articolo, testo_articolo, data_articolo, immagine_articolo) VALUES 
(1,'SHEFFIELD 2024: RECORD INFRANTI E CLASSIFICA','La Sheffield Powerlifting Championship 2024, tenutasi il 10 febbraio 2024 presso la City Hall di Sheffield, ha rappresentato un evento di spicco nel panorama del powerlifting internazionale. Organizzata da SBD, la competizione ha visto la partecipazione di 24 atleti d\'élite, 12 uomini e 12 donne, provenienti da diverse categorie di peso, impegnati in una sfida unica focalizzata sull\'infrangere i record mondiali della International Powerlifting Federation (IPF). 
Risultati Femminili:<br>
Nella competizione femminile, le atlete della categoria 69 kg hanno dominato il podio, grazie a un record mondiale totale relativamente più basso rispetto ad altre categorie, facilitando il superamento dei precedenti primati.<br>
Agata Sitko (69 kg): Totale di 600 kg, pari al 109,3% del precedente record mondiale.<br>
Prescillia Bavoil (69 kg): Totale di 585 kg, 106,6%.<br>
Carola Garra (69 kg): Totale di 582,5 kg, 106,1%.<br>
Un momento saliente è stato l\'incredibile prestazione di Sonita Muluh, che ha stabilito un nuovo record mondiale di squat femminile sollevando 300,5 kg.<br>
Risultati Maschili:<br>
Tra gli uomini, la categoria 93 kg ha offerto una competizione serrata.<br>
Gustav Hedlund (93 kg): Totale di 895 kg, 100,8% del precedente record mondiale.<br>
Jonathan Cayco (93 kg): Totale di 890,5 kg, 100,6%.<br>
Delaney Wallace (83 kg): Totale di 842,5 kg, 100,2%.<br>
Degna di nota è stata la performance di Jesus Olivares, che ha stabilito un nuovo record mondiale di squat nella categoria supermassimi (+120 kg) con un sollevamento di 478 kg, superando il precedente record di Ray Williams.<br> 
Record Infranti:<br>
La competizione ha registrato un totale impressionante di 51 record mondiali infranti, evidenziando l\'altissimo livello degli atleti partecipanti e l\'importanza dell\'evento nel calendario del powerlifting internazionale.<br>
Bilanciere Utilizzato:<br>
Per quanto riguarda l\'attrezzatura, in competizioni di questo calibro, si utilizzano bilancieri omologati dall\'IPF, progettati per sostenere carichi elevati e garantire standard di sicurezza e performance adeguati. Questi bilancieri hanno specifiche precise, tra cui un diametro di 29 mm e una lunghezza di 2,2 metri, con una capacità di carico che può superare i 600 kg.<br>
In particolare, il bilanciere utilizzato nella Sheffield Powerlifting Championship 2024, come in molte altre competizioni di powerlifting di alto livello, è prodotto da Eleiko, uno dei marchi più rinomati al mondo per l\'attrezzatura da sollevamento pesi e powerlifting.<br>' , '2024-12-01', 'article1.png'),
(2,'BILANCIERI SPECIALI: PERCHÉ OGNI PALESTRA DOVREBBE AVERLI','Nel powerlifting, l\'utilizzo di bilancieri speciali come la trap bar, la safety squat bar (SSB), la cambered bar e la EZ curl bar è fondamentale per migliorare le prestazioni, prevenire infortuni e sviluppare una forza equilibrata.
Questi strumenti offrono variazioni agli esercizi tradizionali, permettendo di affrontare punti deboli specifici, ridurre lo stress articolare e introdurre nuovi stimoli nell\'allenamento.

<br>
1. Trap Bar
La trap bar, o bilanciere esagonale, è utilizzata principalmente per il deadlift e varianti di squat.

Benefici:

Riduzione dello stress lombare: la posizione centrale del corpo all\'interno della barra consente un baricentro più naturale, diminuendo la tensione sulla colonna vertebrale.
Maggiore coinvolgimento delle gambe: rispetto al deadlift tradizionale, la trap bar distribuisce il carico in modo più equilibrato tra gambe e schiena.
Sicurezza: ideale per atleti con limitazioni di mobilità o che desiderano evitare sollecitazioni eccessive sulla colonna.
Applicazioni:

Sviluppo della forza esplosiva, utile per migliorare lo stacco da terra.
Adatta per il condizionamento generale e l\’allenamento di principianti o atleti in fase di riabilitazione.
<br>
2. Safety Squat Bar (SSB)
La SSB è un bilanciere dotato di cuscinetti e maniglie anteriori, progettato per facilitare lo squat mantenendo una postura più eretta.

Benefici:

Riduzione dello stress sulle spalle: le maniglie anteriori evitano il sovraccarico articolare delle spalle, comune negli squat tradizionali.
Miglioramento della postura: aiuta a mantenere una posizione eretta, risultando utile per atleti con debolezza nella parte alta della schiena o limitazioni di mobilità.
Rafforzamento della catena posteriore: l\'angolo del carico sollecita maggiormente glutei, femorali e parte bassa della schiena.
Applicazioni:

Sviluppo della forza specifica per lo squat tradizionale.
Ideale per il recupero da infortuni alle spalle o alla schiena.
<br>
3. Cambered Bar
La cambered bar presenta una struttura a U che sposta il baricentro più in basso rispetto a un bilanciere standard.

Benefici:

Miglioramento della stabilità: il peso oscillante costringe l\'atleta a mantenere una posizione più stabile, rafforzando il core e i muscoli stabilizzatori.
Riduzione del carico sulla parte superiore della schiena: spostando il peso in basso, si allevia la pressione su collo e spalle.
Applicazioni:

Allenamento avanzato per squat e good mornings.
Utile per atleti che desiderano sviluppare una forza di base solida e migliorare il controllo neuromuscolare.
<br>
4. EZ Curl Bar
La EZ curl bar è comunemente utilizzata per esercizi di isolamento, come curl per i bicipiti e skull crushers per i tricipiti.

Benefici:

Riduzione dello stress sui polsi: la curvatura del bilanciere offre una presa più naturale e confortevole.
Isolamento muscolare: consente di lavorare specificamente su bicipiti e tricipiti in modo efficace.
Varietà: la possibilità di cambiare l\'angolo di presa permette di stimolare i muscoli da diverse angolazioni.
Applicazioni:

Costruzione della forza accessoria per migliorare il lockout nella panca piana e la stabilità negli stacchi.
Allenamento di supporto per rafforzare i muscoli delle braccia e prevenire squilibri.
<br>
Conclusione
L\'uso di bilancieri speciali, secondo Louie Simmons, rappresenta una strategia indispensabile per il successo nel powerlifting.
Oltre a offrire variazioni essenziali per superare i plateau, contribuiscono a prevenire infortuni, sviluppare forza accessoria e rafforzare i punti deboli.

Atleti di ogni livello possono trarre enormi benefici dall\'integrazione di questi strumenti nei loro programmi, seguendo l\'esempio di una delle menti più innovative nella storia del powerlifting.' , '2025-01-07', 'article2.png' ),
(3,'WEST SIDE E METODO CONIUGATO', 'L\'Influenza di Louie Simmons
Louie Simmons, fondatore della Westside Barbell e figura leggendaria nel mondo del powerlifting, ha enfatizzato l\'importanza dell\'utilizzo di bilancieri speciali nell\'allenamento.
Attraverso il suo Metodo Coniugato, Simmons ha integrato l\'uso di questi strumenti per sviluppare forza massimale, velocità e resistenza, sottolineando come la variazione degli esercizi sia cruciale per evitare il plateau e stimolare continuamente l\'adattamento muscolare.

<br>
Approccio di Simmons:

Variazione continua: l\'introduzione di bilancieri speciali permette di modificare gli schemi di movimento, prevenendo l\'adattamento eccessivo e promuovendo progressi costanti.
Sviluppo della forza speciale: strumenti come la cambered bar o la SSB sono utilizzati per rafforzare specifici gruppi muscolari e migliorare parti del movimento che possono rappresentare punti deboli.
Prevenzione degli infortuni: l\'uso di bilancieri come la SSB riduce lo stress su articolazioni vulnerabili, permettendo un allenamento intenso con minori rischi.
<br>
Simmons ha anche sviluppato attrezzature innovative, come la reverse hyper-extension e la belt squat machine, per affrontare specifiche esigenze di allenamento e riabilitazione.
Ha dimostrato l\'importanza di attrezzature e bilancieri specializzati nel miglioramento delle prestazioni dei powerlifter.

Louie Simmons ha costantemente sostenuto che strumenti come la cambered bar, la safety squat bar e la trap bar sono fondamentali per costruire una base di forza completa e preparare gli atleti a eccellere nei tre movimenti principali del powerlifting: squat, panca e stacco.

<br>
L\'Importanza di Bilancieri Speciali nel Metodo Westside
Louie Simmons ha integrato bilancieri speciali nel suo approccio con finalità specifiche:

<br>
Trap Bar:

Usata per sviluppare la forza esplosiva e la capacità di spingere con le gambe, elemento cruciale per lo stacco da terra.
La neutralità della presa è particolarmente utile per atleti con debolezza nella presa o difficoltà con il bilanciere tradizionale.
<br>
Safety Squat Bar (SSB):

Fondamentale per rafforzare la parte superiore della schiena, un punto critico per lo squat pesante e la tenuta posturale sotto carico.
Simmons ha spesso evidenziato come l\SSB migliori la resilienza complessiva, poiché il design spinge il corpo in avanti, obbligando i muscoli stabilizzatori a lavorare più intensamente.
<br>
Cambered Bar:

Simmons la utilizzava per sviluppare il core e migliorare la stabilità sotto carichi pesanti, un elemento cruciale per i movimenti multi-articolari.
Ha sottolineato come il peso oscillante creato dalla cambered bar simuli situazioni di instabilità che si possono incontrare in competizione.
<br>
EZ Curl Bar:

Pur non essendo direttamente collegata ai movimenti principali, è un\’ottima scelta per allenare braccia e avambracci, che giocano un ruolo fondamentale nella stabilità durante la panca piana e la forza di presa nello stacco.
<br>
Prevenzione e Riabilitazione
Louie Simmons ha anche promosso l\'uso di bilancieri speciali per la prevenzione degli infortuni e il recupero.
L\'uso strategico di attrezzature come la safety squat bar e la reverse hyper-extension è stato un elemento cardine della filosofia di Westside Barbell per:

Ridurre lo stress su articolazioni e legamenti.
Rafforzare i muscoli stabilizzatori, spesso trascurati negli esercizi tradizionali.
Facilitare il ritorno all\'allenamento intenso senza compromettere la salute a lungo termine.
<br>
Un Approccio Dinamico
Simmons credeva fermamente che la monotonia nell\'allenamento fosse il nemico della progressione.
Cambiare frequentemente gli strumenti, l\’intensità e i movimenti consente al corpo di adattarsi a nuovi stimoli, migliorando costantemente forza, potenza e resistenza.', '2025-01-16', 'article3.png'),
(4,'DALLA SVEZIA AL MONDO: LA STORIA DEL BILANCIERE DA COMPETIZIONE ELEIKO', 'L\'Eleiko IPF Powerlifting Competition Bar
L\'Eleiko IPF Powerlifting Competition Bar è il risultato di decenni di innovazione e dedizione all\'eccellenza nel sollevamento pesi.
Fondata nel 1957, Eleiko ha iniziato come produttore di piccoli elettrodomestici da cucina, come le piastre per waffle.
Tuttavia, un\'idea ispirata ha cambiato per sempre la direzione dell\'azienda, portandola a diventare un leader nella produzione di bilancieri di alta qualità.

<br>
Nel corso degli anni, Eleiko ha perfezionato la progettazione e la produzione dei suoi bilancieri, utilizzando acciaio svedese proprietario noto per la sua resistenza e flessibilità.
Questo impegno ha portato alla creazione di bilancieri che hanno visto oltre 1.000 record mondiali stabiliti con il loro utilizzo.

<br>
L\'IPF Powerlifting Competition Bar è stato progettato specificamente per le tre discipline del powerlifting: squat, panca piana e stacco da terra.
Con un diametro di 29 mm, offre una rigidità ottimale per sollevamenti pesanti.
La zigrinatura aggressiva e non rivestita garantisce una presa sicura, mentre i robusti boccole in bronzo con aggiunta di grafite permettono un\'auto-lubrificazione che migliora le prestazioni e la longevità del bilanciere.

<br>
Questo bilanciere è certificato dalla International Powerlifting Federation (IPF) per l\'uso in competizione, riflettendo l\'impegno di Eleiko nel soddisfare gli standard più elevati nello sport del powerlifting.
La combinazione di materiali di alta qualità, design meticoloso e una lunga storia di eccellenza rende l\'Eleiko IPF Powerlifting Competition Bar una scelta privilegiata per gli atleti di élite in tutto il mondo.', '2024-12-14', 'article4.png');