<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
// $pointages=isset($_GET['pointage'])?$_GET['pointage']:"";
// $infos=isset($_GET['infos'])?$_GET['infos']:"";

if (isset($_POST['photo1']) && !empty($_POST['photo1']))   {
    $img = $_POST['photo1'];
 //   print_r($img);
    $folderPath = "pointage/";
 
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    // if ($pointages==1)
    // $_SESSION['message'] = "
    //                          تسجيل الحضور  قد تم
    //                          <br>
    //                          pointage d'entree reussi.
    //                          ";
    // if ($pointages==4)
    // $_SESSION['message'] = "
    //             تسجيل الذهاب قد تم
    //                         <br>
    //                          pointage de sortie reussi.
    //                                                   ";                  
    //header('Location:camera2.php');
    //header('Location:camera2.php');



    // ,$$$$$$$$$$$$$

    header("location: democam.php");
    //print_r($fileName);




} else  { 
    $_SESSION['message'] = "Veuillez vous prendre en photo";
        header("location: democam.php?");
    // $_SESSION['message'] = "pointage de test sans camera";
    // header("location: confirmationpointagecamera.php?pointage=$pointages&infos=$infos&fileName=$fileName");


        }
