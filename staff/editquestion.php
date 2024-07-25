<?php
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['username']))
{
	include "index.php";
	exit();
} 
$id=$desc=$qdate=$stime=$etime=$typ=$cate=$duration=$cans=$mark='';$totques=0;
$quizname=$eid='';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
if(isset($_GET['eid']))
{
	$eid=$_GET['eid'];
}
if($id =='')
{
	include "ques.php";
	exit();
}
include "config.php";
$query="SELECT * FROM rim_quizquestion WHERE Id = '".$id."'";	
$result=mysqli_query($conn,$query);
if($result != false)
{
	if(mysqli_num_rows($result)>0)
	{
		while($data=mysqli_fetch_assoc($result))
		{			
			$desc=$data['Answer'];
			$cans=$data['Correctans'];
			$mark=$data['Mark'];
			$ques=htmlspecialchars($data['Question']);						
		}
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!--<link rel="shortcut icon" href="images/logoicon.png"/>-->
    <title>RIMSR: Online Exam/Test</title>    
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
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="ques.php" style="text-decoration:none;color:#FF0000;">Home</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="viewexam.php" style="text-decoration:none;color:#FF0000;">View Exam &amp; Test</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="viewquestion.php?id=<?php echo $eid;?>" style="text-decoration:none;color:#FF0000;">Back</a></span>
	<div style="width:825px;">		
		<div class="admin_panel">
			<div class="admin_form" style="width:800px;padding:10px;margin-top:45px;">
				<form name="frm1" method="post" action="updatequestion.php?id=<?php echo $id;?>">
					<div class="addmovie_details" style="width:auto;text-decoration:underline;font-family:arial;font-weight:bold;font-size:12px;"> Edit Question</div>
					<div style="clear:both"></div>
					<div class="addmovie_details" style="width:auto;text-decoration:underline;font-family:arial;font-weight:bold;font-size:12px;"> Enter Your Questions</div><div style="clear:both"></div>			
					<div class="formlabel">Question</div>
					<div class="form_text_box">
						<input type="text" name="ques" id="ques" value="<?php echo $ques;?>"  style="width:400px; height:20px;"/>
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
							$fck->Value = $desc;												
							$fck->Create();
						?>	
					</div>
					<div style="clear:both"></div>
					<div class="formlabel">Correct Answer:</div>
					<div class="form_text_box" style="width:560px;text-align:left;">
						<input type="text" name="cans" id="cans" maxlength="1" value="<?php echo $cans;?>" style="width:280px; height:20px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mark&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mark" id="mark" value="<?php echo $mark;?>" maxlength="2" style="width:50px; height:20px;"/>
					</div>	
					<div style="clear:both"></div>
					<div class="submit_form" style="width:250px;">				
						<input type="submit" name="submit" id="submit" value="Submit" style="width:80px; margin-right:10px;height:25px;cursor:pointer; border:none; background-color:#49729E; color:#FFF;float:left;" />
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
  frmvalidator.addValidation("ques","req","Question Required");  
     
//]]>
</script>
</body>
</html>