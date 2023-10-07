<?php
// On démarre une session
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
if (!isset($_SESSION['user'])) {
    header('Location:login.php');
    exit();
}
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
// On inclut la connexion à la base
require_once('connectclient.php');

$sql = 'SELECT * FROM `client`';

// On prépare la requête
$query = $db->prepare($sql);
// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$resultclient = $query->fetchAll(PDO::FETCH_ASSOC);
// O;//var_dump($result);

require_once('closeclient.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="../css/style41.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        img {
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="entete">
            <img src="./images/logo.avif" alt="logo global2pub" width="100" height="auto" loading="lazy">

            <h1 class="entete">Gestion Commande</h1>
        </div>
        <div class="avatar">
            <img src="./images/annonce2.png" alt="" width="400" height="auto">
        </div>
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
                <?php
                if (!empty($_SESSION['message'])) {
                    echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
                    $_SESSION['message'] = "";
                }
                ?>
                <a href="./gestion4.php" class="btn btn-primary btn-block">Ajouter Commande</a>
                <a href="./indexcommande.php" class="btn btn-primary btn-block">Liste commandes</a>
                <a href="./index.php" class="btn btn-primary btn-block">Liste imprimés</a>
                <!-- <a href="./indexclient.php" class="btn btn-primary">Liste clients</a> -->
                <h1 class="entete">Liste clients</h1>


                <a href="addclient.php" class="btn btn-primary btn-block">Ajouter un Client</a>
                <a href="./gestion4.php" class="btn btn-primary btn-block">Retourner à Home</a>
                <a href="./trieclient.php" class="btn btn-success btn-block">Liste Commande trié par client</a>
                <a href="./seDeconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a>
                <br>

                <table class="table tab">
                    <thead class="table tab">
                        <th class="table-primary">ID</th>
                        <th class="table-primary">Client</th>
                        <th class="table-primary">Telephone</th>
                        <!-- <th>Prix</th> -->
                        <!-- <th>Qte Min</th> -->
                        <!-- <th>Actif</th> -->
                        <th class="table-primary">Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach ($resultclient as $client) {
                        ?>
                            <tr>
                                <td class="table-primary"><?= $client['id'] ?></td>
                                <td class="table-primary"><?= $client['client'] ?></td>
                                <td class="table-primary"><?= $client['tel'] ?></td>
                                <td class="table-primary">
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="detailsclient.php?id=<?= $client['id'] ?>">Voir</a>
                                        <a class="btn btn-primary btn-success" href="editclient.php?id=<?= $client['id'] ?>">Modif</a>
                                        <a class="btn btn-primary" href="deleteclient.php?id=<?= $client['id'] ?>">Suppr</a>

                                </td>
        </div>
        </tr>
        <!-- <p id="demo"></p> -->
        <!-- <script>
                            function myFunction() {
                            let text = "Press a button!\nEither OK or Cancel.";
                            if (confirm(text) == true) {
                                text = "You pressed OK!";
                            } else {
                                text = "You canceled!";
                            }
                            document.getElementById("demo").innerHTML = text;
                          
                            }
                            </script> -->
    <?php
                        }
    ?>
    </tbody>
    </table>

    </section>
    </div>
    </main>
</body>

</html>