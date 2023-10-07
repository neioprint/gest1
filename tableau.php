<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
$tableau=array(array(0,'',''),
                array(0,'',''),
                array(0,'',''),
                array(0,'',''),
                array(0,'',''),
                array(0,'',''),
                array(0,'',''),
                array(0,'',''),
              

);
echo "<pre>";
print_r($tableau);
echo "</pre>";
echo "<br>";
echo count($tableau);
echo "<br>";
$tabser=serialize($tableau);
print_r($tabser);
echo "<br>";
$tableau[0][0]=0;

$tableau[0][1]=date('Y-m-d'). " à ".date('H:i'). " par " . $_SESSION['login'];

echo "<pre>";
print_r($tableau);
echo "</pre>";



