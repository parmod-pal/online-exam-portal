<?php
include "config.php";
$grpid='';$cnt=0;
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d');
$res1=mysqli_query($conn,"select * from userdet where usertype=2 and username='".$_POST['username']."'");
if($res1>0)
{	
	$cnt=mysqli_num_rows($res1);
}
if($cnt==0)
{ 	
	$pswd=md5($_POST['pswd']);
	$res=mysqli_query($conn,"insert into userdet(name,username,emailid,password,usertype,dateofpost) values('".$_POST['name']."','".$_POST['username']."','".$_POST['email']."','".$pswd."','2','".$date."')");	
	if($res>0)
	{
		$to=$_POST['email'];
		$from="registrar@rimsr.in";
		$subject="RIMSR Login Details";
		$msg="Your Login Details for the site <a href='http://www.rimsr.in' target='_blank'>www.rimsr.in</a> are given below <br/><br/> Username :".$_POST['username']."<br/>Password : ".$_POST['pswd']."<br/><br/><br/><br/>best regards,<br/>RIMSR Team.";
		
		$mailsent=mail("$to","Receipt: $subject","$msg","From: $from\nReply-To: $from\nContent-type:text/html;");
		if($mailsent>0)
		{
			msg("User created successfully","createuser.php");		  
		}
		else
		{
			msg("User created successfully but the details not send to the user.\n Send it after some time.","createuser.php");
		}		
	}
}
else
{
	msg("Username Already Exists","createuser.php");
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