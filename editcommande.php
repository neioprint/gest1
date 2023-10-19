<?php
// version fonctionnelle copié le 1 sep 2023 sous le nom editcommande00.php
require_once "const.php";
// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {

    require('connectcommande.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `commande` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $commande = $query->fetch();

    // On vérifie si le produit existe
    if (!$id) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header("Location: indexcommande.php?page=$page");
        die();
    } else {
        // memoriser l'ancienne valeur de la commande avant modification
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        $ancientotal = $commande['total'];
        $_SESSION['ancientotal'] = $ancientotal;

        
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header("Location: indexcommande.php?page=$page");
    die();
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//$page=intval($page);
if (@$_POST['submit']) {

    if (
        isset($_POST['id']) && !empty($_POST['id']) &&
        isset($_POST["dates"]) && !empty($_POST["dates"]) &&
        isset($_POST["idclient"]) && !empty($_POST["idclient"]) &&
        isset($_POST["quantite"]) && !empty($_POST["quantite"]) &&
        isset($_POST["prix"]) &&

        isset($_POST["remarque"]) && !empty($_POST["remarque"])
        //&&
        //    isset($_POST["etat"]) && !empty($_POST["etat"]) &&
        // isset($_POST["paiement"]) && !empty($_POST["paiement"]) &&
        // isset($_POST["prepress"])
        //&& !empty($_POST["prepress"]) remarque 0 est considere comme non empty(vide)
    ) {

    //     echo '<pre>';
    //     print_r($_POST);
    //    echo '</pre>';
        
        // On inclut la connexion à la base
        
       

        // On nettoie les données envoyées

        $id = strip_tags($_POST['id']);

        $dates = strip_tags($_POST['dates']);
        $idclient = strip_tags($_POST['idclient']);
        $nomclient = strip_tags($_POST['nomclient']);
        $idimprime = strip_tags($_POST['idimprime']);
        $imprime = strip_tags($_POST['imprime']);
        $quantite = strip_tags($_POST['quantite']);
        $prix = strip_tags($_POST['prix']);
     /*   echo $prix;
         echo "<br>";
         echo $_SESSION['prix'];
         echo "<br>";*/
       

        
        $prepress = strip_tags($_POST['prepress']);
        // $total= strip_tags($_POST['total']);
        $total = $prix * $quantite + $prepress;
        $etat = strip_tags($_POST['etat']);
        $remarque = strip_tags($_POST['remarque']);
        // $tag = strip_tags($_POST['tag']);

        //$solde = 0;
        //strip_tags($_POST['solde']);
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        // acceder à la table client enlever l'ancien montant rajouter le nouveau montant
        $etatsuivi = explode("/", $etat);
        $etatsuivi = $etatsuivi[0];


        // connexion imprimes
        require('connect.php');
        // On nettoie l'id envoyé
        $id0 = $idimprime;
        //echo $id0;
        //die();
        $sql = 'SELECT * FROM `imprimes` WHERE `id` = :id0';
    
        // On prépare la requête
        $query = $db->prepare($sql);
    
        // On "accroche" les paramètre (id)
        $query->bindValue(':id0', $id0, PDO::PARAM_INT);
    
        // On exécute la requête
        $query->execute();
    
        // On récupère le produit
        $imprime0 = $query->fetch();
        $result=$imprime0;
        //print_r($imprime0);
      
        $imprime=$imprime0['imprime'];
   //     die();



        if ($etatsuivi == 3) {
            require('./connectclient.php');

            //$sql = 'SELECT * FROM `client` order by client asc';
            $sql = 'SELECT * FROM `client` WHERE `id` = :idclient';
            // On prépare la requête
            $query = $db->prepare($sql);
            $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);
            // On exécute la requête
            $query->execute();

            // On stocke le résultat dans un tableau associatif
            $resultclient = $query->fetch(PDO::FETCH_ASSOC);
            $solde = ($resultclient['solde'] - $_SESSION['ancientotal']) + $total;


            $sql = 'UPDATE `client` SET `solde`=:solde WHERE `id`=:idclient;';

            $query = $db->prepare($sql);

            $query->bindValue(':idclient', $idclient, PDO::PARAM_INT);

            $query->bindValue(':solde', $solde, PDO::PARAM_STR);




            $query->execute();

            $_SESSION['message'] .= " Solde modifié  ";
            require('./closeclient.php');
        }
        
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        //$typ = @$result['typ'];
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        echo "<pre>";
        print_r($commande);
        echo "</pre>";
        if ($commande['etapesvalidee']=="") 
            {
            $chaine = @$result['etapes'];
            $chainedecoupe = explode(",", $chaine);
            //$typdecoupe = explode(",", $typ);
            $compt = count($chainedecoupe);
            //$compt0 = count($typdecoupe);
            $tabsuivi=[[]];
            //$chainedecoupe;
            for ($i=0; $i <$compt ; $i++) { 
                $tabsuivi[$i][0]=0;
                $tabsuivi[$i][1]="";
                $tabsuivi[$i][2]="";

            }       
            $tabsuivi=array($tabsuivi);
            echo "<pre>";
            print_r($tabsuivi);
            echo "</pre>";
            echo "<br>";
            $etapesvalidee=serialize($tabsuivi);
            print_r($etapesvalidee);
            // die();       
        } else $etapesvalidee="";
        // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        die();
        //UPDATE `pointage` SET `sortie2` = '17:00' WHERE `pointage`.`id` = 509;


          
        require('connectcommande.php');
        $sql = 'UPDATE `commande` SET `dates`=:dates, `idclient`=:idclient, `nomclient`=:nomclient,
        `idimprime`=:idimprime, `imprime`=:imprime, `quantite`=:quantite, `prix`=:prix,  `prepress`=:prepress, `total`=:total, 
        `remarque`=:remarque,`etapesvalidee`=:etapesvalidee WHERE  `id`=:id;';
// $sql = 'UPDATE `commande` SET `dates`=:dates, `idclient`=:idclient, `nomclient`=:nomclient,
// `idimprime`=:idimprime, `imprime`=:imprime, `quantite`=:quantite, `prix`=:prix,  `prepress`=:prepress, `total`=:total, 
// `remarque`=:remarque,`tag`=:tag WHERE  `id`=:id;';


        // $sql = 'UPDATE `imprimes` SET `imprime`=:imprime, `qteMin`=:qteMin WHERE `id`=:id;';
        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':idclient', $idclient, PDO::PARAM_STR);
        $query->bindValue(':nomclient', $nomclient, PDO::PARAM_STR);
        $query->bindValue(':idimprime', $idimprime, PDO::PARAM_STR);
        $query->bindValue(':imprime', $imprime, PDO::PARAM_STR);
        $query->bindValue(':quantite', $quantite, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':prepress', $prepress, PDO::PARAM_STR);
        $query->bindValue(':total', $total, PDO::PARAM_STR);
        $query->bindValue(':remarque', $remarque, PDO::PARAM_STR);
        $query->bindValue(':etapesvalidee', $etapesvalidee, PDO::PARAM_STR);

        // $query->bindValue(':tag', $tag, PDO::PARAM_INT);


        //$query->bindValue(':solde', $solde, PDO::PARAM_INT);
        // $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        // $query->bindValue(':etatseq', $etatseq, PDO::PARAM_STR);
        // $query->bindValue(':paiement', $paiement, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] .= "Commande modifiée.";
        require('closecommande.php');
        // print_r($prix);
        // die();
        //print_r($ancientotal);
        //print_r($_SESSION['ancientotal']);
        //die();

        header("Location: indexcommande.php?page=$page");
        //  }
    } else {
        $_SESSION['erreur'] .= "Le formulaire est incomplet";
    }
