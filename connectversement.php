<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
//require_once('role.php');
require_once('serveur.php');
try{
    // Connexion à la base
    if ($serveur=="local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
    if ($serveur=="distant")$db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59' , 'globa932_globa932', 'exp2581exp');
    if ($serveur=="serveur")$db = new PDO('mysql:dbname=globa932_demo01;host=localhost' , 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}