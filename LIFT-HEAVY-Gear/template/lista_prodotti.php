<div class="slider">
            <button class="prev" onclick="prevImage()">❮</button>
            <div class="image-container">
                <img src="images/uploads/home_sheffield.png" alt="Immagine 1" class="active">
                <img src="images/uploads/home_sheffield2025.png" alt="Immagine 2">
                <img src="images/uploads/home_deadlift.png" alt="Immagine 3">
            </div>
            <button class="next" onclick="nextImage()">❯</button>
        </div>
<section>
            <h1>I NOSTRI PRODOTTI</h1>
            <?php foreach($templateParams["lista-prodotti"] as $prodotto ): ?>
            <div class="prodotto">
                <a href="singolo-prodotto.php?id=<?php echo $prodotto["ID_prodotto"];?>">
                    <img src="<?php echo UPLOAD_DIR_UPLOADS.$prodotto["immagine"]; ?>" alt="Immagine prodotto" />
                    <h3><?php echo $prodotto["nome"]; ?></h3>
                    <p><?php echo $prodotto["prezzo"]; ?> €</p>
                </a>
                <p>
                    <button type="button"><span class="fas fa-cart-plus"></span></button>
                </p>
            </div>
            <?php endforeach; ?>
        </section>