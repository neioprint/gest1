<?php
function coquille($nompapier,$formatpapierx,$formatpapiery,$formatmodelx,$formatmodely,$coupex,$coupey,$coupextransversal,$coupeytransversal){
    echo "Votre papier est ".$nompapier." son format est ".$formatpapierx."X".$formatpapiery;
    echo "<br>";
    echo "Votre model son format est ".$formatmodelx."X".$formatmodely;
    echo "<br>";  echo "<br>";
  //  echo "nombre de poses coupe ".$nbreposecoupe;
   echo "<br>";
//   echo "nombre de poses tirage ".$nbreposetirage;
   
   echo "<br>";  echo "<br>";
 //  echo "nombre de pose selon calcul en cm carre ".$operationpose;  
   echo "<br>";    echo "<br>";  


   echo "coupe droite donne selon X $formatmodelx ".$formatpapierx. "      <br>".$coupex. "poses chute $modcoupex cm sur $formatpapiery";
   echo "<br>";   echo "<br>";
   echo "coupe droite donne selon Y $formatmodely ".$formatpapiery. "     <br> ".$coupey. "poses chute $modcoupey cm sur $formatpapierx";
   echo "<br>";   echo "<br>";
   echo "coupe transversale donne selon X $formatmodelx ".$formatpapiery. "    <br>".$coupextransversal. "poses  chute $modcoupextransversal cm sur $formatpapierx";
   echo "<br>"; echo "<br>";   echo "<br>";
 
   echo "coupe transversale donne selon Y $formatmodely ".$formatpapierx. "    <br>".$coupeytransversal. "poses chute   $modcoupeytransversal cm sur $formatpapiery";
   echo "<br>";   echo "<br>";
 
   echo "Alors la coupe droite retenue est chute $modcoupex cm sur $formatpapiery et $modcoupey cm sur $formatpapierx";
   echo "<br>";
 //  echo $nbpose1;
   echo "<br>";
   echo "Alors la coupe transversale retenue est  chute   $modcoupeytransversal cm sur $formatpapiery et $modcoupextransversal cm sur $formatpapierx";
   echo "<br>";
//   echo $nbpose2;
   echo "<br>";
return true;
}