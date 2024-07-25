<?php
include "function.php";
$link=open_database_connection();
date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
if(isset($_POST['submit']))
{
	$usrname=$_POST['usrname'];$pswd='';$usrid='';	
	if($usrname !='')
	{	
		$sqlid =mysql_query("SELECT * FROM logindet where username='".$usrname."'",$link);
		if($sqlid>0)
		{			
			while($row =mysql_fetch_array($sqlid))
			{	   
				$usrid=$row['id'];			
			}
		}
		$result=mysql_query("update logindet set password='".md5($_POST['password'])."' where id='".$usrid."' and username='".$usrname."'",$link);
	}
}
else
{
	close_database_connection($link);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=login&a=template">'; 
}
if($result > 0)
{	
	close_database_connection($link);
	msg("Password created successfully");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=login&a=template">'; 
}
?>
<?php
function msg($msg)
{?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
</script>
<?php } ?>