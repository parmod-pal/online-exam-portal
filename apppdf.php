<?php
ob_start();
session_start();
$appid='';$enc='';
if(isset($_SESSION['appid']))
{
	$appid=$_SESSION['appid'];
}
if(isset($_SESSION['enc']))
{
	$enc=$_SESSION['enc'];
}
include "config.php";
global $conn;
$con=$conn;
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Application Form For PG-DPM</title>
		<style type="text/css">
	<!--
	body {
		margin:0px;
		padding:0px;
		}
		.forward{
		float:right;
		}
		.back{
		float:left;
		}
		.clr{
		clear:both;
		}
		.formpage {
		width:518px;
		}
		.logo {
		padding-right:5px;
		}
		.app_form h1{
			font:bold 13px Geneva, Arial, Helvetica, sans-serif;
			text-align:center;
		}
		.app_form p{
			font:bold 12px Calibri;
		}
		.form_sty{
		font: bold 15px Calibri;
		display:block;
		padding:0 10px 0 10px;

		}
		.lab_text{
		text-indent:140px;
		line-height:35px;
		}
		.lab_text1{
		text-indent:87px;
		line-height:35px;
		}
		.form_sty h2{
		font: bold 18px Calibri;
		}
		h2{
		font: bold 18px Calibri;
		}

		.block1{
		width:170px;
		}
		.block1 h1{
			text-decoration:underline;
			text-align:center;
		}
		.block1 p{
			text-align:center;
		}
		.block2{
		width:105px;
		padding:0 0 0 25px;
		}
		.block2 h1{
			text-decoration:underline;
			text-align:center;
		}
		.block2 p{
			text-align:center;
		}
		.block3{
		width:105px;
		padding:0 0 0 25px;
		}
		.block3 h1{
			text-decoration:underline;
			text-align:center;
		}
		.block3 p{
			text-align:center;
		}
		.box{
			width:125px;
			text-align:center;
		}
		.box h1{
			text-decoration:underline;
			text-align:center;
		}
		.box p{
			text-align:center;
		}
		.box2{
			width:125px;
			text-align:center;
			padding:0 0 0 25px;
		}
		.box2 h1{
			text-decoration:underline;
			text-align:center;
		}
		.box2 p{
			text-align:center;
		}
		textarea {
		width:100%;
		height:150px;			
			border-style: solid;
			border-width: thin;
			padding:4px;
			text-decoration:none;
			font:10px "Myriad Pro";
			margin:10px 0 10px 0;
		}
		.submit {
			font:bold 13px "Myriad Pro";
			background:#999999;
			border:none;
			text-align:center;
			padding:6px;
			margin:7px;

		}
		th{
		background:#999999;
		}
		span,label,p,td{line-height:20px;letter-spacing:1px;}-->
		</style>		
	</head>
