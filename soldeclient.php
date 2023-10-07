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

        require_once('closeclient.php');
        //die();

        header('Location: soldeclient.php');
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solde Client</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">

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
                <h1 class="entete">Solde client</h1>
                <br>
                <form name="fo2" method="post">
                    <label for="client">Sélectionner le client dans la liste</label>
                    <select class="form-control" id="client1" name="client1" onchange="this.form.submit()">
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
                                <?= $client['client'] . " Solde " . $client['solde'] . " DZ au " . date('d-m-Y') ?></option>
                        <?php
                        } // fin foreach client

                        ?>
                        <!-- <div class="form-group">
                                <label for="dates">Date</label>
                                < ?php $datevalue=date('Y-m-d')?>
                                <input type="date" id="dates" value=< ?= $datevalue?> name="dates" class="form-control">
                            </div> -->
                    </select>

                </form>

                <br>
                <a class="btn btn-success" href="indexcommande.php?page=1&recherche=">Retour</a>
            </section>


        </div>
    </main>
</body>

</html>