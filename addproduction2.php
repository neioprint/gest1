<?php
// On démarre une session
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
ini_set("display_errors", 1);
error_reporting(-1);
//require_once('role.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
//@$idclientSel=isset($_GET['idclient'])?$_GET['idclient']:0;
//@$idcommandeSel=isset($_GET['idcommande'])?$_GET['idcommande']:0;

//@$nomclient=$_SESSION['nomclient'];
//@print_r($_SESSION['idimprime']);
// @$idcommandes=$_SESSION['idcommande'];
require_once('connectmatiere.php');
$sql = 'SELECT * FROM `matiere`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif 
$resultmatiere = $query->fetchAll(PDO::FETCH_ASSOC);
require_once('closematiere.php');

require_once('connectcommande.php');
$sql = "SELECT * FROM `commande` where not (etat like '%5/%') and not (etat like '%6/%') 
and not (etat like '%2/%') and not (etat like '%3/%') and not (etat like '%4/%')";

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif 
$resultcommande = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('closecommande.php');

if ($_POST) {
    if (
        isset($_POST['idcommande']) && !empty($_POST['idcommande'])
        && (isset($_POST['dates']) && !empty($_POST['dates']))
    ) {
        //   print_r($_POST);



        $dates = strip_tags($_POST['dates']);
        $idcommande = strip_tags($_POST['idcommande']);
        $idimprime = strip_tags($_POST['idimprime']);
        $idclient = strip_tags($_POST['idclient']);
        $idmatiere = strip_tags($_POST['idmatiere']);
        $qteaconsommer = strip_tags($_POST['qteaconsommer']);
        $formatcoupe = strip_tags($_POST['formatcoupe']);
        $nbreposecoupe = strip_tags($_POST['nbreposecoupe']);
        $formatTirage = strip_tags($_POST['formatTirage']);
        $nbreposetirage = strip_tags($_POST['nbreposetirage']);
        $nbreplaque = strip_tags($_POST['nbreplaque']);
        $formatchute = strip_tags($_POST['formatchute']);

        $etatprod ="0/En attente";
        //strip_tags($_POST['etatprod']);




        //          print_r($formatxxyy);
        //          echo "<br>";
        // print_r($ptf);
        //         print_r($formatxx);
        //         print_r($formatyy);
        //         //  print_r($formatyy);
        //  die();



        require_once('serveur.php');
        try {
            // Connexion à la base
            if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
            if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
            if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
            $db->exec('SET NAMES "UTF8"');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }

        $sql = 'INSERT INTO 
  `production` 
  (`dates`,`idcommande`,`idimprime`,`idclient`,`idmatiere`,`qteaconsommer`,`formatcoupe`,`nbreposecoupe`,`formatTirage`,`nbreposetirage`,`nbreplaque`,`formatchute`,`etatprod`) 
  VALUES 
  ( :dates,:idcommande,:idimprime,:idclient,:idmatiere,:qteaconsommer,:formatcoupe,:nbreposecoupe,:formatTirage,:nbreposetirage,:nbreplaque,:formatchute,:etatprod);';

        $query = $db->prepare($sql);

        // $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':idcommande', @$idcommande, PDO::PARAM_INT);
        $query->bindValue(':idimprime', @$idimprime, PDO::PARAM_INT);
        $query->bindValue(':idclient', @$idclient, PDO::PARAM_INT);

        $query->bindValue(':idmatiere', @$idmatiere, PDO::PARAM_INT);
        $query->bindValue(':qteaconsommer', @$qteaconsommer, PDO::PARAM_STR);
        $query->bindValue(':formatcoupe', @$formatcoupe, PDO::PARAM_STR);
        $query->bindValue(':nbreposecoupe', @$nbreposecoupe, PDO::PARAM_INT);
        $query->bindValue(':formatTirage', @$formatTirage, PDO::PARAM_STR);
        $query->bindValue(':nbreposetirage', @$nbreposetirage, PDO::PARAM_STR);
        $query->bindValue(':nbreplaque', @$nbreplaque, PDO::PARAM_STR);
        $query->bindValue(':formatchute', @$formatchute, PDO::PARAM_STR);

        $query->bindValue(':etatprod', @$etatprod, PDO::PARAM_STR);



        $query->execute();

        $_SESSION['message'] = "PRODUCTION  Ajouté";
        require_once('closeclient.php');

        header('Location: production.php');
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter production</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <script
  src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
  integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
  crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
</head>

<body>
    <?php require_once('./navbarok.php') ?>
    <?php require_once('./base4.php'); ?>
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
                <h1 class="entete">Ajout de production</h1>
                <form method="post" >
                    <div class="form-group">
                        <label for="dates">Date</label>
                        <input type="date" id="dates" name="dates" class="form-control">
                    </div>
                    <div class="form-group">

                        <label for="idclient">Sélectionner le client dans la liste</label>
                        <br>

                        <select class="form-control" id="idclient" name="idclient" required onchange="selection()">
                            <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->
                           

                            <option value=" " selected>veuillez selectionner un client</option>
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
            //    @$var =  "<script>document.write(var1);</script>" ;
                // On boucle sur la variable result

                // echo $var;
               
             
                foreach($resultclient as $client){

                // var_dump($client);
                ?> 
               
                <option value="<?php echo $client['id'] ?>"
                <?php 
                    //if ($idclientSel==$client['id']) { 
                                                        //echo "selected";
                                                        $_SESSION['nomclient']=$client['client'];

                                                        //print_r($_SESSION['nomclient']);
                                                        //die();
                      //                                  }
                     ?> >
                <?php echo($client['id'].'/'.$client['client']) ?></option>
                <?php
                        }
            
                ?>
                            <!-- < ?php
                            // On boucle sur la variable result

                            foreach ($resultclient as $client) {
                                //   var_dump($client);
                            ?>
                                <option value="< ?php echo  $client['id'] ?>">
                                    < ?php echo ($client['id'] . '/' . $client['client']) ?></option>
                            < ?php
                            }
                            ?> -->
                        </select>

                    

                    </div>
                  
                     <div class="form-group">

                        <label for="client">Sélectionner la commande dans la liste</label>
                        <br>

                        <select class="form-control" id="idcommande" name="idcommande"  required>
                             


                            <!-- <option value=" " selected>veuillez selectionner</option> -->
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
                            // On boucle sur la variable result

                            foreach ($resultcommande as $commande) {
                              if ($idclientSel==$commande['idclient'])  {
                                if ($idcommandeSel==$commande['id']) {
                         
                                                                    echo "selected";
                                                                    $_SESSION['idimprime']=$commande['idimprime']; 
                                                                    $_SESSION['imprime']=$commande['imprime']; 
                                                                    //$_SESSION['idcommande']=$commande['id'];
                                                                     //print_r($_SESSION['idimprime']);
                                                                    //die();
                                                                    }

                            ?>
                                <option value="<?php echo  $commande['id'] ?>">
                                    <?php echo 'Comm N°'.$commande['id']. '//Imprimé N°' . $commande['idimprime'] . '//"' . $commande['imprime']. '"//Quantité ' . $commande['quantite'] ?></option>
                            <?php
                              } 
                         }
                            ?>
                        </select>

                        <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>

                    <div class="form-group">
                        <label for="idimprime">id imprimé</label>
                        <input type="number" id="idimprime" name="idimprime" 
                        value="" class="form-control" readonly>
                    </div>
                    <!-- <div class="form-group">

                        <label for="idimprime"> l'imprimé correspondant à la commande</label>
                        <br>
                       
                        <select class="form-control" id="idimprime" name="idimprime" required>
                          
                           
                            <?php
                            // On boucle sur la variable result

                            foreach ($result as $imprime) {
                                if ($idclientSel==$imprime['idclient'])  {
                              //  if ($_SESSION['idimprime']==$imprime['id'])  {
                                    echo "selected";
                                //   var_dump($client);
                            ?>
                                <option value="<?php echo  $imprime['id'] ?>">
                                    <?php echo ($imprime['id'] . '/' . $imprime['imprime'] . '/' . $imprime['impclient']) ?></option>
                            <?php
                            }
                        }
                            ?>
                        </select>

                        

                    </div> -->

                    <!-- <div class="form-group">
                        <label for="idcommande">id client</label>
                        <input type="number" id="idclient" name="idclient" class="form-control" >
                    </div> -->


                    <!-- <div class="form-group">
                        <label for="idcommande">id matiere</label>
                        <input type="number" id="idmatiere" name="idmatiere" class="form-control" >
                    </div> -->
                    <div class="form-group">

                        <label for="matiere">Sélectionner la matiere dans la liste</label>
                        <br>
                        <!-- select de matiere -->
                        <select class="form-control" id="idmatiere" name="idmatiere" required>
                            <!-- size="< ?= sizeof($resultclient)>5 ? 3 : sizeof($resultclient) ?>" -->


                            <!-- <option value=" " selected>veuillez selectionner</option> -->
                            <!-- <option disabled value="">Sélectionnez votre le client</option>  -->
                            <?php
                            // On boucle sur la variable result

                            foreach ($resultmatiere as $matiere) {
                                //   var_dump($client);
                            ?>
                                <option value="<?php echo  $matiere['idmat'] ?>">
                                    <?php echo ('N°' . $matiere['idmat'] . '/' . $matiere['matiere'] . '/' . $matiere['grammage'] . 'grs') ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <!-- < ?php if ($client['id']==64) echo 'selected'?>     -->

                    </div>

                    <div class="form-group">
                        <label for="qteaconsommer">Qte à consommer</label>

                        <input type="number" name="qteaconsommer" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="formatcoupe">Format coupe</label>
                        <input type="text" name="formatcoupe" class="form-control" pattern="[0-9]{2,3}[x,X]{1}[0-9]{2,3}">
                    </div>

                    <div class="form-group">
                        <label for="nbreposecoupe">Nbre poses coupe</label>
                        <input type="text" name="nbreposecoupe" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="formatTirage">Format tirage</label>
                        <input type="text" name="formatTirage" class="form-control" pattern="[0-9]{2,3}[x,X]{1}[0-9]{2,3}">
                    </div>

                    <div class="form-group">
                        <label for="nbreposetirage">Nb pose Tirage</label>
                        <input type="number" name="nbreposetirage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nbreplaque">Nbre de plaques</label>
                        <input type="number" name="nbreplaque" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="formatchute">Format chute</label>
                        <input type="text" name="formatchute" class="form-control" pattern="[0-9]{2,3}[x,X]{1}[0-9]{2,3}">
                    </div>
                    <!-- <div class="form-group">
                        <label for="periodicite">Grammage</label>
                        <select name="periodicite" id="periodicite" class="form-control">
                        <option value="jour">Quantité</option>
                        <option value="semaine">Semaine</option>
                        <option value="mois">Mois</option>
                        <option value="ponctuelle">Ponctuelle</option>

                        </select> -->
                    <!-- <input type="text" name="periodicite"  class="form-control"> -->
                    <!-- </div> -->
                    <!-- <div class="form-group">
                        <label for="montant">Montant</label>
                        <input type="text" name="montant"  class="form-control">
                        </div> -->



                    <!-- <input type="hidden" value="< ?= $client['id']?>" name="id"> -->
                    <!-- <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">

                    </div> -->
                    <!-- <div class="form-group">
                        <label for="qteMin">Qte Min</label>
                        <input type="number" id="qteMin" name="qteMin" class="form-control">
                    </div> -->
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
                <br>
                <a class="btn btn-success" href="production.php">Annuler</a>
            </section>


        </div>
    </main>
    <script>
                            function  selection() {
                            // Creating a cookie after the document is ready
                            // $(document).ready(function () {
                                
                            //     createCookie("idclient", document.getElementById("idclient").value, "1");
                            //     // createCookie("idcommande", document.getElementById("idcommande").value, "1");
                            // });
                                
                            // // Function to create the cookie
                            // function createCookie(name, value, days) {
                            //     var expires;
                            //     // var var1=document.getElementById("client").value;
                                    
                            //     if (days) {
                            //         var date = new Date();
                            //         date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                            //         expires = "; expires=" + date.toGMTString();
                            //     }
                            //     else {
                            //         expires = "";
                            //     }
                                    
                            //     document.cookie = escape(name) + "=" + 
                            //         escape(value) + expires + "; path=/";
                            // }
                            
                            // console.log(var1);
                        // window.location.href="addproduction.php?idclient="+document.getElementById("idclient").value+
                        // "&idcommande="+document.getElementById("idcommande").value+
                        // "&idimprime="+document.getElementById("idimprime").value;
                        window.location.href="addproduction.php";
                            //$_COOKIE["idclient"];
                            
                        }
                            
                            </script>
</body>

</html>