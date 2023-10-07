<?php 

// Données relatives au serveur
//
$connect = TRUE;                               // Autoriser ou non la connexion
//
$name_internet = 'Connexion Web';      // Nom à donner au test de connexion internet
$ip_internet = 'www.global2-pub.com';            // adresse (ip) ou URL du serveur à utiliser pour la vérification de la connexion
$port_internet = 80;                           // port de vérification de la connexion

	// Vérification de la connexion Internet
// Mise en place du texte
echo '<font face="verdana" size="2" color="#e7cf5c">';
echo "<strong>$name_internet :</strong>";

// Verification du statut
if (! $sock = @fsockopen($ip_internet, $port_internet, $num, $error, 5))

// Si il est hors ligne
echo ' <font face="verdana" size="2" color="#CC0000"><blink><b>  HORS LIGNE</b></blink></font>';

// Si il est en ligne
else{
echo ' <font face="verdana" size="2" color="#00CC00"><b>  OK</b></font>';
fclose($sock);
}

echo ' </font><br>';
//echo ' <font face="verdana" size="1"><i>(test sur '; echo $ip_internet; echo ')</i></font>';

?>