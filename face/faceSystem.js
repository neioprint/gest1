$(document).ready(function(){
                
    async function face() {
        
    const MODEL_URL = './models'
    
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
       
         await faceapi.loadFaceLandmarkModel(MODEL_URL)
         await faceapi.loadFaceRecognitionModel(MODEL_URL)
        // await faceapi.loadFaceExpressionModel(MODEL_URL)

        // accordingly for the other models:
        // await faceapi.loadTinyFaceDetectorModel(MODEL_URL)
        // await faceapi.loadMtcnnModel(MODEL_URL)
        // await faceapi.loadFaceLandmarkModel(MODEL_URL)
        // await faceapi.loadFaceLandmarkTinyModel(MODEL_URL)
        // await faceapi.loadFaceRecognitionModel(MODEL_URL)
        // await faceapi.loadFaceExpressionModel(MODEL_URL)

        const img = document.getElementById('originalImg')
        let faceDescriptions = await faceapi.detectAllFaces(img).withFaceLandmarks().withFaceDescriptors()
            //.withFaceExpressions()
        const canvas = $('#reflay').get(0)
        faceapi.matchDimensions(canvas, img)

        faceDescriptions = faceapi.resizeResults(faceDescriptions, img)
        //faceapi.draw.drawDetections(canvas, faceDescriptions)
        //faceapi.draw.drawFaceLandmarks(canvas, faceDescriptions)
        //faceapi.draw.drawFaceExpressions(canvas, faceDescriptions)

        
        const labels = ['houarie', 'sid','sofiane','abdou']

        const labeledFaceDescriptors = await Promise.all(
            labels.map(async label => {

                const imgUrl = `./labeled_images/${label}.jpg`
                const img = await faceapi.fetchImage(imgUrl)
                
                const faceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                
                if (!faceDescription) {
                throw new Error(`no faces detected for ${label}`)
                }
                
                const faceDescriptors = [faceDescription.descriptor]
                return new faceapi.LabeledFaceDescriptors(label, faceDescriptors)
            })
        );

        const threshold = 0.6
        const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, threshold)
        //console.log(faceMatcher)
        const results = faceDescriptions.map(fd => faceMatcher.findBestMatch(fd.descriptor))
        console.log(results);
        //document.write(results)
        results.forEach((bestMatch, i) => {
            const box = faceDescriptions[i].detection.box
           
            const text = bestMatch.toString()
            //console.log(bestMatch)
            console.log(text)
           
            const drawBox = new faceapi.draw.DrawBox(box, { label: text })
            drawBox.draw(canvas)
        })

    }
    
    face()
})
