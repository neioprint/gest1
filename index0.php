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
//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// On inclut la connexion à la base client
require_once('connectclient.php');

$sql = "SELECT * FROM `client`";

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
//var_dump( $resultclient[0]['tel']);
//die();
// echo "<pre>";
// var_dump($resultclient);
// echo "</pre>";
require_once('closeclient.php');

// $recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";
// $dat = isset($_GET['dates']) ? $_GET['dates'] : "";
// $dat2 = isset($_GET['dates2']) ? $_GET['dates2'] : "";

// $niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "all";
// // On inclut la connexion à la base imprimé
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

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
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
} else @$niveau1 = $_SESSION['niveau1'];
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

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


require('connect.php');
$sql = "select * from imprimes where impclient like  '%$recherche%'";
if ($niveau1 == "all")  $sql = "select * from imprimes where impclient like  '%$recherche%'";
if ($niveau1 == "t") {

    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *
                from imprimes where dates>='$dat' and dates<='$dat2' and
                impclient like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *
                from imprimes where  dates>='$dat' and 
                nomclient like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *
            from imprimes  where dates<='$dat2' and 
            impclient like  '%$recherche%'  order by dates";
    else $sql = "select * from imprimes where  
    impclient like  '%$recherche%'  order by dates";
}

if ($niveau1 == "d") {

    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *
                from imprimes where dates>='$dat' and dates<='$dat2' and
                imprime like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *
                from imprimes where  dates>='$dat' and 
                imprime like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *
            from imprimes  where dates<='$dat2' and 
            imprime like  '%$recherche%'  order by dates";
    else $sql = "select * from imprimes where  
    imprime like  '%$recherche%'  order by dates";
}

if ($niveau1 == "i") {
    $sql = "select *,SUBSTRING(impclient,1,20) as impclient,SUBSTRING(imprime,1,20) 
    as imprime from imprimes where  imprime like  '%$recherche%' order by dates";
}
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);
// O;//var_dump($result);

require('./close.php');
// pagination
@$page = isset($_GET['page']) ? $_GET['page'] : 1;
$compteur = count($result);
$nbr_element_page = 50000;
$nbr_de_pages = ceil($compteur / $nbr_element_page);
$debut = ($page - 1) * $nbr_element_page;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Imprimés</title>
    <link rel="stylesheet" href="css/normalize.css">


    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/monstyle.css"> -->
    <link rel="stylesheet" href="./css/style41.css">
    <script src="./js/jquery-3.3.1.js"></script>
    <link rel="icon" href="./images/logo.avif" type="image" />

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->




    
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
     <!-- <link rel="stylesheet" href="./css/styleloader.css"> -->
</head>

