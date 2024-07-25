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
	$ano='';
	if(isset($_REQUEST['ano']))
	{
		$ano=$_REQUEST['ano'];
	}
	$prgname=selprogramname($pid);
	foreach($prgname as $pgname)
	{	
		$prname=$pgname['programname'];
	}
$dat=date('d/m/Y');	
if($ano !='')
{
$studlist=selrpt2($pid,$ano);	
if(count($studlist)>0)
{
?>
<a href="process/mail.php?pid=<?php echo $pid;?>&ano=<?php echo $ano;?>" class="" id="fsendmail" onclick="" style="text-decoration:none;float:right;margin-right:20px;font-weight:bold;font-size:14px;color:#0163BC;">Send Mail</a>
<?php
}
}
?>
<div style="clear:both;"></div>
<div id="logo" class="logo" style="float:left;width:160px;margin-top:40px;"><img src="images/logo.jpg" /></div>
<!--<div style="float:right;margin-right:20px;"><img src="images/unilogo.jpeg" style="float:left;margin-top:30px;" /></div>-->
<div style="clear:both;"></div>
<div style="text-align:center;"> <img src="images/lgo1.jpg"  style="margin-left:60px;"/></div>
<p style="font-weight:bold; text-align:center; margin-top:5px;">PROGRAMWISE AND STUDENTWISE FEE DETAILS</p>
<p style="font-weight:bold; text-align:center; margin-top:5px; margin-bottom:10px;">PROGRAM : <?php echo $prname;?></p>
<table width="100%" border="1" cellspacing="0" cellpadding="0" >
	<tbody>
		<tr style="font-weight:bold; font-size:15px; text-align:left;">
			<th width="130" height="40"><label>Admission No.</label></th>
			<th width="130"><label>First Name</label></th>
			<th width="130"><div style="float:left;margin-left:10px;">Fee Payable (in</div>
			<div style="float:left;margin-left:2px;font-weight:bold;">
			<?php 
			if($pid !=2 && $pid != 4)
			{
			?>
				<img src="images/rs.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/>
			<?php
			}
			else
			{
			?><img src="images/dollar.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/><?php
			}
			?>)</div></th>
			<th width="130"><div style="float:left;margin-left:25px;">Fee Paid (in</div><div style="float:left;margin-left:2px;font-weight:bold;">
			<?php 
			if($pid !=2 && $pid != 4)
			{
			?>
				<img src="images/rs.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/>
			<?php
			}
			else
			{
				?><img src="images/dollar.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/><?php
			}
			?>)</div></th>
			<th width="130"><div style="float:left;margin-left:30px;">Balance(in</div><div style="float:left;margin-left:2px;font-weight:bold;">
			<?php 
			if($pid !=2 && $pid != 4)
			{
			?>
				<img src="images/rs.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/>
			<?php
			}
			else
			{
				?><img src="images/dollar.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/><?php
			}
			?>)</div></th>					
		</tr>
		<?php
			$studlist=selrpt2($pid,$ano);		
			foreach($studlist as $slist)
			{	
				$bal=$slist['payable']-$slist['paid'];
			?>
				<tr>
					<td><?php echo $slist['admissionno'];?></td>
					<td><?php echo $slist['firstname'];?></td>
					<td><?php echo $slist['payable'];?></td>
					<td><?php echo $slist['paid'];?></td>
					<td><?php echo $bal;?></td>												
				</tr>
			<?php
			}
			?>	
	</tbody>
</table>