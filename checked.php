<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$commande['etat']="33/En attente";
$commande['etat']=explode("/",$commande['etat']);
//print_r ($commande['etat']);
$commande['etat']=$commande['etat'][0];
//echo $commande['etat'];


// $commande['etat']=explode("E",$commande['etat']);
// //print_r ($commande['etat']);
// $commande['etat']=$commande['etat'][1];
//echo $commande['etat'];
?>
<script>
 var vari= <?php echo json_encode($commande['etat']); ?>;
 console.log(vari);
</script>




	<form action="">
		<input id="choix" name='choix' type="radio" value=0 >
		<input id="choix" name='choix' type="radio" value=1 >
		<input id="choix" name='choix' type="radio" value=2 >
	</form>
   
	<script>
        // vari.innerHTML+="checked";
		var elts = document.querySelectorAll('#choix');
        //console.log(elts);
        if (elts[vari]!=undefined) {elts[vari].checked=true;} else console.log('erreur:index introuvable');
		// for (var i = 0; i < elts.length; i++) {
		// 	if ( elts[i].checked === true ) break;
		// }
		if (elts[vari]!=undefined) {console.log('value => '+elts[vari].value);}
	</script>


<!-- <script>
         vari.innerHTML+="checked";
		var elts = document.querySelectorAll('#choix');
        
		for (var i = 0; i < elts.length; i++) {
			if ( elts[i].checked === true ) break;
		}
		if (elts[i]!=undefined) {console.log('value => '+elts[i].value);}
	</script> -->
</body>






<!-- <body>
    <h1>bouton radio</h1>
    <input type="radio" name="radio" checked>

    <script>
        let bouton=document.querySelector('input');
        console.log(bouton.checked);
    </script>
</body> -->
</html>