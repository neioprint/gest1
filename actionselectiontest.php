<?php

require_once "const.php";

// print_r( $_SESSION['iduser']);
// die();
//require_once('role.php');
$supprimer = isset($_GET['supprimer']) ? $_GET['supprimer'] : 0;

if (isset($_POST["sel"]) && !empty($_POST["sel"])) {
                  @$sel = $_POST["sel"];
                  $_SESSION['sel'] = $sel;} else if ($supprimer==1) $sel=$_SESSION['sel'];
//print_r($sel);
$Tous = 0;
$compteur=0;
//$resultcommande=$_SESSION['resultcommande'];
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
// die();


//print_r($_POST);
//die();
// if (empty($sel)) {
//     $_SESSION['erreur'] = "Veuillez selectionner au moins un champ dans la liste des commandes<br>";
//     header('Location: ./indexcommande.php?page=1');
//     die();
// }
@$valider = $_POST["valider"];
// print_r($valider);
// echo "<br>";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
//die();
if (isset($valider) && isset($sel) or $supprimer==1) {
  if (@$_POST["seltous"] == "seltous") $Tous = 1;
  // echo "<p>Vous avez coché les cases suivantes:</p> <br>";
  // echo "<p>".@implode("//",$sel)."</p>";
//echo "ok";
//die();

  // On  recherche le nombre d'enregistrement
  $long = count($sel);
  //print_r($long);

  // $count = $db->prepare("select count(id) as cpt from commande");
  // $count->setFetchMode(PDO::FETCH_ASSOC);
  // $count->execute();
  // $tcount = $count->fetchAll();
  // print_r ($tcount);
  // $totalcount = $tcount[0]['cpt'];
  // echo "<p>".$totalcount."</p>";
  // echo "<p>".$long."</p>";

  //die();
  // on se connect à la base
  require('connectcommande.php');
  //$j = 0;
  // print_r($sel);
  // echo "<br>";
  if ($supprimer==1) {
    echo $supprimer;
    for ($i = 0; $i < $long; $i++) {
      $boucle = $sel[$i];
      //require('connectcommande.php');
      //   $reponse = $bdd->query('SELECT nom FROM jeux_video WHERE possesseur=\'' . $_GET['possesseur'] . '\'');  
      $sql = "delete from commande where id=$boucle";
      // $sql = 'SELECT * FROM `commande` WHERE `id` = :id;';
      // $sql = 'select * from commande where id=\'' . $sel[$i] . '\'';
      // On prépare la requête
      $query = $db->prepare($sql);
      // $query->bindValue(':id', $sel[$i], PDO::PARAM_INT);
      // On exécute la requête
      $query->execute() or die(print_r($bdd->errorInfo()));;
      // On stocke le résultat dans un tableau associatif
      //$resultcommande[$i] = $query->fetch(PDO::FETCH_ASSOC);
      // if (in_array($resultprov['id'], $sel)) {
      //     $resultcommande[$j] = $resultprov;
      //     $j++;
      // }
  
    }


    echo "operation terminée";
    $_SESSION['message'].="Suppression terminée avec succée";
    header("location:indexcommande.php?recherche=$recherche&niveau=ins");

    die();
  } 
  if ($supprimer==0) {
  for ($i = 0; $i < $long; $i++) {
    $boucle = $sel[$i];
    //require('connectcommande.php');
    //   $reponse = $bdd->query('SELECT nom FROM jeux_video WHERE possesseur=\'' . $_GET['possesseur'] . '\'');  
    $sql = "select * from commande where id=$boucle";
    // $sql = 'SELECT * FROM `commande` WHERE `id` = :id;';
    // $sql = 'select * from commande where id=\'' . $sel[$i] . '\'';
    // On prépare la requête
    $query = $db->prepare($sql);
    // $query->bindValue(':id', $sel[$i], PDO::PARAM_INT);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));;
    // On stocke le résultat dans un tableau associatif
    $resultcommande[$i] = $query->fetch(PDO::FETCH_ASSOC);
    // if (in_array($resultprov['id'], $sel)) {
    //     $resultcommande[$j] = $resultprov;
    //     $j++;
    // }
  }
  $trieclientid = @$resultcommande[0]['idclient'];

// test si bon de livraison si 1 seul client
$nomclient = @$resultcommande[0]['nomclient'];
$nomimprime = @$resultcommande[0]['imprime'];
$datebl = date('Y-m-d');
  // echo "<pre>";
  // print_r($resultcommande);
  // echo "</pre>";
 // die();
  require_once('closecommande.php');
  //echo "<pre>";
  // for ($i = 0; $i < $long; $i++) {
  //     echo "<pre>";
  // print_r($resultcommande[$i]);
  // echo "</pre>";
  // print_r(count($resultcommande));

  //  }
  // die();

  $_SESSION['resultcommande'] = $resultcommande;
  // // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


  // // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $compteur = count($resultcommande);
  // $nbr_element_page = 50000;
  // $nbr_de_pages = ceil($compteur / $nbr_element_page);
  // $debut = ($page - 1) * $nbr_element_page;
  //$debut =0;
  $listedate1 = $_POST["listedate1"];
  $listedate2 = $_POST["listedate2"];
  $recherche = $_POST["recherche"];
  $niveau = $_POST["niveau"];
  // echo $listedate1;
  // echo $listedate2;
  // echo $recherche;
  // die();

  // die();
  }
} else {
  $listedate1 = $_POST["listedate1"];
  $listedate2 = $_POST["listedate2"];
  $recherche = $_POST["recherche"];
  $niveau = $_POST["niveau"];
  $_SESSION['erreur'] = "Veuillez selectionner une commande";
  header("location:indexcommande.php?recherche=$recherche&dates=$listedate1&dates2=$listedate2&niveau=ins");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="icon" href="./images/logo.avif" type="image" /> -->
  <link rel="stylesheet" href="./css/style41.css">
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
  <link rel="stylesheet" href="./css/stylebl.css">
  <link rel="stylesheet" type="text/css" href="./css/impression.css" media="print">

  <link rel="stylesheet" href="css/normalize.css">

  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
  <link rel="stylesheet" href="./css/style41.css">
  <script src="./js/jquery-3.3.1.js"></script>
  <link rel="icon" href="./images/logo.avif" type="image" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>Imprimer etat</title>
</head>
<!-- <body onafterprint="myFunction()"> -->

<body onafterprint="apresimpression()">
  <br><br>
  <?php require_once('./navbarok.php') ?>
 
  <div class="entete">
    liste de commandes <br><br>
    <?php if (!empty($listedate1)) echo "Du " . $listedate1 ?>

    <?php if (!empty($listedate2)) echo "au " . $listedate2 ?>
  </div>
  <h1 class="entete"><?php if (!empty($recherche)) echo "Recherche :" . $recherche ?></h1>
  <div class="panel panel-primary" id="container">
    <div class="panel-heading">Liste de commandes (<?= @$compteur ?>)</div>
    <div class="table-responsive">

      <table class="table tab">
        <thead class="table ">
          <!-- <th >Sel</th> -->
          <th>N°-ID </th>
          <th class="table-primary">Date</th>
          <!-- <th class="table-primary">ID client</th> -->
          <th class="table-primary">client</th>
          <!-- <th class="table-primary">ID impri</th> -->
          <th class="table-primary">impr</th>
          <th class="table-primary">qte</th>
          <?php
          if ($_SESSION['user']['role'] == 'ADMIN') {
          ?>
            <th class="table-primary">prix</th>
            <!-- <th class="table-primary">prpress</th> -->
            <th class="table-primary">total</th>
          <?php } ?>
          <!-- <th class="table-primary">remarque</th> -->
          <th class="table-primary">etat</th>
          <?php
          if ($_SESSION['user']['role'] == 'ADMIN') {
          ?>
            <th class="table-primary">Paiement</th>
          <?php } ?>
          <!-- <th class="table-primary">Photo</th> -->

          <!-- <th class="table-primary">Action</th> -->
    </div>
    </thead>
    <tbody>
      <?php
      $total1 = 0;
      $totalqte = 0;
      //$nombrecommandes=0;
      // On boucle sur la variable result
      // echo "<pre>";
      // print_r($resultcommande);
      // echo "</pre>";
      // echo $resultcommande[0]['id'];
      // echo $resultcommande[0]['dates'];
      //die();
      // foreach($resultcommande as $commande)
      $listeimprime="";
      for ($i = 0; $i < $compteur; $i++) {
        // if ($resultcommande[$i]==null) break;
      ?>
        <tr>
          <!-- <td class="table-primary">
                <input name='sel[]' type="checkbox" value=< ?= $resultcommande[$i]['id'] ?> 
                < ?php if (@in_array($resultcommande[$i]['id'],$sel)) echo "checked" ?>></td> -->

          <?php if (in_array(@$resultcommande[$i]['id'], @$sel)) { 
              $listeimprime.=$resultcommande[$i]['imprime']."-";
            ?>
           
            <td class="table-primary"><?= ($i + 1) . "-" . $resultcommande[$i]['id'] ?></td>
            <td class="table-success"><?= $resultcommande[$i]['dates'] ?></td>
            <!-- <td class="table-primary">< ?= $resultcommande[$i]['idclient'] ?></td> -->
            <td class="table-info"><?= $resultcommande[$i]['nomclient'] ?></td>
            <!-- <td class="table-primary">< ?= $resultcommande[$i]['idimprime'] ?></td> -->
            <td class="table-warning"><?= $resultcommande[$i]['imprime'] ?></td>

            <td class="table-primary"><?= $resultcommande[$i]['quantite'] ?></td>
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN') {
            ?>
              <td class="table-primary"><?= number_format($resultcommande[$i]['prix'], 2, ".", ".") ?></td>
              <!-- <td class="table-primary">< ?= $resultcommande[$i]['prepress'] ?></td> -->
              <td class="table-danger"><?= number_format($resultcommande[$i]['total'], 2, ".", ".") ?></td>
            <?php } ?>
            <!-- <td class="table-primary">< ?= $resultcommande[$i]['remarque'] ?></td> -->
            <td class="table-primary"><span style="background-color:yellow;color:black;font-weight:bold"><?= $resultcommande[$i]['etat'] ?></span></td>
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN') {
            ?>
              <td class="table-primary"><span style="background-color:red;color:black;font-weight:bold"><?= $resultcommande[$i]['paiement'] ?></td>
            <?php } ?>
            <!-- <td class="table-success"> 
                <img  src="./uploads/66-30--15-08-2022 17.png" alt="logo global2pub" width="90" height="auto">
                </td> -->


            <td>

            </td>

          <?php } ?>


        </tr>

      <?php
        if (@in_array($resultcommande[$i]['id'], $sel)) {
          $total1 += $resultcommande[$i]['total'];
          $totalqte += $resultcommande[$i]['quantite'];
        }

        //$nombrecommandes+=1;
      }
      ?>
      <td class="table-primary">Total en DZ</td>
      <td class="table-danger"></td>
      <td class="table-primary"></td>
      <td class="table-primary"></td>
      <!-- <td class="table-primary"></td> -->
      <!-- <td class="table-primary"></td> -->
      <td class="table-success"><?= number_format($totalqte, 0, ",", ".") ?></td>
      <!-- <td class="table-primary"></td>
        <td class="table-primary"></td>
        <td class="table-primary"></td> -->
      <td class="table-primary"></td>
      <td class="table-success"><?= number_format($total1, 2, ",", ".") ?></td>
      <td class="table-primary"></td>
      <td class="table-primary"></td>
      <td class="table-primary"></td>
      <td class="table-primary"></td>
    </tbody>

    </table>

  </div>

  </div>

  <!-- <a href="blivraisonneioselection.php" class="btn btn-primary">Emettre Le Bon de livraison</a>
