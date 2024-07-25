<?php
include_once "function.php";
$pid='';$fname='';$r='fail';$sid='';
$ano='';$chkadmno=0;
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
$dat=date('Y-m-d');	
$studlist=createmarksheet($ano);		
foreach($studlist as $slist)
{	
	$pid=$slist['programid'];
	$fname=$slist['firstname'];
	$sid=$slist['id'];	
}
session_start();
if(isset($_SESSION['rep'])!= 'reprintprov')
{
	$link=open_database_connection();
	$sqlid =mysql_query("SELECT * FROM provisional where admissionno='".$ano."'",$link);
	if($sqlid>0)
	{			
		if(mysql_num_rows($sqlid)>0)
		{	   
			$chkadmno=1;			
		}
	}
	if($chkadmno==0)
	{
		$sql = "INSERT INTO provisional(admissionno,studentid,programid,dateofissue) VALUES ('".$ano."','".$sid."','".$pid."','".$dat."')";	
		$result=mysql_query($sql,$link);
	}
	else
	{
		$result=0;
		$r='issued';
	}
	close_database_connection($link);
}
else
{
	$result=1;
	unset($_SESSION['rep']);
}
if($result>0)
{
	$r='success';
}
echo $r;
?>