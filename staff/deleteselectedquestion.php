<?php	
	$id="";
	include "config.php";
	if(isset($_POST['submit']))
	{	
		if(isset($_POST['checkbox']))
		{
			foreach($_POST['checkbox'] as $id)
			{								
				$res=mysqli_query($conn,"delete from rim_quizquestion where Id='".$id."'");							
			}
			if($res>0)
			{
				msg("Questions removed successfully","viewexam.php"); 
			}
			else
			{
				msg("Process failed","viewexam.php");
			}	
		}	
		else
		{			
			msg("No Question Selected","viewexam.php");			
		}
	}	
?>
<?php
	function msg($msg,$url)
	{
?>
	<script type="text/javascript">
		alert("<?php echo $msg;?>");
		window.location="<?php echo $url;?>";
	</script>
<?php 
	} 
?>