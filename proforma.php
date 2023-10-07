<?php
require_once "const.php";

//require_once('role.php');
include('./functions/ChiffresEnLettres.php');


//echo $_SESSION['numblclient'];
//$trieclientid=$_SESSION['numblclient'];
//$datebl = date('Y-m-d');
if (isset($_GET["datebl"]) && !empty($_GET["datebl"])) $datebl = $_GET["datebl"];
else if (@$datebl == "") $datebl = date('Y-m-d');

$annee = date('Y');
//.' à '. date("H:i");;
$nbr = 0;

//print_r($_SESSION['valider']);



// if (empty($resultcommande)) $resultcommande = array(
// //                   // array("idclient"=>0,"nomclient"=>"","quantite"=>"","imprime"=>"","prix"=>"","prepress"=>"","total"=>"")
//                    array() 
// //                   // ,array()  
// //                   // ,array()  ,array()


// );
//@$resultcommande=[];
//$_SESSION['resultcommande'];
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
//$trieclientid ="";
// test si bon de livraison si 1 seul client
//$nomclient = "client";
if (!isset($_SESSION['boucle'])) $_SESSION['boucle'] = 1;
if (isset($_GET['v1'])) {

  $_SESSION['boucle']++;
  $_SESSION['resultcommande'] = $resultcommande;
}
if (isset($_GET['v2']) && $_SESSION['boucle'] > 1) {
  $_SESSION['boucle']--;
  $_SESSION['resultcommande'] = $resultcommande;
}
// $boucle =1;
// $_SESSION['boucle']=$boucle;
//count($resultcommande);
//echo $boucle;
// if (isset($_GET["v1"]) && !empty($_GET["v1"]) && $_GET["v1"]=="+Ligne") $boucle++;
// if (isset($_GET["v1"]) && !empty($_GET["v1"]) && $_GET["v1"]=="-Ligne" && $_GET["v1"]>0) $boucle++;

if (isset($_GET["idclient"]) && !empty($_GET["idclient"])) {
  $trieclientid = $_GET["idclient"];
  $_SESSION['resultcommande'] = $resultcommande;
}
for ($i = 0; $i < $_SESSION['boucle']; $i++) {


  if (isset($_GET["quantite$i"]) && !empty($_GET["quantite$i"]) && $_GET["quantite$i"] > 0) {
    @$resultcommande[$i]['quantite'] = $_GET["quantite$i"];
    @$resultcommande[$i]['total'] = ($resultcommande[$i]['quantite'] * $resultcommande[$i]['prix']) + $resultcommande[$i]['prepress'];
    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[0]);
    // echo "</pre>";
  }

  if (isset($_GET["prepress$i"]) && !empty($_GET["prepress$i"]) && $_GET["prepress$i"] >= 0) {
    //if ($_GET["prepress$i"]=="0") $_GET["prepress$i"]="00";
    $resultcommande[$i]['prepress'] = $_GET["prepress$i"];
    @$resultcommande[$i]['total'] = ($resultcommande[$i]['quantite'] * $resultcommande[$i]['prix']) + $resultcommande[$i]['prepress'];
    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[1]);
    // echo "</pre>";
  }

  if (isset($_GET["imprime$i"]) && !empty($_GET["imprime$i"])) {

    $resultcommande[$i]['imprime'] = $_GET["imprime$i"];

    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[1]);
    // echo "</pre>";
  }
  if (isset($_GET["prix$i"]) && !empty($_GET["prix$i"])) {

    $resultcommande[$i]['prix'] = $_GET["prix$i"];
    $resultcommande[$i]['total'] = ($resultcommande[$i]['quantite'] * $resultcommande[$i]['prix']) + $resultcommande[$i]['prepress'];
    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[1]);
    // echo "</pre>";
  }
}




//echo $occurence."<br";


