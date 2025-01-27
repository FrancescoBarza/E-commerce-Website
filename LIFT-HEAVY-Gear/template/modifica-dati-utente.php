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
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Lascia vuoto per mantenere la password attuale"
                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                       title="La password deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola, un numero e un carattere speciale.">
                       <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                <em class="fas fa-eye"></em> 
            </span>
            </div>
            <button type="submit">Salva modifiche</button>
            <button type="button" onclick="toggleModificaDati()">Annulla</button>
        </form>
    </div>
    <script>

        const isVenditore = '<?php echo $templateParams["userData"]["venditore"]; ?>';

        function tornaAreaUtente() {
            if (isVenditore === 'Y') {
                window.location.href = 'areaVenditore.php';
            } else {
                window.location.href = 'areaCliente.php';
            }
        }
    </script>
    <button type="button" class="tornaAreaCliente" onclick="tornaAreaUtente()">Torna alla tua area utente</button>
</section>

<script>
function toggleModificaDati() {
    const staticView = document.getElementById('static-view');
    const form = document.getElementById('modificaDatiForm');
    const tornaAreaUtenteButton = document.querySelector('.tornaAreaUtente');

    if (form.style.display === 'none') {
        form.style.display = 'block';
        staticView.style.display = 'none';
        tornaAreaUtenteButton.style.display = 'none';
    } else {
        form.style.display = 'none';
        staticView.style.display = 'block';
        tornaAreaUtenteButton.style.display = 'block';
    }
}
</script>
<script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<em class="fas fa-eye"></em>' : '<em class="fas fa-eye-slash"></em>';
        });
    </script>