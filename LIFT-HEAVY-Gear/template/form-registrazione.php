<section>
    <h1>REGISTRATI</h1>
    <form action="registrazione.php" method="post">
        <label for="nome">Nome</label>
        <br>
        <input type="text" id="nome" name="nome" required value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>" <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
        <br><br>
        <label for="cognome">Cognome</label>
        <br>
        <input type="text" id="cognome" name="cognome" required value="<?php echo isset($_POST['cognome']) ? htmlspecialchars($_POST['cognome']) : ''; ?>" <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
        <br><br>
        <label for="email">Email</label>
        <br>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
        <br><br>
        <label for="password">Password</label>
        <br>
        <div class="password-container">
            <input
                type="password"
                id="password"
                name="password"
                required
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                title="La password deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola, un numero e un carattere speciale."
                <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                <em class="fas fa-eye"></em> 
            </span>
        </div>
        <br><br>
        <label for="venditore" class="checkbox-label">
            <span>Account venditore?</span>
            <input type="checkbox" id="venditore" value="venditore" name="venditore">
        </label>
        <?php if (!empty($templateParams["errore"])): ?>
            <p class="error">
                <em class="fas fa-exclamation-triangle"></em> <?php echo $templateParams["errore"]; ?>
            </p>
        <?php endif; ?>
        <button type="submit">Crea Account</button>
        <br><br>
    </form>
    <img src="<?php echo UPLOAD_DIR_LOGINS; ?>login.png" alt="registration-img">
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<em class="fas fa-eye"></em>' : '<em class="fas fa-eye-slash"></em>';
        });
    </script>
</section>