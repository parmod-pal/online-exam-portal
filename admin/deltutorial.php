<?php
include_once 'function.php';
//ini_set('display_errors', 1);
$id=$im='';$val=0;
if(isset($_REQUEST['qid']))
{
	$id=$_REQUEST['qid'];
}
$members = delval("tutorial",$id);
if(count($members)>0)
{
	$val=1;
}	
echo $val;
?>	