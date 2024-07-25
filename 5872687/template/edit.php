<?php	
	if (!isset($_SESSION)) session_start();
	$id='';$pid='';$admissionno='';$cid='';
	include "includes/lseditmenu.php";
	if(isset($_SESSION['id']))
	{
		$id=$_SESSION['id'];
	}
	if(isset($_SESSION['pid']))
	{
		$pid=$_SESSION['pid'];
	}	
	if(isset($_SESSION['admissionno']))
	{
		$admissionno=$_SESSION['admissionno'];
	}
	if($admissionno !='')
	{	
		$stdgen=selstudbyadm($admissionno);		
		foreach($stdgen as $studgen)
		{
			$id=$studgen['id'];
			$pid=$studgen['admittedfor'];
		}
	}	
?>
<div id="wrap2" class="wrap2">
	<form name="studentinfo" action="process/update.php" id="frm" method="post" enctype="multipart/form-data">
		<input type="hidden" value="0" id="chkval" name="chkval"/>
		<input type="hidden" value="0" id="chkval1" name="chkval1"/>
		<input type="hidden" value="0" id="chkval2" name="chkval2"/>
		<input type="hidden" value="0" id="chkval3" name="chkval3"/>
		<input type="hidden" value="0" id="chkval4" name="chkval4"/>
		<input type="hidden" value="" id="delexp" name="delexp"/>		
		<input type="hidden" value="<?php echo $id;?>" id="studid" name="studid"/>
		<input type="hidden" value="<?php echo $pid;?>" id="prid" name="prid"/>	
		<input type="hidden" value="<?php echo $crid;?>" id="crid" name="crid"/>	
		<div id="perinfo">
			<h2><label>Edit Personal Information</label></h2><br/>
			<table width="850">
				<tbody>
					<tr>
						<td colspan="2"><div id="error" style="color:#F70938;text-align:center;"></div></td>
					</tr>
					<?php
					$phn1='';$phn2='';$dob='';$validity='';$doi='';
					$stdgen=selstudinfo($id);		
					foreach($stdgen as $studgen)
					{
						$phn=explode("-",$studgen['phone']);
						if(count($phn)>0)
						{
							$phn1=$phn[0];
							if(count($phn)>1)
							{
								$phn2=$phn[1];
							}
						}
						$datob=explode("-",$studgen['dob']);
						if(count($datob)>0)
						{
							$yr=$datob[0];							
							$mn=$datob[1];
							$dt=$datob[2];
							$dob=$dt.'-'.$mn.'-'.$yr;
						}
						if($studgen['dateofissue'] !='' && $studgen['dateofissue'] != '--')
						{
							$dofi=explode("-",$studgen['dateofissue']);
							if(count($dofi)>0)
							{
								$yr=$dofi[0];							
								$mn=$dofi[1];
								$dt=$dofi[2];
								$doi=$dt.'-'.$mn.'-'.$yr;
							}	
						}
						if($studgen['validupto'] !='' && $studgen['validupto'] != '--')
						{
							$valupto=explode("-",$studgen['validupto']);
							if(count($valupto)>0)
							{
								$yr=$valupto[0];							
								$mn=$valupto[1];
								$dt=$valupto[2];
								$validity=$dt.'-'.$mn.'-'.$yr;
							}	
						}
					?>
						<tr>
							<td width="125" ><label>Admission No :</label></td>
							<td width="167"><input type="text" class="fldval" name="admin" id="admin" value="<?php echo $studgen['admissionno'];?>" readonly /></td>
						</tr>
						<tr>
							<td ><label>First Name :</label></td>
							<td><input type="text" class="fldval" name="fname" id="fname" value="<?php echo $studgen['firstname'];?>" onkeypress="toupper('fname');" onblur="toupper('fname');" /></td>
							<td width="112" ><label>Middle Name :</label></td>
							<td width="160"><input type="text" class="" name="mname" id="mname" value="<?php echo $studgen['middlename'];?>" onkeypress="toupper('mname');" onblur="toupper('mname');" /></td>
							<td width="114" ><label>Last Name :</label></td>
							<td width="144"><input type="text" class="fldval" name="lname" id="lname" value="<?php echo $studgen['lastname'];?>" onkeypress="toupper('lname');" onblur="toupper('lname');" /></td>
						</tr>
						<tr>
							<td ><label>Gender :</label></td>
							<td>
							<?php
								$gen=array('Male','Female');
								foreach($gen as $gender)
								{
									if($gender==$studgen['gender'])
									{
										echo '<input type="radio" class="gender" name="gender" value="'.$gender.'" checked/><label>'.$gender.'</label>';
									}
									else
									{
										echo '<input type="radio" class="gender" name="gender" value="'.$gender.'"/><label>'.$gender.'</label>';
									}
								}
							?>
							</td>						
						</tr>
						<tr>
							<td ><label>Phone No :</label></td>
							<td><input type="text" class="phone" name="phone1" id="phone1" value="<?php echo $phn1;?>" style="width:50px;margin-right:5px;"placeholder="code"/><input type="text" class="phone" name="phone" id="phone" value="<?php echo $phn2;?>" style="width:95px;"/></td>							
							<td ><label>Cell Number :</label></td>
							<td><input type="text" class="fldval" name="mobile" id="mobile" value="<?php echo $studgen['mobile'];?>"  /></td>
							<td ><label>Email id :</label></td>
							<td><input type="text" class="fldval" name="email" id="email" value="<?php echo $studgen['emailid'];?>"  /></td>
						</tr>
						<tr>
							<td ><label>Date of Birth :</label></td>
							<td><input type="text" class="fldval" name="dob" id="dob" value="<?php echo $dob;?>" placeholder="DD-MM-YYYY" /></td>
							<td ><label>Nationality :</label></td>
							<td>
							<select class="fldval" name="nationality" id="nationality" >
							<option value="">Select Nationality</option>						
							<?php	
							$country=selcountry();
							foreach($country as $nationality)
							{
								if($studgen['nationality']==$nationality['Name'])
								{
									echo '<option value="'.$nationality['Name'].'" selected>'.$nationality['Name'].'</option>';
								}
								else
								{
									echo '<option value="'.$nationality['Name'].'">'.$nationality['Name'].'</option>';
								}
							}							
							?>
							</select>	
							</td>
							<td ><label>Community :</label></td>
							<td>
							<?php
								$caste=array('SC','ST','OBC','GENERAL');
								foreach($caste as $cast)
								{
									if($cast==$studgen['community'])
									{
										echo '<input type="radio" class="sc" name="community" value="'.$cast.'" checked/><label>'.$cast.'</label>';
									}
									else
									{
										echo '<input type="radio" class="sc" name="community" value="'.$cast.'"/><label>'.$cast.'</label>';
									}
								}
							?>
							</td>
						</tr>
						<tr>
							<td ><label>Pancard No :</label></td>
							<td><input type="text" class="pancard" name="pancard" id="pancard" value="<?php echo $studgen['panno'];?>"  /></td>
							<td ><label>Aadharcard:</label></td>
							<td><input type="text" class="aadharcard" name="aadharcard" id="aadharcard" value="<?php echo $studgen['aadharno'];?>"  /></td>
						</tr>
						<tr>
							<td ><label>Passport No:</label>
							<td><input type="text" class="fldval" name="passport" id="passport" value="<?php echo $studgen['passportno'];?>"/></td>
						</tr>
						<tr>
							<td ><label>Place of Issue :</label>
							<td><input type="text" class="fldval" name="poi" id="poi" value="<?php echo $studgen['placeofissue'];?>"/></td>
							<td ><label>Date of Issue:</label>
							<td><input type="text" class="fldval" name="doi" id="doi" value="<?php echo $doi;?>" placeholder="DD-MM-YYYY"/></td>
							<td ><label>Valid Upto :</label>
							<td><input type="text" class="fldval" name="valupto" id="valupto" onblur="return chkpassdate();" onchange="return chkpassdate();"value="<?php echo $validity;?>" placeholder="DD-MM-YYYY"/></td>
						</tr>
						<tr>
							<td ><label>Marital Status :</label>
							<td><input type="text" class="fldval" name="marital" id="marital" onkeypress="toupper('marital');" onblur="toupper('marital');"  value="<?php echo $studgen['maritialstatus'];?>"  /></td>
							
						</tr>
						<tr>
							<td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline;">Present Address Details</label></td>
							<td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline;">Permanent Address Details</label><br/><input type="checkbox" class="fldval" name="sadd" id="sadd" value="Yes" onclick="chkaddr(this);"/><label style="color:gray !important;font-size:12px !important;font-weight:normal !important;">Copy the present address for permanent.</label></td>
						</tr>
						<tr>
							<td ><label>Address :</label></td>
							<td colspan="2"><textarea  class="fldval" name="pa" id="pa" ><?php echo $studgen['postaladdress'];?></textarea></td>
							<td ><label>Address :</label></td>
							<td colspan="2"><textarea  class="fldval" name="pa1" id="pa1" ><?php echo $studgen['peraddress'];?> </textarea></td>
						</tr>					
						<tr>
							<td ><label>City :</label></td>
							<td colspan="2"><input type="text" class="fldval" name="city" id="city" value="<?php echo $studgen['postalcity'];?>"  /></td>
							<td ><label>City :</label></td>
							<td colspan="2"><input type="text" class="fldval" name="pcity" id="pcity" value="<?php echo $studgen['percity'];?>"/></td>
						</tr>
						<tr>
							<td ><label>State :</label></td>
							<td colspan="2"><input type="text" class="fldval" name="state" id="state" value="<?php echo $studgen['postalstate'];?>"  /></td>
							<td ><label>State :</label></td>
							<td colspan="2"><input type="text" class="fldval" name="pstate" id="pstate" value="<?php echo $studgen['perstate'];?>"/></td>
						</tr>
						<tr>
							<td ><label>Pin :</label></td>
							<td colspan="2"><input type="text" class="fldval" name="pin" id="pin" value="<?php echo $studgen['postalpin'];?>"  /></td>
							<td ><label>Pin :</label></td>
							<td colspan="2"><input type="text" class="fldval" name="ppin" id="ppin" value="<?php echo $studgen['perpin'];?>"/></td>
						</tr>
						<tr>
							<td colspan="4"><label style="font-size:14px;color:#000;text-decoration:underline;">Father/Guardian Details</label></td>		
						</tr>
						<tr>
							<td ><label>Name :</label></td>
							<td ><input type="text" class="fldval" name="father" id="father" value="<?php echo $studgen['gaurdianname'];?>"  /></td>
							<td  ><label>Phone No :</label></td>
							<td><input type="text" class="fldval" name="fmobile" id="fmobile" value="<?php echo $studgen['gaurdianphone'];?>"  /></td>
							<td  ><label>Email Id :</label></td>
							<td><input type="text" class="fldval" name="femail" id="femail" value="<?php echo $studgen['gaurdianemail'];?>"  /></td>
						</tr>
						<tr>
							<td ><label>Address :</label></td>
							<td><textarea class="fldval" name="address" id="address"><?php echo $studgen['gaurdianaddress'];?></textarea></td>						
						</tr>					
						<tr>
							<td ><label>City : </label></td>
							<td><input type="text" class="fldval" name="fcity" id="fcity" value="<?php echo $studgen['fcity'];?>"  /></td>						
							<td ><label>State  : </label></td>
							<td><input type="text" class="fldval" name="fstate" id="fstate" value="<?php echo $studgen['fstate'];?>"  /></td>						
							<td ><label>Pin : </label></td>
							<td><input type="text" class="fldval" name="fpin" id="fpin" value="<?php echo $studgen['fpin'];?>"  /></td>
						</tr>
						<tr><td></td></tr>						
						<tr>
						<td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline;">Upload Enclosures : </label></td>				
					</tr>					
					<tr>
						<td colspan="3"><div style="width:250px;float:left;">Upload Photo (Max Size 190KB) : </div><div style="width:150px;float:left;"><input type="file" class="photo" name="image" id="image"/></div></td>
					</tr>
					<tr>
						<td colspan="4"><div style="width:250px;float:left;">Upload SSLC Marks Card: </div><div style="width:150px;float:left;"><input type="file" class="photo" name="sslcfile" id="sslcfile"/></div></td>
					</tr>
					<tr>
						<td colspan="4"><div style="width:250px;float:left;">Upload Degree Certificate : </div><div style="width:150px;float:left;"><input type="file" class="photo" name="ugfile" id="ugfile"/></div></td>
					</tr>
					<tr>
						<td colspan="4"><div style="width:250px;float:left;">Upload Address Proof : </div><div style="width:150px;float:left;"><input type="file" class="photo" name="addrfile" id="addrfile"/></div></td>
					</tr>
					<tr>
						<td colspan="4"><div style="width:250px;float:left;">Upload Community Certificate: </div><div style="width:150px;float:left;"><input type="file" class="photo" name="comfile" id="comfile"/></div></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<!-- <a href="#" class="next" id="nxt1" onclick="return valperinfo(),nxt1();">Next</a>
				<a href="#ps1" class="next" id="up1" onclick="return valperinfo('edit');">Update</a>-->
			<input name="but" type="button" style="font-size:13px;height:30px;" onclick="return valperinfo('edit'),chkps();" class="next" value="Update">
		</div>
		<div id="admission" >
			<h2>Edit Admission Details</h2><br/>
			<table width="830">
				<tbody>
					<tr>
						<td colspan="2"><div id="error1" style="color:#F70938;text-align:center;"></div></td>
					</tr>
					<?php
					$doa='';$doc='';$docer='';
					$stdadm=selstudadmdet($id);		
					foreach($stdadm as $studadm)
					{
						$prgname=selprogramname($studadm['admittedfor']);
						foreach($prgname as $prname)
						{
							$prgmname=$prname['programname'];
						}
						$dofa=explode("-",$studadm['dateofadmission']);
						if(count($datob)>0)
						{
							$yr=$dofa[0];							
							$mn=$dofa[1];
							$dt=$dofa[2];
							$doa=$dt.'-'.$mn.'-'.$yr;
						}	
						$dofc=explode("-",$studadm['dateofcompletion']);
						if(count($datob)>0)
						{
							$yr=$dofc[0];							
							$mn=$dofc[1];
							$dt=$dofc[2];
							$doc=$dt.'-'.$mn.'-'.$yr;
						}	
						$dofcer=explode("-",$studadm['certificateissuedon']);
						if(count($datob)>0)
						{
							$yr=$dofcer[0];							
							$mn=$dofcer[1];
							$dt=$dofcer[2];
							$docer=$dt.'-'.$mn.'-'.$yr;
						}	
					?>
						<tr>
							<td><label>Program Admitted For :</label></td>
							<td><input type="text" class="doc" name="program" id="program" value="<?php echo $prgmname;?>" readonly /></td>
							<!--<select name="program" id="program" >
							<option value="PG-CPPM">PG-CPPM</option>
							<option value="PG-CPPM">PG-CPPM</option>
							</select>-->
							</td>
							<td><label>Date of Admission :</label></td>
							<td><input type="text" class="fldval1" name="doa" id="doa" value="<?php echo $doa;?>" placeholder="DD-MM-YYYY" /></td>
						</tr>
						<tr>
							<td><label>Date of Completion :</label></td>
							<td><input type="text" class="doc" name="doc" id="doc" onblur="return chkdate();" onchange="return chkdate();" value="<?php echo $doc;?>" placeholder="DD-MM-YYYY"/></td>							
							<td><label>Mentor Assigned :</label></td>
							<td><input type="text" class="fldval1" name="mentor" id="mentor" value="<?php echo $studadm['mentorassigned'];?>"/></td>
						</tr>
						<tr>
							<td><label>Completion Certificate Issue On :</label></td>
							<td><input type="text" class="dtp" name="certificate" id="certificate" value="<?php echo $docer;?>" placeholder="DD-MM-YYYY" onblur="return chkdate1();" onchange="return chkdate1();"/></td>
							<td><label>No of Attempts :</label></td>
							<td><input type="text" class="fldval1" name="noa" id="noa" value="<?php echo $studadm['noofattempts'];?>" readonly /></td>
							<td><input type="hidden" class="doc" name="pgid" id="pgid" value="<?php echo $studadm['id'];?>" readonly />
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<input name="submit1" type="button" style="font-size:13px;height:30px;" onclick="return valadmission(),chkps();" class="next" value="Update">
			<!--<a href="#" class="next" id="nxt2" onclick="return valadmission(), nxt2();">Next</a>
			<a href="#" class="previous" id="prev1">Previous</a>-->
		</div>
		<div id="feedet" >
			<h2>Edit Fee Details</h2><br/>
			<div style="float:right;"><a href="#" id="anp" style="font-weight:bold;color:#444444;font-size:12px;">Make New Payment</a></div>
			<?php	
			$bal='';					
			$feepaiddet=selpaidfeedet($id,$pid);		
			foreach($feepaiddet as $fpdet)
			{	
				if($fpdet['payable']>=$fpdet['paidamt'])
				{
					$bal=$fpdet['payable']-$fpdet['paidamt'];	
				}
				if($bal=='')
				{
					$bal=$fpdet['payable'];	
				}
			?>
			<input type="hidden" class="fldval2" name="fpayable" id="fpayable" value="<?php echo $fpdet['payable'];?>"  />
			<input type="hidden" class="fldval2" name="feeid" id="feeid"  value="<?php echo $fpdet['id'];?>" readonly />			
			<input type="hidden" class="fldval2" name="bal" id="bal"  value="<?php echo $bal;?>" readonly />
			<input type="hidden" class="fldval2" name="pgrid" id="pgrid"  value="<?php echo $pid;?>" readonly />
			<div id="pymnt">				
				<table width="830">
					<tbody>
						<tr>
							<td colspan="2"><div id="error2" style="color:#F70938;text-align:center;"></div></td>
						</tr>
						<tr>
							<td width="125" ><label>Fee Payable :</label></td>
							<td width="160">
							<?php 
							if($pid !=2 && $pid != 4)
							{
							?>
								<img src="images/rs.png" width="20" height="20" border="0"  style="float:left;margin-top:5px;"/>
							<?php
							}
							else
							{
								?><img src="images/dollar.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/><?php
							}
							?>
							<input type="text" class="fldval2" name="fp" id="fp" value="<?php echo $fpdet['payable'];?>" readonly onblur="return calbal();" /></td>
							<td width="112" ><label>Fee Paid  :</label></td>
							<td width="160">
							<?php 
							if($pid !=2 && $pid != 4)
							{
							?>
								<img src="images/rs.png" width="20" height="20" border="0"  style="float:left;margin-top:5px;"/>
							<?php
							}
							else
							{
								?><img src="images/dollar.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/><?php
							}
							?>
							<input type="text" class="fldval2" name="feepa" id="feepa" value="<?php echo $fpdet['paidamt'];?>" readonly onblur="return calbal();"/></td>
						</tr>					
						<tr>
							<td><label>Balance :</label></td>
							<td>
							<?php 
							if($pid !=2 && $pid != 4)
							{
							?>
								<img src="images/rs.png" width="20" height="20" border="0"  style="float:left;margin-top:5px;"/>
							<?php
							}
							else
							{
								?><img src="images/dollar.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/><?php
							}
							?>
							<input type="text" class="fldval2" name="balance" id="balance" onblur="return calbal();" value="<?php echo $bal;?>" readonly /></td>
							<td><label>Mode of Payment :</label></td>
							<td>
								<select name="mop" id="mop" onchange="chkmode(this);" >
									<option value="Cash">Cash</option>
									<option value="Cheque">Cheque</option>
									<option value="DD">DD</option>
									<option value="Bank Transfer">Bank Transfer</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" ></td>							
							<td width="112" ><label id="dtl">Enter Details :</label></td>
							<td width="160"><input type="text" class="fldval2" name="moddet" id="moddet" value="<?php echo $fpdet['modedet'];?>" readonly /></td>
						</tr>						
						<tr>
						<td colspan="2">
						<input type="hidden" class="fldval2" name="feeid" id="feeid"  value="<?php echo $fpdet['id'];?>" readonly /></td></tr>
					</tbody>
				</table>
				<!--<input name="submit3" type="submit" style="font-size:13px;height:30px;" onclick="return valfee();" class="next" value="Update">-->
			</div>
			<?php	
			}					
			?>
		
			<!--<div id="feeinstallment">
				<table width="600">
					<tbody>
						<tr class="top">
							<td >Installment</td>
							<td >Paid</td>						
							<td>Mode of Pay</td>
							<td >Date</td>
							<td width="75">Action</td>
						</tr>
						<?php	
						$i=1;
						$feedet=selstudfeedet($id,$pid);		
						foreach($feedet as $fdet)
						{						
						?>
							<tr height="20">
								<td><?php echo$fdet['installmentno'];?></td>
								<td><?php echo $fdet['paid'];?></td>
								<td><?php echo $fdet['modeofpay'];?></td>
								<td><?php echo $fdet['paiddate'];?></td>												
								<td><a href="" onclick="return delfee(<?php echo $fdet['id'];?>,<?php echo $id;?>,<?php echo $pid;?>);"><img src="images/delete1.png"  /></a></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>	-->		
			
			<!--<a href="#" class="next" id="nxt3" onclick="return valfee(), nxt3();">Next</a>
			<a href="#" class="previous" id="prev2">Previous</a>-->
		</div>
		<div id="scholastic" >
			<h2>Edit Scholastic Data</h2><br/>	
			<div style="float:right;"><a href="#" id="ena" style="font-weight:bold;color:#444444;font-size:12px;">Enter New Attempt</a></div>	
			<div id="natmt">
				<?php	
				$doe='';				
				$markddet=selstudmarkdet($id,$pid);	
				if(count($markddet)>0)
				{
					foreach($markddet as $mdet)
					{	
						$dofex=explode("-",$mdet['examdate']);
						if(count($dofex)>0)
						{
							$yr=$dofex[0];							
							$mn=$dofex[1];
							$dt=$dofex[2];
							$doe=$dt.'-'.$mn.'-'.$yr;
						}	
				?>				
				<table width="835">
					<tbody>
						<tr><td colspan="2"><input type="hidden" class="fldval2" name="mrkid" id="mrkid"  value="<?php echo $mdet['id'];?>" readonly /></td></tr>
						<tr>
							<td colspan="2"><div id="error3" style="color:#F70938;text-align:center;"></div></td>
						</tr>
						<tr>
							<td ><label style="float:left;">Date of Examination :</label><input type="text" class="fldval" name="doe" id="doe" value="<?php echo $doe;?>" placeholder="DD-MM-YYYY" /></td>														
						</tr>
						<tr>
							<td width="500"><label style="font-size:15px;color:#000;">Details</label></td>
							<td width="150"><label style="font-size:15px;color:#000;">Weightage</label></td>
							<td width="150"><label style="font-size:15px;color:#000;">Marks Obtained </label></td>
						</tr>					
						<tr>
							<td ><label>Assignments (Average % of marks for the Assignments) :</label></td>
							<td  ><label>10 </label></td>
							<td><input type="text" class="fldval3" name="assign" id="assign" style="text-align:center;" value="<?php echo $mdet['assignment'];?>" onchange="return calmark();" onblur="return calmark();"/></td>
						</tr>
						<tr>
							<td ><label>Case Studies (Average % of marks for the Case Studies) :</label></td>
							<td  ><label>10 </label></td>
							<td><input type="text" class="fldval3" name="casestudies" id="casestudies" style="text-align:center;" value="<?php echo $mdet['casestudies'];?>" onchange="return calmark();" onblur="return calmark();"/></td>
						</tr>
						<tr>
							<td ><label>Tests (Average % of marks for the Tests) :</label></td>
							<td ><label>10 </label></td>
							<td><input type="text" class="fldval3" name="test" id="test" style="text-align:center;" value="<?php echo $mdet['testmark'];?>" onchange="return calmark();" onblur="return calmark();"/></td>
						</tr>
						<tr>
							<td ><label>Examination :</label></td>
							<td ><label>70 </label></td>
							<td><input type="text" class="fldval3" name="exam" id="exam" style="text-align:center;" value="<?php echo $mdet['exam'];?>" onchange="return calmark();" onblur="return calmark();"/></td>
						</tr>
						<tr>
							<td ><label>Total :</label></td>
							<td ><label>100 </label></td>
							<td><input type="text" class="fldval3" name="tot" id="tot" style="text-align:center;" value="<?php echo $mdet['totalmark'];?>" onblur="return calmark();"readonly /></td>
						</tr>
					</tbody>
				</table>
				<div style="margin-left:20px;color:maroon;font-weight:bold;font-size:14px;float:left;width:120px;">
					* Final Result : 
				</div>
					<div id="fresult" style="float:left;font-weight:bold;font-size:14px;">
				<?php
					if($mdet['totalmark']>=80)
					{
						echo "<font color='#1626f3' size='2' style='font-weight:bold;'>PASSED WITH DISTINCTION</font>";
					}
					else if($mdet['totalmark']>=60 && $mdet['totalmark'] < 80 )
					{
						echo "<font color='#009130' size='2'>Passed</font>";
					}
					else
					{
						echo "<font color='#F70938' size='2'>Fail</font>";
					}
				?>						
				</div>
				<input name="submit4" type="button" style="font-size:13px;height:30px;" onclick="return valtest(),chkps();" class="next" value="Update">
					<?php
					}
				}
				else
				{
				?>
					<table width="835">
						<tbody>
							<tr>
								<td colspan="2"><div id="error3" style="color:#F70938;text-align:center;"></div></td>
							</tr>
							<tr>
							<td ><label style="float:left;">Date of Examination :</label><input type="text" class="fldval" name="doe" id="doe" value="" placeholder="DD-MM-YYYY" /></td>														
						</tr>
							<tr>
								<td width="500"><label style="font-size:15px;color:#000;">Details</label></td>
								<td width="150"><label style="font-size:15px;color:#000;">Weightage</label></td>
								<td width="150"><label style="font-size:15px;color:#000;">Marks Obtained </label></td>
							</tr>	
							<tr>
								<td ><label>Assignments (Average % of marks for the assignments) :</label></td>
								<td  ><label>10 </label></td>
								<td><input type="text" class="fldval3" name="assign" id="assign" value="" style="text-align:center;" onchange="return calmark();" onblur="return calmark();"/></td>
							</tr>
							<tr>
								<td ><label>Case Studies (Average % of marks for the case studies) :</label></td>
								<td  ><label>10 </label></td>
								<td><input type="text" class="fldval3" name="casestudies" id="casestudies" style="text-align:center;" value="" onchange="return calmark();" onblur="return calmark();"/></td>
							</tr>
							<tr>
								<td ><label>Tests (Average % of marks for the tests) :</label></td>
								<td ><label>10 </label></td>
								<td><input type="text" class="fldval3" name="test" id="test" value="" style="text-align:center;"  onchange="return calmark();" onblur="return calmark();"/></td>
							</tr>
							<tr>
								<td ><label>Exam :</label></td>
								<td ><label>70 </label></td>
								<td><input type="text" class="fldval3" name="exam" id="exam" value="" style="text-align:center;" onchange="return calmark();" onblur="return calmark();"/></td>
							</tr>
							<tr>
								<td ><label>Final Result :</label></td>
								<td ><label>100 </label></td>
								<td><input type="text" class="fldval3" name="tot" id="tot" value="" style="text-align:center;" onblur="return calmark();"readonly /></td>
							</tr>
						</tbody>
					</table>
					<div id="fresult" style="float:left;font-weight:bold;font-size:14px;"></div>					
					<input name="submit3" type="button" style="font-size:13px;height:30px;" onclick="return valtest(),chkps();" class="next" value="Save">
				<?php
				}
				?>
			</div>
			<!--<a href="#" class="next" id="nxt4" onclick="return valtest(), nxt4();">Next</a>
			<a href="#" class="previous" id="prev3">Previous</a>-->
		</div>
		<div id="edu">
			<h2>Edit Educational Qualification</h2><br/>			
			<table width="100%">
				<tbody>
					<tr>
						<td colspan="2"><div id="error4" style="color:#F70938;text-align:center;"></div></td>
					</tr>
					<tr>
						<td><label style="font-size:15px;color:#000;">Qualification</label></td>
						<td><label style="font-size:15px;color:#000;">Passing Year</label></td>
						<td><label style="font-size:15px;color:#000;">Subject Offered</label></td>
						<td><label style="font-size:15px;color:#000;">Institute Name</label></td>
						<td><label style="font-size:15px;color:#000;">University</label></td>
						<td><label style="font-size:15px;color:#000;">Class Awarded</label></td>							
					</tr>	
					<?php
					$i=1;
					$cor=array('SSLC','Graduation','Post Graduation','Others');
					$crname=array();					
					$edet=selstudedudet($id);						
					foreach($edet as $edudet)
					{
						$crname[]=$edudet['course'];
						if($edudet['course']=="SSLC")						
							$i=1;
						if($edudet['course']=="Graduation")						
							$i=2;
						if($edudet['course']=="Post Graduation")						
							$i=3;
						if($edudet['course']=="Others")						
							$i=4;
					?>
						<tr>
							<td><label style="margin-left:25px;"><?php echo $edudet['course'];?></label></td>
							<td><input type="text" style="width:98%;" class="fldval4" id="pyear<?php echo $i;?>" value="<?php echo $edudet['yearofpassing']; ?>" maxlength="4" name="pyear<?php echo $i;?>" ></td>
							<td><input type="text" style="width:98%;" size="10" class="fldval4"  id="subject<?php echo $i;?>" value="<?php echo $edudet['subject']; ?>"  name="subject<?php echo $i;?>" ></td>
							<td><input type="text" style="width:98%;" size="14" class="fldval4"  id="institute<?php echo $i;?>" value="<?php echo $edudet['institute']; ?>"  name="institute<?php echo $i;?>" ></td>
							<td><input type="text" style="width:98%;" size="10" class="fldval4"  id="university<?php echo $i;?>" value="<?php echo $edudet['university']; ?>"  name="university<?php echo $i;?>" ></td>
							<td><input type="text" style="width:98%;" size="14" class="fldval4"  id="award<?php echo $i;?>" value="<?php echo $edudet['classaward']; ?>"  name="award<?php echo $i;?>" ></td>
							<td><input type="hidden" class="doc" name="eduid<?php echo $i;?>" id="eduid<?php echo $i;?>" value="<?php echo $edudet['id'];?>" readonly /></td>
						</tr>
					<?php							
					}	
					for($j=0;$j<4;$j++)
					{
						$chkcourse=0;$c=0;
						foreach($crname as $cname)
						{
							if($cor[$j]==$cname)
							{
								$chkcourse++;
								break;
							}
						}
						if($chkcourse == 0)
						{
							$c=$j+1;
						?>
							<tr>
								
								<td><label style="margin-left:25px;"><?php echo $cor[$j];?></label></td>
								<td><input type="text" style="width:98%;" class="fldval4" id="pyear<?php echo $c;?>" value="" maxlength="4" name="pyear<?php echo $c;?>" ></td>
								<td><input type="text" style="width:98%;" size="10" class="fldval4"  id="subcejt<?php echo $c;?>" value=""  name="subject<?php echo $c;?>" ></td>
								<td><input type="text" style="width:98%;" size="14" class="fldval4"  id="institute<?php echo $c;?>" value=""  name="institute<?php echo $c;?>" ></td>
								<td><input type="text" style="width:98%;" size="10" class="fldval4"  id="university<?php echo $c;?>" value=""  name="university<?php echo $c;?>" ></td>
								<td><input type="text" style="width:98%;" size="14" class="fldval4"  id="award<?php echo $c;?>" value=""  name="award<?php echo $c;?>" ></td>
								<td><input type="hidden" class="doc" name="eduid<?php echo $c;?>" id="eduid<?php echo $c;?>" value="" readonly /></td>
							</tr>	
						<?php
						
						}
					}					
					?>								
				</tbody>
			</table>
			<input name="submit5" type="button" style="font-size:13px;height:30px;" onclick="return valedu(),chkps();" class="next" value="Update">
			<!--<a href="#" class="next" id="nxt5" onclick="return valedu(), nxt5();">Next</a>			
			<a href="#" class="previous" id="prev4">Previous</a>-->
		</div>
		<div id="exp">
			<h2>Edit Experience Details</h2><br/>
			
			<table width="100%">
				<tbody class="admore">					
					<tr>
						<td><label style="font-size:15px;color:#000;">Institution</label></td>
						<td><label style="font-size:15px;color:#000;">Designation</label></td>
						<td><label style="font-size:15px;color:#000;">Period of Employment</label></td>
						<td><label style="font-size:15px;color:#000;">Nature of Work</label></td>													
					</tr>	
					<?php										
					$exdet=selstudexpdet($id);	
					$cnt=1;$ecnt=count($exdet);
					foreach($exdet as $expdet)
					{
					?>
						<tr id="row<?php echo $cnt;?>">							
							<td><input type="text" style="width:98%;" size="10" id="ins<?php echo $cnt;?>" value="<?php echo $expdet['institutename'];?>"  name="ins<?php echo $cnt;?>"></td>
							<td><input type="text" style="width:98%;" size="14" id="des<?php echo $cnt;?>" value="<?php echo $expdet['designation'];?>"  name="des<?php echo $cnt;?>"></td>
							<td width="315"><input type="text" style="margin-right:5px;" id="empf<?php echo $cnt;?>" value="<?php echo $expdet['periodfrom'];?>"  name="empf<?php echo $cnt;?>" placeholder="From"><input type="text" id="empt<?php echo $cnt;?>" value="<?php echo $expdet['periodto'];?>"  name="empt<?php echo $cnt;?>" placeholder="To" >
							</td>
							<td><input type="text" style="width:98%;" size="14" id="wrk<?php echo $cnt;?>" value="<?php echo $expdet['natureofwork'];?>"  name="wrk<?php echo $cnt;?>"></td>
							<td><input type="hidden" id="expid<?php echo $cnt;?>" value="<?php echo $expdet['id'];?>"  name="expid<?php echo $cnt;?>"></td>
							<td><a href="#" id="r<?php echo $cnt;?>" style="text-decoration:none;" class="rmv" onclick="return delchkps(this.id);" title="remove">X</a></td>
						</tr>
					<?php
						$cnt++;
					}
					$ecnt++;
					?>	
					<input type="hidden" name="cnt" id="cnt" style="width:275px; " value="<?php echo $ecnt;?>" />					
				</tbody>
			</table>
			<div style="width:100%;text-align:right;font-weight:bold;"><a style="cursor:pointer;" class="expadmore" onclick="addmore();">Addmore</a></div>	
			<input name="submit6" type="button" style="font-size:13px;height:30px;" class="next" onclick="return chkps();" value="Update"></input>
			<!--<a href="#" class="previous" id="prev5">Previous</a>-->
		</div>
		<div id="substudied" >
			<h2>Edit Subject Studied Details</h2><br/>	
			<div style="float:right;"><a href="#" id="cena" style="font-weight:bold;color:#444444;font-size:12px;">Enter New Attempt</a></div>	
			<div id="snatmt">						
				<table width="835">
					<tbody>						
						<tr>
							<td colspan="2"><div id="errors" style="color:#F70938;text-align:center;"></div></td>
						</tr>
						<tr>
							<td><label>Program :</label></td>							
							<td>
								<select name="cprogram" id="cprogram" disabled>
									<option value="<?php echo $pid;?>"><?php echo $prgmname;?></option>
								</select>									
							</td>								
						</tr>
						<tr>
							<td><label>Course No :</label></td>
							<td>
								<select name="cno" id="cno" onchange="getcourname(this.value),getcourdet(<?php echo $id;?>,<?php echo $pid;?>,this.value);" >
									<option value="">Select Subject</option>
									<?php 
										$prgm=selsubjectlist($id,$pid);									
										foreach($prgm as $program)
										{
											echo '<option value="'.$program['courseno'].'">'.$program['courseno'].'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td ><label>Course Name:</label></td>								
							<td><div id="courname"><input type="text" class="fldval3" name="cna" id="cna" value="" readonly /></div></td>
						</tr>
					</tbody>
				</table>
				<div id="cordet">
					<table width="687">
						<tbody>							
							<tr>
								<td ><label>Maximum Marks:</label></td>								
								<td><input type="text" class="fldval3" name="mxm" id="mxm" value="100"/>
								<input type="hidden" class="fldval2" name="corid" id="corid"  value="" readonly /></td>
							</tr>
							<tr>
								<td ><label>Marks Obtained:</label></td>								
								<td><input type="text" class="fldval3" name="mobt" id="mobt" value="" onblur="getpercent();" onchange="getpercent();"/></td>
							</tr>
							<tr>
								<td ><label>Percentage of Marks:</label></td>								
								<td><input type="text" class="fldval3" name="percent" id="percent" value="" readonly /></td>
							</tr>
							<tr>
								<td ><label>Remarks:</label></td>								
								<td><select name="remarks" id="remarks" >
									<option value="PASSED WITH DISTINCTION">PASSED WITH DISTINCTION</option>
									<option value="PASSED">PASSED</option>
									<option value="FAILED">FAILED</option>
									<option value="EXEMPTED">EXEMPTED</option>
									</select>
								</td>
							</tr>			
						</tbody>
					</table>
				</div>	
				<input name="submit14" type="button" style="font-size:13px;height:30px;" onclick="return valcor(),chkps();" class="next" value="Update" />
			</div>
		</div>
		<div style="width:300px;" id="ps1">						
			<label style="font-size:14px;font-weight:bold;padding-top:5px;margin-bottom:5px; color:#0163BC;">Enter Password</label><br/>
			<input type="password" class="inpt" style="width:185px;margin-right:5px;" name="ss1" id="ss1" value=""/>
			<input type="button" value="submit" name="login" class="next" onclick='return chkusr();' style="margin-top: 0; padding: 5px 12px;" />		
		</div>
		<div style="width:300px;" id="ps2">						
			<label style="font-size:14px;font-weight:bold;padding-top:5px;margin-bottom:5px; color:#0163BC;">Enter Password</label><br/>
			<input type="password" class="inpt" style="width:185px;margin-right:5px;" name="ss2" id="ss2" value=""/>
			<input type="button" value="submit" name="login" class="next" onclick='return delchkusr();' style="margin-top: 0; padding: 5px 12px;" />		
		</div>		
	</form>	
</div>