<?php

//require_once('role.php');
// inclue la fonction de chiffre en lettre
include('./functions/ChiffresEnLettres.php');
//echo $_SESSION['valider'];

//$resultcommande=[];

$fichier = isset($_GET['fichier']) ? $_GET['fichier'] : "";
$idcommandes = isset($_GET['idcommandes']) ? $_GET['idcommandes'] : "";
$numbl = isset($_GET['numbl']) ? $_GET['numbl'] : "";
$client = isset($_GET['client']) ? $_GET['client'] : "";
$datebl = isset($_GET['datebl']) ? $_GET['datebl'] : "";
$montantbl = isset($_GET['montantbl']) ? $_GET['montantbl'] : 0;
$modepaiement=isset($_GET['modepaiement']) ? $_GET['modepaiement'] : "";
// isoler id commande et qte sur bon de livraison

$tabqte = explode("/", $idcommandes);
//print_r($tabqte);
//echo "<br>";
$compteur0 = count($tabqte);
//if ($compteur0 > 1) $compteur0 = $compteur0 - 1;
for ($i = 0; $i < $compteur0; $i++) {
    $idcomm[$i] = explode("-", $tabqte[$i]);
    // echo "<br>";
    // print_r($idcomm[$i]);
    // echo "<br>";
}
// print_r($idcomm);
// echo count($idcomm);
$compteur = count($idcomm);
if ($compteur > 1) $compteur = $compteur - 1;
require_once('serveur.php');
require_once('connectcommande.php');
for ($i = 0; $i < $compteur; $i++) {

    $idd =  $idcomm[$i][0];

    $sql = 'SELECT * FROM `commande` WHERE `id` = :idd;';

    $query = $db->prepare($sql);
    $query->bindValue(':idd', $idd, PDO::PARAM_INT);
    // On exécute la requête
    $query->execute();
    //or die(print_r($db->errorInfo()));

    // On stocke le résultat dans un tableau associatif
    $resultcommande[$i] = $query->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($resultcommande);
    // echo "</pre>";
    if ($resultcommande[$i] == false) {
        $_SESSION['erreur'] .= " document introuvable ou commande effacé";

        header('Location: document.php?niveau1=t');
        //                                 die();}

         die();
    }
}
//  echo "<pre>";
//    print_r($resultcommande);
//    echo "</pre>";
//    die();



$trieclientid = $resultcommande[0]['idclient'];
require_once('closecommande.php');


require_once('connectclient.php');

// On nettoie l'id envoyé
$id = $trieclientid;


$sql = 'SELECT * FROM `client` WHERE `id` = :id;';
// On prépare la requête
$query = $db->prepare($sql);

// On "accroche" les paramètre (id)
$query->bindValue(':id', $id, PDO::PARAM_INT);

// On exécute la requête
$query->execute();

// On récupère le produit
$client = $query->fetch();



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/stylebl.css">
    <link rel="stylesheet" type="text/css" href="./css/impression.css" media="print">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Bon de livraison</title>
</head>

<body>
    <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

    <!-- <h1 class="entete">Liste de commandes par client</h1> -->
    <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->
    <?php require_once('./navbarok.php') ?>
    <div class="container">
        <div class="logo">
            <img src="images/logoneio.png" alt="logo neio" width="60" height="auto">


        </div>
        <div class="ent ete bold">
            <h3 class="gras">Imprimerie NEIO</h3>
            <p class="gras">Imprimerie Industrielle Tous travaux d'imprimerie</p>
            <p> Offset-impression numerique-Emballage-Etiquette-Travaux de ville </p>
            <!-- <p class="gras">Publicité internet & video de présentation conception de sites web	</p>		 -->
            <p>17 rue moussa Ahmed(Ex Cuvelier) Oran</p>
            <p>RC N°98A0520726 IF 193731010287140 Article N°31806613011 </p>
        <p>Nis 194331010677042 RIB BNA N°00100960030010136077</p>
    
            <p>Contact 0541 03 55 48/0555 11 97 37 site web https://global2pub.com <br> e-mail contactpub@global2pub.com </p>

        </div>

    </div>
    <hr>

    <div class="containerbl stylebl">

        <!-- <p>Bon de livraison N°001 du < ?= $datebl ?></p>  -->

        <!-- <p> < ?= $client ?></p> -->
        <!-- <p>Adresse:</p> -->
        <!-- <p>E-mail:</p>
    <p>Tel:</p> -->



        <p><?php if ($fichier[0] == "b" && $fichier[1] == "l") { ?>
        <p class="gras">N° <?= $client['id'] . " " . $client['client'] ?></p>
        <p> Bon de livraison N°<?= $numbl . " du " . $datebl ?></p>
        <p><?php echo $client['adresse'] ?></p>

        <!-- <p>id commandes < ?= $idcommandes ?></p> -->
    <?php } ?>

    <p><?php if ($fichier[0] == "p" && $fichier[1] == "r") { ?>

            Proforma N°<?= $numbl . " du " . $datebl ?></p>
    <p><?php echo $client['adresse'] ?></p>

    <!-- <p>id commandes < ?= $idcommandes ?></p> -->

<?php } ?>


