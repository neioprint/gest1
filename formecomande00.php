<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};
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
if(!empty($_SESSION['erreur'])){
    echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
            '. $_SESSION['erreur'].'
        </div>';
    $_SESSION['erreur'] = "";
 }

if(!empty($_SESSION['message'])){
    echo '<div class="alert alert-success .alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
            '. $_SESSION['message'].'
        </div>';
    $_SESSION['message'] = "";
}
ini_set("display_errors",1);
date_default_timezone_set("Africa/Algiers");
error_reporting(-1);
// echo '<pre>'; 
//  print_r($_POST);
//  print_r($_SESSION['message']);
//  print_r($_SESSION['erreur']);
// echo '</pre>';
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$ fonction chargement de fichier d'impression $$$$$$$$$$


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$datecom=date('Y-m-d');
//.' à '. date("H:i");
require_once('./base4.php');
if (isset($_POST["submit"])) {
// echo '<pre>';
// print_r($_POST);
// echo '</pre>'; 
// die();

    if  (
         isset($_POST["dates"]) && !empty($_POST["dates"]) 
        //    &&  isset($_POST["client"]) && !empty($_POST["client"]) &&
        
        //    isset($_POST["quantite"]) && !empty($_POST["quantite"]) &&
        //    isset($_POST["prix"]) && !empty($_POST["prix"]) && 
        //  isset($_POST["details"]) && !empty($_POST["details"]) &&
        //   isset($_POST["commandes"]) && !empty($_POST["commandes"]) && 
        //   isset($_POST["remarque"]) && !empty($_POST["remarque"]) && 
        //   isset($_POST["etat"]) && !empty($_POST["etat"]) &&
        //   isset($_POST["paiement"]) && !empty($_POST["paiement"]) &&
        //   isset($_POST["prepress"]) 
        
        ) 

    {


        $clientp=$_POST["client"];// nom de variable posté p à la fin
        $quantitep=$_POST["quantite"];// nom de variable posté
        $prixp=$_POST["prix"];// nom de variable posté
        $detailsp=$_POST["details"];// nom de variable posté p à la fin
        $commandesp=$_POST["commandes"];// nom de variable posté p à la fin
        $datep=$_POST["dates"];

        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // On inclut la connexion à la base commandes clients
        require_once('connectcommande.php');

        // On nettoie les données envoyées
        //$dates = $datep;
        $dates=date('Y-m-d');
        //.' à '. date("H:i");
        $idclient=explode("/",$clientp);
        $nomclient=explode("/",$clientp);
        //$clientp;
        $idimprime= explode("/",$commandesp);
        $imprime= explode("/",$commandesp);
        //$commandesp;
        $quantite= $quantitep;
        $prix=$prixp; 
        $prepress=$detailsp; 
        $total= $quantite*$prix+$prepress;
        $remarque= $_POST["remarque"];
        $etat= $_POST["etat"];
        $paiement= $_POST["paiement"];
        // $images="jkjkjjkjkj.jpg";

        $sql = 'INSERT INTO `commande` 
        (`dates`, `idclient`, `nomclient`, `idimprime`, `imprime`, `quantite`, `prix`,
         `prepress`, `total`, `remarque`, `etat`, `paiement`) 
        VALUES (:dates,:idclient,:nomclient,:idimprime,:imprime,:quantite,
        :prix,:prepress,:total,:remarque,:etat,:paiement);';
        $query = $db->prepare($sql);
       
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':idclient', $idclient[0], PDO::PARAM_INT);
        $query->bindValue(':nomclient', $nomclient[1], PDO::PARAM_STR);
        $query->bindValue(':idimprime', $idimprime[0], PDO::PARAM_INT);
        $query->bindValue(':imprime', $imprime[1], PDO::PARAM_STR);
        $query->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':prepress', $prepress, PDO::PARAM_INT);
        $query->bindValue(':total', $total, PDO::PARAM_INT);
        $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
        $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);
        // $query->bindValue(':paiement', $images, PDO::PARAM_STR);
        $query->execute();
  //      print_r($query);
        $_SESSION['message'] .= "Commande ajouté avec succée"."<br>";
        // unset($_POST["dates"],$_POST["idcllient"],$_POST["nomclient"],
        // $_POST["idimprime"],$_POST["imprime"],$_POST["quantite"],$_POST["prix"]
      
        // );
       header('Location: ./indexcommande.php?page=1');
        die();
// $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$ appel de fct charger fichier$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// if (isset($_POST["monfichier"]))  {
//  echo '<pre>';
// print_r($_FILES["monfichier"]);
// echo '</pre>'; 
// die();
require('./functions/chargerfichier.php');                                 
// chargerfichier("formulaire");
//$idclient[0].$nomclient[1].$idimprime[0].$imprime[1].date('d-m-Y H').".".$extension[1];
//if (isset($_POST["monfichier"]) && !empty($_POST["monfichier"])) 
chargerfichier("formulaire",$idclient[0],$idimprime[0],$imprime[1]);
                                    // echo "bonjour";
                                    // }
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
require_once('closecommande.php');
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
        $_SESSION['erreur'] .= "Le formulaire est incomplet"."<br>";
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
<title>Gestion Commandes ver25.0</title>
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
   <script
  src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
  integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
  crossorigin="anonymous"></script>


  
  
   
   
</head>


<body>
<?php require_once('./navbarok.php') ?>
<div id="container">
<div class="entete">
    <img  src="./images/logo.avif" alt="logo global2pub" width="150" height="auto">
  
    <h1 class="entete">Gestion  <br> Commande</h1>
    </div>
    <div class="avatar">
    <img   src="./images/banquier.png" alt="" width="250" height="auto">
</div>
   
