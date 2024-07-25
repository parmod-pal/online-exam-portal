<?php
function open_database_connection()
{
	/* $link = mysql_connect('localhost', 'negen5lg_sinfo', 'sinfo123');
	mysql_select_db('negen5lg_studinfo', $link); */  
	
	/* $link = mysql_connect('localhost', 'root', '');
	mysql_select_db('studentinfo', $link);  */
	$link = mysql_connect('localhost', 'elefaw8a_rimsr', 'qwer_!@#4');
	mysql_select_db('elefaw8a_rimsrstudinfo', $link);
	return $link;
}
function close_database_connection($link)
{
	mysql_close($link);
}
function randomNumber() {
    $result = '';
    for($i = 0; $i < 6; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}
function selprogram()
{
	$link = open_database_connection();	
	$prgmname=array();
	$result=mysql_query("select * from programdet order by id asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$prgmname[]=$data;
		}
	}
	close_database_connection($link);
	return $prgmname;
}
function selcourse()
{
	$link = open_database_connection();	
	$prgmname=array();
	$result=mysql_query("select * from coursedet order by id asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$prgmname[]=$data;
		}
	}
	close_database_connection($link);
	return $prgmname;
}
function selcountry()
{
	$link = open_database_connection();	
	$prgmname=array();
	$result=mysql_query("select * from countrylist order by Name asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$prgmname[]=$data;
		}
	}
	close_database_connection($link);
	return $prgmname;
}
function selprogramname($id)
{
	$link = open_database_connection();	
	$prgmname=array();
	$result=mysql_query("select * from programdet where id='".$id."'",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$prgmname[]=$data;
		}
	}
	close_database_connection($link);
	return $prgmname;
}
function selstudlist()
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select s.id,s.admissionno,s.dob,s.firstname,s.middlename,s.lastname,s.mobile,s.emailid,s.gender,p.admittedfor from student_info s inner join admission_details p where s.id=p.studentid order by s.id asc",$link); 	
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selstudbyadm($admno)
{	
	$link = open_database_connection();	
	$studinfo=array();
	$result=mysql_query("select s.id,p.admittedfor from student_info s,admission_details p where s.admissionno='".$admno."' and s.id=p.studentid",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studinfo[]=$data;
		}
	}
	close_database_connection($link);
	return $studinfo;
}
function selstudbyprog($progid)
{	
	$link = open_database_connection();	
	$studinfo=array();
	$result=mysql_query("select s.id,s.dob,s.admissionno,s.firstname,s.middlename,s.lastname,s.mobile,s.emailid,s.gender,p.admittedfor from student_info s inner join admission_details p where s.id=p.studentid and p.admittedfor='".$progid."' order by s.id asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studinfo[]=$data;
		}
	}
	close_database_connection($link);
	return $studinfo;
}
function selstudinfo($id)
{	
	$link = open_database_connection();	
	$studinfo=array();
	$result=mysql_query("select * from student_info where id='".$id."'",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studinfo[]=$data;
		}
	}
	close_database_connection($link);
	return $studinfo;
}

function selstudadmdet($id)
{
	$link = open_database_connection();	
	$admdet=array();
	$result=mysql_query("select * from admission_details where studentid='".$id."'",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$admdet[]=$data;
		}
	}
	close_database_connection($link);
	return $admdet;
}
function selstudfeedet($id,$prgid)
{
	$link = open_database_connection();	
	$feedet=array();
	$result=mysql_query("select * from fee_details where studentid='".$id."' and programid='".$prgid."' order by id asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$feedet[]=$data;
		}
	}
	close_database_connection($link);
	return $feedet;
}
function delstudfeedet($id)
{
	$link = open_database_connection();		
	$result=mysql_query("delete from fee_details where id='".$id."'",$link);	
	close_database_connection($link);
	return $result;
}
function selpaidfeedet($sid,$prgid)
{
	$link = open_database_connection();	
	$paidfeedet=array();
	$result=mysql_query("select sum(paid) as paidamt,payable,id,modedet from fee_details where studentid='".$sid."' and programid='".$prgid."'",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$paidfeedet[]=$data;
		}
	}
	close_database_connection($link);
	return $paidfeedet;
}
function selstudexpdet($id)
{
	$link = open_database_connection();	
	$expdet=array();
	$result=mysql_query("select * from experiance where studentid='".$id."'",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$expdet[]=$data;
		}
	}
	close_database_connection($link);
	return $expdet;
}
function selstudmarkdet($id,$prgid)
{
	$link = open_database_connection();	
	$markdet=array();
	$result=mysql_query("select * from scholistic where studentid='".$id."' and programid='".$prgid."' order by id desc limit 0,1",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$markdet[]=$data;
		}
	}
	close_database_connection($link);
	return $markdet;
}
function selstudedudet($id)
{
	$link = open_database_connection();	
	$edudet=array();
	$result=mysql_query("select * from student_edu_details where studentid='".$id."'",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$edudet[]=$data;
		}
	}
	close_database_connection($link);
	return $edudet;
}



