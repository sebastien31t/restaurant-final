<?php

    $cookies = intval($_POST['cookies']);

    if($cookies){
        setcookie('accept',1,0,'/','http://obierti.com');
        setcookie('langue','fr',0,'/','http://obierti.com');
    }else{
        setcookie('accept',0,0,'/','http://obierti.com');
    }
    echo $_COOKIE['accept'];
?>
