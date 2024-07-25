<?php include "header.php";
	$errors=array();
	if(isset($_POST['forpass'])) {  
		$femail = trim($_POST['femail']); 	 
		$errors = array();
		if (strlen($femail) == 0) 
			array_push($errors, "Please specify your registered email id");
		if (!filter_var($femail, FILTER_VALIDATE_EMAIL))
			array_push($errors, "Please specify a valid email address"); 
		if(empty($errors)){		
			$member_details_data['emailid']=$femail;	
			$member_details_id=chgpass('userdet',$member_details_data,array('emailid'=>$femail));		
			unset($_POST['forpass']);		
			if ($member_details_id > 0) {
				//header('location:index.php');
				array_push($errors,'Password reset link sent to your mail id');
			}
			else 
			{
				array_push($errors,'Either incorrect email id or process failed');
			}
		}	
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='output'>$val</p>";
	}
?> 

<div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Reset your password</p>
        <div class="panel-body">
            <form action="" method="post" id="fpass" >
			<?php echo $output;?>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="femail" required class="form-control span12 form-control" />
                </div>
                <button type="submit" name="forpass" class="btn btn-primary pull-right">Reset Password</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <a href="./" style="font-size: .75em; margin-top: .25em;">Sign in to your account</a>
</div>
   <?php include "footer.php";?>
   
<script src="lib/jquery.validate.js"></script>
<!-- jQuery Form Validation code -->
<script>  
// When the browser is ready...
$(function() { 	
    // Setup form validation on the #register-form element		
    $("#fpass").validate({    
        // Specify the validation rules
        rules: {			
			femail: {
                required: true,
                email: true
            }
        },        
        // Specify the validation error messages
        messages: {                       
			femail: "Enter a valid email address"			
        },        
        submitHandler: function(form) {		
            form.submit();
        }
    });
});  
</script>