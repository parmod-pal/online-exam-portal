<?php		
	$usrname='';
	if(isset($_REQUEST['u']))
	{
		$usrname=$_REQUEST['u'];
	}	
?>
<div id="wrap2" class="wrap2">
	<form name="newpswd" action="" id="frm" method="post" enctype="multipart/form-data">		
		<div id="perinfo" style="margin:40px;">
			<h2><label>Create New Password</label></h2><br/>
			<table width="450">
				<tbody>
					<tr>
						<td colspan="2"><div id="error" style="color:#F70938;text-align:center;"></div>
						<input type="hidden" class="fldval" name="usrname" id="usrname" value="<?php echo $usrname;?>"  />
						</td>
					</tr>					
					<tr>
						<td width="114" ><label>New Password :</label></td>
						<td width="144"><input type="password" class="fldval" name="pswd" id="pswd" value=""  /></td>
					</tr>
					<tr>
						<td width="114" ><label>Confirm Password :</label></td>
						<td width="144"><input type="password" class="fldval" name="cpswd" id="cpswd" value=""  /></td>
					</tr>					
					<tr>
						<td colspan="2" style="text-align:center;">
						<input name="submit" type="submit" style="font-size:13px;height:30px;float:left;margin-left:250px;" onclick="return npswd();" class="next" value="Submit">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>	
</div>