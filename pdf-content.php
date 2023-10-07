<?php
// On démarre une session
ini_set("display_errors", 1);
error_reporting(-1);
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
include('../functions/ChiffresEnLettres.php');
// $num = 1999.9;
// $formattedNum = number_format($num)."<br>";
// echo $formattedNum;
// $formattedNum = number_format($num, 2);
// echo $formattedNum;
// echo number_format("1000000")."<br>";
// echo number_format("1000000",2)."<br>";
// echo number_format("1000000",2,",",".");

//echo $_SESSION['numblclient'];
$trieclientid = $_SESSION['numblclient'];
$datebl = date('d-m-Y');

require_once('connectcommande.php');
//`id`=:id;';
$sql = "SELECT * FROM `commande` WHERE idclient=$trieclientid";
//echo $trieclientid;
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r(count($resultcommande));
// echo "</pre>";
require_once('closecommande.php');
// if (count($resultcommande)>0){
// $date1erecommande=$resultcommande[0]['dates'];
// $nomclient=$resultcommande[0]['nomclient'];
// } else {
//     $_SESSION['erreur'] = "Aucune commande pour ce client"; 
//     header('Location: ../clients/trieclient.php');
//     die();
// }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylebl.css">
    <link rel="stylesheet" type="text/css" href="../css/impression.css" media="print">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Bon de livraison</title>
</head>

<body>


    <!-- <h1 class="entete">Liste de commandes par client</h1> -->
    <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->
    <div class="container">
        <div class="logo">
            <img src="../images/logo.avif" alt="logo global2pub" width="100" height="auto">


        </div>
        <div class="en tete bold">
            <p class="gras">Boualam Ahmed</p>
            <p class="gras"> Agence de communication et publicité</p>
            <p> IF 17031010601018900000 RC N° 31/00-5428133A Article N°31018105204 </p>
            <p class="gras">Tous travaux d'impression & publicité internet & video de présentation </p>
            <p>Adresse:Bt N°A5 Hlm Hai ibn rochd Oran Algerie</p>
            <p>Contact 0541 03 55 48 E-mail contact@global2-pub.com </p>

        </div>

    </div>
    <hr>
    <div class="containerbl">
        <div class="stylebl">
            <p>Bon de livraison N°001 du <?= $datebl ?></p>

            <!-- <p>N° <?= $trieclientid . " " . $nomclient ?></p> -->
            <p>Adresse: cite usto oran</p>
            <p>E-mail:hachemani@liberte.com</p>
        </div>
        <div class="stylebl">
            <!-- < ?php
    if  (@$_SESSION['valider']==="oui") {
        $fp=fopen("../numbl.txt","r+");
        $nbr=fgets($fp);
        fclose($fp);
       // $_SESSION['valider']="non";
    } else $nbr=0;
   
    ?> -->
            <p>Bon de livraison N°<?= $nbr ?> <br> du <?= $datebl ?></p>

            <!-- <p>N° <?= $trieclientid . " " . $nomclient ?></p> -->
            <!-- <p>Adresse Client</p>
    <p>E-mail</p> -->
        </div>
        <!-- <div class="stylebl">
    <p>Bon de livraison N°001 du <?= $datebl ?></p> 
   
    <p>N° <?= $trieclientid . " " . $nomclient ?></p>
    <p>Adresse:Cite usto zone des sièges Oran</p>
    <p>E-mail:new@gmail.com</p> -->
    </div>
    </div>

    <!-- <br>
    <hr> -->
    <!-- <h2>Date commande Le < ?= $date1erecommande ?></h2>     -->
    <!-- <a id="bouton" href="../clients/trieclient.php" class="btn btn-primary btn-block">Retourner ou Annuler</a>
    <a id="bouton" href="validerbl.php" class="btn btn-primary btn-block">Valider le Bon de livraison</a>
    <a id="bouton" href="" class="btn btn-primary btn-block">Generer le pdf du bon de livraison</a>
    <a id="bouton"href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer le Bon de livraison</a>
    <a id="bouton" href="../clients/trieclient.php" class="btn btn-danger btn-block">Deconnecter</a> -->
    <!-- <a href="../imprimes/index.php" class="btn btn-primary btn-block">Liste imprimés</a>
                <a href="../clients/indexclient.php" class="btn btn-primary btn-block">Liste clients</a> -->

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
                $nombrecommandes = 0;
                // On boucle sur la variable result
                foreach ($resultcommande as $commande) {
                ?>
                    <tr>
                        <td class="table-pri mary"><?= $commande['id'] ?></td>
                        <!-- <td class="table-success">< ?= $commande['dates'] ?></td> -->
                        <!-- <td class="table-pr imary">< ?= $commande['idclient'] ?></td> -->
                        <!-- <td class="table-in fo"><?= $commande['nomclient'] ?></td> -->
                        <td class="table-pr imary"><?= $commande['idimprime'] ?></td>
                        <td class="table-war ning"><?= $commande['imprime'] ?></td>
                        <td class="table-pri mary"><?= $commande['quantite'] ?></td>
                        <td class="table-pri mary"><?= number_format($commande['prix'], 2, ",", ".") ?></td>
                        <td class="table-pri mary"><?= $commande['prepress'] ?></td>
                        <td class="table-dan ger"><?= number_format($commande['total'], 2, ",", ".") ?></td>
                        <!-- <td class="table-primary">< ?= $commande['remarque'] ?></td>
                                <td class="table-primary">< ?= $commande['etat'] ?></td>
                                <td class="table-primary">< ?= $commande['paiement'] ?></td> -->
                        <!-- <td class="table-success"> -->
                        <div class="btn-group">

                        </div>
                        </td>



                    </tr>

                <?php
                    $total1 += $commande['total'];
                    $nombrecommandes += 1;
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
                <td class="table-success"><?= number_format($total1, 2, ",", ".") ?></td>
                <!-- <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td> -->
            </tbody>

        </table>
    </div>
    <?php $lettre = new ChiffreEnLettre();
    $chiffre = intval($total1);
    $lettre->Conversion($chiffre);
    $chaine = $lettre->enLettre . " DA";
    //$chaine = mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
    ?>
    <p>Arrété le présent Bon de livraison à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>

    <div class="basdepage">


        <p>Accusé de réception</p>
        <p>signature</p>
    </div>
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