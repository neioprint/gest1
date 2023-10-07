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

    $sql = 'SELECT * FROM `commande` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $commande = $query->fetch();

    // On vérifie si le produit existe
    if (!$commande) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: indexcommande.php');
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
    header('Location: indexcommande.php');
}
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$idclient = $commande['idclient'];
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

// print_r($resultclient);
// die();
require_once('./closeclient.php');
//print_r($resultclient)
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Imprimés</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
    crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">

                <h1 class="entete">Veuillez confirmer votre action</h1>

                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" value="<?= $commande['id'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" value="<?= $commande['nomclient'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="client">Imprimé</label>
                    <input type="text" value="<?= $commande['imprime'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Quantité</label>
                    <input type="text" class="form-control" value="<?= $commande['quantite'] ?>" readonly>
                </div>
                <!-- <p>Quantité:< ?= $commande['quantite'] ?></p> -->
                <div class="form-group">
                    <label>Prix</label>
                    <input type="text" class="form-control" value="<?= $commande['prix'] ?>" readonly>
                </div>
                <!-- <p>Prix :< ?= $commande['prix'] ?></p> -->
                <div class="form-group">
                    <label>Pre Press</label>
                    <input type="text" class="form-control" value="<?= $commande['prepress'] ?>" readonly>
                </div>
                <!-- <p>Pre Press:< ?= $commande['prepress'] ?></p> -->
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" class="form-control" value="<?= $commande['total'] ?>" readonly>
                </div>
                <!-- <p>Total Commande:< ?= $commande['total'] ?></p> -->
                <div class="form-group">
                    <label>Remarques</label>
                    <input type="text" class="form-control" value="<?= $commande['remarque'] ?>" readonly>
                </div>

                <!-- <a class="btn btn-primary btn-block" href="indexcommande.php?recherche=&niveau=">Annuler</a> -->
                <button class="btn btn-primary btn-block" onclick="history.back()">Retour Et Annuler</button>

                <a class="btn btn-danger btn-block" href="deletecommande2.php?id=<?= $commande['id'] ?>&total=<?= $commande['total'] ?>&idclient=<?= $commande['idclient'] ?>&solde=<?= $resultclient['solde'] ?>">Confirmer Suppression</a>
            </section>
        </div>
    </main>
</body>

</html>