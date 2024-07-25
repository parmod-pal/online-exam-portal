<?php
require_once 'config.php';
global $conn;
$con=$conn;
$res='fail';$f='';$p='';
if(isset($_REQUEST['f']))
{
	$f=$_REQUEST['f'];
}
if(isset($_REQUEST['p']))
{
	$p=$_REQUEST['p'];
}
$pswd=$p;	
$fname=$f;
$sqlid =mysqli_query($con,"SELECT * FROM wp_filepswd where filename='".$f."' and password='".$p."'");	
if($sqlid>0)
{
	if(mysqli_num_rows($con,$sqlid)>0)
	{		
		$res="success";		
	}
}
echo $res;
?>