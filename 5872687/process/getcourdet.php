<?php
require_once 'function.php';
$id='';$pid='';$cid='';$res='';
if(isset($_REQUEST['sid']))
{
	$id=$_REQUEST['sid'];
}
if(isset($_REQUEST['pid']))
{
	$pid=$_REQUEST['pid'];
}	
if(isset($_REQUEST['cid']))
{
	$cid=$_REQUEST['cid'];
}		
$link=open_database_connection();
$sqlid =mysql_query("SELECT * FROM courseattend where studentid='".$id."' and programid='".$pid."' and courseno='".$cid."' order by id desc limit 0,1",$link);	
if($sqlid>0)
{
	if(mysql_num_rows($sqlid)>0)
	{
		while($data=mysql_fetch_array($sqlid))
		$res='<table width="440">
				<tbody>
			<tr>
				<td ><label>Maximum Marks:</label></td>								
				<td>
					<input type="text" class="fldval3" name="mxm" id="mxm" value="'.$data['maxmark'].'"/>
					<input type="hidden" class="fldval2" name="corid" id="corid"  value="'.$data['id'].'" readonly />
				</td>
			</tr>
			<tr>
				<td ><label>Marks Obtained:</label></td>								
				<td><input type="text" class="fldval3" name="mobt" id="mobt" value="'.$data['markobtained'].'" onblur="getpercent();" onchange="getpercent();"/></td>
			</tr>
			<tr>
				<td ><label>Percentage of Marks:</label></td>								
				<td><input type="text" class="fldval3" name="percent" id="percent" value="'.$data['markpercent'].'" readonly /></td>
			</tr>
			<tr>
				<td ><label>Remarks:</label></td>								
				<td><select name="remarks" id="remarks" >
						<option value="'.$data['remarks'].'" selected>'.$data['remarks'].'</option>
						<option value=""></option>
						<option value="PASSED WITH DISTINCTION">PASSED WITH DISTINCTION</option>
						<option value="PASSED">PASSED</option>
						<option value="FAILED">FAILED</option>
						<option value="EXEMPTED">EXEMPTED</option>					
					</select>
				</td>
			</tr>
			</tbody>
					</table>';				
	}
}
close_database_connection($link);
echo $res;
?>