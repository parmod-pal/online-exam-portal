<?php
session_start();
$uname=isset($_SESSION['usname'])?$_SESSION['usname']:'';
$pswd=isset($_REQUEST['p'])?$_REQUEST['p']:'';
$skey=isset($_REQUEST['k'])?$_REQUEST['k']:'';
$shkey=isset($_REQUEST['sk'])?$_REQUEST['sk']:'';
if($shkey != '')
{
	$fullpswd = 'tutorial' . $shkey . base64_decode($skey);
}
else
{
	$fullpswd = 'tutorial'.base64_decode($skey);
}
if($fullpswd == $pswd)
{
	echo 1;
}
else
{
	echo 0;
}
?>
