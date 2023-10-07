<?php
// On démarre une session
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
// print_r( $_SESSION['iduser']);
// die();
//require_once('role.php');
if (isset($_POST["sel"]) && !empty($_POST["sel"])) {
                                                @$sel = $_POST["sel"];
                                                $_SESSION['sel']=@$sel;
                                                    } else $sel=$_SESSION['sel'];
//print_r($_SESSION['sel']);
$Tous=0;
$resultcommande=$_SESSION['resultcommande'];
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";


$trieclientid=@$resultcommande[0]['idclient'];

// test si bon de livraison si 1 seul client
$nomclient=@$resultcommande[0]['nomclient'];
$nomimprime=@$resultcommande[0]['imprime'];
$datebl=date('Y-m-d');
//print_r($_POST);
 //die();
// if (empty($sel)) {
//     $_SESSION['erreur'] = "Veuillez selectionner au moins un champ dans la liste des commandes<br>";
//     header('Location: ./indexcommande.php?page=1');
//     die();
// }
@$valider = $_POST["valider"];
// echo "<br>";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
//die();
if (isset($valider) && isset($sel)) {
    if (@$_POST["seltous"]=="seltous") $Tous=1;
    // echo "<p>Vous avez coché les cases suivantes:</p> <br>";
    // echo "<p>".@implode("//",$sel)."</p>";


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
    for ($i = 0; $i < $long; $i++) {
        $boucle=$sel[$i];
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
    //print_r($resultcommande);
    require_once('closecommande.php');
    // //echo "<pre>";
    // for ($i = 0; $i < $long; $i++) {
    //     echo "<pre>";
    // print_r($resultcommande[$i]);
    // echo "</pre>";
    // print_r(count($resultcommande));
    
    // }
    // die();

    $_SESSION['resultcommande'] = $resultcommande;
    // // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


    // // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $compteur = count($resultcommande);
    $nbr_element_page = 50;
    $nbr_de_pages = ceil($compteur / $nbr_element_page);
    $debut = ($page - 1) * $nbr_element_page;

    @$listedate1=$_POST["listedate1"];
    @$listedate2=$_POST["listedate2"];
    @$recherche=$_POST["recherche"];
    @$niveau=$_POST["niveau"];
    // echo $listedate1;
    // echo $listedate2;
    // echo $recherche;
    // die();

    // die();
} else {
    @$listedate1=$_POST["listedate1"];
    @$listedate2=$_POST["listedate2"];
    @$recherche=$_POST["recherche"];
    @$niveau=$_POST["niveau"];
    //$_SESSION['erreur'] = "Veuillez selectionner une commande";
    //header("location:indexcommande.php?recherche=$recherche&dates=$listedate1&dates2=$listedate2&niveau=$niveau");
  

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

<body>
    <br><br>
    <?php require_once('./navbarok.php') ?>
    <br>
    <div class="entete">
        liste de commandes <br><br>
    <?php if (!empty($listedate1)) echo "Du ".$listedate1 ?>
   
    <?php if (!empty($listedate2)) echo "au ".$listedate2 ?>
    </div>
    <h1 class="entete"><?php if (!empty($recherche)) echo "Recherche :".$recherche ?></h1>
    <div class="panel panel-primary" id="container">
        <div class="panel-heading">Liste de commandes (<?= @$compteur ?>)</div>
        <div class="table-responsive">

            <table class="table tab">
                <thead class="table ">
                    <!-- <th >Sel</th> -->
                    <th>ID</th>
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
            //$nombrecommandes=0;
            // On boucle sur la variable result
            // echo "<pre>";
            // print_r($resultcommande);
            // echo "</pre>";
            // echo $resultcommande[0]['id'];
            // echo $resultcommande[0]['dates'];
            //die();
            // foreach($resultcommande as $commande)
            for ($i = @$debut; $i <= @$nbr_element_page - 1 + @$debut; $i++) {
                // if ($resultcommande[$i]==null) break;
            ?>
                <tr>
                    <!-- <td class="table-primary">
                <input name='sel[]' type="checkbox" value=< ?= $resultcommande[$i]['id'] ?> 
                < ?php if (@in_array($resultcommande[$i]['id'],$sel)) echo "checked" ?>></td> -->

                    <?php if  (in_array(@$resultcommande[$i]['id'], @$sel)) { ?>
                        <td class="table-primary"><?= $resultcommande[$i]['id'] ?></td>
                        <td class="table-success"><?= $resultcommande[$i]['dates'] ?></td>
                        <!-- <td class="table-primary"><?= $resultcommande[$i]['idclient'] ?></td> -->
                        <td class="table-info"><?= $resultcommande[$i]['nomclient'] ?></td>
                        <!-- <td class="table-primary"><?= $resultcommande[$i]['idimprime'] ?></td> -->
                        <td class="table-warning"><?= $resultcommande[$i]['imprime'] ?></td>

                        <td class="table-primary"><?= $resultcommande[$i]['quantite'] ?></td>
                        <?php
                        if ($_SESSION['user']['role'] == 'ADMIN') {
                        ?>
                            <td class="table-primary"><?= number_format($resultcommande[$i]['prix'], 2, ".", ".") ?></td>
                            <!-- <td class="table-primary"><?= $resultcommande[$i]['prepress'] ?></td> -->
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
                if (@in_array($resultcommande[$i]['id'], $sel))  $total1 += $resultcommande[$i]['total'];
                //$nombrecommandes+=1;
            }
            ?>
            <td class="table-primary">Total en DZ</td>
            <td class="table-danger"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <!-- <td class="table-primary"></td>
        <td class="table-primary"></td>
        <td class="table-primary"></td> -->
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
    $trieclientid = $resultcommande[0]['idclient'];
    // test si bon de livraison si 1 seul client
    $nomclient = $resultcommande[0]['nomclient'];
    $occurence = 0;
    //echo $trieclientid."<br>";
    foreach ($resultcommande as $commande) {
        if ($commande['idclient'] != $trieclientid) $occurence++;
    }
    //echo $occurence."<br";
    if ($occurence > 0 and $Tous==0) {
        //@$_SESSION['erreur'] .= "Deux Clients differents ne peuvent pas avoir le même document!<br>";
        
        //die();
        // echo "<script>
        //         //alert('Erreur veuillez remplir tous les champs');
        //         window.location.href='./indexcommande.php?page=1&recherche=&ni';
        //         </script>";
       // ?>

        <!-- <a href="" class="btn btn-primary">Imprimer Etat de commandes</a>  -->
        <?php

    } else { 
        
        $_SESSION['valider']="non";
        ?>
         <!-- <div class="form-group">
                <label for="dates">Date du document à émettre</label> 
                < ?php $datevalue=date('Y-m-d')?>
                         <input type="date" id="dates" value=< ?= $datevalue?> name="dates" class="form-control"> 
                 <input type="text" placeholder="ftererere" value=" < ?php echo date('D-Y-m-d')?>"> -->

                <!-- <input type="date"  class="form-control" value=< ?= $datevalue?> id="dates" name="dates" onchange="selection()">
             </div> -->
        <a id="bouton" href="blivraisonneioselection.php" class="btn btn-primary btn-block">Emettre Le Bon de livraison</a>
        <a id="bouton" href="proformaneioselection.php" class="btn btn-primary btn-block">Emettre La Proforma</a>
        <a id="bouton" href="factureneioselection.php" class="btn btn-primary btn-block">Emettre La facture</a>

        
    <?php     } ?>
    <a id="bouton" 
     
    class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer Etat de commandes</a>
    <!-- <a id="bouton" 
    href="indexcommande.php?recherche=<?=$recherche ?>&dates=<?= $listedate1 ?>&dates2=<?=$listedate2 ?>&niveau=<?=$niveau ?>" 
    class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer Etat de commandes</a> -->

    <button class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de commande prête</button>
    <!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<!-- <script>
// function myFunction() {
//  // alert("This document is now being printed");
//  window.location.href='indexcommande.php';
// }
// </script> -->
<script src="sweetalert2.all.min.js"></script>
<script>
                function  selection() {
                //Creating a cookie after the document is ready
              
               window.location.href="actionselectiontest.php";
                //$_COOKIE["idclient"];
                
             }
                
                </script>
<script>
function envoisms(){ 


Swal.fire({
  title: 'Envoi Sms commande prête?',
  text: "Etes vous sûr?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Envoyer!',
  cancelButtonText:'Annuler',
  width:'20em'
}).then((result) => {
// document.location.href='sms/envoismsok.php?';
//  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.' ;
    
  if (result.isConfirmed) {
   
    Swal.fire(
      'En cours!',
      '',
      'success'
    );
 



 document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.';



  }
})
}


function encours(){
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
</script>
</body>

</html>