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
} else $niveau1 = @$_SESSION['niveau1'];
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
require_once('connectversement.php');

$sql = "select * from versement where id";

// if ($niveau == "t") {
//     if (!empty($dat) and !empty($dat2)) {
//         $sql = "select *,SUBSTRING(nomclient,1,12) as nomclient,SUBSTRING(imprime,1,12) as imprime 
//                     from commande where not (etat like '%6/%') and dates>='$dat' and dates<='$dat2' and
//                     nomclient like  '%$recherche%' order by dates";
//                 }
//         elseif (!empty($dat))
//         $sql = "select *,SUBSTRING(nomclient,1,12) as nomclient,SUBSTRING(imprime,1,12) as imprime 
//                     from commande where not (etat like '%6/%') and dates>='$dat' and 
//                     nomclient like  '%$recherche%'  order by dates";
//         elseif (!empty($dat2))
//         $sql = "select *,SUBSTRING(nomclient,1,12) as nomclient,SUBSTRING(imprime,1,12) as imprime 
//                 from commande not (etat like '%6/%') and where dates<='$dat2' and 
//                 nomclient like  '%$recherche%'  order by dates";
//         else $sql = "select *,SUBSTRING(nomclient,1,12) as nomclient,SUBSTRING(imprime,1,12) as imprime 
//         from commande where not (etat like '%6/%') and 
//         nomclient like  '%$recherche%'  order by dates";
// }


if ($niveau1 == "d") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(client,1,12) as client
                    from versement where  dates>='$dat' and dates<='$dat2' and
                    client like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(client,1,12) as client
                    from versement where  dates>='$dat' and 
                    client like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(client,1,12) as client
                from versement  where dates<='$dat2' and 
                client like  '%$recherche%'  order by dates";
    else $sql = "select *,SUBSTRING(client,1,12) as client
        from versement where client like  '%$recherche%'  order by dates";
}

if ($niveau1 == "m") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(client,1,12) as client
                    from versement where  dates>='$dat' and dates<='$dat2' and
                    versement like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(client,1,12) as client
                    from versement where  dates>='$dat' and 
                    versement like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(client,1,12) as client
                from versement  where dates<='$dat2' and 
                versement like  '%$recherche%'  order by dates";
    else $sql = "select *,SUBSTRING(client,1,12) as client
        from versement where 
        versement like  '%$recherche%'  order by dates";
}




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
    <title>liste de Paiements</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">

  <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body class="container">
    <?php require_once('./navbarok.php') ?>
    <br>
    <h1 class="entete">Liste de Recettes</h1>
    <br>
    
    <!-- <button class="btn btn-primary btn-lg" onclick="travailfait()">Travail fait</button> -->

    <div class="panel panel-success">

        <div class="panel-heading">Recherche de Recettes</div>
        <div class="panel-body">

            <form method="get" action="" class="form-inline">

                <div class="form-group">
                    <select name="niveau1" class="form-&control" id="niveau1" onchange="this.form.submit()">
                        <option value="d" <?php if ($niveau1 === "d")   echo "selected" ?>>Recherche par date</option>

                        <!-- <option value="t" < ?php if ($niveau === "t")   echo "selected" ?>>Recherche Par clients</option> -->
                        <option value="m" <?php if ($niveau1 === "m")   echo "selected" ?>>Recherche par Montant</option>

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
                <a href="./addversement.php" class="btn btn-primary">Ajouter Versement</a>
                <!-- <a href="./etatcreance.php" class="btn btn-primary">Etat Créance Client</a> -->
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
                <th>Client</th>
                <th class="table-primary">Date</th>
                <th class="table-primary">Montant</th>
                <th>Refs</th>
                <th>id client</th>
                <th class="table-primary">Actions</th>


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
                        <!-- number_format(@$versement[$i]['versement'], 2, ",", ".") -->
                        <input id="sel" name='sel[]' type="checkbox" value=<?= @$versement[$i]['id'] ?> <?php if (isset($sel) && (@in_array($versement[$i]['id'], $sel))) echo "checked" ?>>
                    </td>

                    <td class="table-primary"><?= @$versement[$i]['id'] ?></td>
                    <td class="table-primary"><?= @$versement[$i]['client'] ?></td>
                    <td class="table-primary"><?= $jour . ' ' . @$versement[$i]['dates'] ?></td>

                    <td class="table-primary"><?= number_format(@$versement[$i]['versement'], 2, ",", ".") ?></td>
                    <td class="table-info"><?= @$versement[$i]['ref'] ?></td>
                    <td class="table-primary"><?= @$versement[$i]['idclient'] ?></td>

                    <td class="table-primary">
                        <div class="btn-group btn-group-sm">
                            <!-- <a class="btn btn-primary" href="detailsversement.php?id=< ?= $versement[$i]['id'] ?>">Consulter</a> -->
                            <a class="btn btn-primary" 
                            onclick="consulter(`<?=$versement[$i]['id']?>`,
                            `<?=$versement[$i]['client']?>`,
                            `<?= number_format($versement[$i]['versement'],2)?>`)" >Consulter
                            </a>
                           
                            <!-- <input  type="hidden" name="idv" value="< ?= $versement[$i]['id']?>" >
                            <input  type="hidden" name="clientv" value="< ?= $versement[$i]['id']?>" >
                            <input  type="hidden" name="montantv" value="< ?= $versement[$i]['versement']?>" > -->
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <a class="btn btn-success" href="editversement.php?id=<?= $versement[$i]['id'] ?>">Modifier</a>
                                <!-- <a class="btn btn-danger " href="deleteversement.php?id=< ?= $versement[$i]['id'] ?>">Supprimer</a> -->
                        </div>
                        <a class="btn btn-danger" 
                            onclick="supprimer(`<?=$versement[$i]['id']?>`,
                            `<?=$versement[$i]['client']?>`,
                            `<?= number_format($versement[$i]['versement'],2)?>`)" >Supprimer
                            </a>
                    </td>
                <?php


                            } ?>


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

