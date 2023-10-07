<?php
require_once './vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

ob_start();
require_once './pdflecture.php';

$html = ob_get_contents();
ob_end_clean();

$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
//$fichier = 'bl.pdf';
$dompdf->stream();
