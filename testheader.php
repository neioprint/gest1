<?php
// Vous voulez afficher un pdf
header('Content-Type: application/pdf');

// Il sera nommé downloaded.pdf
header('Content-Disposition: attachment; filename="blneio39.pdf"');

// Le source du PDF original.pdf
readfile('./bl/blneio39.pdf');
?>