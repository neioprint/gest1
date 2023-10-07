<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="myImage">
    <img src="./pointage/63e95bf889f8b.png" alt="">
</div>
<script src="./node_modules/face-api.js/dist/face-api.js"></script>  
<script>
const input = document.getElementById('myImage')
let fullFaceDescriptions = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()



</script> 
</body>
</html>