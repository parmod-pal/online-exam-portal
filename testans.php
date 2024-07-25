<?php
if(!isset($_SESSION))
{
	session_start();
}
 

$uid=$qid=$title=$uans=$cans=$desc=$qd=$username=$subcode=$pgcode='';
if(isset($_SESSION['uid']))
{
	$uid=$_SESSION['uid'];
}
if(isset($_SESSION['qid']))
{
	$qid=$_SESSION['qid'];
}
if(isset($_SESSION['qd']))
{
	$qd=$_SESSION['qd'];
}

include 'configold.php';
 
$resu1=mysqli_query($conn,"select * from rim_quizmain where Id='".$qid."'");
if($resu1>0)
{
	while($data1=mysqli_fetch_array($resu1))
	{   
	    
		$subcode=$data1['Title'];
		$pgcode=$data1['Category'];
		$desc=$data1['Description'];
	}
}

//echo "select * from userdet where id='".$uid."'";
$resu=mysqli_query($conn,"select * from userdet where id='".$uid."'");
if($resu>0)
{
	while($data=mysqli_fetch_array($resu))
	{   
	   // echo '<pre>';print_r($data);
		$username=$data['name'];
	}
}


//echo $username;die;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RIMSR : Online Exam Answer Sheet</title>
<style>
<!--body {
margin:0px;
padding:0px;
}
.forward {
	float:right;
}
.back {
	float:left;
}
.clr {
	clear:both;
}
.header{
	
	margin:0 auto;
}
.logo {
	width:250px;
}
.header_text{
	width:500px;
	text-align:right;
	color:#0033FF;
	font: 13px Arial, Helvetica, sans-serif;
}
h2 {
text-align:left;margin-left:250px;
font:bold 18px Arial, Helvetica, sans-serif;
}
.studentid {
font:bold 20px Arial, Helvetica, sans-serif;
}
.searchbox{
height:30px;
background:#dde4ff;
border:none;
}
h3 {

color:#FF0000;
padding:0 0 0 15px;
font:bold 16px Arial, Helvetica, sans-serif;
}
form {
	font:bold 16px Arial, Helvetica, sans-serif;
	padding:0 20px 0 20px;
}
.textarea {

background:#dde4ff;
border:none;
font-family: arial;
font-size: 14px;
font-weight: normal;
height: auto;  
margin-left: 25px;   
}-->
</style>
</head>
<body>	
<div class="clr"></div>
<h2>Subject Code: <?php echo $subcode;?> <br/>Program Code: <?php echo $pgcode;?></h2>
<form>
<div class="studentid"> 
  Username : <span class="searchbox"><?php echo $username; ?></span>
</div>  
<p><?php echo nl2br($desc);?></p>
<?php
	$totmark=$nocans=$nowans=0;
	$res=mysqli_query($conn,"select * from rim_quizquestion where Quizid='".$qid."' order by Id asc");
	if($res>0)
	{
		if(mysqli_num_rows($res)>0)
		{
			$i=1;
			while($data=mysqli_fetch_array($res))
			{   
			   
			  //  echo '<pre>';print_r($data);
				 $ques=str_replace("^","'",trim(@$data['Question']));
				 $ans=str_replace("^","'",trim(@$data['Answer']));
				$ques=str_replace("\\n","",trim(@$ques));	
				 $ques=str_replace("\\r","",trim(@$ques));	
				 $ans=str_replace("\\n","",trim(@$ans));
				 $ans=str_replace("\\r","",trim(@$ans));
				$cans=$data['Correctans'];
			    $mark=$data['Mark'];
			    $q= "select * from rim_quizscore where Quizid='".$qid."' and Userid='".$uid."' and Quesid='".$data['Id']."' and Dateofscored='".$qd."'";
				$resu=mysqli_query($conn,$q);				
				if($resu>0)
				{   
				    
					while($dat=mysqli_fetch_array($resu))
					{		
					    //echo '<pre>';print_r($dat);
						/* $title=$dat['Title']; */
						$uans=str_replace("^","'",trim($dat['Answer']));		
						$uans=str_replace("\\n","",trim($uans));
						$uans=str_replace("\\r","",trim($uans));
						
					}
				}				
				if(strlen($uans) == 1)
				{
					if($uans == $cans)
					{
						$totmark += $mark;
						$nocans++;
					}
					else
					{
						$nowans++;
					}							
				}
				 //echo $data['Question'];die;
				
				?>
				<p style="width:90% !important;"><?php echo $i.' '.$ques;?></p>
				<label><span style="font-weight:normal;font-size:12px;font-family:arial;margin-left:20px;color:gray;"><?php echo $ans;?></span></label><br />
				<?php
				if(strlen($uans) == 1)
				{
				?>
				<span style="font-weight:bold;font-size:14px;font-family:arial;margin-left:20px;text-decoration:underline;">Correct Answer:-</span><br/>
				<span class="textarea">
				<?php echo $cans;?></span><br/>
				<?php
				}
				?>
				<span style="font-weight:bold;font-size:14px;font-family:arial;margin-left:20px;text-decoration:underline;">Answer:-</span><br/>
				<span class="textarea">
				<?php echo $uans;?></span><br/>
				
			<?php
			$i++;
			}
		}
	}
?>  
</form><br/>
<div class="studentid"> 
  <h2>Total Marks Scored : <span class="searchbox"><?php echo $totmark; ?></span></h2>
  <h2>No. of Correct Answers : <span class="searchbox"><?php echo $nocans; ?></span></h2>
  <h2>No. of Wrong Answers  : <span class="searchbox"><?php echo $nowans; ?></span></h2>
</div>  
</body>
</html>