<?php
	include "dbconnect.php";
	$tot=0;
	$sql="SELECT count(*)as row FROM rim_chronoforms_4";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {	
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$tot=  $row["row"];
		}
	} 
	$tot++;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Application</title>
<link href="css/application.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="application" id="application" style="padding:0px ;">
<img src="images/intapp.jpg" />
	<div class="app" style="padding:15px;">
	<form method="post" action="insertintapp.php" autocomplete="off" class="form_sty" name="frm1" enctype="multipart/form-data">
		<input type="hidden" class="diploma" name="diploma" value="GEN" />
		<h4>Application No.:&nbsp;<?php echo $tot;?></h4>
		<div class="clr"></div>
		<hr width="100%" size="1" color="#333" />
		<div class="app_div1" id="app_div1">		
		<div class="clr"></div>
		<div class="app_div3" id="app_div3">
		<div class="app_container1">
							<div class="clr"></div>
		
		 <p>PLEASE PROVIDE THE FOLLOWING DETAILS : </p>
							<h2>PERSONAL INFORMATION</h2>
							<table width="670" border="0" class="add_table1">
<tr>
									<td>PROGRAM APPLIED FOR</td>
									<td>:</td>
									<td><input type="text" name="Course Applied For" value="" size="28" /></td>
								</tr>
								<tr>
									<td>FIRST NAME</td>
									<td>:</td>
									<td><input type="text" name="name" value="" size="28" /></td>
								</tr>
								<tr>
									<td>MIDDLE NAME</td>
									<td>:</td>
									<td><input type="text" name="mname" value="" size="28" /></td>
								</tr>
								<tr>
									<td>LAST NAME</td>
									<td>:</td>
									<td><input type="text" name="lname" value="" size="28" /></td>
								</tr>
								 
								<tr>
									<td>POSTAL ADDRESS (INCLUDING THE PIN CODE)</td>
									<td>:</td>
									<td><textarea name="houseaddress" value="" cols="23" rows="5"></textarea></td>
								</tr>
								
								<tr>
									<td>DATE OF BIRTH</td>
									<td>:</td>
									<td><input type="text" name="dob" value="" size="28" /><span style="color:red;font-family:arial;font-size:12px;">eg:17/04/2000</span><br /></td>
								</tr>
								<tr>
									<td>GENDER</td>
									<td>:</td>
									<td>
										<input type="radio"name="gender" value="Male" checked />MALE
										<input type="radio"name="gender" value="Female"/>FEMALE
										<input type="radio"name="gender" value="Other"/>Other
									</td>
								</tr>
								<tr>
									<td>ETHNICITY/RACE</td>
									<td>:</td>
									<td><input type="text" name="race" value="" size="28" /><br/></td>
								</tr>
								<tr>
									<td>NATIONALITY</td>
									<td>:</td>
									<td><input type="text" name="nationality" value="" size="28" /><br/></td>
								</tr>
								<tr>
									<td>RELIGION(OPTIONAL)</td>
									<td>:</td>
									<td><input type="text" name="religion" value="" size="28" /><br/></td>
								</tr>
								<tr>
									<td>TELEPHONE NO. (INCLUDE COUNTRY AND AREA CODES)</td>
									<td>:</td>
									<td><input type="text" name="HomePhone" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>CELL PHONE NO</td>
									<td>:</td>
									<td><input type="text" name="MobilePhone" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>OFFICIAL ID NUMBER</td>
									<td>:</td>
									<td><input type="text" name="offid" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>PLACE OF ISSUE</td>
									<td>:</td>
									<td><input type="text" name="poi" value="" size="28" /><br /></td>
								</tr>
								
								</table>			
							<div class="clr"></div>
							<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
							<h2>ADDITIONAL INFORMATION</h2>
							<table class="add_table1" width="570" border="0">
								<tr>
									<td>NAME OF THE PARENT/GUARDIAN:</td>
									<td>:</td>
									<td><input type="text" name="gname" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>POSTAL ADDRESS OF THE PARENT/GUARDIAN</td>
									<td>:</td>
									<td><textarea name="gaddress" value="" cols="23" rows="5"></textarea><br /></td>
								</tr>								
								<tr>
									<td>PHONE NUMBER OF THE PARENT/GUARDIAN</td>
									<td>:</td>
									<td><input type="text" name="gphone" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>CELL NUMBER OF THE PARENT/GUARDIAN</td>
									<td>:</td>
									<td><input type="text" name="gmobile" value="" size="28" /><br /></td>
								</tr>
																
							</table>			
							<div class="clr"></div>
		<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
							<h2>EDUCATIONAL BACKGROUND : </h2>
							<table class="add_table1" width="557" border="0">
								<table width="100%">
								<tr class="headertable">
									<th>Name of the college and location<br/> (from the most recent)</th> 
									<th>Period <br/> (From - To)</th>
									<th>Course</th>
									<th>Major subjects studied</th> 
									<th>Secured Grade</th>									
								</tr>
								<tr>
									<td><input type="text" name="Institution1" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period1" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course1" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major1" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class1" value="" size="10" style="width:98%;" /></td>
									
								</tr>
								<tr>
									<td><input type="text" name="Institution2" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period2" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course2" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major2" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class2" value="" size="10" style="width:98%;" /></td>
									
								</tr>
								<tr>
									<td><input type="text" name="Institution3" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period3" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course3" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major3" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class3" value="" size="10" style="width:98%;" /></td>
									
								</tr>
								<tr>
									<td><input type="text" name="Institution4" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period4" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course4" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major4" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class4" value="" size="10" style="width:98%;" /></td>
									
								</tr>
							</table></table>
							<div class="clr"></div>
										<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
							<h2>WORK EXPERIENCE:(Most Recent First) </h2>
							<table class="add_table1" width="557" border="0">
								<table width="100%">
								<tr class="headertable">
									<th>Job Title</th> 
									<th>Company</th>
									<th>From</th>
									<th>To</th> 
									<th>MAJOR TASKS HANDLED</th>
									<th>ANY OTHER INFORMATION IN SUPPORT OF YOUR ADMISSION</th>
								</tr>
								<tr>
									<td><input type="text" name="job1" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company1" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from1" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to1" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="mtask1" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="othr1" value="" size="20" style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="job2" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company2" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from2" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to2" value="" size="20" style="width:98%;" /></td>
										<td><input type="text" name="mtask2" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="othr2" value="" size="20" style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="job3" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company3" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from3" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to3" value="" size="20" style="width:98%;" /></td>
										<td><input type="text" name="mtask3" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="othr3" value="" size="20" style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="job4" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company4" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from4" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to4" value="" size="20" style="width:98%;" /></td>
										<td><input type="text" name="mtask4" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="othr4" value="" size="20" style="width:98%;" /></td>
								</tr>
							</table>
							</table>
							<div class="clr"></div>
							<table class="add_table1" width="" border="0" style="margin-top:15px;">							
								<tr>
									<td style="vertical-align:top;">HOW DID YOU COME TO KNOW ABOUT RIMSR, AND THE COURSES OFFERED?</td>
									<td style="vertical-align:top;">:</td>
									<td><textarea cols="72" rows="5" name="htk"></textarea></td>
								</tr>
								
							</table>
