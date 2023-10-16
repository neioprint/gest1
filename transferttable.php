<?php
   require('connectcommande.php');

   // On nettoie l'id envoyé
   //$id = strip_tags($_GET['id']);

   $sql = 'SELECT * FROM `commande`';

   // On prépare la requête
   $query = $db->prepare($sql);

   // On "accroche" les paramètre (id)
   //$query->bindValue(':id', $id, PDO::PARAM_INT);

   // On exécute la requête
   $query->execute();

   // On récupère le produit
   $commande = $query->fetchAll();
//    echo "<pre>";

//    print_r($commande);
//    echo "</pre>";
   // On vérifie si le produit existe
   if (!$commande) {
       $_SESSION['erreur'] = "Cet id n'existe pas";
       header('Location: indexcommande.php');
       die();
   }

 for ($i=0; $i <count($commande) ; $i++) { 
    # code...

    $commande[$i]['etapesvalidee'] = unserialize($commande[$i]['etapesvalidee']);

 $commande[$i]['etapesvalidee']=array($commande[$i]['etapesvalidee']);
 echo "<pre>";

 print_r($commande[$i]['etapesvalidee']);
 echo "</pre>";
$commande[$i]['etapesvalidee']=serialize($commande[$i]['etapesvalidee']);
 $sql = 'UPDATE `commande` SET `etapesvalidee`=:etapesvalidee WHERE `id`=:id;';
 // Prepare statement
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':id', $commande[$i]['id'], PDO::PARAM_INT);
 
 $stmt->bindValue(':etapesvalidee',$commande[$i]['etapesvalidee'] , PDO::PARAM_STR);

 // execute the query
 $stmt->execute();




 
 }



//  $sql = 'UPDATE `commande` SET `etapesvalidee`=:etapesvalidee WHERE `id`=:id;';
//     // Prepare statement
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
//     $stmt->bindValue(':etapesvalidee',$commande[$i]['etapesvalidee'] , PDO::PARAM_STR);

//     // execute the query
//     $stmt->execute();



//     // echo "<pre>";
//     // print_r($commande);
//     // echo "</pre>";


//     //$query->execute();
//     require_once('closecommande.php');

 
//echo $tabsuivi;
