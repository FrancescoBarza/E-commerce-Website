
<section>
    <h1>LOGIN</h1>
    <form action="login.php" method="post">
        <label for="email">Email</label>
        <br>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
        <br/><br/>
        <label for="password">Password</label>
        <br/>
        <input type="password" id="password" name="password" required <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
        <br>
        <?php if (!empty($templateParams["errore"])): ?>
            <p class="error">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $templateParams["errore"]; ?>
            </p>
        <?php endif; ?>
        <a href="password-dimenticata.php" style="display: block; margin-top: 10px; text-decoration: none; color: #007bff;">
            Password dimenticata?
        </a>
        <button type="submit" name="submit">Sign In</button>

        <br/><br/>
        <p>Nuovo cliente?<a href="registrazione.php"> Crea un account</a></p><br/>

    </form>
    <img src="<?php echo UPLOAD_DIR_LOGINS; ?>login.png" alt="login-img">
</section>