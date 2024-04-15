<?php

namespace Bizu\Weblistmc\controllers;

class UserController extends MainController
{
    public function homePage(): void
    {
        require_once $this->userView('home');
    }

    public function loginPage(): void
    {
        require_once $this->userView('user/login');
    }

    public function accountPage(): void
    {
        require_once $this->userView('user/account');
    }

    
    public function registerPage(): void
    {
        require_once $this->userView('user/register');
    }    

    public function settingsPage(): void
    {
        require_once $this->userView('user/settings');
    }

    public function serverPage(): void 
    {
        require_once $this->userView('server/server');
    }

    public function serverListPage(): void
    {
        require_once $this->userView('server/list');
    }

    public function serverInfosPage(): void
    {
        require_once $this->userView('server/server-infos');
    }

    public function myServerPage(): void
    {
        require_once $this->userView('server/myserver');
    }

    public function adminServerManagerPage(): void
    {
        require_once $this->userView('server/admin-server');
    }

    public function createServerPage(): void{
        require_once $this->userView('server/servercreate');
    }

    public function notFoundPage($exception)
    {
        require_once $this->userView('404');
    }


    public function errorPage()
    {
        require_once $this->userView('error');
    }

}
