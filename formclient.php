<?php
// require_once "constclient.php";
require_once "const.php";
if ($_SESSION['sms'] == 1)
    $_SESSION['sms'] = 0;
//$_SESSION['sms'] = 0;
if (!empty($_SESSION['message'])) { ?>
    <!-- //  echo "<div class='alert alert-success alert-dismissible'>

    //  <button type='button' class='btn-close' data-dismiss='alert'>&times;</button>
    //          " . $_SESSION['message'] . "
    //      </div>";  -->
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <?= $_SESSION['message'] ?>
    </div>
    <?php
    $messageJson = json_encode($_SESSION['message']);
    ?>
    <script>
        let message = JSON.parse('<?php echo $messageJson; ?>');
        travail(message)
    </script>
    <?php
    $_SESSION['message'] = "";

}

if (!empty($_SESSION['erreur'])) { ?>
    <!-- // echo '<div class="alert alert-danger .alert-dismissible" role="alert">
                            // <button type="button" class="btn-close" data-dismiss="alert">&times;</button>
                            //         ' . $_SESSION['erreur'] . '
                            //     </div>'; -->
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <?= $_SESSION['erreur'] ?>
    </div>
    <?php
    $messageJson = json_encode($_SESSION['erreur']); ?>
    <script>
        let message = JSON.parse('<?php echo $messageJson; ?>');
        probtravail(message)
    </script>
    <?php
    $_SESSION['erreur'] = "";

}
// if (session_status() != PHP_SESSION_ACTIVE) {
//     session_start();

// };
// if (isset($_SESSION['sms'])) unset($_SESSION['sms']);




// $refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
//                             $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// //echo $refreshButtonPressed;
// if ($refreshButtonPressed==1) die();
//if (isset($_SESSION['trouve'])) header( "refresh:1;url=formclient.php?idclient=$_SESSION[idclient]&nomclient=$_SESSION[client]" );
// if (!isset($_SESSION['user'])) {
//     header('Location:login.php');
//     exit();
// } à
//$cookie_name="idclient";
//setcookie($cookie_name, 0, time() + (86400 * 30), "/"); // 86400 = 1 day
// explode("/",$clientp)
$idclientSel = isset($_GET['idclient']) && !empty($_GET['idclient']) ? $_GET['idclient'] : 0;
$nomclient = isset($_GET['nomclient']) && !empty($_GET['nomclient']) ? $_GET['nomclient'] : "";
$quefaire = isset($_GET['quefaire']) ? $_GET['quefaire'] : "";
$email = isset($_GET['email']) ? $_GET['email'] : "";
$imprime_nouveau = isset($_GET["imprime"]) ? $_GET["imprime"] : "";
//print_r($_GET);
if ($_GET == null)
    die("fin");
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
require('./connectclient.php');

//$sql = 'SELECT * FROM `client` order by client asc';
$sql = 'SELECT * FROM `client` WHERE `id` = :idclientSel;';
// On prépare la requête
$query = $db->prepare($sql);
$query->bindValue(':idclientSel', $idclientSel, PDO::PARAM_INT);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetch(PDO::FETCH_ASSOC);


require_once('./closeclient.php');
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if ($email == "")
    $email = @$resultclient['email'];

// if ($quefaire=="commanderenouv") {
//                                 header("Location: ./rappelcommande.php?idclient=$idclientSel");
//                                 die();


//                                 }
//$idimprime=98;
//echo $idclientSel;
//echo $nomclient;
//die();
require_once('connectcommande.php');

// On nettoie l'id envoyé

$id = $idclientSel;
// echo $id;
// echo $nomclient;
// $$$$$$$$$$$$$$$$$$$$ a revoir 
// if ($nomclient==="") {
//     $_SESSION['erreur'] .= "Client incorrect" . "<br>";
//     header('Location: ./loginclient.php');

//     die();

// }

// $$$$$$$$$$$$$$$$$$$$$$

