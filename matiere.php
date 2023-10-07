<?php
require_once "const.php";
if (!empty($_SESSION['message'])) {
    
    echo '<div class="alert alert-success .alert-dismissible" role="alert">

    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['message'] . '
        </div>';
        
  
        $messageJson=json_encode($_SESSION['message']);
?>
 <script>
 let message=JSON.parse('<?php echo $messageJson; ?>');
 travail(message)
 </script> 
<?php
 $_SESSION['message'] = "";
  
}

if (!empty($_SESSION['erreur'])) {
    echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['erreur'] . '
        </div>';
  
        $messageJson=json_encode($_SESSION['erreur']);?>
<script>
    let message=JSON.parse('<?php echo $messageJson; ?>');
            probtravail(message)
            </script>`; 
<?php
    $_SESSION['erreur'] = "";

}
//$datecom=date('d-m-Y');
// **************************************************************
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
$dat = isset($_GET['dates']) ? $_GET['dates'] : "";
$dat2 = isset($_GET['dates2']) ? $_GET['dates2'] : "";

$niveau1 = isset($_GET['niveau1']) ? $_GET['niveau1'] : "d";
if ($dat == "") {
    $dat = date('Y') . '-' . date('m') . '-' . '01';
    // $dat2=date('Y').'-'.date('m').'-'.date('t');
    //$dat2=strtotime(time, now);
}
if ($dat2 == "") {
    // $dat=date('Y').'-'.date('m').'-'.'01'; t =le nombre de jours de ce mois
    $dat2 = date('Y') . '-' . date('m') . '-' . date('d');
    //$dat2=strtotime(time, now);
}
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$_SESSION['valider'] = "non";

// On inclut la connexion à la base
// require_once('connectcommande.php');
//require_once('connectversement.php');
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






if ($niveau1 == "d") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(matiere,1,20) as matiere
                    from matiere where  dates>='$dat' and dates<='$dat2' and
                    matiere like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(matiere,1,20) as matiere
                    from matiere where  dates>='$dat' and 
                    matiere like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(matiere,1,20) as matiere
                from matiere  where dates<='$dat2' and 
                matiere like  '%$recherche%'  order by dates";
    else $sql = "select *,SUBSTRING(matiere,1,20) as matiere
        from matiere where matiere like  '%$recherche%'  order by dates";
}
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$matiere = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($matiere);
// echo "</pre>";
// echo gettype($matiere[2]['qte']);
// echo gettype($matiere[0]['prix']);
// echo ($matiere[2]['qte']*1.0);
// echo ($matiere[0]['prix'])*1.0;
// die();
// require_once('closecommande.php');
//require_once('closedesignation.php');
$db = null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($matiere);
$nbr_element_page = 500000;
$nbr_de_pages = ceil($compteur / $nbr_element_page);
$debut = ($page - 1) * $nbr_element_page;
// partie countage du nombre de champs ds commande Fin







// **************************************************************

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste de matieres</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
</head>

<body class="container">
    <?php require_once('./navbarok.php') ?>
    <br>
    <h1 class="entete">Liste de matieres</h1>
    <br>

    <div class="panel panel-success">

        <div class="panel-heading">Recherche de matieres</div>
        <div class="panel-body">

            <form method="get" action="" class="form-inline">

                <div class="form-group">
                    <select name="niveau1" class="form-control" id="niveau1" onchange="this.form.submit()">
                        <option value="d" <?php if ($niveau1 === "d")   echo "selected" ?>>Recherche par date</option>

                        <!-- <option value="t" < ?php if ($niveau === "t")   echo "selected" ?>>Recherche Par clients</option> -->
                        <!-- <option value="m" < ?php if ($niveau === "m")   echo "selected" ?>>Recherche par Montant</option> -->

                    </select>
                    <!-- < ?php if ($niveau == "t") { ?>
                        <input type="text" name="recherche" placeholder="rechercher" value="< ?php echo @$recherche ?>" />
                    < ?php } ?> -->
                    <?php if ($niveau1 == "d") { ?>
                        <br>
                        <input type="text" name="recherche" placeholder="rechercher" value="<?php echo @$recherche ?>" />

                        <input type="date" name="dates" value="<?php echo @$dat ?>" onchange="this.form.submit()" />
                        <input type="date" name="dates2" value="<?php echo @$dat2 ?>" onchange="this.form.submit()" />
                    <?php } ?>

                    <!-- < ?php if ($niveau == "m") { ?>
                        <input type="number" name="recherche" placeholder="rechercher" value="< ?php echo @$recherche ?>" />
                        <input type="date" name="dates" value="< ?php echo @$dat ?>" onchange="this.form.submit()"/>
                        <input type="date" name="dates2" value="< ?php echo @$dat2 ?>" onchange="this.form.submit()"/>
                        < ?php } ?> -->
                </div>
                <!-- onchange="this.form.submit()" -->
                <!-- <label for="niveau">Type de recherche</label> -->

                <br>
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                    Chercher.....
                </button>
                <a href="./addmatiere.php" class="btn btn-primary">Ajouter Matière</a>

            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table tab table-striped table-responsive">
            <thead class="table tab">

                <th>
                    <input id="seltous" name='seltous' type="checkbox" value='seltous' onclick="myfunction()">
                    <span class="fa fa-arrow-down"></span>
                    Tous

                </th>

                <th class="table-primary">ID</th>

                <th class="table-primary">Date</th>
                <th class="table-primary">matiere</th>
                <th>Gr</th>
                <th class="table-primary">Format</th>
                <th class="table-primary">P/feuille</th>
                <th class="table-primary">Nb/feuilles</th>

                <th>Couleur</th>
                <th>Quantite</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Total</th>
                <th>Action</th>

                <!-- <th class="table-primary">Actions</th> -->
            </thead>
            <tbody>
                <?php
                $total = 0;
                $jours = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
                // On boucle sur la variable result
                // foreach($resultclient as $client){
                // for($i=$debut;$i<=$nbr_de_pages+$debut+1 ; $i++)
                for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {

                    if (@$matiere[$i] == null) break;
                    $time = $matiere[$i]['dates'];

                    $numJour = date('w', strtotime($time));
                    $jour = $jours[$numJour];
                ?>
                    <td class="table-primary">
                        <input id="sel" name='sel[]' type="checkbox" value=<?= @$matiere[$i]['idmat'] ?> <?php if (isset($sel) && (@in_array($matiere[$i]['idmat'], $sel))) echo "checked" ?>>
                    </td>

                    <td class="table-primary"><?= @$matiere[$i]['idmat'] ?></td>

                    <td class="table-primary"><?= $jour . ' ' . @$matiere[$i]['dates'] ?></td>
                    <td class="table-primary"><?= @$matiere[$i]['matiere'] ?></td>
                    <td class="table-primary"><?= @$matiere[$i]['grammage'] ?></td>
                    <td class="table-primary"><?= @$matiere[$i]['formatxxyy'] ?></td>
                    <td class="table-primary"><?= @$matiere[$i]['ptf'] . "kg" ?></td>
                    <td class="table-primary"><?= @$matiere[$i]['qtecalculee'] . "Feuilles" ?>
                        <!-- < ?php  
                    if ($matiere[$i]['mesure']==="kg") 
                            $matiere[$i]['qtecalculee']=ceil(@$matiere[$i]['qte']/@$matiere[$i]['ptf'])-1; 
                            else $matiere[$i]['qtecalculee']=$matiere[$i]['qte'];
                    echo $matiere[$i]['qtecalculee'];
                    ?> -->
                    </td>

                    <td class="table-primary"><?= @$matiere[$i]['couleur'] ?></td>
                    <td class="table-primary"><?= @$matiere[$i]['qte'] . $matiere[$i]['mesure'] ?></td>

                    <td class="table-primary"><?= @$matiere[$i]['descriptionmat'] ?></td>
                    <td class="table-primary"><?= @$matiere[$i]['prix'] ?></td>
                    <?php $matiere[$i]['total'] = $matiere[$i]['prix'] * $matiere[$i]['qte']; ?>
                    <td class="table-primary"><?= number_format(@$matiere[$i]['total'], 2, ",", ".") ?></td>
                    <td class="table-primary">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-primary" href="consultermatiere.php?id=<?= $matiere[$i]['idmat'] ?>">Consulter</a>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <a class="btn btn-success" href="editmatiere.php?id=<?= $matiere[$i]['idmat'] ?>">Modifier</a>
                                <a class="btn btn-danger " href="deletemat.php?id=<?= $matiere[$i]['idmat'] ?>">Supprimer</a>
                        </div>
                    </td>
                <?php


                            } ?>
                <!-- <td class="table-primary">< ?= @$matiere[$i]['mesure'] ?></td> -->








                <!-- <td class="table-primary">< ?= number_format(@$matiere[$i]['montant'], 2, ",", ".") ?></td> -->




                <td>





                    </tr>

                <?php
                    $total += @$matiere[$i]['total'];
                }
                ?>
                <td class="table-danger"></td>
                <td class="table-danger"></td>
                <td class="table-primary"></td>
                <td class="table-danger"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-danger"></td>
                <td class="table-primary"></td>

                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary">Total en DZ</td>
                <td class="table-success"><?= number_format($total, 2, ",", ".") ?></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>

            </tbody>
        </table>
    </div>
    <!-- <button class="btn btn-success">
        <span class="glyphicon glyphicon-search"></span>
        Emettre reçu
    </button> -->
    <script>
        function myfunction() {
            var sel = document.querySelectorAll('#sel');
            //console.log(sel.length);
            var elt = document.querySelector('#seltous');
            if (elt.checked) {
                //console.log("cochée");
                for (let i = 0; i < sel.length; i++) {
                    sel[i].checked = true;

                }

            } else {
                //console.log("non cochée");
                for (let i = 0; i < sel.length; i++) {
                    sel[i].checked = false;

                }
            }
        }
    </script>
</body>

</html>