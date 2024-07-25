<?php
if(strlen(session_id()<1)){session_start();}
if(!isset($_SESSION['username']))
{
	include "index.php";
	exit();
} 
$quizname='';
$desc='';
$qdate='';
$stime='';
$etime='';
$typ='';
$cate='';
$usrtyp='';
$duration='';$totques=0;
if(isset($_SESSION['usrtyp']))
{
	$usrtyp=$_SESSION['usrtyp'];
}
if(isset($_SESSION['cate']))
{
	$cate=$_SESSION['cate'];
}
if(isset($_SESSION['typ']))
{
	$typ=$_SESSION['typ'];
}
if(isset($_SESSION['qname']))
{
	$quizname=$_SESSION['qname'];
}
if(isset($_SESSION['qdesc']))
{
	$desc=$_SESSION['qdesc'];
}
if(isset($_SESSION['qdate']))
{
	$qdate=$_SESSION['qdate'];
}
if(isset($_SESSION['qstime']))
{
	$stime=$_SESSION['qstime'];
}
if(isset($_SESSION['qetime']))
{
	$etime=$_SESSION['qetime'];
}
if(isset($_SESSION['qduration']))
{
	$duration=$_SESSION['qduration'];
}
if(isset($_SESSION['tques']))
{
	$totques=$_SESSION['tques'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!--<link rel="shortcut icon" href="images/logoicon.png"/>-->
    <title>RIMSR: Upload Questions</title>    
	<link type="text/css" href="css/addmovie.css" rel="stylesheet"/>
	<link type="text/css" href="css/kinder.css" rel="stylesheet"/>	 
	<link type="text/css" href="css/timepicker.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery.js"></script>    
	<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>	

<script type="text/javascript" src="js/jquery.timePicker.js"></script>
<script type="text/javascript">
var $jq = jQuery.noConflict();
	$jq(document).ready(function() {		
		$jq("#time").timePicker({
		  startTime: "00:00:00", // Using string. Can take string or Date object.
		  endTime: new Date(0, 0, 0, 23, 30, 0), // Using Date object here.
		  show24Hours: true,
		  separator: ':',
		  step: 15});
		$jq("#time1").timePicker({
		  startTime: "00:00:00", // Using string. Can take string or Date object.
		  endTime: new Date(0, 0, 0, 23, 30, 0), // Using Date object here.
		  show24Hours: true,
		  separator: ':',
		  step: 15});
		  
		  $jq('#cans').on('keypress',function(){
			var ch=String.fromCharCode(event.keyCode);
			var filter = /[a-eA-e]/;
			var filter1 = /[0-9]/;
			  
			 if(!filter.test(ch)){
				  event.returnValue = false;
				  alert('Your answer should be within "a" to "e" character.');
			 }
			 else
			 {			
				 if(filter1.test(ch)){
					  event.returnValue = false;
					  alert('Your choice should be indicated only in alpha character.  Your answer is not case sensitive.');
				 }
			 }
		});
		  $jq('#mark').on('keypress',function(){
			var ch=String.fromCharCode(event.keyCode);			
			var filter1 = /[0-9]/;				  
						
			 if(!filter1.test(ch)){
				  event.returnValue = false;
				  alert('Your choice should be indicated only in numeric values.');
			 }
				 
			});
		  
		  });
		  
		function destroy()
		{	
			window.location='closesession.php';
			/*  $jq.ajax({			
				url:"closesession.php",
				success: function(data) {				
				}
			});	 */	
		}
</script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.13.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" language="javascript">
var $jquery1 = jQuery.noConflict();    
	$jquery1(function() {
    $jquery1("#startdate").datepicker({ minDate: "0D",maxDate: "+3M", numberOfMonths: 1 });   
    });
	$jquery1(function() {
    $jquery1("#expirydate").datepicker({ minDate: "0D", numberOfMonths: 1 });   
    });	
	</script>
</head>
<body onload="">
<div class="wrapper">	
	<div style="width:100%;border-bottom:2px solid #0A50A1; ">	
			<img src="images2/logo.jpg" style="float:left;margin-top:10px;margin-left:20px;"/>		
			<br/>
		<p style="padding-top:40px;margin-left:25px;width:600px;"><strong><font color="#0A50A1" size="4.95px" face="Verdana, Arial, Helvetica, sans-serif">Rangnekar Institute of Management Studies and Research</font></strong></p>
	</div>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="logout.php" style="text-decoration:none;color:#FF0000;">Logout</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="viewexam.php" style="text-decoration:none;color:#FF0000;">View Exam/Test</a></span>
	<?php
	/* if($usrtyp == 'admin')
	{ */
	?>
		<span style="font-weight:bold;float:right;margin-right:20px;"><a href="createuser.php" style="text-decoration:none;color:#FF0000;">Create User</a></span>
		<span style="font-weight:bold;float:right;margin-right:20px;"><a href="viewuser.php" style="text-decoration:none;color:#FF0000;">View User</a></span>
	<?php
	/* } */
	?>	
	<div style="width:825px;">		
		<div class="admin_panel">
			<div class="admin_form" style="width:800px;padding:10px;margin-top:45px;">
				<form name="frm1" method="post" action="insertquestion.php">
					<div class="addmovie_details" style="width:auto;text-decoration:underline;font-family:arial;font-weight:bold;font-size:12px;"> Add Online Exam Questions</div><span style="font-weight:bold;float:right;margin-right:20px;">Total Question's:&nbsp;&nbsp;&nbsp;<font style="color:#ff0000;"><?php echo $totques;?></font></span><div style="clear:both"></div>
					<div class="formlabel">Program Code</div>
					<div class="form_text_box" style="width:250px;">
						<input type="text" name="category" id="category" value="<?php echo $cate;?>" style="width:250px;height:20px;"/>
										
					</div>
					<div class="formlabel">Type</div>
					<div class="form_text_box" style="width:140px;">
						<select name="typ">
							<?php
							if($typ=="Exam")
							{
							?>								
								<option value="Test" >Test</option>
								<option value="Exam"selected>Exam</option>								
							<?php
							}
							else 
							{
							?>							
								<option value="Test" selected>Test</option>
								<option value="Exam">Exam</option>
								
							<?php
							}
							?>					
						</select>				
					</div>
					<div style="clear:both"></div>
					<div class="formlabel">Subject Code</div>
					<div class="form_text_box">
						<input type="text" name="quizname" id="quizname" value="<?php echo $quizname;?>" style="width:400px; height:20px;"/>
					</div>
					<div style="clear:both"></div>
					<div class="formlabel">Instructions</div>
					<div class="form_text_area">
						<!--<textarea name="desc" id="desc" style="width:400px; height:100px; resize:none;"><?php //echo $desc;?></textarea>-->
						<?php		
							include("fckeditor/fckeditor.php");													
							$fck = new FCKeditor('desc');													
							$fck->BasePath = 'fckeditor/';
							$fck->Height = '300px';
							$fck->Width = '600px';													
							$fck->Value = $desc;												
							$fck->Create();
						?>	
					</div>	
					<div style="clear:both"></div>
					<div class="formlabel">Start Date & Time  </div>
					<div class="form_text_box" style="width:395px;text-align:left;">
						<input type="text" name="startdate" id="startdate" readonly value="<?php echo $qdate;?>" style="width:70px; height:20px;"/>				
						<input type="text" name="time" id="time" readonly value="<?php echo $stime;?>" style="width:50px; height:20px;"/>&nbsp;To &nbsp;
						<input type="text" name="time1" id="time1" readonly value="<?php echo $etime;?>" style="width:50px; height:20px;"/>&nbsp;Duration &nbsp;
						<input type="text" name="duration" id="duration" value="<?php echo $duration;?>" style="width:50px; height:20px;"/>
						<span style="color:#ff0000;">(in min)</span>
					</div>	
					<div style="clear:both"></div><br/>
					<div class="addmovie_details" style="width:auto;text-decoration:underline;font-family:arial;font-weight:bold;font-size:12px;"> Enter Your Questions</div><div style="clear:both"></div>			
					<div class="formlabel">Question</div>
					<div class="form_text_box">
						<input type="text" name="ques" id="ques"  style="width:400px; height:20px;"/>
					</div>
					<div style="clear:both"></div>
					<div class="formlabel" style="color:#ff0000;width:400px;height:auto;margin-left:120px;">If this question is optional type then enter your options in below box, otherwise click submit.</div><div style="clear:both"></div>
					<div class="formlabel">Options</div>
					<div style="clear:both"></div>
					<div class="form_text_area" style="margin-left:100px;">
						<?php		
							include("fckeditor/fckeditor.php");													
							$fck = new FCKeditor('description');													
							$fck->BasePath = 'fckeditor/';
							$fck->Height = '300px';
							$fck->Width = '600px';													
							$fck->Value = '';												
							$fck->Create();
						?>	
					</div>
					<div style="clear:both"></div>
					<div class="formlabel">Correct Answer:</div>
					<div class="form_text_box" style="width:560px;text-align:left;">
						<input type="text" name="cans" id="cans" maxlength="1" value="" style="width:280px; height:20px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mark&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mark" id="mark" value="" maxlength="2" style="width:50px; height:20px;"/>
					</div>					
					<div style="clear:both"></div>
					<div class="submit_form" style="width:250px;">				
						<input type="submit" name="submit" id="submit" value="Submit" style="width:80px; margin-right:10px;height:25px;cursor:pointer; border:none; background-color:#49729E; color:#FFF;float:left;" />
						<input type="reset" name="reset" id="reset" value="New Exam" onclick="destroy();" style="width:80px; height:25px;cursor:pointer; border:none; background-color:#49729E; color:#FFF;" />			
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
  frmvalidator.addValidation("category","req","Program Code Required"); 
  frmvalidator.addValidation("quizname","req","Subject Code Required");   
  frmvalidator.addValidation("startdate","req","Start Date Required");
  frmvalidator.addValidation("time","req","Start Time Required");
  frmvalidator.addValidation("time1","req","End Time Required"); 
  frmvalidator.addValidation("duration","req","Duration Required");
  frmvalidator.addValidation("duration","numeric","Enter Only Numeric Values");  
  frmvalidator.addValidation("ques","req","Question Required");    
//]]>
</script>

</body>
</html>