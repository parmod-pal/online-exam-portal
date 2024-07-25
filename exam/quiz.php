<?php 
session_start();
include "config.php";
if(!isset($_SESSION['usrid']))
{
	header('location:index.php');
	exit; 
}
$id='';$usrid='';$title="RIMSR: Online Exam";
date_default_timezone_set('Asia/Calcutta');
$date=date('Y-m-d');
$time=date('H:i a');
$tot=0;$status='';$curquiz=0;$quizid='';$title='';$qudesc='';$duration=0;$totques=0;
$typ='';$i=0;$etime='00:00';
$cate='';$sid=$scode=$pcode='';
if(isset($_SESSION['usrid']))
{
	$sid=$_SESSION['usrid'];
}
/* if ($my->id) {
$sid=$my->id;
} */
if(isset($_SESSION['sc']))
{
	$scode=$_SESSION['sc'];
}
if(isset($_SESSION['pc']))
{
	$pcode=$_SESSION['pc'];
}
if(isset($_SESSION['t']))
{
	$typ=$_SESSION['t'];
}

/**** Test code *****/
/* $pcode='BCPPM';
$scode='BCPPM-01';
$typ='Test'; */
/*********************/

if($typ=='Test')
{
	$title="RIMSR : Online Test";
}


$sdate=date('d-m-Y');
$query1 = "SELECT * FROM rim_quizmain where Startdate='".$date."' and Category='".$pcode."' and Title='".$scode."' and Etype='".$typ."' order by Id desc limit 0,1";

