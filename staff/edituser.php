<?php
if(!isset($_SESSION)){session_start();}
/* if(isset($_SESSION['usrtyp'])!= 'admin')
{
	include "ques.php";
	exit();
} */
include "config.php";
$id='';$usrtype='';$usrname='';$name='';$email='';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
		
$query="SELECT * FROM userdet WHERE id = '".$id."' and usertype=2";	
$result=mysqli_query($conn,$query);
if($result != false)
{
	if(mysqli_num_rows($result)>0)
	{
		while($data=mysqli_fetch_assoc($result))
		{			
			$usrname=$data['username'];
			$name=$data['name'];
			$email=$data['emailid'];			
		}
	}
	else
	{
		header('location:viewuser.php');
		exit();
	}
}
else
{
	header('location:viewuser.php');
	exit();
}
								
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!--<link rel="shortcut icon" href="images/logoicon.png"/>-->
    <title>RIMSR: Edit User</title>    
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
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="logout.php" style="text-decoration:none;color:#FF0000;">Logout</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="createuser.php" style="text-decoration:none;color:#FF0000;">Create User</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="viewuser.php" style="text-decoration:none;color:#FF0000;">View User</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="ques.php" style="text-decoration:none;color:#FF0000;">Home</a></span>
	<div style="width:825px;">		
		<div class="admin_panel">
			<div class="admin_form" style="width:800px;padding:10px;margin-top:45px;">
				<form name="frm1" method="post" action="updateuser.php?id=<?php echo $id;?>">
					<div class="addmovie_details" style="width:auto;text-decoration:underline;font-family:arial;font-weight:bold;font-size:12px;">Add User Details</div><div style="clear:both"></div>					
					<div class="formlabel" style="width:103px;text-align:left;">Name</div>
					<div class="form_text_box">
						<input type="text" name="name" id="name" value="<?php echo $name;?>" style="width:400px; height:20px;"/>
					</div>	
					<div style="clear:both"></div>
					<div class="formlabel" style="width:103px;text-align:left;">Email Id</div>
					<div class="form_text_box">
						<input type="text" name="email" id="email" value="<?php echo $email;?>" style="width:400px; height:20px;"/>
					</div>
					<div style="clear:both"></div>
					<div class="formlabel" style="width:103px;text-align:left;">Username</div>
					<div class="form_text_box">
						<input type="text" name="username" id="username" value="<?php echo $usrname;?>" readonly style="width:400px; height:20px;"/>
					</div>								
					<div style="clear:both"></div>
					<div class="submit_form" style="width:250px;">				
						<input type="submit" name="submit" id="submit" value="Update" style="width:80px; margin-right:10px;height:25px;cursor:pointer; border:none; background-color:#49729E; color:#FFF;float:left;" />						
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>	
<!--bottom End -->
<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
	var frmvalidator  = new Validator("frm1"); 
	frmvalidator.addValidation("name","req","Name Required");   
	frmvalidator.addValidation("email","req","Email Id Required");
	frmvalidator.addValidation("email","email","Please Write Your Valide Email Id");
	frmvalidator.addValidation("username","req","Username Required");
//]]>
</script>
</body>
</html>