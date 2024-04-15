<?php require_once __DIR__ . "/../components/header.php" ?>


<section class="login-form-section">
    <div class="login-form-container">
        <h1 class="title-form-login">
            Connexion
        </h1>

        <form action="?action=post-login" method="post">
            <div class="form-input-container">
                <input placeholder="exemple@exemple.com" class="input-style" type="email" name="email" required>
                <input placeholder="password" class="input-style" type="password" name="password">
            </div>

            <input aria-label="se connecter" class="form-validate-login" type="submit" value="Se connecter" required>
            <a class="form-validate" href="?action=register">Créer un compte</a>
        </form>
    </div>
</section>

<?php require_once __DIR__ . "/../components/footer.php" ?>
