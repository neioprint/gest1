<!-- < ?php

// Initialising a DateTime
$datetime = new DateTime('2019-09-30');

// DateInterval object is taken as the
// parameter of the add() function
// Here 1 day is added
$datetime->add(new DateInterval('P1D'));

// Getting the new date after addition
echo $datetime->format('Y-m-d') . "\n";
echo "<br>";
?> -->


<!-- < ?php

// Initialising a DateTime
$datetime = new DateTime('2019-09-30');

// DateInterval object is taken as the
// parameter of the add() function
// Here 5 hours, 3 Minutes and 10 seconds is added
$datetime->add(new DateInterval('PT5H3M10S'));

// Getting the new date after addition
echo $datetime->format('Y-m-d H:i:s') . "\n";
?> -->

<!-- < ?php
$startTime = date("Y-m-d H:i:s");

$add_date = date('Y-m-d H:i:s',strtotime('+5 hour +30 minutes +1 seconds',strtotime($startTime)));

$add_date2 = date('Y-m-d H:i:s',strtotime('+1 week 3 days 7 hours 5 seconds',strtotime($startTime)));

$sub_date = date('Y-m-d H:i:s',strtotime('-5 hour -30 minutes -1 seconds',strtotime($startTime)));

$nxt_mon = date('Y-m-d H:i:s',strtotime('next Monday',strtotime($startTime)));

$last_sun = date('Y-m-d H:i:s',strtotime('last Sunday',strtotime($startTime)));


echo $startTime; echo " : This is Current Time<br /> ";
echo $add_date; echo " : Added 5hours, 30min, 1sec in Current Time.<br />"; 
echo $add_date2; echo " : Added +1 week 3 days 7 hours 5 seconds<br />"; 
echo $sub_date; echo " : Subtracted 5hours, 30min, 1sec in Current Time.<br />";
echo $nxt_mon; echo " : next Monday date<br />";
echo $last_sun; echo " : last Sunday date<br />";

?>  -->



<?php
$heure= date ("H:i");
$new_time = date('H:i',strtotime('+5 hour',strtotime($heure)));
echo $heure;
echo "<br>";
echo $new_time;

