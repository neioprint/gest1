<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
};
//session_start();
$resultcommande=$_GET["id"];
$page=$_GET["page"];
$etat=$_GET["etat"];
$trieclientid=$_GET['idclient'];
// print_r($resultcommande);
// print_r($page);
// print_r($_SESSION['user']['role']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style41.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <title>Action</title>
</head>
<body>
  <!-- < ?php include('navbarok2.php') ?>   -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<div class="navigation">
		<ul>
			<li>
				<a href="../indexcommande.php?page=1">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Commandes</span>
				</a>
			</li>
			<?php if ($_SESSION['user']['role']=='ADMIN') { ?>
			<li>
				<a href="../formcommande.php">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Ajout Commande</span>
				</a>
			</li> <?php } ?>
			<!-- <li>
				<a href="../trieclient.php">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Commande trié/client</span>
				</a>
			</li> -->
			<li>
				<a href="../index0.php?page=1">
					<span class="icon"><i class="fa fa-print" aria-hidden="true"></i></span>
					<span class="title">Imprimés</span>
				</a>
			</li>
			<?php if ($_SESSION['user']['role']=='ADMIN') { ?>
			<li>
				<a href="../add.php">
					<span class="icon"><i class="fa fa-print" aria-hidden="true"></i></span>
					<span class="title">Ajout Imprimés</span>
				</a>
			</li> <?php } ?>
			<li>
				<a href="../indexclient.php?page=1">
					<span class="icon"><i class="fa  fa-address-card"" aria-hidden="true"></i></span>
					<span class="title">Clients</span>
				</a>
			</li>
			<?php if ($_SESSION['user']['role']=='ADMIN') { ?>
			<li>
				<a href="../addclient.php">
					<span class="icon"><i class="fa  fa-address-card"" aria-hidden="true"></i></span>
					<span class="title">Ajout Clients</span>
				</a>
			</li> <?php } ?>
			<?php if ($_SESSION['user']['role']=='ADMIN') { ?>
			<li>
				<a href="../Utilisateurs.php">
					<span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
					<span class="title">Utilisateurs</span>
				</a>
			</li>

			<!-- < ?php if ($_SESSION['user']['role']=='ADMIN') { ?> -->
			<li>
				<a href="../addversement.php">
					<span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
					<span class="title">Versement</span>
				</a>
			</li> 
			<!-- < ?php } ?> -->
			<?php } ?>
			
			<li>
                <a href="../editerUtilisateur.php?idUser=<?php echo $_SESSION['user']['iduser'] ?>">
				<!-- <span class="icon"><i class="fa fa-user-circle" aria-hidden="true"></i></span> -->
					<!-- <span class="title"></span> -->
                    <!-- <i class="fa fa-user-circle-o"></i> < ?php echo  ' '.$_SESSION['user']['login']?>  -->
					<span class="icon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
					<span class="title"><?php echo  ' '.$_SESSION['user']['login']?></span>
				
				</a>
            </li>
            <li>
                <a href="../seDeconnecter.php">
                  
					<span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
					<span class="title">Se déconnecter </span>
				</a>
            </li>
			<!-- <li>
				<a href="#">
					<span class="icon"><i class="fa fa-cog" aria-hidden="true"></i></span>
					<span class="title">Setting</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
					<span class="title">Password</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
					<span class="title">Sign Out</span>
				</a>
			</li> -->
		</ul>
	</div>
	<div class="toggle" onclick="toggleMenu();"></div>
	<script type="text/javascript">
		function toggleMenu(){
			let navigation = document.querySelector('.navigation');
			let toggleMenu = document.querySelector('.toggle');
			navigation.classList.toggle('active');
			toggleMenu.classList.toggle('active');
		}
	</script>
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<div class="container">
<!-- </div> -->
<div class="btn-group">
                            
                            
                                <a class="btn btn-primary btn-sm btn-success" 
                                href="../detailscommande.php?id=<?= $resultcommande ?>&page=<?=$page?>">Consulter</a>
                               
                                <a class="btn btn-primary btn-sm" 
                                href="../editcommande.php?id=<?= $resultcommande ?>&page=<?=$page?>">Modifier</a>
                                <?php
                                if ($_SESSION['user']['role']=='ADMIN') { 
                               // print_r($_SESSION['user']['role']);
                                ?> 
                                <a class="btn btn-primary btn-sm btn-warning" 
                                href="../deletecommande.php?id=<?= $resultcommande ?>&page=<?=$page?>">Supprimer</a> 

                                <?php } ?>

                                 <?php $etatsuivi=$etat; 

                                $etatsuivi=explode("/",$etatsuivi);     
                                $etatsuivi=$etatsuivi[0];
                            //     print_r($etatsuivi);
                            //    die();
                                if ($etatsuivi==1){ ?> 
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="../terminercommande.php?id=<?= $resultcommande ?>&suite=99&page=<?=$page?>">Terminer</a>  
                                <?php } ?>

                                <?php if ($etatsuivi==0){ ?>
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="../terminercommande.php?id=<?= $resultcommande ?>&suite=9&page=<?=$page?>">Debuter</a>  
                                <?php } ?>
                                <?php if ($etatsuivi==6){ ?>
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="../terminercommande.php?id=<?= $resultcommande ?>&suite=9&page=<?=$page?>">En attente</a>  
                                <?php } ?>
                                <?php if ($etatsuivi==2){ ?>
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="../terminercommande.php?id=<?= $resultcommande ?>&suite=999&page=<?=$page?>">Livrer</a>  
                                <?php } ?>

                                <?php if ($etatsuivi==3){ ?>
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="../terminercommande.php?id=<?= $resultcommande ?>&suite=9999&page=<?=$page?>">Archiver</a>  
                                <?php } ?> 
                                
                                
                              
                                <?php 
                               //print_r($_SESSION['user']['role']);
                               if ($_SESSION['user']['role']=='ADMIN') { 
                               // print_r($_SESSION['user']['role']);
                                ?>
                                
                               
                               
                                <a class="btn btn-primary btn-sm" 
                                href="../blivraisoncommande.php?id=<?= $resultcommande ?>&page=<?=$page?>">Imprimer</a>
                                <a class="btn btn-primary btn-sm" 
                                href="../proforma.php?id=<?= $resultcommande ?>&page=<?=$page?>&idclient=<?= $trieclientid ?>">Proforma</a>

                                <?php 
                               
                                } ?>
                               
                                </div>
                                </div>

                                </body>
</html>