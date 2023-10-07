<?php
require_once "const.php";

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
$idcomm = explode("-", $idcommandes);
// print_r($idcomm);
// echo count($idcomm);
$compteur = count($idcomm);
if ($compteur > 1) $compteur = $compteur - 1;
require_once('serveur.php');
require_once('connectcommande.php');
for ($i = 0; $i < $compteur; $i++) {

    $idd =  $idcomm[$i];

    $sql = 'SELECT * FROM `commande` WHERE `id` = :idd;';

    $query = $db->prepare($sql);
    $query->bindValue(':idd', $idd, PDO::PARAM_INT);
    // On exécute la requête
    $query->execute() or die(print_r($db->errorInfo()));

    // On stocke le résultat dans un tableau associatif
    $resultcommande[$i] = $query->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($resultcommande);
    // echo "</pre>";
    // die();

}
require_once('closecommande.php');




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
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->

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
            <img src="images/logoneio.png" alt="logo neio" width="100" height="auto">


        </div>
        <div class="en tete bold">
            <h3 class="gras">Imprimerie NEIO</h3>
            <p class="gras">Imprimerie Industrielle Tous travaux d'imprimerie</p>
            <p> Offset-impression numerique-Emballage-Etiquette-Travaux de ville </p>
            <!-- <p class="gras">Publicité internet & video de présentation conception de sites web	</p>		 -->
            <p>17 rue moussa Ahmed(Ex alexis cuvelier) ex Halles centrales Oran</p>
            <p>Contact 0541 03 55 48/0555 11 97 37 site web https://global2-pub.com <br> e-mail contactpub@global2-pub.com </p>

        </div>

    </div>
    <hr>

    <div class="containerbl">
        <div class="stylebl">
            <!-- <p>Bon de livraison N°001 du < ?= $datebl ?></p>  -->

            <p> <?= $client ?></p>
            <p>Adresse:</p>
            <!-- <p>E-mail:</p>
    <p>Tel:</p> -->
        </div>
        <div class="stylebl">

            <p><?php if ($fichier[0] == "b" && $fichier[1] == "l") { ?>

                    Bon de livraison N°<?= $numbl . "<br> du " . $datebl ?></p>
            <!-- <p>id commandes < ?= $idcommandes ?></p> -->
        <?php } ?>

        <p><?php if ($fichier[0] == "p" && $fichier[1] == "r") { ?>

                Proforma N°<?= $numbl . "<br> du " . $datebl ?></p>
        <!-- <p>id commandes < ?= $idcommandes ?></p> -->
    <?php } ?>

    <p><?php if ($fichier[0] == "f" && $fichier[1] == "a") { ?>

            Facture N°<?= $numbl . "<br> du " . $datebl ?></p>
    <!-- <p>id commandes < ?= $idcommandes ?></p> -->
<?php } ?>
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

    <!-- <br>
    <hr> -->
    <!-- <h2>Date commande Le < ?= $date1erecommande ?></h2>     -->

    <a id="bouton" href="./document.php?page=1&recherche=&niveau1=t" class="btn btn-primary btn-block">Retourner ou Annuler</a>
    <!-- <a id="bouton" href="validerbl.php?idclient=<?= $trieclientid ?>" class="btn btn-primary btn-block">Valider le Bon de livraison</a> -->
    <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf du document</a>
    <a id="bouton" href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer le document</a>
    <!-- <a id="bouton" href="sms/envoismsok.php?idclient=< ?= $trieclientid ?>" class="btn btn-primary btn-block">Envoyer Sms de livraison</a> -->

    <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>'" class="btn btn-primary btn-block">Envoyer Sms</a>
    <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href=''" class="btn btn-primary btn-block">Envoyer e-mail</a>

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
                        <td class="table-pri mary"><?= $resultcommande[$i]['quantite'] ?></td>
                        <td class="table-pri mary"><?= number_format($resultcommande[$i]['prix'], 2, ".", ".") ?></td>
                        <td class="table-pri mary"><?= $resultcommande[$i]['prepress'] ?></td>
                        <td class="table-dan ger"><?= number_format($resultcommande[$i]['total'], 2, ".", ".") ?></td>
                        <!-- <td class="table-primary">< ?= $commande['remarque'] ?></td>
                                <td class="table-primary">< ?= $commande['etat'] ?></td>
                                <td class="table-primary">< ?= $commande['paiement'] ?></td> -->
                        <!-- <td class="table-success"> -->
                        <div class="btn-group">

                        </div>
                        </td>



                    </tr>

                <?php
                    $total1 += @$resultcommande[$i]['total'];
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

    <p>Arrété le présent document à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>

    <div class="basdepage">
        <?php if ($fichier[0] == "b" && $fichier[1] == "l") { ?>

            <p>Accusé de reception client</p>
            <p>Cachet et signature</p>
        <?php } ?>
    </div>
    <!-- <img  class="cachet" src="./images/cachet2.png" alt="logo global2pub" width="230" height="auto"> -->

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