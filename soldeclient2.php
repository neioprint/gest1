<?php
require_once "const.php";

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
$dat = isset($_GET['dates']) ? $_GET['dates'] : "";
$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "all";

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// On inclut la connexion à la base
require_once('connectclient.php');

// $sql = "SELECT id,SUBSTRING(client,1,12) as client ,tel FROM `client`";
$sql = "select * from client where id";

if ($niveau == "i") {
    $sql = "select * from client where client like  '%$recherche%'  order by solde desc";
}

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
//var_dump( $resultclient[0]['tel']);
//die();
// echo "<pre>";
// var_dump($resultclient);
// echo "</pre>";
require_once('closeclient.php');

if ($recherche != "") {
    // on accede aux versement du client selectionné
}
// pagination
@$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($resultclient);
$nbr_element_page = 50000;

$nbr_de_pages = ceil($compteur / $nbr_element_page);
$debut = ($page - 1) * $nbr_element_page;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste solde clients</title>
    <link rel="stylesheet" href="css/normalize.css">


    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/monstyle.css"> -->
    <link rel="stylesheet" href="./css/style41.css">
    <script src="./js/jquery-3.3.1.js"></script>
    <link rel="icon" href="./images/logo.avif" type="image" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./css/monstyle.css">
<link rel="stylesheet" href="./css/style41.css">
<script src="./js/jquery-3.3.1.js"></script>
<link rel="icon" href="./images/logo.avif" type="image" /> 
<style>
        img {
            border-radius: 50%;
            }
</style> -->
</head>

<body class="container">
    <?php require_once('./navbarok.php') ?>
    <!-- <main class="container"> -->

    <?php
    require_once('./menu.php')
    ?>
    <div class="entete">
        <!-- <img src="./images/logo.avif" alt="logo global2pub" width="120" height="auto" loading="lazy"> -->

        <!-- <h1 class="entete">Gestion Commande</h1> -->
    </div>
    <!-- <div class="avatar">
        <img   src="./images/annonce2.png" alt="" width="280" height="auto">
