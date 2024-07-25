<?php
include "function.php";
$link=open_database_connection();
date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
if(isset($_POST['submit']))
{
	$usrname=$_POST['usrname'];$email=$_POST['email'];$usrid='';	
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
		$result=mysql_query("update logindet set email='".$email."' where id='".$usrid."' and username='".$usrname."'",$link);	
	}
}
else
{
	close_database_connection($link);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=viewprofile&a=template">'; 
}
if($result > 0)
{	
	close_database_connection($link);
	if (!isset($_SESSION)) session_start();
	if(isset($_SESSION['usrmail']))
	{
		$_SESSION['usrmail']=$email;
	}	
	msg("Profile updated successfully");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=viewprofile&a=template">'; 
}
?>
<?php
function msg($msg)
{?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
</script>
<?php } ?>