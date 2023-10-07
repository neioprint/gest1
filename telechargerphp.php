<?php 
//   $url = 'https://waytolearnx.com/wp-content/uploads/2018/09/cropped-logoWeb.png'; 
  $url = './uploads/100-114-ticket dyner-07-12-2022 15.png'; 
    
  // Utilisez la fonction basename pour renvoyer le nom du fichier.
  $file_name = basename($url); 
     
  /* Utiliser la fonction file_get_contents() pour récupérer le fichier
  depuis l'url et utilise la fonction file_put_contents() pour
  sauvegarde le fichier */
  if(file_put_contents( $file_name,file_get_contents($url))) { 
    echo "Fichier téléchargé avec succès"; 
  } 
  else { 
    echo "Le téléchargement du fichier a échoué."; 
  }
?>