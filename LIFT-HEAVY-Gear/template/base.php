<!DOCTYPE html>

<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- FONT -->
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Libre%20Franklin' rel='stylesheet'>
    <!-- Icone -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/styleClass.css" />
    <link rel="stylesheet" href="css/carrello.css" />

    <title><?php echo $templateParams["titolo"]; ?> </title>
    <link rel="icon" href="images/icons/Logo_Icon.ico" />
</head>

<body>
    <header>
        <div class="header-menu">
            <a href="#" id="menu-toggle" aria-label="Apri il menù" title="Clicca per aprire il menù">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 18L20 18" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 12L20 12" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 6L20 6" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                </svg>
            </a>
            <nav>
                <ul id="dropdown-menu" class="hidden">
                    <?php foreach ($templateParams["categorie"] as $categoria): ?>
                        <li>
                            <a href="<?php
                                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                            $userRole = $_SESSION["venditore"];
                                            echo $userRole === 'Y' ? '#' : 'categoria.php?id=' . $categoria["ID_categoria"];
                                        } else {
                                            echo 'categoria.php?id=' . $categoria["ID_categoria"];
                                        }
                                        ?>">
                                <?php echo $categoria["nome_categoria"]; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/notify.js/0.4.2/notify.min.js"></script>
                <script>
                    const linksCategorie = document.querySelectorAll('#dropdown-menu a');

                    linksCategorie.forEach(link => {
                        link.addEventListener('click', function(event) {
                            if (this.getAttribute('href') === '#') {
                                event.preventDefault();
                                $.notify("Riservato ai soli clienti.", { type: "error" , position: "top center" });
                            }
                        });
                    });
                </script>
            </nav>
        </div>
        <div class="header-logo">
            <a href="<?php
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                            $userRole = $_SESSION["venditore"];
                            echo $userRole === 'Y' ? '#' : 'index.php';
                        } else {
                            echo 'index.php';
                        }
                        ?>" id="link-index" >
                <img src="images/logos/Logo_Main.png" alt="Logo" /></a>
        </div>
        <div class="header-icon">
            <a href="<?php
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

                            $userRole = $_SESSION["venditore"];
                            echo $userRole === 'Y' ? 'areaVenditore.php' : 'areaCliente.php';
                        } else {

                            echo 'login.php';
                        }
                        ?>" title="Login" aria-label="Login">
                <svg>
                    <path fill="currentColor"
                        d="M12 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.429a3.571 3.571 0 1 0 0 7.142 3.571 3.571 0 0 0 0-7.142zm0 10c2.558 0 5.114.471 7.664 1.411A3.571 3.571 0 0 1 22 18.19v3.096c0 .394-.32.714-.714.714H2.714A.714.714 0 0 1 2 21.286V18.19c0-1.495.933-2.833 2.336-3.35 2.55-.94 5.106-1.411 7.664-1.411zm0 1.428c-2.387 0-4.775.44-7.17 1.324a2.143 2.143 0 0 0-1.401 2.01v2.38H20.57v-2.38c0-.898-.56-1.7-1.401-2.01-2.395-.885-4.783-1.324-7.17-1.324z">

                    </path>
                </svg>
            </a>
            <a href="<?php
                        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                            echo 'login.php';
                        } else {
                            $userRole = $_SESSION["venditore"];
                            echo $userRole === 'Y' ? '#' : 'carrello.php';
                        }
                        ?>" id="link-carrello" title="Carrello" aria-label="Carrello">
                <svg>
                    <path fill="currentColor"
                        d="M17 18a2 2 0 0 1 2 2 2 2 0 0 1-2 2 2 2 0 0 1-2-2c0-1.11.89-2 2-2M1 2h3.27l.94 2H20a1 1 0 0 1 1 1c0 .17-.05.34-.12.5l-3.58 6.47c-.34.61-1 1.03-1.75 1.03H8.1l-.9 1.63-.03.12a.25.25 0 0 0 .25.25H19v2H7a2 2 0 0 1-2-2c0-.35.09-.68.24-.96l1.36-2.45L3 4H1V2m6 16a2 2 0 0 1 2 2 2 2 0 0 1-2 2 2 2 0 0 1-2-2c0-1.11.89-2 2-2m9-7 2.78-5H6.14l2.36 5H16Z">
                    </path>
                </svg>
            </a>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/notify.js/0.4.2/notify.min.js"></script>
            <script>
                const linksCheRichiedonoCliente = document.querySelectorAll('#link-carrello, #link-index');

                linksCheRichiedonoCliente.forEach(link => {
                    link.addEventListener('click', function(event) {
                        if (this.getAttribute('href') === '#') {
                            event.preventDefault();
                            $.notify("Riservato ai soli clienti.", { type: "error" ,position: "top center", });
                        }
                    });
                });
            </script>
        </div>
        <div class="header-search">
            <form method="GET" action="search-bar.php" id="searchForm">
                <span type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.9604 11.4802C19.9604 13.8094 19.0227 15.9176 17.5019 17.4512C16.9332 18.0247 16.2834 18.5173 15.5716 18.9102C14.3594 19.5793 12.9658 19.9604 11.4802 19.9604C6.79672 19.9604 3 16.1637 3 11.4802C3 6.79672 6.79672 3 11.4802 3C16.1637 3 19.9604 6.79672 19.9604 11.4802Z"
                            stroke="#fff" stroke-width="2" />
                        <path d="M18.1553 18.1553L21.8871 21.8871" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </span>
                <label style="display: none;" for="searchInput">Cerca</label>
                <input type="search" name="search" autocomplete="off" placeholder="Search..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" id="searchInput" />
            </form>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/notify.js/0.4.2/notify.min.js"></script>
            <script>
                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["venditore"]) && $_SESSION["venditore"] == 'Y'): ?>
                    const searchForm = document.getElementById('searchForm');
                    if (searchForm) {
                        searchForm.addEventListener('submit', function(event) {
                            event.preventDefault(); 
                            $.notify("Ricerca disabilitata per venditori", { type: "error", position: "top left",});
                        });
                    }
                <?php endif; ?>
            </script>
        </div>
    </header>
