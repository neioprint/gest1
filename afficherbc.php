
<?php $afficherbc = isset($_GET['bc']) ? $_GET['bc'] : "";
//echo $afficherbc;

// require interdit da,s ce fichier erreur d'affichage de pdf
//require_once "const.php";

$file = "uploads/".$afficherbc; 
//$file = './uploads/cartedevisite.pdf'; 
// echo $afficherbc;
//   echo "<br>";
//   echo $file;
 // die();
//$file = 'bc.pdf'; 
//echo $file;
//die(); 
//$file = './uploads/cartedevisite.pdf'; 
    
// Type de contenu de l'en-tête
header('Content-type: application/pdf'); 
  
header('Content-Disposition: inline; filename="' . $file . '"'); 
  
header('Content-Transfer-Encoding: binary'); 
  
header('Accept-Ranges: bytes'); 
  
// Lire le fichier
@readfile($file); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>


<link rel="stylesheet" href="css/normalize.css">

<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">

<link rel="stylesheet" href="./css/style41.css">
<script src="./js/jquery-3.3.1.js"></script> -->
<link rel="icon" href="./images/logo.avif" type="image" />
<style>
.container {
  position: relative;
  width: 100%;
  /* max-width: 400px; */
} 

.container img {
  width: 100%;
  height: auto;
}

.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: blue;
  color: white;
  font-size: 24px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

.container .btn:hover {
  background-color: red;
}
</style>
</head>
<body>

<!-- <h2>Button on Image</h2>
<p>Add a button to an image:</p> -->
<br><br>
<div class="container">

  <!-- <img src="uploads/< ?= $afficherimage ?>" alt="Snow" style="width:100%"> -->
  <!-- <embed src="./uploads/< ?php echo $afficherbc ?>" width="800" height="1200" type="application/pdf"/></embed> -->
  <!-- <iframe src="./uploads/< ?=$afficherbc?>" width="600" height="800" type="application/pdf"></iframe> -->

     <!-- <iframe src="https://docs.google.com/viewer?embedded=true&url=https://neio.global2pub.com/uploads/< ?= $afficherbc ?>" width="500" height="800"></iframe> -->

<!-- <iframe src="https://docs.google.com/viewer?embedded=true&url=FILE_URL" style="width: 100%; height: 400px; border: none;"></iframe> -->

  <!-- http://docs.google.com/gview?url=, le lien vers le PDF et le paramètre &embedded=true -->
  <button class="btn" onclick="history.back()">Retour</button>
</div>

</body>
</html>
<!-- deuxieme methode -->
<!-- < ?php 
  // Le chemin du fichier (path) 
  $file = "/chemin/vers/fichier.pdf"; 
    
  // Type de contenu d'en-tête
  header("Content-type: application/pdf"); 
    
  header("Content-Length: " . filesize($file)); 
    
  // Envoyez le fichier au navigateur.
  readfile($file); 
?> -->