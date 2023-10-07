<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
    <title>L</title>
    <link rel="stylesheet" href="css/normalize.css">

    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css"> -->

    <!-- <link rel="stylesheet" type="text/css" href="./css/webcam.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/monstyle.css"> -->
    <!-- <link rel="stylesheet" href="./css/style41.css">
    <script src="./js/jquery-3.3.1.js"></script> -->
    <link rel="icon" href="./images/logo.avif" type="image" />

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->




    <!-- <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script> -->
    <script src="jquery-2.1.1.min.js"></script>
    <script src="faceSystem.js"></script>
    <script src="face-api.min.js"></script>
    <style>
        #overlay,
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>

<body>


</body>

</html>
<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
$pointages = isset($_GET['pointage']) ? $_GET['pointage'] : "";
$infos = isset($_GET['infos']) ? $_GET['infos'] : "";
$salarie = $_SESSION['user']['login'];
$reussi = 0;






if (isset($_POST['image']) && !empty($_POST['image'])) {



    $img = $_POST['image'];
    $folderPath = "pointage/";


    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    $fileName = $infos . uniqid() . '.png';
    //     ? >
    //   <script>
    //   var fileName = <?php echo json_encode($fileName); ? >;
    //   </script>
    // < ?php
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    // appel de la reconnaissance faciale

    //header('Location: ./face/index3.php');
?>
    <img src="./pointage/<?= $fileName ?>" id="originalImg" />
    <canvas id="reflay" class="overlay"></canvas>
    <script>
        var salarie = <?php echo json_encode($salarie); ?>;
        var pointages = <?php echo json_encode($pointages); ?>;
        var infos = <?php echo json_encode($infos); ?>;
        var fileName = <?php echo json_encode($fileName); ?>;
    </script>
<?php
    // echo "<br>";
    // echo $salarie;
    //$reussi=1;
    // if ($reussi==1) {
    //die();
    // fin de la reconnaissance faciale
    // if ($pointages==1)
    // $_SESSION['message'] = "
    //                          تسجيل الحضور  قد تم
    //                          <br>
    //                          pointage de présence reussi.
    //                          ";
    // if ($pointages==4)
    // $_SESSION['message'] = "
    //             تسجيل الخروج قد تم
    //                         <br>
    //                          pointage de sortie reussi.
    //                                                   ";                  
    //header('Location:camera2.php');
    //header('Location:camera2.php');



    // ,$$$$$$$$$$$$$

    // header("location: confirmationpointagecamera.php?pointage=$pointages&infos=$infos&fileName=$fileName");
    //print_r($fileName);


    // } // fin de test de reussi

} else {
    $_SESSION['message'] = "Veuillez vous prendre en photo";

    header("location: camera2.php?pointage=$pointages&infos=$infos&fileName=$fileName");
    die();
    // $_SESSION['message'] = "pointage de test sans camera";
    //header("location: confirmationpointagecamera.php?pointage=$pointages&infos=$infos&fileName=$fileName");


}
?>