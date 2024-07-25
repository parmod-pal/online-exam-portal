<?php
ob_start();
ini_set('display_errors','off');
if(!isset($_SESSION)){session_start();}
$appid='';$_SESSION['appid']=$_SESSION['dappid']=$_SESSION['napp']=$_SESSION['gappid']=$_SESSION['intappid']='';$_SESSION['enc']='nil';
if(isset($_REQUEST['app']))
{
	$_SESSION['appid']=$_REQUEST['app'];
	unset($_SESSION['gappid']);
	unset($_SESSION['dappid']);
	unset($_SESSION['napp']);
	unset($_SESSION['intappid']);
}
if(isset($_REQUEST['napp']))
{
	$_SESSION['napp']=$_REQUEST['napp'];
	unset($_SESSION['gappid']);
	unset($_SESSION['dappid']);
	unset($_SESSION['appid']);
	unset($_SESSION['intappid']);
}
if(isset($_REQUEST['gapp']))
{
	$_SESSION['gappid']=$_REQUEST['gapp'];
	unset($_SESSION['appid']);
	unset($_SESSION['napp']);
	unset($_SESSION['dappid']);
	unset($_SESSION['intappid']);
}
if(isset($_REQUEST['dapp']))
{
	$_SESSION['dappid']=$_REQUEST['dapp'];
	unset($_SESSION['appid']);
	unset($_SESSION['gappid']);
	unset($_SESSION['napp']);
	unset($_SESSION['intappid']);
}
if(isset($_REQUEST['intapp']))
{
	$_SESSION['intappid']=$_REQUEST['intapp'];
	unset($_SESSION['appid']);
	unset($_SESSION['dappid']);
	unset($_SESSION['gappid']);
	unset($_SESSION['napp']);
}
if(isset($_REQUEST['enc']))
{
	$_SESSION['enc']=$_REQUEST['enc'];	
}
/**
 * HTML2PDF Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */		
if($_SESSION['appid'] != '' || $_SESSION['napp'] != '' || $_SESSION['gappid'] != '' || $_SESSION['dappid'] != ''|| $_SESSION['intappid'] != '')
{
	

	//include(dirname(__FILE__).'apphtml.php?appid='.$appid);
	if($_SESSION['appid'] != '')
	{
		include("apppdf.php");
	}
	else if($_SESSION['gappid'] != '')
	{
		include("gapppdf.php");
	}
	else if($_SESSION['napp'] != '')
	{
		include("napppdf.php");
	}
	else if($_SESSION['dappid'] != '')
	{
		include("dapppdf.php");
	}
	else if($_SESSION['intappid'] != '')
	{
		include("intapppdf.php");
	}
	else
	{
		include("globalapppdf.php");
	}
	$content = ob_get_clean();
	// convert in PDF
	require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P', 'A4', 'fr');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output('application.pdf');
	}
	catch(HTML2PDF_exception $e) {
		echo $e;
		exit;
	}
}
else
{
	echo "No Application Found";
}
?>