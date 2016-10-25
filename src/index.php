<?php
include "./ClubPremierSSO.class.php";
$login = $club_premier_sso->get_access_level() == 1 ? 'Logeado' : 'No logeado';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Test Clubpremier </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <p>Hola tu estas <?= $login?></p>
        <?php //if( $club_premier_sso->get_access_level() == 1 ): ?>
        <a href="https://member.clubpremier.info/salir">Salir</a>
        <?php //endif ?>
    </body>
</html>
