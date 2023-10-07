<?php
require_once "const.php";

$pointages=isset($_GET['pointage'])?$_GET['pointage']:"";
$infos=isset($_GET['infos'])?$_GET['infos']:"";
$fileName=isset($_GET['fileName'])?$_GET['fileName']:"";

?>

<!-- ********************************************************************** -->
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

    <style type="text/css">
    .photo{
        position: relative;
    }
    .textover{
        position:absolute;
        left:50%;
        top:5%;
        transform:translateX(-50%);
    }

 </style> 


    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>

    <title>Document</title>
    <style>
    canvas {
        border: 1px solid #bbb;
    }
    </style>
</head>
<body>
<video id="webcam" autoplay playsinline width="640" height="480"></video>
<canvas id="canvas" class="d-none" width="320" height="300"></canvas>
<audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio> 


<button class="btn btn-primary" onclick="prendrephoto()"><i class="material-icons">camera_alt</i></button>
<!-- <button class="btn btn-primary" onclick="playcamera()"><i class="material-icons">camera_front</i></button> -->
<!-- <button class="btn btn-primary" onclick="stopcamera()"><i class="material-icons">exit_to_app</i></button> -->
<!-- <button id="download-photo" class="btn btn-primary" class="d-none"><i class="material-icons">file_download</i></button> -->
<!-- <input type="hidden" name="image" class="image-tag"> -->
<!-- <a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a> -->
<!-- <div id="cameraControls" class="cameraControls"> -->
<!-- <a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a>
<a href="#" id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a> -->
<!-- <a href="#" id="download-photo" download="selfie.png"  title="Save Photo" class="d-none"><i class="material-icons">file_download</i></a>   -->
                    <!-- <a href="#" id="resume-camera"  title="Resume Camera" class="d-none"><i class="material-icons">camera_front</i></a> -->
<!-- </div> -->

<form method="POST" action="storeImage.php?pointage=<?= $pointages?>&infos=<?=$infos?>">
       
           
                <p class="textover"><?=@$infos?></p>
                
                <br/>
                <!-- <input class="center" type=button value="Photo/Selphy" onClick="take_snapshot()"> -->
                <!-- <button class="btn btn-lg btn-success" onClick="take_snapshot()"><i class="material-icons">camera_alt</i></button>
                <input type="hidden" name="image" class="image"> -->
          
           
               
                <button class="btn btn-lg btn-success">Pointer</button>
             
   
    </form>
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
    document.querySelector('.image').href = picture;
//   document.write(picture);
//document.querySelector('#download-photo').href = picture;
//var dataURL = canvas.toDataURL();
//canvas.toDataURL('png');

}
 webcamElement = document.getElementById('webcam');
const canvasElement = document.getElementById('canvas');
const snapSoundElement = document.getElementById('snapSound');
const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
webcam.start()
</script>
</body>
</html>


<!-- ********************************************************************** -->
























 

