<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
error_reporting(-1);
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
ini_set("display_errors", 1);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//$page=intval($page);
// Est-ce que l'id existe et n'est pas vide dans l'URL
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
    if (!$id) {
        $_SESSION['erreur'] = 'id pas existant';
        header("Location: indexcommande.php?page=$page&recherche=ins");
    }
} else {
    $_SESSION['erreur'] = 'URL invalide';
    header("Location: indexcommande.php?page=$page&recherche=&niveau=ins");
}

if (@$_POST['submit']) {
    // 6/Proforma +DIRECT+Le 2023-09-20 par sid
    if (
        isset($_POST['id']) && !empty($_POST['id']) &&
        // isset($_POST["dates"]) && !empty($_POST["dates"]) &&
        // isset($_POST["idclient"]) && !empty($_POST["idclient"]) &&
        // isset($_POST["quantite"]) && !empty($_POST["quantite"]) &&
        // isset($_POST["prix"]) &&

        // isset($_POST["remarque"]) && !empty($_POST["remarque"]) &&
        isset($_POST["etat"]) && !empty($_POST["etat"]) &&
        isset($_POST["paiement"]) && !empty($_POST["paiement"])
        // && isset($_POST["prepress"])
        //&& !empty($_POST["prepress"]) remarque 0 est considere comme non empty(vide)
    ) {
        // On inclut la connexion à la base
        require_once('connectcommande.php');

        // On nettoie les données envoyées

        $id = strip_tags($_POST['id']);

        $dates = strip_tags($_POST['dates']);
        // $idclient = strip_tags($_POST['idclient']);
        // $nomclient = strip_tags($_POST['nomclient']);
        // $idimprime = strip_tags($_POST['idimprime']);
        // $imprime = strip_tags($_POST['imprime']);
        // $quantite = strip_tags($_POST['quantite']);
        // $prix = strip_tags($_POST['prix']);
        // $prepress = strip_tags($_POST['prepress']);
        // // $total= strip_tags($_POST['total']);
        // $total = strip_tags($prix * $quantite + $prepress);

        $remarque = strip_tags($_POST['remarque']);
        //$etat= $_POST["etat"]." Le ".$dates." par ".$_SESSION['login'];
        // print_r($commande['etat']);
        // echo "<br>";
         $etatsuivi = $commande['etat'];

        $etatsuivi = explode("+", $etatsuivi);
        // print_r($etatsuivi);
        // echo "<br>";
        //$etatsuivi="";
        //print_r ($commande['etat']);
        if (@$etatsuivi[1]=="DIRECT") $etatsuivi = " +".$etatsuivi[1]."+ ";
      
       
   

        $etat = strip_tags($_POST['etat'].@$etatsuivi . " Le " . $dates . " par " . $_SESSION['login']);
        // print_r($etat);
        // die();
        //$etat=$commande['etat'];
        $paiement = strip_tags($_POST['paiement']);
        $etatseq = "";
        // $sql = 'UPDATE `commande` SET `client`=:client WHERE `id`=:id;';
        $sql = 'UPDATE `commande` SET 
        `dates`=:dates,`etat`=:etat,`etatseq`=:etatseq, `paiement`=:paiement WHERE  `id`=:id;';
        // $sql = 'UPDATE `imprimes` SET `imprime`=:imprime, `qteMin`=:qteMin WHERE `id`=:id;';
        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        // $query->bindValue(':idclient', $idclient, PDO::PARAM_STR);
        // $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);
        // $query->bindValue(':idimprime', $idimprime, PDO::PARAM_STR);
        // $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
        // $query->bindValue(':quantite', $quantite, PDO::PARAM_STR);
        // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        // $query->bindValue(':prepress', $prepress, PDO::PARAM_STR);
        // $query->bindValue(':total', $total, PDO::PARAM_STR);
        // $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
        $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        $query->bindValue(':etatseq', $etatseq, PDO::PARAM_STR);
        $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);

     
        $query->execute();

        $_SESSION['message'] = 'Etat Commande modifié';
        require_once('closecommande.php');

        header("Location: indexcommande.php?page=$page&recherche=&niveau=ins");
    } else {
        $_SESSION['erreur'] = 'Le formulaire est incomplet';
    }
}


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
                <h1 class="entete">Modifier Etat commande</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="id">Id Commande</label>
                        <input type="number" name="id" class="form-control" value="<?= $commande['id'] ?>" name="id" readonly>
                    </div>
                    <?php
                    if ($_SESSION['user']['role'] == 'ADMIN') {
                    ?>

                        <div class="form-group">

                            <label for="dates">Date</label>
                            <input type="date" id="dates" name="dates" class="form-control" value="<?= $commande['dates'] ?>" readonly>


                        <?php } else { ?>
                            <label for="dates">Date</label>
                            <input type="text" id="dates" name="dates" class="form-control" value="<?= $commande['dates'] ?>" rendonly>

                        <?php }

                        ?>

                        <div class="form-group">
                            <label for="idclient">Id Client</label>
                            <input type="number" id="idclient" name="idclient" class="form-control" value="<?= $commande['idclient'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nomclient">Nom Client</label>
                            <input type="text" id="nomclient" name="nomclient" class="form-control" value="<?= $commande['nomclient'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="idimprime">ID Imprime</label>
                            <input type="number" id="idimprime" name="idimprime" class="form-control" value="<?= $commande['idimprime'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="imprime">Imprime</label>
                            <input type="text" id="imprime" name="imprime" class="form-control" value="<?= $commande['imprime'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" min="0" id="quantite" name="quantite" class="form-control" value="<?= $commande['quantite'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <input type="number" min="0" step="0.01" id="prix" name="prix" class="form-control" value="<?= $commande['prix'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="prepress">PrePress</label>
                            <input type="number" min="0" id="prepress" name="prepress" class="form-control" value="<?= $commande['prepress'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total">total</label>
                            <input type="number" min="0" id="total" name="total" class="form-control" value="<?= $commande['total'] ?>" readonly>
                        </div>




                        <div class="form-group">
                            <label for="remarque">Remarque</label>
                            <input type="text" id="remarque" name="remarque" class="form-control" value="<?= $commande['remarque'] ?>" readonly>
                        </div>

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <div class="form-group">


                            <fieldset>
                                <legend>Etat Commande <?= $commande['etat'] ?></legend>
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
                        </div>
                        <?php $etatsuivi = $commande['etat'];

                        $etatsuivi = explode("/", $etatsuivi);
                        //print_r ($commande['etat']);
                        $etatsuivi = $etatsuivi[0];
                        ?>
                        <script>
                            var vari = <?php echo json_encode($etatsuivi); ?>;
                            // console.log(vari);
                            var elts = document.querySelectorAll('#etat');
                            //console.log(elts);
                            elts[vari].checked = true;
                        </script>

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- <div class="form-group">
                        <label for="etat">Etat</label>
                        <input type="text" id="etat" name="etat" class="form-control" value="< ?= $commande['etat']?>"  >
                    </div> -->
                        <!-- <div class="form-group">
                        <label for="paiement">Paiement</label>
                        <input type="text" id="paiement" name="paiement" class="form-control" value="< ?= $commande['paiement']?>"  >
                    </div> -->
                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

                        <div class="form-group">
                            <fieldset>
                                <legend>Paiement <?= $commande['paiement'] ?></legend>
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
                        </div>
                        <?php $pai = $commande['paiement'];

                        $pai = explode("/", $pai);
                        //print_r ($commande['etat']);
                        $pai = $pai[0];
                        ?>
                        <script>
                            var vari = <?php echo json_encode($pai); ?>;
                            // console.log(vari);
                            var elts = document.querySelectorAll('#paiement');
                            //console.log(elts);
                            elts[vari].checked = true;
                        </script>

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
</body>

</html>