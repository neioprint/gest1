<?php
$file = "test.test.test.test.essai.php";
$file="M. B.O.N.C Extra.jpg";
$extension = substr($file,strrpos($file, "."));
$file2 = substr($file,0,strrpos($file, "."));
$final_file = str_replace('.','',$file2).$extension;
echo $file."<br>";
echo $extension."<br>";
echo $file2."<br>";
echo $final_file."<br>";