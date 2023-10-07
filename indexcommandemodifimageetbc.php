<?php
require_once "const.php";

// $refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
//                              $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// //echo $refreshButtonPressed;
// if ($refreshButtonPressed==1) die();






switch (connection_status()) {
    case CONNECTION_NORMAL:
        $txt = 'Connection OK';
        //$_SESSION['message']=$txt;
        break;
    case CONNECTION_ABORTED:
        $txt = 'Connection aborted';
        $_SESSION['erreur'] = $txt;
        break;
    case CONNECTION_TIMEOUT:
        $txt = 'Connection timed out';
        $_SESSION['erreur'] = $txt;
        break;
    case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
        $txt = 'Connection aborted and timed out';
        $_SESSION['erreur'] = $txt;
        break;
    default:
        $txt = 'Unknown';
        //$_SESSION['erreur']=$txt;
        break;
}
//echo $_SERVER['HTTP_USER_AGENT'];
$browser = @get_browser(null, true);
// echo "<pre>";
// print_r($browser); 
// echo "</pre>";
//   echo $txt;
//checking connection with @fopen
if (@fopen("https://google.com", "r")) {

    // print "You are connected to the internet.";
    //$txt = 'Connection is in a normal state';
    // $_SESSION['message']=$txt;
} else {
    $txt = "Please check your internet connection.";
    $_SESSION['erreur'] = $txt;
}
//echo "<br>";
//echo 'L adresse IP de l utilisateur est : '.getIp();





// setlocale(LC_TIME, "fr_FR");


//  $premierJour = strftime("%A - %d/%M/%Y", strtotime("this week")); 




//   echo "Premier jour de cette semaine est: ", $premierJour;

//date_default_timezone_set("Africa/Algiers");
// include du qr code
// include('./phpqrcode/qrlib.php'); //On inclut la librairie au projet
// include dur qr code
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
// if (!isset($_SESSION['user'])) 
//     header('Location:login.php');
//     exit();
// }
// @$sel=$_POST["sel"];
// @$valider=$_POST["valider"];
// if (isset($valider)){
//     echo "<p>Vous avez coché les cases suivantes:</p> <br>";
//     echo "<p>".@implode(" - ",$sel)."</p>";
//$_SESSION['recherche']=$recherche="";
// }
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
//$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "" ;


if (isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $_SESSION['recherche'] = $_GET['recherche'];
} else $recherche = $_SESSION['recherche'];
//echo $recherche;echo "<br>";
//$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "q";
//echo $_SESSION['niveau'];
if (isset($_GET['niveau'])) {
    $niveau = $_GET['niveau'];
    $_SESSION['niveau'] = $_GET['niveau'];
} else $niveau = $_SESSION['niveau'];
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
//echo $dat2;echo "<br>";
//                             $_SESSION['dates']=$dat;
//$recherche="";
//echo $_SESSION['recherche'];
//$_SESSION['recherche']=@$recherche;
//echo $recherche;
// if (isset($_POST)) {

//     $_SESSION['recherche']=@$_POST['recherche'];
//     $recherche=$_POST['recherche'];
//     echo $_SESSION['recherche'];
//     echo $recherche;

// }
//$recherche=$_SESSION['recherche'];
//var_dump($recherche);
// initialiser 1ere date de recherche
//$dat = isset($_GET['dates']) ? $_GET['dates'] : "";
//$dat = !empty($_GET['dates']) ? $_GET['dates'] : "";
//echo $dat;
// $dat = isset($_GET['dates']) ? $_GET['dates'] : "";
// echo $dat;
// echo "dat<br>";
// echo $_SESSION['dates']. " session";
// echo "<br>";
// if ($_SESSION['dates']=="" or $dat=="")   {
//                             $dat=date('Y').'-'.date('m').'-'.'01';
//                             $_SESSION['dates']=$dat;
//                             } 
// if ($dat!="") {
//                         $_SESSION['dates']=$_GET['dates'];
//                         $dat=$_GET['dates'];
//                         }
// // $_SESSION['dates'];
// echo $dat;
// echo "dat<br>";
// echo $_SESSION['dates']. " session";
// echo "<br>";
// if ($_SESSION['dates']!="" && $dat=="") {
//     $dat=$_SESSION['dates'];
//     // $_SESSION['dates']=$_GET['dates'];
// } else
// if ($dat=="") { $dat=date('Y').'-'.date('m').'-'.'01';   }
// else
// if (empty($_GET['dates'])) {
//     $dat=$_SESSION['dates'];
//     //$_SESSION['niveau']=$_GET['niveau'];
// }

// echo $dat;echo "dat<br> ";

