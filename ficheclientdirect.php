<?php
// On démarre une session
require_once "constclient.php";
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
// if (session_status() != PHP_SESSION_ACTIVE) {
//     session_start();
// };
// if (!empty($_SESSION['erreur'])) {
//     echo '<div class="alert alert-danger .alert-dismissible" role="alert">
//     <button type="button" class="close" data-dismiss="alert">&times;</button>
//             ' . $_SESSION['erreur'] . '
//         </div>';
//     $_SESSION['erreur'] = "";
// }
// if (!empty($_SESSION['message'])) {
//     echo '<div class="alert alert-success .alert-dismissible" role="alert">

//     <button type="button" class="close" data-dismiss="alert">&times;</button>
//             ' . $_SESSION['message'] . '
//         </div>';
        
//     $_SESSION['message'] = "";
// }

// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
ini_set("display_errors", 1);
error_reporting(-1);
//require_once('role.php');
// if (!isset($_SESSION['user'])) {
//     header('Location:login.php');
//     exit();
// }
//print_r($_POST);
$email = isset($_GET['email']) && !empty($_GET['email']) ? $_GET['email'] : "";

if ($_POST) {
    if (
        isset($_POST['client']) && !empty($_POST['client'])
        && isset($_POST['tel']) && !empty($_POST['tel'])
        //  && isset($_POST['registre']) && !empty($_POST['registre'])
    
        // isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['adresse']) && !empty($_POST['adresse'])
        && isset($_POST['activite']) && !empty($_POST['activite'])
    ) {



        // On inclut la connexion à la base
        require_once('connectclient.php');
        //pattern="[2][1][3]{1}[5-7]{1}[0-9]{1}[0-9]{7}"
        $client = strip_tags($_POST['client']);
        $client = str_replace( array( '%', '@', '\'', ';', '<', '>','.',',','-') , '', $client);
        $tel = strip_tags($_POST['tel']);
        $tel[0]="3";
        $tel="21".$tel;
        echo $tel;
        echo "<br>";
        // $chaine=preg_match("/[2][1][3]{1}[5-7]{1}[0-9]{1}[0-9]{7}/i",$tel);
        // // echo $chaine;
        // // die();
        // if ($chaine==0) {
        //     $_SESSION['erreur'].="erreur format Telephone";
        //     header("location: ficheclientdirect.php?email=$email");
        //     die();
        // }
        $activite=strip_tags($_POST['activite']);
        $adresse = strip_tags($_POST['adresse']);

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// avant de creer la fiche client s'assurer que cete fiche 
// n'existe pas deja en recoupant le telephone ou le nom
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// connexion base client

// On inclut la connexion à la table client client
require('./connectclient.php');

//$sql = 'SELECT * FROM `client` order by client asc';
// $sql = "SELECT tel,client,id,email FROM `client` where `tel` like '%$tel%' or `client` like '%$client%'";
$sql = "SELECT tel,client,id FROM `client` where `tel` like '%$tel%'";

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclienttel = $query->fetchAll(PDO::FETCH_ASSOC);
//print_r($resultclienttel);

$sql = "SELECT tel,client FROM `client` where `client` like '%$client%'";
$query = $db->prepare($sql);
$query->execute();
echo "<br>";
$resultclientnom = $query->fetchAll(PDO::FETCH_ASSOC);
// print_r($resultclientnom);
// echo "<br>";


require('./closeclient.php');


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// connexion base commandes clients



// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

        $registre = strip_tags($_POST['registre']);
        $idfiscal = strip_tags($_POST['idfiscal']);
        $nis=strip_tags($_POST['nis']);
       
       
        $telsiege=$tel;
        //strip_tags($_POST['telsiege']);
        $art = strip_tags($_POST['art']);
        //$email = $email;
        //echo $email;
        //strip_tags($_POST['email']);
       
        $solde =0; 
        // strip_tags($_POST['solde']);


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// avant de creer la fiche client s'assurer que cete fiche n'existe pas deja en recoupant le telephone ou le nom
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if ($resultclienttel[0]['tel']==$tel) 
    {
        // echo "cette fiche existe $tel $client son mail est $email";
        $id = $resultclienttel[0]['id'];
        require_once('connectclient.php');
        $sql = 'UPDATE `client` SET 
       
        `email`=:email WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        // $query->bindValue(':client', $client, PDO::PARAM_STR);
        // $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        // $query->bindValue(':solde', $solde, PDO::PARAM_STR);
        // $query->bindValue(':registre', $registre, PDO::PARAM_STR);
        // $query->bindValue(':idfiscal', $idfiscal, PDO::PARAM_STR);
        // $query->bindValue(':nis', $nis, PDO::PARAM_STR);
        // $query->bindValue(':activite', $activite, PDO::PARAM_STR);
        // $query->bindValue(':telsiege', $telsiege, PDO::PARAM_STR);
        // $query->bindValue(':art', $art, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        // $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);



        $query->execute();

        $_SESSION['message'] = "Client modifié e-mail ajouté";
        require('closeclient.php');
        header("Location: formclient.php?idclient=$id&nomclient=$client&email=$email");
        die();

    } else
        {  
        //echo "cette fiche n'existe pas $tel $client son mail est $email";

        $sql = 'INSERT INTO `client` (`client`,`tel`,`registre`,`idfiscal`,`art`,`email`,`adresse`,`solde`,`nis`,`activite`,`telsiege`) 
        VALUES (:client,:tel,:registre,:idfiscal,:art,:email,:adresse,:solde,:nis,:activite,:telsiege);';
      

        $query = $db->prepare($sql);

        // $query->bindValue(':id', $id, PDO::PARAM_INT);
 //       $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':client', $client, PDO::PARAM_STR);
        $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        $query->bindValue(':solde', $solde, PDO::PARAM_STR);
        $query->bindValue(':registre', $registre, PDO::PARAM_STR);
        $query->bindValue(':idfiscal', $idfiscal, PDO::PARAM_STR);
        $query->bindValue(':nis', $nis, PDO::PARAM_STR);
        $query->bindValue(':activite', $activite, PDO::PARAM_STR);
        $query->bindValue(':telsiege', $telsiege, PDO::PARAM_STR);
        $query->bindValue(':art', $art, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);


        $query->execute();
        require('closeclient.php');
        
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        require('connectclient.php');
        //print_r($client);
        $sql = "SELECT * FROM `client` WHERE client='$client';";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On "accroche" les paramètre (id)
        // $query->bindValue(':client', $client, PDO::PARAM_INT);

        // On exécute la requête
        $query->execute();

        // On récupère le produit
        $resultclient = $query->fetch();
        $id=$resultclient['id'];

        // print_r($resultclient);
        // die();
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        $_SESSION['message'] .= "Fiche client crée avec succée. ";

        $headers='Content-Type: text/plain; charset=utf-8' . "\r\n";
        $headers .= 'FROM:  contact@global2pub.com';
        $msg = "$client à renseigné une nouvelle Fiche client $tel $activite $email $adresse à ".date('H:i');
        $msgc = "Vous avez renseigné une nouvelle Fiche client $client $tel $activite $email $adresse \r\n Veuillez continuer et renseigner vos imprimés";
       $to=$email;
    
       mail("neioprint@gmail.com", "Nouvelle Fiche client de $client", $msg, $headers);//e-mail envoye pour moi
       if ($to!=""){
       mail($to, "Nouvelle Fiche client de $client", $msgc, $headers);// e-mail envoye au client
       }

        require_once('closeclient.php');
      

        header("Location: formclient.php?idclient=$id&nomclient=$client&email=$email");
        die();
        }
        //header("Location: addnouvelimprime.php?idclient=$resultclient[id]&nomclient=$resultclient[client]");
        //header("Location: loginclient.php?idclient=$resultclient[id]&nomclient=$resultclient[client]");

        // On nettoie les données envoyées
        // $client = strip_tags($_POST['client']);
        // $tel = strip_tags($_POST['tel']);
        // // $prix = strip_tags($_POST['prix']);
        // // $qteMin = strip_tags($_POST['qteMin']);

        // $sql = 'INSERT INTO `client` (`client`, `tel`) VALUES (:client,:tel);';

        // $query = $db->prepare($sql);

        // $query->bindValue(':client', $client, PDO::PARAM_STR);
        // $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        // // $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        // // $query->bindValue(':qteMin', $qteMin, PDO::PARAM_INT);

        // $query->execute();

        // $_SESSION['message'] = "Client ajouté";
        // require_once('closeclient.php');

        // header('Location: indexclient.php?page=1');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veuillez renseigner votre fiche client</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
</head>

<body>
    <!-- < ?php require_once('./navbarok.php') ?> -->
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <h1 class="entete">Veuillez renseigner Votre fiche client</h1>
               
                <form method="post" class="was-validated">
                    <div class="form-group">
                        <label for="client">Entreprise/Société</label>
                        <input type="text" id="client" name="client" minlength="4" maxlength="20" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <label for="tel">Mobile</label>
                        <!-- <input type="tel" id="tel" name="tel" placeholder="mobile seulement exemple 213541035548"class="form-control"  pattern="[2][1][3]{1}[5-7]{1}[0-9]{1}[0-9]{7}" required> -->
                        <input type="tel" id="tel" name="tel" placeholder="mobile seulement exemple 0541035548"class="form-control"  pattern="[0]{1}[5-7]{1}[0-9]{1}[0-9]{7}" required>
                    
                    </div>
                    <div class="form-group">
                    <label for="activite">Activité</label>
                    <input type="text" name="activite"  minlength="4"class="form-control" required>
                </div>
                    <!-- <div class="form-group">
                        <label for="solde">Solde</label>
                        <input type="number" id="solde" name="solde" step="0.01" class="form-control"  ?>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="email">e-mail</label>
                        <input type="email" name="email"  class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label for="adresse">Adresse complete</label>
                        <input type="text" name="adresse"  minlength="6" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- <label for="registre">Registre de commerce (facultatif)</label> -->
                        <input type="hidden" name="registre"  value="vide" class="form-control" >
                    </div>
                    <div class="form-group">
                        <!-- <label for="idfiscal">Identifiant Fiscal (facultatif)</label> -->
                        <input type="hidden" name="idfiscal"  value="vide" class="form-control" hidden>
                    </div>
                    <div class="form-group">
                    <!-- <label for="nis">Nis (facultatif)</label> -->
                    <input type="hidden" name="nis" value="vide"  class="form-control" hidden>
                </div>
                <div class="form-group">
                        <!-- <label for="art">N° Article (facultatif)</label> -->
                        <input type="hidden" name="art"  value="vide" class="form-control" hidden>
                    </div>
               
                <!-- <div class="form-group">
                    <label for="telsiege">Tel siège</label>
                    <input type="text" name="telsiege"  class="form-control" >
                </div> -->
                <br>
                <div class="center">
                <input class="form-check-input" type="checkbox" id="myCheck" name="remember" required>
                <label class="form-check-label" for="myCheck">J'accepte</label>
                <!-- <div class="valid-feedback">Valid.</div> -->
                <!-- <div class="invalid-feedback">Check this checkbox to continue.</div> -->
                </div>
                <p class="center">Je certifie que les informations que je communique sont vrais. <br>

                    <br> 
                    Tous changements ou annulation de la pre-commande doit se faire au plus tard dans <br>
                    les 36H maximum en envoyant un e-mail au neioprint@gmail.com merci. <br>
                    Nous nous donnerons pas suite à cette pre-commande si vous ne disposez pas <br>
                    d'un dossier fiscal.sauf dans le cas de particuiler commandant pour son <br>prpore compte
                    Les informations fiscales peuvent êtres envoyés ultérieurement <br>
                    en nous envoyant votre dossier Fiscal à des fins de facturation et ce avant la <br>
                    livraison.
                
                </p>
                <br>
                    <input type="hidden"  name="id">
                    <button class="btn btn-primary">Valider</button>
                </form>
             
                <!-- <a class="btn btn-success" href="indexclient.php?page=1">Annuler</a> -->
            </section>


        </div>
    </main>
</body>

</html>