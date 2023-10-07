<?php
require_once "const.php";




$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : "";

// On inclut la connexion à la base
// require_once('connectcommande.php');
require_once('connectversement.php');

$sql = "select * from versement where commande  like '%$idcommande%'";




// if ($niveau1 == "d") {
//     if (!empty($dat) and !empty($dat2)) {
//         $sql = "select *,SUBSTRING(client,1,12) as client
//                     from versement where  dates>='$dat' and dates<='$dat2' and
//                     client like  '%$recherche%' order by dates";
//     } elseif (!empty($dat))
//         $sql = "select *,SUBSTRING(client,1,12) as client
//                     from versement where  dates>='$dat' and 
//                     client like  '%$recherche%'  order by dates";
//     elseif (!empty($dat2))
//         $sql = "select *,SUBSTRING(client,1,12) as client
//                 from versement  where dates<='$dat2' and 
//                 client like  '%$recherche%'  order by dates";
//     else $sql = "select *,SUBSTRING(client,1,12) as client
//         from versement where client like  '%$recherche%'  order by dates";
// }

// if ($niveau1 == "m") {
//     if (!empty($dat) and !empty($dat2)) {
//         $sql = "select *,SUBSTRING(client,1,12) as client
//                     from versement where  dates>='$dat' and dates<='$dat2' and
//                     versement like  '%$recherche%' order by dates";
//     } elseif (!empty($dat))
//         $sql = "select *,SUBSTRING(client,1,12) as client
//                     from versement where  dates>='$dat' and 
//                     versement like  '%$recherche%'  order by dates";
//     elseif (!empty($dat2))
//         $sql = "select *,SUBSTRING(client,1,12) as client
//                 from versement  where dates<='$dat2' and 
//                 versement like  '%$recherche%'  order by dates";
//     else $sql = "select *,SUBSTRING(client,1,12) as client
//         from versement where 
//         versement like  '%$recherche%'  order by dates";
// }




// $sql = "select * from versement where 
// versement like  '$recherche' order by dates";





// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$versement = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($versement);
// echo "</pre>";
// die();
// require_once('closecommande.php');
require_once('closeclient.php');

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($versement);
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
    <title>Etat versement commande</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
</head>

<body class="container">
    <?php require_once('./navbarok.php') ?>
    <br>
    <h1 class="entete">Etat Recette commande</h1>
    <br>

    

        <!-- <div class="panel-heading">Recherche de Recettes</div> -->
     
    <div class="table-responsive">
    <a id="bouton"  class="btn btn-primary btn-block" onclick="window.history.back()">Retourner</a>
    <?php if ($versement!=null) { ?>
        <table class="table tab table-striped table-responsive">
            <thead class="table tab">

                <th>
                    <input id="seltous" name='seltous' type="checkbox" value='seltous' onclick="myfunction()">
                    <span class="fa fa-arrow-down"></span>
                

                </th>
                <th class="table-primary">Date</th>
                <th class="table-primary">ID</th>
                <th>id client</th>
                <th>Client</th>
              
                <th class="table-primary">Montant</th>
                <th>Refs</th>
              
                <!-- <th class="table-primary">Actions</th> -->


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
                    if (@$versement[$i] == null) break;
                    $time = $versement[$i]['dates'];

                    $numJour = date('w', strtotime($time));
                    $jour = $jours[$numJour];
                ?>
                    <td class="table-primary">
                        <input id="sel" name='sel[]' type="checkbox" value=<?= @$versement[$i]['id'] ?> <?php if (isset($sel) && (@in_array($versement[$i]['id'], $sel))) echo "checked" ?>>
                    </td>
                    <td class="table-primary"><?= $jour . ' ' . @$versement[$i]['dates'] ?></td>
                    <td class="table-primary"><?= @$versement[$i]['id'] ?></td>
                    <td class="table-primary"><?= @$versement[$i]['idclient'] ?></td>
                    <td class="table-primary"><?= @$versement[$i]['client'] ?></td>
                  

                    <td class="table-primary"><?= number_format(@$versement[$i]['versement'], 2, ",", ".") ?></td>
                    <td class="table-info"><?= @$versement[$i]['ref'] ?></td>
                   

                    <!-- <td class="table-primary">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-primary" href="detailsversement.php?id=< ?= $versement[$i]['id'] ?>">Consulter</a>
                            < ?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <a class="btn btn-success" href="editversement.php?id=< ?= $versement[$i]['id'] ?>">Modifier</a>
                                <a class="btn btn-danger " href="deleteversement.php?id=< ?= $versement[$i]['id'] ?>">Supprimer</a>
                        </div>
                    </td>
                < ?php


                            } ?> -->


                <td>





                    </tr>

                <?php
                    $total += @$versement[$i]['versement'];
                }
                ?>
                <td class="table-primary">Total en DZ</td>
                <td class="table-danger"></td>
                <td class="table-primary"></td>

                <td class="table-primary"></td>

                <td class="table-success"><?= number_format($total, 2, ",", ".") ?></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>
                <td class="table-primary"></td>

            </tbody>
        </table>
        <?php } else {
            $_SESSION['message']='Pas de Recette pour cette commande';
            if (!empty($_SESSION['message'])) {
                echo '<div class="alert alert-success" role="alert" .alert-dismissible">
                        ' . $_SESSION['message'] . '</div>';
                $_SESSION['message'] = "";
             }
             }?>
    </div>
   
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