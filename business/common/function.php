<?php
if(!isset($_SESSION)){session_start();}

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	$server="localhost";
	$user="root";
	$pswd="";
	$dbname="rimsrgame";
}
else
{
	$server="localhost";
	$user="rimsrcsp_rimsr";
	$pswd="rimsrcsp_rimsr";
	$dbname="rimsrcsp_rimsrgame"; 
}


global $con;
$con=mysqli_connect($server,$user,$pswd,$dbname);
if(mysqli_connect_errno($con))
{
	echo "Failed to connect MySQL";
	mysqli_connect_error();
	die();
}
function randomNum()
{
	$result='';
	for($i=0;$i<6;$i++)
	{
		$result .= mt_rand(0,9);
	}
	return $result;
}
function array_map_callback($a)
{
	global $con;
	$dbcon = $con;
	return mysqli_real_escape_string($dbcon, $a);
}
function select($qry)
{
	global $con;
	$dbcon=$con;
	$result=mysqli_query($dbcon,$qry);
	
	if($result===false)
	{
		
		die(mysqli_error($dbcon));
	}
	else
	{
		
		
		if(!$result || mysqli_num_rows($result) <=0 || mysqli_num_fields($result) <=0)
		{
			
		//return $myArray;
		//exit;
		return false;
		}
		while($r=mysqli_fetch_assoc($result))
		{
			$rArray[]=$r;
		}
		mysqli_free_result($result);
		
		
		return $rArray;
	}
}
function chkpayment($table,$data)
{
	global $con;
	$dbcon=$con;
	$values='';$id=0;
	if(! empty($data))
	{
		if($table=="basicinfo" || $table=="prodinfo" || $table=="inventory" || $table=="directcost" || $table=="indirectcost" || $table=="finance_deposit_investment" || $table=="prod_sales_cost" || $table=="salesparticular")
		{
			$res=mysqli_query($dbcon,"select id from $table where userid='".$data['userid']."' and payment_id='".$data['payment_id']."'");
			if($res === FALSE) {
				die(mysqli_error($dbcon));
			}
			else
			{				
				if(mysqli_num_rows($res) > 0)
				{					
					$id=1;
				}
			} 
		}		
		if($table=="manpowerdet" )
		{
			$res=mysqli_query($dbcon,"select id from $table where userid='".$data['userid']."' and payment_id='".$data['payment_id']."' and category='".$data['category']."'");
			if($res === FALSE) {
				die(mysqli_error($dbcon));
			}
			else
			{				
				if(mysqli_num_rows($res) > 0)
				{					
					$id=1;
				}
			} 
		}
			
	}
	return $id;
}

