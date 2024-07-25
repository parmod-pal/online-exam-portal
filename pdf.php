<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
 
// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
use Dompdf\Dompdf; 
$dompdf = new Dompdf();

 
    $setHtml = 'Abc';
    $dompdf->loadHtml($setHtml);
    $dompdf->render(); 
    $dompdf->stream("group-appointment", array("Attachment" => 1));


?>