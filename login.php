<?php
session_start();
date_default_timezone_set("Africa/Algiers");
// require_once "const.php";

//echo (date_default_timezone_set("Africa/Algiers"));
// $script_tz = date_default_timezone_get();

// if (strcmp($script_tz, ini_get('date.timezone'))){
//     echo 'Script timezone differs from ini-set timezone.';
// } else {
//     echo 'Script timezone and ini-set timezone match.';
// }
// die();
// if (isset($_SESSION['erreurLogin']))
//     $erreurLogin = $_SESSION['erreurLogin'];
// else {
//     $erreurLogin = "";
// }
//session_destroy();
 // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet"> 
    <script> 



function travail(message) {


    Swal.fire({
//   position: 'bottom-start',
  icon: 'success',
  title: `${message}`,
  showConfirmButton:true
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
<?php    
    if (!empty($_SESSION['message'])) {
    
    // echo '<div class="alert alert-success .alert-dismissible" role="alert">

    // <button type="button" class="close" data-dismiss="alert">&times;</button>
    //         ' . $_SESSION['message'] . '
    //     </div>';
        
  
        $messageJson=json_encode($_SESSION['message']);
?>
 <script>
 let message=JSON.parse('<?php echo $messageJson; ?>');
 travail(message)
 </script> 
<?php
 $_SESSION['message'] = "";
  
}

if (!empty($_SESSION['erreur'])) {
    // echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    // <button type="button" class="close" data-dismiss="alert">&times;</button>
    //         ' . $_SESSION['erreur'] . '
    //     </div>';
  
        $messageJson=json_encode($_SESSION['erreur']);?>
<script>
    let message=JSON.parse('<?php echo $messageJson; ?>');
            probtravail(message)
            </script>`; 
<?php
    $_SESSION['erreur'] = "";

}
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// if(!empty($_SESSION['erreur'])){
//     echo '<div class="alert alert-danger" role="alert" .alert-dismissible">'. $_SESSION['erreur'].'
//         </div>';
//     $_SESSION['erreur'] = "";
// }
// if(!empty($_SESSION['message'])){
//     echo '<div class="alert alert-success" role="alert" .alert-dismissible">
//             '. $_SESSION['message'].'</div>';
//     $_SESSION['message'] = "";
// }
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <title>Se connecter</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/monstyle.css">
   
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style41.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

</head>
<body>
<h1 class="entete animate__animated animate__rollIn"><span style=" text-shadow: 3px 3px 3px #ababab;font-size: 100px;font-family: 'Style Script', cursive;">GEST'</span> 
	<i><span style="text-shadow: 3px 3px 3px #ababab;color:yellow;font-size: 55px;font-family:Sofia, sans-serif;">IMPRIM</span></i>
	</h1>

<!-- < ?php require_once('./navbarok.php') ?> -->
<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
<!-- <img  src="./images/logo.avif" alt="logo global2pub" width="150" height="auto"> -->
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Se connecter :</div>
        <div class="panel-body">

        
            <form method="post" action="seConnecter.php" class="form">

                <!-- < ?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        < ?php echo $erreurLogin ?>
                    </div>
                < ?php } ?> -->

                <div class="form-group">
                    <label style="color:black" for="login">Login :</label>
                    <input type="text" name="login" placeholder="Login"
                           class="form-control" />
                </div>

                <div class="form-group">
                    <label style="color:black" for="pwd">Mot de passe :</label>
                    <input type="password" name="pwd"
                           placeholder="Mot de passe" class="form-control"/>
                </div>

                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-log-in"></span>
                    Se connecter
                </button>
                <p class="text-right">
                    <a href="initialiserPwd.php">Mot de passe Oublié</a>

                    &nbsp &nbsp

                    <a href="nouvelUtilisateur.php">Créer un compte</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</HTML>
