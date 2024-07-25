<?php
include "config.php";
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d h:m:s');
$id='';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
$res=mysqli_query($conn,"delete from rim_quizmain where Id='".$id."'");	
$res=mysqli_query($conn,"delete from rim_quizquestion where Quizid='".$id."'");	
if($res>0)
{	
	msg("Exam/Test removed successfully","viewexam.php"); 
}
else
{
	msg("Process failed","viewexam.php");
}
?>
<?php
function msg($msg,$url)
{?>
<script type="text/javascript">
alert ("<?php echo $msg; ?>");
window.location="<?php echo $url;?>";
</script>
<?php } ?>