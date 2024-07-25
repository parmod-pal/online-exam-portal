<div id="wrap2" class="wrap2">
	<form name="studentinfo" action="process/save.php" id="frm" method="post" enctype="multipart/form-data">
		<input type="hidden" value="0" id="chkval" name="chkval"/>
		<input type="hidden" value="0" id="chkval1" name="chkval1"/>
		<input type="hidden" value="0" id="chkval2" name="chkval2"/>
		<input type="hidden" value="0" id="chkval3" name="chkval3"/>
		<input type="hidden" value="0" id="chkval4" name="chkval4"/>
		<!--<input type="hidden" value="save" id="" name="m"/>
		<input type="hidden" value="process" id="" name="a"/>-->
		<div id="perinfo">
			<h2><label>Personal Information</label></h2><br/>
			<table width="850">
				<tbody>
					<tr>
						<td colspan="2"><div id="error" style="color:#F70938;text-align:center;"></div></td>
					</tr>					
					<tr>
						<td width="125" ><label>Admission No :</label></td>
						<td width="167"><input type="text" class="fldval" name="admin" id="admin" value="<?php echo randomNumber();?>" readonly /></td>
					</tr>
					<tr>
						<td ><label>First Name :</label></td>
						<td><input type="text" class="fldval" name="fname" id="fname" value="" onkeypress="toupper('fname');" onblur="toupper('fname');" /></td>
						<td width="112" ><label>Middle Name :</label></td>
						<td width="160"><input type="text" class="" name="mname" id="mname" value="" onkeypress="toupper('mname');" onblur="toupper('mname');" /></td>
						<td width="114" ><label>Last Name :</label></td>
						<td width="144"><input type="text" class="fldval" name="lname" id="lname" value="" onkeypress="toupper('lname');" onblur="toupper('lname');" /></td>
					</tr>
					<tr>
						<td ><label>Gender :</label></td>
						<td><input type="radio" name="gender" class="gender" value="Male"><label>Male</label>
						<input type="radio" name="gender" class="gender" value="Female"><label>Female</label></td>
					</tr>
					<tr>
						<td ><label>Phone No :</label></td>
						<td><input type="text" class="phone" name="phone1" id="phone1" value="" style="width:50px;margin-right:5px;"placeholder="code"/><input type="text" class="phone" name="phone" id="phone" value="" style="width:95px;"/></td>
						<td ><label>Cell Number :</label></td>
						<td><input type="text" class="fldval" name="mobile" id="mobile" value="+91"  /></td>
						<td ><label>Email Id :</label></td>
						<td><input type="text" class="fldval" name="email" id="email" value=""  /></td>
					</tr>
					<tr>
						<td ><label>Date of Birth :</label></td>
						<td><input type="text" class="fldval" name="dob" id="dob" value="" placeholder="DD-MM-YYYY" /></td>
						<td ><label>Nationality :</label></td>
						<td>
							<select class="fldval" name="nationality" id="nationality" >
							<option value="">Select Nationality</option>						
							<?php	
							$country=selcountry();
							foreach($country as $nationality)
							{
								echo '<option value="'.$nationality['Name'].'">'.$nationality['Name'].'</option>';
							}							
							?>
							</select>	
						</td>
						<td ><label>Community :</label></td>
						<td><input type="radio" class="sc" name="community" value="SC"/><label>SC</label>
						<input type="radio" class="sc" name="community" value="ST"/><label>ST</label>
						<input type="radio" class="sc" name="community" value="OBC"  /><label>OBC</label>
						<input type="radio" class="sc" name="community" value="GENERAL" checked /><label>General</label></td>
					</tr>
					<tr>
						<td ><label>Pancard No :</label></td>
						<td><input type="text" class="pancard" name="pancard" id="pancard" value=""  /></td>
						<td ><label>Aadharcard:</label></td>
						<td><input type="text" class="aadharcard" name="aadharcard" id="aadharcard" value=""  /></td>
					</tr>
					<tr>
						<td ><label>Passport No:</label>
						<td><input type="text" class="fldval" name="passport" id="passport" value=""/></td>
					</tr>
					<tr>
						<td ><label>Place of Issue :</label>
						<td><input type="text" class="fldval" name="poi" id="poi" value=""/></td>
						<td ><label>Date of Issue:</label>
						<td><input type="text" class="fldval" name="doi" id="doi" value="" placeholder="DD-MM-YYYY"/></td>
						<td ><label>Valid Upto :</label>
						<td><input type="text" class="fldval" name="valupto" id="valupto" onblur="return chkpassdate();" onchange="return chkpassdate();" value="" placeholder="DD-MM-YYYY"/></td>
					</tr>
					<tr>
						<td ><label>Marital Status :</label>
						<td><input type="text" class="fldval" name="marital" id="marital" value="" onkeypress="toupper('marital');" onblur="toupper('marital');"  /></td>
						
					</tr>
					<tr>
						<td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline;">Present Address Details</label></td>
						<td colspan="3"><label style="font-size:14px;color:#000;text-decoration:underline;">Permanent Address Details</label><br/><input type="checkbox" class="fldval" name="sadd" id="sadd" value="Yes" onclick="chkaddr(this);"/><label style="color:gray !important;font-size:12px !important;font-weight:normal !important;">Copy the present address for permanent.</label></td>						
					</tr>
					<tr>
						<td ><label>Address :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="pa" id="pa" value=""  /></td>
						<td ><label>Address :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="pa1" id="pa1" value=""/></td>
					</tr>
					<tr>
						<td ><label>Line1 :</label></td>
						<td colspan="2"><input type="text" class="line" name="line" id="line" value=""/></td>
						<td ><label>Line1 :</label></td>
						<td colspan="2"><input type="text" class="line" name="pline" id="pline" value=""/></td>
					</tr>
					<tr>
						<td ><label>Line2 :</label></td>
						<td colspan="2"><input type="text" class="line2" name="line2" id="line2" value=""  /></td>
						<td ><label>Line2 :</label></td>
						<td colspan="2"><input type="text" class="line2" name="pline2" id="pline2" value=""/></td>
					</tr>
					<tr>
						<td ><label>City :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="city" id="city" value=""  /></td>
						<td ><label>City :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="pcity" id="pcity" value=""/></td>
					</tr>
					<tr>
						<td ><label>State :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="state" id="state" value=""  /></td>
						<td ><label>State :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="pstate" id="pstate" value=""/></td>
					</tr>
					<tr>
						<td ><label>Pin :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="pin" id="pin" value=""  /></td>
						<td ><label>Pin :</label></td>
						<td colspan="2"><input type="text" class="fldval" name="ppin" id="ppin" value=""/></td>
					</tr>
					<tr>
						<td colspan="4"><label style="font-size:14px;color:#000;text-decoration:underline;">Father/Guardian Details</label></td>		
					</tr>
					<tr>
						<td ><label>Name :</label></td>
						<td ><input type="text" class="fldval" name="father" id="father" value=""  /></td>
						<td  ><label>Phone No :</label></td>
						<td><input type="text" class="fldval" name="fmobile" id="fmobile" value=""  /></td>
						<td  ><label>Email Id :</label></td>
						<td><input type="text" class="fldval" name="femail" id="femail" value=""  /></td>
					</tr>
					<tr>
						<td ><label>Address :</label></td>
						<td><input type="text" class="fldval" name="address" id="address" value=""  /></td>
						<td ><label>Line1 : </label></td>
						<td><input type="text" class="line1" name="line1" id="line1" value=""/></td>
						<td ><label>Line2 : </label></td>
						<td><input type="text" class="fline2" name="fline2" id="fline2" value=""/></td>
					</tr>
					
					<tr>
						<td ><label>City : </label></td>
						<td><input type="text" class="fldval" name="fcity" id="fcity" value=""  /></td>						
						<td ><label>State  : </label></td>
						<td><input type="text" class="fldval" name="fstate" id="fstate" value=""  /></td>						
						<td ><label>Pin : </label></td>
						<td><input type="text" class="fldval" name="fpin" id="fpin" value=""  /></td>
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
				</tbody>
			</table>	
			<a href="#" class="next" id="nxt1" onclick="return valperinfo('new'), nxt1();">Next</a>							
		</div>
		<div id="edu">
			<h2>Educational Qualification</h2><br/>			
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
					<tr>
						<td><label style="margin-left:25px;">SSLC</label></td>
						<td><input type="text" style="width:98%;" class="fldval4" id="pyear1" value="" maxlength="4" name="pyear1" ></td>
						<td><input type="text" style="width:98%;" size="10" class="fldval4"  id="subject1" value=""  name="subject1" ></td>
						<td><input type="text" style="width:98%;" size="14" class="fldval4"  id="institute1" value=""  name="institute1" ></td>
						<td><input type="text" style="width:98%;" size="10" class="fldval4"  id="university1" value=""  name="university1" ></td>
						<td><input type="text" style="width:98%;" size="14" class="fldval4"  id="award1" value=""  name="award1" ></td>
					</tr>
					<tr>
						<td><label style="margin-left:25px;">Graduation</label></td>
						<td><input type="text" style="width:98%;" id="pyear2" value="" maxlength="4" name="pyear2"></td>
						<td><input type="text" style="width:98%;" size="10" id="" value=""  name="subject2"></td>
						<td><input type="text" style="width:98%;" size="14" id="" value=""  name="institute2"></td>
						<td><input type="text" style="width:98%;" size="10" id="" value=""  name="university2"></td>
						<td><input type="text" style="width:98%;" size="14" id="" value=""  name="award2"></td>
					</tr>
					<tr>
						<td><label style="margin-left:25px;">Post Graduation</label></td>
						<td><input type="text" style="width:98%;" id="pyear3" value="" maxlength="4" name="pyear3"></td>
						<td><input type="text" style="width:98%;" size="10" id="" value=""  name="subject3"></td>
						<td><input type="text" style="width:98%;" size="14" id="" value=""  name="institute3"></td>
						<td><input type="text" style="width:98%;" size="10" id="" value=""  name="university3"></td>
						<td><input type="text" style="width:98%;" size="14" id="" value=""  name="award3"></td>
					</tr>
					<tr>
						<td><label style="margin-left:25px;">Others</label></td>
						<td><input type="text" style="width:98%;" id="pyear4" value="" maxlength="4" name="pyear4"></td>
						<td><input type="text" style="width:98%;" size="10" id="" value=""  name="subject4"></td>
						<td><input type="text" style="width:98%;" size="14" id="" value=""  name="institute4"></td>
						<td><input type="text" style="width:98%;" size="10" id="" value=""  name="university4"></td>
						<td><input type="text" style="width:98%;" size="14" id="" value=""  name="award4"></td>
					</tr>						
				</tbody>
			</table>
			<a href="#" class="next" id="nxt2" onclick="return valedu(),nxt2();">Next</a>			
			<a href="#" class="previous" id="prev1">Previous</a>
		</div>
		<div id="exp">
			<h2>Experience Details</h2><br/>
			<input type="hidden" name="cnt" id="cnt" style="width:275px; " value="3" />
			<table width="835">
				<tbody class="admore">					
					<tr>
						<td><label style="font-size:15px;color:#000;">Institution</label></td>
						<td><label style="font-size:15px;color:#000;">Designation</label></td>
						<td><label style="font-size:15px;color:#000;">Period of Employment</label></td>
						<td><label style="font-size:15px;color:#000;">Nature of Work</label></td>													
					</tr>						
					<tr>						
						<td><input type="text" style="width:98%;" size="10" id="ins1" value=""  name="ins1" ></td>
						<td><input type="text" style="width:98%;" size="14" id="des1" value=""  name="des1" ></td>
						<td width="315"><input type="text" style="margin-right:5px;" id="empf1" value=""  name="empf1"  placeholder="From"><input type="text" id="empt1" value=""  name="empt1"  placeholder="To"></td>
						<td><input type="text" style="width:98%;" size="14" id="wrk1" value=""  name="wrk1" ></td>
					</tr>
					<tr>
						<td><input type="text" style="width:98%;" size="10" id="ins2" value=""  name="ins2" ></td>
						<td><input type="text" style="width:98%;" size="14" id="des2" value=""  name="des2" ></td>
						<td width="315"><input type="text" style="margin-right:5px;" id="empf2" value=""  name="empf2"  placeholder="From"><input type="text" id="empt2" value=""  name="empt2"  placeholder="To"></td>
						<td><input type="text" style="width:98%;" size="14" id="wrk2" value=""  name="wrk2" ></td>
					</tr>					
					<tr>
						<td><input type="text" style="width:98%;" size="10" id="ins3" value=""  name="ins3" ></td>
						<td><input type="text" style="width:98%;" size="14" id="des3" value=""  name="des3" ></td>
						<td width="315"><input type="text" style="margin-right:5px;" id="empf3" value=""  name="empf3"  placeholder="From"><input type="text" id="empt3" value=""  name="empt3"  placeholder="To"></td>
						<td><input type="text" style="width:98%;" size="14" id="wrk3" value=""  name="wrk3" ></td>
					</tr>										
				</tbody>
			</table>
			<div style="width:100%;text-align:right;font-weight:bold;"><a style="cursor:pointer;" class="expadmore" onclick="addmore();">Addmore</a>	</div>		
			<a href="#" class="next" id="nxt3" onclick="return nxt3();">Next</a>
			<a href="#" class="previous" id="prev2">Previous</a>
			
		</div>
		<div id="admission" >
			<h2>Admission Details</h2><br/>
			<table width="835">
				<tbody>
					<tr>
						<td colspan="2"><div id="error1" style="color:#F70938;text-align:center;"></div></td>
					</tr>
					<tr>
						<td><label>Program Admited For :</label></td>
						<td>
							<select name="program" id="program" onchange="getprg(this.value);" >
								<?php 
									/* $prgm=selprogram();									
									foreach($prgm as $program)
									{
										echo '<option value="'.$program['id'].'">'.$program['programname'].'</option>';
									} */
								?>								
								<option value="1">MBA - Online</option>
								<option value="2">MBA - On-campus</option>
								<option value="3">PGDPM</option>
								<option value="6">DPM</option>
								<option value="4">Study Abroad</option>
								<option value="5">Other</option>
							</select>							
						</td>
						<td ><label>Date of Admission :</label></td>
						<td><input type="text" class="fldval1" name="doa" id="doa" value="" placeholder="DD-MM-YYYY" /></td>
					</tr>
					<tr>
						<td><label>Date of Completion :</label></td>
						<td><input type="text" class="doc" name="doc" id="doc" value="" onblur="return chkdate();" onchange="return chkdate();"placeholder="DD-MM-YYYY"/></td>						
						<td ><label>Mentor Assigned :</label></td>
						<td><input type="text" class="fldval1" name="mentor" id="mentor" value=""/></td>
					</tr>
					<tr>
						<td ><label>Completion Certificate Issue On :</label></td>
						<td><input type="text" class="dtp" name="certificate" id="certificate"onblur="return chkdate1();" onchange="return chkdate1();" value="" placeholder="DD-MM-YYYY"/></td>
						<td ><label>No of Attempts :</label></td>
						<td><input type="text" class="fldval1" name="noa" id="noa" value="1"/></td>
					</tr>
				</tbody>
			</table>
			<a href="#" class="next" id="nxt4" onclick="return valadmission(),nxt4();">Next</a>
			<a href="#" class="previous" id="prev3">Previous</a>
		</div>
		<div id="feedet" >
			<h2>Fee Details</h2><br/>
			<table width="835">
				<tbody>
					<tr>
						<td colspan="2"><div id="error2" style="color:#F70938;text-align:center;"></div></td>
					</tr>
					<tr>
						<td width="125" ><label>Fee Payable :</label></td>
						<td width="160"><div id="currency1" style="float:left;"><img src="images/rs.png" width="20" height="20" border="0" id="cur1" style="float:left;margin-top:5px;"/></div><input type="text" class="fldval2" name="fp" id="fp" value="" onchange="return calbal();" onblur="return calbal();" /></td>
						<td width="112" ><label>Fee Paid  :</label></td>
						<td width="160"><div id="currency2" style="float:left;"><img src="images/rs.png" width="20" height="20" border="0" id="cur2" style="float:left;margin-top:5px;"/></div><input type="text" class="fldval2" name="feepa" id="feepa" value="" onchange="return calbal();" onblur="return calbal();"/></td>
					</tr>
					<tr>
						<td><label>Balance :</label></td>
						<td><div id="currency3" style="float:left;"><img src="images/rs.png" width="20" height="20" border="0" id="cur3" style="float:left;margin-top:5px;"/></div><input type="text" class="fldval2" name="balance" id="balance" onblur="return calbal();" value="" readonly /></td>
						<td><label>Mode of Payment :</label></td>
						<td>
							<select name="mop" id="mop" onchange="chkmode(this);">
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
						<td width="160"><input type="text" class="fldval2" name="moddet" id="moddet" value="" /></td>
					</tr>
				</tbody>
			</table>
			<a href="#" class="next" id="nxt5" onclick="return valfee(),nxt5();">Next</a>
			<a href="#" class="previous" id="prev4">Previous</a>
		</div>
		<div id="scholastic" >
			<h2>Scholastic Data</h2><br/>
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
						<td><input type="text" class="fldval3" name="test" id="test" value="" style="text-align:center;" onchange="return calmark();" onblur="return calmark();"/></td>
					</tr>
					<tr>
						<td ><label>Examination :</label></td>
						<td ><label>70 </label></td>
						<td><input type="text" class="fldval3" name="exam" id="exam" value="" style="text-align:center;" onchange="return calmark();" onblur="return calmark();"/></td>
					</tr>
					<tr>
						<td ><label>Total :</label></td>
						<td ><label>100 </label></td>
						<td><input type="text" class="fldval3" name="tot" id="tot" value="" style="text-align:center;" onblur="return calmark();"readonly /></td>
					</tr>
				</tbody>
			</table>
			<div style="margin-left:20px;color:maroon;font-weight:bold;font-size:14px;float:left;width:120px;">
				* Final Result : 
			</div>
			<div id="fresult" style="float:left;font-weight:bold;font-size:14px;"></div>
			<a href="#" class="next" id="nxt6" onclick="return valtest1(),nxt6();">Next</a>
			<a href="#" class="previous" id="prev5">Previous</a>
		</div>
		<div id="substudied" >
			<h2>Enter Subject Studied Details</h2><br/>				
			<table width="835">
				<tbody>
					<tr>
						<td colspan="2"><div id="errors" style="color:#F70938;text-align:center;"></div></td>
					</tr>
					<tr>
						<td><label>Program :</label></td>
						<td><div id="prgn">
							<select name="cprogram" id="cprogram" disabled>
								<option value="1">MBA - Online</option>
							</select>
						</div></td>
					</tr>
					<tr>
						<td><label>Course No :</label></td>
						<td>
							<select name="cno" id="cno" onchange="getcourname(this.value);" >
								<?php 
									$prgm=selcourse();									
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
						<td><div id="courname"><input type="text" class="crname" name="cna" id="cna" value="Principles of Project Management" readonly /></div></td>
					</tr>
					<tr>
						<td ><label>Maximum Marks:</label></td>								
						<td><input type="text" class="fldval3" name="mxm" id="mxm" value="100"/></td>
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
			<input name="submit" type="submit" style="font-size:13px;height:30px;" class="next" value="Submit"></input>	
			<a href="#" class="previous" id="prev6">Previous</a>
		</div>
	</form>
</div>