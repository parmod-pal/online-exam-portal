<?php
ob_start();
ini_set('display_errors','off');
session_start();
include "config.php";
global $conn;
$con=$conn;
$date=date('Y-m-d');$id1='';$errors='';
$name='';$usid='';$chk=0;$s=0;
$nfrom='';$n=0;
if(isset($_POST['6_letters_code']))
{
	if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
		$errors .= "\n The captcha code does not match!";
	}
	else
	{
		if(isset($_POST['n1'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n1'];
			}
			else
			{
				$nfrom=$_POST['n1'];
			}
		}
		if(isset($_POST['n2'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n2'];
			}
			else
			{
				$nfrom=$_POST['n2'];
			}
		}
		if(isset($_POST['n3'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n3'];
			}
			else
			{
				$nfrom=$_POST['n3'];
			}
		}
		if(isset($_POST['n4'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n4'];
			}
			else
			{
				$nfrom=$_POST['n4'];
			}
		}
		if(isset($_POST['n5'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n5'];
			}
			else
			{
				$nfrom=$_POST['n5'];
			}
		}
		if(isset($_POST['n6'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n6'];
			}
			else
			{
				$nfrom=$_POST['n6'];
			}
		}
		if(isset($_POST['n7'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n7'];
			}
			else
			{
				$nfrom=$_POST['n7'];
			}
		}
		if(isset($_POST['n8'])!="")
		{
			if($nfrom !='')
			{
				$nfrom=$nfrom.','.$_POST['n8'];
			}
			else
			{
				$nfrom=$_POST['n8'];
			}
		}
		$randnum=mt_rand();
		$image="";$photo="";$sslc="";$ugc="";
		$image=isset($_FILES["signfile"]["name"])?$_FILES["signfile"]["name"]:'';
		$image= str_replace(' ','',$image);
		$photo=isset($_FILES["photo"]["name"])?$_FILES["photo"]["name"]:''; 
		$photo= str_replace(' ','',$photo);
		$sslc=isset($_FILES["sslc"]["name"])?$_FILES["sslc"]["name"]:'';
		$sslc= str_replace(' ','',$sslc);
		$ugc=isset($_FILES["certificate"]["name"])?$_FILES["certificate"]["name"]:'';
		$ugc= str_replace(' ','',$ugc);
		if($image !="")
		{
			if ($_FILES["signfile"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["signfile"]["error"] . "<br />";
			}
			else
			{
				move_uploaded_file($_FILES["signfile"]["tmp_name"],"images/signature/" . $image);
			}
		}
		
		
		if($sslc != '')
		{
			move_uploaded_file($_FILES["sslc"]["tmp_name"],"images/sslc/" . $sslc);
		}
		
		if($ugc != '')
		{
			move_uploaded_file($_FILES["certificate"]["tmp_name"],"images/ugc/" . $ugc);
		}
		
		
		if($photo !="")
		{ 
			move_uploaded_file($_FILES["photo"]["tmp_name"],"images/photograph/" . $photo);
		}
		

		if($sslc !="" && $photo !="" && $ugc !="")
		{
			$res=mysqli_query($con,"insert into rim_chronoforms_9(recordtime,ipaddress,past_apply,past_details,past_attend,past_attend_details,month,year,name,emailid,houseaddress,street,city,State,HomePhone,MobilePhone,BusinessPhone,AdharNo,pan_no,Voter_id,dob,gender,rd1,otherdetails,Newspaper,purpose,degreeseeking,Institution1,location1,LastYear1,major1,Degree1,Institution2,location2,LastYear2,major2,Degree2,Institution3,location3,LastYear3,major3,Degree3,Institution4,location4,LastYear4,major4,Degree4,Institution5,location5,LastYear5,major5,Degree5,sign,date,signimg,photo,sslc,ugc,encrypt) values('". date('Y-m-d')." - ".date("H:i:s")."', '".$_SERVER['REMOTE_ADDR']."' ,'".$_POST['past_apply']."','".$_POST['past_details']."','".$_POST['past_attend']."','".$_POST['past_attend_details']."','".$_POST['month']."','".$_POST['year']."','".$_POST['name']."','".$_POST['emailid']."','".mysqli_real_escape_string($con,$_POST['houseaddress'])."','".mysqli_real_escape_string($con,$_POST['street'])."','".mysqli_real_escape_string($con,$_POST['city'])."','".mysqli_real_escape_string($con,$_POST['State'])."','".$_POST['HomePhone']."','".$_POST['MobilePhone']."','".$_POST['BusinessPhone']."','".$_POST['AdharNo']."','".$_POST['pan_no']."','".$_POST['Voter_id']."','".$_POST['dob']."','".$_POST['gender']."','".$_POST['rd1']."','".mysqli_real_escape_string($con,$_POST['otherdetails'])."','".$nfrom."','".mysqli_real_escape_string($con,$_POST['purpose'])."','".mysqli_real_escape_string($con,$_POST['degreeseeking'])."','".mysqli_real_escape_string($con,$_POST['Institution1'])."','".mysqli_real_escape_string($con,$_POST['location1'])."','".$_POST['LastYear1']."','".$_POST['major1']."','".$_POST['Degree1']."','".mysqli_real_escape_string($con,$_POST['Institution2'])."','".mysqli_real_escape_string($con,$_POST['location2'])."','".$_POST['LastYear2']."','".$_POST['major2']."','".$_POST['Degree2']."','".mysqli_real_escape_string($con,$_POST['Institution3'])."','".mysqli_real_escape_string($con,$_POST['location3'])."','".$_POST['LastYear3']."','".$_POST['major3']."','".$_POST['Degree3']."','".mysqli_real_escape_string($con,$_POST['Institution4'])."','".mysqli_real_escape_string($con,$_POST['location4'])."','".$_POST['LastYear4']."','".$_POST['major4']."','".$_POST['Degree4']."','".mysqli_real_escape_string($con,$_POST['Institution5'])."','".mysqli_real_escape_string($con,$_POST['location5'])."','".$_POST['LastYear5']."','".$_POST['major5']."','".$_POST['Degree5']."','".mysqli_real_escape_string($con,$_POST['sign'])."','".$_POST['date1']."','".$image."','".$photo."','".$sslc."','".$ugc."','".$randnum."')") or die(mysqli_error($con));

			if($res>0)
			{
				$id1="";$email="";$randno="error";
				$sql1="SELECT cf_id,emailid,encrypt FROM rim_chronoforms_9 order by cf_id desc limit 0,1";
				$result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
				if(($result1)>0)
				{
					while ($data = mysqli_fetch_array($result1))
					{
						$id1=$data['cf_id'];
						$email=$data['emailid'];
						$randno=$data['encrypt'];
					}
				}
				
				$subject="Online Application For Diploma Courses";
				$msg="Click the below link to download the application <br/> <a href='https://www.rimsr.in/exemple01.php?app=".$id1."&enc=".$randno."'>Download Application</a> <br/>";
				if($image !="")
				{
					$msg .="Click here to download the signature of the applicant <a href='https://www.rimsr.in/images/signature/".$image."'>Download Signature</a><br/>";
				}
				if($photo !="") 
				{
				$msg .="Click here to download the photograph of the applicant <a href='https://www.rimsr.in/images/photograph/$photo'>Download Photograph</a><br/>";
				}
				$msg .="Click here to download the SSLC Mark Sheet of the applicant <a href='https://www.rimsr.in/images/sslc/".$sslc."'>Download SSLC Mark Sheet</a><br/>Click here to download the degree certificate of the applicant <a href='http://www.rimsr.in/images/ugc/".$ugc."'>Download Degree Certificate</a>";
			
				$to="registrar@rimsr.in";
				$from = "info@rimsr.in";
				require_once('Classes/class.phpmailer.php');					
				$mail             = new PHPMailer();						
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPAuth   = true; // enable SMTP authentication
				$mail->Sendmail   = '/usr/sbin/sendmail';
				$mail->Mailer = "smtp";
				$mail->SMTPSecure = "ssl";               		// sets the prefix to the servier
				$mail->Host       = "mail.rimsr.in";        		// sets Rimsr as the SMTP server
				$mail->Port       = '465';                  	 	// set the SMTP port for the Rimsr server
				$mail->Username   = "info@rimsr.in";  	// Rimsr username
				$mail->Password   = "qwer_!@#4";		// Rimsr password
				$mail->ContentType = "text/html";
				$mail->SetFrom($from, 'Rimsr');
				
				$mail->Subject    = $subject;

				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

				$mail->MsgHTML($msg);
				
				$mail->AddAddress($to);

				if($mail->Send())
				{
					$s=1;
				}	
			}
			else
			{
				$s=0;
			}
		}
		else
		{
			$s=0;
		}

	}
}
else
{
	$errors .= "\n The captcha code does not match!";
}
if(!empty($errors))
{
	$s=0;
}
?>
<?php
function msg($msg,$url)
{?>
<script type="text/javascript">
alert ("<?php echo $msg;?>");
window.location="<?php echo $url;?>";
</script>
<?php }function mss($msg){?><script type="text/javascript">alert ("<?php echo $msg;?>");</script><?php } ?>
 
 <!DOCTYPE html> 
 <html xmlns="http://www.w3.org/1999/xhtml"> 
 <head> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
 <title>RIMSR Online Application</title> 
 </head>
 <body>  
	<?php    
	if($s==1)  
	{  
	?>  
		<script type="text/javascript" src="js/jquery.js"></script> 
		<script>    $(document).ready(function() {      launchWindow('#dialog');      $('.window #close').click(function () {  $('#mask').hide();  $('.window').hide();  window.location="http://www.rimsr.in/";  });      $('#mask').click(function () {  $(this).hide();  $('.window').hide();  window.location="http://www.rimsr.in/";  });      $(window).resize(function () {    var box = $('#boxes .window');      var maskHeight = $(document).height();  var maskWidth = $(window).width();      $('#mask').css({'width':maskWidth,'height':maskHeight});     var winH = $(window).height();  var winW = $(window).width();      box.css('top',  winH/2 - box.height()/2);  box.css('left', winW/2 - box.width()/2);    });    }); 
		 function launchWindow(id) {      var maskHeight = $(document).height();  var maskWidth = $(window).width();      $('#mask').css({'width':maskWidth,'height':maskHeight});      $('#mask').fadeIn(1000);  $('#mask').fadeTo("slow",0.8);      var winH = $(window).height();  var winW = $(window).width();      $(id).css('top',  winH/2-$(id).height());  $(id).css('left', winW/2-$(id).width()/2);      $(id).fadeIn(2000);      }    
		 </script>  
	<?php  mss('Receipt of your Application is Acknowledged.');  
	} 
	else  
	{  
		msg("Process Failed","https://www.rimsr.in/");  
	}  
	?> 
<div id="boxes">
	<div id="dialog" class="window" style="margin-top:150px;">
		<div id="page" class="page" style="margin:0 auto;width:600px; height:380px; background-color:#7AD8F3; -moz-box-shadow:1px 1px 5px 3px #000;  -webkit-box-shadow: 1px 1px 5px 3px #000; box-shadow:1px 1px 5px 3px #000;" align="center">
			<span class="page" style="width:500px; height:400px;">
				<img src="images/hand1.png"  />
			</span>
			<h2 style="color:#CC3300; font:Geneva; font-weight:bold;">Your Application is Successfully Submitted. Our Administrative team will contact you soon.</h2>
			<span style="float:right;color:blue;">
				<a href="https://www.rimsr.in" style="color:blue;font-family:arial;font-size:12px;font-weight:bold;">Go to Main Page</a>
			</span>  
		</div> 
	</div>    
	<!-- Mask to cover the whole screen -->
	<div id="mask"></div>
</div>
</body>

</html>