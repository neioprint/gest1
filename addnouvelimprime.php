<?php
require_once "const.php";

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

date_default_timezone_set("Africa/Algiers");
//define("ICONFONT","23px");
//define("FONTSIZE","30px");


ini_set("display_errors", 1);
error_reporting(-1);


// function getIp()
// {
//     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//         $ip = $_SERVER['HTTP_CLIENT_IP'];
//     } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     } else {
//         $ip = $_SERVER['REMOTE_ADDR'];
//     }
//     return $ip;
// }

if (!empty($_SESSION['erreur'])) {
    echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['erreur'] . '
        </div>';
    $_SESSION['erreur'] = "";
}
if (!empty($_SESSION['message'])) {
    echo '<div class="alert alert-success .alert-dismissible" role="alert">

    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['message'] . '
        </div>';
        
    $_SESSION['message'] = "";
}

// if (!isset($_SESSION['user'])) {
//     header('Location:login.php');
//     exit();
// }
//if (!isset($typ)) $typ="carnet"; else $typ="";
// require_once('connectmatiere.php');
// $sql = 'SELECT * FROM `matiere`';

// // On prépare la requête
// $query = $db->prepare($sql);

// // On exécute la requête
// $query->execute();

// // On stocke le résultat dans un tableau associatif 
// $resultmatiere = $query->fetchAll(PDO::FETCH_ASSOC);
// require_once('closematiere.php');
//print_r($resultmatiere);
//die();
$idclientt = isset($_GET['idclient']) ? $_GET['idclient'] : 0;
$nomclient = isset($_GET['nomclient']) ? $_GET['nomclient'] : "";
$quefaire=isset($_GET['quefaire']) ? $_GET['quefaire'] : "";
if ($_POST) {
    //    print_r($_POST);
    $typ = $_POST['typ'];

    //echo $typ;
    // die();
    if (
        isset($_POST['impclient']) && !empty($_POST['impclient'])
        // && isset($_POST['prix']) && !empty($_POST['prix'])
        && isset($_POST['idclient']) && !empty($_POST['idclient'])
         && isset($_POST['etapes']) && !empty($_POST['etapes'])
         && isset($_POST['formatfinie']) && !empty($_POST['formatfinie'])
         && isset($_POST['matiere']) && !empty($_POST['matiere'])
         && isset($_POST['grammage']) && !empty($_POST['grammage'])
    ) {




        // On inclut la connexion à la base
        require_once('connect.php');
        $dates = strip_tags($_POST['dates']); // nom de l'imprime posté
        // // On nettoie les données envoyées supprimer balise html et php htmlspecialchars est mieu adapté
        $imprime = strip_tags($_POST['impclient']);

        $idclient = $idclientt;
        //strip_tags($_POST['idclient']);

        $impclient = $nomclient;
        //explode("/",$idclient[1]);
        // print_r($impclient);
        // die();
        //$impclient=$idclient[1];
        $typ = "client direct/".$_POST['typ'];
        $etapes = implode("/",$_POST['etapes']);
        //implode(',',$_POST['etapes']);
        $matiere = $_POST['matiere'];
        $grammage = $_POST['grammage'];

        $unitedemesure=$_POST['unitedemesure'];
        $formatfinie =$_POST['formatfinie'];
        $formattirage = 0;
        //$_POST['formattirage'];
        $nbrepose = 0;
        //$_POST['nbrepose'];
        // $unitedemesure = "";
        //$_POST['unitedemesure'];
        $idmat = "";
        //$_POST['matiere'];
        // $sql = 'INSERT INTO `imprimes` (`dates`,`imprime`, `idclient`,`impclient`,`typ`) 
        //  VALUES (:dates,:imprime, :idclient,:impclient,:typ) ;';
        $sql = 'INSERT INTO `imprimes` (`dates`,`imprime`, `idclient`,`impclient`,`typ`,idmat,`matiere`,`grammage`,
 `formatfinie`,`formattirage`,`nbrepose`,`unitedemesure`,`etapes`) 
  VALUES (:dates,:imprime, :idclient,:impclient,:typ,:idmat,:matiere,:grammage,
 :formatfinie,:formattirage,:nbrepose,:unitedemesure,:etapes) ;';
        $query = $db->prepare($sql);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR); // attention au type d'argument numerique ou string
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

        //  $_SESSION['message'] = "Imprimé ajouté avec succée";

        // $query = $db->prepare($sql);


        //  $query->execute();
        $_SESSION['message'] = "Imprimé ajouté avec succée";
        $headers='Content-Type: text/plain; charset=utf-8' . "\r\n";
        $headers .= 'FROM:  contact@global2pub.com';
        $msg = "Mr $nomclient à ajouté un nouvel Imprimé le $dates $imprime $typ ";
        // $_SESSION['message'].=$msg;
    //    echo $msg;
       // attention encodage des éééé àààà  éééé pose pron sur l'envoi des mails
      $to="neioprint@gmail.com";
       $result=mail($to, "Nouvel Imprimé ajouté par $nomclient", $msg, $headers);
    //    echo $result;
        require_once('close.php');

        // die();
        header("Location: formclient.php?idclient=$idclient&nomclient=$nomclient&quefaire=$quefaire&imprime=$imprime");

        die();

        //header('Location: index0.php?page=1');
    } else {
        if (empty($_POST['typ']))
            $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
} else {
   // header("Location: formclient.php?idclient=$idclient&nomclient=$nomclient");
    //die();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Imprimé</title>
    <link rel="icon" href="./images/logo2.png" type="image" />
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
</head>

<body>
    <!-- < ?php require_once('./base4.php'); ?> -->
    <?php
    require_once('./navbarok.php') ?>
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
                <h1 class="entete">Veuillez ajouter votre imprimé</h1>
                <br>
                <form method="post" class="was-validated">
                <label for="dates">Date</label>
                    <?php $datevalue = date('Y-m-d') ?>


                    <input type="date" class="form-control" value="<?= $datevalue ?>" id="dates" name="dates" readonly>
                    <div class="form-group">
                    <div class="form-group">

                    <label for="client">Client</label>
                    <br>

                    <select class="form-control" id="idclient" name="idclient" required>
                        <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->


                        <option value="<?= $idclientt . '/' . $nomclient ?>" selected><?= $idclientt . '/' . $nomclient ?></option>
                        <!-- <option disabled value="">Sélectionnez votre le client</option>  -->

                    </select>

                    <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>
                        <label for="imprime">Nom de votre imprimé </label>
                        <input value="<?= @$_POST['impclient']; ?>" minlength="5" type="text" id="impclient" name="impclient" maxlength="20" class="form-control" required>
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
                   
                    <!-- <div class="form-group">
                    <label name="idmat">Id Matière</label>
                    <input  name="idmat" class="form-control" placeholder="okokok" disabled>
                    </div> -->


                    <div class="form-group">
                        <label>Type d'imprimé </label>
                        <select class="form-control" size="1" id="typ" name="typ" required>

                        <option value="" <?php if (@$typ == "") echo "selected" ?>>Selectionner une option</option>
                            <!-- <option  value="0"> Selectionner un imprimé</option> -->
                            <option value="carnet" <?php if (@$typ == "carnet") echo "selected" ?>> Carnet</option>
                           
                            <option value="ordonnance" <?php if (@$typ == "ordonnance") echo "selected" ?>> Ordonnance Médicale </option>
                            <!-- <option value="bloc" < ?php if (@$typ == "bloc") echo "selected" ?>> Bloc ordonnance</option> -->
                            <option value="feuille" <?php if (@$typ == "feuille") echo "selected" ?>> Feuille Volante</option>
                            <option value="fiche" <?php if (@$typ == "fiche") echo "selected" ?>> Fiche </option>
                            <option value="cartevisite" <?php if (@$typ == "cartevisite") echo "selected" ?>>Carte de visite</option>
                            <option value="etiquette" <?php if (@$typ == "etiquette") echo "selected" ?>> Etiquette </option>
                            <option value="affiche" <?php if (@$typ == "affiche") echo "selected" ?>> Affiche </option>
                            <option value="poster" <?php if (@$typ == "poster") echo "selected" ?>> Poster </option>
                            <option value="pochettearabat" <?php if (@$typ == "pochette") echo "selected" ?>>pochette à rabat</option>
                            <option value="chemise" <?php if (@$typ == "chemise") echo "selected" ?>>Chemise</option>
                            <option value="env" <?php if (@$typ == "env") echo "selected" ?>>Enveloppe</option>
                            <option value="livret" <?php if (@$typ == "livret") echo "selected" ?>>Livret</option>
                            <option value="catalogue" <?php if (@$typ == "catalogue") echo "selected" ?>>Catalogue</option>
                            <option value="depliant" <?php if (@$typ == "depliant") echo "selected" ?>>depliant</option>
                            <option value="flayer" <?php if (@$typ == "flayer") echo "selected" ?>>Flayer</option>
                            <option value="calendrier" <?php if (@$typ == "calendrier") echo "selected" ?>>Calendrier</option>
                            <!-- <option value="mural" < ?php if ($typ=="mural") echo "selected" ?>>mural</option>
                    <option value="chevalet" < ?php if ($typ=="chevalet") echo "selected" ?>>Chevalet</option> -->
                            <option value="boite" <?php if (@$typ == "boite") echo "selected" ?>> Boite pliante</option>
                            <option value="conception" <?php if (@$typ == "conception") echo "selected" ?>> Conception maquette</option>
                            <option value="reproduction" <?php if (@$typ == "reproduction") echo "selected" ?>> Reproduction maquette </option>
                            <option value="autre" <?php if (@$typ == "autre") echo "selected" ?>> Autre ..... </option>
                        </select>
                     
                        <!-- <select class="form-control" size="6" id="typsuite" name="typsuite[]" required multiple>
                 < ?php if ($typ=="carnet" or $typ=="ordonnance" or $typ=="bloc") { ?>
                   
                   
                    <option value="l25">De 25 liasses</option>
                    <option value="l50">De 50  liasses</option>
                    <option value="f100">De 100 Feuilles</option>
                    <option value="5f">5 feuilles</option>
                    <option value="10f">10 feuilles</option>
                    <option value="1s">De 1 souche</option>
                    <option value="2s">De 2 souche</option>
                    <option value="3s">De 3 souche</option>
                    <option value="1ex">1expl</option>
                    <option value="2ex">2expl</option>
                    <option value="3ex">3expl</option>
                    <option value="4ex">4expl</option>
                    <option value="5ex">5expl</option>
                  
                   
                   
                    <option  value="agraphe"> Agraphé</option>
                    <option value="perfore">Perforés</option>
                    <option value="numerote">Numerotés</option>
                    <option value="colle"> Collé</option>
                    <option value="1c">1 couleur</option>
                    <option value="2c">2 couleurs</option>
                    <option value="3c">3 couleurs</option>
                    <option value="4c">4 couleurs</option>
                     < ?php }
                            else { ?>
                                <option value="1c">1 couleur</option>
                                <option value="2c">2 couleurs</option>
                                <option value="3c">3 couleurs</option>
                                <option value="4c">4 couleurs</option>
                                <option value="recto">Recto</option>
                                <option value="verso">Verso</option>
                                <option value="num">Numerotés</option>
                                <option value="perf">Perforés</option>
                                <option value="autocoll"> Autocollantes</option>
                                <option value="autocolldecoupe"> Avec decoupe</option>
                                <option value="cartonne"> Cartonnés</option>
                                <option value="pelbr"> Pelliculé brillant</option>
                                <option value="pelmatt"> Pelliculé Matt</option>
                                 <option value="bloc"> Bloc</option> 
                              
                                <option value="rabat">à rabat</option>
                                <option value="mural">mural</option>
                                <option value="mural">Chevalet</option>
                                <option value="sm">sous-main</option>

                       < ?php     }
                      ?>
                    </select> -->



                    </div>

                    <div class="form-group">
                        <label name="matiere">Papier/carton/couché etc...</label>
                        <select class="form-control"  id="matiere" name="matiere" required>
                        <option value="">Selectionner une option</option>
                        <option  value="choix"> Choisissez pour moi suivant imprimé</option>
                        <option  value="extracouleur"> Extra blanc</option>
                        <option  value="extrablanc"> Extra Couleur</option>
                        <option  value="dossierblanc"> Dossier Blanc</option>
                        <option  value="dossiercouleur"> Dossier Couleur</option>
                        <option  value="cartonblancgris"> Carton Blanc Gris</option>
                        <option  value="cartonblancblanc">Carton Blanc/Blanc</option>
                        <option  value="bristolblanc"> Bristol Blanc</option>
                        <option  value="bristolcouleur"> Bristol Couleur</option>
                        <option  value="ncr"> Ncr Autocopiant</option>
                        <option  value="autocollant">Autocollant</option>
                        <option  value="couche2f">Couche 2face</option>
                        <option  value="couche1f">Couche 1face</option>
                        <option  value="reh">Reh</option>
                        <!-- <option  value="autre">Autre</option> -->


                        </select>
                        <!-- <input id="matiere" placeholder="exemple:extra blanc ou Carton ou dossier couleur " name="matiere" class="form-control" required> -->
                    </div>
                    <div class="form-group">
                        <label name="grammage">Grammage</label>
                        <select class="form-control"  id="grammage" name="grammage" required>
                        <option value="">Selectionner une option</option>
                        <!-- <option  value="nesaispas"> Je ne sais pas</option> -->
                        <option  value="choix"> Choisissez pour moi suivant imprimé</option>
                        <option  value="70"> gramm fin</option>
                        <option  value="150"> gramm moyen</option>
                        <option  value="300"> gramm gros</option>
                        <option  value="56"> 56grs seulemnt ncr</option>
                        <option  value="60"> 60grs seulement papier couleur</option>
                        <option  value="70"> 70grs</option>
                        <option  value="90"> 90grs</option>
                        <option  value="115"> 115grs</option>
                        <option  value="150"> 150grs</option>
                        <option  value="200"> 200grs</option>
                        <option  value="250"> 250grs</option>
                        <option  value="300"> 300grs</option>
                        <option  value="350"> 350grs</option>
                        <option  value="380"> 380grs</option>
                        <option  value="400"> 400grs</option>




                        <!-- <option  value="autre">Autre</option> -->
                        </select>
                        <!-- <input id="grammage" placeholder="Exemple:80 ou 300 etc..." name="grammage" class="form-control" required> -->
                    </div>

                    <div class="form-group">
                        <label name="formatfinie">Format en Cm</label>
                        <select class="form-control"  id="formatfinie" name="formatfinie" required>
                        <option value="">Selectionner une option</option>
                        <option  value="choix"> Choisissez pour moi suivant imprimé</option>
                        <option  value="A4">A4 soit 21x29.7cm</option>
                        <option  value="A5">A5 soit 21x14.85cm</option>
                        <option  value="A3">A3 soit 42x29.7cm</option>
                        <option  value="A3+">A3+ soit 45x32cm</option>
                        <option  value="13.5X21">13.5x21cm</option>
                        <option  value="21x27">21x27cm</option>
                        <option  value="autre">Autre</option>
                        </select>
                        <!-- <input id="formatfinie" placeholder="exemple 13.5x21 en cm" name="formatfinie" class="form-control" required> -->
                    </div>
                    <div class="form-group">
                        <label name="etapes">Details
                        </label>
                        <select class="form-control"  id="etapes" name="etapes[]" required multiple>
                        <!-- <option value="">Selectionner une option</option> -->
                        <option  value="choix"> Choisissez pour moi suivant imprimé</option>
                        <option value="1 coul">1 couleur</option>
                        <option value="2 coul">2 couleurs</option>
                        <option value="3 coul">3 couleurs</option>
                        <option value="4 coul">4 couleurs</option>
                        <option value="pantone">Pantone Preparée</option>
                        <option value="recto">Recto</option>
                        <option value="rectoverso">Recto/Verso</option>
                        </select>
                        <!-- <input id="etapes" placeholder="Detail de votre imprimé " name="etapes" class="form-control" required> -->
                    </div>
                    <div class="form-group">
                        <label name="unitedemesure">Unité de mesure</label>
                        <select class="form-control" id="unitedemesure" name="unitedemesure" required>
                            <option value="cm">Cm</option>



                        </select>
                        <!-- <input  name="unitedemesure" class="form-control" > -->
                    </div>

        </div>



        </div>







        </div>


        <!-- ******************************************  -->

       
     
       
      
                                <br>
        <button type="submit" class="btn btn-success">Valider l'Imprimé</button>
        <a class="btn btn-primary" href="formclient.php?idclient=<?= $idclientt ?>&nomclient=<?= $nomclient ?>&quefaire=<?=$quefaire?>">Retour sans valider</a>
        <a class="btn btn-primary btn-danger" href="./quitter.php">Quitter</a>
        </form>
        </div>
        </section>
    </main>
    <br><br>
</body>

</html>