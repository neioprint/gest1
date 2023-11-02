<?php
require_once "const.php";
//require 'vendor/autoload.php';
//require __DIR__.'/vendor/autoload.php';

// create a variable, which could be anything!

// $someVar="";
// dump($someVar);

// // dump() returns the passed value, so you can dump an object and keep using it
// dump($someObject)->someMethod();
$valeur = 0;
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//if ($tabsuivi2 != null) {

//}
function calculduree($etat, $tabsuivi1, $tabsuivi2)
{
  // if (2==2) okookokokokokokokokook
  // okokokokokokok
  if ($etat == 2) {
    // echo $tabsuivi0[0][0];
    // echo $etat;
    // echo "<br>";
    // echo $tabsuivi1;
    //$tabsuivi[0][1]="2023-09-21//13:32//houari//";
    // echo "<br>";
    // echo $tabsuivi2;
    // echo "<br>";
    // $debut = explode('à', $tabsuivi1);
    // $datedebut = $debut[0];
    // $heuredebut = explode('par', @$debut[1]);
    // $heuredebut = $heuredebut[0];
    // echo "<br>";
    // print_r($debut);
    // echo "<br>";
    // print_r($datedebut);
    // echo "<br>";
    // print_r($heuredebut);

    // echo "<br>";

    //$diff = 0;
    //opoopopopopopopopopopopopo
    // ok
    if ($tabsuivi2 != null) {
      $fin = explode('à', $tabsuivi2);
      //print_r($fin);
      $datefin = $fin[0];
      $heurefin = explode('par', @$fin[1]);
      $heurefin = $heurefin[0];
      // echo "<br>";
      // print_r(@$fin);
      // echo "<br>";
      // print_r(@$datefin);
      // echo "<br>";
      // print_r(@$heurefin);

      // echo "<br>";
      // echo "duree ";

      // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$



      $h2 = strtotime($heurefin);
      $h1 = strtotime($heuredebut);
      //$diff = $h2 - $h1;
      // print_r ($datedebut);echo "<br>";
      // print_r ($datefin);echo "<br>";
      $date1 = date_create($datedebut . " " . $heuredebut);
      //    die();
      //  print_r ($date1);echo "<br>";

      $date2 = date_create(@$datefin . " " . $heurefin);
      //     print_r( $date2);echo "<br>";
      $diff2 = date_diff($date1, $date2);
      //       echo "<pre>";
      // print_r($diff2);
      // echo "</pre>";
      //$GLOBALS['valeur']=$diff2->format("%a"); 
      //   echo "<pre>";
      //   echo($GLOBALS['valeur']." Jours ");
      //  echo "</pre>";
      //       $d2=date_create("2023-09-15");
      //       $d1=date_create("2023-09-16");








      // @$extractheure += date('H', $diff);
      // @$extractminute += date('i', $diff);
      // echo $diff." ".$extractheure." ".$extractminute;
      // echo "<br>";
      //$totaldiff=strtotime($totaldiff)+strtotime($diff);
      //$totaldiff=strtotime(date($totaldiff))+strtotime(date($diff)); 
    }

    return @$diff2;
  } else
    return 0;
}

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$






if (!empty($_SESSION['message'])) { ?>
  <!-- //  echo "<div class='alert alert-success alert-dismissible'>

    //  <button type='button' class='btn-close' data-dismiss='alert'>&times;</button>
    //          " . $_SESSION['message'] . "
    //      </div>";  -->
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <?= $_SESSION['message'] ?>
  </div>
  <?php
  $messageJson = json_encode($_SESSION['message']);
  //echo $messageJson;
  ?>
  <script>
    let message = JSON.parse('<?php echo $messageJson; ?>');
    travail(message)
  </script>
  <?php
  $_SESSION['message'] = "";
}

