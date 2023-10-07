<?php
require_once('serveur.php');
try {
    if ($serveur=="local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
    
    if ($serveur=="distant")$db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59' , 'globa932_globa932', 'exp2581exp');

    if ($serveur=="serveur")$db = new PDO('mysql:dbname=globa932_demo01;host=localhost' , 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

    if ($serveur == "serveurlws2") $db = new PDO('mysql:dbname= cp2094915p03_globa2085215_1ilsts;host=localhost', 'cp2094915p03_admin', 'exp2581exp');
    //     Tr@mW0rk
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());

    //die('Erreur : impossible de se connecter à la base de donnée');
}
?>