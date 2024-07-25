<?php
include "function.php";
$dat=date('d-m-Y');	$pid='';$pvno='';$rep=0;
$prgname=selprogramname($pid);
foreach($prgname as $pgname)
{	
	$prname=$pgname['programname'];
}	
$ano='';$prgname='';
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
if(isset($_REQUEST['rep']))
{
	$rep=$_REQUEST['rep'];
}
if($rep==0)
{
	$link=open_database_connection();
	$sql = "select max(id) as id from provisional";	
	$result=mysql_query($sql,$link);
	if($result>0)
	{
		if(mysql_num_rows($result)>0)
		{
			while($data=mysql_fetch_array($result))
			{
				$pvno=$data['id'];
			}
		}
	}
	close_database_connection($link);
	$dat=date('d-m-Y');	
	$pvno++;
}
else
{
	session_start();
	$_SESSION['rep']='reprintprov';
	$studlis=selprov($ano);
	foreach($studlis as $slis)
	{
		$pvno=$slis['id'];
	}
}		
$len=strlen($pvno);
if($len<4)
{
	$pvno='00'.$pvno;
}
else if($len ==4)
{
	$pvno='0'.$pvno;
}
else
{
	$pvno=$pvno;
}
?>
<style>
td,tr
{
height:22px;color:#000;
}
th{color:#0163BC;}
.wra2
{
width:800px;
height:auto;
float:left;
margin-top:5px;
margin-left:33px;
border:5px double #000000;
padding-bottom:40px;
}
</style>
<div style="background-image:url(http://rimsr.in/5872687/images/rptlogo.png);background-repeat:no-repeat;background-position:center;background-size:300px 535px;height:600px;">
	<div class="logo1" style="padding:20px;width:60px;height:auto;float:left;font-family:Cambria;">
		<img src="images/logo1.jpg"  style=" margin-top:10px;" />
	</div>
	<div class="head1" style="float:left;width:625px;height:auto;text-align:center;margin-top:40px;">
		<span style="color:#c00000; text-align:center;  font-weight:bold; font-size:37px;font-family:Cambria;text-shadow:1px 1px #000000;">BRENAU UNIVERSITY,GEORGIA, USA</span>
	</div>
	<div class="logo12" style="float:left;">
		<img src="images/logo.jpg" width="100" height="40" style="float:right; margin-top:55px; margin-right:20px;" />
	</div>	
	<div style="color:#0000FF;width:735px;text-align:center;font-weight:bold; font-size:29px;font-family:Cambria;line-height:40px;">RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES &amp; RESEARCH,BANGALORE,INDIA</div>
<div style="clear:both;"></div>
<div style="float:right;"> <p style="font-family:Calibri; font-size:20px; font-weight:bold;color:#000;padding-right:10px;">No.<?php echo $pvno;?></p></div>
<div style="margin-top:20px;">
<h3 style="font-family:Calibri; font-size:24px; font-weight:bold; text-align:center;">PROVISIONAL CERTIFICATE </h3>
<?php
	$doe='';$result='';
	$studlist=createmarksheet($ano);		
	foreach($studlist as $slist)
	{	
		$datob=explode("-",$slist['examdate']);
		if(count($datob)>0)
		{
			$yr=$datob[0];							
			$mn=$datob[1];
			$dt=$datob[2];
			$doe=$dt.'-'.$mn.'-'.$yr;
		}	
		if($slist['totalmark'] >=80)
		{
			$result="<font color='#1626f3' size='2'>DISTINCTION</font>";
		}
		else 
		{
			$result="<font color='#009130' size='2'>PASS</font>";
		}	
		
	?>
<div class="provisional" style="color: #0000FF !important; font-family: Cambria; font-size: 16px; font-style: italic; height: auto;letter-spacing: 1px;line-height: 27px;margin-left: 35px;margin-top: 30px;font-weight:bold;">This is to certify that <?php if($slist['gender']=="Male"){echo 'Mr.';}else{echo 'Ms.';}?> <font style="text-decoration:underline;color:#000;"><?php echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></font> has successfully completed the Post-Graduate Diploma in Project Management by passing the prescribed examination held by Brenau University at RIMSR on <font style="text-decoration:underline;color:#000;"><?php echo $doe;?></font> with <font style="text-decoration:underline;color:#000;"><?php echo $result;?></font> class. <?php if($slist['gender']=="Male"){echo 'He';}else{echo 'She';}?> is eligible for 100 PDUs, and to take the PMI Examinations (subject to eligibility) upon the issuance of due Certification thereof by Brenau University, #500, Washington Street, SE, Gainesville, Georgia 30501,  USA.<br/><br/>
The Certificate of Completion of PGDPM will be issued to <?php if($slist['gender']=="Male"){echo 'him';}else{echo 'her';}?> by Brenau University in due course.<br/><br/>
Issued Under the Official Seal of RIMSR, on <font style="text-decoration:underline;color:#000;"><?php echo $dat;?></font> at Bangalore.</p>
</div>
<div style="float:left; margin-top:60px; margin-left:30px; ">
<p><img alt="barcode" src="process/barcode.php?text=<?php echo $slist['admissionno'];?>" /></p></div>
<div style="float:right; margin-top:60px; ">
<p style="font-family:Cambria; font-size:20px; font-weight:bold;font-style:italic;letter-spacing:1px;color:#000;">DIRECTOR<br/>RIMSR</p>
</div>	
<?php
	}
?>
</div>