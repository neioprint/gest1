<?php
require_once "const.php";

//session_start();
// echo "<pre>";
// print_r ($_SESSION['user']);
// die();
// echo "</pre>";
// echo "<br>";
// echo "<pre>";
//print_r( $_SESSION['user']['role']);
// echo "</pre>";
//die();
if (!isset($_SESSION['user'])) {
     header('Location:login.php');     
     exit();
 } 
 else
if ($_SESSION['user']['role'] != 'ADMIN' and $_SESSION['user']['role'] != 'ADMIN2') {
        header('Location:seDeconnecter.php');
        exit();
    }
