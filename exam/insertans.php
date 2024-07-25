<?php
session_start();
include"config.php";
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d');
$time=date('H:i a');
$usrid='';$quesid='';$typ=$email='';
$uans='';$quizid='';$totq=$s=0;$uid='';$quizdate='';
if(isset($_SESSION['usrid']))
{
	$usrid=$_SESSION['usrid'];
} 
if(isset($_SESSION['usremail']))
{
	$usremail=$_SESSION['usremail'];
} 

if(isset($_REQUEST['totques']))
{
	$totq=$_REQUEST['totques'];
}         
if(isset($_GET['q']))
{
	$quizid=$_GET['q'];
}
if(isset($_GET['s']))
{
	$uid=$_GET['s'];
}
if(isset($_GET['t']))
{
	$typ=$_GET['t'];
}
$query="SELECT * FROM rim_quizmain WHERE Id = '".$quizid."'";	
$result=mysqli_query($conn,$query);
if($result != false)
{
	if(mysqli_num_rows($result)>0)
	{
		while($data=mysqli_fetch_assoc($result))
		{
			$quizdate=$data['Startdate'];			
		}
	}
}
$res=mysqli_query($conn,"select * from rim_quizscore where Quizid='".$quizid."' and Userid='".$uid."' and Dateofscored='".$quizdate."'");
if($res>0)
{
	if(mysqli_num_rows($res)==0)
	{
		for($i=1;$i<=$totq;$i++)
		{			
			$quesid=$_POST['qid'.$i];
			$uans=$_POST['uans'.$i];
			
			$res1=mysqli_query($conn,"insert into rim_quizscore(Userid,Quizid,Quesid,Answer,Dateofscored) values('".$uid."','".$quizid."','".$quesid."','".$uans."','".$date."')");
		}
		if($totq>0)
		{		
			if($res1>0)
			{			
				
				$to="registrar@rimsr.in";
				$to1="controller@rimsr.in";
				
				$subject="Online ".$typ." Answer Sheet";
				$msg="Click the below link to download the Answer Sheet<br/><a href='http://www.rimsr.in/ans.php?uid=".$uid."&qid=".$quizid."&qd=".$quizdate."'>Download Answer Sheet</a>";
				$from = $email;
				
				require_once('Classes/class.phpmailer.php');					
				$mail             = new PHPMailer();						
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPAuth   = true; // enable SMTP authentication
				$mail->Sendmail   = '/usr/sbin/sendmail';
				$mail->Mailer = "smtp";
				$mail->SMTPSecure = "ssl";               		// sets the prefix to the servier
				$mail->Host       = "mail.rimsr.in";      		// sets azillesoft as the SMTP server
				$mail->Port       = '465';                  	 	// set the SMTP port for the azillesoft server
				$mail->Username   = "controller@rimsr.in";  	// azillesoft username
				$mail->Password   = "Rimsr...2010";		// azillesoft password
				$mail->ContentType = "text/html";
				$mail->SetFrom($to1, 'Rimsr');
				
				$mail->Subject    = $subject;

				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

				$mail->MsgHTML($msg);
				
				$mail->AddAddress($to);

				$mail->Send();				
				
				//$mailsent=mail("$to","Receipt: $subject","$msg","From: $to1\nReply-To: $from");
				if($mail->Send())
				{
					$s=1;			  
				}
				else
				{
					$s=0;
				}
				//msg("Your answer posted successfully","http://www.rimsr.in/");
			}
			
		}
		else
		{
			$s=4;
		}
	}
	else
	{
		$s=2;
		//msg("You already attend the exam","http://www.rimsr.in/");
	}	
}
else
{
	for($i=1;$i<=$totq;$i++)
	{		
		$quesid=$_POST['qid'.$i];
		$uans=$_POST['uans'.$i];
		
		$res1=mysqli_query($conn,"insert into rim_quizscore(Userid,Quizid,Quesid,Answer,Dateofscored) values('".$uid."','".$quizid."','".$quesid."','".$uans."','".$date."')");
	}
	if($totq>0)
	{		
		if($res1>0)
		{
			$to="registrar@rimsr.in";
				$to1="controller@rimsr.in";
				
				$subject="Online ".$typ." Answer Sheet";
				$msg="Click the below link to download the Answer Sheet<br/><a href='http://www.rimsr.in/ans.php?uid=".$uid."&qid=".$quizid."&qd=".$quizdate."'>Download Answer Sheet</a>";
				$from = $email;
				
				require_once('Classes/class.phpmailer.php');					
				$mail             = new PHPMailer();						
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPAuth   = true; // enable SMTP authentication
				$mail->Sendmail   = '/usr/sbin/sendmail';
				$mail->Mailer = "smtp";
				$mail->SMTPSecure = "ssl";               		// sets the prefix to the servier
				$mail->Host       = "mail.rimsr.in";      		// sets azillesoft as the SMTP server
				$mail->Port       = '465';                  	 	// set the SMTP port for the azillesoft server
				$mail->Username   = "controller@rimsr.in";  	// azillesoft username
				$mail->Password   = "Rimsr...2010";		// azillesoft password
				$mail->ContentType = "text/html";
				$mail->SetFrom($to1, 'Rimsr');
				
				$mail->Subject    = $subject;

				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

				$mail->MsgHTML($msg);
				
				$mail->AddAddress($to);

				$mail->Send();
				
				//$mailsent=mail("$to","Receipt: $subject","$msg","From: $to1\nReply-To: $from");
				if($mail->Send())
				{
					$s=1;			  
				}
				else
				{
					$s=0;
				}
			//msg("Your answer posted successfully","http://www.rimsr.in/");
		}		
	}
	else
	{
		$s=4;
	}
} 

