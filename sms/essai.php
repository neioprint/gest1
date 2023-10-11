<?php
$NomUtilisateur = "neio";
$MotDePasse = "Exp2581exp$";
$autorisation = "Basic " . base64_encode($NomUtilisateur . ":" . $MotDePasse);
echo $autorisation;
?> 