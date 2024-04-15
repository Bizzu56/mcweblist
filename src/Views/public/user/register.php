<?php require_once __DIR__ . "/../components/header.php" ?>


<section class="register-form-section">
    <div class="register-form-container">
        <h1 class="title-form-register">
            Register
        </h1>

        <form action="?action=post-register" method="post">
            <div class="form-input-container">
                <input placeholder="exemple@exemple.com" class="input-style" type="email" name="email" required>
                <input placeholder="jhon Doe" class="input-style" type="text" name="nickName" required>
                <input placeholder="password" class="input-style" type="password" name="password" required>
            </div>

            <input aria-label="s'enregistrer'" class="form-validate-register" type="submit" value="S'enregistrer">
            <a class="form-validate" href="?action=login">Se Connecter</a>
        </form>

        <p>Aucune donnée n'est utilisée ailleurs que sur MCWebList, en créant un compte vous acceptez que l'on stocke vos données sur un serveur jusqu'à suppression de votre part.</p>
    </div>
</section>

<?php require_once __DIR__ . "/../components/footer.php" ?>