function insert($table,$data)
{
	global $con;
	$dbcon=$con;
	$values='';$id=0;
	if(! empty($data))
	{
		$chk=0;	
		
		if($table=="userdet" )
		{
			$res=mysqli_query($dbcon,"select emailid from $table where emailid='".$data['emailid']."'");
			if($res === FALSE) {
				die(mysqli_error($dbcon));
			}
			else
			{				
				if(mysqli_num_rows($res) > 0)
				{					
					$chk=2;
				}
			} 
		}
					
		
		if($chk==0)
		{
			$columns =implode(", ",array_keys($data));
			$escaped_values = array_map('array_map_callback',array_values($data));
			foreach($escaped_values as $val)
			{
				if(gettype($val) == 'string')
				$values .="'".$val."',";
				if(gettype($val) == 'integer')
				$values .= $val.",";
			}
			$values=substr($values,0,-1);
			$qry="insert into $table ($columns) values ($values)";
			$result=mysqli_query($dbcon,$qry);
			
			if($result === false){
				//die(mysqli_error($dbcon));
				$id=mysqli_error($dbcon);
			}
			else
			{
				$data='';
				$id=mysqli_insert_id($dbcon);
			}	
		}
		else if($chk==2)
		{
			$id="exists";
		}	
	}
	return $id;
}
function update($table,$data,$cond,$t="")
{
	global $con;
	$dbcon = $con;		
	if(!empty($data))
	{	
		$chk=0;
		$update_feild=''; 
		foreach($data as $key=> $val)
		{
			if(gettype($val)=="string")
				$update_feild.=$key."="."'".$val."'," ;
			if(gettype($val)=="integer")
			{
				$update_feild.=$key."=".$val."," ; 
			}
			else
			{
				$update_feild.=$key."="."'".$val."'," ;
			}	
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
		if($table=="userdet")
		{	
			$chk=0;
			$sub_conds = " where 1 ";
			if(count($cond)>0)
			{
				foreach ($cond as $k=>$v)
				{
					$sub_conds  .= " and $k !='$v' ";
				}
			}
			$qry1 = "select * from $table $sub_conds and emailid = '".$data['emailid']."'";
			if($qry1 != '')
			$result1=mysqli_query($dbcon,$qry1);	
			if($result1 === FALSE) {
				die(mysqli_error($dbcon));
			}
			else
			{				
				if(mysqli_num_rows($result1) > 0)
				{					
					$chk=1;
				}
			} 
		}
		
		
		if($chk == 0)
		{
			$qry = "UPDATE $table SET $update_feild $sub_cond";  
			if($qry!='')
				$result=mysqli_query($dbcon,$qry);
			if($result === FALSE) {
				//die(mysqli_error($dbcon));
				 return mysqli_error($dbcon);
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

function updatestat($table,$data,$cond,$t="")
{
	global $con;
	$dbcon = $con;		
	if(!empty($data))
	{	
		$chk=0;
		$update_feild=''; 
		foreach($data as $key=> $val)
		{
			if(gettype($val)=="string")
				$update_feild.=$key."="."'".$val."'," ;
			if(gettype($val)=="integer")
			{
				$update_feild.=$key."=".$val."," ; 
			}
			else
			{
				$update_feild.=$key."="."'".$val."'," ;
			}	
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
		
		$qry = "UPDATE $table SET $update_feild $sub_cond";  
		if($qry!='')
			$result=mysqli_query($dbcon,$qry);
		if($result === FALSE) {
			//die(mysqli_error($dbcon));
			 return mysqli_error($dbcon);
		}
		else
		{					
			return $result;
		} 
					
	}
}

function trunc_temp($table)
{
	global $con;
	$dbcon = $con;
	$qry = "truncate table $table";  
	if($qry!='')
		$result=mysqli_query($dbcon,$qry);
	
	if($result === FALSE) {
		die(mysqli_error($dbcon));
	}
	else
	{
		return $result;
	}	
}

function delval($table,$cond)
{
	global $con;
	$dbcon = $con;	
	$col='Id';$chk=0;
		
	if($table == "userdet")
	{
		$teamdet=select("select * from userdet where id=$cond");			
		if(count($teamdet)>0)
		{	
			foreach($teamdet as $tm => $data)
			{				
				$tmlogo=$data['profimg'];
				unlink('../img/userimg/'.$tmlogo);				
			}
		}
		$col='id';
	}
	
	$qry = "delete from $table where $col =".$cond;  
	if($qry!='')
		$result=mysqli_query($dbcon,$qry);
	
			
	
	if($result === FALSE) {
		die(mysqli_error($dbcon));
	}
	else
	{
		return $result;
	}		
}

function approve($table,$cond)
{
	global $con;
	$dbcon = $con;
	$qry = "update $table set Status='Active' where Id =".$cond;	
	
	if($qry!='')
		$result=mysqli_query($dbcon,$qry);
	if($result === FALSE) {
		die(mysqli_error($dbcon));
	}
	else
	{
		/* if($table=="membership")
		{
			$emailid=$gvname='';
			$quotes=select("select * from membership where Id='".$cond."'");			
			if(count($quotes)>0 && $quotes[0] !='')
			{											
				foreach($quotes as $pages => $fquote)
				{
					$emailid=$fquote['Email'];
					$gvname=$fquote['Given_Name'];
				}
			}
			if($emailid !=''){
			$to=$emailid;
			$from="info@acclub.com";
			$subject="Registration Confirmation Mail";
			$msg='Dear '.$gvname.',<br/>
			Congrats! your membership is approved by our club.<br/> Login to our website and get your team & employee id details.<br/><br/>

			Regards,
			Zipcaars';
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers .= 'From: '.$from."\r\n".
				'Reply-To: '.$from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			$mailsent=mail("$to","$subject","$msg",$headers);
			}
		} */
		return $result;
	}		
}
function unapprove($table,$cond)
{
	global $con;
	$dbcon = $con;	
	$qry = "update $table set Status='InActive' where Id =".$cond;
	
	if($qry!='')
		$result=mysqli_query($dbcon,$qry);
	if($result === FALSE) {
		die(mysqli_error($dbcon));
	}
	else
	{
		/* if($table=="membership")
		{
			$emailid=$gvname='';
			$quotes=select("select * from membership where Id='".$cond."'");			
			if(count($quotes)>0 && $quotes[0] !='')
			{											
				foreach($quotes as $pages => $fquote)
				{
					$emailid=$fquote['Email'];
					$gvname=$fquote['Given_Name'];
				}
			}
			if($emailid !=''){
			$to=$emailid;
			$from="info@acclub.com";
			$subject="Registration Confirmation Mail";
			$msg='Dear '.$gvname.',<br/>
			Congrats! your membership is approved by our club.<br/> Login to our website and get your team & employee id details.<br/><br/>

			Regards,
			Zipcaars';
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers .= 'From: '.$from."\r\n".
				'Reply-To: '.$from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			$mailsent=mail("$to","$subject","$msg",$headers);
			}
		}*/
		return $result; 
	}		
}
?>