<?php
include "function.php";
	$pid='';$prname='';
	if(isset($_REQUEST['pid']))
	{
		$pid=$_REQUEST['pid'];
	}
	session_start();
	if(isset($_SESSION['pid']))
	{
		unset($_SESSION['pid']);
	}
$_SESSION['pid']=$pid;
	$prgname=selprogramname($pid);
	foreach($prgname as $pgname)
	{	
		$prname=$pgname['programname'];
	}
$dat=date('d/m/Y');	
?>
<div id="logo" class="logo" style="float:left;width:160px;margin-top:40px;"><img src="images/logo.jpg" /></div>
<!--<div style="float:right;margin-right:20px;"><img src="images/unilogo.jpeg" style="float:left;margin-top:30px;" /></div>-->
<div style="clear:both;"></div>
<div style="text-align:center;"> <img src="images/lgo1.jpg"  style="margin-left:60px;"/></div>
<p style="font-weight:bold; text-align:center; margin-top:5px;">PROGRAMWISE AND STUDENTWISE DETAILS OF THE CONSOLIDATED MARKS OBTAINED</p>
<p style="font-weight:bold; text-align:center; margin-top:5px; margin-bottom:10px;">PROGRAM : <?php echo $prname;?></p>
<table width="100%" border="1" cellspacing="0" cellpadding="0" >
	<tbody>
		<tr style="font-weight:bold; font-size:15px; text-align:left;">
			<th width="130" height="40"><label>Admission No.</label></th>
			<th width="190"><label>First Name</label></th>
			<th width="110"><label>Assignment Marks <br/>(Max 10)</label></th>
			<th width="110"><label>Case Study Marks (Max 10)</label></th>
			<th width="110"><label>Tests Marks (Max 10)</label></th>
			<th width="130"><label>Examination Marks <br/>(Max 70)</label></th>
			<th width="130"><label>Grand Total</label></th>
			<th width="130"><label>Result</label></th>						
		</tr>
		<?php			
			$result='';
			$studlist=selrpt4($pid);			
			foreach($studlist as $slist)
			{	
				$total=$slist['assignment']+$slist['casestudies']+$slist['testmark']+$slist['exam'];
				if($total>=80)
				{
					$result="<font color='#1626f3' size='2'>PASSED WITH DISTINCTION</font>";
				}
				else if($total>=60 && $total < 80)
				{
					$result="<font color='#009130' size='2'>PASSED</font>";
				}
				else
				{
					$result="<font color='#F70938' size='2'>FAIL</font>";
				}
				
			?>
				<tr>
					<td><?php echo $slist['admissionno'];?></td>
					<td><?php echo $slist['firstname'];?></td>
					<td style="text-align:center;"><?php echo $slist['assignment'];?></td>	
					<td style="text-align:center;"><?php echo $slist['casestudies'];?></td>
					<td style="text-align:center;"><?php echo $slist['testmark'];?></td>
					<td style="text-align:center;"><?php echo $slist['exam'];?></td>	
					<td style="text-align:center;"><?php echo $total;?></td>
					<td><?php echo $result;?></td>					
				</tr>
			<?php
			}
			?>	
	</tbody>
</table>