// echo $_SESSION['dates']." session";
// initialiser 2ere date de recherche






$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : "";
// $dat2 = isset($_GET['dates2']) ? $_GET['dates2'] : "";
// initialiser le niveau du select par defaut "t" Toutes les commandes (sans les proformas)
//$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "0";
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
$_SESSION['valider'] = "non";
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// $nbr_element_page = 50;
// $nbr_de_pages = ceil($compteur / $nbr_element_page);
// $debut = ($page - 1) * $nbr_element_page;
// On inclut la connexion à la base
//if ($idcommande=="") {
require_once('connectcommande.php');

$sql = "select * from commande where id";
// tous les resultats son triés par date 
// tous les resultats where (dates>='$dat' and dates<='$dat2') and
// recherche commande en instances

if ($niveau == "t") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where not (etat like '%6/%') and dates>='$dat' and dates<='$dat2' and
                nomclient like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where not (etat like '%6/%') and dates>='$dat' and 
                nomclient like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
            from commande not (etat like '%6/%') and where dates<='$dat2' and 
            nomclient like  '%$recherche%'  order by dates";
    else $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
    from commande where not (etat like '%6/%') and 
    nomclient like  '%$recherche%'  order by dates";
}



if ($niveau == "q") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
    where nomclient like  '%$recherche%'
    and dates>='$dat' and dates<='$dat2' and not (etat like '%5/Archivée%')   order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
    nomclient like  '%$recherche%' and dates>='$dat' and
   not (etat like '%5/Archivée%')   order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
    nomclient like  '%$recherche%' and dates<='$dat2' and 
   not (etat like '%5/Archivée%')   order by dates";
    else $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
    nomclient like  '%$recherche%' and
   not (etat like '%5/Archivée%')  order by dates";
}
// resultat pour  les commandes archiviés
if ($niveau == "e5") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande 
            where  nomclient like '%$recherche%' and (dates>='$dat' and dates<='$dat2') and etat like  '%5/%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
            where  nomclient like '%$recherche%' and dates>='$dat' and etat like  '%5/%' order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

            where  nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%5/%' order by dates";

    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
    where  nomclient like '%$recherche%' and etat like  '%5/%' order by dates";
}

if ($niveau == "e0") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
            where nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and etat like  '%0/En attente%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
            where nomclient like  '%$recherche%' and dates>='$dat' and etat like  '%0/En attente%' order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
            where nomclient like  '%$recherche%' and dates<='$dat2' and etat like  '%0/En attente%' order by dates";

    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
    where  nomclient like  '%$recherche%' and etat like  '%0/En attente%' order by dates";
}
if ($niveau == "e1") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
            where  nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and etat like  '%1/En cours%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

            where nomclient like '%$recherche%' and dates>='$dat' and etat like  '%1/En cours%' order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

            where nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%1/En cours%' order by dates";

    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    where nomclient like '%$recherche%' and etat like  '%1/En cours%' order by dates";
}
if ($niveau == "e2") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

            where nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and etat like  '%2/Terminé%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

            where nomclient like '%$recherche%' and dates>='$dat' and etat like  '%2/Terminé%' order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
            where nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%2/Terminé%' order by dates";

    else             $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
    where nomclient like '%$recherche%' and etat like  '%2/Terminé%' order by dates";
}
if ($niveau == "e3") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

            where nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and etat like  '%3/Livrée%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

            where nomclient like '%$recherche%' and dates>='$dat' and etat like  '%3/Livrée%' order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
            where nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%3/Livrée%' order by dates";

    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    where nomclient like '%$recherche%' and etat like  '%3/Livrée%' order by dates";
}

// resultat de recherche par dates

// recherche par proforma
if ($niveau == "prof") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
        where nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and etat like  '%6/Proforma%' and nomclient like  '%$recherche%'";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

        where nomclient like '%$recherche%' and dates>='$dat' and etat like  '%6/Proforma%' and nomclient like  '%$recherche%'";

    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

        where nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%6/Proforma%' and nomclient like  '%$recherche%'";

    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

        where nomclient like '%$recherche%' and etat like  '%6/Proforma%' and nomclient like  '%$recherche%'";
}


