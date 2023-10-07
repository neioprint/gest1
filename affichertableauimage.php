<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 TRANSITIONAL//EN"> 
<html> 
<head><title>Galerie</title>
<style type="text/css">

body { background-color: #eeeeee; }
div { width: 100%; overflow: auto; }
table { text-align: center; }
table td { padding: 10px; background-color: #ffffff; }
</style>
</head> 
<body>
<div>
<?php  
$table = '<table align="center" cellspacing="10"><tr>'."\n"; 
$liste = array();
if ($dossier = opendir(dirname(__FILE__).'/')) { 
  while (($item = readdir($dossier)) !== false) { 
    if ($item[0] == '.') { continue; } 
    if (!in_array(end(explode('.', $item)), array('jpg','jpeg','png','gif'))) { continue; } 
    $liste[] = $item; 
  } 
  closedir($dossier); 
  rsort($liste);
  foreach ($liste as $val) {
    $table .= '<td><img src="'.$val.'" alt="'.$val.'" /></td>'."\n";
  }
} 
$table .= '</tr></table>'; 
echo $table; 
?>
</div>
</body> 
</html>