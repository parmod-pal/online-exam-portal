<?php
include "function.php";
$pid='';$prname='';	
$ano='';$rcno=0;
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
if(isset($_REQUEST['rno']))
{
	$rcno=$_REQUEST['rno'];
}
if($rcno==0)
{
	$link=open_database_connection();
	$sql = "select max(receiptno) as rcno from receipt";	
	$result=mysql_query($sql,$link);
	if($result>0)
	{
		if(mysql_num_rows($result)>0)
		{
			while($data=mysql_fetch_array($result))
			{
				$rcno=$data['rcno'];
			}
		}
	}
	close_database_connection($link);
	$dat=date('d-m-Y');	
	$rcno++;
	$studlist=selrpt2($pid,$ano);
}
else
{
	session_start();
	$_SESSION['rep']='reprint';
	$studlist=selreceipt($rcno);
	foreach($studlist as $slist)
	{
		$datob=explode("-",$slist['dateofpay']);
		if(count($datob)>0)
		{
			$yr=$datob[0];							
			$mn=$datob[1];
			$dt=$datob[2];
			$dat=$dt.'-'.$mn.'-'.$yr;
		}	
	}
	
}		
foreach($studlist as $slist)
{	
	$prgname=selprogramname($slist['programid']);
	foreach($prgname as $pgname)
	{	
		$prname=$pgname['programname'];
	}
	$bal=$slist['payable']-$slist['paid'];
	
?>
<style>
	td label{color:#000;}
</style>
<div style="background-image:url(http://rimsr.in/5872687/images/rptlogo.png);background-repeat:no-repeat;background-position:center;background-size:300px 535px;">
<div class="logo1" style="width:160px;float:left;"><img src="images/logo.jpg" /></div>
<div class="head1" style="width:845px;">
<p style="color:#0000FF; font-weight:bold; font-size:28px; text-align:center; margin-top:20px;">RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES &amp; RESEARCH</p>
</div>
<div style="clear:both;"></div>
<br/>
<p style="text-align:center; font-size:20px; font-family:Calibri; font-weight:bold;color:#000;">RECEIPT</p><br/>
<div style="float:left; margin-left:20px; width:350px;color:#000;"><p style="color:#000;">Receipt No :<?php echo $rcno;?></p></div>
<div style="float:right; width:150px;color:#000;"><p style="color:#000;">Date :<?php echo $dat;?></p></div>
<div style="clear:both;"></div>
<div style="margin-top:30px;margin-left:20px; line-height:25px; letter-spacing:1px; font-family:Calibri; font-weight:bold;font-size:17px;">
This is to acknowledge the receipt of the fee towards the program <?php echo $prname;?> from <?php if($slist['gender']=="Male"){echo 'Mr. ';}else{echo 'Ms. ';} echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?>. The particulars of the fee remitted are as under:
</div>
<div style="clear:both;"></div>
<div style="margin-top:40px;">
<table width="540" style="text-align:left; margin-left:20px;background-color:transparent !important">
	<tr>
		<td><label>1. Program</label></td>
		<td><label><?php echo $prname;?></label></td>
	</tr>
	<tr>
	<td ><label>2. Total Fee payable </label></td>
	<td><label>
	<?php 
	if($slist['programid'] !=2 && $slist['programid'] != 4)
	{
	?>
		<img src="images/rs.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/>
	<?php
	}
	else
	{
		?><img src="images/dollar.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/><?php
	}
	echo $slist['payable'];?></label></td></tr>
	<tr>
	<td><label>3. Fee paid on <?php echo $dat;?></label></td>
	<td><label>
	<?php 
	if($slist['programid'] !=2 && $slist['programid'] != 4)
	{
	?>
		<img src="images/rs.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/>
	<?php
	}
	else
	{
		?><img src="images/dollar.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/><?php
	}
	echo $slist['paid'];?></label></td></tr>
	<tr>
	<td><label>4. Balance fee Payable</label></td>
	<td><label>
	<?php 
	if($slist['programid'] !=2 && $slist['programid'] != 4)
	{
	?>
		<img src="images/rs.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/>
	<?php
	}
	else
	{
		?><img src="images/dollar.png" width="12" height="12" border="0" style="float:left;margin-top:5px;"/><?php
	}
	echo $bal;?></label></td>
	</tr>
</table>
<p style="float:right; font-family:Calibri; font-size:20px;margin-right:20px;margin-top:30px;  font-weight:bold;color:#000;">Controller<br/>RIMSR</p>	
<div style="clear:both;"></div>
<div style="text-align:right; font-family:Calibri; font-size:18px;margin-right:20px;margin-top:30px;font-weight:normal;color:#FF0000;">This is a computer generated receipt. Signature is not required.</div>
</div>
</div>
<?php
}
?>	