<?php
require_once "const.php";

// $refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
//                             $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// //echo $refreshButtonPressed;
// if ($refreshButtonPressed==1) die();
//$cookie_name="idclient";
//setcookie($cookie_name, 0, time() + (86400 * 30), "/"); // 86400 = 1 day
// explode("/",$clientp)
$idclientSel = isset($_GET['idclient']) && !empty($_GET['idclient']) ? $_GET['idclient'] : 0;
$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : 0;
//$idclientSel=0;
//print_r($idclientSel);
// die();
require_once('role.php');


// echo '<pre>'; 
//  print_r($_POST);
//  print_r($_SESSION['message']);
//  print_r($_SESSION['erreur']);
// echo '</pre>';
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$ fonction chargement de fichier d'impression $$$$$$$$$$


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$datecom = date('Y-m-d');
//.' à '. date("H:i");
require_once('connectcommande.php');
$sql = "select * from commande  where idclient=$idclientSel";




$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
require_once('closecommande.php');
// echo "<pre>";
// print_r($resultcommande);
// echo "</pre>";
// die();
require_once('./base4.php');
//   echo '<pre>';
//      print_r($resulcommande);
//      echo '</pre>'; 
//      die();
if (isset($_POST["submit"])) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>'; 
    // die();

    if (
        isset($_POST["dates"]) && !empty($_POST["dates"])
        &&  isset($_POST["client"]) && !empty($_POST["client"])
        && isset($_POST["commande"]) && !empty($_POST["commande"])

        //    isset($_POST["quantite"]) && !empty($_POST["quantite"]) &&
        //    isset($_POST["prix"]) && !empty($_POST["prix"]) && 
        //  isset($_POST["details"]) && !empty($_POST["details"]) &&
        //   isset($_POST["commandes"]) && !empty($_POST["commandes"]) && 
        //   isset($_POST["remarque"]) && !empty($_POST["remarque"]) && 
        //   isset($_POST["etat"]) && !empty($_POST["etat"]) &&
        //   isset($_POST["paiement"]) && !empty($_POST["paiement"]) &&
        //   isset($_POST["prepress"]) 

    ) {
// echo '<pre>';
//     print_r($_POST);
//     echo '</pre>'; 
//     die();
        require('./functions/chargerfichier.php');
        // chargerfichier("formulaire");
        //$idclient[0].$nomclient[1].$idimprime[0].$imprime[1].date('d-m-Y H').".".$extension[1];
        //if (isset($_POST["monfichier"]) && !empty($_POST["monfichier"]))
        //chargerfichier("formulaire",$idclient[0],$idimprime[0],$imprime[1]);


        $clientp = $_POST["client"]; // nom de variable posté p à la fin
        $quantitep = $_POST["quantite"]; // nom de variable posté
        $prixp = $_POST["prix"]; // nom de variable posté
        $detailsp = $_POST["details"]; // nom de variable posté p à la fin
        $commandep = $_POST["commande"]; // nom de variable posté p à la fin
        $images=$_POST["image"];
        //print_r($commandep);die();
        $datep = $_POST["dates"];
        $tag = 0;
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // On inclut la connexion à la base commandes clients
        require_once('connectcommande.php');

        // On nettoie les données envoyées
        $dates = $datep;
        //$dates=date('Y-m-d');
        //.' à '. date("H:i");
        //$idclient=explode("/",$clientp);
        $idclient = $clientp;
        //$nomclient=explode("/",$clientp);
        $nomclient = $_SESSION['nomclient'];
        //echo $nomclient;
        // die();

        $idimprime =$_POST["idimprime"];
        $imprime =$_POST["imprime"];
        //explode("/", $commandep);
        //$imprime = "uiouoiuoi";
        //explode("/", $commandep);
        //$commandesp;
        $quantite = $quantitep;
        $prix = $prixp;
        $prepress = $detailsp;
        $total = $quantite * $prix + $prepress;


    //      echo '<pre>';
    //  print_r($_POST);
    //  echo '</pre>'; 
//     die();
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        require('./connectclient.php');

        //$sql = 'SELECT * FROM `client` order by client asc';
        $sql = 'SELECT * FROM `client` WHERE `id` = :idclient;';
        // On prépare la requête
        $query = $db->prepare($sql);
        $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
        // On exécute la requête
        $query->execute();

        // On stocke le résultat dans un tableau associatif
        $resultclient = $query->fetch(PDO::FETCH_ASSOC);


        require_once('./closeclient.php');
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


        // ici il faut ajouter le solde dans la fiche client
        $soldeclient = $resultclient['solde'];

        // print_r($soldeclient);
        // echo "<pre>";
        // print_r($resultclient);
        // echo "</pre>";
        // die();



        $remarque = $_POST["remarque"];
        $etat = $_POST["etat"] . " Le " . $dates . " par " . $_SESSION['login'];
        //print_r($_POST["etat"]);
        $etatseq = "";
        $paiement = $_POST["paiement"];


        // // if ($images=="") {
        //                 chargerfichier("image", $idclient, $idimprime, $imprime);
        //                 $images = isset($_SESSION["image"]) ? $_SESSION["image"] : "";
        //                 // }

        chargerfichier("bondecommande", $idclient, $idimprime, $imprime);
        $bondecommande = isset($_SESSION["bondecommande"]) ? $_SESSION["bondecommande"] : "";
        // die();
        if ($_POST["etat"] == "6/Proforma") $solde = $total;
        else $solde = $total + $soldeclient;

        //$typ=@$result['typ'];
        $chaine=@$resultcommande['etapes'];
        $chainedecoupe=explode(",",$chaine);
        // $typdecoupe=explode(",",$typ);
        $compt=count($chainedecoupe);
        //$compt0=count($typdecoupe);
        //$tabsuivi=[];
        $tabsuivi=[[]];
        //$chainedecoupe;
        for ($i=0; $i <$compt ; $i++) { 
             $tabsuivi[$i][0]=0;
             $tabsuivi[$i][1]="";
             $tabsuivi[$i][2]="";

        }       







        //$etapesvalidee = "";
        $etapesvalidee =serialize($tabsuivi);
        $_SESSION["image"] = "";
        $_SESSION["bondecommande"] = "";
        $sql = 'INSERT INTO `commande` 
        (`dates`, `idclient`, `nomclient`, `idimprime`, `imprime`, `quantite`, `prix`,
         `prepress`, `total`, `remarque`, `etat`,etatseq, `paiement`,`images`,`bc`,`tag`,`solde`,`etapesvalidee`) 
        VALUES (:dates,:idclient,:nomclient,:idimprime,:imprime,:quantite,
        :prix,:prepress,:total,:remarque,:etat,:etatseq,:paiement,:images,:bc,:tag,:solde,:etapesvalidee);';
        $query = $db->prepare($sql);

        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
        $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);
        $query->bindValue(':solde', $solde, PDO::PARAM_STR);
        $query->bindValue(':idimprime', $idimprime, PDO::PARAM_INT);
        $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
        $query->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':prepress', $prepress, PDO::PARAM_INT);
        $query->bindValue(':total', $total, PDO::PARAM_STR);
        $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
        $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        $query->bindValue(':etatseq', $etatseq, PDO::PARAM_STR);

        $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);
        $query->bindValue(':images', $images, PDO::PARAM_STR);
        $query->bindValue(':bc', $bondecommande, PDO::PARAM_STR);
        $query->bindValue(':tag', $tag, PDO::PARAM_INT);
        $query->bindValue(':etapesvalidee', $etapesvalidee, PDO::PARAM_STR);
        // $query->bindValue(':paiement', $images, PDO::PARAM_STR);
        $query->execute();
        //      print_r($query);
        $_SESSION['message'] .= "Commande ajouté avec succée" . "<br>";
        // unset($_POST["dates"],$_POST["idcllient"],$_POST["nomclient"],
        // $_POST["idimprime"],$_POST["imprime"],$_POST["quantite"],$_POST["prix"]

        // );

        // $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // if (isset($_POST["monfichier"]))  {
        //  echo '<pre>';
        // print_r($_FILES["monfichier"]);
        // echo '</pre>'; 
        // die();

        // echo "bonjour";
        // }
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        require_once('closecommande.php');

        // on ouvre la fiche client pour modifier le solde client
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // if ($_POST["etat"] != "6/Proforma") {
        //     require('connectclient.php');


        //     $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

        //     $query = $db->prepare($sql);

        //     $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

        //     $query->bindValue(':solde', $solde, PDO::PARAM_STR);




        //     $query->execute();

        //     $_SESSION['message'] .= "Solde  client modifié avec succée";
        //     require('closeclient.php');
        // }
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

        header("Location: ./indexcommande.php?page=1");
        die();
        //    header('Location: formcommande.php');
        // if ($query) {
        //     echo "<script>
        //     alert('Commande Enregistrée avec succée');
        //     window.location.href='gestion4.php';
        //     </script>";
        // } else {
        //     echo "<script>
        //     alert('Erreur commande non enregistrée');
        //     window.location.href='gestion4.php';
        //     </script>";
        // }
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
    } else {
        // echo "<script>
        // alert('Erreur veuillez remplir tous les champs');
        // window.location.href='gestion4.php';
        // </script>";
        $_SESSION['erreur'] .= "Le formulaire est incomplet" . "<br>";
        if (!empty($_SESSION['erreur'])) {
            echo '<div class="alert alert-danger .alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                    ' . $_SESSION['erreur'] . '
                </div>';
            $_SESSION['erreur'] = "";
        }
    }
}



