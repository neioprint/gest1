<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
// print_r($_SESSION['user']);
// die();
if (!isset($_SESSION['user'])) {
    header('Location:login.php');
    exit();
}
//require_once('role.php');
error_reporting(-1);
ini_set("display_errors", 1);
date_default_timezone_set("Africa/Algiers");
echo "valide";
die();
//header("Location: action2ok.php?id=234&page=1&etat=1&idclient=114&etapeterminer=0");
