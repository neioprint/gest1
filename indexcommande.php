<?php







// if (empty($_COOKIE['PHPSESSID']))
// {
//      $page = "Home";
//      $page->file = '/www/index.html';

//     setcookie(
//         'PHPSESSID', 
//         base64_encode(serialize($page)), 
//         time()+60*60*24, 
//         '/'
//     );
// } 

// $cookie = base64_decode($_COOKIE['PHPSESSID']);
// unserialize($cookie);
//  print_r($_COOKIE);



// die("cookie");
// interdire d'inxlure des iframes
// interdire d'inxlure des iframes
header( 'X-Frame-Options: DENY' );
// interdire d'inxlure des iframes










// function myException($exception) {
  
//     $output=exec("networksetup -getairportnetwork en1");
//     echo "<b>Exception:</b> " . $exception->getMessage();
  
//   }
  
//   set_exception_handler('myException');
  
//   throw new Exception('Uncaught Exception occurred');

// error_reporting(0);
// die();

// Check the current WiFi connection status 
// $output = shell_exec('/System/Library/PrivateFrameworks/Apple80211.framework/Versions/Current/Resources/airport -s
// '); 
// echo "<pre>";
// print_r( $output); 
// echo "</pre>";
 
// Connect to a specific WiFi network 


// [HTTP_SEC_CH_UA_PLATFORM] => "macOS"
// echo $_SERVER['H_PLATFORM'];
$ssid = 'IdoomFibre_ATnMqxa75'; 
// echo "<br>"; 
//  echo "<pre>";
//  print_r($_SERVER);

//  echo "</pre>";
//  echo $_SERVER['HTTP_USER_AGENT'];
//  echo "<br>"; 
//  $position = strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh');
// // $password = 'MXPmwK3R'; 
// echo $position;
// //  $output = shell_exec("networksetup -setairportnetwork en1 IdoomFibre_ATnMqxa75 MXPmwK3R"); 
 
 

//  //$output=exec("echo ok");
 
// //  networksetup -getairportnetwork en1
//         $output=exec("php -v");
//         //If the exception is thrown, this text will not be shown
   
       
  
   
//  print_r($output); 
// if ($output!=null) {
//                 $wifi=explode(': ',$output);
//                 echo "<pre>";
//                 print_r($wifi);
//                 echo "</pre>";
//                 $_SESSION['wifi']=$wifi[1];
//                 $_SESSION['wifiok']=$ssid;
//                     }
                





// networksetup -setairportnetwork en0 <IdoomFibre_ATnMqxa75> <MXPmwK3R>
// phpinfo();
// header('Cache-Control: no-store, private, no-cache, must-revalidate');     // HTTP/1.1
// header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);  // HTTP/1.1
// header('Pragma: public');
// header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');                  // Date in the past  
// header('Expires: 0', false); 
// header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
// header ('Pragma: no-cache');

// $socket = socket_create(AF_INET, SOCK_DGRAM, getprotobyname('udp'));
// socket_set_option($socket, SOL_SOCKET, SO_BROADCAST, true);
// socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec'=> 1, 'usec'=>'0'));
// //socket_set_option($socket, IPPROTO_IP, IP_MULTICAST_IF, "xxxx"); //only if you have multiple network cards
// $data = "M-SEARCH * HTTP/1.1\n".
//         "HOST: 239.255.255.250:1900\n".
//         "MAN: \"ssdp:discover\"\n".
//         "MX: 1\n".
//         "ST: urn:dslforum-org:device:InternetGatewayDevice:1\n\n";
// socket_sendto($socket, $data, strlen($data), 0, "239.255.255.250", "1900");
// socket_recvfrom($socket, $mess, 1024, 0, $ip, $port);
// echo $mess;
// echo $ip;
// socket_close($socket);
// die("arret");
// if (!function_exists('gettext')) {
//     throw new \Exception("L'extension gettext n'est pas active");
// }

// $domain='main';
// $lang='fr_FR';
// bindtextdomain("*", dirname(__FILE__).'/locale');
// //  bindtextdomain($domain,realpath('./').DIRECTORY_SEPARATOR . 'locale');
// // bindtextdomain($domain, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'locale');
// textdomain($domain);
// // if (!setlocale(LC_MESSAGES,'fr_FR')) {
// //     throw new Exception('locale non supprotes: '.$lang);
// // };

// setlocale(LC_MESSAGES,'fr_FR','fr_FR.UTF8');
// setlocale(LC_MESSAGES,'');


// $locale = "fr_FR";

//     if (defined('LC_MESSAGES')) {
//         setlocale(LC_MESSAGES, $locale); // Linux
//         bindtextdomain("messages", "./locale");
//     } else {
//         putenv("LC_ALL={$locale}"); // windows
//         bindtextdomain("messages", ".\locale");
//     }

    
//     textdomain("messages");

//     echo _("Good Morning");

?>
<noscript>
le JavaScript est désactivé.
<!-- veuillez l'activer pour utiliser Gestimprim -->
</noscript>
<!-- <h1>< ?= _('Welcome on my website') ?></h1> -->
<script>
// let preloadVideo = true;
// var connection =
//   navigator.connection || navigator.mozConnection || navigator.webkitConnection;
// if (connection) {
//   if (connection.effectiveType === "cellular") {
//     preloadVideo = false;
//   }
// }
// console.log(connection);



// function mobilecheck() {
//     return (typeof window.orientation !== "undefined") 
//       || (navigator.userAgent.indexOf('IEMobile') !== -1
//       );
// };


// if (mobilecheck()) console.log("vous etes sur mobile"); else console.log("vous etes  sur desktop");


</script>
<div id="status" class="panel-heading entete"></div>
  <!-- <div class="loader-container">
        <div class="loader"></div>
  </div> -->
<?php

require "../const.php";
require "calculdureemoyenne.php";
$modesimplifieadmin = 1;
//  print_r($_SERVER['REQUEST_URI']);
//  echo "<br>";
// $menuactif = $_SERVER['PHP_SELF'];
// $menuactif = str_replace("/gestimprim.com/gestcomm/commande/", "",$menuactif);
// print_r($_SERVER['SERVER_NAME']);


//  print_r($_SERVER['HTTP_HOST']);
//  echo "<br>"; 
//  print_r($_SERVER['QUERY_STRING']);
//  echo "<br>"; 
//  print_r($_SERVER['REQUEST_URI']); 
//  echo "<br>"; 

//  $url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//  echo disk_free_space("/")/1024/1024/1024;
//  echo "<br>"; 
// var_dump($url);
// echo "<br>"; 

//  if (filter_var($url, FILTER_VALIDATE_URL)) {
//     echo("$url is a valid URL");
// } else {
//     echo("$url is not a valid URL");
// }

