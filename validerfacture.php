<?php
require_once "const.php";

//require_once('role.php');
if (isset($_GET['idclient'])) {
      //  if (isset($_GET['page'])) 
      // @$page=$_GET['page']; 
      //else $page=1;
      $trieclientid = $_GET['idclient'];
}
if (isset($_GET['idclient'])) {
    
      $datebl = $_GET['datebl'];
}

if (isset($_GET['modepaiement']) && !empty($_GET['modepaiement']))  $modepaiement=$_GET['modepaiement'];
if (isset($_GET["nbr"]) && !empty($_GET["nbr"])) $nbr=$_GET["nbr"]; else $nbr=0; 

$annee = date('Y');
if (@$_SESSION['valider'] === "non" && @$_SESSION['valider'] != "deja") {
      require_once('serveur.php');
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

      //$sql = 'SELECT * FROM `numero`';
      $sql = 'SELECT * FROM `numero` WHERE `annee`=:annee';
      // On prépare la requête
      $query = $db->prepare($sql);

      // On "accroche" les paramètre (id)
      //$query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->bindValue(':annee', $annee, PDO::PARAM_INT);
      // On exécute la requête
      $query->execute();

      // On récupère le produit
      $numero = $query->fetch();
      //print_r($numero['facture']);

      // die();
      $nbr = $numero['facture'] + 1;
      $id = $numero['id'];
     
      // print_r($numero['id']);

      // require_once('serveur.php');
      // try{
      //       // Connexion à la base
      //       if ($serveur=="local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
      //       if ($serveur=="distant")$db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59' , 'globa932_globa932', 'exp2581exp');
      //       if ($serveur=="serveur")$db = new PDO('mysql:dbname=globa932_demo01;host=localhost' , 'globa932_globa932', 'exp2581exp');
      //       if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

      //       $db->exec('SET NAMES "UTF8"');
      //       } catch (PDOException $e){
      //       echo 'Erreur : '. $e->getMessage();
      //       die();
      //       }



      $sql = 'UPDATE `numero` SET `facture`=:nbr  WHERE `id`=:id;';

      $query = $db->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->bindValue(':nbr', $nbr, PDO::PARAM_INT);




      $query->execute();


      // $fp = fopen("./facture.txt", "r+");
      // $nbr = fgets($fp);

      // $nbr += 1;
      // fseek($fp, 0);
      // fputs($fp, $nbr);
      // fclose($fp);
      $_SESSION['valider'] = "oui";
      $_SESSION['message'] .= "Facture Validé";
} else {
      $_SESSION['message'] .= "Facture Déja Validé ";
      //$_SESSION['valider'] = "deja";
      }


header("Location: factureneioselection.php?idclient=$trieclientid&datebl=$datebl&modepaiement=$modepaiement&nbr=$nbr");
// echo $_SESSION['valider']."<br>";
// echo $modepaiement."<br>";
// echo $datebl."<br>";
// echo $nbr;
die;
