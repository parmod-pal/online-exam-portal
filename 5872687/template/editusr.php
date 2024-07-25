<?php	
	if (!isset($_SESSION)) session_start();
	$id='';
	include "includes/lsusrmenu.php";
	if(isset($_SESSION['id']))
	{
		$id=$_SESSION['id'];
	}
		
?>
<div id="wrap2" class="wrap2">
	<form name="createuser" action="process/updateusr.php" id="frm" method="post" enctype="multipart/form-data">		
		<div id="perinfo">
			<h2><label>Edit User</label></h2><br/>
			<table width="450">
				<tbody>
					<tr>
						<td colspan="2"><div id="error" style="color:#F70938;text-align:center;"></div></td>
					</tr>
					<?php
					$stdgen=selusrdet($id);		
					foreach($stdgen as $studgen)
					{					
					?>
					<tr>
						<td width="125" ><label>User Name :</label></td>
						<td width="167"><input type="text" class="fldval" name="usrname" id="usrname" value="<?php echo $studgen['username'];?>"  /></td>
					</tr>
					<tr>
						<td ><label>Email :</label></td>
						<td><input type="text" class="fldval" name="email" id="email" value="<?php echo $studgen['email'];?>" /></td>
					</tr>
					<tr>
						<td width="112" ><label>User Type :</label></td>
						<td width="160">
							<select name="usrtyp">
							<?php
								$typ=array('Super Admin','Admin','Sub Admin');
								foreach($typ as $usrtyp)
								{
									if($usrtyp==$studgen['usrtype'])
									{
										echo '<option value="'.$usrtyp.'" selected>'.$usrtyp.'</option>';
									}
									else
									{
										echo '<option value="'.$usrtyp.'">'.$usrtyp.'</option>';
									}
								}
							?>
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
						<input name="submit" type="submit" style="font-size:13px;height:30px;margin-left:250px;float:left;" onclick="return valusr('edit');" class="next" value="Update">
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</form>	
</div>