<?php
// On démarre une session
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
// if  (!isset($_SESSION['login'])){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }

$_SESSION['valider'] = "non";



// On inclut la connexion à la base
require_once('connectcommande.php');

$sql = 'SELECT * FROM `commande` LIMIT 100';

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
require_once('closecommande.php');

//monjson=json_encode($resultcommande);
// partie countage du nombre de champs ds commande debut
// pagination
@$page = $_GET['page'];
$compteur = count($resultcommande);
$nbr_element_page = 5;
$nbr_de_pages = ceil($compteur / $nbr_element_page);
$debut = ($page - 1) * $nbr_element_page;
// partie countage du nombre de champs ds commande Fin


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des commandes</title>


    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>     -->
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">

    <!-- <style>
        .container{
            font-size:14px;
            /* color:blue; */
        }
    </style> -->
</head>

<body>
    <?php require_once('./navbarok.php') ?>

    <!-- < ?php  if ($_SESSION['user']['role']=='ADMIN') { ?> -->

    <!-- < ?php } ?> -->
    <?php
    require_once('./menu.php')
    ?>
    <?php
    if ($_SESSION['user']['role'] == 'ADMIN') { ?>
        <a href="./formcommande.php" class="btn btn-success btn-block">Ajouter Commande</a>

    <?php                                       } ?>
    <a href="./trieclient.php" class="btn btn-primary btn-block">Liste commandes par client</a>
    <!-- <main class="container">
    <div class="entete">
    <img  src="../images/logo.avif" alt="logo global2pub" width="120" height="auto" loading="lazy">
  
    <h1 class="entete">Gestion Commande</h1>
    </div>
    <div class="avatar">
    <img   src="../images/banquier.png" alt="" width="300" height="auto">
    </div> -->
    <div class="container">

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



        <!-- <a href="../imprimes/index.php" class="btn btn-primary btn-block">Liste imprimés</a>
                <a href="../clients/indexclient.php" class="btn btn-primary btn-block">Liste clients</a>
                <a href="formcommande.php" class="btn btn-success btn-block">Ajouter Commande</a>
                <a href="../commandes/gestion4.php" class="btn btn-primary btn-block">Retourner à Home</a>
                <br> -->
        <!-- < ?php
    if ($_SESSION['login']==="login") {
      
        ?>
       
       
    <a href="../deconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a>
    
    < ?php } ?> -->
        <!-- <h1 class="entete">Liste de commandes</h1> -->
        <h2 class="entete"><?= "Liste de commandes:" . $compteur ?></h2>
        <div id="pagination">

            <?php
            for ($i = 1; $i <= $nbr_de_pages; $i++) {
                echo "<a href='?page=$i' class='btn btn-success'>$i</a>&nbsp";
            }
            ?>
        </div>

        <div class="table-responsive">

            <table class="table tab">
                <thead class="table ">
                    <th>ID</th>
                    <th class="table-primary">Date commande</th>
                    <th class="table-primary">ID client</th>
                    <th class="table-primary">client</th>
                    <th class="table-primary">ID imprimé</th>
                    <th class="table-primary">imprimé</th>
                    <th class="table-primary">qte</th>
                    <th class="table-primary">prix</th>
                    <th class="table-primary">prepress</th>
                    <th class="table-primary">total</th>
                    <th class="table-primary">remarque</th>
                    <th class="table-primary">etat</th>
                    <th class="table-primary">paiement</th>
                    <th class="table-primary">Photo</th>
                    <th class="table-primary">Actions</th>

                </thead>
                <tbody>
                    <?php
                    $total1 = 0;
                    $nombrecommandes = 0;
                    // On boucle sur la variable result
                    foreach ($resultcommande as $commande) {
                    ?>
                        <tr>
                            <td class="table-prima ry"><?= $commande['id'] ?></td>
                            <td class="table-succe ss"><?= $commande['dates'] ?></td>
                            <td class="table-pri mary"><?= $commande['idclient'] ?></td>
                            <td class="table-i nfo"><?= $commande['nomclient'] ?></td>
                            <td class="table-pr imary"><?= $commande['idimprime'] ?></td>
                            <td class="table-war ning"><?= $commande['imprime'] ?></td>
                            <td class="table-pri mary"><?= $commande['quantite'] ?></td>
                            <td class="table-p rimary"><?= number_format($commande['prix'], 2, ",", ".") ?></td>
                            <td class="table-p rimary"><?= $commande['prepress'] ?></td>
                            <td class="table-da nger"><?= number_format($commande['total'], 2, ",", ".") ?></td>
                            <td class="table-pr imary"><?= $commande['remarque'] ?></td>
                            <td class="table-pr imary"><?= $commande['etat'] ?></td>
                            <td class="table-pr imary"><?= $commande['paiement'] ?></td>
                            <td class="table-s uccess">
                                <img src="./uploads/66-30--15-08-2022 17.png" alt="logo global2pub" width="90" height="auto">
                            </td>
                            <td class="table-succe ss">
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm btn-success" href="detailscommande.php?id=<?= $commande['id'] ?>">Consulter</a>
                                    <br>
                                    <?php $etatsuivi = $commande['etat'];

                                    $etatsuivi = explode("/", $etatsuivi);
                                    $etatsuivi = $etatsuivi[0];
                                    if ($etatsuivi == 1) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $commande['id'] ?>&suite=99">Terminer</a>
                                    <?php } ?>

                                    <?php if ($etatsuivi == 0) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $commande['id'] ?>&suite=9">Debuter</a>
                                    <?php } ?>
                                    <?php if ($etatsuivi == 2) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $commande['id'] ?>&suite=999">Livrer</a>
                                    <?php } ?>

                                    <?php if ($etatsuivi == 3) { ?>
                                        <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $commande['id'] ?>&suite=9999">Archiver</a>
                                    <?php } ?>

                                    <!-- <a class="btn btn-primary btn-sm btn-danger" href="terminercommande.php?id=<?= $commande['id'] ?>">Terminer</a>   -->
                                    <br>
                                    <?php
                                    //print_r($_SESSION['user']['role']);
                                    if ($_SESSION['user']['role'] == 'ADMIN') {
                                        // print_r($_SESSION['user']['role']);
                                    ?>
                                        <a class="btn btn-primary btn-sm" href="editcommande.php?id=<?= $commande['id'] ?>">Modifier</a>

                                        <br>
                                        <a class="btn btn-primary btn-sm" href="blivraisoncommande.php?id=<?= $commande['id'] ?>">Imprimer</a>
                                    <?php } ?>
                                </div>
                            </td>



                        </tr>

                    <?php
                        $total1 += $commande['total'];
                        $nombrecommandes += 1;
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
                    <td class="table-success"><?= number_format($total1, 2, ",", ".") ?></td>
                    <td class="table-primary"></td>
                    <td class="table-primary"></td>
                    <td class="table-primary"></td>
                    <td class="table-primary"></td>
                </tbody>

            </table>
        </div>

        <!-- <a href="addcommande.php" class="btn btn-primary">Ajouter une commande</a> -->


    </div>
    </main>
</body>

</html>
<!-- <td class="table-primary">Nombre de Commandes < ?= $nombrecommandes ?> </td> -->