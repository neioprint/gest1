<?php
$commande['etapesvalidee']='a:2:{i:0;a:1:{i:0;a:4:{i:0;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:1;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:2;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:3;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}}}i:1;a:4:{i:0;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:1;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:2;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:3;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}}}';



//'a:1:{i:0;a:4:{i:0;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:1;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:2;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:3;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}}}';

// 'a:8:{i:0;a:3:{i:0;i:2;i:1;s:27:"2023-10-12 à 16:38 par sid";i:2;s:27:"2023-10-12 à 18:28 par sid";}i:1;a:3:{i:0;i:2;i:1;s:27:"2023-10-12 à 16:38 par sid";i:2;s:27:"2023-10-12 à 18:28 par sid";}i:2;a:3:{i:0;i:2;i:1;s:27:"2023-10-12 à 18:29 par sid";i:2;s:27:"2023-10-13 à 09:01 par sid";}i:3;a:3:{i:0;i:2;i:1;s:27:"2023-10-13 à 09:10 par sid";i:2;s:0:"";}i:4;a:3:{i:0;i:2;i:1;s:27:"2023-10-13 à 09:11 par sid";i:2;s:0:"";}i:5;a:3:{i:0;i:2;i:1;s:27:"2023-10-13 à 09:02 par sid";i:2;s:27:"2023-10-13 à 09:07 par sid";}i:6;a:3:{i:0;i:2;i:1;s:27:"2023-10-13 à 09:01 par sid";i:2;s:0:"";}i:7;a:3:{i:0;i:2;i:1;s:27:"2023-10-12 à 18:29 par sid";i:2;s:27:"2023-10-12 à 18:29 par sid";}}';
//'a:4:{i:0;a:3:{i:0;i:1;i:1;s:27:"2023-10-14 à 14:13 par sid";i:2;s:0:"";}i:1;a:3:{i:0;i:1;i:1;s:27:"2023-10-14 à 14:14 par sid";i:2;s:0:"";}i:2;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}i:3;a:3:{i:0;i:0;i:1;s:0:"";i:2;s:0:"";}}';
//$commande['etapesvalidee']=array(
//     array(array())
    



// );
$tabsuivi = unserialize($commande['etapesvalidee']);
$tabsuivi=array($tabsuivi);

// $tabsuivi[0][0][0]=0;
// $tabsuivi[0][0][1]="";
// $tabsuivi[0][0][2]="";

// $tabsuivi[0][1][0]=0;
// $tabsuivi[0][1][1]="";
// $tabsuivi[0][1][2]="";


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

// $tabsuivi[1][3][0]=0;
// $tabsuivi[1][3][1]="";
// $tabsuivi[1][3][2]="";
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