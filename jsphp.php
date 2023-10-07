<script>
var p1 = 120;
// document.cookie = "username=John Doe";
document.cookie = "username=John Doe; expires=Thu, 18 Dec 2013 12:00:00 UTC";
let x = document.cookie;
</script>

<?php
echo"<script>document.writeln(p1);</script>";
print_r( $_COOKIE);

?>




Afficher la valeur de la variable dans le code JavaScript
La méthode la plus simple consiste à afficher grâce à PHP la valeur de la variable directement dans le code JavaScript. Il s'agit de la méthode la plus directe. La fonction json_encode permet alors d'éviter des injections avec par exemple du code malveillant inséré depuis PHP. Il peut également être difficile de se retrouver dans son code quand on insère des données structurées (JSON, HTML) et parce que les deux langages sont mélangés.


<script>
 var variableRecuperee = <?php echo json_encode($variableAPasser); ?>;
</script>
Afficher la variable PHP dans le code HTML
La méthode suivante consiste à afficher la variable PHP dans le code HTML. Par exemple, dans un <input> caché ou dans une <div> puis dans le code JavaScript servant à récupérer la valeur en utilisant le DOM. Avec cette méthode, l'exécution du code est très rapide en JavaScript, car les opérations faites avec le DOM sont courtes. Cette méthode oblige cependant le code à être valide en HTML pour que cela fonctionne, sinon il faut échapper ou encoder les caractères posant problème.
Le code HTML est aussi plus long en conséquence.

<!-- HTML -->
<input type=hidden id=variableAPasser value=<?php echo $variableAPasser; ?>/>
//JavaScript
var variableRecuperee = document.getElementById(variableAPasser).value;
Recourir à AJAX
Une autre solution est d'utiliser AJAX. Le code JavaScript va envoyer une requête AJAX à un script PHP qui affichera la valeur. Grâce à l'événement onLoad qui est appelé lors du chargement du script PHP, on peut récupérer la valeur dans le code JavaScript. C'est la méthode la plus propre, car les langages sont alors bien séparés. Elle permet également de charger plus vite la page, car l'appel du script PHP peut être effectué dans un deuxième temps (par exemple, lors d'un clic sur un bouton). Le code écrit est par contre plus difficile à comprendre pour un débutant, et cela génère plus de latence dans la page (le code doit attendre que le JavaScript ait appelé la fonction PHP).

//Fichier PHP script.php
<?php
echo $variableAPasser;
?>
//Code JavaScript
var requete = new XMLHttpRequest();
requete.onload = function() {
 //La variable à passer est alors contenue dans l'objet response et l'attribut responseText.
 var variableARecuperee = this.responseText;
};
requete.open(get, script.php, true); //True pour que l'exécution du script continue pendant le chargement, false pour attendre.
requete.send();