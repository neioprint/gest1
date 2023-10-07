<?php 
$afficherbc = isset($_GET['bc']) ? $_GET['bc'] : "";
//echo $afficherbc;
//require_once "const.php";
  // Stocker le nom du fichier dans une variable
  $file = './uploads/cartedevisite.pdf'; 
    
  // Type de contenu de l'en-tête
  header('Content-type: application/pdf'); 
    
  header('Content-Disposition: inline; filename="' . $file . '"'); 
    
  header('Content-Transfer-Encoding: binary'); 
    
  header('Accept-Ranges: bytes'); 
    
  // Lire le fichier
  @readfile($file); 
?>