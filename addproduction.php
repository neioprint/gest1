<?php
// le 29 sep2023
require_once "const.php";
//require_once "./functions/coquille.php";
@$idclientSel = isset($_GET['idclient']) ? $_GET['idclient'] : 0;
@$idcommandeSel = isset($_GET['idcommande']) ? $_GET['idcommande'] : 0;
require('serveur.php');

@$nomclient = $_SESSION['nomclient'];
// @$idcommandes=$_SESSION['idcommande'];
require_once('connectmatiere.php');
$sql = 'SELECT * FROM `matiere`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif 
$resultmatiere = $query->fetchAll(PDO::FETCH_ASSOC);
//require_once('closematiere.php');

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// require('connectcommande.php');
// $sql = "select * from production order by dates";
// //     // $sql = "SELECT * FROM `commande` WHERE `id` = :idcommande"; 
// // }
// // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// // On prépare la requête
// $query = $db->prepare($sql);
// // On exécute la requête
// $query->execute();

// // On stocke le résultat dans un tableau associatif
// $prod = $query->fetchAll(PDO::FETCH_ASSOC);
// // echo "<pre>";
// // print_r($prod);
// // echo "</pre>";
// // echo gettype($prod[2]['qte']);
// // echo gettype($matiere[0]['prix']);
// // echo ($matiere[2]['qte']*1.0);
// // echo ($matiere[0]['prix'])*1.0;
// // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

require('connectcommande.php');
// foreach ($prod as $prod0) {
    

$sql = "SELECT * FROM `commande` where not( id in (SELECT idcommande FROM `production` WHERE idcommande))  and not (etat like '%5/%') and not (etat like '%6/%') 
and not (etat like '%2/%') and not (etat like '%3/%') and not (etat like '%4/%') ";

// On prépare la requête
$query = $db->prepare($sql);
// }
// On exécute la requête
$query->execute();


// On stocke le résultat dans un tableau associatif 
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('closecommande.php');
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";

//print_r("-------------------------------------------------------------------");

// die();




