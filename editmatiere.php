<?php
require_once "const.php";

//$id=$matiere[$i]['idmat']

if ($_POST) {
    if (
        isset($_POST['idmat']) && !empty($_POST['idmat']) &&
        isset($_POST['dates']) && !empty($_POST['dates']) &&
        isset($_POST['matiere']) && !empty($_POST['matiere']) &&
        isset($_POST['formatxxyy']) && !empty($_POST['formatxxyy'])


    ) {
        require_once('connectmatiere.php');

        // On nettoie les données envoyées

        $idmat = strip_tags($_POST['idmat']);
        $dates = strip_tags($_POST['dates']);
        $matiere = strip_tags($_POST['matiere']);
        $formatxxyy = strip_tags($_POST['formatxxyy']);
        $ptf = strip_tags($_POST['ptf']);
        $qtecalculee = strip_tags($_POST['qtecalculee']);
        $grammage = strip_tags($_POST['grammage']);
        $couleur = strip_tags($_POST['couleur']);
        $qte = strip_tags($_POST['qte']);

        $descriptionmat = strip_tags($_POST['descriptionmat']);
        $prix = strip_tags($_POST['prix']);
        $mesure = strip_tags($_POST['mesure']);

        $total = strip_tags($_POST['total']);
        // ici tous pour la  mise à jour de la base
        $sql = 'UPDATE `matiere` SET `dates`=:dates,`matiere`=:matiere
       ,`formatxxyy`=:formatxxyy,`ptf`=:ptf,`qtecalculee`=:qtecalculee
       ,`grammage`=:grammage,`couleur`=:couleur,`qte`=:qte,`descriptionmat`=:descriptionmat
       ,`prix`=:prix,`mesure`=:mesure,`total`=:total 
       WHERE  `idmat`=:idmat;';
        $query = $db->prepare($sql);

        $query->bindValue(':idmat', $idmat, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':matiere', $matiere, PDO::PARAM_STR);
        $query->bindValue(':formatxxyy', $formatxxyy, PDO::PARAM_STR);
        $query->bindValue(':ptf', $ptf, PDO::PARAM_INT);
        $query->bindValue(':qtecalculee', $qtecalculee, PDO::PARAM_INT);
        $query->bindValue(':grammage', $grammage, PDO::PARAM_INT);

        $query->bindValue(':couleur', $couleur, PDO::PARAM_STR);
        $query->bindValue(':qte', $qte, PDO::PARAM_INT);
        $query->bindValue(':descriptionmat', $descriptionmat, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':mesure', $mesure, PDO::PARAM_STR);
        $query->bindValue(':total', $total, PDO::PARAM_INT);
        $query->execute();

        $_SESSION['message'] = "Matiere modifié";
        require_once('close.php');

        header("Location: matiere.php?recherche=&niveau=d");
        // ici tous pour la  mise à jour de la base
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
//$idmat=$_GET['id'];
// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require('connectmatiere.php');


    // On nettoie l'id envoyé
    $idmat = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `matiere` WHERE `idmat` = :idmat;';
    //  $sql = 'UPDATE `imprimes` WHERE `id`=:id;';
    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':idmat', $idmat, PDO::PARAM_INT);
    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $matiere = $query->fetch();

    // On vérifie si le produit existe
    if (!$matiere) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: matiere.php?recherche=&niveau=d');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    //   header('Location: matiere.php?page=1');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un imprimé</title>
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
</head>

<body>
    <?php require_once('./navbarok.php') ?>
    <?php require_once('./base4.php'); ?>
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
                <h1 class="entete">Modifier Matière</h1>
                <form method="post">

                    <div class="form-group">
                        <label for="idmat">ID</label>
                        <input type="text" id="idmat" class="form-control" value="<?= $matiere['idmat'] ?>" name="idmat" readonly>
                        <label for="dates">Date</label>
                        <input type="date" id="dates" name="dates" class="form-control" value="<?= $matiere['dates'] ?>" required>
                    </div>
                    <!-- <div class="form-group">
                                            <label for="imprime">Id Imprime</label>
                                            <input type="text" id="id" name="imprime" class="form-control" value="< ?= $imprime['id'] ?>">
                                        </div> -->
                    <div class="form-group">
                        <label for="matiere">Matiere</label>
                        <input type="text" id="matiere" name="matiere" class="form-control" value="<?= $matiere['matiere'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="formatxxyy">Format xxyy</label>
                        <input type="text" id="formatxxyy" name="formatxxyy" class="form-control" value="<?= $matiere['formatxxyy'] ?>" pattern="[0-9,',','.']{2,3,4}[x,X]{1}[0-9,',','.']{2,3,4}" required>
                    </div>

                    <div class="form-group">
                        <label for="ptf">Poids feuille en Kg</label>
                        <input type="number" id="ptf" name="ptf" class="form-control" value="<?= $matiere['ptf'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="qtecalculee">qte Calculée en feuille</label>
                        <input type="text" id="qtecalculee" name="qtecalculee" class="form-control" value="<?= $matiere['qtecalculee'] . " F" ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="grammage">Grammage</label>
                        <input type="text" id="grammage" name="grammage" class="form-control" value="<?= $matiere['grammage'] . "gr /m2" ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="couleur">Couleur</label>
                        <input type="text" id="couleur" name="couleur" class="form-control" value="<?= $matiere['couleur'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="qte">qte</label>
                        <input type="text" id="qte" name="qte" class="form-control" value="<?= $matiere['qte'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="descriptionmat">Description</label>
                        <input type="text" id="descriptionmat" name="descriptionmat" class="form-control" value="<?= $matiere['descriptionmat'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" value="<?= $matiere['prix'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="mesure">Mesure</label>
                        <input type="text" id="mesure" name="mesure" class="form-control" value="<?= $matiere['mesure'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" id="total" name="total" class="form-control" value="<?= $matiere['total'] ?>" required>
                    </div>





                    <input type="submit" value="Valider" class="btn btn-primary" />
                    <!-- <button class="btn btn-primary">Envoyer</button> -->
                </form>
                <br>
                <a class="btn btn-primary" href="matiere.php?page=1">Retour</a>

            </section>

        </div>
    </main>
</body>

</html>