<?php
require_once 'class/Connect.php';
require_once 'config/config.php';

/**************************
*  Cette class sert principalement a la réservation des table pour la partie réservation
***************************/

class Calendar
{

    private string $dte;
    private string $hour;
    private int $table;

    
    public function __construct(string $dte, string $hour, int $table)
    {
        connect::conn();
        $this->dte = $dte;
        $this->hour = $hour;
        $this->table = $table;
    }

    public function getCalendar():string
    {
        return $this->dte .' '.$this->hour;
    }

    public function add_book()
    {
        $book = $this->dte.' '.$this->hour.':00';
        switch ($this->table){
            case 1: $max = TABLE2; break;
            case 2: $max = TABLE4; break;
            case 3: $max = TABLE6; break;
            case 4: $max = TABLE8; break;
        }

        // On rechersi il y a deja une réservation pour l'horraire demandé
        // $rs_count_enr = connect::conn()->prepare('SELECT COUNT(*) FROM `book` WHERE `book_day` = ? AND `table` = ?');
        $rs_count_enr = connect::conn()->prepare('SELECT `table` ,COUNT(*) count FROM `book` WHERE `book_day` = ? AND `table` LIKE ? GROUP BY `table`');
        $rs_count_enr->execute([$book,$this->table]);
        $count_enr = $rs_count_enr->fetch();

        // Si deja réservé on n'enregistre pas la demande
        if($count_enr['count'] >= $max){
            return false;
        }else{  // Si enregistrement disponible on enregistre la demande           
            $ri_enr = connect::conn()->prepare('INSERT INTO `book`(`book_day`,`table`)VALUES(?,?)');
            $ri_enr->execute([$book,$this->table]);
            return true;
        }
    }
}
