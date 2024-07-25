<?php 
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
 	
?>