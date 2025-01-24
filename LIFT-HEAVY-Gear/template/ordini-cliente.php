<section>
    <h1>ORDINI PASSATI</h1>
    <!-- Ordini -->
    <?php if (count($templateParams["ordini"]) > 0) : ?>
        <?php foreach ($templateParams["ordini"] as $ordine) : ?>
            <div class="ordine">
                <div>
                    <span class="fas fa-clipboard-list"></span>
                </div>
                <h3>Numero ordine: <?php echo $ordine["ID_ordine"]; ?></h3>
                <p>Data ordine: <?php echo date("d/m/Y", strtotime($ordine["data_ordine"])); ?></p>
                <p>Stato: <?php echo $ordine["stato_ordine"]; ?></p>
                <button type="button" onclick="window.location.href='infoOrdine.php?id=<?php echo $ordine["ID_ordine"]; ?>' "><span class="fas fa-info-circle"> </span> Info ordine</button>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Non hai ancora effettuato ordini.</p>
    <?php endif; ?>
    <button type="button" class="tornaAreaCliente" onclick="tornaAreaUtente()">Torna alla tua area utente</button>
            <script>
                function tornaAreaUtente() {

                    window.location.href = 'areaCliente.php';
                }
            </script>
</section>