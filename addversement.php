<?php
require_once "const.php";

require_once('role.php');
// if (isset($_POST["client1"]))  {
//     echo( $_POST["client1"]) ;  
// //die(); 
// }

//$datecom=date('d-m-Y');
require_once('connectclient.php');

$sql = 'SELECT * FROM `client`';

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
//$index=$client['client'] ;
//$_SESSION["commandevide"]=$resultclient[0]["client"];

//var_dump($_SESSION["commandevide"]);

require_once('closeclient.php');
//   print_r($resultclient);

// ouverure de la base commande 
require_once('connectcommande.php');
$sql = "select *,nomclient,etat from commande where not (etat like '%5/Archivée%') and not (etat like '%6/%') order by nomclient";




$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
require_once('closecommande.php');
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
// die();
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//print_r($_POST);
if (isset($_POST["dates"])) {
    //   echo "ok";
    if (
        //isset($_POST['client'])     && !empty($_POST['client']) && 
        isset($_POST['dates'])     && !empty($_POST['dates']) &&
        isset($_POST['versement']) &&  !empty($_POST['versement']) &&
        isset($_POST['ref'])       &&  !empty($_POST['ref'])
    ) {
        //echo "ok";

        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // On inclut la connexion à la base
        require_once('connectversement.php');

        // On nettoie les données envoyées

        $dates = strip_tags($_POST['dates']);
        $versement = strip_tags($_POST['versement']);
        $ref = strip_tags($_POST['ref']);
        $idclient = $_SESSION['idclient'];
        //explode("/",strip_tags($_POST['client']));

        // strip_tags($_POST['idclient']);
        $client = $_SESSION['client'];
        //     print_r($_POST['commande']);
        //    echo "<br>";
        //explode("/",strip_tags($_POST['client']));
        //strip_tags($_POST['client']);
        $commande = implode(',', $_POST['commande']);
        // print_r($commande);
        // die();
        $sql = "INSERT INTO `versement` (`dates`,`versement`,`ref`,`idclient`,`client`,`commande`) 
        VALUES (:dates,:versement,:ref,:idclient,:client,:commande)";
        $query = $db->prepare($sql);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':versement', $versement, PDO::PARAM_STR);
        $query->bindValue(':ref', $ref, PDO::PARAM_STR);
        $query->bindValue(':idclient', $idclient, PDO::PARAM_STR);
        $query->bindValue(':client', $client, PDO::PARAM_STR);
        $query->bindValue(':commande', $commande, PDO::PARAM_STR);


        // $query->bindValue(':idclient', $idclient[0], PDO::PARAM_STR);
        // $query->bindValue(':client', $client[1], PDO::PARAM_STR);

        // echo "<pre>";
        // print_r($commande);
        // echo "</pre>";
        // die();


        // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        // $query->bindValue(':qteMin', $qteMin, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Versement ajouté";
        require_once('closeclient.php');
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
        $solde = $resultclient['solde'] - $versement;

        require('connectclient.php');


        $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

        $query = $db->prepare($sql);

        $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

        $query->bindValue(':solde', $solde, PDO::PARAM_STR);




        $query->execute();

        $_SESSION['message'] .= "Solde  client modifié avec succée";
        require('closeclient.php');
        //die();

        header('Location: versement.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: versement.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Versement Client</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
</head>

<body>
    <?php require_once('./navbarok.php') ?>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- < ?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?> -->
                <h1 class="entete">Ajout de Versement</h1>
                <br>
                <form name="fo2" method="post" class="was-validated">
                    <label for="client">Sélectionner le client dans la liste</label>
                    <select class="form-control" id="client1" name="client1" onchange="this.form.submit()" required >
                        <!-- < ?php if (!isset($_POST["client1"]))  { ?> -->
                        <option value="">Selectionnez le client</option>
                        <?php
                        foreach ($resultclient as $client) {
                        ?>
                            <!-- $client['id']."/".          -->
                            <option value="<?= $client['client'] ?>" <?php if (@$_POST["client1"] == $client['client']) {
                                                                            echo "selected";
                                                                            //$client=$_POST["client1"];
                                                                            $_SESSION['client'] = $_POST["client1"];
                                                                            $_SESSION['idclient'] = $client["id"];
                                                                        }

                                                                        ?>>
                                <?= $client['client'] ?></option>
                        <?php
                        } // fin foreach client

                        ?>

                    </select>

                </form>
                <?php if (isset($_POST["client1"])) { ?>
                    <form name="fo" method="post"class="was-validated" >


                        <!-- <input type="hidden" name="page" value="1" /> -->

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <label for="commande">Commande(s) à selectionner</label>

                        <!-- <input type="hidden" name="page" value="1" /> -->
                        <select class="form-control" id="commande" name="commande[]" multiple size="4" required>

                            <?php

                            $i = 0;
                            foreach ($resultcommande as $comm) {
                                // if ($_POST["client1"]==$comm['nomclient']) {
                                if ($_SESSION['idclient'] == $comm['idclient']) {
                                    $i++;

                            ?>
                                    <option value="<?= $comm['id'] . "/" . $comm['nomclient'] . "/" . $comm['imprime'] . "=" . $comm['total'] . " DZ" ?>">
                                        <?= $comm['imprime'] . "=" . $comm['total'] . " DZ" ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <?php if ($i > 0) { ?>
                            <div class="form-group">
                                <label for="dates">Date</label>
                                <?php $datevalue = date('Y-m-d') ?>
                                <input type="date" id="dates" value=<?= $datevalue ?> name="dates" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                        <label hidden for="idclient">Id Client</label>
                        <input type="hidden" id="idclient" name="idclient" value="< ?= $client['id'] ?>" class="form-control" >
                    </div> -->

                            <div class="form-group">
                                <label for="versement">Versement</label>

                                <input type="number" step="0.1" id="versement" value=<?= $datevalue ?> name="versement" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ref">References</label>
                                <input type="text"  id="ref" name="ref" class="form-control" required>
                            </div>
                            <br>
                            <!-- <div class="form-group">
                         <label for="idclient">Id Client</label> 
                        <input type="text" id="idclient" name="idclient" class="form-control" >
                    </div> -->
                            <!-- <div class="form-group">
                        <label for="idc">Id commande</label>
                        <input type="number" id="idc" name="idc" class="form-control">
                    </div> -->


                            <button type="submit" class="btn btn-success">Ajout versement</button>
                    </form>
                <?php } else {
                            //$_SESSION['message'] = "Pas de commande pour ce client";
                            //  $i=0;
                            //header('Location: addversement.php');
                            //echo "<script> window.location.href='addversement.php';</script>";
                            //die();


                        } ?>
            <?php } // if (isset($_POST["client1"]))
            ?>
            <br>
            <a class="btn btn-success" href="indexcommande.php?page=1&recherche=">Retour</a>
            </section>


        </div>
    </main>
</body>

</html>