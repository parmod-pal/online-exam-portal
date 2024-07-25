<?php
require_once 'function.php';
$id='';
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}	
$link=open_database_connection();
$sqlid =mysql_query("SELECT * FROM programdet where id='".$id."'",$link);	
if($sqlid>0)
{
	if(mysql_num_rows($sqlid)>0)
	{
		while($data=mysql_fetch_array($sqlid))
		$res='<select name="cprogram" id="cprogram" disabled>
				<option value="'.$id.'">'.$data['programname'].'</option>
			</select>';				
	}
}
close_database_connection($link);
echo $res;
?>