//strip_tags($_GET['id']);
if ($id != 0) {
    $sql = "SELECT * FROM `commande` WHERE `idclient` = :id order by id DESC";
    //  and `idimprime` =:idimprime ';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    // $query->bindValue(':idimprime', $idimprime, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $commande = $query->fetchAll();
    //      echo '<pre>'; 
// print_r($commande);
//      echo '</pre>';
//      die();
    // if (!empty($_SESSION['erreur'])) {
    //     echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    // <button type="button" class="close" data-dismiss="alert">&times;</button>
    //         ' . $_SESSION['erreur'] . '
    //     </div>';
    //     $_SESSION['erreur'] = "";
    // }

    // if (!empty($_SESSION['message'])) {
    //     echo '<div class="alert alert-success .alert-dismissible" role="alert">
    // <button type="button" class="close" data-dismiss="alert">&times;</button>
    //         ' . $_SESSION['message'] . '
    //     </div>';
    //     $_SESSION['message'] = "";
    // }

    // echo '<pre>'; 
    //  print_r($_POST);
    // //  print_r($_SESSION['message']);
    // //  print_r($_SESSION['erreur']);
    // echo '</pre>';
    // die();
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // $$$$$$$$$$$$$$ fonction chargement de fichier d'impression $$$$$$$$$$


    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    $datecom = date('Y-m-d');
    //.' à '. date("H:i");
    //require_once('./base4.php');
    require_once('./connect.php');

    $sql = "SELECT * FROM `imprimes` WHERE idclient=$idclientSel";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif 
    $result = $query->fetchAll(PDO::FETCH_ASSOC);


    require_once('./close.php');
    // echo " <pre>";
    // print_r($result);
    // echo " </pre>";



    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // connexion base client

    // On inclut la connexion à la table client client
    require('./connectclient.php');

    //$sql = 'SELECT * FROM `client` order by client asc';
    $sql = 'SELECT * FROM `client`';
    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $resultclient = $query->fetchAll(PDO::FETCH_ASSOC);


    require_once('./closeclient.php');
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    if (isset($_POST)) {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>'; 
        //die();

        if (
            isset($_POST["dates"]) && !empty($_POST["dates"])
            && isset($_POST["client"]) && !empty($_POST["client"])
            && isset($_POST["commandes"]) && !empty($_POST["commandes"])

            && isset($_POST["quantite"]) && !empty($_POST["quantite"])

            // &&   @$_POST["quefaire"]!=""
            //  isset($_POST["details"]) && !empty($_POST["details"]) &&
            //   isset($_POST["commandes"]) && !empty($_POST["commandes"]) && 
            //   isset($_POST["remarque"]) && !empty($_POST["remarque"]) && 
            //   isset($_POST["etat"]) && !empty($_POST["etat"]) &&
            //   isset($_POST["paiement"]) && !empty($_POST["paiement"]) &&
            //   isset($_POST["prepress"]) 

        ) {
            if ($_SESSION['sms'] == $_SESSION['sms']) {

                require('./functions/chargerfichier.php');
                // chargerfichier("formulaire");
                //$idclient[0].$nomclient[1].$idimprime[0].$imprime[1].date('d-m-Y H').".".$extension[1];
                //if (isset($_POST["monfichier"]) && !empty($_POST["monfichier"]))
                //chargerfichier("formulaire",$idclient[0],$idimprime[0],$imprime[1]);


                $clientp = strip_tags($_POST["client"]); // nom de variable posté p à la fin
                $quantitep = strip_tags($_POST["quantite"]); // nom de variable posté
                $prixp = strip_tags($_POST["prix"]); // nom de variable posté
                $detailsp = strip_tags($_POST["details"]); // nom de variable posté p à la fin
                $commandesp = strip_tags($_POST["commandes"]); // nom de variable posté p à la fin
                $datep = strip_tags($_POST["dates"]);
                $tag = 0;
                // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                // On inclut la connexion à la base commandes clients
                require_once('connectcommande.php');

                // On nettoie les données envoyées
                $dates = $datep;
                //$dates=date('Y-m-d');
                //.' à '. date("H:i");
                // $idclient=explode("/",$clientp);
                $idclient = $clientp;
                //$nomclient=explode("/",$clientp);
                //$nomclient=$_SESSION['nomclient'];
                //echo $nomclient;
                // die();

                $idimprime = explode("/", $commandesp);
                $imprime = explode("/", $commandesp);
                //$commandesp;
                $quantite = $quantitep;
                $prix = $prixp;
                if ($prix == "Le prix sera envoyé par e-mail")
                    $prix = 0;
                //$prix = 0;
                $prepress = 0;
                //$detailsp;

                $total = $quantitep * $prix + $prepress;

                $remarque = strip_tags($_POST["remarque"]);
                $etat = "erreur";
                if ($quefaire == "commandenouv")
                    $etat = "0/En Attente +DIRECT+" . date('Y-m-d') . " à " . date('H:i');
                if ($quefaire == "proforma")
                    $etat = "6/Proforma +DIRECT+" . date('Y-m-d') . " à " . date('H:i');
                if ($quefaire == "")
                    $etat = "8/Erreur +DIRECT+" . date('Y-m-d') . " à " . date('H:i');
                //strip_tags($_POST["etat"]);
                $etatseq = "";
                $paiement = strip_tags($_POST["paiement"]);
                $etapesvalidee = "";
                // $images="jkjkjjkjkj.jpg";
                //chargerfichier("image",$idclient,$idimprime[0],$imprime[1]);
                chargerfichier("image", $idclientSel, $idimprime[0], $imprime[1]);
                $images = isset($_SESSION["image"]) ? $_SESSION["image"] : "";
                //chargerfichier("bondecommande",$idclient,$idimprime[0],$imprime[1]);
                chargerfichier("bondecommande", $idclientSel, $idimprime[0], $imprime[1]);
                $bondecommande = isset($_SESSION["bondecommande"]) ? $_SESSION["bondecommande"] : "";
                // die();
                $solde = $total;
                $_SESSION["image"] = "";
                $_SESSION["bondecommande"] = "";
                $sql = 'INSERT INTO `commande` 
        (`dates`, `idclient`, `nomclient`, `idimprime`, `imprime`, `quantite`, `prix`,
         `prepress`, `total`, `remarque`, `etat`,etatseq, `paiement`,`images`,`bc`,`tag`,`solde`,`etapesvalidee`) 
        VALUES (:dates,:idclient,:nomclient,:idimprime,:imprime,:quantite,
        :prix,:prepress,:total,:remarque,:etat,:etatseq,:paiement,:images,:bc,:tag,:solde,:etapesvalidee);';
                $query = $db->prepare($sql);

                $query->bindValue(':dates', $dates, PDO::PARAM_STR);
                $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
                $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);

                $query->bindValue(':idimprime', $idimprime[0], PDO::PARAM_INT);
                $query->bindValue(':imprime', $imprime[1], PDO::PARAM_STR);
                $query->bindValue(':quantite', $quantite, PDO::PARAM_INT);
                $query->bindValue(':prix', $prix, PDO::PARAM_INT);
                $query->bindValue(':prepress', $prepress, PDO::PARAM_INT);
                $query->bindValue(':total', $total, PDO::PARAM_INT);
                $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
                $query->bindValue(':etat', $etat, PDO::PARAM_STR);
                $query->bindValue(':etatseq', $etatseq, PDO::PARAM_STR);

                $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);
                $query->bindValue(':images', $images, PDO::PARAM_STR);
                $query->bindValue(':bc', $bondecommande, PDO::PARAM_STR);
                $query->bindValue(':tag', $tag, PDO::PARAM_INT);
                $query->bindValue(':solde', $solde, PDO::PARAM_STR);
                $query->bindValue(':etapesvalidee', $etapesvalidee, PDO::PARAM_STR);
                // $query->bindValue(':paiement', $images, PDO::PARAM_STR);
                $query->execute();
                //      print_r($query);


                // "Merci de votre fidelité <br> Bonne journée <br>";
                //header("refresh:5;url=addnouvelimprime.php?idclient=$idclientSel&nomclient=$nomclient");
                // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                // ****************************************************************
                $headers = 'Content-Type: text/plain; charset=utf-8' . "\r\n";
                $headers .= 'FROM:  contact@global2pub.com';
                if ($quefaire == "commandenouv") {
                    $msg = "$nomclient à emis une nouvelle commande le $dates qte $quantite $imprime[1]";
                    //    $msgc = "$nomclient à emis une nouvelle commande le $dates qte $quantite $imprime[1]";
                    if ($msg != "") {
                        mail("neioprint@gmail.com", "Urgent Prioritaire Nouvelle Commande de $nomclient", $msg, $headers);
                        mail($email, "Urgent Prioritaire votre Nouvelle Commande ", $msg, $headers);
                    }

                    //    mail("neioprint@gmail.com", "Urgent Prioritaire Nouvelle Commande de $nomclient", $msg, $headers);

                }
                if ($quefaire == "proforma")
                    $msg = "$nomclient à emis une demande de proforma le $dates qte $quantite $imprime[1]";
                $_SESSION['message'] .=
                    "Votre Demande à été ajoutée avec succée. <br>
           et est mise en attente.<br>" .
                    "Vous recevrez un e-mail répondant à votre demande <br>";
                if ($msg != "") {
                    mail("neioprint@gmail.com", "Urgent Prioritaire demande Proforma de $nomclient", $msg, $headers);
                    mail($email, "Urgent Prioritaire votre demande Proforma", $msg, $headers);
                }

                // ajout envoi sms

                require_once('closecommande.php');
                if ($msg != "" && $idclient != 0 && $nomclient != "") {
                    header("Location: sms/sms.php?idclient=$idclient&nomclient=$nomclient&message=$msg&direct=oui&tel=213541035548");
                    die();
                } else
                    $_SESSION['erreur'] = "Erreur! Message  sms vide ";



                header("Location:formclient.php?idclient=$idclient&nomclient=$nomclient&quefaire=$quefaire&message=$msg&email=$email&imprime=$imprime_nouveau");

                die();


                // unset($_POST["dates"],$_POST["idcllient"],$_POST["nomclient"],
                // $_POST["idimprime"],$_POST["imprime"],$_POST["quantite"],$_POST["prix"]

                //  );

                // $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                // $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                // if (isset($_POST["monfichier"]))  {
                //  echo '<pre>';
                // print_r($_FILES["monfichier"]);
                // echo '</pre>'; 
                // die();

                // echo "bonjour";
                // }
                // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

                //header('Location: ./indexcommande.php?page=1&niveau=');
                //die();
                //    header('Location: formcommande.php');
                // if ($query) {
                //     echo "<script>
                //     alert('Commande Enregistrée avec succée');
                //     window.location.href='gestion4.php';
                //     </script>";
                // } else {
                //     echo "<script>
                //     alert('Erreur commande non enregistrée');
                //     window.location.href='gestion4.php';
                //     </script>";
                // }
                // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
            } else {
                // echo "<script>
                // alert('Erreur veuillez remplir tous les champs');
                // window.location.href='gestion4.php';
                // </script>";
                if (empty($quefaire) && !isset($quefaire))
                    $_SESSION['erreur'] .= "Le formulaire est incomplet" . "<br>";
            }
        }
    }
} else {
    //$_SESSION['erreur'] .= "Id client incorrect" . "<br>";
    //header('Location: ./loginclient.php');

    //die();
}



