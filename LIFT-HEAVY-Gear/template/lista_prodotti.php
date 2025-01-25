<div class="slider">
    <button class="prev" onclick="prevImage()">❮</button>
    <div class="image-container">
        <img src="images/uploads/home_sheffield.png" alt="Palco Sheffield 2024" class="active">
        <img src="images/uploads/home_sheffield2025.png" alt="Sheffield 2025">
        <img src="images/uploads/home_deadlift.png" alt="Stacco da terra">
    </div>
    <button class="next" onclick="nextImage()">❯</button>
</div>
<section>
    <h1><?php echo $templateParams["titolo-main"]; ?></h1>
    <?php foreach ($templateParams["lista-prodotti"] as $prodotto): ?>
        <div class="prodotto">
            <a href="prodotto.php?id=<?php echo $prodotto["ID_prodotto"]; ?>">
                <img src="<?php echo UPLOAD_DIR_UPLOADS . $prodotto["immagine"]; ?>" alt="<?php echo $prodotto["nome"]; ?>" />
                <h2><?php echo $prodotto["nome"]; ?></h2>
                <p><?php echo $prodotto["prezzo"]; ?> €</p>
            </a>
            <p>
            <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idprodotto" value="<?php echo $prodotto["ID_prodotto"]; ?>">
                <input type="hidden" name="action" value="7">
                <input type="hidden" name="quantita" value="1"> <!-- Quantità di default -->
                <button type="submit"><span class="fas fa-cart-plus"></span></button>
            </form>
            </p>

        </div>
    <?php endforeach; ?>
</section>