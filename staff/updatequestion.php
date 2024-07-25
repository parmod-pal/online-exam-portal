<?php
include "config.php";
$grpid='';
date_default_timezone_set("Asia/Calcutta");$date=date('Y-m-d h:m:s');
$id='';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}	
$desc=str_replace("'","^",trim($_POST['description']));
$que=str_replace("'","^",trim($_POST['ques']));
$que = preg_replace('/$(\r\n\r\n)/', '',$que);
$desc = preg_replace('/$(\r\n\r\n)/', '',$desc);
$cans=$_POST['cans'];
$mark=$_POST['mark'];
$res=mysqli_query($conn,"update rim_quizquestion set Question='".$que."',Answer='".$desc."',Correctans='".$cans."',Mark='".$mark."' where Id='".$id."'");	
if($res>0)
{	
	msg("Question details updated successfully","viewexam.php"); 
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