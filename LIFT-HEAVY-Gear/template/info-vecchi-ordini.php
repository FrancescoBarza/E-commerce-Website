<main>
    <h1>INFO ORDINE</h1>
    <section class="info-ordine">
        <ul>
            <li>
                <h3>Numero Ordine: <?php echo $templateParams["ordine"]["ID_ordine"]; ?></h3>
            </li>
            <li>Data: <?php echo date("d/m/Y", strtotime($templateParams["ordine"]["data_ordine"])); ?></li>
            <li>Stato: <?php echo $templateParams["ordine"]["stato_ordine"]; ?></li>
            <li>Totale: <?php echo $templateParams["ordine"]["prezzo_totale"]; ?></li>
            <li>Prodotti ordinati:</li>
        </ul>
        <ul>
            <?php if (count($templateParams["prodotti"]) > 0) : ?>
                <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                    <li>
                        <?php if (!empty($prodotto["immagine"])) : ?>
                            <img src="<?php echo UPLOAD_DIR_UPLOADS . $prodotto["immagine"]; ?>" alt="<?php echo $prodotto["nome_prodotto"]; ?>" style="max-width: 150px; max-height: 150px;  float: left;">
                        <?php endif; ?><br>
                        <?php echo $prodotto["nome_prodotto"]; ?> (Quantità: <?php echo $prodotto["quantita"]; ?>) - Prezzo unitario: <?php echo $prodotto["prezzo"]; ?>€<div style="clear: both;"></div>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <li>Nessun prodotto in questo ordine.</li>
            <?php endif; ?>
        </ul>
        <h3><span class="fas fa-route"></span> Spedizione</h3>
        <div class="stato">
            <?php
            switch ($templateParams["ordine"]["stato_ordine"]) {
                case 'In Elaborazione':
                    echo '<span class="fas fa-hourglass-half"></span><p>In attesa di elaborazione</p>';
                    break;
                case 'Spedito':
                    echo '<span class="fas fa-truck"></span><p>Spedito</p>';
                    break;
                case 'Pronto per il ritiro':
                    echo '<span class="fas fa-check-circle"></span><p>Pronto per il ritiro</p>';
                    break;
                case 'Consegnato':
                    echo '<span class="fas fa-check-double"></span><p>Consegnato</p>';
                    break;
                default:
                    echo '<span class="fas fa-question-circle"></span><p>Stato non definito</p>';
                    break;
            }
            ?>
        </div>
    </section>
    <button type="button" onclick="window.location.href='ordiniPassati.php'">Torna agli ordini</button>
</main>