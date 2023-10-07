<?php

require_once "const.php";

//require_once('role.php');
@$sel = $_POST["sel"];
@$valider = $_POST["valider"];
if (isset($valider)) {
    // echo "<p>Vous avez coché les cases suivantes:</p> <br>";
    // echo "<p>".@implode("//",$sel)."</p>";


    // On inclut la connexion à la base
    require_once('connectcommande.php');

    $sql = "select * from commande where id";
    // On prépare la requête
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($resultcommande);
    // echo "</pre>";
    // die();
    require_once('closecommande.php');
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $compteur = count($resultcommande);
    $nbr_element_page = 50;
    $nbr_de_pages = ceil($compteur / $nbr_element_page);
    $debut = ($page - 1) * $nbr_element_page;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <title>Document</title>
</head>

<body>
    <br><br>
    <?php require_once('./navbarok.php') ?>

    <div class="panel panel-primary" id="container">
        <div class="panel-heading">Liste de commandes (<?= $compteur ?>)</div>
        <div class="table-responsive">

            <table class="table tab">
                <thead class="table ">
                    <!-- <th >Sel</th> -->
                    <th>ID</th>
                    <th class="table-primary">Date</th>
                    <!-- <th class="table-primary">ID client</th> -->
                    <th class="table-primary">client</th>
                    <!-- <th class="table-primary">ID impri</th> -->
                    <th class="table-primary">impr</th>
                    <th class="table-primary">qte</th>
                    <?php
                    if ($_SESSION['user']['role'] == 'ADMIN') {
                    ?>
                        <th class="table-primary">prix</th>
                        <!-- <th class="table-primary">prpress</th> -->
                        <th class="table-primary">total</th>
                    <?php } ?>
                    <!-- <th class="table-primary">remarque</th> -->
                    <th class="table-primary">etat</th>
                    <?php
                    if ($_SESSION['user']['role'] == 'ADMIN') {
                    ?>
                        <th class="table-primary">Paiem</th>
                    <?php } ?>
                    <!-- <th class="table-primary">Photo</th> -->

                    <!-- <th class="table-primary">Action</th> -->
        </div>
        </thead>
        <tbody>
            <?php
            $total1 = 0;
            //$nombrecommandes=0;
            // On boucle sur la variable result
            // echo "<pre>";
            // print_r($resultcommande);
            // echo "</pre>";
            // echo $resultcommande[0]['id'];
            // echo $resultcommande[0]['dates'];
            //die();
            // foreach($resultcommande as $commande)
            for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {
                if ($resultcommande[$i] == null) break;
            ?>
                <tr>
                    <!-- <td class="table-primary">
                <input name='sel[]' type="checkbox" value=< ?= $resultcommande[$i]['id'] ?> 
                < ?php if (@in_array($resultcommande[$i]['id'],$sel)) echo "checked" ?>></td> -->

                    <?php if (@in_array($resultcommande[$i]['id'], $sel)) { ?>
                        <td class="table-primary"><?= $resultcommande[$i]['id'] ?></td>
                        <td class="table-success"><?= $resultcommande[$i]['dates'] ?></td>
                        <!-- <td class="table-primary"><?= $resultcommande[$i]['idclient'] ?></td> -->
                        <td class="table-info"><?= $resultcommande[$i]['nomclient'] ?></td>
                        <!-- <td class="table-primary"><?= $resultcommande[$i]['idimprime'] ?></td> -->
                        <td class="table-warning"><?= $resultcommande[$i]['imprime'] ?></td>

                        <td class="table-primary"><?= $resultcommande[$i]['quantite'] ?></td>
                        <?php
                        if ($_SESSION['user']['role'] == 'ADMIN') {
                        ?>
                            <td class="table-primary"><?= number_format($resultcommande[$i]['prix'], 2, ".", ".") ?></td>
                            <!-- <td class="table-primary"><?= $resultcommande[$i]['prepress'] ?></td> -->
                            <td class="table-danger"><?= number_format($resultcommande[$i]['total'], 2, ".", ".") ?></td>
                        <?php } ?>
                        <!-- <td class="table-primary">< ?= $resultcommande[$i]['remarque'] ?></td> -->
                        <td class="table-primary"><span style="background-color:yellow;color:black;font-weight:bold"><?= $resultcommande[$i]['etat'] ?></span></td>
                        <?php
                        if ($_SESSION['user']['role'] == 'ADMIN') {
                        ?>
                            <td class="table-primary"><span style="background-color:red;color:black;font-weight:bold"><?= $resultcommande[$i]['paiement'] ?></td>
                        <?php } ?>
                        <!-- <td class="table-success"> 
                <img  src="./uploads/66-30--15-08-2022 17.png" alt="logo global2pub" width="90" height="auto">
                </td> -->


                        <td>

                        </td>

                    <?php } ?>


                </tr>

            <?php
                if (@in_array($resultcommande[$i]['id'], $sel))  $total1 += $resultcommande[$i]['total'];
                //$nombrecommandes+=1;
            }
            ?>
            <td class="table-primary">Total en DZ</td>
            <td class="table-danger"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <!-- <td class="table-primary"></td>
        <td class="table-primary"></td>
        <td class="table-primary"></td> -->
            <td class="table-success"><?= number_format($total1, 2, ",", ".") ?></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
            <td class="table-primary"></td>
        </tbody>

        </table>

    </div>

    </div>
</body>

</html>