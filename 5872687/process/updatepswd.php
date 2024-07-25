<?php
include "function.php";
$link=open_database_connection();
date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
if(isset($_POST['submit']))
{
	$usrname=$_POST['usrname'];$pswd='';$usrid='';$chkusr=0;	
	if($usrname !='')
	{	
		$sqlid =mysql_query("SELECT * FROM logindet where username='".$usrname."' and password='".md5($_POST['opswd'])."'",$link);
		if($sqlid>0)
		{			
			while($row =mysql_fetch_array($sqlid))
			{	   
				$usrid=$row['id'];
				$chkusr=1;				
			}
		}
		if($chkusr==1)
		{
			$result=mysql_query("update logindet set password='".md5($_POST['pswd'])."' where id='".$usrid."' and username='".$usrname."'",$link);
			$chkusr=0;
		}
		else
		{			
			msg("Username and Old Password Not match to the existing user");
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=viewprofile&a=template">'; 
		}
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
	msg("Password updated successfully");
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