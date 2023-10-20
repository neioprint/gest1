<?php
require('invoice.php');
//echo "ok";
$idc = isset($_GET['idc']) ? $_GET['idc'] : 0;
$dates = isset($_GET['dates']) ? $_GET['dates'] : "";
$nomclient = isset($_GET['nomclient']) ? $_GET['nomclient'] : "";

$idclient = isset($_GET['idclient']) ? $_GET['idclient'] : 0;
$idimprime = isset($_GET['idimprime']) ? $_GET['idimprime'] : 0;
$imprime = isset($_GET['imprime']) ? $_GET['imprime'] : "";
$email = isset($_GET['email']) ? $_GET['email'] : "";

$quantite = isset($_GET['quantite']) ? $_GET['quantite'] : 0;
$prix = isset($_GET['prix']) ? $_GET['prix'] : 0;
if ($idc==0) {
    $_SESSION['erreur'] .= " Commande inexiste!";
            header("Location: ../indexcommande?niveau=ins");
            die();
            }








// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF

//$client="scco";
//$somme=78;


$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "IMPRIMERIE NEIO",
                "Tous travaux d'impression typo/offset\n".

                "Tel 0541035548/0770416421/0555119737\n".
                "17 Rue moussa ahmed ex Cuvelier\n" .
                 
                "31037  ORAN\n"
                 
                );
// $pdf->fact_dev( "Devis ", "10" );
$pdf->fact_dev( "Devis ", $idc );

$pdf->temporaire( "Devis  Devis  Devis" );
$pdf->addDate($dates);
$pdf->addClient($idclient);
$pdf->addPageNumber("1");
$pdf->addClientAdresse("Client: $nomclient ");
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
$line = array( "REF"    => $idimprime,
               "DESIGNATION"  => "$imprime\n",
                                
                                
               "QUANTITE"     => $quantite,
               "P.U. TTC"      => $prix,
               "MONTANT TTC" => $quantite*$prix
               );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;

// $line = array( "REF"    => $idimprime,
//                "DESIGNATION"  => "$imprime\n",
                                
                                
//                "QUANTITE"     => $quantite,
//                "P.U. TTC"      => $prix,
//                "MONTANT TTC" => $quantite*$prix
//                );
// $size = $pdf->addLine( $y, $line );
// $y   += $size + 2;

// $line = array( "REF"    => "REF2",
//                "DESIGNATION"  => "Cable RS232",
//                "QUANTITE"     => "1",
//                "P.U. TTC"      => "10.00",
//                "MONTANT TTC" => "10.00"
//                 );
// $size = $pdf->addLine( $y, $line );
// $y   += $size + 2;

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


$tot_prods = array( array ( "px_unit" => 600, "qte" => 1 ));
$tab_tva = array( "1"       => 19.6,
                  "2"       => 5.5);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => " " );

$pdf->addTVAs( $params, $tab_tva, $tot_prods,$prix,$quantite);
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
$nomfichier=$idc.$nomclient.date("Hsi").'.pdf';
// echo $nomfichier;
// die();
$pdf->Output($nomfichier,"F");
//$pdf->Output();
// debut partie envoi mail au client
//  if($client['email']!="") {

  
                        //$_SESSION['message'] .= "Changement de prix  <br>";
                        //echo "entre";
                        //die();
                    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                    //$destinataire='neioprint@gmail.com';
                    $to=$email;
                    // $to='neioprint@gmail.com';
                    $from='contact@global2pub.com';
                    //$sujet='Message avec piece jointe';
                    $sujet='Urgent! Prioritaire  prix de votre commande '. $nomclient;
                    $chemin_fichier= $nomfichier; // chemin relatif par rapport au fichier de script envoyant l'email, j'ai pas testé en chemin absolu
                    //$message='Voici un message (format texte) avec une piece jointe ';
                    //$msg = 'Mr '.$nomclient.' le prix de votre commande à été evalué à '.$prix.' DZ veuillez trouver le devis en piece jointe et le telecharger.';
                    $msg="<html>
                    <body>
                    <div>
                    <img src='https://neio.global2pub.com/images/logoneio.png' width='40px' height='auto'>
                    <p>IMPRIMERIE NEIO Tous travaux d'impression typo/offset</p>
       
                    <p>Tel 0541035548/0770416421/0555119737</p>
                    <p>17 Rue moussa ahmed ex Cuvelier 31037  ORAN</p>
                        <h4>Mr $nomclient  le prix de votre commande à été evalué à $prix DZ</h4>
                        <p>Lien pour commander https://neio.global2pub.com/loginclient.php</p>
                        <img src='https://neio.global2pub.com/images/annonce2.png' width='100%' height='auto'>
                        <img src='https://neio.global2pub.com/images/banniere3.gif' width='100%' height='auto'>
                       <p>veuillez trouver le devis en piece jointe et le télecharger merci.</p>
                       <img src='https://neio.global2pub.com/images/plaquette.jpg' width='100%' height='auto'>
                      
                       

                     
                       
                    </div>
                      
                    </body>
                </html>";
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
                        $body = "--". $boundary ."\nContent-Type: text/html; charset=ISO-8859-1\r\n\n".$msg . $attached;

                    //on envoie le mail
                    $res = mail($to,$sujet,$body,$headers);
                    // if ($res) echo $res;
                    // die();
                    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
           
                    //$headers='Content-Type: text/plain; charset=utf-8' . "\r\n";
                    // $headers .= 'FROM:  contact@global2pub.com';
                    //$msg = "Mr $nomclient le prix de votre commande à été evalué à $prix DZ";
    
                    // $to=$client['email'];
                    // echo $to;
                    // die();
                    //"neioprint@gmail.com";// e mail du client
                    //mail($to, $sujet, $msg, $headers);
                     // require('./closeclient.php');

//                     }
// fin partie envoi mail
//echo "envoye";
header('Location: ../indexcommande.php?niveau=ins');




// envoi email
