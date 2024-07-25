<?php
include "function.php";
$ano='';
if(isset($_REQUEST['ano']))
{
	$ano=$_REQUEST['ano'];
}
$dat=date('d-m-Y');
$studlist=welcomeletter($ano);		
foreach($studlist as $slist)
{
?>
	<div  id="wl" style="width:840px;height:auto;float:left;margin-top:150px;">
		<div style="width:100%;float:left;margin-left:3px;">
			<div style="float:left; width:540px;">
				<span style="font-family:Calibri; font-size:18px; padding-left:6px;">Ref: RIMSR/PGDPM/</span><br/><br/>
				<span style="font-family:Calibri; font-size:18px;padding-left:6px;"><?php if($slist['gender']=="Male"){echo 'Mr. ';}else{echo 'Ms. ';} echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></span>
				<br/><span style="font-family:Calibri; font-size:18px;padding-left:6px;"><?php echo $slist['postaladdress'];?></span>
				<br/><span style="font-family:Calibri; font-size:18px;padding-left:6px;"><?php echo $slist['postalcity'];?></span>
				<br/><span style="font-family:Calibri; font-size:18px;padding-left:6px;"><?php echo $slist['postalstate'];?></span>
				<br/><span style="font-family:Calibri; font-size:18px;padding-left:6px;"><?php echo $slist['postalpin'];?></span>
			</div>
			<div style="float:right; width:145px;">
				<span style="font-family:Calibri; font-size:18px;">Date : <?php echo $dat;?></span>					
			</div>	
		</div>
		<div style="clear:both;"></div><br/><br/>
		<div style="float:left; width:100%;margin-left:5px;">
		<span>Dear <?php echo $slist['firstname'];?></span><br/><br/>
		<span><strong>SUBJECT: ADMISSION TO PGDPM - Your Student ID: <?php echo $slist['admissionno'];?></strong></span><br/><br/>
		<span>Congratulations!</span><br/><br/>
		<span>RIMSR has great pleasure in inviting you to the student community of Brenau University. Your admission to the Post-Graduate Diploma in Project Management of RIMSR/ Brenau University is indeed a matter to be proud of, considering the stringent admission standards of the University.</span><br/><br/>
		<span>The program that you are about to take is on E-Platform. It is an extremely useful program that adds value to your scholastic accomplishments. It is a "career-multiplier;" providing you with the capacities to handle projects of any size professionally, and with confidence. The program transforms you as a 'Project-cum-Functional Manager,' thus making you an Effective Manager, and a class-apart from other mediocre managers. </span><br/><br/>
		<span>You will be provided with the Login ID, and Password to enter the 'Gateway to PGDPM,' on the official website of RIMSR www.rimsr.in. Once you enter the gateway, you can access the tutorials, reference books, webcasts, and case studies.  As the program is on a virtual platform your assignments, tests, and examination are screen-based. From time to time you will get specific and detailed instructions on the procedure to proceed ahead of the program.  You would also be let known of the 'Mentor' assigned to you, and his particulars, who would successfully guide you through the program. </span><br/><br/>
		<span>I can assure you that it is a great learning experience that would transform you, and implant you with agile project management skills. 
		<br/><br/>
		With Best Wishes,</span><br/>
		<div style="float:right">
		<span>Truly Yours,</span><br/><br/><br/>
		<span>Dr. S S Chandrashekar<br/>
		DIRECTOR<br/><br/></span>
		</div>	
		</div> 	
		</div>
	</div>
<?php
}
?>	
<style>
#wl span{font-family:Calibri; font-size:18px;}
</style>