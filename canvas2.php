<?php

        //$formatxxyy = $chainematiere[3];
        //$formatcoupe = strip_tags($_POST['formatcoupe']);
       
        //$formatTirage = $formatcoupe;
        
  // verification des calcul de poses selon format papier

        //$nbreposetirage = strip_tags($_POST['nbreposetirage']);
        //$nompapier=$chainematiere[1];
        // $formatpapier=$chainematiere[3];
        $formatpapier="65X100";
          // le papier doit etre classe selon l'ordre le plus petit à gauche
        // le plus grand à droite 
        $formatpapier=explode('X',$formatpapier);
       
        $formatpapierx=$formatpapier[0];
        $formatpapiery=$formatpapier[1];
        //$grampapier=$chainematiere[2];
        $formatmodel="15X25";
        $formatmodel=explode('X',$formatmodel);
        
        //explode('X',$formatcoupe);
        $formatmodelx=$formatmodel[0];
        $formatmodely=$formatmodel[1];
        // le model doit etre classe selon l'ordre le plus petit à gauche
        // le plus grand à droite 
        if ($formatmodelx>$formatmodely) {
            $formatmodelx=$formatmodel[1];
            $formatmodely=$formatmodel[0];
        }
        $formatpapiercarre= $formatpapierx* $formatpapiery;
        $formatmodelcarre=$formatmodelx*$formatmodely;
        $operationpose=$formatpapiercarre/$formatmodelcarre;

        // calcul pour coupe coquille
        $opx=(int)($formatpapierx/($formatmodelx+$formatmodely));
        $opy=(int)($formatpapiery/($formatmodelx+$formatmodely));
       
        if ($opy>=2) {

                      
                        $denomy1=(int)($formatpapierx/$formatmodelx);
                        $denomy2=(int)($formatpapierx/$formatmodely);
                        $denomfinaly=(int)(($denomy1+$denomy2)*$opy);
                     
                        $denomfinalx=0;
                        }
  
        if ($opx>=2) {
        
            $denomx1=(int)($formatpapiery/$formatmodelx);
            $denomx2=(int)($formatpapiery/$formatmodely);
            $denomfinalx=(int)(($denomy1+$denomy2)*$opx);
   
            $denomfinaly=0;

                        }              
  
     


        $coupex=($formatpapierx/$formatmodelx);
        $modcoupex=(int) ($formatpapierx/$formatmodelx);
        $valeurx=(int)(($coupex-$modcoupex)*$formatmodelx);
        $coupeintx=(int)($formatpapierx/$formatmodelx);
      
        $coupey=($formatpapiery/$formatmodely);
        $modcoupey=(int) ($formatpapiery/$formatmodely);
        $valeury=(int)(($coupey-$modcoupey)*$formatmodely);
        $coupeinty=(int)($formatpapiery/$formatmodely);
     
        
        $coupextrans=($formatpapierx/$formatmodely);
        $modcoupextrans=(int) ($formatpapierx/$formatmodely);
        $valeurxtrans=(int)(($coupextrans-$modcoupextrans)*$formatmodely);
        $coupeintxtrans=(int)($formatpapierx/$formatmodely);
      


        $coupeytrans=($formatpapiery/$formatmodelx);
        $modcoupeytrans=(int) ($formatpapiery/$formatmodelx);
        $valeurytrans=(int)(($coupeytrans-$modcoupeytrans)*$formatmodelx);
        $coupeintytrans=(int)($formatpapiery/$formatmodelx);
    

        $nbrepose=0;
        $nbpose1=$coupeintx*$coupeinty;
        $nbpose2=$coupeintxtrans*$coupeintytrans;

    
        $formatchute="00x00";

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if ($nbpose1>$nbpose2) {
    // echo "nombre de poses1 $nbpose1";

    if ($nbpose1>@$denomfinalx && $nbpose1>@$denomfinaly ){
                                       $nbreposecoupe=$nbpose1;
                                       if ($valeurx!=0) $formatchute ="$valeurx X  $formatpapiery "; 
                                       if ($valeury!=0) $formatchute.=" et $valeury X  $formatpapierx" ;
                                                   } else if ($nbpose1<$denomfinalx) {
                                                                                       $nbreposecoupe=$denomfinalx;
                                                                                       } else if ($nbpose1<$denomfinaly)
                                                                                       $nbreposecoupe=$denomfinaly;
                                                                                      

  
   
   //  $nbreposecoupe=$nbpose1;
   //  $formatchute ="$valeurx X  $formatpapiery et $valeury X  $formatpapierx" ;
    
   }
    
    else  { 
        //    echo "nombre de poses2 $nbpose2";
           if ($nbpose2>$denomfinalx && $nbpose2>$denomfinaly) {
               $nbreposecoupe=$nbpose2;
               if ($valeurxtrans!=0) $formatchute ="$valeurxtrans X  $formatpapiery "; 
               if ($valeurytrans!=0) $formatchute.=" et $valeurytrans X  $formatpapierx" ;

               // $formatchute ="$valeurxtrans X  $formatpapiery et $valeurytrans X $formatpapierx" ;
                           } else if ($nbpose2<$denomfinalx) {
                                                               $nbreposecoupe=$denomfinalx;
                                                               } else if ($nbpose2<$denomfinaly)
                                                               $nbreposecoupe=$denomfinaly;




          

           
           }
// je cree une fonction



//$resultatcoquille=coquille($nompapier,$formatpapierx,$formatpapiery,$formatmodelx,$formatmodely,$coupex,$coupey,$coupextransversal,$coupeytransversal);
//var_dump($resultatcoquille);
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Shema de coupe</h1>
<div>


