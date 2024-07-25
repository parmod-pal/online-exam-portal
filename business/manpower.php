<?php 
include "common/function.php";

$date=date('Y-m-d H:i:s');
$val=$_REQUEST['data'];
$chk=0;$table="manpowerdet";
foreach($val as $key)
{	
	$mp=$key[0];
	$ms = $key[1];
	$wc = $key[2];
	$inc = $key[3];
	$bonus = $key[4];
	$cate=$key[5];

	$team_det['category']=$cate;
	$team_det['manpower']=str_replace(',','',$mp);
	$team_det['salary']=str_replace(',','',$ms);
	$team_det['welfarecost']=str_replace(',','',$wc);
	$team_det['incentive']=str_replace(',','',$inc);
	$team_det['bonus']=str_replace(',','',$bonus);	
	$team_det['payment_id']=$_SESSION['payid'];
	$team_det['userid']=$_SESSION['rim_userid'];
	
	if(chkpayment($table,$team_det) > 0)
	{		
		$team_det['dateofupdate']=$date;
		$team_det_id=update($table,$team_det,array('userid'=>$_SESSION['rim_userid'],'payment_id'=>$_SESSION['payid'],'category'=>$cate));
	}
	else
	{
		$team_det['dateofstart']=$date;
		$team_det['dateofupdate']=$date;
		$team_det_id=insert($table,$team_det);
	}	
}
echo 1;

?>