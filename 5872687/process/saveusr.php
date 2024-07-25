<?php
include "function.php";
$link=open_database_connection();
date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
if(isset($_POST['submit']))
{
	$usrname='';$email='';$usrtyp='';$pswd='';	
	$chkusrname=0;
	if($usrname !='')
	{	
		$sqlid =mysql_query('SELECT * FROM logindet where username='.$usrname,$link);
		if($sqlid>0)
		{			
			while($row =mysql_fetch_array($sqlid))
			{	   
				$chkusrname=1;			
			}
		}		
	}
	if($chkusrname==1)
	{
		msg("Username Already Exists");
	}
	else
	{
		$result=mysql_query("insert into logindet(username,email,usrtype,password,createddate) values('".$_POST['usrname']."','".$_POST['email']."','".$_POST['usrtyp']."','".md5($_POST['pswd'])."','".$date."')",$link);
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
	msg("User created successfully");
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