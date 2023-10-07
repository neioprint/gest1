<?php
require_once "const.php";


//  echo "<pre>";
//  print_r($resultcommande[$prod[0]['idcommande']]['nomclient']);
//  echo "</pre>";
//$datecom=date('d-m-Y');
// **************************************************************
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
$dat = isset($_GET['dates']) ? $_GET['dates'] : "";
$dat2 = isset($_GET['dates2']) ? $_GET['dates2'] : "";

$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "t";

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




if ($niveau == "t") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *
                    from production where  dates>='$dat' and dates<='$dat2'  order by dates";
    } elseif (!empty($dat))
        $sql = "select *
                    from production where  dates>='$dat'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *
                from production  where dates<='$dat2'  order by dates";
    else
        $sql = "select *
        from production order by dates";
}

if ($niveau == "d") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *
                    from production where  dates>='$dat' and dates<='$dat2'  order by dates";
    } elseif (!empty($dat))
        $sql = "select *
                    from production where  dates>='$dat'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *
                from production  where dates<='$dat2'  order by dates";
    else
        $sql = "select *
        from production order by dates";
}
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$prod = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($prod);
// echo "</pre>";
// echo gettype($prod[2]['qte']);
// echo gettype($matiere[0]['prix']);
// echo ($matiere[2]['qte']*1.0);
// echo ($matiere[0]['prix'])*1.0;
// die();
// require_once('closecommande.php');
//require_once('closedesignation.php');
//$db = null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($prod);
$nbr_element_page = 50;
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
    <title>liste de Production</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
</head>

