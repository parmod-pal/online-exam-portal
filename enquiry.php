<?php
date_default_timezone_set("Asia/Kolkata");
ini_set('display_error',1);
$date=date('Y-m-d');
$em='Error';$mailsent=0;
if(isset($_POST['send']))
{
	$subject    = "Rimsr Enquiry Details (www.rimsr.in)";
	
	
	$body="Enquiry Details are given below \r\n \r\n 

	 Name :".$_POST['name']."\r\n 

	 Email :".$_POST['email']."\r\n 

	 Mobile :".$_POST['mobile']."\r\n 

	 Subject :".$_POST['subject']."\r\n

	 Message :".$_POST['msg']."\r\n\r\n\r\n Reply To My Mail ".$_POST['email']."\r\n \r\n \r\n

	 Thank you \r\n ".$_POST['name'];	
	
	 
	$to="registrar@rimsr.in";
	$from = "info@rimsr.in";
	require_once('Classes/class.phpmailer.php');					
	$mail             = new PHPMailer();						
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPAuth   = true; // enable SMTP authentication
	$mail->Sendmail   = '/usr/sbin/sendmail';
	$mail->Mailer = "smtp";
	$mail->SMTPSecure = "ssl";               		// sets the prefix to the servier
	$mail->Host       = "bh-in-3.webhostbox.net";      		// sets Rimsr as the SMTP server
	$mail->Port       = '465';                  	 	// set the SMTP port for the Rimsr server
	$mail->Username   = "info@rimsr.in";  	// Rimsr username
	$mail->Password   = "qwer_!@#4";		// Rimsr password
	$mail->ContentType = "text/html";
	$mail->SetFrom($from, 'Rimsr');
	
	$mail->Subject    = $subject;

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$mail->MsgHTML($body);
	
	$mail->AddAddress($to);

	if($mail->Send())
	{
		$mailsent=1;
	}	
	 
	 
	 
	if($_POST['chk'] == 'c')
	{
		if($mailsent >0)
		{ 	
			msg("contactus.php?e=3"); 
		}
		else
		{
			msg("contactus.php?e=1");
		}
	}
	if($_POST['chk'] == 'p')
	{
		if($mailsent >0)
		{ 	
			msg("payment.php?e=3"); 
		}
		else
		{
			msg("payment.php?e=1");
		}
	}
	else
	{
		if($mailsent > 0)
		{		
			$em='<div class="gen alert alert-success">Mail has been sent successfully</div>';
			mss("index.php",$em); 			
		}
		else
		{
			$em='<div class="gen alert alert-info">Process failed. Try after some time</div>';
			mss("index.php",$em);
		}	
	}
}
?>
<?php
function msg($url)
{
?>		<script type="text/javascript">	
		
		window.location="<?php echo $url;?>";
	</script>
<?php
}
function mss($url,$em)
{
?>		
	<script type="text/javascript">
		localStorage.setItem('chkm','<?php echo $em;?>');
		window.location="<?php echo $url;?>";
	</script>
<?php
}
?>