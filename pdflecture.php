<?php 
  // Stocker le nom du fichier dans une variable
  $file = 'uploads/111-117-carte de visite-11-12-2022 15.pdf'; 
    
  // Type de contenu de l'en-tête
  header('Content-type: application/pdf'); 
    
  header('Content-Disposition: inline; filename="' . $file . '"'); 
    
  header('Content-Transfer-Encoding: binary'); 
    
  header('Accept-Ranges: bytes'); 
    
  // Lire le fichier
  @readfile($file); 
?>