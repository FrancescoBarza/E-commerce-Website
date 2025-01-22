<section>
            <h1><?php echo htmlspecialchars($templateParams["titolo-main"]); ?></h1>
            <!-- Prodotti -->
            <?php foreach ($templateParams["lista-prodotti"] as $prodotto): ?>
        <div class="prodotto">
            <a href="prodotto.php?id=<?php echo $prodotto["ID_prodotto"]; ?>">
                <img src="<?php echo UPLOAD_DIR_UPLOADS . $prodotto["immagine"]; ?>" alt="<?php echo $prodotto["nome"]; ?>" />
                <h3><?php echo $prodotto["nome"]; ?></h3>
                <p><?php echo $prodotto["prezzo"]; ?> €</p>
                <p>Quantità: <?php echo $prodotto["quantita"]; ?></p>
                <p class="rifornisci"><span>Rifornisci</span></p>
            </a>
            <form action="processa-rifornimento.php" method="POST">
                <input type="hidden" name="id_prodotto" value="<?php echo $prodotto["ID_prodotto"]; ?>" />
                <input type="number" name="quantita" min="1" value="1" />
                <button type="submit">Invio</button>
            </form>     
        </div>
    <?php endforeach; ?>

            <button class="add-button" type="button"
                onclick="document.getElementById('aggiunta').style.display='block'">Aggiungi un nuovo prodotto</button>
            <div id="aggiunta" class="modal">
                <span onclick="document.getElementById('aggiunta').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
                <form class="modal-content" action="processa-aggiunta-prodotto.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <h1>AGGIUNGI PRODOTTO</h1>
                        <p>Completa i seguenti campi per aggiungere un nuovo prodotto.</p><br />
                        <label for="categoria"><b>Categoria: </b></label>
                        <select name="categoria" id="categoria" required>
                            <option value="" disabled selected>Seleziona una categoria</option>
                            <option value=1>Bilanciere da competizione</option>
                            <option value=2>Bilanciere speciale</option>
                            <option value=3>Accessorio</option>
                        </select>
                        <br /><br />
                        <label for="nome"><b>Nome</b></label>
                        <input type="text" placeholder="Inserisci Nome Prodotto" name="nome" id="nome" required>

                        <label for="prezzo"><b>Prezzo</b></label>
                        <input type="number" placeholder="Inserisci Prezzo" name="prezzo" id="prezzo" required>

                        <label for="prezzo"><b>Peso</b></label>
                        <input type="number" placeholder="Inserisci Peso" name="peso" id="peso" required>

                        <label for="prezzo"><b>Lunghezza</b></label>
                        <input type="number" placeholder="Inserisci Lunghezza" name="lunghezza" id="lunghezza" required>

                        <label for="immagine"><b>Immagine prodotto:</b></label>
                        <input type="file" name="immagine" id="immagine" accept="image/*" required />

                        <label for="descrizione"><b>Descrizione:</b></label>
                        <textarea class="form-control" name="descrizione" id="descrizione" required></textarea>
                        <br /><br />

                        <label for="quantita">Quantità; disponibile in magazzino: </label>
                        <input type="number" id="quantita" name="quantita" min="1" value="1" required />

                        <button type="submit">Aggiungi</button>
                    </div>
                </form>
            </div>
        </section>