<a href="proformaneioselection.php" class="btn btn-primary">Emettre La Proforma</a>
<a href="factureneioselection.php" class="btn btn-primary">Emettre La facture</a> -->
  <?php
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  if ($supprimer==0)
  {
  $trieclientid = @$resultcommande[0]['idclient'];
  // test si bon de livraison si 1 seul client
  $nomclient = @$resultcommande[0]['nomclient'];
  $occurence = 0;
  $nonvalide=0;
  //echo $trieclientid."<br>";
  foreach ($resultcommande as $commande) {
    if ($commande['idclient'] != $trieclientid) $occurence++;
    $etatcolor[0] = explode("/", @$commande['etat']);
    if ($etatcolor[0][0]!=2 and $etatcolor[0][0]!=3 and $etatcolor[0][0]!=1 and $etatcolor[0][0]!=11) $nonvalide++;

  }
}
  //echo $occurence."<br";
  if (@$occurence > 0 or @$nonvalide>0) {
    //@$_SESSION['erreur'] .= "Deux Clients differents ne peuvent pas avoir le même document!<br>";

    //die();
    // echo "<script>
    //         //alert('Erreur veuillez remplir tous les champs');
    //         window.location.href='./indexcommande.php?page=1&recherche';
    //         </script>";
    // 
  ?>

    <!-- <a href="" class="btn btn-primary">Imprimer Etat de commandes</a>  -->
  <?php
  echo '<a id="bouton" onclick="proforma()" class="btn btn-primary btn-block">Emettre La Proforma</a>';
  } else {

    $_SESSION['valider'] = "non";
  ?>
   
    <a id="bouton" onclick="bondelivraison()" class="btn btn-primary btn-block">Emettre Bon de livraison</a>

    <!-- <a id="bouton" href="blivraisonneioselection.php?livr=partiellebl" class="btn btn-primary btn-block">Emettre Bon de livraison partiel</a> -->

    <a id="bouton" onclick="facture()" class="btn btn-primary btn-block">Emettre facture</a>
    <!-- <a id="bouton" href="factureneioselection.php" class="btn btn-primary btn-block">Emettre facture partielle</a> -->
    <button class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de commande prête à être livrée</button>

  <?php     } ?>
  <a id="bouton" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer Etat de commandes</a>
  <a id="bouton" onclick="supprimer()" class="btn btn-danger btn-block"> <i class='fa fa-trash' style='font-size:25px'  aria-hidden='true'></i></a>
