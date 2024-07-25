<?php
include "function.php";
session_start();
$f='';
if(isset($_GET['f']))
{
	$f=$_GET['f'];
}
$link=open_database_connection();
date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
	$image='';$studid='';$prgid='';$sslcfile='';$addrfile='';$ugfile='';$comfile='';$simage='';$sslc='';$degree='';$addr='';$comm='';
	$studid=$_POST['studid'];
	$prgid=$_POST['prid'];
	
	$dob=$_POST['dob'];
	if($dob !=''){$dt=explode("-",$dob);$mon=$dt[1];$date1=$dt[0];$year=$dt[2];$dob=$year.'-'.$mon.'-'.$date1;}
	$doi=$_POST['doi'];
	if($doi !=''){$dt=explode("-",$doi);$mon=$dt[1];$date1=$dt[0];$year=$dt[2];$doi=$year.'-'.$mon.'-'.$date1;}
	$validity=$_POST['valupto'];
	if($validity !=''){$dt=explode("-",$validity);$mon=$dt[1];$date1=$dt[0];$year=$dt[2];$validity=$year.'-'.$mon.'-'.$date1;}
	$doc=$_POST['doc'];
	if($doc !=''){$dt=explode("-",$doc);$mon=$dt[1];$date1=$dt[0];$year=$dt[2];$doc=$year.'-'.$mon.'-'.$date1;}
	$doa=$_POST['doa'];
	if($doa !=''){$dt=explode("-",$doa);$mon=$dt[1];$date1=$dt[0];$year=$dt[2];$doa=$year.'-'.$mon.'-'.$date1;}
	$certificate=$_POST['certificate'];	
	if($certificate !=''){$dt=explode("-",$certificate);$mon=$dt[1];$date1=$dt[0];$year=$dt[2];$certificate=$year.'-'.$mon.'-'.$date1;}
	$doe=$_POST['doe'];
	if($doe !=''){$dt=explode("-",$doe);$mon=$dt[1];$date1=$dt[0];$year=$dt[2];$doe=$year.'-'.$mon.'-'.$date1;}
	
	$admno=$_POST['admin'];$fname=$_POST['fname'];$mname=$_POST['mname'];$lname=$_POST['lname'];$gender=$_POST['gender'];$phone=$_POST['phone1'].'-'.$_POST['phone'];$mobile=$_POST['mobile'];$email=$_POST['email'];$nationality=$_POST['nationality'];$caste=$_POST['community'];$panno=$_POST['pancard'];$aadharno=$_POST['aadharcard'];$passno=$_POST['passport'];$poi=$_POST['poi'];$martial=$_POST['marital'];$addr=$_POST['pa'];$city=$_POST['city'];$state=$_POST['state'];$pin=$_POST['pin'];$faname=$_POST['father'];$fphone=$_POST['fmobile'];$femail=$_POST['femail'];$faddr=$_POST['address'];$fcity=$_POST['fcity'];$fstate=$_POST['fstate'];$fpin=$_POST['fpin'];	
	if($_POST['sadd']=='Yes')
	{
		$paddr=$_POST['pa'];$pcity=$_POST['city'];$pstate=$_POST['state'];$ppin=$_POST['pin'];
	}
	else
	{
		$paddr=$_POST['pa1'];$pcity=$_POST['pcity'];$pstate=$_POST['pstate'];$ppin=$_POST['ppin'];
	}
	$presentaddr=$addr;
	$permanentaddr=$paddr;
	$fatheraddr=$faddr;
	
	$pgrm=$_POST['program'];$mentor=$_POST['mentor'];$noa=$_POST['noa'];

	$fp=$_POST['fp'];$paid=$_POST['feepa'];$bal=$_POST['balance'];$mod=$_POST['mop'];$moddet=$_POST['moddet'];

	$assign=$_POST['assign'];$casestud=$_POST['casestudies'];$test=$_POST['test'];$exam=$_POST['exam'];$tot=$_POST['tot'];

	$pyr=$_POST['pyear1'];$sub=$_POST['subject1'];$insti=$_POST['institute1'];$university=$_POST['university1'];$award=$_POST['award1'];$eduid=$_POST['eduid1'];
	$pyr1=$_POST['pyear2'];$sub1=$_POST['subject2'];$insti1=$_POST['institute2'];$university1=$_POST['university2'];$award1=$_POST['award2'];$eduid1=$_POST['eduid2'];
	$pyr2=$_POST['pyear3'];$sub2=$_POST['subject3'];$insti2=$_POST['institute3'];$university2=$_POST['university3'];$award2=$_POST['award3'];$eduid2=$_POST['eduid3'];
	$pyr3=$_POST['pyear4'];$sub3=$_POST['subject4'];$insti3=$_POST['institute4'];$university3=$_POST['university4'];$award3=$_POST['award4'];$eduid3=$_POST['eduid4'];	
	
	if($admno !='')
	{	
		if(isset($_FILES['image']["name"]) !=''){      
			$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg");
			$extension = explode(".", $_FILES["image"]["name"]);
			$len=count($extension)-1;			
			$extension = $extension[$len];
			$extension=strtolower($extension);
			if ((($_FILES["image"]["type"] == "image/gif")
				|| ($_FILES["image"]["type"] == "image/jpeg")
				|| ($_FILES["image"]["type"] == "image/png")
				|| ($_FILES["image"]["type"] == "image/pjpeg"))
				&& ($_FILES["image"]["size"] < 200000)
				&& in_array($extension, $allowedExts)){
				$imgname=$studid.$_FILES["image"]["name"];
				move_uploaded_file($_FILES["image"]["tmp_name"],"/home/rimsr/public_html/5872687/upload/studimage/".$imgname);
				$image = $imgname;			
			}
		}
		if(isset($_FILES['sslcfile']["name"]) !=''){			
			$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
			$extension = explode(".", $_FILES["sslcfile"]["name"]);
			$len=count($extension)-1;			
			$extension = $extension[$len];
			$extension=strtolower($extension);				
			if (in_array($extension, $allowedExts)){
				$imgname1=$studid.$_FILES["sslcfile"]["name"];
				move_uploaded_file($_FILES["sslcfile"]["tmp_name"],"/home/rimsr/public_html/5872687/upload/sslc/".$imgname1);
				$sslcfile = $imgname1;			
			}
		}
		if(isset($_FILES['ugfile']["name"]) !=''){      
			$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
			$extension = explode(".", $_FILES["ugfile"]["name"]);
			$len=count($extension)-1;			
			$extension = $extension[$len];
			$extension=strtolower($extension);
			if (in_array($extension, $allowedExts)){
				$imgname2=$studid.$_FILES["ugfile"]["name"];
				move_uploaded_file($_FILES["ugfile"]["tmp_name"],"/home/rimsr/public_html/5872687/upload/degree/".$imgname2);
				$ugfile = $imgname2;			
			}
		}
		if(isset($_FILES['addrfile']["name"]) !=''){      
			$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
			$extension = explode(".", $_FILES["addrfile"]["name"]);
			$len=count($extension)-1;			
			$extension = $extension[$len];
			$extension=strtolower($extension);
			if (in_array($extension, $allowedExts)){			
				$imgname3=$studid.$_FILES["addrfile"]["name"];
				move_uploaded_file($_FILES["addrfile"]["tmp_name"],"/home/rimsr/public_html/5872687/upload/address/".$imgname3);
				$addrfile = $imgname3;			
			}
		}
		if(isset($_FILES['comfile']["name"]) != ''){      
			$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
			$extension = explode(".", $_FILES["comfile"]["name"]);
			$len=count($extension)-1;			
			$extension = $extension[$len];
			$extension=strtolower($extension);
			if (in_array($extension, $allowedExts)){			
				$imgname4=$studid.$_FILES["comfile"]["name"];
				move_uploaded_file($_FILES["comfile"]["tmp_name"],"/home/rimsr/public_html/5872687/upload/community/".$imgname4);
				$comfile = $imgname4;			
			}
		}
		/************************************* update student general info**********************************************************/
		$sql = "update student_info set firstname='".$fname."',lastname='".$lname."',middlename='".$mname."',postaladdress='".$presentaddr."',postalcity='".$city."',postalstate='".$state."',postalpin='".$pin."',peraddress='".$permanentaddr."',percity='".$pcity."',perstate='".$pstate."',perpin='".$ppin."',phone='".$phone."',mobile='".$mobile."',emailid='".$email."',dob='".$dob."',nationality='".$nationality."',community='".$caste."',panno='".$panno."',aadharno='".$aadharno."',gender='".$gender."',passportno='".$passno."',placeofissue='".$poi."',dateofissue='".$doi."',validupto='".$validity."',gaurdianname='".$faname."',gaurdianaddress='".$fatheraddr."',fcity='".$fcity."',fstate='".$fstate."',fpin='".$fpin."',gaurdianphone='".$fphone."',gaurdianemail='".$femail."',maritialstatus='".$martial."'where id='".$studid."'";		
			$result=mysql_query($sql,$link);			
			$sqlid =mysql_query("SELECT image,sslccertificate,degreecertificate,addrproof,communitycertificate FROM student_info where id='".$studid."'",$link);	
			while($row =mysql_fetch_array($sqlid))
			{	   
				$simage = $row['image'];			
				$sslc = $row['sslccertificate'];
				$degree = $row['degreecertificate'];
				$addr = $row['addrproof'];
				$comm = $row['communitycertificate'];
			}
			
			if($image !="")
			{			
				$path="/home/rimsr/public_html/5872687/upload/studimage/" .$simage;
				if(file_exists($path))
				{
					if($simage != $image)
					{
						unlink($path);
					}
				}
				$sql = "update student_info set image='".$image."' where id='".$studid."'";		
				$result=mysql_query($sql,$link);
			}
			if($sslcfile !="")
			{
				$path="/home/rimsr/public_html/5872687/upload/sslc/" .$sslc;
				if(file_exists($path))
				{
					if($sslc != $sslcfile)
					{
						unlink($path);
					}
				}
				$sql = "update student_info set sslccertificate='".$sslcfile."' where id='".$studid."'";		
				$result=mysql_query($sql,$link);
			}
			if($ugfile !="")
			{
				$path="/home/rimsr/public_html/5872687/upload/degree/" .$degree;
				if(file_exists($path))
				{
					if($degree != $ugfile)
					{
						unlink($path);
					}
				}
				$sql = "update student_info set degreecertificate='".$ugfile."' where id='".$studid."'";		
				$result=mysql_query($sql,$link);
			}
			if($addrfile !="")
			{
				$path="/home/rimsr/public_html/5872687/upload/address/" .$addr;
				if(file_exists($path))
				{
					if($addr != $addrfile)
					{
						unlink($path);
					}
				}
				$sql = "update student_info set addrproof='".$addrfile."' where id='".$studid."'";		
				$result=mysql_query($sql,$link);
			}
			if($comfile !="")
			{
				$path="/home/rimsr/public_html/5872687/upload/community/" .$comm;
				if(file_exists($path))
				{
					if($comm != $comfile)
					{
						unlink($path);
					}
				}
				$sql = "update student_info set communitycertificate='".$comfile."' where id='".$studid."'";		
				$result=mysql_query($sql,$link);
			}
	}
	/************************************* update program details**********************************************************/
	
		$pid=$_POST['pgid'];
		$sql = "update admission_details set dateofadmission='".$doa."',dateofcompletion='".$doc."',certificateissuedon='".$certificate."',mentorassigned='".$mentor."' where id='".$pid."'";	
		$result=mysql_query($sql,$link);
	
	
	/************************************* insert new installment details**********************************************************/
	if(isset($_POST['submit2']))
	{
		$installment=0;
		$sqlid =mysql_query("SELECT count(*) as installment FROM fee_details where studentid='".$studid."' and programid='".$prgid."'" ,$link);	
		if($sqlid > 0)
		{   
			while($row =mysql_fetch_array($sqlid))
			{	      
				$installment = $row['installment'];			
			} 
		}
		$installment++;
		$sql = "INSERT INTO fee_details(studentid,programid,payable,paid,balance,modeofpay,modedet,installmentno,paiddate) VALUES('".$studid."','".$prgid."','".$fp."','".$paid."','".$bal."','".$mod."','".$moddet."','".$installment."','".$date."')";		   
		$result=mysql_query($sql,$link);
	}
	
	/************************************* insert new attempt scholastic details**********************************************************/
	if(isset($_POST['submit3']))
	{
		$noa=0;		
		$sqlid =mysql_query("SELECT count(*) as attempts FROM scholistic where studentid='".$studid."' and programid='".$prgid."'" ,$link);
		if($sqlid > 0)
		{ 		
			while($row =mysql_fetch_array($sqlid))
			{	   
				$noa = $row['attempts'];			
			} 	
		}
		$noa++;
		$sql = "INSERT INTO scholistic(studentid,programid,assignment,casestudies,testmark,exam,totalmark,attempt,examdate,posteddate) VALUES('".$studid."','".$prgid."','".$assign."','".$casestud."','".$test."','".$exam."','".$tot."','".$noa."','".$doe."','".$date."')";		
		$result=mysql_query($sql,$link);
	}
	else
	{	
	/************************************* update scholastic details**********************************************************/
		if($assign !='')
		{
			$sql = "update scholistic set assignment='".$assign."',casestudies='".$casestud."',testmark='".$test."',exam='".$exam."',totalmark='".$tot."',examdate='".$doe."' where id='".$_POST['mrkid']."'";		
			$result=mysql_query($sql,$link);
			
		}	
	}
	/************************************* insert educational details**********************************************************/
	
	$sql = "update student_edu_details set subject='".$sub."',institute='".$insti."',university='".$university."',classaward='".$award."',yearofpassing='".$pyr."' where id='".$eduid."'";	
	$result=mysql_query($sql,$link);		
	if($insti1!="" && $eduid1 =="")
	{			
		$sql = "INSERT INTO student_edu_details(studentid,course,subject,institute,university,classaward,yearofpassing,posteddate) VALUES('".$studid."','Graduation','".$sub1."','".$insti1."','".$university1."','".$award1."','".$pyr1."','".$date."')";
		$result=mysql_query($sql,$link);
	}
	else
	{
		$sql = "update student_edu_details set subject='".$sub1."',institute='".$insti1."',university='".$university1."',classaward='".$award1."',yearofpassing='".$pyr1."' where id='".$eduid1."'";	
		$result=mysql_query($sql,$link);
	}
	if($insti2!="" && $eduid2 =="")
	{			
		$sql = "INSERT INTO student_edu_details(studentid,course,subject,institute,university,classaward,yearofpassing,posteddate) VALUES('".$studid."','Graduation','".$sub2."','".$insti2."','".$university2."','".$award2."','".$pyr2."','".$date."')";
		$result=mysql_query($sql,$link);
	}
	else
	{
		$sql = "update student_edu_details set subject='".$sub2."',institute='".$insti2."',university='".$university2."',classaward='".$award2."',yearofpassing='".$pyr2."' where id='".$eduid2."'";	
		$result=mysql_query($sql,$link);
	}
	if($insti3!="" && $eduid3 =="")
	{			
		$sql = "INSERT INTO student_edu_details(studentid,course,subject,institute,university,classaward,yearofpassing,posteddate) VALUES('".$studid."','Graduation','".$sub3."','".$insti3."','".$university3."','".$award3."','".$pyr3."','".$date."')";
		$result=mysql_query($sql,$link);
	}
	else
	{
		$sql = "update student_edu_details set subject='".$sub3."',institute='".$insti3."',university='".$university3."',classaward='".$award3."',yearofpassing='".$pyr3."' where id='".$eduid3."'";	
		$result=mysql_query($sql,$link);
	}

