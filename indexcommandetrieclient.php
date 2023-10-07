<?php
require_once "const.php";


if (isset($_GET['idclient'])) {
    //  if (isset($_GET['page'])) 
    @$page = $_GET['page'];
    //else $page=1;
    $trieclientid = $_GET['idclient'];
    //$_POST["client"];
    $_SESSION['numblclient'] = $trieclientid;
    //    echo $trieclientid;

    //echo "je stoppe avant traitement";
    // On inclut la connexion à la base
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // recuperer les id des clients depuis la base

    //require_once('trieclient.php');
    require('./connectclient.php');

    //$sql = 'SELECT * FROM `client`';
    $sql = "SELECT * FROM client WHERE id=$trieclientid";
    // On prépare la requête
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
    //print_r($resultclient);
    // echo "<pre>";
    // print_r($resultclient[0]['client']);

    // echo "</pre>";
    $index = @$resultclient[0]['client'];
    //$_SESSION["commandevide"]=$resultclient[0]["client"];

    //var_dump($_SESSION["commandevide"]);

    require('./closeclient.php');



    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    //die;
    require('connectcommande.php');
    //`id`=:id;';
    $sql = "SELECT * FROM `commande` WHERE idclient=$trieclientid";
    //echo $trieclientid;
    // On prépare la requête
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
    $etat = count($resultcommande);
    // echo "<pre>";
    // print_r($resultcommande);
    // echo "</pre>";
    require('closecommande.php');
    // pagination

    $compteur = count($resultcommande);
    //print_r($compteur);
    $nbr_element_page = 10;
    $nbr_de_pages = ceil($compteur / $nbr_element_page);
    $debut = ($page - 1) * $nbr_element_page;
    if ($etat < 1) {
        //$tableau=$_SESSION["commandevide"];
        $_SESSION['erreur'] = "Aucune commande pour " . $index;

        header('Location: ./trieclient.php');
        die();
    }
}
//else header('Location: ./indexcommande?page=1.php');
//die("accee non autorise");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de commandes par clients</title>
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
    crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/style41.css">
    <!-- <style>
        .container{
            font-size:14px;
            /* color:blue; */
        }
    </style> -->
</head>

<body>
    <?php require_once('./navbarok.php') ?>
    <main class="container">
        <!-- <div class="entete">
    <img  src="./images/logo.avif" alt="logo global2pub" width="120" height="auto" loading="lazy">
  
    <h1 class="entete">Gestion Commande</h1>
    </div> -->
        <div class="container">
            <!-- <div class="alert alert-success">
