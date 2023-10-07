

   
   
    
    <!-- <h2 class="entete">Veuillez vous connecter</h2> -->
    <!-- <a href="commandes/indexcommande.php" class="btn btn-primary btn-block">Liste commandes</a> 
     <a href="clients/trieclient.php" class="btn btn-primary btn-block">Liste commandes par client</a>  
    <a href="imprimes/index.php" class="btn btn-primary btn-block">Liste imprimés</a> 
    <a href="clients/indexclient.php" class="btn btn-primary btn-block">Liste clients</a> -->
   
    <?php
    if (@$_SESSION['login']==="login") {
      
        ?>
       
       <a href=".gestion4.php" class="btn btn-primary btn-block">Menu Principal</a> 
    <a href="./deconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a>
    <?php } ?>
           
    
    <!-- <div id="bidon"></div> -->