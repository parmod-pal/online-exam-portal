<?php
	//Connect to the server
if($_SERVER['SERVER_NAME'] == 'localhost')
{
	$server  = "localhost";
	$dbuser  = 'root';
	$dbpwd   = '';
	$dbname  = "rimsr";
}
else
{
	$server  = "localhost";
	$dbuser  = 'rimsrcsp_rimsr';
	$dbpwd   = 'rimsrcsp_rimsr';
	$dbname  = "rimsrcsp_rimsrweb";


// 	$servername  = "localhost";
// 	$username  = 'rimsrcsp_rimsr';
// 	$password   = 'rimsrcsp_rimsr';
// 	$dbname  = "rimsrcsp_rimsrweb";
}

//echo md5('rimsr@123');die
	global $conn ;
	$conn = mysqli_connect($server, $dbuser, $dbpwd,$dbname);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

	function randomNumber() {
		$result='';
		for($i = 0; $i < 6; $i++) {
			$result .= mt_rand(0, 9);
		}
		return $result;
	}
	function _get($table,$toshow=-1,$page=0,$cond=array(),$order_name='id',$order_type='ASC')
    {
		global $conn;
		$dbconnection = $conn;
		$sub_cond   = ' WHERE 1 ';
		$limit  = '';
		if(count($cond)>0)
		{
			foreach ($cond as $k=>$v)
			{
				if($k=='ext_cnd')
					$sub_cond   .= " AND $v";
				elseif($k=='group')
					$sub_cond   .= " GROUP BY $v";
				elseif($v!='' && $v!=-1)
					$sub_cond   .= " AND $k='$v' ";
			}
		}
		$sql    = "SELECT * FROM $table $sub_cond ";
		if($toshow>0)
		$limit	= ' limit '.$page.','.$toshow;
		$sql    .= ' order by '.$order_name.' '.$order_type.' '.$limit;
		$result = mysqli_query($dbconnection,$sql);
		if(!$result || mysqli_num_rows($result) <= 0)
		{
			return false;
		}
		while($r = mysqli_fetch_assoc($result)) {
			$rArray[] = $r;
		}
		mysqli_free_result($result);
		return $rArray;
	}
	function is_valid_data($table,$arr)
    {
		global $conn;
		$dbconnection = $conn;
		$cond= ' where 1';
		if(count($arr)>0)
		{
			foreach($arr as $k => $v)
			{
				$cond.= ' AND '.$k. '=\''.$v.'\'';
			}
		}
		$qry =" select * from ".$table.$cond;
		$result = mysqli_query($dbconnection,$qry);
		if(!$result || mysqli_num_rows($result) <= 0)
		{
		  return FALSE;
		}
		else
		return true;

		return $qry;
    }
	function chgpass($table,$data,$cond)
    {
		global $conn;
		$dbconnection = $conn;
		if(!empty($data))
		{
			$update_feild='';
			foreach($data as $key=> $val)
			{
				if(gettype($val)=="string")
				$update_feild.=$key."="."'".$val."'," ;
				if(gettype($val)=="integer")
				$update_feild.=$key."=".$val."," ;
			}
			$update_feild= substr($update_feild, 0, -1);
			$sub_cond   = ' WHERE 1 ';
			if(count($cond)>0)
			{
				foreach ($cond as $k=>$v)
				{
					if($k=='ext_cnd')
					$sub_cond   .= " AND $v";
					else
					$sub_cond   .= " AND $k='$v' ";
				}
			}
			$qry = "select * from $table " .$sub_cond;
			if($qry!='')
			$result=mysqli_query($dbconnection,$qry);
			if($result === FALSE) {
				die(mysqli_error($dbconnection)); // TODO: better error handling
			}
			else
			{
				if(mysqli_num_rows($result)>0)
				{
					$to=$data['emailid'];
					$from='info@rimsr.in';
					$subject='Password Reset Link';
					$secode=randomNumber();
					$msg='Dear Customer<br/> As per your request to create a new password, click the below link or copy paste the url to the address bar and change your password.<br/><a href="" target="">http://rimsr.in/blogcp/newpass.php?s='.$secode.'&m='.$data['emailid'].'<br/><br/> Thanks & Regards<br/>Customer Support Team';
					$mailsent=mail("$to","$subject","$msg","From:$from/ncontent-type=text/html");
					if($mailsent >0)
					{
						$qry = "UPDATE $table SET secretcode='".$secode."' where emailid='".$data['emailid']."'";
						if($qry!='')
						$result=mysqli_query($dbconnection,$qry);
						if($result === FALSE) {
							die(mysqli_error($dbconnection)); // TODO: better error handling
						}
						else
						{
							return $result;
						}
					}
					else
					{
						return 0;
					}
				}
			}
		}
	}
	function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

		return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	function updatenewpass($table,$data,$cond)
    {
		global $conn;
		$dbconnection = $conn;
		if(!empty($data))
		{
			$update_feild='';
			foreach($data as $key=> $val)
			{
				if(gettype($val)=="string")
				$update_feild.=$key."="."'".$val."'," ;
				if(gettype($val)=="integer")
				$update_feild.=$key."=".$val."," ;
			}
			$update_feild= substr($update_feild, 0, -1);
			$sub_cond   = ' WHERE 1 ';
			if(count($cond)>0)
			{
				foreach ($cond as $k=>$v)
				{
					if($k=='ext_cnd')
					$sub_cond   .= " AND $v";
					else
					$sub_cond   .= " AND $k='$v' ";
				}
			}
			$qry = "select * from $table " .$sub_cond;
			if($qry!='')
			$result=mysqli_query($dbconnection,$qry);
			if($result === FALSE) {
				die(mysqli_error($dbconnection)); // TODO: better error handling
			}
			else
			{
				if(mysqli_num_rows($result)>0)
				{
					$qry = "UPDATE $table SET $update_feild " .$sub_cond;
					if($qry!='')
					$result=mysqli_query($dbconnection,$qry);
					if($result === FALSE) {
						die(mysqli_error($dbconnection)); // TODO: better error handling
					}
					else
					{
						return $result;
					}
				}
				else
				{
					return 0;
				}
			}
		}
	}
    function insert($table,$data)
    {
		global $conn;
		$tickid=$values='';$id=0;
		$dbconnection = $conn;
		if(!empty($data))
		{
			$chk=0;
			if($table == "userdet")
			{
				$qry = "select * from $table where emailid ='".$data['emailid']."' and username = '".$data['username']."'";
				if($qry!='')
				$result=mysqli_query($dbconnection,$qry);
				if($result === FALSE) {
					die(mysqli_error($dbconnection)); // TODO: better error handling
				}
				else
				{
					if(mysqli_num_rows($result) > 0)
					{
						$chk=2;
					}
				}
			}

			if($table == "category")
			{
				$qry = "select * from $table where categoryname ='".$data['categoryname']."' and Category_type ='".$data['Category_type']."'";
				if($qry!='')
				$result=mysqli_query($dbconnection,$qry);
				if($result === FALSE) {
					die(mysqli_error($dbconnection)); // TODO: better error handling
				}
				else
				{
					if(mysqli_num_rows($result) > 0)
					{
						$chk=2;
					}
				}
			}
			if($chk==0)
			{
				$columns = implode(", ",array_keys($data));
				$escaped_values = array_map('array_map_callback', array_values($data));
				foreach($escaped_values as $val)
				{
					if(gettype($val)=="string")
					$values  .="'".$val."'," ;
					if(gettype($val)=="integer")
					$values  .=$val."," ;
				}
				$values= substr($values, 0, -1);
				$qry = "INSERT INTO $table ($columns) VALUES ($values)";
				if($qry!='')
					$result=mysqli_query($dbconnection,$qry);
				if($result === FALSE) {
					die(mysqli_error($dbconnection)); // TODO: better error handling
				}
				else
				{
					$data='';
					$id = mysqli_insert_id($dbconnection);
				}
				/* if($table=="newsevents")
				{
					$qry = "select emailid from subscribedet";
					$title=$cate='';
					$qrys = "select category,title from $table where id=$id";
					$results=mysqli_query($dbconnection,$qrys);
					if($results === FALSE) {
						die(mysqli_error($dbconnection)); // TODO: better error handling
					}
					else
					{
						$emails=array();
						if(mysqli_num_rows($results)>0)
						{
							while($rowvals=mysqli_fetch_assoc($results))
							{
								$cate=$rowvals['category'];
								$title=clean($rowvals['title']);
							}
						}
					}

					if($qry!='')
					$result1=mysqli_query($dbconnection,$qry);
					if($result1 === FALSE) {
						die(mysqli_error($dbconnection)); // TODO: better error handling
					}
					else
					{
						$emails=array();
						if(mysqli_num_rows($result1)>0)
						{
							$from='info@rimsr.in';
							$subject='Washington University of Barbados added new blog';
							$msg='Dear Student,<br/><br/> Click the below link to know about our new events/blog.<br/> <a href="http://rimsr.in/blog/'.$cate.'/'.$title.'/'.$id.'">http://rimsr.in/blog/'.$cate.'/'.$title.'/'.$id.'</a><br/><br/> Best Wishes<br/>Administration Team';
							// Always set content-type when sending HTML email
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: info@rimsr.in' . "\r\n";

							while($rowval=mysqli_fetch_assoc($result1))
							{
								$emails[]=$rowval['emailid'];
							}

							foreach($emails as $email)
							{
								$to=$email;
								$mailsent=mail($to,$subject,$msg,$headers);
							}
						}
					}
				} */
			}
			else if($chk==2)
			{
				$id="exists";
			}
		}
		return $id;
	}
	function select($qry)
    {
		global $conn;
		$dbconnection = $conn;
		if($qry!='')
		$result=mysqli_query($dbconnection,$qry);
		if($result === FALSE) {
			die(mysqli_error($dbconnection)); // TODO: better error handling
		}
		else
		{
			if(!$result || mysqli_num_rows($result) <= 0 || mysqli_num_fields($result) <= 0)
			{
				return false;
			}
			while($r = mysqli_fetch_assoc($result)) {
				$rArray[] = $r;
			}
			mysqli_free_result($result);
			return $rArray;
		}
    }
	function update($table,$data,$cond)
    {
		global $conn;
		$dbconnection = $conn;
		if(!empty($data))
		{
			$chk=0;
			$update_feild='';
			foreach($data as $key=> $val)
			{
				if(gettype($val)=="string")
					$update_feild.=$key."="."'".$val."'," ;
				if(gettype($val)=="integer")
					$update_feild.=$key."=".$val."," ;
			}
			$update_feild= substr($update_feild, 0, -1);
			$sub_cond   = ' WHERE 1 ';
			if(count($cond)>0)
			{
				foreach ($cond as $k=>$v)
				{
					$sub_cond   .= " AND $k='$v' ";
				}
			}
			if($table == "userdet")
			{
				$sub_conds = " where 1 ";
				if(count($cond)>0)
				{
					foreach ($cond as $k=>$v)
					{
						$sub_conds  .= " and $k !='$v' ";
					}
				}
				$qry = "select * from $table $sub_conds and emailid ='".$data['emailid']."' and username = '".$data['username']."'";
				if($qry != '')
				$result=mysqli_query($dbconnection,$qry);
				if($result === FALSE) {
					die(mysqli_error($dbconnection)); // TODO: better error handling
				}
				else
				{
					if(mysqli_num_rows($result) > 0)
					{
						$chk=1;
					}
				}
			}
			if($table == "category")
			{
				$sub_conds = " where 1 ";
				if(count($cond)>0)
				{
					foreach ($cond as $k=>$v)
					{
						$sub_conds  .= " and $k !='$v' ";
					}
				}
				$qry = "select * from $table $sub_conds and categoryname ='".$data['categoryname']."' and Category_type ='".$data['Category_type']."'";
				if($qry != '')
				$result=mysqli_query($dbconnection,$qry);
				if($result === FALSE) {
					die(mysqli_error($dbconnection)); // TODO: better error handling
				}
				else
				{
					if(mysqli_num_rows($result) > 0)
					{
						$chk=1;
					}
				}
			}
			if($chk == 0)
			{
				$qry = "UPDATE $table SET $update_feild " .$sub_cond;
				if($qry!='')
					$result=mysqli_query($dbconnection,$qry);
				if($result === FALSE) {
					die(mysqli_error($dbconnection)); // TODO: better error handling
				}
				else
				{
					return $result;
				}
			}
			else
			{
				$result="exists";
				return $result;
			}
		}
	}
	function updatepswd($table,$data,$cond)
    {
		global $conn;
		$dbconnection = $conn;
		if(!empty($data))
		{
			$chk=0;
			$update_feild='';
			foreach($data as $key=> $val)
			{
				if(gettype($val)=="string")
					$update_feild.=$key."="."'".$val."'," ;
				if(gettype($val)=="integer")
					$update_feild.=$key."=".$val."," ;
			}
			$update_feild= substr($update_feild, 0, -1);
			$sub_cond   = ' WHERE 1 ';
			if(count($cond)>0)
			{
				foreach ($cond as $k=>$v)
				{
					$sub_cond   .= " AND $k='$v' ";
				}
			}

			$qry = "select * from $table $sub_cond";
			if($qry != '')
			$result=mysqli_query($dbconnection,$qry);
			if($result === FALSE) {
				die(mysqli_error($dbconnection)); // TODO: better error handling
			}
			else
			{
				if(mysqli_num_rows($result) > 0)
				{
					$chk=1;
				}
			}
			if($chk == 1)
			{
				$qry = "UPDATE $table SET $update_feild " .$sub_cond;
				if($qry!='')
					$result=mysqli_query($dbconnection,$qry);
				if($result === FALSE) {
					die(mysqli_error($dbconnection)); // TODO: better error handling
				}
				else
				{
					return $result;
				}
			}
			else
			{
				$result="Password not match";
				return $result;
			}
		}
	}

	function delnews($table,$im,$cond)
    {
		global $conn;
		$dbconnection = $conn;
		// Identify directories
		if($table=="portfolio")
		{
			$source = "images/portfolio/$im/";
		}
		else
		{
			$source = "images/blogimg/$im/";
		}
	if(is_dir($source))
	{
		// Get array of all source files
		$files = scandir($source);
		// Cycle through all source files
		foreach ($files as $file){
			if (in_array($file, array(".",".."))) continue;
				unlink($source.$file);
		}
		rmdir($source);
	}
		$qry = "delete from $table where id =".$cond;
		if($qry!='')
			$result=mysqli_query($dbconnection,$qry);
		if($result === FALSE) {
			die(mysqli_error($dbconnection)); // TODO: better error handling
		}
		else
		{
			return $qry;
		}
	}
	function delval($table,$cond)
    {
		global $conn;
		$dbconnection = $conn;
		$qry = "delete from $table where id =".$cond;
		if($qry!='')
			$result=mysqli_query($dbconnection,$qry);
		if($result === FALSE) {
			die(mysqli_error($dbconnection)); // TODO: better error handling
		}
		else
		{
			return $qry;
		}
	}
	function apprv($table,$st,$cond)
    {
		global $conn;
		$dbconnection = $conn;
		if($st=='u')
		{
			$status='inactive';
		}
		else
		{
			$status='active';
		}
		$qry = "update $table set status='".$status."',approveby='admin',approvedon='".date('Y-m-d')."' where id =".$cond;
		if($qry!='')
			$result=mysqli_query($dbconnection,$qry);
		if($result === FALSE) {
			die(mysqli_error($dbconnection)); // TODO: better error handling
		}
		else
		{
			return $qry;
		}
	}
	function array_map_callback($a)
	{
		global $conn;
		$dbconnection = $conn;
		return mysqli_real_escape_string($dbconnection, $a);
	}
?>
