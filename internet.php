<!-- < ?php
//checking connection with @fopen
if ( @fopen("https://google.com", "r") ) 
{
  print "You are connected to the internet.";
} 
else 
{
  print "You seem to be offline. Please check your internet connection.";  
} 
?> -->

<?php
switch (connection_status())
{
case CONNECTION_NORMAL:
  $txt = 'Connection is in a normal state';
  break;
case CONNECTION_ABORTED:
  $txt = 'Connection aborted';
  break;
case CONNECTION_TIMEOUT:
  $txt = 'Connection timed out';
  break;
case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
  $txt = 'Connection aborted and timed out';
  break;
default:
  $txt = 'Unknown';
  break;
}

echo $txt;
?>