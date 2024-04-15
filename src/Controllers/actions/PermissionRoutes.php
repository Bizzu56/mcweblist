<?php 

namespace Bizu\Weblistmc\controllers\actions;

use Bizu\Weblistmc\Models\ModelUser;

class PermissionRoutes {

    private function isExist($id, $email){
        $db = new ModelUser();
        $verifyUser = $db->findBy(['email' => $email, 'id' => $id]);

        if($verifyUser === false) return false;
        else return true;
    }

    public function isLogin() {
        if(isset($_SESSION['islogged']) && $_SESSION['islogged'] && isset($_SESSION['id']) && $_SESSION['id'] && isset($_SESSION['email']) && $_SESSION['email']){
            
            $check = $this->isExist($_SESSION['id'], $_SESSION['email']);
            if(!$check){
                return header("Location: " . $_ENV['SITE_URL'] . "?action=login");
            } else {
                return true;
            }
        } else {
            header("Location: " . $_ENV['SITE_URL'] . "?action=login");
        }
    }


    public function isAdmin(){
        if($this->isLogin() === true){
            $db = new ModelUser();
            $verifyUser = $db->findBy(['email' => $_SESSION['email'], 'id' => $_SESSION['id']]);
            
            
            return $verifyUser;
        }
    }
}