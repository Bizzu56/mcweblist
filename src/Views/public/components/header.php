<!DOCTYPE html>
<html lang="fr">

<head>
    <title>MCWebList</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/styles/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <nav class="nav-container">
        <div class="bar-navigation">
            <a class="logo-container" href="/">
                <img src="./assets/img/logo.png" alt="MC WebList Logo">
            </a>

            <div class="navigation">
                <ul class="nav-links">
                    <li class="nav-link">
                        <a href="?action=home">Accueil</a>
                    </li>
                    <li class="nav-link">
                        <a href="?action=server">Serveurs</a>
                    </li>
                    <li class="nav-link">
                        <a href="?action=list">Listing</a>
                    </li>
                  
                    <?php
                    if (!isset($_SESSION["islogged"])) echo ('
                    <li class="nav-link login-page">
                        <a href="?action=login">LOGIN</a>
                    </li>
                    <li class="nav-link register-page">
                        <a href="?action=register">REGISTER</a>
                    </li>
                    ')
                    ?>
                    <?php if (isset($_SESSION["islogged"])) echo ('
                    <li class="nav-link account-page">
                        <a href="?action=account">Account</a>
                    </li>
                    
                    ')
                    ?>
                </ul>
            </div>

            <?php if (isset($_SESSION["islogged"]) && isset($_SESSION['username'])) echo ('
                    <a class="my-account-nav-icon" href="?action=account">
                        <i class="fa-regular fa-circle-user"></i>
                        <span>
                        '.$_SESSION['username'].'
                        </span>
                    </a>
                ');
                else echo('<a class="login-header-button" href="?action=login">LOGIN</a>'); ?>

            <div class="hamburger">
                <input class="checkbox" type="checkbox" />
                <svg fill="none" viewBox="0 0 50 50" height="50" width="50">
                    <path class="lineTop line" stroke-linecap="round" stroke-width="4" stroke="black" d="M6 11L44 11"></path>
                    <path stroke-linecap="round" stroke-width="4" stroke="black" d="M6 24H43" class="lineMid line"></path>
                    <path stroke-linecap="round" stroke-width="4" stroke="black" d="M6 37H43" class="lineBottom line"></path>
                </svg>
            </div>
        </div>
    </nav>
    <script src="./assets/js/index.js"></script>
</body>


</html>