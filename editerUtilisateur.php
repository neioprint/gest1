<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    $id=isset($_GET['idUser'])?$_GET['idUser']:0;
    //print_r ($id);
    $requete="select * from utilisateur where iduser=$id";

    $resultat=$db->query($requete);
    $utilisateur=$resultat->fetch();
    //print_r($utilisateur);
    $login=$utilisateur['login'];
    $email=$utilisateur['email'];

?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un utilisateur</title>
        <link rel="icon" href="./images/logo.avif" type="image" />
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    </head>
    <body>
         <?php include("navbarok.php"); ?> 
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition de l'utilisateur :</div>
                <div class="panel-body">
                    <form method="post" action="updateUtilisateur.php" class="form">
						<div class="form-group">
                           <!-- <label for="id">id user:</label>-->
                            <input type="hidden" name="iduser" class="form-control" value="<?php echo $id ?>"/>
                        </div>
                        <div class="form-group">
                             <label for="nom">Login :</label>
                            <input type="text" name="login" placeholder="Login" class="form-control" value="<?php echo $login ?>"/>
                        </div>
                        <div class="form-group">
                             <label for="prenom">Email :</label>
                            <input type="email" name="email" placeholder="email" class="form-control"
                                   value="<?php echo $email ?>"/>
                        </div>

				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button>

                        <a href="editPwd.php">Changer le mot de passe</a>
                      
					</form>
                </div>
            </div>   
        </div>      
    </body>
</HTML>
