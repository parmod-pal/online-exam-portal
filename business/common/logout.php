<?php
date_default_timezone_set('asia/kolkata');
session_start();
$r='';$utype =0;
if(isset($_REQUEST['r']))
{
	$r=$_REQUEST['r'];
}
if(isset($_SESSION['invbase_path']))
{
	$c_path=$_SESSION['invbase_path'];
}
else
{
	$c_path='../index.php';
}
if(isset($_SESSION['lgtype'])) 
{
	$utype = $_SESSION['lgtype'];
}
if($utype==1)
{
	$c_path='../admin.php';
}
//Something to write to txt log
$log  = "---------------------------------------".PHP_EOL . date("M d, Y, h:i:s a").' : '.$_SESSION['lusrname'].' logged out '.PHP_EOL . "---------------------------------------".PHP_EOL;
//Save string to log, use FILE_APPEND to append.
file_put_contents('../log/'.date("Ymd").'-UBPL-Logfile.txt', $log, FILE_APPEND);

session_unset();
$_SESSION = array();
if(isset($_COOKIE[session_name()])){
setcookie(session_name(),'',time()-42000,'/');}
setcookie('usid','',time()-3600,"/");
setcookie('email','',time()-3600,"/");
setcookie('pswd','',time()-3600,"/");
setcookie('rem','1',time()-3600,"/");
session_destroy();
if($r=='')
{
	header("location:$c_path");
}
else
{
	header("location:http://rimsr.in");
	
}
  
?>