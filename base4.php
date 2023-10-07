<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
//  le 1 juillet 2022 à tlemcen 
// dans cette version index4.js et gestion4.php et base4.php correction bug affichage des commandes par dates
// qui ne stocke pas dazns le localstorazge du fait d'un bug probazblement sur la festion dates anterieures
// actuctuelle et future de l'enregistrement des commandes
// On démarre une session

// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// On inclut la connexion à la table imprime
require_once('./connect.php');

$sql = 'SELECT * FROM `imprimes`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif 
$result = $query->fetchAll(PDO::FETCH_ASSOC);


require_once('./close.php');
// var_dump($result); 




// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// connexion base client

// On inclut la connexion à la table client client
require('./connectclient.php');

//$sql = 'SELECT * FROM `client` order by client asc';
$sql = 'SELECT * FROM `client`';
// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);


require_once('./closeclient.php');


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// connexion base commandes clients
