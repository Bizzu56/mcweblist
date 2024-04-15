<?php

namespace Bizu\Weblistmc\controllers\actions;

use Bizu\Weblistmc\controllers\UserController;
use Bizu\Weblistmc\Models\ModelUser;

    class UserAction extends UserController
    {
         

        public function login(string $email, string $password)
        {
            $passwordsHelpers = new PasswordHelpers();
            $user = new ModelUser();

            $getUser = $user->ifExistingUser($email);
            
            if ($getUser === false) {
                header("Location: " . $_ENV['SITE_URL'] . "?action=login&nouser=true");
            }

            if(!$passwordsHelpers->verifyPassword($password, $getUser['password'])){
                header("Location: " . $_ENV['SITE_URL'] . "?action=login&password=false");
            }

            unset($getUser['password']);

            session_start();

            if ($getUser['isAdmin'] == 1) {
                $_SESSION['admin'] = true;
            }

          
            $_SESSION['username'] = $getUser['nickName'];
            $_SESSION['email'] = $email;
            $_SESSION['islogged'] = true;
            $_SESSION['id'] = $getUser['id'];

            
            if(isset($_SESSION['islogged'])){
                header("Location: ".$_ENV['SITE_URL']."?action=profile");
            } else {
                header("Location: " . $_ENV['SITE_URL'] . "?action=login");
            }
        }
            public function deleteAccount()
            {
                $user = new ModelUser();
                $user->delete($_SESSION['id']);
    
                $this->logout();
    
                header("Location: " . $_ENV['SITE_URL']);
            }
        

        public function logout()
        {
            session_start();

            $_SESSION = array();

            session_destroy();

            setcookie('PHPSESSID', '', time() - 3600, '/');

            header("Location: " . $_ENV['SITE_URL']);
        }

        public function register($email, $nickName, $password)
        {
            $passwordsHelpers = new PasswordHelpers();
            $user = new ModelUser();

            $hashPassword = $passwordsHelpers->hashPassword($password);

            $verifyExistingUser = $user->ifExistingUser($email);

            if($verifyExistingUser){
                header("Location: " . $_ENV['SITE_URL'] . "?action=register&exists=true");

            }

            $modelData = $user
            -> setNickName($nickName)
            -> setPassword($hashPassword)
            -> setEmail($email);

            $user->create($modelData);

            header("Location: " . $_ENV['SITE_URL'] . "?action=login");

            
        }

        public function userListForAdmin() {
            $user = new ModelUser();
            return $user->getAllUserForAdmin();
        }
    }