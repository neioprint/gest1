<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idclient = isset($_GET['idclient']) ? $_GET['idclient'] : 1;
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    // partie effacement
    require_once('connectclient.php');
    //  window.location.href='indexclient.php';
    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `bondelivraison` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $document = $query->fetch();
    $montantbl=$document['montant'];
    // On vérifie si le produit existe
    if (!$document) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        echo "<script>
            window.location.href='document.php';
           
            </script>";
            die();
        //header('Location: indexclient.php');

    }

    $sql = 'DELETE FROM `bondelivraison` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();


    $_SESSION['message'] = " Document supprimé ";
    $_SESSION['message'] .= " Solde Modifié ";
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$sql = "SELECT * FROM `client` WHERE id=$idclient;";
// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetch(PDO::FETCH_ASSOC);
//print_r($resultclient);
//die();
$solde+=$resultclient['solde'];

//require_once('./closeclient.php');
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  
        $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

        $query = $db->prepare($sql);

        $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

        $query->bindValue(':solde', $solde, PDO::PARAM_STR);




        $query->execute();
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // header('Location: indexclient.php');
    echo "<script>
        window.location.href='document.php?page=1';
        </script>";
} else {
    $_SESSION['erreur'] = "URL invalide";
    // header('Location: indexclient.php');
    echo "<script>
            window.location.href='document.php';
            </script>";
    die();
}
