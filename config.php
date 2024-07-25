<?php 
	//Connect to the server
if($_SERVER['SERVER_NAME'] == 'localhost')
{
	$server  = "localhost";
	$dbuser  = 'root';	
	$dbpwd   = '';
	$dbname  = "rimsradmin";
}
else
{
	$server  = "localhost";
	$dbuser  = 'rimsrcsp_rimsr';	
	$dbpwd   = 'rimsrcsp_rimsr';
	$dbname  = "rimsrcsp_rimsrweb";
}

	global $conn ;	
	$conn = mysqli_connect($server, $dbuser, $dbpwd,$dbname) ;
	if (mysqli_connect_errno($conn))
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
		$cond= ' where 1 and usertype=2';
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
		  return FALSE;
		else
			return true;
    }
	
	function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

		return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
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
	
	function array_map_callback($a)
	{
		global $conn;
		$dbconnection = $conn;
		return mysqli_real_escape_string($dbconnection, $a);
	}
?>