<?php
    /****
     * Connexion a la base de données
     */
    
    require_once 'config.php';

    try{
        $conn = new PDO(DATABASE,USER,PASS);
    }
    catch(PDOException $e){
        echo $e;
    }
?>