// echo "<br>"; 
// function url_exists($url_a_tester)
// {
// $F=@fopen($url_a_tester,"r");
// echo $url_a_tester;
// echo "<br>"; 
// var_dump($F);
// if($F)
// {
//  fclose($F);
//  return true;
//  echo "oui";
// }
// else return 
//         false;


// } // fin de la fonction
// print_r(url_exists($url));


//  echo "<br>";
//  echo $_SERVER['PHP_SELF'];



// die();
// function checkWebSite($url)
// {
//     // Vérifiez si l'URL fournie est valide
//     if (!filter_var($url, FILTER_VALIDATE_URL)) {
//         return false;
//     }
//     // Initialiser cURL
//     $ch = curl_init($url);

//     // Définir les options
//     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
//     curl_setopt($ch, CURLOPT_HEADER, true);
//     curl_setopt($ch, CURLOPT_NOBODY, true);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     // Récupérer la réponse
//     $response = curl_exec($ch);

//     // Fermer la session cURL
//     curl_close($ch);
//     return $response ? true : false;
// }
// echo "<br>";
// $url = 'https://gestimprim.com/gesimprim';
// if (checkWebSite($url)) {
//      echo 'Le site est disponible.';
//     //$_SESSION['message'] .= '<br> Le site est disponible.';

//     // echo "<div class='alert alert-success alert-dismissible'>

//     //   <button type='button' class='close' data-dismiss='alert'>&times;</button>
//     //           " . $_SESSION['message'] . "
//     //       </div>";
//     //echo $_SESSION['message'];
// } else {
//     echo "Le site n' est pas disponible";
//     $_SESSION['erreur'] .= '<br> Le site est indisponible.';
//     echo $_SESSION['erreur'];
// }



// die();



if (!empty($_SESSION['message'])) {

    // echo "<div class='alert alert-success alert-dismissible'>

    //   <button type='button' class='close' data-dismiss='alert'>&times;</button>
    //           " . $_SESSION['message'] . "
    //       </div>";

    echo "<div></div>";



    // echo "<div class='alert alert-success alert-dismissible'>
    //     <button type='button' class='btn-close' data-bs-dismiss='alert'></button>"
    //     . $_SESSION['message'] . "
    // </div> ";

    $messageJson = json_encode($_SESSION['message']);
?>

    <script>
        let message = JSON.parse('<?=  $messageJson; ?>');

        travail(message)
    </script>
<?php
    $_SESSION['message'] = "";
}


if (!empty($_SESSION['erreur'])) {

    // echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    //  <button type="button" class="btn-close" data-dismiss="alert">&times;</button>
    //          ' . $_SESSION['erreur'] . '
    //      </div>';

    echo "<div></div>";
    $messageJson = json_encode($_SESSION['erreur']); ?>
    <script>
        let message = JSON.parse('<?= $messageJson; ?>');
        probtravail(message)
    </script>
<?php
    $_SESSION['erreur'] = "";
}





if (!isset($_GET['ignorerdate'])) {
    $_GET['ignorerdate']=0;
                                // if ($_GET['ignorerdate']=="on" or $_GET['ignorerdate']==1) 
                                
                                //$_SESSION['ignorerdate']=0;
                                // else $_SESSION['ignorerdate']=$_GET['ignorerdate'];
                                //  <script>
                                //     console.log(< ?=$_SESSION['ignorerdate']? >)
                                //     var ignorer = document.querySelector('#ignorerdate');
                                //   console.log(ignorer);
              
               
                                //     if (ignorer.checked) valeur=1; else valeur=0;
                                //     console.log(valeur);
                                // </script>
                                                
                                } 
                                //else $_SESSION['ignorerdate']="on";
//echo  $_SESSION['ignorerdate'];                               

if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
     $recherche = $_GET['recherche'];
//     $_SESSION['recherche'] = $_GET['recherche'];
 } 
else $recherche="";
//     $recherche = @$_SESSION['recherche'];





//echo $recherche;echo "<br>";
//$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "q";
//echo $_SESSION['niveau'];

if (isset($_GET['niveau']) && !(empty($_GET['niveau']))) {
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
if (isset($_GET['dates2'])) {

    $dat2 = $_GET['dates2'];
    $_SESSION['dates2'] = $_GET['dates2'];
} else
    $dat2 = $_SESSION['dates2'];

if ($dat2 == "") {
    //$dat2 = date('Y') . '-' . date('m') . '-' . '01';
    $dat2 = date('Y') . '-' . date('m') . '-' . date('d');
}
$datexx = date('Y') . '-' . date('m') . '-' . date('d');
$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : "";
// echo $dat;
// echo $dat2;
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ recherche $$$$$$$$$$$$$$$$$$$$$$$$$$$
$_SESSION['valider'] = "non";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// echo "<pre>";
// print_r($_GET);
// echo "<pre>";
// $nbr_element_page = 50;
// $nbr_de_pages = ceil($compteur / $nbr_element_page);
// $debut = ($page - 1) * $nbr_element_page;
// On inclut la connexion à la base
//if ($idcommande=="") {
require_once('../base/connectcommande.php');
//if ($idcommande!="") $sql = "se lect * from commande where id=406"; else $sql = "select * from commande where id";
// tous les resultats son triés par date 
// tous les resultats where (dates>='$dat' and dates<='$dat2') and
// recherche commande en instances


$sql = 'SELECT * FROM `rubriques` WHERE `idrubrique` = 1;';

// On prépare la requête
$query = $db->prepare($sql);

// On "accroche" les paramètre (id)
// $query->bindValue(':idrubrique', 1, PDO::PARAM_INT);

// On exécute la requête
$query->execute();

// On récupère le produit
$rubriques = $query->fetch();

if ($niveau == "t") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where   dates>='$dat' and dates<='$dat2' and not (etat like '%6/%') and 
                nomclient like  '%$recherche%' order by dates";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
                from commande where  dates>='$dat' and not (etat like '%6/%') and 
                nomclient like  '%$recherche%'  order by dates";

    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
            from commande  where dates<='$dat2' and not (etat like '%6/%') and 
            nomclient like  '%$recherche%'  order by dates";
    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
    from commande where not (etat like '%6/%') and
    nomclient like  '%$recherche%'  order by dates";

     if ($_GET['ignorerdate']=="on")  $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
     from commande where not (etat like '%6/%') and
     nomclient like  '%$recherche%'  order by dates";
 
}


// commandes sans archives
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

   if ($_GET['ignorerdate']=="on")  $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where 
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
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%5/%' order by dates";
    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  nomclient like '%$recherche%' and etat like  '%5/%' order by dates";

    if ($_GET['ignorerdate']=="on")  $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  nomclient like '%$recherche%' and etat like  '%5/%' order by dates";

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

    if ($_GET['ignorerdate']=="on")  $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
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

    if ($_GET['ignorerdate']=="on")   $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    where nomclient like '%$recherche%' and etat like  '%1/En cours%' order by dates";
}


