<?php
require_once "const.php";

//require_once('role.php');
// if  (@$_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
include('./functions/ChiffresEnLettres.php');
// $num = 1999.9;
// $formattedNum = number_format($num)."<br>";
// echo $formattedNum;
// $formattedNum = number_format($num, 2);
// echo $formattedNum;
// echo number_format("1000000")."<br>";
// echo number_format("1000000",2)."<br>";
// echo number_format("1000000",2,",",".");

//echo $_SESSION['numblclient'];
$trieclientid = @$_SESSION['numblclient'];
$datebl = date('Y-m-d') . ' à ' . date("H:i");;
$nbr = 0;
require_once('connectcommande.php');
//`id`=:id;';
$sql = "SELECT * FROM `commande` WHERE idclient=$trieclientid";
//echo $trieclientid;
// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
require_once('closecommande.php');
//die();
if (count($resultcommande) > 0) {
    $date1erecommande = $resultcommande[0]['dates'];
    $nomclient = $resultcommande[0]['nomclient'];
} else {
    $_SESSION['erreur'] = "Aucune commande pour ce client";
    header('Location: ./trieclient.php');
    die();
}


if (@$_SESSION['valider'] === "oui") {
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
        $idcommandes .= $commande['id'] . "-";
        //$nombrecommandes+=1;
    }



    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    // $$$$$$$$$$$$$$$$$$$$$enregistrement ds la table bondelivraison du bl$$$$$$$$$$$$$$$$$$$$$$$$$$
    //require_once('connectbondelivraison.php');
    require_once('serveur.php');
    try {
        // Connexion à la base
        if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
        if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
        if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
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
    $idcommandes = $resultcommande[0]['id'];
    $numbl = $nbr;

    $client = $nomclient;
    $fichier = "bl" . strtolower($client) . $nbr . "pdf";
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

    //$_SESSION['message'] = "Bon de livraison Validé";
    //require_once('closeclient.php');
    // On se déconnecte de la base db et sql
    $db = null;
    $sql = null;
    //header('Location: indexclient.php?page=1');

    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    // $_SESSION['valider']="non";
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Bon de livraison</title>
</head>

<body>

    <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

    <!-- <h1 class="entete">Liste de commandes par client</h1> -->
    <!-- <h2 class="entete">< ?= "Nombre de commandes ".count($resultcommande) ?></h2> -->
    <div class="container">
        <div class="logo">
            <img src="images/logoneio.png" alt="logo neio" width="120" height="auto">


        </div>
        <div class="en tete bold">
            <h3 class="gras">Imprimerie NEIO</h3>
            <p class="gras">Imprimerie Industrielle Tous travaux d'imprimerie</p>
            <p> Offset-impression numerique-Emballage-Etiquette-Travaux de ville </p>
            <p class="gras">Publicité internet & video de présentation conception de sites web </p>
            <p>Adresse:17 rue moussa Ahmed(Ex alexis cuvelier) Halles centrales Oran</p>
            <p>Contact 0541 03 55 48/0770 41 64 21 site web https://global2-pub.com <br> e-mail contact@global2-pub.com </p>

        </div>

    </div>
    <hr>
    <br>
    <div class="containerbl">
        <div class="stylebl">
            <!-- <p>Bon de livraison N°001 du < ?= $datebl ?></p>  -->

            <p>N° <?= $trieclientid . " " . $nomclient ?></p>
            <p>Adresse:</p>
            <p>E-mail:</p>
            <p>Tel:</p>
        </div>
        <div class="stylebl">

            <p>Bon de livraison N°<?= @$nbr ?> <br> du <?= $datebl ?></p>

            <!-- <p>N° <?= $trieclientid . " " . $nomclient ?></p> -->
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
    <br>
    <!-- <br>
    <hr> -->
    <!-- <h2>Date commande Le < ?= $date1erecommande ?></h2>     -->
    <a id="bouton" href="./trieclient.php" class="btn btn-primary btn-block">Retourner ou Annuler</a>
    <a id="bouton" href="validerbl.php?idclient=<?= $trieclientid ?>" class="btn btn-primary btn-block">Valider le Bon de livraison</a>
    <a id="bouton" href="testheader.php" class="btn btn-primary btn-block">Telecharger le pdf du bon de livraison</a>
    <a id="bouton" href="#" class="btn btn-primary btn-block" OnClick="javascript:window.print()">Imprimer le Bon de livraison</a>
    <!-- <a id="bouton" href="sms/envoismsok.php?idclient=<?= $trieclientid ?>" class="btn btn-primary btn-block">Envoyer Sms de livraison</a> -->

    <a id="bouton" href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir Envoyer Sms ?')) document.location.href='sms/envoismsok.php?idclient=<?= $trieclientid ?>'" class="btn btn-primary btn-block">Envoyer Sms de livraison</a>
    <!-- <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='page.php'">Supprimer</a> -->

    <!-- <a id="bouton" href="./seDeconnecter.php" class="btn btn-danger btn-block">Deconnecter</a> -->
    <!-- <a href="../imprimes/index.php" class="btn btn-primary btn-block">Liste imprimés</a>
                <a href="../clients/indexclient.php" class="btn btn-primary btn-block">Liste clients</a> -->

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
                foreach ($resultcommande as $commande) {
                ?>
                    <tr>
                        <td class="table-pri mary"><?= $commande['id'] ?></td>

                        <!-- <td class="table-success">< ?= $commande['dates'] ?></td> -->
                        <!-- <td class="table-pr imary">< ?= $commande['idclient'] ?></td> -->
                        <!-- <td class="table-in fo"><?= $commande['nomclient'] ?></td> -->
                        <td class="table-pr imary"><?= $commande['idimprime'] ?></td>
                        <td class="table-war ning"><?= $commande['imprime'] ?></td>
                        <td class="table-pri mary"><?= $commande['quantite'] ?></td>
                        <td class="table-pri mary"><?= number_format($commande['prix'], 2, ".", ".") ?></td>
                        <td class="table-pri mary"><?= $commande['prepress'] ?></td>
                        <td class="table-dan ger"><?= number_format($commande['total'], 2, ".", ".") ?></td>
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
                    //$nombrecommandes+=1;
                }
                ?>
                <!-- <td class="table-primary">Total en DZ</td> -->
                <!-- <td class="table-d anger"></td> -->
                <!-- <td class="table-p rimary"></td> -->
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <td class="table-p rimary"></td>
                <br>
                <td class="table-p rimary">Total Gle TTC</td>
                <td class="table-success"><span class="gras"><?= number_format($total1, 2, ",", ".") ?> </span></td>
                <!-- <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td>
                        <td class="table-primary"></td> -->
            </tbody>

        </table>
    </div>
    <?php $lettre = new ChiffreEnLettre();

    $chiffre = intval($total1);
    $lettre->Conversion($chiffre);
    $chaine = $lettre->enLettre . " DA";
    //$chaine = mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
    ?>
    <br>
    <p>Arrété le présent Bon de livraison à la somme de <span class="gras"> <?= " " . $chaine ?> </span></p>
    <br> <br>
    <div class="basdepage">


        <p>Accusé de reception client</p>
        <p>Cachet et signature</p>
    </div>
    <!-- <img  class="cachet" src="./images/cachet2.png" alt="logo global2pub" width="230" height="auto"> -->

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