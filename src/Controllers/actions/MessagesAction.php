<?php

namespace Bizu\Weblistmc\controllers\actions;

use Bizu\Weblistmc\controllers\UserController;
use Bizu\Weblistmc\Models\ModelMessage;

class MessagesAction extends UserController {
    public function postMessages() {
        $db = new ModelMessage();

        $models = $db
        ->setAuthorId($_SESSION['id'])
        -> setContent($_POST['content'])
        -> setServerId($_POST['serverId']);

        $db->create($models);

        header("Location: " . $_ENV['SITE_URL'] . "?action=server-infos&serverId=".$_POST['serverId']);
    }

    public function deleteMessage()
    {
        
        if(isset($_GET['messageId']) && $_GET['messageId'] && isset($_GET['serverId']) && $_GET['serverId'])
        {
            $db = new ModelMessage();

        $permissions = new PermissionRoutes();
        $checkAdmin = $permissions->isAdmin();
        if($checkAdmin[0] && $checkAdmin[0]["isAdmin"] == 1) {
            $db->delete($_GET['messageId']);
            return header("Location: " . $_ENV['SITE_URL'] ."?action=server-infos&serverId=".$_GET['serverId']);
        }
        else {
            return header("Location: " . $_ENV['SITE_URL'] ."?action=server-infos&serverId=".$_GET['serverId']);
        }
        }
        else {
            return header("Location: " . $_ENV['SITE_URL'] ."?action=server-infos&serverId=".$_GET['serverId']);
        }

    }
}