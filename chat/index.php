<?php
    session_start();
    //Créez une session
    print_r($_POST);
    if(isset($_POST['username'])){
      $_SESSION['username']=$_POST['username'];
    }
    //Annuler la session et déconnecter l'utilisateur du chat
    if(isset($_GET['logout'])){
      unset($_SESSION['username']);
      header('Location:index.php');
    }
    ?>


    <html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=0">
      <link rel="stylesheet" href="style.css" />
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/1.1.9/js/libs/jquery-1.10.2.min.js">

      </script>
    
    </head>
    <body>
    <div class='header'>
      <h1>
        MESSAGERIE NEIO
        <a class='logout btn' href="../indexcommande.php"  >&nbsp;Retour</a>
        <?php if(isset($_SESSION['username'])) { ?>
          <a class='logout' href="?logout">Déconnexion&nbsp;</a>
        <?php } ?>
      </h1>
    
    </div>
    <div class='framechat'>
    <!-- <button onclick="history.back()">Retour</button> -->
    <!-- Vérifier si l'utilisateur est connecté ou non -->
    <?php if(isset($_SESSION['username'])) { ?>
    <div id='result'></div>
    <div class='chatbody'>
      <form method="post" onsubmit="return lancerlechat();">
      <input type='text' name='chat' id='msgbox' placeholder="Tapez votre message ICI" />
      <input type='submit' name='send' id='send' class='btn btn-send' value='Envoyer' />
      <input type='button' name='clear' class='btn btn-clear' id='clear' value='X' title="Effacer les messages" />
    </form>
   
    <script>
    // Fonction Javascript pour soumettre le nouveau chat entré par l'utilisateur
    function lancerlechat(){
        if($('#chat').val()=='' || $('#msgbox').val()==' ') return false;
        $.ajax({
          url:'chat.php',
          data:{msg:$('#msgbox').val(), send:true},
          method:'post',
          success:function(data){
			// Récupérer les enregistrements du chat et les ajouter à div avec id=result
            $('#result').html(data); 
			//Effacer la boîte de dialogue après une soumission réussie
            $('#msgbox').val(''); 
			// Ramener la barre de défilement au bas dans le cas où le chat est long
            document.getElementById('result').scrollTop=document.getElementById('result').scrollHeight; 
          }
        })
        return false;
    };
    // Fonction permettant de vérifier à tout moment si quelqu'un a soumi un nouveau chat.
    setInterval(function(){
      $.ajax({
          url:'chat.php',
          data:{get:true},
          method:'post',
          success:function(data){
            $('#result').html(data);
          }
      })
    },1000);
    // Fonction d'accès à l'historique des chats
    $(document).ready(function(){
      $('#clear').click(function(){
        if(!confirm('Êtes-vous sûr de vouloir effacer les messages?'))
          return false;
        $.ajax({
          url:'chat.php',
          data:{username:"<?php echo $_SESSION['username'] ?>", clear:true},
          method:'post',
          success:function(data){
            $('#result').html(data);
          }
        })
      })
    })
    </script>
    <?php } else { ?>
    <div class='controlepanel'>
      <form method="post">
        <input  type='text' class='input-user' placeholder="SAISISSEZ VOTRE NOM ICI" name='username' />
        <input type='submit' class='btn btn-user' value='Démarrer la Messagerie' />
      </form>
    </div>
    <?php } ?>
    </div>
    </body>
    </html>