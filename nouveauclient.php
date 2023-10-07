<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
    $trouve = 0;
};
//echo "basxule";

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
die();
//$oui=isset($_GET['oui'])?$_GET['oui']:0;




// if (isset($_POST['login'])) {





//echo $client['email']."<br>";
// if ($client['email']==$_POST['login'] && !isset($_SESSION['trouve'])) {
//                                         $clientok=$client['client'];

//                                         $_SESSION['idclient']=$client['id'];
//                                         $_SESSION['client']=$clientok;
//                                         $_SESSION['email']=$client['email'];
//                                         // $_SESSION['prix']=$client['prix'];
//                                        //echo "email trouvé ".$client['email']."<br>";
//                                         //echo $trouve;
//                                         // if (!isset($_SESSION['trouve'])) 
//                                         $aleatoire=9999;
//                                         //rand(0,9).rand(0,9).rand(0,9).rand(0,9);
//                                         //echo "aleatoire".@$aleatoire;
//                                         $msg = "Mr $clientok votre code de securité à usage unique est: $aleatoire";
//                                         $_SESSION['code']=$aleatoire;
//                                         $trouve=1;
//                                         $_SESSION['trouve']=1;
//                                         //echo $_SESSION['trouve'];

//                                         $headers = 'FROM:  contact@global2-pub.com';


//                                         mail($_SESSION['email'],"CODE DE SECURITE A USAGE UNIQUE",$msg,$headers);



//                                         // header('Location:seconnecterclient.php');

//                                        }



// if ($trouve==0  && !isset($_SESSION['trouve'])){
//     $_SESSION['erreur']="Votre e-mail n'est pas dans la base probablement vous êtes nouveau";
//       //header('Location:loginclient.php');
//       header('Location:nouveauclient.php');
//         }   
// } else
if (isset($_POST['pwd'])) {
    if ($_POST['pwd'] == $_SESSION['code']) {
        echo "authentification reussie" . "<br>";
        //echo "bienvenu(e) sur votre espace client ".$_SESSION['client']."<br>";
        echo "Vous allez etre redirigé pour renseigner votre fiche client dans 5 secondes" . "<br>";
        //echo "S'il s'agit d'une commande reguliere vous la trouverez dans le menu déroulant"."<br>";
        // echo "Sinon Demandez un devis ,n'oubliez pas de fournir les informations nécessaires"."<br>";
        header("refresh:5;url=ficheclientdirect.php");
    } else {
        $_SESSION['erreur'] = "introduisez le code reçu";
        //header('Location:seconnecterclient.php');

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

</head>

<body>
    <?php require_once('./navbarok.php') ?>

    <div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <img src="./images/logo.avif" alt="logo global2pub" width="150" height="auto">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading">Se connecter :</div>
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
                        <label for="pwd">Code de sécurité :</label>
                        <input type="password" name="pwd" required placeholder="Entrez le code de securité" class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Introduire Le Code reçu sur votre e-mail!
                    </button>
                    <!-- <p class="text-right">
                    <a href="initialiserPwd.php">Mot de passe Oublié</a>

                    &nbsp &nbsp

                    <a href="nouvelUtilisateur.php">Créer un compte</a>
                </p> -->
                </form>
            </div>
        </div>
    </div>
</body>

</HTML>