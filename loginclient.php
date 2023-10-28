<?php
session_start();

$_SESSION['sms'] = 0;
//echo $_SESSION['sms'];


//echo $_SESSION['sms'];
//die();


// require_once './vendor/autoload.php';

// require_once 'google/src/autoload.php';

unset($_SESSION['trouve']);
unset($_SESSION['email']);
if (!empty($_SESSION['erreur'])) {
  echo '<div class="alert alert-danger" role="alert" .alert-dismissible">' . $_SESSION['erreur'] . '
        </div>';
  $_SESSION['erreur'] = "";
}


$_SESSION['language'] = "FR";

if ($_SESSION['language'] == "FR") {
  define("LANGUE", "🇩🇿");
  define("GEST", "Gest'");
  define("IMPRIM", "imprim");
  define("COMMANDE", "commande");
  define("POINTAGE", "Pointage");
  define("MESSAGE", "Message");
  define("PRODUCTION", "Production");
  define("RELEVE", "Releve");
  define("CLIENT", "Client");
  define("CLIENTS", "Clients");
  define("UTILISATEUR", "Utilisateur");
  define("SEDECONNECTER", "Se déconnecter");
  define("ESPACE", "Espace Client");
  // define("PRODUCTION","Production");


  // العملاء
// إنتاج
// عميل
// مستخدم
//   منطقة العملاء 
} else
  if ($_SESSION['language'] == "AR") { {
      define("ESPACE", "منطقة العملاء");
      define("LANGUE", "🇫🇷");
      define("GEST", "Gest'");
      define("IMPRIM", "imprim");
      define("COMMANDE", "الطلب");
      define("POINTAGE", "دخول العمل");
      define("MESSAGE", "رسالة");
      define("PRODUCTION", "انتاج");
      define("RELEVE", "كشف الدخول");
      define("CLIENT", "عميل");
      define("CLIENTS", "العملاء");
      define("UTILISATEUR", "مستخدم");
      define("SEDECONNECTER", "تسجيل الخروج");

      // define("PRODUCTION","إنتاج");
    }
  }
// echo "<br>";
// echo "<br>";
// echo "<br>";
// echo "<br>";
// print_r($_COOKIE);
// echo "<br>";
// print_r($_POST);
// if (!empty($_POST['credential'])) {

//     if (empty($_COOKIE['g_csrf_token'])
//     || empty($_POST['g_csrf_token'])
//     || ($_COOKIE['g_csrf_token'] !=$_POST['g_csrf_token'])
//     )
//     {
//         echo "erreur auhentification";
//         die();
//     }
// }
// echo "<br>";
// // 38832248303-u8g069aj217jm43pre72l401b9ttouvi.apps.googleusercontent.com
//  $clientId="38832248303-u8g069aj217jm43pre72l401b9ttouvi.apps.googleusercontent.com";
//  $client = new Google_Client(['client_id' => $clientId]);  // Specify the CLIENT_ID of the app that accesses the backend
//  $idToken=$_POST['credential'];
// $payload = $client->verifyIdToken($idToken);
// if ($payload) {
//     print_r($payload);
//   $userid = $payload['sub'];
//   // If request specified a G Suite domain:
//     echo "ok connecté";
//   //$domain = $payload['hd'];
// } else {
//   // Invalid ID token
//   echo "prob";
// }



// include your composer dependencies

// $client = new Google\Client();
// $client->setApplicationName("Client_Library_Examples");
// $client->setDeveloperKey("YOUR_APP_KEY");

// $service = new Google\Service\Books($client);
// $query = 'Henry David Thoreau';
// $optParams = [
//   'filter' => 'free-ebooks',
// ];
// $results = $service->volumes->listVolumes($query, $optParams);

// foreach ($results->getItems() as $item) {
//   echo $item['volumeInfo']['title'], "<br /> \n";
// }


// csrf_token_cookie = self.request.cookies.get('g_csrf_token')
// if not csrf_token_cookie:
//     webapp2.abort(400, 'No CSRF token in Cookie.')
// csrf_token_body = self.request.get('g_csrf_token')
// if not csrf_token_body:
//     webapp2.abort(400, 'No CSRF token in post body.')
// if csrf_token_cookie != csrf_token_body:
//     webapp2.abort(400, 'Failed to verify double submit cookie.')



if (!empty($_SESSION['message'])) {
  echo '<div class="alert alert-success" role="alert" .alert-dismissible">
            ' . $_SESSION['message'] . '</div>';
  $_SESSION['message'] = "";
}
//if (isset($_SESSION['trouve'])) header("url=formclient.php?idclient=$_SESSION[idclient]&nomclient=$_SESSION[client]");
// $refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
//                             $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// //echo $refreshButtonPressed;
// if ($refreshButtonPressed==1) die();
$erreur = isset($_GET['erreur']) ? $_GET['erreur'] : 0;
if ($erreur == 1) {
  setcookie('aleatoire', 0, time() - 3600, "/"); // 86400 = 1 day
  setcookie('login', 0, time() - 3600, "/"); // 86400 = 1 day
}
if (isset($_COOKIE['aleatoire']) && isset($_COOKIE['login'])) {

  header('Location:seconnecterclient.php?cookie=1');
  die();
  // setcookie('aleatoire', $aleatoire, time() + (900), "/"); // 86400 = 1 day
  // setcookie('login', $login, time() + (900), "/"); // 86400 = 1 day
}

