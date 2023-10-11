<?php
//require_once "const.php";
// bonjour ca va
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "const.php";
// if (!isset($_SESSION['user'])) {
//     header('Location:login.php');
//     exit();
// }
date_default_timezone_set("Africa/Algiers");
// define("ICONFONT","23px");
// define("FONTSIZE","30px");


ini_set("display_errors", 1);
error_reporting(-1);




if (!empty($_SESSION['erreur'])) {
    echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['erreur'] . '
        </div>';
    $_SESSION['erreur'] = "";
}
if (!empty($_SESSION['message'])) {
    echo '<div class="alert alert-success .alert-dismissible" role="alert">

    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['message'] . '
        </div>';

    $_SESSION['message'] = "";
}








$modesimplifie = isset($_GET['simplifie']) ? $_GET['simplifie'] : 0;
//debut appel depuis commande pour recuperer la fiche production
if (isset($_GET['idcommande'])) {
    $idcommande = $_GET['idcommande'];
    require('connectproduction.php');
    $sql = 'SELECT * FROM `production` WHERE `idcommande` = :idcommande;';
    $query = $db->prepare($sql);
    $query->bindValue(':idcommande', $idcommande, PDO::PARAM_INT);
    // // On exécute la requête
    $query->execute() or die(print_r($db->errorInfo()));
    //  print_r($query);
    // // On stocke le résultat dans un tableau associatif
    $prod = $query->fetch(PDO::FETCH_ASSOC);
    require_once('closeproduction.php');
    //     echo "<br>";
    //     echo "<pre>";
    //    print_r($prod);
    //    echo "</pre>";
    //    echo "<br>";
    //   print_r($prod);
    //die();
    if ($prod != "") {





        $idprod = $prod['idprod'];
        $dates = $prod['dates'];
        $idcommande = $prod['idcommande'];
        $idimprime = $prod['idimprime'];
        if ($idimprime == 0) $_SESSION['erreur'] .= "Id imprime Vide dans table production";

        require('./connect.php');

        $sql = "SELECT * FROM `imprimes` WHERE `id`=$idimprime";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On stocke le résultat dans un tableau associatif 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // echo "<br>";
        // echo "<br>";
        //  echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // echo "<br>";
        require_once('./close.php');
        $typ = @$result['typ'];
        $chaine = @$result['etapes'];
        //$chainedecoupe=explode(",",$chaine);
        $typdecoupe = explode(",", $typ);
        //$compt=count($chainedecoupe);
        $compt0 = count($typdecoupe);
        $formatfinie = $result['formatfinie'];


        // echo "</pre>";
        // echo "<br>";
        // echo "<pre>";
        // print_r($typdecoupe);
        // echo "</pre>";
        // $carnet=$typdecoupe[0];
        // $exemplaire=explode(' ', $typdecoupe[1]);
        // $exemplaire=$exemplaire[0];

      
        $carnet = $typdecoupe[0];
        // if (array_key_exists(2, $typdecoupe)){
        $qtecarnet = explode(' ', $typdecoupe[1]);
        $qtecarnet = $qtecarnet[0];
        // echo count($typdecoupe);
        // die();
         $exemplaire = explode(' ', $typdecoupe[2]);
        $exemplaire = $exemplaire[0];
        // }

        // echo "<br>";
        // print_r($exemplaire);






        //$idcommande =$prod['idcommande']; 

        $idclient = $prod['idclient'];
        $idmatiere = $prod['idmatiere'];
        $qteaconsommer = $prod['qteaconsommer'];
        // <td class="table-primary"><?= @$prod[$i]['qteaconsommer']*@$prod[$i]['nbreposecoupe'] ? ></td>
        $formatcoupe = $prod['formatcoupe'];
        $nbreposecoupe = $prod['nbreposecoupe'];
        $formatTirage = $prod['formatTirage'];
        $nbretirage = $qteaconsommer * $nbreposecoupe;
        $nbreposetirage = $prod['nbreposetirage'];
        $nbreplaque = $prod['nbreplaque'];
        $formatchute = $prod['formatchute'];
    } else {
        $_SESSION['erreur'] = "pas de fiche de production pour cette commande";

        if ($modesimplifie == 1) header('Location:indexcommandesimplifie.php?recherche=');
        else header('Location:indexcommande.php?recherche=');
    }
} else {



    //fin appel depuis commande pour recuperer la fiche production

    // appel depuis production debut traitement
    $qrcode = isset($_GET['qrcode']) ? $_GET['qrcode'] : "0";

    $idprod = isset($_GET['idprod']) ? $_GET['idprod'] : "";
    $dates = isset($_GET['dates']) ? $_GET['dates'] : "";
    $idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : "";
    $idimprime = isset($_GET['idimprime']) ? $_GET['idimprime'] : "";
    $idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : "";

    $idclient = isset($_GET['idclient']) ? $_GET['idclient'] : "";
    $idmatiere = isset($_GET['idmatiere']) ? $_GET['idmatiere'] : "";
    $qteaconsommer = isset($_GET['qteaconsommer']) ? $_GET['qteaconsommer'] : "";
    $formatcoupe = isset($_GET['formatcoupe']) ? $_GET['formatcoupe'] : "";
    $nbreposecoupe = isset($_GET['nbreposecoupe']) ? $_GET['nbreposecoupe'] : "";
    $formatTirage = isset($_GET['formatTirage']) ? $_GET['formatTirage'] : "";
    $nbreposetirage = isset($_GET['nbreposetirage']) ? $_GET['nbreposetirage'] : "";
    $nbretirage = $qteaconsommer * $nbreposecoupe;
    $nbreplaque = isset($_GET['nbreplaque']) ? $_GET['nbreplaque'] : "";
    $formatchute = isset($_GET['formatchute']) ? $_GET['formatchute'] : "";
}
// fin appel depuis production debut traitement

