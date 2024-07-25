<?php
	include "function.php";
	$ano='';$prgname='';
	if(isset($_REQUEST['ano']))
	{
		$ano=$_REQUEST['ano'];
	}	
	
$dat=date('d/m/Y');	
?>
<style>
td,tr
{
height:30px;
text-align:left;
font-size:12px;
font-weight:normal;
}
</style>
<div id="logo" class="logo" style="float:left;width:160px;margin-top:40px;"><img src="images/logo.jpg" /></div>
<!--<div style="float:right;margin-right:20px;"><img src="images/unilogo.jpeg" style="float:left;margin-top:30px;" /></div>-->
<div style="clear:both;"></div>
<div style="text-align:center;"> <img src="images/lgo1.jpg"  style="margin-left:60px;"/></div>
<p style="font-weight:bold; text-align:center; margin-top:5px;">STUDENT'S INDIVIDUAL REPORT</p>
<table width="850">
	<tbody>	
		<?php
			$dob='';$validity='';$doi='';$result='';$bal='';
			$studlist=selrpt8($ano);		
			foreach($studlist as $slist)
			{	
				$prgname=selprogramname($slist['admittedfor']);
				foreach($prgname as $pgname)
				{	
					$prname=$pgname['programname'];
				}
				if($slist['totalmark']>=80)
				{
					$result= "<font color='#1626f3' size='2' style='font-weight:bold;'>PASSED WITH DISTINCTION</font>";					
				}
				else if($slist['totalmark']>=60 && $slist['totalmark'] < 80 )
				{
					$result="<font color='#009130' size='2' style='font-weight:bold;'>PASSED</font> ";					
				}
				else
				{
					$result="<font color='#F70938' size='2' style='font-weight:bold;'>FAIL</font>";					
				}
				$datob=explode("-",$slist['dob']);
				if(count($datob)>0)
				{
					$yr=$datob[0];							
					$mn=$datob[1];
					$dt=$datob[2];
					$dob=$dt.'-'.$mn.'-'.$yr;
				}
				$dofi=explode("-",$slist['dateofissue']);
				if(count($dofi)>0)
				{
					$yr=$dofi[0];							
					$mn=$dofi[1];
					$dt=$dofi[2];
					$doi=$dt.'-'.$mn.'-'.$yr;
				}	
				$valupto=explode("-",$slist['validupto']);
				if(count($valupto)>0)
				{
					$yr=$valupto[0];							
					$mn=$valupto[1];
					$dt=$valupto[2];
					$validity=$dt.'-'.$mn.'-'.$yr;
				}
				$bal=$slist['payable']-$slist['paid'];				
			?>	
		<tr>
			<td width="125" ><label style="font-weight:bold;">Student Id :</label></td>
			<td width="167" style="font-weight:bold;"><?php echo $slist['admissionno'];?></td>
			<td width="125" ><label style="font-weight:bold;">Admitted For :</label></td>
			<td width="167" style="font-weight:bold;"><?php echo $prname;?></td>			
		</tr>
		<tr>
			<td width="170" ><label style="font-weight:bold;">Date of Admission :</label></td>
			<td width="167" style="font-weight:bold;"><?php echo $slist['dateofadmission'];?></td>			
		</tr>
		<tr>
			<td width="170" ><label style="font-weight:bold;">Date of Completion :</label></td>
			<td width="167" style="font-weight:bold;"><?php echo $slist['dateofcompletion'];?></td>
			<?php
				if($slist['image']!='')
				{
					$path='../upload/studimage/'.$slist['image'];					
					if(file_exists($path))
					{
					?>
						<td width="125" >&nbsp;</td>
						<td width="167">&nbsp;</td>	
						<td width="100">&nbsp;</td>
						<td style="vertical-align:bottom;"><img src="<?php echo 'upload/studimage/'.$slist['image'];?>" style="height:100px;width:100px;margin-top: -70px;"/></td>
					<?php						
					}
				}
				?>
		</tr>
		<tr>
			<td colspan="4"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">Personal Information</label></td>		
		</tr>
		<tr>
			<td ><label>First Name :</label></td>
			<td><?php echo $slist['firstname'];?></td>
			<td width="112" ><label>Middle Name :</label></td>
			<td width="160"><?php echo $slist['middlename'];?></td>
			<td width="114" ><label>Last Name :</label></td>
			<td width="144"><?php echo $slist['lastname'];?></td>
		</tr>
		<tr>
			<td ><label>Gender :</label></td>
			<td><?php echo $slist['gender'];?></td>
		</tr>
		<tr>
			<td ><label>Phone no :</label></td>
			<td><?php echo $slist['phone'];?></td>
			<td ><label>Cell Number :</label></td>
			<td><?php echo $slist['mobile'];?></td>
			<td ><label>Email id :</label></td>
			<td><?php echo $slist['emailid'];?></td>
		</tr>
		<tr>
			<td ><label>Date of Birth :</label></td>
			<td><?php echo $dob;?></td>
			<td ><label>Nationality :</label></td>
			<td><?php echo $slist['nationality'];?></td>
			<td ><label>Community :</label></td>
			<td><?php echo $slist['community'];?></td>
		</tr>
		<tr>
			<td ><label>Marital Status :</label>
			<td><?php echo $slist['maritialstatus'];?></td>						
		</tr>
		<tr>
			<td colspan="4"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">Additional Details</label></td>		
		</tr>
		<tr>
			<td ><label>Pancard no :</label></td>
			<td><?php echo $slist['panno'];?></td>
			<td ><label>Aadharcard:</label></td>
			<td><?php echo $slist['aadharno'];?></td>
			
		</tr>
		<tr>
			<td ><label>Passport no:</label>
			<td><?php echo $slist['passportno'];?></td>
			<td ><label>Place of issue :</label>
			<td><?php echo $slist['placeofissue'];?></td>
			<td ><label>Date of issue:</label>
			<td><?php echo $doi;?></td>
		</tr>
		<tr>
			<td ><label>Valid upto :</label>
			<td><?php echo $validity;?></td>
		</tr>					
		<tr>
			<td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">Present Address Details</label></td>
			<td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">Permanent Address Details</label><br/></td>						
		</tr>
		<tr>
			<td ><label>Address :</label></td>
			<td colspan="2"><?php echo $slist['postaladdress'];?></td>
			<td ><label>Address :</label></td>
			<td colspan="2"><?php echo $slist['peraddress'];?></td>
		</tr>					
		<tr>
			<td ><label>City :</label></td>
			<td colspan="2"><?php echo $slist['postalcity'];?></td>
			<td ><label>City :</label></td>
			<td colspan="2"><?php echo $slist['percity'];?></td>
		</tr>
		<tr>
			<td ><label>State :</label></td>
			<td colspan="2"><?php echo $slist['postalstate'];?></td>
			<td ><label>State :</label></td>
			<td colspan="2"><?php echo $slist['perstate'];?></td>
		</tr>
		<tr>
			<td ><label>Pincode :</label></td>
			<td colspan="2"><?php echo $slist['postalpin'];?></td>
			<td ><label>Pincode :</label></td>
			<td colspan="2"><?php echo $slist['perpin'];?></td>
		</tr>
		<tr>
			<td colspan="4"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">Father/Guardian Details</label></td>		
		</tr>
		<tr>
			<td ><label>Name :</label></td>
			<td ><?php echo $slist['gaurdianname'];?></td>
			<td  ><label>Phone no :</label></td>
			<td><?php echo $slist['gaurdianphone'];?></td>
			<td  ><label>Email id :</label></td>
			<td><?php echo $slist['gaurdianemail'];?></td>
		</tr>
		<tr>
			<td ><label>Address :</label></td>
			<td><?php echo $slist['gaurdianaddress'];?></td>						
		</tr>					
		<tr>
			<td ><label>City : </label></td>
			<td><?php echo $slist['fcity'];?></td>						
			<td ><label>State  : </label></td>
			<td><?php echo $slist['fstate'];?></td>						
			<td ><label>Pincode : </label></td>
			<td><?php echo $slist['fpin'];?></td>
		</tr>
		<tr>
	   <td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">Fees Details </label></td>
	   <td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">Marks Details </label></td></tr>
	   <tr>
	   <td>Fees Payable</td>
	   <td>
	   <?php 
		if($slist['admittedfor'] !=2 && $slist['admittedfor'] != 4)
		{
		?>
			<img src="images/rs.png" width="10" height="10" style="float:left;margin-top:3px;"/>
		<?php
		}
		else
		{
			?><img src="images/dollar.png" width="10" height="10" border="0" style="float:left;margin-top:5px;"/><?php
		}
		?>
	   <?php echo $slist['payable'];?></td>
	   <td></td>
	   <td>Assignment Marks : </td>
	   <td><?php echo $slist['assignment'];?></td>
	   </tr>
	   <tr>
	   <td>Fees Paid :</td>
	   <td>
	   <?php 
		if($slist['admittedfor'] !=2 && $slist['admittedfor'] != 4)
		{
		?>
			<img src="images/rs.png" width="10" height="10" style="float:left;margin-top:3px;"/>
		<?php
		}
		else
		{
			?><img src="images/dollar.png" width="10" height="10" border="0" style="float:left;margin-top:5px;"/><?php
		}
		?>
	   <?php echo $slist['paid'];?></td>
	   <td></td>
	   <td>Case Studies Marks : </td>
	   <td><?php echo $slist['casestudies'];?></td>
	   </tr>
		<tr>
	   <td>Balance  :</td>
	   <td>
	   <?php 
		if($slist['admittedfor'] !=2 && $slist['admittedfor'] != 4)
		{
		?>
			<img src="images/rs.png" width="10" height="10" style="float:left;margin-top:3px;"/>
		<?php
		}
		else
		{
			?><img src="images/dollar.png" width="10" height="10" border="0" style="float:left;margin-top:5px;"/><?php
		}
		?>
	   <?php echo $bal;?></td>
	   <td></td>
	   <td>Test Marks : </td>
	   <td><?php echo $slist['testmark'];?></td>
	  </tr>
	   <tr>
	   <td></td>
	   <td></td>
	   <td></td>
	   <td>Exam : </td>
	   <td><?php echo $slist['exam'];?></td>
	   <td>Result :<?php echo $result;?></td>	   	  
	   </tr>
	   <tr>
	   <td></td>
	   <td></td>
	   <td></td>
	   <td>Grand Total : </td>
	   <td><?php echo $slist['assignment']+$slist['casestudies']+$slist['testmark']+$slist['exam'];?></td>
	    <td>Mentor :<?php echo $slist['mentorassigned'];?></td>	   
	   </tr>
	   <tr><td colspan="4"><label style="font-size:14px;color:#000;text-decoration:underline; font-weight:bold;">List of Documents Submitted :</label></td></tr>
	   <?php	  
	   if($slist['sslccertificate']!='')
	   {
	   ?>
			<tr><td width="160"><a href="upload/sslc/<?php echo $slist['sslccertificate'];?>" target="_blank" style="font-weight:bold;text-decoration:none;">SSLC Certificate</a></td></tr>
		<?php
	   }
	   if($slist['degreecertificate']!='')
	   {
		?>
			<tr><td width="160"><a href="upload/degree/<?php echo $slist['degreecertificate'];?>" target="_blank" style="font-weight:bold;text-decoration:none;">Degree Certificate</a></td></tr>
		<?php
			
	   }
	   if($slist['addrproof']!='')
	   {
			?>
			<tr><td width="250"><a href="upload/address/<?php echo $slist['addrproof'];?>" target="_blank" style="font-weight:bold;text-decoration:none;">Address Proof Certificate</a></td></tr>
		<?php
			
	   }
	   if($slist['communitycertificate']!='')
	   {
		?>
			<tr><td width="180"><a href="upload/community/<?php echo $slist['communitycertificate'];?>" target="_blank" style="font-weight:bold;text-decoration:none;">Community Certificate</a></td></tr>
		<?php
			
	   }
	  
	   }
	   ?>
	</tbody>
</table>