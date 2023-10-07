<?php
 $current_dir = getcwd();
//  echo $current_dir;
//  echo "<br>";
$target_dir = "../up/";
@$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//print_r($_POST["submit"]);
// Check if image file is a actual image or fake image
if
//(isset($_POST["submit"]) && !empty($_POST["submit"]) &&
(isset($_POST["fileToUpload"]) && !empty($_POST["fileToUpload"])
) {
  //print_r($_POST["submit"]);
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "Fichier image - " . $check["mime"] . ".";
    echo "<br>";
    $uploadOk = 1;
  } else {
    echo "Ce fichier n'est pas une image.";
    echo "<br>";
    $uploadOk = 0;
  }

}
 // ivi
// Check if file already exists
if (file_exists($target_file)) {
  echo "Désolé, ce fichier existe déja.";
  echo "<br>";
  $uploadOk = 0;
} 


// Check file size
if (@$_FILES["fileToUpload"]["size"] > 500000) {
  echo "Désole,Votre fichier est trop grand .";
  echo "<br>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Désolé, Seulement JPG, JPEG, PNG & GIF fichier sont autorisés.";
  echo "<br>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Désolé, Votre fichier n'a pas été téléchargé.";
  echo "<br>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " à été telecharger.";
  } else {
    echo "Désolé, une erreur s'est produite.";
  }
}


?>



<form id="commande-form" name="fo"  method="post" enctype="multipart/form-data">

      <div class="form-group">
                <label for="fileToUpload">Fichier d'impression (PDF,jpg,png,cdr) </label> <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="fileToUpload" value="fileToUpload" />
                <br>
               
      </div>
             
      
          
              <button type="submit" class="btn btn-success" name="submit" 
              id="submit" value="Envoyer Commande" class="btn btn-success">Ajouter COMMANDE</button>
        </form>