if (!empty($_SESSION['erreur'])) { ?>
  <!-- // echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    // <button type="button" class="btn-close" data-dismiss="alert">&times;</button>
    //         ' . $_SESSION['erreur'] . '
    //     </div>'; -->
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <?= $_SESSION['erreur'] ?>
  </div>
  <?php
  $messageJson = json_encode($_SESSION['erreur']);
  //  echo $messageJson;

  ?>
  <script>
    let message1 = JSON.parse('<?php echo $messageJson; ?>');
    probtravail(message1)
  </script>`;
  <?php
  $_SESSION['erreur'] = "";
}
$resultcommande = $_GET["id"];
$page = $_GET["page"];
$etat = $_GET["etat"];
$trieclientid = $_GET['idclient'];


//$variable = @$_GET["variable"];







require('connectcommande.php');



$sql = 'SELECT * FROM `commande` WHERE `id` = :resultcommande;';


$query = $db->prepare($sql);


$query->bindValue(':resultcommande', $resultcommande, PDO::PARAM_INT);


$query->execute();


$commande = $query->fetch();

// echo "<pre>";
// print_r($commande);
// echo "</pre>";
// print_r($page);
// print_r($_SESSION['user']['role']);
// lecture de la table imprime
require_once('./connect.php');

$sql = "SELECT * FROM `imprimes` WHERE `id`=$commande[idimprime]";

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif 
$result = $query->fetch(PDO::FETCH_ASSOC);
// echo "<br>";
// echo "<br>";
// echo "<br>";
// print_r($result);
// echo "<br>";
// echo "<br>";
require_once('./close.php');
// echo "<pre>";
// echo($result['etapes']);
// echo "</pre>";

// die()

// okokkokokokok


// if (isset($variable)) {
// echo $variable;
//  echo "<br>";
// // print_r($commande);
// $tabsuivi=unserialize($commande['etapesvalidee']);
//     // traitement du tableau
// //print_r($tabsuivi);
// if ($tabsuivi[$variable]<2) $tabsuivi[$variable]+=1;
// $tabsuivi=serialize($tabsuivi);
// $etapesvalidee=$tabsuivi;
// // trait
// require('connectcommande.php');
// $sql = 'UPDATE `commande` SET `etapesvalidee`=:etapesvalidee WHERE  `id`=:resultcommande;';



// // // $sql = 'UPDATE `imprimes` SET `imprime`=:imprime, `qteMin`=:qteMin WHERE `id`=:id;';
//  $query = $db->prepare($sql);
// // $etapesvalidee="";
//  $query->bindValue(':resultcommande', $resultcommande, PDO::PARAM_INT);
//  $query->bindValue(':etapesvalidee', $etapesvalidee, PDO::PARAM_STR);
// // // $query->bindValue(':idclient', $idclient, PDO::PARAM_STR);
// // // $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);
// // // $query->bindValue(':idimprime', $idimprime, PDO::PARAM_STR);
// // // $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
// // // $query->bindValue(':quantite', $quantite, PDO::PARAM_STR);
// // // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
// // // $query->bindValue(':prepress', $prepress, PDO::PARAM_STR);
// // // $query->bindValue(':total', $total, PDO::PARAM_STR);
// // // $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
// // // $query->bindValue(':tag', $tag, PDO::PARAM_INT);


// // //$query->bindValue(':solde', $solde, PDO::PARAM_INT);
// // // $query->bindValue(':etat', $etat, PDO::PARAM_STR);
// // // $query->bindValue(':etatseq', $etatseq, PDO::PARAM_STR);
// // // $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);

// $query->execute();

// // trait

// }
?>
<!DOCTYPE html>
<html lang="fr">
  <!-- <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <title>Action</title>
</head> -->

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
    <title>Action</title>
    <link rel="stylesheet" href="css/normalize.css">
    <!-- <script src="https://kit.fontawesome.com/6554078cc6.js" crossorigin="anonymous"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->
    <script src="./js/jquery-3.6.1.min.js"></script>
    <link rel="icon" href="./images/logo2.png" type="image" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="./css/styleloader.css"> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/style41.css">
  </head>

  <body>
    <!-- < ?php require_once "loadersvg.php"; ?> -->
    <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) '">Continuer</a> -->
    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    <div class="container">
      <?php include('./navbarok.php') ?>
      <!-- </div> -->
      <h2 class="entete">Suivi commandes et imprimés</h2>
      <h3 class="entete">
        <?= 'Le ' . $commande['dates'] . ' ' . $commande['nomclient'] . ' commande<br>' . $commande['quantite'] . ' ' . $commande['imprime'] ?>
      </h3>
      <!-- <p id="#variable"></p> -->
      <div class="container mt-3">
        <div class="d-grid gap-3">
          <div class="btn-group">
            <!-- <button class="btn btn-primary btn-lg btn-info" onclick="history.back()">Retour</button> -->
            <?php
            //print_r($_SESSION['user']['role']);
            if ($_SESSION['user']['role'] != 'ADMIN') { ?>
              <a class="btn btn-primary btn-lg btn-success" href="indexcommandesimplifie.php?niveau=ins">
                <i class='fa fa-undo' style='font-size:27px;color:black' aria-hidden='true'></i>
              </a>
            <?php } ?>
            <?php

            if ($_SESSION['user']['role'] == 'ADMIN') {
              // print_r($_SESSION['user']['role']);
              ?>
              <a class="btn btn-primary btn-lg btn-success" href="indexcommande.php?niveau=<?= @$_SESSION['niveau'] ?>">
                <i class='fa fa-undo' style='font-size:27px;color:black' aria-hidden='true'></i>
              </a>
              <a class="btn btn-primary btn-lg btn-success"
                href="./detailscommande.php?id=<?= $resultcommande ?>&page=<?= $page ?>">
                <i class='fa fa-desktop' style='font-size:27px;color:black' aria-hidden='true'></i></a>
              <a class="btn btn-primary btn-lg" href="./editcommande.php?id=<?= $resultcommande ?>&page=<?= $page ?>">
                <i class='fa fa-pencil-square-o' style='font-size:27px;color:black' aria-hidden='true'></i>
              </a>
              <a class="btn btn-primary btn-lg btn-warning"
                href="./deletecommande.php?id=<?= $resultcommande ?>&page=<?= $page ?>">
                <i class='fa fa-trash' style='font-size:27px;color:black' aria-hidden='true'></i>
              </a>
              <a class="btn btn-primary btn-lg btn-info"
                href="./etatcommande.php?id=<?= $resultcommande ?>&page=<?= $page ?>">
                <i class='fa fa-desktop' style='font-size:27px;color:black' aria-hidden='true'></i>
                <i class='fa fa-address-card' style='font-size:27px;color:black' aria-hidden='true'></i></a>
              <a class="btn btn-primary btn-lg btn-info"
                href="./editetatcommande.php?id=<?= $resultcommande ?>&page=<?= $page ?>">
                <i class='fa fa-pencil-square-o' style='font-size:27px;color:black' aria-hidden='true'></i>
                <i class='fa fa-address-card' style='font-size:27px;color:black' aria-hidden='true'></i>
              </a>
              <a class="btn btn-primary btn-lg btn-danger"
                href="./tagger.php?id=<?= $resultcommande ?>&suite=9&page=<?= $page ?>">
                <i class='fa fa-tag' style='font-size:27px;color:black' aria-hidden='true'></i>
              </a>
            <?php } ?>
          </div>
          <?php $etatsuivi = $etat;

          $etatsuivi = explode("/", $etatsuivi);
          $etatsuivi = $etatsuivi[0];
          ?>
          <!-- //     print_r($etatsuivi);
            //    die(); -->
          <!-- <a class="btn btn-primary btn-lg btn-success" > Etape Suivante </a> -->
          <!-- <button class="button1">Etape Suivante</button> -->
          <!-- <i class="fa fa-arrow-right" style='font-size:27px;color:red' aria-hidden="true"></i>    -->
          <!-- <a class="btn btn-primary btn-lg btn-success" href="indexcommande.php?niveau=< ?=@$_SESSION['niveau']?>">
            <i class='fa fa-undo' style='font-size:27px;color:black'  aria-hidden='true'></i>
            </a> -->
          <?php

          if ($etatsuivi == 0) { ?>
            <!-- <a class="btn btn-primary btn-lg btn-success" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Debuter commande</a> -->
            <!-- <a class="button1 btn btn-primary btn-lg btn-success" href="./terminercommande.php?id=< ?= $resultcommande ?>&suite=9&page=< ?= $page ?>">Debuter commande</a> -->
            <a class="button 1 btn btn-primary btn-lg btn-success" onclick="confirmer(0)">Debuter commande</a>
          <?php } ?>
          <?php if ($etatsuivi == 1) {

            ?>
            <a class="button 1 btn btn-primary btn-lg btn-danger" onclick="confirmer(1)">Terminer</a>
            <a class="button 1 btn btn-primary btn-lg btn-info" onclick="confirmer(11)">Terminer Partiellement</a>
          <?php } ?>
          <!-- < ?php if ($etatsuivi == 10) { 
       
                ?>
                <a class="button1 btn btn-primary btn-lg btn-danger btn-block" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Terminer coupe</a>

            < ?php } ?> -->
          <!-- < ?php if ($etatsuivi == 11) { 
       
                ?>
                <a class="button1 btn btn-primary btn-lg btn-danger btn-block" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Terminer impression</a>
                
            < ?php } ?> -->
          <!-- < ?php if ($etatsuivi == 12) { 
       
       ?>
       <a class="button1 btn btn-primary btn-lg btn-danger btn-block" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Terminer commande</a>
       
   < ?php } ?> -->
          <?php if ($etatsuivi == 2) { ?>
            <!-- <a class="btn btn-primary btn-lg btn-danger" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Livrer commande</a> -->
            <a class="button 1 btn btn-primary btn-lg btn-danger btn-block" onclick="confirmer(2)">Livrer commande</a>
          <?php } ?>
          <?php if ($etatsuivi == 11) { ?>
            <!-- <a class="btn btn-primary btn-lg btn-danger" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Livrer commande</a> -->
            <a class="button 1 btn btn-primary btn-lg btn-danger btn-block" onclick="confirmer(12)">Livrer commande
              Partielle</a>
            <a class="button 1 btn btn-primary btn-lg btn-danger btn-block" onclick="confirmer(17)">Reprise</a>
          <?php } ?>
          <?php if ($etatsuivi == 12) { ?>
            <!-- <a class="btn btn-primary btn-lg btn-danger" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Livrer commande</a> -->
            <a class="button 1 btn btn-primary btn-lg btn-danger btn-block" onclick="confirmer(17)">Reprise</a>
          <?php } ?>
          <?php if ($etatsuivi == 3) { ?>
            <!-- <a class="btn btn-primary btn-lg btn-danger" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Archiver commande</a> -->
            <a class="button 1 btn btn-primary btn-lg btn-danger btn-block" onclick="confirmer(3)">Archiver commande</a>
          <?php } ?>
          <?php if ($etatsuivi == 6) { ?>
            <!-- <a class="btn btn-primary btn-lg btn-danger" href="./terminercommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>&etat=< ?= $etatsuivi?>">Mise En attente</a> -->
            <a class="button 1 btn btn-primary btn-lg btn-danger btn-block" onclick="confirmer(6)">Mise En attente</a>
          <?php } ?>
        </div>
      </div>
      <br>
      <!-- debut $$$$$$ partie traitement des etapes depuis la base -->
      <?php


      $typ = @$result['typ'];
      $chaine = @$result['etapes'];
      $chainedecoupe = explode(",", $chaine);
      $typdecoupe = explode(",", $typ);
      $compt = count($chainedecoupe);
      $compt0 = count($typdecoupe);
      //print_r($commande['etapesvalidee']);
      // $tabsuivi=[];
      //$tabsuivi=
      //array(0,0,0,0,0);
      
      if ($commande['etapesvalidee'] != null)
        $tabsuivi = unserialize($commande['etapesvalidee']);
      print_r(count(@$tabsuivi));
      echo "<pre>";
      print_r($tabsuivi);
      //dump($someObject)->someMethod();
      echo "</pre>";

      //echo $_SERVER['HTTP_REFERER'];
      

      // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
      //echo count($tabsuivi);
      $dim = count($tabsuivi) - 1;
      //if ($etatsuivi==12) $dim=1;
      $totaldureejour = 0;
      $totaldureeminute = 0;
      $totaldureeheure = 0;

      //echo $etatsuivi;
      //$totalvaleur=0;
      for ($i = 0; $i < $compt; $i++) {


        if (@$tabsuivi[$dim][$i][0] == 2) {
          $inter = @calculduree(@$tabsuivi[$dim][$i][0], @$tabsuivi[$dim][$i][1], @$tabsuivi[$dim][$i][2]);
          //echo "$chainedecoupe[$i] à durée $valeur jours ".date("H:i",$duree)."Mn<br>";
          //echo @$chainedecoupe[$i]." Duree jour ".@$inter->d." heure ".@$inter->h. " min ".@$inter->i;
      
          //$totalduree+=$duree;
          //@$totalvaleur+=@$valeur;
          // $jours=0;
          // $minutes=0;
          // $heures=0;
          if (@$inter->d > 0)
            $jours = $inter->d;
          if (@$inter->h > 0)
            $heures = $inter->h;
          if (@$inter->i > 0)
            $minutes = $inter->i;


          @$totaldureejour += $jours;
          @$totaldureeheure += $heures;
          @$totaldureeminute += $minutes;
        } else if (@$tabsuivi[$dim][$i][0] == 2 && @$tabsuivi[$dim][$i][2] == "") {
          echo "erreur <br>";
          $_SESSION['erreur'] .= "Erreur calcul duree commande";
        }
      }
      //  print_r($totaldureejour);echo "<br>";
      //  print_r($totaldureeheure);echo "<br>";
      //  print_r($totaldureeminute);echo "<br>";
      

      // date("H:i", @$diff);
      // echo "<br>";
      // echo $diff2->format("%R%a Jours");
      // //die()
      
      // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
      


      // echo "<br>";echo "<br>";
      echo "<br>";
      // if ($totalvaleur!=0 or  $totalduree!=0) { ? >
      if (0 == 0) { ?>
        <!-- echo @$totalvaleur." jours et ".date("H:i",@$totalduree)."<br>"; ? > -->
        <div class="d-grid gap-3 container">
          <a class="btn btn-lg btn-info btn-block">
            <?php
            $chaineaff = "";
            if ($totaldureejour > 0)
              $chaineaff .= $totaldureejour . " jours ";
            if ($totaldureeheure > 0)
              $chaineaff .= $totaldureeheure . " heures ";
            if ($totaldureeminute > 0)
              $chaineaff .= $totaldureeminute . " minutes ";
            @$affichage = " Duree totale=" . $chaineaff;

            echo $affichage;

            ?>
          </a>
        </div>
      <?php }
      //  echo $totalvaleur;
      // $tabsuivi=array(0,0,0,0,0,0,0,0);
      // $tabsuivi=serialize($tabsuivi);
      // print_r($tabsuivi);
      //echo "<br>";
      //print_r($tabsuivi);
      //$chainedecoupe;
      // for ($i=0; $i <$compt ; $i++) { 
      //     $tabsuivi[$i]=0;
      // }
      //print_r($tabsuivi);
      // echo "<br>";
      
      // echo $compt;
      // echo "<br>";
      // // echo $compt0;
      // // echo "<br>";
      
      // print_r($chaine);
      // echo "<br>";
      //print_r($chainedecoupe);
      // echo "<br>";
      

      // print_r($typ);
      // echo "<br>";
      
      // print_r($typdecoupe);
      // echo "<br>";
      
      //die();
      
      // if ($etatsuivi == 1 or $etatsuivi == 3) {
      if ($etatsuivi != 0 && $etatsuivi != 6) {
        //$messageJson=[];
        for ($i = 0; $i < $compt; $i++) {


          //echo $messageJson;
          ?>
          <div class="container mt-3">
            <div class="d-grid gap-3">
              <?php
              // if (!$tabsuivi) {
              //   $tabsuivi = [[]];
              //   //$chainedecoupe;
              //   for ($i = 0; $i < $compt; $i++) {
              //     $tabsuivi[$i][0] = 0;
              //     $tabsuivi[$i][1] = "";
              //     $tabsuivi[$i][2] = "";
              //   }
          


              // }
          
              //array(0,0,0,0,0,0,0,0);
              if (@$tabsuivi[$dim][$i][0] == 0)
                $bouton = 'btn-danger';
              else if (@$tabsuivi[$dim][$i][0] == 1)
                $bouton = 'btn-warning';
              else
                $bouton = 'btn-success';
              ?>
              <!-- <a  class="btn btn-lg btn-primary btn-block">< ?="Debut ".@$tabsuivi[$i][1]." Fin ".@$tabsuivi[$i][2]?>
                        </a> -->
              <a id="etat<?= $i ?>" class="btn btn-lg <?= $bouton ?> btn-block"
                onclick="togglestate(<?= $i ?>,'<?= $chainedecoupe[$i] ?>',<?= $tabsuivi[$dim][$i][0] ?>,<?= $resultcommande ?>)">
                <?php
                if (@$tabsuivi[$dim][$i][0] == 2) {
                  @$inter = @calculduree(@$tabsuivi[$dim][$i][0], @$tabsuivi[$dim][$i][1], @$tabsuivi[$dim][$i][2]);
                  $chaineaff = "";

                  if (@$inter->d > 0)
                    $chaineaff .= $inter->d . " jours ";
                  if (@$inter->h > 0)
                    $chaineaff .= $inter->h . " heures ";
                  if (@$inter->i > 0)
                    $chaineaff .= $inter->i . " minutes ";
                  if (@$inter->d == 0 && @$inter->h == 0 && @$inter->i == 0) {

                    $affichage = "";
                    echo @$chainedecoupe[$i];
                  } else {
                    $affichage = "Du " . @$chainedecoupe[$i] . " Duree=" . $chaineaff;
                    echo $affichage;
                  }
                  //.@$inter->d."jour ".@$inter->h." heure ".@$inter->h.  @$inter->i." min";
            
                } else {
                  $inter = "";
                  echo @$chainedecoupe[$i];
                }
                //  if (date('H:i',$inter)!="00:00")
            
                //  echo @$chainedecoupe[$i]." Duree ".@date('H:i',$inter)." mn";
                // else   echo @$chainedecoupe[$i];
            
                ?>
              </a>
              <!-- date("H:i",$duree) -->
            </div>
          </div>
        <?php } ?>
        <br><br>
      <?php }

      ?>
      <div class="container mt-3">
        <div class="d-grid gap-3">
          <a class="btn  btn-primary btn-lg btn-danger">
            <?= $typdecoupe[0] ?>
          </a>
          <!-- <i class="fa fa-arrow-right" style='font-size:30px;color:red' aria-hidden="true"></i> -->
          <?php for ($i = 1; $i < $compt0; $i++) { ?>
            <a class="btn btn-primary btn-lg btn-prymary">
              <?= $typdecoupe[$i] ?>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
    <script>
      function togglestate(variable, message, tableau, id) {
        //console.log('varaible'+variable);
        //document.cookie = "variable="+variable;
        //console.log(tableau);
        //console.log(id);
        let state0 = document.getElementById("etat" + variable);
        // let classe0=document.getElementsByClassName("btn-danger");
        let element0 = state0.classList;

        //console.log(message);
        // if (tableau==1) {

        //                 element0.remove("btn-danger");
        //                 element0.add("btn-warning");

        //                 state0.innerHTML=message+" en cours";
        //                         }

        // confirmation de l'operation

        if (tableau < 2) {
          Swal.fire({
            title: `Confirmation?`,
            text: "Etes vous sûr?",

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuer!',
            cancelButtonText: 'Annuler!',
            width: '24em'
          }).then((result) => {


            if (result.isConfirmed) {
              if (tableau < 2) {
                if (element0.contains("btn-warning")) {
                  element0.remove("btn-warning");
                  element0.add("btn-success");
                  state0.innerHTML = message + " terminé";
                  if (tableau < 2) {
                    tableau += 1;
                    // jQuery(document).ready(function() 
                    //         {
                    $.post('acce_table_jquery.php', {
                      variable: variable,
                      tableau: tableau,
                      id: id
                    }


                      ,
                      // Ci-dessous c'est le traitement de la réponse
                      function (reponse) {

                        // Analyse et récupération du tableau de données transmis par le serveur
                        var data = JSON.parse(reponse);
                        console.log(data);
                        tableau = data.tableau;
                        variable = data.variable;
                        id = data.id;
                        //if (tableau=2) togglestate(variable,message,tableau,id)
                        // On place les données dans le tableau HTML
                        //$('#annee').text(data.annee);        
                        //console.log(data);
                        //$('#variable').text(data.variable);



                      });
                  }; //fin du tes if
                  // < ?php header("location:./"); ?>// vers la page courante
                  //window.location.href="action2ok.php?variable="+variable+"&id="+< ?= $resultcommande ?>+"&page="+< ?=$page?>+"&etat="+< ?=$etat?>+"&idclient="+< ?=$trieclientid?>;
                  // a:4:{i:0;a:3:{i:0;i:2;i:1;s:27:"2023-09-16 à 09:48 par sid";i:2;s:27:"2023-09-15 à 22:53 par sid";}i:1;a:3:{i:0;i:2;i:1;s:27:"2023-09-16 à 09:48 par sid";i:2;s:27:"2023-09-15 à 22:59 par sid";}i:2;a:3:{i:0;i:2;i:1;s:27:"2023-09-16 à 09:59 par sid";i:2;s:27:"2023-09-16 à 09:59 par sid";}i:3;a:3:{i:0;i:2;i:1;s:27:"2023-09-16 à 10:01 par sid";i:2;s:0:"";}}                                        


                }

                if (element0.contains("btn-danger")) {
                  element0.remove("btn-danger");
                  element0.add("btn-warning");

                  state0.innerHTML = message + " en cours";

                  if (tableau < 2) {
                    tableau += 1;
                    // jQuery(document).ready(function() 
                    //         {
                    $.post('acce_table_jquery.php', {
                      variable: variable,
                      tableau: tableau,
                      id: id
                    }


                      ,
                      // Ci-dessous c'est le traitement de la réponse
                      function (reponse) {

                        // Analyse et récupération du tableau de données transmis par le serveur
                        var data = JSON.parse(reponse);
                        console.log(data);
                        tableau = data.tableau;
                        variable = data.variable;
                        id = data.id;
                        //if (tableau=2) togglestate(variable,message,tableau,id)
                        // On place les données dans le tableau HTML
                        //$('#annee').text(data.annee);        

                        //$('#variable').text(data.variable);



                      });
                  }; //fin du tes if
                }
                // < ?php header("location:./"); ?>// vers la page courante
                //window.location.href="action2ok.php?variable="+variable+"&id="+< ?= $resultcommande ?>+"&page="+< ?=$page?>+"&etat="+< ?=$etat?>+"&idclient="+< ?=$trieclientid?>;

                //die();
              } //test tableau
              // });









            } // fin is confirmedresult


          }) // fin is result


        } else {

          //   Swal.fire({
          //   icon: 'error',
          //   title: 'Etape Terminée'
          //window.location.href="action2ok.php?variable="+variable+"&id="+< ?= $resultcommande ?>+< ?=$etat?>+"&idclient="+< ?=$trieclientid?>;


          // })

        }
      } //console.log(tableau);
    </script>
    <!-- fin $$$$$$ partie traitement des etapes depuis la base -->
    <script>
      function confirmer(etat) {
        //console.log(etat);
        // mavar=document.getElementById(j).innerHTML;

        // j=0;
        // nom="sido";
        // versement="5000" ;      
        Swal.fire({
          title: `<strong>Confirmer</strong>`,
          showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
          //   text: "Versement",
          icon: 'success',
          html: `
   
   <h4>Action </h4>
  `,
          footer: "Operation  irréversible",
          backdrop: true,
          heightAuto: false,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok',
          cancelButtonText: 'Annuler',
          width: '42em',

          //  height: '42em',
          showCloseButton: true
        }).then((result) => {



          if (result.isConfirmed) {

            //     Swal.fire(
            //       'Supprimé',
            //       'Votre fiche à eté supprimé.',
            //       'success'
            //     ).then((result) => {
            document.location.href = './terminercommande.php?id=' + '<?= $resultcommande ?>' + '&suite=' + etat + '&page=' + <?= $page ?>;


            //     })


          }
        })
      }
    </script>
    <br><br>
    <!-- <div class="card">
  <div class="card-body">Basic card</div> -->
    <?php
    //echo $commande['images'];
    if ($commande['images'] != "") {
      $extension = substr($commande['images'], strrpos($commande['images'], "."));
      if ($extension != ".pdf") {
        echo '<div class="container">';

        echo '<img src="' . 'uploads/' . $commande['images'] . '"  width="350px" height="auto" class="circle mx-auto d-block">';

        echo '</div>';
      }
    }

    ?>
    </div>
    </div>
    </div>
    <!-- <script src="./js/script.js"></script> -->
  </body>

</html>