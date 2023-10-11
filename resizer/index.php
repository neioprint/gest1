<html>
	<body>
		<!-- <h3>Lire l'article sur : <a href="" target="_blank">Redimensionner une image en PHP</a></h3> -->

		<form name="frmImageResize" action="" method="post" enctype="multipart/form-data">
			<input type="file" name="myImage" /> 
			<input type="submit" name="submit" value="Submit" />
		</form>

<?php
    if(isset($_POST['submit'])){
		var_dump($_FILES);
      if (isset ($_FILES['myImage'])){
		$imagename = $_FILES['myImage']['name'];
		$source = $_FILES['myImage']['tmp_name'];

		$imagepath = $imagename;
		//Ceci est le nouveau fichier que vous enregistrez
		$save = "images/" . $imagepath; 

		$info = getimagesize($imagepath);
		echo "<br>";
		$mime = $info['mime'];
		var_dump($info);
		switch ($mime) {
				case 'image/jpeg':
						$image_create_func = 'imagecreatefromjpeg';
						$image_save_func = 'imagejpeg';
						break;

				case 'image/png':
						$image_create_func = 'imagecreatefrompng';
						$image_save_func = 'imagepng';
						break;

				case 'image/gif':
						$image_create_func = 'imagecreatefromgif';
						$image_save_func = 'imagegif';
						break;

				default: 
						throw new Exception('Unknown image type.');
		}
		  
		list($width, $height) = getimagesize($imagepath);
		$modwidth = 300;  //target width
		$diff = $width / $modwidth;
		$modheight = $height / $diff;

		$tn = imagecreatetruecolor($modwidth, $modheight) ;
		$image = $image_create_func($imagepath) ;
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

		$image_save_func($tn, $save) ;
		  
		echo '<img src="'.$save.'">';
      }
    }
?>
	</body>
</html>