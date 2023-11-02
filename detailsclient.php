<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connectclient.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `client` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $client = $query->fetch();

    // On vérifie si le produit existe
    if (!$client) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: indexclient.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: indexclient.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détails du produit</title>
        <link rel="icon" href="./images/logo.avif" type="image" />
        <link rel="stylesheet" href="./css/style41.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet"> -->
    </head>

    <body>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h1 class="entete">Détails Client
                        <?= $client['client'] ?>
                    </h1>
                    <!-- <p>ID : < ?= $client['id'] ?></p>
                <p>Client : < ?= $client['client'] ?></p>
                <p>Telephone : < ?= $client['tel'] ?></p> -->
                    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" value="<?= $client['id'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="client">Client</label>
                        <input type="text" value="<?= $client['client'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tel">Telephone</label>
                        <input type="text" value="<?= $client['tel'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tel">Solde</label>
                        <input type="number" step="0.01" value="<?= $client['solde'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tel">e-mail</label>
                        <input type="mail" value="<?= $client['email'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" value="<?= $client['adresse'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="registre">Registre de commerce</label>
                        <input type="text" value="<?= $client['registre'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="idfiscal">Identifiant Fiscal</label>
                        <input type="text" value="<?= $client['idfiscal'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="idfiscal">Nis</label>
                        <input type="text" value="<?= $client['nis'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="idfiscal">Activité</label>
                        <input type="text" value="<?= $client['activite'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="idfiscal">Tel siège</label>
                        <input type="text" value="<?= $client['telsiege'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="art">N° Article</label>
                        <input type="text" value="<?= $client['art'] ?>" class="form-control" readonly>
                    </div>
            </div>
            <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                <a class="btn btn-primary btn-block" href="editclient.php?id=<?= $client['id'] ?>">Modifier</a>
                <button class="btn btn-primary btn-block" onclick="envoisms()">Envoyer Sms de Bienvenue</button>
            <?php } ?>
            <a class="btn btn-primary btn-block" href="indexclient.php?page=1">Retour</a>
            </section>
            </div>
            <br><br>
        </main>
        <script>
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




                        document.location.href = "sms/sms.php?idclient=<?= $client['id'] ?>&message=<?= $client['client'] . ' ' ?>Bienvenue sur la plateforme de commande en ligne NEIO vous avez renseigné votre fiche client avec succée. Soumettre votre demande(Proforma,Pre-commande)";
                        //  document.location.href='sms/envoismsok.php?idclient=< ?= $trieclientid ?>&message=Le < ?= $datebl ?> Cher < ?= $nomclient ?> Votre commande < ?= $nomimprime ?> est prete,pour plus de renseignements appeler le 0541 03 55 48.';



                    }
                })
            }
        </script>
    </body>

</html>