<?php
require_once "const.php";


//require_once('role.php');
include('./functions/ChiffresEnLettres.php');


//echo $_SESSION['numblclient'];
//$trieclientid=$_SESSION['numblclient'];
if (isset($_GET["datebl"]) && !empty($_GET["datebl"])) $datebl = $_GET["datebl"];
else if (@$datebl == "") $datebl = date('Y-m-d');
if (isset($_GET["modepaiement"]) && !empty($_GET["modepaiement"])) $modepaiement = $_GET["modepaiement"];
else $modepaiement = "a terme";
//else $modepaiement="a terme";
//$datebl = date('Y-m-d');
$annee = date('Y');
//.' à '. date("H:i");;

$nbr = 0;
if (isset($_GET["nbr"]) && !empty($_GET["nbr"])) $nbr = $_GET["nbr"];
else $nbr = 0;




$resultcommande = $_SESSION['resultcommande'];
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
$trieclientid = $resultcommande[0]['idclient'];
// test si bon de livraison si 1 seul client
$nomclient = $resultcommande[0]['nomclient'];
$boucle = count($resultcommande);
//if (isset($modepaiement) && !empty($modepaiement))  $modepaiement=$_GET["modepaiement"]; else $modepaiement="";
//echo $modepaiement;
//die();

// echo $_SESSION['valider']."<br>";
// echo $modepaiement."<br>";
// echo $datebl."<br>";

//echo $idcommandes;




for ($i = 0; $i < $boucle; $i++) {

  if (isset($_GET["quantite$i"]) && !empty($_GET["quantite$i"]) && $_GET["quantite$i"] > 0) {
    $resultcommande[$i]['quantite'] = $_GET["quantite$i"];
    $resultcommande[$i]['total'] = ($resultcommande[$i]['quantite'] * $resultcommande[$i]['prix']) + $resultcommande[$i]['prepress'];
    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[0]);
    // echo "</pre>";
  }

  if (isset($_GET["prepress$i"]) && !empty($_GET["prepress$i"]) && $_GET["prepress$i"] >= 0) {
    //if ($_GET["prepress$i"]=="0") $_GET["prepress$i"]="00";
    $resultcommande[$i]['prepress'] = $_GET["prepress$i"];
    $resultcommande[$i]['total'] = ($resultcommande[$i]['quantite'] * $resultcommande[$i]['prix']) + $resultcommande[$i]['prepress'];
    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[1]);
    // echo "</pre>";
  }
}


$occurence = 0;
//echo $trieclientid."<br>";
foreach ($resultcommande as $commande) {
  if ($commande['idclient'] != $trieclientid) $occurence++;
}
//echo $occurence."<br";
if ($occurence > 0) {
  $_SESSION['erreur'] = "Deux Clients ne peuvent pas avoir la même Facture!";
  header('Location: ./indexcommande.php?page=1');
}


if (@$_SESSION['valider'] === "oui") {



  // acceder à la table numero afin de recuperer les numero de facture et bl et proforma
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

  $total1 = 0;
  $idcommandes = "";
  //$nombrecommandes=0;
  // On boucle sur la variable result
  foreach ($resultcommande as $commande) {
    $total1 += $commande['total'];
    $idcommandes .= $commande['id'] . "-" . $commande['quantite'] . "/";
    //$nombrecommandes+=1;
  }



  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

  // $$$$$$$$$$$$$$$$$$$$$enregistrement ds la table bondelivraison du bl$$$$$$$$$$$$$$$$$$$$$$$$$$
  //require_once('connectbondelivraison.php');
  require('serveur.php');
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
    $nbr = $numero['facture'];
    $numbl = $nbr;
    //die();
    $client = $nomclient;
    $fichier = "fact" . strtolower($client) . $nbr . ".pdf";
    //$datebl="2022/05/05";
    $montant = $total1;
    $modepaiement = $_GET["modepaiement"];
    // echo $modepaiement;
    // die();
    $sql = "INSERT INTO `bondelivraison` (`fichier`,`idcommandes`, `numbl`,`client`,`datebl`,`montant`,`modepaiement`) VALUES (:fichier,:idcommandes,:numbl,:client,:datebl,:montant,:modepaiement)";

    $query = $db->prepare($sql);

    $query->bindValue(':idcommandes', $idcommandes, PDO::PARAM_STR);
    $query->bindValue(':fichier', $fichier, PDO::PARAM_STR);
    $query->bindValue(':numbl', $numbl, PDO::PARAM_STR);
    $query->bindValue(':client', $client, PDO::PARAM_STR);
    $query->bindValue(':datebl', $datebl, PDO::PARAM_STR);
    $query->bindValue(':montant', $montant, PDO::PARAM_STR);
    $query->bindValue(':modepaiement', $modepaiement, PDO::PARAM_STR);

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
} // fin de test si facture validée


