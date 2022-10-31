<?php
require_once 'config/config.php';
/***
 * Connexion singleton a la base de données
 */

class Connect extends PDO
{
    
    public static PDO $connect;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function conn()
    {
        if(!isset(self::$connect) || is_null(self::$connect)){
            try {
               return self::$connect = new PDO(DATABASE,USER,PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            } catch (PDOException $e){
                echo $e;
            }
        }else{
            return self::$connect;
        }
    }
}