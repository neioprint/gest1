<?php
require_once "const.php";

require_once('connectmatiere.php');
$sql = 'SELECT * FROM `matiere`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif 
$resultmatiere = $query->fetchAll(PDO::FETCH_ASSOC);
require_once('closematiere.php');
//print_r($resultmatiere);
//die();
if ($_POST) {
    if (
        isset($_POST['imprime']) && !empty($_POST['imprime'])
        // && isset($_POST['prix']) && !empty($_POST['prix'])
        && isset($_POST['idclient']) && !empty($_POST['idclient'])
    ) {




        // On inclut la connexion à la base
        // require_once('connect.php');

        // // On nettoie les données envoyées supprimer balise html et php htmlspecialchars est mieu adapté
        // $imprime = strip_tags($_POST['imprime']);
        // // $prix = strip_tags($_POST['prix']);
        // $idclient = strip_tags($_POST['idclient']);

        $sql = 'INSERT INTO `imprimes` (`imprime`, `idclient`,`impclient`,`typ`,idmat,`matiere`,`grammage`,
        `formatfinie`,`formattirage`,`nbrepose`,`unitedemesure`,`etapes`) 
         VALUES (:imprime, :idclient,:impclient,:typ,:idmat,:matiere,:grammage,
        :formatfinie,:formattirage,:nbrepose,:unitedemesure,:etapes) ;';

        // $query = $db->prepare($sql);

        // $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
        // // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        // $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

        // $query->execute();

        // $_SESSION['message'] = "Imprimé ajouté";
        // require_once('close.php');

        // header('Location: ./index0.php?page=1');

        require_once('connect.php');

        // On nettoie les données envoyées d'eventuelles balises html
        // $id = strip_tags($_POST['id']); // id de l'imprimé posté
        $imprime = strip_tags($_POST['imprime']); // nom de l'imprime posté

        $idclient = strip_tags($_POST['idclient']); // id  du client posté
        // print_r($idclient);
        $idclient = explode("/", $idclient);
        // print_r($idclient);
        // die();
        $impclient = explode("/", $idclient[1]);
        $impclient = $idclient[1];
        $idclient = $idclient[0];

        // print_r($idclient);
        $typ = implode(',', $_POST['typ']);
        $etapes = implode(',', $_POST['etapes']);
        $matiere = $_POST['matiere'];
        $grammage = 0;
        //$_POST['grammage'];


        $formatfinie = $_POST['formatfinie'];
        $formattirage = 0;
        //$_POST['formattirage'];
        $nbrepose = 0;
        //$_POST['nbrepose'];
        $unitedemesure = $_POST['unitedemesure'];
        $idmat = $_POST['matiere'];
        // echo $idclient;
        // echo $impclient;
        // die();
        //$impclient=explode("/",$idclient);
        //$impclient = strip_tags($_POST['impclient']); // nom du nouveau client posté
        // $sql = 'UPDATE `imprimes` SET `imprime`=:imprime, `idclient`=:idclient,
        //                                     `impclient`=:impclient,
        //                                     `typ`=:typ,`matiere`=:matiere,`grammage`=:grammage,
        //                                     `formatfinie`=:formatfinie,
        //                                     `formattirage`=:formattirage,
        //                                     `nbrepose`=:nbrepose,
        //                                     `unitedemesure`=:unitedemesure
        //                                     WHERE `id`=:id;';

        $query = $db->prepare($sql);

        // $query->bindValue(':id', $id, PDO::PARAM_INT);// attention au type d'argument numerique ou string
        $query->bindValue(':imprime', $imprime, PDO::PARAM_STR); // attention au type d'argument numerique ou string
        $query->bindValue(':idclient', $idclient, PDO::PARAM_INT); // attention au type d'argument numerique ou string
        $query->bindValue(':impclient', $impclient, PDO::PARAM_STR); // attention au type d'argument numerique ou string
        $query->bindValue(':typ', $typ, PDO::PARAM_STR); // attention au type d'argument numerique ou string
        $query->bindValue(':etapes', $etapes, PDO::PARAM_STR); // attention au type d'argument numerique ou string
        $query->bindValue(':matiere', $matiere, PDO::PARAM_STR); // attention au type d'argument numerique ou string
        $query->bindValue(':idmat', $idmat, PDO::PARAM_INT); // attention au type d'argument numerique ou string
        $query->bindValue(':grammage', $grammage, PDO::PARAM_INT); // attention au type d'argument numerique ou string
        $query->bindValue(':formatfinie', $formatfinie, PDO::PARAM_STR); // attention au type d'argument numerique ou string
        $query->bindValue(':formattirage', $formattirage, PDO::PARAM_STR); // attention au type d'argument numerique ou string
        $query->bindValue(':nbrepose', $nbrepose, PDO::PARAM_INT); // attention au type d'argument numerique ou string
        $query->bindValue(':unitedemesure', $unitedemesure, PDO::PARAM_STR); // attention au type d'argument numerique ou string

        $query->execute();
        $_SESSION['message'] = "Imprimé ajouté";
        require_once('close.php');





        header('Location: index0.php?page=1');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Imprimé</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
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
                <h1 class="entete">Ajouter un imprimé</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="imprime">Imprimé</label>
                        <input type="text" id="imprime" name="imprime" maxlength="20" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">

                    </div> -->
                    <!-- <div class="form-group">
                        <label for="qteMin">Id client</label>
                        <input type="number" id="idclient" name="idclient" class="form-control">
                    </div> -->
                    <!-- ******************************************  -->
                    <div class="form-group">

                        <label for="client">Sélectionner le client dans la liste</label>
                        <br>

                        <select class="form-control" id="idclient" name="idclient" required>
                            <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->


                            <!-- <option value=" " selected>veuillez selectionner</option> -->
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
                            // On boucle sur la variable result

                            foreach ($resultclient as $client) {
                                //   var_dump($client);
                            ?>
                                <option value="<?php echo  $client['id'] . '/' . $client['client'] ?>">
                                    <?php echo ($client['client']) ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>
                    <!-- <div class="form-group">
                    <label name="idmat">Id Matière</label>
                    <input  name="idmat" class="form-control" placeholder="okokok" disabled>
                    </div> -->


                    <div class="form-group">
                        <label>Description imprimé </label>
                        <select class="form-control" size="6" id="typ" name="typ[]" required multiple>
                            <optgroup label="Administratif">

                                <option value="carnet"> Carnet</option>
                                <option value="agraphe"> Agraphé</option>
                                <option value="perfore">Perforés</option>
                                <option value="numerote">Numerotés</option>
                                <option value="1ex">1expl</option>
                                <option value="2ex">2expl</option>
                                <option value="3ex">3expl</option>
                                <option value="4ex">4expl</option>
                                <option value="5ex">5expl</option>
                                <option value="l25">De 25 liasses</option>
                                <option value="l50">De 50 liasses</option>
                                <option value="f100">De 100 Feuilles</option>
                                <option value="1s">De 1 souche</option>
                                <option value="2s">De 2 souche</option>
                                <option value="3s">De 3 souche</option>
                                <option value="carnet"> Fiche</option>
                                <option value="ordonnace"> Ordonnance Médicale </option>
                                <option value="cartevisite">Carte de visite</option>
                                <option value="bloc"> Bloc</option>
                                <option value="colle"> Collé</option>

                            <optgroup label="Etiquetage">
                                <option value="etiquette"> Etiquette </option>
                                <option value="autocoll"> Autocollantes</option>
                                <option value="cartonne"> Cartonnés</option>
                                <option value="boitepliante"> Boite pliante</option>


                            <optgroup label="Publicitaire">
                                <option value="pochette">pochette</option>
                                <option value="rabat">à rabat</option>

                                <option value="depliant">depliant</option>
                                <option value="flayer">Flayer</option>
                                <option value="calendrier">Calendrier</option>
                                <option value="mural">mural</option>
                                <option value="mural">Chevalet</option>
                                <option value="sm">sous-main</option>
                            <optgroup label="couleurs/Descriptif">
                                <option value="1c">1 couleur</option>
                                <option value="2c">2 couleur</option>
                                <option value="3c">3 couleur</option>
                                <option value="4c">Quadri</option>
                                <option value="recto">Recto</option>
                                <option value="rectoverso">Recto/verso</option>

                                <option value="soustraitance">Soustraitance</option>

                                <!-- <option value="autre">Autre...</option> -->

                                <!-- <option  value="carnet"> Carnet perforés</option>
                    <option value="carnum"> Carnet perforés numerotés</option>
                    <option value="bloc"> Bloc collés</option>
                    <option value="etiquette"> Etiquette </option>
                    <option value="etiquetteautocoll"> Etiquette Autocollantes</option>
                    
                    <option value="ordonnace"> Ordonnance Médicale </option>
                    <option value="catevisite">Carte de visite</option>
                    <option value="catevisiterv">Carte de visite recto/verso</option>

                    <option value="boitepliante"> Boite pliante</option>
                    <option value="pochettesimple">pochette simple</option>
                    <option value="pochettearabat">pochette à rabat</option>
                  
                    <option value="depliant">depliant</option>
                    <option value="flayer">Flayer</option>
                    <option value="calendrier">Calendrier Affiche</option>
                    <option value="calendriersm">Calendrier sous-main</option>
                   
                    <option value="soustraitance">Soustraitance</option>
                   
                    <option value="autre">Autre...</option> -->
                        </select>

                        <!-- <input  name="typ" class="form-control" > -->
                    </div>
                    <div class="form-group">
                        <label>Etapes d'impression</label>
                        <select class="form-control" size="6" id="etapes" name="etapes[]" required multiple>

                            <option value="coupeinit">coupe initiale</option>
                            <option value="impression">impression</option>
                            <option value="faconnageinter">façonnage intermediare</option>
                            <option value="numperf">Numerotage ou et perforation</option>
                            <option value="decoupep">Découpe/refoule platine</option>
                            <option value="decoupec">Découpe/plis cylindre</option>
                            <!-- <option value="decoupec">Refoule</option> -->
                            <option value="decoupeb">Découpe Balancier</option>
                            <option value="intercallage">Intercallage</option>
                            <option value="agraphage">Agraphage</option>
                            <option value="pliage">pliage</option>
                            <option value="assemblage">Assemblage livret</option>
                            <option value="decorticage">Decorticage</option>
                            <option value="pliagecollage">Pliage Collage</option>
                            <option value="peliculage">peliculage</option>
                            <option value="coupefin">Coupe Finale</option>
                            <option value="prestation">Prestation</option>


                            <option value="autre">Autre...</option>
                        </select>

                        <!-- <input  name="typ" class="form-control" > -->
                    </div>
                    <div class="form-group">

                        <label for="matiere">Sélectionner la matiere dans la liste</label>
                        <br>

                        <select class="form-control" id="matiere" name="matiere" required>
                            <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->


                            <!-- <option value=" " selected>veuillez selectionner</option> -->
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
                            // On boucle sur la variable result

                            foreach ($resultmatiere as $matiere) {
                                //   var_dump($client);
                            ?>
                                <option value="<?php echo  $matiere['idmat'] . '/' . $matiere['matiere'] ?>">
                                    <?php echo ('N°' . $matiere['idmat'] . '/' . $matiere['matiere'] . '/' . $matiere['grammage'] . 'grs') ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>

                    <!-- <div class="form-group">
                    <label name="type">Matière</label>
                    <input  name="matiere" class="form-control" disabled>
                </div> -->
                    <!-- <div class="form-group">
                    <label name="grammage">Grammage</label>
                    <input  name="grammage" class="form-control" >
                </div> -->
                    <div class="form-group">
                        <label name="formatfinie">Format Finie</label>
                        <input name="formatfinie" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                    <label name="formattirage">Format Tirage</label>
                    <input  name="formattirage" class="form-control" >
                </div> -->
                    <!-- <div class="form-group">
                    <label name="nbrepose">Nombre de poses</label>
                    <input  name="nbrepose" class="form-control" >
                </div> -->
                    <div class="form-group">
                        <label name="unitedemesure">Unité de mesure</label>
                        <select class="form-control" id="unitedemesure" name="unitedemesure" required>
                            <option value="cm">Cm</option>



                        </select>
                        <!-- <input  name="unitedemesure" class="form-control" > -->
                    </div>


                    <!-- ******************************************  -->

                    <button class="btn btn-primary">Valider</button>
                </form>
                <br>
                <a class="btn btn-primary" href="index0.php?page=1">Retour</a>
            </section>


        </div>
    </main>
</body>

</html>