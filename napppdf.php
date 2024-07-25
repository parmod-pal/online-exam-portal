<?php
ob_start();
ini_set('display_errors','off');
if(!isset($_SESSION)){session_start();}
$appid='';$enc='';
if(isset($_SESSION['napp']))
{
	$appid=$_SESSION['napp'];
}
if(isset($_SESSION['enc']))
{
	$enc=$_SESSION['enc'];
}
include 'configold.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Application</title>
<style>
<!--
*
{
	margin:0px;
	padding:0px;
}
.clr
{
	clear:both;
}
.application
{
	width:800px;
	height:auto;
	margin:0 auto;	
	padding:15px;
	margin-bottom:15px;
	font-family:arial;
	margin-top:5px;
}
.logo1
{
	width:100px;
	height:auto;
	float:left;
	margin-top:10px;
}
.app h4
{
	float:right;
}
.addm
{
	width:1085px;
	height:auto;
	float:left;
}
.addm p
{
	font-size:12px;
	letter-spacing:1px;
	color:#000;
	font-weight:bold;
}
.addm input
{
	margin-left:5px;
	margin-right:5px;
}
.app_div2
{
	margin-top:10px;
	width:800px;
	height:auto;
	float:left;
	margin-bottom:10px;
}
.app_div2
{
	font-size:12px;
	letter-spacing:1px;
	line-height:20px;
}
.app_container1 p
{
	font-family:arial;
	font-size:13px;
	letter-spacing:1px;
	line-height:30px;
	font-weight:bold;
	margin-top:5px;
}
.lab_text,.lab_text1
{
	text-indent:190px;
}
.lab_text,.lab_text1
{
	font-family:arial;
	font-size:13px;
	letter-spacing:1px;
	font-weight:bold;
	line-height:30px;
	margin-top:5px;
}
.lab_text1
{
	text-indent:125px;
}
span
{
	font-family:arial;
	font-size:13px;
	letter-spacing:1px;
	font-weight:bold;
	line-height:24px;
	margin-top:5px;
}
.app_container1 h2
{
	font-size:18px;
	color:#80A138;
	letter-spacing:1px;
	font-family:arial;
	line-height:30px;
}
.add_table1
{
	font-family:arial;
	font-size:13px;
	letter-spacing:1px;
	line-height:30px;
	color:#000;
	font-weight:bold;
}
.chk
{
	margin-left:5px;
	margin-right:5px;
}
.headertable
{
	background-color:#999999;
	font-size:13px;
	padding:5px;
}
.submit
{
	background: none repeat scroll 0 0 #999999;
    border: medium none;
    font: bold 13px "Myriad Pro";
    margin: 7px;
    padding: 6px;
    text-align: center;
	}
