<?php
include "function.php";
$id='';$sid='';$pid='';
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
if(isset($_REQUEST['s']))
{
	$sid=$_REQUEST['s'];
}
if(isset($_REQUEST['p']))
{
	$pid=$_REQUEST['p'];
}
$link=open_database_connection();

$res =mysql_query("delete FROM experiance where id='".$id."'",$link);	
close_database_connection();

echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../index.php?m=edit&a=template&id=$sid&pid=$pid'>"; 

?>