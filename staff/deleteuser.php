<?php
include "config.php";
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d h:m:s');
$id='';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}

$res=mysqli_query($conn,"delete from userdet where id='".$id."'");	
if($res>0)
{	
	msg("User removed successfully","viewuser.php"); 
}
else
{
	msg("Process failed","viewuser.php");
}

?>
<?php
function msg($msg,$url)
{?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
window.location="<?php echo $url; ?>";
</script>
<?php } ?>