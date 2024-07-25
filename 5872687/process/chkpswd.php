<?php
require_once 'function.php';
session_start();
$res='fail';$f='';
if(isset($_REQUEST['f']))
{
	$f=$_REQUEST['f'];
}	
$link=open_database_connection();
$pswd=md5($_REQUEST['f']);
$usrname=$_SESSION['usrname'];
$usrtyp=$_SESSION['usrtyp'];
if($usrtyp =="Admin" || $usrtyp == "Super Admin")
{
	$sqlid =mysql_query("SELECT * FROM logindet where username='".$usrname."' and password='".$pswd."'",$link);	
	if($sqlid>0)
	{
		if(mysql_num_rows($sqlid)>0)
		{			
			$_SESSION['login'] = 1;
			$res="success";				
		}
	}
}
else
{
	$_SESSION['login'] = 1;
	$res="restrict";	
}

close_database_connection($link);
echo $res;
?>