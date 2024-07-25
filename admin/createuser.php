<?php include "header.php";
include "sidebar.php";
/* if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['usid'])) 
{	
	header('location:index.php');
	exit;	
} */
$_SESSION['title']='nodata';
$_SESSION['uname']='nodata';
$name = $email = $username = $password = $output = $result='';
$success='';

$date=date('Y-m-d');
if($_POST && $_SESSION['title'] != trim($_POST['emailid']) && $_SESSION['uname'] != trim($_POST['uname'])) {
	// collect all input and trim to remove leading and trailing whitespaces  
	$name = trim($_POST['fname']); 	
	$uname = trim($_POST['uname']);
	$email = trim($_POST['emailid']);  
	$password = trim($_POST['pswd']);
	$cpassword=trim($_POST['cpswd']);
	$_SESSION['title']=$email;
	$_SESSION['uname']=$uname;
	$errors = array();
	// Validate the input 
	if (strlen($name) == 0)
    array_push($errors, "Please enter your name");
	if (strlen($uname) == 0)
    array_push($errors, "Please enter username"); 	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		array_push($errors, "Please specify a valid email address");    
	if (strlen($password) < 5)
		array_push($errors, "Please enter a password. Passwords must contain at least 5 characters.");		
	if (strlen($cpassword) == 0)
		array_push($errors, "Please enter a valid username");
	if(strlen($password) >0 && strlen($cpassword)>0)
	{
		if($password != $cpassword)
		{
			array_push($errors, "Password and Confirm Password not match");
		}
	}  
	if(empty($errors)){		
		$member_details_data['name']=$_POST['fname'];
		$member_details_data['username']=$_POST['uname'];				
		$member_details_data['password']=md5($_POST['pswd']);
		$member_details_data['emailid']=$_POST['emailid'];	
		$member_details_data['usertype']=$_POST['ustype'];
		$member_details_data['dateofpost']=$date;			
		$member_details_id=insert('userdet',$member_details_data);
		unset($_POST['submit']);		
		if($member_details_id == "exists") {
			array_push($errors,'Username or Email id already exists');
		}
		else if ($member_details_id > 0 )
		{	
			$success="<p class='outputs'>User Profile Created Successfully</p>";			
			//header('location:createuser.php');			
		}
		else
		{
			array_push($errors,'Process Failed');
		}		
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='outputf'>$val</p>";
	}
}
?> 
<div class="content">
	<div class="header">            
		<h1 class="page-title">Create User</h1>
		<ul class="breadcrumb">
			<li><a href="users.php">Home</a> </li>          
			<li class="active">Create User</li>
		</ul>
	</div>
	<div class="main-content">            
		<ul class="nav nav-tabs">
			<li class="active"><span style="color: #555;cursor: default;background-color: #fff;border: 1px solid #ddd;border-bottom-color: transparent;padding-left:10px;padding-right:10px;padding-top:10px;">Create User</span></li> 
		</ul>
<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      <form name="usfrm" action="" id="cusreg" method="post"> 
		<?php echo $output; ?>   
		<?php echo $success; ?>		
        <div class="form-group">
        <label>Name</label>
        <input type="text" value="" name="fname" required class="form-control">
        </div>       
        <div class="form-group">
        <label>Email</label>
        <input type="email" value="" name="emailid" required class="form-control">
        </div>
		<div class="form-group">
			<label>User Type</label>
			<select name="ustype" id="ustype" class="form-control">
				<option value="0">Admin</option>
				<option value="1">Staff</option>
				<option value="2">Student</option>
			</select>
		</div>
		 <div class="form-group">
        <label>Username</label>
        <input type="text" value="" name="uname" required class="form-control">
        </div>
		 <div class="form-group">
            <label>Password</label>
            <input type="password" name="pswd" required id="pswd" class="form-control">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="cpswd" required class="form-control">
          </div>
			<div class="btn-toolbar list-toolbar">
				<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>   
			</div>
        </form>
      </div>
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
	
    $("#cusreg").validate({    
        // Specify the validation rules
        rules: {
			fname:"required",
			emailid: {
                required: true,
                email: true
            },
			uname: "required",
			pswd: {
                required: true,
                minlength: 5
            },
			cpswd: {
                required: true,
                equalTo: "#pswd"
            }
        },        
        // Specify the validation error messages
        messages: { 				
            fname: "Enter your name",           
			emailid: "Enter a valid email address",
			uname:"Enter Username",
			pswd: {
                required: "Provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
			cpswd: {
                required: "Provide a confirm password",
                equalTo: "password and confirm password not match"
            }
        },        
        submitHandler: function(form) {		
            form.submit();
        }
    });
});  
setTimeout( "$('.outputs,.outputf').hide();", 4000);
</script>