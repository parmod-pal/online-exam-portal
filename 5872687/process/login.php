<?php
require_once 'function.php';
session_start();
if(isset($_REQUEST['submit']))
{
	if($_REQUEST['action']=="login")
	{
		$link=open_database_connection();
		$pswd=md5($_REQUEST['pswd']);
		$usrname=mysql_real_escape_string($_REQUEST['usrname']);
		$sqlid =mysql_query("SELECT * FROM logindet where username='".$usrname."' and password='".$pswd."'",$link);			
		if($sqlid>0)
		{
			if(mysql_num_rows($sqlid)>0)
			{
				while($row =mysql_fetch_array($sqlid))
				{			
					$_SESSION['login'] = 1;
					$_SESSION['usrname'] = $usrname;
					$_SESSION['usrtyp'] = $row['usrtype'];
					$_SESSION['usrmail']=$row['email'];
					$m="welcome";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=welcome&a=template">';
				}
			}
			else
			{						
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=login&a=template">'; 
			}
			
		}
		else
		{		
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=login&a=template">'; 		
		}
		close_database_connection($link);
	}	
}
?>