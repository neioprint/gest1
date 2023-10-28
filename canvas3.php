<?php
session_start();
// okkokokokoko
if (isset($_GET['formatpapier']) && !empty($_GET['formatpapier'])) {
  $formatpapier = $_GET['formatpapier'];
} else
  $formatpapier = "65X100";


if (isset($_GET['formatmodel']) && !empty($_GET['formatmodel'])) {
  $formatmodel = $_GET['formatmodel'];
} else
  $formatmodel = "21X28";

if (isset($_GET['portrait'])) {
  $portrait = $_GET['portrait'];
} else
  $portrait = 0;
// echo $formatpapier;echo "<br>";
// echo $formatmodel;echo "<br>";
//$formatxxyy = $chainematiere[3];
//$formatcoupe = strip_tags($_POST['formatcoupe']);

//$formatTirage = $formatcoupe;

// verification des calcul de poses selon format papier

//$nbreposetirage = strip_tags($_POST['nbreposetirage']);
//$nompapier=$chainematiere[1];
// $formatpapier=$chainematiere[3];
//$formatpapier="65X100";
// $portrait=1;
// if ($portrait==0) {
//     //  1=portait
//     // 0=paysage
//     // affichage portrait debout
//     $formatpapier="100X65";   $formatmodel="28.5X21.5";
// } else {
//     // affichage paysage couche
//     $formatpapier="65X100";$formatmodel="21.5X28.5";
// }

// $formatpapier="100X65";   $formatmodel="21X13";
//$formatpapier="65X100";$formatmodel="13X21";
// le papier doit etre classe selon l'ordre le plus petit à gauche
// le plus grand à droite 
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>"; echo "<br>";echo "<br>";echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>"; echo "<br>";echo "<br>";echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
$formatpapierEx = explode('X', $formatpapier);
// print_r($formatpapier);
// echo "<br>";
if ($formatpapier == $formatpapierEx[0]) {
  $formatpapierEx = explode('x', $formatpapier);
  if ($formatpapier != $formatpapierEx[0]) {
    $formatpapierx = $formatpapierEX[0];
    $formatpapiery = $formatpapierEx[1];
  } else {
    echo "Erreur Format  incorrect";
    die();
  }
} else {
  $formatpapierx = $formatpapierEx[0];
  $formatpapiery = $formatpapierEx[1];
}


$formatpapier = $formatpapierEx;
//$grampapier=$chainematiere[2];

//$formatmodel="13X21";


// print_r($formatpapierEx);
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$formatmodelEx = explode('X', $formatmodel);
if ($formatmodel == $formatmodelEx[0]) {
  $formatmodelEx = explode('x', $formatmodel);
  if ($formatmodel != $formatmodelEx[0]) {
    $formatmodelx = $formatmodelEx[0];
    $formatmodely = $formatmodelEx[1];
  } else {
    echo "Erreur Format  incorrect";
    die();
  }
} else {
  $formatmodelx = $formatmodelEx[0];
  $formatmodely = $formatmodelEx[1];
}

$formatmodel = $formatmodelEx;

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


// echo $formatpapierx;echo "<br>";
// echo $formatpapiery;echo "<br>";

//die();
// $formatmodel=explode('X',$formatmodel);
// $formatmodelx=$formatmodel[0];
// $formatmodely=$formatmodel[1];
if ($formatpapierx < $formatpapiery && $portrait == 1) {

  $formatpapierx = $formatpapier[1];
  $formatpapiery = $formatpapier[0];
  //explode('X',$formatcoupe);
  if ($formatmodelx < $formatmodely) {
    $formatmodelx = $formatmodel[1];
    $formatmodely = $formatmodel[0];
  } elseif ($portrait == 1) {
    $formatmodelx = $formatmodel[0];
    $formatmodely = $formatmodel[1];
  }
} else

  if ($formatpapierx > $formatpapiery && $portrait == 0) {

    $formatpapierx = $formatpapier[1];
    $formatpapiery = $formatpapier[0];
    //explode('X',$formatcoupe);
    if ($formatmodelx < $formatmodely) {
      $formatmodelx = $formatmodel[1];
      $formatmodely = $formatmodel[0];
    } elseif ($portrait == 0) {
      $formatmodelx = $formatmodel[0];
      $formatmodely = $formatmodel[1];
    }
  }
