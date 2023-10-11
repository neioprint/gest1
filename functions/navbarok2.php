<!-- <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Responsive Sidebar Menu</title>
<!- - <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> - ->
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body> -->
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
			<li>
				<a href="../trieclient.php">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Commande trié/client</span>
				</a>
			</li>
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

<!-- </body>
</html> -->
