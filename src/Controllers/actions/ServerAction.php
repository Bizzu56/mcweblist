<?php

namespace Bizu\Weblistmc\controllers\actions;

use Bizu\Weblistmc\controllers\UserController;
use Bizu\Weblistmc\Models\ModelServer;

class ServerAction extends UserController
{
    public function getAllServer()
    {
        $db = new ModelServer();
        $result = $db->findAll();
        
        // Convertir le résultat en JSON
        $jsonResponse = json_encode($result);

        // Vérifier si l'encodage JSON a réussi
        if ($jsonResponse === false) {
            // Gérer l'erreur d'encodage JSON
            http_response_code(500); // Erreur interne du serveur
            echo json_encode(['error' => 'Erreur lors de l\'encodage JSON']);
            exit;
        }

        // Définir l'en-tête de la réponse JSON
        header('Content-Type: application/json');

        // Retourner la réponse JSON
        echo $jsonResponse;
    }


    public function getMyServer(){
        $id = $_SESSION['id'];
        $db = new ModelServer();

        $server = $db->findBy(['userId' => $id]);

        $jsonResponse = json_encode($server);

        if ($jsonResponse === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de l\'encodage JSON']);
            exit;
        }

        header('Content-Type: application/json');

        echo $jsonResponse;
    }

    public function delete()
{
    $permissions = new PermissionRoutes();
    $checkAdmin = $permissions->isAdmin();

    if(isset($_GET['serverId']) && $_GET['serverId']) {
        $serverId = $_GET['serverId'];

        $db = new ModelServer();
        $serverForUser = $db->findBy(['userId' => $_SESSION['id'], 'id' => $serverId]);
        $server = $db->findById($serverId);


        if($checkAdmin[0] && $checkAdmin[0]["isAdmin"] == 1 && $server) {
            $db->delete($serverId);
            return header("Location: " . $_ENV['SITE_URL'] ."?action=admin-server");
        } elseif($serverForUser) {
            $db->delete($serverId);
            return header("Location: " . $_ENV['SITE_URL'] ."?action=myserver");
        } else { 
            return header("Location: " . $_ENV['SITE_URL'] ."?action=list");
        }
    } else {
        return header("Location: " . $_ENV['SITE_URL'] ."?action=list");
    }
}

    public function create(){
        $db = new ModelServer();
        $modelData = $db
        ->setName($_POST['name'])
        ->setServer_ip($_POST['server_ip'])
        ->setDescription($_POST['description'])
        ->setUserId($_SESSION['id']);

        $db->create($modelData);
        header("Location: " . $_ENV['SITE_URL'] . "?action=list");
    }

    public function getSpecifiqueServerData() {
        $id = $_GET['serverId'];
        $db = new ModelServer();

        $server = $db->getServerMessagesEvents($id);

        if(!$server){
            return header("Location: " . $_ENV['SITE_URL'] . "?action=list");
        }
        
        $jsonResponse = json_encode($server);

        if ($jsonResponse === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de l\'encodage JSON']);
            exit;
        }

        header('Content-Type: application/json');

        echo $jsonResponse;
    }
}