require('connectcommande.php');
$sql = 'SELECT * FROM `commande` WHERE `id` = :idcommande;';
$query = $db->prepare($sql);
$query->bindValue(':idcommande', $idcommande, PDO::PARAM_INT);
// // On exécute la requête
$query->execute() or die(print_r($db->errorInfo()));
// // On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetch(PDO::FETCH_ASSOC);
require_once('closecommande.php');
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";

require('connectclient.php');
$sql = 'SELECT * FROM `client` WHERE `id` = :idclient;';
$query = $db->prepare($sql);
$query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
// // On exécute la requête
$query->execute() or die(print_r($db->errorInfo()));

// // On stocke le résultat dans un tableau associatif
$resultclient = $query->fetch(PDO::FETCH_ASSOC);
// require_once('closeclient.php');
// echo "<pre>";
// print_r($resultclient);
// echo "</pre>";


require('connectmatiere.php');
$sql = 'SELECT * FROM `matiere` WHERE `idmat` = :idmatiere;';
$query = $db->prepare($sql);
$query->bindValue(':idmatiere', $idmatiere, PDO::PARAM_INT);
// // On exécute la requête
$query->execute() or die(print_r($db->errorInfo()));
// // On stocke le résultat dans un tableau associatif
$resultmatiere = $query->fetch(PDO::FETCH_ASSOC);
require_once('closematiere.php');
// echo "<pre>";
// print_r($resultmatiere);
// echo "</pre>";

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
    <title>Etat Production</title>
</head>

