<?php
// On démarre une session
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calculatrice</title>
    <link rel="stylesheet" href="stylecalc.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@100;300;400;500;700;900&display=swap" 
    rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  </head>
  <body>

  
    <div class="calculator">
    <a class="btn btn-primary btn-lg btn-success" href="../indexcommande.php?niveau=<?=@$_SESSION['niveau']?>">
            <i class='fa fa-undo' style='font-size:30px;color:black'  aria-hidden='true'></i>
            </a>
            <br><br>
      <div class="display">
        <p class="calculation"></p>
        <p class="result">0</p>
      </div>
      <div class="grid">
        <button data-action="c">C</button>
        <button data-action="ce">CE</button>
        <button data-action="+">+</button>
        <button data-action="7">7</button>
        <button data-action="8">8</button>
        <button data-action="9">9</button>
        <button data-action="-">-</button>
        <button data-action="4">4</button>
        <button data-action="5">5</button>
        <button data-action="6">6</button>
        <button data-action="*">x</button>
        <button data-action="1">1</button>
        <button data-action="2">2</button>
        <button data-action="3">3</button>
        <button data-action="/">/</button>
        <button data-action="0">0</button>
        <button data-action=".">.</button>
        <button data-action="=">=</button>
      </div>
     
    </div>
    
    <script src="calc.js"></script>
  </body>
</html>
