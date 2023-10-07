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

    $sql = 'SELECT * FROM `imprimes` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $imprime = $query->fetch();

    // On vérifie si le produit existe
    if (!$imprime) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index0.php?page=1');
        die();
    }

    $sql = 'DELETE FROM `imprimes` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Imprimé supprimé";
    header('Location: index0.php?page=1');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index0.php?page=1');
}
