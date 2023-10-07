<?php
//------------------recuperation des variables et formatage--------------------------------
 $expediteur = $mail;
 $suject = stripslashes($_POST['objet']);
 $message = stripslashes($_POST['elm1']);
 $chemin_fichier= 'pdf/.pdf'; // chemin relatif par rapport au fichier de script envoyant l'email, j'ai pas testé en chemin absolu
//-----------------------------------------------------------------------------------------
$boundary = "_".md5 (uniqid (rand()));
//------------------------------ courriel pret a partir -----------------------------------
 $header = "MIME-Version:1.0" . "\r\n" ;
 $header .= "Content-Type:text/html; charset=ISO-8859-1" . "\r\n";
 
 $header.= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

//on formate le corps du message
                $message = "--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\n".$header . $attached;
 // more Header
 $header .= "From:mail" . "\r\n";
 $header .= 'Bcc:mail' . "\r\n";
 
//on selectionne le fichier à partir d'un chemin relatif
                $attached_file = file_get_contents($chemin_fichier); //file name ie: ./image.jpg
                $attached_file = chunk_split(base64_encode($attached_file));
//on recupere ici le nom du fichier
                $pos=strrpos($chemin_fichier,"/");
                if($pos!==false)$file_name=substr($chemin_fichier,$pos+1);
                else $file_name=$chemin_fichier;

//on recupere ici le type du fichier
                $pos=strrpos($chemin_fichier,".");
                if($pos!==false)$file_type="/pdf".substr($chemin_fichier,$pos+1);
                else $file_type="/pdf";

                //echo "file_type=$file_type";
                $attached = "\n\n". "--" .$boundary . "\nContent-Type: application".$file_type."; name=\"$file_name\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$file_name\"\r\n\n".$attached_file . "--" . $boundary . "--";

$message = stripslashes($_POST['elm1']);
//$message .= stripslashes($nom); 
$message .= stripslashes("<br /><br /><p style='font-family:Tahoma, Geneva, sans-serif; font-size: x-small; line-height:20px;'>Pour visiter le site : <a href='$url'>$url</a><br>Conformément à la loi 78-17 du 6 janvier 1978, dite loi Informatique et Libertés, vous disposez d'un droit d'accès individuel, de rectification et de suppression de données nominatives qui vous concernent. </p><br>");


//------------verifie si la case est cochee pour envoyer le mail en question---------------
 $options = $_POST['options'];
//-----------------------------------------------------------------------------------------

//----------------------------affichage de la liste des mails envoyes ---------------------
 if ($options) {
   echo "<br /><table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" width=\"760px\">";

  foreach ($options as $mail) {
//-------------recuperation du mail pour desabonnement a la newsletter--------------------
   $mesg = $message;
   $mesg .= stripslashes("<p style='font-family:Tahoma, Geneva, sans-serif; font-size: x-small;color:#999; text-align:center;'>Je ne souhaite plus être référencé <a href=\"$url/desabonner_tb2.php?mail=$mail\">cliquez ici </a></p> <br>");
   
//---------------------------envoi des mails si possible ---------------------------------	 
     	if (@mail($mail, $suject, $mesg, $header)) {
     echo "<tr><td>&nbsp;&nbsp;"."NEWSLETTER_A_DESTINATION_DE"." : $mail</td></tr>";
  } else {
     	   echo "<tr><td>&nbsp;&nbsp;"."IMPOSSIBLE_ENVOYER_MESSAGE"."  : $mail</td></tr>";
   	  } 
//---------------------------------------------------------------------------------------- 
 } 
}








// autre code
function sendMail(
    string $fileAttachment,
    string $mailMessage = MAIL_CONF["mailMessage"],
    string $subject     = MAIL_CONF["subject"],
    string $toAddress   = MAIL_CONF["toAddress"],
    string $fromMail    = MAIL_CONF["fromMail"]
): bool {
   
    $fileAttachment = trim($fileAttachment);
    $from           = $fromMail;
    $pathInfo       = pathinfo($fileAttachment);
    $attchmentName  = "attachment_".date("YmdHms").(
    (isset($pathInfo['extension']))? ".".$pathInfo['extension'] : ""
    );
   
    $attachment    = chunk_split(base64_encode(file_get_contents($fileAttachment)));
    $boundary      = "PHP-mixed-".md5(time());
    $boundWithPre  = "\n--".$boundary;
   
    $headers   = "From: $from";
    $headers  .= "\nReply-To: $from";
    $headers  .= "\nContent-Type: multipart/mixed; boundary=\"".$boundary."\"";
   
    $message   = $boundWithPre;
    $message  .= "\n Content-Type: text/plain; charset=UTF-8\n";
    $message  .= "\n $mailMessage";
   
    $message .= $boundWithPre;
    $message .= "\nContent-Type: application/octet-stream; name=\"".$attchmentName."\"";
    $message .= "\nContent-Transfer-Encoding: base64\n";
    $message .= "\nContent-Disposition: attachment\n";
    $message .= $attachment;
    $message .= $boundWithPre."--";
   
    return mail($toAddress, $subject, $message, $headers);
}
