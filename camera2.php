<?php
require_once "const.php";
   
if (!empty($_SESSION['message'])) {
    
    echo '<div class="alert alert-success .alert-dismissible" role="alert">

    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['message'] . '
        </div>';
        
  
        //$messageJson=json_encode($_SESSION['message']);
?>
 <!-- <script>
 let message=JSON.parse('< ?php echo $messageJson; ?>');
 travail(message)
 </script>  -->
<?php
 $_SESSION['message'] = "";
  
}

if (!empty($_SESSION['erreur'])) {
    echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['erreur'] . '
        </div>';
  
        // $messageJson=json_encode($_SESSION['erreur']);
?>
<!-- <script>
    // let message=JSON.parse('< ?php echo $messageJson; ?>');
    //         probtravail(message)
    //         </script> -->
<?php
    $_SESSION['erreur'] = "";

}
$pointages=isset($_GET['pointage'])?$_GET['pointage']:"";
$infos=isset($_GET['infos'])?$_GET['infos']:"";
$fileName=isset($_GET['fileName'])?$_GET['fileName']:"";

?>


<!DOCTYPE html>
<html lang="fr">
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

    <link rel="stylesheet" href="./css/styleloader.css">
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->




    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
   

    <title>pointage</title>
    <!-- <style>
    canvas {
        border: 1px solid #bbb;
    }
    </style> -->
<style>
#webcam {
 
  /* border: 1px solid black;
  box-shadow: 2px 2px 3px black; */
  width: 320px;
  height: 240px;
}

#photo {
  /* border: 1px solid black;
  box-shadow: 2px 2px 3px black; */
  width: 320px;
  height: 240px;
}

/* #canvas {
  display: none;
} */

.camera {
  width: 320px;
  height: 240px;
  /* display: inline-block; */
}

/* .output {
  width: 320px;
  display: inline-block;
  vertical-align: top;
} */

#startbutton {
  display: block;
  position: relative;
  margin-left: auto;
  margin-right: auto;
  bottom: 85px;
  background-color: rgba(0, 150, 0, 0.5);
  /* border: 1px solid rgba(255, 255, 255, 0.7); */
  /* box-shadow: 0px 0px 1px 2px rgba(0, 0, 0, 0.2); */
  font-size: 16px;
  font-family: "Lucida Grande", "Arial", sans-serif;
  color: rgba(255, 255, 255, 1);
}

.contentarea {
  font-size: 16px;
  font-family: "Lucida Grande", "Arial", sans-serif;
  width: 320px;
}    
</style>
</head>
<body>
<div class="loader-container">
        <div class="loader">

        </div>
</div>
<!-- < ?php 
    require_once('./navbarok.php') ?> -->
    <br>
<div class="contentarea">
    <video id="webcam" autoplay playsinline width="320" height="240"></video>

    <audio id="snapSound" src="audio/snap3.wav" preload = "auto"></audio> 

    <div class="camera">
    <button id="startbutton" class="btn btn-primary" onclick="prendrephoto()">
    <i class="material-icons">camera_alt</i>
  </button>

<!-- <button id="startbutton"><i class="material-icons">camera_alt</i></button> -->
<!-- <button class="btn btn-primary" onclick="playcamera()"><i class="material-icons">camera_front</i></button> -->
<!-- <button class="btn btn-primary" onclick="stopcamera()"><i class="material-icons">exit_to_app</i></button> -->
<!-- <button id="download-photo" class="btn btn-primary" class="d-none"><i class="material-icons">file_download</i></button> -->
    <form method="POST" action="storeImage.php?pointage=<?= $pointages?>&infos=<?=$infos?>&fileName=<?=$fileName?>">

    <input type="hidden" name="image"  id="image"> 

    <button  type="submit" id="startbutton" class="btn btn-success">Pointer</button>
  </form>
  <button class="btn btn-primary btn-lg btn-info" onclick="history.back()">Retour</button>
<canvas id="canvas" class="d-n one" width="320" height="240"></canvas>
  </div>
</div>
<!-- <a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a> -->
<!-- <div id="cameraControls" class="cameraControls"> -->
<!-- <a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a>
<a href="#" id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a> -->
<!-- <a href="#" id="download-photo" download="selfie.png" target="_blank" title="Save Photo" class="d-none"><i class="material-icons">file_download</i></a>   -->
                    <!-- <a href="#" id="resume-camera"  title="Resume Camera" class="d-none"><i class="material-icons">camera_front</i></a> -->
<!-- </div> -->
<script>
  var device = 0;
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
//change_device()
playcamera();

// function change_device() {
//             if (Webcam.on) {
//                 Webcam.reset();
//             }
//             if (device == 0){
//                 device = 1;
//             } else {
//                 device = 0;
//             }
//          //   initCam();    

//         }
</script>

    <script src="./js/script.js"></script>
</body>
</html>