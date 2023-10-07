<?php
require_once "const.php";


$pointages=isset($_GET['pointage'])?$_GET['pointage']:"";
$infos=isset($_GET['infos'])?$_GET['infos']:"";
$fileName=isset($_GET['fileName'])?$_GET['fileName']:"";

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
    <title>Liste des commandes</title>
    <link rel="stylesheet" href="css/normalize.css">
  
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>

    <title>pointage</title>
    <style>
    canvas {
        border: 1px solid #bbb;
    }
    </style>
</head>
<body>
<video id="webcam" autoplay playsinline width="320" height="320"></video>
<canvas id="canvas" class="d-none" width="320" height="300"></canvas>
<audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio> 


<button class="btn btn-primary" onclick="prendrephoto()"><i class="material-icons">camera_alt</i></button>
<!-- <button class="btn btn-primary" onclick="playcamera()"><i class="material-icons">camera_front</i></button> -->
<!-- <button class="btn btn-primary" onclick="stopcamera()"><i class="material-icons">exit_to_app</i></button> -->
<!-- <button id="download-photo" class="btn btn-primary" class="d-none"><i class="material-icons">file_download</i></button> -->
<form method="POST" action="storeImage.php?pointage=<?= $pointages?>&infos=<?=$infos?>&fileName=<?=$fileName?>">

<input type="hidden" name="image"  id="image"> 

<button type="submit" class="btn btn-lg btn-success">Pointer</button>
</form>
<!-- <a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a> -->
<!-- <div id="cameraControls" class="cameraControls"> -->
<!-- <a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a>
<a href="#" id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a> -->
<!-- <a href="#" id="download-photo" download="selfie.png" target="_blank" title="Save Photo" class="d-none"><i class="material-icons">file_download</i></a>   -->
                    <!-- <a href="#" id="resume-camera"  title="Resume Camera" class="d-none"><i class="material-icons">camera_front</i></a> -->
<!-- </div> -->
<script>

 function  stopcamera(){
    webcam.stop();

 }
 function  playcamera(){
    webcam.start()
   .then(result =>{
      console.log("webcam started");
   })
   .catch(err => {
       console.log(err);
   });  
}
function prendrephoto(){
//    var picture = webcam.snap();
    let picture = webcam.snap();
    document.getElementById('image').value = picture;
//document.querySelector('#download-photo').href = picture;
}

 webcamElement = document.getElementById('webcam');
const canvasElement = document.getElementById('canvas');
const snapSoundElement = document.getElementById('snapSound');
const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
playcamera();
</script>
</body>
</html>