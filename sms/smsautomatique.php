<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};

if(!empty($_SESSION['erreur'])){
    echo '<div class="alert alert-danger" role="alert" .alert-dismissible">
            '. $_SESSION['erreur'].'
        </div>';
    $_SESSION['erreur'] = "";
}

if(!empty($_SESSION['message'])){
    echo '<div class="alert alert-success" role="alert" .alert-dismissible">
            '. $_SESSION['message'].'
        </div>';
    $_SESSION['message'] = "";
}

$idclient=$_GET["idclient"];
$requette=$_GET["message"];
require('../connectclient.php');
$sql = "SELECT * FROM client WHERE id=$idclient";
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
require('../closeclient.php');
$client=strtolower($resultclient[0]['client']);
$phone=$resultclient[0]['tel'];
$fp=fopen("../numbl.txt","r+");
$nbr=fgets($fp);
//$lien="https://global2-pub.com/gtv26/bl/bl$client$nbr.pdf";
$texte=$requette;
//"Cher $client Votre commande est prête: ";
//$texte.=$lien;
//echo $texte;
if (strlen($texte)>160) {
   
    $_SESSION['erreur'] ="erreur message depassant 160 caracteres. Diminuer la longueur du message" ;
 //   header('Location: ../blivraisonneio.php');

     header('Location: ../indexcommande.php');
  
 $erreur=true;
}
else {
  $erreur=false;

}

if (@$erreur) {
           
            $_SESSION['erreur'] ="ERREUR: message non envoyé ".$erreur;
        }
            else {
//    $sobap = curl_init();
//                 curl_setopt_array($sobap, array(
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "POST",
//                 CURLOPT_URL => "https://api.sobersys.com/sms/2/text/single",
//                 CURLOPT_POSTFIELDS => "{ \"from\":\"Impr NEIO\", \"to\":[\"$phone\"],\"text\":\"$texte\" }",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_HTTPHEADER => array(
//                 "accept: application/json",
//                 "content-type: application/json",
//                 "authorization:Basic bmVpbzpAQEBOMzEwcHJpbnQ="
//                 ),
//                 ));
//                 $retour = curl_exec($sobap);
//                 $erreur =
//                 curl_error($sobap);
//                 curl_close($sobap);
                $_SESSION['message'] ="Sms Envoyé avec succée ";
            

            }




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style41.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <title>Envoi SMS</title>
</head>
<body>
<?php
// header('Location: ../indexcommande.php');
//      die();
echo $_SESSION['message']."<br>";
     header( "refresh:5;url=../indexcommande.php" );
     echo "<br>";
     echo 'Vous serez redirigé dans 5 secs.';
     //If not, click <a href="./envoismsok.php">here</a>.';
?>
<!-- <button class="btn btn-primary btn-sm btn-info" onclick="history.back()">Retour</button> -->

</body>
</html>