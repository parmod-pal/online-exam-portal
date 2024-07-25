<?php 
if(!isset($_SESSION)){session_start();}
include "common/function.php";

date_default_timezone_set('asia/kolkata');

$cur_sign='rupee';
if(isset($_SESSION['currency'])) 
{
	$cur_sign=$_SESSION['currency'];
}
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if(isset($_SESSION['rim_userid']) == '') 
{
	header('location:index.php');
	exit;
}

$usrname=$profimg1=$output=$name=$email=$phone=$addr='';
if(isset($_SESSION['rim_userid']))
{
	$uid=$_SESSION['rim_userid'];	
}
if($uid !='')
{
	$teamdet=select("select * from userdet where id=$uid");			
	if(count($teamdet)>0)
	{	
		foreach($teamdet as $tm => $data)
		{			
			$usrname=$data['username'];
			$email=$data['emailid'];
			$profimg1=$data['profimg'];
			$name=$data['name'];
			$addr=$data['address'];
			$phone=$data['phoneno'];
		}
	}
}


$date=date('Y-m-d H:i:s');
 
?>
<?php include 'common/header.php';include 'common/topnav.php';?>	
<div class="maincontent">
	<div class="container">	
		<div>
			<h2 class="main-head">My Business - My Strategies</h2>
		</div>	
		<div class="clearfix"></div>
		<div class="row">			
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default itab" id="default_img">
					<div class="panel-body">
						<?php
						//Get payment information from PayPal
						$item_number = $_SESSION['rim_userid']; 
						$item_name = $_GET['item_name'];
						$txn_id = $_GET['tx'];
						$payment_gross = $_GET['amt'];
						$currency_code = $_GET['cc'];
						$payment_status = $_GET['st'];
						if($currency_code=='INR')
						{
							$productPrice = 499;
						}
						else
						{
							$productPrice = 19.99;
						}

						 if(!empty($txn_id) && $payment_gross == $productPrice){
							//Check if payment data exists with the same TXN ID.
							
							$teamdet=select("select id from payment WHERE txn_id = '".$txn_id."'");			
							if($teamdet != false)
							{	
								foreach($teamdet as $tm => $data)
								{	
									$payment_id = $data['id'];
								}
							}
							else
							{
							
								$ins_det['userid']=$_SESSION['rim_userid'];
								$ins_det['purpose']=$item_name;
								$ins_det['payment_status']=$payment_status;
								$ins_det['payment_amount']=$payment_gross;
								$ins_det['payment_currency']=$currency_code;
								$ins_det['txn_id']=$txn_id;
								$ins_det['dateoftrans']=$date;
								$payment_id = insert("payment",$ins_det);
								if($payment_id > 0)
								{
									$upd['payment']=$payment_id;
									$upd['game_status']=0;
									$upd['expiry']='0000-00-00 00:00:00';
									$update=updatestat('userdet',$upd,array('id'=>$_SESSION['rim_userid']));
									
									$nsubject= "Rimsr Game Payment Acknowledgement (www.rimsr.in)";
									$nfrom='info@rimsr.in';
									$nto=$email;		
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
												<div style='width:100%;margin-top:30px;padding-left:43px;font-size:14px;font-family:arial;line-height:20px;'>
													<p>Dear <strong>$usrname</strong>,</p>
													<p>Your payment is successful.</p>
													<p>Here is your payment details:-<br/>Amount:<strong>$payment_gross</strong><br/>Payment Id:<strong>$payment_id</strong><br/>Transaction Id:<strong>$txn_id</strong> <br/><br/>Regards,<br/>Team RIMSR</p>
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
								}							
							}
							$_SESSION['payid']=$payment_id; 
						?>
							<h1 class="text-center">Your Payment is Successful.</h1>
							
 
<h2 class="text-center">Go to My Profile page and start your game now. </h2><br/>

<p class="text-center">The duration of the game is 3 hours.  If you intend exceeding the duration of the game, you have to log-in afresh after the expiry of 3 hours. <br/>
The history of the game is available in the page  "Game History"</p>

						<?php  }else{ ?>
							<h1>Your payment has failed.</h1>
						<?php }  ?>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php include 'common/footscript.php';?>
</body>
<link rel="stylesheet" href="css/jquery.ui.css" >
    <script src="js/jquery.ui.js"></script>
		<!-- iCheck -->
<script src="js/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
	window.setTimeout(function(){window.location.href="http://www.rimsr.in/business/myprofile.php?act=g";}, 20000);
  });
 
</script>

</html>
