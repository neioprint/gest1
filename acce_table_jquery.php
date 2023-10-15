<?PHP 
header('Content-Type: text/html; charset=utf-8');

// Une fonction perso pour me connecter à la database
//$connexion = dtbi_connection();

// On récupère l'année que demande le client
$variable=$_POST['variable'];
$tableau=$_POST['tableau'];
$id=$_POST['id'];
$resultcommande=$id;
// acce à la base de donnee debut
require('connectcommande.php');



$sql = 'SELECT * FROM `commande` WHERE `id` = :resultcommande;';


$query = $db->prepare($sql);


$query->bindValue(':resultcommande', $resultcommande, PDO::PARAM_INT);


$query->execute();


$commande = $query->fetch();

// acce à la base de donnee fin







// misa  à jour la base de donnee debut
$tabsuivi=$commande['etapesvalidee'];
$tabsuivi=unserialize($tabsuivi);
$dim=count($tabsuivi)-1;
if ($tabsuivi[$dim][$variable][0]<2) {
                            $tabsuivi[$dim][$variable][0]+=1;
                            $tabsuivi[$dim][$variable][$tableau]=date('Y-m-d'). " à ".date('H:i'). " par " . $_SESSION['login'];
                            $tableau+=1;
                            //$tabsuivi[$variable][$tableau]=date('Y-m-d'). " à ".date('H:i'). " par " . $_SESSION['login'];
                            }
// $resultcommande=$id;
// print_r($tabsuivi);
// die();
// <!-- <script>

// confirm("Press a button!");

// </script> -->
// <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) '">Continuer</a> -->

$tabsuivi=serialize($tabsuivi);
$etapesvalidee=$tabsuivi;
// // // trait
require('connectcommande.php');
$sql = 'UPDATE `commande` SET `etapesvalidee`=:etapesvalidee WHERE  `id`=:resultcommande;';




$query = $db->prepare($sql);

$query->bindValue(':resultcommande', $resultcommande, PDO::PARAM_INT);
$query->bindValue(':etapesvalidee', $etapesvalidee, PDO::PARAM_STR);
$query->execute();


// acce à la base de donnee fin

$JSON_data =array( 'variable' => $variable,
                    'tableau' => $tableau,
                    'id'=>$id
);
// Envoie de la réponse vers le navigateur
echo json_encode($JSON_data);

?>