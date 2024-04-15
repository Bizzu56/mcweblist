<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}


require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
try {
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    die('Impossible de charger le fichier .env : ' . $e->getMessage());
}

require_once __DIR__ . '/src/Controllers/Routes.php';

?>