// le model doit etre classe selon l'ordre le plus petit à gauche
// le plus grand à droite 
// if ($formatmodelx<$formatmodely && $formatpapierx>$formatpapierx) {
//     $formatmodelx=$formatmodel[1];
//     $formatmodely=$formatmodel[0];
// } 


$formatpapiercarre = $formatpapierx * $formatpapiery;
$formatmodelcarre = $formatmodelx * $formatmodely;
$operationpose = $formatpapiercarre / $formatmodelcarre;
//echo $operationpose;echo "<br>";
// calcul pour coupe coquille
$opx = (int) ($formatpapierx / ($formatmodelx + $formatmodely));
$opy = (int) ($formatpapiery / ($formatmodelx + $formatmodely));
// echo $opx;echo "<br>";
// echo $opy;echo "<br>";
$coquille = 0;
if ($opy >= 2) {


  $denomy1 = (int) ($formatpapierx / $formatmodelx);
  $denomy2 = (int) ($formatpapierx / $formatmodely);
  $denomfinaly = (int) (($denomy1 + $denomy2) * $opy);
  //echo "denomfinaly=".$denomfinaly;echo "<br>";
  $denomfinalx = 0;
  // echo "denomy1=$denomy1 denomy2=$denomy2";
  // echo "<br>";
  //$coquille=1;
}

if ($opx >= 2) {

  $denomx1 = (int) ($formatpapiery / $formatmodelx);
  $denomx2 = (int) ($formatpapiery / $formatmodely);
  $denomfinalx = (int) ((@$denomx1 + @$denomx2) * $opx);
  // echo "denomx1=$denomx1 denomx2=$denomx2 denomfinalx=$denomfinalx";
  // echo "<br>";
  //$coquille=1;
  //echo "denomfinalx=".$denomfinalx;echo "<br>";
  $denomfinaly = 0;

}




$coupex = ($formatpapierx / $formatmodelx);
$modcoupex = (int) ($formatpapierx / $formatmodelx);
$valeurx = (int) (($coupex - $modcoupex) * $formatmodelx);
$coupeintx = (int) ($formatpapierx / $formatmodelx);

$coupey = ($formatpapiery / $formatmodely);
$modcoupey = (int) ($formatpapiery / $formatmodely);
$valeury = (int) (($coupey - $modcoupey) * $formatmodely);
$coupeinty = (int) ($formatpapiery / $formatmodely);


$coupextrans = ($formatpapierx / $formatmodely);
$modcoupextrans = (int) ($formatpapierx / $formatmodely);
$valeurxtrans = (int) (($coupextrans - $modcoupextrans) * $formatmodely);
$coupeintxtrans = (int) ($formatpapierx / $formatmodely);



$coupeytrans = ($formatpapiery / $formatmodelx);
$modcoupeytrans = (int) ($formatpapiery / $formatmodelx);
$valeurytrans = (int) (($coupeytrans - $modcoupeytrans) * $formatmodelx);
$coupeintytrans = (int) ($formatpapiery / $formatmodelx);


$nbrepose = 0;
$nbpose1 = $coupeintx * $coupeinty;
$nbpose2 = $coupeintxtrans * $coupeintytrans;


