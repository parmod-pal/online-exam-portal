<?php
include "function.php";
$id='';
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
$link=open_database_connection();

$res =mysql_query("delete FROM logindet where id='".$id."'",$link);	

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=viewprofile&a=template">'; 

?>