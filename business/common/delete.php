<?php
include_once 'function.php';
//ini_set('display_errors', 1);
$id=$tb='';$val=0;
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
if(isset($_REQUEST['tb']))
{
	$tb=$_REQUEST['tb'];
}
$members = delval($tb,$id);
if(count($members)>0)
{
	$val=1;
}	
echo $val;
?>	