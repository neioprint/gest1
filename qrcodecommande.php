<?php
require_once "const.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connectcommande.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `commande` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $commande = $query->fetch();

    // On vérifie si le produit existe
    if (!$commande) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: indexcommande.php?recherche=&niveau=ins');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: indexcommande.php?recherche=&niveau=ins');
}
include('./phpqrcode/qrlib.php'); //On inclut la librairie au projet
echo "<h1>PHP QR Code</h1><hr/>";

//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

// include "qrlib.php";    
$requette = $commande['id'] . " " . $commande['dates'] . " " . $commande['idclient'] . " " .
    $commande['nomclient'] . " " . $commande['imprime'] . " " . $commande['quantite'] . " " . $commande['prix'] . " " . $commande['total'];
//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR . 'test.png';
//processing form input
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'L';
// if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
//     $errorCorrectionLevel = $_REQUEST['level'];    

$matrixPointSize = 6;
// if (isset($_REQUEST['size']))
//     $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

$filename = $PNG_TEMP_DIR . 'comm' . md5($requette . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
QRcode::png($requette, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><hr/>';
// $lien='https://global2-pub.com'; // Vous pouvez modifier le lien selon vos besoins
// QRcode::png($lien, 'qrcodecommande1.png'); // On crée notre QR Code
// echo "<h1>Qr code généré</h1>"

?>
<button class="btn btn-primary btn-sm btn-info" onclick="history.back()">Retour</button>