<p><?php if ($fichier[0] == "f" && $fichier[1] == "a") { ?>

        Facture  N°<?= $numbl . " du " . $datebl ?></p>
<!-- <p>id commandes < ?= $idcommandes ?></p> -->


<p class="gras">N° <?= $client['id'] . " " . $client['client'] ?></p>

 
    <!-- <p>Mode Paiement:virement tresor</p> -->
    <!-- <p>Type de livraison:</p> -->
    <?php if ($client['activite']!=''): ?>
    <p>Activite:<?php echo $client['activite'] ?></p>
    <?php endif?>
    
    <?php if ($client['telsiege']!=''): ?>
        <p>Telephone:<?php echo $client['telsiege'] ?></p>
        
        <?php endif?>
        
    <p><?php echo $client['adresse'] ?></p>
    
    <p>Rc:<?php echo $client['registre'] ?></p>
    <p>NIF:<?php echo $client['idfiscal'] ?></p>
    <?php 
    if ($client['nis']!="") { ?>
    <p>NIS:<?php echo $client['nis'] ?></p>
    <?php } ?>
   
    <p>Article:<?php echo $client['art'] ?></p>
  
    <p>Mode de paiement:<?= $modepaiement ?></p>
 
   <?php } ?>   

    </div>

    <!-- <br>
    <hr> -->
    <!-- <h2>Date commande Le < ?= $date1erecommande ?></h2>     -->

    

    <div class="tab table-responsive-sm table-striped">

        <table class="table">
            <thead>
                <th>CC</th>
                <!-- <th>Date commande</th> -->
                <!-- <th>ID client</th> -->
                <!-- <th>client</th> -->
                <th>CI</th>
                <th>Désignation imprimé</th>
                <th>quantité</th>
                <th>prix TTC</th>
                <th>prepress</th>
                <th>Total TTC</th>
                <!-- <th>remarque</th>
                        <th>etat</th>
                        <th>paiement</th>
                      
                        <th>Actions</th> -->
            </thead>
            <tbody>
                <?php
                $total1 = 0;
                $total = 0;
                //$nombrecommandes=0;
                // On boucle sur la variable result
                // foreach(@$resultcommande as $commande){
                for ($i = 0; $i < $compteur; $i++) {
                ?>
                    <tr>
                        <!-- <td class="table-primary"></td> -->

                        <!-- <td class="table-success">< ?= $commande['dates'] ?></td> -->
                        <!-- <td class="table-pr imary">< ?= $commande['idclient'] ?></td> -->
                        <td class="table-in fo"><?= $resultcommande[$i]['id'] ?></td>
                        <td class="table-pr imary"><?= $resultcommande[$i]['idimprime'] ?></td>
                        <td class="table-war ning"><?= $resultcommande[$i]['imprime'] ?></td>
                        <!-- <td class="table-pri mary">< ?= $resultcommande[$i]['quantite'] ?></td> -->
                        <td class="table-pri mary"><?= $idcomm[$i][1] ?></td>
                        <td class="table-pri mary"><?= $resultcommande[$i]['prix'] ?></td>
                        <td class="table-pri mary"><?= $resultcommande[$i]['prepress'] ?></td>

                        <?php


                        //var_dump($total);
                        // var_dump($idcomm[$i][1]);
                        // var_dump($resultcommande[$i]['prix']);
                        // var_dump($resultcommande[$i]['prepress']);
                        $total = $idcomm[$i][1] * $resultcommande[$i]['prix'] + $resultcommande[$i]['prepress'];
                        //  var_dump($total);
                        ?>
                        <td class="table-dan ger"><?= number_format($total, 2, ",", ".")  ?>
                            <!-- number_format($total, 2, ",", ".") -->
                        </td>
                        <!-- <td class="table-primary">< ?= $commande['remarque'] ?></td>
                                <td class="table-primary">< ?= $commande['etat'] ?></td>
                                <td class="table-primary">< ?= $commande['paiement'] ?></td> -->
                        <!-- <td class="table-success"> -->
                        <div class="btn-group">

                        </div>
                        </td>



                    </tr>

                <?php
                    $total1 += $total;
                    // on remplace  le la valeur transmise par l'url par celle du total general calcule
                    $montantbl=$total1;
                    //(@$idcomm[$i][1]*$resultcommande[$i]['prix'])+$resultcommande[$i]['prepress'];

                    //$nombrecommandes+=1;
                }


                ?>
                <!-- <td class="table-primary">Total en DZ</td> -->
                <!-- <td class="table-d anger"></td> -->
                <!-- <td class="table-p rimary"></td> -->
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>

                <td class="table-p rimary">Total Gle TTC</td>
                <td class="table-success"><span class="gras"><?= number_format($montantbl, 2, ",", ".") ?> </span></td>
                <?php
                //echo $total1 . " " . $montantbl;

                $montantbl = floatval($montantbl);
                $total1 = floatval($total1);
                //+ 0.00000000001;
                // var_dump($total1);
                // var_dump($montantbl);
                // if ($total1 <> $montantbl) {
                //     $_SESSION['erreur'] .= "Document non conforme à l'original ";
                //     if (!empty($_SESSION['erreur'])) {
                //         echo '<div class="alert alert-danger .alert-dismissible" role="alert">
                //                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                //                         ' . $_SESSION['erreur'] . '
                //                     </div>';
                //         $_SESSION['erreur'] = "";
                //     }
                    //header("Location: documentafficher.php");

                //} 
                ?>
                <!-- <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td> -->
            </tbody>

        </table>
    </div>

    <?php



    //$chiffre=$total1;
    // if ($total1!=$chiffre) $fraction=($total1-$chiffre)*100;
    //$lettre->Conversion($chiffre);
    //$chaine= $lettre->enLettre." DA";
    //$chaine = mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
    $chiffre = intval($montantbl);
    $reste = intval(($montantbl - $chiffre) * 100);
    //var_dump( $reste);
    $lettre = new ChiffreEnLettre();
    $lettre->Conversion($chiffre);
    if ($reste == 0) $chaine = $lettre->enLettre . " DA";
    else $chaine = $lettre->enLettre . " DA et $reste centimes"; ?>
