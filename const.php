<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
if  (!isset($_SESSION['login'])){
    $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
    header('Location: ./login.php');
    die;
}
}
if (empty($_SESSION['language'])) $_SESSION['language']="AR";
if ($_SESSION['language']=="FR") {
    define("LANGUE","🇩🇿");
    define("GEST","Gest'");
    define("IMPRIM","imprim");
    define("COMMANDE","commande");
    define("POINTAGE","Pointage");
    define("MESSAGE","Message");
    define("PRODUCTION","Production");
    define("RELEVE","Releve");
    define("CLIENT","Client");
    define("CLIENTS","Clients");
    define("UTILISATEUR","Utilisateur");
    define("SEDECONNECTER","Se déconnecter");
    define("ESPACE","Espace Client");
    define("AUTH",'Authentification reussie! <br> Bienvenue');
 

// العملاء
// إنتاج
// عميل
// مستخدم
//   منطقة العملاء 
    } else  
    if ($_SESSION['language']=="AR") {
    
        define("ESPACE","منطقة العملاء");
        define("LANGUE","🇫🇷");
        define("GEST","Gest'");
        define("IMPRIM","imprim");
        define("COMMANDE","الطلب");
    define("POINTAGE","دخول العمل");
    define("MESSAGE","رســالــــة");
    define("PRODUCTION","انــــتاج");
    define("RELEVE","كشف الدخول");
    define("CLIENT","عمــــــيل");
    define("CLIENTS","العملاء");
    define("UTILISATEUR","مســتـخدم");
    define("SEDECONNECTER","تسجيل الخروج");


    define('AUTH','تمت المصادقة بنجاح');

    // define("PRODUCTION","إنتاج");
    }

//print_r($_SESSION['user']['iduser']);
//die();
// if (!isset($_SESSION['user']['iduser'])) {
//     // echo "okokokokokoko";
//     // die();
//     header('Location:login.php');
//     die();
// }
date_default_timezone_set("Africa/Algiers");
define("ICONFONT","23px");
define("FONTSIZE","30px");


ini_set("display_errors", 1);
error_reporting(-1);


function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
} ?>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet"> 

<script> 


function travail(message) {


    Swal.fire({
//   position: 'bottom-start',
  icon: 'success',
  title: `${message}`,
  showConfirmButton: true
//   ,timer: 4000
})
 } 




 function probtravail(message) {


Swal.fire({
//   position: 'bottom-start',
icon: 'error',
title: `${message}`,
showConfirmButton: true
// ,timer: 4000
})
} 

</script> 
<?php
// if (!empty($_SESSION['erreur'])) {
//     echo '<div class="alert alert-danger .alert-dismissible" role="alert">
//     <button type="button" class="close" data-dismiss="alert">&times;</button>
//             ' . $_SESSION['erreur'] . '
//         </div>';
  
//     // echo "<script>
    
//     //         probtravail()
//     //         </script>"; 
//     $_SESSION['erreur'] = "";
// }
// if (!empty($_SESSION['message'])) {
    
//     echo '<div class="alert alert-success .alert-dismissible" role="alert">

//     <button type="button" class="close" data-dismiss="alert">&times;</button>
//             ' . $_SESSION['message'] . '
//         </div>';
        
  
  
// //  echo "
// //     <script>
// //     travail();
// //     </script>"; 
//  $_SESSION['message'] = "";
    
// }
?>
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<!-- <div class="container">
    <div class="entete">
            <img src="./images/logo.avif" alt="logo global2pub" width="50" height="auto">

            <h1 class="entete">Commande V1.0</h1>
    </div>

</div> -->




<footer>

<div class="footer">
    
        &copy; 2021-<?=date("Y")?> <a style="color:blue" href="https://global2pub.com"> global2pub.com </a>
      
</div>
</footer>
<!-- <script src="./js/script.js"></script> -->