<?PHP 
header('Content-Type: text/html; charset=utf-8');

// Une fonction perso pour me connecter à la database
//$connexion = dtbi_connection();

// On récupère l'année que demande le client
$annee=$_POST['annee'];

// Ci-dessous on interroge la database
//$query = "SELECT opus,ventes,logo FROM table_call_of_duty WHERE annee=$annee";  
// Une fonction perso pour interroger la database
//$result = dtbi_query($connexion,$query,__FILE__,__LINE__,0);
//list($opus,$ventes,$logo) = mysqli_fetch_row($result);

// Préparation des données
// $JSON_data = array(
// 	'opus'		=> $opus,
// 	'ventes'	=> $ventes,
// 	'logo'		=> $logo,
// );

$JSON_data =array( 'annee' => $annee);
// Envoie de la réponse vers le navigateur
echo json_encode($JSON_data);

?>