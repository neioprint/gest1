<?php
// On démarre une session
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};
if  ($_SESSION['login']!="login"){
    $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
    header('Location: ../login.php');
    die;
}
// On inclut la connexion à la base
require_once('connectcommande.php');

$sql = 'SELECT * FROM `commande` LIMIT 100';

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
require_once('closecommande.php');
$json=json_encode($resultcommande);
//echo $monjson
echo "<pre>";
print_r($json);
echo "</pre>";

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
try{
    // Connexion à la base
    $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
//    $db = new PDO('mysql:dbname=globa932_demo01;host=localhost' , 'globa932_globa932', 'exp2581exp');
    $db->exec('SET NAMES "UTF8"');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e){
    echo 'Erreur :impossible de se connecter ';
    //$e->getMessage();
    die();
}

//$sql = "INSERT INTO `json` json VALUES ?";
$sql = "INSERT INTO `json` (`id`, `json`) VALUES (NULL,$json)";

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);

// On se déconnecte de la base
$db = null;
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

?>

