<?php
require_once "const.php";

include('./functions/ChiffresEnLettres.php');
//$trieclientid=$_SESSION['numblclient'];
$datebl = date('d-m-Y') . ' à ' . date("H:i");
if (@$nbr !== 0) {
    $nbr = 0;
};
require_once('connectcommande.php');
//`id`=:id;';
$id = strip_tags($_GET['id']);
$sql = 'SELECT * FROM `commande` WHERE `id` = :id;';
// On prépare la requête
$query = $db->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);
// On exécute la requête
$query->execute();
// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r(count($resultcommande));
// echo "</pre>";
require_once('closecommande.php');
//  if (count($resultcommande)>0){
//  //$date1erecommande=$resultcommande[0]['dates'];
//  //$nomclient=$resultcommande[0]['nomclient'];
//  } else {
//      $_SESSION['erreur'] = "Aucune commande pour ce client"; 
//      header('Location: ../commandes/indexcommande.php');
//     die();
// }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylebl.css">
    <link rel="stylesheet" type="text/css" href="./css/impression.css" media="print">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Proforma</title>
</head>

<body>


    <!-- <h1 class="entete">Liste de commandes par client</h1> -->
    <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->
    <div class="container">
        <div class="logo">
            <img src="./images/logo.avif" alt="logo global2pub" width="100" height="auto">


        </div>
        <div class="en tete bold">
            <p class="gras">Boualam Ahmed</p>
            <p class="gras"> Agence de communication et publicité</p>
            <p> IF 17031010601018900000 RC N° 31/00-5428133A Article N°31018105204 </p>
            <p class="gras">Tous travaux d'impression & publicité internet & video de présentation </p>
            <p>Adresse:Bt N°A5 Hlm Hai ibn rochd Oran Algerie</p>
            <p>Contact 0541 03 55 48 site web https://global2-pub.com <br> e-mail contact@global2-pub.com </p>

        </div>

    </div>
    <hr>
    <br>
    <div class="containerbl">
        <div class="stylebl">
            <!-- <p>Bon de livraison N°001 du < ?= $datebl ?></p>  -->

            <p>N° <?= $resultcommande["idclient"] . " " . $resultcommande["nomclient"] ?></p>
            <p>Adresse:</p>
            <p>E-mail:</p>
            <p>Tel:</p>
        </div>
        <div class="stylebl">
            <?php
            if ($_SESSION['valider'] === "oui") {
                $fp = fopen("./proforma.txt", "r+");
                $nbr = fgets($fp);
                fclose($fp);
                // $_SESSION['valider']="non";
            } else $nbr = 0;

            ?>
            <p>Proforma N°<?= $nbr ?> <br> du <?= $datebl ?></p>

            <!-- <p>N° < ?= $trieclientid." ".$nomclient ?></p> -->
            <!-- <p>Adresse Client</p>
    <p>E-mail</p> -->
        </div>
        <!-- <div class="stylebl">
    <p>Bon de livraison N°001 du < ?= $datebl ?></p> 
   
    <p>N° < ?= $trieclientid." ".$nomclient ?></p>
    <p>Adresse:Cite usto zone des sièges Oran</p>
    <p>E-mail:new@gmail.com</p> -->
    </div>
    </div>
    <br>
    <!-- <br>
    <hr> -->
    <!-- <h2>Date commande Le < ?= $date1erecommande ?></h2>     -->
    <a id="bouton" href="./indexcommande.php?page=1" class="btn btn-primary btn-block">Retourner ou Annuler</a>
    <a id="bouton" href="validerproforma.php?id=<?= $id ?>" class="btn btn-primary btn-block">Valider la proforma</a>
    <a id="bouton" href="" class="btn btn-primary btn-block">Telecharger le pdf</a>
    <a id="bouton" href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer la proforma</a>
    <!-- <a id="bouton" href="./trieclient.php" class="btn btn-danger btn-block">Deconnecter</a> -->
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
                //  $nombrecommandes=0;
                // On boucle sur la variable result
                // foreach($resultcommande as $commande){
                // 
                ?>
                <tr>
                    <td class="table-pri mary"><?= $resultcommande['id'] ?></td>

                    <!-- <td class="table-success">< ?= $commande['dates'] ?></td> -->
                    <!-- <td class="table-pr imary">< ?= $commande['idclient'] ?></td> -->
                    <!-- <td class="table-in fo"><?= $resultcommande['nomclient'] ?></td> -->
                    <td class="table-pr imary"><?= $resultcommande['idimprime'] ?></td>
                    <td class="table-war ning"><?= $resultcommande['imprime'] ?></td>
                    <td class="table-pri mary"><?= $resultcommande['quantite'] ?></td>
                    <td class="table-pri mary"><?= number_format($resultcommande['prix'], 2, ",", ".") ?></td>
                    <td class="table-pri mary"><?= $resultcommande['prepress'] ?></td>
                    <td class="table-dan ger"><?= number_format($resultcommande['total'], 2, ",", ".") ?></td>
                    <!-- <td class="table-primary">< ?= $commande['remarque'] ?></td>
                                <td class="table-primary">< ?= $commande['etat'] ?></td>
                                <td class="table-primary">< ?= $commande['paiement'] ?></td> -->
                    <!-- <td class="table-success"> -->
                    <div class="btn-group">

                    </div>
                    </td>



                </tr>

                <?php
                $total1 += $resultcommande['total'];
                //  $nombrecommandes+=1;
                // }
                ?>
                <!-- <td class="table-primary">Total en DZ</td> -->
                <!-- <td class="table-d anger"></td> -->
                <!-- <td class="table-p rimary"></td> -->
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <br>
                <td class="table-p rimary">Total Gle TTC</td>
                <td class="table-success"><span class="gras"><?= number_format($total1, 2, ",", ".") ?> </span></td>
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
    <br>
    <p>Arrété la présente proforma à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>
    <br> <br>
    <div class="basdepage">


        <p></p>
        <p>Cachet et signature</p>
    </div>
    <img class="cachet" src="images/cachet2.png" alt="logo global2pub" width="230" height="auto">

</body>

</html>