<?php
session_start();
include "config.php";
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d');
$quizname=str_replace("'","^",$_POST['quizname']);	
$desc=str_replace("'","^",$_POST['description']);
$descr=str_replace("'","^",$_POST['desc']);
$que=str_replace("'","^",$_POST['ques']);
$cans=$_POST['cans'];
$mark=$_POST['mark'];
$cnt=0;$cnt1=0;$quizid='';
$_SESSION['tques']=0;
$_SESSION['qname']=$_POST['quizname'];
$_SESSION['qdesc']=$_POST['desc'];
$_SESSION['qdate']=$_POST['startdate'];
$_SESSION['qstime']=$_POST['time'];
$_SESSION['qetime']=$_POST['time1'];
$_SESSION['qduration']=$_POST['duration'];
$_SESSION['typ']=$_POST['typ'];
$_SESSION['cate']=$_POST['category'];
$res1=mysqli_query($conn,"select * from rim_quizmain where Title='".$quizname."' and Duration ='".$_POST['duration']."' and Startdate='".$_POST['startdate']."'");
if($res1>0)
{
	if(mysqli_num_rows($res1)>0)
	{
		while($data = mysqli_fetch_assoc($res1))
		{
			$quizid=$data['Id'];
		}
	}
	$cnt=mysqli_num_rows($res1);
}
if($cnt==0)
{ 	
	$res=mysqli_query($conn,"insert into rim_quizmain(Title,Category,Etype,Description,Duration,Startdate,Starttime,Endtime,Dateofpost)
	 values('".$quizname."','".$_POST['category']."','".$_POST['typ']."','".$descr."','".$_POST['duration']."','".$_POST['startdate']."','".$_POST['time']."','".$_POST['time1']."','".$date."')");
	 
	$sql1="SELECT Id FROM rim_quizmain order by Id desc limit 0,1";
	$result1=mysqli_query($conn,$sql1);
	if(($result1)>0)
	{
		while ($data = mysqli_fetch_assoc($result1))
		{
			$quizid=$data['Id'];
		}		
	}
}
if($quizid !='')
{
	$res=mysqli_query($conn,"insert into rim_quizquestion(Quizid,Question,Answer,Correctans,Mark,Dateofpost)values('".$quizid."','".$que."','".$desc."','".$cans."','".$mark."','".$date."')");

	if($res>0)
	{
		msg("Question Added Successfully","ques.php");
		$sql="SELECT count(*)as cnt FROM rim_quizquestion where Quizid='".$quizid."'";
		$result=mysqli_query($conn,$sql);
		if(($result)>0)
		{
			while ($data = mysqli_fetch_assoc($result))
			{
				$totques=$data['cnt'];
				$_SESSION['tques']=$totques;
			}		
		}
	}
	else
	{		
		msg("Process Failed","ques.php");
	}
}
else
{
	msg("Process Failed","ques.php");
}
?>
<?php
function msg($msg,$url)
{?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
window.location="<?php echo $url; ?>";
</script>
<?php } ?>