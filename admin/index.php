<?php include "header.php";
if(isset($_POST['login'])){
    $data=$_POST;
    $data_arr=array();
	$errors=array();
    if($data['res_user']!='')
    {
		$data_arr['username']=$data['res_user'];
    }
    else
    {
		$errors[]='Please enter Username';
    }
	if($data['res_pass']!='')
    {
		$data_arr['password']=md5($data['res_pass']);
    }
    else
    {
		$errors[]='Please enter password';
    }	
	$remember=isset($data['remember']);
	if(empty($errors))
	{		
		if(is_valid_data('userdet',$data_arr))
		{
			$profile_member_details	= _get('userdet',1,0,$data_arr);
			$profile_member		= _get('userdet',1,0,array('id'=>$profile_member_details[0]['id']));
			$memID=$profile_member[0]['id'];
			$username=$profile_member[0]['name'];
			$_SESSION['fullname']=$username;			
			if ($remember == "yes") //if the Remember me is checked, it will create a cookie.
			{
				setcookie("usid", $memID, time()+60*60*24*30, "/");
				setcookie("usname", $data['res_user'], time()+60*60*24*30, "/");
				setcookie("pswd", $data['res_pass'], time()+60*60*24*30, "/");
				setcookie("rem", 1, time()+60*60*24*30, "/");				
				$_SESSION['usid']=$memID;					
			}				
			else if ($remember=="") //if the Remember me isn't checked, it will create a session.
			{
				setcookie("usid", $memID, time()-3600, "/");
				setcookie("usname", $data['res_user'], time()-3600, "/");
				setcookie("pswd", $data['res_pass'], time()-3600, "/");
				setcookie("rem", 1, time()-3600, "/");
				$_SESSION['usid']=$memID;				 
			}
			echo "<script type='text/javascript'>location.href='viewpages.php'</script>";			
			exit;
			ob_flush();			
			
		}
		else
		{
		   $errors[]=' Login failed. Either Username or Password is invalid.';
		}
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='output'>$val</p>";
	}
}
?>
<div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Sign In</p>
        <div class="panel-body">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="loginfrm" class="lgnfrm">
				<?php echo $output; ?>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" required name="res_user" class="form-control span12">
                </div>
                <div class="form-group">
                <label>Password</label>
                    <input type="password" required name="res_pass" class="form-control span12 form-control">
                </div>
                <button type="submit" name="login" class="btn btn-primary pull-right">Sign In</button>
                <label class="remember-me"><input type="checkbox" name="remember" <?php if(isset($_COOKIE['rem'])) echo 'checked="checked"'; ?> value="yes"> Remember me</label>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>   
    <p><a href="reset-password.php">Forgot your password?</a></p>
</div>
<?php include "footer.php";?>
<script src="lib/jquery.validate.js"></script>
<!-- jQuery Form Validation code -->
<script>  
// When the browser is ready...
$(function() { 	
    // Setup form validation on the #register-form element	
	
    $(".lgnfrm").validate({    
        // Specify the validation rules
        rules: {			
			res_user: "required",
			res_pass: "required"
        },        
       
        messages: {            
			res_user: {
                required: "Provide a Username",               
            },
			res_pass: {
                required: "Provide a password"
               
            }
        },        
        submitHandler: function(form) {		
            form.submit();
        }
    });
});  
</script>