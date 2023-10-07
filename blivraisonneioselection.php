<?php
require_once "const.php";
include('./functions/ChiffresEnLettres.php');

//echo $_SESSION['numblclient'];
//$trieclientid=$_SESSION['numblclient'];
if (isset($_GET["datebl"]) && !empty($_GET["datebl"])) $datebl=$_GET["datebl"]; else if (@$datebl=="") $datebl = date('Y-m-d');
//.' à '. date("H:i");;
$nbr = 0;



$resultcommande = $_SESSION['resultcommande'];
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
//die();
//@$sel = $_POST["sel"];
//$_SESSION['sel']=$sel;
//print_r($_SESSION['sel']);
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
$trieclientid = $resultcommande[0]['idclient'];

// test si bon de livraison si 1 seul client
$nomclient = $resultcommande[0]['nomclient'];
$nomimprime = $resultcommande[0]['imprime'];
$boucle = count($resultcommande);
for ($i = 0; $i < $boucle; $i++) {


  if (isset($_GET["quantite$i"]) && !empty($_GET["quantite$i"]) && $_GET["quantite$i"] > 0) {
    $resultcommande[$i]['quantite'] = $_GET["quantite$i"];
    $resultcommande[$i]['total'] = ($resultcommande[$i]['quantite'] * $resultcommande[$i]['prix']) + $resultcommande[$i]['prepress'];
    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[0]);
    // echo "</pre>";
  }

  if (isset($_GET["quantite$i"]) && !empty($_GET["prepress$i"]) && $_GET["prepress$i"] >= 0) {
    //if ($_GET["prepress$i"]=="0") $_GET["prepress$i"]="00";
    $resultcommande[$i]['prepress'] = $_GET["prepress$i"];
    $resultcommande[$i]['total'] = ($resultcommande[$i]['quantite'] * $resultcommande[$i]['prix']) + $resultcommande[$i]['prepress'];
    $_SESSION['resultcommande'] = $resultcommande;
    // echo "<pre>";
    // print_r($resultcommande[1]);
    // echo "</pre>";
  }
}
// if (isset($_GET['quantite3']) && !empty($_GET['quantite3'])) {
//                                     $resultcommande[3]['quantite']=$_GET['quantite3'];
//                                     $resultcommande[3]['total']=($resultcommande[3]['quantite']*$resultcommande[3]['prix'])+$resultcommande[3]['prepress'];
//                                     $_SESSION['resultcommande']=$resultcommande;
//                                     // echo "<pre>";
//                                     // print_r($resultcommande[2]);
//                                     // echo "</pre>";
//                                       }                             

//print_r($_GET['quantite0']);



//print_r($_GET['prix0']);

$occurence = 0;
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
//echo $trieclientid."<br>";
for ($i = 0; $i < count($resultcommande); $i++) {


  // foreach($resultcommande as $commande){
  if ($resultcommande[$i]['idclient'] != $trieclientid) $occurence++;
}
//echo $occurence."<br";
if ($occurence > 0) {
  $_SESSION['erreur'] = "Pas plus d'un Client  pour un bon de livraison!";
  header('Location: ./indexcommande.php?page=1');

  die();
}

if (@$_SESSION['valider'] === "oui" or @$_SESSION['valider'] === "deja") {
  //   @$_SESSION['valider']="fin";
  @$_SESSION['msm'] = "oui";
  $fp = fopen("./numbl.txt", "r+");
  $nbr = fgets($fp);
  fclose($fp);

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
  // print_r($idcommandes);
  // print_r($total1);
}

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

// $$$$$$$$$$$$$$$$$$$$$enregistrement ds la table bondelivraison du bl$$$$$$$$$$$$$$$$$$$$$$$$$$
//require_once('connectbondelivraison.php');
require_once('serveur.php');

