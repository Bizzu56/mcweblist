<?php require_once __DIR__ . "/../components/header.php" ?>


<section class="server-one-infos-section">
    <div class="server-one-infos-container">
        <div class="server-one-infos-first">
            
        </div>
        <div class="server-one-infos-two">
            <div class="server-one-infos-two-description">
                
            </div>
            <div class="server-one-infos-two-comment">
                <h1>MESSAGE</h1>
                <?php
                    if(isset($_SESSION['islogged']) && $_SESSION['islogged'] && isset($_GET['serverId']) && $_GET['serverId']) echo('
                        <form action="?action=post-message&serverId" method="post">
                    <input type="hidden" name="serverId" value="'.$_GET['serverId'].'" />
                    <textarea placeholder="Votre message..." class="input-style" name="content" maxlength="1099" required></textarea>
                    <input aria-label="envoyer" type="submit" value="Envoyer" required>
                </form>');
                    
                ?>

                <div class="line-comment"></div>


                <div class="server-one-infos-two-all-comment">
                    
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        var isAdmin = <?php echo isset($_SESSION["admin"]) ? 'true' : 'false'; ?>;
    </script>
</section>
<?php require_once __DIR__ . "/../components/footer.php" ?>
