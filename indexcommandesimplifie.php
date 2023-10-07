<?php
require_once "const.php";

if (isset($_GET['language']) && !empty($_GET['language']))  {
    if($_GET['language']=="FR") $_SESSION['language']="AR"; else 
    if ($_GET['language']=="AR") $_SESSION['language']="FR";

}
// $refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
//                             $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

//echo $refreshButtonPressed;
// if ($refreshButtonPressed!=1) die();
// include du qr code
// include('./phpqrcode/qrlib.php'); //On inclut la librairie au projet
// include dur qr code

// if (!isset($_SESSION['user'])) {
//     header('Location:login.php');
//     exit();
// }
// @$sel=$_POST["sel"];
// @$valider=$_POST["valider"];
// if (isset($valider)){
//     echo "<p>Vous avez coché les cases suivantes:</p> <br>";
//     echo "<p>".@implode(" - ",$sel)."</p>";

// }
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
// initialiser 1ere date de recherche
$dat = isset($_GET['dates']) ? $_GET['dates'] : "";
// initialiser 2ere date de recherche
$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : "";
$dat2 = isset($_GET['dates2']) ? $_GET['dates2'] : "";
// initialiser le niveau du select par defaut "t" Toutes les commandes (sans les proformas)
$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "0";
// afficher les commande par mois en cours pour les ouvriers
$datecom = date('Y-m-d-D');
// print_r($datecom);
// echo '<br>';
if ($dat == "") {
    $dat = date('Y') . '-' . date('m') . '-' . '01';
    // $dat2=date('Y').'-'.date('m').'-'.date('t');
    //$dat2=strtotime(time, now);
}
if ($dat2 == "") {
    // $dat=date('Y').'-'.date('m').'-'.'01';t =le nombre de jours de ce mois
    $dat2 = date('Y') . '-' . date('m') . '-' . date('d');
    //$dat2=strtotime(time, now);
}
// print_r($dat);
// echo '<br>';
// print_r($dat2);
//die();
// afficher les commande par mois en cours pour les ouvriers

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$_SESSION['valider'] = "non";
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// $nbr_element_page = 50;
// $nbr_de_pages = ceil($compteur / $nbr_element_page);
// $debut = ($page - 1) * $nbr_element_page;
// On inclut la connexion à la base
if ($idcommande == "") {
    require_once('connectcommande.php');

    $sql = "select * from commande where id";



    if ($niveau == "ins") {
        $sql = "select * from commande where etat like '%0/%' or etat like '%1/%' or etat like '%2/%'  and nomclient like  '%$recherche%' order by dates";
    }
    if ($niveau == "q") {
        if (!empty($dat) and !empty($dat2)) {
            $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
    where nomclient like  '%$recherche%' and (tag like '1')
    and dates>='$dat' and dates<='$dat2' and  ((etat like '%0/%') or  (etat like '%1/%') or (etat like '%2/%') or (etat like '%3/%'))  order by dates";
        } elseif (!empty($dat))
            $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
    nomclient like  '%$recherche%' and dates>='$dat' and  ((etat like '%0/%') or  (etat like '%1/%') or (etat like '%2/%') or (etat like '%3/%')) order by dates";
        elseif (!empty($dat2))
            $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
    nomclient like  '%$recherche%' and (tag like '1')
    and dates<='$dat2' and  ((etat like '%0/%') or  (etat like '%1/%') or (etat like '%2/%') or (etat like '%3/%')) order by dates";

        else $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
    nomclient like  '%$recherche%' and (tag like '1')
    and  ((etat like '%0/%') or  (etat like '%1/%') or (etat like '%2/%') or (etat like '%3/%')) order by dates";
    }
    // resultat pour  les commandes archiviés

    if ($niveau == "0") {
        //$sql="select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande 
        //where nomclient like  '%$recherche%'";
        $sql = "";
    }
    // On prépare la requête
    if ($sql != "") {
        $query = $db->prepare($sql);
        // On exécute la requête
        $query->execute() or die(print_r($bdd->errorInfo()));;

        // On stocke le résultat dans un tableau associatif
        $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($resultcommande);
        // echo "</pre>";
        // die();
        require_once('closecommande.php');
    }

    // partie countage du nombre de champs ds commande Fin
} else {
    require_once('connectcommande.php');
    $sql = 'SELECT * FROM `commande` WHERE `id` = :idcommande;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':idcommande', $idcommande, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $resultcommande = array($query->fetch());

    require_once('closecommande.php');
    // print_r($resultcommande[0]['etat']);
    // die();
}
$compteur = count($resultcommande);
$nbr_element_page = 50000;
$nbr_de_pages = ceil($compteur / $nbr_element_page);
$debut = ($page - 1) * $nbr_element_page;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Liste des commandes</title>
    <link rel="stylesheet" href="css/normalize.css">

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <script src="./js/jquery-3.3.1.js"></script>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <!-- <link rel="stylesheet" href="./css/styleloader.css"> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
</head>

