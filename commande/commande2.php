<?php
session_start();
date_default_timezone_set("Africa/Algiers");

// gestion des erreurs
error_reporting(-1);
ini_set("display_errors",1);
$d=strtotime('+12 days');
$datecomprop=date('d-m-Y', $d);
$datecom=date('d-m-Y').' à '. date("H:i");

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// debut du test
if (isset($_POST["submit"])) {

    if  (isset($_POST["nom"]) && !empty($_POST["nom"]) &&
        isset($_POST["email"]) && !empty($_POST["email"]) &&
        isset($_POST["phone"]) && !empty($_POST["phone"]) &&
        isset($_POST["message"]) && !empty($_POST["message"]) &&
        isset($_POST["quantite"]) && !empty($_POST["quantite"]) &&
        isset($_POST["commande"]) && !empty($_POST["commande"]) &&
        isset($_POST["datecom"]) && !empty($_POST["datecom"]) 
        // &&
        // isset($_POST["datecomprop"]) && !empty($_POST["datecomprop"]) 
        
        ) 

    {
//   echo 'test reussi';  
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
$username = $_POST["nom"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$message = $_POST["message"];
$quantite= $_POST["quantite"];
$commande= $_POST["commande"];
$datecom= $_POST["datecom"];
$liste="";
//$imprimer=$_POST["imprimer"];
//affichage de la liste commande 
//var_dump($commande);
$tableau_Array=$commande;
//print_r($tableau_Array);
// boucle pour parcourrir le tableau
$i=1; // le compteur de boucle pour compter et afficher les imprimés
foreach($tableau_Array as $selectValue){
		//affichage des valeurs sélectionnées
              //  echo "Imprimé N°".$i." ".$selectValue."<br>";
                $liste=$liste."Imprimé N°".$i." :".$selectValue." Quantité ".$quantite."<br>";
                $i++; // incrementer le compteur
    //affichage des valeurs sélectionnées
          
                
            } //fin foreach
            $imprimer=$i-1; // affecter la variable $i-1 au nombrer de document à envoyer par mail
        //    echo "<br>";
        //    echo $imprimer;
        //    echo "<br>";

/* $to = $email; */
//$to= "commande@global2pub.com";

//$to= "neioprint@gmail.com";
$to= "contact@global2pub.com";
//$email=$to;
$subject = $message;

$message = "Nom : {$username} <br>
            Email: {$email} <br>
            Phone: {$phone} <br>
            Date commande :{$datecom} <br>
            Date possible pour traiter la commande:{$datecomprop} <br>
            Nombre d'imprimes :{$imprimer} <br>
            liste des Imprimés  <br> 
            {$liste} 
           
          
            Message : <br> "  
            .$message."<br>";
    // affichage message suivi d'un retour à la ligne        
          //  echo ($message);
          //  echo "<br>";

// Always set content-type when sending HTML email
//  Commande: {$commande}
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: '.$to;

$mail = mail($to,$subject,$message,$headers);

if ($mail) {
 
 
echo "<script>alert('Mail Envoyé avec succée.');</script>";
//session_unset();

// destroy the session
//session_destroy();
$username = "";
$email = "";
$phone = "";
$message = "";
$quantite= "";
$commande= "";
$tableau_Array=[];
$liste="";
$message="";
//header('Location:../index.html'); 
//exit();
}else {
echo "<script>
alert('Mail Non envoyé.');
</script>";
// remove all session variables

}
}
} //else echo 'test non reussi'; 
//fin du if isset

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire de pre-Commande</title>
     <link rel="icon" href="images/logo2.png" type="image/png" />
    <link rel="stylesheet" href="styleanim.css" />
    <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> -->
  <!-- <link rel="stylesheet" href="../styles/stylenav.css">
   <link rel="stylesheet" href="../styles/style2.css"> -->
   <!-- style provisoire à déplacer plus tard -->
   <!-- <script defer data-domain="global2-pub.com" src="https://plausible.io/js/script.js"></script> -->

   <style>
       /* input[type="text"]:disabled  */
       /* input:disabled
       {
   background: blue;
  
  
} */
       .bouton {
  width: 120px;
  border-radius: 10px;
  background-color: purple;
  display: inline-block;
  text-decoration: none;
  text-align: center;
  margin: 0 auto;
  font-size: 1.2em;
  color: white;

}
/* textarea {
  resize: none;
} */
   </style>
</head>
<body>
<div class="container">
       
        <div class="form">
            <div class="contact-info">
                <!-- <img src="images/logo2.png" alt="" width="100"> -->
                
              
                <!-- <h3 class="title">A propos de nous</h3>
               

                <div class="info">
                    <div class="information">
                       
                        <img class="icon" src="../emplacement.gif"  width="40" alt="">
                        <p>52 rue affen benarmass Aoued Oran</p>
                    </div>

                    <div class="information">
                        
                        <img class="icon" src="../e-mail.gif"  width="40" alt="">
                        <p>commande@global2-pub.com</p>
                    </div>

                    <div class="information">
                      
                        <img class="icon" src="../telephone.gif"  width="40" height="auto" alt="">
                       
                        <p> 0541 03 55 48 / 0558 02 83 52 </p>
                      
                    </div>

                </div> -->

              
               
                <!-- image animée format avif -->
                <img class="icon" src="../accueil.avif"  width="40"alt="">
               
                <!-- <a class="bouton" href="../index.html">
                    HOME</a> -->
                 
 
<!-- echo "Aujourd'hui " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");
echo "<br>";
echo "Il est " . date("h:i:sa"); -->

                  
            </div>

            <div class="contact-form">
                <!--  <span class="circle one"></span>
                <span class="circle two"></span> -->

                <form action="" name="fo" method="post" autocomplete="on">
                    <h2 class="title2">Formulaire de pre-Commande</h2>
                   
                    <h3 class="title">Chaque champ doit être validé <br> il change de couleur du Rouge au Blanc une fois validé</h3>
                    <br>
                    <h3 class="title" >Mobile à appeler 0541 03 55 48 <br> pour suivre votre pre-commande</h3>

                    <div class="input-container">
                        <label for="nom">Nom Entreprise(4 caracteres minimum)</label>
                        <input type="text" name="nom" minlength="4" maxlength="20" class="input"  required/>

                        <span>Nom Entreprise(4 caracteres minimum)</span>
                    </div>

                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="input"  required
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />

                        <span>Email</span>
                    </div>

                    <div class="input-container">
                        <label for="phone">Votre Mobile (Mobilis,Ooredoo,Djezzy)</label>
                        <span>Votre Mobile (Mobilis,Ooredoo,Djezzy)</span>
                        <input type="tel" name="phone" class="input" autocomplete="on" required
                            pattern="[0]{1}[5-7]{1}[0-9]{1}[0-9]{7}" />


                    </div>
 <!-- *********************************************** -->
                   <!-- <h1>
                    <script>
                    function f(){
                    nombre=document.fo.imprimer.value;
                    alert(nombre);
                    if (nombre>3) {
                        nombre=0;
                    }
                    echo nombre;
                    

                    // document.write(nombre);
                    }
                    </script>
                    </h1> -->



                    <!-- <div class="input-container">
                     <label for="imprimer">Nombre d'imprimés à commander</label>

                    <input  type="number" name="imprimer" class="input" 
                     min="1" max="16" step="1" placeholder="1" required  onChange="f()"/>
                     
                    <span>Nombre d'imprimés à commander</span>

                    </div>  -->
    <!-- #593196 -->
                    <!-- <div class="input-container"> -->

                    <label for="commande"></label>
                    <!-- <h4 style="color:white;text-align:center">Choisissez votre imprimé</h4> -->
                    <h4 class="title">Choisissez vos imprimés <br>  
                    <!-- selectionner plusieurs à la fois -->
                    Si vous avez plusieurs imprimés soumettez les un à la fois  Merci
                    </h4>
                   
                    <select name="commande[]" id="commande" class="input" required style="background:var(--violet) " 
                    size="16" >


                     <!-- <option value="" disabled>Choisissez votre imprimé</option>  -->
                  
                    <option value="carte de visite">Carte de Visite</option>
                    <option value="Etiquette Carton">Etiquette Carton</option>
                    <option value="Etiquette autocollante">Etiquette autocollante</option>
                    <option value="Flayer A5">Flayer A5</option>
                    <option value="Depliant">Depliant</option>
                    <option value="Affiche A3">Affiche A3</option>
                    <option value="Affiche A2">Affiche A2</option>
                    <option value="Chemise Avocat">Chemise Avocat</option>
                    <option value="Chemise Notaire">Chemise Notaire</option>
                    <option value="Fiche de pointage">Fiche de Pointage</option>
                    <option value="Bon de chargement">Bon de chargement</option>
                    <option value="Bon de chargement">Bon de chargement</option>
                    <option value="Bon de livraison">Bon de livraison</option>
                    <option value="Bon d'enlevement">Bon d'enlevement</option>
                    <option value="calendrier">Calendrier</option>
                    <option value="Autre Imprimé à Detailler" >Autre Imprimé à Detailler</option>
                </select>
                <!-- </div>  -->
                <div class="input-container">
                    
                    <label for="quantite">Quantité</label>
                <input type="number" name="quantite" class="input"  min="50" step="50" 
                max="100000"  required />
                <!-- <span>Quantité 500</span> -->
                    </div>

                    <div class="input-container textarea">
                        
                        <label for="message">Details 5 caracteres au moins</label>
                       
                        <textarea name="message" class="input" required minlength="5" maxlength="232" ></textarea>
                        <span>Details Commande 5 caracteres au moins</span>
                    </div>


                    <div class="title">
                      
                <label for="datecom">Date et heure de pre-commande </label>
                
                <input type="text" name="datecom"  class="input"  readonly
                value="<?php echo $datecom;?>"> 
                
                    </div>

                    <div class="title">
                    <br>    
                <label for="datecomprop">Date à partir de laquelle la  pre-commande pourrai être traitée. </label>
                <input type="text" name="datecomprop" readonly class="input" 
                        value="<?php echo $datecomprop;?>" />
                <!-- <span>Date</span> -->
                    <!-- </div> -->
                    <br>
 <!-- *********************************************** -->
                    
                    <input type="submit" name="submit" value="Envoyer pre-Commande" class="btn" />
                </form>
            </div>
</div>    
</div>
    <script src="appcontact.js"></script>
    <!-- <script src="nbrimprimes.js"></script> -->
</body>
</html>
