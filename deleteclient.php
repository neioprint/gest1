<?php
require_once "const.php";

//require_once('role.php');
// if  ($_SESSION['login']!="login"){
//     $_SESSION['erreur'] = "Veuillez vous connecter pour acceder au contenu"; 
//     header('Location: ../login.php');
//     die;
// }
//prompt function

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    // partie confirmation effacement
    require_once('connectclient.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `client` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $client = $query->fetch();

    // On vérifie si le produit existe
    if (!$client) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: indexclient.php?page=1');
        die();
    }
    require_once('closeclient.php');


    if (isset($id) && !empty($id)) {
        require('connectcommande.php');
    
        // On nettoie l'id envoyé
        $id = strip_tags($_GET['id']);
    
        $sql = 'SELECT * FROM `commande` WHERE `idclient` = :id;';
    
        // On prépare la requête
        $query = $db->prepare($sql);
    
        // On "accroche" les paramètre (id)
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    
        // On exécute la requête
        $query->execute();
    
        // On récupère le produit
        $commande = $query->fetch();
       
        // On vérifie si le produit existe
        if ($commande)
        if (count($commande)>0) {
            $_SESSION['erreur'] = "Impossible de supprimer ce Client <br> Veuillez supprimer les commandes avant ";
           
            header('Location: indexclient.php?page=1');
            die();
        }
     
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du client</title>
    <link rel="icon" href="./images/logo.avif" type="image" />
    <link rel="stylesheet" href="./css/style41.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">

                <h1>Veuillez confirmer l'effacement de <br> <?= $client['client'] ?></h1>
                <!-- <p>ID : < ?= $client['id'] ?></p>
                <p>Client : < ?= $client['client'] ?></p>
                <p>Telephone : < ?= $client['tel'] ?></p> -->
                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" value="<?= $client['id'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" value="<?= $client['client'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="tel">Telephone</label>
                    <input type="text" value="<?= $client['tel'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="tel">Solde</label>
                    <input type="number" step="0.01" value="<?= $client['solde'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="tel">e-mail</label>
                    <input type="mail" value="<?= $client['email'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" value="<?= $client['adresse'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="registre">Registre de commerce</label>
                    <input type="text" value="<?= $client['registre'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="idfiscal">Identifiant Fiscal</label>
                    <input type="text" value="<?= $client['idfiscal'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="idfiscal">Nis</label>
                    <input type="text" value="<?= $client['nis'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="idfiscal">Activité</label>
                    <input type="text" value="<?= $client['activite'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="idfiscal">Tel siège</label>
                    <input type="text" value="<?= $client['telsiege'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="art">N° Article</label>
                    <input type="text" value="<?= $client['art'] ?>" class="form-control" readonly>
                </div>
                <a class="btn btn-primary btn-block" href="indexclient.php?page=1">Annuler</a>
                <!-- <a class="btn btn-danger btn-block" href="deleteclient2.php?id=< ?= $client['id'] ?>">Confirmer Suppression</a> -->

                <a class="btn btn-danger" onclick="confirmer(<?= $client['id'] ?>)">Suppr</a>

            </section>
        </div>
    </main>
    <script>
function confirmer(id) {
            console.log(id);
            // mavar=document.getElementById(j).innerHTML;
    
// j=0;
// nom="sido";
// versement="5000" ;      
Swal.fire({
    title: `<strong>Confirmer</strong>`,
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  },
//   text: "Versement",
  icon: 'success',
  html:`
   
   <h4>Action </h4>
  `
  ,
footer:"Operation  irréversible",
backdrop:true,
heightAuto:false,
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
 confirmButtonText: 'Ok',
   cancelButtonText: 'Annuler',
  width: '42em',
 
//  height: '42em',
  showCloseButton: true
}).then((result) => {
   


   if (result.isConfirmed) {

//     Swal.fire(
//       'Supprimé',
//       'Votre fiche à eté supprimé.',
//       'success'
//     ).then((result) => {
    //document.location.href = './terminercommande.php?id='+'< ?= $resultcommande ?>'+'&suite='+etat+'&page='+< ?= $page ?>;
    
    //document.location.href ='deletedocument.php?id='+id;
 
//     })
  

   }
})
}


</script>
</body>

</html>