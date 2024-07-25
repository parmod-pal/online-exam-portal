<?php
if(!isset($_SESSION)){session_start();}
include "config.php";
$output = '';
if(isset($_POST['login'])){
    $data=$_POST;
    $data_arr=array();
	$errors=array();
    if($data['username']!='')
    {
		$data_arr['username']=$data['username'];
    }
    else
    {
		$errors[]='Please enter Username';
    }
	if($data['pswd']!='')
    {
		$data_arr['password']=md5($data['pswd']);
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
			$ustype=$profile_member[0]['usertype'];
			$_SESSION['username']=$username;
			$_SESSION['usid']=$memID;
			$_SESSION['usrtyp']=$ustype;
			echo "<script type='text/javascript'>location.href='ques.php'</script>";			
			exit;
			ob_flush();			
			
		}
		else
		{
		   $errors[]=' Login failed. Either Username or Password is invalid.';
		}
	}
	//Prepare errors for output
	
	foreach($errors as $val) {
		$output .= "<p class='output'>$val</p>";
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!--<link rel="shortcut icon" href="images/logoicon.png"/>-->
    <title>RIMSR: Upload Questions</title>    
	<link type="text/css" href="css/addmovie.css" rel="stylesheet"/>
	<link type="text/css" href="css/kinder.css" rel="stylesheet"/>	 
	<script type="text/javascript" src="js/jquery.js"></script>    
	<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>
</head>
<body onload="">
<div class="wrapper">	
<div style="width:100%;border-bottom:2px solid #0A50A1; ">	
		<img src="images2/logo.jpg" style="float:left;margin-top:10px;margin-left:20px;"/>		
		<br/>
	<p style="padding-top:40px;margin-left:25px;width:600px;"><strong><font color="#0A50A1" size="4.95px" face="Verdana, Arial, Helvetica, sans-serif">Rangnekar Institute of Management Studies and Research</font></strong></p>
</div>
				
	<div class="admin_panel">
	<div style="clear:both;"></div><br/>
		<div class="admin_form" style="width:335px;">		
			<form name="frm1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<?php echo $output; ?>
				<div class="addmovie_details" style="width:auto;text-decoration:underline;font-family:arial;font-weight:bold;font-size:12px;margin-left:110px;margin-top:20px;"> Staff Panel</div>
				<div style="clear:both;"></div><br/>
				<div class="formlabel">Username</div>
				<div class="form_text_box">
					<input type="text" name="username" id="username" value="" style="width:150px; height:20px;"/>
				</div>
				<div style="clear:both"></div>
				<div class="formlabel">Password</div>
				<div class="form_text_box">
					<input type="password" name="pswd" id="pswd" value="" style="width:150px; height:20px;"/>
				</div>
				<div style="clear:both"></div>
				<div class="submit_form">				
					<input type="submit" name="login" id="submit" value="Login" style="width:80px; margin-right:10px;height:25px;cursor:pointer; border:none; background-color:#49729E;color:#FFF;float:left;" />
				</div>
			</form>
		</div>
	</div>	
</div>	
<!--bottom End -->
<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
	var frmvalidator  = new Validator("frm1"); 
	frmvalidator.addValidation("username","req","Enter Username");   
	frmvalidator.addValidation("pswd","req","Enter Password");	
  
//]]>
</script>
</body>
</html>