<?php 
ob_start();
session_start(); 
ini_set('display_errors','off');
include "config.php";
global $conn;
$con=$conn;
$date=date('Y-m-d');
$id1='';$errors=''; $name='';$usid='';$chk=0;$s=0; $nfrom='';$n=0;
if(isset($_POST['6_letters_code']))
{ 
	if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{ 
		$errors .= "\n The captcha code does not match!";
	} 
	else 
	{ 
		$randnum=mt_rand();
		$image="";$photo="";$idimg="";$ugc=""; 
		$image=isset($_FILES["signfile"]["name"])?$_FILES["signfile"]["name"]:'';
		$image= str_replace(' ','',$image);
		$photo=isset($_FILES["photo"]["name"])?$_FILES["photo"]["name"]:''; 
		$photo= str_replace(' ','',$photo);
		$idimg=isset($_FILES["idimg"]["name"])?$_FILES["idimg"]["name"]:'';
		$idimg= str_replace(' ','',$idimg);
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
				$image=time().$image;
				move_uploaded_file($_FILES["signfile"]["tmp_name"],"images/signature/" . $image); 
			} 
		} 
		if($idimg != '')
		{
			$idimg= time().$idimg;
			move_uploaded_file($_FILES["idimg"]["tmp_name"],"images/govid/" . $idimg);
		}
		
		if($ugc != '')
		{
			$ugc= time().$ugc;
			move_uploaded_file($_FILES["certificate"]["tmp_name"],"images/ugc/" . $ugc);
		}
		
		if($photo !="")
		{ 
			$photo=time().$photo;
			move_uploaded_file($_FILES["photo"]["tmp_name"],"images/photograph/" . $photo);
		}
		if($idimg !="")
		{
			$res=mysqli_query($con,"insert into rim_chronoforms_4(recordtime,ipaddress,name,mname,lname,houseaddress,race,nationality,religion,MobilePhone,BusinessPhone,OffIdNo,Placeofissue,dob,gender,gname,gaddress,gphone,gmobile,Institution1,period1,course1,major1,class1,Institution2,period2,course2,major2,class2,Institution3,period3,course3,major3,class3,Institution4,period4,course4,major4,class4,jobtitle1,company1,frm1,to1,task1,extra1,jobtitle2,company2,frm2,to2,task2,extra2,jobtitle3,company3,frm3,to3,task3,extra3,jobtitle4,company4,frm4,to4,task4,extra4,place,date,sign,signimg,photo,degree,iddocimg,encrypt,howtoknow)
			values('". date('Y-m-d')." - ".date("H:i:s")."', '".$_SERVER['REMOTE_ADDR']."' ,'".$_POST['name']."','".$_POST['mname']."','".$_POST['lname']."','".mysqli_real_escape_string($con,$_POST['houseaddress'])."','".mysqli_real_escape_string($con,$_POST['race'])."','".mysqli_real_escape_string($con,$_POST['nationality'])."','".mysqli_real_escape_string($con,$_POST['religion'])."','".$_POST['MobilePhone']."','".$_POST['HomePhone']."','".$_POST['offid']."','".$_POST['poi']."','".$_POST['dob']."','".$_POST['gender']."','".$_POST['gname']."','".mysqli_real_escape_string($con,$_POST['gaddress'])."','".$_POST['gphone']."','".mysqli_real_escape_string($con,$_POST['gmobile'])."','".mysqli_real_escape_string($con,$_POST['Institution1'])."','".mysqli_real_escape_string($con,$_POST['period1'])."','".$_POST['course1']."','".$_POST['major1']."','".$_POST['class1']."','".mysqli_real_escape_string($con,$_POST['Institution2'])."','".mysqli_real_escape_string($con,$_POST['period2'])."','".$_POST['course2']."','".$_POST['major2']."','".$_POST['class2']."','".mysqli_real_escape_string($con,$_POST['Institution3'])."','".mysqli_real_escape_string($con,$_POST['period3'])."','".$_POST['course3']."','".$_POST['major3']."','".$_POST['class3']."','".mysqli_real_escape_string($con,$_POST['Institution4'])."','".mysqli_real_escape_string($con,$_POST['period4'])."','".$_POST['course4']."','".$_POST['major4']."','".$_POST['class4']."','".mysqli_real_escape_string($con,$_POST['job1'])."','".mysqli_real_escape_string($con,$_POST['company1'])."','".$_POST['from1']."','".$_POST['to1']."','".$_POST['mtask1']."','".$_POST['othr1']."','".mysqli_real_escape_string($con,$_POST['job2'])."','".mysqli_real_escape_string($con,$_POST['company2'])."','".$_POST['from2']."','".$_POST['to2']."','".$_POST['mtask2']."','".$_POST['othr2']."','".mysqli_real_escape_string($con,$_POST['job3'])."','".mysqli_real_escape_string($con,$_POST['company3'])."','".$_POST['from3']."','".$_POST['to3']."','".$_POST['mtask3']."','".$_POST['othr3']."','".mysqli_real_escape_string($con,$_POST['job4'])."','".mysqli_real_escape_string($con,$_POST['company4'])."','".$_POST['from4']."','".$_POST['to4']."','".$_POST['mtask4']."','".$_POST['othr4']."','".$_POST['place1']."','".$_POST['date1']."','".mysqli_real_escape_string($con,$_POST['sign'])."','".$image."','".$photo."','".$idimg."','".$ugc."','".$randnum."','".$_POST['htk']."')") or die(mysqli_error($con));
					
			if($res>0)
			{ 
				$id1="";$email="";$randno="error"; 
				$sql1="SELECT cf_id,emailid,encrypt FROM rim_chronoforms_4 where encrypt='".$randnum."'"; 
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
				
				$subject="Online Application From International Student";
				$msg="Click the below link to download the application <br/> <a href='https://www.rimsr.in/exemple01.php?intapp=$id1&enc=$randno'>Download Application</a> <br/>";
				if($image !="") 
				{ 
					$msg .="Click here to download the signature of the applicant <a href='https://www.rimsr.in/images/signature/$image'>Download Signature</a><br/>";
				}
				if($idimg !="")
				{
					$msg .="Click here to download the Official Id of the applicant <a href='https://www.rimsr.in/images/govid/$idimg'>Download Official Id Proof</a><br/>";
				}
				if($ugc !="") 
				{ 
					$msg .="Click here to download the degree certificate of the applicant <a href='https://www.rimsr.in/images/ugc/$ugc'>Download Degree Certificate</a><br/>";
				} 
				if($photo !="") 
				{
				$msg .="Click here to download the photograph of the applicant <a href='https://www.rimsr.in/images/photograph/$photo'>Download Photograph</a>";
				}
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
function msg($ms,$url)
{ 
?> 
	<script type="text/javascript"> 
		alert ("<?php echo $ms;?>"); 
		window.location="<?php echo $url;?>";
	</script> 
<?php 
} 
function mss($ms) 
{ ?> 
	<script type="text/javascript">
		alert ("<?php echo $ms;?>"); 
	</script> 
<?php 
} 
?> 
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