// recherche par commande annulée
if ($niveau == "a") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where  (etat like '%4/%') and dates>='$dat' and dates<='$dat2' and
                nomclient like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where (etat like '%4/%') and dates>='$dat' and 
                nomclient like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
            from commande  (etat like '%4/%') and where dates<='$dat2' and 
            nomclient like  '%$recherche%'  order by dates";
    else $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
    from commande where  (etat like '%4/%') and 
    nomclient like  '%$recherche%'  order by dates";
}
if ($niveau == "idcl") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  idclient like  '$recherche' order by dates";
}
if ($niveau == "idco") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  id like  '$recherche'";
}
if ($niveau == "idi") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where idimprime like  '$recherche' order by dates";
}
if ($niveau == "p") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  paiement like  '%$recherche%' order by dates";
}
// recherche par imprimé
if ($niveau == "i") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  imprime like  '%$recherche%' order by dates";
}
// if ($niveau == "e0") {
//     $sql = "select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande where  etat like  '%0/En attente%' order by dates";
// }
// if ($niveau == "e1") {
//     $sql = "select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande where  etat like  '%1/En cours%'order by dates";
// }
// if ($niveau == "e2") {
//     $sql = "select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande where  etat like  '%2/Terminé%' order by dates";
// }
// if ($niveau == "e3") {
//     $sql = "select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande where  etat like  '%3/Livrée%' order by dates";
// }
// if ($niveau == "e5") {
//     $sql = "select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande where  etat like  '%5/Archivée%' order by dates";
// }
if ($niveau == "0") {
    //$sql="select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande 
    //where nomclient like  '%$recherche%'";
    $sql = "";
}
if ($niveau == "souf") {
    $sql = "select * from commande where tag like '%11%'  and nomclient like  '%$recherche%' order by dates";
}
if ($niveau == "ins") {
    $sql = "select * from commande where not(tag like '%11%')  and (etat like '%0/%' or etat like '%1/%' or etat like '%2/%') and nomclient like  '%$recherche%' order by dates";
}
// On prépare la requête
if ($sql != "") {
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));;

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($resultcommande);
    // echo "</pre>";
    // die();
    require_once('closecommande.php');
}

// partie countage du nombre de champs ds commande Fin
//} // fin
// else {
//     require_once('connectcommande.php');
//     $sql = 'SELECT * FROM `commande` WHERE `id` = :idcommande;';

//     // On prépare la requête
//     $query = $db->prepare($sql);

//     // On "accroche" les paramètre (id)
//     $query->bindValue(':idcommande', $idcommande, PDO::PARAM_INT);

//     // On exécute la requête
//     $query->execute();

//     // On récupère le produit
//     $resultcommande = array($query->fetch());

