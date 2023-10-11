


<?php
$sobap = curl_init();
curl_setopt_array($sobap, array(
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_URL => "https://api.sobersys.com/sms/2/text/single",
CURLOPT_POSTFIELDS => "{ \"from\":\"Global2PUB\", \"to\":[\"213658434587\"],
\"text\":\"Publicité internet? sur Tous les réseaux global2-pub.com prix promotionnel profitez de l'un de nos packs pub à partir de 500DZ/Jour jusqu'au 31 decembre 2021\" }",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array(
"accept: application/json",
"content-type: application/json",
"authorization:Basic bmVpbzpAQEBOMzEwcHJpbnQ="
),
));
$retour = curl_exec($sobap);
$erreur =
curl_error($sobap);
curl_close($sobap);
if ($erreur) {echo "ERREUR: " .
$erreur;} else {echo $retour;}
?>

