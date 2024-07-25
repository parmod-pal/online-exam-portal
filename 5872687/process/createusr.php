<div id="wrap2" class="wrap2">
	<form name="createuser" action="process/saveusr.php" id="frm" method="post" enctype="multipart/form-data">		
		<div id="perinfo">
			<h2><label>Create New User</label></h2><br/>
			<table width="450">
				<tbody>
					<tr>
						<td colspan="2"><div id="error" style="color:#F70938;text-align:center;"></div></td>
					</tr>					
					<tr>
						<td width="125" ><label>User Name :</label></td>
						<td width="167"><input type="text" class="fldval" name="usrname" id="usrname" value=""  /></td>
					</tr>
					<tr>
						<td ><label>Email :</label></td>
						<td><input type="text" class="fldval" name="email" id="email" value="" /></td>
					</tr>
					<tr>
						<td width="112" ><label>User Type :</label></td>
						<td width="160">
							<select name="usrtyp">
								<option value="Super Admin">Super Admin</option>
								<option value="Admin" selected>Admin</option>
								<option value="Sub Admin">Sub Admin</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="114" ><label>Password :</label></td>
						<td width="144"><input type="password" class="fldval" name="pswd" id="pswd" value=""  /></td>
					</tr>
					<tr>
						<td width="114" ><label>Confirm Password :</label></td>
						<td width="144"><input type="password" class="fldval" name="cpswd" id="cpswd" value=""  /></td>
					</tr>	
					<tr>
						<td colspan="2" style="text-align:center;">
						<input name="submit" type="submit" style="font-size:13px;height:30px;margin-left:250px;float:left;" onclick="return valusr('save');" class="next" value="Submit">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>	
</div>