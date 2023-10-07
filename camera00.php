<!DOCTYPE html>
<html>
<head>
    <title>Capture webcam image</title>
       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   <!-- <style type="text/css">
        #results { padding:20px; 
        border:1px solid; 
        background:#ccc; }
    </style>-->
    <link rel="stylesheet" href="css/normalize.css">
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

  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="./css/monstyle.css"> -->
  <link rel="stylesheet" href="./css/style41.css">
  <script src="./js/jquery-3.3.1.js"></script>
  <link rel="icon" href="./images/logo.avif" type="image" />

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
  <style>
    canvas {
        border: 3px solid #bbb;
    }
    </style>
</head>
<body>
  
<div class="container">
<!-- < ?php include('./navbarok.php') ?> -->
    <h1 class="text-center">Pointage automatique</h1>
    <video id="webcam" autoplay playsinline width="320" height="320"></video>
<canvas id="canvas" class="d-none" width="320" height="300"></canvas>
<audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio> 
    <form method="POST" action="storeImage.php?pointage=<?= $pointages?>&infos=<?=$infos?>">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera" class="photo">
                <p class="textover"><?=@$infos?></p>
                </div>
                <br/>
                <input class="center" type=button value="photo" onClick="prendrephoto()">

                <!-- <input class="center" type=button value="Photo/Selphy" onClick="take_snapshot()"> -->
                <input  type="hidden" name="image" class="image-tag">
              
            </div>
            <div class="col-md-6" >
                <div id="results" class="photo"></div>
            </div>
            <div class="col-md-12 text-center">
                <br/><br><br><br>
                <!-- < ?php 
                    // if (isset($_POST) && !empty($_POST)) { ?> -->
                <button class="btn btn-lg btn-success">Pointer</button>
                <!-- < ?php } ?> -->
            </div>
        </div>
    </form>
</div>
  
<!-- Configure a few settings and attach camera -->
<script>

 webcamElement = document.getElementById('webcam');
const canvasElement = document.getElementById('canvas');
const snapSoundElement = document.getElementById('snapSound');
const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

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
//document.querySelector('#results').innerHTML = picture;

//document.write(picture);

}
playcamera();
</script>
 
</body>
</html>