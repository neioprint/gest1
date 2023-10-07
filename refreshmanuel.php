<?php
session_start();

//The second parameter on print_r returns the result to a variable rather than displaying it
$RequestSignature = md5($_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].print_r($_POST, true));

if ($_SESSION['LastRequest'] == $RequestSignature)
{
  echo 'This is a refresh.';
}
else
{
  echo 'This is a new request.';
  $_SESSION['LastRequest'] = $RequestSignature;
}
