<!-- < ?php
    session_start();
    require_once('serveur.php');
    try {
        // Connexion à la base
        if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
        if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
        if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
        $db->exec('SET NAMES "UTF8"');
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        die();
    } -->


<!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$      -->
<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
    // $trouve = 0;
    // $pass0 = 0;
    // unset($_SESSION['pass']);
    // echo "pass";
};
//$_SESSION['pass'] = 0;
// $refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
//                             $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// //echo $refreshButtonPressed;
// if ($refreshButtonPressed==1) die();
//echo $trouve;
if (!empty($_SESSION['erreur'])) {
    echo '<div class="alert alert-danger" role="alert" .alert-dismissible">' . $_SESSION['erreur'] . '
        </div>';
    $_SESSION['erreur'] = "";
}
if (!empty($_SESSION['message'])) {
    echo '<div class="alert alert-success" role="alert" .alert-dismissible">
            ' . $_SESSION['message'] . '</div>';
    $_SESSION['message'] = "";
}
$oui = isset($_GET['oui']) ? $_GET['oui'] : 0;
$pasdecookie = isset($_POST['pasdecookie']) ? $_POST['pasdecookie'] : 0;
// $erreur=isset($_GET['erreur']) ? $_GET['erreur'] : 0;
// echo "<br>";
// echo $pasdecookie;
// echo "<br>";
if ($pasdecookie==0) {
    if(!isset($_COOKIE['aleatoire']) && !isset($_COOKIE['login'])) {
        $_SESSION['erreur'] .= "Code à usage unique expiré.";
        header('Location:loginclient.php?cookie=0');
        die();   
                                                                    }
}
require_once('connectclient.php');

// $sql = "SELECT id,SUBSTRING(client,1,12) as client ,tel FROM `client`";
//$sql = "select * from client where id";