// etat de commandes terminés ok
if ($niveau == "e2") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where nomclient like '%$recherche%' and etat like  '%2/Terminé%'  order by dates";
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);

   
    for ($i = 0; $i <= count(@$resultcommande) - 1; $i++) {
   
 
    // echo "<pre>";
    // print_r($resultcommande[$i]['etat']);
    // echo "</pre>";
    $diviserdate=explode(' ',$resultcommande[$i]['etat']);
    $dateAcomparer=$diviserdate[2];

    
    $dateFinale=date_create($dateAcomparer);
    $ResulatDate=date_format($dateFinale,"Y-m-d");
    if ($ResulatDate>=$dat) { 
       
     
      
        } 
        else  {
            //unset($resultcommande[$i]);
            array_splice($resultcommande,$i,2);
           
          
        }
    }

    // if (!empty($dat) and !empty($dat2)) {




    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    //         where nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and etat like  '%2/Terminé%' order by dates";
    // } elseif (!empty($dat))
    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    //         where nomclient like '%$recherche%' and dates>='$dat' and etat like  '%2/Terminé%' order by dates";
    // elseif (!empty($dat2))
    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
    //         where nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%2/Terminé%' order by dates";
    // else
    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
    // where nomclient like '%$recherche%' and etat like  '%2/Terminé%' order by dates";
}

// etat de commandes livrées ok
if ($niveau == "e3") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    where  etat like  '%3/Livrée%'  order by dates";

    // where nomclient like '%$recherche%' and etat like  '%3/Livrée%'  order by dates";
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
    
    // echo "<br>";   echo "<br>";   echo "<br>";
    //  echo $dat;
    //  echo "<br>";
    //  echo "<br>";

    // echo "<pre>";
    // print_r($resultcommande);
    // echo "</pre>";
    //array_shift($resultcommande);
    //array_splice($resultcommande,1,1);
    // echo "----------------";
    // echo "<pre>";
    // print_r($resultcommande);
    // echo "</pre>";

    // echo "----------------";

    //  die();
     $fin=count(@$resultcommande);
    //  echo $fin;
    //  echo "<br>";
      $borne=10;
      for ($ii = 0; $ii <$borne; $ii++) {
    for ($i = 0; $i <=count(@$resultcommande)-1; $i++) {
   
 
    // echo "<pre>";
    // print_r($resultcommande[$i]['etat']);
    // echo "</pre>";
    $diviserdate=explode(' ',$resultcommande[$i]['etat']);
    $dateAcomparer=$diviserdate[2];

    // echo "<pre>";
    // print_r($diviserdate);
    // echo "</pre>";
    // echo $dateAcomparer;
    $dateFinale=date_create($dateAcomparer);
    $ResulatDate=date_format($dateFinale,"Y-m-d");
    if ($ResulatDate>=$dat) { 
       
     
        // echo $ResulatDate;
        // echo "<br>";
        // echo "date ok $i".  count($resultcommande);
        } 
        else  {
            // $borne++;
            //unset($resultcommande[$i]);
            array_splice($resultcommande,$i,1);
            // array_splice($resultcommande,$i,1);
            //if ($i==0) array_shift($resultcommande); else array_splice($resultcommande,$i,1);
            // echo $ResulatDate;
            // echo "<br>";
            // echo "date non ok $i ".  count($resultcommande);
    //           echo "<pre>";
    //  print_r($resultcommande[$i]);
    //  echo "</pre>";
          
        }
    }
  }
    // array_shift($resultcommande);
    // echo "<pre>";
    // print_r($resultcommande[0]);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($resultcommande[1]);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($resultcommande[2]);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($resultcommande[3]);
    // echo "</pre>";

//     echo "=================================";
//     echo "<pre>";
//     print_r($resultcommande);
//     echo "</pre>";
    
//    echo count($resultcommande);
// die();
    // if (!empty($dat) and !empty($dat2)) {
    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    //         where nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and etat like  '%3/Livrée%' order by dates";
    // } elseif (!empty($dat))
    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    //         where nomclient like '%$recherche%' and dates>='$dat' and etat like  '%3/Livrée%' order by dates";
    // elseif (!empty($dat2))
    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
 
    //         where nomclient like '%$recherche%' and dates<='$dat2' and etat like  '%3/Livrée%' order by dates";
    // else
    //     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

    // where nomclient like '%$recherche%' and etat like  '%3/Livrée%' order by dates";




   
    
}

// resultat de recherche par dates

// recherche par proforma
if ($niveau == "prof") {
    if (!empty($dat) and !empty($dat2)) {
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 
        where nomclient like '%$recherche%' and dates>='$dat' and dates<='$dat2' and (etat like  '%6/Proforma%' or  etat like  '%66/%') ";
    } elseif (!empty($dat))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

        where nomclient like '%$recherche%' and dates>='$dat' and (etat like  '%6/Proforma%'  or etat like  '%66/%')";
    elseif (!empty($dat2))
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

        where nomclient like '%$recherche%' and dates<='$dat2' and (etat like  '%6/Proforma%' or etat like  '%66/%')";
    else
        $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande 

        where nomclient like '%$recherche%' and (etat like  '%6/Proforma%' or  etat like  '%66/%' )";

    if ($_GET['ignorerdate']=="on")  $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where nomclient like '%$recherche%' and (etat like  '%6/Proforma%' or  etat like  '%66/%' )";
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

    if ($_GET['ignorerdate']=="on") $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime 
    from commande where  (etat like '%4/%') and 
    nomclient like  '%$recherche%'  order by dates";
}
if ($niveau == "idcl") {
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  idclient like  '$recherche' order by dates";

    // if ($_GET['ignorerdate']=="on")  $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  idclient like  '$recherche' order by dates";
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


// recherche par nom imprimé
// a voir
if ($niveau == "i") {
    //if ($recherche!="")
    $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  imprime like  '%$recherche%' order by dates";
    if ($recherche=="")
     $sql = "select *,SUBSTRING(nomclient,1,20) as nomclient,SUBSTRING(imprime,1,20) as imprime from commande where  imprime='' order by dates";
}







if ($niveau == "ins") {

    if ($recherche == "" )
    //     $sql = "select * from commande where ( tag<=11111111 and tag!=11111110) and
    //  ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%' ) or (etat not like '%6/%'  and dates>='$dat'))    order by tag";

     $sql = "select * from commande where ( tag<=11111111 and tag!=11111110) and
     ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%' ) or (etat not like '%66/%' and (etat not like '%5/%') and dates>='$dat'))    order by tag";




    if ($_GET['ignorerdate']!="on" )
    //     $sql = "select * from commande where ( tag<=11111111 and tag!=11111110) 
    //  and ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%') or (etat not like '%6/%'  and dates>='$dat'))  
    //     and (nomclient like  '%$recherche%')  order by dates and tag";

     $sql = "select * from commande where ( tag<=11111111 and tag!=11111110) 
        and ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%') or (etat not like '%66/%'  and (etat not like '%5/%') and dates>='$dat'))  
           and (nomclient like  '%$recherche%')  order by tag";
   
    if  ($_GET['ignorerdate']=="on")
    $sql = "select * from commande where ( tag<=11111111 and tag!=11111110) 
        and ((etat like '%0/%' or etat like '%1/%' or etat like '%2/%') or (etat not like '%66/%') and (etat not like '%5/%'))  
           and (nomclient like  '%$recherche%') ";
}






// On prépare la requête
if (@$sql != "") {
    if ($niveau!="e3" && $niveau!="e2"){
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));;

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($resultcommande);
    // echo "</pre>";
    // die();
    }
    if ($resultcommande != false) {
 




        if ($niveau == "ins" && count($resultcommande) <= 1) {
            $tag = 0;
            $annee = date('Y');
            $sql = 'SELECT * FROM `numero` WHERE `annee`=:annee';
            // On prépare la requête
            $query = $db->prepare($sql);

            // On "accroche" les paramètre (id)
            //$query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':annee', $annee, PDO::PARAM_INT);
            // On exécute la requête
            $query->execute();

            // On récupère le produit
            $numero = $query->fetch();
            $tag = @$numero['tag'];

            if ($tag != 1) {
                $tag = 0;
                $sql = 'UPDATE `numero` SET `tag`=:tag  WHERE `annee`=:annee';

                $query = $db->prepare($sql);
                //$query->bindValue(':idd', $idd, PDO::PARAM_INT);
                $query->bindValue(':annee', $annee, PDO::PARAM_INT);
                $query->bindValue(':tag', $tag, PDO::PARAM_INT);




                $query->execute();

                //  die();
            }
            //require_once('../base/closecommande.php');
        }
    }
}


