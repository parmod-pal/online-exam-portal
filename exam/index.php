<?php
//phpinfo();
//ini_set("session.cookie_domain", ".rimsr.in");
/* session_start();
$sid="0";
if(isset($_SESSION['usrid']))
{
	$sid=$_SESSION['usrid'];
}
echo $sid;  
$cate='';$typ='';
if(isset($_REQUEST['c']))
{
	$cate=$_REQUEST['c'];
}
if(isset($_REQUEST['t']))
{
	$typ=$_REQUEST['t'];
}
if($cate=="fo")
{
	$cate="Foundation Course";
}
else if($cate=="co")
{
	$cate="Concentration Course";
}
if($typ=="fex" ||$typ=="cex")
{
	$typ="Exam";
}
else if($typ=="ct" || $typ=="ft")
{
	$typ="Test";
}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!--<link rel="shortcut icon" href="images/logoicon.png"/>-->
    <title>RIMSR: Online Test</title>    
	<link type="text/css" href="css/addmovie.css" rel="stylesheet"/>
	<link type="text/css" href="css/kinder.css" rel="stylesheet"/>	 
	<script type="text/javascript" src="js/jquery.js"></script>    
	<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>
</head>
<body onload="">
<div class="wrapper">	
<!--<div style="width:100%;border-bottom:2px solid #0A50A1; ">	
		<a href="http://www.rimsr.in"><img src="images2/logo.jpg" style="float:left;margin-top:10px;margin-left:20px;"/></a>		
		<br/>
	<p style="padding-top:40px;margin-left:25px;width:600px;"><strong><font color="#0A50A1" size="4.95px" face="Verdana, Arial, Helvetica, sans-serif">Rangnekar Institute of Management Studies and Research</font></strong></p>
</div>-->
				
	<div class="admin_panel">
	<div style="clear:both;"></div><br/>
		<div class="admin_form" style="width:335px;margin-top:60px;">		
			<form name="frm1" method="post" action="login_test.php" autocomplete="off">
				<div class="addmovie_details" style="width:auto;text-decoration:underline;font-family:arial;font-weight:bold;font-size:12px;margin-left:110px;margin-top:20px;"> Exam/Test Login</div>
				<div style="clear:both;"></div><br/>
				<div class="formlabel">Username</div>
				<div class="form_text_box">
					<input type="text" name="username" id="username" value="" style="width:150px; height:20px;margin-left:22px;"/>
				</div>
				<div style="clear:both"></div>
				<div class="formlabel">Password</div>
				<div class="form_text_box">
					<input type="password" name="pswd" id="pswd" value="" style="width:150px; height:20px;margin-left:22px;"/>
				</div>
				<div style="clear:both"></div>
				<div class="formlabel">Subject Code</div>
				<div class="form_text_box">
					<input type="text" name="subcode" id="subcode" value="" style="width:150px; height:20px;margin-left:5px;"/>
				</div>
				<div style="clear:both"></div>
				<div class="formlabel">Program Code</div>
				<div class="form_text_box">
					<input type="text" name="prgcode" id="prgcode" value="" style="width:150px; height:20px;"/>
				</div>
				<div style="clear:both"></div>
				<div class="submit_form">				
					<input type="submit" name="submit" id="submit" value="Login" style="width:80px; margin-right:10px;height:25px;cursor:pointer; border:none; background-color:#49729E;color:#FFF;float:left;" />
				</div>
			</form>
		</div>
	</div>	
</div>	
<!--bottom End -->
<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
	var frmvalidator  = new Validator("frm1"); 
	frmvalidator.addValidation("username","req","Enter Username");   
	frmvalidator.addValidation("pswd","req","Enter Password");
	frmvalidator.addValidation("subcode","req","Enter Subject Code");   
	frmvalidator.addValidation("prgcode","req","Enter Program Code");	
  
//]]>
</script>
</body>
</html>