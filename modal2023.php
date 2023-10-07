  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="./js/jquery-3.3.1.js"></script> -->
    <link rel="icon" href="./images/logo2.png" type="image" />
   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Modale</title>
    <link rel="stylesheet" href="css/normalize.css">



<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">



<!-- <script src="./js/jquery-3.3.1.js"></script> -->
<link rel="icon" href="./images/logo2.png" type="image" />

<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


<!-- <link rel="stylesheet" href="./css/styleloader.css"> -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="./css/style41.css">
  </head>
  
    
  
  <!-- Bouton qui déclenche l'ouverture du modal -->
  <button id="btn-open-modal" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Commandes</button>
 <!-- <a href="./formcom mande.php"  class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Commande</a> -->
<!-- Div qui contient le contenu du modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">×</span>
    <div id="modal-content"></div>
  </div>
</div>

<!-- CSS pour le modal -->
<style>
.modal {
  display: none; /* Masquer le modal par défaut */
  position: fixed; /* Position fixe pour empêcher le défilement de la page */
  z-index: 999; /* Mettre le modal au-dessus du contenu de la page */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Activer le défilement si le contenu du modal dépasse la taille de l'écran */
  /* background-color:blue;  */
}

.modal-content {
  background-color:rgb(15,4,95);
  margin: 10% auto;
  padding: 20px;
  /* border: 1px solid #888; */
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>

<!-- JavaScript pour le modal -->
<script>
$(document).ready(function() {
  // Au clic sur le bouton, ouvrir le modal et charger le contenu de la page PHP
  $("#btn-open-modal").click(function() {
    $("#myModal").show(); // Afficher le modal
    $("#modal-content").load("formcommandemodal.php"); // Charger le contenu de la page PHP dans la div du modal
  });

  // Au clic sur le bouton de fermeture, cacher le modal
  $(".close").click(function() {
    $("#myModal").hide(); // Cacher le modal
  });
});
</script>