/************************************* insert experience details**********************************************************/

	$cnt=$_POST['cnt'];
	$i=$cnt;
	for($i=1;$i<$cnt;$i++)
	{
		if($_POST['ins'.$i] !="" && $_POST['expid'.$i] =="")
		{			
			$sql = "INSERT INTO experiance(studentid,institutename,designation,periodfrom,periodto,natureofwork,posteddate) VALUES('".$studid."','".$_POST['ins'.$i]."','".$_POST['des'.$i]."','".$_POST['empf'.$i]."','".$_POST['empt'.$i]."','".$_POST['wrk'.$i]."','".$date."')";			
			$result=mysql_query($sql,$link);
		}
		else
		{
			$sql = "update experiance set institutename='".$_POST['ins'.$i]."',designation='".$_POST['des'.$i]."',periodfrom='".$_POST['empf'.$i]."',periodto='".$_POST['empt'.$i]."',natureofwork='".$_POST['wrk'.$i]."' where id='".$_POST['expid'.$i]."'";
			$result=mysql_query($sql,$link);
		}			
	}	
	
	/************************************* insert new attempt course attend details**********************************************************/
	$progid=$_POST['cprogram'];	
	if($_POST['corid'] =='')
	{
		$noa=0;		
		$sqlid =mysql_query("SELECT count(*) as attempts FROM courseattend where studentid='".$studid."' and programid='".$prgid."' and courseno='".$_POST['cno']."'" ,$link);		
		if($sqlid > 0)
		{ 		
			while($row =mysql_fetch_array($sqlid))
			{	   
				$noa = $row['attempts'];			
			} 	
		}
		if($noa <= 2)
		{
			if($_POST['cno'] !='' && $_POST['mobt'] !='')
			{						
				$sql = "INSERT INTO courseattend(studentid,programid,courseno,coursename,maxmark,markobtained,markpercent,remarks,dateofpost) VALUES('".$studid."','".$prgid."','".$_POST['cno']."','".$_POST['cna']."','".$_POST['mxm']."','".$_POST['mobt']."','".$_POST['percent']."','".$_POST['remarks']."','".$date."')";		
				$result=mysql_query($sql,$link);
			}
		}			
	}
	else
	{		
		/************************************* update course attend details**********************************************************/
		if($_POST['cno'] !='' && $_POST['mobt'] !='')
		{			
			$result='';
			if($_POST['remarks']=="PASSED WITH DISTINCTION")
			{
				if($_POST['percent'] >=80)
				{
					$result="PASSED WITH DISTINCTION";
				}
				else if($_POST['percent'] >=60 && $_POST['percent'] < 80)
				{
					$result="PASSED";
				}	
				else
				{
					$result="FAILED";
				}
			}
			else
			{
				$result=$_POST['remarks'];
			}
			$sql = "update courseattend set markobtained='".$_POST['mobt']."',markpercent='".$_POST['percent']."',remarks='".$result."' where id='".$_POST['corid']."'";		
			$result=mysql_query($sql,$link);
		}
	}	
		
	if($result >0)
	{	
		close_database_connection($link);			
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../index.php?m=edit&a=template&id=$studid&pid=$prgid'>";  
	}	
?>
<?php
	function alrt($msg)
	{
?>
		<script type="text/javascript">
			alert("<?php echo $msg;?>");
		</script>		
<?php	
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../index.php?m=view&a=template'>";
	}
?>