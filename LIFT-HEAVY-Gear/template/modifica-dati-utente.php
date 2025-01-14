<section>
    <h1>I MIEI DATI</h1>
    <div class="dati">
        <div id="static-view">
            <p class="editable">Nome: <?php echo htmlspecialchars($templateParams["userData"]["nome"]); ?></p>
            <p class="editable">Cognome: <?php echo htmlspecialchars($templateParams["userData"]["cognome"]); ?></p>
            <p class="editable">E-mail: <?php echo htmlspecialchars($templateParams["userData"]["email"]); ?></p>
            <p class="editable">Password: ********</p>
            <button type="button" onclick="toggleModificaDati()">Modifica dati</button>
        </div>

        <form id="modificaDatiForm" method="post" action="datiUtente.php" style="display: none;">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($templateParams["userData"]["nome"]); ?>" required>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" value="<?php echo htmlspecialchars($templateParams["userData"]["cognome"]); ?>" required>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($templateParams["userData"]["email"]); ?>" required>
            <label for="password">Nuova Password:</label>
            <input type="password" id="password" name="password" placeholder="Lascia vuoto per mantenere la password attuale">
            <button type="submit">Salva modifiche</button>
            <button type="button" onclick="toggleModificaDati()">Annulla</button>
        </form>
    </div>

    <button type="button" class="tornaAreaCliente" onclick="tornaAreaUtente()">Torna alla tua area utente</button>
    <script>
        // Passa il valore venditore a una variabile JavaScript
        const isVenditore = '<?php echo $templateParams["userData"]["venditore"]; ?>';

        function tornaAreaUtente() {
            if (isVenditore === 'Y') {
                window.location.href = 'areaVenditore.php';
            } else {
                window.location.href = 'areaCliente.php';
            }
        }
    </script>
</section>

<script>
function toggleModificaDati() {
    const staticView = document.getElementById('static-view');
    const form = document.getElementById('modificaDatiForm');
    const tornaAreaUtenteButton = document.querySelector('.tornaAreaUtente');

    if (form.style.display === 'none') {
        form.style.display = 'block';
        staticView.style.display = 'none';
        tornaAreaClienteButton.style.display = 'none';
    } else {
        form.style.display = 'none';
        staticView.style.display = 'block';
        tornaAreaClienteButton.style.display = 'block';
    }
}
</script>