if ($_SESSION['valider'] != "deja" && $_SESSION['valider'] === "oui") {
  try {
    // Connexion à la base
    if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
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
  $numbl = $nbr;
$modepaiement="à therme";
  $client = $nomclient;
  $fichier = "bl" . strtolower($client) . $nbr . "pdf";
  //$datebl="2022/05/05";
  @$montant = @$total1;
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

  //$_SESSION['message'] = "Bon de livraison Validé";
  //require_once('closeclient.php');
  // On se déconnecte de la base db et sql
  //$db = null;
  //$sql = null;
  $solde=$montant;
  $idclient=$trieclientid;
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  $sql = "SELECT * FROM `client` WHERE id=$idclient;";
// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetch(PDO::FETCH_ASSOC);
//print_r($resultclient);
//die();
$solde+=$resultclient['solde'];

//require_once('./closeclient.php');
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  
        $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

        $query = $db->prepare($sql);

        $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

        $query->bindValue(':solde', $solde, PDO::PARAM_STR);




        $query->execute();

        $_SESSION['message'] .= "Solde client modifié avec succée";
        require('closeclient.php');
        //echo $idclient;
  $_SESSION['valider'] = "deja";
}
//header('Location: indexclient.php?page=1');

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

// $_SESSION['valider']="non";

//else $nbr=0;






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
  <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  <title>Bon de livraison</title>
</head>

<body>
  <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

  <!-- <h1 class="entete">Liste de commandes par client</h1> -->
  <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->
  <?php require_once('./navbarok.php') ?>
  <div class="container">
    <div class="logo">
      <img src="images/logoneio.png" alt="logo neio" width="100" height="auto">


    </div>
    <div class="ente te bold">
      <h3 class="gras">NEIO</h3>
      <p class="gras">Imprimerie Industrielle Tous travaux d'imprimerie</p>
      <p> Offset-impression numerique-Emballage-Etiquette-Travaux de ville </p>
      <p class="gras">Publicité internet & video de présentation conception de sites web </p>
      <p>17 rue moussa Ahmed(Ex alexis cuvelier) ex Halles centrales Oran</p>
      <p>Contact 0541 03 55 48/0555 11 97 37 site web https://global2pub.com <br> e-mail contact@global2pub.com </p>

    </div>

  </div>
  <hr>

  <div class="containerbl">
    <div class="stylebl">
      <!-- <p>Bon de livraison N°001 du < ?= $datebl ?></p>  -->

      <p>N° <?= $trieclientid . " " . $nomclient ?></p>
      <!-- <p>Adresse:</p> -->
      <!-- <p>E-mail:</p>
    <p>Tel:</p> -->
    </div>
    <div class="stylebl">

     
      <form name="form" method="get" action="">
      <p>Bon de livraison N°<?php if (@$nbr > 0) echo @$nbr ?> du </p>
  <?php if (@$_SESSION['valider'] !== "deja") { ?>
                  <input type="date"   value="<?=$datebl?>" id="datebl" name="datebl" onchange="this.form.submit()" required> 
                  <?php } else echo "<p>".$datebl."</p>" ?>
    
    <!-- <p>E-mail</p> -->
    </div>
    
  </div>
  </div>

  

  

  <!-- <button class="btn btn-primary btn-block" onclick="encours()">Operation en cours</button> -->

  <!-- <a id="bouton" href="" class="btn btn-primary btn-block" onclick="envoisms()">Envoyer sms</a> -->
  
                 <!-- < ?php }  -->
               
              
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

  $chiffre = intval($total1);
  $reste = round(($total1 - $chiffre) * 100);
  $lettre->Conversion($chiffre);
  if ($reste == 0) $chaine = $lettre->enLettre . " DA";
  else $chaine = $lettre->enLettre . " DA et $reste centimes";
  //$chaine= $lettre->enLettre." DA";
  //$chaine = mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
  ?>

  <p>Arrété le présent Bon de livraison à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>

  <div class="basdepage">


    <p>Accusé de reception client</p>
    <p>Cachet et signature</p>
  </div>
  <a id="bouton" href="./indexcommande.php?page=1&recherche=&niveau=ins" class="btn btn-danger btn-block">Retourner ou Annuler</a>
  <a id="bouton" href="validerbl.php?idclient=<?= $trieclientid ?>&datebl=<?=$datebl ?>" class="btn btn-primary btn-block">Valider le Bon de livraison</a>
  <!-- <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf du bon de livraison</a> -->
  <a id="bouton" href="#" class="btn btn-primary btn-block" onclick="javascript:window.print()">Imprimer le Bon de livraison</a>
  <!-- <a id="bouton" href="sms/envoismsok.php?idclient=< ?= $trieclientid ?>" class="btn btn-primary btn-block">Envoyer Sms de livraison</a> -->



  <!-- <a id="bouton" 
    href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href='sms/envoismsok.php?idclient=< ?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.'" 
    class="btn btn-primary btn-block">Envoyer Sms de livraison</a>
    <div class="tab table-responsive-sm table-striped"> -->
  <br>
  <!-- <button class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de commande prête à être livrée</button> -->
  <a id="bouton" href="#" class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de commande prête à être livrée</a>
  <!-- <img  class="cachet" src="./images/cachet2.png" alt="logo global2pub" width="230" height="auto"> -->
  <script src="sweetalert2.all.min.js"></script>

  <!-- <script>
   
        Swal.fire(
  'Bienvenue!',
  'à vous cher ami!',
  'success'
)
</script> -->
  <script>
    function envoisms() {


      Swal.fire({
        title: 'Envoi Sms de livraison?',
        text: "Etes vous sûr?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Envoyer!',
        cancelButtonText: 'Annuler',
        width: '20em'
      }).then((result) => {
        // document.location.href='sms/envoismsok.php?';
        //  document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.' ;

        if (result.isConfirmed) {

          Swal.fire(
            'En cours!',
            '',
            'success'
          );




          document.location.href = 'sms/envoismsok.php?idclient=<?= $trieclientid ?>&message=Le <?= $datebl ?> Cher <?= $nomclient ?> Votre commande <?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.';



        }
      })
    }


    function encours() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }

      })

      Toast.fire({
        icon: 'success',
        title: 'Operation en cours'
      })
    }
  </script>
</body>

</html>
<!-- < ?php
include('ChiffreEnLettre.php');
?>
au lieu où vous voulez l'afficher faites:
< ?php
$lettre=new ChiffreEnLettre();
$lettre->Conversion($chiffre);
?>
$lettre est une instance de la classe ChiffreEnLettre
$chiffre est la variable qui stocke le chiffre que nous devons traduire en lettre
Conversion() est la fonction qui génère la conversion du chiffre en lettre.	 -->