<body onload=''>
	<div class="formpage">
		<div class="app_form">		
		<div style="text-align:right;width:90%;">
			Application No:<?php echo $appid;?>
			</div><div class="clr"></div>			
			<div class="logo back">
				<p><img src="gapplogo.jpg" alt="logo" style="float:left;"/><h1>APPLICATION FOR ADMISSION PG-DPM</h1>		
			This is an online application form. Please complete this application and submit it to admissions@rimsr.in. Alternateively, you could submit this application to the Registrar, RIMSR at registrar@rimsr.in. If a question is not applicable,respond with "N/A".</p>
			</div>
			<div class="clr"></div>
			<div class="container">			
				<?php 
				$resu=mysqli_query($con,"select * from rim_chronoforms_9 where cf_id='".$appid."'and encrypt='".$enc."'");
				
				if($resu>0)
				{
				
					while($data=mysqli_fetch_array($resu))
					{					
				?>
					Have you applied to Brenau University in the past?&nbsp; 
						<?php echo $data['past_apply'];?>
						
					<br />
					<div class="lab_text">If yes, when?&nbsp;<span name="past_details"><?php echo $data['past_details'];?></span></div>
					Have you attended Brenau University in the past?&nbsp; 
					<?php echo $data['past_attend'];?>									
					<br />
					<div class="lab_text1">If yes, which campus?&nbsp;
					<span name="past_details1"> <?php echo $data['past_attend_details'];?></span></div>
					When do you plan to start taking the Post-Graduate Diploma in Project Management? <br/>(please indicate the month and the year)&nbsp; <br /><br /><span >Month:<?php echo $data['month'];?></span>&nbsp;&nbsp;<span >Year:<?php echo $data['year'];?> </span>
					
					<h2>PERSONAL INFORMATION</h2><br/>					
					<table width="518" border="0">
						<tr>
							<td>Name</td>
							<td>:</td>
							<td><span name="name"> <?php echo $data['name'];?></span></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><span name="email"> <?php echo $data['emailid'];?></span></td>
						</tr>
						<tr>
							<td>House Address</td>
							<td>:</td>
							<td><span name="houseaddress"> <?php echo $data['houseaddress'];?></span></td>
						</tr>
						<tr>
							<td>Street</td>
							<td>:</td>
							<td><span name="street" ><?php echo $data['street'];?></span><br /></td>
						</tr>
						<tr>
							<td>City &amp; Pin</td>
							<td>:</td>
							<td><span name="city" ><?php echo $data['city'];?> </span><br/></td>
						</tr>
						<tr>
							<td>State</td>
							<td>:</td>
							<td><span name="State"> <?php echo $data['State'];?></span><br/></td>
						</tr>
						<tr>
							<td>HomePhone</td>
							<td>:</td>
							<td><span name="HomePhone"> <?php echo $data['HomePhone'];?></span><br /></td>
						</tr>
						<tr>
							<td>MobilePhone</td>
							<td>:</td>
							<td><span name="MobilePhone"> <?php echo $data['MobilePhone'];?></span><br /></td>
						</tr>
						<tr>
							<td>BusinessPhone</td>
							<td>:</td>
							<td><span name="BusinessPhone"> <?php echo $data['BusinessPhone'];?> </span><br /></td>
						</tr>
					</table>			
					
					<h2>ADDITIONAL INFORMATION</h2>
					<table>
						<tr>
							<td>Adhar No</td>
							<td>:</td>
							<td><span name="AdharNo"> <?php echo $data['AdharNo'];?> </span><br /></td>
						</tr>
						<tr>
							<td>PAN No</td>
							<td>:</td>
							<td><span name="pan_no"> <?php echo $data['pan_no'];?> </span><br /></td>
						</tr>
						<tr>
							<td>Voter's ID No</td>
							<td>:</td>
							<td><span name="Voter_id"> <?php echo $data['Voter_id'];?> </span><br /></td>
						</tr>
						<tr>
							<td>Date of Birth</td>
							<td>:</td>
							<td><span name="dob"> <?php echo $data['dob'];?></span><br /></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td>:</td>
							<td>
								<?php
								echo $data['gender'];								
								?>																
							</td>
						</tr>
						<tr>
							<td>Employment Status</td>
							<td>:</td>
							<td>
								<?php
								echo $data['rd1'];
								?>									
							</td>
						</tr>
					</table>		   
					<label>If others, give details:</label><span name="otherdetails"> <?php echo $data['otherdetails'];?></span><br /><br/>
					<label>How did you learn about Brenau's PGDPM? (check all that apply)</label><br /><br />
						<?php
						if($data['Newspaper']!='')
						{
							echo $data['Newspaper'];
						}										
						?>
					<br/><br/>
					<label>Statement of Purpose: Please indicate the purpose of taking this program in the space given below:</label><br />
					<textarea name="purpose"> <?php echo $data['purpose'];?></textarea>
					
					<h2>DEGREE SEEKING STUDENTS</h2>
					<p>If, you are pursuing a degree program like, BE, BTech, BA, BSc, BCom, BBA, BCA or any other degree program you are permitted<br/> to seek admission to the PGDPM subject to the condition that the 'Certifiate of Completion of PGDPM' will be awarded only <br/>after submission of proof of successful completion of the degree program.<br/> Please give details of the degree program that you are pursuing:</p><br/>
					<textarea name="degreeseeking"> <?php echo $data['degreeseeking'];?> </textarea>
					
					<h2>PREVIOUS COLLEGES ATTENDED</h2>
					<p>List all colleges, universities and technical schools you have previously attended, including Brenau University (use extra sheet if necessary). Transcripts are required from each institution regardless of length of study. Institution Location Last Year Attended <br/>
					Major</p>
					<table>
						<tr class="headertable">
							<th>Institution</th> 
							<th>Location</th>
							<th>Last Year Attended</th>
							<th>Major</th> 
							<th>Degree Conferred</th>
						</tr>
						<tr>
							<td><span name="Institution1"> <?php echo $data['Institution1'];?></span></td>
							<td><span name="location1" ><?php echo $data['location1'];?></span></td>
							<td><span name="LastYear1"> <?php echo $data['LastYear1'];?></span></td>
							<td><span name="major1" ><?php echo $data['major1'];?></span></td>
							<td><span name="Degree1"> <?php echo $data['Degree1'];?></span></td>
						</tr>
						<tr>
							<td><span name="Institution2" ><?php echo $data['Institution2'];?></span></td>
							<td><span name="location2"> <?php echo $data['location2'];?></span></td>
							<td><span name="LastYear2" ><?php echo $data['LastYear2'];?></span></td>
							<td><span name="major2"> <?php echo $data['major2'];?></span></td>
							<td><span name="Degree2"> <?php echo $data['Degree2'];?></span></td>
						</tr>
						<tr>
							<td><span name="Institution3" ><?php echo $data['Institution3'];?></span></td>
							<td><span name="location3"> <?php echo $data['location3'];?></span></td>
							<td><span name="LastYear3"> <?php echo $data['LastYear3'];?></span></td>
							<td><span name="major3"> <?php echo $data['major3'];?></span></td>
							<td><span name="Degree3"> <?php echo $data['Degree3'];?></span></td>
						</tr>
						<tr>
							<td><span name="Institution4"> <?php echo $data['Institution4'];?></span></td>
							<td><span name="location4"> <?php echo $data['location4'];?></span></td>
							<td><span name="LastYear4" ><?php echo $data['LastYear4'];?></span></td>
							<td><span name="major4"> <?php echo $data['major4'];?></span></td>
							<td><span name="Degree4"> <?php echo $data['Degree4'];?></span></td>
						</tr>
						<tr>
							<td><span name="Institution5" ><?php echo $data['Institution5'];?></span></td>
							<td><span name="location5"> <?php echo $data['location5'];?></span></td>
							<td><span name="LastYear5"> <?php echo $data['LastYear5'];?></span></td>
							<td><span name="major5"> <?php echo $data['major5'];?></span></td>
							<td><span name="Degree5"> <?php echo $data['Degree5'];?></span></td>
						</tr>
					</table>
					<p>My signature below indicates that all information in my application is complete, factually correct and honestly presented. I <br/>understand that failure to provide accurate and true information may invalidate my admission to Brenau University/ RIMSR. I have read and understand the admissions policy of Brenau University/ RIMSR. If my application is accepted and I become a student, 
					I agree to abide by all policies and regulations of Brenau University/ RIMSR.</p><br/><br/><br/>
					<table width="600">
						<tr>
							<td><span>Signature of Applicant:</span></td>
							<td><span><?php echo $data['sign'];?></span></td>						
							<td width="400"><span></span></td>								
							<td><span>Date :</span></td>
							<td><span><?php echo $data['date'];?></span></td>
						</tr>
					</table>
				<div class="clr"></div> 
				<div class="address_container">										
					 <p style="color:brown;">
					 Accreditation: RIMSR is accredited by KSOU(Karnataka State Open University) Mysore,Karnataka,India to award diploma degrees.<br/>RIMSR believes in and practices equal opportunity for all. The diplomas' awarded by RIMSR are <br/>recognized in India and Abroad.</p>
				</div>
				
				<h2>RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES AND RESEARCH CAMPUS</h2>
				<div class="footer">
					<table>
						<tr>
							<td>
								<b>RIMSR, Bangalore, India Registrar</b><br/>
								716/ 35, II Floor, J C Plaza<br/>
								12th Main, 42nd Cross<br/>
								III Block, Rajajinagar<br/>
								Bangalore - 560010
							</td> 
							<td></td>
							<td>
								<b>Contact Details:</b><br/>
								Phone 1: 080 - 2340-9795<br/>
								Phone 2: 080 - 2314-7407<br/>						
								Email - registrar@rimsr.in<br/>
								Website: www.rimsr.in	
							</td>												
						</tr>
					</table>  
				</div>
			<?php
					}
				}				
			?>
			</div><!-- app form end-->
		</div><!--form page end-->
	</div>	
</body>
</html>