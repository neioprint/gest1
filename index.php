<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
if (!isset($_SESSION['user'])) {
    header('Location:login.php');
    exit();
}
header('Location:login.php');
//  //   require_once('role.php');
//     header('Location: ./login.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />

    <link rel="shortcut icon " href="favicon.png">
    <title>Gestion Imprimerie</title>
</head>

<body>
    <?php require_once('./navbarok.php')

    ?>

</body>

</html>