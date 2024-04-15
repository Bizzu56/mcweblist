<?php require_once __DIR__ . "/../components/header.php" ?>

<section class="section-accounts-manager">
    <?php echo "<h1>" . $_SESSION['username'] . "</h1>";?>
    <div class="cards-account-container">
      
        <a class="card" href="?action=myserver">
            <img src="./assets/img/icons/server.png" alt="image Voir mes serveurs" class="card-img">
            <div class="card-overlay">
                <p class="card-text">Mes serveurs</p>
            </div>
        </a>
        <a class="card" href="?action=logout">
            <img src="./assets/img/icons/logout.png" alt="image Deconnexion" class="card-img">
            <div class="card-overlay">
                <p class="card-text">Deconnexion</p>
            </div>
        </a>
        <a class="card" href="?action=delete-account">
            <img src="./assets/img/icons/delete.png" alt="image Suppression du compte" class="card-img">
            <div class="card-overlay">
                <p class="card-text">Supprimer le compte</p>
            </div>
        </a>
    </div>
</section>

<?php require_once __DIR__ . "/../components/footer.php" ?>
