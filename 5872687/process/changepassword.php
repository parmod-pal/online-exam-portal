<?php	
	if (!isset($_SESSION)) session_start();
	$usrname='';	
	if(isset($_SESSION['usrname']))
	{
		$usrname=$_SESSION['usrname'];
	}	
?>
<div id="wrap2" class="wrap2">
	<form name="chngpswd" action="process/updatepswd.php" id="frm" method="post" enctype="multipart/form-data">		
		<div id="perinfo">
			<h2><label>Change Password</label></h2><br/>
			<table width="450">
				<tbody>
					<tr>
						<td colspan="2"><div id="error" style="color:#F70938;text-align:center;"></div><input type="hidden" class="fldval" name="usrname" id="usrname" value="<?php echo $usrname;?>"  /></td>
					</tr>	
					<tr>
						<td width="114" ><label>Old Password :</label></td>
						<td width="144"><input type="password" class="fldval" name="opswd" id="opswd" value=""  /></td>
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
						<input name="submit" type="submit" style="font-size:13px;height:30px;float:left;margin-left:250px;" onclick="return chgpswd();" class="next" value="Submit">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>	
</div>