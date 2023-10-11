<?php
date_default_timezone_set("Africa/Algiers");
session_start();
// gestion des erreurs
error_reporting(-1);
ini_set("display_errors",1);
$d=strtotime('+9 days');
$datecomprop=date('l d-m-Y', $d);
$datecom=date('l d/m/Y').' à '. date("H:i:sa");
if (isset($_POST["submit"])) {
$username = $_POST["nom"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$message = $_POST["message"];
$quantite= $_POST["quantite"];
$commande= $_POST["commande"];

$liste="";
//$imprimer=$_POST["imprimer"];
//affichage de la liste commande 
//var_dump($commande);
$tableau_Array=$commande;
//print_r($tableau_Array);
// boucle pour parcourrir le tableau
$i=1; // le compteur de boucle pour compter les imprimés
foreach($tableau_Array as $selectValue){
		//affichage des valeurs sélectionnées
              //  echo "Imprimé N°".$i." ".$selectValue."<br>";
                $liste=$liste."Imprimé N°".$i." :".$selectValue." Quantité".$quantite."<br>";
                $i++; // incrementer le compteur
    //affichage des valeurs sélectionnées
          
                
            }
            $imprimer=$i-1; // affecter la variable $i au nombrer de document à envoyer par mail
        //    echo "<br>";
        //    echo $imprimer;
        //    echo "<br>";

/* $to = $email; */
$to= "commande@global2-pub.com";
$subject = $message;

$message = "Nom : {$username} <br>
            Email: {$email} <br>
            Phone: {$phone} <br>
            Date commande :{$datecom} <br>
            Date proposé pour traiter la commande:{$datecomprop} <br>
            Nombre d'imprimes :{$imprimer} <br>
            liste des Imprimés  <br> 
            {$liste} 
           
            Quantite: {$quantite} <br> 
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
$headers .= 'From: '.$email;

$mail = mail($to,$subject,$message,$headers);

if ($mail) {
 
 
echo "<script>alert('Mail Envoyé avec succée.');</script>";
session_unset();

// destroy the session
session_destroy();
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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire de Commande</title>
    <link rel="stylesheet" href="styleanim.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="../styles/stylenav.css">
   <link rel="stylesheet" href="../styles/style2.css"> -->
   <!-- style provisoire à déplacer plus tard -->
   <style>
       input[type="text"]:disabled {
   background: blue;
  
}
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
   </style>
</head>
<body>
<div class="container">
        <!--  <span class="big-circle"></span> -->
       <!-- <img src="images/shape.png" class="square" alt="" />  -->
        <div class="form">
            <div class="contact-info">
                <img src="images/logo2.png" alt="" width="100">
                
                <!-- <img src="../accueil.gif"  width="80"alt=""> -->
                <h3 class="title">A propos de nous</h3>
                <!--  <p class="text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe
                    dolorum adipisci recusandae praesentium dicta!
                </p> -->

                <div class="info">
                    <div class="information">
                        <!-- <img src="images/location.png" class="icon" alt="" /> -->
                        <img class="icon" src="../emplacement.gif"  width="40" alt="">
                        <p>52 rue affen benarmass Aoued Oran</p>
                    </div>
                    <div class="information">
                        <!-- <img src="images/email.png" class="icon" alt="" /> -->
                        <img class="icon" src="../e-mail.gif"  width="40" alt="">
                        <p>commande@global2-pub.com</p>
                    </div>
                    <div class="information">
                        <!-- <img src="images/phone.png" class="icon" alt="" /> -->
                        <img class="icon" src="../telephone.gif"  width="40" height="auto" alt="">
                       
                        <p> 0541 03 55 48 / 0558 02 83 52 </p>
                      
                    </div>
                </div>

                <!-- <div class="social-media">
                    <p>Les réseaux sociaux :</p>
                    <div class="social-icons">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div> -->
                <br><br>
                <!-- image animée format avif -->
                <img class="icon" src="../accueil.avif"  width="40"alt="">
               
                <a class="bouton" href="../index.html">
                    HOME</a>
                    <br>
                    <?php
//echo "Aujourd'hui " . date("Y/m/d") . "<br>";
//echo "Today is " . date("Y.m.d") . "<br>";
//echo "Today is " . date("Y-m-d") . "<br>";
//echo "Today is " . date("l");
//echo "<br>";
//echo "Il est " . date("h:i:sa");
?>
                  
            </div>

            <div class="contact-form">
                <!--  <span class="circle one"></span>
                <span class="circle two"></span> -->

                <form action="" name="fo" method="post" autocomplete="on">
                    <h3 class="title">Formulaire de Commande</h3>
                    <h3 class="title" >Mobile à appeler 0541 03 55 48</h3>

                    <div class="input-container">
                        <label for="nom">Nom Entreprise(4 caracteres minimum)</label>
                        <input type="text" name="nom" minlength="4" maxlength="20" class="input"  required autocomplete="on"/>

                        <span>Nom Entreprise(4 caracteres minimum)</span>
                    </div>

                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="input" autocomplete="on" required
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />

                        <span>Email</span>
                    </div>

                    <div class="input-container">
                        <label for="phone">Votre Mobile (Mobilis ou Ooredoo ou Djezzy) SVP</label>
                        <span>Votre Mobile (Mobilis ou Ooredoo ou Djezzy) SVP</span>
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
                    <h4 class="title">Choisissez vos imprimés vous pouvez selectionner plusieurs à la fois</h4><br>
                   
                    <select name="commande[]" id="commande" class="input" required style="background:var(--violet) " size="16" multiple>
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
                <div class="title">
                    <br>
                <label for="quantite">Quantité à partir de 500</label>
                <input type="number" name="quantite" class="input" min="500" step="250" max="100000" placeholder="500" required autocomplete="on"/>
                <!-- <span>Quantité 500</span> -->
                    </div>

                    <div class="input-container textarea">
                        
                        <label for="message">Details Commande 5 caracteres au moins</label>
                       
                        <textarea name="message" class="input" required minlength="5" maxlength="232" autocomplete="on"></textarea>
                        <span>Details Commande 5 caracteres au moins</span>
                    </div>


                    <div class="title">
                      
                <label for="datecom">Date de commande (aujourd'hui) </label>
                <input type="text" name="datecom" class="input"  disabled autocomplete="on"
               
                placeholder="<?php echo $datecom ?>" >
                <!-- Y/m/d -->
               <!-- d/m/Y -->
                    </div>
                    <div class="title">
                    <br>    
                <label for="datecomprop">Proposition de Date (eventuelle) pour traiter la commande. </label>
                <input type="text" name="datecomprop" disabled class="input" 
                        placeholder="<?php echo $datecomprop;
                         ?>"
                       
                                     autocomplete="on"/>
                <!-- <span>Date</span> -->
                    </div>
                    <br>
 <!-- *********************************************** -->
                    
                    <input type="submit" name="submit" value="Envoyer Commande" class="btn" />
                </form>
            </div>
</div>    
</div>
    <script src="appcontact.js"></script>
    <!-- <script src="nbrimprimes.js"></script> -->
</body>
</html>
