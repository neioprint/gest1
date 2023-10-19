<?php
$commande['etapesvalidee']='a:1:{i:0;a:4:{i:0;a:3:{i:0;i:2;i:1;s:27:"2023-10-18 à 12:16 par sid";i:2;s:27:"2023-10-18 à 13:02 par sid";}i:1;a:3:{i:0;i:2;i:1;s:27:"2023-10-19 à 08:30 par sid";i:2;s:27:"2023-10-19 à 14:39 par sid";}i:2;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:3;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}}}';


// 'a:1:{i:0;a:4:{i:0;a:3:{i:0;i:2;i:1;s:27:"2023-10-18 à 12:16 par sid";i:2;s:27:"2023-10-18 à 17:02 par sid";}i:1;a:3:{i:0;i:2;i:1;s:27:"2023-10-19 à 08:30 par sid";i:2;s:27:"2023-10-19 à 14:39 par sid";}i:2;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:3;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}}}';

// 'a:2:{i:0;a:6:{i:0;a:3:{i:0;i:2;i:1;s:27:"2023-10-14 à 21:15 par sid";i:2;s:27:"2023-10-15 à 06:35 par sid";}i:1;a:3:{i:0;i:2;i:1;s:27:"2023-10-15 à 06:28 par sid";i:2;s:27:"2023-10-15 à 06:36 par sid";}i:2;a:3:{i:0;i:2;i:1;s:27:"2023-10-14 à 21:13 par sid";i:2;s:27:"2023-10-14 à 21:14 par sid";}i:3;a:3:{i:0;i:2;i:1;s:27:"2023-10-15 à 06:34 par sid";i:2;s:27:"2023-10-15 à 06:36 par sid";}i:4;a:3:{i:0;i:2;i:1;s:27:"2023-10-15 à 06:34 par sid";i:2;s:27:"2023-10-15 à 06:36 par sid";}i:5;a:3:{i:0;i:2;i:1;s:27:"2023-10-15 à 06:29 par sid";i:2;s:27:"2023-10-15 à 06:36 par sid";}}i:1;a:6:{i:0;a:3:{i:0;i:2;i:1;s:27:"2023-10-15 à 06:46 par sid";i:2;s:27:"2023-10-15 à 06:58 par sid";}i:1;a:3:{i:0;i:1;i:1;s:27:"2023-10-15 à 07:10 par sid";i:2;s:0:"";}i:2;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:3;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:4;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:5;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}}}';

//     array(array())
    



// );
 $tabsuivi = unserialize($commande['etapesvalidee']);
// $tabsuivi=array($tabsuivi);

// $tabsuivi[0][0][0]=0;
 $tabsuivi[0][0][1]="2023-10-18 à 12:16 par sid";
$tabsuivi[0][0][2]="2023-10-18 à 13:02 par sid";

// $tabsuivi[0][1][0]=0;
$tabsuivi[0][1][1]="2023-10-19 à 08:30 par sid";
$tabsuivi[0][1][2]="2023-10-19 à 12:30 par sid";


// $tabsuivi[0][2][0]=0;
// $tabsuivi[0][2][1]="";
// $tabsuivi[0][2][2]="";




// $tabsuivi[1][0][0]=0;
// $tabsuivi[1][0][1]="";
// $tabsuivi[1][0][2]="";

// $tabsuivi[1][1][0]=0;
// $tabsuivi[1][1][1]="";
// $tabsuivi[1][1][2]="";


// $tabsuivi[1][2][0]=0;
// $tabsuivi[1][2][1]="";
// $tabsuivi[1][2][2]="";



//  $tabsuivi[1][3][0]=0;
//  $tabsuivi[1][3][1]="";
//  $tabsuivi[1][3][2]="";

//  $tabsuivi[1][4][0]=0;
//  $tabsuivi[1][4][1]="";
//  $tabsuivi[1][4][2]="";

//  $tabsuivi[1][5][0]=0;
//  $tabsuivi[1][5][1]="";
//  $tabsuivi[1][5][2]="";

echo "<pre>";

print_r($tabsuivi);
echo "</pre>";
//die();
$tabsuivi=serialize($tabsuivi);
echo $tabsuivi;
//$tabsuivi=[];

 //$tabsuivi1 = $tabsuivi;

//$tabsuivi = $commande['etapesvalidee'];
// echo "<pre>";
// print_r($tabsuivi);
// echo "</pre>";

// $tabsuivi=array($tabsuivi);
 //$tabsuivi[1][0][0]=2;

// $tabsuivi[1]=array($tabsuivi1);

// echo "<pre>";

// print_r($tabsuivi);
// echo "</pre>";