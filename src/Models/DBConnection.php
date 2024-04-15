<?php
namespace Bizu\Weblistmc\Models;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class DBConnection extends PDO
{

    private static $instance;



    private function __construct()
    {

         $DB_HOST = 'localhost';
       $DB_USER = $_ENV['db_user'];
       $DB_PASSWORD = $_ENV['db_password'];
        $DB_NAME = $_ENV['db_name'];


        $_dsn = 'mysql:dbname='. $DB_NAME . ';host=' . $DB_HOST;

        try{
            parent::__construct($_dsn, $DB_USER, $DB_PASSWORD);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e){
            die($e->getMessage());
        }
        
    }

    public static function getInstance():self
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}