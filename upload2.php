<?php
if (session_status() != PHP_SESSION_ACTIVE) {
   session_start();
};
$message = "";
if (isset($_POST["valider"])) {
   //     echo 'Voici quelques informations de débogage :';
   // print_r($_FILES);

   // echo '</pre>';
   // $mess=date(date('d-m-Y H:i')).$_FILES["monfichier"]["name"];
   // $nom="new".time().$_FILES["monfichier"]["name"];
   $nom = $_FILES["monfichier"]["name"];
   //   echo $mess;
   if (!preg_match("#jpeg|png|pdf#", $_FILES["monfichier"]["type"])) {
      // $message='<span class="nook">Format invalide!</span>';
      $_SESSION['erreur'] = 'Format invalide!';
   } elseif ($_FILES["monfichier"]["size"] > 3000000)
      // $message='<span class="nook">Taille trop grande!</span>';
      $_SESSION['erreur'] = 'Taille trop grande!';
   else {
      //  $message='Nom du fichier :<b>'.
      //     // $_FILES["monfichier"]["name"].
      //     $nom.
      //     '</b><br />';
      //  $message.='Nom temporaire du fichier :<b>'.
      //     $_FILES["monfichier"]["tmp_name"].
      //     '</b><br />';
      //  $message.='Type du fichier :<b>'.
      //     $_FILES["monfichier"]["type"].
      //     '</b><br />';
      //  $message.='Taille du fichier :<b>'.
      //     $_FILES["monfichier"]["size"].
      //     ' octets</b><br />';
      if (move_uploaded_file($_FILES["monfichier"]["tmp_name"], "uploads/" . $nom)) {
         //   $message.='<span class="ok">Image chargée avec succès</span>';
         $_SESSION['message'] = 'Fichier chargée avec succès';
         //header('Location: ./commandes/formcommande.php');
         die();
      }
   }
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8" />
   <!-- <style>
         *{
            font-family:arial, sans-serif;
         }
         .nook{
            color:#DD0000;
         }
         .ok{
            color:#00DD00;
         }
      </style> -->
</head>

<body>
   <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
      <input type="file" name="monfichier" /><br />
      <input type="submit" name="valider" value="Envoyer le fichier" />
   </form>
   <!-- < ?php
         echo $message;
      ?> -->
</body>

</html>