<body>
    <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

    <!-- <h1 class="entete">Liste de commandes par client</h1> -->
    <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->

    <?php if (!isset($_GET['qrcode'])) require_once('./navbarok.php');

    include('./phpqrcode/qrlib.php'); //On inclut la librairie au projet
    //echo "<h3>QR Code</h3>";

    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    // include "qrlib.php";    
    $dateprod = date('d-m-Y') . ' à ' . date("H:i");
    $requette = "
    Imprimerie NEIO: Client:" .
        $resultcommande['nomclient'] . " imprime:" .
        $resultcommande['imprime'] .
        " Qté " . $resultcommande['quantite'] . " Pièces " .
        "Edité le" . $dateprod . "Le  " . $dates . "Etat production N°" . $idprod . "Date " . $dates .
        "Id commande N°" . $idcommande . "Id client N°" . $idclient .
        "id matiere N°" . $idmatiere . "&nbsp&nbsp Id imprime N°" . $idimprime .
        " https://neio.global2pub.com/etatproduction.php?idcommande=$idcommande&qrcode=1";
    //etatproduction.php?recherche=&niveau=&idcommande=171
    $requette2 = "
    Imprimerie NEIO:" .
        $resultcommande['nomclient'] . " " .
        $resultcommande['imprime'] .
        " Qté " . $resultcommande['quantite'] .

        "Id commande N°" . $idcommande . "Id client N°" . $idclient;

    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);


    //$filename = $PNG_TEMP_DIR.'test.png';
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    // if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
    //     $errorCorrectionLevel = $_REQUEST['level'];

    $matrixPointSize = 2;
    // if (isset($_REQUEST['size']))
    //     $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
    $nomqrcode = $resultcommande['nomclient'] . ' ' . $resultcommande['imprime'];
    $filename = $PNG_TEMP_DIR . $nomqrcode . '.png';
    QRcode::png($requette, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    // $nomqrcode='comm'.$resultcommande['nomclient'].' '.$resultcommande['imprime'];
    // $filename = $PNG_TEMP_DIR.$nomqrcode.md5($requette.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    // QRcode::png($requette, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
    // $lien='https://global2-pub.com'; // Vous pouvez modifier le lien selon vos besoins
    // QRcode::png($lien, 'qrcodecommande1.png'); // On crée notre QR Code
    // echo "<h1>Qr code généré</h1>"


    ?>
    <div class="bordure">
        <?php echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" />'; ?>

        <h1>Imprimerie NEIO</h1>
        <h5><?= $resultcommande['nomclient'] ?></h5>
        <h5>Imprimé:<?= $resultcommande['imprime'] . " Format: $formatfinie" ?></h5>

        <?php if ($carnet == "carnet" & $exemplaire > 1) { ?>
            <h5><?= "Quantité " . $resultcommande['quantite'] . " $carnet(s) de $qtecarnet feuilles de $exemplaire ex" ?></h5>'
        <?php echo "<h3>la quantité mentionnée est pour un seul exemplaire <br> multiplier la qte par $exemplaire</h3>";
        } ?>
        <?php
        $extension = substr($resultcommande['images'], strrpos($resultcommande['images'], "."));
        if ($extension != ".pdf") echo '<img src="' . 'uploads/' . $resultcommande['images'] . '"  width="350" height="auto">' ?>



    </div>
    <hr>
    <!-- <h3>< ?= $resultcommande['remarque'] ?></h3> -->
    <?php
    $dateprod = date('d-m-Y') . ' à ' . date("H:i");
    ?>
    <p>Edité le <?= $dates ?></p>
    <p>Etat production N° <?= $idprod ?></p>
    <!-- <p>Le  <?= $dates . "<br> Etat production N°" . $idprod ?></p>  -->
    <!-- <p>Date <?= $dates ?></p>  -->
    <p>Id commande N°<?= $idcommande . "&nbsp&nbsp Id client N°" . $idclient ?></p>
    <p>id matiere N°<?= $idmatiere ?></p>
    <!-- <p>id matiere N°< ?= $idmatiere."&nbsp&nbsp Id imprime N°".$idimprime ?></p> -->

    <!-- <img  src="images/logoneio.png" alt="logo neio" width="100" height="auto"> -->















    <p>Quantité à consommer: <br> <?= "<span style='color:red'>" . $qteaconsommer . "</span> Feuilles de /" . $resultmatiere['matiere'] . "/ Format " . "<span style='color:red'>" . $resultmatiere['formatxxyy'] . "</span>" . " Grammage " . "<span style='color:red'>" . $resultmatiere['grammage'] . "</span>" . "Gr" ?></p>
    <?php if ($carnet == "carnet" & $exemplaire > 1) {
        echo "<p>la quantité mentionnée est pour un seul exemplaire <br> multiplier la qte par $exemplaire</p>";
    } ?>

    <p>Format coupe <?= $formatcoupe . "cm" ?>//Nombre de poses coupe <?= $nbreposecoupe . "poses" ?></p>
    <p>Format Tirage <?= "<span style='color:red'>" . $formatTirage . "</span>cm" ?></p>
    <p>Nombre de tirage <?= "<span style='color:red'>" . $nbretirage . "</span>Tirages" ?>//Nombre de pose Tirage <?= $nbreposetirage . "poses" ?></p>
    <p>Nombre de plaques <?= $nbreplaque ?> //Format chute <?= $formatchute . "cm" ?></p>




    </div>
    <!-- <a id="bouton" href="" class="btn btn-primary btn-block">Retourner ou Annuler</a> -->
    <a id="bouton" href="#" class="btn btn-primary btn-lg btn-info btn-block" onClick="history.back()">Retour</a>
    <a id="bouton" href="canvas3.php?formatpapier=<?= $resultmatiere['formatxxyy'] ?>&formatmodel=<?= $formatcoupe ?>&portrait=1" class="btn btn-primary btn-lg btn-info btn-block">Shema de coupe</a>

    <!-- <a id="bouton" href="validerbl.php?idclient=<?= $trieclientid ?>" class="btn btn-primary btn-block">Valider le Bon de livraison</a> -->
    <!-- <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf du bon de production</a> -->
    <a id="bouton" href="" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer le Bon de production</a>
    <!-- <a id="bouton" href="sms/envoismsok.php?idclient=< ?= $trieclientid ?>" class="btn btn-primary btn-block">Envoyer Sms de livraison</a> -->

    <!-- <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href='sms/envoismsok.php?idclient=<?= $idclient ?>&message=<?= $requette2 ?>'" 
    class="btn btn-primary btn-block">Envoyer Sms de livraison</a>             -->
    <br>
    <br>
</body>

</html>