<?php
$titolareError = isset($_SESSION["titolareError"]) ? $_SESSION["titolareError"] : "";
$capError = isset($_SESSION["capError"]) ? $_SESSION["capError"] : "";
$cartaError = isset($_SESSION["cartaError"]) ? $_SESSION["cartaError"] : "";
$cvvError = isset($_SESSION["cvvError"]) ? $_SESSION["cvvError"] : "";
$annoError = isset($_SESSION["annoError"]) ? $_SESSION["annoError"] : "";

// Recupera i dati dell'ordine dalla sessione se presenti
$indirizzoValue = isset($_SESSION["ordine_data"]["indirizzo"]) ? $_SESSION["ordine_data"]["indirizzo"] : "";
$cittaValue = isset($_SESSION["ordine_data"]["citta"]) ? $_SESSION["ordine_data"]["citta"] : "";
$capValue = isset($_SESSION["ordine_data"]["cap"]) ? $_SESSION["ordine_data"]["cap"] : "";

// Cancella gli errori dalla sessione dopo averli recuperati
unset($_SESSION["titolareError"]);
unset($_SESSION["capError"]);
unset($_SESSION["cartaError"]);
unset($_SESSION["cvvError"]);
unset($_SESSION["annoError"]);
unset($_SESSION["ordine_data"]);

