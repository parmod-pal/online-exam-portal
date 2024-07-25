<?php	
	$id="";
	include "config.php";
	if(isset($_POST['submit']))
	{	
		if(isset($_POST['checkbox']))
		{
			foreach($_POST['checkbox'] as $id)
			{				
				$res=mysqli_query($conn,"delete from userdet where id='".$id."'");							
			}
			if($res>0)
			{
				msg("User removed successfully","viewuser.php"); 
			}
			else
			{
				msg("Process failed","viewuser.php");
			}	
		}	
		else
		{			
			msg("Select one user to delete","viewuser.php");			
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