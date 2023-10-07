<?php

// Initialising a DateTime
$datetime = new DateTime('08:00');

// DateInterval object is taken as the
// parameter of the add() function
// Here 1 day is added
$datetime->add(new DateInterval('P1D'));

// Getting the new date after addition
echo $datetime->format('Y-m-d') . "\n";
?>
