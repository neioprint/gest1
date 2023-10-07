<?php 
session_start();
ob_start();
// ini_set("display_errors",1);
// error_reporting(-1);
?>
<!DOCTYPE html>
 <html lang="fr">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
   <h1>kkkkkkkkkkkkkkkkkkkkkkkkk</h1> 
 </body>
 </html>
 <?php
 $content=ob_get_clean();
 
 ?>

 

<?php

echo $content;
//Header('Location: dir.php');
 ?>
