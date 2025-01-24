<section>
<?php if (isset($templateParams["ordine"]) && is_array($templateParams["ordine"])): ?>
    <h1>ORDINE CONFERMATO!</h1>
    <p>Il tuo ordine è stato confermato con successo, grazie per averci scelto.</p>
    <h2>Numero d'ordine: #<?php echo isset($templateParams["ordine"]["ID_ordine"]) ? htmlspecialchars($templateParams["ordine"]["ID_ordine"]) : "Non disponibile"; ?></h2>
    <h3>Riepilogo dell'ordine:</h3>
    <?php if (isset($templateParams["prodotti_ordine"]) && !empty($templateParams["prodotti_ordine"])): ?>
        <ul>
            <?php
            $totaleOrdine = 0;
            foreach ($templateParams["prodotti_ordine"] as $prodotto):
                $subtotale = $prodotto["prezzo"] * $prodotto["quantita"];
                $totaleOrdine += $subtotale;
            ?>
                <li>
                    <?php echo htmlspecialchars($prodotto["nome_prodotto"]); ?>: <?php echo htmlspecialchars($prodotto["quantita"]); ?> x €<?php echo number_format($prodotto["prezzo"], 2); ?> = €<?php echo number_format($subtotale, 2); ?>
                </li>
            <?php endforeach; ?>
            <li><strong>Totale: €<?php echo number_format($totaleOrdine, 2); ?></strong></li>
        </ul>
    <?php else: ?>
        <p>Non ci sono prodotti in questo ordine.</p>
    <?php endif; ?>
    
        <h3>Indirizzo di fatturazione: </h3>
        <address>
            <ul>
                <li>Indirizzo: <?php echo isset($templateParams["ordine"]["indirizzo"]) ? htmlspecialchars($templateParams["ordine"]["indirizzo"]) : "Non disponibile"; ?></li>
                <li>Città: <?php echo isset($templateParams["ordine"]["citta"]) ? htmlspecialchars($templateParams["ordine"]["citta"]) : "Non disponibile"; ?></li>
                <li>Cap: <?php echo isset($templateParams["ordine"]["cap"]) ? htmlspecialchars($templateParams["ordine"]["cap"]) : "Non disponibile"; ?></li>
            </ul>
        </address>
    </section>
<?php else: ?>
    <p>Errore: Dettagli dell'ordine non trovati.</p>
<?php endif; ?>