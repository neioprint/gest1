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
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    // partie effacement
    require_once('connectclient.php');
    //  window.location.href='indexclient.php';
    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `client` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $client = $query->fetch();

    // On vérifie si le produit existe
    if (!$client) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        echo "<script>
            window.location.href='indexclient.php?page=1';
            </script>";
        //header('Location: indexclient.php');

    }

    $sql = 'DELETE FROM `client` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Client supprimé";
    // header('Location: indexclient.php');
    echo "<script>
        window.location.href='indexclient.php?page=1';
        </script>";
} else {
    $_SESSION['erreur'] = "URL invalide";
    // header('Location: indexclient.php');
    echo "<script>
            window.location.href='indexclient.php?page=1';
            </script>";
}
