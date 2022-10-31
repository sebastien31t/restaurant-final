<?php
    require "../config/connect.php";
    
    $dte = strip_tags($_POST['dte']);
    $hre = strip_tags($_POST['hre']);

    $book = $dte.' '.$hre.':00';
    $result = [];

    // requete de recherche de les nouveaux parametres.
    $rs_table = $conn->prepare('SELECT `table` ,COUNT(*) count 
        FROM `book` 
        WHERE `book_day` LIKE ?
        GROUP BY `table`');
    $rs_table->execute([$book]);

    foreach($rs_table as $i => $table){
        $result[$i] = [
            'id'=>$i,
            'book'=>$book,
            'table'=>$table['table'],
            'count'=>$table['count']
        ];
    }

    echo json_encode($result);
?>