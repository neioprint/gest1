<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['dates']) && !empty($_POST['dates'])
    ) {
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $dates = strip_tags($_POST['dates']);
        $designation = strip_tags($_POST['designation']);
        $divers = strip_tags($_POST['divers']);
        $periodicite = strip_tags($_POST['periodicite']);
        $montant = strip_tags($_POST['montant']);

        $sql = 'UPDATE `depense` SET `dates`=:dates,
        `designation`=:designation,`divers`=:divers,`periodicite`=:periodicite,
        `montant`=:montant WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':designation', $designation, PDO::PARAM_STR);
        $query->bindValue(':divers', $divers, PDO::PARAM_STR);
        $query->bindValue(':periodicite', $periodicite, PDO::PARAM_STR);
        $query->bindValue(':montant', $montant, PDO::PARAM_STR);




        $query->execute();

        $_SESSION['message'] = "Depense modifié";
        require_once('close.php');

        header('Location: depense.php?page=1');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

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

    // On vérifie si le produit existe
    if (!$depense) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: depense.php?page=1');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: depense.php?page=1');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
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
                <h1 class="entete">Modifier Depense</h1>
                <form method="post">
                    <div class="form-group">

                        <label for="dates">Date</label>
                        <input type="date" id="dates" name="dates" class="form-control" value="<?= $depense['dates'] ?>">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" id="designation" name="designation" class="form-control" value="<?= $depense['designation'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="divers">Divers</label>
                                <input type="text" id="divers" name="divers" class="form-control" value="<?= $depense['divers'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="periodicite">Periodicite</label>
                                <input type="text" id="periodicite" name="periodicite" class="form-control" value="<?= $depense['periodicite'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="montant">Montant</label>
                                <input type="text" id="montant" name="montant" class="form-control" value="<?= $depense['montant'] ?>">
                            </div>
                            <input type="hidden" value="<?= $depense['id'] ?>" name="id">
                            <button class="btn btn-primary">Envoyer</button>
                </form>
                <br>
                <a class="btn btn-primary" href="depense.php?page=1">Retour</a>
            </section>

        </div>
    </main>
</body>

</html>