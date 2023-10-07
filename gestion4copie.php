<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};
if  ($_SESSION['login']!="login"){
    $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
    header('Location: ../login.php');
    die;
}


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
// Array
// (
//     [dates] => 09-07-2022 à 17:16
//     [client] => 61/ewax
//     [quantite] => 1
//     [prix] => 1
//     [details] => 1
//     [commandes] => 30/fiche d'hotel
//     [remarque] => 1
//     [etat] => En attente
//     [paiement] => Payé
//     [submit] => Envoyer Commande
// )
//session_start();
error_reporting(-1);
// echo '<pre>'; 
//  print_r($_POST);
//  print_r($_SESSION['message']);
//  print_r($_SESSION['erreur']);
// echo '</pre>';


$datecom=date('d-m-Y').' à '. date("H:i");
require_once('../base4.php');
if (isset($_POST["submit"])) {
//  echo '<pre>';
// print_r($_POST);
// echo '</pre>'; 

    if  (
         isset($_POST["dates"]) && !empty($_POST["dates"]) 
         //&&
        //  isset($_POST["client"]) && !empty($_POST["client"]) &&
        //  isset($_POST["quantite"]) && !empty($_POST["quantite"]) &&
        //  isset($_POST["prix"]) && !empty($_POST["prix"]) && 
        // isset($_POST["details"]) && !empty($_POST["details"]) &&
        //  isset($_POST["commandes"]) && !empty($_POST["commandes"]) && 
        //  isset($_POST["remarque"]) && !empty($_POST["remarque"]) && 
        //  isset($_POST["etat"]) && !empty($_POST["etat"]) &&
        //  isset($_POST["paiement"]) && !empty($_POST["paiement"]) &&
        //  isset($_POST["prepress"]) 
        
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
        $dates=date('d-m-Y').' à '. date("H:i");
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
        $query->execute();
  //      print_r($query);
        $_SESSION['message'] = "Commande ajouté avec succée";
        // unset($_POST["dates"],$_POST["idcllient"],$_POST["nomclient"],
        // $_POST["idimprime"],$_POST["imprime"],$_POST["quantite"],$_POST["prix"]
      
        // );
    //    die;
        require_once('closecommande.php');
        header('Location: gestion4.php');
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
        $_SESSION['erreur'] = "Le formulaire est incomplet";
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

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- changement dans le head de index2.js et style2.css -->
    <link rel="icon" href="../images/logo.avif" type="image" />
    <!-- <script src="./vanilla-calendar.js"></script> -->
    <!-- <link rel="stylesheet" href="./vanilla-calendar.css"> -->
    <!-- <link rel="stylesheet" href="style4.css"> -->
    <link rel="stylesheet" href="../css/style41.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./index4.js" defer ></script> -->
      <!-- <script defer>
        function chargement(){

        alert("Veuillez selectionner une date sur le calendrier pour votre commande");
            }
      </script>    -->
    <title>Gestion Commandes ver4.0</title>
</head>

<!-- <body onload="chargement()"> -->
<body>
<div class="icon-bar">
  <a class="active" href="#"><i class="fa fa-home"></i></a>
  <a href="#"><i class="fa fa-search"></i></a>
  <a href="#"><i class="fa fa-envelope"></i></a>
  <a href="#"><i class="fa fa-globe"></i></a>
  <!-- <a href="#"><i class="fa fa-trash"></i></a> -->
 

</div>   
<?php
require_once('../menu.php')
?> 
 <!-- Add icon library -->



    <div id="nbCommandes"></div>
    <div id="commande-list">
    <!-- <h3>Selectionnez une Date  pour enregistrer <br> ou visualiser une commande</h3> -->
        
       
    
    </div>
    <i class="fa-solid fa-typewriter"></i>
   
     <div class="center">
         <!-- <h2 class="center">Ajouter une commande</h2>  -->
        <form action="" id="commande-form" name="fo"  method="post" class="was-validated">
            <div class="form-group">
                <label for="dates">Date et Heure de Commande</label> <br>
                <input type="text" class="form-control" id="dates" name="dates" readonly
                value="<?php echo $datecom;?>" >
            </div>
<!-- ******************************************  -->
                <div class="form-group">
               
                <label for="client">Sélectionner le client  dans la liste</label>
                <br>
               
                <select class="form-control" id="client" name="client" required
                size="<?= sizeof($resultclient)>6 ? 5 : sizeof($resultclient) ?>">

                 <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                <?php
                // On boucle sur la variable result
                foreach($resultclient as $client){
                ?>                
                <option value="<?= $client['id'].'/'.$client['client'] ?>">
                <?= $client['client'] ?></option>
                <?php
                        }
                ?>
                </select>
              
               
           
           </div>
<!-- ******************************************  -->



            <!-- <div class="form-group">
                <label for="nomcontact">Nom du contact </label>
                <input type="text" class="form-control" id="nomcontact" name="nomcontact" placeholder="" >
            </div>
            <div class="form-group">
                <label for="mail">E-mail Contact </label>
                <input type="email" class="form-control" id="mail" name="mail" 
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="" >
            </div>
            <div class="form-group">
                <label for="mobile">Mobile du contact </label>
                <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0]{1}[5-7]{1}[0-9]{1}[0-9]{7}"
                placeholder="" >
            </div> -->
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" min="1" placeholder="Entrez la Qté" class="form-control" id="quantite"
                    name="quantite" required>

            </div>

            <div class="form-group">
                <label for="prix">Prix Unitaire</label>
                <input type="number" min="0.01" step="0.01" placeholder="Prix unitaire en DZ" class="form-control" id="prix"
                    name="prix" required>

            </div>



            <div class="form-group">
                <label for="details">Coût Pre-press</label>
                <input type="number" min="0" step="0.01" class="form-control" id="details" name="details"
                    placeholder="Le cout des maquettes films et plaques à la charge du client etc..." required>
            </div>


            <!-- <div class="form-group">
                    <label for="total">Total Commande</label>
                    <input type="text" disabled  placeholder="Total Commande"
                    class="form-control" id="total"
                    name="total">
                   
                </div>  -->
            <!-- <br> -->
         
          
          
           
            <div class="form-group">
               
                <label for="commandes">Sélectionner l'imprimé <br> dans la liste</label>
                <br>
               
                <select class="form-control" id="commandes" name="commandes" 
                size="<?= sizeof($result)>6 ? 5 : sizeof($result)?>" 
                required>
                 <!-- <option disabled value="">Sélectionnez votre imprimé</option>  -->
                <?php
                // On boucle sur la variable result
              
                foreach($result as $imprime){
                ?>
                
                <option value="<?= $imprime['id'].'/'.$imprime['imprime'] ?>"><?= $imprime['imprime'] ?></option>
                <?php
                        }
                ?>
              
                   

                </select>
                <div>
                <div class="form-group">
                <label for="remarque">Remarques</label> <br>
                <input type="text"  class="form-control" id="remarque" name="remarque" placeholder="saisissez vos remarques" required>
                </div>
               
                <div class="radio">

                <fieldset>
                <legend>Etats Commandes</legend>
                

                <input type="radio"  id="etat" name="etat" value="En attente"  required>
                <label for="etat">En Attente</label>
                <input type="radio"   id="etat" name="etat"  value="En cours" required>
                <label for="etat">En cours</label>
                <input type="radio"   id="etat" name="etat"  value="Terminé" required>
                <label for="etat">Terminé</label> <br>
                <input type="radio"   id="etat" name="etat"  value="Livrée" required>
                <label for="etat">Livrée</label>
                <input type="radio"  id="etat" name="etat" value="Annulée"  required>
                <label for="etat">Annulée</label>
                <input type="radio"  id="etat" name="etat" value="Archivée"  required>
                <label for="etat">Archivée</label>
                

                </fieldset>
                </div>
                <div class="radio">

                <fieldset>
                <legend>Paiement</legend>
                <input type="radio"  id="paiement" name="paiement" value="Non payée"  required>
                <label for="paiement">Non payée</label>
                <input type="radio"  id="paiement" name="paiement" value="Payé"  required>
                <label for="paiement">Payée</label>
                <input type="radio"   id="paiement" name="paiement"  value="Avance" required>
                <label for="paiement">Avance</label>
                <input type="radio"   id="paiement" name="paiement"  value="A terme" required>
                <label for="paiement">A terme</label>
                


                </fieldset>
                </div>

                
                <!-- <button>Ajouter Une COMMANDE</button> -->
                <!-- <input type="submit" name="submit" id="submit" value="Envoyer Commande" class="btn btn-primary" />
              -->
              <button type="submit" name="submit" id="submit" value="Envoyer Commande" class="btn btn-success">Ajouter Une COMMANDE</button>
        </form>
       </div>
    </div>
    <!-- <button class="boutonAjouterImprime" >Ajouter un imprimé</button>
    <br>
    <button class="boutonSupprimerImprime" >Supprimer un imprimé</button>
    <br><br><br><br> -->
    
</body>

</html>