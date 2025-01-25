<section class="info-ordine">
    <h1>INFO ORDINE</h1>
        <ul>
            <li>
                <h2>Numero Ordine: <?php echo $templateParams["ordine"]["ID_ordine"]; ?></h2>
            </li>
            <li>Data: <?php echo date("d/m/Y", strtotime($templateParams["ordine"]["data_ordine"])); ?></li>
            <li>Stato: <?php echo $templateParams["ordine"]["stato_ordine"]; ?></li>
            <li>Totale: <strong><?php echo $templateParams["ordine"]["prezzo_totale"]; ?>€ </strong></li>
            <li>Prodotti ordinati:</li>
        </ul>
        <ul>
            <?php if (count($templateParams["prodotti"]) > 0) : ?>
                <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                    <div class="prodotto">
                        <a href="prodotto.php?id=<?php echo $prodotto["ID_prodotto"]; ?>">
                            <?php if (!empty($prodotto["immagine"])) : ?>
                                <img src="<?php echo UPLOAD_DIR_UPLOADS . $prodotto["immagine"]; ?>" alt="<?php echo $prodotto["nome_prodotto"]; ?>" />
                            <?php endif; ?>
                            <h2><?php echo $prodotto["nome_prodotto"]; ?></h2>
                            <p>Prezzo unitario: <?php echo $prodotto["prezzo"]; ?>€</p>
                            <p>Quantità: <?php echo $prodotto["quantita"]; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <li>Nessun prodotto in questo ordine.</li>
            <?php endif; ?>
        </ul>
        <h2><span class="fas fa-route"></span> Spedizione</h2>
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
    <?php if ($userData['venditore'] == 'Y') : ?>
        <button type="button" onclick="window.location.href='ordiniEvasi.php'">Torna agli ordini</button>
    <?php else : ?>
        <button type="button" onclick="window.location.href='ordiniPassati.php'">Torna agli ordini</button>
    <?php endif; ?>
    </section>