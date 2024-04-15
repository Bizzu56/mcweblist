<?php
use Bizu\Weblistmc\controllers\actions\MessagesAction;
use Bizu\Weblistmc\controllers\actions\PermissionRoutes;
use Bizu\Weblistmc\controllers\actions\ServerAction;
use Bizu\Weblistmc\controllers\actions\UserAction;


$view = new \Bizu\Weblistmc\controllers\UserController();

$login = new UserAction();

$server = new ServerAction();

$security = new PermissionRoutes();

$message = new MessagesAction();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'server':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $view->serverPage();
                break;
            }


        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (isset($_SESSION['islogged']) && $_SESSION['islogged']) {
                    header("Location: " . $_ENV['SITE_URL'] . '?action=account');
                    break;
                } else {
                    $view->loginPage();
                    break;
                }
            }

        case 'account':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if ($security->isLogin() === true) {
                    $view->accountPage();
                    break;
                } else {
                    $view->loginPage();
                    break;
                }
            }


        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (isset($_SESSION['islogged']) && $_SESSION['islogged']) {
                    header("Location: " . $_ENV['SITE_URL'] . '?action=account');
                    break;
                } else {
                    $view->registerPage();
                    break;
                }
            }

        case 'myserver':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if ($security->isLogin() === true) {
                    $view->myServerPage();
                    break;
                } else {
                    header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                    break;
                }
            }

        case 'logout':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if ($security->isLogin() === true) {
                    $login->logOut();
                    break;
                } else {
                    $login->logOut();
                    break;
                }
            }

        case 'post-login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_SESSION['islogged']) && $_SESSION['islogged']) {
                    $view->homePage();
                    break;
                } else {
                    $login->login($_POST['email'], $_POST['password']);
                    break;
                }
            }
        case 'post-register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_SESSION['islogged']) && $_SESSION['islogged']) {
                    $view->homePage();
                    break;
                } else {
                    $login->register($_POST['email'], $_POST['nickName'], $_POST['password']);
                    break;
                }
            }

        case 'get-server':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $server->getAllServer();
            }
            break;
        case 'get-myserver':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['id']) && $_SESSION['id']) {
                $server->getMyServer();
                break;
            } else {
                header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                break;
            }
        case 'list':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $view->serverListPage();
            }
            break;
            case 'server-infos':
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['serverId']) && $_GET['serverId']) {
                    $view->serverInfosPage();
                }
                break;

                case 'get-server-infos':
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['serverId']) && $_GET['serverId']) {
                        $server->getSpecifiqueServerData();
                    }
                    break;
        case 'delete-server':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['serverId']) && $_GET['serverId']) {
                if ($security->isLogin() === true) {
                    $server->delete();
                    break;
                } else {
                    header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                    break;
                }
            } else {
                header("Location: " . $_ENV['SITE_URL'] . "?action=home");
            }
        case 'admin-server':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if ($security->isLogin() === true) {
                    if(isset($_SESSION['admin'])) {
                        $view->adminServerManagerPage();
                        break;
                    } else {
                        header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                        break;
                    }
                } else {
                    header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                    break;
                }
            }
        case 'servercreate':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if ($security->isLogin() === true) {
                    $view->createServerPage();
                    break;
                } else {
                    header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                    break;
                }
            }
        case 'post-create-server':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($security->isLogin() === true) {
                    $server->create();
                    break;
                } else {
                    header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                    break;
                }
            }
            case 'post-message':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($security->isLogin() === true) {
                        $message->postMessages();
                        break;
                    } else {
                        header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                        break;
                    }
                }

                case 'delete-account':
                    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                        if ($security->isLogin() === true) {
                            $login->deleteAccount();
                            break;
                        } else {
                            header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                            break;
                        }
                    }

                case 'delete-message':
                    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                        if ($security->isLogin() === true) {
                            if(isset($_SESSION['admin'])) {
                                $message->deleteMessage();
                            } else {
                                header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                                break;
                            }
                        } else {
                            header("Location: " . $_ENV['SITE_URL'] . "?action=home");
                            break;
                        }
                    }

        default:
            $view->homePage();
            break;
    }
} else {
    $view->homePage();
}
