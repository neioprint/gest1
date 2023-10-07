<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if ($_SESSION['language']=="AR") {
    $_SESSION['language']="FR";
    $languagejs="FR";
} else {

    if ($_SESSION['language']=="FR") {
        $_SESSION['language']="AR";
        $languagejs="AR";
}
}



$JSON_data =array( 'languagejs' => $languagejs,);



// Envoie de la réponse vers le navigateur
echo json_encode($JSON_data);

