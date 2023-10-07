<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<body>
<script>
$(document).ready(function () {
$("#actualisez_moi").load("rand.php", {
});
var refreshId = setInterval(function () {
$("#actualisez_moi").load("rand.php", {
});
}, 2000); //Touts les 2 secondes le div sera actualisé
$.ajaxSetup({
cache: false
});
});
</script>
<div id="actualisez_moi">Merci de patienter ...</div>
</body>