<?php
require_once "const.php";

$datepointage = date('Y-m-d');
$heurepointage = date("H:i");
$salarie = $_SESSION['user']['login'];
require('./connectpointage.php');
//  echo $datepointage;
//  echo $salarie;
$sql = "select * from pointage where  dates='$datepointage' and salarie='$salarie'";

//$sql = 'SELECT * FROM `pointage` WHERE `dates` = :datepointage;';


$query = $db->prepare($sql);


// $query->bindValue(':datepointage', $datepointage, PDO::PARAM_STR);
// $query->bindValue(':salarie', $salarie, PDO::PARAM_STR);

// On exécute la requête
$query->execute();

// On récupère le produit
$pointage = $query->fetch();
//var_dump($pointage);
// if ($pointage==false)echo "vide";
// echo "<pre>";
// print_r($pointage);
// echo "</pre>";
// if ($heurepointage<date("12:15")) echo "avant midi"."<br>"; else echo "aprés midi"."<br>";
// echo $datepointage;
// echo "<br>";
// echo $heurepointage;
// echo "<br>";

//session_start();
//$resultcommande = $_GET["id"];
//$page = $_GET["page"];
//$etat = $_GET["etat"];
//$trieclientid = $_GET['idclient'];

// require_once('connectcommande.php');

// On nettoie l'id envoyé
//$id = strip_tags($_GET['id']);

// $sql = 'SELECT * FROM `commande` WHERE `id` = :resultcommande;';
// $query = $db->prepare($sql);
// $query->bindValue(':resultcommande', $resultcommande, PDO::PARAM_INT);
// $query->execute();
// $commande = $query->fetch();
//print_r($commande);

// print_r($resultcommande);
// print_r($page);
// print_r($_SESSION['user']['role']);
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";
// echo "<pre>";
// print_r($_SESSION['user']['login']);
// echo "</pre>";

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

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <link rel="stylesheet" href="./css/styleloader.css"> -->
  <title>Pointage journalier</title>
</head>

