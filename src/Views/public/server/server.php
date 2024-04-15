<?php require_once __DIR__ . "/../components/header.php" ?>

<section class="server-public-data-section">
    <div class="server-public-data-container">
        <div class="server-public-data-header">
            <h1 class="server-public-data-title">
                STATUS DES SERVEURS MINECRAFT
            </h1>
            <h2 class="server-public-data-small-title">
                Obtenez rapidement des informations sur les serveurs Minecraft
            </h2>
        </div>

        <div class="server-public-data-body">
            <form class="server-public-data-form" id="searchForm">
                <div class="server-public-data-form-search-and-submit">
                    <input type="text" id="searchInput" placeholder="Entrez l'ip du serveur...">
                    <input type="submit" value="Rechercher">
                </div>

                <div class="server-public-data-form-bedrock-check">
                    <label for="activeOnlyCheckbox">
                        <input type="checkbox" id="activeOnlyCheckbox"> Serveur Bedrock ?
                    </label>
                </div>
            </form>
            <div class="server-data-with-search-container">
                <div class="server-status-infos-header">
                    <img src="./assets/img/default/server-default-image.webp" alt="server image" />
                    <h1>Inconnue</h1>
                </div>
                <div class="server-status-infos-body">
                    <div class="server-status-infos-motd">
                        <h2>MOTD :</h2>
                        <div class="server-status-infos-motd-view">
                        Inconnue
                        </div>
                    </div>
                    <div class="server-status-infos-players">
                        <h2>players :</h2>
                        <span>0 / 0</span>
                    </div>
                    <div class="server-status-infos-version">
                        <h2>Version :</h2>
                        <span>Inconnue</span>
                    </div>
                    <div class="server-status-infos-online">
                        <h2>Status :</h2>
                        <span>Inconnue</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="./assets/js/server-data.js"></script>

<?php require_once __DIR__ . "/../components/footer.php" ?>
