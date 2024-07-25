<?php 
if(!isset($_SESSION)){session_start();}
include "common/function.php";

date_default_timezone_set('asia/kolkata');
$date=date('Y-m-d H:i:s');
$base_path="http://".$_SERVER['SERVER_NAME']."/business/";


error_reporting(E_ALL);
ini_set('display_errors', 'On');

if(isset($_SESSION['rim_userid']) != '') 
{
	header('location:myprofile.php');
	exit;
}
$error=$output=$success='';$enb="lgn";
if(isset($_REQUEST['login']))
{
	$user=trim($_POST['usname']);
	$password = md5($_POST['pswd']);	
	if($_POST['usname'] != "" && $_POST['pswd'] != "")
	{		
		$result=load_user($user,$password);		
		if(count($result) > 0)
		{		
			if($user==$result['mailid'] && $password==$result['pass'] && $result['usrtype'] == 1){			
				$_SESSION['login'] = 1;
				$_SESSION['rim_userid']=$result['id'];
				$_SESSION['expiry']=$result['expiry'];
				$_SESSION['email']=$result['mailid'];
				$_SESSION['lusrname']=$result['lusername'];
				$_SESSION['gstat']=$result['gstat'];
				$_SESSION['lgtype']=$result['usrtype'];
				$_SESSION['invbase_path']=$base_path;
				$remember=isset($_POST['rem']);
				if ($remember == "yes") //if the Remember me is checked, it will create a cookie.
				{
					setcookie("usid", $result['id'], time()+60*60*24*30, "/");
					setcookie("email", $result['mailid'], time()+60*60*24*30, "/");
					setcookie("pswd", $_POST['pswd'], time()+60*60*24*30, "/");
					setcookie("rem", 1, time()+60*60*24*30, "/");									
				}
				else if ($remember=="") //if the Remember me isn't checked, it will create a session.
				{
					setcookie("usid", $result['id'], time()-3600, "/");
					setcookie("email",  $result['mailid'], time()-3600, "/");
					setcookie("pswd", $_POST['pswd'], time()-3600, "/");
					setcookie("rem", 1, time()-3600, "/");																	
				}
					
				$pres=pay($result['id']);	
				if(count($pres)>0)
				{
					$_SESSION['payid']=$pres['payid'];
				}
				else
				{
					$_SESSION['payid']='';
				}
				
				/* $curdate=strtotime(date('Y-m-d H:i:s'));
				$expdate=strtotime(date('Y-m-d H:i:s',strtotime("+3 hours")));
				$_SESSION['expiry']=$expdate; */
				
				$expdate=strtotime(date('Y-m-d H:i:s',strtotime($result['expiry']))); 
				$_SESSION['expiry']=$expdate;
								
				if($_SESSION['rim_userid'] != '' && $_SESSION['lgtype'] == 1  ) 
				{
					header('location:myprofile.php');					
				} 
				else{			
					$error="invalid login";		 
				}
				
				//Something to write to txt log
				$log  = date("M d, Y, h:i:s a").' : '.$result['lusername'].' logged in '.PHP_EOL;
				//Save string to log, use FILE_APPEND to append.
				file_put_contents('log/'.date("Ymd").'-RIMSR-Logfile.txt', $log, FILE_APPEND);
				
			}else{			
				$error="invalid login";		 
			}		
		}
		else
		{ 
			//echo count($result);
			$error="invalid login";	
		}
	}
	
	$output = "<p class='outputf'>$error</p>";
	$enb="lgn";
}
function pay($user){
    global $con;
    $select = array();
    $sql = "SELECT id FROM payment WHERE userid = '".$user."' order by id desc limit 1";
     $data = mysqli_query($con,$sql);
         //var_dump($data);
   while($result=mysqli_fetch_assoc($data)){
        //var_dump($result);
        $select['payid']=$result['id'];
    }  
    return $select;    
}

function load_user($user,$password){
    global $con;
    $select = array();
    $sql = "SELECT * FROM userdet WHERE emailid = '".$user."' AND password = '".$password."' AND usrtype = 1";
     $data = mysqli_query($con,$sql);
         //var_dump($data);
   while($result=mysqli_fetch_assoc($data)){
        //var_dump($result);
        $select['mailid']=$result['emailid'];
        $select['pass']=$result['password'];
		$select['lusername']=$result['username'];
        $select['id']=$result['id'];
		$select['usrtype']=$result['usrtype'];
		$select['payid']=$result['payment'];
		$select['expiry']=$result['expiry'];
		$select['gstat']=$result['game_status'];
    }  
    return $select;    
}


