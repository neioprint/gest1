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
$_SESSION['valider'] = "deja";
//require_once('role.php');


//$datecom=date('d-m-Y');
// **************************************************************
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
$dat = isset($_GET['dates']) ? $_GET['dates'] : "";
// if ($dat!="") {
//                 $datexplode=explode(" à",$dat);
//                 //print_r($datexplode[0]);
//                 $dat=$datexplode[0];
//                 }
//die();
$dat2 = isset($_GET['dates2']) ? $_GET['dates2'] : "";

$niveau1 = isset($_GET['niveau1']) ? $_GET['niveau1'] : "t";
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
    if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
    if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die();
}






if ($niveau1 == "p") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and datebl<='$dat2' and
                    client  like  '%$recherche%' and fichier like '%prof%' order by datebl";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and 
                    client like  '%$recherche%' and fichier like '%prof%' order by datebl";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                from bondelivraison  where datebl<='$dat2' and 
                client like  '%$recherche%' and fichier like '%prof%' order by datebl";
    else $sql = "select * from bondelivraison where client like  '%$recherche%' and fichier like '%prof%' order by datebl";
}

if ($niveau1 == "b") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and datebl<='$dat2' and
                    client  like  '%$recherche%' and fichier like '%bl%' order by datebl";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and 
                    client like  '%$recherche%' and fichier like '%bl%' order by datebl";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                from bondelivraison  where datebl<='$dat2' and 
                client like  '%$recherche%' and fichier like '%bl%' order by dates";
    else $sql = "select * from bondelivraison where client like  '%$recherche%' 
        and fichier like '%bl%' order by datebl";
}
if ($niveau1 == "f") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and datebl<='$dat2' and
                    client  like  '%$recherche%' and fichier like '%fact%' order by datebl";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and 
                    client like  '%$recherche%' and fichier like '%fact%' order by datebl";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                from bondelivraison  where dates<='$dat2' and 
                client like  '%$recherche%' and fichier like '%bl%' order by dates";
    else $sql = "select * from bondelivraison where client like  '%$recherche%' 
        and fichier like '%fact%' order by datebl";
}
// if ($niveau == "t") 
// $sql = "se lect *,SUBSTR(datebl,1,10) as datebl from bondelivraison where client like  '%$recherche%'  order by datebl";
if ($niveau1 == "t") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and datebl<='$dat2' and
                    client  like  '%$recherche%'  order by datebl";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                    from bondelivraison where  datebl>='$dat' and 
                    client like  '%$recherche%'  order by datebl";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTR(datebl,1,10) as datebl
                from bondelivraison  where dates<='$dat2' and 
                client like  '%$recherche%' order by dates";
    else $sql = "select * from bondelivraison where client like  '%$recherche%' 
         order by datebl";
}





// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$document = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($depense);
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
    <h1 class="entete">liste de documents émis</h1>
    <br>

    <div class="panel panel-success">

        <div class="panel-heading">Recherche de documents</div>
        <div class="panel-body">

            <form method="get" action="" class="form-inline">

                <div class="form-group">
                    <select name="niveau1" class="form-control" id="niveau1" onchange="this.form.submit()">
                        <option value="t" <?php if ($niveau1 === "t")   echo "selected" ?>>Tous les documents</option>
                        <option value="b" <?php if ($niveau1 === "b")   echo "selected" ?>>Recherche par bon de livraison</option>
                        <option value="f" <?php if ($niveau1 === "f")   echo "selected" ?>>Recherche par facture</option>
                        <option value="p" <?php if ($niveau1 === "p")   echo "selected" ?>>Recherche par facture proforma</option>


                    </select>


                    <br>
                    <input type="text" name="recherche" placeholder="rechercher" value="<?php echo @$recherche ?>" />

                    <input type="date" name="dates" value="<?php echo @$dat ?>" onchange="this.form.submit()" />
                    <input type="date" name="dates2" value="<?php echo @$dat2 ?>" onchange="this.form.submit()" />



                </div>
                <!-- onchange="this.form.submit()" -->
                <!-- <label for="niveau">Type de recherche</label> -->

                <br>
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                    Chercher.....
                </button>
                <!-- <a href=""  class="btn btn-primary">Ajouter document</a> -->
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
                <th>Date</th>
                <!-- < ?php if ($niveau=="t") { ?>
            <th class="table-primary">Fichier</th>
            < ?php } ?> -->
                <!-- <th class="table-primary">Id commande</th> -->
                <th>Document</th>

                <th>Client</th>

                <th>Montant</th>
                <th>Action</th>

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

                    <td class="table-primary"><?= @$document[$i]['id'] ?></td>
                    <td class="table-primary"><?= $document[$i]['datebl'] ?></td>



                    <!-- <td class="table-primary">< ?= @$document[$i]['idcommandes'] ?></td> -->
                    <?php if ($niveau1 == "p") { ?>
                <td class="table-primary"><?= "Prof N°" . @$document[$i]['numbl'] ?></td>
                <?php }  ?> 
                <?php if ($niveau1 == "f") { ?>
                <td class="table-primary"><?= "Facture N°" . @$document[$i]['numbl'] ?></td>
                <?php } ?> 
                <?php if ($niveau1 == "b") { ?>
                <td class="table-primary"><?= "bon de liv N°" . @$document[$i]['numbl'] ?></td>
                <?php } ?> 
                    <!-- debut de traitement type de document -->
                    <?php
                 
                    $fichier = $document[$i]['fichier'];
                    $typedoc = "";
                    if ($fichier[0] == "b" && $fichier[1] == "l") $typedoc = "Bon Livr N°";
                    if ($fichier[0] == "p" && $fichier[1] == "r") $typedoc = "Proforma N°";
                    if ($fichier[0] == "f" && $fichier[1] == "a") $typedoc = "Facture N°";
                    ?>
                    <td class="table-primary">
                        <a style="color:blue" href="./documentafficher.php?fichier=<?= $document[$i]['fichier'] ?>&idcommandes=<?= $document[$i]['idcommandes'] ?>&numbl=<?= $document[$i]['numbl'] ?>&client=<?= $document[$i]['client'] ?>&datebl=<?= $document[$i]['datebl'] ?>&montantbl=<?= $document[$i]['montant'] ?>&modepaiement=<?=@$document[$i]['modepaiement']?>"> <?= $typedoc . @$document[$i]['numbl'] ?>
                        </a>
                    </td>

                 
                    <!-- fin de traitement type de document -->

                    <td class="table-primary">
                      
                        <?= @$document[$i]['client'] ?>
                     

                    </td>

                    <td class="table-primary"><?= number_format(@$document[$i]['montant'], 2, ",", ".") ?></td>
                    <td>  
                         <!-- <a class="btn btn-danger" href="deletedocument.php?id=< ?=@$document[$i]['id']?>">Suppr</a> -->
                         <a class="btn btn-danger" onclick="confirmer(<?=@$document[$i]['id']?>)">Suppr</a>

                        
                    </td>









                    </tr>

                <?php
                    $total += @$document[$i]['montant'];
                }
                ?>
                <td class="table-primary">Total en DZ</td>
                <td class="table-danger"></td>
                <td class="table-primary"></td>

                <td class="table-primary"></td>
                <td class="table-primary"></td>

                <td class="table-success"><?= number_format($total, 2, ",", ".") ?></td>
                <td class="table-primary"></td>
                <!-- <td class="table-primary"></td> -->
                <!-- <td class="table-primary"></td> -->

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
function confirmer(id) {
            console.log(id);
            // mavar=document.getElementById(j).innerHTML;
    
// j=0;
// nom="sido";
// versement="5000" ;      
Swal.fire({
    title: `<strong>Confirmer</strong>`,
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  },
//   text: "Versement",
  icon: 'success',
  html:`
   
   <h4>Action </h4>
  `
  ,
footer:"Operation  irréversible",
backdrop:true,
heightAuto:false,
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
 confirmButtonText: 'Ok',
   cancelButtonText: 'Annuler',
  width: '42em',
 
//  height: '42em',
  showCloseButton: true
}).then((result) => {
   


   if (result.isConfirmed) {

//     Swal.fire(
//       'Supprimé',
//       'Votre fiche à eté supprimé.',
//       'success'
//     ).then((result) => {
    //document.location.href = './terminercommande.php?id='+'< ?= $resultcommande ?>'+'&suite='+etat+'&page='+< ?= $page ?>;
    
    document.location.href ='deletedocument.php?id='+id;
 
//     })
  

   }
})
}


</script>
</body>

</html>