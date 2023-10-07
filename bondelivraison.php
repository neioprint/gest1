<?php
require_once "const.php";

//require_once('role.php');
include('./functions/ChiffresEnLettres.php');


//echo $_SESSION['numblclient'];
//$trieclientid=$_SESSION['numblclient'];
$datebl = date('Y-m-d') . ' à ' . date("H:i");;
$nbr = 0;



$idclient = isset($_GET['idclient']) ? $_GET['idclient'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : "";

require_once('serveur.php');
try {
    // Connexion à la base
    if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
    if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die();
}
require_once('connectcommande.php');
$sql = 'SELECT * FROM `commande` WHERE `idclient` = :idclient;';
// $sql = "select * from commande where id like '%$idclient%'";
// On prépare la requête
$query = $db->prepare($sql);
$query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
// echo $resultcommande[0]['id'];

// $idimprime=$resultcommande['idimprime'];
// $imprime=$resultcommande['imprime'];
// $quantite=$resultcommande['quantite'];
// $prix=$resultcommande['prix'];
// $prepress=$resultcommande['prepress'];
// $total=$resultcommande['total'];



function ajouterligne(&$valeur)
{
    $valeur++;
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/stylebl.css">
    <link rel="stylesheet" type="text/css" href="./css/impression.css" media="print">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">


    <title>Bon de livraison</title>
</head>

<body>
    <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

    <!-- <h1 class="entete">Liste de commandes par client</h1> -->
    <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->
    <?php require_once('./navbarok.php') ?>
    <?php require_once('./base4.php'); ?>

    <div class="container">
        <div class="logo">
            <img src="images/logoneio.png" alt="logo neio" width="100" height="auto">


        </div>
        <div class="en tete bold">
            <h3 class="gras">Imprimerie NEIO</h3>
            <p class="gras">Imprimerie Industrielle Tous travaux d'imprimerie</p>
            <p> Offset-impression numerique-Emballage-Etiquette-Travaux de ville </p>
            <p class="gras">Publicité internet & video de présentation conception de sites web </p>
            <p>17 rue moussa Ahmed(Ex alexis cuvelier) ex Halles centrales Oran</p>
            <p>Contact 0541 03 55 48/0555 11 97 37 site web https://global2-pub.com <br> e-mail contactpub@global2-pub.com </p>

        </div>

    </div>
    <hr>

    <div class="containerbl">
        <div class="stylebl">

            <!-- ******************************************  -->
            <div class="form-group">



                <form method="get" action="">
                    <!-- onchange="this.form.submit()" -->
                    <select class="form-control" id="idclient" name="idclient" onchange="this.form.submit()" required>
                        <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->


                        <!-- <option value=" " selected>veuillez selectionner</option> -->
                        <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                        <option value="">Selectionnez un client</option>
                        <?php
                        // On boucle sur la variable result

                        foreach ($resultclient as $client) {
                            //    var_dump($client);
                        ?>

                            <option value="<?php
                                            echo (@$client['id']) ?>" <?php if (@$client['id'] == @$idclient) echo 'selected' ?>>
                                <?php echo (@$client['id'] . '/' . @$client['client']) ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

            </div>
            <!-- ******************************************  -->

        </div>
        <div class="stylebl">

            <p>Bon de livraison N°<?php if (@$nbr > 0) echo @$nbr ?> <br> du <?= $datebl ?></p>

        </div>
    </div>
    </div>
    <button class="btn btn-success" class="btn btn-success">+</button>

    <button class="btn btn-success" class="btn btn-success" onclick=''>-</button>
    <br><br>
    <!-- <a id="bouton" href="./indexcommande.php?page=1&recherche=&niveau=" class="btn btn-primary btn-block">Retourner ou Annuler</a>
    <a id="bouton" href="validerbl.php?idclient=< ?= $trieclientid ?>" class="btn btn-primary btn-block">Valider le Bon de livraison</a>
    <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf du bon de livraison</a>
    <a id="bouton"href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer le Bon de livraison</a>
     <a id="bouton" href="sms/envoismsok.php?idclient=< ?= $trieclientid ?>" class="btn btn-primary btn-block">Envoyer Sms de livraison</a>

    <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href='sms/envoismsok.php?idclient=< ?= $trieclientid ?>'" class="btn btn-primary btn-block">Envoyer Sms de livraison</a> -->
    <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

    <!-- <a id="bouton" href="./seDeconnecter.php" class="btn btn-danger btn-block">Deconnecter</a> -->
    <!-- <a href="../imprimes/index.php" class="btn btn-primary btn-block">Liste imprimés</a>
                <a href="../clients/indexclient.php" class="btn btn-primary btn-block">Liste clients</a> -->

    <div class="tab table-responsive-sm table-striped">

        <table class="table">
            <thead>
                <th>CC</th>
                <!-- <th>Date commande</th> -->
                <!-- <th>ID client</th> -->
                <!-- <th>client</th> -->
                <th>CI</th>
                <th>Désignation imprimé</th>
                <th>quantité</th>
                <th>prix TTC</th>
                <th>prepress</th>
                <th>Total TTC</th>
                <!-- <th>remarque</th>
                        <th>etat</th>
                        <th>paiement</th>
                      
                        <th>Actions</th> -->
            </thead>
            <tbody>
                <?php
                $total1 = 0;
                $boucle = 1;
                //$GLOBALS['boucle']=2;
                //$nombrecommandes=0;
                // On boucle sur la variable result

                // foreach($resultcommande as $commande){

                for ($i = 0; $i < $boucle; $i++) { ?>
                    <tr>
                        <!-- <td class="table-pri mary">< ?= $commande['id'] ?></td> -->



                        <td class="table- primary">
                            <div>

                                <!-- <label for="client">Sélectionner le client  dans la liste</label> -->
                                <br>
                                <!-- <form method="get" action=""> -->
                                <select class="form-c ontrol" id="id" name="id" onchange="this.form.submit()" required>
                                    <!-- <option value="">Selectionnez une commande</option>          -->
                                    <?php

                                    $idimprime = $resultcommande[0]['idimprime'];
                                    $imprime = $resultcommande[0]['imprime'];
                                    $quantite = $resultcommande[0]['quantite'];
                                    $prix = $resultcommande[0]['prix'];
                                    $prepress = $resultcommande[0]['prepress'];
                                    $total = $resultcommande[0]['total'];

                                    foreach ($resultcommande as $commande) {

                                    ?>

                                        <option value="<?php echo ($commande['id']) ?>" <?php if (@$commande['id'] == @$id) {
                                                                                            echo 'selected';
                                                                                            $idimprime = $commande['idimprime'];
                                                                                            $imprime = $commande['imprime'];
                                                                                            $quantite = $commande['quantite'];
                                                                                            $prix = $commande['prix'];
                                                                                            $prepress = $commande['prepress'];
                                                                                            $total = $commande['total'];
                                                                                        }
                                                                                        // echo($commande['id'].'/'.$commande['nomclient'].'/'.$commande['imprime'].'/'.
                                                                                        // $commande['idimprime'].'/'.$commande['quantite'])
                                                                                        ?>>
                                            <?php echo ($commande['id'] . '/' . $commande['imprime']) ?> </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>

                        </td>

                        <!-- <td class="table-success">< ?= $commande['dates'] ?></td> -->
                        <!-- <td class="table-pr imary">< ?= $commande['idclient'] ?></td> -->
                        <!-- <td class="table-in fo">< ?= $commande['nomclient'] ?></td> -->

                        <td class="table-primary"><?= @$idimprime ?></td>
                        <td class="table-warning"><?= @$imprime ?></td>
                        <td class="table-primary"><?= @$quantite ?></td>
                        <td class="table-primary"><?= number_format(@$prix, 2, ".", ".") ?></td>
                        <td class="table-primary"><?= @$prepress ?></td>
                        <td class="table-danger"><?= number_format(@$total, 2, ".", ".") ?></td>


                        <!-- <td class="table-primary">< ?= $commande['remarque'] ?></td>
                                <td class="table-primary">< ?= $commande['etat'] ?></td>
                                <td class="table-primary">< ?= $commande['paiement'] ?></td> -->
                        <!-- <td class="table-success"> -->
                        <!-- <div class="btn-group">
                               
                                </div>
                            </td> -->



                    </tr>
                <?php } ?>
                <?php
                //$total1+=$commande['total'];
                $total1 += $total;
                // //$nombrecommandes+=1;
                // }
                ?>
                <!-- <td class="table-primary">Total en DZ</td> -->
                <!-- <td class="table-d anger"></td> -->
                <!-- <td class="table-p rimary"></td> -->
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>

                <td class="table-primary">Total Gle TTC</td>
                <td class="table-success"><span class="gras"><?= number_format(@$total1, 2, ",", ".") ?> </span></td>
                <!-- <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td> -->
            </tbody>
            <!-- <button type="submit" class="btn btn-success" name="submit" id="submit" value="Envoyer Commande" class="btn btn-success">Ajouter COMMANDE</button> -->
            </form>
        </table>
    </div>
    <?php $lettre = new ChiffreEnLettre();

    $chiffre = intval(@$total1);
    $lettre->Conversion($chiffre);
    $chaine = $lettre->enLettre . " DA";
    //$chaine = mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
    ?>

    <p>Arrété le présent Bon de livraison à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>

    <div class="basdepage">


        <p>Accusé de reception client</p>
        <p>Cachet et signature</p>
    </div>
    <!-- <img  class="cachet" src="./images/cachet2.png" alt="logo global2pub" width="230" height="auto"> -->

</body>

</html>