//else $nbr=0;
// Debut lecture de la table client afin de recuperer tous les coordonnées client
require_once('connectclient.php');

// On nettoie l'id envoyé
$id = $trieclientid;


$sql = 'SELECT * FROM `client` WHERE `id` = :id;';
// On prépare la requête
$query = $db->prepare($sql);

// On "accroche" les paramètre (id)
$query->bindValue(':id', $id, PDO::PARAM_INT);

// On exécute la requête
$query->execute();

// On récupère le produit
$client = $query->fetch();



?>
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

      <p>RC N°98A0520726 IF 193731010287140 Article N°31806613011 </p>
      <p>Nis 194331010677042 RIB BNA N°00100960030010136077</p>
      <p>Contact 0541 03 55 48 e-mail contact@global2pub.com </p>


    </div>

  </div>
  <hr>
  <br>
  <div class="containerbl">
    <div class="stylebl">

      <form name="form" method="get" action="">
        <p class="gras"><span class="gras">Facture N°</span><?php if ($nbr > 0) echo @$nbr ?> du</p>


        <?php if (@$_SESSION['valider'] !== "deja") { ?>

          <input type="date" value="<?= $datebl ?>" id="datebl" name="datebl" onchange="this.form.submit()" required>

        <?php } else {
          echo "<p>" . $datebl . "</p>";
          //echo $modepaiement;
        } ?>
        <!-- <p>Bon de livraison N°001 du < ?= $datebl ?></p>  -->

        <p class="gras">N° <?= $trieclientid . " " . $nomclient ?></p>
        <!-- < ?php if ($trieclientid == 122) { ?> -->
        <!-- <p>Activité: Fabrication de tapis et Moquette</p>
        <p>tel: 041 65 90 00 FAX 041 65 90 10</p>
        <p>Adresse:< ?php echo $client['adresse'] ?></p>
        <p>Rc:< ?php echo $client['registre'] ?></p>
        <p>NIF:< ?php echo $client['idfiscal'] ?></p>
        <p>NIS:098231200028931</p>
        <p>TIN:< ?php echo $client['art'] ?></p> -->
        <!-- <p>Mode de paiement cheque</p> -->
        <!-- < ?php }   -->
        <!-- // else { ?> -->
        <!-- <p>Mode Paiement:virement tresor</p> -->
        <!-- <p>Type de livraison:</p> -->
        <?php if ($client['activite'] != '') : ?>
          <p>Activite:<?php echo $client['activite'] ?></p>
        <?php endif ?>

        <?php if ($client['telsiege'] != '') : ?>
          <p>Telephone:<?php echo $client['telsiege'] ?></p>
        <?php endif ?>
        <p>Adresse:<?php echo $client['adresse'] ?></p>
        <!-- <p>e-mail: < ?php echo $client['email'] ?></p> -->
        <!-- <p>tel:< ?php echo $client['tel'] ?></p> -->
        <!-- <p>tel: 041 65 90 00 FAX 041 65 90 10</p> -->

        <p>Rc:<?php echo $client['registre'] ?></p>
        <p>NIF:<?php echo $client['idfiscal'] ?></p>
        <p>NIS:<?php echo $client['nis'] ?></p>
        <!-- <p>NIS:098231200028931</p> -->
        <p>Article:<?php echo $client['art'] ?></p>
        <!-- <label>Description imprimé </label> -->
        Mode de paiement:
        <?php if (@$_SESSION['valider'] !== "deja") { ?>
          <select id="modepaiement" name="modepaiement" onchange="this.form.submit()" required>
            <option value="a terme" <?php if (@$_GET["modepaiement"] == "a terme") echo "selected" ?>>à terme</option>
            <option value="cheque" <?php if (@$_GET["modepaiement"] == "cheque") echo "selected" ?>>Cheque</option>
            <option value="virement" <?php if (@$_GET["modepaiement"] == "virement") echo "selected" ?>>virement</option>
            <option value="espece" <?php if (@$_GET["modepaiement"] == "espece") echo "selected" ?>>espece</option>
          </select>

        <?php
          //@$modepaiement=@$_GET["modepaiement"];
        } else {

          echo @$_GET["modepaiement"];
        } ?>

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

  <!-- < ?php @$modepaiement=$_GET["modepaiement"]; ?> -->



  <div class="tab table-responsive-sm table-striped">

    <table class="table">
      <thead>
        <th>CC</th>
        <!-- <th>Date commande</th> -->
        <!-- <th>ID client</th> -->
        <!-- <th>client</th> -->
        <th>CI</th>
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
        $i = 0;
        foreach ($resultcommande as $commande) {
          if (in_array(@$commande['id'], $_SESSION['sel'])) { ?>

            <tr>
              <td><?= $commande['id'] ?></td>

              <!-- <td class="table-success">< ?= $commande['dates'] ?></td> -->
              <!-- <td class="table-pr imary">< ?= $commande['idclient'] ?></td> -->
              <!-- <td class="table-in fo"><?= $commande['nomclient'] ?></td> -->
              <td><?= $commande['idimprime'] ?></td>
              <td><?= $commande['imprime'] ?></td>
              <td>
                <!-- <label for="quantite">Quantité</label> -->
                <?php if ($_SESSION['valider'] !== "deja") { ?>
                  <input type="number" min="0" placeholder="<?= $commande['quantite'] ?>" id="quantite<?= $i ?>" name="quantite<?= $i ?>" onchange="this.form.submit()" required>
                <?php } else echo $commande['quantite'] ?>
              </td>

              <td><?= $commande['prix'] ?></td>
              <td>
                <!-- < ?= $commande['prepress'] ?> -->
                <?php if ($_SESSION['valider'] !== "deja") { ?>
                  <input type="number" min="0" placeholder="<?= $commande['prepress'] ?>" id="prepress<?= $i ?>" name="prepress<?= $i ?>" onchange="this.form.submit()" required>
                <?php } else echo $commande['prepress'] ?>
              </td>

              <td><?= $commande['total'] ?></td>

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
            $total1 += $commande['total'];
            $i++;
          }
        }
        ?>
        <!-- <td class="table-primary">Total en DZ</td> -->
        <!-- <td class="table-d anger"></td> -->
        <!-- <td class="table-p rimary"></td> -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
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
  //echo $total1."<br>";
  $chiffre = intval($total1);
  //  echo $chiffre."<br>";
  $reste = round(($total1 - $chiffre) * 100);
  //echo round($reste);
  $lettre->Conversion($chiffre);
  if ($reste == 0) $chaine = $lettre->enLettre . " DA";
  else $chaine = $lettre->enLettre . " DA et $reste centimes";
  //$chaine = mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
  ?>
  <p> <span class="gras" style="color:red">Non Assujetti à la TVA</p>
  <!-- <p> <span class="gras">Non Assujetti à la TVA</p> -->
  <p>Arrétée la présente Facture à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>
  <a id="bouton" href="./indexcommande.php?page=1&recherche=&niveau=ins" class="btn btn-danger btn-block">Retour ou Annuler</a>
  <a id="bouton" href="validerfacture.php?idclient=<?= $trieclientid ?>&datebl=<?= $datebl ?>&modepaiement=<?= $modepaiement ?>&nbr=<?= $nbr ?>" class="btn btn-primary btn-block">Valider La Facture</a>
  <!-- <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf </a> -->
  <a id="bouton" href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer la Facture</a>
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