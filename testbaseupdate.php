<?php
// On démarre une session
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};

error_reporting(-1);
ini_set("display_errors", 1);
require('connectcommande.php');

// On nettoie l'id envoyé
$id = 53;

$sql = 'SELECT * FROM `commande` WHERE `id` = :id;';


$query = $db->prepare($sql);

// On "accroche" les paramètre (id)
$query->bindValue(':id', $id, PDO::PARAM_INT);

// On exécute la requête
$query->execute();

// On récupère le produit
$commande = $query->fetch();
require_once('closecommande.php');

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// echo "<pre>";
// print_r($commande);
// echo "</pre>";
// $datecom=date('d-m-Y').' à '. date("H:i");
// $commande['etat']="2/Terminé".$datecom;
$id = 53;
$datecom = date('d-m-Y') . ' à ' . date("H:i");
$etat = "2/Terminé" . $datecom;
require('connectcommande.php');
// try{
//     // Connexion à la base
//     $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'root', 'root');
// //    $db = new PDO('mysql:dbname=globa932_demo01;host=localhost' , 'globa932_globa932', 'exp2581exp');
//     $db->exec('SET NAMES "UTF8"');
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// //    $sql='UPDATE `commande` SET etat="1/terminé" WHERE id="53"';
$sql = 'UPDATE `commande` SET `etat`=:etat WHERE `id`=:id;';
// Prepare statement
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':etat', $etat, PDO::PARAM_STR);
// execute the query
$stmt->execute();
// echo "Connected successfully";
// } catch (PDOException $e){
//     echo 'Erreur :impossible de se connecter '.$e->getMessage();
//     die();
// }


echo "<pre>";
print_r($commande);
echo "</pre>";


//$query->execute();
require_once('closecommande.php');
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'imprimé</title>


</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">



                <div class="form-group">
                    <div class="radio form-group">
                        <?php $etatsuivi = $commande['etat'];

                        $etatsuivi = explode("/", $etatsuivi);

                        //$etatsuivisauv=$etatsuivi;
                        $etatsuivi = $etatsuivi[0];
                        //$encours=0;
                        ?>

                        <fieldset>
                            <legend>Etats Commandes <?= $commande['etat'] ?></legend>
                            <!-- <legend>< ?php echo $_SESSION['etat'] ?></legend> -->
                            <?php if ($etatsuivi == 0) { ?>
                                <input type="radio" id="etat" name="etat" value="0/En attente" checked>
                                <label for="etat0">En Attente</label>
                            <?php } ?>
                            <?php if ($etatsuivi == 1) { ?>
                                <input type="radio" id="etat" name="etat" value="1/En cours" checked>

                                <label for="etat">En cours</label>
                            <?php $_SESSION['etat'] = "encours";
                            } ?>

                            <?php if ($etatsuivi == 2) { ?>
                                <input type="radio" id="etat" name="etat" value="2/Terminé" checked>
                                <label for="etat">Terminé</label> <br>
                            <?php } ?>
                            <?php if ($etatsuivi == 3) { ?>
                                <input type="radio" id="etat" name="etat" value="3/Livrée" checked>
                                <label for="etat">Livrée</label>
                            <?php } ?>
                            <?php if ($etatsuivi == 4) { ?>
                                <input type="radio" id="etat" name="etat" value="4/Annulée" checked>
                                <label for="etat">Annulée</label>
                            <?php } ?>
                            <?php if ($etatsuivi == 5) { ?>
                                <input type="radio" id="etat" name="etat" value="5/Archivée" checked>
                                <label for="etat">Archivée</label>
                            <?php } ?>
                        </fieldset>
                    </div>

                    <script>
                        var vari1 = <?php echo json_encode($etatsuivi); ?>
                        //console.log(vari);
                        var elts1 = document.querySelectorAll('#etat');
                        //       console.log(elts);checked
                        elts1[vari1].checked = true;
                        console.log(elts1[vari1]);
                    </script>

                    <!-- <label>Etat</label>
                <input type="text" class="form-control" value="< ?= $commande['etat'] ?>"readonly> -->


                </div>
                <!-- <p>Etat (En attente,En cours,Livré,Archivé):< ?= $commande['etat'] ?></p> -->
                <?php $pai = $commande['paiement'];

                $pai = explode("/", $pai);
                //print_r ($commande['etat']);
                $pai = $pai[0];
                ?>



                <!-- <script>
                var vari= < ?php echo json_encode($pai); ?>;
                // console.log(vari);
                var elts = document.querySelectorAll('#paiement');
                  //      console.log(elts);
                        elts[vari].checked=true;
                        console.log(elts[vari]);
                </script> -->

                <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

                <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                <!-- <label>Paiement</label>
                <input type="text" class="form-control" value="< ?= $commande['paiement'] ?>"readonly> -->
        </div>
        <!-- <p>Paiement (A terme,A la livraison,Avance 50% +Solde à la livraison:< ?= $commande['paiement'] ?></p> -->


        <!-- <a class="btn btn-primary btn-block" href="indexcommande.php">Retour</a> 
                <a href="" class="btn btn-primary btn-block">Confirmer que la commande est Terminée</a> -->

        <!-- <a class="btn btn-primary" href="edit.php?id=< ?= $commande['id'] ?>">Modifier</a></p> -->
        <!-- <a href="./gestion4.php" class="btn btn-primary btn-block">Retourner à Home</a> -->
        </section>
        </div>
    </main>
</body>

</html>