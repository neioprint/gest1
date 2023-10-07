<?php

    session_start();
   

    //echo($_SESSION['login']);
    require_once('serveur.php');
    try {
        // Connexion à la base
        if ($serveur == "local") $db = new PDO('mysql:host=localhost;dbname=globa932_demo01', 'globa932_globa932', 'exp2581exp');
        if ($serveur == "distant") $db = new PDO('mysql:dbname=globa932_demo01;host=204.44.192.59', 'globa932_globa932', 'exp2581exp');
        if ($serveur == "serveur") $db = new PDO('mysql:dbname=globa932_demo01;host=localhost', 'globa932_globa932', 'exp2581exp');
        if ($serveur == "serveurlws") $db = new PDO('mysql:dbname=globa2085215_1ilsts;host=185.98.131.160', 'globa2085215_1ilsts', 'cwf5bqwyvo');

        $db->exec('SET NAMES "UTF8"');
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        die();
    }
    @$username=$_SESSION['login'];
    if ($username!=null) {
    $dateconn="Deja connecté ulterieurement";
    $sql = 'INSERT INTO 
    `historiqueconnexion` 
    (`dateconn`,`username`,`datedec`,`messages`) 
    VALUES 
    ( :dateconn,:username,:datedec,:messages);';
    
    $query = $db->prepare($sql); 
    $_SESSION['message'].="Deconnexion reussie";
   
    $messages=$_SESSION['message'];
    
    
    //date('Y-m-d').' à '. date("H:i");
    $datedec=date('Y-m-d').' à '. date("H:i");
    $query->bindValue(':dateconn', @$dateconn, PDO::PARAM_STR);
    $query->bindValue(':username', @$username, PDO::PARAM_STR);
    $query->bindValue(':datedec', @$datedec, PDO::PARAM_STR);
    $query->bindValue(':messages', @$messages, PDO::PARAM_STR);
    $query->execute();
}
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    unset($_SESSION['user']);
    session_destroy();
    session_start();
    ?>
    <!-- // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet"> 
    
    <!-- <script> 
    
    
    function travail() {
    
    
        Swal.fire({
    //   position: 'bottom-start',
      icon: 'success',
      title: 'Operation Reussie',
      showConfirmButton: false,
      timer: 3000
    })
     } 
    
     function probtravail() {
    
    
    Swal.fire({
    //   position: 'bottom-start',
    icon: 'error',
    title: 'Operation Echouée',
    showConfirmButton: false,
    timer: 3000
    })
    } 
    
    </script>  -->
    <?php
    // if (!empty($_SESSION['erreur'])) {
    //     echo '<div class="alert alert-danger .alert-dismissible" role="alert">
    //     <button type="button" class="close" data-dismiss="alert">&times;</button>
    //             ' . $_SESSION['erreur'] . '
    //         </div>';
    //     $_SESSION['erreur'] = "";
    //     echo "<script>probtravail()</script>"; 
    // }
    // if (!empty($_SESSION['message'])) {
        
    //     echo '<div class="alert alert-success .alert-dismissible" role="alert">
    
    //     <button type="button" class="close" data-dismiss="alert">&times;</button>
    //             ' . $_SESSION['message'] . '^login
    
    //         </div>';
            
    //     $_SESSION['message'] = "";
      
    //  echo "<script>travail()</script>"; 
        
    // }
    
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    $_SESSION['message']='Deconnexion reussie merci de votre visite '.strtoupper($username);
 //   die();
   header('Location: login.php');
    die();
