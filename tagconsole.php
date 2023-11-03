<?php
//require_once "const.php";



// On inclut la connexion à la base
require_once('connectcommande.php');

// On nettoie les données envoyées

$id = strip_tags($_GET['id']);
$tag = strip_tags($_GET['tag']);


if ($tag == 0) {

    // if ($_POST['etat'] != 6 && $_POST['tag'] == 0) {
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    $annee = date('Y');
    $sql = 'SELECT * FROM `numero` WHERE `annee`=:annee';
    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
//$query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':annee', $annee, PDO::PARAM_INT);
    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $numero = $query->fetch();
    //print_r($numero['facture']);

    // die();

    $tag = $numero['tag'] + 1;
    $idd = $numero['id'];
    // print_r($nbr);
// print_r($numero['id']);





    $sql = 'UPDATE `numero` SET `tag`=:tag  WHERE `id`=:idd;';

    $query = $db->prepare($sql);
    $query->bindValue(':idd', $idd, PDO::PARAM_INT);
    $query->bindValue(':tag', $tag, PDO::PARAM_INT);




    $query->execute();
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    //$tag = strip_tags($_POST['tag']);
    // $t = 0;
    // if ($tag >= 0) {
    //     //$tag += 1;
    //     $t = 1;
    //     $_SESSION['message'] .= "Tag Commande modifié mise en attente d'impression";
    // } else {
    //     $tag = 11111111;
    //     $t = 1;
    //     $_SESSION['message'] .= "Tag Commande modifié fin d'impression";
    // }
    // // if ($tag == 11 && $t == 0) {
    // //     $tag = 10;
    // //     $_SESSION['message'] .= "Tag Commande modifié Archivé";
    // // }
    // if ($tag == 11111111 && $t == 0) {
    //     $tag = 11111110;
    //     $_SESSION['message'] .= "Tag Commande modifié Archivé";
    // }

    echo $tag;
    //die();
    //$_SESSION['message'] = "Tag Commande modifié";
    // $sql = 'UPDATE `commande` SET `client`=:client WHERE `id`=:id;';
    $sql = 'UPDATE `commande` SET `tag`=:tag WHERE  `id`=:id;';

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->bindValue(':tag', $tag, PDO::PARAM_INT);
    echo $tag;
    $query->execute();

    //die();
    require_once('closecommande.php');
    if ($_SESSION['user']['role'] == 'ADMIN') {
        header('Location: ./indexcommande.php?recherche=&niveau=ins');
        // die();
    } else {
        header('Location: ./indexcommandesimplifie.php?recherche=&niveau=ins');
        //die();
    }
    //header("Location: indexcommande.php?page=$page&recherche=&niveau=");
} else {
    //$_SESSION['erreur'] .= "Tag Impossible (Deja TAGGE ou autre)";
    if ($_SESSION['user']['role'] == 'ADMIN') {
        header('Location: ./indexcommande.php?recherche=&niveau=ins');
        die();
    } else {
        header('Location: ./indexcommandesimplifie.php?recherche=&niveau=ins');
        die();
    }



}








// Est-ce que l'id existe et n'est pas vide dans l'URL
// if (isset($_GET['id']) && !empty($_GET['id'])) {
//     require_once('connectcommande.php');

//     // On nettoie l'id envoyé
//     $id = strip_tags($_GET['id']);

//     $sql = 'SELECT * FROM `commande` WHERE `id` = :id;';

//     // On prépare la requête
//     $query = $db->prepare($sql);

//     // On "accroche" les paramètre (id)
//     $query->bindValue(':id', $id, PDO::PARAM_INT);

//     // On exécute la requête
//     $query->execute();

//     // On récupère le produit
//     $commande = $query->fetch();

//     // On vérifie si le produit existe
//     if (!$id) {
//         $_SESSION['erreur'] = "Cet id n'existe pas";
//         if ($_SESSION['user']['role'] == 'ADMIN')
//             header('Location: ./indexcommande.php?recherche=&niveau=ins');
//         else
//             header('Location: ./indexcommandesimplifie.php?recherche=&niveau=ins');
//         //header("Location: indexcommande.php?page=$page&recherche=&niveau=");
//     }
// } else {
//     $_SESSION['erreur'] = "URL invalide";
//     if ($_SESSION['user']['role'] == 'ADMIN')
//         header('Location: ./indexcommande.php?recherche=&niveau=ins');
//     else
//         header('Location: ./indexcommandesimplifie.php?recherche=&niveau=ins');
//     //header("Location: indexcommande.php?page=$page&recherche=&niveau=");
// }

