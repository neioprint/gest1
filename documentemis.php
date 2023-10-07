<?php
require_once "const.php";

$_SESSION['valider'] = "deja";
//require_once('role.php');



$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : "";
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
//$_SESSION['valider'] = "non";

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












    
    
      
 $sql = "select * from bondelivraison where idcommandes like  '%$idcommande%' 
         order by datebl";





// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$document = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($document);
// echo "</pre>";
// die();
// require_once('closecommande.php');
//require_once('closedesignation.php');
$db = null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($document);
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
    <title>liste de documents émis</title>
    <link rel="icon" href="./images/logo.avif" type="image" />


    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">



</head>

<body class="container">



    <?php require_once('./navbarok.php') ?>
    <br>
    <h1 class="entete">liste de documents émis pour la commande <?= $idcommande ?></h1>
    <br>

    <a id="bouton"  class="btn btn-primary btn-block" onclick="window.history.back()">Retourner</a>
    <?php if ($document!=null) { ?>
    <div class="table-responsive">
        <table class="table tab table-striped table-responsive">
            <thead class="table tab">

                <th>
                    <input id="seltous" name='seltous' type="checkbox" value='seltous' onclick="myfunction()">
                    <span class="fa fa-arrow-down"></span>


                </th>

                <!-- <th class="table-primary">ID</th> -->
                <th>Date</th>
                <!-- < ?php if ($niveau=="t") { ?>
            <th class="table-primary">Fichier</th>
            < ?php } ?> -->
                <!-- <th class="table-primary">Id commande</th> -->
                <th>Document</th>

                <!-- <th>Client</th> -->

                <th>Montant</th>

                <!-- <th class="table-primary">Actions</th> -->
            </thead>
            <tbody>
                <?php
                $total = 0;
                // On boucle sur la variable result
                // foreach($resultclient as $client){
                // for($i=$debut;$i<=$nbr_de_pages+$debut+1 ; $i++)
                // print_r($document);
                // die();
                for ($i = 0; $i < count($document); $i++) {

                    //  if (@$document[$i] == null) break;
                ?>
                    <td class="table-primary">
                        <input id="sel" name='sel[]' type="checkbox" value=<?= @$document[$i]['id'] ?> <?php if (isset($sel) && (@in_array($document[$i]['id'], $sel))) echo "checked" ?>>
                    </td>

                    <!-- <td class="table-primary">< ?= @$document[$i]['id'] ?></td> -->
                    <td class="table-primary"><?= $document[$i]['datebl'] ?></td>



                    <!-- <td class="table-primary">< ?= @$document[$i]['idcommandes'] ?></td> -->
                    <!-- < ?php if (1 == 1) { ?>
                <td class="table-primary">< ?= "Prof N°" . @$document[$i]['numbl'] ?></td>
                < ?php }  ?> 
                < ?php if (1 ==1) { ?>
                <td class="table-primary">< ?= "Facture N°" . @$document[$i]['numbl'] ?></td>
                < ?php } ?> 
                < ?php if (1 == 1) { ?>
                <td class="table-primary">< ?= "bon de liv N°" . @$document[$i]['numbl'] ?></td>
                < ?php } ?>  -->
                    <!-- debut de traitement type de document -->
                    <?php
                 
                    $fichier = $document[$i]['fichier'];
                    $typedoc = "";
                    if ($fichier[0] == "b" && $fichier[1] == "l") $typedoc = "Bon de Livraison N°";
                    if ($fichier[0] == "p" && $fichier[1] == "r") $typedoc = "Proforma N°";
                    if ($fichier[0] == "f" && $fichier[1] == "a") $typedoc = "Facture N°";
                    ?>
                    <td class="table-primary">
                        <a style="color:blue" href="./documentafficher.php?fichier=<?= $document[$i]['fichier'] ?>&idcommandes=<?= $document[$i]['idcommandes'] ?>&numbl=<?= $document[$i]['numbl'] ?>&client=<?= $document[$i]['client'] ?>&datebl=<?= $document[$i]['datebl'] ?>&montantbl=<?= $document[$i]['montant'] ?>&modepaiement=<?=@$document[$i]['modepaiement']?>"> <?= $typedoc . @$document[$i]['numbl'] ?>
                        </a>
                    </td>

                 
                    <!-- fin de traitement type de document -->

                    <!-- <td class="table-primary">
                      
                         < ?= @$document[$i]['client'] ?> 
                     

                    </td> -->

                    <td class="table-primary"><?= number_format(@$document[$i]['montant'], 2, ",", ".") ?></td>










                    </tr>

                <?php
                    $total += @$document[$i]['montant'];
                }
                ?>
                <!-- <td class="table-primary">Total en DZ</td>
                <td class="table-danger"></td>
                <td class="table-primary"></td> -->

                <!-- <td class="table-primary"></td> -->
                <!-- <td class="table-primary"></td> -->

                <!-- <td class="table-success">< ?= number_format($total, 2, ",", ".") ?></td> -->
                <!-- <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td> -->

            </tbody>
        </table>
    </div>
           <?php } else {
            //echo 'pas de document';
            $_SESSION['message']='Pas de document emis pour cette commande';
            if (!empty($_SESSION['message'])) {
                echo '<div class="alert alert-success" role="alert" .alert-dismissible">
                        ' . $_SESSION['message'] . '</div>';
                $_SESSION['message'] = "";
            }
            // header('Location:indexcommande.php');
            // exit();

            }?>
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