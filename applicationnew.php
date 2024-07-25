<?php
	include "dbconnect.php";
	$tot=0;
	$sql="SELECT count(*)as row FROM rim_chronoforms_3";
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
<img src="images/rimsr1.png" />
	<div class="app" style="padding:15px;">
	<form method="post" action="insertappnew.php" autocomplete="off" class="form_sty" name="frm1" enctype="multipart/form-data">
		<h4>Application No.:&nbsp;<?php echo $tot;?></h4>
		<div class="clr"></div>
		<hr width="100%" size="1" color="#333" />
		<div class="app_div1" id="app_div1">
		<div class="logo1" id="logo1">
		<img src="images/logo1.jpg"  />
		</div>
		<div class="addm" id="addm">
		<h3 style="text-align:center; font-size:16px; color:#3C7191;">APPLICATION FOR ADMISSION TO</h3><br/>
		<!--<p style="color:#80a138; font-size:16px;"><b>INDICATE THE PROGRAM THAT YOU INTEND TO TAKE : </b></p>
        <div class="foundation">
        <p>1.BASIC PROGRAMS</p>
        <table>
        <tr>
        <td>Certificate Program in Project Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="F1" /></td>
        </tr>
         <tr>
        <td>Certificate Program in Business Finance</td>
        <td><input type="radio" class="diploma" name="diploma" value="F2" /></td>
        </tr>
         <tr>
        <td>Certificate in Health Care Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="F3" /></td>
        </tr>
         <tr>
        <td>Certificate in Management of MSME</td>
        <td><input type="radio" class="diploma" name="diploma" value="F4" /></td>
        </tr>
		<tr>
        <td>Supply – Chain Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="F5" /></td>
        </tr>
		<tr>
        <td>Business Finance </td>
        <td><input type="radio" class="diploma" name="diploma" value="F6" /></td>
        </tr>
		<tr>
        <td>Project Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="F7" /></td>
        </tr>
		<tr>
        <td>Health Care Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="F8" /></td>
        </tr>
		<tr>
        <td>Production Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="F9" /></td>
        </tr>
		<tr>
        <td>Teaching Methodologies </td>
        <td><input type="radio" class="diploma" name="diploma" value="F10" /></td>
        </tr>
		<tr>
        <td>ERP using TALLY </td>
        <td><input type="radio" class="diploma" name="diploma" value="F11" /></td>
        </tr>
		<tr>
        <td>Inventory Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="F12" /></td>
        </tr>
        </table>
        </div>
        <div class="foundation">
        <p>2.ADVANCED PROGRAMS</p>
        <table>
        <tr>
        <td>Post-Graduate Diploma in Procurement Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="A1" /></td>
        </tr>
         <tr>
        <td>Post-Graduate Diploma Program in Health-Care Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="A2" /></td>
        </tr>
         <tr>
        <td>Post-Graduate Diploma in Business Finance</td>
        <td><input type="radio" class="diploma" name="diploma" value="A3" /></td>
        </tr>
         <tr>
        <td>Advanced Certificate Program in Health-Care Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="A4" /></td>
        </tr>
		<tr>
        <td>Supply-Chain Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="A5" /></td>
        </tr>
	<tr>
        <td>Health Care Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="A6" /></td>
        </tr>
	<tr>
        <td>Project Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="A7" /></td>
        </tr>
	<tr>
        <td>Business Finance </td>
        <td><input type="radio" class="diploma" name="diploma" value="A8" /></td>
        </tr>
	<tr>
        <td>International Business </td>
        <td><input type="radio" class="diploma" name="diploma" value="A9" /></td>
        </tr>
	<tr>
        <td>MSME Management </td>
        <td><input type="radio" class="diploma" name="diploma" value="A10" /></td>
        </tr>
	<tr>
        <td>Taxation </td>
        <td><input type="radio" class="diploma" name="diploma" value="A11" /></td>
        </tr>

        </table>
        </div>
        <div class="foundation">
        <p>3.EXPERT PROGRAMS</p>
        <table>
        <tr>
        <td>Advanced Certificate Program in MSME Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="E1" /></td>
        </tr>
         <tr>
        <td>Study Abroad-Global Exposure Program in International Business</td>
        <td><input type="radio" class="diploma" name="diploma" value="E2" /></td>
        </tr>
         <tr>
        <td>Post-Graduate Diploma in Project Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="E3" /></td>
        </tr>
         <tr>
        <td>International Expert Program in MSME Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="E4" /></td>
        </tr>
		<tr>
        <td>Project Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="E5" /></td>
        </tr> 
	<tr>
        <td>Production and Control Management</td>
        <td><input type="radio" class="diploma" name="diploma" value="E6" /></td>
        </tr> 
	<tr>
        <td>Business Analytics </td>
        <td><input type="radio" class="diploma" name="diploma" value="E7" /></td>
        </tr>
	<tr>
        <td>Business Finance </td>
        <td><input type="radio" class="diploma" name="diploma" value="E8" /></td>
        </tr>

        </table>
        </div>
