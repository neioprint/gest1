<!DOCTYPE html>
<html>

<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
	<title>Responsive Sidebar Menu</title>
	<!-- <link rel="icon" href="./images/logo.avif" type="image" /> -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css"> -->
	
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.1/css/all.min.css" integrity="sha512-9my9Mb2+0YO+I4PUCSwUYO7sEK21Y0STBAiFEYoWtd2VzLEZZ4QARDrZ30hdM1GlioHJ8o8cWQiy8IAb1hy/Hg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
	<script src="https://kit.fontawesome.com/6554078cc6.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Style+Script&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet"> -->

<!-- <script>
	import 'animate.min.css';
</script>	
	 -->
	<!-- <style>
		@import url("animate.css");
	</style>
	 -->
    <!-- <link rel="stylesheet" href="./css/style41.css"> -->
	<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

  <script src="./js/jquery-3.6.1.min.js"></script>

  <!-- <link rel="stylesheet" href="./node_modules/animate.css/animate.min.css"/> -->
</head>

<body>
	

	<br><br>
    <div class="entete">
            <!-- <img src="./images/logo.avif" alt="logo global2pub" width="100" height="auto"> -->
			</div>	
	<h1 class="entete animate__animated animate__rollIn"><span style=" text-shadow: 3px 3px 3px #ababab;font-size: 100px;font-family: 'Style Script', cursive;">Gest</span> 
	<i><span style="text-shadow: 3px 3px 3px #ababab;color:yellow;font-size: 55px;font-family:Sofia, sans-serif;">Imprim</span></i>
	</h1>

	<!-- <h1 class="entete"><span style="color:yellow;font-size: 20px;font-family: Garamond, serif;">imprim</span> </h1> -->
            <!-- <h1 class="entete"> <span style="font-family: 'Brush Script MT', cursive;"> Imprim </span> </h1> -->
	
			
			
			
			
   


	<div class="navigation">
		<ul>
		<!-- <li>
			<a class="btn" href="indexcommandesimplifie.php?recherche=&niveau=ins&language=< ?=$_SESSION['language']?>">
					<span class="icon"><i class="fa fa-align-justify" aria-hidden="true"></i></span>
					
					
					<span class="title" style="font-size:50px">< ?=LANGUE?></span>
					

				</a>
			</li> -->
		<!-- <li>
				<a href="./chat/index.php">
					<span class="icon">
					<i class="fa fa-commenting" aria-hidden="true"></i>
					
				</span> 
					<span class="title">Message</span>
				</a>
			</li>  -->
			<?php if (
					
					@$_SESSION['user']['role']== 'VISITEUR' 

					// @$_SESSION['user']['role'] != 'ADMIN' && !isset($_SESSION['user']['role']) &&
					// @$_SESSION['user']['role'] != 'VISITEUR' && @$_SESSION['user']['role'] != 'ADMIN2'
					) { ?>
	
			<li>
				<a href="./loginclient.php?language=<?=$_SESSION['language']?>">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title" style="font-size:20px"><?=ESPACE?></span>
				</a>
			</li>
			
			<li>
			 <!-- if (isset($_GET['language']) && !empty($_GET['language']))  {
     if($_GET['language']=="FR") $_SESSION['language']="AR"; else 
     if ($_GET['language']=="AR") $_SESSION['language']="FR";

 } -->
			<a class="btn" href="indexcommande.php?recherche=&niveau=ins&language=<?=$_SESSION['language']?>">
					<span class="icon" ><i class="fa fa-align-justify" aria-hidden="true"></i></span>
					
					<!-- <span class="title">< ?=$_SESSION['language']?></span> -->
					<!-- <i class="fa fa-align-justify" aria-hidden="true"></i> -->
					<span class="title" style="font-size:40px"><?=LANGUE?></span>
					

				</a>
			</li>
			<?php } ?>
		
			<!-- <li>
				<a href="./pointage.php">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Pointer</span>
				</a>
			</li>  -->
			<!-- <li>
				<a href="./telechargerimage.php">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Telecharger</span>
				</a>
			</li>  -->
			<li>
			<?php if (@$_SESSION['user']['role'] == 'ADMIN' or @$_SESSION['user']['role'] == 'ADMIN2' && isset($_SESSION['user']['role'])) { ?>
			

				<!-- <li>
				<a href="./pointage.php">
					
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Pointer</span>
				</a>
			</li>  -->
			<li>
			<a class="btn" href="indexcommande.php?recherche=&niveau=ins&language=<?=$_SESSION['language']?>">
					<span class="icon"><i class="fa fa-align-justify" aria-hidden="true"></i></span>
					
					<!-- <span class="title">< ?=$_SESSION['language']?></span> -->
					<!-- <i class="fa fa-align-justify" aria-hidden="true"></i> -->
					<span class="title" style="font-size:40px"><?=LANGUE?></span>
					

				</a>
			</li>
			<li>
				<a href="./indexcommande.php?niveau=<?=$_SESSION['niveau']?>&language=<?=$_SESSION['language']?>"> 
				<span class="icon">
				<i class="fa fa-align-justify" aria-hidden="true"></i>

					<!-- <i class="fa fa-home" aria-hidden="true"></i> -->
				</span>
						<span class="title" style="font-size:20px"> 
							<!-- <i class="fa fa-plus-square" aria-hidden="true"></i> -->
							<?=COMMANDE?></span>
				</a> 
			
				<li>
					<a href="./formcommande.php?language=<?=$_SESSION['language']?>">
						<span class="icon">
						<i class="fa fa-align-justify" aria-hidden="true"></i>
							<!-- <i class="fa fa-home" aria-hidden="true"></i> -->
						</span>
						<span class="title" style="font-size:20px"> <i class="fa fa-plus-square" aria-hidden="true"></i><?=COMMANDE?></span>
					</a>
				</li> 
			<li>
				<a href="./pointagecamera.php?language=<?=$_SESSION['language']?>">
					<span class="icon">
						<!-- <i class="fa fa-home" aria-hidden="true"></i> -->
						<!-- <i class="fa fa-hand-pointer-o" aria-hidden="true"></i> -->
						<i class="fa fa-camera" aria-hidden="true"></i>
					</span>
					<span class="title" style="font-size:20px"> <?=POINTAGE?></span>
				</a>
			</li> 
		
				<?php } else { 
							if (@$_SESSION['user']['role'] == 'VISITEUR' && isset($_SESSION['user']['role'])) {?>
							<li>
							<!-- <a href="./pointage.php"> -->
							<a href="./pointagecamera.php?language=<?=$_SESSION['language']?>">
							<span class="icon">
								<!-- <i class="fa fa-home" aria-hidden="true"></i> -->
								<i class="fa fa-camera" aria-hidden="true"></i>
							</span>
							<span class="title" style="font-size:20px"> <?=POINTAGE?></span>
							</a>
							</li> 
							
							<!-- <a href="./indexcommandesimplifie.php?recherche=&niveau=ins"> 
							<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
							<span class="title">Commandes</span>
						</a>  -->
						
						<?php }} ?>
						</li>	

						<li>
						<a href="./chat/index.php?username=sid&language=<?=$_SESSION['language']?>">
						<span class="icon">
						<i class="fa fa-commenting" aria-hidden="true"></i>
					
						</span> 
						<span class="title" style="font-size:20px"><?=MESSAGE?></span>
						</a>
						</li> 
			<?php if (@$_SESSION['user']['role'] == 'ADMIN' && isset($_SESSION['user']['role'])) { ?>
				<li>
				<a href="./relevepointage.php?niveau1=d&language=<?=$_SESSION['language']?>">
					<span class="icon">
						<!-- <i class="fa fa-home" aria-hidden="true"></i> -->
						<i class="fa fa-camera" aria-hidden="true"></i>
					</span>
					<span class="title"><?= RELEVE?> </span>
				</a>
			</li> 
			
				<li>
					<a href="production.php?niveau1=d&language=<?=$_SESSION['language']?>">
						<span class="icon">
							<!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
							<i class="fa fa-industry" aria-hidden="true"></i>
						</span>
						<span class="title"><?=PRODUCTION?></span>
					</a>
				</li>
				<li>
					<a href="addproduction.php?language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-industry" aria-hidden="true"></i></span>
						<span class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> <?=PRODUCTION?></span>
					</a>
				</li>
				<?php } ?>

			<!-- <li>
				<a href="./trieclient.php">
					<span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<span class="title">Commande trié/client</span>
				</a>
			</li> -->

			<?php if (@$_SESSION['user']['role'] == 'ADMIN' or @$_SESSION['user']['role'] == 'ADMIN2' && isset($_SESSION['user']['role'])) { ?>
				<li>
				<a href="indexclient.php?page=1&language=<?=$_SESSION['language']?>">
					<span class="icon"><i class="fa fa-address-card" aria-hidden=" true"></i></span>
					<span class="title"><?=CLIENTS?></span>
				</a>
			</li>
				<li>
					<a href="addclient.php?language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa  fa-address-card" aria-hidden=" true"></i></span>
						<span class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> <?=CLIENT?></span>
					</a>
				</li> <?php } ?>
				
			<?php if (@$_SESSION['user']['role'] == 'ADMIN'  or @$_SESSION['user']['role'] == 'ADMIN2') { ?>
				<li>
				<a href="soldeclient2.php?recherche=&niveau=i&language=<?=$_SESSION['language']?>">
					<span class="icon">
						<!-- <i class="fa fa-address-card" aria-hidden=" true"></i> -->
						<!-- <i class="fa fa-money" aria-hidden="true"></i> -->
						<i class="fa fa-usd" aria-hidden="true"></i>
					</span>
					<span class="title">Solde</span>
				</a>
			</li>
				<li>
					<a href="./index0.php?page=1&language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-print" aria-hidden="true"></i></span>
						<span class="title">Imprimés</span>
					</a>
				</li>
				<li>
						<a href="./add.php?language=<?=$_SESSION['language']?>">
							<span class="icon"><i class="fa fa-print" aria-hidden="true"></i></span>
							<span class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Imprimés</span>
						</a>
					</li> 

				<?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
					
					<li>
					<a href="document.php?niveau1=t&language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
						<span class="title">Documents</span>
					</a>
				</li>
				<!-- <li>
					<a href="">
						<span class="icon"><i class="fa fa-university" aria-hidden="true"></i></span>
						<span class="title">+ Document</span>
					</a>
				</li> -->
				<!-- < ?php if ($_SESSION['user']['role']=='ADMIN') { ?> -->
					<li>
					<a href="matiere.php?niveau1=d&language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
						<span class="title">Matiere</span>
					</a>
				</li>
				<li>
					<a href="addmatiere.php?language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
						<span class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Matiere</span>
					</a>
				</li>
				
				<li>
					<a href="versement.php?niveau1=d&language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
						<span class="title">Recettes</span>
					</a>
				</li>
				<li>
					<a href="addversement.php?niveau1=d&language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
						<span class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Recettes</span>
					</a>
				</li>

				<li>
					<a href="depense.php?niveau1=d&language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-university" aria-hidden="true"></i></span>
						<span class="title">Depenses</span>
					</a>
				</li>
				<li>
					<a href="adddepense.php?niveau1=d&language=<?=$_SESSION['language']?>">
						<span class="icon"><i class="fa fa-university" aria-hidden="true"></i></span>
						<span class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Depense</span>
					</a>
				</li> <?php } ?>
				<!-- < ?php } ?> -->
			<?php } ?>
			<?php if (@$_SESSION['user']['role'] == 'ADMIN' && isset($_SESSION['user']['role'])) { ?>
				<li>
					<a href="uploads/index00.php?language=<?=$_SESSION['language']?>">
						<span class="icon">
							<!-- <i class="fa fa-users" aria-hidden="true"></i> -->
							<i class="fa fa-upload" aria-hidden="true"></i>
					</span>
						<span class="title">Uploads</span>
					</a>
				</li>

				
				<li>
					<a href="Utilisateurs.php?language=<?=$_SESSION['language']?>">
						<span class="icon">
							<i class="fa fa-users" aria-hidden="true"></i>
							<!-- <i class="fa fa-upload" aria-hidden="true"></i> -->
						</span>
						
					
						<span class="title"><?=UTILISATEUR?></span>
					</a>
				</li>
				<li>
				<a href="./editerUtilisateur.php?idUser=<?php echo $_SESSION['user']['iduser'] ?>&language=<?=$_SESSION['language']?>">
					<!-- <span class="icon"><i class="fa fa-user-circle" aria-hidden="true"></i></span> -->
					<!-- <span class="title"></span> -->
					<!-- <i class="fa fa-user-circle-o"></i> < ?php echo  ' '.$_SESSION['user']['login']?>  -->
					<span class="icon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
					<span class="title"><?php echo  ' ' . $_SESSION['user']['login'] ?></span>

				</a>
			</li>
			<li>
				<a href="./calculator/calculator.php?language=<?=$_SESSION['language']?>">

					<span class="icon">
					
						<i class="fa fa-calculator" aria-hidden="true"></i>
					
					</span>
					<span class="title">Calculatrice </span>
			
				</a>
				
			</li>
			<?php } ?>
			<?php if (@isset($_SESSION['user']['role']) ) { ?>
				<?php if (@$_SESSION['user']['role'] != 'ADMIN'): ?>
				<li>
				<a href="">
				
					<span class="icon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
					<span class="title"><?php echo  ' ' . $_SESSION['user']['login'] ?></span>

				</a>
			</li>
			<?php endif ?>
			<li>
				<a href="./seDeconnecter.php?language=<?=$_SESSION['language']?>">

					<span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
					<span class="title" style="font-size:20px"> <?=SEDECONNECTER?></span>
			
				</a>
				
			</li>
		
					
		
			<?php } ?>
			
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


	</div>
	<script type="text/javascript">
		function toggleMenu() {
			let navigation = document.querySelector('.navigation');
			let toggleMenu = document.querySelector('.toggle');
			navigation.classList.toggle('active');
			toggleMenu.classList.toggle('active');
		}

	//  function language(languagejs) {
	// 	function outoforder() {

	// 	}
	// 	console.log(languagejs);

	// 	// if (languagejs=='FR') {

	// 		$(document).ready(function()
    //                                                          {
                                                    
    //                                                             $.post("session.php",
    //                                                                 {
    //                                                             languagejs:languagejs
                                                               
    //                                                                 }
                                                            
                                                                    
    //                                                             ,
    //                                                             // Ci-dessous c'est le traitement de la réponse
    //                                                             function (reponse) {

    //                                                                 // Analyse et récupération du tableau de données transmis par le serveur
    //                                                                 var data = JSON.parse(reponse);
    //                                                                 console.log(data);
                                                                   
    //                                                                 //if (tableau=2) togglestate(variable,message,tableau,id)
    //                                                                 // On place les données dans le tableau HTML
    //                                                                 //$('#annee').text(data.annee);        
                                                                  
    //                                                                 //$('#variable').text(data.variable);

                                                                

    //                                                             });
																
	// 															// header( "refresh:5;url=login.php" );
	// 															//const myTimeout = setTimeout(outoforder(), 7000);
	// 															document.location.href = 'indexcommande.php?recherche=&niveau=ins';
	// 															die();
	// 														})
                                                      
													

	
		
	

	//   }
	</script>

</body>

</html>