</div> -->
    <br>
    <h1 class="entete">Liste créance clients</h1>
    <!-- $$$$$$$$$$$$$$$$debut recherche $$$$$$$$$ -->
    <div class="panel panel-success">

        <div class="panel-heading">Recherche de créance clients</div>
        <div class="panel-body">
            <form method="get" action="" class="form-inline">
                <div class="form-group">
                    <!-- < ?php if ($niveau!="d" && $niveau!="e0" 
                && $niveau!="e1" && $niveau!="e2" && $niveau!="e3" && $niveau!="e5" && $niveau!="prof") {?>
                <input type="text" name="recherche" placeholder="rechercher" value="< ?php echo @$recherche ?>"/>< ?php } ?>   -->
                    <input type="text" name="recherche" placeholder="rechercher" value="<?php echo @$recherche ?>" />
                    <?php if ($niveau == "d") { ?>
                        <input type="date" name="dates" value="<?php echo $dat ?>" onchange="this.form.submit()" /><?php } ?>
                    <!-- value="< ?php echo $dat ?>"                       -->
                    <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">

                        <option value="i" <?php if ($niveau === "i")   echo "selected" ?>>Recherche par client</option>


                    </select>
                </div>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Chercher.....</button>
                <a href="./addclient.php" class="btn btn-primary">Ajouter Client</a>
            </form>
        </div>
    </div>
    </div>
    <!-- $$$$$$$$$$$$$$$$$$$$$$fin recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    <?php
    if (!empty($_SESSION['erreur'])) {
        echo '<div class="alert alert-danger" role="alert">
                            ' . $_SESSION['erreur'] . '</div>';
        $_SESSION['erreur'] = "";
    }
    if (!empty($_SESSION['message'])) {
        echo '<div class="alert alert-success" role="alert">
                            ' . $_SESSION['message'] . '</div>';
        $_SESSION['message'] = "";
    }
    ?>

    <br>
    <div id="pagination">
        <?php
        if ($recherche == "") {
            for ($i = 1; $i <= $nbr_de_pages; $i++) {
                if ($page != $i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
                else echo "<a class='btn btn-success'>$i</a>&nbsp";
            }
        ?>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Liste de client (<?= @$compteur ?>)
            <br>
            <div class="table-responsive">
                <table class="table tab table-striped table-responsive ">
                    <!-- <table class="table tab table-striped table-responsive"> -->
                    <thead class="table">
                        <th class="table-primary">ID</th>
                        <th class="table-primary">Client</th>
                        <!-- <th class="table-primary">Telephone</th> -->
                        <th class="table-primary">Solde</th>
                        <!-- <th class="table-primary">Registre</th>
                <th class="table-primary">Mat Fiscal</th>
                <th class="table-primary">N° Article</th>
                <th class="table-primary">email</th>
                <th class="table-primary">Adresse</th> -->
                        <!-- <th class="table-primary">Actions</th> -->
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        // foreach($resultclient as $client){
                        // for($i=$debut;$i<=$nbr_de_pages+$debut+1 ; $i++)
                        $total1 = 0;
                        for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {
                            if (@$resultclient[$i] == null) break;
                        ?>
                            <tr>
                                <td class="table-primary"><?= $resultclient[$i]['id'] ?></td>
                                <td class="table-primary"><?= $resultclient[$i]['client'] ?></td>
                                <!-- <td class="table-primary">< ?= $resultclient[$i]['tel'] ?></td> -->
                                <td class="table-primary"><?= number_format($resultclient[$i]['solde'], 2, ".", ".") ?></td>

                                <!-- <td class="table-primary">< ?= $resultclient[$i]['registre'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['idfiscal'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['art'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['email'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['adresse'] ?></td> -->

                                <!-- <div class="btn-group btn-group-sm">
                                        <td class="table-primary">
                                        <a class="btn btn-primary" href="detailsclient.php?id=< ?= $resultclient[$i]['id'] ?>">Voir</a> 
                                        <?php if ($_SESSION['user']['role'] == 'ADMIN') {
                                            //if ($resultclient[$i]['solde']>0) 
                                            $total1 += $resultclient[$i]['solde'];
                                        ?>
                                        <a class="btn btn-primary btn-success" href="editclient.php?id=< ?= $resultclient[$i]['id'] ?>">Modif</a> 
                                        <a class="btn btn-danger" 
                                        href="deleteclient.php?id=< ?= $resultclient[$i]['id'] ?>">Suppr</a>
                                        <?php if ($resultclient[$i] == null) break;
                                        } ?>
                                        </td>
                                        </div> -->


                            </tr>

                        <?php

                        }
                        ?>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-success"><?= number_format($total1, 2, ".", ".") ?></td>
                    </tbody>
                </table>
            <?php } else { ?>
                <!-- // affichage etat general solde client recettes et solde à nouveau -->
                <div class="panel panel-primary">
                    <div class="panel-heading">Liste de client (<?= @$compteur ?>)
                        <br>
                        <div class="table-responsive">
                            <table class="table tab table-striped table-responsive ">
                                <!-- <table class="table tab table-striped table-responsive"> -->
                                <thead class="table">
                                    <th class="table-primary">ID</th>
                                    <th class="table-primary">Client</th>
                                    <!-- <th class="table-primary">Telephone</th> -->
                                    <th class="table-primary">Versement</th>
                                    <!-- <th class="table-primary">Registre</th>
                <th class="table-primary">Mat Fiscal</th>
                <th class="table-primary">N° Article</th>
                <th class="table-primary">email</th>
                <th class="table-primary">Adresse</th> -->
                                    <!-- <th class="table-primary">Actions</th> -->
                                </thead>
                                <tbody>
                                    <?php
                                    // On boucle sur la variable result
                                    // foreach($resultclient as $client){
                                    // for($i=$debut;$i<=$nbr_de_pages+$debut+1 ; $i++)
                                    $total1 = 0;
                                    for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {
                                        if (@$resultclient[$i] == null) break;
                                    ?>
                                        <tr>
                                            <td class="table-primary"><?= $resultclient[$i]['id'] ?></td>
                                            <td class="table-primary"><?= $resultclient[$i]['client'] ?></td>
                                            <!-- <td class="table-primary">< ?= $resultclient[$i]['tel'] ?></td> -->
                                            <td class="table-primary"><?= number_format($resultclient[$i]['solde'], 2, ".", ".") ?></td>

                                            <!-- <td class="table-primary">< ?= $resultclient[$i]['registre'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['idfiscal'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['art'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['email'] ?></td>
                                        <td class="table-primary">< ?= $resultclient[$i]['adresse'] ?></td> -->

                                            <!-- <div class="btn-group btn-group-sm">
                                        <td class="table-primary">
                                        <a class="btn btn-primary" href="detailsclient.php?id=<?= $resultclient[$i]['id'] ?>">Voir</a> 
                                        <?php if ($_SESSION['user']['role'] == 'ADMIN') {
                                            //if ($resultclient[$i]['solde']>0) 
                                            $total1 += $resultclient[$i]['solde'];
                                        ?>
                                        <a class="btn btn-primary btn-success" href="editclient.php?id=<?= $resultclient[$i]['id'] ?>">Modif</a> 
                                        <a class="btn btn-danger" 
                                        href="deleteclient.php?id=<?= $resultclient[$i]['id'] ?>">Suppr</a>
                                        <?php if ($resultclient[$i] == null) break;
                                        } ?>
                                        </td>
                                        </div> -->


                                        </tr>

                                    <?php

                                    }
                                    ?>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-success"><?= number_format($total1, 2, ".", ".") ?></td>
                                </tbody>
                            </table>
                        <?php    } ?>

                        <!-- </main> -->

</body>

</html>