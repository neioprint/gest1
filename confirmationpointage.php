<?php
require_once "const.php";



$salarie = $_SESSION['user']['login'];
$pointages = isset($_GET['pointage']) ? $_GET['pointage'] : "";
if ($pointages != "") {
  $datepointage = date('Y-m-d');
  $heurepointage = date("H:i");
  date_default_timezone_set("Africa/Algiers");
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  // lecture du pointage en fonction de la date et des etats antecedents
  // si 1ere pointage de la journee c'est une entree matinale
  // si c'est un deuxieme pointage c'est une sortie dejeuner
  // si troisieme pointage c'est ube entree apres midi
  // si 4eme  pointage c'est une sortie fin de travail
  // si Seulement Deux pointage alors 1 entree matinale et une sortie fin de travail



  require('./connectpointage.php');
  // echo $datepointage;
  // echo $salarie;
  $sql = "select * from pointage where  dates='$datepointage' and salarie='$salarie'";

  //$sql = 'SELECT * FROM `pointage` WHERE `dates` = :datepointage;';


  $query = $db->prepare($sql);


  // $query->bindValue(':datepointage', $datepointage, PDO::PARAM_STR);
  // $query->bindValue(':salarie', $salarie, PDO::PARAM_STR);

  // On exécute la requête
  $query->execute();

  // On récupère le produit
  $pointage = $query->fetch();
  //echo gettype($pointage);
  // On vérifie si le produit existe
  // if(!$pointage){
  //     $_SESSION['erreur'] = "Cet id n'existe pas";
  //    // header('Location: indexcommande.php?recherche=&niveau=');
  // }
  // echo "<pre>";
  // var_dump($pointage);
  // echo "</pre>";
  //die();
  //require('./close.php');
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  // insertion du pointage en fonction de l'heure et la date et l'entree et sortie
  require('./connectpointage.php');
  $dates = $datepointage;
  $salarie = $_SESSION['user']['login'];
  //$pauses="";
  // if ($pointage['pauses']=="") 
  $pauses = getIp();
  //else $pauses=getIp()."//".$pointage['pauses'];

  $entree1 = "";
  $entree2 = "";
  $sortie1 = "";
  $sortie2 = "";
  // echo count($pointage);
  //die();
  // if ($pointage['entree2']=="" && $pointage['entree1']=="" &&$pointage['sortie1']=="" )
  $msg = "de " . $salarie . " le " . $dates . " à " . $heurepointage;


  $headers = 'FROM:  contact@global2-pub.com';

  mail("pointageneio@gmail.com", "Pointage ", $msg, $headers);
  if ($pointage == false) {
    // echo "vide";
    if ($pointages == 1) $entree1 = $heurepointage;
    if ($pointages == 3) $entree2 = $heurepointage;
    $sql = 'INSERT INTO `pointage` 
        (`dates`, `salarie`, `pauses`, `entree1`, `sortie1`, `entree2`, `sortie2`) 
        VALUES (:dates,:salarie,:pauses,:entree1,:sortie1,:entree2,
        :sortie2);';
    $query = $db->prepare($sql);

    $query->bindValue(':dates', $dates, PDO::PARAM_STR);
    $query->bindValue(':salarie', $salarie, PDO::PARAM_STR);
    $query->bindValue(':pauses', $pauses, PDO::PARAM_STR);
    $query->bindValue(':entree1', $entree1, PDO::PARAM_STR);
    $query->bindValue(':sortie1', $sortie1, PDO::PARAM_STR);
    $query->bindValue(':entree2', $entree2, PDO::PARAM_STR);
    $query->bindValue(':sortie2', $sortie2, PDO::PARAM_STR);


    // $query->bindValue(':papmointageiement', $images, PDO::PARAM_STR);
    $query->execute();
    //      print_r($query);
    // $_SESSION['message'] .= "Pointage avec succée"."<br>";
    // if ($pointage==2) $sortie1=$heurepointage;
    // if ($pointages==3) $entree2=$heurepointage;
    // if ($pointage==4) $sortie2=$heurepointage;
  } else {
    $id = $pointage['id'];
    // $sql = 'UPDATE `commande` SET `dates`=:dates WHERE  `id`=:id;';
    if ($pointage['entree1'] != "" && $pointage['sortie2'] != "") $pointages = 0;
    if ($pointages == 2 && $pointage['sortie1'] == "") {
      $sortie1 = $heurepointage;
      $sql = "UPDATE `pointage` SET `sortie1`='$sortie1',`pauses`='$pointage[pauses]//$pauses' WHERE  `id`='$id';";
    }
    if ($pointages == 3 && $pointage['entree2'] == "") {
      $entree2 = $heurepointage;
      $sql = "UPDATE `pointage` SET `entree2`='$entree2',`pauses`='$pointage[pauses]//$pauses' WHERE  `id`='$id';";
    }
    if ($pointages == 4 && $pointage['sortie2'] == "") {
      $sortie2 = $heurepointage;
      $sql = "UPDATE `pointage` SET `sortie2`='$sortie2',`pauses`='$pointage[pauses]//$pauses' WHERE  `id`='$id';";
    }
    if ($pointages != 0) {
      $query = $db->prepare($sql);
      $query->execute();
    }
  }




  require('./close.php');
  $_SESSION['message'] .= "Pointage avec succée" . "<br>";

  if ($_SESSION['user']['role'] == 'ADMIN') {

    header('Location: ./indexcommande.php?');
  } else header('Location: ./indexcommandesimplifie.php?niveau=ins');
} else {
  $_SESSION['erreur'] .= "Erreur Pointage impossible " . "<br>";
  header('Location: ./confirmationpointage.php?');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./images/logo.avif" type="image" />
  <link rel="stylesheet" href="./css/style41.css">
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="./css/monstyle.css">

  <link rel="stylesheet" href="./css/styleloader.css">

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Pointage journalier</title>
</head>

<body>
<div class="loader-container">
        <div class="loader">
          
        </div>
</div>
  <?php include('./navbarok.php') ?>
  <h2 class="entete center">Pointage Journalier</h2>

  <br><br><br>

  <button class="btn btn-primary btn-lg btn-info" onclick="history.back()">Retour</button>
  <script src="./js/script.js"></script>
</body>

</html>