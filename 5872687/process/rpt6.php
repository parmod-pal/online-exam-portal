<?php
include "function.php";
	$pid='';$r='';$prname='';
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
	if(isset($_REQUEST['r']))
	{
		$r=strtoupper($_REQUEST['r']);
	}
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
<p style="font-weight:bold; text-align:center; margin-top:5px;">PROGRAMWISE LIST OF STUDENTS TO WHOM CERTIFICATES ARE ISSUED</p>
<p style="font-weight:bold; text-align:center; margin-top:5px; margin-bottom:10px;">PROGRAM : <?php echo $prname;?></p>
<table width="100%" border="1" cellspacing="0" cellpadding="0" >
	<tbody>
		<tr style="font-weight:bold; font-size:15px; text-align:left;">
			<th width="130" height="40"><label>Admission No.</label></th>
			<th width="190"><label>First Name</label></th>			
			<th width="130"><label>Date of Issue</label></th>									
		</tr>
		<?php	
			$doi='';
			$studlist=selrpt6($pid);			
			foreach($studlist as $slist)
			{	
				$datob=explode("-",$slist['certificateissuedon']);
				if(count($datob)>0)
				{
					$yr=$datob[0];							
					$mn=$datob[1];
					$dt=$datob[2];
					$doi=$dt.'-'.$mn.'-'.$yr;
				}				
			?>
				<tr>
					<td><?php echo $slist['admissionno'];?></td>
					<td><?php echo $slist['firstname'];?></td>
					<td><?php echo $doi;?></td>											
				</tr>
			<?php
			}
			?>	
	</tbody>
</table>