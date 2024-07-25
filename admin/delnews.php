<?php
include_once 'function.php';
//ini_set('display_errors', 1);
$id=$im='';$val=0;
if(isset($_REQUEST['qid']))
{
	$id=$_REQUEST['qid'];
}
if(isset($_REQUEST['im']))
{
	$im=$_REQUEST['im'];
}
$members = delnews("latestnews",$im,$id);
if(count($members)>0)
{
	$val=1;
}	
echo $val;
?>	