<?php
require_once('./menu.php')
 ?> 
     <div class="center">
     <h2 class="entete">Formulaire de commandes</h2>
         <!-- <h2 class="center">Ajouter une commande</h2>  -->

        <form id="commande-form" name="fo"  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="dates">Date de Votre Commande</label> 
                <input type="text" class="form-control" id="dates" name="dates" readonly
                value="<?php echo $datecom;?>" >
            </div>
<!-- ******************************************  -->
                <div class="form-group">
               
                <label for="client">Sélectionner le client  dans la liste</label>
                <br>
               
                <select  class="form-control" id="client" name="client" required onchange="selection()">
                <script>
                function  selection() {
                // Creating a cookie after the document is ready
                $(document).ready(function () {
                    
                    createCookie("idclient", document.getElementById("client").value, "1");
                });
                    
                // Function to create the cookie
                function createCookie(name, value, days) {
                    var expires;
                    // var var1=document.getElementById("client").value;
                        
                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toGMTString();
                    }
                    else {
                        expires = "";
                    }
                        
                    document.cookie = escape(name) + "=" + 
                        escape(value) + expires + "; path=/";
                }
                // console.log(var1);
                //window.location.href='formcommande.php';
             }
                
                </script>



                <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->
                <!-- <script>
                function  selection() {

                    
                    var var1=document.getElementById("client").value;
                    console.log(var1);
                    return var1;
                }
                </script> -->
                
                
                <!-- <option value=" " selected>veuillez selectionner</option> -->
                 <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                 <option value="0">Selectionner Client</option>
               <?php
            //    @$var =  "<script>document.write(var1);</script>" ;
                // On boucle sur la variable result

                // echo $var;
               
             
                foreach($resultclient as $client){

                // var_dump($client);
                ?>                
                <option value="<?php echo $client['id'] ?>" >
                <?php echo($client['id'].'/'.$client['client']) ?></option>
                <?php
                        }
                        $idclientSel=$_COOKIE["idclient"];
                        // $idclientSel=65;
                        //var_dump($idclientSel);
                ?>
                </select>
              
                <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->
           
           </div>
<!-- ******************************************  -->




            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" min="0" placeholder="Entrez la Qté" class="form-control" id="quantite"
                    name="quantite" required>

            </div>

            <div class="form-group">
                <label for="prix">Prix Unitaire</label>
                <input type="number" min="0" step="0.01" placeholder="Prix en DZ" class="form-control" id="prix"
                    name="prix" placeholder="exemple Prix 1.20" required>

            </div>



            <div class="form-group">
                <label for="details">Coût Pre-press</label>
                <input type="number" min="0" step="0.01" class="form-control" id="details" name="details"
                    placeholder="Le cout des maquettes films forme decoupe et plaques à la charge du client etc..." required>
            </div>


            
<!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$ Debut affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->

            <div class="form-group">
               
                <label for="commandes">Sélectionner l'imprimé <br> dans la liste</label>
                <br>
               
                <select class="form-control" id="commandes" name="commandes"    required onstorage="selection()">
                <!-- size="< ?= sizeof($result)>5 ? 3 : sizeof($result)?>"  -->
             
                 <!-- <option disabled value="">Sélectionnez votre imprimé</option>  -->
                <?php
                
                // On boucle sur la variable result
              
                foreach($result as $imprime){ 

                    if ($idclientSel==$imprime['idclient']) {
                ?>
                
                <option value="<?php echo $imprime['id'].'/'.$imprime['imprime'] ?>">
                <?php 
                 if ($idclientSel==$imprime['idclient']) 
                 echo $imprime['idclient'].'/'.$imprime['imprime'] ?>
                </option>
                <?php
                    }
                        }
                ?>

                </select>
                <div>

<!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$ Fin affiche l'imprimé selon client $$$$$$$$$$$$$$$$$$$$$$$$$ -->


                <div class="form-group">
                <label for="remarque">Remarques</label> <br>
                <input type="text"  class="form-control" id="remarque" maxlength="60"name="remarque" placeholder="saisissez vos remarques" required>
                </div>

                <div class="form-group">
                <label for="monfichier">Si vous avez un fichier d'impression PDF,jpg,png,cdr </label> <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input type="file" name="monfichier" value="monfichier"/>
                </div>
                <div class="radio form-group">

                <fieldset>
                <!-- <div class="spinner-border text-success">
                </div> -->
                <legend>Etats Commandes:</legend>
               
                
                
                <input type="radio"  id="etat" name="etat" value="0/En attente"  required checked>
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

                 <input type="radio"   id="etat" name="etat"  value="6/Proforma">
                <label for="etat">Proforma</label>
                
                </fieldset>
                </div>

                <div class="radio">
                <fieldset>
                <legend>Paiement</legend>
                <input type="radio"  id="paiement" name="paiement" value="0/Non payée"  required>
                <label for="paiement">Non payée</label>

                <input type="radio"  id="paiement" name="paiement" value="1/Payé"  required>
                <label for="paiement">Payée</label>

                <input type="radio"   id="paiement" name="paiement"  value="2/Avance" required>
                <label for="paiement">Avance</label>

                <input type="radio"   id="paiement" name="paiement"  value="3/A terme" required>
                <label for="paiement">A terme</label>
                </fieldset>
                </div> 
                <!-- <input type="button" class="btn btn-success" value="Imprimer" onClick="window.print()">        -->
              <button type="submit" class="btn btn-success" name="submit" id="submit" value="Envoyer Commande" class="btn btn-success">Ajouter COMMANDE</button>
        </form>
        <!-- <a class="btn btn-primary btn" href="../upload2.php">Envoyer votre fichier d'impression</a>            -->
       </div>
    </div>

    </div>
</body>

</html>