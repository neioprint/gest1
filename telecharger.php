<?php
  //////////////////////////////////////////////////////////////////////////////////////
  // Fichier: telecharger.php                                                         //
  // Version: 1.00 - Derni�re modification: Mercredi 15 D�cembre 2004                 //
  // Auteur:  J�r�me DESMOULINS (http://www.jerome-desmoulins.new.fr)                 //
  // Description:                                                                     //
  //   Ce script permet de proposer aux visiteurs du site de t�l�charger un fichier,  //
  //   comme une image JPG, par exemple qui, par d�faut s'affiche au lieu de proposer //
  //   la boite de dialogue de t�l�chargement                                         //
  //////////////////////////////////////////////////////////////////////////////////////

  $NomAdmin="sid";         // Nom de l'administrateur du site Web (ou seulement son pr�nom)
  $LogSouhaite=1;             // On met se parametre � 1 si l'on veut g�n�rer un log en cas de tentative d'utilisation du script par un "hacker";
  $LogFile="telecharger.txt"; // Ceci est le nom du fichier de log, si $LogSouhaite est � 1, sinon, il n'est pas utilis�
    // Le fichier de log contient les colonnes suivantes: Date, Heure, Remote Host, IP du visiteur, fichier demand�, Navigateur Internet

  // Suivant l'extention du fichier, on d�termine le type de t�l�chargement pour lequel il faut opter
  // Pour autoriser le t�l�chargement de nouveaux types de fichier (par extention), il suffit de
  // d�commenter les lignes ci-dessous
  $fichier=$_GET['fichier'];
  switch(strrchr(basename($fichier), ".")) {
    //case ".gz": $type = "application/x-gzip"; break;
    //case ".tgz": $type = "application/x-gzip"; break;
    //case ".zip": $type = "application/zip"; break;
    //case ".pdf": $type = "application/pdf"; break;
    //case ".png": $type = "image/png"; break;
    //case ".gif": $type = "image/gif"; break;
    case ".jpg": $type = "image/jpeg"; break;
    //case ".txt": $type = "text/plain"; break;
    //case ".htm": $type = "text/html"; break;
    //case ".html": $type = "text/html"; break;
    case ".php": $type = "text/php"; break;

    // Pour les autres types (ceux que l'on ne veut pas autoriser en t�l�chargement, on affiche un message d'avertissement)
    // Sinon, ce script pourrait �tre utilis� pour t�l�charger les sources des pages PHP, par exemple, ou un fichier .htaccess
    default:
      print "<FONT COLOR=red><CENTER>";
      print "  Ca va pas non!!!<BR>";
      print "  T'as cru que j'allais laisser pirater ce site aussi facilement!!!<P>";
      print "  J'avise imm�diatement ".$NomAdmin." de cette tentative de piratage.";
      // Si l'on souhaite un log pour cette tentative, on le g�n�re
      if ($LogSouhaite==1)
      {
        if (!file_exists($LogFile)) touch($LogFile);
        $fp=fopen($LogFile,"a");
        $LaDate=date("y/m/d");
        $LHeure=date("H:i:s");
        $hostname = getenv("REMOTE_HOST");
        $ipaddress = getenv("REMOTE_ADDR");
        $navigateur=$_SERVER["HTTP_USER_AGENT"];
        fwrite($fp,$LaDate.";".$LHeure.";".$hostname.";".$ipaddress.";".$fichier.";".$navigateur."\n");
        fclose($fp);
      }
      print "</CENTER></FONT>";
      exit;
      break;
  }

  // On d�marre le t�l�chargement du fichier
  $nomfichier=basename($fichier);
  header("Content-disposition: attachment; filename=$nomfichier");
  header("Content-Type: application/force-download");
  header("Content-Transfer-Encoding: $type\n"); // Surtout ne pas enlever le \n
  header("Content-Length: ".filesize($fichier));
  header("Pragma: no-cache");
  header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, public");
  header("Expires: 0");
  readfile($fichier);
?>
