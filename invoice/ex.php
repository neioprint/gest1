<?php
// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF

$client="scco";
$somme=78;
require('invoice.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "IMPRIMERIE Boualam Lahouari NEIO",
                  "17 Rue moussa ahmed\n" .
                  "31000 ORAN\n"
                 
                   );
$pdf->fact_dev( "Devis ", "10" );
$pdf->temporaire( "Devis Temporaire" );
$pdf->addDate( "25/01/2023");
$pdf->addClient("CL01");
$pdf->addPageNumber("1");
$pdf->addClientAdresse("Client:$client \n okokoko \n bnbnbn \n vvvvvv \n hjhjhjhjh");
$pdf->addReglement("Cheque/virement/espece");
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");
// $pdf->addReference("Bon de commande .");
$cols=array( "REF"    => 15,
             "DESIGNATION"  => 90,
             "QUANTITE"     => 22,
             "P.U. TTC"      => 26,
             "MONTANT TTC" => 37
             );
$pdf->addCols( $cols);
$cols=array( "REF"    => "L",
             "DESIGNATION"  => "L",
             "QUANTITE"     => "C",
             "P.U. TTC"      => "R",
             "MONTANT TTC" => "R"
             );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;
$line = array( "REF"    => "REF1",
               "DESIGNATION"  => "$client\n" .
                                 "Processeur AMD 1Ghz\n" .
                                 "128Mo SDRAM, 30 Go Disque, CD-ROM, Floppy, Carte video",
               "QUANTITE"     => "1",
               "P.U. TTC"      => "600.00",
               "MONTANT TTC" => "600.00"
               );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;

$line = array( "REF"    => "REF2",
               "DESIGNATION"  => "Cable RS232",
               "QUANTITE"     => "1",
               "P.U. TTC"      => "10.00",
               "MONTANT TTC" => "10.00"
                );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;

//$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte


// $tot_prods = array( array ( "px_unit" => 600, "qte" => 1 ),
//                     array ( "px_unit" =>  10, "qte" => 1 ));
// $tab_tva = array( "1"       => 19.6,
//                   "2"       => 5.5);
// $params  = array( "RemiseGlobale" => 1,
//                       "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
//                       "remise"         => 0,       // {montant de la remise}
//                       "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
//                   "FraisPort"     => 1,
//                       "portTTC"        => 10,      // montant des frais de ports TTC
//                                                    // par defaut la TVA = 19.6 %
//                       "portHT"         => 0,       // montant des frais de ports HT
//                       "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
//                   "AccompteExige" => 1,
//                       "accompte"         => 0,     // montant de l'acompte (TTC)
//                       "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
//                   "Remarque" => " " );

//$pdf->addTVAs( $params, $tab_tva, $tot_prods);
//$pdf->addReference("Non asujetti à la tva .");
$pdf->addCadreEurosFrancs();
$pdf->SetXY(10,250);
// Début en police normale
$pdf->SetFont('Arial', '', 14);
$nonassujetti='Non assujettie à la tva';
$nonassujetti = iconv('UTF-8', 'windows-1252', $nonassujetti);
$pdf->Write(5,$nonassujetti);
// Lien en bleu souligné
// $pdf->SetTextColor(0, 0, 255);
// $pdf->SetFont('', 'U');
// $pdf->Write(5, 'www.fpdf.org', 'http://www.fpdf.org');
// $pdf->Output("monfichier.pdf","F");
$pdf->Output();

                   $to='neioprint@gmail.com';
                    $nomclient='moi';
                    $prix=10;
                    $from='contact@global2pub.com';
                    //$sujet='Message avec piece jointe';
                    $sujet='Urgent Prioritaire Changement de prix '.$nomclient;
                    $chemin_fichier= 'monfichier.pdf'; // chemin relatif par rapport au fichier de script envoyant l'email, j'ai pas testé en chemin absolu
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
                        $attached = "\n\n". "--" .$boundary . "\nContent-Type: application".$file_type."; name=\"$file_name\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$file_name\"\r\n\n".$attached_file . "--" . $boundary . "--";

                    //on formate les headers
                        $headers ="From: ".$from." \r\n";
                        $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

                    //on formate le corps du message
                        $body = "--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\n".$msg . $attached;

                    //on envoie le mail
                    $res = mail($to,$sujet,$body,$headers);
                    if ($res) echo "ok";
// <!-- $str = iconv('UTF-8', 'windows-1252', $str);
// Ou bien avec mbstring :
// $str = mb_convert_encoding($str, 'windows-1252', 'UTF-8'); -->