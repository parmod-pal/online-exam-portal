<?php 
require_once "../process/function.php";
if (!isset($_SESSION)) session_start();
$pid='';$prgmname='';$sid='';
if(isset($_SESSION['pid']))
{
	$pid=$_SESSION['pid'];
}	
if(isset($_SESSION['id']))
{
	$sid=$_SESSION['id'];
}
$prgname=selprogramname($pid);
foreach($prgname as $prname)
{
	$prgmname=$prname['programname'];
}?>
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
				<select name="cno" id="cno" onchange="getcourname(this.value);" >
					<?php 
						$noa=0;
						$prgm=selcourse();									
						foreach($prgm as $program)
						{
							$link=open_database_connection();
							$sqlid =mysql_query("SELECT count(*) as tot FROM courseattend where studentid='".$sid."' and programid='".$pid."' and courseno='".$program['courseno']."'",$link);	
							if($sqlid>0)
							{
								while($row =mysql_fetch_array($sqlid))
								{	   
									$noa = $row['tot'];			
								} 
							}
							close_database_connection($link);
							if($noa < 4)
							{
								echo '<option value="'.$program['courseno'].'">'.$program['courseno'].'</option>';
							}
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
<input name="submit13" type="button" style="font-size:13px;height:30px;" onclick="return valcor(),chkps();" class="next" value="Save" />