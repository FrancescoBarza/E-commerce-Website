<section>
<?php foreach($templateParams["articolo"] as $articolo):?>
    <h1><?php echo $articolo["titolo_articolo"]; ?></p></h1>
    <img src="<?php echo UPLOAD_DIR_ARTICLES.$articolo["immagine_articolo"] ?>" alt="<?php echo $articolo["titolo_articolo"]; ?>">
    <p><?php echo $articolo["data_articolo"]; ?></p>
    <p><?php echo $articolo["testo_articolo"]; ?></p><br />
    <?php endforeach; ?>
</section>