<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `versement` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $versement = $query->fetch();
    $idclient = $versement['idclient'];
    $versementancien = $versement['versement'];
    // On vérifie si le produit existe
    if (!$versement) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: versement.php?page=1');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: versement.php?page=1');
}



if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['dates']) && !empty($_POST['dates'])
    ) {
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);// celui du versement
        $dates = strip_tags($_POST['dates']);
        $versement = strip_tags($_POST['versement']);
        // $prix = strip_tags($_POST['prix']);
        // $qteMin = strip_tags($_POST['qteMin']);

        $sql = 'UPDATE `versement` SET `dates`=:dates,`versement`=:versement WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':versement', $versement, PDO::PARAM_STR);
        // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        // $query->bindValue(':qteMin', $qteMin, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] .= "Versement modifié ";
        require_once('closeclient.php');
              // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
              require('./connectclient.php');

              //$sql = 'SELECT * FROM `client` order by client asc';
              $sql = 'SELECT * FROM `client` WHERE `id` = :idclient;';
              // On prépare la requête
              $query = $db->prepare($sql);
              $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
              // On exécute la requête
              $query->execute();

              // On stocke le résultat dans un tableau associatif
              $resultclient = $query->fetch(PDO::FETCH_ASSOC);


              require_once('./closeclient.php');
              $_SESSION['message'] .= "Solde  modifié";
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


        //ici il faut ajouter le solde dans la fiche client
         $solde=$resultclient['solde']-$versementamodifier['versement']+$versement;


        header('Location: versement.php?page=1');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Paiement</title>
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
                <h1 class="entete">Modifier Paiement</h1>
                <form method="post">
                    <div class="form-group">

                        <label for="dates">Date</label>
                        <input type="date" id="dates" name="dates" class="form-control" value="<?= $versement['dates'] ?>">

                        <label for="dates">Client</label>
                        <input type="text" id="client" name="client" class="form-control" value="<?= $versement['client'] ?>" readonly>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="versement">Paiement</label>
                                <input type="number" step="0.1" id="versement" name="versement" class="form-control" value="<?= $versement['versement'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="ref">Reference</label>
                                <input type="text" id="ref" name="ref" class="form-control" value="<?= $versement['ref'] ?>">
                            </div>


                            <input type="hidden" value="<?= $versement['id'] ?>" name="id">
                            <button class="btn btn-primary">Valider</button>
                </form>
                <br><br>
                <a class="btn btn-primary" href="versement.php?page=1">Retour</a>
            </section>

        </div>
    </main>
</body>

</html>