/*********************************************** Reports Data***************************************************/

function selrpt1($progid)
{	
	$link = open_database_connection();	
	$studall=array();
	if($progid != "")
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.community,s.emailid,p.admittedfor, p.dateofadmission,p.dateofcompletion from student_info s inner join admission_details p where s.id=p.studentid and p.admittedfor='".$progid."' order by p.dateofadmission, s.firstname asc",$link);
	}
	else
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.community,s.emailid,p.admittedfor, p.dateofadmission,p.dateofcompletion from student_info s inner join admission_details p where s.id=p.studentid order by p.dateofadmission, s.firstname asc",$link);
	}
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function seldwiserpt($progid,$frm,$to)
{	
	$link = open_database_connection();	
	$studall=array();
	if($progid != "" && $frm !='' && $to !='')
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.community,s.emailid,p.admittedfor, p.dateofadmission,p.dateofcompletion from student_info s inner join admission_details p where s.id=p.studentid and p.admittedfor='".$progid."' and (p.dateofadmission between '".$frm."' and '".$to."') order by s.firstname asc",$link);
	}
	else
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.community,s.emailid,p.admittedfor, p.dateofadmission,p.dateofcompletion from student_info s inner join admission_details p where s.id=p.studentid order by p.dateofadmission, s.firstname asc",$link);
	}
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selrpt2($progid,$ano)
{	
	$link = open_database_connection();	
	$studall=array();
	if($ano == '')
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.gender,f.payable,sum(f.paid) as paid from student_info s inner join fee_details f where s.id = f.studentid and f.programid='".$progid."' group by s.id order by s.firstname asc",$link);
	}
	else if($progid == '' && $ano != '')
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.gender,f.programid,f.payable,sum(f.paid) as paid from student_info s inner join fee_details f where s.id = f.studentid and s.admissionno = '".$ano."' group by s.id order by s.firstname asc",$link);
	}
	else
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.gender,s.emailid,f.payable,sum(f.paid) as paid from student_info s inner join fee_details f where s.admissionno = '".$ano."' and s.id = f.studentid and f.programid='".$progid."' group by s.id order by s.firstname asc",$link);
	}
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selrpt3($progid,$cour)
{	
	if($cour=="tests")
	{
		$cour="testmark";
	}
	if($cour=="examination")
	{
		$cour="exam";
	}
	$fld='e.'.$cour;
	$link = open_database_connection();	
	$studall=array();
	if($progid !="")
	{		
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,".$fld.",e.posteddate,e.totalmark,e.examdate from student_info s inner join scholistic e where s.id=e.studentid and e.programid='".$progid."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
	}
	else
	{		
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,".$fld.",e.posteddate,e.totalmark,e.examdate from student_info s inner join scholistic e where s.id=e.studentid and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
	}
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selrpt4($progid)
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.assignment,e.casestudies,e.testmark,e.exam,e.examdate from student_info s inner join scholistic e where s.id=e.studentid and e.programid='".$progid."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selrpt5($progid,$r,$frm,$to)
{	
	$link = open_database_connection();	
	$studall=array();	
	if($r=="PASSED")
	{		
		if($progid !='' && $frm !='' && $to !='')
		{
			$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark,e.examdate from student_info s inner join scholistic e,admission_details p where s.id=e.studentid and e.programid='".$progid."' and p.admittedfor='".$progid."' and (p.dateofadmission between '".$frm."' and '".$to."') and e.totalmark >= 60 and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
			
		}
		else
		{
			$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark,e.examdate from student_info s inner join scholistic e where s.id=e.studentid and e.programid='".$progid."' and e.totalmark >= 60 and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
		}
	}
	else
	{
		if($progid !='' && $frm !='' && $to !='')
		{
			$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark,e.examdate from student_info s inner join scholistic e,admission_details p where s.id=e.studentid and e.programid='".$progid."' and p.admittedfor='".$progid."' and (p.dateofadmission between '".$frm."' and '".$to."') and e.totalmark < 60 and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
		}
		else
		{
			$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark,e.examdate from student_info s inner join scholistic e where s.id=e.studentid and e.programid='".$progid."' and e.totalmark < 60 and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
		}		
	}
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selrpt6($progid)
{	
	$link = open_database_connection();	
	$studall=array();
	if($progid !="")
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,p.certificateissuedon from student_info s inner join admission_details p where s.id=p.studentid and p.admittedfor='".$progid."' and p.certificateissuedon <> '0000-00-00' order by p.certificateissuedon desc",$link);
	}
	else
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,p.certificateissuedon from student_info s inner join admission_details p where s.id=p.studentid and p.certificateissuedon <> '0000-00-00' order by p.certificateissuedon desc",$link);
	}
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selmentor()
{
	$link = open_database_connection();	
	$prgmname=array();
	$result=mysql_query("select distinct(mentorassigned) from admission_details order by mentorassigned asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$prgmname[]=$data;
		}
	}
	close_database_connection($link);
	return $prgmname;
}
function selrpt7($progid,$m)
{	
	$link = open_database_connection();	
	$studall=array();
	if($progid !="" && $m !="")
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark ,e.examdate,p.mentorassigned from admission_details p,student_info s inner join scholistic e where s.id=e.studentid and s.id=p.studentid and e.programid='".$progid."'and p.admittedfor='".$progid."' and p.mentorassigned ='".$m."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);		
	}
	else if($progid !="" && $m =="")
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark ,e.examdate,p.mentorassigned from admission_details p,student_info s inner join scholistic e where s.id=e.studentid and s.id=p.studentid and e.programid='".$progid."'and p.admittedfor='".$progid."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);	
	}
	else if($progid =="" && $m !="")
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark,e.examdate ,p.mentorassigned from admission_details p,student_info s inner join scholistic e where s.id=e.studentid and s.id=p.studentid and p.mentorassigned ='".$m."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);	
	}
	else
	{
		$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,e.totalmark ,e.examdate,p.mentorassigned from admission_details p,student_info s inner join scholistic e where s.id=e.studentid and s.id=p.studentid and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
	}
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selrpt8($sid)
{	
	$link = open_database_connection();	
	$studall=array();
	$result=0;
	if($sid !="")
	{
		$result=mysql_query("select s.*,e.* ,p.*,f.payable,sum(f.paid) as paid from admission_details p,fee_details f,student_info s inner join scholistic e where s.id=e.studentid and s.id=p.studentid and s.id=f.studentid and e.programid = p.admittedfor and s.admissionno='".$sid."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL )",$link);		
	}
	/* else
	{
		$result=mysql_query("select s.*,e.* ,p.*,f.payable,sum(f.paid) as paid from admission_details p,fee_details f,student_info s inner join scholistic e where s.id=e.studentid and s.id=p.studentid and s.id=f.studentid and e.programid = p.admittedfor and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.id desc limit 1",$link);
	} */	
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selusr()
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select * from logindet order by id desc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selusrdet($id)
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select * from logindet where id='".$id."'",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function createmarksheet($ano)
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.gender,s.image,a.dateofadmission,e.programid,e.assignment,e.casestudies,e.testmark,e.exam,e.examdate,e.posteddate,e.totalmark from admission_details a,student_info s inner join scholistic e where s.id=e.studentid and s.id = a.studentid and s.admissionno='".$ano."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) order by s.firstname asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function idcard($ano)
{	
	$link = open_database_connection();	
	$studall=array();	
	$result=mysql_query("select s.id,s.admissionno,s.firstname,s.middlename,s.lastname,s.gender,s.image,a.dateofadmission,a.admittedfor from admission_details a inner join student_info s where s.id = a.studentid and s.admissionno = '".$ano."' group by s.id order by s.firstname asc",$link);	
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selsubjectlist($id,$prgid)
{
	$link = open_database_connection();	
	$markdet=array();
	$result=mysql_query("select distinct(courseno) from courseattend where studentid='".$id."' and programid='".$prgid."' order by id asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$markdet[]=$data;
		}
	}
	close_database_connection($link);
	return $markdet;
}
function selsubjectmark($ano)
{
	$link = open_database_connection();	
	$markdet=array();
	$result=mysql_query("select c.*,s.admissionno,s.firstname,s.middlename,s.lastname,s.gender,e.programid,e.examdate,a.dateofadmission,a.admittedfor from admission_details a,courseattend c,student_info s inner join scholistic e where s.id=e.studentid and s.id=a.studentid and s.id=c.studentid and c.programid=a.admittedfor and s.admissionno='".$ano."' and e.id in(SELECT m1.id FROM scholistic m1 LEFT JOIN scholistic m2 ON (m1.studentid = m2.studentid AND m1.id < m2.id) WHERE m2.id IS NULL ) and c.id in(SELECT m1.id FROM courseattend m1 LEFT JOIN courseattend m2 ON (m1.studentid = m2.studentid AND m1.courseno = m2.courseno AND m1.id < m2.id)WHERE m2.id IS NULL) order by courseno asc",$link);
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{ 	
			$markdet[]=$data;
		}
	}
	close_database_connection($link);
	return $markdet;
}
function welcomeletter($ano)
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select * from student_info where admissionno='".$ano."'",$link); 	
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selreceipt($rno)
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select * from receipt where receiptno='".$rno."'",$link); 	
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}
function selprov($ano)
{	
	$link = open_database_connection();	
	$studall=array();
	$result=mysql_query("select id from provisional where admissionno='".$ano."'",$link); 	
	if($result>0)
	{
		while($data=mysql_fetch_assoc($result))
		{
			$studall[]=$data;
		}
	}
	close_database_connection($link);
	return $studall;
}

?>