<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ 
modale de chargement de fichier vers le serveur
-->
<!-- Button to Open the Modal -->
<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" href="./css/style41.css">
    <script src="./js/jquery-3.3.1.js"></script> -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Envoyer Fichier d'impression
</button>

<!-- The Modal -->
 <div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
  
    
      <div class="modal-header">
        <h4 class="modal-title">Envoyer fichier d'impression</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

   
      <div class="modal-body">
      
       
        <form method="post" action="" enctype="multipart/form-data">
         <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
         <input type="file" name="monfichier" /><br />
         <input type="submit" name="valider" value="Uploader" />
      </form>
       <!-- < ?php  chargerfichier("telechargement");  
       // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
   
      ?> -->
      
    
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->