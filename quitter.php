<?php
//require_once "const.php";
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
$_SESSION['message'] .= "Merci de votre fidelité <br> A bientôt";
// if (!isset($_SESSION['user'])) {
//   header('Location:login.php');
//   exit();
// }
date_default_timezone_set("Africa/Algiers");
define("ICONFONT","23px");
define("FONTSIZE","30px");


ini_set("display_errors", 1);
error_reporting(-1);




if (!empty($_SESSION['message'])) { ?>
     
  <!-- //  echo "<div class='alert alert-success alert-dismissible'>

  //  <button type='button' class='btn-close' data-dismiss='alert'>&times;</button>
  //          " . $_SESSION['message'] . "
  //      </div>";  -->
      
        <div class="alert alert-success alert-dismissible">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <?=$_SESSION['message']?>
    </div>  
<?php
      $messageJson=json_encode($_SESSION['message']);
?>
<script>
let message=JSON.parse('<?php echo $messageJson; ?>');
travail(message)
</script> 
<?php
$_SESSION['message'] = "";

}

if (!empty($_SESSION['erreur'])) { ?>

  <!-- // echo '<div class="alert alert-danger .alert-dismissible" role="alert">
  // <button type="button" class="btn-close" data-dismiss="alert">&times;</button>
  //         ' . $_SESSION['erreur'] . '
  //     </div>'; -->
   <div class="alert alert-success alert-dismissible">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <?=$_SESSION['erreur']?>
    </div>  
<?php  
      $messageJson=json_encode($_SESSION['erreur']);?>
<script>
  let message=JSON.parse('<?php echo $messageJson; ?>');
          probtravail(message)
          </script>`; 
<?php
  $_SESSION['erreur'] = "";

}

// header("Location: loginclient.php");
// die();







?>
<!DOCTYPE html>
<html lang="fr">
 

<head>
<title>Gestion Commandes ver gtv26.0</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="icon" href="./images/logo.avif" type="image" />

    <link rel="stylesheet" href="./css/style41.css"> 
     <link rel="stylesheet" href="./css/style.css">

    
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- jquery script-->
   <script
  src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
  integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
  crossorigin="anonymous"></script>

  
</head>
<body>
    
</body>
</html>
