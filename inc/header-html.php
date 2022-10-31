<?php
    require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Decription -->
    <meta name="description" content="Site gastronomique de la maison Outlet situé a Toulouse,Découvrez nos recettes dans le blog !">
    <meta name="keywords" content=" maison Outlet gastronoomie Toulouse">

    <!-- CSS -->
    <!-- <link rel="stylesheet" href="lib/css/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="lib/node_modules/trumbowyg/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="style.css">

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script defer src="lib/node_modules/trumbowyg/dist/trumbowyg.min.js"></script>
    <script defer src="lib/node_modules/trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script defer src="script.js"></script>
    <script defer src="reservations.js"></script>

    <link rel="icon" href="img/fav/favicon-32x32.png" />
    <title>Outlet</title>

</head>
<body>
    <header>
        <?php
            if(empty($_COOKIE['accept'])): ?>
                <section id="cookies">
                    <div class="d-flex justify-content-center align-items-center" id="cookies-content">
                        <div class="row">
                            <div class="col-12"><h2 class="text-align-center">Acceptation des cookies<h2></div>
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-success mx-2" id="accept">Accepter</button>
                                <button class="btn btn-danger mx-2" id="reject">Rejeter</button>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif ?>
        <section class="d-flex justify-content-center align-items-center">
        <div class="encadre">
            <h1>Outlet</h1>
            <hr>
            <h2>Maison gastronomique</h2>
        </div>
        </section>
    <?php require_once 'inc/nav.php';?>
    </header>
