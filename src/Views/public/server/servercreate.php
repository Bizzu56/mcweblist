<?php require_once __DIR__ . "/../components/header.php" ?>


<section class="create-server-form-section">
    <div class="create-server-form-container">
        <h1 class="title-form-create-server">
            Ajoute ton serveur
        </h1>

        <form action="?action=post-create-server" method="post">
            <div class="form-input-container">
                <input placeholder="hypixel.net" class="input-style" type="text" name="server_ip" required>
                <input placeholder="Hypixel" class="input-style" type="text" name="name" required>
                <textarea placeholder="description..." class="input-style" name="description" maxlength="1099" required></textarea>
            </div>

            <input aria-label="ajouter" class="form-validate-create-server" type="submit" value="Ajouter">
        </form>
    </div>
</section>

<?php require_once __DIR__ . "/../components/footer.php" ?>