// echo "<pre>";
// print_r($result);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>Gestion Commandes</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./images/logo.png" type="image" />
        <!-- <link rel="stylesheet" href="./css/style41.css"> -->
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jquery script-->
        <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
            integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="./css/style41.css">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    </head>

    <body>
        <!-- < ?php require_once('./navbarok.php') ?> -->
        <!-- <div class="entete">
            <img src="./images/logo.avif" alt="logo global2pub" width="120" height="auto">

            <h1 class="entete">Gest' <br> Imprim 1.0 </h1>
            
    </div> -->
        <div class="container">
            <!-- <div class="entete">
            <img src="./images/logo.avif" alt="logo global2pub" width="150" height="auto">

            <h1 class="entete">Gestion <br> Commande</h1> -->
            <!-- <div class="avatar">
    <img   src="./images/banquier.png" alt="" width="250" height="auto">
    </div> -->
            <?php

            // require_once('./menu.php')
            ?>
            <div class="center">
                <h2 class="entete">Bienvenue
                    <?= strtoupper($nomclient) ?>.
                </h2>
                <h2 class="entete">Formulaire de pre-commandes rapides </h2>
                <!-- <h4 class="entete">Pour un seul imprimés à la fois<br></h4> -->
                <!-- <h4 class="entete">1 commande validée=1 imprimé validé.</h4> -->
                <!-- <h6 class="entete">Tous les imprimés  déja commandés <br> sont listés si vous êtes déja client.</h6> -->
                <!-- <h2 class="entete center">Ajouter une commande</h2>  -->
                <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                <form id="formulaire" name="fo" method="post" enctype="multipart/form-data" class="was-validated">
                    <div class="form-group">
                        <label for="dates">Que voulez vous faire?</label>
                        <select class="form-control" id="quefaire" name="quefaire" onchange="quefaire1()" required>
                            <option value="" <?php if ($quefaire === "")
                                echo "selected"; ?>>Selectionner une option
                            </option>
                            <option value="proforma" <?php if ($quefaire === "proforma")
                                echo "selected"; ?>>Demander une
                                proforma</option>
                            <option value="commandenouv" <?php if ($quefaire === "commandenouv")
                                echo "selected"; ?>>
                                Commander</option>
                            <!-- <option value="commanderenouv" < ?php if ($quefaire === "commanderenouv")   echo "selected"; ?>>Renouveller commande</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dates">Date</label>
                        <?php $datevalue = date('Y-m-d') ?>
                        <!-- <input type="date" id="dates" value=< ?= $datevalue?> name="dates" class="form-control"> -->
                        <!-- <input type="text" placeholder="ftererere" value=" < ?php echo date('D-Y-m-d')?>"> -->
                        <input type="date" class="form-control" value=<?= $datevalue ?> id="dates" name="dates" readonly
                            required>
                    </div>
                    <!-- ******************************************  date('d.m.Y H:i:s')-->
                    <div class="form-group">
                        <label for="client">Entreprise ou Société</label>
                        <br>
                        <select class="form-control" id="client" name="client" required>
                            <option value="<?php echo ($idclientSel) ?>">
                                <?php echo ($idclientSel . '/' . $nomclient) ?>
                            </option>
                        </select>
                    </div>
                    <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                    <div class="form-group">
                        <label for="commandes">Sélectionner l'imprimé </label>
                        <br>
                        <select class="form-control" id="commandes" name="commandes" required>
                            <!-- size="< ?= sizeof($result)>5 ? 3 : sizeof($result)?>"  -->
                            <!-- <option  value="" >Sélectionnez votre imprimé</option>  -->
                            <?php

                            // On boucle sur la variable result
                            $nb = 0;

                            if ($imprime_nouveau != "") { ?>
                                <option value="<?= $imprime_nouveau ?>">
                                    <?= $imprime_nouveau ?>
                                </option>
                                <?php
                            }
                            foreach ($result as $imprime) {

                                if ($idclientSel == $imprime['idclient'] && $imprime['idclient'] != 0 && $imprime_nouveau != $imprime['imprime']) {
                                    $nb++;
                                    ?>
                                    <option value="<?php echo $imprime['id'] . '/' . $imprime['imprime'] ?>">
                                        <?php
                                        //  if ($idclientSel==$imprime['idclient']) 
                                        // echo $imprime['idclient'] . '/' . $imprime['imprime'] . '/' . $imprime['id'] 
                                        echo $imprime['imprime'];
                                        ?>
                                    </option>
                                    <?php

                                    //header('Location formcommande.php?idclient=<?php echo $_COOKIE["idclient"]'); 
                                }
                            }
                            if ($nb == 0) {
                                echo "<option value=''>aucun imprimé déja réalisé veuillez ajouter votre imprimé</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <div class="d-grid">
                            <a class="btn btn-danger btn-block"
                                href="addnouvelimprime.php?idclient=<?= $idclientSel ?>&nomclient=<?= $nomclient ?>&quefaire=<?= $quefaire ?>&imprime=<?= $imprime_nouveau ?>">Ajouter
                                votre Imprimé s'il n'est pas dans la liste des imprimés</a>
                        </div>
                        <div>
                            <br>
                            <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                            <!-- ******************************************  -->
                            <div class="form-group">
                                <?php if ($nb != 0) { ?>
                                    <label for="quantite">Quantité, souhaitée</label>
                                    <input type="number" min="1" placeholder="Entrez la Qté" class="form-control"
                                        id="quantite" value="<?= @$commande[0]['quantite']; ?>" name="quantite" required>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <?php if ($nb != 0) { ?>
                                    <label for="prix">Prix Unitaire TTC provisoire</label>
                                    <input type="text" class="form-control" id="prix" name="prix" value="<?php if (@$commande[0]['prix'] != 0)
                                        echo @$commande[0]['prix'];
                                    else
                                        echo "Le prix sera envoyé par e-mail" ?>" required readonly>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <!-- <label for="details">Coût Pre-press</label> -->
                                <input type="number" min="0" step="0.01" value="" class="form-control" id="details"
                                    name="details"
                                    placeholder="Le cout des maquettes films forme decoupe et plaques à la charge du client etc..."
                                    hidden>
                            </div>
                            <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                            <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                            <div class="form-group">
                                <label for="remarque">Remarques</label> <br>
                                <input type="text" class="form-control" id="remarque" maxlength="60" name="remarque"
                                    placeholder="vos remarques" required>
                            </div>
                            <div class="form-group">
                                <label for="monfichier">Image ou Model (PDF,jpg,png) max 5Mo</label> <br>
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                <input type="file" name="monfichier" value="monfichier" />
                                <br>
                                <label for="monfichier2">Bon de commande Faculatif (PDF,jpg,png) max 5Mo </label> <br>
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                <input type="file" name="monfichier2" value="monfichier2" />
                            </div>
                            <div class="radio form-group">
                                <!-- <fieldset>
                <div class="spinner-border text-success">
                </div>
                <legend>Etats Commandes:</legend> -->
                                <!-- <input type="radio" id="etat" name="etat" value="0/En Attente +DIRECT+< ?= date('Y-m-d') . ' à ' . date("H:i"); ?>"  >
                            <label for="etat">En Attente</label>

                            <input type="radio" id="etat" name="etat" value="6/Proforma +DIRECT+< ?= date('Y-m-d') . ' à ' . date("H:i"); ?>"  >
                            <label for="etat">Proforma</label> -->
                                <!-- <input type="radio"   id="etat" name="etat"  value="1/En cours"  disabled>
                <label for="etat">En cours</label>
                <input type="radio"   id="etat" name="etat"  value="2/Terminé"   disabled>
                <label for="etat">Terminé</label> <br>
                <input type="radio"   id="etat" name="etat"  value="3/Livrée"  disabled>
                <label for="etat">Livrée</label>
                <input type="radio"  id="etat" name="etat" value="4/Annulée"  disabled>
                <label for="etat">Annulée</label>
                <input type="radio"  id="etat" name="etat" value="5/Archivée"  disabled>
                <label for="etat">Archivée</label> -->
                                <!-- <input type="radio"   id="etat" name="etat"  value="6/Proforma">
                <label for="etat">Proforma</label> -->
                                <!-- </fieldset>
                </div> -->
                                <div class="radio">
                                    <fieldset>
                                        <!-- <legend>Mode de paiement</legend> -->
                                        <input type="radio" id="paiement" name="paiement" value="0/Non payée" checked
                                            required hidden>
                                        <label for="paiement" hidden>Non payée</label>
                                        <!-- <input type="radio"  id="paiement" name="paiement" value="1/Payé"  required>
                <label for="paiement">Payée</label>

                <input type="radio"   id="paiement" name="paiement"  value="2/Avance" required>
                <label for="paiement">Avance</label>

                <input type="radio"   id="paiement" name="paiement"  value="3/A terme" required>
                <label for="paiement">A terme</label> -->
                                    </fieldset>
                                </div>
                                <br><br>
                                <!-- <input type="button" class="btn btn-success" value="Imprimer" onClick="window.print()">        -->
                                <button type="submit" class="btn btn-success" name="submit1" id="submit1"
                                    value="Envoyer Commande" class="btn btn-success">Valider </button>
                                <!-- <button  class="btn btn-danger" name="submit" onclick="" value="Envoyer Commande" class="btn btn-success">Quitter</button> -->
                                <a class="btn btn-primary btn-danger" href="./quitter.php">Quitter</a>
                </form>
                <!-- <a class="btn btn-primary btn" href="../upload2.php">Envoyer votre fichier d'impression</a>            -->
            </div>
        </div>
        </div>
        </div>
        <!-- <script>
        function selection() {
            //Creating a cookie after the document is ready
            $(document).ready(function() {


                createCookie("idclient", document.getElementById("client").value, "1");
                createCookie("idimprime", document.getElementById("commandes").value, "1");


            });

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;
                // var var1=document.getElementById("client").value;

                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                } else {
                    expires = "";
                }

                document.cookie = escape(name) + "=" +
                    escape(value) + expires + "; path=/";
            }

            // console.log(var1);
            window.location.href = "formclient.php?idclient=" + document.getElementById("client").value +
                "&idimprime=" + document.getElementById("commandes").value;
            //$_COOKIE["idclient"];

        }
    </script> -->
        <script>
            function quefaire1() {
                //Creating a cookie after the document is ready
                $(document).ready(function () {

                    createCookie("quefaire", document.getElementById("quefaire").value, "1");
                });

                // Function to create the cookie
                function createCookie(name, value, days) {
                    var expires;
                    // var var1=document.getElementById("client").value;

                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toGMTString();
                    } else {
                        expires = "";
                    }

                    document.cookie = escape(name) + "=" +
                        escape(value) + expires + "; path=/";
                }

                // console.log(var1);
                window.location.href = "formclient.php?idclient=<?= $idclientSel ?>&nomclient=<?= $nomclient ?>&quefaire=" + document.getElementById('quefaire').value;
                //$_COOKIE["idclient"];

            }

        </script>
        </script>
        <br><br>
        <footer>
            <div class="footer"> &copy; 2021-
                <?= date("Y") ?> <a style="color:blue" href="https://global2pub.com"> global2pub.com </a>
            </div>
        </footer>
    </body>

</html>