if (@$_SESSION['valider'] === "oui" or @$_SESSION['valider'] === "deja") {



  // acceder à la table numero afin de recuperer les numero de facture et bl et proforma
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

  $total1 = 0;
  //$idcommandes = "";
  //$nombrecommandes=0;
  // On boucle sur la variable result
  // foreach ($resultcommande as $commande) {
  //   $total1 += $commande['total'];
  //   $idcommandes .= $commande['id'] . "-" . $commande['quantite'] . "/";
  //   //$nombrecommandes+=1;
  // }


  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

  // $$$$$$$$$$$$$$$$$$$$$enregistrement ds la table bondelivraison du bl$$$$$$$$$$$$$$$$$$$$$$$$$$
  //require_once('connectbondelivraison.php');
  require_once('serveur.php');
  if ($_SESSION['valider'] != "deja" && $_SESSION['valider'] === "oui") {
    try {
      // Connexion à la base
      if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
      if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
      if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
      if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

      $db->exec('SET NAMES "UTF8"');
    } catch (PDOException $e) {
      echo 'Erreur : ' . $e->getMessage();
      die();
    }

    // On nettoie les données envoyées
    //$client = strip_tags($_POST['client']);
    //$tel = strip_tags($_POST['tel']);
    // $prix = strip_tags($_POST['prix']);
    // $qteMin = strip_tags($_POST['qteMin']);
    //$idcommandes=$resultcommande[0]['id'];
    @$_SESSION['msm'] = "oui";
    // $fp=fopen("./facture.txt","r+");
    // $nbr=fgets($fp);
    // fclose($fp);
    // `id` = :id;';
    $sql = 'SELECT * FROM `numero` WHERE `annee`=:annee';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':annee', $annee, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $numero = $query->fetch();
    //print_r($numero['facture']);

    // die();
    $nbr = $numero['proforma'];
    $numbl = $nbr;
    //die();
    $client = $nomclient;
    $idcommandes = 0;
    $fichier = "factprof" . strtolower($client) . $nbr . ".pdf";
    //$datebl="2022/05/05";
    $montant = $total1;
    $sql = "INSERT INTO `bondelivraison` (`fichier`,`idcommandes`, `numbl`,`client`,`datebl`,`montant`) VALUES (:fichier,:idcommandes,:numbl,:client,:datebl,:montant)";

    $query = $db->prepare($sql);

    $query->bindValue(':idcommandes', $idcommandes, PDO::PARAM_STR);
    $query->bindValue(':fichier', $fichier, PDO::PARAM_STR);
    $query->bindValue(':numbl', $numbl, PDO::PARAM_STR);
    $query->bindValue(':client', $client, PDO::PARAM_STR);
    $query->bindValue(':datebl', $datebl, PDO::PARAM_STR);
    $query->bindValue(':montant', $montant, PDO::PARAM_STR);


    $query->execute();
    //$db = null;
    $sql = null;
    $_SESSION['valider'] = "deja";

    // fin lecture de la table client afin de recuperer tous les coordonnées client


    //$_SESSION['message'] = "Bon de livraison Validé";
    //require_once('closeclient.php');
    // On se déconnecte de la base db et sql

    //header('Location: indexclient.php?page=1');

    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    // $_SESSION['valider']="non";
  }
}
//else $nbr=0;
// Debut lecture de la table client afin de recuperer tous les coordonnées client
require_once('connectclient.php');

// On nettoie l'id envoyé
//$id = $trieclientid;


$sql = 'SELECT * FROM `client`';
// On prépare la requête
$query = $db->prepare($sql);

// On "accroche" les paramètre (id)
// $query->bindValue(':id', $id, PDO::PARAM_INT);

// On exécute la requête
$query->execute();

// On récupère le produit
$resultclient = $query->fetchall(); ?>




<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./images/logo.avif" type="image" />
  <link rel="stylesheet" href="./css/stylebl.css">
  <link rel="stylesheet" type="text/css" href="./css/impression.css" media="print">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <title>Facture</title>
</head>

