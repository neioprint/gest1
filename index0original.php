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

$sql = "SELECT * FROM `client`";

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

$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
$dat = isset($_GET['dates']) ? $_GET['dates'] : "";
$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "all";
// On inclut la connexion à la base imprimé

require('connect.php');
$sql = "select * from imprimes where imprime like  '%$recherche%'";
if ($niveau == "i") {
    $sql = "select * from imprimes where imprime like  '%$recherche%'";
}
if ($niveau == "q") {
    $sql = "select * from imprimes where impclient like  '%$recherche%'";
} else $sql = 'SELECT * FROM `imprimes`';

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
$nbr_element_page = 250;
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
        <div class="entete">
            <img src="./images/logo.avif" alt="logo global2pub" width="120" height="auto">

            <h1 class="entete">Gestion Commande</h1>

        </div>
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

                <h1 class="entete">Liste des imprimés<?php echo " " . $compteur ?></h1>
                <!-- $$$$$$$$$$$$$$$$debut recherche $$$$$$$$$ -->
                <div class="panel panel-success">
                    <div class="panel-heading">Recherche de commandes</div>
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
                                    <!-- <option value="all" < ?php if($niveau==="all") echo "selected" ?>>Toutes les commandes</option> -->
                                    <option value="q" <?php if ($niveau === "q")   echo "selected" ?> selected>Recherche par client</option>
                                    <!-- <option value="t"   < ?php if($niveau==="t")   echo "selected" ?>>Tous les clients</option> -->
                                    <!-- <option value="d"   < ?php if($niveau==="d")   echo "selected" ?>>Recherche par date</option> -->
                                    <option value="i" <?php if ($niveau === "i")   echo "selected" ?>>Recherche par imprime</option>


                                </select>
                            </div>
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Chercher.....</button>
                            <a href="./add.php" class="btn btn-primary">Ajouter Imprimé</a>





                        </form>
                    </div>
                </div>
        </div>





        <!-- $$$$$$$$$$$$$$$$$$$$$$fin recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->


        <div id="pagination">

            <?php
            for ($i = 1; $i <= $nbr_de_pages; $i++) {
                if ($page != $i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
                else echo "<a class='btn btn-success'>$i</a>&nbsp";
            }
            ?>
            <br><br>
            <table class="table tab table-striped">
                <thead class="table">
                    <th class="table-primary">ID</th>
                    <th class="table-primary">Date</th>
                    <th class="table-primary">Imprimé</th>
                    <!-- <th>Prix</th> -->
                    <th class="table-primary">Id Client</th>
                    <th class="table-primary">Client</th>
                    <th class="table-primary">Type</th>
                    <th class="table-primary">Etapes</th>
                    <th class="table-primary">Id Matiere</th>
                    <th class="table-primary">Matiere</th>
                    <!-- <th class="table-primary">Gr</th>
                    <th class="table-primary">Format finie</th>
                    <th class="table-primary">Format tirage</th>
                    <th class="table-primary">Nbre poses</th> -->
                    <th class="table-primary">Unite de mesure</th>



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
                            <td class="table-primary"><?= $result[$i]['dates'] ?></td>
                            <td class="table-primary"><?= $result[$i]['imprime'] ?></td>

                            <td class="table-danger"><?= $result[$i]['idclient'] ?></td>
                            <td class="table-danger"><?= $result[$i]['impclient']  ?></td>
                            <td class="table-danger"><?= $result[$i]['typ']  ?></td>
                            <td class="table-danger"><?= $result[$i]['etapes']  ?></td>
                            <td class="table-danger"><?= $result[$i]['idmat']  ?></td>
                            <td class="table-danger"><?= $result[$i]['matiere']  ?></td>
                            <!-- <td class="table-danger">< ?= $result[$i]['grammage']  ?></td>
                            <td class="table-danger">< ?= $result[$i]['formatfinie']  ?></td>
                            <td class="table-danger">< ?= $result[$i]['formattirage']  ?></td>
                            <td class="table-danger">< ?= $result[$i]['nbrepose']  ?></td> -->
                            <td class="table-danger"><?= $result[$i]['unitedemesure']  ?></td>
                            <!-- < ?php foreach($resultclient as $clt){
                                    if ($result[$i]['idclient']==$clt['id']) {
                                        
                                    ?>
                                <td class="table-danger">< ?= $clt['client']  ?>
                                </td>
                                < ?php }} ?> -->

                            <td class="table-primary">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-primary" href="details.php?id=<?= $result[$i]['id'] ?>">Consulter</a>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                        <a class="btn btn-success" href="edit.php?id=<?= $result[$i]['id'] ?>">Modifier</a>
                                        <a class="btn btn-danger " href="delete.php?id=<?= $result[$i]['id'] ?>">Supprimer</a>
                                </div>
                            </td>
                        <?php


                                    } ?>

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