<body>
  <div class="loader-container">
    <div class="loader"></div>
  </div>
  <?php include('./navbarok.php') ?>
  <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

  <div class="container" id="container">
    <!-- </div> -->
    <h2 class="entete">Pointage Journalier</h2>
    <h3 class="entete">Bonjour <?= $_SESSION['user']['login'] ?> </h3>
    <br>






    <!-- < ?php -->
    <!-- // if ($_SESSION['user']['role'] == 'ADMIN') {
                // print_r($_SESSION['user']['role']);
            ?> -->
    <!-- < ?php      if ($heurepointage>date("07:00") && $heurepointage<date("12:15")) { ?> -->

    <?php if ($heurepointage > date("07:00") && $heurepointage < date("12:00")) { ?>
      <?php if ($pointage == false) { ?>
        <button class="btn btn-primary btn-lg btn-success" onclick="envoipointage(1)">Pointage Entree1</button>
      <?php   } ?>
      <?php if (@$pointage['sortie1'] == "" && $pointage != false) { ?>
        <button class="btn btn-primary btn-lg btn-danger" onclick="envoipointage(2)">Pointage Sortie1</button>
        <!-- <button class="btn btn-primary btn-lg btn-success" onclick="envoipointage(2)">Sortie1</button> -->

      <?php   } ?>
    <?php } ?>
    <?php if ($heurepointage > date("12:00") && $heurepointage < date("23:00")) { ?>
      <?php if (@$pointage['entree2'] == "") { ?>
        <button class="btn btn-primary btn-lg btn-success" onclick="envoipointage(3)">Pointer Entree2</button>
      <?php   } ?>
      <?php if ($pointage == true) { ?>
        <button class="btn btn-primary btn-lg btn-danger" onclick="envoipointage(4)">Pointer Sortie2</button>
      <?php   } ?>
      <!-- <button class="btn btn-primary btn-lg btn-success" onclick="envoipointage(4)">Sortie2</button> -->
      <br><br>
    <?php } ?>
    <!-- <a class="btn btn-primary btn-lg btn-success" onclick="envoisms()" href="">Entree1</a> -->
    <br><br>
    <!-- <button class="btn btn-primary btn-lg btn-success" onclick="envoipointage(2)">Pointer</button> -->
    <button class="btn btn-primary btn-lg btn-info" onclick="history.back()">Retour</button>
    <!-- <a class="btn btn-primary btn-lg" href="./editcommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>">Modifier</a>
                <a class="btn btn-primary btn-lg btn-warning" href="./deletecommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>">Supprimer</a>
                <br>
                <a class="btn btn-primary btn-lg btn-info" href="./etatcommande.php?id=< ?= $resultcommande ?>&page=< ?= $page ?>">Etat commande</a>
                 <a class="btn btn-primary btn-sm btn-primary" href="./qrcodecommande.php?id=< ?= $resultcommande ?>">Qr code commande</a> -->

    <!-- <a class="btn btn-primary btn-lg btn-danger" href="./tagger.php?id=< ?= $resultcommande ?>&suite=9&page=< ?= $page ?>">Tagger Commande</a> -->

    <!-- < ?php } ?> -->














    <!-- //print_r($_SESSION['user']['role']);
                               if ($_SESSION['user']['role']=='ADMIN') { 
                               // print_r($_SESSION['user']['role']);
                                ?> -->



    <!-- <a class="btn btn-primary btn-sm" 
                                href="../blivraisoncommande.php?id=< ?= $resultcommande ?>&page=< ?=$page?>">Imprimer</a>
                                <a class="btn btn-primary btn-sm" 
                                href="./proforma.php?id=< ?= $resultcommande ?>&page=< ?=$page?>&idclient=< ?= $trieclientid ?>">Proforma</a> -->








  </div>
  <script src="sweetalert2.all.min.js"></script>

  <script>
    function envoipointage(entree) {
      // pointage 1
      var pointer = new Date();
      var hours = pointer.getHours() + ":" + pointer.getMinutes() + ":" + pointer.getSeconds();
      //document.write(now);
      if (entree == 1) {
        Swal.fire({
          title: `Confirmation pointage du Matin? ${hours}`,
          text: "Etes vous sûr?",

          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Pointer!',
          cancelButtonText: 'Annuler',
          width: '27em'
        }).then((result) => {


          if (result.isConfirmed) {

            Swal.fire(

              'Pointage OK Bonne journee! Soyez à l\'heure c\'est bien',
              '',
              'success',

            ).then((result) => {


              document.location.href = 'confirmationpointage.php?pointage=1';

            }) // fin is result;

          } // fin is confirmedresult


        }) // fin is result
      } // fin entree



      // pointage 2
      if (entree == 2) {
        Swal.fire({
          title: `Confirmation pointage Fin de Matinée? ${hours}`,
          text: "Etes vous sûr?",

          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Pointer!',
          cancelButtonText: 'Annuler',
          width: '27em'
        }).then((result) => {


          if (result.isConfirmed) {

            Swal.fire(

              'Vous venez de pointer Bon Appetit!',
              '',
              'success',

            ).then((result) => {

              document.location.href = 'confirmationpointage.php?pointage=2';

            }) // fin is result;

          } // fin is confirmedresult


        }) // fin is result
      } // fin entree

      // pointage 3
      if (entree == 3) {
        Swal.fire({
          title: `Confirmation pointage Apres-Midi? ${hours}`,
          text: "Etes vous sûr?",

          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Pointer!',
          cancelButtonText: 'Annuler',
          width: '27em'
        }).then((result) => {


          if (result.isConfirmed) {

            Swal.fire(

              'Vous venez de pointer Bon Aprés-Midi!',
              '',
              'success',

            ).then((result) => {

              document.location.href = 'confirmationpointage.php?pointage=3';

            }) // fin is result;

          } // fin is confirmedresult


        }) // fin is result
      } // fin entree

      // pointage 1
      if (entree == 4) {
        Swal.fire({
          title: `Confirmation pointage de Fin de Journée?${hours}`,
          text: "Etes vous sûr?",

          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Pointer!',
          cancelButtonText: 'Annuler',
          width: '27em'
        }).then((result) => {


          if (result.isConfirmed) {

            Swal.fire(

              'Vous venez de pointer Bonne Route Soyez Prudent!',
              '',
              'success',

            ).then((result) => {

              document.location.href = 'confirmationpointage.php?pointage=4';

            }) // fin is result;

          } // fin is confirmedresult


        }) // fin is result
      } // fin entree


    }
  </script>
  <!-- <script src="./js/script.js"  >

</script>            -->
</body>

</html>