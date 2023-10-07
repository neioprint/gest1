<?php
session_start();
require_once('serveur.php');
try {
    // Connexion à la base
    if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
    if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die();
}
$sql = 'INSERT INTO 
    `historiqueconnexion` 
    (`dateconn`,`username`,`datedec`,`messages`) 
    VALUES 
    ( :dateconn,:username,:datedec,:messages);';

$query = $db->prepare($sql);

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$     
require_once('connexiondb.php');

$login = isset($_POST['login']) ? $_POST['login'] : "";

$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";

$requete = "select iduser,login,email,role,etat 
                from utilisateur where login='$login' 
                and pwd=MD5('$pwd')";

$resultat = $db->query($requete);

if ($iduser = $resultat->fetch()) {

    if ($iduser['etat'] == 1) {

        $_SESSION['login'] = $iduser['login'];
        // echo "<pre>";
        // print_r($_SESSION['user']);
        // echo "</pre>";
        // echo "<br>";
        // print_r($iduser['etat']);
        // die();   
        $_SESSION['message'] = "Authentification reussie! <br> Bienvenue \"" . $iduser['login'] . "\" Connecté le " . date('Y-m-d') . " à " . date('H:i:s');

        $messages = "Authentification reussie <br> Bienvenue " . $iduser['login'];
        //$_SESSION['message'];
        $username = $login;
        $dateconn = date('Y-m-d') . ' à ' . date("H:i");
        $datedec = "Pas encore connue";
        $query->bindValue(':dateconn', @$dateconn, PDO::PARAM_STR);
        $query->bindValue(':username', @$username, PDO::PARAM_STR);
        $query->bindValue(':datedec', @$datedec, PDO::PARAM_STR);
        $query->bindValue(':messages', @$messages, PDO::PARAM_STR);
        $query->execute();
        if ($iduser['role'] == "ADMIN") header('Location: ./indexcommande.php?recherche=&niveau=ins');
        else header('Location: ./indexcommandesimplifie.php?recherche=&niveau=ins');
        die();
    } else {

        $_SESSION['erreur'] = "<strong>Erreur!!</strong> Votre compte est désactivé.
            <br> Veuillez contacter l'administrateur";
        $_SESSION['login'] = $iduser['login'];
        $dateconn = date('Y-m-d') . ' à ' . date("H:i");
        $datedec = "Pas encore connue";
        $messages = "Compte désactivé";
        $username = $login;
        $query->bindValue(':dateconn', @$dateconn, PDO::PARAM_STR);
        $query->bindValue(':username', @$username, PDO::PARAM_STR);
        $query->bindValue(':datedec', @$datedec, PDO::PARAM_STR);
        $query->bindValue(':messages', @$messages, PDO::PARAM_STR);
        $query->execute();
        header('Location:login.php');
        die();
    }
} else {
    $_SESSION['erreur'] = "<strong>Erreur!!</strong> Login ou mot de passe incorrecte!!!";
    // $dateconn=date('Y-m-d').' à '. date("H:i");
    // $datedec="";
    // $messages=$_SESSION['erreur'];
    // $username=$iduser['login'];
    // $query->bindValue(':dateconn', @$dateconn, PDO::PARAM_STR);
    // $query->bindValue(':username', @$username, PDO::PARAM_STR);
    // $query->bindValue(':datedec', @$datedec, PDO::PARAM_STR);
    // $query->bindValue(':messages', @$messages, PDO::PARAM_STR);
    // $query->execute();
    header('Location:login.php');
    die();
}