// if (@$resultcommande != []) {
     $compteur = count($resultcommande);
//     $nbr_element_page = 50000;
//     $nbr_de_pages = ceil($compteur / $nbr_element_page);
//     $debut = ($page - 1) * $nbr_element_page;
// }

//    echo "ok";
// appelimprime();
//die();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0"> -->
    <meta name="description" content="Put your description here.">
    <title>Liste commandes</title>
    <link rel="icon" type="image/x-icon" href="../../images/favicon.ico">
    <!-- <link rel="icon" href="../images/logo2.png" type="image" /> -->
    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    <!-- <link rel="stylesheet" href="../../css/loader.css"> -->

    <link rel="stylesheet" href="../../css/style41.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">



    <!-- <script src="./js/jquery-3.3.1.js"></script> -->
    <!-- <link rel="icon" type="image" href="../../images/logoneio1.png" /> -->
 
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet"> -->


    <!-- <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script> -->

    <!-- <script type="module">
        import Swal from '../../node_modules/sweetalert2/dist/sweetalert2'
    </script> -->



   

   
    <!-- nav bar ok  -->
   
    <!-- <style>
    .loader-container{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
    width: 100%;
    height: 100%;
    background-color: white;
    transition: opacity 1s ease-in-out, visibility 1s ease-in-out;
}
.loader-container.hidden{
    opacity:0;
    visibility: hidden;
}
.loader{
    width: 120px;
    height: 120px;
    border: 16px solid #e5e5e5;
    
    border-radius: 50%;
    border-top: 16px solid #007bff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%) rotate(0deg);
    box-shadow: 0 0 6px 2px rgba(0,0,0,0.2); 
    animation: loader 1s linear infinite;
}
@keyframes loader{
    0%{
        transform: translate(-50%,-50%) rotate(0deg);
    }
    100%{
        transform: translate(-50%,-50%) rotate(360deg);

    }
}


.container1{
    display:flex;
    flex-wrap: wrap;
}
</style>
   -->

</head>


<!-- <body> -->
<body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;" >

<!-- <img src="https://ccacghixha.cloudimg.io/https://gestimprim.com/gestimprim/uploads/90-118-chemise%20a3-11-12-2022%2018:47:50.png?w=400&wat=1&wat_scale=30&wat_gravity=northeast&wat_pad=10,8" alt=""> -->


<!-- //test integration igrame doit etre refuse -->

