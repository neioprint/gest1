<?php
$sobap = curl_init();
curl_setopt_array($sobap, array( CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_URL => "https://api.sobersys.com/status", CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => array(
"content-type: application/json",
"accept: application/json"
),
));
$retour = curl_exec($sobap); $erreur = curl_error($sobap); curl_close($sobap);
if ($erreur) {echo "ERREUR: " . $erreur;} else {echo $retour;}
?>