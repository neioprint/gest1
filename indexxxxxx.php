<?php
 
$url = '';
if(isset($_GET['url'])) {
$url = $_GET['url'];
//echo $url;
}
 
if($url == '') {
require 'home.php';
} elseif(preg_match('#article-([0-9]+)#', $url, $params)) {
$idArticle = $params[1];
print_r ($params);
//echo $params[1];
require 'article.php';
} else {
require '404.php';
}
?>
