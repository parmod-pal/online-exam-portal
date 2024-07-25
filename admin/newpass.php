<?php include "header.php";
$secode =  $email = $output = $result='';
$errors = array();

$date=date('Y-m-d');
if(isset($_REQUEST['s']))
{
	$secode=$_REQUEST['s'];
}
if(isset($_REQUEST['m']))
{
	$email=$_REQUEST['m'];
}
if($secode == '' || $email =='' || $secode == 0)
{
	header('location:index.php');
	exit;
}
if(isset($_POST['submit'])) {
  
	$password = trim($_POST['password']);
	$cpassword=trim($_POST['cpassword']);
	$errors = array();
  
	// Validate the input 
	 
	if (strlen($password) < 5)
		array_push($errors, "Please enter a password. Passwords must contain at least 5 characters.");		
	if (strlen($cpassword) == 0)
		array_push($errors, "Please enter a confirm password");
	if(strlen($password) >0 && strlen($cpassword)>0)
	{
		if($password != $cpassword)
		{
			array_push($errors, "Password and Confirm Password not match");
		}
	}
	if(empty($errors)){
		$member_details_data['password']=md5($_POST['password']);
		$member_details_data['secretcode']=0;
		$member_details_id=updatenewpass('userdet',$member_details_data,array('secretcode'=>$secode,'emailid'=>$email));
		
		unset($_POST['submit']);
		if ($member_details_id > 0){
			header('location:index.php');
		}
		else 
		{
			array_push($errors,'Process Failed.');
		}
	}	
}
$output = '';
	foreach($errors as $val) {
		$output .= "<p class='output'>$val</p>";
	}
?> 
        <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Create New Password</p>
        <div class="panel-body">
            <form id="newpass" action="" method="post">     
				<?php echo $output;?>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" id="password" class="form-control span12">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control span12">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>                    
                </div>
                    <div class="clearfix"></div>
            </form>
        </div>
    </div>    
</div>
<?php include "footer.php";?>

<script src="lib/jquery.validate.js"></script>
<!-- jQuery Form Validation code -->
<script>  
// When the browser is ready...
$(function() { 	
    // Setup form validation on the #register-form element	  
	
	$("#newpass").validate({    
        // Specify the validation rules
        rules: {			
			password: {
                required: true,
                minlength: 5
            },
			cpassword: {
                required: true,
                equalTo: "#password"
            }
        },        
        // Specify the validation error messages
        messages: {            
			password: {
                required: "Provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
			cpassword: {
                required: "Provide a confirm password",
                equalTo: "Confirm password not match"
            }
        },        
        submitHandler: function(form) {		
            form.submit();
        }
    });
});  
</script>