bbnbbn,b,nb,nbn,bn,b,nb
        </div> -->
            <?php
            if (!empty($_SESSION['erreur'])) {
                echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                $_SESSION['erreur'] = "";
            }
            ?>
            <?php
            if (!empty($_SESSION['message'])) {
                echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
                $_SESSION['message'] = "";
            }
            ?>


            <!-- <a href="./gestion4.php" class="btn btn-primary btn-block">Ajouter Commande</a> -->
            <!-- <a href="./index0?page=1.php" class="btn btn-primary btn-block">Liste imprimés</a>
                <a href="./indexclient?page=1.php" class="btn btn-primary btn-block">Liste clients</a> -->





            <!-- <a href="./seDeconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a> -->

            <h1 class="entete">Liste de commandes par client</h1>
            <h2 class="entete"><?= "Nombre de commandes " . $etat ?></h2>
            <div id="pagination">

                <?php
                for ($i = 1; $i <= $nbr_de_pages; $i++) {
                    echo "<a href='?page=$i&idclient=$trieclientid' class='btn btn-success'>$i</a>&nbsp";
                }
                ?>
            </div>
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover tab">
                    <thead class="table-dark">
                        <th>ID</th>
                        <th>Date commande</th>
                        <th>ID client</th>
                        <th>client</th>
                        <th>ID imprimé</th>
                        <th>imprimé</th>
                        <th>qte</th>
                        <th>prix</th>
                        <th>prepress</th>
                        <th>total</th>
                        <th>remarque</th>
                        <th>etat</th>
                        <th>paiement</th>
                        <th>Action</th>
                        <!-- <th>Actions</th> -->
                    </thead>
                    <tbody>
                        <?php
                        $total1 = 0;
                        //$nombrecommandes=0;
                        // On boucle sur la variable result
                        //foreach($resultcommande as $commande)
                        //   for($i=$debut;$i<=$nbr_de_pages+$debut+1 ; $i++)
                        for ($i = $debut; $i <= $nbr_element_page * $nbr_de_pages + $debut - 1; $i++) {
                            if (@$resultcommande[$i] == null) break;
                        ?>
                            <tr>
                                <td class="table-primary"><?= $resultcommande[$i]['id'] ?></td>
                                <td class="table-success"><?= $resultcommande[$i]['dates'] ?></td>
                                <td class="table-primary"><?= $resultcommande[$i]['idclient'] ?></td>
                                <td class="table-info"><?= $resultcommande[$i]['nomclient'] ?></td>
                                <td class="table-primary"><?= $resultcommande[$i]['idimprime'] ?></td>
                                <td class="table-warning"><?= $resultcommande[$i]['imprime'] ?></td>
                                <td class="table-primary"><?= $resultcommande[$i]['quantite'] ?></td>
                                <td class="table-primary"><?= number_format($resultcommande[$i]['prix'], 2, ",", ".") ?></td>
                                <td class="table-primary"><?= $resultcommande[$i]['prepress'] ?></td>
                                <td class="table-danger"><?= number_format($resultcommande[$i]['total'], 2, ",", ".") ?></td>
                                <td class="table-primary"><?= $resultcommande[$i]['remarque'] ?></td>
                                <td class="table-primary"><?= $resultcommande[$i]['etat'] ?></td>
                                <td class="table-primary"><?= $resultcommande[$i]['paiement'] ?></td>
                                <td class="table-success">
                                    <?php $etatsuivi = $resultcommande[$i]['etat'];

                                    $etatsuivi = explode("/", $etatsuivi);
                                    $etatsuivi = $etatsuivi[0];
                                    if ($etatsuivi == 1) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=99">Terminer</a>
                                    <?php } ?>

                                    <?php if ($etatsuivi == 0) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=9">Debuter</a>
                                    <?php } ?>
                                    <?php if ($etatsuivi == 2) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=999">Livrer</a>
                                    <?php } ?>

                                    <?php if ($etatsuivi == 3) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=9999">Archiver</a>
                                    <?php } ?>

                                </td>
                                <!-- < ?php 
                            
                            } ?> -->
                                <div class="btn-group">

                                </div>
                                </td>



                            </tr>

                        <?php
                            $total1 += $resultcommande[$i]['total'];
                            //$nombrecommandes+=1;
                        }
                        ?>
                        <td class="table-primary">Total en DZ</td>
                        <td class="table-danger"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-success"><?= number_format($total1, 2, ".", ".") ?></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <!-- <td class="table-primary"></td> -->
                    </tbody>

                </table>
            </div>
            <br>
            <!-- <a href="addcommande.php" class="btn btn-primary">Ajouter une commande</a> -->
            <!-- <a href="gestion4.php" class="btn btn-primary">Retourner à Home</a> -->
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN') {

            ?>
                <a href="blivraisonneio.php?idclient=<?= $trieclientid ?>" class="btn btn-primary">Emettre Le Bon de livraison</a>

                <a class="btn btn-primary btn-sm" href="proforma.php?idclient=<?= $trieclientid ?>">Proforma</a>
                <br> <br>
            <?php } ?>
            <!-- <a class="btn btn-primary" href="sms/envoismsok.php?idclient=<?= $trieclientid ?>" 
                >Envoi Sms de livraison</a> -->

        </div>
    </main>
</body>

</html>