if(isset($_REQUEST['frgpswd']))
{
	$output=$success=$rndnum='';
	$femail=trim($_POST['femail']);
	$errors=array();
	if(strlen($femail) == 0)
	array_push($errors,"Enter Email Id");
	$rndnum=randomNum();
	$seccode=md5($rndnum);
	if(empty($errors)){
		$chkemail=0;
		$selteamid=select("select * from userdet where emailid='".$_POST['femail']."'");
		if(count($selteamid)>0 && $selteamid[0] !='')
		{
			$chkemail=1;
		}	
		if($chkemail==1)
		{
			$team_det['secretcode']=$seccode;
			$team_det['emailid']=$femail;
			$team_det['dateofupdation']=$date;
			$team_det_id=update('userdet',$team_det,array('emailid' => $_POST['femail']));			
			if($team_det_id > 0)
			{
				$to=$_POST['femail'];
				$from="info@rimsr.in";
				$subject="Reset Password Request";
				$msg='Dear member,<br/>
				Click the below link to create new password.<br/>
				<a href="'.$base_path.'chngpswd.php?s='.$seccode.'" target="_blank">'.$base_path.'chngpswd.php?s='.$seccode.'</a><br/>

				Regards,
				inventory';
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 
				// Create email headers
				$headers .= 'From: '.$from."\r\n".
					'Reply-To: '.$from."\r\n" .
					'X-Mailer: PHP/' . phpversion();
				$mailsent=mail("$to","$subject","$msg",$headers);
				if($mailsent > 0)
				{			
					$success="<p class='outputs'>Reset password link sent to your mail successfully</p>";
				}
				else
				{
					array_push($errors,'Process Failed');
				}
			}
			else
			{
				array_push($errors,'Process Failed');
			}
		}
		else
		{
			array_push($errors,'Sorry email id not exists');
		}
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='outputf'>$val</p>";
	}
	$enb="fpswd";
}

?>
<?php include 'common/header.php';?>	
	<div class="maincontent">		
		<div class="container">
		<div class="col-md-3 col-sm-12 col-xs-12"></div>
		<div class="col-md-6 col-sm-12 col-xs-12">
		<div>
			<h2 class="main-head">My Business - My Strategies</h2>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<p class="login-box-msg">Admin Login</p>
			</div>
			<div class="panel-body">
				<?php echo $output;?>		
				<form id="lgn" action="<?php echo $_SERVER['PHP_SELF'];?>" name="login" novalidate method="post">
					<input type="hidden" id="enb" name="usname" value="<?php echo $enb; ?>"/>
					<div class="form-group has-feedback">
						<input type="email" class="form-control" required placeholder="Email" id="usname" name="usname" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Password" id="pswd" name="pswd" required value="<?php if(isset($_COOKIE['pswd'])) echo $_COOKIE['pswd']; ?>">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>					
					<div class="row">
						<div class="col-xs-8">
						  <div class="checkbox icheck">
							<label>
							  <input type="checkbox" class="checkbox"  name="rem" value="yes" id="rem" <?php if(isset($_COOKIE['rem'])) echo 'checked="checked"'; ?>> <label for="rem" >Remember Me</label>	
							</label>
						  </div>
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
						  <button type="submit"  name="login" class="btn btn-primary ">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
					<a href="#" id="frgtpswd">I forgot my password</a><br>
				</form>
				<form id="frgpwd" class="m-t" role="form" method="post" name="frgpwd" action="./" novalidate style="display:none;" >
					<?php echo $output;?>	
					<?php echo $success;?>			
					<div class="form-group">
						<input type="email" class="form-control" name="femail" placeholder="Enter Registered Email" required>
					</div>	   
					<a class="btn btn-sm btn-white btn-primary" href="admin.php">login</a>
					<button type="submit" name="frgpswd" class="btn btn-primary">Reset Password</button>
				</form>
			</div>
			<div class="col-md-3 col-sm-12 col-xs-12"></div>
			</div></div>
		</div>		
	</div>
	
	
	<?php include 'common/footscript.php';?>
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
    // Setup form validation on the #register-form element		
    $("#lgn").validate({    
        // Specify the validation rules
        rules: {
			usname:"required",
			pswd:"required"
        },        
        // Specify the validation error messages
        messages: { 				
            usname: "Enter Registered Email Id",			
			pswd: "Enter password"
        },        
        submitHandler: function(form) {	
			localStorage.setItem('actid','')
            form.submit();
        }
    });
	$("#frgtpswd").validate({    
        // Specify the validation rules
        rules: {
			femail:{required:true,email:true},
			pswd:"required"			
        },        
        // Specify the validation error messages
        messages: { 				
            femail: {required:"Enter email id",email:"Enter valid email"}
        },        
        submitHandler: function(form) {			
            form.submit();
        }
    });
	var val=$('#enb').val();
	if(val=="lgn")
	{
		$('#frgpwd').hide();
		$('#lgn').show();
	}
	else
	{
		$('#frgpwd').show();
		$('#lgn').hide();
	}
	
	$('#frgtpswd').on('click',function(){
		$('#frgpwd').show();
		$('#lgn').hide();
	});
	
});  
setTimeout( "$('.outputs,.outputf').hide();", 4000);
</script>
</html>
