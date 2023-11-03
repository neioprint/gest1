<?php
// les constantes 
// require 'vendor/autoload.php';
require_once "const.php";
$modesimplifieadmin = 1;
//$resultcommande[0]['tag'] = 1;
function appelimprime()
{
    require('./connect.php');
    $sql = "SELECT * FROM `imprimes` WHERE `id`=363";

    //$sql = "SELECT * FROM `imprimes` ";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif 
    $result = $query->fetch(PDO::FETCH_ASSOC);
    // echo "<br>";
    // echo "<br>";
    //  echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    // echo "<br>";
    require_once('./close.php');
    $typ = @$result['typ'];
    $chaine = @$result['etapes'];
    $chainedecoupe = explode(",", $chaine);
    $typdecoupe = explode(",", $typ);
    $compt = count($chainedecoupe);
    $compt0 = count($typdecoupe);
    @$formatfinie = $result['formatfinie']; //


    // echo "</pre>";
    // echo "<br>";
    // echo "<pre>";
    // print_r($typdecoupe);
    // echo "<br>";
    // print_r($chainedecoupe);
    // echo "<br>";
    // print_r($formatfinie);
    // echo "<br>";
    // print_r($compt);
    // echo "<br>";
    // print_r($compt0);

    //    echo "</pre>";
    $carnet = $typdecoupe[0];
    @$exemplaire = explode(' ', $typdecoupe[1]);
    $exemplaire = $exemplaire[0];


    $carnet = $typdecoupe[0];
    @$qtecarnet = explode(' ', $typdecoupe[1]); //
    $qtecarnet = $qtecarnet[0];
    @$exemplaire = explode(' ', $typdecoupe[2]); //
    $exemplaire = $exemplaire[0];

    // echo "<br>";
    // print_r($exemplaire);






    //$idcommande =$prod['idcommande']; 

    // $idclient = $prod['idclient'];
    // $idmatiere = $prod['idmatiere'];
    // $qteaconsommer = $prod['qteaconsommer'];
    // // <td class="table-primary"><?= @$prod[$i]['qteaconsommer']*@$prod[$i]['nbreposecoupe'] ? ></td>
    // $formatcoupe = $prod['formatcoupe'];
    // $nbreposecoupe = $prod['nbreposecoupe'];
    // $formatTirage = $prod['formatTirage'];
    // $nbretirage = $qteaconsommer * $nbreposecoupe;
    // $nbreposetirage = $prod['nbreposetirage'];
    // $nbreplaque = $prod['nbreplaque'];
    // $formatchute = $prod['formatchute'];
} // $$$$$$$$$$$$$$

// $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ? : $pageWasRefreshed=0;
// echo $pageWasRefreshed;
// if(!$pageWasRefreshed ) {
//do something because page was refreshed;

// if (isset($_GET['language']) && !empty($_GET['language']))  {
//     if($_GET['language']=="FR") $_SESSION['language']="AR"; else 
//     if ($_GET['language']=="AR") $_SESSION['language']="FR";

// }
// }
if (!empty($_SESSION['message'])) { ?>
     
                                                                                                                                                                                                                                                                        <!-- //  echo "<div class='alert alert-success alert-dismissible'>

    //  <button type='button' class='btn-close' data-dismiss='alert'>&times;</button>
    //          " . $_SESSION['message'] . "
    //      </div>";  -->
        
                                                                                                                                                                                                                                                                              <!-- <div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        < ?=$_SESSION['message']?>
      </div>   -->
                                                                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                                                                    $messageJson = json_encode($_SESSION['message']);
                                                                                                                                                                                                                                                                    ?>
                                                                                                                                                                                                                                                                     <script>
                                                                                                                                                                                                                                                                     let message=JSON.parse('<?php echo $messageJson; ?>');
                                                                                                                                                                                                                                                                     travail(message)
                                                                                                                                                                                                                                                                     </script> 
                                                                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                                                                    $_SESSION['message'] = "";

}

