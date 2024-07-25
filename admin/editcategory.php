<?php include "header.php";
include "sidebar.php";

$uid=$title = $output = $result=$cattype='';
if(isset($_REQUEST['urid']))
{
	$uid=$_REQUEST['urid'];	
}
if($uid !='')
{
	$userdet=select("select * from category where id=$uid");			
	if(count($userdet)>0)
	{	
		foreach($userdet as $user => $data)
		{
			$title=$data['categoryname'];
			$cattype=$data['Category_type'];	
		}
	}
}
else
{
	header('location:viewcategory.php');
	exit;
}

$date=date('Y-m-d');
if(isset($_POST['submit'])) {
	// collect all input and trim to remove leading and trailing whitespaces  
	$title = trim($_POST['catename']); 
	$cattype = trim($_POST['typ']);	
	$errors = array();
	// Validate the input 
	if (strlen($title) == 0)
    array_push($errors, "Enter Category Name");	    
	
	if(empty($errors)){				
		$member_details_data['categoryname']=$_POST['catename'];	
		$member_details_data['Category_type']=$_POST['typ'];
		$member_details_data['dateofpost']=$date;			
		$member_details_id=update('category',$member_details_data,array('id' => $_POST['uid']));
		unset($_POST['submit']);
		if ($member_details_id > 0)
		{			
			header('location:viewcategory.php');			
		}
		else
		{
			array_push($errors,'Process Failed');
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
            <h1 class="page-title">Edit Category </h1>
                    <ul class="breadcrumb">
            <li><a href="viewcategory.php">Home</a> </li>
            <li><a href="">Edit Category</a> </li>
        </ul>
        </div>
        <div class="main-content">            

<div class="row">
	<div class="col-md-4">
		<br>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<form name="usfrm" action="<?php echo $_SERVER['PHP_SELF'].'?urid='.$uid;?>" id="tab" class="cusreg" method="post"> 
					<input type="hidden" value="<?php echo $uid;?>" name="uid" >
					<?php echo $output; ?>
					<div class="form-group">
						<label>Category Type</label>
						<select name="typ" class="form-control">
						<option value="Blog" selected>Blog</option>
							<!--<?php
							if($cattype=="Blog")
							{
							?>
								<option value="Blog" selected>Blog</option>
								<option value="Portfolio">Portfolio</option>
							<?php
							}
							else
							{
							?>
								<option value="Blog">Blog</option>
								<option value="Portfolio" selected>Portfolio</option>
							<?php
							}						
							?>-->												
						</select>						
					</div> 			
					<div class="form-group">
						<label>Category Name</label>
						<input type="text" class="form-control" name="catename" id="catename" value="<?php echo $title;?>"></input>												
					</div>							
					<div class="btn-toolbar list-toolbar">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
						<a href="#myModal" data-toggle="modal" class="btn btn-danger delus" id="udel-<?php echo $uid;?>">Delete</a>
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
        <p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal" id="dcate">Delete</button>
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
			catename:"required"
        },        
        // Specify the validation error messages
        messages: { 				
            catename: "Enter Category Name"
        },         
        submitHandler: function(form) {		
            form.submit();
        }
    });
});  
</script>