$result = mysqli_query($conn,$query1);
if(mysqli_num_rows($result)>0)
{
	while ($data = mysqli_fetch_assoc($result))
	{
		
		$Id=$data['Id'];
		$Name=$data['Title'];	
		$Name=str_replace("^","'",$Name);
		$desc=$data['Description'];
		$desc=str_replace("^","'",$desc);	
		$duration=$data['Duration'];
		$stime=$data['Starttime'];
		$h=substr($stime,0,2);
		$m=substr($stime,3,2);
		if($h<12)
		{
			$stime=$stime.'&nbsp; AM';
		}
		else
		{
			$h=$h-12;
			if($h==0)
			{
				$h=12;												
			}
			$stime=$h.':'.$m.'&nbsp; PM';
		}
		$etime=$data['Endtime'];
		$eh=substr($etime,0,2);
		$em=substr($etime,3,2);
		if($eh<12)
		{
			$etime=$etime.'&nbsp; AM';
		}
		else
		{
			$eh=$eh-12;
			if($eh==0)
			{
				$eh=12;												
			}
			$etime=$eh.':'.$em.'&nbsp; PM';
		}
		$datetime=$data['Startdate'].'&nbsp;,'.$stime;	
		$sold=$data['Startdate'];$quizid='';
		if(($data['Starttime'] == $time || $data['Starttime'] < $time) && $data['Endtime'] > $time)
		{
			$curquiz=1;			
			$quizid=$data['Id'];
			$etime=$data['Endtime'];
		}
		else
		{
			/* include 'index.php';
			exit; */
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!--<link rel="shortcut icon" href="images/logoicon.png"/>-->
    <title><?php echo $title;?></title>    
	<link type="text/css" href="css/addmovie.css" rel="stylesheet"/>
	<link type="text/css" href="css/kinder.css" rel="stylesheet"/>	
<script type="text/javascript" src="js/jquery.js"></script>    
<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>	
<script type="text/javascript">
function frmsubmit()
{	
	document.quiz.submit();
}
function AutoRefresh()
{	
	var etime=document.getElementById("etime").value;
	var qid=document.getElementById("quizid").value;
	var sid=document.getElementById("suserid").value;
	var typ=document.getElementById("typ").value;
	var totques=document.getElementById("totques").value;
	var time=new Date();
	var hr=time.getHours();
	var min=time.getMinutes();
	if (min < 10){
		min = "0" + min;
	}
	if (hr < 10){
		hr = "0" + hr;
	}
	var curtime=hr+":"+min;
	
	if(etime > curtime)
	{
		//alert(etime+","+curtime);
		setTimeout('AutoRefresh()',3000);
	}
	else
	{
		//alert("time up");
		var chk=1;
		var tques=document.getElementById('totques').value;
		for(var i=1;i<tques;i++)
		{
			if(document.getElementById('uans'+i).value=="")
			{
				chk++;
			}
		}		
		if(chk < tques)
		{
			frmsubmit();
		}
		else
		{
			/* window.location="http://www.rimsr.in"; */
		}
		/* if(totques>0)
		{
			frmsubmit();	
		}	 */	
	}
}
function doConfirm(msg, yesFn, noFn) {
	var confirmBox = $("#confirmBox");
	confirmBox.find(".message").text(msg);
	confirmBox.find(".yes,.no").unbind().click(function () {
		confirmBox.hide();
	});
	confirmBox.find(".yes").click(yesFn);
	confirmBox.find(".no").click(noFn);
	confirmBox.show();
}

$(document).ready(function(){
	//AutoRefresh();
	
	$('.quizplayer').on('click','#cls',function(){
		window.location="logout.php";
	});
	
});

$(function () {		
	$("form").submit(function (e) {	
		e.preventDefault();
		var form = this;	
		var chk=1;
		var tques=document.getElementById('totques').value;
		for(var i=1;i<tques;i++)
		{
			if(document.getElementById('uans'+i).value=="")
			{
				chk++;
			}
		}				
		if(chk == tques)
		{			
			doConfirm("Are you sure the test/exam paper can be submitted?", function yes() {			
				form.submit();
			}, function no() {
				// do nothing
			});
		}
		else
		{
			doConfirm("Are you sure the test/exam paper can be submitted?", function yes() {			
				form.submit();
			}, function no() {
				// do nothing
			});
		}		
	});
});
var ctmnts = 0;
var ctsecs = 0;
var startchr = 0;       
var totalSec = 72;
var increment = 0;
var point = 200;
var calPoints = 0;
var changeQue = "false";
var nextRound = "false";

function countdownTimer() {	
	/* increment++;
	changeQue = $('.changeQue').val();
	nextRound = $('.nextRound').val();
	if(increment == 1 || changeQue == "true")
	{
		increment = 1;
		point = 200;
		$('.changeQue').val('false');
	}
	calPoints = point-Math.ceil((increment/totalSec)*100); */
	if((startchr == 0 && document.getElementById('mns') && document.getElementById('scs'))) 
	{
		ctmnts = parseInt(document.getElementById('mns').value) + 0;
		ctsecs = parseInt(document.getElementById('scs').value) * 1
		if(isNaN(ctmnts)) ctmnts = 0;
		if(isNaN(ctsecs)) ctsecs = 0;
		document.getElementById('mns').value = ctmnts;
		document.getElementById('scs').value = ctsecs;
		startchr = 1;
		//$('.nextRound').val('false');
	} 
	if(ctmnts <= 10) 
	{ 	
		if(chk == 1)
		{
			$(".timertext").css("color","red");
		}
		var s=document.getElementById('rt');
		s.style.visibility=(s.style.visibility=='visible') ?'hidden':'visible';
	}
  
	if(ctmnts==0 && ctsecs==0) {
		startchr = 0;	
		var chk=document.getElementById('status').value;	
		if(chk == 1)
		{
			alert("Time Up");
		}
		if('<?php echo $curquiz;?>'==1)
		{
			frmsubmit(); 
		}
		/* window.location="http://www.rimsr.in/";	 */
  }
  else {    
    ctsecs--;
    if(ctsecs < 0) {
      if(ctmnts > 0) {
        ctsecs = 59;
        ctmnts--;
      }
      else {
        ctsecs = 0;
        ctmnts = 0;
      }
    }
  }
  
  $('.showmns:visible').text(ctmnts);
  $('.showscs:visible').text(ctsecs);
  document.getElementById('mns').value=ctmnts;
  document.getElementById('scs').value=ctsecs;
  setTimeout('countdownTimer()', 1000);
  
}
</script>
<style type="text/css">
<!--
.newslistwrapper {
	background-color: #FFF;
	height: auto;
	width: 994px;
	margin-top: 0px;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
	padding-left: 15px;
	padding-right: 15px;
	border-bottom-left-radius:.5em;
	border-bottom-right-radius:.5em;
}
.quizplayer {
	float: left;
	height: auto;
	width: 100%;
}
.quizbanner_wrapper {
	float: left;
	height: 200px;
	width: 82%;
	background-color: #FFF;
}
.quizbanner {
	height: 200px;
	width: 82%;
	margin-left: 25px;
}

.round_timesection {
	float: left;
	height: 50px;
	width: 88%;
	background-repeat: repeat-x;
	background-image: url(http://www.rimsr.in/images2/quizheadbg.jpg);
	border-top-left-radius:.5em;
	border-top-right-radius:.5em;
}
.question_section {
	float: left;
	height: 575px;
	width: 88%;
	background-color: #d4ebfa;
	border: 1px solid #09F;
	border-bottom-left-radius:.5em;
	border-bottom-right-radius:.5em;
	overflow:scroll;
	overflow-x: hidden;	
}
.roundlines {
	float: left;
	height: 15px;
	width: 200px;
	margin-top: 6px;
	margin-left: 10px;
	font-family: Arial;
	font-size: 12px;
	font-weight: normal;
	color: #FFF;
}
.directions {
	float: right;
	height: 15px;
	width: 55px;
	margin-top: 6px;
	margin-right: 10px;
	font-family: Arial;
	font-size: 12px;
	font-weight: normal;
	color: #FFF;
	text-decoration: underline;
}
.totalquestions {
	float: left;
	height: 15px;
	width: 150px;
	margin-top: 7px;
	margin-left: 10px;
	font-family: Arial;
	font-size: 12px;
	font-weight: normal;
	color: #FFF;
}
.timer {
	float: right;
	height: 15px;
	width: 120px;
	margin-top: 6px;
	margin-right: 10px;
}
.timertext {
	float: left;
	height: 15px;
	width: 80px;
	font-family: Arial;
	font-size: 12px;
	font-weight: normal;
	color: #FFF;
}
.time {
	float: right;
	height: 15px;
	width: 35px;
	font-family: Arial;
	font-size: 12px;
	font-weight: normal;
	color: #FFF;
}
.question_1_wrapper {
	float: left;
	height: auto;
	width: 740px;
}
.question_no {
	float: left;
	height: 20px;
	min-width: 20px;
	margin-top: 10px;
	margin-left: 10px;
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #900;
}
.question {
	float: left;
	height: auto;
	margin-top: 10px;
	margin-left: 5px;
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #333;
	width: 640px;
}


.counter {
	float: right;
	height: 20px;
	width: 40px;
}
.answeres {
	float: left;
	height: auto;
	width: 740px;
	margin-left: 35px;
	margin-top: 5px;
}
.answers a{	
	float: left;
	height: auto;
	width: 690px;
	padding-top: 3px;
	padding-left: 10px;
	font-family: Arial;
	font-size: 14px;
	font-weight:normal;
	color: #FFF;
	margin-top: 5px;
	background-color:#457ea0;
	text-decoration:none;
	}
.checkbox {
	float: left;
	height: 20px;
	width: 20px;
	margin-top: 5px;
}
.answers a:hover{text-decoration:none; background-color:#ad7850;}
.sumbit_butoon {
	float: right;
	height: 20px;
	/* width: 75px; */
	margin-right: 20px;
	margin-top: 50px;
	margin-bottom:10px;
	cursor:pointer;
}

.question_cross_line {
	float: left;
	height: 1px;
	width: 735px;
	margin-left: 30px;
	background-color: #467E9F;
	margin-top: 10px;
}

.round {
	float: left;
	height: 15px;
	width: 50px;
	margin-top: 3px;
	margin-left: 10px;
	font-family: Arial;
	font-size: 12px;
	font-weight: normal;
	color: #FFF;
	text-align: center;
}
.page_no {
	float: right;
	height: 20px;
	width: 170px;
	margin-top: 10px;
}
#round1
{
	margin-left:95px;
}


#confirmBox
{
    display: none;
    background-color: #eee;
    border-radius: 5px;
    border: 1px solid #aaa;
    position: fixed;
    width: 300px;
    left: 50%;
    margin-left: -150px;
    padding: 6px 8px 8px;
    box-sizing: border-box;
    text-align: center;
}
#confirmBox .button {
    background-color: #ccc;
    display: inline-block;
    border-radius: 3px;
    border: 1px solid #aaa;
    padding: 2px;
    text-align: center;
    width: 80px;
    cursor: pointer;
}
#confirmBox .button:hover
{
    background-color: #ddd;
}
#confirmBox .message
{
    text-align: left;
    margin-bottom: 8px;
}
-->
</style>
</head>
<body onload="return countdownTimer();">
<div class="wrapper">	
	
	<div class="admin_panel">
	<div style="clear:both;"></div><br/>
		
<div class="newslistwrapper" style="background-color:#edf6fb;padding-left:14px;"> 
	<div class="quizplayer">
		<form method="post" name="quiz" action="insertans.php?q=<?php echo $quizid;?>&s=<?php echo $sid;?>&t=<?php echo $typ;?>" onload="return countdownTimer();" autocomplete="off">
			<input type="hidden" id="scs" name="scs" value="0" size="2" maxlength="2" /><br/>
			<input type="hidden" id="changeQue" name="changeQue" class="changeQue" value="false" maxlength="5" />
			<input type="hidden" id="nextRound" name="nextRound" class="nextRound" value="false" maxlength="5" />			
			<input type="hidden" name="quizid" value="<?php echo $quizid;?>" id="quizid"></input>
			<input type="hidden" name="etime" value="<?php echo $etime;?>" id="etime"></input>
			<input type="hidden" name="suserid" value="<?php echo $sid;?>" id="suserid"></input>
			<input type="hidden" name="typ" value="<?php echo $typ;?>" id="typ"></input>
			<div id="round1">
				<div class="round_timesection">	
					<?php
					$duration=$oduration=0;
						if($curquiz == 1)
						{
							$res=mysqli_query($conn,"select * from rim_quizmain where Id='".$quizid."'");
							//echo "select * from rim_quizmain where Id='".$quizid."'";
							if($res>0)
							{
								if(mysqli_num_rows($res)>0)
								{
									$i=1;$duration=$oduration=0;
									while($data=mysqli_fetch_assoc($res))
									{
										$title=str_replace("^","'",$data['Title']);									
										$qudesc=str_replace("^","'",$data['Description']);
										$duration=$data['Duration'];
										$oduration=$data['Duration'];
									}
								}
							}
							$ress=mysqli_query($conn,"select count(*) as cnt from rim_quizquestion where Quizid='".$quizid."'");
							if($ress>0)
							{
								if(mysqli_num_rows($ress)>0)
								{
									while($datas=mysqli_fetch_assoc($ress))
									{
										$totques=str_replace("^","'",$datas['cnt']);
									}
								}
							}
						}
						function get_time_difference( $start, $end )
						{
							$uts['start']      =    strtotime( $start );
							$uts['end']        =    strtotime( $end );
							if( $uts['start']!==-1 && $uts['end']!==-1 )
							{
								if( $uts['end'] >= $uts['start'] )
								{
									$diff    =    $uts['end'] - $uts['start'];
									if( $days=intval((floor($diff/86400))) )
										$diff = $diff % 86400;
									if( $hours=intval((floor($diff/3600))) )
										$diff = $diff % 3600;
									if( $minutes=intval((floor($diff/60))) )
										$diff = $diff % 60;
									$diff    =    intval( $diff );            
									return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
								}
								else
								{
									trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
								}
							}
							else
							{
								trigger_error( "Invalid date/time data detected", E_USER_WARNING );
							}
							return( false );
						}
						date_default_timezone_set('Asia/Calcutta');						
						$stime=date("H:i");
						// a START time value
						$start = $stime;
						// an END time value
						$end   = $etime;;

						// what is the time difference between $end and $start?
						if( $diff=@get_time_difference($start, $end) )
						{
							$htom=$diff['hours']*60;
							$calmin=$htom+$diff['minutes'];							
							if($calmin<$duration)
							{
								$duration=$calmin;
							}
						}						
						?>
					<input type="hidden" id="mns" name="mns" value="<?php echo $duration;?>" size="3" maxlength="3"></input>
					<input type="hidden" name="status" value="<?php echo $curquiz;?>" id="status"></input>
					<div class="roundlines"><?php echo $title;?></div>					
					<div style="clear:both"></div>
					<div class="totalquestions">Total Questions : &nbsp;&nbsp;<?php echo $totques;?></div>
					<div class="roundlines" style="font-weight:bold;font-size:14px;"><?php echo "Student Id :".$sid;?></div>
					<div class="timer">
						<div class="timertext"><span id="rt">Time Left</span></div>
						<div class="time" id="r1timer"><span class="showmns">00</span>:<span class="showscs">00</span></div>
					</div>
				</div>
				<input type="hidden" name="r1complete" value="No" id="r1complete"></input>
				<div class="question_section">
				<div style="font-weight:bold;text-align:right;font-size:14px;width:96%;font-family:arial;color:#FF0000;margin-left:10px;margin-top:10px;">Duration : <?php echo $oduration;?> mins &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Time Left : <?php echo $duration;?> mins &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Exam Date: <?php echo $sdate;?> </div>
				
				<div style="clear:both"></div>
				<div style="font-weight:bold;font-size:14px;width:100%;font-family:arial;color:#FF0000;margin-left:10px;margin-top:10px;">Program Code : <?php echo $pcode;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Subject Code : <?php echo $title;?></div>
				<div style="clear:both"></div>
				<div style="font-weight:bold;font-size:14px;width:100%;font-family:arial;color:#FF0000;margin-left:10px;margin-top:10px;">Instructions :-</div>
					<div style="clear:both"></div>
					<div style="font-weight:bold;font-size:14px;width:100%;font-family:arial;color:#000;margin-left:10px;margin-top:10px;"><?php echo $qudesc;?></div>
					<div style="clear:both"></div><hr/><br/>
					<?php
					if($curquiz == 1)
					{
						$res=mysqli_query($conn,"select * from rim_quizquestion where Quizid='".$quizid."' order by Id asc");
						if($res>0)
						{
							if(mysqli_num_rows($res)>0)
							{
								$i=1;
								while($data=mysqli_fetch_assoc($res))
								{
									$ques=str_replace("^","'",$data['Question']);									
									$ans=str_replace("^","'",$data['Answer']);
									?>																	
										<div id="q<?php echo $i;?>" class="qs <?php echo $i > 1?'hide':'';?>">
											<div class="question_1_wrapper">
												<input type="hidden" name="qid<?php echo $i;?>" value="<?php echo $data['Id'];?>" id="qid<?php echo $i;?>"></input>
												<div class="question_no">Q<?php echo $i;?></div>
												<div class="question"><?php echo $ques;?></div>											
												<div style="clear:both"></div>
												<div class="answeres">
													<?php
													if($ans !="")
													{
													?>
														<div class="answers"><a href="#" style="margin-left:20px;"><?php echo $ans;?></a></div>
														<div style="clear:both"></div>
														<div class="answers"><input type="text" maxlength="1" class="opans" name="uans<?php echo $i;?>" id="uans<?php echo $i;?>" style="min-height:50px;height:auto;max-width:700px;min-width:700px;margin-left:20px;padding-left:15px;font-size:22px;" onblur="return AutoRefresh();" ></input></div>
													<?php
													}	
													else
													{
													?>													
														<div style="clear:both"></div>
														<div class="answers"><textarea name="uans<?php echo $i;?>" id="uans<?php echo $i;?>" style="min-height:50px;height:auto;max-width:700px;min-width:700px;margin-left:20px;resize:auto;padding-left:15px;font-size:22px;" placeholder="Write Your Answer Here." onblur="return AutoRefresh();"></textarea></div>
													<?php
													}
													?>
													<div style="clear:both"></div>
												</div>
											</div>
											<div class="question_cross_line"></div>
										</div>
									<?php
									$i++;
								}
								$i--;
								?>
								<input type="hidden" name="totques" value="<?php echo $i;?>" id="totques"></input>
								<input type="hidden" name="curques" value="1" id="curques"></input>
								<div class="sumbit_butoon">
									<input name="btnprev" id="prev" class="submitAns" type="button" value="Prev" style="width:75px; border:none; height:20px; color:#FFF; background-color:#333;cursor:pointer;" />
									<input name="btnnext" id="next" class="submitAns" type="button" value="Next" style="width:75px; border:none; height:20px; color:#FFF; background-color:#333;cursor:pointer;" />
									<input name="btnsubmit" id="sub" class="submitAns" type="submit" value="Submit" style="width:75px; border:none; height:20px; color:#FFF; background-color:#333;cursor:pointer;" />
								</div> 
							<?php
							}
						}
					}
					else
					{
						
						echo '<div style="font-weight:bold;font-size:14px;text-align:center;width:100%;font-family:arial">No Examination/Test Found</div>';
						echo '<div style="font-weight:bold;font-size:14px;text-align:center;width:100%;margin-top:150px;font-family:arial"><button id="cls">Close</button></div>';
																		
					}
					?>					
				</div>
			</div>			
			<div id="confirmBox">
				<div class="message"></div>
				<span class="button yes">Yes</span>
				<span class="button no">No</span>
			</div>
		</form>
	</div>
</div>
</div>
</div>

</body>
</html>
<script>
$(function () {	
	var tq=$('#totques').val();
	$("#prev").hide();
	/* for(var i=2;i<= tq;i++)
	{
		$('#q'+i).hide();
	} */
	$("#next").on('click',function () {	
		var val=$('#curques').val();
		
		if($('#uans'+val).val() != '')
		{
			if((parseInt(val)+1) > 1)
			{
				$("#prev").show();
			}
			else
			{
				$("#prev").hide();
			}
			if((parseInt(val)+1) >= parseInt(tq))
			{
				$("#next").hide();
				$("#sub").show();
				$('#curques').val(parseInt(tq));
			}
			else
			{
				$('#curques').val(parseInt(val)+1);
				$("#next").show();
				$("#sub").hide();
			}
			$('.qs').hide();
			$('#q'+ (parseInt(val)+1)).show();
		}
		else
		{
			alert('Answer the Question.');
		}
	});
	$("#prev").on('click',function () {	
		var val=$('#curques').val();
		
		if((parseInt(val)-1) > 1)
		{
			$("#prev").show();
		}
		else
		{
			$("#prev").hide();
		}
		if((parseInt(val)-1) <=  1)
		{
			$("#next").show();
			$("#sub").hide();
			$('#curques').val(1);
		}
		else
		{
			$('#curques').val(parseInt(val)-1);
			$("#next").show();
			$("#sub").hide();
		}
		$('.qs').hide();
		$('#q'+ (parseInt(val)-1)).show();
		
	});

	$('.opans').on('keypress',function(){
		var ch=String.fromCharCode(event.keyCode);
		var filter = /[a-eA-e]/;
		var filter1 = /[0-9]/;
		  
		 if(!filter.test(ch)){
			  event.returnValue = false;
			  alert('Your answer should be within the choices given.  Pick-up your answer within the choices given.');
		 }
		 else
		 {			
			 if(filter1.test(ch)){
				  event.returnValue = false;
				  alert('Your choice should be indicated only in alpha character.  Your answer is not case sensitive.');
			 }
		 }
	});
});
</script>