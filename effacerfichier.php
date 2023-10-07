<?php
require_once "const.php";

//$cookie_name="idclient";
//setcookie($cookie_name, 0, time() + (86400 * 30), "/"); // 86400 = 1 day
// explode("/",$clientp)
//$idclientSel=isset($_GET['idclient'])?$_GET['idclient']:0;
$idclient = isset($_GET['idclient']) ? $_GET['idclient'] : 0;
$nomclient = isset($_GET['nomclient']) ? $_GET['nomclient'] : "";
$idimprime = isset($_GET['idimprime']) ? $_GET['idimprime'] : 0;
$imprime = isset($_GET['imprime']) ? $_GET['imprime'] : "";
$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : 0;
$fichieraeffacer = isset($_GET['fichieraeffacer']) ? $_GET['fichieraeffacer'] : "";
//$idclientSel=0;
// print_r($idclientSel);
// die();
require_once('role.php');

// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] .= "Veuillez vous connecter pour acceder au contenu"."<br>"; 
//     header('Location: ../login.php');
//     die;
// }

// if  (!isset($_SESSION['login'])){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// if ($_SESSION['user']['role']!='ADMIN') { 
//     $_SESSION['erreur'] = "Vous n'avez pas accée à ce contenu (impossible d'ajouter des commandes)"; 
//     header('Location: ./indexcommande.php?page=1');
//     die;
//                                         }

// echo '<pre>'; 
//  print_r($_POST);
//  print_r($_SESSION['message']);
//  print_r($_SESSION['erreur']);
// echo '</pre>';
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$ fonction chargement de fichier d'impression $$$$$$$$$$


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $datecom=date('Y-m-d');
//.' à '. date("H:i");
require_once('./base4.php');
require_once('connectcommande.php');
$sql = "select * from commande where id='$idcommande'";
if ($sql != "") {
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));;

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetch(PDO::FETCH_ASSOC);
}
// echo '<pre>';
// print_r($resultcommande);
// echo '</pre>'; 
// die();                

// echo '<pre>';
// print_r($_FILES);
// echo '</pre>'; 
//  die();         










require_once('connectcommande.php');


if ($fichieraeffacer == "image" && $resultcommande['images'] != "") {
    //chargerfichier("image",$idclient,$idimprime,$imprime);
    unlink('uploads' . DIRECTORY_SEPARATOR . $resultcommande['images']);
    $images = "";
    $sql = "UPDATE `commande` SET `images`='$images' WHERE  `id`='$idcommande';";
    $query = $db->prepare($sql);
    $query->execute();
    require_once('closecommande.php');
    //$imageaeffacer="uploads/".$images;


    //die();
    $_SESSION['message'] .= "Image  Effacé avec succée" . "<br>";
    header('Location: ./indexcommande.php?page=1&recherche=&niveau=ins');
}
if ($fichieraeffacer == "bondecommande" && $resultcommande['bc'] != "") {
    //chargerfichier("bondecommande",$idclient,$idimprime,$imprime);
    unlink('uploads' . DIRECTORY_SEPARATOR . $resultcommande['bc']);
    $bondecommande = "";
    $sql = "UPDATE `commande` SET `bc`='$bondecommande' WHERE  `id`='$idcommande';";
    $query = $db->prepare($sql);
    $query->execute();
    require_once('closecommande.php');

    $_SESSION['message'] .= "Bc  Effacé avec succée" . "<br>";
    header('Location: ./indexcommande.php?page=1&recherche=&niveau=ins');
}



// $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

//header('Location: ./indexcommande.php?page=1&recherche=&niveau=ins');
//die();




?>
<!DOCTYPE html>
<html lang="fr">


<head>
    <title>Gestion Commandes ver gtv26.0</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./images/logo.avif" type="image" />

    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="./css/style.css">


    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jquery script-->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
</head>


<body>
    <?php require_once('./navbarok.php') ?>
    <div class="container">
        <div class="entete">
            <img src="./images/logo.avif" alt="logo global2pub" width="150" height="auto">

            <h1 class="entete">Gestion <br> Commande</h1>
        </div>
        <!-- <div class="avatar">
    <img   src="./images/banquier.png" alt="" width="250" height="auto">
    </div> -->
        <br>
        <br>
        <br>
        <?php

        // require_once('./menu.php')
        ?>
        <div class="center">
            <h2 class="entete">Effacer Fichiers image ou Bon de commande</h2>
            <!-- <h2 class="entete center">Ajouter une commande</h2>  -->



            <!-- ******************************************  -->
            <div class="form-group">

                <label for="client">Client</label>
                <br>

                <select class="form-control" id="client" name="client" required>
                    <option value="<?= $idclient . '-' . $nomclient ?>"><?= $idclient . '-' . $nomclient ?></option>












                </select>



            </div>
            <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->

            <div class="form-group">

                <label for="commandes">Commande <br></label>
                <br>

                <select class="form-control" id="commandes" name="commandes" required>
                    <!-- size="< ?= sizeof($result)>5 ? 3 : sizeof($result)?>"  -->

                    <option value="<?= $idclient . '-' . $imprime ?>"><?= $idclient . '-' . $imprime ?></option>






                </select>
                <div>



                    <br>
                    <div class="form-group">
                        <?php if ($resultcommande['images'] != "") { ?>
                            <!-- <button  class="btn btn-success"  value="Envoyer Commande" class="btn btn-success">EFFACER Fichier</button> -->
                            <a class="btn btn-danger" href="effacerfichier.php?idcommande=<?= $idcommande ?>&fichieraeffacer=image&idclient=<?= $idclient ?>&nomclient=<?= $nomclient ?>&imprime=<?= $imprime ?>&idimprime=<?= $idimprime ?>">Effacer fichier image</a>
                            <br>
                            <br>
                        <?php } ?>
                        <?php if ($resultcommande['bc'] != "") { ?>
                            <a class="btn btn-danger" href="effacerfichier.php?idcommande=<?= $idcommande ?>&fichieraeffacer=bondecommande&idclient=<?= $idclient ?>&nomclient=<?= $nomclient ?>&imprime=<?= $imprime ?>&idimprime=<?= $idimprime ?>">Effacer fichier bon de commande</a>
                        <?php } ?>
                    </div>





                </div>
            </div>

        </div>

</body>

</html>