<?php
include "config.php";
$grpid='';
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d');
$id='';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
$res=mysqli_query($conn,"update userdet set name='".$_POST['name']."',emailid='".$_POST['email']."' where id='".$id."'");

if($res>0)
{	
	msg("User details updated successfully","viewuser.php");
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