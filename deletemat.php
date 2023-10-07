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
    require_once('connectmatiere.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `matiere` WHERE `idmat` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $matiere = $query->fetch();

    // On vérifie si le produit existe
    if (!$matiere) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: matiere.php');
        die();
    }

    // $sql = 'DELETE FROM `imprimes` WHERE `id` = :id;';

    // // On prépare la requête
    // $query = $db->prepare($sql);

    // // On "accroche" les paramètre (id)
    // $query->bindValue(':id', $id, PDO::PARAM_INT);

    // // On exécute la requête
    // $query->execute();
    // $_SESSION['message'] = "Produit supprimé";
    // header('Location: index.php');


} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: matiere.php');
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
    <main class="container">
        <div class="row">
            <section class="col-12">

                <h1 class="entete">Veuillez confirmer votre action <br> ?></h1>

                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" value="<?= $matiere['idmat'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="id">Date</label>
                    <input type="text" value="<?= $matiere['dates'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="id">Matiere</label>
                    <input type="text" value="<?= $matiere['matiere'] ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="id">Grammage</label>
                    <input type="text" value="<?= $matiere['grammage'] ?>" class="form-control" readonly>
                </div>


                <a class="btn btn-primary btn-block" href="matiere.php?page=1">Annuler</a>
                <a class="btn btn-danger btn-block" href="delete2mat.php?id=<?= $matiere['idmat'] ?>">Confirmer Suppression</a>
            </section>
        </div>
    </main>
</body>

</html>





<!-- <td class="table-primary">< ?= @$matiere[$i]['formatxxyy'] ?></td>
                <td class="table-primary">< ?= @$matiere[$i]['ptf']."kg" ?></td>
                <td class="table-primary">
                < ?= @$matiere[$i]['qtecalculee']."Feuilles" ?> -->