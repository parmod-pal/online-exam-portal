<?php
include "config.php";
$grpid='';
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d h:m:s');
$id='';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
$quizname=str_replace("'","^",$_POST['quizname']);

$descr=str_replace("'","^",$_POST['desc']);
$res=mysqli_query($conn,"update rim_quizmain set Title='".$quizname."',Category='".$_POST['category']."',Etype='".$_POST['typ']."',Description='".$descr."',Duration='".$_POST['duration']."',Startdate='".$_POST['startdate']."',Starttime='".$_POST['time']."',Endtime='".$_POST['time1']."' where Id='".$id."'");	
if($res>0)
{	
	msg("Exam/Test details updated successfully","viewexam.php"); 
}
else
{
	msg("Process failed","viewexam.php");
}
?>
<?php
function msg($msg,$url)
{
?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
window.location="<?php echo $url; ?>";
</script>
<?php } ?>