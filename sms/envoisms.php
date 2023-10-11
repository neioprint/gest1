<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};
require '../src/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
//$sobap = curl_init();
//$phone="213770870263";
$phone="213541035548";
$lien="https://global2-pub.com/gtv26/loginclient.php";
$texte="Cher Client Bienvenue sur la plateforme de commande en ligne de imprimerie Neio ".$lien;
//echo $texte."<br>";
//echo strlen($texte);
if (strlen($texte)>160) {
    echo "erreur message depassant 160 caracteres";
}
else echo "message ok";
echo "<br>";

// curl_setopt_array($sobap, array(
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => "POST",
// CURLOPT_URL => "https://6j8xze.api.infobip.com/",
// CURLOPT_POSTFIELDS => "{ \"from\":\"Impr NEIO\", \"to\":[\"$phone\"],\"text\":\"$texte\" }",
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_HTTPHEADER => array(
// "accept: application/json",
// "content-type: application/json",
// "authorization:App 003026bbc133714df1834b8638bb496e-8f4b3d9a-e931-478d-a994-28a725159ab9"
// ),
// ));
// $retour = curl_exec($sobap);
// $erreur =
// curl_error($sobap);
// curl_close($sobap);
// if ($erreur) {echo "ERREUR: " .
// $erreur;} else {echo $retour;}

// $client = new Client([
//     'base_uri' => "https://6j8xze.api.infobip.com/",
//     'headers' => [
//         'Authorization' => "App 0b57e3323485b040fb5c43b055f7e08d-176f788a-abbf-4a95-ad20-a7c1c072ad20",
//         'Content-Type' => 'application/json',
//         'Accept' => 'application/json',
//     ]
// ]);
// $response = $client->request(
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

// echo("HTTP code: " . $response->getStatusCode() . PHP_EOL);
// //echo("Response body: " . $response->getBody()->getContents() . PHP_EOL);
// if ($response->getStatusCode()=="200") $_SESSION['message'] ="SMS Envoyé avec succée "; else  $_SESSION['message'] ="Erreur SMS non envoyé";       

            
?> 











<!-- < ?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};
$sobap = curl_init();
//$phone="213770870263";
$phone="213541035548";
$lien="https://global2-pub.com/gtv26/loginclient.php";
$texte="Cher Client Bienvenue sur la plateforme de commande en ligne de imprimerie Neio ".$lien;
//echo $texte."<br>";
//echo strlen($texte);
if (strlen($texte)>160) {
    echo "erreur message depassant 160 caracteres";
}
else echo "message ok";
echo "<br>";
curl_setopt_array($sobap, array(
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_URL => "https://6j8xze.api.infobip.com/",
CURLOPT_POSTFIELDS => "{ \"from\":\"Impr NEIO\", \"to\":[\"$phone\"],\"text\":\"$texte\" }",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array(
"accept: application/json",
"content-type: application/json",
"authorization:App 003026bbc133714df1834b8638bb496e-8f4b3d9a-e931-478d-a994-28a725159ab9"
),
));
$retour = curl_exec($sobap);
$erreur =
curl_error($sobap);
curl_close($sobap);
if ($erreur) {echo "ERREUR: " .
$erreur;} else {echo $retour;}
?> -->

<!-- Cher Client Hotel Liberte Votre commande  est prête votre lien de telechargement De Facture https://global2-pub.com/gtv21/facture/hotelliberte2022N°5.pdf -->