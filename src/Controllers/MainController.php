<?php

namespace Bizu\Weblistmc\controllers;

class MainController
{
    public function userView(string $view): string
    {
        return 'src/Views/public/' . $view . '.php';
    }
}