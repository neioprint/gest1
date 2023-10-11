<?php
require_once "../constclient.php";
$erreur=false;
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};

// if(!empty($_SESSION['erreur'])){
//     echo '<div class="alert alert-danger" role="alert" .alert-dismissible">
//             '. $_SESSION['erreur'].'
//         </div>';
//     $_SESSION['erreur'] = "";
// }

// if(!empty($_SESSION['message'])){
//     echo '<div class="alert alert-success" role="alert" .alert-dismissible">
//             '. $_SESSION['message'].'
//         </div>';
//     $_SESSION['message'] = "";
// }

// attention cette ligne est tres importante
// ça valeur doit etre = require '../src/vendor/autoload.php';

require '../src/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

 if (isset($_GET["idclient"])) $idclient =$_GET["idclient"]; else $idclient=0;
 if (isset($_GET["nomclient"])) $client =$_GET["nomclient"]; else $client="";
 if (isset($_GET["direct"])) $direct =$_GET["direct"]; else $direct="";
if (isset($_GET["tel"]))   $tel =$_GET["tel"]; else $tel="";

//$idclient=$_GET["idclient"];
$requette=$_GET["message"];
if ($tel=="") {
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
                $phone=$resultclient[0]['tel'];
                } else $phone=$tel;
//$fp=fopen("../numbl.txt","r+");
//$nbr=fgets($fp);
//$lien="https://global2-pub.com/gtv26/bl/bl$client$nbr.pdf";
$texte=$requette;
if ($texte=="") {
                $erreur=true;
                $_SESSION['erreur'] .="Message Vide" ;
                }
//"Cher $client Votre commande est prête: ";
//$texte.=$lien;
//echo $texte;

if (strlen($texte)>160) {
   
    $_SESSION['erreur'] .="erreur message depassant 160 caracteres. Diminuer la longueur du message" ;
 //   header('Location: ../blivraisonneio.php');

     if ($direct=="") {
                      header('Location: ../indexcommande.php');
                      die();
                      } else {
                                                                    //header('Location: ../loginclient.php');
                                                                    header( "Location: ../formclient.php?idclient=$idclient&nomclient=$client");
                                                                    die();
                                                                    }
  //   die();
 $erreur=true;
}
else {
  $erreur=false;

}
// print_r($erreur);
// echo "ok".$erreur;
// die();
if (@$erreur) {
           
            $_SESSION['erreur'] .="ERREUR: message non envoyé ".$erreur;
        }
            else {
// echo "okkookookokoko";
// die();
//appel curl sobersys
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
//                 $_SESSION['message'] ="Sms Envoyé avec succée ";

// deuxieme appel api diect infobip
// if  ( empty($_SESSION['sms'])) 

if  ( 1==1) 
        {
        // $dest = new Client([
        //     'base_uri' => "https://6j8xze.api.infobip.com/",
        //     'headers' => [
        //         'Authorization' => "App 0b57e3323485b040fb5c43b055f7e08d-176f788a-abbf-4a95-ad20-a7c1c072ad20",
        //         'Content-Type' => 'application/json',
        //         'Accept' => 'application/json',
        //     ]
        // ]);
        // $response = $dest->request(
        //     'POST',
        //     'sms/2/text/advanced',
        //     [
        //         RequestOptions::JSON => [
        //             'messages' => [
        //                 [
        //                     'from' => 'Impr NEIO',
        //                     'destinations' => [
        //                         ['to' => "$phone"]
        //                     ],
        //                     'text' => "$texte",
        //                 ]
        //             ]
        //         ],
        //     ]
        // );

        // // echo("HTTP code: " . $response->getStatusCode() . PHP_EOL); // ligne poour l'etat d'envoi
        // // echo("Response body: " . $response->getBody()->getContents() . PHP_EOL);
        // //die();
        // if ($response->getStatusCode()=="200") {
        //                                         $_SESSION['message'] .="SMS Envoyé avec succée ";
        //                                         $_SESSION['sms']=1;
                                            
        //                                         } else  
        //                                             {$_SESSION['erreur'].="Erreur SMS non envoyé";
        //                                                 $_SESSION['sms']=0;
        //                                             }       


        }
//$_SESSION['message'] .="SMS Envoyé avec succée ";
?>







<!-- <script>chargement()</script> -->

<?php
//echo "ok";
}


?>
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
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.all.min.js"></script>


<!-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="@sweetalert2/theme-borderless/borderless.css"> -->
    <title>Envoi SMS</title>
</head>
<body onload="chargement()">
<!-- <body> -->
<?php
if (isset($_GET["idclient"])) $idclient =$_GET["idclient"]; else $idclient=0;
if (isset($_GET["nomclient"])) $client =$_GET["nomclient"]; else $client="";

?>

<!-- <button class="btn btn-primary btn-lg btn-success" onclick="choix()">Que voulez vous faire?</button> -->

<?php
// header('Location: ../indexcommande.php');
//      die();
//echo $_SESSION['message']."<br>";
// echo "<br>";
// echo 'Vous serez redirigé dans 10 secs.';
if ($direct=="") header( "Location:../indexcommande.php" ); else  { ?>
                                                                    <!-- // header( "Location:../loginclient.php" );
                                                                    // ajouter ici le choix d'ajouter une nouvelle commande? -->
                                                                    <!-- <script onload="choix()"></script> -->
                                                                    <!-- <button class="btn btn-primary btn-lg btn-success" onclick="choix()">Que voulez vous faire?</button> -->
                                                                    
                                                                    <?php
                                                                    //header( "Location: ../formclient.php?idclient=$_SESSION[idclient]&nomclient=$_SESSION[client]");
                                                                    //die();
                                                                    }

    // die();
     //If not, click <a href="./envoismsok.php">here</a>.';
?>
<!-- <button class="btn btn-primary btn-sm btn-info" onclick="history.back()">Retour</button> -->
<!-- <script src="sweetalert2.all.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.all.min.js"></script> -->

<script>
    function chargement() {
    //  console.log("ok");
 
 
      Swal.fire({
  title: 'Commander un autre imprimé?',
  text: "",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Je continue!',
  cancelButtonText: 'je Quitte',
  width: '32em',
}).then((result) => {
  if (result.isConfirmed) {
    // Swal.fire(
    //   'Deleted!',
    //   'Your file has been deleted.',
    //   'success',
    // )
    document.location.href = "../formclient.php?idclient=<?=$idclient?>&nomclient=<?=$client?>";
  } 
  else {
    document.location.href = "../quitter.php";
        }
})  



    }
        
      

           

      
</script>
</body>
</html>

<!-- HTTP code: 200 
Response body: {"messages":[{"messageId":"3759816123474335322385","
    status":{"description":"Message sent to next instance","groupId":1,"groupName":"PENDING","id":26,"name":"PENDING_ACCEPTED"},"to":"213557765635"}]} 
    Sms Envoyé avec succée -->


















