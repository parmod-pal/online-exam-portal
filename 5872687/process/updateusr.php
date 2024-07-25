<?php
include "function.php";
if (!isset($_SESSION)) session_start();
$id='';	
if(isset($_SESSION['id']))
{
	$id=$_SESSION['id'];
}
$link=open_database_connection();
date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
if(isset($_POST['submit']))
{
	$usrname=$_POST['usrname'];$email=$_POST['email'];	
	if($usrname !='')
	{			
		$result=mysql_query("update logindet set username='".$usrname."',usrtype='".$_POST['usrtyp']."',email='".$email."' where id='".$id."'",$link);	
	}
	if($_POST['pswd'] !='')
	{			
		$result=mysql_query("update logindet set password='".md5($_POST['pswd'])."' where id='".$id."'",$link);	
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
	msg("User details updated successfully");
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