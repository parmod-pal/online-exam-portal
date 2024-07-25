<?php
if($_SERVER['SERVER_NAME'] == 'localhost')
{
    
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname="rimsradmin";
}
else
{
	$servername  = "localhost";
	$username  = 'rimsrcsp_rimsr';	
	$password   = 'rimsrcsp_rimsr';
	$dbname  = "rimsrcsp_rimsrweb";
}
global $conn;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
		$sql = "SELECT * FROM $table $sub_cond ";
		if($toshow > 0)
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
		$cond= ' where 1 and usertype < 2';
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
?>