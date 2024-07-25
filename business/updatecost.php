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

/* if($expdate < $curdate)
{
	array_push($errors,"Payment is pending. Please pay and start again");
} */

/* if(isset($_SESSION['payid']) == '') 
{
	array_push($errors,"Payment is pending. Please pay and start again");
} */
foreach($_POST as $key=>$val)
{	
	if(strlen($_POST[$key]) == 0)
	{
		array_push($errors,"Enter all the required fields");		
		break;
	}
}

 if ( ! empty($errors)) {
	// if there are items in our errors array, return those errors
	$data['success'] = false;
	$data['errors']  = $errors;
} else {	
	foreach($_POST as $key=>$val)
	{
		if($key != 'tbl')
		{
			$team_det[$key]=str_replace(',','',$val);
		}		
	}
	$table=$_POST['tbl'];	
	$team_det['dateofupdate']=$date;
	
	$team_det_id=update($table,$team_det,array('userid'=>$_SESSION['rim_userid'],'payment_id'=>$_SESSION['payid']));
	
	
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