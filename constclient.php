<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
// if (!isset($_SESSION['user'])) {
//     header('Location:login.php');
//     exit();
// }
date_default_timezone_set("Africa/Algiers");
define("ICONFONT","23px");
define("FONTSIZE","30px");


ini_set("display_errors", 1);
error_reporting(-1);


function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet"> 
</head>




<body>
    


<script> 


function travail(message) {


    Swal.fire({
//   position: 'bottom-start',
  icon: 'success',
  title: `${message}`,
  showConfirmButton: true
//   ,timer: 4000
})
 } 




 function probtravail(message) {


Swal.fire({
//   position: 'bottom-start',
icon: 'error',
title: `${message}`,
showConfirmButton: true
// ,timer: 4000
})
} 

</script> 

</body>
</html>