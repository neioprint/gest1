<?php

require_once "const.php";



//require_once('role.php');
if ($_POST) {
    //    print_r($_POST);
    if (isset($_POST['dates']) && !empty($_POST['dates']))
    // && isset($_POST['prix']) && !empty($_POST['prix'])

    {


        // On inclut la connexion à la base
        require_once('connectcommande.php');

        // On nettoie les données envoyées
        $dates = strip_tags($_POST['dates']);
        $idclient = strip_tags($_POST['idclient']);
        $nomclient = strip_tags($_POST['nomclient']);
        $idimprime = strip_tags($_POST['idimprime']);
        $imprime = strip_tags($_POST['imprime']);
        $quantite = strip_tags($_POST['quantite']);
        $prix = strip_tags($_POST['prix']);
        $prepress = strip_tags($_POST['prepress']);
        $total = strip_tags($_POST['total']);
        $remarque = strip_tags($_POST['remarque']);
        $etat = strip_tags($_POST['etat']);
        $paiement = strip_tags($_POST['paiement']);

        $sql = 'INSERT INTO `commande` 
        (`dates`, `idclient`, `nomclient`, `idimprime`, `imprime`, `quantite`, `prix`, `prepress`, `total`, `remarque`, `etat`, `paiement`) 
        VALUES (:dates,:idclient,:nomclient,:idimprime,:imprime,:quantite,:prix,:prepress,:total,:remarque,:etat,:paiement);';
        $query = $db->prepare($sql);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
        $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);
        $query->bindValue(':idimprime', $idimprime, PDO::PARAM_INT);
        $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
        $query->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':prepress', $prepress, PDO::PARAM_INT);
        $query->bindValue(':total', $total, PDO::PARAM_INT);
        $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
        $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);
        $query->execute();
        //    print_r($query);
        $_SESSION['message'] = "Commande ajouté";
        //    die;
        require_once('closecommande.php');

        header('Location: indexcommande.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<link rel="icon" href="./images/logo.avif" type="image" />
<html lang="fr">

<head>
    <?php
    require_once('./head.php');
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
                <h1>Ajouter une commande</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="dates">Date</label>
                        <input type="text" id="dates" name="dates" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="idclient">Id Client</label>
                        <input type="number" id="idclient" name="idclient" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nomclient">Nom Client</label>
                        <input type="text" id="nomclient" name="nomclient" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="idimprime">ID Imprime</label>
                        <input type="number" id="idimprime" name="idimprime" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="imprime">Imprime</label>
                        <input type="text" id="imprime" name="imprime" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="number" id="prix" name="prix" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="prepress">PrePress</label>
                        <input type="number" id="prepress" name="prepress" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total">total</label>
                        <input type="number" id="total" name="total" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="remarque">Remarque</label>
                        <input type="text" id="remarque" name="remarque" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="etat">Etat</label>
                        <input type="text" id="etat" name="etat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paiement">Paiement</label>
                        <input type="text" id="paiement" name="paiement" class="form-control">
                    </div>


                    <button class="btn btn-primary">Envoyer</button>
                </form>
                <br>
                <a class="btn btn-primary" href="indexcommande.php">Retour</a>
            </section>


        </div>
    </main>
</body>

</html>