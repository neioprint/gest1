// const { FaceDetection } = require("face-api.js")

$(document).ready(function () {
      
    async function face() {
        
        const MODEL_URL = './models'
        
    //const useTinyModel = true
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
    await faceapi.loadTinyFaceDetectorModel(MODEL_URL)
         await faceapi.loadFaceLandmarkModel(MODEL_URL)
        await faceapi.loadFaceRecognitionModel(MODEL_URL)
        
        
        
        // await faceapi.loadFaceExpressionModel(MODEL_URL)

        // accordingly for the other models:
        
        // await faceapi.loadMtcnnModel(MODEL_URL)
        // await faceapi.loadFaceLandmarkModel(MODEL_URL)
        // await faceapi.loadFaceLandmarkTinyModel(MODEL_URL)
        // await faceapi.loadFaceRecognitionModel(MODEL_URL)
        // await faceapi.loadFaceExpressionModel(MODEL_URL)

        const img = document.getElementById('originalImg')
        let faceDescriptions = await faceapi.detectAllFaces(img).withFaceLandmarks().withFaceDescriptors()
       // let faceDescriptions = await faceapi.detectAllFaces(img)
            
            //.withFaceLandmarks()
           // .withFaceDescriptors()
        //let faceDescriptions = await faceapi.detectAllFaces(img, new faceapi.TinyFaceDetectorOptions())
            //.withFaceExpressions()
        const canvas = $('#reflay').get(0)
        faceapi.matchDimensions(canvas, img)

        faceDescriptions = faceapi.resizeResults(faceDescriptions, img)
        //faceapi.draw.drawDetections(canvas, faceDescriptions)
        //faceapi.draw.drawFaceLandmarks(canvas, faceDescriptions)
        //faceapi.draw.drawFaceExpressions(canvas, faceDescriptions)

        
        //const labels = ['houarie', 'sid','Sofiane','abdou']
        const labels = ['sid','Sofiane','houarie']
        const labeledFaceDescriptors = await Promise.all(
            labels.map(async label => {
                const descriptions = []
                for (let i = 1; i <= 2; i++) {
                  const img = await faceapi.fetchImage(`./labeled_images/${label}/${label}${i}.png`)
                    const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                    if (!detections) {
                             throw new Error(`no faces detected for ${label}`)
                             } 
                  descriptions.push(detections.descriptor)
                }
          
                return new faceapi.LabeledFaceDescriptors(label, descriptions)
              })   
              ) 
        
      
//
//
//const labeledFaceDescriptors = await Promise.all(
    // labels.map(async label => {

    //     const imgUrl = `./labeled_images/${label}/${label}2.png`
    //     const img = await faceapi.fetchImage(imgUrl)
        
    //     const faceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
        
    //     if (!faceDescription) {
    //     throw new Error(`no faces detected for ${label}`)
    //     }
        
    //     const faceDescriptors = [faceDescription.descriptor]
    //     return new faceapi.LabeledFaceDescriptors(label, faceDescriptors)
    // })
//);       
//
        const threshold = 0.6
        const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, threshold)
        //console.log(faceMatcher)
        const results = faceDescriptions.map(fd => faceMatcher.findBestMatch(fd.descriptor))
        //console.log(results);
        //document.write(results)
        let text
        results.forEach((bestMatch, i) => {
            const box = faceDescriptions[i].detection.box
           
            //text = bestMatch.toString()
            text = bestMatch
            //console.log(text)
           
            const drawBox = new faceapi.draw.DrawBox(box, { label: text.label.toString()+"Reconnu" })
            drawBox.draw(canvas)
            //console.log(text)
             console.log(text.label) 
                 console.log(text.distance)
            
        })
        console.log(salarie);
        console.log(fileName);
        window.location.href = "./reussi.php?salarie="+text.label+"&areconnaitre="+salarie+"&pointage="+pointages+"&infos="+infos+"&fileName="+fileName
        
    }
   
    face()
})
// var salarie = <?php echo json_encode($salarie); ?>;
//      var pointages = <?php echo json_encode($pointages); ?>;
//      var infos = <?php echo json_encode($infos); ?>;