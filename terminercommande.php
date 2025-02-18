<?php
require_once "const.php";


// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// Est-ce que l'id existe et n'est pas vide dans l'URL

if (isset($_GET['id']) && !empty($_GET['id'])) {
    require('connectcommande.php');

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
        header('Location: indexcommande.php');
        die();
    }
    $etat = $commande['etat'];
    $montant = $commande['total'];
    $dates = $commande['dates'];
    $quantite = $commande['quantite'];
    $idcommande = $commande['id'];
    $imprime = $commande['imprime'];
    $prix = $commande['prix'];
    $tabsuivi = unserialize($commande['etapesvalidee']);
    //$total=$commande['total'];
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    $idclient = $commande['idclient'];
    $tag = $commande['tag'];

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
    $solde = $resultclient['solde'] + $montant;
    $email = $resultclient['email'];
    $to = $email;
    $nomclient = $resultclient['client'];
    // if ($email!="") {

    // "Vous recevrez un e-mail vous indiquant l'etat d'avancement de votre commande <br>";

    // "Merci de votre fidelité <br> Bonne journée <br>";
    //header("refresh:5;url=addnouvelimprime.php?idclient=$idclientSel&nomclient=$nomclient");
    //    $headers='Content-Type: text/plain; charset=utf-8' . "\r\n";
    //    $headers .= 'FROM:  contact@global2pub.com';
    //    $msg = "Mr $nomclient votre commande N°$idcommande du $dates qte $quantite $imprime montant $montant est";
    //     $to=$email;

    //mail($to, "Urgent Prioritaire  Commande de $nomclient", $msg, $headers);

    // }
    //require_once('./closeclient.php');



    //print_r($resultclient)
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//echo "ok";
} else {
    $_SESSION['erreur'] .= "URL invalide";
    header('Location: indexcommande.php');
}
//print_r(@$_SESSION['etat']);
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if (
    ($_GET['suite'] == 1) or ($_GET['suite'] == 0) or
    ($_GET['suite'] == 2) or ($_GET['suite'] == 3) or
    ($_GET['suite'] == 6) or ($_GET['suite'] == 11)
    or ($_GET['suite'] == 12) or ($_GET['suite'] == 13) or ($_GET['suite'] == 17)
) {
    // if (isset($_SESSION['etat']) && ($_SESSION['etat'])=="encours" && ($_GET['suite']=1))
    $headers = 'Content-Type: text/plain; charset=utf-8' . "\r\n";
    $headers .= 'FROM:  contact@global2pub.com';

    // $to='neioprint@gmail.com';
    // $msg="okokkokokokokoko";
    // $nomclient="moi";
    $datecom = date('d-m-Y') . ' à ' . date("H:i");
    $encours = 0;
    //print_r($_SESSION['etat']);

    //$_SESSION['etat']="termine";


    //$etatsuivi=2;
    //$commande['etat']="2/Terminé";
    //echo $etat;
    //print_r($_SESSION['etat']);
    require_once('connectcommande.php');
    $id = strip_tags($_GET['id']);
    //$etatancien=$etat;
    @$etatseq .= $commande['etatseq'] . $etat . '//';

    // if ($email=="") {
    //     $_SESSION['erreur'].="Pas de mail pour ce client envoi impossible";
    //     header("Location: action2ok.php?id=$commande[id]&page=1&etat=$etat&idclient=$commande[nomclient]");
    //     die();
    //                 }
    $datecom = date('d-m-Y') . ' à ' . date("H:i");
    if ($_GET['suite'] == 0) {
        $etat = "1/En cours le " . $datecom . " par " . $_SESSION['login'];
        $_SESSION['message'] .= $etat;

        // ici changement d'etat vers termine
        //$_SESSION['message'] .= 'Changement etat commande reussie ';
        // inclure le changement d'etat pour la production aussi
        @$msg .= " " . $etat;
        if ($email != "") {

            // mail($to, "Urgent! Commande de $nomclient", $msg, $headers);
            // $_SESSION['message'] .= ' e-mail envoye à '.$to;
        } else
            $_SESSION['erreur'] .= "Pas de mail pour ce client";
    }
    if ($_GET['suite'] == 17) {
        $etat = "1/Reprise En cours le " . $datecom . " par " . $_SESSION['login'];
        $_SESSION['message'] .= $etat;

        // ici changement d'etat vers termine
        //$_SESSION['message'] .= 'Changement etat commande reussie ';
        // inclure le changement d'etat pour la production aussi
        @$msg .= " " . @$etat;
        // ajout de la suite du tableau apres reprise de la commande
        // echo "<pre>";
        // print_r($commande);
        // echo "</pre>";
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $tabsuivi=unserialize($commande['etapesvalidee']);
        $dim = count($tabsuivi);

        //$typ=@$result['typ'];
        // $chaine=@$result['etapes'];
        // $chainedecoupe=explode(",",$chaine);
        //$typdecoupe=explode(",",$typ);
        $compt = count($tabsuivi[$dim - 1]);
        //count($chainedecoupe);
        // echo "<br>";
        // print_r( $compt);
        // echo "<br>";
        // echo $dim;
        //$compt0=count($typdecoupe);
        //$tabsuivi=[];
        //$tabsuivi=[[]];
        //$chainedecoupe;
        for ($i = 0; $i < $compt; $i++) {
            $tabsuivi[$dim][$i][0] = 0;
            $tabsuivi[$dim][$i][1] = "";
            $tabsuivi[$dim][$i][2] = "";

        }
        $dim += 1;
        // $tabsuivi=serialize($tabsuivi);
        // echo "<br>";
        // echo "<pre>";
        // print_r($tabsuivi);
        // echo "</pre>";    
        //,$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

        if ($email != "") {

            // mail($to, "Urgent! Commande de $nomclient", $msg, $headers);
            // $_SESSION['message'] .= ' e-mail envoye à '.$to;
        } else
            $_SESSION['erreur'] .= "Pas de mail pour ce client";
    }


    if ($_GET['suite'] == 1) {
        //$_SESSION['message'] .= 'Changement etat commande reussie ';
        $tag = 11111111;
        $etat = "2/Terminé le " . $datecom . " par " . $_SESSION['login'];
        $_SESSION['message'] .= $etat;

        //echo "ok";
        $msg .= " " . $etat;
        if ($email != "") {


            // mail($to, "Urgent! Commande de $nomclient", $msg, $headers);
            // $_SESSION['message'] .= ' e-mail envoye à '.$to;
            //$tag = 11111110;
            //$sql = 'UPDATE `commande` SET `tag`=:tag WHERE  `id`=:id;';
            // $sql = 'UPDATE `imprimes` SET `imprime`=:imprime, `qteMin`=:qteMin WHERE `id`=:id;';
            //$query = $db->prepare($sql);

            //$query->bindValue(':id', $id, PDO::PARAM_INT);
            // $query->bindValue(':dates', $dates, PDO::PARAM_STR);
            // $query->bindValue(':idclient', $idclient, PDO::PARAM_STR);
            // $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);
            // $query->bindValue(':idimprime', $idimprime, PDO::PARAM_STR);
            // $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
            // $query->bindValue(':quantite', $quantite, PDO::PARAM_STR);
            // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
            // $query->bindValue(':prepress', $prepress, PDO::PARAM_STR);
            // $query->bindValue(':total', $total, PDO::PARAM_STR);
            // $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
            // $query->bindValue(':etat', $etat, PDO::PARAM_STR);
            // $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);
            //   $query->bindValue(':tag', $tag, PDO::PARAM_INT);
            // echo $tag;
            // $query->execute();

            // //die();
            // require_once('closecommande.php');
        } else
            $_SESSION['erreur'] .= "Pas de mail pour ce client";
        //header('Location: ./sms/smsautomatique.php?idclient=< ?=$commande[idclient]? >&message=okokokokokokokokok');
        // inclure le changement d'etat pour la production aussi




    } // kokokokokokokokokokokokokokokoo

    if ($_GET['suite'] == 11) {
        //$_SESSION['message'] .= 'Changement etat commande reussie ';
        $etat = "11/Terminé Partiel le " . $datecom . " par " . $_SESSION['login'];
        $_SESSION['message'] .= $etat;

        //echo "ok";
        $msg .= " " . $etat;
        if ($email != "") {


            // mail($to, "Urgent! Commande de $nomclient", $msg, $headers);
            // $_SESSION['message'] .= ' e-mail envoye à '.$to;
        } else
            $_SESSION['erreur'] .= "Pas de mail pour ce client";
        //header('Location: ./sms/smsautomatique.php?idclient=< ?=$commande[idclient]? >&message=okokokokokokokokok');
        // inclure le changement d'etat pour la production aussi

    }

    if ($_GET['suite'] == 12) {
        //$_SESSION['message'] .= 'Changement etat commande reussie ';

        $etat = "12/Livraison Partiel le " . $datecom . " par " . $_SESSION['login'];
        $_SESSION['message'] .= $etat;
        //echo "ok";
        $msg .= " " . $etat;
        if ($email != "") {


            // mail($to, "Urgent! Commande de $nomclient", $msg, $headers);
            // $_SESSION['message'] .= ' e-mail envoye à '.$to;
        } else
            $_SESSION['erreur'] .= "Pas de mail pour ce client";
        //header('Location: ./sms/smsautomatique.php?idclient=< ?=$commande[idclient]? >&message=okokokokokokokokok');
        // inclure le changement d'etat pour la production aussi

    }



    if ($_GET['suite'] == 6) {
        $etat = "0/En Attente " . $datecom . " par " . $_SESSION['login'];
        //$_SESSION['message'] .= 'Changement etat commande reussie ';
        $_SESSION['message'] .= $etat;
        // inclure le changement d'etat pour la production aussi
        // $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

        // $query = $db->prepare($sql);

        // $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

        // $query->bindValue(':solde', $solde, PDO::PARAM_STR);




        // $query->execute();

        // $_SESSION['message'] .= "Solde  client modifié avec succée";
        // require('closeclient.php');
    }

    if ($_GET['suite'] == 2) {
        //$_SESSION['message'] .= 'Changement etat commande reussie ';
        $etat = "3/Livrée le " . $datecom . " par " . $_SESSION['login'];
        $_SESSION['message'] .= $etat;
        $msg .= " " . $etat;
        if ($email != "" && $msg != "") {


            // mail($to, "Urgent!  Commande de $nomclient", $msg, $headers);
            // $_SESSION['message'] .= ' e-mail envoye à '.$to;
        } else
            $_SESSION['erreur'] .= "Pas de mail pour ce client";
        // inclure le changement d'etat pour la production aussi
        // $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

        // $query = $db->prepare($sql);

        // $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

        // $query->bindValue(':solde', $solde, PDO::PARAM_STR);




        // $query->execute();

        // $_SESSION['message'] .= "Solde  client modifié avec succée";
        // require('closeclient.php');
    }
    if ($_GET['suite'] == 3) {
        $tag = 11111110;
        $etat = "5/Archivée le " . $datecom . " par " . $_SESSION['login'];
        $_SESSION['message'] .= $etat;
        // inclure le changement d'etat pour la production aussi
    }






    //die();
    //require('connectcommande.php');
    //    $etatseq.=$commande['etatseq'].$etat.'//';
    $etatprod = $etat; // relatif à la mise à jour dans la table production
    $tabsuivi = serialize($tabsuivi);

    //$sql = 'UPDATE `commande` SET `tag`=:tag WHERE  `id`=:id;';
    //echo $etatseq;
    $sql = 'UPDATE `commande` SET `tag`=:tag,`etat`=:etat,`etatseq`=:etatseq,`etapesvalidee`=:etapesvalidee WHERE `id`=:id;';
    // Prepare statement
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':etat', $etat, PDO::PARAM_STR);
    $stmt->bindValue(':etatseq', $etatseq, PDO::PARAM_STR);
    $stmt->bindValue(':etapesvalidee', $tabsuivi, PDO::PARAM_STR);
    $stmt->bindValue(':tag', @$tag, PDO::PARAM_INT);

    // execute the query
    $stmt->execute();



    // echo "<pre>";
    // print_r($commande);
    // echo "</pre>";


    //$query->execute();
    require_once('closecommande.php');
    if ($_SESSION['user']['role'] != 'ADMIN') {
        $msg = $commande['nomclient'] . "\n" . $commande['imprime'] . "\n Etat de Commande N°" . $commande['id'] . "\n " . $etat;


        $headers = 'FROM:  contact@global2pub.com';
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail("neioprint@gmail.com", "Etat commande", $msg, $headers);
        // $headers = 'FROM:  contact@global2pub.com';
        // $msg = $commande['nomclient'] . "\n" . $commande['imprime'] . "\n Etat de Commande N°" . $commande['id'] . "\n " . $etat;

        mail($to, "Etat commande", $msg, $headers);

        //unset($_SESSION['etat']);

    }
    //    if ($_SESSION['user']['role']=="ADMIN") header('Location: indexcommande.php?recherche=&niveau='); else header('Location: indexcommandesimplifie.php?recherche=&niveau=');

    // header("Location: action2ok.php?id=$commande[id]&page=1&etat=$etat&idclient=$commande[nomclient]");
    // die();
}

header("Location: action2ok.php?id=$commande[id]&page=1&etat=$etat&idclient=$commande[nomclient]");
die();
//  header("Location: ./terminercommande.php?id=$commande[id]&suite=$etatsuivi");
//  die();

?>
<!-- <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'imprimé</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
 
</body>

</html> -->