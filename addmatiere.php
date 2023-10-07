<?php
// On démarre une session
require_once "const.php";

if ($_POST) {
    if (
        isset($_POST['matiere']) && !empty($_POST['matiere'])
        && (isset($_POST['dates']) && !empty($_POST['dates']))
    ) {
        // print_r($_POST);



        $dates = strip_tags($_POST['dates']);
        $matiere = strip_tags($_POST['matiere']);
        // $divers = strip_tags($_POST['divers']);
        //  $periodicite = strip_tags($_POST['periodicite']);
        $formatxxyy = strip_tags($_POST['formatxxyy']);
        $formatxxyy = strtoupper($formatxxyy);
        $format = explode("X", $formatxxyy);
        $formatxx = $format[0];
        $formatyy = $format[1];

        $ptf = $formatxx * $formatyy * $_POST['grammage'] / 10000000;
        //          print_r($formatxxyy);
        //          echo "<br>";
        // print_r($ptf);
        //         print_r($formatxx);
        //         print_r($formatyy);
        //         //  print_r($formatyy);
        //  die();
        //$ptf=1200;
        $grammage = strip_tags($_POST['grammage']);

        $couleur = strip_tags($_POST['couleur']);
        $qte = strip_tags($_POST['qte']);


        $qtecalculee = 0;
        $descriptionmat = strip_tags($_POST['descriptionmat']);
        $prix = strip_tags($_POST['prix']);
        $mesure = strip_tags($_POST['mesure']);
        $total = strip_tags($_POST['prix'] * $_POST['qte']);
        if ($mesure === "kg")
            $qtecalculee = ceil(@$qte / @$ptf) - 1;
        else $qtecalculee = $qte;
        // print_r($ptf);
        //  die();
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

        $sql = 'INSERT INTO 
  `matiere` 
  (`dates`,`matiere`,`formatxxyy`,`ptf`,`grammage`,`couleur`,`qte`,`qtecalculee`,`descriptionmat`,`prix`,`mesure`,`total`) 
  VALUES 
  (:dates,:matiere,:formatxxyy,:ptf,:grammage,:couleur,:qte,:qtecalculee,:descriptionmat,:prix,:mesure,:total);';

        $query = $db->prepare($sql);

        // $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':matiere', $matiere, PDO::PARAM_STR);
        $query->bindValue(':formatxxyy', $formatxxyy, PDO::PARAM_STR);
        $query->bindValue(':ptf', $ptf, PDO::PARAM_STR);

        $query->bindValue(':grammage', $grammage, PDO::PARAM_INT);
        $query->bindValue(':couleur', $couleur, PDO::PARAM_STR);
        $query->bindValue(':qte', $qte, PDO::PARAM_STR);
        $query->bindValue(':qtecalculee', $qtecalculee, PDO::PARAM_STR);

        $query->bindValue(':descriptionmat', $descriptionmat, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':mesure', $mesure, PDO::PARAM_STR);
        $query->bindValue(':total', $total, PDO::PARAM_STR);






        $query->execute();

        $_SESSION['message'] = "Matiere  Ajouté";
        require_once('closeclient.php');

        header('Location: matiere.php');
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
    <title>liste de mat</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
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
                <h1 class="entete">Ajouter une matiere Premiere</h1>
                <form method="post" class="was-validated">
                    <div class="form-group">
                        <label for="client">Date</label>
                        <?php $datevalue = date('Y-m-d') ?>
                        <input type="date" id="dates" value=<?= $datevalue ?> name="dates" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="matiere">matiere</label>
                        <input type="text" id="matiere" name="matiere" class="form-control" required>


                    </div>
                    <div class="form-group">
                        <label for="formatxxyy">Format</label>
                        <!-- [2][1][3]{1}[5-7]{1}[0-9]{1}[0-9]{7} -->
                        <input type="text" name="formatxxyy" id="formatxxyy" pattern="[0-9,',','.']{2,3,4}[x,X]{1}[0-9,',','.']{2,3,4}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="grammage">Grammage</label>
                        <input type="number" name="grammage" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="couleur">Couleur</label>
                        <input type="text" name="couleur" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="qte">Quantité</label>
                        <input type="number" name="qte" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descriptionmat">Description</label>
                        <input type="text" name="descriptionmat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" name="prix" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mesure">Unite de Mesure</label>
                        <!-- <input type="text" name="mesure"  class="form-control"> -->

                        <select class="form-control" size="1" id="mesure" name="mesure" required>
                            <option value="Feuilles">Feuilles</option>
                            <option value="kg">Kg</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <!-- <label for="total">Total</label> -->
                        <input type="hidden" name="total" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <label for="periodicite">Grammage</label>
                        <select name="periodicite" id="periodicite" class="form-control">
                        <option value="jour">Quantité</option>
                        <option value="semaine">Semaine</option>
                        <option value="mois">Mois</option>
                        <option value="ponctuelle">Ponctuelle</option>

                        </select> -->
                    <!-- <input type="text" name="periodicite"  class="form-control"> -->
                    <!-- </div> -->
                    <!-- <div class="form-group">
                        <label for="montant">Montant</label>
                        <input type="text" name="montant"  class="form-control">
                        </div> -->



                    <!-- <input type="hidden" value="< ?= $client['id']?>" name="id"> -->
                    <!-- <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">

                    </div> -->
                    <!-- <div class="form-group">
                        <label for="qteMin">Qte Min</label>
                        <input type="number" id="qteMin" name="qteMin" class="form-control">
                    </div> -->
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
                <br>
                <a class="btn btn-success" href="matiere.php">Annuler</a>
            </section>


        </div>
    </main>
</body>

</html>