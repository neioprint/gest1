<html>
<head>
   <title>Open webcam using JavaScript. </title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
</head>
<body>
   <h1>Open WebCam Using JavaScript</h1>
   <br/>
   <!-- <button id="startBtn" onclick="openCam()">Open Webcam</button> -->
   <br/><br/>
   <video id="videoCam"></video>
   <script>
      function openCam(){
         let All_mediaDevices=navigator.mediaDevices
         if (!All_mediaDevices || !All_mediaDevices.getUserMedia) {
            console.log("getUserMedia() not supported.");
            return;
         }
         All_mediaDevices.getUserMedia({
            audio: false,
            video: true
         })
         .then(function(vidStream) {
            var video = document.getElementById('videoCam');
            if ("srcObject" in video) {
               video.srcObject = vidStream;
            } else {
               video.src = window.URL.createObjectURL(vidStream);
            }
            video.onloadedmetadata = function(e) {
               video.play();
            };
         })
         .catch(function(e) {
            console.log(e.name + ": " + e.message);
         });
      }
      openCam();
   </script>
</body>
</html>