?>
<?php
function msg($msg,$url)
{?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
window.location="<?php echo $url; ?>";
</script>
<?php } ?>
<?php
function mss($url)
{?>
<script type="text/javascript">
window.location="<?php echo $url; ?>";
</script>
<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>RIMSR Online Application</title>
		<style>
			body {
			font-family:verdana;
			font-size:15px;
			}

			a {color:#333; text-decoration:none}
			a:hover {color:#ccc; text-decoration:none}

			#mask {
			  position:absolute;
			  left:0;
			  top:0;
			  z-index:9000;
			  background-color:#ddd;
			  display:none;
			}
			  
			#boxes .window {
			  position:absolute;
			  width:440px;
			  height:200px;
			  display:none;
			  z-index:9999;
			  padding:20px;
			}

			#boxes #dialog {
			  width:600px; 
			  height:350px;
			  padding:10px;
			  background-color:#ffffff;
			}
		</style>
		<script type="text/javascript" src="js/jquery.js"></script>
	</head>

	<body>
<?php
if($s >= 1)
{
	if($s==4)
	{?>
		<script>
		 
		$(document).ready(function() {
			window.location.href="http://rimsr.in/exam/logout.php";
		});
		</script>
		<?php
	}
	else
	{
?>
		
			<script>
		 
		$(document).ready(function() {	
			
			//Put in the DIV id you want to display
			launchWindow('#dialog');
			
			//if close button is clicked
			$('.window #close').click(function () {
				$('#mask').hide();
				$('.window').hide();
				window.location.href="http://rimsr.in/exam/logout.php";
				/* window.location.href="http://rimsr.in/exam/logout.php"; */
			});		
			
			//if mask is clicked
			$('#mask').click(function () {
				$(this).hide();
				$('.window').hide();
				window.location.href="http://rimsr.in/exam/logout.php";
				/* window.location="http://rimsr.in"; */
			});			
			

			$(window).resize(function () {
			 
				var box = $('#boxes .window');
		 
				//Get the screen height and width
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();
			  
				//Set height and width to mask to fill up the whole screen
				$('#mask').css({'width':maskWidth,'height':maskHeight});
					   
				//Get the window height and width
				var winH = $(window).height();
				var winW = $(window).width();

				//Set the popup window to center
				box.css('top',  winH/2 - box.height()/2);
				box.css('left', winW/2 - box.width()/2);
			 
			});	
			
		});

		function launchWindow(id) {
			
				//Get the screen height and width
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();
			
				//Set heigth and width to mask to fill up the whole screen
				$('#mask').css({'width':maskWidth,'height':maskHeight});
				
				//transition effect		
				$('#mask').fadeIn(1000);	
				$('#mask').fadeTo("slow",0.8);	
			
				//Get the window height and width
				var winH = $(window).height();
				var winW = $(window).width();
					  
				//Set the popup window to center
				$(id).css('top',  winH/2-$(id).height());
				$(id).css('left', winW/2-$(id).width()/2);
			
				//transition effect
				$(id).fadeIn(2000); 
			

		} 

		</script>
<?php
	}
}
else
{
	?>
	
		<script>
		 
		$(document).ready(function() {
			window.location.href="http://rimsr.in/exam/logout.php";
		});
		</script>
		<?
	//msg("Process Failed","http://www.rimsr.in/");
} 
?>
<div id="boxes">
	<div id="dialog" class="window" style="margin-top:150px;">
		<div id="page" class="page" style="width:600px;     height: 200px;  margin-top: 15px;   padding-top: 120px; background-color:#fff; -moz-box-shadow:1px 1px 5px 3px #000; -webkit-box-shadow: 1px 1px 5px 3px #000; box-shadow:1px 1px 5px 3px #000;" align="center">
		  <h2 style="color:#CC3300; font:Geneva; font-weight:bold;">
		  <?php
		  if($s==2)
		  {
			  echo "You have completed the exam. You can now log out.";
			//echo "Sorry! You Cannot Submit Your Answer Script Yet Again.";
			$s=0;
		  }
		  else
		  {
			echo "Your answer script has been submitted successfully.";
			$s=0;
		  }
		  ?>
		  </h2>	
		 	  
		</div>
		<div style="clear:both;"></div>
		<span style="float:right;color:blue;    line-height: 24px;">--><a href="http://rimsr.in/exam/logout.php" style="color:blue;font-family:arial;font-size:12px;font-weight:bold;">Go to Main Page</a></span>
	</div>

	<!-- Mask to cover the whole screen -->
	<div id="mask"></div>
</div>

</div>
</body>
</html>