<?php
session_start();
if(isset($_SESSION['qname']	))
{
	unset($_SESSION['qname']);
}
if(isset($_SESSION['qdesc']	))
{
	unset($_SESSION['qdesc']);
}
if(isset($_SESSION['qdate']	))
{
	unset($_SESSION['qdate']);
}
if(isset($_SESSION['qstime']))
{
	unset($_SESSION['qstime']);
}
if(isset($_SESSION['qetime']))
{
	unset($_SESSION['qetime']);
}
if(isset($_SESSION['qduration']))
{
	unset($_SESSION['qduration']);
}
if(isset($_SESSION['tques']))
{
	unset($_SESSION['tques']);
}
redirect();
?>
<?php
function redirect()
{
?>
	<script type="text/javascript">
		window.location="ques.php";
	</script>
<?php
}	
?>