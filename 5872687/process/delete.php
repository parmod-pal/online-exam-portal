<?php
include "function.php";
$id='';$image='';$sslc='';$degree='';$addr='';$comm='';
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
$link=open_database_connection();
$sqlid =mysql_query("SELECT image,sslccertificate,degreecertificate,addrproof,communitycertificate FROM student_info where id='".$id."'",$link);	
while($row =mysql_fetch_array($sqlid))
{	   
	$image = $row['image'];			
	$sslc = $row['sslccertificate'];
	$degree = $row['degreecertificate'];
	$addr = $row['addrproof'];
	$comm = $row['communitycertificate'];
}

$path = array("/home/rimsr/public_html/5872687/upload/studimage/" .$image, "/home/rimsr/public_html/5872687/upload/sslc/" .$sslc,"/home/rimsr/public_html/5872687/upload/degree/" .$degree, "/home/rimsr/public_html/5872687/upload/address/" .$addr,"/home/rimsr/public_html/5872687/upload/community/" .$comm);

foreach($path as $fullpath)
{	
	if(file_exists($fullpath))
	{
		unlink($fullpath);
	}
}
$res =mysql_query("delete FROM student_info where id='".$id."'",$link);	
$res1 =mysql_query("delete FROM admission_details where studentid='".$id."'",$link);	
$res2 =mysql_query("delete FROM fee_details where studentid='".$id."'",$link);	
$res3 =mysql_query("delete FROM student_edu_details where studentid='".$id."'",$link);	
$res4 =mysql_query("delete FROM scholistic where studentid='".$id."'",$link);
$res5 =mysql_query("delete FROM experiance where studentid='".$id."'",$link);


echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=view&a=template">'; 

?>