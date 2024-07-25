<?php 
include 'common/function.php';
if(!isset($_SESSION)){session_start();}
$pstat='';
$gstat=$expd=$payment=$pstatus=$rep=0;
if(isset($_REQUEST['r']))
{
	$rep=$_REQUEST['r'];
}
date_default_timezone_set('asia/kolkata');
$expdate=date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s',strtotime("+3 hours"))));
if($rep == 0)
{
	$upd['expiry']=$expdate;
	$update = updatestat('userdet',$upd,array('id'=>$_SESSION['rim_userid']));
	$_SESSION['expiry']=$expdate;
}


$teamdet=select("select * from userdet where id='".$_SESSION['rim_userid']."'"); 			
if($teamdet != '' && $teamdet[0] != false)
{	
	foreach($teamdet as $tm => $data)
	{
		$gstat=$data['game_status'];
		$payment=$data['payment'];
	}
}
$teamd=select("select payment_status from payment where userid='".$_SESSION['rim_userid']."' and id='".$payment."'"); 			
if($teamd != '' && $teamd[0] != false)
{	
	foreach($teamd as $tm => $dat)
	{
		$pstat=$dat['payment_status'];	
	}
}
if($pstat=='Completed')
{
	$pstatus = 1;
}
echo $gstat.','.$pstatus.','.$rep;
?>