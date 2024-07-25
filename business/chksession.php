<?php 
include 'common/function.php';
if(!isset($_SESSION)){session_start();}
date_default_timezone_set('asia/kolkata');
$curdate=strtotime(date('Y-m-d H:i:s'));
$expdate='';
$expdate=strtotime($_POST['exp']);
if($expdate < $curdate)
{
	$upd['game_status']=1;
	$update = updatestat('userdet',$upd,array('id'=>$_SESSION['rim_userid']));
	echo '0';
} 
else
{
	echo '1';
}
?>