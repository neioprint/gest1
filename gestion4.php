<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
require_once('identifier.php');
require_once("connexiondb.php");
// if (isset($_SESSION['erreurLogin'])) {
//     $erreurLogin = $_SESSION['erreurLogin'];
//      header('Location: login.php');
//     }
// else {
//     $erreurLogin = "";
// }
// echo 'okokookok'.$erreurLogin;
//require_once('./role.php');
// if  (!isset($_SESSION['login'])){
//     $_SESSION['erreur'] = 'Veuillez vous connecter pour acceder au contenu'; 
//     header('Location: ../login.php');
//     die;
// }


// if(!empty($_SESSION['erreur'])){
//     echo '<div class="alert alert-danger alert-dismissible" role="alert">
//     <button type="button" class="close" data-dismiss="alert">&times;</button>
//             '. $_SESSION['erreur'].'</div>';
//     $_SESSION['erreur'] = '';
//  }

// if(!empty($_SESSION['message'])){
//     echo '<div class="alert alert-success alert-dismissible" role="alert">
//     <button type="button" class="close" data-dismiss="alert">&times;</button>
//             '. $_SESSION['message'].'</div>';
//     $_SESSION['message'] = '';
// }

ini_set("display_errors", 1);
date_default_timezone_set("Africa/Algiers");


error_reporting(-1);





?>
<!DOCTYPE html>
<html lang="fr">
<!-- le 1 juillet 2022 à tlemcen 
 dans cette version index4.js et gestion4.php et base4.php correction bug affichage des commandes par dates
 qui ne stocke pas dans le localstorage du fait d'un bug probazblement sur la festion dates anterieures
 actuctuelle et future de l'enregistrement des commandes -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- changement dans le head de index2.js et style2.css -->
    <link rel="icon" href="./images/logo.avif" type="image" />

    <link rel="stylesheet" href="./css/style41.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->


    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <title>Gestion Commandes ver4.0</title>
    <!-- < ?php
require('../head.php');
?> -->

</head>


<body>
    <?php require_once('./navbarok.php') ?>

    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

    <div class="entete margetop60">
        <img src="./images/logo.avif" alt="logo global2pub" width="100" height="auto">

        <h1 class="entete">Gestion <br> Commande</h1>
    </div>

    <div class="avatar">
        <img src="./images/banquier.png" alt="" width="200" height="auto">
    </div>

    <!-- <h2 class="entete">Menu</h2>    
    <a href="./indexcommande.php" class="btn btn-primary btn-block">Liste commandes</a>
    < ?php  if ($_SESSION['user']['role']=='ADMIN') { ?> 
    <a href="./formcommande.php" class="btn btn-success btn-block">Ajouter Commande</a>
    < ?php  }   ?>
    <a href="./trieclient.php" class="btn btn-primary btn-block">Liste commandes par client</a> 
    <a href="./index.php" class="btn btn-primary btn-block">Liste imprimés</a> 
    <a href="./indexclient.php" class="btn btn-primary btn-block">Liste clients</a>
   < ?php   if (isset($_SESSION['login'])) { ?>
   <a href="./deconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a>
  
  < ?php } ?>  -->

    <?php
    require_once('./menu.php')
    ?>
</body>

</html>