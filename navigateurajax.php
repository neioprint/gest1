<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
<button  id="bouton" type="button">mon bouton</button>
<button onclick="clearTimeout(looping)">Stop it</button>
    <div>
    <p id="annee"></p>
    </div>
<script>
    function looping(){
// for (let i=0; i<30; i++) {
// Sur un changement d'état du select
// $('#bouton').on('click',function() {

    // On récupére l'année
    // var annee = $('#annee').val();
    var annee = Math.random();

    // On fait une requête Ajax
    $.ajax({

        type: 'POST',
        url : 'serveurajax.php',
        data: 'annee='+annee,

        // Ci-dessous c'est le traitement de la réponse
        success: function (reponse) {

            // Analyse et récupération du tableau de données transmis par le serveur
            var data = JSON.parse(reponse);

            // On place les données dans le tableau HTML
            $('#annee').text(data.annee);        
            //console.log(data)    ;
           

        }
    });

//    }//
}
jQuery(document).ready(function() {

// function looping(){
// // for (let i=0; i<30; i++) {
// // Sur un changement d'état du select
// // $('#bouton').on('click',function() {

//     // On récupére l'année
//     // var annee = $('#annee').val();
//     var annee = Math.random();

//     // On fait une requête Ajax
//     $.ajax({

//         type: 'POST',
//         url : 'serveurajax.php',
//         data: 'annee='+annee,

//         // Ci-dessous c'est le traitement de la réponse
//         success: function (reponse) {

//             // Analyse et récupération du tableau de données transmis par le serveur
//             var data = JSON.parse(reponse);

//             // On place les données dans le tableau HTML
//             $('#annee').text(data.annee);        
//             //console.log(data)    ;
           

//         }
//     });

// //    }//
// }
//setInterval(looping,1000);
// });  //
});
</script>   
</body>
</html>