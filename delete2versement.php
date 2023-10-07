<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// On démarre une session
// echo "<script>
// alert('Welcome ');
// window.location.href='index.php';
// </script>";
// session_start();

// echo "<script>
// alert('Veuillez selectionner une date sur le calendrier pour votre commande');
// let text='confirmer';
// if (confirm(text)) {
//                     window.location.href='index.php';

//                     }
// </script>";

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `versement` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $versement = $query->fetch();
    $idclient = $versement['idclient'];
    // On vérifie si le produit existe
    if (!$versement) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: versement.php?page=1');
        die();
    }

    $sql = 'DELETE FROM `versement` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] .= "Versement supprimé ";

    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    require('./connectclient.php');

    //$sql = 'SELECT * FROM `client` order by client asc';
    $sql = 'SELECT * FROM `client` WHERE `id` = :idclient;';
    // On prépare la requête
    $query = $db->prepare($sql);
    $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $resultclient = $query->fetch(PDO::FETCH_ASSOC);


    require_once('./closeclient.php');
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


    // ici il faut ajouter le solde dans la fiche client
    $solde = $resultclient['solde'] + $versement['versement'];

    require('connectclient.php');


    $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

    $query = $db->prepare($sql);

    $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

    $query->bindValue(':solde', $solde, PDO::PARAM_STR);




    $query->execute();

    $_SESSION['message'] .= " Solde client modifié avec succée";
    require('closeclient.php');




    header('Location: versement.php?page=1');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: versement.php?page=1');
}
