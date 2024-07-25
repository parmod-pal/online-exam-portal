<?php 
if(!isset($_SESSION)){session_start();}
include "common/function.php";

date_default_timezone_set('asia/kolkata');

$base_path="http://".$_SERVER['SERVER_NAME']."/business/";


error_reporting(E_ALL);
ini_set('display_errors', 'On');
$date=date('Y-m-d H:i:s');
$rndnum=randomNum();
$error='';$enb="lgn";$chk=0;
if(isset($_REQUEST['submit']))
{
	$usname=trim($_POST['fname']);
	$emailid=trim($_POST['email']);
	$pswd=trim($_POST['password']);
	$errors=array();
	if(strlen($usname) == 0)
	array_push($errors,"Enter Name");
	if(strlen($emailid) == 0)
	array_push($errors,"Enter Email id");
	if(strlen($pswd) == 0)
	array_push($errors,"Enter password");
	if(empty($errors)){
		$team_det['name']=$_POST['fname'];
		$team_det['username']=$_POST['fname'];
		$team_det['emailid']=$_POST['email'];
		$team_det['password']=md5($_POST['password']);
		$team_det['dateofcreation']=$date;
		$team_det['dateofupdation']=$date;
		$team_det_id=insert('userdet',$team_det);
		
		unset($_POST);
		if($team_det_id == "exists") {
			$chk=1;			
					
			array_push($errors,'Email Id already exists');
		}
		else if($team_det_id > 0)
		{
			$success="<p class='outputs'>Profile Created Successfully</p>";
			
			$nsubject= "Rimsr Game Registration Acknowledgement (www.rimsr.in)";
			$nfrom='info@rimsr.in';
			$nto=$emailid;		
			$nbody = "<!DOCTYPE html>
					<html lang='en'>
					<head>
						<title>RIMSR</title>
					</head>
					<body>																	
					<div style='width:85%;margin-top:20px;margin-right:auto;margin-left:auto;'>
						<div style='text-align:center;width:100%;'>	
							<a href='http://www.rimsr.in/' target='_blank'> <img src='http://www.rimsr.in/business/images/emaillogo.jpg' style='margin:0 auto;max-width:100%;'></a>				
							<img src='http://www.rimsr.in/business/images/emailhead.jpg' style='margin:0 auto;max-width:100%;'>
						</div>
						<div style='width:100%;padding-left:43px;margin-top:30px;font-size:14px;font-family:arial;line-height:20px;'>
							<p>Dear <strong>$usname</strong>,</p>
							<p>Thank you for registering with our Business Game.</p>
							<p>Here is your login details:-<br/>Login Id:<strong>$emailid</strong><br/>Password:<strong>$pswd</strong> <br/><br/>Regards,<br/>Team RIMSR</p>
						</div>
						<div style='background-color:#000;color:#fff;padding:10px;margin-top:30px;'>
							<a href='mailto:registrar@rimsr.in' style='color:#fff;padding-left:40px;'>registrar@rimsr.in</a>
						</div>
					</div>
					</body></html>";
					require_once('Classes/class.phpmailer.php');					
					$mail             = new PHPMailer();						
					$mail->IsSMTP(); // telling the class to use SMTP
					$mail->SMTPAuth   = true; // enable SMTP authentication
					$mail->Sendmail   = '/usr/sbin/sendmail';
					$mail->Mailer = "smtp";
					$mail->SMTPSecure = "ssl";               		// sets the prefix to the servier
					$mail->Host       = "mail.rimsr.in";      		// sets azillesoft as the SMTP server
					$mail->Port       = '465';                  	 	// set the SMTP port for the azillesoft server
					$mail->Username   = "info@rimsr.in";  	// azillesoft username
					$mail->Password   = "qwer_!@#4";		// azillesoft password
					$mail->ContentType = "text/html";
					$mail->SetFrom($nfrom, 'RIMSR');
					
					$mail->Subject    = $nsubject;

					$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

					$mail->MsgHTML($nbody);
					
					$mail->AddAddress($nto);

					$mail->Send();
			$chk=2;
			//header('location:index.php');
		}
		else
		{
			array_push($errors,'Process Failed');
		}
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='outputf'>$val</p>";
	}
	$enb="lgn";
}
?>
<?php include 'common/header.php';?>	
	<div class="maincontent">
	<div class="container">
	<div class="col-md-3 col-sm-12 col-xs-12"></div>
	<div class="col-md-6 col-sm-12 col-xs-12">
	<div >
		<h2 class="main-head">My Business - My Strategies</h2>
		</div>
	<div class="panel panel-default">
		<div class="panel-heading">
		<p class="login-box-msg">Register a new user</p>
		</div>
		<div class="panel-body">
		<form action="" method="post" name="reg" id="reg">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="fname" name="fname" placeholder="Full name" required >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Retype password" required >
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            
				<input type="checkbox" checked class="checkbox" name="rem" value="yes" id="rem" required >
               &nbsp;&nbsp; I agree to the <a href="#">terms</a>
            
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>   

    <a href="index.php" class="text-center"> I already have a membership</a>
		</div>
		<div class="col-md-3 col-sm-12 col-xs-12"></div>
		</div>
		</div>
	</div>
</div>
<?php include 'common/footscript.php';?>

<div class="modal video-modal fade" id="regsuc" tabindex="-1" role="dialog" aria-labelledby="regsuc" style="width:50%;margin:0 auto;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="text-center poptitle">Message<button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
			</div>
			<div class="modal-body">	
				<div class="alert-default instruc text-center">					
					<h2 class="success">YOUR REGISTRATION IS SUCCESSFUL.</h2>
					<a class="btn btn-primary" href="myprofile.php?act=g">SIGN IN</a><br/><br/>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal video-modal fade" id="regfail" tabindex="-1" role="dialog" aria-labelledby="regfail" style="width:50%;margin:0 auto;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="text-center poptitle">Message<button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
			</div>
			<div class="modal-body">	
				<div class="alert-default instruc text-center">					
					<h2 class="error">YOUR ARE ALREADY REGISTERED.</h2>
					<a class="btn btn-primary" href="myprofile.php?act=g">SIGN IN</a><br/><br/>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
		<!-- iCheck -->
<script src="js/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script src="js/jquery.validate.js"></script>
<!-- jQuery Form Validation code -->
<script>  
// When the browser is ready...
$(function() {
var c='<?php echo $chk;?>'; 
if(c== 1)
{
	$('#regfail').modal('show');
}
if(c== 2)
{
	$('#regsuc').modal('show');
}	
    // Setup form validation on the #register-form element		
    $("#reg").validate({    
        // Specify the validation rules
        rules: {
			fname:"required",
			email:{required:true,email:true},
			password:"required"	,
			cpassword: {
				required:true,
				equalTo: "#password"
			},
			rem:"required"
        },        
        // Specify the validation error messages
        messages: { 				
            fname: "Enter Name",	
			email:{required:"Enter Email Id",email:"Enter Valid Email Id"},
			password: "Enter password",
			cpassword: {
				required:"Enter Confirm Password",
				equalTo: "Enter Confirm Password Same as Password"
			},
			rem:"Accept Terms and Conditions"
        },        
        submitHandler: function(form) {	
            form.submit();
        }
    });
	
	
});  
setTimeout( "$('.outputs,.outputf').hide();", 4000);
</script>
</html>
