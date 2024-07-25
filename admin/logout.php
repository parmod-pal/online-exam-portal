<?php
session_start();
session_unset();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
setcookie(session_name(), '', time()-42000, '/');}
setcookie("usid", 1, time()-3600, "/");
setcookie("usname", 1, time()-3600, "/");
setcookie("pswd", 1, time()-3600, "/");
setcookie("rem", 1, time()-3600, "/");
unset($_SESSION['fullname']);
session_destroy();
header('location:./');
?>