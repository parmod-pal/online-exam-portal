<?php		
require "includes/reportmenu.php";
require_once "process/function.php";
$dat=date('d/m/Y');	$pid='';$prname='';
$prgname=selprogramname($pid);
foreach($prgname as $pgname)
{	
	$prname=$pgname['programname'];
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
		<form method="post" action="" name="frmrpt" id="frmrpt" style="float:left;width:700px;">
			<label style="float:left;font-size:14px;padding-top:5px; ">Select Program:</label>			
			<select name="program" class="inpt" id="selprg" style="margin-right:5px;">
				<option value="1">MBA - Online</option>
				<option value="2">MBA - On-campus</option>
				<option value="3">PGDPM</option>
				<option value="6">DPM</option>
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
		
		<form method="post" action="" name="frm" id="admsrch">
			<label style="float:left;">Admission no:</label>			
			<input type="text" class="search" name="adsrch" id="adsrch" placeholder="Search" />
			<a href="#" class="admissrch" id="admiss" onclick="">Search</a>
		</form>
		<form method="post" action="" name="mentorfrm" id="mentsrch">
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
				<option value="6">DPM</option>
				<option value="4">Study Abroad</option>
				<option value="5">Other</option>
			</select>	
		</form>
		</div>
		<div style="float:right;">
			<a href="#" onclick="printSelection(document.getElementById('display'));return false" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#ff0000; font-size:20px; margin-right:30px; text-decoration:none;">Print</a>
			<a href="process/excel.php" id="excel" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#ff0000; font-size:20px; margin-right:30px; text-decoration:none;">Export To Excel</a>
		</div>
	</div>	
	<div style="clear:both;"></div>	
	<div id="display">
		<div id="logo" class="logo" style="float:left;width:160px;margin-top:40px;"><img src="images/logo.jpg" /></div>
		<!--<div style="float:right;margin-right:20px;"><img src="images/unilogo.jpeg" style="float:left;margin-top:30px;" /></div>-->
		<div style="clear:both;"></div>
		<div style="text-align:center;"> <img src="images/lgo1.jpg"  style="margin-left:60px;"/></div>
		<p style="font-weight:bold; text-align:center; margin-top:5px;">PROGRAMWISE LIST OF STUDENTS AS ON <?php echo $dat;?></p>
		<p style="font-weight:bold; text-align:center; margin-top:5px; margin-bottom:10px;">PROGRAM : <?php echo $prname;?></p>
				
		
		<table width="100%" border="1" cellspacing="0" cellpadding="0" >
			<tbody>
				<tr style="font-weight:bold; font-size:15px; text-align:left;">
					<th width="130" height="40"><label>Admission No.</label></th>
					<th width="130"><label>Student Name</label></th>
					<th width="130"><label>Email Id</label></th>
					<th width="130"><label>Community</label></th>
					<th width="130"><label>Date of Admission</label></th>
					<th width="130"><label>Date of Completion</label></th>
				</tr>
				<?php
					$pid='';$doa='';$doc='';
					$studlist=selrpt1($pid);		
					foreach($studlist as $slist)
					{
						$datob=explode("-",$slist['dateofadmission']);
						if(count($datob)>0)
						{
							$yr=$datob[0];							
							$mn=$datob[1];
							$dt=$datob[2];
							$doa=$dt.'-'.$mn.'-'.$yr;
						}
						$dofi=explode("-",$slist['dateofcompletion']);
						if(count($dofi)>0)
						{
							$yr=$dofi[0];							
							$mn=$dofi[1];
							$dt=$dofi[2];
							$doc=$dt.'-'.$mn.'-'.$yr;
						}	
					?>
						<tr>
							<td><?php echo $slist['admissionno'];?></td>
							<td><?php echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></td>
							<td><?php echo $slist['emailid'];?></td>
							<td><?php echo $slist['community'];?></td>
							<td><?php echo $doa;?></td>
							<td><?php echo $doc;?></td>					
						</tr>
					<?php
					}
					?>	
			</tbody>
		</table>
	</div>
</div>