<?php
     session_start();
    if(isset($_SESSION['user'])){
        
            require_once('connexiondb.php');
            
            $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;

            $requete="delete from utilisateur where idUser=?";
            
            $params=array($idUser);
            
            $resultat=$db->prepare($requete);
            
            $resultat->execute($params);
            
            header('Location:Utilisateurs.php');   
            
     }else {
                header('Location:login.php');
        }
