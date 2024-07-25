<?php
session_start();
session_unset();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');}
session_destroy();
redirect();
//header("location:index.php");
?>
<?php
function redirect()
{?>
<script type="text/javascript">
window.location="http://rimsr.in/exam/";
</script>
<?php } ?>