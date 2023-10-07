<?php
require_once "const.php";


// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// Est-ce que l'id existe et n'est pas vide dans l'URL
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connectcommande.php');

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
        header('Location: indexcommande.php?recherche=&niveau=ins');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: indexcommande.php?recherche=&niveau=insq');
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
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h2 class="entete">Détails de commande</h2>
                <div class="form-group">
                    <label>ID Commande</label>
                    <input type="text" class="form-control" value="<?= $commande['id'] ?>" readonly>
                    <!-- <p>ID Commande: < ?= $commande['id'] ?></p> -->
                </div>
                <div class="form-group">
                    <label for="tag">TAG Commande</label>
                    <input type="number" class="form-control" value="<?= $commande['tag'] ?>" name="tag" readonly>
                </div>
                <div class="form-group">
                    <label>Date commande</label>
                    <input type="text" class="form-control" value="<?= $commande['dates'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>ID Client</label>
                    <!-- <p>Date commande:< ?= $commande['dates'] ?></p> -->
                    <input type="text" class="form-control" value="<?= $commande['idclient'] ?>" readonly>
                </div>
                <!-- <p>ID Client:< ?= $commande['idclient'] ?></p> -->
                <div class="form-group">
                    <label>Nom CLient</label>
                    <input type="text" class="form-control" value="<?= $commande['nomclient'] ?>" readonly>
                </div>
                <!-- <p>Nom CLient< ?= $commande['nomclient'] ?></p> -->
                <div class="form-group">
                    <label>ID Imprimé</label>
                    <input type="text" class="form-control" value="<?= $commande['idimprime'] ?>" readonly>
                </div>
                <!-- <p>ID Imprimé:< ?= $commande['idimprime'] ?></p> -->
                <div class="form-group">
                    <label>Imprimé</label>
                    <input type="text" class="form-control" value="<?= $commande['imprime'] ?>" readonly>
                </div>
                <!-- <p>Imprimé:< ?= $commande['imprime'] ?></p> -->
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
                <!-- <p>Remarque:< ?= $commande['remarque'] ?></p> -->


                <div class="form-group">
                    <div class="radio form-group">
                        <?php $etatsuivi = $commande['etat'];

                        $etatsuivi = explode("/", $etatsuivi);

                        //$etatsuivisauv=$etatsuivi;
                        $etatsuivi = $etatsuivi[0];

                        ?>

                        <fieldset>
                            <legend>Etats Commandes <?= $commande['etat'] ?></legend>
                            <?php if ($etatsuivi == 0) { ?>
                                <input type="radio" id="etat" name="etat" value="0/En attente" checked>
                                <label for="etat0">En Attente</label>
                            <?php } ?>
                            <?php if ($etatsuivi == 1) { ?>
                                <input type="radio" id="etat" name="etat" value="1/En cours" checked>
                                <label for="etat">En cours</label>
                            <?php } ?>

                            <?php if ($etatsuivi == 2) { ?>
                                <input type="radio" id="etat" name="etat" value="2/Terminé" checked>
                                <label for="etat">Terminé</label> <br>
                            <?php } ?>
                            <?php if ($etatsuivi == 3) { ?>
                                <input type="radio" id="etat" name="etat" value="3/Livrée" checked>
                                <label for="etat">Livrée</label>
                            <?php } ?>
                            <?php if ($etatsuivi == 4) { ?>
                                <input type="radio" id="etat" name="etat" value="4/Annulée" checked>
                                <label for="etat">Annulée</label>
                            <?php } ?>
                            <?php if ($etatsuivi == 5) { ?>
                                <input type="radio" id="etat" name="etat" value="5/Archivée" checked>
                                <label for="etat">Archivée</label>
                            <?php } ?>
                        </fieldset>
                    </div>

                    <script>
                        var vari1 = <?php echo json_encode($etatsuivi); ?>
                        //console.log(vari);
                        var elts1 = document.querySelectorAll('#etat');
                        //       console.log(elts);checked
                        elts1[vari1].checked = true;
                        console.log(elts1[vari1]);
                    </script>

                    <!-- <label>Etat</label>
                <input type="text" class="form-control" value="< ?= $commande['etat'] ?>"readonly> -->


                </div>
                <!-- <p>Etat (En attente,En cours,Livré,Archivé):< ?= $commande['etat'] ?></p> -->
                <?php $pai = $commande['paiement'];

                $pai = explode("/", $pai);
                //print_r ($commande['etat']);
                $pai = $pai[0];
                ?>

                <div class="form-group">
                    <div class="radio">
                        <fieldset>
                            <legend>Paiement <?= $commande['paiement'] ?></legend>
                            <?php if ($pai == 0) { ?>
                                <input type="radio" id="paiement" name="paiement" value="0/Non payée" checked>
                                <label for="paiement">Non payée</label>
                            <?php } ?>
                            <?php if ($pai == 1) { ?>
                                <input type="radio" id="paiement" name="paiement" value="1/Payé" checked>
                                <label for="paiement">Payée</label>
                            <?php } ?>
                            <?php if ($pai == 2) { ?>
                                <input type="radio" id="paiement" name="paiement" value="2/Avance" checked>
                                <label for="paiement">Avance</label>
                            <?php } ?>
                            <br>
                            <?php if ($pai == 3) { ?>
                                <input type="radio" id="paiement" name="paiement" value="3/A terme" checked>
                                <label for="paiement">A terme</label>
                            <?php } ?>

                        </fieldset>
                    </div>

                    <script>
                        var vari = <?php echo json_encode($pai); ?>;
                        // console.log(vari);
                        var elts = document.querySelectorAll('#paiement');
                        //      console.log(elts);
                        elts[vari].checked = true;
                        console.log(elts[vari]);
                    </script>

                    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

                    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                    <!-- <label>Paiement</label>
                <input type="text" class="form-control" value="< ?= $commande['paiement'] ?>"readonly> -->
                </div>
                <!-- <p>Paiement (A terme,A la livraison,Avance 50% +Solde à la livraison:< ?= $commande['paiement'] ?></p> -->

                <!-- <a class="btn btn-primary btn-block" href="indexcommande.php?page=<?= $page ?>&recherche=&niveau=">Retour</a>  -->
                <button class="btn btn-primary btn-block" onclick="history.back()">Retour</button>

                <!-- <a class="btn btn-primary" href="edit.php?id=< ?= $commande['id'] ?>">Modifier</a></p> -->
                <!-- <a href="./gestion4.php" class="btn btn-primary btn-block">Retourner à Home</a> -->
            </section>
        </div>
    </main>
    <br><br>
</body>

</html>