if ($_POST) {
    if (
        isset($_POST['idcommande']) && !empty($_POST['idcommande'])
        && (isset($_POST['dates']) && !empty($_POST['dates']))
    ) {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
      
        $dates = strip_tags($_POST['dates']);
        $commandeetqte = strip_tags($_POST['idcommande']);// separé par un /
        //extraction de id commande et quantite commande
        $commandeinter=explode("/", $commandeetqte);
        $idcommande=$commandeinter[0];
       
        $qtecommande=$commandeinter[1];

     // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
     require('./connect.php');

     $sql = "SELECT * FROM `commande` WHERE `id`=$idcommande";

     // On prépare la requête
     $query = $db->prepare($sql);

     // On exécute la requête
     $query->execute();

     // On stocke le résultat dans un tableau associatif 
     $resultcommande = $query->fetch(PDO::FETCH_ASSOC);
  
//   echo "<pre>";
//         print_r($resultcommande);
//         echo "</pre>";
     // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$




     // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
     //echo $idcommande."<br>";
     require('./connect.php');

     $sql = "SELECT * FROM `imprimes` WHERE `id`=$resultcommande[idimprime]";

     // On prépare la requête
     $query = $db->prepare($sql);

     // On exécute la requête
     $query->execute();

     // On stocke le résultat dans un tableau associatif 
     $result = $query->fetch(PDO::FETCH_ASSOC);
     // echo "<br>";
     // echo "<br>";
    //   echo "<pre>";
    //  print_r($result);
    //  echo "</pre>";
     // echo "<br>";
     require_once('./close.php');
     
     



    //  echo '<div>
    //  <canvas id="myCanvas" width="200" height="100" style="border:1px solid #000000;">
    //  </canvas>
    //  </div>';
    //  echo"<br><br><br><br><br>";

     // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$




    


       
        // print_r($idcommande);
        // print_r($qtecommande);
        // die();
        // $idimprime = 0;
        $idimprime=$resultcommande['idimprime'];
        //echo $idimprime;
        //strip_tags($_POST['idimprime']);
        $idclient = strip_tags($_POST['idclient']);
        $idmatiere = strip_tags($_POST['idmatiere']);
        $chainematiere = explode('/', $idmatiere);
     
        // die();
        $idmatiere = $chainematiere[0];
        $matiere = $chainematiere[1];
        $grammage = $chainematiere[2];
        $formatxxyy = $chainematiere[3];
        $formatcoupe = strip_tags($_POST['formatcoupe']);
        //$nbreposecoupe = strip_tags($_POST['nbreposecoupe']);
        // $formatTirage = strip_tags($_POST['formatTirage']);
        $formatTirage = $formatcoupe;
        
  // verification des calcul de poses selon format papier

        $nbreposetirage = strip_tags($_POST['nbreposetirage']);
        $nompapier=$chainematiere[1];
        $formatpapier=$chainematiere[3];
        $formatpapier=explode('X',$formatpapier);
        $formatpapierx=$formatpapier[0];
        $formatpapiery=$formatpapier[1];
        $grampapier=$chainematiere[2];
        $formatmodel=explode('X',$formatcoupe);
        $formatmodelx=$formatmodel[0];
        $formatmodely=$formatmodel[1];
        $formatpapiercarre= $formatpapierx* $formatpapiery;
        $formatmodelcarre=$formatmodelx*$formatmodely;
        $operationpose=$formatpapiercarre/$formatmodelcarre;

        // calcul pour coupe coquille
        $opx=(int)($formatpapierx/($formatmodelx+$formatmodely));
        $opy=(int)($formatpapiery/($formatmodelx+$formatmodely));
        // echo "opy retenue"." ".$opy ;
        // echo "<br>";
        // echo "opx retenue";
        // echo "<br>";
        // $opy=0;
        //$denomfinaly=0;
        if ($opy>=2) {

                        echo "opy retenue"." ".$opy ;
                        echo "<br>";
                        $denomy1=(int)($formatpapierx/$formatmodelx);
                        $denomy2=(int)($formatpapierx/$formatmodely);
                        $denomfinaly=(int)(($denomy1+$denomy2)*$opy);
                        echo "<br>";  
                        echo "pose y=".$denomfinaly;
                        echo "<br>";
                        echo $denomy1."       ".$denomy2;
                        echo "<br>";
                        $denomfinalx=0;
                        }
        // $opx=0;
        //$denomfinalx=0;
        if ($opx>=2) {
            echo "opx retenue";
            echo "<br>";
            $denomx1=(int)($formatpapiery/$formatmodelx);
            $denomx2=(int)($formatpapiery/$formatmodely);
            $denomfinalx=(int)(($denomy1+$denomy2)*$opx);
            echo "<br>";  
            echo "poses=".$denomfinalx;
            echo "<br>";
            echo $denomx1."       ".$denomx2;
            echo "<br>";
            $denomfinaly=0;

                        }              
        echo $formatpapierx." ".$opx;
        echo "<br>";
        echo $formatpapiery." ".$opy;
         // calcul pour coupe coquille
        echo "<br>";
        echo "<br>";
        echo "Votre papier est ".$nompapier." son format est ".$formatpapierx."X".$formatpapiery;
        echo "<br>";
        echo "Votre model son format est ".$formatmodelx."X".$formatmodely;
        echo "<br>";  echo "<br>";
    //     echo "nombre de poses coupe ".$nbreposecoupe;
    //    echo "<br>";
       echo "nombre de poses tirage ".$nbreposetirage;
       
       echo "<br>";  echo "<br>";
       echo "nombre de pose selon calcul en cm carre ".$operationpose;  
       echo "<br>";    echo "<br>";  
     


        $coupex=($formatpapierx/$formatmodelx);
        $modcoupex=(int) ($formatpapierx/$formatmodelx);
        $valeurx=(int)(($coupex-$modcoupex)*$formatmodelx);
        $coupeintx=(int)($formatpapierx/$formatmodelx);
         echo "coupe droite donne selon X $formatmodelx ".$formatpapierx. "      <br>".$coupeintx. "poses chute $valeurx cm sur format $formatpapiery";
        echo "<br>";   echo "<br>";
 


        // $coupextransversal=(int)($formatpapiery/$formatmodelx);
        // $modcoupextransversal=(int)((($formatpapiery/$formatmodelx)-intdiv($formatpapiery,$formatmodelx))*$formatmodelx);
        $coupey=($formatpapiery/$formatmodely);
        $modcoupey=(int) ($formatpapiery/$formatmodely);
        $valeury=(int)(($coupey-$modcoupey)*$formatmodely);
        $coupeinty=(int)($formatpapiery/$formatmodely);
         echo "coupe droite donne selon Y $formatmodely ".$formatpapiery. "      <br>".$coupeinty. "poses chute $valeury cm sur format $formatpapierx";
        echo "<br>";   echo "<br>";
        
        $coupextrans=($formatpapierx/$formatmodely);
        $modcoupextrans=(int) ($formatpapierx/$formatmodely);
        $valeurxtrans=(int)(($coupextrans-$modcoupextrans)*$formatmodely);
        $coupeintxtrans=(int)($formatpapierx/$formatmodely);
         echo "coupe transversal donne selon X $formatmodely ".$formatpapierx. "      <br>".$coupeintxtrans. "poses chute $valeurxtrans cm sur format $formatpapiery";
        echo "<br>";   echo "<br>";    


        $coupeytrans=($formatpapiery/$formatmodelx);
        $modcoupeytrans=(int) ($formatpapiery/$formatmodelx);
        $valeurytrans=(int)(($coupeytrans-$modcoupeytrans)*$formatmodelx);
        $coupeintytrans=(int)($formatpapiery/$formatmodelx);
         echo "coupe transversal donne selon X $formatmodelx ".$formatpapiery. "      <br>".$coupeintytrans. "poses chute $valeurytrans cm sur format $formatpapierx";
        echo "<br>";   echo "<br>";    

        // $coupey=(int)($formatpapiery/$formatmodely);
        // $modcoupey=(int)((($formatpapiery/$formatmodely)-intdiv($formatpapiery,$formatmodely))*$formatmodely);

        // $coupeytransversal=(int)($formatpapierx/$formatmodely);
        // $modcoupeytransversal=(int)((($formatpapierx/$formatmodely)-intdiv($formatpapierx,$formatmodely))*$formatmodely);

        $nbrepose=0;
        $nbpose1=$coupeintx*$coupeinty;
        $nbpose2=$coupeintxtrans*$coupeintytrans;

        echo "nombre de poses1 $nbpose1";
        echo "<br>";    
        echo "nombre de poses2 $nbpose2";
        echo "<br>";  
        echo "<br>";  
        // test coupe coquille
        echo "retenue";
        echo "<br>";
        $formatchute="00x00";
        // if ($denomfinalx>=1 or $denomfinaly>=1) {

        //              }   
        // echo "denomfinalxy".$denomfinalx." ".$denomfinaly."<br>"; 
        if ($nbpose1>$nbpose2) {
                                 echo "nombre de poses1 $nbpose1";

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
                                        echo "nombre de poses2 $nbpose2";
                                        if ($nbpose2>$denomfinalx && $nbpose2>$denomfinaly) {
                                            $nbreposecoupe=$nbpose2;
                                            if ($valeurxtrans!=0) $formatchute ="$valeurxtrans X  $formatpapiery "; 
                                            if ($valeurytrans!=0) $formatchte.=" et $valeurytrans X  $formatpapierx" ;

                                            // $formatchute ="$valeurxtrans X  $formatpapiery et $valeurytrans X $formatpapierx" ;
                                                        } else if ($nbpose2<$denomfinalx) {
                                                                                            $nbreposecoupe=$denomfinalx;
                                                                                            } else if ($nbpose2<$denomfinaly)
                                                                                            $nbreposecoupe=$denomfinaly;




                                       

                                        
                                        }
        // je cree une fonction

      
        echo "<br>";    
        echo "choix final ".$nbreposecoupe;
        echo "<br>";    
        echo $formatchute;
        echo "<br>";    
        //$resultatcoquille=coquille($nompapier,$formatpapierx,$formatpapiery,$formatmodelx,$formatmodely,$coupex,$coupey,$coupextransversal,$coupeytransversal);
        //var_dump($resultatcoquille);
    






    //    echo "coupe droite donne selon X $formatmodelx ".$formatpapierx. "      <br>".$coupex. "poses chute $modcoupex cm sur $formatpapiery";
    //    echo "<br>";   echo "<br>";
    //    echo "coupe droite donne selon Y $formatmodely ".$formatpapiery. "     <br> ".$coupey. "poses chute $modcoupey cm sur $formatpapierx";
    //    echo "<br>";   echo "<br>";
    //    echo "coupe transversale donne selon X $formatmodelx ".$formatpapiery. "    <br>".$coupextransversal. "poses  chute $modcoupextransversal cm sur $formatpapierx";
    //    echo "<br>"; echo "<br>";   echo "<br>";
     
    //    echo "coupe transversale donne selon Y $formatmodely ".$formatpapierx. "    <br>".$coupeytransversal. "poses chute   $modcoupeytransversal cm sur $formatpapiery";
    //    echo "<br>";   echo "<br>";
     
    //    echo "Alors la coupe droite retenue est chute $modcoupex cm sur $formatpapiery et $modcoupey cm sur $formatpapierx";
    //    echo "<br>";
    //    echo $nbpose1;
    //    echo "<br>";
    //    echo "Alors la coupe transversale retenue est  chute   $modcoupeytransversal cm sur $formatpapiery et $modcoupextransversal cm sur $formatpapierx";
    //    echo "<br>";
    //    echo $nbpose2;
    //    echo "<br>";
 // fin verification des calcul de poses selon format papier      
        // $qteaconsommer = strip_tags($_POST['qteaconsommer']);

   
        
        


        $qteaconsommer =round($qtecommande/($nbreposecoupe*$nbreposetirage));
        $nbreplaque = strip_tags($_POST['nbreplaque']);
        //$formatchute = "";
        //strip_tags($_POST['formatchute']);
        $etatprod = "0/En attente";
   
      

        

        $typ=@$result['typ'];
        $chaine=@$result['etapes'];
        $chainedecoupe=explode(",",$chaine);
        $typdecoupe=explode(",",$typ);
        $compt=count($chainedecoupe);
        $compt0=count($typdecoupe);
        // print_r($chainematiere);
        echo "<br>";
        // echo "<pre>";
        // print_r($chainedecoupe);
        // echo "</pre>";
        echo "<br>";
        echo "<pre>";
        print_r($typdecoupe);
        echo "</pre>";
        if ($typdecoupe[0]=="carnet") {
                                       
                                        $carnet=$typdecoupe[0];
                                        $qtecarnet=explode(' ', $typdecoupe[1]);
                                        $qtecarnet=$qtecarnet[0];
                                        $exemplaire=explode(' ', $typdecoupe[2]);
                                        $exemplaire=$exemplaire[0];
                                        $souche=explode(' ', $typdecoupe[3]);
                                      
                                        print_r($carnet);
                                        echo "<br>";
                                        print_r($qtecarnet);
                                        echo "<br>";
                                        print_r($exemplaire);
                                        $qteaconsommer=round(($qtecommande*$qtecarnet)/($nbreposecoupe*$nbreposetirage));
                                        echo "<br>";
                                        // print_r($qteaconsommer);
                                        //$resultcommande['quantite'];
                                        
                                        }
            if ($typdecoupe[0]=="registre") {
                                       
                                            $registre=$typdecoupe[0];
                                            $qteregistre=explode(' ', $typdecoupe[1]);
                                            $qteregistre=$qteregistre[0];
                                            //$exemplaire=explode(' ', $typdecoupe[2]);
                                            //$exemplaire=$exemplaire[0];
                                            //$souche=explode(' ', $typdecoupe[3]);
                                          
                                        //     print_r($registre);
                                        //     echo "<br>";
                                        //     print_r($qteregistre);
                                        //     echo "<br>";
                                        //   echo $qtecommande."<br>";
                                            $qteaconsommer=round(($qtecommande*$qteregistre)/($nbreposecoupe*$nbreposetirage));
                                            echo "<br>";
                                            // print_r($qteaconsommer);
                                            //$resultcommande['quantite'];
                                            
                                            }

    
                //strip_tags($_POST['etatprod']);


                print_r($qteaconsommer);
                echo "<br>";
                echo "Le nombre de total avec les poses tirages". $nbreposecoupe*$nbreposetirage;
        //          print_r($formatxxyy);
        //          echo "<br>";
        // print_r($ptf);
        //         print_r($formatxx);
        //         print_r($formatyy);
        //         //  print_r($formatyy);

   

        //die();



        require_once('serveur.php');
        try {
            // Connexion à la base
            if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
            if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
            if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
            if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

            if ($serveur == "serveurlws2") $db = new PDO('mysql:dbname= cp2094915p03_globa2085215_1ilsts;host=localhost', 'cp2094915p03_admin', 'exp2581exp');
            $db->exec('SET NAMES "UTF8"');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die("prob");
        }

        $sql = 'INSERT INTO 
  `production` 
  (`dates`,`idcommande`,`idimprime`,`idclient`,`idmatiere`,`matiere`,`formatxxyy`,`grammage`,`qteaconsommer`,`formatcoupe`,`nbreposecoupe`,`formatTirage`,`nbreposetirage`,`nbreplaque`,`formatchute`,`etatprod`) 
  VALUES 
  ( :dates,:idcommande,:idimprime,:idclient,:idmatiere,:matiere,:formatxxyy,:grammage,:qteaconsommer,:formatcoupe,:nbreposecoupe,:formatTirage,:nbreposetirage,:nbreplaque,:formatchute,:etatprod);';

        $query = $db->prepare($sql);

        // $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':idcommande', @$idcommande, PDO::PARAM_INT);
        $query->bindValue(':idimprime', @$idimprime, PDO::PARAM_INT);
        $query->bindValue(':idclient', @$idclient, PDO::PARAM_INT);

        $query->bindValue(':idmatiere', @$idmatiere, PDO::PARAM_INT);

        $query->bindValue(':matiere', @$matiere, PDO::PARAM_STR);

        $query->bindValue(':formatxxyy', @$formatxxyy, PDO::PARAM_STR);

        $query->bindValue(':grammage', @$grammage, PDO::PARAM_INT);
        $query->bindValue(':qteaconsommer', @$qteaconsommer, PDO::PARAM_STR);
        $query->bindValue(':formatcoupe', @$formatcoupe, PDO::PARAM_STR);
        $query->bindValue(':nbreposecoupe', @$nbreposecoupe, PDO::PARAM_INT);
        $query->bindValue(':formatTirage', @$formatTirage, PDO::PARAM_STR);
        $query->bindValue(':nbreposetirage', @$nbreposetirage, PDO::PARAM_STR);
        $query->bindValue(':nbreplaque', @$nbreplaque, PDO::PARAM_STR);
        $query->bindValue(':formatchute', @$formatchute, PDO::PARAM_STR);

        $query->bindValue(':etatprod', @$etatprod, PDO::PARAM_STR);



        $query->execute();

        $_SESSION['message'] = "Production  Ajoutée avec succés";
        require_once('closeclient.php');

        header("Location: production.php?niveau1=d");
        // On nettoie les données envoyées
        // $client = strip_tags($_POST['client']);
        // $tel = strip_tags($_POST['tel']);
        // // $prix = strip_tags($_POST['prix']);
        // // $qteMin = strip_tags($_POST['qteMin']);

        // $sql = 'INSERT INTO `client` (`client`, `tel`) VALUES (:client,:tel);';

        // $query = $db->prepare($sql);

        // $query->bindValue(':client', $client, PDO::PARAM_STR);
        // $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        // // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        // // $query->bindValue(':qteMin', $qteMin, PDO::PARAM_INT);

        // $query->execute();

        // $_SESSION['message'] = "Client ajouté";
        // require_once('closeclient.php');

        // header('Location: indexclient.php?page=1');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter production</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php require_once('./navbarok.php') ?>
    <?php require_once('./base4.php'); ?>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <h1 class="entete">Ajout de production</h1>
                <form method="post" class="was-validated">
                    <div class="form-group">
                        <label for="dates">Date</label>
                        <?php $datevalue = date('Y-m-d') ?>
                        <input type="date" id="dates" value=<?= $datevalue ?> name="dates" class="form-control">
                    </div>
                    <div class="form-group">

                        <label for="idclient">Sélectionner le client dans la liste</label>
                        <br>

                        <select class="form-control" id="idclient" name="idclient" required onchange="selection()" required>
                            <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->


                            <option value="" selected>veuillez selectionner un client</option>
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
                            //    @$var =  "<script>document.write(var1);</script>" ;
                            // On boucle sur la variable result

                            // echo $var;


                            foreach ($resultclient as $client) {

                                // var_dump($client);
                            ?>

                                <option value="<?php echo $client['id'] ?>" <?php if ($idclientSel == $client['id']) {
                                                                                echo "selected";
                                                                                $_SESSION['nomclient'] = $client['client'];

                                                                                //print_r($_SESSION['nomclient']);
                                                                                //die();
                                                                            }
                                                                            ?>>
                                    <?php echo ($client['id'] . '/' . $client['client']) ?></option>
                            <?php
                            }

                            ?>
                            <!-- < ?php
                            // On boucle sur la variable result

                            foreach ($resultclient as $client) {
                                //   var_dump($client);
                            ?>
                                <option value="< ?php echo  $client['id'] ?>">
                                    < ?php echo ($client['id'] . '/' . $client['client']) ?></option>
                            < ?php
                            }
                            ?> -->
                        </select>



                    </div>

                    <div class="form-group">

                        <label for="client">Sélectionner la commande dans la liste</label>
                        <br>

                        <select class="form-control" id="idcommande" name="idcommande" required>



                            <!-- <option value=" " selected>veuillez selectionner</option> -->
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
                            // On boucle sur la variable result
// foreach ($variable as $key => $value) {
//     # code...
// }


                            $nbcomm=0;
                            foreach ($resultcommande as $commande) {
                               
                                if ($idclientSel == $commande['idclient']) {
                                   
                                    if ($idcommandeSel == $commande['id']) {
                                     
                            
                                        echo "selected";
                                        $_SESSION['idimprime'] = $commande['idimprime'];
                                      
                                    }
                              

                                                            
                                ?>
                                    <option value="<?php echo  $commande['id']."/".$commande['quantite'] ?>">
                                        <?php echo 'Commande N°' . $commande['id'] . " " . $commande['imprime'] . ' Qté ' . $commande['quantite'] ?>
                                    </option>
                            <?php
                                                            //  }
                                                            // }    
                                $nbcomm++;                              
                                } 
                               
                            } // fin foreach
                            if ($nbcomm==0) {?> <option value="">pas de commande en cours</option> <?php }
                            ?>
                        </select>

                        <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>

                    <!-- <div class="form-group">
                        <label for="idimprime">id imprimé</label>
                        <input value="< ?php if (isset($_SESSION['idimprime'])) $_SESSION['idimprime'] ?>" type="number" id="idimprime" name="idimprime" class="form-control" disabled>
                    </div> -->
                    <!-- <div class="form-group">

                        <label for="idimprime">Sélectionner l'imprimé dans la liste</label>
                        <br>
                       
                        <select class="form-control" id="idimprime" name="idimprime" required>
                          
                           
                            < ?php
                            // On boucle sur la variable result

                            foreach ($result as $imprime) {
                                if ($idclientSel==$imprime['idclient'])  {
                                    echo "selected";
                                //   var_dump($client);
                            ?>
                                <option value="< ?php echo  $imprime['id'] ?>">
                                    < ?php echo ($imprime['id'] . '/' . $imprime['imprime'] . '/' . $imprime['impclient']) ?></option>
                            < ?php
                            }
                        }
                            ? >
                        </select>

                        

                    </div> -->

                    <!-- <div class="form-group">
                        <label for="idcommande">id client</label>
                        <input type="number" id="idclient" name="idclient" class="form-control" >
                    </div> -->


                    <!-- <div class="form-group">
                        <label for="idcommande">id matiere</label>
                        <input type="number" id="idmatiere" name="idmatiere" class="form-control" >
                    </div> -->
                    <div class="form-group">

                        <label for="matiere">Sélectionner la matiere dans la liste</label>
                        <br>
                        <!-- select de matiere -->
                        <select class="form-control" id="idmatiere" name="idmatiere" required>
                            <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->


                            <!-- <option value=" " selected>veuillez selectionner</option> -->
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
                            // On boucle sur la variable result

                            foreach ($resultmatiere as $matiere) {
                                //   var_dump($client);
                            ?>
                                <option value="<?php echo $matiere['idmat'] . '/' . $matiere['matiere'] . '/' . $matiere['grammage'] .
                                                    '/' . $matiere['formatxxyy']   ?>">
                                    <?php echo 'N°' . $matiere['idmat'] . '/' . $matiere['matiere'] . '/' . $matiere['grammage'] .
                                        '/' . $matiere['formatxxyy'] . '/'  ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>

                    <!-- <div class="form-group">
                        <label for="qteaconsommer">Qte à consommer</label>

                        <input type="number" name="qteaconsommer" class="form-control" required>
                    </div> -->

                    <!-- <div class="form-group">[0-9]{1,3}[.]{0,1}[0-9]{0,2}+[X][0-9]{1,3}[.]{0,1}[0-9]{0,2} -->
                        <label for="formatcoupe">Format de coupe & tirage</label>
                        <input type="text" placeholder="ex 21X31" name="formatcoupe" class="form-control"  pattern="[0-9]{1,3}[.]{0,1}[X]{1}[0-9]{1,3}" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="nbreposecoupe">Nbre poses par coupe</label>
                        <input type="text" name="nbreposecoupe" class="form-control" required>
                    </div> -->



                    <!-- <div class="form-group">
                        <label for="formatTirage">Format tirage</label>
                        <input type="text" placeholder="ex 65X100" name="formatTirage" class="form-control" pattern="[0-9,',','.']{2,3,4}[x,X]{1}[0-9,',','.']{2,3,4}" required>
                    </div> -->

                    <div class="form-group">
                        <label for="nbreposetirage">Nb pose Tirage</label>
                        <input type="number" name="nbreposetirage" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nbreplaque">Nbre de plaques</label>
                        <input type="number" name="nbreplaque" class="form-control" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="formatchute">Format chute</label>
                        <input type="text" placeholder="ex 05X100" name="formatchute" class="form-control" pattern="[0-9,',','.']{2,3,4}[x,X]{1}[0-9,',','.']{2,3,4}" required>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="periodicite">Grammage</label>
                        <select name="periodicite" id="periodicite" class="form-control">
                        <option value="jour">Quantité</option>
                        <option value="semaine">Semaine</option>
                        <option value="mois">Mois</option>
                        <option value="ponctuelle">Ponctuelle</option>

                        </select> -->
                    <!-- <input type="text" name="periodicite"  class="form-control"> -->
                    <!-- </div> -->
                    <!-- <div class="form-group">
                        <label for="montant">Montant</label>
                        <input type="text" name="montant"  class="form-control">
                        </div> -->



                    <!-- <input type="hidden" value="< ?= $client['id']?>" name="id"> -->
                    <!-- <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">

                    </div> -->
                    <!-- <div class="form-group">
                        <label for="qteMin">Qte Min</label>
                        <input type="number" id="qteMin" name="qteMin" class="form-control">
                    </div> -->
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
                <br>
                <a class="btn btn-success" href="production.php">Annuler</a>
            </section>


        </div>
    </main>
    <script>
        function selection() {
            // Creating a cookie after the document is ready
            // $(document).ready(function () {

            //     createCookie("idclient", document.getElementById("idclient").value, "1");
            //     // createCookie("idcommande", document.getElementById("idcommande").value, "1");
            // });

            // // Function to create the cookie
            // function createCookie(name, value, days) {
            //     var expires;
            //     // var var1=document.getElementById("client").value;

            //     if (days) {
            //         var date = new Date();
            //         date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            //         expires = "; expires=" + date.toGMTString();
            //     }
            //     else {
            //         expires = "";
            //     }

            //     document.cookie = escape(name) + "=" + 
            //         escape(value) + expires + "; path=/";
            // }

            // console.log(var1);
            window.location.href = "addproduction.php?idclient=" + document.getElementById("idclient").value +
                "&idcommande=" + document.getElementById("idcommande").value;
            //$_COOKIE["idclient"];

        }
    </script>
</body>

</html>