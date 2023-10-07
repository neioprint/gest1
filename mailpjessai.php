<?php
                    $to='neioprint@gmail.com';
                    $nomclient='moi';
                    $prix=10;
                    $from='contact@global2pub.com';
                    //$sujet='Message avec piece jointe';
                    $sujet='Urgent Prioritaire Changement de prix '.$nomclient;
                    $chemin_fichier= 'invoice/ex.php'; // chemin relatif par rapport au fichier de script envoyant l'email, j'ai pas testé en chemin absolu
                    //$message='Voici un message (format texte) avec une piece jointe ';
                    $msg = 'Mr '.$nomclient.' le prix de votre commande à été evalué à '.$prix.' DZ';
                    $boundary = "_".md5 (uniqid (rand()));

                    //on selectionne le fichier à partir d'un chemin relatif 
                        $attached_file = file_get_contents($chemin_fichier); //file name ie: ./image.jpg
                        $attached_file = chunk_split(base64_encode($attached_file));
                    //on recupere ici le nom du fichier
                        $pos=strrpos($chemin_fichier,"/");
                        if($pos!==false)$file_name=substr($chemin_fichier,$pos+1);
                        else $file_name=$chemin_fichier;

                    //on recupere ici le type du fichier
                        $pos=strrpos($chemin_fichier,".");
                        if($pos!==false)$file_type="/".substr($chemin_fichier,$pos+1);
                        else $file_type="";

                        //echo "file_type=$file_type";
                        $attached = "\n\n". "--" .$boundary . "\nContent-Type: application"."pdf"."; name=\"$file_name\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$file_name\"\r\n\n".$attached_file . "--" . $boundary . "--";

                    //on formate les headers
                        $headers ="From: ".$from." \r\n";
                        $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

                    //on formate le corps du message
                        $body = "--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\n".$msg . $attached;

                    //on envoie le mail
                    $res = mail($to,$sujet,$body,$headers);
                    if ($res) echo "ok";