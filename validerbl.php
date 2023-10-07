<?php
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
if (isset($_GET['idclient'])) {
      //  if (isset($_GET['page'])) 
      // @$page=$_GET['page']; 
      //else $page=1;
      $trieclientid = $_GET['idclient'];
}

if (isset($_GET['idclient'])) {

    
      $datebl = $_GET['datebl'];
}


if (@$_SESSION['valider'] === "non" && @$_SESSION['valider'] != "deja") {
      $fp = fopen("./numbl.txt", "r+");
      $nbr = fgets($fp);
      //    if(@$_SESSION['deja']=="oui"){
      $nbr += 1;
      fseek($fp, 0);
      fputs($fp, $nbr);
      fclose($fp);
      $_SESSION['valider'] = "oui";

      $_SESSION['message'] .= "Bon de livraison Validé ";
} else $_SESSION['message'] .= "Bon de livraison Déja Validé ";
header("Location: blivraisonneioselection.php?idclient=$trieclientid&datebl=$datebl");
die;