// ici
if ($prix != $_SESSION['prix']) {

    //echo "entre";
        
            require('connectclient.php');
    //echo $idclient;
    $idd=$idclient;
            // On nettoie l'id envoyé
        
            //strip_tags($_GET['id']);
        
    $sql = 'SELECT * FROM `client` WHERE `id` = :idd;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':idd', $idd, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $client = $query->fetch();
    $_SESSION['message'] .= " Prix Modifié & Mail envoyé ";
    header("Location: invoice/envoimailpj.php?idc=$id&dates=$dates&idclient=$idclient&nomclient=$nomclient&idimprime=$idimprime&imprime=$imprime&quantite=$quantite&prix=$prix&email=$client[email]");
    die();
/*print_r($client);
die();*/

    // On vérifie si le produit existe
    // if (!$client) {
    //     $_SESSION['erreur'] = "Cet id n'existe pas";
    //     header('Location: indexclient.php');
    // }

//     else {
//     $_SESSION['erreur'] = "URL invalide";
//     header('Location: indexclient.php');
// }
// debut partie envoi mail au client
//  if($client['email']!="") {
  
//                         $_SESSION['message'] .= "Changement de prix  <br>";
//                         //echo "entre";
//                         //die();
//                     // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//                     //$destinataire='neioprint@gmail.com';
//                     $to=$client['email'];
//                     // $to='neioprint@gmail.com';
//                     $from='contact@global2pub.com';
//                     //$sujet='Message avec piece jointe';
//                     $sujet='Urgent Prioritaire Changement de prix $nomclient';
//                     $chemin_fichier= 'doc.pdf'; // chemin relatif par rapport au fichier de script envoyant l'email, j'ai pas testé en chemin absolu
//                     //$message='Voici un message (format texte) avec une piece jointe ';
//                     $msg = 'Mr $nomclient le prix de votre commande à été evalué à $prix DZ';
//                     $boundary = "_".md5 (uniqid (rand()));

//                     //on selectionne le fichier à partir d'un chemin relatif 
//                         $attached_file = file_get_contents($chemin_fichier); //file name ie: ./image.jpg
//                         $attached_file = chunk_split(base64_encode($attached_file));
//                     //on recupere ici le nom du fichier
//                         $pos=strrpos($chemin_fichier,"/");
//                         if($pos!==false)$file_name=substr($chemin_fichier,$pos+1);
//                         else $file_name=$chemin_fichier;

//                     //on recupere ici le type du fichier
//                         $pos=strrpos($chemin_fichier,".");
//                         if($pos!==false)$file_type="/".substr($chemin_fichier,$pos+1);
//                         else $file_type="";

//                         //echo "file_type=$file_type";
//                         $attached = "\n\n". "--" .$boundary . "\nContent-Type: application".$file_type."; name=\"$file_name\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$file_name\"\r\n\n".$attached_file . "--" . $boundary . "--";

//                     //on formate les headers
//                         $headers ="From: ".$from." \r\n";
//                         $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

//                     //on formate le corps du message
//                         $body = "--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\n".$msg . $attached;

//                     //on envoie le mail
//                     $res = mail($to,$sujet,$body,$headers);
//                     // if ($res) echo $res;
//                     // die();
//                     // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
           
//                     //$headers='Content-Type: text/plain; charset=utf-8' . "\r\n";
//                     // $headers .= 'FROM:  contact@global2pub.com';
//                     //$msg = "Mr $nomclient le prix de votre commande à été evalué à $prix DZ";
    
//                     // $to=$client['email'];
//                     // echo $to;
//                     // die();
//                     //"neioprint@gmail.com";// e mail du client
//                     //mail($to, $sujet, $msg, $headers);
//                       require('./closeclient.php');

//                     }
// fin partie envoi mail
}
}




