<?php
$message = "";
if (isset($_POST["valider"])) {
   //     echo 'Voici quelques informations de débogage :';
   // print_r($_FILES);

   // echo '</pre>';
   $mess = $_FILES["monfichier"]["name"];
   echo $mess;
   echo "<br>";
   echo $_FILES["monfichier"]["type"];
   echo "<br>";
   $trouve = preg_match("#application/octet-stream#", $_FILES["monfichier"]["type"]);
   echo $trouve;
   echo "<br>";
   if (!$trouve) {

      $message = '<span class="nook">Format invalide!</span>';
   } elseif ($_FILES["monfichier"]["size"] > 2000000)
      $message = '<span class="nook">Taille trop grande!</span>';
   else {
      $message = 'Nom du fichier :<b>' .
         $_FILES["monfichier"]["name"] .
         '</b><br />';
      $message .= 'Nom temporaire du fichier :<b>' .
         $_FILES["monfichier"]["tmp_name"] .
         '</b><br />';
      $message .= 'Type du fichier :<b>' .
         $_FILES["monfichier"]["type"] .
         '</b><br />';
      $message .= 'Taille du fichier :<b>' .
         $_FILES["monfichier"]["size"] .
         ' octets</b><br />';
      if (move_uploaded_file($_FILES["monfichier"]["tmp_name"], "uploads/" . $_FILES["monfichier"]["name"]))
         $message .= '<span class="ok">Image chargée avec succès</span>';
   }
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8" />
   <style>
      * {
         font-family: arial, sans-serif;
      }

      .nook {
         color: #DD0000;
      }

      .ok {
         color: #00DD00;
      }
   </style>
</head>

<body>
   <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
      <input type="file" name="monfichier" /><br />
      <input type="submit" name="valider" value="Uploader" />
   </form>
   <?php
   echo $message;
   ?>
</body>

</html>