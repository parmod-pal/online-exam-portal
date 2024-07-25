<?php	
	if (!isset($_SESSION)) session_start();
	$usrname='';$usrmail='';$usrtyp='';
	include "includes/lsusrmenu.php";
	if(isset($_SESSION['usrname']))
	{
		$usrname=$_SESSION['usrname'];
	}
	if(isset($_SESSION['usrmail']))
	{
		$usrmail=$_SESSION['usrmail'];
	}	
	if(isset($_SESSION['usrtyp']))
	{
		$usrtyp=$_SESSION['usrtyp'];
	}	
?>
<div id="display">
	<div id="wrap2" class="wrap2">
		<form name="profile" action="process/updateprofile.php" id="frm" method="post" enctype="multipart/form-data">		
			<div id="perinfo">
				<h2><label>View Profile</label></h2><br/>
				<table width="450">
					<tbody>
						<tr>
							<td colspan="2"><div id="error" style="color:#F70938;text-align:center;"></div></td>
						</tr>					
						<tr>
							<td width="125" ><label>User Name :</label></td>
							<td width="167"><input type="text" class="fldval" name="usrname" id="usrname" value="<?php echo $usrname;?>" readonly /></td>
						</tr>
						<tr>
							<td ><label>Email :</label></td>
							<td><input type="text" class="fldval" name="email" id="email" value="<?php echo $usrmail;?>" /></td>
						</tr>
						<tr>
							<td ><label>User Type :</label></td>
							<td><input type="text" class="fldval" name="usrtyp" id="usrtyp" value="<?php echo $usrtyp;?>" readonly /></td>
						</tr>						
						<tr>
							<td colspan="2" style="text-align:center;">
							<input name="submit" type="submit" style="font-size:13px;height:30px;float:left;margin-left:250px;" onclick="return valusr();" class="next" value="Update">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</form>	
	</div>
</div>