<section>
    <div class="info">
        <?php foreach ($templateParams["prodotto"] as $prodotto): ?>
            <img src="<?php echo UPLOAD_DIR_UPLOADS . $prodotto["immagine"]; ?>" alt="" />
            <h2><?php echo $prodotto["nome"]; ?></h2>
            <p><?php echo $prodotto["prezzo"]; ?> €</p><br>
            <h3>Descrizione:</h3>
            <p><?php echo $prodotto["descrizione"]; ?></p>
            
            <?php if (!isset($_SESSION["venditore"]) || $_SESSION["venditore"] !== 'Y'): ?>
               
                <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idprodotto" value="<?php echo $prodotto["ID_prodotto"]; ?>">
                    <input type="hidden" name="action" value="7">
                    <input type="hidden" name="quantita" value="1"> <!-- Quantità di default -->
                    <button type="submit"><span class="fas fa-cart-plus"></span> Aggiungi al carrello</button>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
