<?php
include_once "function.php";
$pid='';$fname='';$pay='';$paid='';$bal='';$r='fail';
$ano='';
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
$dat=date('Y-m-d');	
$studlist=selrpt2($pid,$ano);		
foreach($studlist as $slist)
{	
	$pid=$slist['programid'];
	$fname=$slist['firstname'];
	$mname=$slist['middlename'];
	$lname=$slist['lastname'];
	$gen=$slist['gender'];
	$pay=$slist['payable'];
	$paid=$slist['paid'];	
	$bal=$slist['payable']-$slist['paid'];
}
session_start();
if(isset($_SESSION['rep'])!='reprint')
{
	$link=open_database_connection();
	$sql = "INSERT INTO receipt(admissionno,firstname,middlename,lastname,gender,programid,payable,paid,balance,dateofpay) VALUES ('".$ano."','".$fname."','".$mname."','".$lname."','".$gen."','".$pid."','".$pay."','".$paid."','".$bal."','".$dat."')";	
	$result=mysql_query($sql,$link);
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