.box h1,.box2 h1 {
    font: bold 13px Geneva,Arial,Helvetica,sans-serif;
    text-align: center;
	color:#3C7191;
}
.box,.box2
{
	text-align: center;
    width: 180px;
	margin-top:15px;
	float:left;
	margin-right:40px;
}
.box h1,.box2 h1
{
	text-align:center;
	text-decoration:underline;
}
.app_form p
{
	font-size:12px;
	font-family:calibri;
	font-weight:bold;
}
.foundation
{
	float:left;
	width:360px;
	margin-top:15px;
	line-height:30px;
}
.foundation p
{
	font-size:14px;
}
.foundation table tr td
{
	font-size:12px;
	line-height:24px;
	color:#000;
	font-weight:bold;
}
.app_container1 p
{
	font-size:16px;
	text-align:left;
}-->
</style>
</head>
<body>
<div class="application" id="application" style="padding:0px ;">
	<!--<img src="images/rimsr1.png" />-->
	<div class="app" style="padding:15px;">		
		<?php 
		$resu=mysql_query("select * from rim_chronoforms_3 where cf_id='".$appid."'and encrypt='".$enc."'");		
		if($resu>0)
		{		
			while($data=mysql_fetch_array($resu))
			{					
		?>
			<div class="app_div1" id="app_div1">				
				<div class="addm" id="addm">
				<p><div style="width:165px;float:left;"><img src="images/logo1.jpg"/></div><h3 style="font-size:16h:500px; color:#3C7191;">APPLICATION FOR ADMISSION TO</h3></px;float:left;widtp><br/>
				<h4 style="float:right;">Application No.:&nbsp;<?php echo $appid;?></h4>
				<div class="clr"></div>
				<hr width="95%" size="1" color="#333" />
					<!--<span style="color:#80a138; font-size:16px;"><b>INDICATE THE COURSE THAT YOU INTEND TO TAKE : </b></span><br/>
					<div class="foundation">
						<span>SELECTED PROGRAMS</span>
						<table width="800" border="0" class="add_table1">
						<tr>
						<td>
						<?php 
						$resus=mysql_query("select description from coursedes where code='".$data['coursename']."'");		
						if($resus>0)
						{		
							while($datas=mysql_fetch_array($resus))
							{ echo $datas['description'];}}?>
						</td>
						</tr>
						</table>
					</div>-->
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
			<div class="app_div3" id="app_div3">
				<div class="app_container1">
					<div class="clr"></div>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<p>PLEASE PROVIDE THE FOLLOWING DETAILS : </p>
					<h2>PERSONAL INFORMATION</h2>
					<table width="800" border="0" class="add_table1">
					<tr>
						<td>NAME (SUR NAME FOLLWED BY GIVEN NAME)</td>
						<td>:</td>
						<td><?php echo $data['name'];?></td>
					</tr>
					 <!--<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" name="emailid" value="" size="28" /></td>
					</tr>-->
					<tr>
						<td>POSTAL ADDRESS (INCLUDING THE PIN CODE)</td>
						<td>:</td>
						<td><?php echo $data['houseaddress'];?></td>
					</tr>
					<tr>
						<td>PERMANENT ADDRESS (INCLUDING THE PIN CODE)</td>
						<td>:</td>
						<td><?php echo $data['peraddress'];?></td>
					</tr>
					<tr>
						<td>DATE OF BIRTH</td>
						<td>:</td>
						<td><?php echo $data['dob'];?></td>
					</tr>
					<tr>
						<td>GENDER</td>
						<td>:</td>
						<td>
							<?php echo $data['gender'];?>
						</td>
					</tr>
					<tr>
						<td>NATIONALITY</td>
						<td>:</td>
						<td><?php echo $data['nationality'];?></td>
					</tr>
					<tr>
						<td>RELIGION</td>
						<td>:</td>
						<td><?php echo $data['religion'];?><br/></td>
					</tr>
					<tr>
						<td>TELEPHONE NO WITH AREA CODE</td>
						<td>:</td>
						<td><?php echo $data['MobilePhone'];?></td>
					</tr>
					<tr>
						<td>CELL PHONE NO</td>
						<td>:</td>
						<td><?php echo $data['BusinessPhone'];?></td>
					</tr>
					<tr>
						<td>PAN CARD No</td>
						<td>:</td>
						<td><?php echo $data['pan_no'];?></td>
					</tr>
					<tr>
						<td>Adhar No</td>
						<td>:</td>
						<td><?php echo $data['AdharNo'];?></td>
					</tr>
					<tr>
						<td>DRIVING LICENSE NO </td>
						<td>:</td>
						<td><?php echo $data['licenseno'];?></td>
					</tr>
					<tr>
						<td>Voter's ID No</td>
						<td>:</td>
						<td><?php echo $data['Voter_id'];?></td>
					</tr>
					</table>			
					<div class="clr"></div>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<h2>ADDITIONAL INFORMATION</h2>
					<table class="add_table1" width="800" border="0">
					<tr>
						<td>NAME OF THE PARENT/GUARDIAN:</td>
						<td>:</td>
						<td><?php echo $data['gname'];?></td>
					</tr>
					<tr>
						<td>POSTAL ADDRESS OF THE PARENT/GUARDIAN</td>
						<td>:</td>
						<td><?php echo $data['gaddress'];?></td>
					</tr>
					<tr>
						<td>IN CASE OF GUARDIAN PLEASE INDICATE THE RELATIONSHIP TO THE APPLICANT</td>
						<td>:</td>
						<td><?php echo $data['relationship'];?></td>
					</tr>
					<tr>
						<td>PHONE NUMBER OF THE PARENT/GUARDIAN</td>
						<td>:</td>
						<td><?php echo $data['gphone'];?></td>
					</tr>
					<tr>
						<td>CELL NUMBER OF THE PARENT/GUARDIAN</td>
						<td>:</td>
						<td><?php echo $data['gmobile'];?></td>
					</tr>
					<tr>
						<td>IF PARENT/GUARDIAN IS EMPLOYED, PROVIDE DETAILS OF HIS/HER EMPLOYMENT</td>
						<td>:</td>
						<td><?php echo $data['gemployment'];?></td>
					</tr>
					<tr>
						<td style="vertical-align:top;">PLEASE INDICATE WHETHER YOU BELONG TO SPECIAL CATEGORY</td>
						<td style="vertical-align:top;">:</td>
						<td>
							<?php echo $data['caste'];?>
						</td>
					</tr>

					</table>
					
					
					<!--new changes--->
					<div class="clr"></div>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<h2>ADDITIONAL INFORMATION</h2>
					<table class="add_table1" width="800" border="0">
				    <tr>
						<td>Amount:</td>
						<td>:</td>
						<td><?php echo $data['amount'];?></td>
					</tr>
					<tr>
						<td>Transaction I'd</td>
						<td>:</td>
					<td><?php echo $data['txnId'];?></td>
					</tr>
					<tr>
						<td>Date</td>
						<td>:</td>
						<td><?php echo $data['date1'];?></td>
					</tr>
					<tr>
						<td>Bank</td>
						<td>:</td>
						<td><?php echo $data['bank'];?></td>
					</tr>
					<tr>
						<td>Branch</td>
						<td>:</td>
						<td><?php echo $data['branch'];?></td>
					</tr>

					</table>
					
					<!--end--->
					
					
					
					<div class="clr"></div>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<h2>EDUCATIONAL BACKGROUND : </h2>
					<table class="add_table1" width="800" border="0" >
					<table width="800" style="text-align:center;">
					<tr class="headertable">
						<th>Name of the college and location<br/>(from the most recent)</th> 
						<th>Period <br/> (From - To)</th>
						<th>Course</th>
						<th>Major subjects studied</th> 
						<th>Class secured</th>
						<th>Percentage</th>
					</tr>
					<tr>
						<td><?php echo $data['Institution1'];?></td>
						<td><?php echo $data['period1'];?></td>
						<td><?php echo $data['course1'];?></td>
						<td><?php echo $data['major1'];?></td>
						<td><?php echo $data['class1'];?></td>
						<td><?php echo $data['percent1'];?></td>
					</tr>
					<?php
						if($data['Institution2'] !='')
						{
						?>
							<tr>
								<td><?php echo $data['Institution2'];?></td>
								<td><?php echo $data['period2'];?></td>
								<td><?php echo $data['course2'];?></td>
								<td><?php echo $data['major2'];?></td>
								<td><?php echo $data['class2'];?></td>
								<td><?php echo $data['percent2'];?></td>
							</tr>
						<?php
						}
						if($data['Institution3'] !='')
						{
						?>
							<tr>
								<td><?php echo $data['Institution3'];?></td>
								<td><?php echo $data['period3'];?></td>
								<td><?php echo $data['course3'];?></td>
								<td><?php echo $data['major3'];?></td>
								<td><?php echo $data['class3'];?></td>
								<td><?php echo $data['percent3'];?></td>
							</tr>
						<?php
						}
						if($data['Institution4'] !='')
						{
						?>
							<tr>
								<td><?php echo $data['Institution4'];?></td>
								<td><?php echo $data['period4'];?></td>
								<td><?php echo $data['course4'];?></td>
								<td><?php echo $data['major4'];?></td>
								<td><?php echo $data['class4'];?></td>
								<td><?php echo $data['percent4'];?></td>
							</tr>
						<?php
						}
					?>
					</table>
					</table>
					<div class="clr"></div><br/>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<h2>WORK EXPERIENCE:(Most Recent First) </h2>
					<table class="add_table1" width="800" border="0" >					
					<tr class="headertable">
						<th>Job Title</th> 
						<th>Company</th>
						<th>From</th>
						<th>To</th> 
					</tr>
					<tr>
						<td><?php echo $data['jobtitle1'];?></td>
						<td><?php echo $data['company1'];?></td>
						<td><?php echo $data['frm1'];?></td>
						<td><?php echo $data['to1'];?></td>
					</tr>					
					<?php
						if($data['jobtitle2'] !='')
						{
						?>
							<tr>
								<td><?php echo $data['jobtitle2'];?></td>
								<td><?php echo $data['company2'];?></td>
								<td><?php echo $data['frm2'];?></td>
								<td><?php echo $data['to2'];?></td>
							</tr>	
						<?php
						}
						if($data['jobtitle3'] !='')
						{
						?>
							<tr>
								<td><?php echo $data['jobtitle3'];?></td>
								<td><?php echo $data['company3'];?></td>
								<td><?php echo $data['frm3'];?></td>
								<td><?php echo $data['to3'];?></td>
							</tr>
						<?php
						}
						if($data['jobtitle4'] !='')
						{
						?>
							<tr>
								<td><?php echo $data['jobtitle4'];?></td>
								<td><?php echo $data['company4'];?></td>
								<td><?php echo $data['frm4'];?></td>
								<td><?php echo $data['to4'];?></td>
							</tr>
						<?php
						}
					?>
					</table>					
					<br/>
					<table class="add_table1" width="800" border="0" style="margin-top:15px;">
					<tr>
						<td style="vertical-align:top;">AWARDS, MERIT CERTIFICATES, ACHIEVEMENT CERTIFICATES, IF ANY</td>
						<td style="vertical-align:top;">:</td>
						<td><?php echo $data['awards'];?></td>
					</tr>
					<tr>
						<td style="vertical-align:top;">HOW DID YOU COME TO KNOW ABOUT RIMSR, AND THE COURSES OFFERED?</td>
						<td style="vertical-align:top;">:</td>
						<td><?php echo $data['howtoknow'];?></td>
					</tr>

					</table>
					<div class="clr"></div>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<h2>PLEASE PROVIDE THE FOLLOWING DETAILS (FOR FOREIGN NATIONAL ONLY)</h2>							
					<table width="800" border="0" class="add_table1">
					<tr>
						<td>Pass-Port No</td>
						<td>:</td>
						<td><?php echo $data['passportno'];?></td>
					</tr>
					<tr>
						<td>Place of Issue</td>
						<td>:</td>
						<td><?php echo $data['placeofissue'];?></td>
					</tr>
					<tr>
						<td>Date of Issue</td>
						<td>:</td>
						<td><?php echo $data['dateofissue'];?></td>
					</tr>
					<tr>
						<td>Date of Expiry:</td>
						<td>:</td>
						<td><?php echo $data['dateofexpiry'];?></td>
					</tr>
					</table><br/>
					<h2>PLEASE PROVIDE THE VISA PARTICULARS:</h2>							
					<table width="570" border="0" class="add_table1">
					<tr>
						<td>Date of Issue of Indian Visa:</td>
						<td>:</td>
						<td><?php echo $data['visaissuedate'];?></td>
					</tr>
					<tr>
						<td>Date of Expiry</td>
						<td>:</td>
						<td><?php echo $data['visaexpiry'];?></td>
					</tr>
					<tr>
						<td>Type of Visa</td>
						<td>:</td>
						<td><?php echo $data['visatype'];?></td>
					</tr>
					<tr>
						<td>Visa Number</td>
						<td>:</td>
						<td><?php echo $data['visano'];?></td>
					</tr>
					<tr>
						<td>Place of Issue</td>
						<td>:</td>
						<td><?php echo $data['visaissueplace'];?></td>
					</tr>
					</table>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<div class="address_container">		
					<h3>DECLARATION</h3>						
					<span style="color:brown; font-size:12px;  line-height:20px; text-align:left;">I do hereby declare that I will abide by the rules, regulations and orders framed or passed by RIMSR from time to time.<br/> The information given by me in the application is true to the best of my knowledge and belief. I understand <br/>that I will be held responsible if any incorrect or wrong information is given here, and in which case my admission is<br/> liable to be cancelled automatically. In such a case the decision of the Director, RIMSR is final and binding.</span>
					</div>
					<div class="clr"></div>
					<hr width="800" size="2" color="#cc6600" style="margin-bottom:15px; margin-top:15px;" />
					<span>Signature of Applicant:<?php echo $data['sign'];?></span><br/>
					<span>Place:<?php echo $data['place'];?></span><br/>
					<span>Date:<?php echo $data['date'];?></span><br/>
					<div class="clr"></div>
				</div>
			</div>
		<?php
			}
		}
		?>		
	</div>	
</div>
</body>
</html>