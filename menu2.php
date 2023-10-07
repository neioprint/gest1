<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
};
if ($_SESSION['login'] != "login") {
    $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu";
    header('Location: ./login.php');
    die;
}
?>
<div class="entete">
    <img src="../images/logo.avif" alt="logo global2pub" width="150" height="auto">

    <h1 class="entete">Gestion <br> Commande</h1>
</div>
<div class="avatar">
    <img src="../images/banquier.png" alt="" width="300" height="auto">
</div>
<!-- <h3 class="center">Selectionner la date <br>
        sur le calendrier <br> pour enregistrer <br> ou voir vos commandes </h3> -->
<hr>
<!-- <div id="myCalendar" class="vanilla-calendar"></div> -->
<h2 class="entete">Menu Principal</h2>
<a href="../commandes/indexcommande.php" class="btn btn-primary btn-block">Liste commandes</a>
<a href="formcommande.php" class="btn btn-success btn-block">Ajouter Commande</a>
<a href="../clients/trieclient.php" class="btn btn-primary btn-block">Liste commandes par client</a>
<a href="../imprimes/index.php" class="btn btn-primary btn-block">Liste imprimés</a>
<a href="../clients/indexclient.php" class="btn btn-primary btn-block">Liste clients</a>

<?php
if ($_SESSION['login'] === "login") {

?>


    <a href="../deconnecter.php" class="btn btn-danger btn-block">Se deconnecter</a>
<?php } ?>
<br> <br>

<!-- <div id="bidon"></div> -->