<?php
include "function.php";
$pid='';$frm='';$to='';$frm1='';$to1='';
if(isset($_REQUEST['pid']))
{
	$pid=$_REQUEST['pid'];
}
if(isset($_REQUEST['frm']))
{
	$frm1=$_REQUEST['frm'];
	$datob=explode("-",$frm1);
	if(count($datob)>0)
	{
		$yr=$datob[2];							
		$mn=$datob[1];
		$dt=$datob[0];
		$frm=$yr.'-'.$mn.'-'.$dt;
	}	
}
if(isset($_REQUEST['to']))
{
	$to1=$_REQUEST['to'];
	$datob=explode("-",$to1);
	if(count($datob)>0)
	{
		$yr=$datob[2];							
		$mn=$datob[1];
		$dt=$datob[0];
		$to=$yr.'-'.$mn.'-'.$dt;
	}	
}
session_start();
if(isset($_SESSION['pid']))
{
	unset($_SESSION['pid']);
}
if(isset($_SESSION['frm']))
{
	unset($_SESSION['frm']);
}
if(isset($_SESSION['to']))
{
	unset($_SESSION['to']);
}
$_SESSION['pid']=$pid;
$_SESSION['frm']=$frm;
$_SESSION['to']=$to;
$prgname=selprogramname($pid);
foreach($prgname as $pgname)
{	
	$prname=$pgname['programname'];
}
$dat=date('d/m/Y');	
if($frm !="" && $to !='')
{
	$title="PROGRAMWISE LIST OF STUDENTS BETWEEN ".$frm1." TO ".$to1;
}
else
{
	$title="PROGRAMWISE LIST OF STUDENTS AS ON ".$dat;
}
?>
<div id="logo" class="logo" style="float:left;width:160px;margin-top:40px;"><img src="images/logo.jpg" /></div>
<!--<div style="float:right;margin-right:20px;"><img src="images/unilogo.jpeg" style="float:left;margin-top:30px;" /></div>-->
<div style="clear:both;"></div>
<div style="text-align:center;"> <img src="images/lgo1.jpg"  style="margin-left:60px;"/></div>
<p style="font-weight:bold; text-align:center; margin-top:5px;"><?php echo $title;?></p>
<p style="font-weight:bold; text-align:center; margin-top:5px; margin-bottom:10px;">PROGRAM : <?php echo $prname;?></p>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tbody>
		<tr style="font-weight:bold; font-size:15px; text-align:left;">
			<th width="130" height="40"><label>Admission No.</label></th>
			<th width="130"><label>Student Name</label></th>
			<th width="130"><label>Email Id</label></th>
			<th width="130"><label>Community</label></th>
			<th width="130"><label>Date of Admission</label></th>
			<th width="130"><label>Date of Completion</label></th>
		</tr>		
			<?php
			$doa='';$doc='';
			if($frm !='' && $to !='')
			{
				$studlist=seldwiserpt($pid,$frm,$to);
			}
			else
			{
				$studlist=selrpt1($pid);
			}			
			foreach($studlist as $slist)
			{
				$datob=explode("-",$slist['dateofadmission']);
				if(count($datob)>0)
				{
					$yr=$datob[0];							
					$mn=$datob[1];
					$dt=$datob[2];
					$doa=$dt.'-'.$mn.'-'.$yr;
				}
				$dofi=explode("-",$slist['dateofcompletion']);
				if(count($dofi)>0)
				{
					$yr=$dofi[0];							
					$mn=$dofi[1];
					$dt=$dofi[2];
					$doc=$dt.'-'.$mn.'-'.$yr;
				}	
			?>
				<tr>
					<td><?php echo $slist['admissionno'];?></td>
					<td><?php echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></td>
					<td><?php echo $slist['emailid'];?></td>
					<td><?php echo $slist['community'];?></td>
					<td><?php echo $doa;?></td>
					<td><?php echo $doc;?></td>					
				</tr>
			<?php
			}
			?>	
	</tbody>
</table>