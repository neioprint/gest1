<?php

if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};

if(!empty($_SESSION['erreur'])){
    echo '<div class="alert alert-danger" role="alert">
            '. $_SESSION['erreur'].'
        </div>';
    $_SESSION['erreur'] = "";
}

if(!empty($_SESSION['message'])){
    echo '<div class="alert alert-success" role="alert">
            '. $_SESSION['message'].'
        </div>';
    $_SESSION['message'] = "";
}
// if (@$_SESSION['valider']=="oui") {
 //   $_SESSION['msm']=="non" ;
//$phone="213770870263";
if (isset($_GET["idclient"]))$idclient =$_GET["idclient"]; else $idclient=0;
if (isset($_GET["client"])) $client =$_GET["client"]; else $client="";
$requette=$_GET["message"];
//echo $idclient;
//echo $_SESSION['numblclient'];
require('../connectclient.php');
$sql = "SELECT * FROM client WHERE id='$idclient'";
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
require('../closeclient.php');

$client=strtolower($resultclient[0]['client']);
//echo $client;
$phone=$resultclient[0]['tel'];
$fp=fopen("../numbl.txt","r+");
$nbr=fgets($fp);
 
     
    


//echo $nbr;


//$client="Scco";
//$phone="213541035548";

//$lien="https://global2-pub.com/gtv26/bl/bl$client$nbr.pdf";

//echo $lien;
$texte=$requette;
//"Cher $client Votre commande est prête:";
echo"<h1>Envoi Sms</h1>";
echo "<h3>Client :$client </h3>";
echo "<h3>Mobile $phone </h3>";
//echo "<br>";
echo "<h3> $texte </h3>";

//echo "<h3>Le lien de telechargement</h3>"; 
//$texte.=$lien;
//echo $texte;


//echo "<h3><span style='color:red'><a href='$lien'>$lien</a></span></h3>";
echo "<br>";
echo("longueur message ".strlen($texte)." caracteres");
?>




<!-- <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>'" class="btn btn-primary btn-block">Envoyer Sms de livraison</a> -->

<?php
//$erreur=true;
if (strlen($texte)>160) {
    //echo "erreur message depassant 127 caracteres";
    $_SESSION['erreur'] ="erreur message depassant 160 caracteres. Diminuer la longueur du message" ;
 //  header('Location: ../blivraisonneio.php');

     header('Location: ../indexcommande.php?niveau=ins');
     die();
}
else {
  
//echo "message ok";
}

// if ($erreur) {
//             //echo "ERREUR: " .$erreur; 
//             $_SESSION['erreur'] ="ERREUR: message non envoyé " ;
//             //.$erreur;
//         }
//             else {
//                 //echo $retour;
//                 $_SESSION['message'] ="Sms Envoyé avec succée ".$retour;
//             }


// } else {
//    $_SESSION['message'] = "Sms envoyé avec succéé";
//    header('Location: ../blivraisonneio.php');
      
// }
//header('Location: ../blivraisonneio.php');

?>_
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style41.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet"> 
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <title>Envoi SMS</title>
</head>
<body>

<!-- < ?php require_once('../navbarok.php') ?> -->

<a id="bouton" href="javascript:document.location.href='sms.php?idclient=<?= $idclient ?>&message=<?= $requette ?>'" 
class="btn btn-primary">Envoyer Sms</a>

<!-- <a id="bouton" href="javascript:document.location.href='../actionselectiontest.php'"  -->
<a id="bouton" href="javascript:document.location.href='../indexcommande.php?niveau=ins'" 

class="btn btn-primary">Retour</a>



<!-- <a id="bouton" 
href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms')) document.location.href='sms.php?idclient=< ?= $trieclientid ?>'" 
class="btn btn-primary">Envoyer Sms de livraison</a> -->
<!-- <script src="sweetalert2.all.min.js"></script> -->

<!-- <script>
   
        Swal.fire(
  'Bienvenue!',
  'à vous cher ami!',
  'success'
)
</script> -->
<!-- <script>
function envoisms(){   
Swal.fire({
  title: 'Envoi Sms de livraison?',
  text: "Etes vous sûr",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, envoyer!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Annuler!',
      '',
      'success'
    )
  }
})
}
</script> -->
</body>
</html>