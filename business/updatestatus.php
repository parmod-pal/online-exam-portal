<?php include "common/function.php";
$date=date('Y-m-d H:i:s');
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data
$table='';
if(isset($_SESSION['rim_userid']) == '') 
{
	array_push($errors,"User Id is empty. Please login and try again");
}
$curdate=strtotime(date('Y-m-d H:i:s'));
$expdate=strtotime(date('Y-m-d H:i:s',strtotime($_SESSION['expiry'])));
 if ( ! empty($errors)) {
	// if there are items in our errors array, return those errors
	$data['success'] = false;
	$data['errors']  = $errors;
} else {	
	$table='userdet';	
	$team_det['game_status']=1;
	$team_det['dateofupdation']=$date;	
	$team_det_id=updatestat($table,$team_det,array('id'=>$_SESSION['rim_userid']));	
	unset($_POST);
	if($team_det_id > 0)
	{
		$data['success'] = true;
		$data['errors']  = '';
	}
	else
	{	
		$data['success'] = false;
		$data['errors']  = $errors;
	}
}
echo json_encode($data);
?>