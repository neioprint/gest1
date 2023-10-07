<?php
require_once "const.php";

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id']) &&
        isset($_POST['imprime']) && !empty($_POST['imprime']) 
        &&
        isset($_POST['idclient']) && !empty($_POST['idclient'])
    ) {
        require_once('connect.php');

        // On nettoie les données envoyées

        $id = strip_tags($_POST['id']);
        $imprime = strip_tags($_POST['imprime']);
        $idclient = strip_tags($_POST['idclient']);
        $impclient = explode("/", $idclient);
        $idclient = $impclient[0];
        $impclient = $impclient[1];
        //$idclient=$impclient[0];
        // echo $impclient;
        // echo $idclient;
        // die();
        //strip_tags($_POST['impclient']);
        $typ = strip_tags($_POST['typ']);

        $idmat = 0;
        //= strip_tags($_POST['idmat']);
        $matiere = strip_tags($_POST['matiere']);
        $grammage = 0;
        //strip_tags($_POST['grammage']);
        // $total= strip_tags($_POST['total']);
        $formatfinie = strip_tags($_POST['formatfinie']);   

        $formattirage = 0;
        //strip_tags($_POST['formattirage']);
        $nbrepose = 0;
        //strip_tags($_POST['nbrepose']);
        //$etat=$commande['etat'];
        $unitedemesure = strip_tags($_POST['unitedemesure']);
        // ici tous pour la  mise à jour de la base
        $sql = 'UPDATE `imprimes` SET `imprime`=:imprime, `idclient`=:idclient,
       `impclient`=:impclient, `typ`=:typ, `idmat`=:idmat, `matiere`=:matiere,  `grammage`=:grammage, `formatfinie`=:formatfinie, 
       `formattirage`=:formattirage, `nbrepose`=:nbrepose, `unitedemesure`=:unitedemesure WHERE  `id`=:id;';
        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
        $query->bindValue(':idclient', $idclient, PDO::PARAM_STR);
        $query->bindValue(':typ', $typ, PDO::PARAM_STR);
        $query->bindValue(':impclient', $impclient, PDO::PARAM_STR);
        $query->bindValue(':idmat', $idmat, PDO::PARAM_STR);
        $query->bindValue(':matiere', $matiere, PDO::PARAM_STR);
        $query->bindValue(':grammage', $grammage, PDO::PARAM_STR);
        $query->bindValue(':formatfinie', $formatfinie, PDO::PARAM_STR);
        $query->bindValue(':formattirage', $formattirage, PDO::PARAM_STR);
        $query->bindValue(':nbrepose', $nbrepose, PDO::PARAM_STR);
        $query->bindValue(':unitedemesure', $unitedemesure, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "imprimé modifié";
        require_once('close.php');

        header("Location: index0.php?recherche=&niveau=ins");
        // ici tous pour la  mise à jour de la base
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');


    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `imprimes` WHERE `id` = :id;';
    //  $sql = 'UPDATE `imprimes` WHERE `id`=:id;';
    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $imprime = $query->fetch();

    // On vérifie si le produit existe
    if (!$imprime) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index0.php?page=1');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index0.php?page=1');
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
                <h1 class="entete">Modifier un Imprimé</h1>
                <form method="post">
                    <input type="hidden" value="<?= $imprime['id'] ?>" name="id">
                    <!-- <div class="form-group">
                                            <label for="imprime">Id Imprime</label>
                                            <input type="text" id="id" name="imprime" class="form-control" value="<?= $imprime['id'] ?>">
                                        </div> -->
                    <div class="form-group">
                        <label for="imprime">Imprime</label>
                        <input type="text" id="imprime" name="imprime" class="form-control" value="<?= $imprime['imprime'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Id client </label>
                        <input type="number" class="form-control" value="<?= $imprime['idclient'] ?>" readonly>
                    </div>


                    <!-- ******************************************  -->
                    <div class="form-group">

                        <label for="client">Client</label>
                        <br>

                        <!-- <select class="form-control" id="idclient" name="idclient" required> -->

                            <?php
                            // On boucle sur la variable result

                            foreach ($resultclient as $client) {
                            if ($client['id'] == $imprime['idclient']) { ?>
                             <input value="<?php echo $client['client'] ?>" class="form-control" readonly>
                                <!-- <option value="< ?php echo $client['id'] . '/' . $client['client'] ?>"> -->
                                                                                                        
                                                                                                        
                                    <!-- < ?php echo $client['id'] . '/' . $client['client'] ?> -->
                                <!-- </option> -->
                            <?php }} ?>

                            <!-- foreach ($resultclient as $client) { ?>
                                <option value="< ?php echo $client['id'] . '/' . $client['client'] ?>" < ?php if ($client['id'] == $imprime['idclient'])
                                                                                                            echo 'selected'
                                                                                                        ?> >
                                    < ?php echo $client['id'] . '/' . $client['client'] ?>
                                </option>
                            < ?php } ?> -->
                        <!-- </select> -->

                            </div>
                        <div class="form-group">
                            <label>Type d'imprimé</label>
                            <input value="<?= $imprime['typ'] ?>" name="typ" class="form-control">
                        </div>

                        <div class="form-group">
                            <label name="type">Matière</label>
                            <input value="<?= $imprime['matiere'] ?>" name="matiere" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                    <label name="grammage">Grammage</label>
                    <input value="<?= $imprime['grammage'] ?>" name="grammage" class="form-control" >
                </div> -->
                        <div class="form-group">
                            <label name="formatfinie">Format Finie</label>
                            <input value="<?= $imprime['formatfinie'] ?>" name="formatfinie" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                    <label name="formattirage">Format Tirage</label>
                    <input value="< ?= $imprime['formattirage'] ?>" name="formattirage" class="form-control" >
                </div>  -->
                        <!-- <div class="form-group">
                    <label name="nbrepose">Nombre de poses</label>
                    <input value="< ?= $imprime['nbrepose'] ?>" name="nbrepose" class="form-control" >
                </div>  -->
                        <div class="form-group">
                            <label name="unitedemesure">Unité de mesure</label>
                            <input value="<?= $imprime['unitedemesure'] ?>" name="unitedemesure" class="form-control">
                        </div>


                    </div>
                    <!-- ******************************************  -->


                    <input type="submit" value="Valider" class="btn btn-primary" />
                    <!-- <button class="btn btn-primary">Envoyer</button> -->
                </form>
                <br>
                <a class="btn btn-primary" href="index0.php?page=1">Retour</a>

            </section>

        </div>
    </main>
</body>

</html>