$formatchute = "00x00";


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if ($nbpose1 > $nbpose2) {
  //echo "nombre de poses1 $nbpose1";

  if ($nbpose1 > @$denomfinalx && $nbpose1 > @$denomfinaly) {
    $nbreposecoupe = $nbpose1;
    if ($valeurx != 0)
      $formatchute = "$valeurx X  $formatpapiery ";
    if ($valeury != 0)
      $formatchute .= " et $valeury X  $formatpapierx";
  } else if ($nbpose1 < $denomfinalx) {
    $nbreposecoupe = $denomfinalx;
    $coquille = 1;
  } else if ($nbpose1 < $denomfinaly) {
    $nbreposecoupe = $denomfinaly;
    $coquille = 1;

  }




  //  $nbreposecoupe=$nbpose1;
  //  $formatchute ="$valeurx X  $formatpapiery et $valeury X  $formatpapierx" ;

} else {
  //echo "nombre de poses2 $nbpose2";
  if ($nbpose2 > @$denomfinalx && $nbpose2 > @$denomfinaly) {
    $nbreposecoupe = $nbpose2;
    if ($valeurxtrans != 0)
      $formatchute = "$valeurxtrans X  $formatpapiery ";
    if ($valeurytrans != 0)
      $formatchute .= " et $valeurytrans X  $formatpapierx";

    // $formatchute ="$valeurxtrans X  $formatpapiery et $valeurytrans X $formatpapierx" ;
  } else if ($nbpose2 < $denomfinalx) {
    $nbreposecoupe = $denomfinalx;
    $coquille = 1;
  } else if ($nbpose2 < $denomfinaly) {
    $nbreposecoupe = $denomfinaly;
    $coquille = 1;
  }








}


//je cree une fonction



// echo "<br>";    
// echo "choix final ".$nbreposecoupe;
// echo "<br>";    
// echo $formatchute;
// echo "<br>";    
// echo $coquille;
// echo "<br>";    


//$resultatcoquille=coquille($nompapier,$formatpapierx,$formatpapiery,$formatmodelx,$formatmodely,$coupex,$coupey,$coupextransversal,$coupeytransversal);
//var_dump($resultatcoquille);
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$



