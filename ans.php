<?php
session_start();
$appid='';$_SESSION['qid']='';$_SESSION['qd']='';
$_SESSION['uid']='';

require_once 'dompdf/autoload.inc.php'; 
use Dompdf\Dompdf; 
$dompdf = new Dompdf();

if(isset($_GET['uid']))
{
	$_SESSION['uid']=$_GET['uid'];
}
if(isset($_GET['qid']))
{
	$_SESSION['qid']=$_GET['qid'];
}
if(isset($_GET['qd']))
{
	$_SESSION['qd']=$_GET['qd'];
}
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */		
if($_SESSION['uid'] != '' && $_SESSION['qid'] != '' && $_SESSION['qd'] != '')
{
	// get the HTML
	ob_start();
	//include(dirname(__FILE__).'apphtml.php?appid='.$appid);
	include("testans.php");
	$content = ob_get_clean();

	// convert in PDF
	require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	try
	{
// 		$html2pdf = new HTML2PDF('P', 'A4', 'fr');
// 		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
// 		$html2pdf->Output('Answersheet.pdf');
		
		$setHtml = $content;
    $dompdf->loadHtml($setHtml);
    $dompdf->render(); 
    $dompdf->stream("Answersheet.pdf", array("Attachment" => 1));
		
	}
	catch(HTML2PDF_exception $e) {
		echo $e;
		exit;
	}
}
else
{
	echo "No Answer Sheet Found";
}
?>