<canvas id="myCanvas" width="1070" height="700" style="border:3px dashed blue;">

</canvas> 

</div>
<!-- $nbpose1=$coupeintx*$coupeinty;
        $nbpose2=$coupeintxtrans*$coupeintytrans; -->
<script>
const canvas = document.getElementById("myCanvas");
const ctx = canvas.getContext("2d");
let origine=20;
let formatdiv=<?=$formatpapiery ?>/2;



// test du choix des poses
// $nbpose1=$coupeintx*$coupeinty;
//         $nbpose2=$coupeintxtrans*$coupeintytrans;
if (<?=$nbpose1 ?>><?= $nbpose2 ?>) {
                                var bouclei=<?= $coupeintx?>;
                                var bouclej=<?= $coupeinty?>;
                                console.log(bouclei);
                                console.log(bouclej);
                                } 
                            else                          
                            {
                               
                                var bouclei=<?= $coupeintxtrans?>;
                             bouclej=<?= $coupeintytrans?>;
                            console.log(bouclei);
                                console.log(bouclej);
                                }



// console.log(< ?=$nbpose1 ?>);
// console.log(< ?=$nbpose2 ?>);
// console.log(< ?= $coupeintxtrans?>);
// console.log(< ?= $coupeintytrans?>)
// console.log(bouclei);
// console.log(bouclej);
if (<?=$nbpose1 ?>><?= $nbpose2 ?>) {
                                    var chutey=(<?=$formatpapiery ?>-bouclei*<?=$formatmodely ?>)*10;
                                    var chutex=(<?=$formatpapierx ?>-bouclej*<?=$formatmodelx ?>)*10;

                                    var longposey=(<?=$formatmodely ?>*bouclei)*10;
                                    var longposex=(<?=$formatmodelx ?>*bouclej)*10;
                                    } else {

                                        var chutex=(<?=$formatpapierx ?>-bouclei*<?=$formatmodely ?>)*10;
                                        var chutey=(<?=$formatpapiery ?>-bouclej*<?=$formatmodelx ?>)*10;

                                        var longposex=(<?=$formatmodelx ?>*bouclei)*10;
                                         var longposey=(<?=$formatmodelx ?>*bouclej)*10;
                                    }

console.log("$formatmodely="+<?=$formatmodely ?>);
console.log("$formatmodelx="+<?=$formatmodelx ?>);
console.log("$formatpapierx="+<?=$formatpapierx ?>);
console.log("$formatpapiery="+<?=$formatpapiery ?>);

console.log("longposex="+longposex);
console.log("longposey="+longposey);
console.log("chutex="+chutex);
console.log("chutey="+chutey);


ctx.font = "16px Georgia";
ctx.direction = "ltr";

ctx.fillText("y=<?=$formatpapiery ?>cm", canvas.width/2, 660+origine);
ctx.fillText("x=<?=$formatpapierx ?>cm", 1000+origine, 320);
 // boucle verticale bouclei
for (let i = 0; i <bouclei; i++) 
                                {
    // boucle horizontale boucklej
    for (let j = 0; j <bouclej; j++) {


ctx.beginPath();
ctx.strokeStyle = "red";
ctx.fillStyle = "blue";

ordre=j+bouclej*i+1;
if (<?=$nbpose1 ?>><?= $nbpose2 ?>) {
                                    ctx.rect(origine, origine, <?=$formatmodely*10 ?>*j+<?=$formatmodely*10 ?>,<?=$formatmodelx*10?>*i+<?=$formatmodelx*10?>);
                                    ctx.fillText("pose "+ordre+" <?=$formatmodely?> cm",(origine*5)+<?=$formatmodely*10 ?>*j,origine*5+<?=$formatmodelx*10 ?>*i);

                                    ctx.rect(longposey+origine,origine, chutey, longposex+chutex);
                                    ctx.fillText(chutey/10+" cm",longposey+origine*2, origine*2);

                                    ctx.rect(origine,longposex+origine, longposey+chutey, chutex);
                                    ctx.fillText(chutex/10+" cm",origine*2, origine*2+longposex);
                                    } else {
                                    ctx.rect(origine, origine, <?=$formatmodelx*10 ?>*j+<?=$formatmodely*10 ?>,<?=$formatmodely*10?>*i+<?=$formatmodely*10?>);
                                    ctx.fillText("pose "+ordre+" <?=$formatmodelx?> cm",(origine*5)+<?=$formatmodelx*10 ?>*j,origine*5+<?=$formatmodely*10 ?>*i);


                                //     ctx.rect(longposey+origine,origine, chutey, longposey+chutey);

                                //    ctx.fillText(chutey/10+" cm",longposey+origine*2, origine*2);


                                    // ctx.rect(origine,longposey+origine, longposex+chutex, chutey);
                                    //  ctx.fillText(chutex/10+" cm",origine*2, origine*2+longposey);
                                    }

ctx.stroke();

//context.rect(x, y, width, height)

}




// ctx.rect(longposey+origine,origine, chutey, longposex+chutex);
// ctx.fillText(chutey/10+" cm",longposey+origine*2, origine*2);
// ctx.rect(origine,longposex+origine, longposey+chutey, chutex);
// ctx.fillText(chutex/10+" cm",origine*2, origine*2+longposex);
ctx.stroke();

 }

</script>
<div>
<?php
// echo "nombre de poses1 $nbpose1";
// echo "<br>";    
// echo "nombre de poses2 $nbpose2";
// echo "<br>";    
// echo "choix final ".$nbreposecoupe;
// echo "<br>";    
// echo $formatchute;
// echo "<br>";    
// echo "</div>";

?>
</div>
</body>
</html>