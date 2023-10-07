<?php

require_once "const.php";

if (!empty($_SESSION['message'])) {
    
    echo '<div class="alert alert-success .alert-dismissible" role="alert">

    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['message'] . '
        </div>';
        
  
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
    echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
            ' . $_SESSION['erreur'] . '
        </div>';
  
        $messageJson=json_encode($_SESSION['erreur']);?>
<script>
    let message=JSON.parse('<?php echo $messageJson; ?>');
            probtravail(message)
            </script>`; 
<?php
    $_SESSION['erreur'] = "";

}

if ($_POST) {
    if (isset($_POST['client']) && !empty($_POST['client']))
    // && isset($_POST['prix']) && !empty($_POST['prix'])

    {
        // On inclut la connexion à la base
        require_once('connectclient.php');
        // $id = strip_tags($_POST['id']);
        // $client = strip_tags($_POST['client']);
        // $tel = strip_tags($_POST['tel']);
        // $registre = strip_tags($_POST['registre']);
        // $idfiscal = strip_tags($_POST['idfiscal']);
        // $art = strip_tags($_POST['art']);
        // $email = strip_tags($_POST['email']);
        // $adresse = strip_tags($_POST['adresse']);
        // $solde = strip_tags($_POST['solde']);
        // $sql = 'INSERT INTO `client` `client,
        // `tel`,`registre`,`idfiscal`,
        // `art`,`email`,`adresse`';
        $id = strip_tags($_POST['id']);
       
        $client = strip_tags($_POST['client']);
        echo "original";
        echo $client;
        $client = str_replace( array( '%', '@', '\'', ';', '<', '>','.',',','-'), '', $client);
        // echo "<br>";
        // echo $client;

        // die();
        $tel = strip_tags($_POST['tel']);
        $tel[0]="3";
        $tel="21".$tel;
        // echo $tel;
        // echo "<br>";
        $chaine=preg_match("/[2][1][3]{1}[5-7]{1}[0-9]{1}[0-9]{7}/i",$tel);
        // echo $chaine;
        // die();
        if ($chaine==0) {
            $_SESSION['erreur'].="erreur format Telephone";
            header("location: addclient.php");
            die();
        }


        $registre = strip_tags($_POST['registre']);    $res = str_replace( array( '%', '@', '\'', ';', '<', '>' ), ' ', $str);
        $idfiscal = strip_tags($_POST['idfiscal']);
        $nis=strip_tags($_POST['nis']);
        $activite=strip_tags($_POST['activite']);
        $telsiege=strip_tags($_POST['telsiege']);
        $art = strip_tags($_POST['art']);
        $email = strip_tags($_POST['email']);
        $email=strtolower($email);
        $adresse = strip_tags($_POST['adresse']);
        $solde = strip_tags($_POST['solde']);
        $sql = 'INSERT INTO `client` (`client`,`tel`,`registre`,`idfiscal`,`art`,`email`,`adresse`,`solde`,`nis`,`activite`,`telsiege`) 
  VALUES (:client,:tel,:registre,:idfiscal,:art,:email,:adresse,:solde,:nis,:activite,:telsiege);';


// `client`=:client,
//         `tel`=:tel,`registre`=:registre,`idfiscal`=:idfiscal,
//         `art`=:art,`email`=:email,`adresse`=:adresse,`solde`=:solde,`nis`=:nis,`activite`=:activite,`telsiege`=:telsiege


        $query = $db->prepare($sql);
        //$query->bindValue(':id', $id, PDO::PARAM_INT);
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
        // $query->bindValue(':id', $id, PDO::PARAM_INT);
        // $query->bindValue(':client', $client, PDO::PARAM_STR);
        // $query->bindValue(':tel', $tel, PDO::PARAM_STR);

        // $query->bindValue(':registre', $registre, PDO::PARAM_STR);
        // $query->bindValue(':idfiscal', $idfiscal, PDO::PARAM_STR);
        // $query->bindValue(':art', $art, PDO::PARAM_STR);
        // $query->bindValue(':email', $email, PDO::PARAM_STR);
        // $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        // $query->bindValue(':solde', $solde, PDO::PARAM_STR);


        $query->execute();

        $_SESSION['message'] = "Client  Ajouté";
        require_once('closeclient.php'); ?>
        <!-- <button class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de Bienvenue</button> -->
        <!-- <button class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de Bienvenue</button> -->

<?php
        header('Location: indexclient.php?page=1');
die();



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
        header('Location: addclient.php?page=1');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css"> -->

    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script> -->

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</head>

<body class="container">
    <?php require_once('./navbarok.php') ?>
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
                <h1 class="entete">Ajouter un client</h1>
                <form id="commande-form" name="fo" method="post" class="was-validated">
                    
                    <div class="form-group">
                        <label class="form-label" for="client">Client</label>
                        <input type="text" id="client" name="client" class="form-control"  required>
                        <!-- <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div> -->
                    </div>
                    
                    <!-- pattern="[2][1][3]{1}[5-7]{1}[0-9]{1}[0-9]{7}" -->
                    <div class="form-group">
                        <label for="tel">Telephone</label>
                        <input type="tel" id="tel" name="tel" class="form-control"  pattern="[0]{1}[5-7]{1}[0-9]{1}[0-9]{7}"
                        
                      required>
                    </div>
                    <div class="form-group">
                        <label for="solde">Solde</label>
                        <input type="number" id="solde" name="solde" step="0.01" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <label for="email">e-mail</label>
                        <input type="email" name="email"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="registre">Registre de commerce</label>
                        <input type="text" name="registre"  class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="idfiscal">Identifiant Fiscal</label>
                        <input type="text" name="idfiscal"  class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="nis">Nis</label>
                    <input type="text" name="nis"  class="form-control" >
                </div>
                <div class="form-group">
                    <label for="activite">Activité</label>
                    <input type="text" name="activite"  class="form-control" >
                </div>
                <div class="form-group">
                    <label for="telsiege">Tel siège</label>
                    <input type="text" name="telsiege"  class="form-control" >
                </div>
                    <div class="form-group">
                        <label for="art">N° Article</label>
                        <input type="text" name="art"  class="form-control">
                    </div>

                    <input type="hidden"  name="id">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
                <br>
                <a class="btn btn-success" href="indexclient.php?page=1">Annuler</a>
            </section>

            <!-- <button class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de Bienvenue</button> -->

        </div>
    </main>
    <!-- <script src="sweetalert2.all.min.js"></script> -->

    <!-- <script>
   
        Swal.fire(
  'Bienvenue!',
  'à vous cher ami!',
  'success'
)
</script> -->
    <!-- <script>
        function envoisms() {


            Swal.fire({
                title: 'Envoi Sms de Bienvenue?',
                text: "Etes vous sûr?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Envoyer!',
                cancelButtonText: 'Annuler',
                width: '20em'
            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire(
                        'En cours!',
                        '',
                        'success'
                    );




                    // document.location.href = 'sms/envoismsok.php?idclient=< ?= $id ?>&message=Bienvenue sur la plateforme de commande en ligne NEIO pour plus de renseignements appeler le 0541 03 55 48';
                    //  document.location.href='sms/envoismsok.php?idclient=< ?= $trieclientid ?>&message=Le < ?= $datebl ?> Cher < ?= $nomclient ?> Votre commande < ?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.';



                }
            })
        }
    </script> -->
</body>

</html>