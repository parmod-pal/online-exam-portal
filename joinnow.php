<?php
include "configold.php";
date_default_timezone_set("Asia/Kolkata");
ini_set('display_error',1);
$date=date('Y-m-d');
$em='';
if(isset($_POST['jnow']))
{	
    
     
	$subject    = "Alumni Joining Request From Student (www.rimsr.in)";
	$from=$_POST['email'];
//	$to='registrar@rimsr.in';
	$to='registrar@rimsr.in';
	$body="Student Details are gi
	ven below \r\n \r\n 

	 Name :".$_POST['name']."\r\n 

	 Email :".$_POST['email']."\r\n 

	 Roll Number :".$_POST['rollnum']."\r\n 

	Program Admitted To :".$_POST['program']."\r\n
	Date/Year of Completion :".$_POST['completion']."\r\n

	\r\n\r\n Reply To My Mail ".$_POST['email']."\r\n \r\n \r\n

	 Thank you \r\n ".$_POST['name'];	

	$mailsent=mail("$to","Receipt: $subject","$body","From: $to\nReply-To: $from\r\n");
	 
	if($mailsent > 0)
	{		
		$em='<div class="gen alert alert-success">Mail has been sent successfully</div>';
		msg("index.php",$em); 			
	}
	else
	{
		$em='<div class="gen alert alert-info">Process failed. Try after some time</div>';
		msg("index.php",$em);
	}	
}
?>
<?php
function msg($url,$em)
{
?>		
	<script type="text/javascript">
		localStorage.setItem('chkm','<?php echo $em;?>');
		window.location="<?php echo $url;?>";
	</script>
<?php
}
?>