?>
<!DOCTYPE html>
<html lang="fr">
<!-- le 1 juillet 2022 à tlemcen 
 dans cette version index4.js et gestion4.php et base4.php correction bug affichage des commandes par dates
 qui ne stocke pas dans le localstorage du fait d'un bug probazblement sur la festion dates anterieures
 actuctuelle et future de l'enregistrement des commandes -->

<head>
    <title>Gest'imprim</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./images/logo.avif" type="image" />

    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="./css/style.css">


    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jquery script-->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
</head>


<body>
    <?php require_once('./navbarok.php') ?>
    <div class="container">
        <!-- <div class="entete">
            <img src="./images/logo.avif" alt="logo global2pub" width="150" height="auto">

            <h1 class="entete">Gestion <br> Commande</h1>
        </div> -->
        <!-- <div class="avatar">
    <img   src="./images/banquier.png" alt="" width="250" height="auto">
    </div> -->
       
        <?php

        // require_once('./menu.php')
        ?>
        <div class="center">
            <h2 class="entete">Formulaire de Rappel commandes</h2>
            <!-- <h2 class="entete center">Ajouter une commande</h2>  -->
            <a href="./formcommande.php?idclient=<?=$idclientSel?>" class="btn btn-primary btn-block">Revenir au Formulaire de Commande</a>
            <form id="commande-form" name="fo" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="dates">Date de Votre Commande</label>
                    <?php $datevalue = date('Y-m-d') ?>
                    <!-- <input type="date" id="dates" value=< ?= $datevalue?> name="dates" class="form-control"> -->
                    <!-- <input type="text" placeholder="ftererere" value=" < ?php echo date('D-Y-m-d')?>"> -->

                    <input type="date" class="form-control" value=<?= $datevalue ?> id="dates" name="dates">
                </div>
                <!-- ******************************************  -->
                <div class="form-group">

                    <label for="client">Sélectionner le client dans la liste</label>
                    <br>

                    <select class="form-control" id="client" name="client" required onchange="selection()">
                        <option value="">Selectionner Client</option>




                        <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->
            

                        <?php
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
                        //$idclientSel=$_COOKIE["idclient"];
                        //header('Location formcommande.php?idclient=<?php echo $idclientSel'); 

                        // $idclientSel=65;
                        //var_dump($idclientSel);
                        ?>
                    </select>

                    <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                </div>
                <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche commande selon client à rappeler $$$$$$$$$$$$$$$$$$$$$$$$$ -->

                     <!-- <input type="hidden" name="page" value="1" /> -->

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <label for="commande">Commande(s) à Rappeller</label>

                        <!-- <input type="hidden" name="page" value="1" /> -->
                        <select class="form-control" id="commande" name="commande"   required onchange="commandes()">
                        <option value="">Selectionner Commande</option>
                            <?php

                            $i = 0;
                            foreach ($resultcommande as $comm) {
                                ?>
                               
                                                                                  
                            
                                    <option value="<?= $comm['id']?>" <?php if ($idcommande == $comm['id']) {
                                        
                                                                             $image=$comm['images'];
                                                                            echo "selected"; 
                                                                            $qte=$comm['quantite'];
                                                                            $prix=$comm['prix'];
                                                                            $prepress=$comm['prepress'];
                                                                            $remarque=$comm['remarque'];
                                                                            $idimprime=$comm['idimprime'];
                                                                            $imprime=$comm['imprime'];
                                                                           
                                                                            }

                                                                            ?> 
                                                                            >
                                                                           
                                        <?= $comm['id']." Le ".$comm['dates']." ".$comm['imprime'].$comm['quantite'];  ?></option>
                                        
                              
                           
                                        <?php } ?>
                        </select>
                       
                           
                           
                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche commande selon client à rappeler $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- ******************************************  -->



                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" min="0" placeholder="Entrez la Qté" class="form-control" id="quantite" name="quantite" value="<?= $qte ?>" >

                        </div>
                        <input type="number" min="0"   id="idimprime" name="idimprime" value="<?= $idimprime ?>" hidden>
                        <input type="text"    id="imprime" name="imprime" value="<?= $imprime ?>" hidden>
                        <input type="text"    id="image" name="image" value="<?= $image ?>" hidden>

                        <div class="form-group">
                            <label for="prix">Prix Unitaire</label>
                            <input type="number" min="0" step="0.01" placeholder="Prix en DZ" class="form-control" id="prix" name="prix" placeholder="exemple Prix 1.20" value="<?= @$prix ?>"required>

                        </div>



                        <div class="form-group">
                            <label for="details">Coût Pre-press</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="details" name="details" placeholder="Le cout des maquettes films forme decoupe et plaques à la charge du client etc..." value="<?= @$prepress ?>" required>
                        </div>



                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->


                        <div class="form-group">

                            <label for="remarque">Remarques</label> <br>
                            <input type="text" class="form-control" id="remarque" maxlength="60" name="remarque" placeholder="saisissez vos remarques" value="<?= @$remarque ?>" required>
                        </div>
                        <br>
                        <?php if (@$image!="") {
                                            $extension=substr($comm['images'],strrpos($image, "."));
                                            if ($extension!=".pdf") {
                                                                      echo '<div class="container">';
                                                                    
                                                                    echo '<img src="'.'uploads/'.$image.'"  width="350px" height="auto" class="circle">' ;
                                                                   
                                                                      echo '</div>';
                                                                    }
                                             } 
                           
                            ?>
    <br>
                        <!-- <div class="custom-file"> -->
                        <!-- <input type="file" class="custom-file-input" id="customFile"> -->
                        <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                        <!-- </div> -->
                        <div class="form-group">
                        <!-- <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Fichier d'impression (PDF,jpg,png,cdr)</label> -->
                            <!-- <label for="monfichier">Fichier d'impression (PDF,jpg,png,cdr) </label>  -->
                    
                            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                            <input type="file" name="monfichier" value="monfichier"/> -->
                         </div>
                           
                            <label for="monfichier2">Fichier Bon de commande(PDF,jpg,png) </label> <br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                            <input type="file" name="monfichier2" value="monfichier2" />
                        </div>