<!-- <iframe src="indexcommande.php" height="200" width="300" title="Iframe Example"></iframe> -->





    <?php
    require_once('../../navbarok.php');
   
    ?>

    <div class="container">


    <!-- <img  src="../../images/aid.jpg" alt="image" width="100%" height="auto"> -->
    <!-- <img  src="../../images/imageoffset.png" alt="image" width="100%" height="auto"> -->

      
        <div class="panel panel-success">

        <!-- < ?php require "../status.php"; ?> -->
            <!-- <div id="status" class="panel-heading entete"></div> -->
            <!-- <p>I will display &#8987;</p> -->
            <div class="panel-heading entete">Recherche commandes</div>

            <div class="panel-body">
            <!-- <img  src="../../images/heidelberg.png" alt="image" width="100%" height="50%"> -->



            <!-- <img  src="../../images/imageoffset.png" alt="imhage" width="100%" height="auto"> -->

                <form name="fo0" id="fo0" method="get" class="form-inline">
                
                    <div class="form-group">
                    <br>
                        <input id="recherche" type="text" name="recherche"  placeholder="rechercher" value="<?= @$recherche; ?>" />
                        <!-- < ?php } ?> -->
                        <!-- < ?php if ($niveau == "d") { ?> -->
                        <br><br>
                        <span style="color:red">Du</span>
                        <label for="date"></label>
                        <input type="date" id="dates" name="dates" value="<?= @$dat; ?>" onchange="this.form.submit()" />
                       
                        <br><br>
                        <span style="color:red">Au</span>
                        <label for="date2"></label>
                        <?php if (@$date2 != @$datexx)
                            $date2 = $datexx ?>
                       
                        <!-- <input type="date" id="dates2" name="dates2" value="< ?php echo @$dat2 ?>" onchange="this.form.submit()" /> -->
                        <input type="date" id="dates2" name="dates2" value="<?= @$dat2 ?>" onchange="this.form.submit()" />
                        <br><br>
                        <!-- <input id="ignorerdate" name='ignorerdate' type="checkbox" onclick="ignorer()"> -->
                        <input id="ignorerdate" name='ignorerdate' type="checkbox" onchange="this.form.submit()">
                          <script>
                              var ignorer = document.querySelector('#ignorerdate');
                                     console.log("<?=$_GET['ignorerdate']?>")
                                   
                                     session="<?=@$_GET['ignorerdate']?>"
                                   
                                   //console.log(ignorer);
                                   if (session=="on") ignorer.checked=1; else ignorer.checked=0;
              
               
                                //  if (ignorer.checked) valeur=1; else valeur=0;
                                //     console.log(valeur);
                             </script>
                        <span style="color:red">Ignorer Dates pour la recherche</span>
                        <br><br>
                        <span style="color:red">Par</span>

                        <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                            <!-- <option  value="0" < ?php if($niveau==="0") echo "selected" ?>>Veuillez selectionner un critère de recherche</option> -->
                            <option value="prof" <?php if ($niveau === "prof")
                                                        echo "selected";
                                                    $_SESSION['niveau'] = $niveau; ?>>Proforma demandés</option>
                            <option value="ins" <?php if ($niveau === "ins")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Commandes en instance</option>
                            <option value="t" <?php if ($niveau === "t")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Toutes commandes</option>
                            
                            <option value="e2" <?php if ($niveau === "e2")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>commande Terminé Selon Date de Fin </option>
                            <option value="e3" <?php if ($niveau === "e3")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>commande Livrée selon Date de livraison </option>

                            <option value="e0" <?php if ($niveau === "e0")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>commande en Attente</option>
                            <option value="e1" <?php if ($niveau === "e1")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>commande en Cours </option>


                            <option value="e5" <?php if ($niveau === "e5")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>commande archivée</option>
                            <option value="a" <?php if ($niveau === "a")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>commande annulée</option>
                            <option value="q" <?php if ($niveau === "q")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Commande (sans archives)</option>


                           



                            <option value="i" <?php if ($niveau === "i")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Commande par imprimé</option>
                           
                            <option value="idcl" <?php if ($niveau === "idcl")
                                                        echo "selected";
                                                    $_SESSION['niveau'] = $niveau; ?>>Commande par Id client</option>
                            <option value="idco" <?php if ($niveau === "idco")
                                                        echo "selected";
                                                    $_SESSION['niveau'] = $niveau; ?>>Commande par Id Commande</option>
                            <option value="idi" <?php if ($niveau === "idi")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Commande par Id Imprimé</option>
                            <option value="p" <?php if ($niveau === "p")
                                                    echo "selected";
                                                $_SESSION['niveau'] = $niveau; ?>>Commande par Etat Paiement</option>


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
            for ($i = 1; $i <= $nbr_de_pages; $i++) {
                if ($page != $i) echo "<a class='btn btn-primary' href='?page=$i'>$i</a>&nbsp";
                else echo "<a class='btn btn-success'>$i</a>&nbsp";
            }
            ?> -->
        </div>
        <?php if ($niveau == "ins") { ?>
        <h3 class="entete" style="color:red">Le delai moyen actuel <br> est de <?=$rubriques['dureemoyenne']?> jours</h3>
        <h3 class="entete" style="color:red">Nombre de commandes <br> en cours ou en attente <?=$rubriques['nbcom']?></h3>
        <?php } ?>
        <form name="fo1" id="fo1" method="post" action="actionselectiontest.php">
            <?php
            
            if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                <p class="entete" style="color:yellow"><?= $_SESSION['login'] . " connecté(e)" ?></p>

                <a href="../production/addproduction.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Production</a>

                <!-- <button id="btn-open-modal" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Commandes</button> -->

                <a href="./formcommande.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Commande</a>

                <!-- <button id="btn-open-modal">Ouvrir le modal</button> -->
                <a href="../client/addclient.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Client</a>
                <a href="../imprime/add.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Imprime</a>
                <!-- <a href="./proforma.php" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Proforma</a> -->

                <!-- <a href="tel:+213550090992" class="btn btn-primary">Appeler</a>
                <a href="sms:213550090992" class="btn btn-primary">Envoyer sms</a> -->


                <!-- <a href="./calculator/calculator.php" class="btn btn-primary"><span class="icon">

                        <i class="fa fa-calculator" aria-hidden="true"></i>

                    </span>
                  

                </a> -->


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
                <!-- <a href="./formcommande.php" class="btn btn-primary">+Commande</a>
                <a href="./addclient.php" class="btn btn-primary">+Client</a>
                <a href="./add.php" class="btn btn-primary">+Imprime</a> -->
                <!-- <a href="tel:+213541035548"  class="btn btn-primary">Appeler</a>
                                <a href="sms:+213541035548"  class="btn btn-primary">Envoyer sms</a> -->
                <br><br>
                <button type="submit" class="btn btn-success" name="valider" value="envoyer">
                    <span class="fa fa-sign-in"></span> Valider Selection Commandes</button>
                <br><br>

            <?php } ?>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste de commandes (<?= strip_tags(@$compteur) ?>)
                    <!-- <input name='seltous' type="checkbox" value='seltous'> -->
                </div>
                <input type="text" id="listedate1" name="listedate1" value="<?php echo strip_tags(@$dat) ?>" placeholder="<?php echo $dat ?>" hidden>
                <input type="text" id="listedate2" name="listedate2" value="<?php echo strip_tags(@$dat2) ?>" placeholder="<?php echo $dat2 ?>" hidden>
                <input type="text" id="recherche" name="recherche" value="<?php echo strip_tags(@$recherche) ?>" placeholder="<?php echo $recherche ?>" hidden>
                <input type="text" id="niveau" name="niveau" value="<?php echo @$niveau ?>" placeholder="<?php echo $niveau ?>" hidden>


                <div class="table-responsive">
                    <!-- <div class="table-responsive prevent-select"> -->
                    <table class="mx-auto table tab table-striped table-responsive">

                        <thead class="table">
                <?php   $j=3; 
                // contient appel fonction selection() javascript etc......
                require "entetetableau.php"; ?>

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

                            if (@$resultcommande != null) {
                                // calcule le nomre de fois ou on doit afficher l'entete du tableau
                              
                                for ($i = 0; $i < count(@$resultcommande); $i++) {
                                // afichage du head(entete tableau toutes les 4 lignes)
                                if ($i==$j) {
                                            $j+=3; 
                                            require "entetetableau.php";
                                        }
                                // echo ($i)." "." ".($jj);
                              
                           
                    // require "entetetableau.php";
                           
                                    // echo count(@$resultcommande);
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
                                        <?php if ($modesimplifieadmin == 0 or $modesimplifieadmin == 1) : ?>
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
                                        <?php if ($modesimplifieadmin == 0) : ?>
                                            <td class="table-primary"><?= $resultcommande[$i]['idclient'] ?></td>
                                        <?php endif; ?>
                                        <!-- // duree moyenne commande -->
                                        <!-- < ?php if ($modesimplifieadmin == 0) : ?>
                                            < ?php $duree = $resultcommande[$i]['total'] / 10000; ?> -->
                                            <!-- <td class="table-primary">< ?= $duree ?></td> -->
                                        <!-- < ?php endif; ?> -->
                                        <td class="table-info" style="background-color:blue;color:white"><?= $resultcommande[$i]['nomclient'] ?></td>
                                        <?php if ($modesimplifieadmin == 0) : ?>
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
                                                <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                    <i class='fa-solid attente fa-fw fa-3x' style='color:red' aria-hidden='true'></i>
                                                  
                                                    <span style='background-color:blue;color:red;font-weight:bold'></span>
                                                    </a>
                                                    <!-- <i class='fa fa-undo' style='font-size:30px;color:blue'  aria-hidden='true'></i> -->
                                                    <!-- fa-hourglass-start -->
                                                </div>
                                            <?php } ?>

                                            <?php if ($etatcolor[0][0] == 1) { ?>
                                                <!-- <i  class='fa  fa-spin fa-3x fa-fw' style='color:blue' aria-hidden='true'> -->
                                                <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                <i class="fa-solid fa-gear fa-spin fa-3x" style="color: #042662;"></i>
                                                </a>
                                                <!-- <i class="fa-solid fa-gear fa-spin" style="color: #042662;"></i> -->
                                                <!-- <i class="fa-solid fa-gear fa-spin fa-spin fa-3x" style='color:blue'></i> -->
                                                <!-- <i  class='fa fa-cogs fa-spin' style='font-size:30px;color:blue' aria-hidden='true'> -->
                                                <!-- <i class="fa fa-shield fa-rotate-90"></i>
                                            <i class="fa fa-shield fa-rotate-180"></i>
                                            <i class="fa fa-shield fa-rotate-270"></i>
                                            <i class="fa fa-shield fa-flip-horizontal"></i>
                                            <i class="fa fa-shield fa-flip-vertical"></i> -->
                                                <!-- </i> -->
                                                <!-- <i  class='fa fa-cog fa-spin' style='font-size:30px;color:blue' aria-hidden='true'></i> -->
                                                <!-- <span style='background-color:blue;color:white;font-weight:bold'></span> -->
                                            <?php }
                                            

                                            if ($etatcolor[0][0] == 2 or $etatcolor[0][0] == 11 or $etatcolor[0][0] == 12) { ?>
                                                <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                <i class='fa fa-check-square fa-fw fa-3x' style='color:blue' aria-hidden='true'></i>
                                              
                                                <span style='background-color:green;color:black;font-weight:bold'></span>
                                               
                                                </a>
                                                
                                            <?php } ?>
                                         
                                            

                                          
                                              <?php
                                            // if ($_SESSION['user']['role'] == 'ADMIN') {

                                            if ($etatcolor[0][0] == 3) { ?>
                                               
                                                
                                                <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                <i class="fa-solid fa-truck-front fa-beat fa-fw fa-3x" style='color:Navy'></i>

                                                </a>
                                               
                                                <!-- <i class='fa fa-truck fa-fw' style='font-size:< ?= FONTSIZE ?>;color:Navy' aria-hidden='true'></i> -->
                                                <!-- <span style='color:black;font-weight:bold'></span> -->


                                                <?php } ?>


                                                <?php
                                                if ($etatcolor[0][0] == 4) { ?>
                                                    <!-- // echo "<i class='fa fa-ban' style='font-size:30px;color: DarkRed'  aria-hidden='true'></i> <span style='background-color:red;color:black;font-weight:bold'>"  . "</span>"; -->
                                                    <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                    <i class='fa fa-ban fa-fw fa-3x' style='color: DarkRed' aria-hidden='true'></i>
                                                    </a>
                                                    <!-- <span style='background-color:red;color:black;font-weight:bold'></span> -->
                                                <?php }
                                                if ($etatcolor[0][0] == 5) { ?>
                                                <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                    <i class='fa fa-archive fa-fw fa-3x' style='color:DarkGreen' aria-hidden='true'></i>
                                                    
                                                </a>
                                                    <!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->





                                                <?php } ?>

                                                <?php
                                                if ($etatcolor[0][0] == 6) { ?>
                                                 <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                    <i class='fa-solid fa-newspaper fa-fw fa-3x' aria-hidden='true'></i>
                                                   
                                                    <span style='color:blue;font-weight:bold'></span>
                                                </a>
                                                <?php }
                                                if ($etatcolor[0][0] == 66) { ?>
                                                 <a class="btn" id="nomimage" onclick="modaletext(` <?= $etatcolor[0][1]?>`)">
                                                <i class='fa-solid fa-eject fa-fw fa-3x' aria-hidden='true'></i>
                                              
                                                <span style='color:red;font-weight:bold !important'></span>
                                                </a>
                                                <?php }


                                                if ($etatcolor[0][0] == 12 or $etatcolor[0][0] == 11) { ?>
                                                  
                                                    <i class='fa-solid fa-clock fa-shake fa-fw fa-3x' aria-hidden='true'></i>
                                                   
                                                    <span style='color:blue;font-weight:bold'></span>
                                                  
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

                                                <td>
                                               
                                                <?php if ($resultcommande[$i]['duree']!="") { ?>
                                                <a class="btn" id="nomimage" onclick="modaletext(`<?= 'Duree='.$resultcommande[$i]['duree'] ?>`)">
                                                <!-- <i class='fa-solid fa-clock fa-beat fa-fw fa-3x' aria-hidden='true'></i> -->
                                                <span style='color:black;font-weight:bold'>
                                               <i class='fa-solid fa-clock fa-shake fa-fw fa-3x' aria-hidden='true'></i>
                                               </span>
                                               <!-- <span style='color:black;font-weight:bold'></span> -->
                                               </a>
                                                    <?php } ?>
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
                                          
                                            <?php
                                            if ($resultcommande[$i]['images'] != "") {
                                            
                                            ?>
                                              
                                                <?php
                                                $extension = substr($resultcommande[$i]['images'], strrpos($resultcommande[$i]['images'], "."));
                                                // echo $extension;
                                                // die();
                                                if ($extension != ".pdf") { ?>

                                                  

                                                    <a class="btn" id="nomimage" onclick="modaleimage(`<?= $resultcommande[$i]['images'] ?>`)">

                                                        <i class="fa-solid fa-image" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                    </a>

                                                <?php } else { ?>

                                                    <a id="nomimage" href="afficherbc.php?bc=<?= $resultcommande[$i]['images'] ?>">

                                                        <i class='fa-solid fa-file-pdf' style='font-size:<?= FONTSIZE ?>;color:red'></i>

                                                        <!-- <i class="fa fa-file-image-o" aria-hidden="true"></i> -->

                                                        <!-- <i class="fa fa-picture-o" aria-hidden="true"></i> -->
                                                <?php }
                                            } ?>



                                        </td>
                                     <!-- affichage icone bon de commande -->
                                        <td>
                                            <?php if ($resultcommande[$i]['bc'] != "") {
                                                // echo $resultcommande[$i]['bc'];
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
                                                //  echo $extension;
                                                // die();
                                                if ($extension != ".pdf") {    ?>
                                                 <a class="btn" id="nomimage" onclick="modaleimage(`<?= $resultcommande[$i]['bc'] ?>`)">

                                                    <i class="fa-solid fa-image" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                        </a>
                                                    <!-- <a id="nomimage" href='afficherimage.php?image=<?= $resultcommande[$i]['bc'] ?>'>
                                                      
                                                        <i class="fa-solid fa-picture" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                    </a> -->
                                                <?php } else {   ?>
                                                    <a id="nomimage" href="afficherbc.php?bc=<?= $resultcommande[$i]['bc'] ?>">
                                                        <i class='fa-solid fa-file-pdf' style='font-size:<?= FONTSIZE ?>;color:red'></i>
                                                <?php }
                                            } ?>


                                        </td>
                                        
                                        <!-- // tag -->
                                        <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                            <!-- <th class="table-primary">
                                                < ?= $resultcommande[$i]['solde'] ?></th>  -->

                                        <?php } else { ?>
                                            <th class="table-primary"></th>
                                        <?php
                                        } ?>

                                        <th class="table-primary">
                                            <?php

                                            // echo $resultcommande[$i]['tag'];
                                            if ($resultcommande[$i]['tag'] != 0) {
                                                if ($resultcommande[$i]['tag'] < 11111110) {
                                                    //print_r( "$resultcommande[$i]['tag']");
                                                    echo $resultcommande[$i]['tag'];
                                                    echo "<i class='fa fa-tag' style='font-size:30px;color:red'></i>";
                                                }

                                                if ($resultcommande[$i]['tag'] == 11111111)
                                                    echo "<i class='fa fa-tag' style='font-size:30px;color:blue'></i>";
                                                if ($resultcommande[$i]['tag'] == 11111110)
                                                    echo "<i class='fa fa-tag' style='font-size:30px;color:black'></i>";
                                            }




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
                                            <!-- debut menu action -->
                                            <a class="btn btn-primary btn-sm btn-warning" href="./action2ok.php?id=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&etat=<?= $etatsuivi ?>&page=<?= $page ?>"><i class="fa fa-wrench" style='font-size:30px;color:blue' aria-hidden="true"></i>
                                                <?php if (array_key_exists(1, $etatclientdirect))
                                                     echo $etatclientdirect[1];
                                                if (array_key_exists(1, $etatclientseq))
                                                    echo $etatclientseq[1];
                                                //  print_r( $etatclientseq) 
                                                ?>
                                             </a>
                                          


                            

                                            <!-- debut lien etat productio -->
                                            <!-- s'affiche uniquement sir la fiche production existe poiur cette commande -->
                                            <?php
                                            $idcommande = $resultcommande[$i]['id'];
                                            //$_GET['idcommande'];
                                            if ($idcommande != 0) {
                                                require('../base/connectproduction.php');
                                                $sql = 'SELECT * FROM `production` WHERE `idcommande` = :idcommande;';
                                                //print_r($sql);

                                                $query = $db->prepare($sql);

                                                $query->bindValue(':idcommande', $idcommande, PDO::PARAM_INT);
                                                // // On exécute la requête
                                                $query->execute() or die(print_r($db->errorInfo()));

                                                //On stocke le résultat dans un tableau associatif
                                                $prod = $query->fetch(PDO::FETCH_ASSOC);
                                                //print_r($prod);
                                                //require('closeproduction.php');


                                                if ($prod != "") {
                                                    $inter = $prod['idmatiere'];
                                                    $sql = "select * from matiere where idmat=$inter order by dates";
                                                    $query = $db->prepare($sql);

                                                    $query->execute();
                                                    $matiere = $query->fetch(PDO::FETCH_ASSOC);
                                                    //print_r($matiere);
                                                    // if ($matiere != "") {
                                                    // echo "<br>";
                                                    // echo "<br>";
                                                    // echo "<br>";
                                                    // echo "<br>";
                                                    // print_r($matiere);
                                                    @$adiviser = @$prod['nbreposecoupe'] * @$prod['nbreposetirage'];
                                                    $priximprime = 0;
                                                    //var_dump($adiviser);
                                                    if (@$matiere['mesure'] == "kg") {

                                                        if (@$adiviser != 0)
                                                            $priximprime = ($matiere['ptf'] * $matiere['prix']) / $adiviser;
                                                    } else {

                                                        if (@$adiviser != 0)
                                                            $priximprime = @$matiere['prix'] / @$adiviser;
                                                    }
                                                    // }
                                            ?>



                                                    <!-- ?> -->
                                                    <!-- <a class="btn btn-primary btn-sm btn-primary" href="../production/etatproduction.php?recherche=&niveau=ins&idcommande=< ?= $resultcommande[$i]['id'] ?>&prix=< ?= $priximprime ?>"><i class="fa fa-industry" style='font-size:30px;color:blue' aria-hidden="true"></i></a> -->

                                                    <a class="btn btn-primary btn-sm btn-primary" href="../production/production.php?recherche=&niveau1=prod&idprod=<?=$prod['idprod'] ?>&idcommande=<?= $resultcommande[$i]['id'] ?>"><i class="fa fa-industry" style='font-size:30px;color:blue' aria-hidden="true"></i></a>

                                                <?php } else { ?>
                                                <a class="btn btn-primary btn-sm btn-primary" href="../production/addproduction.php?recherche=&niveau1=ins&idcommande=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>" data-toggle="tooltip" data-placement="right" title="Pas de fiche production"><i class="fa-solid fa-user-plus" style='font-size:30px;color:blue'></i><i class="fa fa-industry" style='font-size:30px;color:blue' aria-hidden="true"></i>
                                                  

                                                </a>
                                            <?php } ?>
                                        
                                            <!-- else { ?>
                                                <a class="btn btn-primary btn-sm btn-primary" href="../production/addproduction.php?recherche=&niveau1=ins&idcommande=< ?= $resultcommande[$i]['id'] ?>&idclient=< ?= $resultcommande[$i]['idclient'] ?>" data-toggle="tooltip" data-placement="right" title="Pas de fiche production">
                                                  

                                                </a>
                                            <?php } ?> -->
                                            <!-- fin lien etat productio -->

                                            <a class="btn btn-primary btn-sm btn-success" href="telechargerimage.php?idcommande=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&nomclient=<?= $resultcommande[$i]['nomclient'] ?>&imprime=<?= $resultcommande[$i]['imprime'] ?>&idimprime=<?= $resultcommande[$i]['idimprime'] ?>">
                                                <i class="fa fa-download" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                <i class="fa-solid fa-image" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                <!-- <i class="fa fa-picture" style='font-size:< ?= FONTSIZE ?>;color:blue' aria-hidden="true"></i> -->
                                            </a>
                                            <?php if ($resultcommande[$i]['images'] != "" or $resultcommande[$i]['bc'] != "") { ?>
                                                <a class="btn btn-primary btn-sm btn-danger" href="effacerfichier.php?idcommande=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>&nomclient=<?= $resultcommande[$i]['nomclient'] ?>&imprime=<?= $resultcommande[$i]['imprime'] ?>&idimprime=<?= $resultcommande[$i]['idimprime'] ?>">
                                                    <i class="fa fa-trash" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                    <i class="fa-solid fa-image" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                   
                                                </a>
                                            <?php } ?>

                                            <?php if ($etatcolor[0][0] == 2 or $etatcolor[0][0] == 3 or $etatcolor[0][0] == 5 or $etatcolor[0][0] == 11 or $etatcolor[0][0] == 12) { ?>
                                                <!-- lien vers  les documents emis -->
                                                <a class="btn btn-primary btn-sm btn-warning" href="../document/documentemis.php?idcommande=<?= $resultcommande[$i]['id'] ?>&client=<?= $resultcommande[$i]['nomclient'] ?>&dates=<?= $resultcommande[$i]['dates'] ?>">
                                                    <span class="icon"><i class="fa fa-file-text" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i></span>
                                                    <!-- <span class="title">Documents</span> -->
                                                </a>
                                            <?php } else { ?>
                                                <a class="btn btn-primary btn-sm btn-primary">

                                                    <i class="fa fa-file" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i>
                                                <?php }


                                            //fa-file-o
                                                ?>
                                                <a class="btn btn-primary btn-sm btn-success" href="etatversementcommande.php?idcommande=<?= $resultcommande[$i]['id'] ?>&idclient=<?= $resultcommande[$i]['idclient'] ?>">
                                                    <span class="icon"><i class="fa fa-usd" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i></span>

                                                    <a class="btn btn-primary btn-sm btn-success" href="../imprime/details.php?id=<?= $resultcommande[$i]['idimprime'] ?>">
                                                    <span class="icon"><i class="fa fa-print" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i></span>

                                                    <a class="btn btn-primary btn-sm btn-success" href="../client/detailsclient.php?id=<?= $resultcommande[$i]['idclient'] ?>">
                                                    <span class="icon"><i class="fa fa-user-circle" style='font-size:<?= FONTSIZE ?>;color:blue' aria-hidden="true"></i></span>

                                        </td>


                                        </td>




                                    </tr>

                            <?php
                                    $total1 += $resultcommande[$i]['total'];
                                    $totalqte += $resultcommande[$i]['quantite'];
                                    //$nombrecommandes+=1;
                                    // }
                                } // fffffffiiiiiin du  fffffffooooooooooorrrrrrrrrrrr
                            } // fin du if
                            ?>
                            <td class="table-primary">Total en DZ</td>
                            <!-- <td class="table-danger"></td>
                            <td class="table-primary"></td> -->
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
              <!-- fin du div compress -->
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
        <br>
        <a class="btn btn-danger" href="#top">
    Aller en Haut de page