$sql = "select * from client";

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
require_once('closeclient.php');
//var_dump( $resultclient[0]['tel']);
//die();
// echo "<pre>";
// var_dump($resultclient);
// echo "</pre>";
// $trouve = 0;
// echo "<br>";
// print_r("login ".$_POST['login']);
// echo "<br>";
// print_r("sessionpass ".$_SESSION['pass']);
// echo "<br>";
// print_r("sessiontrouve ".@$_SESSION['trouve']);
// print_r($aleatoire);
// echo "<br>";
// echo "<pre>";
// print_r($_POST);
// echo "</pre";
if (isset($_POST['login']) && !empty($_POST['login'])) {
// echo "<pre>";
// print_r($_POST);
// echo "</pre";
// $aleatoire=strtolower(@$_POST['aleatoire']);
$aleatoire=strip_tags(@$_POST['aleatoire']);
$login=strip_tags($_POST['login']);
$login=strtolower($login);
//$pasdecookie=$_POST['pasdecookie'];
$pasdecookie=isset($_POST['pasdecookie']) ? $_POST['pasdecookie'] : 0;
    //echo "oui";
//echo $login;

    //echo $_SESSION['pass'];
    if (empty($_SESSION['pass'])) {
        $_SESSION['emailposte']=$login;
        foreach ($resultclient as $client) {
            //echo $client['email']."<br>";
            if ($client['email'] == $login && empty($_SESSION['trouve'])) {
                $clientok = $client['client'];

                $_SESSION['idclient'] = $client['id'];
                $_SESSION['client'] = $clientok;
                $_SESSION['email'] = $client['email'];
                // $trouve = 1;
                // 
                $_SESSION['trouve'] = 1;
            }
        }
                //echo "aleatoire " . @$aleatoire;
                //die();
              
              
                if(!isset($_COOKIE['aleatoire']) && !isset($_COOKIE['login'])&& $pasdecookie==1) {
                    //setcookie("user", "", time() - 3600);
                    setcookie('aleatoire', $aleatoire, time() + (300), "/"); // 86400 = 1 day
                    setcookie('login', $login, time() + (300), "/"); // 86400 = 1 day
                }
                $nombre=$aleatoire+327;
        $msg = "Mr $login votre code de securité à usage unique est: $nombre valide 5minutes.";
        $_SESSION['code'] = $aleatoire;



        $headers = 'FROM:  contact@global2pub.com';
        //print_r($_SESSION['email']);
        mail($login, "CODE DE SECURITE A USAGE UNIQUE VALIDE 5 mn", $msg, $headers);
                // die();
        //  header('Location:loginclient.php?cookie=1');
        //  die();   
        // echo "<br>";
        // echo $resultat;
           
      //  unset($_POST);



        // $pass0 = 1;
        // $_SESSION['pass'] = 1;
        //if (empty($aleatoire)) $aleatoire = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        //echo "<br><br>";
        
        // if ($_SESSION['email']==null) {
        //                                 // $_SESSION['message'].="Fiche client crée avec succée";
        //                                  header("Location:ficheclientdirect.php?email=$login&aleatoire=$aleatoire");
        //                                 //header("Location: seconnecterclient.php?email=$_POST[login]&aleatoire=$aleatoire");

        //                                 die();
        //                               }
        
       



        // header('Location:seconnecterclient.php');

        //}


        //header('Location:seconnecterclient.php');
        //} 

        // if (empty($_SESSION['trouve']) && isset($_POST['login']) && !empty($_POST['login'])){


        //     $_SESSION['erreur']="Votre e-mail n'est pas dans la base.  <br> vous êtes un nouveau client ";
        //     //$aleatoire=9999;
        //     $aleatoire=rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        //     $_SESSION['code']=$aleatoire;
        //     $_SESSION['email']=$_POST['login'];
        //     $headers = 'FROM:  contact@global2pub.com';


        //     mail($_SESSION['email'],"CODE DE SECURITE A USAGE UNIQUE",$msg,$headers);
        //       //header('Location:loginclient.php');
        //       //header('Location:nouveauclient.php');
        //       header('Location:commande/commande2.php');

        //       die();
        //
    }
} else
if (isset($_POST['pwd'])) {
    if ($cookie==1) {
        setcookie('aleatoire', 0, time() -3600, "/"); // 86400 = 1 day
        setcookie('login', 0, time() -3600, "/"); // 86400 = 1 day
        header('Location:loginclient.php');
        die();
    }
    if ($_POST['pwd'] == $_SESSION['code']+327) {
        $_SESSION['message'].="authentification reussie" . "<br>"."Bienvenu(e) sur votre espace client " . $_SESSION['client'] . "<br>";
        // echo "S'il s'agit d'une commande reguliere vous la trouverez dans le menu déroulant"."<br>";
        // echo "Sinon Demandez un devis ,n'oubliez pas de fournir les informations nécessaires"."<br>";
//setcookie("user", "", time() - 3600);
        setcookie('aleatoire', 0, time() -3600, "/"); // 86400 = 1 day
        setcookie('login', 0, time() -3600, "/"); // 86400 = 1 day
        
       // if ($_SESSION['email']==null) { 
        if (!$_SESSION['trouve']) { 
                                      $login=$_SESSION['emailposte'];

                                    header("Location:ficheclientdirect.php?email=$login");
                                    die();
                                        } else {
                                        header("Location:formclient.php?idclient=$_SESSION[idclient]&nomclient=$_SESSION[client]");
                                            die();
                                        }
    } else {
        if ($erreur==1) {
            $_SESSION['erreur'] .= "Code expire";
            setcookie('aleatoire', $aleatoire, time() -3600, "/"); // 86400 = 1 day
            setcookie('login', $login, time() -3600, "/"); // 86400 = 1 day
            header('Location:loginclient.php');
            die();
        } else {
        $_SESSION['erreur'] .= "Code erroné ,veuillez réintroduire le code";
        header('Location:seconnecterclient.php');
        die();
        }
    }
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <title>Se connecter</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style41.css">

</head>

<body>
    <!-- < ?php require_once('./navbarok.php') ?> -->

    <div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <img src='./images/banniere3.gif' width='100%' height='auto'>
        <!-- <img src="./images/logo.avif" alt="logo global2pub" width="150" height="auto"> -->
        <div class="panel panel-primary margetop60">
            <div class="panel-heading" >Se connecter</div>
            <div class="panel-body">


                <form method="post" action="" class="form">

                    <!-- < ?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        < ?php echo $erreurLogin ?>
                    </div>
                < ?php } ?> -->

                    <!-- <div class="form-group">
                    <label for="login">Votre E-mail</label>
                    <input type="email" name="login" placeholder="Votre e-mail que vous avez fournis." required
                           class="form-control" />
                </div> -->

                    <div class="form-group">
                        <label for="pwd" style="color:black">Code de sécurité</label>
                        <input type="password" name="pwd" required placeholder="Entrez le code de securité" class="form-control" required/>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Valider le code reçu
                    </button>
                    <a href="loginclient.php?erreur=1" class="btn btn-success">Reintroduire e-mail
                    </a>
                    <!-- <p class="text-right">
                    <a href="initialiserPwd.php">Mot de passe Oublié</a>

                    &nbsp &nbsp

                    <a href="nouvelUtilisateur.php">Créer un compte</a>
                </p> -->
                </form>
            </div>
        </div>
        <br>
        <img src='./images/etiq2.jpeg' width='100%' height='auto'>
    </div>
</body>

</HTML>