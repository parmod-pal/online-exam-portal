<?php
include "function.php";
$link=open_database_connection();
date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
if(isset($_POST['submit']))
{
	$image='';$studid='';$prgid='';$sslcfile='';$addrfile='';$ugfile='';$comfile='';	
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
	
	$admno=$_POST['admin'];$fname=$_POST['fname'];$mname=$_POST['mname'];$lname=$_POST['lname'];$gender=$_POST['gender'];$phone=$_POST['phone1'].'-'.$_POST['phone'];$mobile=$_POST['mobile'];$email=$_POST['email'];$nationality=$_POST['nationality'];$caste=$_POST['community'];$panno=$_POST['pancard'];$aadharno=$_POST['aadharcard'];$passno=$_POST['passport'];$poi=$_POST['poi'];$martial=$_POST['marital'];$addr=$_POST['pa'];$line1=$_POST['line'];$line2=$_POST['line2'];$city=$_POST['city'];$state=$_POST['state'];$pin=$_POST['pin'];
	if($_POST['sadd']=='Yes')
	{
		$paddr=$_POST['pa'];$pline1=$_POST['line'];$pline2=$_POST['line2'];$pcity=$_POST['city'];$pstate=$_POST['state'];$ppin=$_POST['pin'];
	}
	else
	{
		$paddr=$_POST['pa1'];$pline1=$_POST['pline'];$pline2=$_POST['pline2'];$pcity=$_POST['pcity'];$pstate=$_POST['pstate'];$ppin=$_POST['ppin'];
	}
	$faname=$_POST['father'];$fphone=$_POST['fmobile'];$femail=$_POST['femail'];$faddr=$_POST['address'];$fline1=$_POST['line1'];$fline2=$_POST['fline2'];$fcity=$_POST['fcity'];$fstate=$_POST['fstate'];$fpin=$_POST['fpin'];
	
	$presentaddr=$addr.' '.$line1.' '.$line2;
	$permanentaddr=$paddr.' '.$pline1.' '.$pline2;
	$fatheraddr=$faddr.' '.$fline1.' '.$fline2;
	
	$pgrm=$_POST['program'];$mentor=$_POST['mentor'];$noa=$_POST['noa'];

	$fp=$_POST['fp'];$paid=$_POST['feepa'];$bal=$_POST['balance'];$mod=$_POST['mop'];$moddet=$_POST['moddet'];

	$assign=$_POST['assign'];$casestud=$_POST['casestudies'];$test=$_POST['test'];$exam=$_POST['exam'];$tot=$_POST['tot'];

	$pyr=$_POST['pyear1'];$sub=$_POST['subject1'];$insti=$_POST['institute1'];$university=$_POST['university1'];$award=$_POST['award1'];
	$pyr1=$_POST['pyear2'];$sub1=$_POST['subject2'];$insti1=$_POST['institute2'];$university1=$_POST['university2'];$award1=$_POST['award2'];
	$pyr2=$_POST['pyear3'];$sub2=$_POST['subject3'];$insti2=$_POST['institute3'];$university2=$_POST['university3'];$award2=$_POST['award3'];
	$pyr3=$_POST['pyear4'];$sub3=$_POST['subject4'];$insti3=$_POST['institute4'];$university3=$_POST['university4'];$award3=$_POST['award4'];
	$chkadmno=0;
	if($admno !='')
	{	
		$sqlid =mysql_query("SELECT * FROM provisional where admissionno='".$admno."'",$link);
		if($sqlid>0)
		{			
			while($row =mysql_fetch_array($sqlid))
			{	   
				$chkadmno=1;			
			}
		}
		if($chkadmno==0)
		{
			/************************************* insert student general info**********************************************************/
			$sql = "INSERT INTO student_info(admissionno,firstname,lastname,middlename,postaladdress,postalcity,postalstate,postalpin,peraddress,percity,perstate,perpin,phone,mobile,emailid,dob,nationality,community,panno,aadharno,gender,passportno,placeofissue,dateofissue,validupto,gaurdianname,gaurdianaddress,fcity,fstate,fpin,gaurdianphone,gaurdianemail,maritialstatus,dateofregister) VALUES ('".$admno."','".$fname."','".$lname."','".$mname."','".$presentaddr."','".$city."','".$state."','".$pin."','".$permanentaddr."','".$pcity."','".$pstate."','".$ppin."','".$phone."','".$mobile."','".$email."','".$dob."','".$nationality."','".$caste."','".$panno."','".$aadharno."','".$gender."','".$passno."','".$poi."','".$doi."','".$validity."','".$faname."','".$fatheraddr."','".$fcity."','".$fstate."','".$fpin."','".$fphone."','".$femail."','".$martial."','".$date."')";		
			$result=mysql_query($sql,$link);
			
			$sqlid =mysql_query('SELECT id FROM student_info order by id desc limit 0,1',$link);				
			while($row =mysql_fetch_array($sqlid))
			{	   
				$studid = $row['id'];			
			}
			
			if($studid !='')
			{
				if($_FILES['image']){      
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
						move_uploaded_file($_FILES["image"]["tmp_name"],
								"/home/rimsr/public_html/5872687/upload/studimage/" .$imgname);
						$image = $imgname;			
					}
				}
				if($_FILES['sslcfile']){      
					$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
					$extension = explode(".", $_FILES["sslcfile"]["name"]);
					$len=count($extension)-1;			
					$extension = $extension[$len];
					$extension=strtolower($extension);
					if (in_array($extension, $allowedExts)){
						$imgname1=$studid.$_FILES["sslcfile"]["name"];
						move_uploaded_file($_FILES["sslcfile"]["tmp_name"],
								"/home/rimsr/public_html/5872687/upload/sslc/" .$imgname1);
						$sslcfile = $imgname1;			
					}
				}
				if($_FILES['ugfile']){      
					$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
					$extension = explode(".", $_FILES["ugfile"]["name"]);
					$len=count($extension)-1;			
					$extension = $extension[$len];
					$extension=strtolower($extension);
					if (in_array($extension, $allowedExts)){
						$imgname2=$studid.$_FILES["ugfile"]["name"];
						move_uploaded_file($_FILES["ugfile"]["tmp_name"],
								"/home/rimsr/public_html/5872687/upload/degree/" .$imgname2);
						$ugfile = $imgname2;			
					}
				}
				if($_FILES['addrfile']){      
					$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
					$extension = explode(".", $_FILES["addrfile"]["name"]);
					$len=count($extension)-1;			
					$extension = $extension[$len];
					$extension=strtolower($extension);
					if (in_array($extension, $allowedExts)){
						$imgname3=$studid.$_FILES["addrfile"]["name"];
						move_uploaded_file($_FILES["addrfile"]["tmp_name"],
								"/home/rimsr/public_html/5872687/upload/address/" .$imgname3);
						$addrfile = $imgname3;			
					}
				}
				if($_FILES['comfile']){      
					$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg","doc","docx","pdf");
					$extension = explode(".", $_FILES["comfile"]["name"]);
					$len=count($extension)-1;			
					$extension = $extension[$len];
					$extension=strtolower($extension);
					if (in_array($extension, $allowedExts)){
						$imgname4=$studid.$_FILES["comfile"]["name"];
						move_uploaded_file($_FILES["comfile"]["tmp_name"],
								"/home/rimsr/public_html/5872687/upload/community/" .$imgname4);
						$comfile = $imgname4;			
					}
				}
				if($image !="")
				{
					$sql = "update student_info set image='".$image."' where id='".$studid."'";		
					$result=mysql_query($sql,$link);
				}
				if($sslcfile !="")
				{
					$sql = "update student_info set sslccertificate='".$sslcfile."' where id='".$studid."'";		
					$result=mysql_query($sql,$link);
				}
				if($ugfile !="")
				{
					$sql = "update student_info set degreecertificate='".$ugfile."' where id='".$studid."'";		
					$result=mysql_query($sql,$link);
				}
				if($addrfile !="")
				{
					$sql = "update student_info set addrproof='".$addrfile."' where id='".$studid."'";		
					$result=mysql_query($sql,$link);
				}
				if($comfile !="")
				{
					$sql = "update student_info set communitycertificate='".$comfile."' where id='".$studid."'";		
					$result=mysql_query($sql,$link);
				}
				/************************************* insert program details**********************************************************/
				$sql = "INSERT INTO admission_details(studentid,admittedfor,dateofadmission,dateofcompletion,certificateissuedon,mentorassigned,noofattempts,posteddate) VALUES ('".$studid."','".$pgrm."','".$doa."','".$doc."','".$certificate."','".$mentor."','".$noa."','".$date."')";	
				$result=mysql_query($sql,$link);
			   
				$sqlid =mysql_query('SELECT admittedfor FROM admission_details order by id desc limit 0,1',$link);
				while($row =mysql_fetch_array($sqlid))
				{	      
					$prgid = $row['admittedfor'];			
				}
				if($prgid !='')
				{
					/************************************* insert program fee details**********************************************************/
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
					
					/************************************* insert scholastic details**********************************************************/
					$noa=0;
					if($assign !='' && $casestud !='' && $test !='' && $exam !='')
					{
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
				}
				/************************************* insert educational details**********************************************************/
				$sql = "INSERT INTO student_edu_details(studentid,course,subject,institute,university,classaward,yearofpassing,posteddate) VALUES('".$studid."','".'SSLC'."','".$sub."','".$insti."','".$university."','".$award."','".$pyr."','".$date."')";	
				$result=mysql_query($sql,$link);
				if($insti1!="")
				{
					$sql = "INSERT INTO student_edu_details(studentid,course,subject,institute,university,classaward,yearofpassing,posteddate) VALUES('".$studid."','Graduation','".$sub1."','".$insti1."','".$university1."','".$award1."','".$pyr1."','".$date."')";
					$result=mysql_query($sql,$link);
				}
				if($insti2!="")
				{
					$sql = "INSERT INTO student_edu_details(studentid,course,subject,institute,university,classaward,yearofpassing,posteddate) VALUES('".$studid."','Post Graduation','".$sub2."','".$insti2."','".$university2."','".$award2."','".$pyr2."','".$date."')";
					$result=mysql_query($sql,$link);
				}
				if($insti3!="")
				{
					$sql = "INSERT INTO student_edu_details(studentid,course,subject,institute,university,classaward,yearofpassing,posteddate) VALUES('".$studid."','Others','".$sub3."','".$insti3."','".$university3."','".$award3."','".$pyr3."','".$date."')";
					$result=mysql_query($sql,$link);
				}
				/************************************* insert experience details**********************************************************/
				$cnt=$_POST['cnt'];
				$i=$cnt;
				for($i=1;$i<$cnt;$i++)
				{
					if($_POST['ins'.$i] !="")
					{
						$sql = "INSERT INTO experiance(studentid,institutename,designation,periodfrom,periodto,natureofwork,posteddate) VALUES('".$studid."','".$_POST['ins'.$i]."','".$_POST['des'.$i]."','".$_POST['empf'.$i]."','".$_POST['empt'.$i]."','".$_POST['wrk'.$i]."','".$date."')";
						$result=mysql_query($sql,$link);
					}
				}
				/************************************* insert course attend details**********************************************************/				
				if($prgid !='')
				{
					$result='';
					if($_POST['cno'] !='' && $_POST['mobt'] !='')
					{						
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
						$sql = "INSERT INTO courseattend(studentid,programid,courseno,coursename,maxmark,markobtained,markpercent,remarks,dateofpost) VALUES('".$studid."','".$prgid."','".$_POST['cno']."','".$_POST['cna']."','".$_POST['mxm']."','".$_POST['mobt']."','".$_POST['percent']."','".$result."','".$date."')";		
						$result=mysql_query($sql,$link);
					}
				}				
			}
		}
		else
		{
			close_database_connection($link);
			msg("Admission No. already exists");
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=home&a=template">'; 
		}
	}
	else
	{		
		close_database_connection($link);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=main&a=template">';  
	}
}
else
{
	close_database_connection($link);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=main&a=template">'; 
}
if($result >0)
{	
	close_database_connection($link);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?m=main&a=template">'; 
}
?>
<?php
function msg($msg)
{?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
</script>
<?php } ?>