<body>


 
    <?php require_once('./navbarok.php') ?>
    <h1 class="entete">Liste commandes</h1>
        <p class="entete" style="color:yellow"><?=$_SESSION['login']." est connecté"?></p>
    
    <div class="panel panel-success">
        <div class="panel-heading">Recherche de commandes</div>
        <div class="panel-body">
            <form method="get" action="" class="form-inline">
                <div class="form -group">
                    <!-- < ?php if (
                        $niveau != "e0" && $niveau != "e1" && $niveau != "e2" && $niveau != "e3"
                        && $niveau != "e5" && $niveau != "prof"
                    ) { ?> -->
                    <input type="search" name="recherche" placeholder="rechercher" value="<?php echo @$recherche ?>" />
                    <!-- < ?php } ?> -->
                    <!-- < ?php if ($niveau == "d") { ?> -->
                    <span style="color:red">Du</span>
                    <label for="date"></label>
                    <input type="date" id="date" name="dates" value="<?php echo $dat ?>" onchange="this.form.submit()" />
                    <span style="color:red">Au</span>
                    <label for="date2"></label>
                    <input type="date" id="date2" name="dates2" value="<?php echo $dat2 ?>" onchange="this.form.submit()" />

                    <!-- < ?php } ?> -->

                    <!-- value="< ?php echo $dat ?>"                       -->
                    <br>
                    <span style="color:red">Par</span>
                    <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                        <!-- <option  value="0" < ?php if($niveau==="0") echo "selected" ?>>Veuillez selectionner un critère de recherche</option> -->
                        <option value="ins" <?php if ($niveau === "ins")   echo "selected" ?>>Recherche Commandes en instance sans date</option>

                        <option value="q" <?php if ($niveau === "q")   echo "selected" ?>>Recherche Commandes (en attente,encours,terminé,livré) selon date</option>
                        <!-- <option  value="t" < ?php if ($niveau === "t")   echo "selected" ?>>Toutes les commandes (sans les proformas)</option> -->

                        <!-- <option value="d" < ?php if ($niveau === "d")   echo "selected" ?>>Recherche par date</option> -->
                        <!-- <option value="i"  < ?php if ($niveau === "i")   echo "selected" ?>>Recherche par imprimé</option>
                        <option value="e0" < ?php if ($niveau === "e0")  echo "selected" ?>>Recherche commande en Attente</option>
                        <option value="e1" < ?php if ($niveau === "e1")  echo "selected" ?>>Recherche commande en Cours </option>
                        <option value="e2" < ?php if ($niveau === "e2")  echo "selected" ?>>Recherche commande Terminé </option> -->
                        <!-- <option value="e3" < ?php if ($niveau === "e3")  echo "selected" ?>>Recherche commande Livrée </option> -->
                        <!-- <option value="e5" < ?php if ($niveau === "e5")   echo "selected" ?>>Recherche commande archivée</option>
                        <option value="idcl"   < ?php if($niveau==="idcl")   echo "selected" ?>>Recherche par Id client</option>
                        <option value="idco"   < ?php if($niveau==="idco")   echo "selected" ?>>Recherche Id Commande</option>
                        <option value="idi"   < ?php if($niveau==="idi")   echo "selected" ?>>Recherche Id Imprimé</option>
                        <option value="p" < ?php if ($niveau === "p") echo "selected" ?>>Recherche par Etat Paiement</option>
                        <option value="prof" < ?php if ($niveau === "prof") echo "selected" ?>>Recherche par Proforma</option>
                        <option value="a" < ?php if ($niveau === "a") echo "selected" ?>>Recherche par commande annulée</option> -->
                        <!-- < ?php if ($niveau === "prof")   { ?>
                                                        <option value="prof"  < ?php echo "selected"; ?>>Recherche par Proforma
                                                    
                        </option> -->
                        <!-- <input type="text" name="recherche" placeholder="rechercher" value="< ?php echo @$recherche ?>" /> -->

                        <!-- < ?php } ?> -->
                    </select>
                </div>
                <br><br>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Chercher.....</button>
            </form>
        </div>
    </div>
    <!-- </div> -->
    <!-- $$$$$$$$$$$$$$$$$$$$$$fin recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    <div id="pagination">
        <!-- < ?php
            for($i=1;$i<=$nbr_de_pages ; $i++){
            if ($page!=$i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
            else echo "<a class='btn btn-success'>$i</a>&nbsp";
                        }
            ?> -->
    </div>

    <form name="fo1" method="post" action="actionselectiontest.php">
        <!-- < ?php
        if ($_SESSION['user']['role'] == 'ADMIN') { ?>
            <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                <span class="fa fa-arrow-down"></span>Valider .....</button>
                <br>
                <a href="./addproduction.php"  class="btn btn-primary">+ Production</a>
                <a href="./formcommande.php"  class="btn btn-primary">+ Commande</a>
                <a href="./addclient.php"  class="btn btn-primary">+ Client</a>
                <a href="./add.php"  class="btn btn-primary">+ Imprime</a>
            <br> <br>

        < ? php  }      ?> -->
        <div class="panel panel-primary">
            <div class="panel-heading">Liste de commandes (<?= @$compteur ?>)
                <!-- <input name='seltous' type="checkbox" value='seltous'> -->
            </div>
            <input type="text" id="listedate1" name="listedate1" value="<?php echo $dat ?>" placeholder="<?php echo $dat ?>" hidden>
            <input type="text" id="listedate2" name="listedate2" value="<?php echo $dat2 ?>" placeholder="<?php echo $dat2 ?>" hidden>
            <input type="text" id="recherche" name="recherche" value="<?php echo $recherche ?>" placeholder="<?php echo $recherche ?>" hidden>
            <input type="text" id="niveau" name="niveau" value="<?php echo $niveau ?>" placeholder="<?php echo $niveau ?>" hidden>


            <div class="table-responsive">
                <table class="table tab table-striped table-responsive ">
                    <thead class="table">
                        <th>
                            <input id="seltous" name='seltous' type="checkbox" value='seltous' onclick="myfunction()">
                            <span class="fa fa-arrow-down"></span>



                        </th>
                        <th>ID</th>
                        <th class="table-primary"><i class='fa fa-calendar' style='font-size:20px;color:black' aria-hidden='true'></i></th>
                        <!-- <th class="table-primary">ID client</th> -->
                        <th class="table-primary"><i class='fa fa-user-circle' style='font-size:20px;color:black' aria-hidden='true'></i></th>
                        <!-- <th class="table-primary">ID impri</th> -->
                        <th class="table-primary"><i class='fa fa-print' style='font-size:20px;color:black' aria-hidden='true'></i></th>
                        <th class="table-primary"><i class='fa fa-calculator' style='font-size:20px;color:black' aria-hidden='true'></i></th>
                        <th class="table-primary"><i class='fa fa-sitemap' style='font-size:20px;color:black' aria-hidden='true'></i></th>
                        <!-- <th class="table-primary">TAG</th> -->
                        <!-- < ?php
                        if ($_SESSION['user']['role'] == 'ADMIN') {
                        ?>
                            <th class="table-primary">prix</th>
                          
                            <th class="table-primary">total</th>
                        < ?php
                        } ?> -->
                        <!-- <th class="table-primary">remarque</th> -->
                        <!-- <th class="table-primary">etat</th> -->
                        <!-- < ?php
                        if ($_SESSION['user']['role'] == 'ADMIN') {
                        ?>
                            <th class="table-primary">Paiem</th>
                        < ?php } ?> -->
                        <th class="table-primary" style="color:green;font-weight:bold"> <i class="fa fa-picture-o" style='font-size:20px;color:blue' aria-hidden="true"></i></th>
                        <!-- <th class="table-primary">Qr code</th> -->
                        <th class="table-primary"><i class="fa fa-cog" style='font-size:20px;color:blue' aria-hidden="true"></i></th>
                        <!-- </div> -->
                    </thead>
                    <tbody>
                        <?php
                        $total1 = 0;
                        //$nombrecommandes=0;
                        // On boucle sur la variable result
                        // echo "<pre>";
                        // print_r($resultcommande);
                        // echo "</pre>";πnavbarok^
                        // echo $resultcommande[0]['id'];
                        // echo $resultcommande[0]['dates'];
                        //die();
                        // foreach($resultcommande as $commande)
                        // if (isset($resultcommande))
                        if (@$resultcommande != null)
                            for ($i = 0; $i <= count(@$resultcommande) - 1; $i++) {
                                if ($resultcommande[$i]['tag'] == 1) {
                                    // if (@$resultcommande[$i] == null) break;
                                    @$etatcolor[0] = explode("/", @$resultcommande[$i]['etat']);


                        ?>


                                <!-- for ($i = @$debut; $i <= @$nbr_element_page - 1 + @$debut; $i++) {
                            if (@$resultcommande[$i] == null) break; ?> -->
                                <tr>
                                    <td class="table-primary">

                                        <input id="sel" name='sel[]' type="checkbox" value=<?php echo $resultcommande[$i]['id'];
                                                                                            if (isset($sel)) {
                                                                                                if (@in_array($resultcommande[$i]['id'], @$sel)) echo "checked";
                                                                                            } ?>>

                                    </td>

                                    <td class="table-primary"><?= $resultcommande[$i]['id'] ?></td>




                                    <td class="table-success"><?= $resultcommande[$i]['dates'] ?></td>
                                    <!-- <td class="table-primary">< ?= $resultcommande[$i]['idclient'] ?></td> -->
                                    <td class="table-info" style="background-color:blue;color:white"><?= $resultcommande[$i]['nomclient'] ?></td>
                                    <!-- <td class="table-primary">< ?= $resultcommande[$i]['idimprime'] ?></td> -->
                                    <td class="table-warning"><?= $resultcommande[$i]['imprime'] ?></td>

                                    <td class="table-primary" style="background-color:blue;color:white"><?= $resultcommande[$i]['quantite'] ?></td>
                                    <!-- < ? php
                                if ($_SESSION['user']['role'] == 'ADMIN') {
                                ?>
                                    <td class="table-primary">< ?= number_format($resultcommande[$i]['prix'], 2, ".", ".") ?></td>
                                   
                                    <td class="table-danger" style="background-color:blue;color:white">< ?= number_format($resultcommande[$i]['total'], 2, ".", ".") ?></td>
                                < ?php } ?> -->
                                    <!-- <td class="table-primary">< ?= $resultcommande[$i]['remarque'] ?></td> -->
                                    <td class="table-primary">
                                        <?php

                                        //print_r($etatcolor[0][0]);
                                        // die();
                                        //$resultcommande[$i]['etat'] .
                                        if ($etatcolor[0][0] == 0) { ?>

                                            <!-- <i class='fa fa-hourglass-start fa-fw fa-3x' style='color:red' aria-hidden='true'></i><span style='background-color:blue;color:red;font-weight:bold'></span> -->
                                            <div class="limite">
                                            <i  class='fa attente fa-fw fa-3x' style='color:red' aria-hidden='true'></i>
                                            <span style='color:red;font-weight:bold'></span>
                                            <!-- <i class='fa fa-undo' style='font-size:30px;color:blue'  aria-hidden='true'></i> -->
                                            <!-- fa-hourglass-start -->
                                            </div>
                                        <?php }
                                        if ($etatcolor[0][0] == 1) {?>
                                            <!-- echo "<i class='fa  fa-cogs' style='font-size:30px;color:black' aria-hidden='true'></i><span style='background-color:blue;color:white;font-weight:bold'>" .  "</span>"; -->
                                            <i class="fa-solid fa-gear fa-spin fa-3x" style='color:blue'></i>
                                        <?php }
                                         if ($etatcolor[0][0] == 2) {?>

                                            <!-- echo "<i class='fa fa-check-square' style='font-size:30px;color:blue'  aria-hidden='true'></i><span style='background-color:green;color:black;font-weight:bold'>"  . "</span>"; -->
                                            <i class='fa fa-check-square fa-fw fa-3x' style='color:blue'  aria-hidden='true'></i><span style='background-color:green;color:black;font-weight:bold'></span>
                                         <?php }
                                        // if ($_SESSION['user']['role'] == 'ADMIN') {

                                            if ($etatcolor[0][0] == 3) { ?>
                                                <i class="fa-solid fa-truck-front fa-beat fa-fw fa-3x" style='color:Navy'></i>
                                                <!-- <i class='fa fa-truck fa-fw' style='font-size:<?= FONTSIZE?>;color:Navy' aria-hidden='true'></i> -->
                                                <span style='color:black;font-weight:bold'>
    
    
                                                <?php } ?>

                                            <?php
                                           if ($etatcolor[0][0] == 4) { ?>
                                            <!-- // echo "<i class='fa fa-ban' style='font-size:30px;color: DarkRed'  aria-hidden='true'></i> <span style='background-color:red;color:black;font-weight:bold'>"  . "</span>"; -->
                                            <i class='fa fa-ban fa-fw fa-3x' style='color: DarkRed'  aria-hidden='true'></i> 
                                            <?php } ?>
                                            <!-- <span style='background-color:red;color:black;font-weight:bold'></span> -->
                                            <?php if ($etatcolor[0][0] == 5) { ?>

                                                <i class='fa fa-archive fa-fw fa-3x' style='color:DarkGreen' aria-hidden='true'></i>

                                                <!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->





                                                <?php } ?>

                                                <?php
                                                // if ($etatcolor[0][0] == 6) { ? >
                                                // <i class='fa fa-newspaper-o fa-fw fa-3x' style='color:blue'  aria-hidden='true'></i><span style='color:blue;font-weight:bold'></span>

                                                // < ?php }
                                                ?>
                                            <!-- <span style="background-color:yellow;color:black;font-weight:bold" > -->
                                            <!-- < ?= $resultcommande[$i]['etat'] ?> -->

                                    </td>
                                    <!-- < ?php
                                if ($_SESSION['user']['role'] == 'ADMIN') {
                                    if ($etatcolor[0][0] != 6) {
                                ?>
                                <td class="table-primary"><span style="background-color:red;color:black;font-weight:bold">< ?= $resultcommande[$i]['paiement'] ?></td>
                                < ?php } else ?> 
                                < ?php      }   ?> -->


                                    <!-- <th class="table-primary">< ?= $resultcommande[$i]['tag'] ?></th>   -->
                                    <td>

                                        <?php

                                        if ($resultcommande[$i]['images'] != "") {
                                            //    $size = getimagesize('uploads/'.$resultcommande[$i]['images']); 
                                            //    $lar=$size[0];
                                            //    $hau=$size[1];
                                            //    //print_r($size);
                                            //    echo($lar.' '.$hau);
                                            //    $larimage='100';
                                        ?>
                                            <!-- echo '<img src="'.'uploads/'.$resultcommande[$i]['images'].'"  width="25" height="auto">' ? > -->

                                            <!-- < ?php echo "./uploads/".$resultcommande[$i]['images']?> -->

                                            <!-- <input   id="nomimage" value="< ?php echo $i ; ?>"/> -->
                                            <!-- <a id="nomimage" href='./uploads/< ?=$resultcommande[$i]['images'] ?>'  >  -->
                                            <?php
                                            $extension = substr($resultcommande[$i]['images'], strrpos($resultcommande[$i]['images'], "."));
                                            // echo $extension;
                                            // die();
                                            if ($extension != ".pdf") { ?>
                                                <a id="nomimage" href='afficherimage.php?image=<?= $resultcommande[$i]['images'] ?>'>
                                                    <?php echo '<img src="' . 'uploads/' . $resultcommande[$i]['images'] . '"  width="50" height="auto">' ?>
                                                    <!-- <i class="fa fa-picture-o" style='font-size:30px;color:blue' aria-hidden="true"></i> -->
                                                </a>
                                            <?php } else { ?>
                                                <a id="nomimage" href="afficherbc.php?bc=<?= $resultcommande[$i]['images'] ?>">
                                                    <i class='fa fa-file-pdf-o' style='font-size:30px;color:red'></i>
                                                    <!-- <i class="fa fa-file-image-o" aria-hidden="true"></i> -->
                                                    <!-- <i class="fa fa-picture-o" aria-hidden="true"></i> -->
                                            <?php }
                                        } ?>
                                    </td>
                                    <td>

                                        <a class="btn btn-primary btn-sm btn-success" href="action2ok.php?id=<?= $resultcommande[$i]['id'] ?>&page=<?= $page ?>&etat=<?=
                                                                                                                                                                        $resultcommande[$i]['etat'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>">
                                            <i class="fa fa-wrench" style='font-size:30px;color:blue' aria-hidden="true"></i>
                                        </a>
                                        <?php
                                        $idcommande = $resultcommande[$i]['id'];
                                        //$_GET['idcommande'];
                                        require('connectproduction.php');
                                        $sql = 'SELECT * FROM `production` WHERE `idcommande` = :idcommande;';
                                        $query = $db->prepare($sql);
                                        $query->bindValue(':idcommande', $idcommande, PDO::PARAM_INT);
                                        // // On exécute la requête
                                        $query->execute() or die(print_r($db->errorInfo()));

                                        //On stocke le résultat dans un tableau associatif
                                        $prod = $query->fetch(PDO::FETCH_ASSOC);
                                        require('closeproduction.php');


                                        if ($prod != "") { ?>

                                            <a class="btn btn-primary btn-sm btn-success" href="etatproduction.php?recherche=&niveau=ins&idcommande=<?= $resultcommande[$i]['id'] ?>&simplifie=1">
                                                <i class="fa fa-industry" style='font-size:30px;color:blue' aria-hidden="true"></i>
                                            </a>


                                        <?php } ?>
                                    </td>




                                </tr>

                        <?php
                                    //$total1 += $resultcommande[$i]['total'];
                                    //$nombrecommandes+=1;
                                }
                            } // fin du for
                        ?>
                        <!-- <td class="table-primary">Total en DZ</td>
                        <td class="table-danger"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td> -->
                        <!-- <td class="table-primary"></td>
                                    <td class="table-primary"></td> -->
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <?php
                        if ($_SESSION['user']['role'] == 'ADMIN') {
                        ?>
                            <td class="table-success"><?= number_format($total1, 2, ".", ".") ?></td>
                        <?php } ?>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                    </tbody>

                </table>

            </div>

        </div>
        <!-- <div class="container">
                            
        </div> -->
        <?php
        if ($_SESSION['user']['role'] == 'ADMIN' && @$compteur > 5) { ?>
            <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                <span class="fa fa-arrow-down"></span>
                Valider .....
            </button>
        <?php } ?>
    </form>
    <br>
    <!-- <a href="addcommande.php" class="btn btn-primary">Ajouter une commande</a> -->

    <!-- < ?php
                        for($i=1;$i<=$nbr_de_pages ; $i++){
                            if ($page!=$i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
                            else echo "<a class='btn btn-success'>$i</a>&nbsp";
                        }
                        ?>        -->
    <!-- </div>

            </div> -->
    <!-- <script src="sweetalert2.all.min.js"></script> -->

    <!-- <script>
        Swal.fire('Any fool can use a computer');
    </script> -->
    <script>
        function myfunction() {
            var sel = document.querySelectorAll('#sel');
            //console.log(sel.length);
            var elt = document.querySelector('#seltous');
            if (elt.checked) {
                //console.log("cochée");
                for (let i = 0; i < sel.length; i++) {
                    sel[i].checked = true;

                }

            } else {
                //console.log("non cochée");
                for (let i = 0; i < sel.length; i++) {
                    sel[i].checked = false;

                }
            }
        }
    </script>
    <!-- <script src="./js/script.js"></script> -->

    <script>
function hourglass() {
  var a;
 
  a = document.querySelectorAll("i.attente");
  //longueur=length.a;
//   console.log(a.length);
//   console.log(a[0]);
 for (let i = 0; i < a.length; i++) {
    // const element = array[i];
    a[i].innerHTML = "&#xf251;";
  setTimeout(function () {
      a[i].innerHTML = "&#xf252;";
    }, 1000);
  setTimeout(function () {
      a[i].innerHTML = "&#xf253;";
    }, 2000);
 }
 
}
    hourglass();
setInterval(hourglass, 3000);
// function hourglass1() {
//   var a;
 
//   a = document.getElementById("attente1");
//   console.log(a);
//   a.innerHTML = "&#xf251;";
//   setTimeout(function () {
//       a.innerHTML = "&#xf252;";
//     }, 1000);
//   setTimeout(function () {
//       a.innerHTML = "&#xf253;";
//     }, 2000);
// }
//     hourglass1();
// setInterval(hourglass1, 3000);



</script>
</body>

</html>