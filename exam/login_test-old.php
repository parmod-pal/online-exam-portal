<?php
	include ("config.php");	
	$tbl='';$login='';$pswd='';	
	$login=$_POST['username'];
	$pswd=md5($_POST['pswd']);
	//$pswd=md5($pswd);	
	$qry="SELECT * FROM wp_users WHERE user_login='$login' AND user_pass='$pswd'"; 
	$result=mysqli_query($conn,$qry);
	if($result != false)
	{
		$numrec=mysqli_num_rows($result);
		if($numrec>0)
		{		
			session_start();
			$member=mysqli_fetch_assoc($result);		
			$_SESSION['username']=$member['display_name'];
			$_SESSION['usrid']=$member['ID'];
			$_SESSION['c']=$_POST['cate'];
			$_SESSION['t']=$_POST['typ'];
			session_write_close();
			redir("quiz.php");
			exit();
		}
		else
		{
			redirect("Password you entered is incorrect... try again","index.php?c=".$_POST['cate']."&t=".$_POST['typ']);			
		}
	}
	else
	{
		redirect("Check your Username and Password...","index.php?c=".$_POST['cate']."&t=".$_POST['typ']);
	}
?>
<?php
	function redirect($msg,$url)
	{
?>		<script type="text/javascript">		
			alert("<?php echo $msg;?>");	
			window.location="<?php echo $url;?>";	
		</script>
<?php
	}
?>
<?php
	function redir($url)
	{
?>		<script type="text/javascript">					
			window.location="<?php echo $url;?>";	
		</script>
<?php
	}
?>