-->
		
		
		</div>
		<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<div class="app_div3" id="app_div3">
		<div class="app_container1">
							<div class="clr"></div>
		<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
		 <p>PLEASE PROVIDE THE FOLLOWING DETAILS : </p>
							<h2>PERSONAL INFORMATION</h2>
							<table width="670" border="0" class="add_table1">
							<tr>
									<td>NAME (SUR NAME FOLLWED BY GIVEN NAME)</td>
									<td>:</td>
									<td><input type="text" name="name" value="" size="28" /></td>
								</tr>
								 <!--<tr>
									<td>Email</td>
									<td>:</td>
									<td><input type="text" name="emailid" value="" size="28" /></td>
								</tr>-->
								<tr>
									<td>POSTAL ADDRESS (INCLUDING THE PIN CODE)</td>
									<td>:</td>
									<td><textarea name="houseaddress" value="" cols="23" rows="5"></textarea></td>
								</tr>
								<tr>
									<td>PERMANENT ADDRESS (INCLUDING THE PIN CODE)</td>
									<td>:</td>
									<td><textarea name="peraddress" value="" cols="23" rows="5"></textarea><br /></td>
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
										<input type="radio"name="gender" value="Male"/>MALE
										<input type="radio"name="gender" value="Female"/>FEMALE
									</td>
								</tr>
								<tr>
									<td>NATIONALITY</td>
									<td>:</td>
									<td><input type="text" name="nationality" value="" size="28" /><br/></td>
								</tr>
								<tr>
									<td>RELIGION</td>
									<td>:</td>
									<td><input type="text" name="religion" value="" size="28" /><br/></td>
								</tr>
								<tr>
									<td>TELEPHONE NO WITH AREA CODE</td>
									<td>:</td>
									<td><input type="text" name="HomePhone" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>CELL PHONE NO</td>
									<td>:</td>
									<td><input type="text" name="MobilePhone" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>PAN CARD No</td>
									<td>:</td>
									<td><input type="text" name="pan_no" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>Adhar No</td>
									<td>:</td>
									<td><input type="text" name="AdharNo" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>DRIVING LICENSE NO </td>
									<td>:</td>
									<td><input type="text" name="driving" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td>Voter's ID No</td>
									<td>:</td>
									<td><input type="text" name="Voter_id" value="" size="28" /><br /></td>
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
									<td>IN CASE OF GUARDIAN PLEASE INDICATE THE RELATIONSHIP TO THE APPLICANT</td>
									<td>:</td>
									<td><input type="text" name="relationship" value="" size="28" /><br /></td>
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
								<tr>
									<td>IF PARENT/GUARDIAN IS EMPLOYED, PROVIDE DETAILS OF HIS/HER EMPLOYMENT</td>
									<td>:</td>
									<td><input type="text" name="employee" value="" size="28" /><br /></td>
								</tr>
								<tr>
									<td style="vertical-align:top;">PLEASE INDICATE WHETHER YOU BELONG TO SPECIAL CATEGORY</td>
									<td style="vertical-align:top;">:</td>
									<td>
										<input type="radio"name="caste" value="SCHEDUELED CASTE"/> a.SCHEDUELED CASTE<br/>
										<input type="radio"name="caste" value="SCHEDUELED TRIBE"/> b.SCHEDUELED TRIBE<br/>
										<input type="radio"name="caste" value="OTHER BACKWARD CLASSES"/> c. OTHER BACKWARD CLASSES(INDICATE SPECIFICALLY)
									</td>
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
									<th>Class secured</th>
									<th>Percentage</th>
								</tr>
								<tr>
									<td><input type="text" name="Institution1" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period1" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course1" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major1" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class1" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="percentage1" value=""  size="14"style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="Institution2" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period2" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course2" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major2" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class2" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="percentage2" value=""  size="14"style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="Institution3" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period3" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course3" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major3" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class3" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="percentage3" value=""  size="14"style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="Institution4" value=""  style="width:98%;"/></td>
									<td><input type="text" name="period4" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="course4" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="major4" value="" size="20" style="width:98%;" /></td>
									<td><input type="text" name="class4" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="percentage4" value=""  size="14"style="width:98%;" /></td>
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
								</tr>
								<tr>
									<td><input type="text" name="job1" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company1" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from1" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to1" value="" size="20" style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="job2" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company2" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from2" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to2" value="" size="20" style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="job3" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company3" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from3" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to3" value="" size="20" style="width:98%;" /></td>
								</tr>
								<tr>
									<td><input type="text" name="job4" value=""  style="width:98%;"/></td>
									<td><input type="text" name="company4" value="" size="10" style="width:98%;" /></td>
									<td><input type="text" name="from4" value=""  size="14"style="width:98%;" /></td>
									<td><input type="text" name="to4" value="" size="20" style="width:98%;" /></td>
								</tr>
							</table>
							</table>
							<div class="clr"></div>
							<table class="add_table1" width="" border="0" style="margin-top:15px;">
								<tr>
									<td style="vertical-align:top;">AWARDS, MERIT CERTIFICATES, ACHIEVEMENT CERTIFICATES, IF ANY</td>
									<td style="vertical-align:top;">:</td>
									<td><textarea cols="72" rows="5" name="achivements"></textarea></td>
								</tr>
								<tr>
									<td style="vertical-align:top;">HOW DID YOU COME TO KNOW ABOUT RIMSR, AND THE COURSES OFFERED?</td>
									<td style="vertical-align:top;">:</td>
									<td><textarea cols="72" rows="5" name="htk"></textarea></td>
								</tr>
								
							</table>
