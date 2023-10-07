<?php
require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

$source = 'fr';
$target = 'ar';
$text = ' Entree journaliere';

$trans = new GoogleTranslate();
$result = $trans->translate($source, $target, $text);

// Good morning
echo $result;