?>
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo2.png" type="image" />
    <title>Se connecter</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script defer data-domain="neio.global2pub.com" src="https://plausible.io/js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
  </head>

  <body>
    <?php require_once('./navbarok.php') ?>
    <!-- use GuzzleHttp\Client; -->
    <!-- <div id="g_id_onload"
     data-client_id="38832248303-u8g069aj217jm43pre72l401b9ttouvi.apps.googleusercontent.com"
     data-context="signin"
     data-ux_mode="popup"
     data-login_uri="http://localhost:7000/loginclient.php"
     data-auto_prompt="false">
</div>

<div class="g_id_signin"
     data-type="standard"
     data-shape="rectangular"
     data-theme="filled_blue"
     data-text="signin_with"
     data-size="medium"
     data-logo_alignment="left">
</div> -->
    <div class="container">
      <!-- <div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4"> -->
      <!-- <img  src="./images/logo.avif" alt="logo global2pub" width="150" height="auto"> -->
      <div class="centerimage">
        <!-- <img src='./images/annonce2.png' width='100%' height='auto'> -->
      </div>
      <h1 class="entete1 animate__animated animate__fadeInRight">ساهلة ماهلة باش تكموندي</h1>
      <h1 class="entete1 animate__animated animate__fadeInRight"> مطبوعاتك علي النت في الجزائر</h1>
      <h1 class="entetefr animate__animated animate__fadeInLeft">Il n'a jamais été aussi Facile,<h1>
          <h1 class="entetefr animate__animated animate__fadeInLeft"> de commander un imprimé en ligne en Algerie</h1>
          <div class="card">
            <!-- <div class="panel-heading">Se connecter à l'Espace Client</div> -->
            <!-- <div class="panel panel-primary"> -->
            <div class="card-header  text-bg-primary">Se connecter à l'Espace Client</div>
            <div class="card-body bg-light">
              <br>
              <form method="post" id="commande-form" name="fo" action="seconnecterclient.php" class="was-validated">
                <!-- < ?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">p
                        < ?php echo $erreurLogin ?>
                    </div>
                < ?php } ?> -->
                <div class="form-group">
                  <!-- <label style="color:black" for="login">Votre e-mail</label> -->
                  <input type="email" name="login" placeholder="Entrez votre e-mail" required class="form-control" />
                </div>
                <div class="form-group">
                  <!-- <label for="pwd">Code de sécurité :</label> -->
                  <input type="number" name="aleatoire" value=<?= rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) ?>
                    hidden />
                </div>
                <div class="form-group">
                  <!-- <label for="pwd">Code de sécurité :</label> -->
                  <input type="number" name="pasdecookie" value="1" ; hidden />
                </div>
                <br>
                <button type="submit" class="btn btn-primary">
                  <span class="glyphicon glyphicon-log-in"></span> Valider. <br>
                </button>
                <!-- <p class="text-right">
                    <a href="initialiserPwd.php">Mot de passe Oublié</a>

                    &nbsp &nbsp

                    <a href="nouvelUtilisateur.php">Créer un compte</a>
                </p> -->
              </form>
            </div>
          </div>
          <h2 class="entete1 animate__animated animate__fadeInRight">ادخل بريدك الالتروني</h2>
          <h2 class="entete1 animate__animated animate__fadeInRight">دخل معلوماتك و المطبوع اللي لازمك</h2>
          <h2 class="entete1 animate__animated animate__fadeInRight">اطلب ثمن للمطبوع</h2>
          <h2 class="entete1 animate__animated animate__fadeInRight">تصلك رسالة الكترونية سريعا</h2>
          <h2 class="entetefr animate__animated animate__fadeInLeft">Connectez vous en entrant <br>votre e-mail</h2>
          <h2 class="entetefr animate__animated animate__fadeInLeft"> Renseignez votre fiche client & imprimé.</h2>
          <h2 class="entetefr animate__animated animate__fadeInLeft"> Demandez un Devis ou proforma</h2>
          <h2 class="entetefr animate__animated animate__fadeInLeft"> Vous recevrez votre offre <br> sur votre e-mail
            rapidement! </h2>
          <br>
          <!-- <img src='./images/banniere3.gif' width='100%' height='auto'> -->
          <!-- <img src='./images/soucidimpression.jpg' width='100%' height='auto'> -->
          <!-- <img src='./images/annonce2.png' width='100%' height='auto'> -->
    </div>
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      </div>
      <!-- The slideshow/carousel -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src='./images/soucidimpression.jpg' alt="Los Angeles" class="d-block w-100">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="carousel-item">
          <img src='./images/annonce2.png' alt="Chicago" class="d-block w-100" data-bs-interval="2000">
        </div>
        <div class="carousel-item">
          <img src='./images/banniere3.gif' alt="New York" class="d-block w-100">
        </div>
        <!-- <div class="carousel-item">
      <img src='./images/visuimprimerieNEIO.jpg' alt="New York" class="d-block w-100"> -->
        <!-- </div> -->
      </div>
      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
    <!-- <script src="https://accounts.google.com/gsi/client" async></script> -->
  </body>

</html>