<div class="clr"></div>
										<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
							<h2>PLEASE PROVIDE THE FOLLOWING DETAILS (FOR FOREIGN NATIONAL ONLY)</h2>							
							<table width="820" border="0" class="add_table1">
							<tr>
									<td>Pass-Port No</td>
									<td>:</td>
									<td><input type="text" name="passportno" value="" size="28" /></td>
								</tr>
								<tr>
									<td>Place of Issue</td>
									<td>:</td>
									<td><input type="text" name="poi" value="" size="28" /></td>
								</tr>
								<tr>
									<td>Date of Issue</td>
									<td>:</td>
									<td><input type="text" name="doi1" value="" size="28" /><span style="color:red;font-family:arial;font-size:12px;">eg:17/04/2000</span></td>
								</tr>
								<tr>
									<td>Date of Expiry:</td>
									<td>:</td>
									<td><input type="text" name="doe1" value="" size="28" /><span style="color:red;font-family:arial;font-size:12px;">eg:17/04/2000</span></td>
								</tr>
								</table>
								<h2>PLEASE PROVIDE THE VISA PARTICULARS:</h2>							
							<table width="570" border="0" class="add_table1">
							<tr>
									<td>Date of Issue of Indian Visa:</td>
									<td>:</td>
									<td><input type="text" name="dateofissue" value="" size="28" /><span style="color:red;font-family:arial;font-size:12px;">eg:17/04/2000</span></td>
								</tr>
								<tr>
									<td>Date of Expiry</td>
									<td>:</td>
									<td><input type="text" name="visaexpiry" value="" size="28" /><span style="color:red;font-family:arial;font-size:12px;">eg:17/04/2000</span></td>
								</tr>
								<tr>
									<td>Type of Visa</td>
									<td>:</td>
									<td><input type="text" name="typeofvisa1" value="" size="28" /></td>
								</tr>
								<tr>
									<td>Visa Number</td>
									<td>:</td>
									<td><input type="text" name="visanumber1" value="" size="28" /></td>
								</tr>
								<tr>
									<td>Place of Issue</td>
									<td>:</td>
									<td><input type="text" name="placeofissue1" value="" size="28" /></td>
								</tr>
								</table>
								<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
								
						<div class="address_container">		
							<h3>DECLARATION</h3>						
							 <p style="color:brown; font-size:12px;  line-height:20px; text-align:justify;">I do hereby declare that I will abide by the rules, regulations and orders framed or passed by RIMSR from time to time. The information given by me in the application is true to the best of my knowledge and belief. I understandthat I will be held responsible if any incorrect or wrong information is given here, and in which case my admission is liable to be cancelled automatically. In such a case the decision of the Director, RIMSR is final and binding.</p>
						</div>
						<div class="clr"></div>
						<hr width="100%" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
							<span>Upload Photograph&nbsp;&nbsp;&nbsp;:</span>					
							<input type="file" name="photo" value="" size="20"/><br/><br/>
							<span>Upload SSLC Mark Sheet:</span>					
							<input type="file" name="sslc" value="" size="20" style="margin-left:11px;"/><br/><br/>
							<span>Upload Degree Certificate:</span>					
							<input type="file" name="certificate" value="" style="width:180px;margin-left:3px;"/><span>(Student pursuing a degree program may upload latest marks card)</span><br/><br/>
							<span>Signature of Applicant:</span>
							<input type="text" name="sign" value="" size="28"/>
							<input type="file" name="signfile" value="" size="20"/>&nbsp;&nbsp;<br/><br/>
							<span>Place&nbsp;&nbsp;&nbsp;:</span><input type="text" name="place1" value="" size="15"/><br/><br/>
							<span>Date&nbsp;&nbsp;&nbsp;:</span><input type="text" name="date1" value="" size="15"/><span style="color:red;font-family:arial;font-size:12px;">eg:17/04/2000</span><br/><br/>
							
							<div class="partnerform_label">Enter Verification Code:</div>
							<div class="parner_textbox">
								<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br/>
								<input id="6_letters_code" name="6_letters_code" type="text" required autocomplete="off" style="margin-top:10px;width:250px; height:20px;"><br>
								<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
							</div>
							<div style="text-align:center;width:100%;">
								<input type="submit" name="submit" value="SUBMIT" class="submit"></input>
							</div>
						<div class="clr"></div>
		
						<!--<div class="footer" style="height:220px;"><h2>RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES AND RESEARCH CAMPUS</h2>
						<div class="clr"></div>
							<div class="box back" style="margin-left:225px;">
								<h1>RIMSR, Bangalore, India
								Registrar</h1>
								<p>716/ 35, II Floor, J C Plaza
								12th Main, 42nd Cross
								III Block, Rajajinagar
								Bangalore - 560010</p>
								<div class="clr"></div>
							</div>
							<div class="box2 back">
								<h1>Contact Details:</h1>
								<p>Phone 1: 080 - 2340-9795<br/>
								Phone 2: 080 - 2314-7407
								<br>
								Email - registrar@rimsr.in
								Website: www.rimsr.in</p>
								<div class="clr"></div>
							   
						</div>
						</div>-->
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
		frmvalidator.addValidation("diploma","selone","Select Course");  
		frmvalidator.addValidation("name","req","Name Required");		
		frmvalidator.addValidation("houseaddress","req","Address Required");
		frmvalidator.addValidation("dob","req","Date of birth Required");
		frmvalidator.addValidation("gender","req","Gender Required");
		frmvalidator.addValidation("nationality","req","Nationality Required");
		frmvalidator.addValidation("religion","req","Religion Required");		
		frmvalidator.addValidation("MobilePhone","req","Mobile Number Required");
		frmvalidator.addValidation("MobilePhone","numeric","Enter Only Numeric Values");		
		frmvalidator.addValidation("Institution1","req","Institute Name Required");
		frmvalidator.addValidation("period1","req","Duration Required");		
		frmvalidator.addValidation("course1","req","Course Required");
		frmvalidator.addValidation("major1","req","Major Subject Required");
		frmvalidator.addValidation("class1","req","Class Required");
		frmvalidator.addValidation("percentage1","req","Percentage Required");
		frmvalidator.addValidation("gname","req","Guardian Name Required");
		frmvalidator.addValidation("gaddress","req","Guardian Address Required");
		frmvalidator.addValidation("relationship","req","Relationship Required");
		frmvalidator.addValidation("gmobile","req","Guardian Mobile No. Required");	
		frmvalidator.addValidation("gmobile","numeric","Enter Only Numeric Values");			
		frmvalidator.addValidation("photo","req","Upload your Photograph"); 		 
		frmvalidator.addValidation("sign","req","Sign Required"); 
		frmvalidator.addValidation("place1","req","Place Required"); 
		frmvalidator.addValidation("date1","req","Date Required"); 	
		frmvalidator.addValidation("6_letters_code","req","Please enter verification code");					
	//]]>
	</script>