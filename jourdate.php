<?php
// date fr
echo date('D', strtotime("20-02-2009"));
//date en
// echo date('D', strtotime("2009/02/20"));
echo '<br>';
$time = date('Y-m-d');
$jours = Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
$numJour = date('w',strtotime($time));
$jour = $jours[$numJour];
echo"$jour";
echo '<br>';
?>


<!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
Bonjour,

Je suis en train de développer une bonne tartine de php entre des bases de données et a présent je dois gérer un planning

Je cherche donc à récupérer un jour de la semaine à partir d'une date future (ex: 06/07/2009)
et qu'un petit script bien pratique me donne le jour de la semaine!!!!

J'ai réussi a trouver un script me donnant le jour de la semaine de la date d'aujourd'hui:

<?php
$time = time('Y-m-d');
$jours = Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
$numJour = date('w', strto($time));
$jour = $jours[$numJour];
echo"$jour";
?>

J'essai de développer un autre script calculant la différence entre la date future et le 1er Janvier 1970
et la transformer en seconde:
cependant trop de cas particuliers s'impose:
année bisextile (facile a résoudre!!! pas de prob)
après il faut que je fasse pour tout les mois (ça ça peut aller encore ;-)


mais le truc c'est que si ya plus simple et peut etre plus fiable je suis preneur!!!!

Quelqu'un aurait-il une idée?????

Merci à tous pour avoir lu ce message

GuiGui



$J1 = (YYYY - 1970 ) * 365;

Cependant
Moi aussi (1)
 Posez votre question

A voir également:
Php date jour de la semaine
Vba date du jour - Forum Excel
Alert php ✓ - Forum PHP
Iphone 14 date de sortie - Guide
Header php - Astuces et Solutions
Mise a jour airpods - Guide
6 réponses
RÉPONSE 1 / 6
Meilleure réponse
Kaies_TN
29 juil. 2009 à 12:30
//D:pour day(jour);M pour Month(mois); Y:pour Year(an)
//pour afficher le jour ou le mois en lettre use "M" ou "D"
// pour afficher le jour ou le mois numerique: "m" pour mois(dans notre cas 02), "d" pour jour(dans notre cas 20)
//systax: date('[Y,y,M,m,D,d]', strtotime("[Votre date]"));


/////////////
<?php
// date fr
echo date('Y', strtotime("20-02-2009"));
//date en
echo date('Y', strtotime("2009/02/20"));
?>
/////////////
Result:

2009
Commenter
 17 