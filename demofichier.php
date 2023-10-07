<?php
session_start();
$_SESSION["favcolor"] = "green";
//$GLOBALS["valider"]="je suis globale oui";
echo $_SESSION["favcolor"];
ini_set("display_errors",1);
error_reporting(-1);

//echo @$_SESSION['deja'];
   $fp=fopen("compteur.txt","r+");
   $nbr=fgets($fp);
//    if(@$_SESSION['deja']=="oui"){
      $nbr+=1;
      fseek($fp,0);
      fputs($fp,$nbr);
      //$_SESSION['deja']="oui";
//  } else $_SESSION['deja']="oui";
   echo "Cette page a été visitée $nbr fois.";
//echo $_SESSION['deja'];
//unset($_SESSION['deja']);
//echo $_SESSION['deja'];
?>