</body>
    <!-- END HEADER -->
    <main>
        <?php
        require($templateParams["nome-main"]);
        ?>
    </main>
    <?php if (isset($templateParams["show-aside"]) && $templateParams["show-aside"]): ?>
        <aside>
            <h1>ARTICOLI</h1>
            <?php if (isset($templateParams["articoli"]) && !empty($templateParams["articoli"])): ?>
                <?php foreach ($templateParams["articoli"] as $articolo): ?>
                    <div class="articolo">
                        <img src="<?php echo UPLOAD_DIR_ARTICLES . $articolo["immagine_articolo"]; ?>" alt=" <?php echo $articolo["titolo_articolo"]; ?>" />
                        <section>
                            <h2><?php echo $articolo["titolo_articolo"]; ?></h2>
                            <p><?php echo $articolo["data_articolo"]; ?></p>
                            <button onclick="window.location.href='articolo.php?id=<?php echo $articolo['ID_articolo']; ?>' "><span class="fas fa-arrow-right"></span></button>
                        </section>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nessun articolo disponibile.</p>
            <?php endif; ?>
        </aside>
    <?php endif; ?>
    <footer>
        <section class="social">
            <h2>SEGUICI SU:</h2>
            <a href="http://www.facebook.com" title="Facebook" aria-label="Facebook"><span class="fab fa-facebook-f" style="color: #333;"></span></a>
            <a href="http://instagram.com" title="Instagram" aria-label="Instagram"><span class="fab fa-instagram" style="color: #333;"></span></a>
            <a href="http://twitter.com" title="Twitter" aria-label="Twitter"><span class="fab fa-twitter" style="color: #333;"></span></a>
        </section>

        <section class="pagamenti">
            <p>Pagamenti con:</p>
            <a href="https://americanexpress.com" title="American Express" aria-label="American Express"><span class="fab fa-cc-amex" style="color: #006FCF;"></span></a>
            <a href="https://visa.com" title="Visa" aria-label="Visa"><span class="fab fa-cc-visa" style="color: navy;"></span></a>
            <a href="https://mastercard.com" title="MasterCard" aria-label="MasterCard"><span class="fab fa-cc-mastercard" style="color: red;"></span></a>
            <a href="https://www.paypal.com" title="PayPal" aria-label="PayPal"><span class="fab fa-cc-paypal" style="color: #001C64;"></span></a>
            <a href="https://www.apple.com/it/apple-pay/" title="Apple Pay" aria-label="Apple Pay"><span class="fab fa-cc-apple-pay"
                    style="color: #000000;"></span></a>
        </section>

        <section class="copyright">
            <p>©2024 LIFT HEAVY Gear.</p>
            <a href="about.php">About Us</a>
            <a href="privacy.php">Privacy</a>
            <a href="termini.php">Termini e Condizioni</a>
        </section>
    </footer>
    <!-- SCRIPT JAVASCRIPT-->
    <script src="js/functions.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
</body>

</html>