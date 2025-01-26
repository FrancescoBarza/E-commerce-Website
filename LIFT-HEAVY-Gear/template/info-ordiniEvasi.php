<section>
    <h1>ORDINI DA EVADERE</h1>
    <!-- Ordini -->
    <?php if (count($templateParams["ordini"]) > 0): ?>
        <?php foreach ($templateParams["ordini"] as $ordine): ?>
            <div class="ordine">
                <div>
                    <span class="fas fa-clipboard-list"></span>
                </div>
                <h2>Numero ordine: <?php echo $ordine["ID_ordine"]; ?></h2>
                <p>Data ordine: <?php echo $ordine["data_ordine"]; ?></p>
                <p> Stato ordine attuale <strong><?php echo $ordine["stato_ordine"]; ?> </strong></p>
                        <form method="POST" action="ordiniEvasi.php">
                            <input type="hidden" name="ordine_id" value="<?php echo $ordine["ID_ordine"]; ?>">
                            <p class="editable" data-key="Stato">
                                <label for="stato_select_<?php echo $ordine["ID_ordine"]; ?>">modifica lo stato in:</label>

                                <select name="stato" id="stato_select_<?php echo $ordine["ID_ordine"]; ?>">
                                    <option value="In Elaborazione" <?php if ($ordine["stato_ordine"] == "In Elaborazione") echo "selected"; ?>>In Elaborazione</option>
                                    <option value="Spedito" <?php if ($ordine["stato_ordine"] == "Spedito") echo "selected"; ?>>Spedito</option>
                                    <option value="Pronto per il ritiro" <?php if ($ordine["stato_ordine"] == "Pronto per il ritiro") echo "selected"; ?>>Pronto per il ritiro</option>
                                    <option value="Consegnato" <?php if ($ordine["stato_ordine"] == "Consegnato") echo "selected"; ?>>Consegnato</option>
                                </select>
                            </p>

                            <button type="submit" class="modificaOrdine">Modifica stato</button>
                            <button type="button" onclick="window.location.href='infoOrdine.php?id=<?php echo $ordine["ID_ordine"]; ?>'"><span class="fas fa-info-circle"></span> Info ordine</button>
                        </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Non ci sono ordini da evadere.</p>
    <?php endif; ?>
    <?php if ($userData['venditore'] == 'Y') : ?>
        <button type="button" onclick="window.location.href='areaVenditore.php'">Torna alla tua area utente</button>
    <?php else : ?>
        <button type="button" onclick="window.location.href='areaCliente.php'">Torna alla tua area utente</button>
    <?php endif; ?>
</section>