// print_r($ancientotal);
// print_r($_SESSION['ancientotal']);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Modifier commande</title>
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <?php
    // require_once('./head.php');
    require_once('./navbarok.php')
    ?>

</head>

<body>
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
                <h1 class="entete">Modifier une commande</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="id">Id Commande</label>
                        <input type="number" name="id" class="form-control" value="<?= $commande['id'] ?>" name="id" readonly>
                    </div>
                    <?php
                    if ($_SESSION['user']['role'] == 'ADMIN') {
                    ?>

                        <div class="form-group">

                             <label for="dates">Date</label>
                            <input type="date" id="dates" name="dates" class="form-control" value="<?= $commande['dates'] ?>">

                         <!-- <div class="form-group">
                                <label for="tag">TAG Commande</label>
                                <select style="color:red !important" name="tag" class="form-control" id="tag">
                                   
                                    <option value="0">Commande en attente ====>0</option>
                                    <option value="1">Commande programmée ====>1</option>
                                    <option value="11">Commande terminé non livrés ===>11</option>
                                    <option value="10">Commande archivés payés =====>10</option>
                                </select>
                            </div>  -->

                        <?php } else { ?>
                            <label for="dates">Date</label>
                            <input style="color:red !important" type="text" id="dates" name="dates" class="form-control" value="<?= $commande['dates'] ?>" rendonly>

                        <?php }

                        ?>

                        <div class="form-group">
                            <label for="idclient">Id Client</label>
                            <input type="number" id="idclient" name="idclient" class="form-control" value="<?= $commande['idclient'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nomclient">Nom Client</label>
                            <input type="text" id="nomclient" name="nomclient" class="form-control" value="<?= $commande['nomclient'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="idimprime">ID Imprime</label>
                            <input type="number" id="idimprime" name="idimprime" class="form-control" value="<?= $commande['idimprime'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="imprime">Imprime</label>
                            <input type="text" id="imprime" name="imprime" class="form-control" value="<?= $commande['imprime'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input style="color:red !important" type="number" min="0" id="quantite" name="quantite" class="form-control" value="<?= $commande['quantite'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <?php $_SESSION['prix']=$commande['prix']; ?>
                            <input style="color:red !important" type="number" min="0" step="0.01" id="prix" name="prix" class="form-control" value="<?= $commande['prix'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="prepress">PrePress</label>
                            <input style="color:red !important" type="number" min="0" id="prepress" name="prepress" class="form-control" value="<?= $commande['prepress'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="total">total</label>
                            <input type="number" min="0" id="total" name="total" class="form-control" value="<?= $commande['total'] ?>" readonly>
                        </div>

                        <!-- <div class="form-group">
                            <label for="total">etat</label> -->
                        <input type="hidden" id="etat" name="etat" class="form-control" value="<?= $commande['etat'] ?>">
                        <!-- </div> -->


                        <div class="form-group">
                            <label for="remarque">Remarque</label>
                            <input style="color:red !important" type="text" id="remarque" name="remarque" class="form-control" value="<?= $commande['remarque'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="remarque">Solde</label>
                            <input type="number" min="0" step="0.01" id="solde" name="solde" class="form-control" value="<?= $commande['solde'] ?>" readonly>
                        </div>

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- <div class="form-group">


                            <fieldset>
                                <legend>Etats Commandes < ?= $commande['etat'] ?></legend>
                                <input type="radio" id="etat" name="etat" value="0/En attente">
                                <label for="etat">En Attente</label>
                                <input type="radio" id="etat" name="etat" value="1/En cours">
                                <label for="etat">En cours</label>
                                <input type="radio" id="etat" name="etat" value="2/Terminé">
                                <label for="etat">Terminé</label> <br>
                                <input type="radio" id="etat" name="etat" value="3/Livrée">
                                <label for="etat">Livrée</label>
                                <br>
                                <input type="radio" id="etat" name="etat" value="4/Annulée">
                                <label for="etat">Annulée</label>
                                <input type="radio" id="etat" name="etat" value="5/Archivée">
                                <label for="etat">Archivée</label>
                                <br>
                                <input type="radio" id="etat" name="etat" value="6/Proforma">
                                <label for="etat">Proforma</label>
                            </fieldset>
                        </div>
                        < ?php $etatsuivi = $commande['etat'];

                        $etatsuivi = explode("/", $etatsuivi);
                        //print_r ($commande['etat']);
                        $etatsuivi = $etatsuivi[0];
                        ?>
                        <script>
                            var vari = < ?php echo json_encode($etatsuivi); ?>;
                            // console.log(vari);
                            var elts = document.querySelectorAll('#etat');
                            //console.log(elts);
                            elts[vari].checked = true;
                        </script> -->

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                        <!-- <div class="form-group">
                        <label for="etat">Etat</label>
                        <input type="text" id="etat" name="etat" class="form-control" value="< ?= $commande['etat']?>"  >
                    </div> -->
                        <!-- <div class="form-group">
                        <label for="paiement">Paiement</label>
                        <input type="text" id="paiement" name="paiement" class="form-control" value="< ?= $commande['paiement']?>"  >
                    </div> -->
                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

                        <!-- <div class="form-group">
                            <fieldset>
                                <legend>Paiement < ?= $commande['paiement'] ?></legend>
                                <input type="radio" id="paiement" name="paiement" value="0/Non payée">
                                <label for="paiement">Non payée</label>

                                <input type="radio" id="paiement" name="paiement" value="1/Payé">
                                <label for="paiement">Payée</label>

                                <input type="radio" id="paiement" name="paiement" value="2/Avance">
                                <label for="paiement">Avance</label>
                                <br>
                                <input type="radio" id="paiement" name="paiement" value="3/A terme">
                                <label for="paiement">A terme</label>
                            </fieldset>
                        </div> -->
                        <!-- < ?php $pai = $commande['paiement'];

                        $pai = explode("/", $pai);
                        //print_r ($commande['etat']);
                        $pai = $pai[0];
                        ?> -->
                        <!-- <script>
                            var vari = < ?php echo json_encode($pai); ?>;
                            // console.log(vari);
                            var elts = document.querySelectorAll('#paiement');
                            //console.log(elts);
                            elts[vari].checked = true;
                        </script> -->

                        <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->




                        <!-- <button type="submit" class="btn btn-primary">Envoyer</button> -->
                        <input type="submit" name="submit" value="Envoyer Commande" class="btn btn-primary" />
                </form>
                <br>

                <!-- <a class="btn btn-primary" href="indexcommande.php?page=< ?= $page ?>&recherche=">Retour</a> -->

            </section>
        </div>
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
        <br>
    </main>
    <br><br>
</body>

</html>