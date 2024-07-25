<?php
require_once 'function.php';
$id='';
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}	
$link=open_database_connection();
$sqlid =mysql_query("SELECT * FROM coursedet where courseno='".$id."'",$link);	
if($sqlid>0)
{
	if(mysql_num_rows($sqlid)>0)
	{
		while($data=mysql_fetch_array($sqlid))
		$res='<input type="text" class="crname" name="cna" id="cna" value="'.$data['coursename'].'"/>';				
	}
}
close_database_connection($link);
echo $res;
?>