<body>
  <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

  <!-- <h1 class="entete">Liste de commandes par client</h1> -->
  <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->
  <div class="container">
    <div class="logo">
      <img src="images/logoneio.png" alt="logo neio" width="100" height="auto">


    </div>
    <div class="en tete bold">
      <h3 class="gras"> IMPRIMERIE BOUALAM LAHOUARI. NEIO</h3>
      <p>17 rue moussa Ahmed(Ex alexis cuvelier) Oran</p>
      <p class="gras">Imprimerie Tous travaux d'imprimerie</p>
      <p> Offset-impression numerique-Emballage-Etiquette-Travaux de ville</p>
      <!-- <p class="gras">Publicité internet & video de présentation conception de sites web	</p>		 -->

      <p>RC N°98A052726 IF 1937310102871 Article N°31806613011 </p>
      <p>Nis 194331010677042 RIB BNA N°00100960030010136077</p>
      <p>Contact 0541 03 55 48 e-mail contact@global2pub.com </p>


    </div>

  </div>
  <hr>
  <br>
  <div class="containerbl">
    <div class="stylebl">
      <!-- <p>Bon de livraison N°001 du < ?= $datebl ?></p>  -->


    </div>

    <div class="stylebl">

      <?php $sql = 'SELECT * FROM `numero` WHERE `annee`=:annee';

      // On prépare la requête
      $query = $db->prepare($sql);

      // On "accroche" les paramètre (id)
      $query->bindValue(':annee', $annee, PDO::PARAM_INT);

      // On exécute la requête
      $query->execute();

      // On récupère le produit
      $numero = $query->fetch();
      //print_r($numero['facture']);

      // die();
      // $nbr=$numero['facture'];
      //$numbl=$nbr;
      ?>




      <form name="fo10" method="get">
        <input class="btn btn-success" type="submit" name="v1" value="+Ligne" />

        <input class="btn btn-success" type="submit" name="v2" value="-Ligne" />
      </form>
      <form name="form" method="get" action="">
        <select class="form -control" id="idclient" name="idclient" onchange="this.form.submit()" required>

          <option value="">Selectionnez un client</option>
          <?php
          // On boucle sur la variable result

          foreach ($resultclient as $client) :

          ?>

            <option value="<?php
                            echo (@$client['id']) ?>" <?php if (@$client['id'] == @$trieclientid) echo 'selected' ?>>
              <?php echo (@$client['id'] . '/' . @$client['client']) ?>
            </option>
          <?php
          endforeach;
          ?>
        </select>
        <p class="gras"><span class="gras">Facture proforma N°</span><?php if (@$nbr > 0) echo @$nbr ?> <br> du</p>
        <!-- <p class="gras" ><span class="gras">Facture N°</span><?php if (@$nbr > 0) echo @$nbr ?> <br> du 26 janvier 2023 </p>  -->
        <?php if (@$_SESSION['valider'] !== "deja") { ?>
          <input type="date" value="<?= $datebl ?>" id="datebl" name="datebl" onchange="this.form.submit()" required>
        <?php } else echo "<p>" . $datebl . "</p>" ?>

        <!-- <p>N° < ?= $trieclientid." ".$nomclient ?></p> -->
        <!-- <p>Adresse Client</p>
    <p>E-mail</p> -->
    </div>

    <!-- <div class="stylebl">
    <p>Bon de livraison N°001 du < ?= $datebl ?></p> 
   
    <p>N° < ?= $trieclientid." ".$nomclient ?></p>
    <p>Adresse:Cite usto zone des sièges Oran</p>
    <p>E-mail:new@gmail.com</p> -->
  </div>
  </div>

  <a id="bouton" href="./indexcommande.php?page=1&recherche=&niveau=ins" class="btn btn-danger btn-block">Retourner ou Annuler</a>
  <!-- <a id="bouton" href="validerproforma.php?idclient=<?= $trieclientid ?>" class="btn btn-primary btn-block">Valider La Proforma</a> -->
  <!-- <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf </a> -->
  <a id="bouton" href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer la Facture proforma</a>
  <div class="tab table-responsive-sm table-striped">


    <table class="table">
      <thead>
        <th>+/-</th>
        <!-- <th>CC</th> -->

        <!-- <th>Date commande</th> -->
        <!-- <th>ID client</th> -->
        <!-- <th>client</th> -->
        <!-- <th>CI</th> -->
        <th>Désignation imprimé</th>
        <th>quantité</th>
        <th>prix TTC</th>
        <th>prepress</th>
        <th>Total TTC</th>
        <!-- <th>remarque</th>
                        <th>etat</th>
                        <th>paiement</th>
                      
                        <th>Actions</th> -->
      </thead>
      <tbody>
        <?php
        $total1 = 0;
        //$nombrecommandes=0;
        // On boucle sur la variable result
        //$boucle = 2;
        for ($i = 0; $i < $_SESSION['boucle']; $i++) { ?>




          <tr>
            <td>

            </td>


            <!-- <td class="table-success">< ?= $commande['dates'] ?></td> -->
            <!-- <td class="table-pr imary">< ?= $commande['idclient'] ?></td> -->
            <!-- <td class="table-in fo">< ?= $resultcommande['nomclient'] ?></td> -->

            <td>
              <!-- < ?= $commande['imprime'] ?> -->
              <?php if ($_SESSION['valider'] !== "deja") { ?>

                <input type="text" value="<?= @$resultcommande[$i]['imprime'] ?>" id="imprime<?= $i ?>" name="imprime<?= $i ?>" onchange="this.form.submit()" required>
              <?php } else echo @$resultcommande[$i]['imprime'] ?>
            </td>
            <td>
              <!-- <label for="quantite">Quantité</label> -->
              <?php if ($_SESSION['valider'] !== "deja") { ?>
                <input type="number" min="0" value="<?= $resultcommande[$i]['quantite'] ?>" id="quantite<?= $i ?>" name="quantite<?= $i ?>" onchange="this.form.submit()" required>

              <?php } else echo $resultcommande[$i]['quantite'] ?>
            </td>
            <td>
              <?php if ($_SESSION['valider'] !== "deja") { ?>
                <input type="number" min="0" value="<?= $resultcommande[$i]['prix'] ?>" id="prix<?= $i ?>" name="prix<?= $i ?>" onchange="this.form.submit()" required>

              <?php } else echo $resultcommande[$i]['prix'] ?>
            </td>

            <td>
              <!-- < ?= $commande['prepress'] ?> -->
              <?php if ($_SESSION['valider'] !== "deja") { ?>
                <input type="number" min="0" value="<?= $resultcommande[$i]['prepress'] ?>" id="prepress<?= $i ?>" name="prepress<?= $i ?>" onchange="this.form.submit()" required>
              <?php } else echo $resultcommande[$i]['prepress'] ?>
            </td>

            <td><?= @$resultcommande[$i]['total'] ?></td>

            <!-- <td>< ?= $commande['total'] ?></td> -->
            <!-- <td class="table-primary">< ?= $commande['remarque'] ?></td>
                                <td class="table-primary">< ?= $commande['etat'] ?></td>
                                <td class="table-primary">< ?= $commande['paiement'] ?></td> -->
            <!-- <td class="table-success"> -->
            <div class="btn-group">

            </div>
            </td>



          </tr>

        <?php
          @$total1 += @$resultcommande[$i]['total'];
          //$i++;
          //echo $i;

        } //
        ?>
        <!-- <td class="table-primary">Total en DZ</td> -->
        <!-- <td class="table-d anger"></td> -->
        <!-- <td class="table-p rimary"></td> -->
        <td></td>
        <td></td>
        <td></td>
        <!-- <td></td>
          <td></td> -->
        <td></td>
        <td>Total Gle TTC</td>
        <td class="table-success"><span class="gras"><?= number_format($total1, 2, ",", ".") ?> </span></td>
        <!-- <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td> -->
      </tbody>

    </table>
    </form>

  </div>
  <?php $lettre = new ChiffreEnLettre();
  echo $total1;
  //die();
  $chiffre = intval($total1);
  $reste = ($total1 - $chiffre) * 100;

  $lettre->Conversion($chiffre);
  if ($reste == 0) $chaine = $lettre->enLettre . " DA";
  else $chaine = $lettre->enLettre . " DA et $reste centimes";
  //$chaine = mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
  ?>

  <p> <span class="gras">Non Assujetti à la TVA</p>
  <p>Arrétée la présente Proforma à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>

  <div class="basdepage">


    <!-- <p>Accusé de reception client</p> 
                <p>Cachet et signature</p> -->
  </div>
  <!-- <img  class="cachet" src="./images/cachet2.png" alt="logo global2pub" width="230" height="auto"> -->
  <?php

  // print_r($client);

  ?>
  <br>

  <br><br><br>
</body>

</html>