<body>
    <?php
    require('./navbarok.php')
    ?>
    <main class="container">
         <div class="entete">
            <!-- <img src="./images/logo.avif" alt="logo global2pub" width="120" height="auto"> -->

            <!-- <h1 class="entete">Gestion Commande</h1> -->

        </div>
        <?php
        require('./menu.php')
        ?>
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
                <?php
                if (!empty($_SESSION['message'])) {
                    echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
                    $_SESSION['message'] = "";
                }
                ?>

                <h1 class="entete">Liste des imprimés<?php echo " " . $compteur ?></h1>
                <!-- $$$$$$$$$$$$$$$$debut recherche $$$$$$$$$ -->
                <div class="panel panel-success">
                    <div class="panel-heading">Recherche des imprimés</div>
                    <div class="panel-body">

                        <form method="get" action="" class="form-inline">

                            <div class="form-group">


                                <input type="search" name="recherche" placeholder="rechercher" value="<?php echo @$recherche ?>" />


                                <span style="color:red">Du</span>
                                <label for="date"></label>
                                <input type="date" id="date" name="dates" value="<?php echo $dat ?>" onchange="this.form.submit()" />
                                <span style="color:red">Au</span>
                                <label for="date2"></label>
                                <input type="date" id="date2" name="dates2" value="<?php echo $dat2 ?>" onchange="this.form.submit()" />


                                <br>
                                <span style="color:red">Par</span>



                                <select name="niveau1" class="form-control" id="niveau1" onchange="this.form.submit()">
                                    <!-- <option  value="0" < ?php if($niveau==="0") echo "selected" ?>>Veuillez selectionner un critère de recherche</option> -->
                                    <option value="all" <?php if ($niveau1 === "all") echo "selected";
                                                        $_SESSION['niveau1'] = $niveau1; ?>>Recherche Imprimes par client</option>
                                    <option value="t" <?php if ($niveau1 === "t")   echo "selected";
                                                        $_SESSION['niveau1'] = $niveau1; ?>>Recherche Imprimes par client et date</option>
                                    <option value="i" <?php if ($niveau1 === "i")   echo "selected";
                                                        $_SESSION['niveau1'] = $niveau1; ?>>Recherche par imprimé</option>
                                    <option value="d" <?php if ($niveau1 === "d")   echo "selected";
                                                        $_SESSION['niveau1'] = $niveau1; ?>>Recherche par imprimé et date</option>
                                    <!-- <option value="q" < ?php if ($niveau === "q")   echo "selected" ?> selected>Recherche par client</option>
                                   -->
                                    <!-- <option value="d"   < ?php if($niveau==="d")   echo "selected" ?>>Recherche par date</option>
                                    <option value="i" < ?php if ($niveau === "i")   echo "selected" ?>>Recherche par imprime</option> -->




                                </select>
                            </div>
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Chercher.....</button>
                            <a href="./add.php" class="btn btn-primary">+Imprimé</a>

                            <a href="./addproduction.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Production</a>
  <!-- <button id="btn-open-modal" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Commandes</button> -->

                <a href="./formcommande.php"  class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Commande</a>
                <!-- <button id="btn-open-modal">Ouvrir le modal</button> -->
                <a href="./addclient.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Client</a>
                <a href="./add.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Imprime</a>
                <!-- <a href="./proforma.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Proforma</a> -->
           
                  <a href="tel:+213541035548"  class="btn btn-primary">Appeler</a>
                                <a href="sms:+213541035548"  class="btn btn-primary">Envoyer sms</a>






                            <a href="./calc/calc.php" class="btn btn-primary"><span class="icon">
					
                    <i class="fa fa-calculator" aria-hidden="true"></i>
                        
                    </span>
                        <!-- <span class="title">Calculatrice </span> -->
                
                    </a>



                        </form>
                    </div>
                </div>
        </div>





        <!-- $$$$$$$$$$$$$$$$$$$$$$fin recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->


        <div id="pagination">

            <!-- < ?php
            for ($i = 1; $i <= $nbr_de_pages; $i++) {
                if ($page != $i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
                else echo "<a class='btn btn-success'>$i</a>&nbsp";
            }
            ?> -->
            <br><br>
            <div class="table-responsive">


                <table class="table tab table-striped table-responsive ">
                    <thead class="table">
                        <th class="table-primary">ID</th>
                        <th class="table-primary">Date</th>
                        <th class="table-primary">Imprimé</th>
                        <!-- <th>Prix</th> -->
                        <th class="table-primary">Id Client</th>
                        <th class="table-primary">Client</th>
                        <th class="table-primary">Type</th>
                        <th class="table-primary">Etapes</th>
                        <th class="table-primary">Id Matiere</th>
                        <th class="table-primary">Matiere</th>
                        <!-- <th class="table-primary">Gr</th>
                    <th class="table-primary">Format finie</th>
                    <th class="table-primary">Format tirage</th>
                    <th class="table-primary">Nbre poses</th> -->
                        <th class="table-primary">Unite de mesure</th>



                        <!-- <th>Actif</th> -->
                        <th class="table-primary">Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        //foreach($result as $imprime){
                        //for($i=$debut;$i<=$nbr_de_pages+$debut ; $i++)
                        for ($i = $debut; $i <= $nbr_element_page - 1 + $debut; $i++) {
                            if (@$result[$i] == null) break;
                        ?>
                            <tr>
                                <td class="table-warning"><?= $result[$i]['id'] ?></td>
                                <td class="table-primary"><?= $result[$i]['dates'] ?></td>
                                <td class="table-primary"><?= $result[$i]['imprime'] ?></td>

                                <td class="table-danger"><?= $result[$i]['idclient'] ?></td>
                                <td class="table-danger"><?= $result[$i]['impclient']  ?></td>
                                <td class="table-danger"><?= $result[$i]['typ']  ?></td>
                                <td class="table-danger"><?= $result[$i]['etapes']  ?></td>
                                <td class="table-danger"><?= $result[$i]['idmat']  ?></td>
                                <td class="table-danger"><?= $result[$i]['matiere']  ?></td>
                                <!-- <td class="table-danger">< ?= $result[$i]['grammage']  ?></td>
                            <td class="table-danger">< ?= $result[$i]['formatfinie']  ?></td>
                            <td class="table-danger">< ?= $result[$i]['formattirage']  ?></td>
                            <td class="table-danger">< ?= $result[$i]['nbrepose']  ?></td> -->
                                <td class="table-danger"><?= $result[$i]['unitedemesure']  ?></td>
                                <!-- < ?php foreach($resultclient as $clt){
                                    if ($result[$i]['idclient']==$clt['id']) {
                                        
                                    ?>
                                <td class="table-danger">< ?= $clt['client']  ?>
                                </td>
                                < ?php }} ?> -->

                                <td class="table-primary">
                                    <div class="btn-group btn-group-sm">
                                        <a class="btn btn-primary" href="details.php?id=<?= $result[$i]['id'] ?>">Consulter</a>
                                        <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                            <a class="btn btn-success" href="edit.php?id=<?= $result[$i]['id'] ?>">Modifier</a>
                                            <a class="btn btn-danger" onclick="confirmer(<?= $result[$i]['id'] ?>)">Supprimer</a>
                                            <!-- <a class="btn btn-danger " href="delete.php?id=< ?= $result[$i]['id'] ?>">Supprimer</a> -->
                                            
                                    </div>
                                </td>
                            <?php


                                        } ?>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                </section>
            </div>
    </main>
    <script>
function confirmer(id) {
      //      console.log(etat);
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
    
    document.location.href ='./delete.php?id='+id;
//     })
  

   }
})
}


</script>   
</body>

</html>