<?php
require_once('role.php');
require_once("connexiondb.php");
$login = isset($_GET['login']) ? $_GET['login'] : "";

$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$requeteUser = "select * from utilisateur where login like '%$login%'";
$requeteCount = "select count(*) countUser from utilisateur";

$resultatUser = $db->query($requeteUser);
$resultatCount = $db->query($requeteCount);

$tabCount = $resultatCount->fetch();
$nbrUser = $tabCount['countUser'];
$reste = $nbrUser % $size;
if ($reste === 0)
    $nbrPage = $nbrUser / $size;
else
    $nbrPage = floor($nbrUser / $size) + 1;
    //echo $nbrPage;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="./images/logo.avif" type="image" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">

</head>

<body>
    <!-- < ?php include("navbarok.php"); ?> -->
    <?php require_once("./navbarok.php") ?>
    <div class="container">
        <div class="panel panel-success margetop60">
            <div class="panel-heading">Recherche d'utilisateurs</div>
            <div class="panel-body">
                <form method="get" action="Utilisateurs.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="login" placeholder="Login" class="form-control" value="<?php echo $login ?>" />
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span> Chercher... </button>
                </form>
            </div>
        </div>
        <div class="panel panel-primary table-responsive">
            <div class="panel-heading">Liste des utilisateurs (<?php echo $nbrUser ?> utilisateurs)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> <?php while ($user = $resultatUser->fetch()) { ?> <tr class="<?php echo $user['etat'] == 1 ? 'success' : 'danger' ?>">
                                <td><?php echo $user['login'] ?> </td>
                                <td><?php echo $user['email'] ?> </td>
                                <td><?php echo $user['role'] ?> </td>
                                <td>
                                    <a href="editerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a> &nbsp;&nbsp; <a onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur?')" href="supprimerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a> &nbsp;&nbsp; <a href="activerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>&etat=<?php echo $user['etat']  ?>">
                                        <?php
                                        if ($user['etat'] == 1)
                                            echo '<span class="glyphicon glyphicon-remove"></span>';
                                        else
                                            echo '<span class="glyphicon glyphicon-ok"></span>';
                                        ?> </a>
                                </td>
                            </tr> <?php } ?> </tbody>   
                </table>
                <!-- <div>
                    <ul class="pagination"> < ?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                            <li class="< ?php if ($i == $page) echo 'active' ?>">
                                <a href="Utilisateurs.php?page=< ?php echo $i; ?>&login=< ?php echo $login ?>">
                                    < ?php echo $i; ?> </a>
                            </li> < ?php } ?>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</body>

</HTML>