?>
<div class="cart-main">
  <main>
    <section>
      <h1><?php echo $templateParams["titolo"]; ?></h1>
      <!-- Modalita vuoto-->
      <?php if (count($currentCart) == 0 || number_format($currentCart[0]["prezzo_totale"], 2) == 0) { ?>
        <section class="empty-cart">
          <div>
            <h2>Il tuo carrello è vuoto</h2>
            <p>Aggiungi degli elementi e procedi al pagamento</p>
          </div>
        </section>
      <?php } else { ?>
        <!-- Modalita con elementi-->
        <div class="table-div">
          <div>
            <table>
              <thead>
                <tr>
                  <th id="img"></th>
                  <th id="articolo">Articolo</th>
                  <th id="prezzo">Prezzo</th>
                  <th id="quantita">Quantità</th>
                  <th id="button"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($templateParams["prodottoCarrello"] as $prodotto): ?>
                  <tr>
                    <td headers="img">
                      <a><img src="<?php echo UPLOAD_DIR_UPLOADS . $prodotto["immagine"]; ?>" alt="Immagine <?php echo $prodotto["nome"]; ?>" /></a>
                    </td>
                    <td headers="articolo">
                      <a href="prodotto.php?id=<?php echo $prodotto["ID_prodotto"]; ?>"><?php echo $prodotto["nome"]; ?></a>
                    </td>
                    <td headers="prezzo">
                      <p><?php echo number_format($prodotto["prezzo"], 2); ?> €</p>
                    </td>
                    <td headers="quantita">
                      <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idprodotto" value="<?php echo $prodotto["ID_prodotto"]; ?>" />
                        <input type="hidden" name="action" value="10" />
                        <input type="hidden" name="quantita" value="1" />
                        <button type="submit"><span class="fas fa-plus"></span></button>
                      </form>
                      <p> <?php echo $prodotto["quantita_prodotto"]; ?></p>
                      <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idprodotto" value="<?php echo $prodotto["ID_prodotto"]; ?>" />
                        <input type="hidden" name="action" value="10" />
                        <input type="hidden" name="quantita" value="-1" />
                        <button type="submit"><span class="fas fa-minus"></span></button>
                      </form>
                    </td>
                    <td headers="button">
                      <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idprodotto" value="<?php echo $prodotto["ID_prodotto"]; ?>" />
                        <input type="hidden" name="action" value="9" />
                        <button type="submit"><span class="fas fa-trash"></span></button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="container">
            <h2>Riepilogo ordine <span class="prezzo"><span class="fa fa-shopping-cart"></span> <?php echo count($templateParams["prodottoCarrello"]); ?></span></h2>
            <?php foreach ($templateParams["prodottoCarrello"] as $prodotto): ?>
              <p><a href="#"><?php echo $prodotto["nome"]; ?></a> <span class="prezzo"><?php echo number_format($prodotto["prezzo"] * $prodotto["quantita_prodotto"], 2); ?> €</span></p>
            <?php endforeach; ?>
            <hr>
            <p>Totale <span class="prezzo"><strong><?php echo number_format($currentCart[0]["prezzo_totale"], 2); ?> € </strong></span></p>
          </div>
        </div>
        <?php
        if (isset($_SESSION["errore_carrello"])) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
          echo '<em class="fas fa-exclamation-triangle"></em> ';
          echo $_SESSION["errore_carrello"];
          echo '</div></br>';
        
          unset($_SESSION["errore_carrello"]);
        }
        ?>
        <!-- Inserisci i dati -->
        <div class="row">
          <div class="col-75">
            <div class="container">
              <form method="POST" action="processa-form-carrello.php" enctype="multipart/form-data">
                <input type="hidden" name="action" value="12" />
                <input type="hidden" name="ID_ordine" value="<?php echo $currentCart[0]["ID_ordine"]; ?>" />
                <div class="row">
                  <div class="col-50">
                    <h3>Indirizzo di fatturazione: </h3>
                    <label for="indirizzo"><span class="fa fa-address-card-o"></span> Indirizzo</label>
                    <input type="text" id="indirizzo" name="address" placeholder="Via dell'Università, 50" value="<?php echo $indirizzoValue; ?>" required>
                    <label for="citta"><span class="fa fa-institution"></span> Città</label>
                    <input type="text" id="citta" name="citta" placeholder="Cesena" value="<?php echo $cittaValue; ?>" required>
                    <div class="row">
                      <div class="col-50">
                        <label for="cap">Cap</label>
                        <input type="text" id="cap" name="cap" placeholder="47125" value="<?php echo $capValue; ?>" required>
                        <span class="error">
                          <?php
                          if ($capError != "") {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            echo '<em class="fas fa-exclamation-triangle"></em> ';
                            echo $capError;
                            echo '</div></br>';
                          }
                          ?>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-50">
                    <h3>Metodo di Pagamento</h3>
                    <label for="titolare">Titolare carta</label>
                    <input type="text" id="titolare" name="titolare" placeholder="Mario Rossi" required>
                    <span class="error">
                      <?php
                      if (($titolareError != "")) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        echo '<em class="fas fa-exclamation-triangle"></em> ';
                        echo $titolareError;
                        echo '</div></br>';
                      }
                      ?>
                    </span>
                    <label for="numero">Numero carta</label>
                    <input type="text" id="numero" name="numero" placeholder="1111222233334444" required>
                    <span class="error"> <?php
                                          if ($cartaError != "") {
                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                            echo '<em class="fas fa-exclamation-triangle"></em> ';
                                            echo $cartaError;
                                            echo '</div></br>';
                                          }
                                          ?>
                    </span>
                    <label for="scadenzam">Mese di scadenza</label>
                    <input type="text" id="scadenzam" name="scadenzam" placeholder="Settembre" required>
                    <div class="row">
                      <div class="col-50">
                        <label for="scadenzaa">Anno di scadenza</label>
                        <input type="text" id="scadenzaa" name="scadenzaa" placeholder="2026" required>
                        <span class="error"> <?php
                                              if (($annoError != "")) {
                                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                                echo '<em class="fas fa-exclamation-triangle"></em> ';
                                                echo $annoError;
                                                echo '</div></br>';
                                              }
                                              ?>
                        </span>
                      </div>
                      <div class="col-50">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" required>
                        <span class="error"> <?php
                                              if (($cvvError != "")) {
                                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                                echo '<em class="fas fa-exclamation-triangle"></em> ';
                                                echo $cvvError;
                                                echo '</div></br>';
                                              }
                                              ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Procedi all'acquisto</button>
              </form>
            </div>
          </div>
    </section>
  </main>
</div>
<?php } ?>