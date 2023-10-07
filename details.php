<?php
// On démarre une session

require_once "const.php";


// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');
    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `imprimes` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $imprime = $query->fetch();
    //print_r($imprime);
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // connexion base client

    // On inclut la connexion à la base client imprimes client
    require_once('./connectclient.php');
    $id = $imprime['idclient'];
    //echo $id;
    $sql = 'SELECT * FROM `client` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $resultclient = $query->fetch();


    require_once('./closeclient.php');
    // echo "<br>";
    // echo "<br>";

    // print_r($resultclient);
    // die();
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // On vérifie si le produit existe
    if (!$imprime) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ./index0.php?page=1');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ./index0.php?page=1');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'imprimé</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <!-- < ?php require_once('./base4.php'); ?> -->

    <main class="container">
        <div class="row">
            <section class="col-12">
                <h2 class="entete">Détails de l'imprimé</h2>
                <div class="form-group">
                    <label>client</label>
                    <!-- <input value="< ? $imprime['idclient'].'/'.$resultclient['client'] ?>" class="form-control" readonly> -->
                    <!-- <input value="< ?= $imprime['idclient'].'/'.$resultclient['client'] ?>" class="form-control" readonly> -->

                    <input value="<?= $imprime['idclient'] . '/' . $imprime['impclient'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Id imprimé</label>
                    <input value="<?= $imprime['id'] ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Détails de l'imprimé</label>
                    <input value="<?= $imprime['imprime'] ?>" class="form-control" readonly>
                </div>

              
                <div class="form-group">
                    <label>Type d'imprimé</label>
                    <input value="<?= $imprime['typ'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Id Matière</label>
                    <input value="<?= $imprime['idmat'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Matière</label>
                    <input value="<?= $imprime['matiere'] ?>" class="form-control" readonly>
                </div>
                <!-- <div class="form-group">
                    <label>Grammage</label>
                    <input value="< ?= $imprime['grammage'] ?>" class="form-control" readonly>
                </div> -->
                 <div class="form-group">
                    <label>Format Finie</label>
                    <input value="<?= $imprime['formatfinie'] ?>" class="form-control" readonly>
                </div>
                <!-- <div class="form-group">
                    <label>Format Tirage</label>
                    <input value="< ?= $imprime['formattirage'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Nombre de poses</label>
                    <input value="< ?= $imprime['nbrepose'] ?>" class="form-control" readonly>
                </div> -->
                <div class="form-group">
                    <label>Unité de mesure</label>
                    <input value="<?= $imprime['unitedemesure'] ?>" class="form-control" readonly>
                </div>


                <a class="btn btn-primary" href="index0.php?page=1">Retour</a>
                <a class="btn btn-primary" href="edit.php?id=<?= $imprime['id'] ?>">Modifier</a>

            </section>
        </div>
    </main>
</body>

</html>