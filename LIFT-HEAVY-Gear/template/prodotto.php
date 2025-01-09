<section>
            <div class="info">
                <?php foreach($templateParams["prodotto"] as $prodotto):?>
                <img src="<?php echo UPLOAD_DIR_UPLOADS.$prodotto["immagine"] ?>" alt="" />
                <h2><?php echo $prodotto["nome"] ?></h2>
                <p><?php echo $prodotto["prezzo"] ?> €</p><br>
                <label for="quantita">Quantit&agrave;:</label>
                <input type="number" id="quantita" name="quantita" min="1" max="<?php $prodotto["quantita"]; ?>" value="1" />
                <br>
                <h3>Descrizione:</h3>
                <p><?php echo $prodotto["descrizione"] ?></p>
                <button type="button"><span class="fas fa-cart-plus"></span> </button>
                <?php endforeach; ?>
            </div>
        </section>