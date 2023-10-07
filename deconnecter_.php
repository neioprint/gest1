<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};

if  (!(isset($_SESSION['login']))){
    $_SESSION['erreur'] = 'Veuillez vous connecter pour acceder au contenu'; 
    header('Location: login.php');
    die;
} else
if  ((isset($_SESSION['login']))){
    $_SESSION['login']='';
    session_unset();
    $_SESSION['message']='';
    $_SESSION['message'] = 'Vous êtes maintenant déconnecté'; 
    header('Location: login.php');
    die;
}