?>
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=0.7 user-scalable=0">
    <title>Document</title>
    <link rel="icon" href="./images/logo2.png" type="image" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <!-- <script src="./js/jquery-3.3.1.js"></script> -->
    <link rel="icon" href="./images/logo2.png" type="image" />
    <!-- <link rel="stylesheet" href="./css/styleloader.css"> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="./css/style41.css"> -->
  </head>

  <body>
    <h1>Shema de coupe</h1>
    <div>
      <canvas id="myCanvas" style="border:2px dashed blue;">
      </canvas>
    </div>
    <!-- $nbpose1=$coupeintx*$coupeinty;
        $nbpose2=$coupeintxtrans*$coupeintytrans; -->
    <!-- // javascript du canvas -->
    <script>
      //   $portrait=1;
      //         if ($portrait==1) {
      //             //  1=portait
      //             // 0=paysage
      //             // affichage portrait debout
      //             $formatpapier="100X65";   $formatmodel="28X21";
      //         } else {
      //             // affichage paysage couche
      //             $formatpapier="65X100";$formatmodel="21X28";
      //         }







      const canvas = document.getElementById("myCanvas");
      const ctx = canvas.getContext("2d");
      // if (< ?=$portrait?>===1) {
      //     console.log("portrait");
      //     canvas.width=< ?=$formatpapiery*10?>;
      //     canvas.height=< ?=$formatpapierx*10?>;
      // } else {
      //     canvas.width=< ?=$formatpapiery*10?>;
      //     canvas.height=< ?=$formatpapierx*10?>;
      //     console.log("paysage");
      // }
      if (<?= $formatpapiery ?> * <?= $formatpapierx ?> < 700) {
        //ctx.font = "16px Arial";
        coeff = 2.3;
      } else {
        coeff = 1;
        //ctx.font = "20px Arial";
      }
      canvas.width = <?= $formatpapiery * 10 ?> * coeff + 30;
      canvas.height = <?= $formatpapierx * 10 ?> * coeff + 40;
      ctx.font = "16px Arial";
      ctx.direction = "ltr";
      ctx.lineWidth = "3";
      let origine = 30;
      ctx.beginPath();
      ctx.fillText("(0,0)", 5, 20);
      ctx.fillText("(<?= $formatpapiery ?>,<?= $formatpapierx ?>)", <?= $formatpapiery * 8 ?> - 60, <?= $formatpapierx * 10 ?> - 50);


      ctx.translate(origine, origine);
      if (<?= $formatpapiery ?> * <?= $formatpapierx ?> < 700) {

        ctx.scale(coeff - 0.3, coeff - 0.3);
      } else ctx.scale(0.7, 0.9);


      // ctx.lineJoin="round";
      // ctx.lineCap="round";
      ctx.stroke();
      //ctx.beginPath();

      // let formatdiv=< ?=$formatpapiery ?>/2;



      // test du choix des poses
      // $nbpose1=$coupeintx*$coupeinty;
      //         $nbpose2=$coupeintxtrans*$coupeintytrans;
      // console.log(< ?=$coquille?>);

      // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
      // cas ou la coupe  est droite ou transversale 
      // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
      // console.log("$portrait="+< ?=$portrait?>)
      //         console.log("$nbpose1="+< ?=$nbpose1 ?>);
      //         console.log("$nbpose2="+< ?=$nbpose2 ?>);
      //         console.log("$formatmodely="+< ?=$formatmodely*10 ?>);
      //         console.log("$formatmodelx="+< ?=$formatmodelx*10 ?>);
      //         console.log("$formatpapierx="+< ?=$formatpapierx*10 ?>);
      //         console.log("$formatpapiery="+< ?=$formatpapiery*10 ?>);

      //         console.log("longposex="+longposex);
      //         console.log("longposey="+longposey);
      //         console.log("chutex="+chutex);
      //         console.log("chutey="+chutey);
      if (<?= $coquille ?> == 0) {




        if (<?= $nbpose1 ?> > <?= $nbpose2 ?>) {
          var bouclei = <?= $coupeintx ?>;
          var bouclej = <?= $coupeinty ?>;
          // console.log("bouclei="+bouclei);
          // console.log("bouclej="+bouclej);
        }
        else {

          var bouclei = <?= $coupeintxtrans ?>;
          bouclej = <?= $coupeintytrans ?>;
          // console.log("bouclei="+bouclei);
          // console.log("bouclej="+bouclej);

        }



        // console.log(< ?=$nbpose1 ?>);
        // console.log(< ?=$nbpose2 ?>);
        // console.log(< ?= $coupeintxtrans?>);
        // console.log(< ?= $coupeintytrans?>)
        // console.log(bouclei);
        // console.log(bouclej);
        if (<?= $nbpose1 ?> > <?= $nbpose2 ?>) {
          var chutey = (<?= $formatpapiery ?> - bouclej * <?= $formatmodely ?>) * 10;
          // chutey=65-7*21
          var chutex = (<?= $formatpapierx ?> - bouclei * <?= $formatmodelx ?>) * 10;

          var longposey = <?= $formatmodelx ?> * bouclei * 10;//
          var longposex = <?= $formatmodely ?> * bouclej * 10;//
        } else {

          var chutex = (<?= $formatpapierx ?> - bouclei * <?= $formatmodely ?>) * 10;
          var chutey = (<?= $formatpapiery ?> - bouclej * <?= $formatmodelx ?>) * 10;

          var longposex = (<?= $formatmodely ?> * bouclei) * 10;
          var longposey = (<?= $formatmodelx ?> * bouclej) * 10;
        }


        //context.arc(x, y, r, sAngle, eAngle, counterclockwise)
        // ctx.beginPath();
        // ctx.arc(95, 50, 25, 0, 2 * Math.PI);
        // ctx.stroke();

        textnbpose = "Y=<?= $formatpapiery ?>cm  et " + bouclej + " poses";
        ctx.fillText(textnbpose, canvas.width / 2, <?= $formatpapierx * 10 + 20 ?>);
        ctx.fillText("Total poses " + bouclei * bouclej, canvas.width / 2, <?= $formatpapierx * 10 + 40 ?>);


        ctx.fillText("X=<?= $formatpapierx ?>cm", <?= $formatpapiery * 10 ?>, canvas.height / 2);
        ctx.fillText("et " + bouclei + " poses", <?= $formatpapiery * 10 ?>, canvas.height / 2 + 20);

        // boucle verticale bouclei
        for (let i = 0; i < bouclei; i++) {
          // boucle horizontale boucklej
          for (let j = 0; j < bouclej; j++) {


            ctx.beginPath();
            ctx.strokeStyle = "red";
            ctx.fillStyle = "blue";

            ordre = j + bouclej * i + 1;
            if (<?= $nbpose1 ?> > <?= $nbpose2 ?>) {
              ctx.rect(0, 0, <?= $formatmodely * 10 ?> * j + <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?> * i + <?= $formatmodelx * 10 ?>);
              //ctx.rotate(90)

              if (<?= $formatmodelx ?> > 5 && <?= $formatmodely ?> > 5)
                ctx.fillText(" <?= $formatmodelx ?>X<?= $formatmodely ?> ", <?= $formatmodely * 10 ?> * j + <?= $formatmodely * 10 ?> / 2, 20 + <?= $formatmodelx * 10 ?> * i);

              else if (j == 0) ctx.fillText(" <?= $formatmodelx ?>X<?= $formatmodely ?> ", <?= $formatmodely * 10 ?> + <?= $formatmodely * 10 ?> / 2, 20 + <?= $formatmodelx * 10 ?>);


              //ctx.stroke();


              if (chutey > 0) {
                ctx.rect(longposex, 0, chutey, chutex + longposey);

                ctx.fillText(chutey / 10 + " cm", longposex, 10);
              }

              if (chutex > 0) {

                ctx.rect(0, longposey, longposex, chutex);////////

                ctx.fillText(chutex / 10 + " cm", 10, longposey + chutex - 10);
              }


            } else {


              ctx.rect(0, 0, <?= $formatmodelx * 10 ?> * j + <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?> * i + <?= $formatmodely * 10 ?>);
              //////////////// ici /////////////////////////////////////////////////////



              if (<?= $formatmodelx ?> > 5 && <?= $formatmodely ?> > 5)
                ctx.fillText(<?= $formatmodelx ?> + "X" + <?= $formatmodely ?>, 30 + <?= $formatmodelx * 10 ?> * j, 40 + <?= $formatmodely * 10 ?> * i);
              else if (j == 0) ctx.fillText(" <?= $formatmodelx ?>X<?= $formatmodely ?> ", <?= $formatmodely * 10 ?> + <?= $formatmodely * 10 ?> / 2, 20 + <?= $formatmodelx * 10 ?>);


              // chute verticale
              if (chutey > 0) {
                ctx.rect(longposey, 0, chutey, longposex + chutex);////



                ctx.fillText(chutey / 10 + " cm", longposey + 10, 15);
              }



              if (chutex > 0) {
                // chute horizontale
                ctx.rect(0, longposex, longposey + chutey, chutex);////////


                ctx.fillText(chutex / 10 + " cm", 10, 15 + longposex);
              }
            }

            ctx.stroke();
            // context.rect(x, y, width, height)
            //context.rect(x, y, width, height)

          }




          // ctx.rect(longposey+origine,origine, chutey, longposex+chutex);
          // ctx.fillText(chutey/10+" cm",longposey+origine*2, origine*2);
          // ctx.rect(origine,longposex+origine, longposey+chutey, chutex);
          // ctx.fillText(chutex/10+" cm",origine*2, origine*2+longposex);
          ctx.stroke();

        }
        // cas coupe non droite en coquille
      }
      else //coquille
      {

        // canvas.width=1020;
        // canvas.height=690;
        // let origine=20;
        if (<?= $portrait ?> == 1) {
          <?php
          $trans = $formatpapierx;
          $formatpapierx = $formatpapiery;
          $formatpapiery = $trans;

          $trans = $formatmodelx;
          $formatmodelx = $formatmodely;
          $formatmodely = $trans;
          ?>

          canvas.width = <?= $formatpapierx * 8 ?> + 40;
          canvas.height = <?= $formatpapiery * 10 ?>;

          ctx.beginPath();
          //ctx.scale(0.85, 0.85);
          ctx.scale(0.7, 0.9);
          ctx.strokeStyle = "red";
          ctx.fillStyle = "blue";
          //  ctx.translate(1000, 0);
          // ctx.rotate(90 * Math.PI / 180);


          ctx.font = "16px Arial";
          ctx.direction = "ltr";
          ctx.lineWidth = "3";
          let origine = 30;
          ctx.beginPath();
          ctx.fillText("(0,0)", 5, 20);
          ctx.fillText("(<?= $formatpapiery ?>,<?= $formatpapierx ?>)", <?= $formatpapierx * 10 ?> + 40, <?= $formatpapiery * 10 ?> + 40);


          //ctx.translate(origine, origine);
          //ctx.scale(0.85, 0.85);




          ctx.fillText("X=<?= $formatpapiery ?>cm", canvas.width / 2, <?= $formatpapiery * 10 + 50 ?>);
          ctx.fillText("Y=<?= $formatpapierx ?>cm", <?= $formatpapierx * 10 + 50 ?>, canvas.height / 2);
          ctx.strokeStyle = "red";
          ctx.translate(origine, origine);
          // //origine=0;
          //    ctx.scale(0.9,0.9);
          // ctx.font = "30px Arial";
          // ctx.direction = "ltr";
          ctx.lineWidth = "3";

          // ctx.lineJoin="round";
          // ctx.lineCap="round";

          ctx.beginPath();
          // ctx.translate(800, 0);

          // ctx.rotate(90*Math.PI/180);
          ctx.rect(0, 0, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=0

          ctx.rect(<?= $formatmodelx * 10 ?>, 0, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=0
          ctx.rect(<?= $formatmodelx * 10 * 2 ?>, 0, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=0
          ctx.rect(<?= $formatmodelx * 10 * 3 ?>, 0, <?= $formatmodelx ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=0

          // $$$$$$$$yyyyyyyyyyyyy
          ctx.rect(0, <?= $formatmodely * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);//pose 1 portrait=0
          ctx.rect(<?= $formatmodely * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);//pose 1 portrait=0
          ctx.rect(<?= $formatmodely * 10 * 2 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodely + 55 ?>, <?= $formatmodelx * 10 ?>);//pose 1 portrait=0


          ctx.rect(0, <?= $formatmodelx * 10 ?> + <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=0
          ctx.rect(<?= $formatmodelx * 10 ?>, <?= $formatmodelx * 10 ?> + <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=0
          ctx.rect(<?= $formatmodelx * 10 * 2 ?>, <?= $formatmodelx * 10 ?> + <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=0
          ctx.rect(<?= $formatmodelx * 10 * 3 ?>, <?= $formatmodelx * 10 ?> + <?= $formatmodely * 10 ?>, <?= $formatmodelx ?>, <?= $formatmodely * 10 ?>);//pose 1 portrait=


          // $$$$$$$$yyyyyyyyyyyyy
          ctx.rect(0, <?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?> + <?= $formatmodely * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);//pose 1 portrait=0

          ctx.rect(<?= $formatmodely * 10 ?>, <?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?> + <?= $formatmodely * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);//pose 1 portrait=0

          ctx.rect(<?= $formatmodely * 10 * 2 ?>, <?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?> + <?= $formatmodely * 10 ?>, <?= $formatmodely + 55 ?>, <?= $formatmodelx * 10 ?>);//pose 1 portrait=0






















          ctx.stroke();
        }

        // okokokokokookokne ne pas toucher
        if (<?= $portrait ?> == 0) {
          <?php
          $trans = $formatpapierx;
          $formatpapierx = $formatpapiery;
          $formatpapiery = $trans;

          $trans = $formatmodelx;
          $formatmodelx = $formatmodely;
          $formatmodely = $trans;
          ?>

          canvas.width = <?= $formatpapiery * 10 ?> + 10;
          canvas.height = <?= $formatpapierx * 10 ?> + 10;

          ctx.beginPath();
          //ctx.scale(0.85, 0.85);
          ctx.scale(0.7, 0.9);
          ctx.strokeStyle = "red";
          ctx.fillStyle = "blue";
          //  ctx.translate(1000, 0);
          // ctx.rotate(90 * Math.PI / 180);


          ctx.font = "20px Arial";
          ctx.direction = "ltr";
          ctx.lineWidth = "3";
          let origine = 30;
          ctx.beginPath();
          ctx.fillText("(0,0)", 5, 20);
          ctx.fillText("(<?= $formatpapiery ?>,<?= $formatpapierx ?>)", <?= $formatpapiery * 10 ?> + 20, <?= $formatpapierx * 10 ?> + 30);


          //ctx.translate(origine, origine);
          //ctx.scale(0.85, 0.85);




          ctx.fillText("Y=<?= $formatpapiery ?>cm", canvas.width / 2, <?= $formatpapierx * 10 + 80 ?>);
          ctx.fillText("X=<?= $formatpapierx ?>cm", <?= $formatpapiery * 10 + 30 ?>, canvas.height / 2);
          ctx.strokeStyle = "red";
          ctx.translate(origine, origine);
          // //origine=0;
          //    ctx.scale(0.9,0.9);
          // ctx.font = "30px Arial";
          // ctx.direction = "ltr";
          ctx.lineWidth = "3";

          // ctx.lineJoin="round";
          // ctx.lineCap="round";

          ctx.beginPath();
          // ctx.translate(800, 0);

          // ctx.rotate(90*Math.PI/180);
          ctx.rect(0, 0, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);//pose 1 portrait=0


          //  ctx.rect(0,0,<?= $formatmodelx * 10 ?>,<?= $formatmodely * 10 ?>);//pose 1 portait=1

          // // ctx.moveTo(170, 110);
          // // ctx.arc(140, 110, 30, 0, 2 * Math.PI);
          // //  ctx.fillText("1",130, 120);// texte

          // // throw new Error();
          ctx.rect(0, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);//pose 2
          // // < ?php die(); ?>
          // // ctx.moveTo(170, 320);
          // // ctx.arc(140, 320, 30, 0, 2 * Math.PI);
          // //  ctx.fillText("2",130, 320);// texte


          ctx.rect(0, 2 * <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>); // pose 3
          ctx.rect(0, 3 * <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>, 30); //chute

          ctx.rect(<?= $formatmodely * 10 ?>, 0, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>); //pose 4
          ctx.rect(<?= $formatmodely * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 5
          ctx.rect(<?= $formatmodely * 10 ?>, 2 * <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>, 90);//chute


          ctx.rect(<?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?>, 0, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);// pose 6
          ctx.rect(<?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?>, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);// pose 7
          ctx.rect(<?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?>, 2 * <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>);// pose 8
          ctx.rect(<?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?>, 3 * <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>, 30); //chute
          // // ctx.rect(490,630,280,20); //chute


          ctx.rect(2 * <?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?>, 0, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>); //pose 9
          ctx.rect(2 * <?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>, <?= $formatmodely * 10 ?>);//pose 10
          ctx.rect(2 * <?= $formatmodely * 10 ?> + <?= $formatmodelx * 10 ?>, 2 * <?= $formatmodely * 10 ?>, <?= $formatmodelx * 10 ?>, 90);//chute




          ctx.stroke();
        }


      }

    </script>
    <a id="bouton" href="#" class="btn btn-primary btn-lg btn-info btn-block" onClick="history.back()">Retour</a>
    <div>
      <?php
      // echo "portrait $portrait";
// echo "<br>"; 
// echo "opx $opx";
// echo "<br>"; 
// echo "opy $opy";
// echo "<br>"; 
// echo "denomfinalx ".@$denomfinalx;
// echo "<br>";    
// echo "denomfinaly ".@$denomfinaly;
// echo "<br>";  
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