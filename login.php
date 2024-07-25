<?php 
include "config.php";
session_start();
if(isset($_POST['login'])){
    $data=$_POST;
    $data_arr=array();
	$errors=array();
    if($data['userid']!='')
    {
		$data_arr['username']=$data['userid'];
    }
    else
    {
		$errors[]='Please enter student id';
    }
	if($data['password']!='')
    {
		$data_arr['password']=md5($data['password']);
    }
    else
    {
		$errors[]='Please enter password';
    }
	if(empty($errors))
	{		
		if(is_valid_data('userdet',$data_arr))
		{
			$profile_member_details	= _get('userdet',1,0,$data_arr);
			$profile_member		= _get('userdet',1,0,array('id'=>$profile_member_details[0]['id']));
			$memID=$profile_member[0]['id'];
			$username=$profile_member[0]['name'];
			$_SESSION['fullname']=$username;
			$_SESSION['rim_usid']=$memID;
			$_SESSION['saral']=$data['saral'];
			$_SESSION['usname']=$profile_member[0]['username'];
			$em='<div class="gen alert alert-success">Welcome to Rimsr E-Learning</div>';
			msg("e-learning.php",$em); 			
		}
		else
		{
			$em='<div class="gen alert alert-info">Invalid Student Id / Password. Try Again</div>';
			msg("index.php",$em);
		}	
		  
	}	
	else
	{
		$em='empty';
		msg("index.php",$em);
	}
}
?>
<?php
function msg($url,$em)
{
?>		<script type="text/javascript">
		//localStorage.setItem('cchkm','<?php echo $em;?>');		
		window.location="<?php echo $url;?>";
	</script>
<?php
}
?>