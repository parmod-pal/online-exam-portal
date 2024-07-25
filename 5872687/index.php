<?php 
session_start();
if(isset($_REQUEST['act']))
{
	if($_REQUEST['act']=="logout")
	{
		session_destroy();
		if(isset($_SESSION['login']))
		{
			unset($_SESSION['login']);
		}
		$_SESSION['login']=0;		
	}	
}
if(isset($_SESSION['id']))
{
	unset($_SESSION['id']);
}
if(isset($_SESSION['pid']))
{
	unset($_SESSION['pid']);
}
if(isset($_SESSION['admissionno']))
{
	unset($_SESSION['admissionno']);
}
require_once 'process/function.php';
$m='';$a='';
if(isset($_REQUEST['m']))
{
	$m = $_REQUEST['m'];
}
if(isset($_REQUEST['a']))
{
	$a = $_REQUEST['a']; 
}
if(isset($_REQUEST['srch']))
{
	$_SESSION['admissionno'] = $_REQUEST['srch']; 
	$m="edit";
}
if($m == ''){
	$m = 'login';
}
if($a == ''){
	$a = 'template';
}
if(isset($_REQUEST['id']))
{
	$_SESSION['id'] = $_REQUEST['id'];
}
if(isset($_REQUEST['pid']))
{
	$_SESSION['pid'] = $_REQUEST['pid']; 
}
if(isset($_SESSION['login']) != 1){	
	$m="login";	
}
include "includes/header.php";
?>
<div id="wrapper" class="wrapper">
<?php 	
	include $a."/".$m.".php";		
?>
</div>
<?php include "includes/footer.php";?>