<p> <span class="gras" style="color:red">Non Assujetti à la TVA</p>
    <p>Arrété le présent document à la somme de <span class="gras"> <?= " " . $chaine ?></span></p>
    <!-- <a id="bouton" href="./document.php?page=1&recherche=&niveau1=t" class="btn btn-primary btn-block">Retourner ou Annuler</a> -->

    <a id="bouton"  class="btn btn-primary btn-block" onclick="window.history.back()">Retourner ou Annuler</a>
   
    <!-- <a id="bouton" href="validerbl.php?idclient=<?= $trieclientid ?>" class="btn btn-primary btn-block">Valider le Bon de livraison</a> -->
    <!-- <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf du document</a> -->
    <a id="bouton" href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer le document</a>
    <!-- <a id="bouton" href="sms/envoismsok.php?idclient=< ?= $trieclientid ?>" class="btn btn-primary btn-block">Envoyer Sms de livraison</a> -->

    <!-- <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>'" class="btn btn-primary btn-block">Envoyer Sms</a> -->
    <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer e-mail ?')) document.location.href='invoice/envoimailpjdoc.php?idclient=<?= $trieclientid ?>'" class="btn btn-primary btn-block">Envoyer e-mail</a>
    <div class="basdepage">
        <?php if ($fichier[0] == "b" && $fichier[1] == "l") { ?>

            <p>Accusé de reception client</p>
            <p>Cachet et signature</p>
        <?php } ?>
    </div>
    <!-- <img  class="cachet" src="./images/cachet2.png" alt="logo global2pub" width="230" height="auto"> -->

<br>
</body>

</html>
<!-- < ?php
include('ChiffreEnLettre.php');
?>
au lieu où vous voulez l'afficher faites:
< ?php
$lettre=new ChiffreEnLettre();
$lettre->Conversion($chiffre);
?>
$lettre est une instance de la classe ChiffreEnLettre
$chiffre est la variable qui stocke le chiffre que nous devons traduire en lettre
Conversion() est la fonction qui génère la conversion du chiffre en lettre.	 -->