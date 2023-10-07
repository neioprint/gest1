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
// $recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
// $dat = isset($_GET['dates']) ? $_GET['dates'] : "";
// $dat2 = isset($_GET['dates2']) ? $_GET['dates2'] : "";

// $niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "d";
// if ($dat=="") {
//     $dat=date('Y').'-'.date('m').'-'.'01';
//    // $dat2=date('Y').'-'.date('m').'-'.date('t');
//     //$dat2=strtotime(time, now);
// }
// if ($dat2=="") {
//    // $dat=date('Y').'-'.date('m').'-'.'01'; t =le nombre de jours de ce mois
//     $dat2=date('Y').'-'.date('m').'-'.date('d');
//     //$dat2=strtotime(time, now);
// }
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
if (isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $_SESSION['recherche'] = $_GET['recherche'];
} else $recherche = $_SESSION['recherche'];
//echo $recherche;echo "<br>";
//$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "q";
//echo $_SESSION['niveau'];
if (isset($_GET['niveau1'])) {
    $niveau1 = $_GET['niveau1'];
    $_SESSION['niveau1'] = $_GET['niveau1'];
} else $niveau1 = $_SESSION['niveau1'];
//echo $niveau;echo "<br>";
if (isset($_GET['dates'])) {
    $dat = $_GET['dates'];
    $_SESSION['dates'] = $_GET['dates'];
} else $dat = $_SESSION['dates'];

if ($dat == "") {
    $dat = date('Y') . '-' . date('m') . '-' . '01';
}
//echo $dat;echo "<br>";


if (isset($_GET['dates2'])) {
    $dat2 = $_GET['dates2'];
    $_SESSION['dates2'] = $_GET['dates2'];
} else $dat2 = $_SESSION['dates2'];

if ($dat2 == "") {
    //$dat2=date('Y').'-'.date('m').'-'.'01';
    $dat2 = date('Y') . '-' . date('m') . '-' . date('d');
}
$_SESSION['valider'] = "non";

// On inclut la connexion à la base
// require_once('connectcommande.php');
//require_once('connectversement.php');
require_once('serveur.php');
try {
    // Connexion à la base
    if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
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
        $sql = "select *,SUBSTRING(designation,1,20) as designation
                    from depense where  dates>='$dat' and dates<='$dat2' and
                    designation like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(designation,1,20) as designation
                    from depense where  dates>='$dat' and 
                    designation like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(designation,1,20) as designation
                from depense  where dates<='$dat2' and 
                designation like  '%$recherche%'  order by dates";
    else $sql = "select *,SUBSTRING(designation,1,20) as designation
        from depense where designation like  '%$recherche%'  order by dates";
}

// if ($niveau == "m") {
//     if (!empty($dat) and !empty($dat2)) {
//         $sql = "select *,SUBSTRING(designation,1,20) as designation
//                     from depense where  dates>='$dat' and dates<='$dat2' and
//                     depense like  '%$recherche%' order by dates";
//                 }
//         elseif (!empty($dat))
//         $sql = "select *,SUBSTRING(designation,1,20) as designation
//                     from depense where  dates>='$dat' and 
//                     depense like  '%$recherche%'  order by dates";
//         elseif (!empty($dat2))
//         $sql = "select *,SUBSTRING(designation,1,20) as designation
//                 from depense  where dates<='$dat2' and 
//                 depense like  '%$recherche%'  order by dates";
//         else $sql = "select *,SUBSTRING(designation,1,20) as designation
//         from depense where 
//         depense like  '%$recherche%'  order by dates"; 
// }










// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$depense = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($depense);
// echo "</pre>";
// die();
// require_once('closecommande.php');
//require_once('closedesignation.php');
$db = null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($depense);
$nbr_element_page = 50000;
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
    <title>liste de depenses</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
</head>

<body>
    <div class="container">

        <?php require_once('./navbarok.php') ?>
        <br>
        <h1 class="entete">Liste de depenses</h1>
        <br>

        <div class="panel panel-success">

            <div class="panel-heading">Recherche de depenses</div>
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

                        <?php if ($niveau1 == "m") { ?>
                            <input type="number" name="recherche" placeholder="rechercher" value="<?php echo @$recherche ?>" />
                            <input type="date" name="dates" value="<?php echo @$dat ?>" onchange="this.form.submit()" />
                            <input type="date" name="dates2" value="<?php echo @$dat2 ?>" onchange="this.form.submit()" />
                        <?php } ?>
                    </div>
                    <!-- onchange="this.form.submit()" -->
                    <!-- <label for="niveau">Type de recherche</label> -->

                    <br>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher.....
                    </button>
                    <a href="./adddepense.php" class="btn btn-primary">Ajouter Depenses</a>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table tab table-striped table-responsive">
                <thead class="table tab">

                    <th>
                        <input id="seltous" name='seltous' type="checkbox" value='seltous' onclick="myfunction()">
                        <span class="fa fa-arrow-down"></span>


                    </th>

                    <th class="table-primary">ID</th>

                    <th class="table-primary">Date</th>
                    <th class="table-primary">Designation</th>
                    <th>Divers</th>

                    <th>Montant</th>
                    <th>Periodicite</th>

                    <th class="table-primary">Actions</th>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $jours = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
                    // On boucle sur la variable result
                    // foreach($resultclient as $client){
                    // for($i=$debut;$i<=$nbr_de_pages+$debut+1 ; $i++)
                    for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {
                        if (@$depense[$i] == null) break;
                        $time = $depense[$i]['dates'];

                        $numJour = date('w', strtotime($time));
                        $jour = $jours[$numJour];
                    ?>
                        <td class="table-primary">
                            <input id="sel" name='sel[]' type="checkbox" value=<?= @$depense[$i]['id'] ?> <?php if (isset($sel) && (@in_array($depense[$i]['id'], $sel))) echo "checked" ?>>
                        </td>

                        <td class="table-primary"><?= @$depense[$i]['id'] ?></td>

                        <td class="table-primary"><?= $jour . ' ' . @$depense[$i]['dates'] ?></td>
                        <td class="table-primary"><?= @$depense[$i]['designation'] ?></td>
                        <td class="table-primary"><?= @$depense[$i]['divers'] ?></td>



                        <td class="table-primary"><?= number_format(@$depense[$i]['montant'], 2, ",", ".") ?></td>

                        <td class="table-primary"><?= @$depense[$i]['periodicite'] ?></td>
                        <td class="table-primary">
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-primary" href="detailsdepense.php?id=<?= $depense[$i]['id'] ?>">Consulter</a>
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <a class="btn btn-success" href="editdepense.php?id=<?= $depense[$i]['id'] ?>">Modifier</a>
                                    <a class="btn btn-danger " href="deletedepense.php?id=<?= $depense[$i]['id'] ?>">Supprimer</a>
                            </div>
                        </td>
                    <?php


                                } ?>




                    <td>





                        </tr>

                    <?php
                        $total += @$depense[$i]['montant'];
                    }
                    ?>
                    <td class="table-primary">Total en DZ</td>
                    <td class="table-danger"></td>
                    <td class="table-primary"></td>

                    <td class="table-primary"></td>
                    <td class="table-primary"></td>

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
    </div>
</body>

</html>