<?php

/**********
 * Script de connexion a l'application 
**********/

    session_start();
    require_once 'connect.php';

    $pseudo = strip_tags($_POST['pseudo']);
    $password = $_POST['pass'];

    // on recherche si le pseudo existe
    $rs_pseudo = $conn->prepare('SELECT COUNT(*) FROM `user` WHERE pseudo = ?');
    $rs_pseudo->execute([$pseudo]);
    $pseudoExist = $rs_pseudo->fetch();

    if($pseudoExist[0] == 1){

        $rs_user = $conn->prepare('SELECT 
                id_user id,
                name nom,
                first_name prenom,
                pseudo, 
                mail, 
                phone tel, 
                creation, 
                password, 
                actif,
                admin
            FROM user 
            WHERE pseudo = ?');
        $rs_user->execute([$pseudo]);
        $user = $rs_user->fetch();

        if(password_verify($password,$user['password'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['tel'] = $user['tel'];
            $_SESSION['creation'] = $user['creation'];
            $_SESSION['actif'] = $user['actif'];
            $_SESSION['admin'] = $user['admin'];

            header('Location:../blog.php');
            
        } else{
        }
    } else {
        header('location:../error-conn.php');
    }
?>