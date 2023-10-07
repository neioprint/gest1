<?php
/**
 * Retourne une semaine sous forme de chaine "du {lundi} au {dimanche}..." en gérant des cas particuliers :
 *  - début et fin pas dans le même mois
 *  - début et fin pas dans la même année
 * !!! Penser à utiliser setlocale pour avoir la date (jour et mois) en Français !!!
 */
function week2str($annee, $no_semaine){
    // Récup jour début et fin de la semaine
    $timeStart = strtotime("First Thursday January {$annee} + ".($no_semaine - 1)." Week");
    $timeEnd   = strtotime("First Thursday January {$annee} + {$no_semaine} Week -1 day");
     
    // Récup année et mois début
    $anneeStart = date("Y", $timeStart);
    $anneeEnd   = date("Y", $timeEnd);
    $moisStart  = date("m", $timeStart);
    $moisEnd    = date("m", $timeEnd);
     
    // Gestion des différents cas de figure
    if( $anneeStart != $anneeEnd ){
        // à cheval entre 2 années
        $retour = "du ".strftime("%d %B %Y", $timeStart)." au ".strftime("%d %B %Y", $timeEnd);
    } elseif( $moisStart != $moisEnd ){
        // à cheval entre 2 mois
        $retour = "du ".strftime("%d %B", $timeStart)." au ".strftime("%d %B %Y", $timeEnd);
    } else {
        // même mois
        $retour = "du ".strftime("%d", $timeStart)." au ".strftime("%d %B %Y", $timeEnd);
    }
    return $retour;
}

setlocale(LC_TIME, 'fra_fra'); // Pour avoir les jours et mois en Français, sous Windows
 
// Exemples d'utilisation
echo week2str( date('Y'), date('W') )."\n"; // semaine courante
echo week2str( '2012', '47' )."\n";         // même mois
echo week2str( '2012', '48' )."\n";         // à cheval entre 2 mois
echo week2str( '2012', '53' )."\n";         // à cheval entre 2 années
