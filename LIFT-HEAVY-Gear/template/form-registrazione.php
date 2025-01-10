<section>
    <h1>REGISTRATI</h1>

    <?php if (!empty($templateParams["errore"])): ?>
        <p class="error">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $templateParams["errore"]; ?>
        </p>
    <?php endif; ?>


    <form action="registrazione.php" method="post">
        <label for="nome">Nome</label>
        <br>
        <input type="text" id="nome" name="nome" required value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>"  <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
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
        <input type="password" id="password" name="password" required <?php if (!empty($templateParams["errore"])) echo 'class="error-input"'; ?>>
        <br><br>


        <label for="venditore" class="checkbox-label">
            <span>Account venditore?</span>
            <input type="checkbox" id="venditore" value="venditore" name="venditore">
        </label>

        <button type="submit">Crea Account</button>
        <br><br>
    </form>
    <img src="<?php echo UPLOAD_DIR_LOGINS; ?>login.png" alt="registration-img"> </section>