<div class="clr"></div>
										
								<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
								
						<div class="address_container">		
							<h3>DECLARATION</h3>						
							 <p style="color:brown; font-size:12px;  line-height:20px; text-align:justify;">I DO HEREBY DECLARE THAT I WILL ABIDE BY THE RULES, REGULATIONS AND ORDERS FRAMED OR PASSED BY RIMSR FROM TIME TO TIME. THE INFORMATION GIVEN BY ME IN THE APPLICATION IS TRUE TO THE BEST OF MY KNOWLEDGE AND BELIEF. I UNDERSTAND THAT I WILL BE HELD RESPONSIBLE IF ANY INCORRECT OR WRONG INFORMATION IS GIVEN HERE, AND IN WHICH CASE MY ADMISSION IS LIABLE TO BE CANCELLED AUTOMATICALLY. IN SUCH A CASE THE DECISION OF THE DIRECTOR, RIMSR IS FINAL AND BINDING.</p>
						</div>
						<div class="clr"></div>
						<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
							<span>Upload Photograph&nbsp;&nbsp;&nbsp;:</span>					
							<input type="file" name="photo" value="" size="20"/><br/><br/>	
							<span>Upload Official Id&nbsp;&nbsp;&nbsp;:</span>					
							<input type="file" name="idimg" required value="" size="20"/><br/><br/>								
							<span>Upload Degree Certificate:</span>					
							<input type="file" name="certificate" value="" required style="width:180px;margin-left:3px;"/><span>(Student pursuing a degree program may upload latest marks credential)</span><br/><br/>
							<span>Signature of Applicant:</span>
							<input type="text" name="sign" value="" size="28"/>
							<input type="file" name="signfile" value="" size="20"/>&nbsp;&nbsp;<br/><br/>
							<span>Place&nbsp;&nbsp;&nbsp;:</span><input type="text" name="place1" value="" size="15"/><br/><br/>
							<span>Date&nbsp;&nbsp;&nbsp;:</span><input type="text" name="date1" value="" size="15"/><span style="color:red;font-family:arial;font-size:12px;">eg:17/04/2000</span><br/><br/>
							
							<div class="partnerform_label">Enter Verification Code:</div>
							<div class="parner_textbox">
								<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br/>
								<input id="6_letters_code" required name="6_letters_code" autocomplete="off" type="text" style="margin-top:10px;width:250px; height:20px;"><br>
								<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
							</div>
							<div style="text-align:center;width:100%;">
								<input type="submit" name="submit" value="SUBMIT" class="submit"></input>
							</div>
						<div class="clr"></div>
		
						
					</div>
		</div>

	</div>
	</form>
</div>
</body>
</html>

	<script language='JavaScript' type='text/javascript'>
	function refreshCaptcha()
	{
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
</script>
<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>
	<script language="JavaScript" type="text/javascript"
		xml:space="preserve">//<![CDATA[
		//You should create the validator only after the definition of the HTML form
		var frmvalidator  = new Validator("frm1");
		frmvalidator.addValidation("name","req","Name Required");
		frmvalidator.addValidation("idimg","req","Upload your official Id"); 		 
		frmvalidator.addValidation("certificate","req","Upload Degree Certificate"); 
		frmvalidator.addValidation("6_letters_code","req","Please enter verification code");					
	//]]>
	</script>