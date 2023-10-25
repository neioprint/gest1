<?php
require_once "const.php";

//$cookie_name="idclient";
//setcookie($cookie_name, 0, time() + (86400 * 30), "/"); // 86400 = 1 day
// explode("/",$clientp)
//$idclientSel=isset($_GET['idclient'])?$_GET['idclient']:0;
$idclient = isset($_GET['idclient']) ? $_GET['idclient'] : 0;
$nomclient = isset($_GET['nomclient']) ? $_GET['nomclient'] : "";
$idimprime = isset($_GET['idimprime']) ? $_GET['idimprime'] : 0;
$imprime = isset($_GET['imprime']) ? $_GET['imprime'] : "";
$idcommande = isset($_GET['idcommande']) ? $_GET['idcommande'] : 0;
//$idclientSel=0;
// print_r($idclientSel);
// die();
require_once('role.php');

// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] .= "Veuillez vous connecter pour acceder au contenu"."<br>"; 
//     header('Location: ../login.php');
//     die;
// }

// if  (!isset($_SESSION['login'])){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// if ($_SESSION['user']['role']!='ADMIN') { 
//     $_SESSION['erreur'] = "Vous n'avez pas accée à ce contenu (impossible d'ajouter des commandes)"; 
//     header('Location: ./indexcommande.php?page=1');
//     die;
//                                         }