if (!empty($_SESSION['erreur'])) { ?>

                                                                                                                                                                                                                                                                        <!-- // echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    // <button type="button" class="btn-close" data-dismiss="alert">&times;</button>
    //         ' . $_SESSION['erreur'] . '
    //     </div>'; -->
                                                                                                                                                                                                                                                                         <!-- <div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        < ?=$_SESSION['erreur']?>
      </div>   -->
                                                                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                                                                    $messageJson = json_encode($_SESSION['erreur']); ?>
                                                                                                                                                                                                                                                                    <script>
                                                                                                                                                                                                                                                                        let message=JSON.parse('<?php echo $messageJson; ?>');
                                                                                                                                                                                                                                                                                probtravail(message)
                                                                                                                                                                                                                                                                                </script>`; 
                                                                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                                                                    $_SESSION['erreur'] = "";

}
//print_r($_SESSION["erreur"]);
//print_r($_SESSION);
// $_SESSION["erreur"] = " Commande inexiste!";
//die();
// $refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
//                              $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// //echo $refreshButtonPressed;
// if ($refreshButtonPressed==1) die();






// switch (connection_status()) {
//     case CONNECTION_NORMAL:
//         $txt = 'Connection OK';
//         //$_SESSION['message']=$txt;
//         break;
//     case CONNECTION_ABORTED:
//         $txt = 'Connection aborted';
//         $_SESSION['erreur'] = $txt;
//         break;
//     case CONNECTION_TIMEOUT:
//         $txt = 'Connection timed out';
//         $_SESSION['erreur'] = $txt;
//         break;
//     case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
//         $txt = 'Connection aborted and timed out';
//         $_SESSION['erreur'] = $txt;
//         break;
//     default:
//         $txt = 'Unknown';
//         //$_SESSION['erreur']=$txt;
//         break;
// }

//echo $_SERVER['HTTP_USER_AGENT'];

// $browser = @get_browser(null, true);
// echo "<pre>";
// print_r($browser); 
// echo "</pre>";
//   echo $txt;
//checking connection with @fopen
// if (@fopen("https://google.com", "r")) {

//     // print "You are connected to the internet.";
//     //$txt = 'Connection is in a normal state';
//     // $_SESSION['message']=$txt;
// } else {
//     $txt = "Veuillez vérifier votre internet connection.";
//     $_SESSION['erreur'] = $txt;
// }




//echo "<br>";
//echo 'L adresse IP de l utilisateur est : '.getIp();





// setlocale(LC_TIME, "fr_FR");


//  $premierJour = strftime("%A - %d/%M/%Y", strtotime("this week")); 




//   echo "Premier jour de cette semaine est: ", $premierJour;

//date_default_timezone_set("Africa/Algiers");
// include du qr code
// include('./phpqrcode/qrlib.php'); //On inclut la librairie au projet
// include dur qr code

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

//if (!isset($picture)) $picture=1; else $picture=$_SESSION['picture'];
//$picture=$_GET['picture'];
//print_r($picture);

if (isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $_SESSION['recherche'] = $_GET['recherche'];
} else
    $recherche = $_SESSION['recherche'];
//echo $recherche;echo "<br>";
//$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "q";
//echo $_SESSION['niveau'];
if (isset($_GET['niveau'])) {
    $niveau = $_GET['niveau'];
    $_SESSION['niveau'] = $_GET['niveau'];
} else
    $niveau = $_SESSION['niveau'];
//echo $niveau;echo "<br>";
if (isset($_GET['dates'])) {
    $dat = $_GET['dates'];
    $_SESSION['dates'] = $_GET['dates'];
} else
    $dat = $_SESSION['dates'];

if ($dat == "") {
    $dat = date('Y') . '-' . date('m') . '-' . '01';
}
//echo $dat;echo "<br>";


if (isset($_GET['dates2'])) {
    $dat2 = $_GET['dates2'];
    $_SESSION['dates2'] = $_GET['dates2'];
} else
    $dat2 = $_SESSION['dates2'];
$datexx = date('Y') . '-' . date('m') . '-' . date('d');
if ($dat2 == "") {
    //$dat2=date('Y').'-'.date('m').'-'.'01';
    $dat2 = date('Y') . '-' . date('m') . '-' . date('d');
    //$datexx = date('Y') . '-' . date('m') . '-' . date('d');
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
//if ($idcommande!="") $sql = "select * from commande where id=406"; else $sql = "select * from commande where id";
// tous les resultats son triés par date 
// tous les resultats where (dates>='$dat' and dates<='$dat2') and
// recherche commande en instances

if ($niveau == "t") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where   dates>='$dat' and dates<='$dat2' and
                nomclient like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where  dates>='$dat' and 
                nomclient like  '%$recherche%'  order by dates";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
            from commande  where dates<='$dat2' and 
            nomclient like  '%$recherche%'  order by dates";
    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
    from commande where 
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
    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
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
    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
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
    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
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

if ($niveau == "0") {
    //$sql="select *,SUBSTRING(nomclient,1,9) as nomclient,SUBSTRING(imprime,1,12) as imprime from commande 
    //where nomclient like  '%$recherche%'";
    $sql = "";
}
if ($niveau == "souf") {
    $sql = "select * from commande where tag like '%11%'  and nomclient like  '%$recherche%' order by dates";
}


// if ($niveau == "ins") {
//     $sql = "select * from commande where not(tag like '%11%')  
//     and ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%') or (etat like '%6/%'  and dates>='$dat'))  
//     or (nomclient like  '%$recherche%')  order by dates";
// }


if ($niveau == "ins") {
    if ($recherche == "")
        $sql = "select * from commande where  not(tag like '%11111110%') and
   ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%'or etat like '%3/%') or (etat like '%6/%'  and dates>='$dat'))    order by tag";




    if ($recherche != "")
        $sql = "select * from commande where not(tag like '%11111110%')  
     and ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%') or (etat like '%6/%'  and dates>='$dat'))  
        and (nomclient like  '%$recherche%')  order by tag";
}


// if ($niveau == "ins") {
//     if ($recherche == "")
//         $sql = "select * from commande where  not(tag like '%11%') and
//    ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%'or etat like '%3/%') or (etat like '%6/%'  and dates>='$dat'))    order by dates";




//     if ($recherche != "")
//         $sql = "select * from commande where not(tag like '%11%')  
//      and ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%') or (etat like '%6/%'  and dates>='$dat'))  
//         and (nomclient like  '%$recherche%')  order by dates";
// }


// On prépare la requête
if ($sql != "") {
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));
    ;

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
    $nbr_element_page = 50000;
    $nbr_de_pages = ceil($compteur / $nbr_element_page);
    $debut = ($page - 1) * $nbr_element_page;
}

//echo "ok";
// appelimprime();
//  die();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
    <title>Liste  commandes</title>
    <link rel="stylesheet" href="css/normalize.css">
    



    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
   


    <!-- <script src="./js/jquery-3.3.1.js"></script> -->
    <link rel="icon" href="./images/logo2.png" type="image" />

  

    <!-- <link rel="stylesheet" href="./css/styleloader.css"> -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="./css/style41.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

</head>

<body>
    


  
    <div class="container">
 
        <!-- <a href="telecharger.php?fichier=telecharger.php">telecharger</a> -->
        <?php
        require_once('./navbarok.php');
        // require_once('./modal2023.php');
        
        ?>
        
        <br>
        <!-- animate__animated animate__rollIn -->
        <!-- <h1 class="entete " >Liste commandes</h1> -->
        
        <!-- <p class="entete" style="color:yellow;font-size:16px;">< ?= $_SESSION['login'] . " connecté(e)" ?></p> -->
        <br>
        <div class="panel panel-success">

            <h3 id="status"></h3>

            <div class="panel-heading entete">Recherche commandes</div>
          
            <div class="panel-body">
                <form name="fo0" id="fo0" method="get" class="form-inline">
                    <div class="form-group">
                        <!-- < ?php if (
                        $niveau != "e0" && $niveau != "e1" && $niveau != "e2" && $niveau != "e3"
                        && $niveau != "e5" && $niveau != "prof"
                    ) { ?> -->
                        <!-- $_SESSION['recherche'] -->
                        <!-- echo $recherche -->


                        <!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."> -->
                        <span style="color:red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input id="recherche" type="text" name="recherche"  placeholder="rechercher...." value="<?php echo $recherche; ?>" autofocus/>
                        <!-- < ?php } ?> -->
                        <!-- < ?php if ($niveau == "d") { ?> -->
                        <br>
                        <span style="color:red">Du</span>
                        <label for="date"></label>
                        <input type="date" id="dates" name="dates" value="<?php echo @$dat; ?>" onchange="this.form.submit()" />
                        <br>
                        <span style="color:red">Au</span>
                        <label for="date2"></label>
                        <?php if (@$date2 != @$datexx)
                            $date2 = $datexx ?>
                                                                                                                                                                                                                                                                                            <input type="date" id="dates2" name="dates2" value="<?php echo @$dat2 ?>" onchange="this.form.submit()" />


                        <br>
                        <span style="color:red">Par</span>

                        <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                            <!-- <option  value="0" < ?php if($niveau==="0") echo "selected" ?>>Veuillez selectionner un critère de recherche</option> -->
                            <option value="ins" <?php if ($niveau === "ins")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Commandes en instance</option>
                            <option value="prof" <?php if ($niveau === "prof")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Proforma</option>
                            <option value="a" <?php if ($niveau === "a")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>commande annulée</option>
                            <option value="q" <?php if ($niveau === "q")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Commande (-archivés)</option>
                            <option value="t" <?php if ($niveau === "t")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Toutes commandes</option>
                            <option value="souf" <?php if ($niveau === "souf")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Commandes non livrés</option>


                            <!-- <option value="d" < ?php if ($niveau === "d")   echo "selected" ?>>Recherche par date</option> -->
                            <option value="i" <?php if ($niveau === "i")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>> imprimé</option>
                            <option value="e0" <?php if ($niveau === "e0")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>commande en Attente</option>
                            <option value="e1" <?php if ($niveau === "e1")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>commande en Cours </option>
                            <option value="e2" <?php if ($niveau === "e2")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>commande Terminé </option>
                            <option value="e3" <?php if ($niveau === "e3")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>commande Livrée </option>
                            <option value="e5" <?php if ($niveau === "e5")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>commande archivée</option>
                            <option value="idcl" <?php if ($niveau === "idcl")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Commande par Id client</option>
                            <option value="idco" <?php if ($niveau === "idco")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Id Commande</option>
                            <option value="idi" <?php if ($niveau === "idi")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Id Imprimé</option>
                            <option value="p" <?php if ($niveau === "p")
                                echo "selected";
                            $_SESSION['niveau'] = $niveau; ?>>Etat Paiement</option>

                            <!-- < ?php if ($niveau === "prof")   { ?>
                                                        <option value="prof"  < ?php echo "selected"; ?>>Recherche par Proforma
                                                    
                        </option> -->
                            <!-- <input type="text" name="recherche" placeholder="rechercher" value="< ?php echo @$recherche ?>" /> -->

                            <!-- < ?php } ?> -->
                        </select>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Chercher</button>
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

        <form name="fo1" id="fo1" method="post" action="actionselectiontest.php">
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                                                                                                                                                                                                                                                                    <p class="entete" style="color:yellow"><?= $_SESSION['login'] . " connecté(e)" ?></p>

                                                                                                                                                                                                                                                                                    <a href="./addproduction.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Production</a>
                                                                                                                                                                                                                                                                      <!-- <button id="btn-open-modal" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Commandes</button> -->

                                                                                                                                                                                                                                                                                    <a href="./formcommande.php"  class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Commande</a>
                                                                                                                                                                                                                                                                                    <!-- <button id="btn-open-modal">Ouvrir le modal</button> -->
                                                                                                                                                                                                                                                                                    <a href="./addclient.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Client</a>
                                                                                                                                                                                                                                                                                    <a href="./add.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Imprime</a>
                                                                                                                                                                                                                                                                                    <!-- <a href="./proforma.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Proforma</a> -->
           
                                                                                                                                                                                                                                                                                      <a href="tel:+213541035548"  class="btn btn-primary">Appeler</a>
                                                                                                                                                                                                                                                                                                    <a href="sms:+213541035548"  class="btn btn-primary">Envoyer sms</a>


                                                                                                                                                                                                                                                                                    <a href="./calculator/calculator.php" class="btn btn-primary"><span class="icon">

                                                                                                                                                                                                                                                                                            <i class="fa fa-calculator" aria-hidden="true"></i>

                                                                                                                                                                                                                                                                                        </span>
                                                                                                                                                                                                                                                                                        <!-- <span class="title">Calculatrice </span> -->

                                                                                                                                                                                                                                                                                    </a>


                                                                                                                                                                                                                                                                                    <!-- <a href="tel:+213541035548"  class="btn btn-primary"> Appeler</a>
                                <a href="sms:+213541035548"  class="btn btn-primary">Envoyer sms</a> -->
                                                                                                                                                                                                                                                                                    <br><br>
                                                                                                                                                                                                                                                                                    <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                                                                                                                                                                                                                                                                                        <span class="fa fa-sign-in"></span>Valider Selection Commandes</button>
                                                                                                                                                                                                                                                                                    <br><br>

            <?php } ?>
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN2') { ?>

                                                                                                                                                                                                                                                                                    <!-- <a href="./addproduction.php"  class="btn btn-primary">+ Production</a> -->
                                                                                                                                                                                                                                                                                    <a href="./formcommande.php" class="btn btn-primary">+Commande</a>
                                                                                                                                                                                                                                                                                    <a href="./addclient.php" class="btn btn-primary">+Client</a>
                                                                                                                                                                                                                                                                                    <a href="./add.php" class="btn btn-primary">+Imprime</a>
                                                                                                                                                                                                                                                                                    <!-- <a href="tel:+213541035548"  class="btn btn-primary">Appeler</a>
                                <a href="sms:+213541035548"  class="btn btn-primary">Envoyer sms</a> -->
                                                                                                                                                                                                                                                                                    <br><br>
                                                                                                                                                                                                                                                                                    <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                                                                                                                                                                                                                                                                                        <span class="fa fa-sign-in"></span> Valider Selection Commandes</button>
                                                                                                                                                                                                                                                                                    <br><br>

            <?php } ?>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste de commandes (<?= @$compteur ?>)
                    <!-- <input name='seltous' type="checkbox" value='seltous'> -->
                </div>
                <input type="text" id="listedate1" name="listedate1" value="<?php echo $dat ?>" placeholder="<?php echo $dat ?>" hidden>
                <input type="text" id="listedate2" name="listedate2" value="<?php echo $dat2 ?>" placeholder="<?php echo $dat2 ?>" hidden>
                <input type="text" id="recherche" name="recherche" value="<?php echo $recherche ?>" placeholder="<?php echo $recherche ?>" hidden>
                <input type="text" id="niveau" name="niveau" value="<?php echo $niveau ?>" placeholder="<?php echo $niveau ?>" hidden>


                <div class="table-responsive">

                    <table class="mx-auto table tab table-striped table-responsive">
                      
                        <thead class="table">
                            <th>
                                <input id="seltous" name='seltous' type="checkbox" value='seltous' onclick="selection()">
                                <span class="fa fa-arrow-down"></span>



                            </th>
                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                <th>ID Com</th>
                            <?php endif; ?>


                            <th class="table-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-calendar' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i></th>
                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                <th class="table-primary">ID Client</th>
                            <?php endif; ?>
                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                <td class="table-primary"><?= "duree" ?></td>
                            <?php endif; ?>
                            <th class="table-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-user-circle' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i></th>
                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                <th class="table-primary">ID Imp</th>
                            <?php endif; ?>

                            <th class="table-primary">&nbsp; <i class='fa fa-print' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i></th>

                            <th class="table-primary">&nbsp;&nbsp;&nbsp; <i class='fa fa-calculator' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i></th>
                            <?php
                            if ($_SESSION['user']['role'] == 'ADMIN') {
                                ?>
                                                                                                                                                                                                                                                                                                    <th class="table-primary">&nbsp;&nbsp; <i class='fa fa-usd' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i></th>

                                                                                                                                                                                                                                                                                                    <!-- <th class="table-primary">prpress</th> -->
                                                                                                                                                                                                                                                                                                    <th class="table-primary">&nbsp;&nbsp; <i class='fa fa-money' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i></th>
                                                                                                                                                                                                                                                                                                <?php
                            } ?>
                            <!-- <th class="table-primary">remarque</th> -->

                            <th class="table-primary"> <i class='fa fa-sitemap' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i></th>
                            <?php
                            if ($_SESSION['user']['role'] == 'ADMIN') {
                                ?>
                                                                                                                                                                                                                                                                                                    <!-- <th class="table-primary">Paiem</th> -->
                            <?php } ?>

                            <th class="table-primary" style="color:green;font-weight:bold">





                                <!-- <a href="indexcommande.php?picture=2"><i class="fa fa-picture-o" style='font-size:20px;color:blue' aria-hidden="true"></i></a> -->






                            </th>

                            <th class="table-primary" style="color:green;font-weight:bold">
                                <i class='fa fa-address-card' style='font-size:<?= ICONFONT ?>;color:black' aria-hidden='true'></i>
                            </th>

                            <?php if ($_SESSION['user']['role'] == 'ADMIN') {
                                ?>
                                                                                                                                                                                                                                                                                                    <!-- <th class="table-primary">Solde</th> -->
                            <?php } else { ?>
                                                                                                                                                                                                                                                                                                    <th class="table-primary"></th>
                            <?php } ?>

                            <th class="table-primary">
                                <i class="fa fa-tag" style='font-size:<?= ICONFONT ?>;color:blue' aria-hidden="true"></i>
                            </th>
                            <!-- <th class="table-primary">Qr code</th> -->
                            <!-- Cellule actions -->
                            <th class="table-primary">
                            Actions
                                <i class='fa fa-cog' style='font-size:<?= ICONFONT ?>;color:black'  aria-hidden='true'></i>
                                <!-- <i class='fa fa-cog' style='font-size:20px;color:black' aria-hidden='true'></i> -->
                                <!-- <i class='fa fa-cog' style='font-size:20px;color:black'  aria-hidden='true'></i>
                            <i class='fa fa-cog' style='font-size:20px;color:black'  aria-hidden='true'></i>
                            <i class='fa fa-cog' style='font-size:20px;color:black'  aria-hidden='true'></i> -->
                           
                            </th>
                           
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
                                    //print_r($etatcolor);
                                    //die();
                            

                                    ?>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- for ($i = @$debut; $i <= @$nbr_element_page - 1 + @$debut; $i++) {
                            if (@$resultcommande[$i] == null) break; ?> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <tr>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td class="table-primary">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <input id="sel" name='sel[]' type="checkbox" value=<?php echo $resultcommande[$i]['id'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if (isset($sel)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if (@in_array($resultcommande[$i]['id'], @$sel))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="table-primary"><?= $resultcommande[$i]['id'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php endif; ?>
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="table-primary"><?= $resultcommande[$i]['idclient'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php endif; ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- // duree moyenne commande -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php $duree = $resultcommande[$i]['total'] / 10000; ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="table-primary"><?= $duree ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php endif; ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td class="table-info" style="background-color:blue;color:white"><?= $resultcommande[$i]['nomclient'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php if ($modesimplifieadmin == 0): ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="table-primary"><?= $resultcommande[$i]['idimprime'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php endif; ?>
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //$resultcommande[$i]['etat'] .
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($etatcolor[0][0] == 0) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- <span class="fa-stack fa-lg"> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- <i class="fa fa-camera fa-stack-1x"></i>
                                        <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                        </span> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="limite">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <i  class='fa-solid attente fa-fw fa-3x' style='color:red' aria-hidden='true'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <span style='background-color:blue;color:red;font-weight:bold'></span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i class='fa fa-undo' style='font-size:30px;color:blue'  aria-hidden='true'></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- fa-hourglass-start -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php } ?>
                                       
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php if ($etatcolor[0][0] == 1) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i  class='fa  fa-spin fa-3x fa-fw' style='color:blue' aria-hidden='true'> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <i class="fa-solid fa-gear fa-spin fa-3x" style="color: #042662;"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i class="fa-solid fa-gear fa-spin" style="color: #042662;"></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i class="fa-solid fa-gear fa-spin fa-spin fa-3x" style='color:blue'></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i  class='fa fa-cogs fa-spin' style='font-size:30px;color:blue' aria-hidden='true'> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i class="fa fa-shield fa-rotate-90"></i>
                                            <i class="fa fa-shield fa-rotate-180"></i>
                                            <i class="fa fa-shield fa-rotate-270"></i>
                                            <i class="fa fa-shield fa-flip-horizontal"></i>
                                            <i class="fa fa-shield fa-flip-vertical"></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i  class='fa fa-cog fa-spin' style='font-size:30px;color:blue' aria-hidden='true'></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <span style='background-color:blue;color:white;font-weight:bold'></span> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($etatcolor[0][0] == 2 or $etatcolor[0][0] == 11) { ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <i class='fa fa-check-square fa-fw fa-3x' style='color:blue'  aria-hidden='true'></i><span style='background-color:green;color:black;font-weight:bold'></span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // if ($_SESSION['user']['role'] == 'ADMIN') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($etatcolor[0][0] == 3) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <i class="fa-solid fa-truck-front fa-beat fa-fw fa-3x" style='color:Navy'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <i class='fa fa-truck fa-fw' style='font-size:<?= FONTSIZE ?>;color:Navy' aria-hidden='true'></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <span style='color:black;font-weight:bold'>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php } ?>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($etatcolor[0][0] == 4) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- // echo "<i class='fa fa-ban' style='font-size:30px;color: DarkRed'  aria-hidden='true'></i> <span style='background-color:red;color:black;font-weight:bold'>"  . "</span>"; -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class='fa fa-ban fa-fw fa-3x' style='color: DarkRed'  aria-hidden='true'></i> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- <span style='background-color:red;color:black;font-weight:bold'></span> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($etatcolor[0][0] == 5) { ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class='fa fa-archive fa-fw fa-3x' style='color:DarkGreen' aria-hidden='true'></i>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->





                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php } ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($etatcolor[0][0] == 6) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class='fa-solid fa-newspaper fa-fw fa-3x'   aria-hidden='true'></i><span style='color:blue;font-weight:bold'></span>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($etatcolor[0][0] == 12 or $etatcolor[0][0] == 11) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class='fa-solid fa-clock fa-shake fa-fw fa-3x'   aria-hidden='true'></i><span style='color:blue;font-weight:bold'></span>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- <span style="background-color:yellow;color:black;font-weight:bold" > -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- < ?= $resultcommande[$i]['etat'] ?> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php $etatclientdirect = explode("+", $resultcommande[$i]['etat']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $etatclientseq = explode("+", $resultcommande[$i]['etatseq']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if (array_key_exists(1, $etatclientseq))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<span><i class="fa fa-user-circle" style="font-size:30px;color:blue" aria-hidden="true"></i></span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    else
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        if (array_key_exists(1, $etatclientdirect))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo '<span><i class="fa fa-user-circle" style="font-size:30px;color:blue" aria-hidden="true"></i></span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    //$etatclientdirect[1]
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            if ($_SESSION['user']['role'] == 'ADMIN') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // if ($etatcolor[0][0] != 6) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- <td class="table-primary"><span style="background-color:red;color:black;font-weight:bold">< ?= $resultcommande[$i]['paiement'] ?></td> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- < ?php } else ?>  -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php } ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- <td class="table-success"> 
                                                    <img  src="./uploads/66-30--15-08-2022 17.png" alt="logo global2pub" width="90" height="auto">
                                                    </td> -->


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td>





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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- < ?php echo '<img src="'.'uploads/'.$resultcommande[$i]['images'].'"  width="100" height="auto">' ?> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fa fa-picture-o" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php } else { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a id="nomimage" href="afficherbc.php?bc=<?= $resultcommande[$i]['images'] ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class='fa-solid fa-file-pdf' style='font-size:<?= FONTSIZE ?>;color:red'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- <i class="fa fa-file-image-o" aria-hidden="true"></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- <i class="fa fa-picture-o" aria-hidden="true"></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php if ($resultcommande[$i]['bc'] != "") {
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $extension = substr($resultcommande[$i]['bc'], strrpos($resultcommande[$i]['bc'], "."));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        // echo $extension;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        // die();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        if ($extension != ".pdf") { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a id="nomimage" href='afficherimage.php?image=<?= $resultcommande[$i]['bc'] ?>'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- < ?php echo '<img src="'.'uploads/'.$resultcommande[$i]['bc'].'"  width="100" height="auto">' ?> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fa-solid fa-picture-o" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php } else { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a id="nomimage" href="afficherbc.php?bc=<?= $resultcommande[$i]['bc'] ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class='fa-solid fa-file-pdf' style='font-size:<?= FONTSIZE ?>;color:red'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- // tag -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- <th class="table-primary">< ?= $resultcommande[$i]['solde'] ?></th>  -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php } else { ?> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <th class="table-primary"></th> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <th class="table-primary">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo $resultcommande[$i]['tag'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($resultcommande[$i]['tag'] != 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($resultcommande[$i]['tag'] < 11111110)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "<i class='fa fa-tag' style='font-size:30px;color:red'></i>";


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($resultcommande[$i]['tag'] == 11111111)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "<i class='fa fa-tag' style='font-size:30px;color:blue'></i>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($resultcommande[$i]['tag'] == 11111110)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "<i class='fa fa-tag' style='font-size:30px;color:black'></i>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // <?php if ($resultcommande[$i]['tag'] != 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //     if ($resultcommande[$i]['tag'] == 1)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //         echo "<i class='fa fa-tag' style='font-size:30px;color:red'></i>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //     if ($resultcommande[$i]['tag'] == 11)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //         echo "<i class='fa fa-tag' style='font-size:30px;color:blue'></i>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //     if ($resultcommande[$i]['tag'] == 10)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //         echo "<i class='fa fa-tag' style='font-size:30px;color:black'></i>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- <a class="btn btn-primary btn-sm btn-primary" 
                                    href="action2ok.php?id=< ?= $resultcommande[$i]['id'] ?>&page=< ?= $page ?>&etat=< ?=
                                    $resultcommande[$i]['etat'] ?>&idclient=< ?= $resultcommande[$i]['idclient'] ?>">Action</a> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // etat commande
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $etatsuivi = explode("/", $resultcommande[$i]['etat']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $etatsuivi = $etatsuivi[0];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // $etatclientdirect=explode("+", $resultcommande[$i]['etat']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //if (array_key_exists(1, $etatclientdirect)) $etatclientdirect=$etatclientdirect[1];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- lien vers operations sur les documents emis -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- lien vers  les documents emis -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- <a class="btn btn-primary btn-sm btn-warning" href="">
                                        <span class="icon"><i class="fa fa-file-text-o" style='font-size:30px;color:blue' aria-hidden="true"></i></span>
                                       
                                        </a> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="btn btn-primary btn-sm btn-warning"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                href="./action2ok.php?id=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&etat=<?= $etatsuivi ?>&page=<?= $page ?>"><i class="fa fa-wrench" style='font-size:30px;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php if (array_key_exists(1, $etatclientdirect))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $etatclientdirect[1];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if (array_key_exists(1, $etatclientseq))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $etatclientseq[1];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //  print_r( $etatclientseq) 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a class="btn btn-primary" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                onclick="tagger(`<?= $resultcommande[$i]['id'] ?>`,`<?= $resultcommande[$i]['tag'] ?>`,`<?= $i ?>`,`<?= $etatsuivi ?>`)" ><i class='fa fa-tag' style='font-size:30px;color:yellowgreen'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </a>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- <a class="btn btn-primary btn-sm btn-success" 
                                    href="addproduction.php?id=< ?= $resultcommande[$i]['id'] ?>&page=< ?= $page ?>&etat=< ?=
                                    $resultcommande[$i]['etat'] ? >&idclient=< ?= $resultcommande[$i]['idclient'] ?>">+Prod</a> -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- <a class="btn btn-primary btn-sm btn-success" 
                                    href="production.php?id=< ?= $resultcommande[$i]['id'] ?>&page=< ?= $page ?>&etat=< ?=
                                    $resultcommande[$i]['etat'] ?>&idclient=< ?= $resultcommande[$i]['idclient'] ?>&niveau1=t">Prod</a>
                                       </a> -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- debut lien etat productio -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- s'affiche uniquement sir la fiche production existe poiur cette commande -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $idcommande = $resultcommande[$i]['id'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //$_GET['idcommande'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                require('connectproduction.php');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $sql = 'SELECT * FROM `production` WHERE `idcommande` = :idcommande;';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $query = $db->prepare($sql);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $query->bindValue(':idcommande', $idcommande, PDO::PARAM_INT);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // // On exécute la requête
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $query->execute() or die(print_r($db->errorInfo()));

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //On stocke le résultat dans un tableau associatif
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $prod = $query->fetch(PDO::FETCH_ASSOC);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                require('closeproduction.php');


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($prod != "") { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a class="btn btn-primary btn-sm btn-primary" href="etatproduction.php?recherche=&niveau=ins&idcommande=<?= $resultcommande[$i]['id'] ?>"><i class="fa fa-industry" style='font-size:30px;color:blue' aria-hidden="true"></i></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php } else { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a class="btn btn-primary btn-sm btn-primary" data-toggle="tooltip" data-placement="right" title="Pas de fiche production">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- <i class="fa fa-industry" style='font-size:30px;color:blue' aria-hidden="true"></i> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class="fa fa-bug" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!-- <i class="fa fa-industry" style='font-size:30px;color:blue' aria-hidden="true"></i> -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php } ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- fin lien etat productio -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="btn btn-primary btn-sm btn-success" href="telechargerimage.php?idcommande=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&nomclient=<?= $resultcommande[$i]['nomclient'] ?>&imprime=<?= $resultcommande[$i]['imprime'] ?>&idimprime=<?= $resultcommande[$i]['idimprime'] ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fa fa-download" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fa fa-picture-o" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php if ($resultcommande[$i]['images'] != "" or $resultcommande[$i]['bc'] != "") { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a class="btn btn-primary btn-sm btn-danger" href="effacerfichier.php?idcommande=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&nomclient=<?= $resultcommande[$i]['nomclient'] ?>&imprime=<?= $resultcommande[$i]['imprime'] ?>&idimprime=<?= $resultcommande[$i]['idimprime'] ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class="fa fa-trash" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class="fa fa-picture-o" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php } ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php if ($etatcolor[0][0] == 1 or $etatcolor[0][0] == 2 or $etatcolor[0][0] == 3 or $etatcolor[0][0] == 5) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!-- lien vers  les documents emis -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a class="btn btn-primary btn-sm btn-warning" href="documentemis.php?idcommande=<?= $resultcommande[$i]['id'] ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <span class="icon"><i class="fa fa-file-text-o" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i></span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- <span class="title">Documents</span> -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php } else { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <a class="btn btn-primary btn-sm btn-primary"  >
                                              
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <i class="fa fa-file-o" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php }


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //fa-file-o
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <a class="btn btn-primary btn-sm btn-success" href="etatversementcommande.php?idcommande=<?= $resultcommande[$i]['id'] ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <span class="icon"><i class="fa fa-usd" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i></span>
                                        
                                       
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
                            if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                             

                                                                                                                                                                                                                                                                                                <td class="table-success"><?= number_format($totalqte, 0, ".", ".") ?></td>

                              
                                                                                                                                                                                                                                                                                                    <!-- <td class="table-primary"></td>
                                <td class="table-primary"></td> -->
                                                                                                                                                                                                                                                                                                    <td class="table-primary"></td>
                                                                                                                                                                                                                                                                                                    <td class="table-success"><?= number_format($total1, 2, ".", ".") ?></td>
                            <?php }
                            ?>
                             <td class="table-primary"></td>
                             <td class="table-primary"></td>
                             <td class="table-primary"></td>
                             <td class="table-primary"></td>
                             <td class="table-primary"></td>
                            <!-- <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>
                            <td class="table-primary"></td>

                            <td class="table-primary"></td> -->
                            <!-- <td class="table-primary"></td> -->

                            <!-- <td class="table-primary"></td> -->
                            <!-- <td class="table-primary"></td> -->

                        </tbody>

                    </table>

                </div>

            </div>
            <!-- <div class="container">
                            
        </div> -->
            <?php
            if ($_SESSION['user']['role'] == 'ADMIN' && @$compteur > 5) { ?>
                                                                                                                                                                                                                                                                                    <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                                                                                                                                                                                                                                                                                        <span class="fa fa-sign-in"></span>
                                                                                                                                                                                                                                                                                        Valider Selection Commandes
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
            function selection() {
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

            function modaleimage() {
                let nom = document.getElementById('nomimage').innerHTML;
                //console.log(nom);
                Swal.fire({
                    title: 'Votre Modele!',
                    text: nom,
                    imageUrl: '',
                    imageWidth: 600,
                    imageHeight: 400,
                    imageAlt: 'Custom image',
                })

            }


            // window.addEventListener("load", (event) => {
            //     const statusDisplay = document.getElementById("status");
            //     statusDisplay.textContent = navigator.onLine ? "En ligne" : "Hors ligne";
            // });
            // window.addEventListener("offline", (event) => {
            //     const statusDisplay = document.getElementById("status");
            //     statusDisplay.textContent = "Hors ligne";
            // });

            // window.addEventListener("online", (event) => {
            //     const statusDisplay = document.getElementById("status");
            //     statusDisplay.textContent = "En ligne";
            // });
        </script>


<!-- fonction recherche -->
<!-- <script>
function rechercher() {
    var input;

    //soumettre=document.getElementById("fo0").submit();

    //.submit();
    input = document.getElementById("recherche");
    document.getElementById("recherche").focus();

    // console.log(input.value);
    // console.log(soumettre);
  
    //this.form.submit()
    // filter = input.value.toUpperCase();
    // ul = document.getElementById("myUL");
    // li = ul.getElementsByTagName("li");
    // for (i = 0; i < li.length; i++) {
    //     a = li[i].getElementsByTagName("a")[0];
    //     txtValue = a.textContent || a.innerText;
    //     if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //         li[i].style.display = "";
    //     } else {
    //         li[i].style.display = "none";
    //     }
    // }
}
</script> -->
   
     
        <br>
   



    </div>



<br><br>

    <!-- <script src="./js/script.js"></script> -->
<script>
function hourglass() {
  var a;
 
  a = document.querySelectorAll("i.attente");
  //longueur=length.a;
//   console.log(a.length);
//   console.log(a[0]);
 for (let i = 0; i < a.length; i++) {
    // const element = array[i];
    a[i].innerHTML = "&#xf251;";
  setTimeout(function () {
      a[i].innerHTML = "&#xf252;";
    }, 2000);
  setTimeout(function () {
      a[i].innerHTML = "&#xf253;";
    }, 3000);
 }
 
}
    hourglass();
setInterval(hourglass, 5000);
// function hourglass1() {
//   var a;
 
//   a = document.getElementById("attente1");
//   console.log(a);
//   a.innerHTML = "&#xf251;";
//   setTimeout(function () {
//       a.innerHTML = "&#xf252;";
//     }, 1000);
//   setTimeout(function () {
//       a.innerHTML = "&#xf253;";
//     }, 2000);
// }
//     hourglass1();
// setInterval(hourglass1, 3000);



</script>
<script>
function cogs() {
    var a;
 
 a = document.querySelectorAll("i.encours");
 //longueur=length.a;
//   console.log(a.length);
//   console.log(a[0]);
for (let i = 0; i < a.length; i++) {
   // const element = array[i];
   a[i].innerHTML = "&#xf085;";
 setTimeout(function () {
     a[i].innerHTML = "&#xf013;";
   }, 2000);
 setTimeout(function () {
     a[i].innerHTML = "&#xf085;";
   }, 3000);
}

}
cogs();
setInterval(cogs, 3000);







function tagger(id,tag,i,etatsuivi) {
 
            console.log(tag);
          
            console.log(i);
            console.log(id);
            console.log(etatsuivi);
            // mavar=document.getElementById(j).innerHTML;
    
if (tag==0){       
Swal.fire({
    title: `<strong>Menu Tag</strong>`,
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  },
//   text: "Versement",
  icon: 'success',
  html:`
   <h3>  Commande N° ${id}</h3>
   <h4>Ordre N° ${tag} </h4>
  `
  ,
// footer:"Suppression irréversible",
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
   

   
// < ?php $resultcommande[0]['tag'] = 1; ?>
  if (result.isConfirmed) {
   
    if (tag==0)document.location.href = 'tagconsole.php?id='+id+'&tag='+tag+'&etatsuivi='+etatsuivi;
    // Swal.fire(
    //   'Tag commande',
    //   'Votre Tag à été modifié.',
    //   'success'
    // ).then((result) => {
    // //  document.location.href = 'tagconsole.php?id='+id+'&tag='+tag+'&etatsuivi='+etatsuivi;
   
    // })
  

  }
})
//console.log("ok");
// < ?php $resultcommande[0]['tag'] = 1;
// echo $resultcommande[0]['tag'];
// ?>


}


}


// < ?php
// $messageJson = json_encode($_SESSION['message']);
// ?>
                                                                            
                                                                             //let message=JSON.parse('< ?php echo $messageJson; ?>');
                                                                             //travail(message)
                                                                            

</script>
</body>

</html>