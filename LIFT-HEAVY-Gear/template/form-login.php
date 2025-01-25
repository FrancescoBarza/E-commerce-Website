<section>
    <h1>LOGIN</h1>
    <form action="login.php" method="post">
        <label for="email">Email</label>
        <br>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
        <br><br>

        <label for="password">Password</label>
        <br>
        <div class="password-container">
            <input type="password" id="password" name="password" required <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
            <span class="toggle-password" id="togglePassword">
                <em class="fas fa-eye"></em>
            </span>
        </div>
        <br>
        </button>
        <br>

        <?php if (!empty($templateParams["errore"])): ?>
            <p class="error">
                <em class="fas fa-exclamation-triangle"></em> <?php echo $templateParams["errore"]; ?>
            </p>
        <?php endif; ?>
        <button type="submit" name="submit">Sign In</button>

        <br><br>
        <p>Nuovo cliente?<a href="registrazione.php"> Crea un account</a></p><br />

    </form>
    <img src="<?php echo UPLOAD_DIR_LOGINS; ?>login.png" alt="login-img">
</section>

<script>
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('em').classList.toggle('fa-eye-slash'); 
    });
</script>
