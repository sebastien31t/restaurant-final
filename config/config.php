<?php
    
    // constante base de données
    define('DATABASE','mysql:host=localhost;dbname=db_outlet');
    define('USER','*****');
    define('PASS','************');
    define('ADDRESS_SITE','obierti.com/restaurant');

    // constante configuration de mail
    define('SMTP','mail.gandi.net');
    define('MAIL','outlet@obierti.com');
    define('PASS_MAIL','*********');

    // Nombre de table
    define('TABLE2',6);
    define('TABLE4',5);
    define('TABLE6',5);
    define('TABLE8',2);

    // valeur par deffaut page réservation
    define('DATE_DEFF',date('Y-m-d'));
    define('HEURE_DEFF','20:00');

    // Table select est la valeur par deffaut pour les tables
    define('TABLE_2_SELECT',1);
    define('TABLE_4_SELECT',2);
    define('TABLE_6_SELECT',3);
    define('TABLE_8_SELECT',4);

    // Taille maximale pour téléchargement de photo en octet
    define('MAX_PHOTO_SIZE',5242880);