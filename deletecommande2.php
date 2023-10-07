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
if (isset($_GET['id']) && !empty($_GET['id'])) 
// && isset($_GET['total']) && !empty($_GET['total'])) 
{
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `commande` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $commande = $query->fetch();

    // On vérifie si le produit existe
    if (!$commande) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: indexcommande.php?page=1');
        die();
    } else {

        $etatsuivi = explode("/", $commande['etat']);
        $etatsuivi = $etatsuivi[0];


        $total = isset($_GET['total']) ? $_GET['total'] : 0;
        $idclient = isset($_GET['idclient']) ? $_GET['idclient'] : 0;
        $soldeclient = isset($_GET['solde']) ? $_GET['solde'] : 0;
        require('connectclient.php');

        $solde = $soldeclient - $total;
        // if ($solde < 0) {
            // $_SESSION['erreur'] .= "Solde négatif impossible à modifier";

            // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
            // header('Location: indexcommande.php?page=1');
            // die();
        // } 
        //else 
        {
            if ($etatsuivi == 3) {
                $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

                $query = $db->prepare($sql);

                $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

                $query->bindValue(':solde', $solde, PDO::PARAM_STR);




                $query->execute();

                $_SESSION['message'] .= "Solde  client modifié avec succée";
                require('closeclient.php');
                // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                //

              
                // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                // ajout de la partie qui enleve le total commande apres sa suppression
            }
            $sql = 'DELETE FROM `commande` WHERE `id` = :id;';

            // On prépare la requête
            $query = $db->prepare($sql);

            // On "accroche" les paramètre (id)
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            // On exécute la requête
            $query->execute();
            $_SESSION['message'] .= " Commande supprimé ";
            header('Location: indexcommande.php?page=1');
        }
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: indexcommande.php?page=1');
}