<body>
    <?php require_once('./navbarok.php') ?>

    <br>
    <h1 class="entete">Liste de Production</h1>
    <br>

    <div class="panel panel-success">

        <div class="panel-heading">Recherche de production</div>
        <div class="panel-body">

            <form method="get" action="" class="form-inline">

                <div class="form-group">
                    <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                        <option value="d" <?php if ($niveau === "d")   echo "selected" ?>>Etats (en att/en cours/ter) de production</option>
                        <option value="t" <?php if ($niveau === "t")   echo "selected" ?>>Tout etat de productions</option>
                        <!-- <option value="t" < ?php if ($niveau === "t")   echo "selected" ?>>Recherche Par clients</option> -->
                        <!-- <option value="m" < ?php if ($niveau === "m")   echo "selected" ?>>Recherche par Montant</option> -->

                    </select>
                    <!-- < ?php if ($niveau == "t") { ?>
                        <input type="text" name="recherche" placeholder="rechercher" value="< ?php echo @$recherche ?>" />
                    < ?php } ?> -->
                    <!-- < ?php if ($niveau == "d") { ?> -->
                    <br>
                    <input type="text" name="recherche" placeholder="rechercher" value="<?php echo @$recherche ?>" />

                    <input type="date" name="dates" value="<?php echo @$dat ?>" onchange="this.form.submit()" />
                    <input type="date" name="dates2" value="<?php echo @$dat2 ?>" onchange="this.form.submit()" />
                    <!-- < ?php } ?> -->


                </div>
                <!-- onchange="this.form.submit()" -->
                <!-- <label for="niveau">Type de recherche</label> -->

                <br>
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                    Chercher.....
                </button>
                <a href="./addproduction.php" class="btn btn-primary">Ajouter Production</a>
                <a href="./formcommande.php" class="btn btn-success">Ajouter Commande</a>
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
                <th class="table-primary">id commande</th>


                <th class="table-primary">id imprime</th>
                <th class="table-primary">imprime</th>
                <th class="table-primary">id client</th>
                <th class="table-primary">client</th>
                <th class="table-primary">Etat prod</th>
                <th class="table-primary">id matiere</th>
                <th class="table-primary">matiere</th>
                <th class="table-primary">Qté à consommer</th>
                <th class="table-primary">Format coupe</th>
                <th class="table-primary">Nb poses/feuille</th>
                <th class="table-primary">Format Tirage</th>
                <th class="table-primary">Nb pose/tirage</th>
                <th class="table-primary">Nb plaques</th>
                <th class="table-primary">Format chute</th>
                <th class="table-primary">Action</th>
                <!-- <th>Unite de mesure</th> -->

                <!-- <th class="table-primary">Actions</th> -->
            </thead>
            <tbody>
                <?php
                $total = 0;
                require_once('connectcommande.php');
                // On boucle sur la variable result
                // foreach($resultclient as $client){
                // for($i=$debut;$i<=$nbr_de_pages+$debut+1 ; $i++)
                for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {
                    if (@$prod[$i] == null) break;


                    $sql = "SELECT * FROM `commande` WHERE `id` = :idcommande";

                    $query = $db->prepare($sql);
                    $query->bindValue(':idcommande', $prod[$i]['idcommande'], PDO::PARAM_INT);
                    // // On exécute la requête
                    $query->execute() or die(print_r($db->errorInfo()));
                    // // On stocke le résultat dans un tableau associatif
                    $resultcommande = $query->fetch(PDO::FETCH_ASSOC);
                    if (($niveau == "d") && ($resultcommande['etat'][0] == "0" or $resultcommande['etat'][0] == "1" or $resultcommande['etat'][0] == "2")) {
                ?>
                        <td class="table-primary">
                            <input id="sel" name='sel[]' type="checkbox" value=<?= @$prod[$i]['idprod'] ?> <?php if (isset($sel) && (@in_array($prod[$i]['idprod'], $sel))) echo "checked" ?>>
                        </td>

                        <td class="table-primary"><?= @$prod[$i]['idprod'] ?></td>

                        <td class="table-primary"><?= @$prod[$i]['dates'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['idcommande'] ?></td>
                        <!-- <td class="table-primary">< ?= $resultcommande[$prod[$i]['idcommande']]['nomclient'] ?></td> -->

                        <td class="table-primary"><?= @$resultcommande['idimprime'] ?></td>
                        <td class="table-primary"><?= @$resultcommande['imprime'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['idclient'] ?></td>

                        <td class="table-primary"><?= @$resultcommande['nomclient'] ?></td>
                        <td class="table-primary"><?= "<span style='background-color:blue;color:red;font-weight:bold'>" . @$resultcommande['etat'] . "</span>" ?></td>
                        <td class="table-primary"><?= @$prod[$i]['idmatiere'] ?></td>
                        <td></td>
                        <td class="table-primary"><?= @$prod[$i]['qteaconsommer'] . "Feuilles" ?></td>
                        <td class="table-primary"><?= @$prod[$i]['formatcoupe'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['nbreposecoupe'] ?></td>

                        <td class="table-primary"><?= @$prod[$i]['formatTirage'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['nbreposetirage'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['nbreplaque'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['formatchute'] ?></td>
                        <td>

                            <a class="btn btn-primary btn-sm btn-success" href="etatproduction.php?idprod=<?= $prod[$i]['idprod'] ?>&dates=<?= $prod[$i]['dates'] ?>&idcommande=<?= $prod[$i]['idcommande'] ?>&idimprime=<?= $prod[$i]['idimprime'] ?>&idclient=<?= $prod[$i]['idclient'] ?>&idmatiere=<?= $prod[$i]['idmatiere'] ?>&qteaconsommer=<?= $prod[$i]['qteaconsommer'] ?>&formatcoupe=<?= $prod[$i]['formatcoupe'] ?>&nbreposecoupe=<?= $prod[$i]['nbreposecoupe'] ?>&
                                   formatTirage=<?= $prod[$i]['formatTirage'] ?>&
                                   nbreposetirage=<?= $prod[$i]['nbreposetirage'] ?>&
                                   nbreplaque=<?= $prod[$i]['nbreplaque'] ?>&
                                   formatchute=<?= $prod[$i]['formatchute'] ?>&
                                   
                                   ">Fiche Prod
                            </a>

                        </td>

                        </tr>

                    <?php  } else
                        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                        if ($niveau == "t") {
                    ?>
                        <td class="table-primary">
                            <input id="sel" name='sel[]' type="checkbox" value=<?= @$prod[$i]['idprod'] ?> <?php if (isset($sel) && (@in_array($prod[$i]['idprod'], $sel))) echo "checked" ?>>
                        </td>

                        <td class="table-primary"><?= @$prod[$i]['idprod'] ?></td>

                        <td class="table-primary"><?= @$prod[$i]['dates'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['idcommande'] ?></td>
                        <!-- <td class="table-primary">< ?= $resultcommande[$prod[$i]['idcommande']]['nomclient'] ?></td> -->

                        <td class="table-primary"><?= @$resultcommande['idimprime'] ?></td>
                        <td class="table-primary"><?= @$resultcommande['imprime'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['idclient'] ?></td>

                        <td class="table-primary"><?= @$resultcommande['nomclient'] ?></td>
                        <td class="table-primary"><?= "<span style='background-color:blue;color:red;font-weight:bold'>" . @$resultcommande['etat'] . "</span>" ?></td>
                        <td class="table-primary"><?= @$prod[$i]['idmatiere'] ?></td>
                        <td></td>
                        <td class="table-primary"><?= @$prod[$i]['qteaconsommer'] . "Feuilles" ?></td>
                        <td class="table-primary"><?= @$prod[$i]['formatcoupe'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['nbreposecoupe'] ?></td>

                        <td class="table-primary"><?= @$prod[$i]['formatTirage'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['nbreposetirage'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['nbreplaque'] ?></td>
                        <td class="table-primary"><?= @$prod[$i]['formatchute'] ?></td>
                        <td>

                            <a class="btn btn-primary btn-sm btn-success" href="etatproduction.php?idprod=<?= $prod[$i]['idprod'] ?>&dates=<?= $prod[$i]['dates'] ?>&idcommande=<?= $prod[$i]['idcommande'] ?>&idimprime=<?= $prod[$i]['idimprime'] ?>&idclient=<?= $prod[$i]['idclient'] ?>&idmatiere=<?= $prod[$i]['idmatiere'] ?>&qteaconsommer=<?= $prod[$i]['qteaconsommer'] ?>&formatcoupe=<?= $prod[$i]['formatcoupe'] ?>&nbreposecoupe=<?= $prod[$i]['nbreposecoupe'] ?>&
                                   formatTirage=<?= $prod[$i]['formatTirage'] ?>&
                                   nbreposetirage=<?= $prod[$i]['nbreposetirage'] ?>&
                                   nbreplaque=<?= $prod[$i]['nbreplaque'] ?>&
                                   formatchute=<?= $prod[$i]['formatchute'] ?>&
                                   
                                   ">Fiche Prod
                            </a>

                        </td>

                        </tr>

                <?php  }
                    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

                }
                require_once('closecommande.php');
                ?>

                <!-- <td class="table-danger"></td>
                <td class="table-primary"></td>

                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-danger"></td>
                <td class="table-primary"></td>

                <td class="table-primary"></td>
                <td class="table-primary"></td>
                
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td> -->

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