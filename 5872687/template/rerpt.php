<?php
require "includes/reportmenu.php";
require_once "process/function.php";
$dat=date('d-m-Y');	$pid='';$pvno='';$prname='';
$prgname=selprogramname($pid);
foreach($prgname as $pgname)
{	
	$prname=$pgname['programname'];
}	
$ano='';$prgname='';
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
$link=open_database_connection();
$sql = "select max(id) as id from provisional";	
$result=mysql_query($sql,$link);
if($result>0)
{
	if(mysql_num_rows($result)>0)
	{
		while($data=mysql_fetch_array($result))
		{
			$pvno=$data['id'];
		}
	}
}
close_database_connection($link);
$dat=date('d-m-Y');	
$pvno++;
$len=strlen($pvno);
if($len<4)
{
	$pvno='00'.$pvno;
}
else if($len ==4)
{
	$pvno='0'.$pvno;
}
else
{
	$pvno=$pvno;
}
?>
<style>
td,tr
{
height:22px;color:#000;
}
th{color:#0163BC;}
</style>
<div id="wrap2" class="wrap2" style="height:600px;overflow-y:scroll;overflow-x:hidden;">	
	<div id="admin"  style="margin-left:20px;margin-top:20px;font-size:12px;font-weight:bold;">	
		<div style="float:left;">
		<form method="post" action="" name="frmrpt" id="frmrpt" style="display:none;float:left;width:700px;">
			<label style="float:left;font-size:14px;padding-top:5px; ">Select Program:</label>			
			<select name="program" class="inpt" id="selprg" style="margin-right:5px;">
				<option value="1">MBA - Online</option>
				<option value="2">MBA - On-campus</option>
				<option value="3">PGDPM</option>
				<option value="4">Study Abroad</option>
				<option value="5">Other</option>
			</select>	
			
			<div id="fadmsrch" style="margin-top:5px;">
				<label style="float:left;">Admission no:</label>			
				<input type="text" class="search" name="fadsrch" id="fadsrch" placeholder="Search" />
				<a href="#" class="admissrch" id="fadmiss" onclick="">Search</a>				
			</div><div style="clear:both;"></div>
			<div id="dtfrm" style="margin-top:5px;">
				<label style="float:left;">From :</label>			
				<input type="text" class="search" name="frmdt" id="frmdt" placeholder="DD-MM-YYYY" style="float:left;"/>
				<label style="float:left;">To :</label>			
				<input type="text" class="search" name="todt" id="todt" placeholder="DD-MM-YYYY" />
				<a href="#" class="admissrch" id="dtsrch" onclick="">Search</a>	
				<input type="hidden" class="search" name="fil" id="fil" value="studlist" />				
			</div>
		</form>		
		<form method="post" action="" name="frm" id="admsrch" style="display:none;">
			<label style="float:left;">Admission no:</label>			
			<input type="text" class="search" name="adsrch" id="adsrch" placeholder="Search" />
			<a href="#" class="admissrch" id="admiss" onclick="">Search</a>
		</form>
		<form method="post" action="" name="mentorfrm" id="mentsrch" style="display:none;">
			<div style="width:auto;margin-right:10px;float:left;">
			<label style="float:left;font-size:14px;padding-top:5px; ">Mentor:</label>
			<select name="mentor" class="inpt" id="mentor" >
				<option value="">Select Mentor</option>
				<?php	
				$mentor=selmentor();
				foreach($mentor as $ment)
				{
					echo '<option value="'.$ment['mentorassigned'].'">'.$ment['mentorassigned'].'</option>';
				}							
				?>
			</select>
			</div>
			<label style="float:left;font-size:14px;padding-top:5px; ">Program:</label>			
			<select name="program" class="inpt" id="mselprg">
				<option value="">Select Program</option>
				<option value="1">MBA - Online</option>
				<option value="2">MBA - On-campus</option>
				<option value="3">PGDPM</option>
				<option value="4">Study Abroad</option>
				<option value="5">Other</option>
			</select>	
		</form>
		<form method="post" action="" name="frmprint" id="frmprint" style="display:none;">
			<label style="float:left;font-size:14px;padding-top:5px; ">Select Option:</label>			
			<select name="prntopt" class="inpt" id="selprint">
				<option value="1">ID Card</option>
				<option value="2">Receipt</option>
				<option value="3">Marks Card</option>
				<option value="4">Provisional Certificate</option>				
				<option value="5">Certificate of Subjects Studied</option>
				<option value="6">Welcome Letter</option>
			</select>				
			<label style="float:left;font-size:14px;padding-top:5px; ">Admission No.:</label>			
			<input type="text" class="search" name="padsrch" id="padsrch" placeholder="Search" />
			<a href="#" class="admissrch" id="padmiss" onclick="">Search</a>
		</form>
		<form method="post" action="" name="reprint" id="reprint" >
			<label style="float:left;font-size:14px;padding-top:5px; ">Select Option:</label>			
			<select name="reprntopt" class="inpt" id="selreprint" onchange="chkreprint(this.value);">				
				<option value="2">Receipt</option>				
				<option value="4" selected>Provisional Certificate</option>	
			</select>	
			<div id="rprv" style="float:left;">
				<label style="float:left;font-size:14px;padding-top:5px; ">Admission No.:</label>			
				<input type="text" class="search" name="rpadsrch" id="rpadsrch" placeholder="Search" />
				<a href="#" class="admissrch" id="rpadmiss" onclick="">Search</a>
			</div>
			<div id="recip" style="float:left;display:none;">
				<label style="float:left;font-size:14px;padding-top:5px; ">Enter Receipt No.:</label>			
				<input type="text" class="search" name="rpreceipt" id="rpreceipt" placeholder="Search" />
				<a href="#" class="admissrch" id="repadmiss" onclick="">Search</a>
			</div>
		</form>
		</div>
		<div style="float:right;">
			<a href="#" onclick="printSelection1(document.getElementById('display'));return false" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#ff0000; font-size:20px; margin-right:30px; text-decoration:none;">Print</a>
			<a href="process/excel.php" id="excel" style="display:none;font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#ff0000; font-size:20px; margin-right:30px; text-decoration:none;">Export To Excel</a>
		</div>
	</div>	
	<div style="clear:both;"></div>	
	<div id="display" class="display">		
	<!--<div class="logo1" style="padding:20px;width:60px;height:auto;float:left;font-family:Cambria;">
		<img src="images/logo1.jpg"  style=" margin-top:10px;" />
	</div>
	<div class="head1" style="float:left;width:625px;height:auto;text-align:center;margin-top:40px;">
		<span style="color:#c00000; text-align:center;  font-weight:bold; font-size:37px;font-family:Cambria;text-shadow:1px 1px #000000;">BRENAU UNIVERSITY,GEORGIA, USA</span>
	</div>-->
	<div class="logo12" style="float:left;">
		<img src="images/logo.jpg" width="100" height="40" style="float:right; margin-top:55px; margin-right:20px;" />
	</div>	
	<div style="color:#0000FF;width:735px;text-align:center;font-weight:bold; font-size:29px;font-family:Cambria;line-height:40px;">RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES &amp; RESEARCH,BANGALORE,INDIA</div>

<div style="clear:both;"></div>
<div style="float:right;"> <p style="font-family:Calibri; font-size:20px; font-weight:bold;color:#000;padding-right:10px;">No.<?php echo $pvno;?></p></div>
<div style="margin-top:20px;">
<h3 style="font-family:Calibri; font-size:24px; font-weight:bold; text-align:center;">PROVISIONAL CERTIFICATE </h3>
<?php
	$doe='';$result='';
	$studlist=createmarksheet($ano);		
	foreach($studlist as $slist)
	{	
		$datob=explode("-",$slist['posteddate']);
		if(count($datob)>0)
		{
			$yr=$datob[0];							
			$mn=$datob[1];
			$dt=$datob[2];
			$doe=$dt.'-'.$mn.'-'.$yr;
		}	
		if($slist['totalmark'] >=80)
		{
			$result="<font color='#1626f3' size='2'> DISTINCTION</font>";
		}
		else if($slist['totalmark'] >=60 && $slist['totalmark'] < 80)
		{
			$result="<font color='#009130' size='2'>PASS</font>";
		}			
	?>
		<div class="provisional" style="color: #0000FF !important; font-family: Cambria; font-size: 16px; font-style: italic; height: auto;letter-spacing: 1px;line-height: 27px;margin-left: 35px;margin-top: 30px;font-weight:bold;">This is to certify that <?php if($slist['gender']=="Male"){echo 'Mr.';}else{echo 'Ms.';}?> <font style="text-decoration:underline;color:#000;"><?php echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></font> has successfully completed the Post-Graduate Diploma in Project Management by passing the prescribed examination held by Brenau University at RIMSR on <font style="text-decoration:underline;color:#000;"><?php echo $doe;?></font> with <font style="text-decoration:underline;color:#000;"><?php echo $result;?></font> class. <?php if($slist['gender']=="Male"){echo 'He';}else{echo 'She';}?> is eligible for 100 PDUs, and to take the PMI Examinations (subject to eligibility) upon the issuance of due Certification thereof by Brenau University, #500, Washington Street, SE, Gainesville, Georgia 30501,  USA.<br/><br/>The Certificate of Completion of PGDPM will be issued to <?php if($slist['gender']=="Male"){echo 'him';}else{echo 'her';}?> by Brenau University in due course.<br/><br/>
		
		Issued Under the Official Seal of RIMSR, on <font style="text-decoration:underline;color:#000;"><?php echo $dat;?></font> at Bangalore.
		</div>
		<div style="float:left; margin-top:60px; margin-left:30px; ">
		<p><img alt="barcode" src="../process/barcode.php?text=<?php echo $slist['admissionno'];?>" /></p></div>
		<div style="float:right; margin-top:60px; ">
		<p style="font-family:Cambria; font-size:20px; font-weight:bold;font-style:italic;letter-spacing:1px;color:#000;">DIRECTOR<br/>RIMSR</p>
		</div>
		<?php
		}
	?>
	</div>
</div>