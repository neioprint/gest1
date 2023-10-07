<?php
session_start();
require_once('serveur.php');
$_SESSION['language']='AR';
// if (isset($_SESSION['language']) && !empty($_SESSION['language'])){
//     $language=
if ($_SESSION['language']=="FR") {
    define("LANGUE","🇩🇿");
    define("GEST","Gest'");
    define("IMPRIM","imprim");
    define("COMMANDE","commande");
    define("POINTAGE","Pointage");
    define("MESSAGE","Message");
    define("PRODUCTION","Production");
    define("RELEVE","Releve");
    define("CLIENT","Client");
    define("CLIENTS","Clients");
    define("UTILISATEUR","Utilisateur");
    define("SEDECONNECTER","Se déconnecter");
    define("ESPACE","Espace Client");
    define("AUTH",'Authentification reussie! <br> Bienvenue');
 

// العملاء
// إنتاج
// عميل
// مستخدم
//   منطقة العملاء 
    } else  
    if ($_SESSION['language']=="AR") {
    
        define("ESPACE","منطقة العملاء");
        define("LANGUE","🇫🇷");
        define("GEST","Gest'");
        define("IMPRIM","imprim");
        define("COMMANDE","الطلب");
    define("POINTAGE","دخول العمل");
    define("MESSAGE","رســالــــة");
    define("PRODUCTION","انــــتاج");
    define("RELEVE","كشف الدخول");
    define("CLIENT","عمــــــيل");
    define("CLIENTS","العملاء");
    define("UTILISATEUR","مســتـخدم");
    define("SEDECONNECTER","تسجيل الخروج");


    define('AUTH','تمت المصادقة بنجاح');

    // define("PRODUCTION","إنتاج");
    }

// echo $_SESSION['language'];
// echo "<br>";
// die();
try {
    // Connexion à la base
    if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

    if ($serveur == "serveurlws2") $db = new PDO('mysql:dbname=neiop2094987;host=91.216.107.186', 'neiop2094987', 'cB8@vyWKSsRp8Gd');
    //  cp2094915p03_globa2085215_1ilsts
    //pass lws2cB8@vyWKSsRp8Gd

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
        $_SESSION['user'] = $iduser;
        $_SESSION['login'] = $iduser['login'];
        $_SESSION['dates'] = ""; // initialisation de recherche date 
        $_SESSION['dates2'] = "";
        // echo "<pre>";
        // print_r($_SESSION['user']);
        // echo "</pre>";
        // echo "<br>";
        // print_r($iduser['etat']);
        // die(); 
        // تمت المصادقة بنجاح!
        // مرحبا
        $_SESSION['message'] =AUTH;
        // 'Authentification reussie! <br> Bienvenue ';

        //  . $iduser['login'] . "Connecté le " . date('Y-m-d') . " à " . date('H:i:s');
        $_SESSION['nom']=$iduser['login'] . " Connecté";
        $messages = 'Authentification reussie ' . $iduser['login'];

      
        $username = $login;
        $dateconn = date('Y-m-d') . ' à ' . date("H:i");
        $datedec = "Pas encore deconnecté";
        $query->bindValue(':dateconn', @$dateconn, PDO::PARAM_STR);
        $query->bindValue(':username', @$username, PDO::PARAM_STR);
        $query->bindValue(':datedec', @$datedec, PDO::PARAM_STR);
        $query->bindValue(':messages', @$messages, PDO::PARAM_STR);
        $query->execute();
        if ($iduser['role'] == "ADMIN" or $iduser['role'] == "ADMIN2") header("Location: ./indexcommande.php?recherche=&niveau=ins&language=$_SESSION[language]");
        else header("Location: ./indexcommandesimplifie.php?recherche=&niveau=ins&language=$_SESSION[language]");
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
