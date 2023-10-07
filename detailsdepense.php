<?php
// On démarre une session

require_once "const.php";

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');
    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `depense` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $depense = $query->fetch();
    //print_r($imprime);
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // connexion base client

    // On inclut la connexion à la base client imprimes client
    // require_once('./connectclient.php');
    // $id = $imprime['idclient'];
    // //echo $id;
    // $sql = 'SELECT * FROM `client` WHERE `id` = :id;';

    // // On prépare la requête
    // $query = $db->prepare($sql);
    // $query->bindValue(':id', $id, PDO::PARAM_INT);

    // // On exécute la requête
    // $query->execute();

    // // On stocke le résultat dans un tableau associatif
    // $resultclient = $query->fetch();


    // require_once('./closeclient.php');
    // echo "<br>";
    // echo "<br>";

    // print_r($resultclient);
    // die();
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // On vérifie si le produit existe
    if (!$depense) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ./depense.php?page=1');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ./depense.php?page=1');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails depense</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <!-- < ?php require_once('./base4.php'); ?> -->

    <main class="container">
        <div class="row">
            <section class="col-12">
                <h2 class="entete">Détails Depenses</h2>
                <div class="form-group">

<label for="dates">Date</label>
<input type="date" id="dates" name="dates" class="form-control" value="<?= $depense['dates'] ?>" readonly>
<div class="form-group">
    <div class="form-group">
        <label for="designation">Designation</label>
        <input type="text" id="designation" name="designation" class="form-control" value="<?= $depense['designation']?>" readonly>
    </div>
    <div class="form-group">
        <label for="divers">Divers</label>
        <input type="text" id="divers" name="divers" class="form-control" value="<?= $depense['divers']?>" readonly>
    </div>  
    <div class="form-group">
        <label for="periodicite">Periodicite</label>
        <input type="text" id="periodicite" name="periodicite" class="form-control" value="<?= $depense['periodicite']?>" readonly>
    </div>  
    <div class="form-group">
        <label for="montant">Montant</label>
        <input type="text" id="montant" name="montant" class="form-control" value="<?= $depense['montant']?>" readonly>
    </div>  
    <input type="hidden" value="<?= $depense['id']?>" name="id" readonly>


              

                <a class="btn btn-primary" href="depense.php?page=1">Retour</a>
                <a class="btn btn-primary" href="editdepense.php?id=<?= $depense['id'] ?>">Modifier</a>

            </section>
        </div>
    </main>
</body>

</html>