<?php
require_once "const.php";

// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }

//require_once('role.php');
// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    // $sql = 'SELECT * FROM `imprimes` WHERE `id` = :id;';

    // // On prépare la requête
    // $query = $db->prepare($sql);

    // // On "accroche" les paramètre (id)
    // $query->bindValue(':id', $id, PDO::PARAM_INT);

    // // On exécute la requête
    // $query->execute();

    // // On récupère le produit
    // $imprime = $query->fetch();

    // // On vérifie si le produit existe
    // if (!$imprime) {
    //     $_SESSION['erreur'] = "Cet id n'existe pas";
    //     header('Location: index0.php');
    //     die();
    // }

    $sql = 'DELETE FROM `imprimes` WHERE `id` = :id;';

    // // On prépare la requête
    $query = $db->prepare($sql);

    // // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Imprimé supprimé";
    header('Location: index0.php');


} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index0.php');
}





?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Imprimés</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <!-- <main class="container">
        <div class="row">
            <section class="col-12">

                <h1 class="entete">Veuillez confirmer votre action <br> < ?= $imprime['imprime'] ?></h1>

                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" value="< ?= $imprime['id'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" value="< ?= $imprime['imprime'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="client">Id client</label>
                    <input type="text" value=" < ?= $imprime['idclient'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Type d'imprimé</label>
                    <input value="< ?= $imprime['typ'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Matière</label>
                    <input value="< ?= $imprime['matiere'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Grammage</label>
                    <input value="< ?= $imprime['grammage'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Format Finie</label>
                    <input value="< ?= $imprime['formatfinie'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Format Tirage</label>
                    <input value="< ?= $imprime['formattirage'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Nombre de poses</label>
                    <input value="< ?= $imprime['nbrepose'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Unité de mesure</label>
                    <input value="< ?= $imprime['unitedemesure'] ?>" class="form-control" readonly>
                </div>



                <a class="btn btn-primary btn-block" href="index0.php?page=1">Annuler</a>
                <a class="btn btn-danger btn-block" href="delete2.php?id=<?= $imprime['id'] ?>">Confirmer Suppression</a>
            </section>
        </div>
    </main> -->
</body>

</html>