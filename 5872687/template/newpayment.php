<?php
	$amt='';$bal='';$pid='';
	if(isset($_REQUEST['py']))
	{
		$amt=$_REQUEST['py'];
	}
if(isset($_REQUEST['pv']))
	{
		$bal=$_REQUEST['pv'];
	}
if(isset($_REQUEST['pi']))
	{
		$pid=$_REQUEST['pi'];
	}	
?>
<table width="830px">
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
				<img src="images/rs.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/>
			<?php
			}
			else
			{
				?><img src="images/dollar.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/><?php
			}
			?>
			<input type="text" class="fldval2" name="fp" id="fp" value="<?php echo $amt;?>" readonly /></td>					
		</tr>
		<tr>
			<td width="125" ><label>Previous Balance :</label></td>
			<td width="160"><?php 
			if($pid !=2 && $pid != 4)
			{
			?>
				<img src="images/rs.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/>
			<?php
			}
			else
			{
				?><img src="images/dollar.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/><?php
			}
			?>
			<input type="text" class="fldval2" name="prevbal" id="prevbal" value="<?php echo $bal;?>" readonly /></td>	
			<td width="112" ><label>Fee Paid  :</label></td>
			<td width="160"><?php 
			if($pid !=2 && $pid != 4)
			{
			?>
				<img src="images/rs.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/>
			<?php
			}
			else
			{
				?><img src="images/dollar.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/><?php
			}
			?>
			<input type="text" class="fldval2" name="feepa" id="feepa" value="" onchange="return chkbal();" onblur="return chkbal();"/></td>
		</tr>					
		<tr>
			<td ><label>Balance :</label></td>
			<td><?php 
			if($pid !=2 && $pid != 4)
			{
			?>
				<img src="images/rs.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/>
			<?php
			}
			else
			{
				?><img src="images/dollar.png" width="20" height="20" border="0" style="float:left;margin-top:5px;"/><?php
			}
			?><input type="text" class="fldval2" name="balance" id="balance" onblur="return chkbal();" value="" readonly /></td>
			<td ><label>Mode of payement :</label></td>
			<td>
				<select name="mop" id="mop" onchange="chkmode(this);">
					<option value="Cash">Cash</option>
					<option value="Cheque" selected>Cheque</option>
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
<a href="" class="previous" id="">Cancel</a>
<input name="submit2" type="submit" style="font-size:13px;height:30px;" onclick="return valfee();" class="next" value="Save">