<script>
 function travailfait() {

//  const Toast = Swal.mixin({
//   toast: true,
//   position: 'bottom-start',
//   showConfirmButton: false,
//   timer: 3000,
//   timerProgressBar: true,
//   didOpen: (toast) => {
//     toast.addEventListener('mouseenter', Swal.stopTimer)
//     toast.addEventListener('mouseleave', Swal.resumeTimer)
//   }
// })

// Toast.fire({
//   icon: 'success',
//   title: 'Signed in successfully'
// })




    Swal.fire({
//   position: 'bottom-start',
  icon: 'success',
  title: 'Operation terminée avec succée',
  showConfirmButton: false,
  timer: 2500
})
 } 

function consulter(j,nom,versement) {
            // console.log(j);
            // mavar=document.getElementById(j).innerHTML;
    
         
Swal.fire({
    title: `<strong>Versement N° ${j}</strong>`,
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  },
//   text: "Versement",
  icon: 'success',
  html:`
   <h3>  ${nom}</h3>
   <h4>Montant  ${versement}</h4>
  `
  ,
// footer:"Suppression irréversible",
backdrop:true,
heightAuto:false,
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
 confirmButtonText: 'Ok merci',
   cancelButtonText: 'Annuler',
  width: '42em',
 
//  height: '42em',
  showCloseButton: true
}).then((result) => {
   


//   if (result.isConfirmed) {

//     Swal.fire(
//       'Supprimé',
//       'Votre fiche à eté supprimé.',
//       'success'
//     ).then((result) => {
//      //document.location.href = 'delete2versement.php?id='+j;
   
//     })
  

//   }
})
}





function supprimer(j,nom,versement) {
            // console.log(j);
            // mavar=document.getElementById(j).innerHTML;
    
         
Swal.fire({
    title: `Versement N°${j}`,
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  },
//   text: "Versement",
  icon: 'warning',
  html:`
  
  <h3>  ${nom}</h3>
   <h4>Montant  ${versement}</h4>
  `
  ,
footer:"Suppression irréversible",
backdrop:true,
heightAuto:false,
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Supprimer la fiche',
  cancelButtonText: 'Annuler',
  width: '42em',
 
//  height: '42em',
  showCloseButton: true
}).then((result) => {
   


  if (result.isConfirmed) {

    Swal.fire(
      'Supprimé',
      'Votre fiche à eté supprimé.',
      'success'
    ).then((result) => {
     document.location.href = 'delete2versement.php?id='+j;
   
    })
  

  }
})
}
</script>
</body>

</html>