//     require_once('closecommande.php');
//     // print_r($resultcommande[0]['etat']);
//     // die();
//         }
if (@$resultcommande != []) {
    $compteur = count($resultcommande);
    $nbr_element_page = 5000000;
    $nbr_de_pages = ceil($compteur / $nbr_element_page);
    $debut = ($page - 1) * $nbr_element_page;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
    <title>Liste des commandes</title>
    <link rel="stylesheet" href="css/normalize.css">


    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/monstyle.css"> -->

    <script src="./js/jquery-3.3.1.js"></script>
    <link rel="icon" href="./images/logo.avif" type="image" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="./css/style41.css">
</head>

<body>
    <!-- <img src="./images/loader.gif" alt="Loading..." />  -->
    <!-- <div class="loader-container">
        <div class="loader"></div>
    </div> -->

    <!-- <embed src="bl/blneio49.pdf" width="800" height="500" type="application/pdf"/>  -->
    <div class="container">
        <?php
        require_once('./navbarok.php') ?>
        <br>
        <h1 class="entete">Liste commandes</h1>
        <br>
        <div class="panel panel-success">
            <h3 id="status"></h3>

            <div class="panel-heading">Recherche de commandes</div>

            <div class="panel-body">
                <form method="get" action="" class="form-inline">
                    <div class="form-group">
                        <!-- < ?php if (
                        $niveau != "e0" && $niveau != "e1" && $niveau != "e2" && $niveau != "e3"
                        && $niveau != "e5" && $niveau != "prof"
                    ) { ?> -->
                        <!-- $_SESSION['recherche'] -->
                        <!-- echo $recherche -->
                        <input type="search" name="recherche" placeholder="rechercher...." value="<?php echo $recherche; ?>" />
                        <!-- < ?php } ?> -->
                        <!-- < ?php if ($niveau == "d") { ?> -->
                        <span style="color:red">Du</span>
                        <label for="date"></label>
                        <input type="date" id="dates" name="dates" value="<?php echo @$dat; ?>" onchange="this.form.submit()" />
                        <span style="color:red">Au</span>
                        <label for="date2"></label>
                        <input type="date" id="dates2" name="dates2" value="<?php echo @$dat2 ?>" onchange="this.form.submit()" />


                        <br>
                        <span style="color:red">Par</span>

                        <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                            <!-- <option  value="0" < ?php if($niveau==="0") echo "selected" ?>>Veuillez selectionner un critère de recherche</option> -->
                            <option value="ins" <?php if ($niveau === "ins")   echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche Commandes en instance</option>

                            <option value="q" <?php if ($niveau === "q")   echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche Commande par client(pas archivés)</option>
                            <option value="t" <?php if ($niveau === "t")   echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Toutes les commandes (sans les proformas)</option>
                            <option value="souf" <?php if ($niveau === "souf")   echo "selected";
                                                    $_SESSION['niveau'] = $niveau; ?>>Commandes non livrés</option>


                            <!-- <option value="d" < ?php if ($niveau === "d")   echo "selected" ?>>Recherche par date</option> -->
                            <option value="i" <?php if ($niveau === "i")   echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche par imprimé</option>
                            <option value="e0" <?php if ($niveau === "e0")  echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche commande en Attente</option>
                            <option value="e1" <?php if ($niveau === "e1")  echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche commande en Cours </option>
                            <option value="e2" <?php if ($niveau === "e2")  echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche commande Terminé </option>
                            <option value="e3" <?php if ($niveau === "e3")  echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche commande Livrée </option>
                            <option value="e5" <?php if ($niveau === "e5")   echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche commande archivée</option>
                            <option value="idcl" <?php if ($niveau === "idcl")   echo "selected";
                                                    $_SESSION['niveau'] = $niveau; ?>>Recherche par Id client</option>
                            <option value="idco" <?php if ($niveau === "idco")   echo "selected";
                                                    $_SESSION['niveau'] = $niveau; ?>>Recherche Id Commande</option>
                            <option value="idi" <?php if ($niveau === "idi")   echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche Id Imprimé</option>
                            <option value="p" <?php if ($niveau === "p") echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche par Etat Paiement</option>
                            <option value="prof" <?php if ($niveau === "prof") echo "selected";
                                                    $_SESSION['niveau'] = $niveau; ?>>Recherche par Proforma</option>
                            <option value="a" <?php if ($niveau === "a") echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Recherche par commande annulée</option>
                            <!-- < ?php if ($niveau === "prof")   { ?>
                                                        <option value="prof"  < ?php echo "selected"; ?>>Recherche par Proforma
                                                    
                        </option> -->
                            <!-- <input type="text" name="recherche" placeholder="rechercher" value="< ?php echo @$recherche ?>" /> -->

                            <!-- < ?php } ?> -->
                        </select>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Chercher.....</button>
                </form>
            </div>
        </div>
        <!-- </div> -->
        <!-- $$$$$$$$$$$$$$$$$$$$$$fin recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
        <div id="pagination">
            <!-- < ?php
            for($i=1;$i<=$nbr_de_pages ; $i++){
            if ($page!=$i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
            else echo "<a class='btn btn-success'>$i</a>&nbsp";
                        }
            ?> -->
        </div>

        <form name="fo1" method="post" action="actionselectiontest.php">
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN') { ?>

                <a href="./addproduction.php" class="btn btn-primary">+ Production</a>
                <a href="./formcommande.php" class="btn btn-primary">+ Commande</a>
                <a href="./addclient.php" class="btn btn-primary">+ Client</a>
                <a href="./add.php" class="btn btn-primary">+ Imprime</a>
                <a href="tel:+213541035548" class="btn btn-primary">Appeler</a>
                <a href="sms:+213541035548" class="btn btn-primary">Envoyer sms</a>
                <br><br>
                <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                    <span class="fa fa-arrow-down"></span>Valider .....</button>
                <br><br>

            <?php  }      ?>
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN2') { ?>

                <!-- <a href="./addproduction.php"  class="btn btn-primary">+ Production</a> -->
                <a href="./formcommande.php" class="btn btn-primary">+ Commande</a>
                <a href="./addclient.php" class="btn btn-primary">+ Client</a>
                <a href="./add.php" class="btn btn-primary">+ Imprime</a>
                <a href="tel:+213541035548" class="btn btn-primary">Appeler</a>
                <a href="sms:+213541035548" class="btn btn-primary">Envoyer sms</a>
                <br><br>
                <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                    <span class="fa fa-arrow-down"></span>Valider .....</button>
                <br><br>

            <?php  }      ?>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste de commandes (<?= @$compteur ?>)
                    <!-- <input name='seltous' type="checkbox" value='seltous'> -->
                </div>
                <input type="text" id="listedate1" name="listedate1" value="<?php echo $dat ?>" placeholder="<?php echo $dat ?>" hidden>
                <input type="text" id="listedate2" name="listedate2" value="<?php echo $dat2 ?>" placeholder="<?php echo $dat2 ?>" hidden>
                <input type="text" id="recherche" name="recherche" value="<?php echo $recherche ?>" placeholder="<?php echo $recherche ?>" hidden>
                <input type="text" id="niveau" name="niveau" value="<?php echo $niveau ?>" placeholder="<?php echo $niveau ?>" hidden>


                <div class="table-responsive">
                    <table class="table tab table-striped table-responsive ">
                        <thead class="table">
                            <th>
                                <input id="seltous" name='seltous' type="checkbox" value='seltous' onclick="myfunction()">
                                <span class="fa fa-arrow-down"></span>



                            </th>
                            <th>ID</th>
                            <th class="table-primary">Date</th>
                            <th class="table-primary">ID client</th>
                            <th class="table-primary">client</th>
                            <th class="table-primary">ID impri</th>
                            <th class="table-primary">impr</th>
                            <th class="table-primary">qte</th>
                            <?php
                            if ($_SESSION['user']['role'] == 'ADMIN') {
                            ?>
                                <th class="table-primary">prix</th>
                                <!-- <th class="table-primary">prpress</th> -->
                                <th class="table-primary">total</th>
                            <?php
                            } ?>
                            <!-- <th class="table-primary">remarque</th> -->
                            <th class="table-primary">etat</th>
                            <?php
                            if ($_SESSION['user']['role'] == 'ADMIN') {
                            ?>
                                <th class="table-primary">Paiem</th>
                            <?php } ?>
                            <th class="table-primary" style="color:green;font-weight:bold">Imprimé</th>
                            <th class="table-primary" style="color:green;font-weight:bold">Bon de Comm</th>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') {
                            ?>
                                <th class="table-primary">Solde</th>
                            <?php } else { ?>
                                <th class="table-primar"></th>
                            <?php } ?>
                            <th class="table-primary">Tag</th>
                            <!-- <th class="table-primary">Qr code</th> -->
                            <th class="table-primary">Action</th>
                            <!-- </div> -->
                        </thead>
                        <tbody>
                            <?php
                            $total1 = 0;
                            $totalqte = 0;
                            $jours = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
                            //$nombrecommandes=0;
                            // On boucle sur la variable result
                            // echo "<pre>";
                            // print_r($resultcommande);
                            // echo "</pre>";
                            // echo $resultcommande[0]['id'];
                            // echo $resultcommande[0]['dates'];
                            //die();
                            // foreach($resultcommande as $commande)
                            // if (isset($resultcommande))
                            if (@$resultcommande != null)
                                for ($i = 0; $i <= count(@$resultcommande) - 1; $i++) {
                                    // if ($resultcommande[$i]['tag']!=11 or $niveau === "souf") 
                                    // {
                                    // if (@$resultcommande[$i] == null) break;
                                    @$etatcolor[0] = explode("/", @$resultcommande[$i]['etat']);


                            ?>


                                <!-- for ($i = @$debut; $i <= @$nbr_element_page - 1 + @$debut; $i++) {
                            if (@$resultcommande[$i] == null) break; ?> -->
                                <tr>
                                    <td class="table-primary">

                                        <input id="sel" name='sel[]' type="checkbox" value=<?php echo $resultcommande[$i]['id'];
                                                                                            if (isset($sel)) {
                                                                                                if (@in_array($resultcommande[$i]['id'], @$sel)) echo "checked";
                                                                                            } ?>>

                                    </td>

                                    <td class="table-primary"><?= $resultcommande[$i]['id'] ?></td>

                                    <!-- echo date('D', strtotime("20-02-2009")); -->
                                    <?php
                                    // $jours = Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

                                    $time = $resultcommande[$i]['dates'];

                                    $numJour = date('w', strtotime($time));
                                    $jour = $jours[$numJour];
                                    $datefr = date('d m Y', strtotime($time));
                                    //echo"$jour";
                                    ?>

                                    <td class="table-success"><?= $jour . ' ' . $datefr ?></td>
                                    <td class="table-primary"><?= $resultcommande[$i]['idclient'] ?></td>
                                    <td class="table-info" style="background-color:blue;color:white"><?= $resultcommande[$i]['nomclient'] ?></td>
                                    <td class="table-primary"><?= $resultcommande[$i]['idimprime'] ?></td>
                                    <td class="table-warning"><?= $resultcommande[$i]['imprime'] ?></td>

                                    <td class="table-primary" style="background-color:blue;color:white"><?= $resultcommande[$i]['quantite'] ?></td>
                                    <?php
                                    if ($_SESSION['user']['role'] == 'ADMIN') {
                                    ?>
                                        <td class="table-primary"><?= number_format($resultcommande[$i]['prix'], 2, ".", ".") ?></td>
                                        <!-- <td class="table-primary">< ?= $resultcommande[$i]['prepress'] ?></td> -->
                                        <td class="table-danger" style="background-color:blue;color:white"><?= number_format($resultcommande[$i]['total'], 2, ".", ".") ?></td>
                                    <?php } ?>
                                    <!-- <td class="table-primary">< ?= $resultcommande[$i]['remarque'] ?></td> -->
                                    <td class="table-primary">
                                        <?php

                                        //print_r($etatcolor[0][0]);
                                        // die();
                                        if ($etatcolor[0][0] == 0)
                                            echo "<span style='background-color:blue;color:red;font-weight:bold'>" . $resultcommande[$i]['etat'] . "</span>";
                                        if ($etatcolor[0][0] == 1)
                                            echo "<span style='background-color:blue;color:white;font-weight:bold'>" . $resultcommande[$i]['etat'] . "</span>";

                                        if ($etatcolor[0][0] == 2)
                                            echo "<span style='background-color:green;color:black;font-weight:bold'>" . $resultcommande[$i]['etat'] . "</span>";

                                        // if ($_SESSION['user']['role'] == 'ADMIN') {

                                        if ($etatcolor[0][0] == 3)
                                            echo "<span style='background-color:cyan;color:black;font-weight:bold'>" . $resultcommande[$i]['etat'] . "</span>";
                                        if ($etatcolor[0][0] == 4)
                                            echo "<span style='background-color:red;color:black;font-weight:bold'>" . $resultcommande[$i]['etat'] . "</span>";
                                        if ($etatcolor[0][0] == 5)
                                            echo "<span style='background-color:pink;color:black;font-weight:bold'>" . $resultcommande[$i]['etat'] . "</span>";
                                        if ($etatcolor[0][0] == 6)
                                            echo "<span style='color:blue;font-weight:bold'>" . $resultcommande[$i]['etat'] . "</span>";

                                        // $resultcommande[$i]['etat']
                                        ?>
                                        <!-- <span style="background-color:yellow;color:black;font-weight:bold" > -->
                                        <!-- < ?= $resultcommande[$i]['etat'] ?> -->

                                    </td>
                                    <?php
                                    if ($_SESSION['user']['role'] == 'ADMIN') {
                                        // if ($etatcolor[0][0] != 6) {
                                        // 
                                    ?>
                                        <td class="table-primary"><span style="background-color:red;color:black;font-weight:bold"><?= $resultcommande[$i]['paiement'] ?></td>
                                        <!-- < ?php } else ?>  -->
                                    <?php      }   ?>
                                    <!-- <td class="table-success"> 
                                                    <img  src="./uploads/66-30--15-08-2022 17.png" alt="logo global2pub" width="90" height="auto">
                                                    </td> -->


                                    <td>
                                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                                        <!-- $$$$$$$$$$$Partie qrcode debut $$$$$$$$$$$$ -->
                                        <!-- < ?php


                               
                               
                                    
                                    //set it to writable location, a place for temp generated PNG files
                                    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
                                    
                                    //html PNG location prefix
                                    $PNG_WEB_DIR = 'temp/';

                                    // include "qrlib.php";    
                                    $requette=$resultcommande[$i]['id']." ".$resultcommande[$i]['dates']." "
                                    .$resultcommande[$i]['idclient']." ".$resultcommande[$i]['nomclient']." ".
                                    $resultcommande[$i]['idimprime']
                                    ;
                                    //ofcourse we need rights to create temp dir
                                    if (!file_exists($PNG_TEMP_DIR))
                                        mkdir($PNG_TEMP_DIR);
                                    
                                    
                                    $filename = $PNG_TEMP_DIR.'test.png';
                                //processing form input
                                    //remember to sanitize user input in real-life solution !!!
                                    $errorCorrectionLevel = 'L';
                                    // if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
                                    //     $errorCorrectionLevel = $_REQUEST['level'];    

                                    $matrixPointSize = 3;
                                    // if (isset($_REQUEST['size']))
                                    //     $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

                                    $filename = $PNG_TEMP_DIR.'comm'.md5($requette.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
                                        QRcode::png($requette, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

                                echo '<img src="'.$PNG_WEB_DIR.basename($filename).'"';  
                                // $lien='https://global2-pub.com'; // Vous pouvez modifier le lien selon vos besoins
                                // QRcode::png($lien, 'qrcodecommande1.png'); // On crée notre QR Code
                                // echo "<h1>Qr code généré</h1>"

                                ?> -->





                                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                                        <!-- $$$$$$$$$$$Partie qrcode fin $$$$$$$$$$$$ -->
                                        <!-- <img src="./qrcodecommande1.png" width="50" height="auto" alt=""> -->
                                        <!-- </td> -->
                                        <!-- <img src="uploads/< ?=$resultcommande[$i]['images']?>" width="50" height="auto" alt=""> -->
                                        <?php

                                        if ($resultcommande[$i]['images'] != "") {
                                            // $size = getimagesize('uploads/'.$resultcommande[$i]['images']); 
                                            // $lar=$size[0];
                                            // $hau=$size[1];
                                            //print_r($size);
                                            //echo($lar.' '.$hau);
                                            //$larimage='100';
                                        ?>
                                            <!-- echo '<img src="'.'uploads/'.$resultcommande[$i]['images'].'"  width="25" height="auto">' ? > -->

                                            <!-- < ?php echo "./uploads/".$resultcommande[$i]['images']?> -->

                                            <!-- <input   id="nomimage" value="< ?php echo $i ; ?>"/> -->
                                            <!-- <a id="nomimage" href='./uploads/< ?=$resultcommande[$i]['images'] ?>'  >  -->
                                            <?php
                                            $extension = substr($resultcommande[$i]['images'], strrpos($resultcommande[$i]['images'], "."));
                                            // echo $extension;
                                            // die();
                                            if ($extension != ".pdf") { ?>
                                                <a id="nomimage" href='afficherimage.php?image=<?= $resultcommande[$i]['images'] ?>'>
                                                    <?php echo '<img src="' . 'uploads/' . $resultcommande[$i]['images'] . '"  width="100" height="auto">' ?>
                                                </a>
                                            <?php } else { ?>
                                                <a id="nomimage" href="afficherbc.php?bc=<?= $resultcommande[$i]['images'] ?>">
                                                    <span style='font-size:100px;color:red'><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                                            <?php }
                                        } ?>



                                    </td>
                                    <td>
                                        <?php

                                        if ($resultcommande[$i]['bc'] != "") {
                                            // $size = getimagesize('uploads/'.$resultcommande[$i]['images']); 
                                            // $lar=$size[0];
                                            // $hau=$size[1];
                                            //print_r($size);
                                            //echo($lar.' '.$hau);
                                            //$larimage='100';
                                        ?>
                                            <!-- echo '<img src="'.'uploads/'.$resultcommande[$i]['images'].'"  width="25" height="auto">' ? > -->

                                            <!-- < ?php echo "./uploads/".$resultcommande[$i]['images']?> -->

                                            <!-- <input   id="nomimage" value="< ?php echo $i ; ?>"/> -->
                                            <!-- <a id="nomimage" href='./uploads/< ?=$resultcommande[$i]['images'] ?>'  >  -->
                                            <a id="nomimage" href="afficherbc.php?bc=<?= $resultcommande[$i]['bc'] ?>">
                                                <span style='color:black;font-weight:bold'>Bc</span>
                                                <!-- <a id="nomimage" href="https://global2-pub.com/gtv26/uploads/< ?=$resultcommande[$i]['bc'] ?>"  >  -->
                                                <!-- <span style='color:black;font-weight:bold'>Bon de comm</span> -->
                                                <!-- <img src="'.'uploads/'.< ?=$resultcommande[$i]['bc']?>.'"  width="50" height="auto"> -->
                                            </a>
                                        <?php } ?>
                                        <!-- <embed src="bl/blneio49.pdf" width="800" height="500" type="application/pdf"/> -->
                                        <!-- '<img src="'.'uploads/'.$resultcommande[$i]['bc'].'"  width="50" height="auto">' -->
                                        <!-- <embed src="bl/blneio49.pdf" width="800" height="500" type="application/pdf"/>  -->
                                        <!-- uploads/< ?=$resultcommande[$i]['bc']?> -->
                                    </td>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                        <th class="table-primary"><?= $resultcommande[$i]['solde'] ?></th>
                                    <?php } else  ?> <th class="table-primary"></th>
                                    <th class="table-primary"><?= $resultcommande[$i]['tag'] ?></th>
                                    <td>

                                        <!-- <a class="btn btn-primary btn-sm btn-primary" 
                                    href="action2ok.php?id=< ?= $resultcommande[$i]['id'] ?>&page=< ?= $page ?>&etat=< ?=
                                    $resultcommande[$i]['etat'] ?>&idclient=< ?= $resultcommande[$i]['idclient'] ?>">Action</a> -->
                                        <?php
                                        $etatsuivi = explode("/", $resultcommande[$i]['etat']);
                                        $etatsuivi = $etatsuivi[0]; ?>
                                        <a class="btn btn-primary btn-sm btn-primary" href="./action2ok.php?id=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&etat=<?=
                                                                                                                                                                                                        $etatsuivi ?>&page=<?= $page ?>">Action</a>


                                        <!-- <a class="btn btn-primary btn-sm btn-success" 
                                    href="addproduction.php?id=< ?= $resultcommande[$i]['id'] ?>&page=< ?= $page ?>&etat=< ?=
                                    $resultcommande[$i]['etat'] ? >&idclient=< ?= $resultcommande[$i]['idclient'] ?>">+Prod</a> -->

                                        <a class="btn btn-primary btn-sm btn-success" href="production.php?id=<?= $resultcommande[$i]['id'] ?>&page=<?= $page ?>&etat=<?=
                                                                                                                                                                        $resultcommande[$i]['etat'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&niveau1=t">Prod</a>
                                        </a>
                                        <a class="btn btn-primary btn-sm btn-danger" href="etatproduction.php?recherche=&niveau=ins&idcommande=<?= $resultcommande[$i]['id'] ?>">Fiche Prod</a>

                                        <a class="btn btn-primary btn-sm btn-info" href="telechargerimage.php?idcommande=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&nomclient=<?= $resultcommande[$i]['nomclient'] ?>&imprime=<?= $resultcommande[$i]['imprime'] ?>&idimprime=<?= $resultcommande[$i]['idimprime'] ?>">+Image</a>
                                    </td>


                                    </td>




                                </tr>

                            <?php
                                    $total1 += $resultcommande[$i]['total'];
                                    $totalqte += $resultcommande[$i]['quantite'];
                                    //$nombrecommandes+=1;
                                    // }
                                } // fin di for
                            ?>
                            <td class="table-primary">Total en DZ</td>
                            <td class="table-danger"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <!-- <td class="table-primary"></td>
                                    <td class="table-primary"></td> -->
                            <!-- <td class="table-primary"></td> -->
                            <!-- <td class="table-primary"></td> -->
                            <?php
                            if ($_SESSION['user']['role'] == 'ADMIN') {
                                if ($niveau === "i") { ?>

                                    <td class="table-success"><?= number_format($totalqte, 0, ".", ".") ?></td>

                                <?php } ?>
                                <td class="table-primary"></td>
                                <td class="table-primary"></td>
                                <td class="table-success"><?= number_format($total1, 2, ".", ".") ?></td>
                            <?php }
                            ?>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>

                            <td class="table-primary"></td>
                            <td class="table-primary"></td>

                            <td class="table-primary"></td>
                            <td class="table-primary"></td>

                        </tbody>

                    </table>

                </div>

            </div>
            <!-- <div class="container">
                            
        </div> -->
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN' && @$compteur > 5) { ?>
                <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                    <span class="fa fa-arrow-down"></span>
                    Valider .....
                </button>
            <?php } ?>
        </form>

        <!-- <input   id="nomimage" value="< ?php echo rand() ; ?>"/>
    <a href=""    onclick="modaleimage();return false;"> 
                                    < ?php echo '<img src="'.'uploads/'.$resultcommande[0]['images'].'"  width="50" height="auto">' ?>
                                    </a>  -->
        <!-- <a href="addcommande.php" class="btn btn-primary">Ajouter une commande</a> -->

        <!-- < ?php
                        for($i=1;$i<=$nbr_de_pages ; $i++){
                            if ($page!=$i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
                            else echo "<a class='btn btn-success'>$i</a>&nbsp";
                        }
                        ?>        -->
        <!-- </div>

            </div> -->
        <!-- <script src="sweetalert2.all.min.js"></script> -->

        <!-- <script>
        // Swal.fire('Any fool can use a computer');
        Swal.fire(
  'Bienvenue!',
  'à vous cher ami!',
  'success'
)
</script> -->
        <script>
            function myfunction() {
                var sel = document.querySelectorAll('#sel');
                console.log(sel.length);
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

            function modaleimage() {
                let nom = document.getElementById('nomimage').innerHTML;
                console.log(nom);
                Swal.fire({
                    title: 'Votre Modele!',
                    text: nom,
                    imageUrl: '',
                    imageWidth: 600,
                    imageHeight: 400,
                    imageAlt: 'Custom image',
                })

            }


            window.addEventListener("load", (event) => {
                const statusDisplay = document.getElementById("status");
                statusDisplay.textContent = navigator.onLine ? "Online" : "OFFline";
            });
            window.addEventListener("offline", (event) => {
                const statusDisplay = document.getElementById("status");
                statusDisplay.textContent = "OFFline";
            });

            window.addEventListener("online", (event) => {
                const statusDisplay = document.getElementById("status");
                statusDisplay.textContent = "Online";
            });
        </script>


        <!-- <script src="./js/script.js"  ></script>            -->
    </div>
    <!-- //fin du div de container1              -->
</body>

</html>