<br><br>
  <!-- <a id="bouton" 
    href="indexcommande.php?recherche=< ?= $recherche ?>&dates=< ?= $listedate1 ?>&dates2=< ?= $listedate2 ?>&niveau=< ?= $niveau ?>" 
    class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer Etat de commandes</a> -->

  <!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

  <!-- <script>
// function myFunction() {
//  // alert("This document is now being printed");
//  window.location.href='indexcommande.php';
// }
// </script> -->
  <!-- <script src="sweetalert2.all.min.js"></script> -->

  <script>
    function envoisms() {


      Swal.fire({
        title: 'Sms de commande prête?',
        text: "Etes vous sûr?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Envoyer Sms!',
        cancelButtonText: 'Annuler',
        width: '20em'
      }).then((result) => {
        // document.location.href='sms/envoismsok.php?';
        //  document.location.href='sms/envoismsok.php?idclient=< ?= $trieclientid ?>&message=Le < ?= $datebl ?> Cher < ?= $nomclient ?> Votre commande < ?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.' ;

        if (result.isConfirmed) {

          Swal.fire(
            'En cours!',
            '',
            'success'
          );




          document.location.href = "sms/envoismsok.php?idclient=<?= $trieclientid ?>&client=<?=$nomclient?>&message=Le <?= $datebl." ".$nomclient ?> Commande(s) <?= $listeimprime ?> prête(s),pour plus de renseignements contacter par e-mail neioprint@gmail.com";



        }
      })
    }


    function encours() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }

      })

      Toast.fire({
        icon: 'success',
        title: 'Operation en cours'
      })
    }


    // fonction facture conf
    function facture() {


      Swal.fire({
        title: 'Emettre la facture?',
        text: "Etes vous sûr?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Emettre Facture!',
        cancelButtonText: 'Annuler',
        width: '20em'
      }).then((result) => {
        // document.location.href='sms/envoismsok.php?';
        //  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.' ;

        if (result.isConfirmed) {

          Swal.fire(
            'En cours!',
            '',
            'success'
          );




          //  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.';
          document.location.href = 'factureneioselection.php';


        }
      })
    }


    function bondelivraison() {


      Swal.fire({
        title: 'Emettre le bon de libraison?',
        text: "Etes vous sûr?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Emettre bon de livraison',
        cancelButtonText: 'Annuler',
        width: '20em'
      }).then((result) => {
        // document.location.href='sms/envoismsok.php?';
        //  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.' ;

        if (result.isConfirmed) {

          Swal.fire(
            'En cours!',
            '',
            'success'
          );




          //  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.';
          document.location.href = 'blivraisonneioselection.php';


        }
      })
    }


    function proforma() {


      Swal.fire({
        title: 'Emettre la proforma?',
        text: "Etes vous sûr?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Emettre proforma!',
        cancelButtonText: 'Annuler',
        width: '20em'
      }).then((result) => {
        // document.location.href='sms/envoismsok.php?';
        //  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.' ;

        if (result.isConfirmed) {

          Swal.fire(
            'En cours!',
            '',
            'success'
          );




          //  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.';
          document.location.href = 'proformaneioselection.php';


        }
      })
    }

    function supprimer() {


Swal.fire({
  title: 'Supprimer?',
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  },
  text: "Etes vous sûr?",
  icon: 'error',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Supprimer',
  cancelButtonText: 'Annuler',
  width: '32em'
}).then((result) => {


  if (result.isConfirmed) {

    Swal.fire(
      'En cours!',
      '',
      'success'
    );

    document.location.href = 'actionselectiontest.php?supprimer=1';


  }
})
}

function apresimpression()
{
  Swal.fire('Impression en cours....')
}
  </script>
</body>

</html>