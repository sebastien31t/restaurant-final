<?php

    require_once "../config/connect.php";
    require_once "../config/config.php";

    $dte = htmlspecialchars($_POST['dte']);
    $hre = htmlspecialchars($_POST['hre']);
    $table = intval($_POST['table']);
    $dte_hre = $dte.' '.$hre;

    // On verifie que la table est disponnible
    $rs_count = $conn->prepare('SELECT COUNT(*) count FROM `book` WHERE `book_day` = ? AND `table` = ?');
    $rs_count->execute([$dte_hre,$table]);
    $count = $rs_count->fetch();

    switch($table){
        case 1 : $table_max = TABLE2; break;
        case 2 : $table_max = TABLE4; break;
        case 3 : $table_max = TABLE6; break;
        case 4 : $table_max = TABLE8; break;
    }

    if($count['count']< $table_max){ // si count est inferrieur à table maximun on enregistre la demande
        $ri = $conn->prepare('INSERT INTO `book` (`book_day`,`table`) VALUES (?,?)');
        if($ri->execute([$dte_hre,$table])){
            echo json_encode(true);
        } else{
            echo json_encode(false);
        }
    }else{
        echo json_encode(false);
    }



