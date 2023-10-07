<?php
require_once "const.php";
if (!isset($typ)) $typ = "carnet";
else $typ = "";
require_once('connectmatiere.php');
$sql = 'SELECT * FROM `matiere`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif 
$resultmatiere = $query->fetchAll(PDO::FETCH_ASSOC);
require_once('closematiere.php');
if ($_POST) {
//print_r($_POST);
$typ = $_POST['typ'];
    if (
        isset($_POST['id']) && !empty($_POST['id']) &&
        isset($_POST['imprime']) && !empty($_POST['imprime']) 
        &&
        isset($_POST['idclient']) && !empty($_POST['idclient'])
        && isset($_POST['etapes']) && !empty($_POST['etapes'])
    ) {
        require_once('connect.php');
        $dates = strip_tags($_POST['dates']); // nom de l'imprime posté
        // On nettoie les données envoyées d'eventuelles balises html
        // $id = strip_tags($_POST['id']); // id de l'imprimé posté
        $imprime = strip_tags($_POST['imprime']); // nom de l'imprime posté
        $_SESSION['imprime'] = $imprime;
        $idclient = strip_tags($_POST['idclient']); // id  du client posté
        // print_r($idclient);
        $idclient = explode("/", $idclient);
        // print_r($idclient);
        // die();
        $impclient = explode("/", $idclient[1]);
        $impclient = $idclient[1];
        $idclient = $idclient[0];

        // print_r($idclient);
        $typ = $_POST['typ'] . ',' . implode(',', $_POST['typsuite']);
        //implode(',',$_POST['typ']);
        //if ($typ="carnet") $carnet=implode(',',$_POST['carnet']);
        $etapes = implode(',', $_POST['etapes']);
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $typ=@$result['typ'];
        // $chaine=$etapes;
        // $chainedecoupe=explode(",",$chaine);
        // // $typdecoupe=explode(",",$typ);
        // $compt=count($chainedecoupe);
        // // $compt0=count($typdecoupe);
      
        // $tabsuivi=[[]];
      
        // for ($i=0; $i <$compt ; $i++) { 
        //      $tabsuivi[$i][0]=0;
        //      $tabsuivi[$i][1]="";
        //      $tabsuivi[$i][2]="";

        // }       
        // print_r($typ);
        // echo "<br>";
        // print_r($etapes);
        // echo "<br>";
        // print_r($tabsuivi);
        //die();

        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
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
    
        // On nettoie les données envoyées

        $id = strip_tags($_POST['id']);
        // $imprime = strip_tags($_POST['imprime']);
        // $idclient = strip_tags($_POST['idclient']);
        // $impclient = explode("/", $idclient);
        // $idclient = $impclient[0];
        // $impclient = $impclient[1];//
       
        // $typ = $_POST['typ'] . ',' . implode(',', $_POST['typsuite']);
      
        // $_SESSION['imprime'] = $imprime;
         $idmat = 0;
      
        // $matiere = strip_tags($_POST['matiere']);
        // $grammage = 0;
       
        // $formatfinie = strip_tags($_POST['formatfinie']);   

        // $formattirage = 0;
       
        // $nbrepose = 0;
       
        // $unitedemesure = strip_tags($_POST['unitedemesure']);
        // $etapes =  $etapes = implode(',', $_POST['etapes']); 
        
        $sql = 'UPDATE `imprimes` SET `imprime`=:imprime, `idclient`=:idclient,
       `impclient`=:impclient, `typ`=:typ, `idmat`=:idmat, `matiere`=:matiere,  `grammage`=:grammage, `formatfinie`=:formatfinie, 
       `formattirage`=:formattirage, `nbrepose`=:nbrepose, `unitedemesure`=:unitedemesure,`etapes`=:etapes WHERE  `id`=:id;';
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
        $query->bindValue(':etapes', $etapes, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "imprimé modifié";
        require_once('close.php');

        header("Location: index0.php?recherche=&niveau=ins");
        // ici tous pour la  mise à jour de la base
    } else {
        if (empty($_POST['typ']))
            $_SESSION['erreur'] = "Le formulaire est incomplet";
    
    }
}else {
    $_SESSION['imprime'] = @$imprime;
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
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
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
<!-- $$$$$$$$$$$$$$$$$$ partie tratitement affichage modifiovation $$$$$$ -->
<form method="post" class="was-validated">
<input type="hidden" value="<?= $imprime['id'] ?>" name="id">
                    <?php $datevalue = date('Y-m-d') ?>


                    <input type="date" class="form-control" value="<?= $datevalue ?>" id="dates" name="dates">
                    <div class="form-group">
                        <label for="imprime">Imprime</label>
                        <input type="text" id="imprime" name="imprime" class="form-control" value="<?= $imprime['imprime'] ?>">
                    </div>
                    <!-- <div class="form-group">
                        <label for="imprime">Imprimé</label>
                        <input value="< ?= @$_POST['imprime'] ?>" type="text" id="imprime" name="imprime" maxlength="20" class="form-control"required>
                    </div> -->

                    <div class="form-group">

<label for="client">Client</label>
<br>

<!-- <select class="form-control" id="idclient" name="idclient" required> -->

    <?php
    // On boucle sur la variable result

    foreach ($resultclient as $client) {
    if ($client['id'] == $imprime['idclient']) { ?>
     <input value="<?php echo  $client['id'] . '/' . $client['client'] ?>" name="idclient" class="form-control" readonly>
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
                        <label>Description </label>
                        <select class="form-control" size="1" id="typ" name="typ" required onchange="this.form.submit()">


                            <!-- <option  value="0"> Selectionner un imprimé</option> -->
                            <option value="carnet" <?php if (@$typ == "carnet") echo "selected" ?>> Carnet</option>

                            <option value="ordonnance" <?php if (@$typ == "ordonnance") echo "selected" ?>> Ordonnance Médicale </option>
                            <option value="bloc" <?php if (@$typ == "bloc") echo "selected" ?>> Bloc</option>
                            <option value="feuille" <?php if (@$typ == "feuille") echo "selected" ?>> Feuille Volante</option>
                            <option value="fiche" <?php if (@$typ == "fiche") echo "selected" ?>> Fiche </option>
                            <option value="cartevisite" <?php if (@$typ == "cartevisite") echo "selected" ?>>Carte de visite</option>
                            <option value="etiquette" <?php if (@$typ == "etiquette") echo "selected" ?>> Etiquette </option>


                            <option value="pochette" <?php if (@$typ == "pochette") echo "selected" ?>>pochette</option>
                            <option value="enveloppe" <?php if (@$typ == "enveloppe") echo "selected" ?>>Enveloppe</option>
                            <option value="livret" <?php if (@$typ == "livret") echo "selected" ?>>Livret</option>
                            <option value="catalogue" <?php if (@$typ == "catalogue") echo "selected" ?>>Catalogue</option>
                            <option value="depliant" <?php if (@$typ == "depliant") echo "selected" ?>>depliant</option>
                            <option value="flayer" <?php if (@$typ == "flayer") echo "selected" ?>>Flayer</option>
                            <option value="calendrier" <?php if (@$typ == "calendrier") echo "selected" ?>>Calendrier</option>
                            <!-- <option value="mural" < ?php if ($typ=="mural") echo "selected" ?>>mural</option>
                    <option value="chevalet" < ?php if ($typ=="chevalet") echo "selected" ?>>Chevalet</option> -->
                            <option value="boite" <?php if (@$typ == "boite") echo "selected" ?>> Boite pliante</option>
                            <option value="banner" <?php if (@$typ == "banner") echo "selected" ?>> Banner </option>
                            <option value="conception" <?php if (@$typ == "conception") echo "selected" ?>> Conception maquette</option>
                            <option value="reproduction" <?php if (@$typ == "reproduction") echo "selected" ?>> Reproduction maquette </option>
                            <option value="autre" <?php if (@$typ == "autre") echo "selected" ?>> Autre ..... </option>
                        </select>



                        <br>
                        <select class="form-control" size="6" id="typsuite" name="typsuite[]" required multiple>
                            <?php if ($typ == "carnet" or $typ == "ordonnance" or $typ == "bloc") { ?>


                                <option value="25 liasses">De 25 liasses</option>
                                <option value="50 liasses">De 50 liasses</option>
                                <option value="100 feuilles">De 100 Feuilles</option>
                                <option value="5 feuilles">5 feuilles</option>
                                <option value="10 feuilles">10 feuilles</option>
                                <option value="1 souche">De 1 souche</option>
                                <option value="2 souche">De 2 souche</option>
                                <option value="3 souche">De 3 souche</option>
                                <option value="1 ex">1expl</option>
                                <option value="2 ex">2expl</option>
                                <option value="3 ex">3expl</option>
                                <option value="4 ex">4expl</option>
                                <option value="5 ex">5expl</option>



                                <option value="agraphe"> Agraphé</option>
                                <option value="perforé">Perforés</option>
                                <option value="numerote">Numerotés</option>
                                <option value="collé"> Collé</option>
                                <option value="1 coul">1 couleur</option>
                                <option value="2 coul">2 couleurs</option>
                                <option value="3 coul">3 couleurs</option>
                                <option value="4 coul">4 couleurs</option>
                                <?php } else {
                                if ($typ == "conception" or $typ == "creation") { ?>

                                    <option value="1 coul">1 couleur</option>
                                    <option value="2 coul">2 couleurs</option>
                                    <option value="3 coul">3 couleurs</option>
                                    <option value="4 coul">4 couleurs</option>
                                    <option value="pantone">Pantone</option>
                                    <option value="recto">Recto</option>
                                    <option value="verso">Verso</option>
                                <?php                                           } else { ?>
                                    <option value="1 coul">1 couleur</option>
                                    <option value="2 coul">2 couleurs</option>
                                    <option value="3 coul">3 couleurs</option>
                                    <option value="4 coul">4 couleurs</option>
                                    <option value="4 pages">4 pages</option>
                                    <option value="8 pages">8 pages</option>
                                    <option value="16 pages">16 pages</option>
                                    <option value="24 pages">24 pages</option>
                                    <option value="32 pages">32 pages</option>
                                    <option value="recto">Recto</option>
                                    <option value="verso">Verso</option>
                                    <option value="numeroté">Numerotés</option>
                                    <option value="perforé">Perforés</option>
                                    <option value="autocoll"> Autocollantes</option>
                                    <option value="decoupe"> Avec decoupe</option>
                                    <option value="cartonne"> Cartonnés</option>
                                    <option value="pelliculage brillant"> Pelliculé brillant</option>
                                    <option value="pelliculage matt"> Pelliculé Matt</option>
                                    <!-- <option value="bloc"> Bloc</option> -->

                                    <option value="rabat">à rabat</option>
                                    <option value="mural">mural</option>
                                    <option value="chevalet">Chevalet</option>
                                    <option value="sous main">sous-main</option>

                            <?php    }
                           
                            }
                            if ($typ == "enveloppe") { ?>


                                <option value="25 liasses">De 25 liasses</option>
                               
                                <?php } 
                            ?>
                            

                        </select>



                    </div>
                     <!-- <div class="form-group">

                        <label for="client">Sélectionner le client dans la liste</label>
                        <br>

                        <select class="form-control" id="idclient" name="idclient" required>
                            


                            <option value="" selected>veuillez selectionner</option>
                          
                            < ?php
                            // On boucle sur la variable result

                            foreach ($resultclient as $client) {
                                //   var_dump($client);
                            ?>
                                <option value="< ?php echo  $client['id'] . '/' . $client['client'] ?>">
                                    < ?php echo ($client['client']) ?></option>
                            < ?php
                            }
                            ?>
                        </select>

                      

                    </div>  -->

                    <div class="form-group">
                        <label>Etapes d'impression</label>
                        <select class="form-control" size="6" id="etapes" name="etapes[]" required multiple>

                            <option value="coupe initiale">coupe initiale</option>
                            <option value="impression">impression</option>
                            <option value="faconnage intermediaire">façonnage intermediare</option>
                            <option value="numerotage">Numerotage</option>
                            <option value="perforation">Perforation</option>
                            <option value="refoule ou plie">Refoule ou plie</option>
                            <option value="decoupe platine">Découpe platine</option>
                            <option value="decoupe cylindre">Découpe cylindre</option>
                            <option value="impression platine">Impression Platine</option>
                            <option value="coll">Collage</option>
                            <option value="decoupe balancier">Découpe Balancier</option>
                            <option value="intercallage">Intercallage</option>
                            <option value="agraphage">Agraphage</option>
                            <option value="pliage">pliage</option>
                            <option value="assemblage">Assemblage</option>
                            <option value="decorticage">Decorticage</option>
                            <option value="pliage collage">Pliage Collage</option>
                            <option value="peliculage">peliculage</option>
                            <option value="coupe finale">Coupe Finale</option>
                            <option value="prestation">Prestation</option>
                            <option value="conception" <?php if (@$typ == "conception") echo "selected" ?>> Conception maquette</option>
                            <option value="reproduction" <?php if (@$typ == "reproduction") echo "selected" ?>> Reproduction maquette </option>

                            <option value="autre">Autre...</option>
                        </select>

                      
                    </div>
                    <div class="form-group">

                        <label for="matiere">Sélectionner la matiere dans la liste</label>
                        <br>

                        <select class="form-control" id="matiere" name="matiere" required>
                         
                            <?php
                            // On boucle sur la variable result

                            foreach ($resultmatiere as $matiere) {
                                //   var_dump($client);
                            ?>
                                <option value="<?php echo  $matiere['idmat'] . '/' . $matiere['matiere'] ?>">
                                    <?php echo ('N°' . $matiere['idmat'] . '/' . $matiere['matiere'] . ' ' . $matiere['grammage'] . 'Grs') ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>

             
                    <!-- <div class="form-group">
                        <label name="formatfinie">Format Finie</label>
                        <input id="formatfinie" name="formatfinie" class="form-control"required>
                    </div> -->

                    <div class="form-group">
                            <label name="formatfinie">Format Finie</label>
                            <input value="<?= $imprime['formatfinie'] ?>" name="formatfinie" class="form-control" required>
                        </div>
              
                    <div class="form-group">
                        <label name="unitedemesure">Unité de mesure</label>
                        <select class="form-control" id="unitedemesure" name="unitedemesure" required>
                            <option value="cm">Cm</option>



                        </select>
                        <!-- <input  name="unitedemesure" class="form-control" > -->
                    </div>


                    <!-- ******************************************  -->

                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>             
              



<!-- $$$$$$$$$$$$$$$$$$ partie tratitement affichage modifiovation $$$$$$ -->

                <a class="btn btn-primary" href="index0.php?page=1">Retour</a>

            </section>

        </div>
    </main>
</body>

</html>