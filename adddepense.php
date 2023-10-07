<?php

require_once "const.php";

// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }

if ($_POST) {
    if (
        isset($_POST['designation']) && !empty($_POST['designation'])
        && (isset($_POST['dates']) && !empty($_POST['dates']))
    ) {


        $dates = strip_tags($_POST['dates']);
        $designation = strip_tags($_POST['designation']);
        $divers = strip_tags($_POST['divers']);
        $periodicite = strip_tags($_POST['periodicite']);
        $montant = strip_tags($_POST['montant']);

        require_once('serveur.php');
        try {
            // Connexion à la base
            if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
            if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
            if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
            if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

            $db->exec('SET NAMES "UTF8"');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }

        $sql = 'INSERT INTO `depense` (`dates`,`designation`,`divers`,`periodicite`,`montant`) 
  VALUES (:dates,:designation,:divers,:periodicite,:montant);';

        $query = $db->prepare($sql);

        // $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':designation', $designation, PDO::PARAM_STR);

        $query->bindValue(':divers', $divers, PDO::PARAM_STR);
        $query->bindValue(':periodicite', $periodicite, PDO::PARAM_STR);
        $query->bindValue(':montant', $montant, PDO::PARAM_INT);




        $query->execute();

        $_SESSION['message'] = "Depense  Ajouté";
        require_once('closeclient.php');

        header('Location: depense.php?niveau1=d');
        // On nettoie les données envoyées
        // $client = strip_tags($_POST['client']);
        // $tel = strip_tags($_POST['tel']);
        // // $prix = strip_tags($_POST['prix']);
        // // $qteMin = strip_tags($_POST['qteMin']);

        // $sql = 'INSERT INTO `client` (`client`, `tel`) VALUES (:client,:tel);';

        // $query = $db->prepare($sql);

        // $query->bindValue(':client', $client, PDO::PARAM_STR);
        // $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        // // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        // // $query->bindValue(':qteMin', $qteMin, PDO::PARAM_INT);

        // $query->execute();

        // $_SESSION['message'] = "Client ajouté";
        // require_once('closeclient.php');

        // header('Location: indexclient.php?page=1');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste de depenses</title>
    <link rel="icon" href="./images/logo.png" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
</head>

<body>
    <?php require_once('./navbarok.php') ?>
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
                <h1 class="entete">Ajouter une depense</h1>
                <form method="post" class="was-validated">
                    <div class="form-group">
                        <label for="client">Date</label>
                        <?php $datevalue = date('Y-m-d') ?>
                        <input type="date" id="dates" value=<?= $datevalue ?> name="dates" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <select class="form-control" id="designation" name="designation" size="1" required>
                            <option value="" selected>selectionner une option</option>
                            <option value="salaire nacer">salaire nacer</option>
                            <option value="salaire infographe">salaire inforgraphe</option>
                            <option value="salaire affsetiste">salaire Offsetiste</option>
                            <option value="salaire houarie">salaire houarie</option>
                            <option value="salaire apprenti">salaire apprenti2</option>
                            <option value="forme decoupe">forme decoupe</option>
                            <option value="plaque kord">plaque kord</option>
                            <option value="film falshé">film flashé</option>
                            <option value="encre">encre quadri</option>
                            <option value="ence pantone">Encre Pantone</option>
                            <option value="Frais de transport">Frais de transport</option>
                            <option value="peliculage">Peliculage</option>
                            <option value="electricite">Electricite</option>
                            <option value="Eau">Eau</option>
                            <option value="autre">Autre</option>



                        </select>
                        <!-- <input type="text" id="designation" name="designation" class="form-control" > -->


                    </div>
                    <div class="form-group">
                        <label for="divers">details</label>
                        <input type="text" name="divers" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="periodicite">Periodicité</label>
                        <select name="periodicite" id="periodicite" class="form-control"required>
                        <option value="" selected>selectionner une option</option>
                            <option value="jour">Journaliere</option>
                            <option value="semaine">Hebdomadaire</option>
                            <option value="mois">Mensuelle</option>
                            <option value="bi-mestre">Bi-mestrielle</option>
                            <option value="trimestre">Triestrielle</option>
                            <option value="annuel">Annuelle</option>
                            <option value="ponctuelle">Ponctuelle</option>

                        </select>
                        <!-- <input type="text" name="periodicite"  class="form-control"> -->
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant</label>
                        <input type="text" name="montant" class="form-control" required>
                    </div>



                    <!-- <input type="hidden" value="< ?= $client['id']?>" name="id"> -->
                    <!-- <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">

                    </div> -->
                    <!-- <div class="form-group">
                        <label for="qteMin">Qte Min</label>
                        <input type="number" id="qteMin" name="qteMin" class="form-control">
                    </div> -->
                    <br>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
                <br>
                <a class="btn btn-success" href="depense.php?niveau1=d">Annuler</a>
            </section>


        </div>
    </main>
</body>

</html>