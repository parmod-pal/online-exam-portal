<?php
if($_SERVER['SERVER_NAME'] == 'localhost')
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname="rimsr";
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

function select($sql)
{
	global $conn;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {	
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$res=  $row["description"];
		}
	   
	} else {
		$res= "No Content";
	}	
	return $res;
}
function selectall($sql)
{
	global $conn;
	$rows = array();
	$result = $conn->query($sql);
	if($result)
	{
		if ($result->num_rows > 0) {	
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$rows[]=  $row;
			}
		} 
	}
	return $rows;
}
?>