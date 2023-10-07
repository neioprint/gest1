<?php
require_once "const.php";

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['client']) && !empty($_POST['client'])
    ) {
        // On inclut la connexion à la base
        require_once('connectclient.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $client = strip_tags($_POST['client']);
        $client = str_replace( array( '%', '@', '\'', ';', '<', '>','.',',','-'), '', $client);
        $tel = strip_tags($_POST['tel']);
        $registre = strip_tags($_POST['registre']);
        $idfiscal = strip_tags($_POST['idfiscal']);
        $nis=strip_tags($_POST['nis']);
        $activite=strip_tags($_POST['activite']);
        $telsiege=strip_tags($_POST['telsiege']);
        $art = strip_tags($_POST['art']);
        $email = strip_tags($_POST['email']);
        $email=strtolower($email);
        $adresse = strip_tags($_POST['adresse']);
        $solde = strip_tags($_POST['solde']);
        
        $sql = 'UPDATE `client` SET `client`=:client,
        `tel`=:tel,`registre`=:registre,`idfiscal`=:idfiscal,
        `art`=:art,`email`=:email,`adresse`=:adresse,`solde`=:solde,`nis`=:nis,`activite`=:activite,`telsiege`=:telsiege WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':client', $client, PDO::PARAM_STR);
        $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        $query->bindValue(':solde', $solde, PDO::PARAM_STR);
        $query->bindValue(':registre', $registre, PDO::PARAM_STR);
        $query->bindValue(':idfiscal', $idfiscal, PDO::PARAM_STR);
        $query->bindValue(':nis', $nis, PDO::PARAM_STR);
        $query->bindValue(':activite', $activite, PDO::PARAM_STR);
        $query->bindValue(':telsiege', $telsiege, PDO::PARAM_STR);
        $query->bindValue(':art', $art, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);



        $query->execute();

        $_SESSION['message'] = "Client modifié";
        require_once('closeclient.php');

        header('Location: indexclient.php?page=1');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connectclient.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `client` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $client = $query->fetch();

    // On vérifie si le produit existe
    if (!$client) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: indexclient.php?page=1');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: indexclient.php?page=1');
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
                <h1>Modifier un client</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="client">Client</label>
                        <input type="text" id="client" name="client" class="form-control" value="<?= $client['client'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="tel">Telephone</label>
                        <input type="tel" id="tel" name="tel" class="form-control" value="<?= $client['tel'] ?>" pattern="[2][1][3]{1}[5-7]{1}[0-9]{1}[0-9]{7}">
                    </div>
                    <div class="form-group">
                        <label for="solde">Solde</label>
                        <input type="number" id="solde" name="solde" step="0.01" class="form-control" value="<?= $client['solde'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">e-mail</label>
                        <input type="email" name="email" value="<?= $client['email'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" value="<?= $client['adresse'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="registre">Registre de commerce</label>
                        <input type="text" name="registre" value="<?= $client['registre'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="idfiscal">Identifiant Fiscal</label>
                        <input type="text" name="idfiscal" value="<?= $client['idfiscal'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="nis">Nis</label>
                    <input type="text" name="nis" value="<?= $client['nis'] ?>" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="activite">Activité</label>
                    <input type="text" name="activite"value="<?= $client['activite'] ?>" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="telsiege">Tel siège</label>
                    <input type="text" name="telsiege" value="<?= $client['telsiege'] ?>" class="form-control" >
                </div>
                    <div class="form-group">
                        <label for="art">N° Article</label>
                        <input type="text" name="art" value="<?= $client['art'] ?>" class="form-control">
                    </div>

                    <input type="hidden" value="<?= $client['id'] ?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
                <br>
                <a class="btn btn-primary" href="indexclient.php?page=1">Retour</a>
            </section>

        </div>
    </main>
</body>

</html>