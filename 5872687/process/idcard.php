<?php
include "function.php";
$pid='';$prname='';	$ano='';$doa='';$vdat='';
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
$dat=date('d-m-Y');	
$studlist=idcard($ano);		
foreach($studlist as $slist)
{	
	$prgname=selprogramname($slist['admittedfor']);
	foreach($prgname as $pgname)
	{	
		$prname=$pgname['programname'];
	}
	$dor=explode("-",$slist['dateofadmission']);
	if(count($dor)>0)
	{
		$yr=$dor[0];							
		$mn=$dor[1];
		$dt=$dor[2];
		$doa=$dt.'-'.$mn.'-'.$yr;
		if($slist['admittedfor']==3)
		{
			$mn=$mn+6;
			if($mn>12)
			{
				$mn=$mn-12;
				$yr=$yr+1;
				$vdat=$dt.'-'.$mn.'-'.$yr;
			}
			else
			{
				$vdat=$dt.'-'.$mn.'-'.$yr;
			}
		}
		else if($slist['admittedfor']==1 || $slist['admittedfor']==2 )
		{
			$mn=$mn+18;
			if($mn > 24)
			{
				$mn=$mn-24;
				$yr=$yr+2;
				$vdat=$dt.'-'.$mn.'-'.$yr;
			}			
			else if($mn > 12 && $mn <= 24)
			{
				$mn=$mn-12;
				$yr=$yr+1;
				$vdat=$dt.'-'.$mn.'-'.$yr;
			}
		}
		else
		{
			$vdat=$dt.'-'.$mn.'-'.$yr;
		}
	}
	if($slist['admittedfor']==1 || $slist['admittedfor']==2 || $slist['admittedfor']==3 )
	{
?>
<div id="card" class="card">
	<div id="head11" class="head11">
		<div class="logo_1"><img src="images/logo.jpg" width="60" height="25" /></div>
		<div class="head1">
			<div style="color:#0000FF;font-weight:bold; font-size:12px; text-align:center; font-style:normal;">RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES &amp; RESEARCH</div>
		<div style="text-align:center; font-family:Calibri; font-size:10px;">Affiliated to Brenau University,Georgia,USA.</div>
		</div>
		<div class="logo11">
			<img src="images/logo1.jpg" width="34" height="48" style="float:right; margin-top:0.03in;" />
		</div>
	</div>
	<div style="clear:both;"></div>
	<div id="cont1" class="cont1">
		<div id="con1" class="con1" style="float:left;">
			<div style="font-family: calibri;font-size: 12px;margin-left: 10px;margin-top: 10px;width: 100%; line-height: 25px;"><div style="width:28%;float:left;letter-spacing:1px;">Id No :</div><div style="width:70%;float:left;over-flow:hidden;letter-spacing:1px;"><?php echo $slist['admissionno'];?></div></div>
			<div style="font-family: calibri;font-size: 12px;margin-left: 10px;margin-top: 10px;width: 100%; line-height: 25px;"><div style="width:28%;float:left;letter-spacing:1px;">Name :</div><div style="width:70%;float:left;over-flow:hidden;letter-spacing:1px;"><?php echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></div></div>
			<div style="font-family: calibri;font-size: 12px;margin-left: 10px;margin-top: 10px;width: 100%; line-height: 25px;"><div style="width:28%;float:left;letter-spacing:1px;">Program :</div><div style="width:70%;float:left;over-flow:hidden;letter-spacing:1px;"><?php echo $prname;?></div></div>
		</div>
		<div id="con2" class="con2" style="width:">
			<?php
				if($slist['image']!='')
				{
					$path='../upload/studimage/'.$slist['image'];					
					if(file_exists($path))
					{
					?>
						<img src="<?php echo 'upload/studimage/'.$slist['image'];?>" style="height:70px;width:70px;"/>
					<?php						
					}
				}
				else
				{
					echo 'No image';
				}
			?>			
		</div>
		<div style="font-family: calibri;font-size: 12px;margin-left: 10px;margin-top: 10px;width: 100%; line-height: 18px;float:left;">
			<div style="width:50%;float:left;letter-spacing:1px;">Issued on : <?php echo $doa;?></div>
			<div style="width:50%;float:left;letter-spacing:1px;">Valid Upto: <?php echo $vdat;?></div>
		</div>	
		<div style="clear:both;"></div><br/><br/>
		<p style="float:right;margin-top:10px; font-family:Calibri; letter-spacing:1px; line-height:20px; font-size:12px; margin-bottom:5px; margin-right:0.03in;">Issuing Authority : Registrar</p>
	</div>
	<div style="clear:both;"></div>
	<div id="con3" class="con3">
		<div style="color:#ff0000;">This ID is issued by the Rangenkar Institute of Management Studies &amp; Research only for the purpose of identifying the bonafide student of RIMSR. This ID is not a substitute for any statutory purposes.</div>
		<div>Issued by: Registrar,  RIMSR, 716/ 35,  JC Plaza, II Floor, 12th Main, 42nd Cross, III Block, Rajajinagar, Bangalore-560010; Ph: 080-23409795, 080-23147407;<span style="color:#0066ff; text-decoration:underline;">www.rimsr.in;</span> registrar@rimsr.in</div>	
	</div>
</div>
<?php
}
else
{
	echo "<div style='margin-top:150px;margin-left:350px;'>ID Card Not Generated</div>";
}
}
?>
<style>
.card
{
	width:3.375in;
	height: auto;
	float:left;
	border:1px solid #0066FF;
	margin-top:75px;
	margin-left:275px;
}
.head11
{
width:100%;
height:auto;
background-color:#b9cde5;
border-bottom:1px solid #b9cde5;
float:left;
}
.logo_1
{
width:0.7in;
height:auto;
float:left;
margin-top:0.1in;
}
.head1
{
width:2in;
height:auto;
float:left;
}
.logo11
{
width:0in;
height:auto;
float:left;
margin-left:0.6in;
}
.cont1
{
width:100%;
height:auto;
float:left;
}
.con1
{
width:2.48in;
height:auto;
float:left;
}
.con2
{
width:0.7in;
height:0.7in;
float:left;
margin-top:15px;
float:right;
margin-right:5px;
}
.con3
{
font-size:10px;
width:100%;
height:auto;
letter-spacing:1px;
line-height:18px;
font-family:Calibri;
padding:0.04in;
}
</style>