</a>
<!-- debut des scripts -->
        <script>
            // cette fonction est appele en externe avec un  require "entetetableau.php";
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
            function ignorer() {
                var ignorer = document.querySelector('#ignorerdate');
                var valeur;
                //console.log(ignorer);
                //var elt = document.querySelector('#seltous');
                if (ignorer.checked) valeur=1; else valeur=0;

                document.location.href="indexcommande.php?ignorerdate="+valeur;
                    //console.log("ignorer date cochée"); else  console.log("ignorer date non cochée");
                    // for (let i = 0; i < sel.length; i++) {
                    //     sel[i].checked = true;

                    // }

                // } else {
                //     //console.log("non cochée");
                //     for (let i = 0; i < sel.length; i++) {
                //         sel[i].checked = false;

                //     }
                // }
            
        }


            function modaleimage(image) {
          
                Swal.fire({
                    title: '',
                    text: '',
                    showCloseButton: true,
                    imageUrl: '../../uploads/' + image,
                    // imageWidth: 500,
                    // imageUrl: 'uploads/' + image,
                    // imageWidth: 600,
                    //  imageHeight: 400,
                    imageAlt: 'Pas de image',
                })


            }
            function modaletext(texte) {
                Swal.fire({
  
  icon: "success",
  title: texte,
 
  showConfirmButton: true,
 
});
        //   Swal.fire({
        //     icon: "info",
        //       title: 'Details Etat Commande',
        //       text: texte,
        //       showCloseButton: true,
            
        //       // imageWidth: 500,
        //       // imageUrl: 'uploads/' + image,
        //       // imageWidth: 600,
        //       //  imageHeight: 400,
             
        //   })


      }
        </script>





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
                setTimeout(function() {
                    a[i].innerHTML = "&#xf252;";
                }, 2000);
                setTimeout(function() {
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
        // function cogs() {
        //     var a;

        //     a = document.querySelectorAll("i.encours");
        //     //longueur=length.a;
        //     //   console.log(a.length);
        //     //   console.log(a[0]);
        //     for (let i = 0; i < a.length; i++) {
        //         // const element = array[i];
        //         a[i].innerHTML = "&#xf085;";
        //         setTimeout(function() {
        //             a[i].innerHTML = "&#xf013;";
        //         }, 2000);
        //         setTimeout(function() {
        //             a[i].innerHTML = "&#xf085;";
        //         }, 3000);
        //     }

        // }
        // cogs();
        // setInterval(cogs, 5000);







        function tagger(id, tag, i, etatsuivi) {

            // console.log(tag);

            // console.log(i);
            // console.log(id);
            // console.log(etatsuivi);
            // mavar=document.getElementById(j).innerHTML;

            if (tag == 0 && etatsuivi != 6 && etatsuivi != 66) {
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
                    html: `
   <h3>  Commande N° ${id}</h3>
   <h4>Programmer! </h4>
  `,
                    // footer:"Suppression irréversible",
                    backdrop: true,
                    heightAuto: false,
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

                        if (tag == 0) document.location.href = 'tagconsole.php?id=' + id + '&tag=' + tag + '&etatsuivi=' + etatsuivi;
                        // Swal.fire(
                        //   'Tag commande',
                        //   'Votre Tag à été modifié.',
                        //   'success'
                        // ).then((result) => {
                        // //  document.location.href = 'tagconsole.php?id='+id+'&tag='+tag+'&etatsuivi='+etatsuivi;

                        // })


                    }
                })



            }


        }




     
  
    </script>
 <!-- <script src="../../fontawesome-free-6.5.1-web/js//all.min.js"></script> -->
    <!-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> -->


    <!-- <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyCuA6-VaoG8AKES2i_lD70cUYTm6ZgnzjU",
    authDomain: "gest-8e38a.firebaseapp.com",
    projectId: "gest-8e38a",
    storageBucket: "gest-8e38a.appspot.com",
    messagingSenderId: "569180438414",
    appId: "1:569180438414:web:586e6d870afccb332baedf"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
</script> -->

</body>

</html>