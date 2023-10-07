<?php 
  // Stocker le nom du fichier dans une variable
  $file = './uploads/bcomm10298carte de visite14_04_202313_09_27.pdf'; 
    
  // Type de contenu de l'en-tête
  header('Content-type: application/pdf'); 
    
  header('Content-Disposition: inline; filename="' . $file . '"'); 
    
  header('Content-Transfer-Encoding: binary'); 
    
  header('Accept-Ranges: bytes'); 
    
  // Lire le fichier
  @readfile($file); 
?>
