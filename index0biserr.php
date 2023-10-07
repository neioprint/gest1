<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// On inclut la connexion à la base client
require_once('connectclient.php');
$sql = "SELECT id,SUBSTRING(client,1,15) as client ,tel FROM `client`";
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

// On inclut la connexion à la base imprimé
require('connect.php');

$sql = 'SELECT * FROM `imprimes`';

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);
// O;//var_dump($result);

require('./close.php');
// pagination
@$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($result);
$nbr_element_page = 50;
$nbr_de_pages = ceil($compteur / $nbr_element_page);
$debut = ($page - 1) * $nbr_element_page;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <title>Liste des imprimés</title>
    <link rel="stylesheet" href="./css/style41.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
    crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <style>
        img {
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php
    require('./navbarok.php')
    ?>
    <main class="container">
        <!-- <div class="entete">
    <img  src="../images/logo.avif" alt="logo global2pub" width="120" height="auto">
  
    <h1 class="entete">Gestion Commande</h1>
    
    </div> -->
        <?php
        require('./menu.php')
        ?>
        <div class="row">
            <section class="col-12">
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
                <!-- <div class="avatar">
                <img src="../images/banner1.jpg" alt="image de plusieurs banner" width="400" height="auto">
                </div > -->
                <h1 class="entete">Liste des imprimés <?php echo $compteur ?></h1>
                <!-- <a href="add.php" class="btn btn-primary btn-block">Ajouter un imprimé</a> <br> -->
                <!-- <a href="../commandes/gestion4.php" class="btn btn-primary btn-block">Ajouter Commande</a>
                <a href="../commandes/indexcommande.php" class="btn btn-primary btn-block">Liste commandes</a>
               
                <a href="../clients/indexclient.php" class="btn btn-primary btn-block">Liste clients</a> -->

                <!-- < ?php
                if ($_SESSION['login']==="login") {
                
                    ?>
                
               
                <a href="../commandes/gestion4.php" class="btn btn-success btn-block">Retourner à Home</a>  
                <a href="../deconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a>
                < ?php } ?> <br>  -->

                <div id="pagination">

                    <?php
                    for ($i = 1; $i <= $nbr_de_pages; $i++) {
                        if ($page != $i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
                        else echo "<a class='btn btn-success'>$i</a>&nbsp";
                    }
                    ?>
                    <br> <br>
                    <table class="table tab table-striped">
                        <thead class="table">
                            <th class="table-primary">ID</th>
                            <th class="table-primary">Imprimé</th>
                            <!-- <th>Prix</th> -->
                            <th class="table-primary">Id Client</th>
                            <th class="table-primary">Client</th>
                            <!-- <th>Actif</th> -->
                            <th class="table-primary">Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // On boucle sur la variable result
                            //foreach($result as $imprime){
                            //for($i=$debut;$i<=$nbr_de_pages+$debut ; $i++)
                            for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {
                                if (@$result[$i] == null) break;
                            ?>
                                <tr>
                                    <td class="table-warning"><?= $result[$i]['id'] ?></td>
                                    <td class="table-primary"><?= $result[$i]['imprime'] ?></td>

                                    <td class="table-danger"><?= $result[$i]['idclient'] ?></td>

                                    <?php foreach ($resultclient as $client) {
                                        if ($result[$i]['idclient'] == $client['id']) {

                                    ?>
                                            <td class="table-danger"><?= $client['client']  ?>
                                            </td>
                                    <?php }
                                    } ?>

                                    <td class="table-success">
                                        <div class="btn-group">
                                            <a class="btn btn-primary btn-sm" href="details.php?id=<?= $result[$i]['id'] ?>">Consulter</a>
                                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                                <a class="btn btn-primary btn-success btn-sm" href="edit.php?id=<?= $result[$i]['id'] ?>">Modifier</a>
                                                <a class="btn btn-primary btn-sm" href="delete.php?id=<?= $result[$i]['id'] ?>">Supprimer</a>
                                    </td>
                                <?php


                                            } ?>
                </div>
                </tr>
            <?php
                            }
            ?>
            </tbody>
            </table>

            </section>
        </div>
    </main>
</body>

</html>