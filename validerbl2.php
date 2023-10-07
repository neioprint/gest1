<?php
$id = strip_tags($_GET['id']);
//print_r($id)  ;
//die();
ini_set("display_errors", 1);
error_reporting(-1);
if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
};
if (!isset($_SESSION['user'])) {
      header('Location:login.php');
      exit();
}
//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
if (@$_SESSION['valider'] != "oui") {
      $fp = fopen("./numbl.txt", "r+");
      $nbr = fgets($fp);
      //    if(@$_SESSION['deja']=="oui"){
      $nbr += 1;
      fseek($fp, 0);
      fputs($fp, $nbr);
      fclose($fp);
      $_SESSION['valider'] = "oui";
}
header("Location: blivraisoncommande.php?id=$id");
die;