?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <link rel="stylesheet" href="./css/style41.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
        <link rel="icon" href="./images/logo.avif" type="image" />
        <?php
        // require_once('./head.php');
        require_once('./navbarok.php')
            ?>
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
                    <h1 class="entete">Tagger commande <br> changement de priorité</h1>
                    <form method="post">
                        <div class="form-group">
                            <label for="id">Id Commande</label>
                            <input type="number" name="id" class="form-control" value="<?= $commande['id'] ?>" name="id"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="tag">TAG Commande</label>
                            <input type="number" class="form-control" value="<?= $commande['tag'] ?>" name="tag"
                                readonly>
                        </div>
                        <?php
                        if ($_SESSION['user']['role'] == 'ADMIN') {
                            ?>
                            <div class="form-group">
                                <label for="dates">Date</label>
                                <input type="date" id="dates" name="dates" class="form-control"
                                    value="<?= $commande['dates'] ?>" readonly>
                            <?php } else { ?>
                                <label for="dates">Date</label>
                                <input type="text" id="dates" name="dates" class="form-control"
                                    value="<?= $commande['dates'] ?>" rendonly>
                            <?php }

                        ?>
                            <div class="form-group">
                                <label for="idclient">Id Client</label>
                                <input type="number" id="idclient" name="idclient" class="form-control"
                                    value="<?= $commande['idclient'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nomclient">Nom Client</label>
                                <input type="text" id="nomclient" name="nomclient" class="form-control"
                                    value="<?= $commande['nomclient'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="idimprime">ID Imprime</label>
                                <input type="number" id="idimprime" name="idimprime" class="form-control"
                                    value="<?= $commande['idimprime'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="imprime">Imprime</label>
                                <input type="text" id="imprime" name="imprime" class="form-control"
                                    value="<?= $commande['imprime'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité</label>
                                <input type="number" min="0" id="quantite" name="quantite" class="form-control"
                                    value="<?= $commande['quantite'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="number" min="0" step="0.01" id="prix" name="prix" class="form-control"
                                    value="<?= $commande['prix'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="prepress">PrePress</label>
                                <input type="number" min="0" id="prepress" name="prepress" class="form-control"
                                    value="<?= $commande['prepress'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total">total</label>
                                <input type="number" min="0" id="total" name="total" class="form-control"
                                    value="<?= $commande['total'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="remarque">Remarque</label>
                                <input type="text" id="remarque" name="remarque" class="form-control"
                                    value="<?= $commande['remarque'] ?>" readonly>
                            </div>
                            <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                            <!-- <div class="form-group">


                            <fieldset>
                                <legend>Etats Commandes < ?= $commande['etat'] ?></legend>
                                <input type="radio" id="etat" name="etat" value="0/En attente">
                                <label for="etat">En Attente</label>
                                <input type="radio" id="etat" name="etat" value="1/En cours">
                                <label for="etat">En cours</label>
                                <input type="radio" id="etat" name="etat" value="2/Terminé">
                                <label for="etat">Terminé</label> <br>
                                <input type="radio" id="etat" name="etat" value="3/Livrée">
                                <label for="etat">Livrée</label>
                                <br>
                                <input type="radio" id="etat" name="etat" value="4/Annulée">
                                <label for="etat">Annulée</label>
                                <input type="radio" id="etat" name="etat" value="5/Archivée">
                                <label for="etat">Archivée</label>
                                <br>
                                <input type="radio" id="etat" name="etat" value="6/Proforma">
                                <label for="etat">Proforma</label>
                            </fieldset>
                        </div> -->
                            <?php $etatsuivi = $commande['etat'];

                            $etatsuivi = explode("/", $etatsuivi);
                            //print_r ($commande['etat']);
                            $etatsuivi = $etatsuivi[0];
                            ?>
                            <!-- <script>
                            var vari = < ?php echo json_encode($etatsuivi); ?>;
                            // console.log(vari);
                            var elts = document.querySelectorAll('#etat');
                            //console.log(elts);
                            elts[vari].checked = true;
                        </script> -->
                            <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                            <div class="form-group">
                                <label for="etat">Etat</label>
                                <input type="text" id="etat" name="etat" class="form-control" value="<?= $etatsuivi ?>">
                            </div>
                            <!-- <div class="form-group">
                        <label for="paiement">Paiement</label>
                        <input type="text" id="paiement" name="paiement" class="form-control" value="< ?= $commande['paiement']?>"  >
                    </div> -->
                            <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                            <!-- <div class="form-group">
                            <fieldset>
                                <legend>Paiement < ?= $commande['paiement'] ?></legend>
                                <input type="radio" id="paiement" name="paiement" value="0/Non payée">
                                <label for="paiement">Non payée</label>

                                <input type="radio" id="paiement" name="paiement" value="1/Payé">
                                <label for="paiement">Payée</label>

                                <input type="radio" id="paiement" name="paiement" value="2/Avance">
                                <label for="paiement">Avance</label>
                                <br>
                                <input type="radio" id="paiement" name="paiement" value="3/A terme">
                                <label for="paiement">A terme</label>
                            </fieldset>
                        </div> -->
                            <!-- < ?php $pai = $commande['paiement'];

                        $pai = explode("/", $pai);
                        //print_r ($commande['etat']);
                        $pai = $pai[0];
                        ?> -->
                            <!-- <script>
                            var vari = < ?php echo json_encode($pai); ?>;
                            // console.log(vari);
                            var elts = document.querySelectorAll('#paiement');
                            //console.log(elts);
                            elts[vari].checked = true;
                        </script> -->
                            <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                            <!-- <button type="submit" class="btn btn-primary">Envoyer</button> -->
                            <input type="submit" name="submit" value="Envoyer Commande" class="btn btn-primary" />
                    </form>
                    <br>
                    <!-- <a class="btn btn-primary" href="indexcommande.php?page=< ?= $page ?>&recherche=&niveau=">Retour</a> -->
                </section>
            </div>
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
            <br>
        </main>
        <br><br>
    </body>

</html>