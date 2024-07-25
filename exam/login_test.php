<?php
include ("config.php");	
// wordpress' username that his password going to compare
$user = $_POST['username'];
$pcode = $_POST['prgcode'];
$scode = $_POST['subcode'];
$user_name = htmlspecialchars($user,ENT_QUOTES);

// plain password to compare
$password = md5($_POST['pswd']);

//$hasher = new PasswordHash(8, TRUE);

// get user_name's hashed password from wordpress database

	$qry="SELECT * FROM userdet WHERE username='$user' and usertype=2"; 
	$result=mysqli_query($conn,$qry);
	if($result != false)
	{
		$numrec=mysqli_num_rows($result);
		if($numrec>0)
		{		
			session_start();
			$member=mysqli_fetch_assoc($result);		
			$_SESSION['username']=$member['username'];
			$_SESSION['usrid']=$member['id'];
			$_SESSION['usremail']=$member['emailid'];
			$_SESSION['pc']=$_POST['prgcode'];
			$_SESSION['sc']=$_POST['subcode'];			
			$passnya = $member['password'];
			session_write_close();			
		}
		if ($password==$passnya){
			$qry1="SELECT * FROM rim_quizmain WHERE Category='$pcode' and Title='$scode'"; 
			$result1=mysqli_query($conn,$qry1);
			if($result1 > 0)
			{
				$numrec1=mysqli_num_rows($result1);
				if($numrec1 > 0)
				{	
					session_start();
					$rec = mysqli_fetch_assoc($result1);
					$_SESSION['t'] = $rec['Etype'];
					session_write_close();	
					redir("quiz.php");
					exit();
				}
				else
				{
					redirect("Invalid Codes","index.php");
				}
			}
			else
			{
				redirect("Invalid Codes","index.php");
			}
		}	
		else
		{
			/* redirect("Password you entered is incorrect... try again","index.php?c=".$_POST['cate']."&t=".$_POST['typ']); */			
			redirect("Password you entered is incorrect... try again","index.php");
		}
	}
	else
	{
		redirect("Check your Username and Password...","index.php");
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