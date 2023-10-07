<?php
require_once "const.php";

@$_SESSION['valider'] = "non";

if (isset($_POST["submit"]) && isset($_POST["client"])) {
    $trieclientid = $_POST["client"];

    //$resultclient["id"]["client"];

    // echo $trieclientid;
}
//print_r ($_POST);
// On inclut la connexion à la base
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
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trie des clients</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
</head>

<body>
    <?php require_once('./navbarok.php') ?>
    <br><br>
    <!-- <main class="container">
    <div class="entete">
    <img  src="./images/logo.avif" alt="logo global2pub" width="100" height="auto" loading="lazy">
  
    <h1 class="entete">Gestion Commande</h1>
</div> -->
    <!-- < ?php
    if ($_SESSION['login']==="login") {
      
        ?>
       
        <br>
   
    < ?php } ?> -->
    <h1 class="entete">trie de commandes par clients</h1>
    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    <form action="./indexcommandetrieclient.php" id="commande-form" name="fo" method="get">

        <!-- ******************************************  -->
        <div class="form-group">

            <label for="client">Sélectionner le client dans la liste</label>
            <br>
            <input type="hidden" name="page" value="1" />
            <select class="form-control" id="client" name="idclient" required size="<?= sizeof($resultclient) > 6 ? 5 : sizeof($resultclient) ?>">
                <?php
                // On boucle sur la variable result
                foreach ($resultclient as $client) {
                ?>
                    <option value="<?= $client['id'] ?>">
                        <?= $client['client'] ?></option>
                <?php
                }
                ?>
            </select>
            <br>

            <button type="submit" id="submit" value="Envoyer" class="btn btn-primary btn-block">Afficher La liste triée par client</button>
    </form>

    <!-- <a href="./gestion4.php" class="btn btn-primary btn-block">Retourner à Home</a> -->
    <!-- <a href="./seDeconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a> -->
    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    </div>
    </main>
</body>

</html>