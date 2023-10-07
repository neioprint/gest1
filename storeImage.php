<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

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
$pointages = isset($_GET['pointage']) ? $_GET['pointage'] : "";
$infos = isset($_GET['infos']) ? $_GET['infos'] : "";

if (isset($_POST['image']) && !empty($_POST['image'])) {
    $img = $_POST['image'];
    $folderPath = "pointage/";


    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    $fileName = $infos . uniqid() . '.png';

    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    if ($pointages == 1) $_SESSION['message'] = " تسجيل الحضور  قد تم <br>pointage d'entree reussi.";
    if ($pointages == 4) $_SESSION['message'] = " تسجيل الذهاب قد تم<br>pointage de sortie reussi.";
    //header('Location:camera2.php');
    //header('Location:camera2.php');



    // ,$$$$$$$$$$$$$

    header("location: confirmationpointagecamera.php?pointage=$pointages&infos=$infos&fileName=$fileName");
    //print_r($fileName);




} else {
    $_SESSION['message'] = "Veuillez vous prendre en photo";
    header("location: camera2.php?pointage=$pointages&infos=$infos&fileName=$fileName");
    // $_SESSION['message'] = "pointage de test sans camera";
    // header("location: confirmationpointagecamera.php?pointage=$pointages&infos=$infos&fileName=$fileName");


}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
    <title>L</title>
    <link rel="stylesheet" href="css/normalize.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/webcam.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/monstyle.css"> -->
    <link rel="stylesheet" href="./css/style41.css">
    <script src="./js/jquery-3.3.1.js"></script>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/styleloader.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>

<body>
<div class="loader-container">
        <div class="loader">

        </div>
</div>
    <script>
        function stopcamera() {
            webcam.stop();

        }

        function playcamera() {
            webcam.start()
                .then(result => {
                    console.log("webcam started");
                })
                .catch(err => {
                    console.log(err);
                });
        }

        function prendrephoto() {
            //    var picture = webcam.snap();
            let picture = webcam.snap();
            document.getElementById('image').value = picture;
            //document.querySelector('#download-photo').href = picture;
        }

        webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
        stopcamera();
    </script>
 <script src="./js/script.js"></script>
</body>

</html>