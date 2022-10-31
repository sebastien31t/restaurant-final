<?php

require_once 'config/config.php';
require_once 'class/Connect.php';

/***********
*  Class qui renvoit les réservations 
*/

class Reservation 
{
    public function add_table(
        string $dte,
        string $hre,
        int $table,
        int $iteration,
        int $type_table
        )
    {
        $book = $dte.' '.$hre.':00'; // On concatene la date et l'heure pour avoir un datetime
        $rs_exist = Connect::conn()->prepare('SELECT `table` ,COUNT(*) count FROM `book` WHERE `book_day` LIKE :book AND `table` LIKE :tbl GROUP BY `table`'); // Nombre d'occurance
        $rs_exist->execute([
            'book'=>$book,
            'tbl'=>$type_table
        ]);
        $book = date_create($book);
        $exist = $rs_exist->fetch();
        
        if($exist && $exist[1] > $iteration && $iteration < $table){ // nombre d'occurence enregistre > table ma
            // création d'un nouvel objet grisé
            ob_start()?>
                <div class="alert alert-dark" role="alert">
                    <strong>Enregistrement</strong>
                    <hr>
                    <p><strong><?php echo date_format($book,'d/m/Y H:i')?></strong></p>
                    <p> Non disponible</p>
                </div>
            <?php
            return  ob_end_flush();
        } else {
            // Création d'un nouvel objet vert
            ob_start()?>
                <div class="alert alert-success" role="alert">
                    <strong>Enregistrement</strong>
                    <hr>
                    <p><strong><?php echo date_format($book,'d/m/Y H:i')?></strong></p>
                    <p>Disponible</p>
                </div>
            <?php
            return  ob_end_flush();
        }
        
    }
}