<!-- <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script> -->
                        <div class="radio form-group">

                            <fieldset>
                                <!-- <div class="spinner-border text-success">
                </div> -->
                                <legend>Etats Commandes:</legend>



                                <input type="radio" id="etat" name="etat" value="0/En attente" required checked>
                                <label for="etat">En Attente</label>
                                <!-- <input type="radio"   id="etat" name="etat"  value="1/En cours"  disabled>
                <label for="etat">En cours</label>
                <input type="radio"   id="etat" name="etat"  value="2/Terminé"   disabled>
                <label for="etat">Terminé</label> <br>
                <input type="radio"   id="etat" name="etat"  value="3/Livrée"  disabled>
                <label for="etat">Livrée</label>
                <input type="radio"  id="etat" name="etat" value="4/Annulée"  disabled>
                <label for="etat">Annulée</label>
                <input type="radio"  id="etat" name="etat" value="5/Archivée"  disabled>
                <label for="etat">Archivée</label> -->

                                <input type="radio" id="etat" name="etat" value="6/Proforma">
                                <label for="etat">Proforma</label>

                            </fieldset>
                        </div>

                        <div class="radio">
                            <fieldset>
                                <legend>Paiement</legend>
                                <input type="radio" id="paiement" name="paiement" value="0/Non payée" required>
                                <label for="paiement">Non payée</label>

                                <input type="radio" id="paiement" name="paiement" value="1/Payé" required>
                                <label for="paiement">Payée</label>

                                <input type="radio" id="paiement" name="paiement" value="2/Avance" required>
                                <label for="paiement">Avance</label>

                                <input type="radio" id="paiement" name="paiement" value="3/A terme" required>
                                <label for="paiement">A terme</label>
                            </fieldset>
                        </div>
                        <!-- <input type="button" class="btn btn-success" value="Imprimer" onClick="window.print()">        -->
                        <button type="submit" class="btn btn-success" name="submit" id="submit" value="Envoyer Commande" class="btn btn-success">Ajouter COMMANDE</button>
            </form>
            <!-- <a class="btn btn-primary btn" href="../upload2.php">Envoyer votre fichier d'impression</a>            -->
            <br><br>
            <a href="./formcommande.php?idclient=<?=$idclientSel?>" class="btn btn-primary btn-block">Revenir au Formulaire de Commande</a>
        </div>
    </div>

    </div>
    <script>
        function selection() {
            //Creating a cookie after the document is ready
            $(document).ready(function() {

                createCookie("idclient", document.getElementById("client").value, "1");
                // createCookie("idcommande", document.getElementById("commande").value, "1");
            });

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;
                // var var1=document.getElementById("client").value;

                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                } else {
                    expires = "";
                }

                document.cookie = escape(name) + "=" +
                    escape(value) + expires + "; path=/";
            }

            // console.log(var1);
          
            window.location.href = "rappelcommande.php?idclient=" + document.getElementById("client").value;
            // window.location.href = "rappelcommande.php?idcommande=" + document.getElementById("commande").value+ "&idclient=" + document.getElementById("client").value;

            //$_COOKIE["idclient"];
            
        }
        function commandes() {
            //Creating a cookie after the document is ready
            $(document).ready(function() {

                createCookie("idcommande", document.getElementById("commande").value, "1");
            });

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;
                // var var1=document.getElementById("client").value;

                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                } else {
                    expires = "";
                }

                document.cookie = escape(name) + "=" +
                    escape(value) + expires + "; path=/";
            }
           
            // console.log(var1);
            window.location.href = "rappelcommande.php?idcommande=" + document.getElementById("commande").value+ "&idclient=" + document.getElementById("client").value;
            //$_COOKIE["idclient"];

        }
</script>

    <br><br>
</body>

</html>