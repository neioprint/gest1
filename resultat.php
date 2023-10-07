<?php
  function add() {
     // Vérifiez si les paramètres var1 et var2 sont transmis au script via l'URL
     if (isset($_GET["var1"]) && isset($_GET["var2"])) {
      $somme = $_GET["var1"] + $_GET["var2"];
      echo $_GET["var1"]." + ".$_GET["var2"]." = ".$somme;
     }
  }
  add();
?>