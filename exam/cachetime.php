<?php
if(!isset($_SESSION)){session_start();}

if(isset($_REQUEST['m']	))
{
	$_SESSION['min']=$_REQUEST['m'];
}
if(isset($_REQUEST['s']	))
{
	$_SESSION['sec']=$_REQUEST['s'];
}
?>