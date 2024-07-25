<?php
include "common/function.php";
date_default_timezone_set('asia/kolkata');
$exdat='';
$cudat=date('Y-m-d H:i:s');
$exdat=$_POST['exp'];

$date_a = new DateTime($exdat);
$date_b = new DateTime($cudat);
$interval = date_diff($date_a,$date_b);
echo $interval->format('%h:%i:%s');
?>