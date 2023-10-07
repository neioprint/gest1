<?php
require_once "const.php";

$pointages=isset($_GET['pointage'])?$_GET['pointage']:"";
$infos=isset($_GET['infos'])?$_GET['infos']:"";
$fileName=isset($_GET['fileName'])?$_GET['fileName']:"";
$salarie=isset($_GET['salarie'])?$_GET['salarie']:"";
$areconnaitre=isset($_GET['areconnaitre'])?$_GET['areconnaitre']:"";
echo $salarie;
$salarie1=explode('(',$salarie);
$salarie=$salarie1[0];
// print_r(  $salarie1);
// echo "<br>";
// echo $salarie;

// echo "<br>";
// echo $areconnaitre;
// echo "<br>";
if ($salarie==$areconnaitre) {
                                    //echo "pointage et reconnaissance faciale reussi";
                                    if ($pointages==1)
                                    $_SESSION['message'] = "
                                                             تسجيل الحضور  قد تم
                                                             <br>
                                                             pointage de présence reussi.
                                                             ";
                                    if ($pointages==4)
                                    $_SESSION['message'] = "
                                                تسجيل الخروج قد تم
                                                            <br>
                                                             pointage de sortie reussi.
                                                                                      ";           

                                    header("location: confirmationpointagecamera.php?pointage=$pointages&infos=$infos&fileName=$fileName");
                                    die();
                                    } else {

                                        $_SESSION['erreur'] = "Vous n'etes pas $areconnaitre 
                                                                <br> Refaites le pointage
                                                                ";
   
                                        header("location: camera2.php?pointage=$pointages&infos=$infos&fileName=$fileName");
                                        die();
                                    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
    <title>Liste des commandes</title>
    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/webcam.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/monstyle.css"> -->
    <link rel="stylesheet" href="./css/style41.css">
    <script src="./js/jquery-3.3.1.js"></script>
    <link rel="icon" href="./images/logo.avif" type="image" />
  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->




    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>

    <title>pointage</title>
