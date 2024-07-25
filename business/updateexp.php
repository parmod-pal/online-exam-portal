<?php include "common/function.php";
if(!isset($_SESSION)){session_start();}
$date=date('Y-m-d H:i:s');
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data
$table='';
if(isset($_SESSION['rim_userid']) == '') 
{
	array_push($errors,"User Id is empty. Please login and try again");
}

$expdate=date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s',strtotime("+3 hours"))));
 if ( ! empty($errors)) {
	// if there are items in our errors array, return those errors
	$data['success'] = false;
	$data['errors']  = $errors;
} else {	
	$table='userdet';	
	$team_det['expiry']=$expdate;
	$team_det_id=updatestat($table,$team_det,array('id'=>$_SESSION['rim_userid']));	
	unset($_POST);
	if($team_det_id > 0)
	{
		$_SESSION['expiry']=$expdate;
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