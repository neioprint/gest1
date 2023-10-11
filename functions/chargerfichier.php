<?php
function chargerfichier($type,$idclient,$idimprime,$imprime) {
  //$trans=$GLOBALS["etat"];
  //echo $trans;
 // echo $etat;
//  die();
 //echo $_FILES["monfichier"]["name"];
//if(isset($_FILES["monfichier"]["name"])){
   
        // echo '<pre>';
        // print_r($_FILES["monfichier"]);
        // echo '</pre>'; 
 //  die(); 
    if ($_FILES["monfichier"]['error']== 0 && isset($_FILES["monfichier"]) && !empty($_FILES["monfichier"]))  {
    
        $accepte=false;
    $extension=explode(".",$_FILES["monfichier"]["name"]);
    
    // print_r($extension);
    // print_r($_FILES["monfichier"][""]);
    //die();
    if ($type=="image") {

                            $nom=$idclient.$idimprime.$imprime.date('d_m_YH_i_s').".".$extension[1];
                            //$nom=$idclient.$idimprime.date('d_m_YH_i_s').".".$extension[1];
                            // $file = "test.test.test.test.essai.php";
                            $file=$nom;
                            
                             $extension0 = substr($file,strrpos($file, "."));
                             $file2 = substr($file,0,strrpos($file, "."));
                             $final_file = str_replace('.','',$file2).$extension0;
                             $nom=$final_file;
                            // echo $file."<br>";
                            // echo $extension."<br>";
                            // echo $file2."<br>";
                            // echo $final_file."<br>";

                            // $nom=$idclient[0].$nomclient[1].$idimprime[0].$imprime[1].date('d-m-Y H').".".$extension[1];
                            $_SESSION["image"]=$nom;
                             //print_r($nom);
                         
                          }
    // else {$nom="bcomm".date('d-m-Y H-i-s').".".$extension[1];}
    //print_r($nom);
    //$GLOBALS["image"]=$nom;
    //$_SESSION["image"]=$nom;
    if (($extension[1]=="cdr") | ($extension[1]=="pdf") | ($extension[1]=="png") | ($extension[1]=="jpg")) {
        $accepte=true;
    };
    //$_POST["client"].
   // $_POST["dates"].
    //$_POST["client"].$_POST["imprime"].
 //   $_FILES["monfichier"]["name"];
   //    echo $mess;
        //  if(!preg_match("#image/jpeg|png|application/octet-stream|pdf#",$_FILES["monfichier"]["type"]))
         
        //    { $_SESSION['erreur'].='Format de fichier invalide!';}
           
        if($_FILES["monfichier"]["size"]>8000000)
           // $message='<span class="nook">Taille trop grande!</span>';
          {  
            $_SESSION['erreur'].='Taille trop grande!'.'<br>';
        }
        // else{
            if ($accepte) {
              $nom=$idclient.$idimprime.$imprime.date('d_m_YH_i_s').".".$extension[1];
              //$nom=$idclient.$idimprime.date('d_m_YH_i_s').".".$extension[1];
              $file=$nom;
                            
              $extension0 = substr($file,strrpos($file, "."));
              $file2 = substr($file,0,strrpos($file, "."));
              $final_file = str_replace('.','',$file2).$extension0;
              $nom=$final_file;


              // print_r($idclient);
              // echo "<br>";
              // print_r($nom);
            if (move_uploaded_file($_FILES["monfichier"]["tmp_name"],"uploads/".$nom))
            {
            //   $message.='<span class="ok">Image chargée avec succès</span>';
               $_SESSION['message'].='Fichier image chargé avec succès'.'<br>';
                //header('Location: formcommande.php');
               //return true;
              // die();
    
        }
           } else  { $_SESSION['erreur'].='Format de fichier invalide!';}
        // }
          // echo "<script>window.location.href='formcommande.php';
          //       </script>";
   //     } 
  }







  // echo '<pre>';
  // print_r($_FILES["monfichier2"]);
  // echo '</pre>'; 
// traitement deuxieme fichier
if ($_FILES["monfichier2"]['error']== 0 && isset($_FILES["monfichier"]) && !empty($_FILES["monfichier"])) {
      // echo '<pre>';
      //   print_r($_FILES["monfichier"]);
      //   echo '</pre>';  
  $accepte=false;
$extension=explode(".",$_FILES["monfichier2"]["name"]);

// print_r($extension);
// print_r($_FILES["monfichier"]["name"]);
//die();
if ($type=="bondecommande") {

                      $nom="bcomm".$idclient.$idimprime.$imprime.date('d_m_YH_i_s').".".$extension[1];
                      // $nom=$idclient[0].$nomclient[1].$idimprime[0].$imprime[1].date('d-m-Y H').".".$extension[1];
                             // $file = "test.test.test.test.essai.php";
                             $file=$nom;
                            // $file="M. B.O.N.C Extra.jpg";
                             $extension0 = substr($file,strrpos($file, "."));
                             $file2 = substr($file,0,strrpos($file, "."));
                             $final_file = str_replace('.','',$file2).$extension0;
                             $nom=$final_file;
                            // $file="M. B.O.N.C Extra.jpg";
                            // $extension = substr($file,strrpos($file, "."));
                            // $file2 = substr($file,0,strrpos($file, "."));
                            // $final_file = str_replace('.','',$file2).$extension;
                            // echo $file."<br>";
                            // echo $extension."<br>";
                            // echo $file2."<br>";
                            // echo $final_file."<br>";
                      $_SESSION["bondecommande"]=$nom;
                       //print_r($nom);
                   
                    }
// else {$nom="bcomm".date('d-m-Y H-i-s').".".$extension[1];}
//print_r($nom);
//$GLOBALS["image"]=$nom;
//$_SESSION["bondecommande"]=$nom;
if (($extension[1]=="cdr") | ($extension[1]=="pdf") | ($extension[1]=="png") | ($extension[1]=="jpg")) {
  $accepte=true;
};
//$_POST["client"].
// $_POST["dates"].
//$_POST["client"].$_POST["imprime"].
//   $_FILES["monfichier"]["name"];
//    echo $mess;
  //  if(!preg_match("#image/jpeg|png|application/octet-stream|pdf#",$_FILES["monfichier2"]["type"]))
   
  //    { $_SESSION['erreur'].='Format de fichier invalide!';}
     
   if($_FILES["monfichier2"]["size"]>8000000)
     // $message='<span class="nook">Taille trop grande!</span>';
    {  
      $_SESSION['erreur'].='Taille trop grande!'.'<br>';
  }
  // else{
      if ($accepte) {
        $nom="bcomm".$idclient.$idimprime.$imprime.date('d_m_YH_i_s').".".$extension[1];
        $file=$nom;
                            
        $extension0 = substr($file,strrpos($file, "."));
        $file2 = substr($file,0,strrpos($file, "."));
        $final_file = str_replace('.','',$file2).$extension0;
        $nom=$final_file;

      if (move_uploaded_file($_FILES["monfichier2"]["tmp_name"],"uploads/".$nom))
      {
      //   $message.='<span class="ok">Image chargée avec succès</span>';
         $_SESSION['message'].='Fichier bon de commande chargé avec succès'.'<br>';
          //header('Location: formcommande.php');
         //return true;
        // die();

  }
     } else  { $_SESSION['erreur'].='Format de fichier invalide!';}
  // }
    // echo "<script>window.location.href='formcommande.php';
    //       </script>";
//     } 
}
  
}