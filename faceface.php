<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACE A FACE</title>
    <script src="jquery-2.1.1.min.js"></script>
    <!-- <script src="faceSystem.js"></script> -->
    <script src="face-api.min.js"></script>
</head>
<body>
<div style="position: relative" class="margin">
  <video onplay="onPlay(this)" id="inputVideo" autoplay muted></video>
 
  <canvas id="overlay"></canvas>
  <!-- <canvas id="overlay"/> -->
</div>

<script>
    $(document).ready(function() {
  run()
})
    
async function run() {
  // load the models
  await faceapi.loadMtcnnModel('./models')
  await faceapi.loadFaceRecognitionModel('./models')
  
  // try to access users webcam and stream the images
  // to the video element
  const videoEl = document.getElementById('inputVideo')
  navigator.getUserMedia(
    { video: {} },
    stream => videoEl.srcObject = stream,
    err => console.error(err)
  )
 // 2 partie
 const mtcnnForwardParams = {
  // number of scaled versions of the input image passed through the CNN
  // of the first stage, lower numbers will result in lower inference time,
  // but will also be less accurate
  maxNumScales: 10,
  // scale factor used to calculate the scale steps of the image
  // pyramid used in stage 1
  scaleFactor: 0.709,
  // the score threshold values used to filter the bounding
  // boxes of stage 1, 2 and 3
  scoreThresholds: [0.6, 0.7, 0.7],
  // mininum face size to expect, the higher the faster processing will be,
  // but smaller faces won't be detected
  minFaceSize: 20
}


// const mtcnnForwardParams = {
//   // limiting the search space to larger faces for webcam detection
//   minFaceSize: 200
// }

// const mtcnnResults = await faceapi.mtcnn(document.getElementById('inputVideo'), mtcnnForwardParams)

// 3eme partie
// const mtcnnForwardParams = {
//   // limiting the search space to larger faces for webcam detection
//   minFaceSize: 200
// }

const mtcnnResults = await faceapi.mtcnn(document.getElementById('inputVideo'), mtcnnForwardParams)

//
faceapi.drawDetection('overlay', mtcnnResults.map(res => res.faceDetection), { withScore: true })
faceapi.drawLandmarks('overlay', mtcnnResults.map(res => res.faceLandmarks), { lineWidth: 4, color: 'red' })
//
const alignedFaceBoxes = results.map(
  ({ faceLandmarks }) => faceLandmarks.align()
)

const alignedFaceTensors = await extractFaceTensors(input, alignedFaceBoxes)

const descriptors = await Promise.all(alignedFaceTensors.map(
  faceTensor => faceapi.computeFaceDescriptor(faceTensor)
))

// free memory
alignedFaceTensors.forEach(t => t.dispose())
//
const options = new faceapi.MtcnnOptions(mtcnnParams)
const input = document.getElementById('inputVideo')
const fullFaceDescriptions = await faceapi.detectAllFaces(input, options).withFaceLandmarks().withFaceDescriptors()
//
const labels = ['houarie', 'sid','sofiane','abdou']

const labeledFaceDescriptors = await Promise.all(
  labels.map(async label => {
    // fetch image data from urls and convert blob to HTMLImage element
    const imgUrl = `./labeled_images/${label}.jpg`
    //`${label}.png`
    const img = await faceapi.fetchImage(imgUrl)
    
    // detect the face with the highest score in the image and compute it's landmarks and face descriptor
    const fullFaceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
    
    if (!fullFaceDescription) {
      throw new Error(`no faces detected for ${label}`)
    }
    
    const faceDescriptors = [fullFaceDescription.descriptor]
    return new faceapi.LabeledFaceDescriptors(label, faceDescriptors)
  })
)
//
results.forEach((bestMatch, i) => {
  const box = fullFaceDescriptions[i].detection.box
  const text = bestMatch.toString()
  const drawBox = new faceapi.draw.DrawBox(box, { label: text })
  drawBox.draw(canvas)
  console.log(text)
})
//

// fin
}
async function onPlay(videoEl) {
  // run face detection & recognition
  // ...
//run()
  setTimeout(() => onPlay(videoEl))
}
</script>
</body>
</html>