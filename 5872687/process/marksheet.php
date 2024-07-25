<?php
include "function.php";
$pid='';$prname='';	
$ano='';
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
$dat=date('d-m-Y');	
?>
<style>
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
.head1
{
float:left;
width:565px;
height:auto;
font-family:Cambria;
}
.logo1
{
height:auto;
float:left;
font-family:Cambria;
}
</style>
<div class="wra2" style="background-image:url(http://rimsr.in/5872687/images/rptlogo.png);background-repeat:no-repeat;background-position:center;background-size:300px 535px;">
	<div class="logo12" style="padding:20px;margin-top:25px;height:auto;float:left;font-family:Cambria;">
		<img src="images/logo.jpg" width="100" height="40"/>
	</div>
	<div class="head1">
		<P style="color: #C00000; font-size: 36px; font-weight: bold;letter-spacing: 1px;margin-top: 40px;text-align: center;text-shadow: 1px 1px #000000;margin-bottom:20px;">BRENAU UNIVERSITY</P>
		<p style="color:#0000FF; font-weight:bold; font-size:28px; text-align:center;">RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES &amp; RESEARCH</p>
	</div>
	<div class="logo1">
		<img src="images/logo1.jpg"  style="float:right; margin-top:40px; margin-right:20px;" />
	</div>
	<div style="clear:both;"></div>
	<div style="margin-top:30px; text-align:center;border:1px solid #000000; margin-left:3px;width:790px;">
		<p style="color:#CC0000; font-family:Calibri; font-size:27px; padding-left:6px;">POST-GRADUATE CERTIFICATE PROGRAM IN PROJECT MANAGEMENT</p>
		<p style="color:#CC0000; font-family:Calibri; font-size:23px;">Marks Sheet</p>
	</div>
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
			$result="<font color='#1626f3'>PASSED WITH DISTINCTION</font>";
		}
		else if($slist['totalmark'] >=60 && $slist['totalmark'] < 80)
		{
			$result="<font color='#009130'>PASS</font>";
		}	
		else
		{
			$result="<font color='#F70938'>FAIL</font>";
		}	
	?>
	<div style="border:1px solid #000000;border-top:0px; margin-left:3px;width:790px;height:80px;float:left;">
		<div style="float:left; width:500px;">
			<p style="font-family:Calibri; font-size:18px; padding-left:6px;">Student Id : <?php echo $slist['admissionno'];?></p>
			<p style="font-family:Calibri; font-size:18px;padding-left:6px;">Name : <?php if($slist['gender']=="Male"){echo 'Mr. ';}else{echo 'Ms. ';} echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></p>
		</div>
		<div style="float:right; width:280px;">
			<p style="font-family:Calibri; font-size:18px;">Date of Examination : <?php echo $doe;?></p>
			<p><img alt="barcode" src="process/barcode.php?text=<?php echo $slist['admissionno'];?>" style="float:left;" /></p>			
		</div>
	</div>
	<div style="border:1px solid #000000;border-top:0px; margin-left:3px;width:790px;height:60px;float:left;">
		<div style="float:left; width:130px;height:60px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;">
			<span style="font-family:Calibri; font-size:22px; padding-left:6px;line-height:60px;">SI.No.</p>			
		</div>		
		<div style="float:left; width:387px;height:60px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;">
			<span style="font-family:Calibri; font-size:22px;line-height:60px;">Course</p>		
		</div>		
		<div style="float:left; width:140px;height:60px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;">
			<span style="font-family:Calibri; font-size:22px;">Marks Obtained</p>		
		</div>		
		<div style="float:left; width:130px;height:60px;text-align:center;border-bottom:1px solid #000;">
			<span style="font-family:Calibri; font-size:22px;line-height:60px;">Weightage</p>		
		</div>		
	</div>
	<div style="border:1px solid #000000;border-top:0px; margin-left:3px;width:790px;height:130px;float:left;">
		<div style="float:left; width:130px;height:30px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px; padding-left:6px;line-height:30px;font-weight:normal !important;">I</p>			
		</div>		
		<div style="float:left; width:387px;height:30px;text-align:left;border-right:1px solid #000;">
			<p style="font-family:Calibri;padding-left:5px; font-size:18px;line-height:30px;font-weight:normal !important;">Assignment</p>		
		</div>		
		<div style="float:left; width:140px;height:30px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;"><?php echo $slist['assignment'];?></p>		
		</div>		
		<div style="float:left; width:130px;height:30px;text-align:center;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;">10</p>		
		</div>
		<div style="float:left; width:130px;height:30px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px; padding-left:6px;line-height:30px;font-weight:normal !important;">II</p>			
		</div>		
		<div style="float:left; width:387px;height:30px;text-align:left;border-right:1px solid #000;">
			<p style="font-family:Calibri;padding-left:5px; font-size:18px;line-height:30px;font-weight:normal !important;">Case Studies</p>		
		</div>		
		<div style="float:left; width:140px;height:30px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;"><?php echo $slist['casestudies'];?></p>		
		</div>		
		<div style="float:left; width:130px;height:30px;text-align:center;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;">10</p>		
		</div>
		<div style="float:left; width:130px;height:30px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px; padding-left:6px;line-height:30px;font-weight:normal !important;">III</p>			
		</div>		
		<div style="float:left; width:387px;height:30px;text-align:left;border-right:1px solid #000;">
			<p style="font-family:Calibri;padding-left:5px; font-size:18px;line-height:30px;font-weight:normal !important;">Tests</p>		
		</div>		
		<div style="float:left; width:140px;height:30px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;"><?php echo $slist['testmark'];?></p>		
		</div>		
		<div style="float:left; width:130px;height:30px;text-align:center;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;">10</p>		
		</div>	
		<div style="float:left; width:130px;height:40px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px; padding-left:6px;line-height:30px;font-weight:normal !important;">IV</p>			
		</div>		
		<div style="float:left; width:387px;height:40px;text-align:left;border-right:1px solid #000;">
			<p style="font-family:Calibri;padding-left:5px; font-size:18px;line-height:30px;font-weight:normal !important;">Examination</p>		
		</div>		
		<div style="float:left; width:140px;height:40px;text-align:center;border-right:1px solid #000;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;"><?php echo $slist['exam'];?></p>		
		</div>		
		<div style="float:left; width:130px;height:40px;text-align:center;">
			<p style="font-family:Calibri; font-size:18px;line-height:30px;font-weight:normal !important;">70</p>		
		</div>	
	</div>
	<div style="border:1px solid #000000;border-top:0px; margin-left:3px;width:790px;height:80px;float:left;">
		<div style="float:left; width:518px;height:40px;text-align:right;border-right:1px solid #000;">
			<span style="font-family:Calibri; font-size:22px; padding-right:5px;line-height:40px;">Total Marks :</span>			
		</div>		
		<div style="float:left; width:140px;height:40px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;">
			<span style="font-family:Calibri; font-size:18px;line-height:40px;font-weight:normal !important;"><?php echo $slist['totalmark'];?></span>		
		</div>		
		<div style="float:left; width:130px;height:40px;text-align:center;border-bottom:1px solid #000;">
			<span style="font-family:Calibri; font-size:18px;line-height:40px;font-weight:normal !important;">100</span>		
		</div>
		<div style="float:left; width:518px;height:40px;text-align:right;border-right:1px solid #000;">
			<span style="font-family:Calibri; font-size:22px; padding-right:5px;line-height:40px;">Average % of Marks</span>			
		</div>		
		<div style="float:left; width:140px;height:40px;text-align:center;border-right:1px solid #000;">
			<span style="font-family:Calibri; font-size:18px;line-height:40px;font-weight:normal !important;"><?php echo $slist['totalmark'];?></span>		
		</div>		
		<div style="float:left; width:130px;height:40px;text-align:center;">
			<span style="font-family:Calibri; font-size:18px;line-height:40px;font-weight:normal !important;">100</span>		
		</div>				
	</div>
	<div style="border:1px solid #000000;border-top:0px; margin-left:3px;width:790px;height:40px;float:left;">
		<div style="float:left; width:518px;height:40px;text-align:right;border-right:1px solid #000;">
			<span style="font-family:Calibri; font-size:22px; padding-right:5px;line-height:40px;">Final Result :</span>			
		</div>
		<div style="float:left; width:270px;height:40px;text-align:center;border-bottom:1px solid #000;">
			<span style="font-family:Calibri; font-size:18px;line-height:40px;font-weight:bold !important;"><?php echo $result;?></span>		
		</div>				
	</div>
	<div style="border:1px solid #000000;border-top:0px;border-bottom:0px; margin-left:3px;width:790px;height:90px;text-align:left;float:left;">		
		<?php
			if($slist['image']!='')
			{
				$path='../upload/studimage/'.$slist['image'];					
				if(file_exists($path))
				{
				?>
					<img src="<?php echo 'upload/studimage/'.$slist['image'];?>" style="height:90px;width:90px;margin-top:10px;margin-left:5px;" /><br/>
					<span style="font-size:12px; font-weight:normal;padding-left:5px;"><?php echo  $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></span>
				<?php						
				}
			}				
		?>	
	</div>	
	<div style="border:1px solid #000000;border-top:0px;margin-left:3px;width:790px;height:95px;float:left;">
		<div style="float:left; width:550px;text-align:left;margin-top:45px;margin-left:3px">
			<span style="font-family:Calibri; font-size:20px; padding-right:5px;line-height:20px;font-weight:normal !important;">Date of Issue :<?php echo $dat;?></span><br/>
			<span style="font-family:Calibri; font-size:20px; padding-right:5px;line-height:25px;font-weight:normal !important;">Place :<?php echo 'Bangalore';?></span>			
		</div>
		<div style="float:left; width:180px;text-align:left;margin-top:22px;">
			<div style="width:100px;"><span style="font-family:Calibri; font-size:20px;">REGISTRAR</span>
			<span style="font-family:Calibri; font-size:20px;">RIMSR</span></div>
			<span style="font-family:Calibri; font-size:20px;">Authorized Signatory</span>		
		</div>			
	</div>	
	<?php
	}
	?>
<p style="font-family:Calibri; padding:10px;line-height:60px; font-size:18px;font-weight:normal !important;">This Marks Sheet is issued under the official seal of RIMSR, Bangalore.</p>
</div>