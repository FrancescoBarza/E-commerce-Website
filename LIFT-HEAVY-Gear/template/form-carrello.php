<?php
$titolareError = $capError = $cartaError = $cvvError = $annoError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["titolare"])) {
    $titolareError = "Formato nome non corretto";
  }
  if (!filter_var($_POST["cap"], FILTER_VALIDATE_INT) || strlen($_POST["cap"])!=5) {
    $capError = "Il CAP deve essere composto da cinque numeri";
  }
  if (!preg_match("/^[0-9]*$/",$_POST["numero"]) || strlen($_POST["numero"])!=16) {
    $cartaError = "Il numero della carta deve essere composto da sedici numeri";
  }
  if (!filter_var($_POST["cvv"], FILTER_VALIDATE_INT) || strlen($_POST["cvv"])!=3) {
    $cvvError = "Il CVV deve essere composto da tre numeri";
  }
  if (!filter_var($_POST["scadenzaa"], FILTER_VALIDATE_INT) || strlen($_POST["scadenzaa"])!=4 || $_POST["scadenzaa"]<date("Y")) {
    $annoError = "Formato anno errato";
  }
  if($titolareError=="" && $capError =="" && $capError =="" && $cartaError =="" && $cvvError =="" && $annoError==""){
    $_SESSION["procediAlPagamento"]=1;
  }
}
?>
<h1><span class="fas fa-shopping-cart"></span> <?php echo $templateParams["titolo"]; ?></h1>
    <!-- Modalita vuoto-->
    <?php if(count($currentCart) == 0 || number_format($currentCart[0]["TotalePrezzo"],2) == 0) { ?>
        <section class="empty-cart">
            <span class="fas fa-cart-arrow-down"></span> 
            <div>
                <h4>Il tuo carrello è vuoto</h4>
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
                    <th id="img"></th><th id="articolo">Articolo</th><th id="prezzo">Prezzo</th><th id="quantita">Quantit&agrave;</th><th id="button"></th>
                  </tr>
              </thead>
              <tbody>
                <?php foreach($templateParams["prodottoCarrello"] as $prodotto): ?>
                  <tr>
                      <td headers="img">
                        <a><img src="<?php echo UPLOAD_DIR_UPLOADS.$prodotto["immagine"]; ?>" alt="Immagine <?php echo $prodotto["nome"];?>"/></a>
                      </td>
                      <td headers="articolo">
                        <a href="prodotto.php?id=<?php echo $prodotto["ID_prodotto"];?>"><?php echo $prodotto["nome"];?></a>
                      </td>
                      <td headers="prezzo">
                        <p><?php echo number_format($prodotto["prezzo"],2);?> €</p>
                      </td>
                      <td headers="quantita">
                        <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="ID_prodotto" value="<?php echo $prodotto["ID_prodotto"];?>" />
                          <input type="hidden" name="action" value="10" />
                          <input type="hidden" name="quantita" value="1" />
                          <button type="submit"><span class="fas fa-plus"></span></button>
                        </form>
                        <p> <?php echo $prodotto["quantita_prodotto"];?></p>
                        <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="ID_prodotto" value="<?php echo $prodotto["ID_prodotto"];?>" />
                          <input type="hidden" name="action" value="10" />
                          <input type="hidden" name="quantita" value="-1" />
                          <button type="submit"><span class="fas fa-minus"></span></button>
                        </form>
                      </td>
                      <td headers="button">
                        <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="ID_prodotto" value="<?php echo $prodotto["ID_prodotto"];?>" />
                          <input type="hidden" name="action" value="6" />
                          <button type="submit"><span class="fas fa-heart"></span></button>
                        </form>
                        <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="ID_prodotto" value="<?php echo $prodotto["ID_prodotto"]; ?>" />
                          <input type="hidden" name="action" value="9" />
                          <button type="submit"><span class="fas fa-trash"></span></button>   
                        </form>
                      </td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
            <div class="container">
              <h4>Riepilogo ordine <span class="prezzo" style="color:black"><span class="fa fa-shopping-cart"></span> <?php echo count($templateParams["prodottoCarrello"]); ?></span></h4>
              <?php foreach($templateParams["prodottoCarrello"] as $prodotto): ?>
              <p><a href="#"><?php echo $prodotto["nome"];?></a> <span class="prezzo"><?php echo number_format($prodotto["PrezzoProdotto"]* $prodotto["QuantitaPr"],2);?> €</span></p>
              <?php endforeach;?>
              <hr>
              <h4>Totale <span class="prezzo" style="color:black"><?php echo number_format($currentCart[0]["TotalePrezzo"],2); ?> €</span></h4>
            </div>
        </div>
        
        <!-- Inserisci i dati -->
        <div class="row">
            <div class="col-75">
              <div class="container">
              <?php if(!isset($_SESSION["procediAlPagamento"])) {?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div class="row">
                    <div class="col-50">
                      <h3>Indirizzo di fatturazione: </h3>
                      <label for="indirizzo"><span class="fa fa-address-card-o"></span> Indirizzo</label>
                      <input type="text" id="indirizzo" name="address" placeholder="Via dell'Università, 50" required>
                      <label for="citta"><span class="fa fa-institution"></span> Citt&agrave;</label>
                      <input type="text" id="citta" name="citta" placeholder="Cesena" required>
          
                      <div class="row">
                        <div class="col-50">
                          <label for="cap">Cap</label>
                          <input type="text" id="cap" name="cap" placeholder="47125" required>
                          <span class="error"> <?php echo $capError;?></span>
                        </div>
                      </div>
                    </div>
          
                    <div class="col-50">
                      <h3>Metodo di Pagamento</h3>
                      <label>Carte valide</label>
                      <div class="icon-container">
                        <span class="fab fa-cc-visa" style="color:navy;"></span>
                        <span class="fab fa-cc-amex" style="color:blue;"></span>
                        <span class="fab fa-cc-mastercard" style="color:red;"></span>
                      </div>
                      <label for="titolare">Titolare carta</label>
                      <input type="text" id="titolare" name="titolare" placeholder="Mario Rossi" required>
                      <span class="error"> <?php echo $titolareError;?></span>
                      <label for="numero">Numero carta</label>
                      <input type="text" id="numero" name="numero" placeholder="1111-2222-3333-4444" required>
                      <span class="error"> <?php echo $cartaError;?></span>
                      <label for="scadenzam">Mese di scadenza</label>
                      <input type="text" id="scadenzam" name="scadenzam" placeholder="Settembre" required>
                      <div class="row">
                        <div class="col-50">
                          <label for="scadenzaa">Anno di scadenza</label>
                          <input type="text" id="scadenzaa" name="scadenzaa" placeholder="2022" required>
                          <span class="error"> <?php echo $annoError;?></span>
                        </div>
                        <div class="col-50">
                          <label for="cvv">CVV</label>
                          <input type="text" id="cvv" name="cvv" placeholder="123" required>
                          <span class="error"> <?php echo $cvvError;?></span>
                        </div>
                      </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-success">Verifica dati</button>
              
              </form>
            <?php } else {?>
            <section>
              <h3>Dati verificati</h3>
            </section>
            <form action="processa-form-carrello.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="ID_ordine" value="<?php echo $currentCart[0]["ID_ordine"];?>" />
                <input type="hidden" name="action" value="11"/>
                <!-- Procedi al pagamento -->
                  <button id="procedi" type="button" onclick="document.getElementById('pagamento').style.display='block'" class="btn">Procedi all'acquisto</button>

                <!-- The Modal (Contiene Pagamento avvenuto) -->
                <div id="pagamento" class="modal-pay">
                  <div class="container-pay" >
                    <h1>Pagamento avvenuto con successo</h1>                  
                    <div>
                      <button type="submit" class="btn btn-success">Continua</button>
                    </div>
                  </div>
                  <script> 
                    // Get the modal
                    var modal = document.getElementById('pagamento');
                  </script>
                </div>
            </form> 
            <?php } unset($_SESSION["procediAlPagamento"]);?>
            </div>
        </div>     
    </div>
    <?php } ?>