// echo '<pre>'; 
//  print_r($_POST);
//  print_r($_SESSION['message']);
//  print_r($_SESSION['erreur']);
// echo '</pre>';
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$ fonction chargement de fichier d'impression $$$$$$$$$$


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $datecom=date('Y-m-d');
//.' à '. date("H:i");
require_once('./base4.php');
require_once('connectcommande.php');
$sql = "select * from commande where id='$idcommande'";
if ($sql != "") {
    $query = $db->prepare($sql);
    // On exécute la requête
    $query->execute() or die(print_r($bdd->errorInfo()));
    ;

    // On stocke le résultat dans un tableau associatif
    $resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);
}
// echo '<pre>';
// print_r($resultcommande);
// echo '</pre>'; 
// die();                
if (isset($_POST["submit"])) {
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>'; 
    //  die();         

    if (
        isset($_POST["client"]) && !empty($_POST["client"])
        && isset($_POST["commandes"]) && !empty($_POST["commandes"])
        && (isset($_FILES["monfichier"]) && !empty($_FILES["monfichier"]) or
            (isset($_FILES["monfichier2"]) && !empty($_FILES["monfichier2"])))
    ) {

        require('./functions/chargerfichier.php');
        // chargerfichier("formulaire");
        //$idclient[0].$nomclient[1].$idimprime[0].$imprime[1].date('d-m-Y H').".".$extension[1];
        //if (isset($_POST["monfichier"]) && !empty($_POST["monfichier"]))
        //chargerfichier("formulaire",$idclient[0],$idimprime[0],$imprime[1]);


        $clientp = $_POST["client"]; // nom de variable posté p à la fin
        // $quantitep=$_POST["quantite"];// nom de variable posté
        // $prixp=$_POST["prix"];// nom de variable posté
        // $detailsp=$_POST["details"];// nom de variable posté p à la fin
        $commandesp = $_POST["commandes"]; // nom de variable posté p à la fin
        // $datep=$_POST["dates"];
        // $tag=0;
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // On inclut la connexion à la base commandes clients
        require_once('connectcommande.php');

        // On nettoie les données envoyées
        // $dates = $datep;
        //$dates=date('Y-m-d');
        //.' à '. date("H:i");


        // $idclient=explode("/",$clientp);
        // $idclient=$clientp;
        // $nomclient=explode("/",$clientp);
        // $nomclient=$_SESSION['nomclient'];

        //echo $nomclient;
        // die();

        // $idimprime= explode("/",$commandesp);
        // $imprime= explode("/",$commandesp);
        //$commandesp;
        // $quantite= $quantitep;
        // $prix=$prixp; t
        // $prepress=$detailsp; 
        // $total= $quantite*$prix+$prepress;
        // $remarque= $_POST["remarque"];
        // $etat= $_POST["etat"];
        // $etatseq="";
        // $paiement= $_POST["paiement"];
        // $images="jkjkjjkjkj.jpg";
        if ($_FILES["monfichier"]["error"] == 0) {
            chargerfichier("image", $idclient, $idimprime, $imprime);
            $images = isset($_SESSION["image"]) ? $_SESSION["image"] : "";
            $sql = "UPDATE `commande` SET `images`='$images' WHERE  `id`='$idcommande';";
            $query = $db->prepare($sql);
            $query->execute();
            //$_SESSION['message'] .= "Image  ajouté avec succée"."<br>";
        }
        if ($_FILES["monfichier2"]["error"] == 0) {
            chargerfichier("bondecommande", $idclient, $idimprime, $imprime);
            $bondecommande = isset($_SESSION["bondecommande"]) ? $_SESSION["bondecommande"] : "";
            $sql = "UPDATE `commande` SET `bc`='$bondecommande' WHERE  `id`='$idcommande';";
            $query = $db->prepare($sql);
            $query->execute();
            // $_SESSION['message'] .= "Bc  ajouté avec succée"."<br>";
        }

        // die();
        // $solde=$total;


        //$_SESSION["image"]="";
        //$_SESSION["bondecommande"]="";
        //$sql = "UPDATE `commande` SET `images`='$images',`bc`='$bondecommande' WHERE  `id`='$idcommande';";


        // $sql = 'INSERT INTO `commande` 
        // (`dates`, `idclient`, `nomclient`, `idimprime`, `imprime`, `quantite`, `prix`,
        //  `prepress`, `total`, `remarque`, `etat`,etatseq, `paiement`,`images`,`bc`,`tag`,`solde`) 
        // VALUES (:dates,:idclient,:nomclient,:idimprime,:imprime,:quantite,
        // :prix,:prepress,:total,:remarque,:etat,:etatseq,:paiement,:images,:bc,:tag,:solde);';
        //$query = $db->prepare($sql);

        // $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        // $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
        // $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);
        // $query->bindValue(':solde', $solde, PDO::PARAM_STR);
        // $query->bindValue(':idimprime', $idimprime[0], PDO::PARAM_INT);
        // $query->bindValue(':imprime', $imprime[1], PDO::PARAM_STR);
        // $query->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        // $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        // $query->bindValue(':prepress', $prepress, PDO::PARAM_INT);
        // $query->bindValue(':total', $total, PDO::PARAM_INT);
        // $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
        // $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        // $query->bindValue(':etatseq', $etatseq, PDO::PARAM_STR);

        // $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);
        // $query->bindValue(':images', $images, PDO::PARAM_STR);
        // $query->bindValue(':bc', $bondecommande, PDO::PARAM_STR);
        // $query->bindValue(':tag', $tag, PDO::PARAM_INT);

        // $query->bindValue(':paiement', $images, PDO::PARAM_STR);
        //     $query->execute();
        //      print_r($query);

        //      $_SESSION['message'] .= "Fichiers  ajouté avec succée"."<br>";


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
        //die();
        header('Location: ./indexcommande.php?page=1&recherche=&niveau=ins');
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
        <title>Gestion Commandes ver gtv26.0</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./images/logo.avif" type="image" />
        <link rel="stylesheet" href="./css/style41.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jquery script-->
        <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
            integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php require_once('./navbarok.php') ?>
        <!-- <div class="container">
        <div class="entete">
            <img src="./images/logo2.png" alt="logo global2pub" width="150" height="auto">

            <h1 class="entete">Gestion <br> Commande</h1>
        </div> -->
        <!-- <div class="avatar">
    <img   src="./images/banquier.png" alt="" width="250" height="auto">
    </div> -->
        <br>
        <br>
        <br>
        <?php

        // require_once('./menu.php')
        ?>
        <div class="center">
            <h2 class="entete">Telecharger Fichiers Commande</h2>
            <!-- <h2 class="entete center">Ajouter une commande</h2>  -->
            <!-- onsubmit="document.getElementById('msg').style.display='block'; return true;"  -->
            <form id="commande-form" name="fo" method="post" enctype="multipart/form-data">
                <!-- <div class="form-group">
                <label for="dates">Date de Votre Commande</label> 
                < ?php $datevalue=date('Y-m-d')?>
            

                <input type="date"  class="form-control" value=< ?= $datevalue?> id="dates" name="dates">
            </div> -->
                <!-- ******************************************  -->
                <div class="form-group">
                    <label for="client">Client</label>
                    <br>
                    <select class="form-control" id="client" name="client" required>
                        <option value="<?= $idclient . '-' . $nomclient ?>">
                            <?= $idclient . '-' . $nomclient ?>
                        </option>
                        <!-- < ?php
         
               
             
                foreach($resultclient as $client){

             
                ?> 
               
                <option value="< ?php echo $client['id'] ?>"
                < ?php if ($idclientSel==$client['id']) { 
                                                        echo "selected";
                                                        $_SESSION['nomclient']=$client['client'];
                                                       
                                                        }
                     ?> >
                < ?php echo($client['id'].'/'.$client['client']) ?></option>
                < ?php
                        }


                        
         
                ? > -->
                    </select>
                    <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->
                </div>
                <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                <div class="form-group">
                    <label for="commandes">Commande <br></label>
                    <br>
                    <select class="form-control" id="commandes" name="commandes" required>
                        <!-- size="< ?= sizeof($result)>5 ? 3 : sizeof($result)?>"  -->
                        <option value="<?= $idclient . '-' . $imprime ?>">
                            <?= $idclient . '-' . $imprime ?>
                        </option>
                        <!-- if ($nb==0) {
                           echo "<option value='' >pas de commandes veuillez SELECTIONNER UN AUTRE client</option>";
                           
                           } -->
                    </select>
                    <div>
                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- ******************************************  -->
                        <!-- <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" min="0" placeholder="Entrez la Qté" class="form-control" id="quantite"
                    name="quantite" required>

            </div> -->
                        <!-- <div class="form-group">
                <label for="prix">Prix Unitaire</label>
                <input type="number" min="0" step="0.01" placeholder="Prix en DZ" class="form-control" id="prix"
                    name="prix" placeholder="exemple Prix 1.20" required>

            </div> -->
                        <!-- <div class="form-group">
                <label for="details">Coût Pre-press</label>
                <input type="number" min="0" step="0.01" class="form-control" id="details" name="details"
                    placeholder="Le cout des maquettes films forme decoupe et plaques à la charge du client etc..." required>
            </div> -->
                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- <div class="form-group">

                <label for="remarque">Remarques</label> <br>
                <input type="text"  class="form-control" id="remarque" maxlength="60"name="remarque" placeholder="saisissez vos remarques" required>
                </div> -->
                        <br>
                        <div class="form-group">
                            <label for="monfichier">Fichier d'impression (PDF,jpg,png,cdr) <br>
                                <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
                                <i class="fa-solid fa-download fa-bounce"></i>
                                <input type="file" name="monfichier" value="monfichier" />
                                <!-- <button  class="btn btn-success"  value="Envoyer Commande" class="btn btn-success">EFFACER Fichier</button> -->
                                <!-- <a class="btn btn-danger" href="">Effacer fichier image</a> -->
                                <br>
                                <label for="monfichier2">Fichier Bon de commande(PDF,jpg,png) </label> <br>
                                <input type="hidden" name="MAX_FILE_SIZE" value="8000000" /><i
                                    class="fa-solid fa-download fa-bounce"></i>
                                <input type="file" name="monfichier2" value="monfichier2" />
                                <!-- <a class="btn btn-danger" href="">Effacer fichier bon de commande</a> -->
                        </div>
                        <div class="radio form-group">
                            <!-- <fieldset> -->
                            <!-- <div class="spinner-border text-success">
                </div> -->
                            <!-- <legend>Etats Commandes:</legend> -->
                            <!-- <input type="radio"  id="etat" name="etat" value="0/En attente"  required checked>
                <label for="etat">En Attente</label> -->
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
                            <!-- <input type="radio"   id="etat" name="etat"  value="6/Proforma">
                <label for="etat">Proforma</label> -->
                            <!-- </fieldset>
                </div>

                <div class="radio">
                <fieldset>
                <legend>Paiement</legend>
                <input type="radio"  id="paiement" name="paiement" value="0/Non payée"   required>
                <label for="paiement">Non payée</label>

                <input type="radio"  id="paiement" name="paiement" value="1/Payé"  required>
                <label for="paiement">Payée</label>

                <input type="radio"   id="paiement" name="paiement"  value="2/Avance" required>
                <label for="paiement">Avance</label>

                <input type="radio"   id="paiement" name="paiement"  value="3/A terme" required>
                <label for="paiement">A terme</label>
                </fieldset>
                </div>  -->
                            <!-- <input type="button" class="btn btn-success" value="Imprimer" onClick="window.print()">        -->
                            <button type="submit" class="btn btn-success" name="submit" id="submit"
                                value="Envoyer Commande" class="btn btn-success">Ajouter Fichier Commande</button>
            </form>
            <!-- <div id="msg" style="display:none">ceci est un message</div> -->
            <!-- <a class="btn btn-primary btn" href="../upload2.php">Envoyer votre fichier d'impression</a>            -->
        </div>
        </div>
        </div>
    </body>

</html>