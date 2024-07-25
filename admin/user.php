<?php include "header.php";
include "sidebar.php";

$uid=$name = $email = $username = $password = $output = $result='';
if(isset($_REQUEST['urid']))
{
	$uid=$_REQUEST['urid'];	
}
if($uid !='')
{
	$userdet=select("select * from userdet where id=$uid");			
	if(count($userdet)>0)
	{	
		foreach($userdet as $user => $data)
		{
			$name=$data['name'];
			$username=$data['username'];
			$email=$data['emailid'];
			$ustype=$data['usertype'];
		}
	}
}
else
{
	header('location:users.php');
	exit;
}

$date=date('Y-m-d');
if(isset($_POST['submit'])) {
	// collect all input and trim to remove leading and trailing whitespaces  
	$name = trim($_POST['fname']); 
	$uname = trim($_POST['uname']);
	$email = trim($_POST['emailid']);  
	
	$errors = array();
	// Validate the input 
	if (strlen($name) == 0)
    array_push($errors, "Please enter your name");
	if (strlen($uname) == 0)
    array_push($errors, "Please enter username"); 	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		array_push($errors, "Please specify a valid email address");    
	
	if(empty($errors)){				
		$member_details_data['name']=$_POST['fname'];
		$member_details_data['username']=$_POST['uname'];
		$member_details_data['emailid']=$_POST['emailid'];		
		$member_details_data['usertype']=$_POST['ustype'];
		$member_details_data['dateofpost']=$date;			
		$member_details_id=update('userdet',$member_details_data,array('id' => $_POST['uid']));
		unset($_POST['submit']);
		if ($member_details_id > 0)
		{			
			header('location:users.php');			
		}
		else
		{
			array_push($errors,'Either Email id already exists or Process Failed');
		}		
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='output'>$val</p>";
	}
}
if(isset($_POST['submit1'])) {
	// collect all input and trim to remove leading and trailing whitespaces  
	$pswd = trim($_POST['curpass']); 
	$npswd = trim($_POST['npswd']);
	
	$errors = array();
	// Validate the input 
	if (strlen($pswd) == 0)
    array_push($errors, "Please enter your current password");
	if (strlen($npswd) == 0)
    array_push($errors, "Please enter new password"); 		 
	
	if(empty($errors)){				
		$member_details_data['password']=md5($_POST['npswd']);				
		$member_details_id=updatepswd('userdet',$member_details_data,array('id' => $_POST['puid'],'password'=> md5($_POST['curpass'])));
		unset($_POST['submit']);
		if ($member_details_id > 0)
		{			
			header('location:users.php');			
		}
		else
		{
			array_push($errors,'Either password not match or Process Failed');
		}		
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='output'>$val</p>";
	}
}
?> 
    <div class="content">
        <div class="header">            
            <h1 class="page-title">Edit User</h1>
                    <ul class="breadcrumb">
            <li><a href="index.php">Home</a> </li>
            <li><a href="users.php">Users</a> </li>
            <li class="active"><?php echo $name;?></li>
        </ul>
        </div>
        <div class="main-content">            
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
  <li><a href="#profile" data-toggle="tab">Password</a></li>
</ul>
<div class="row">
	<div class="col-md-4">
		<br>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<form name="usfrm" action="<?php echo $_SERVER['PHP_SELF'].'?urid='.$uid;?>" id="tab" class="cusreg" method="post"> 
					<input type="hidden" value="<?php echo $uid;?>" name="uid" >
					<?php echo $output; ?> 				
					<div class="form-group">
						<label>Name</label>
						<input type="text" value="<?php echo $name;?>" name="fname" required class="form-control">
					</div>       
					<div class="form-group">
						<label>Email</label>
						<input type="email" value="<?php echo $email;?>" name="emailid" required class="form-control">
					</div> 
					<div class="form-group">
						<label>User Type</label>
						<select name="ustype" id="ustype" class="form-control">
							<option value="0" <?php echo ($ustype==0) ?'selected':'';?> >Admin</option>
							<option value="1" <?php echo ($ustype==1) ?'selected':'';?>>Staff</option>
							<option value="2" <?php echo ($ustype==2) ?'selected':'';?>>Student</option>
						</select>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" value="<?php echo $username;?>" readonly name="uname" required class="form-control">
					</div>			
					<div class="btn-toolbar list-toolbar">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
						<a href="#myModal" data-toggle="modal" class="btn btn-danger delus" id="udel-<?php echo $uid;?>">Delete</a>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="profile">
				<form name="usfrm" action="<?php echo $_SERVER['PHP_SELF'].'?urid='.$uid;?>" id="tab2" class="pswdreg" method="post"> 
					<input type="hidden" value="<?php echo $uid;?>" name="puid" >
					<div class="form-group">
						<label>Current Password</label>
						<input type="password" name="curpass" required class="form-control">
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" name="npswd" required class="form-control">
					</div>
					<div>
						<button type="submit" name="submit1" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>    
	</div>
</div>
<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
      </div>
      <div class="modal-body">        
        <p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure you want to delete the user?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal" id="dus">Delete</button>
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
	
    $(".cusreg").validate({    
        // Specify the validation rules
        rules: {
			fname:"required",
			emailid: {
                required: true,
                email: true
            },
			uname: "required"			
        },        
        // Specify the validation error messages
        messages: { 				
            fname: "Enter your name",           
			emailid: "Enter a valid email address",
			uname:"Enter Username"			
        },        
        submitHandler: function(form) {		
            form.submit();
        }
    });
	
	$("#pswdreg").validate({    
        // Specify the validation rules
        rules: {			
			curpass: {
                required: true,
                minlength: 5
            },
			npswd: {
                required: true,
                minlength: 5
            }
        },        
        // Specify the validation error messages
        messages: {            
			curpass: {
                required: "Provide a current password",
                minlength: "Your password must be at least 5 characters long"
            },
			npswd: {
                required: "Provide a new password",
                minlength: "Your password must be at least 5 characters long"
            }
        },        
        submitHandler: function(form) {		
            form.submit();
        }
    });
});  
</script>