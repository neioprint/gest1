<?php
$servername = "localhost";
$username = "globa932_globa932";
$password = "exp2581exp";

try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE mabase";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Database created successfully<br>";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>




<!-- if ($serveur=="local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp'); -->