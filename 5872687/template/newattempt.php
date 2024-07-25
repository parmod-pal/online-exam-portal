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
			<td><label>Assignments (Average % of marks for the assignments) :</label></td>
			<td><label>10 </label></td>
			<td><input type="text" class="fldval3" name="assign" id="assign" value="" style="text-align:center;" onchange="return calmark();" onblur="return calmark();"/></td>
		</tr>
		<tr>
			<td ><label>Case Studies (Average % of marks for the case studies) :</label></td>
			<td  ><label>10 </label></td>
			<td><input type="text" class="fldval3" name="casestudies" id="casestudies" value="" style="text-align:center;" onchange="return calmark();" onblur="return calmark();"/></td>
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
			<td ><label>Final Result :</label></td>
			<td ><label>100 </label></td>
			<td><input type="text" class="fldval3" name="tot" id="tot" value="" style="text-align:center;" onblur="return calmark();"readonly /></td>
		</tr>
	</tbody>
</table>
<div id="fresult" style="float:left;font-weight:bold;font-size:14px;"></div>
<a href="" class="previous" id="">Cancel</a>
<input name="submit3" type="submit" style="font-size:13px;height:30px;" onclick="return valtest();" class="next" value="Save">