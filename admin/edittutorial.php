<?php include "header.php";
include "sidebar.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$uid=$title = $location=$tags=$desc = $output = $img= $result='';
if(isset($_REQUEST['urid']))
{
	$uid=$_REQUEST['urid'];	
}
if($uid !='')
{
	$userdet=select("select * from tutorial where id=$uid");			
	if(count($userdet)>0)
	{	
		foreach($userdet as $user => $data)
		{
			$title=$data['title'];
			$desc=$data['description'];
		}
	}
}
else
{
	header('location:viewtutorial.php');
	exit;
}
for($j = 0; $j < 6; $j++) {
	$result .= mt_rand(0, 9);
}
$t=strtotime('now');
$date=date('Y-m-d');
if(isset($_POST['submit'])) {
	// collect all input and trim to remove leading and trailing whitespaces  	
	$title = trim($_POST['title']); 
	$desc = trim($_POST['desc']);
	$errors = array();
	if (strlen($title) == 0)
    array_push($errors, "Enter Title");
	if (strlen($desc) == 0)
    array_push($errors, "Enter Description"); 
	
	if(empty($errors)){	
		$member_details_data['title']=addslashes($_POST['title']);
		$member_details_data['description']=addslashes($_POST['desc']);
		$member_details_data['dateofpost']=$date;			
		$member_details_id=update('tutorial',$member_details_data,array('id' => $_POST['uid']));
		unset($_POST['submit']);
		if ($member_details_id > 0)
		{			
			header('location:viewtutorial.php');			
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
            <h1 class="page-title">Edit Tutorial</h1>
			<ul class="breadcrumb">
				<li><a href="viewtutorial.php">Home</a> </li>
				<li><a href="">Edit Tutorial</a> </li>
			</ul>
        </div>
        <div class="main-content">            

<div class="row">
	<div class="col-md-4">
		<br>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<form name="usfrm" action="<?php echo $_SERVER['PHP_SELF'].'?urid='.$uid;?>" id="tab" class="cusreg" method="post" enctype="multipart/form-data"> 
					<input type="hidden" value="<?php echo $uid;?>" name="uid" >
					<?php echo $output; ?> 
					<div class="form-group">						
						<label>Select Folder</label>
						<select name="title" id="title" required class="form-control">
							<option value="">Select Folder</option>
							<option value="project_management" <?php echo stripslashes($title) == 'project_management'?'selected':'';?> >Project Management</option>
							<option value="production_management" <?php echo stripslashes($title) == 'production_management'?'selected':'';?> >Production Management</option>
							<option value="financial_management" <?php echo stripslashes($title) == 'financial_management'?'selected':'';?> >Financial Management</option>
							<option value="human_resources" <?php echo stripslashes($title) == 'human_resources'?'selected':'';?> >Human Resources</option>
							<option value="supply_chain_management" <?php echo stripslashes($title) == 'supply_chain_management'?'selected':'';?> >Supply Chain Management</option>
							<option value="health_care" <?php echo stripslashes($title) == 'health_care'?'selected':'';?> >Health Care</option>
							<option value="business_laws_and_taxation" <?php echo stripslashes($title) == 'business_laws_and_taxation'?'selected':'';?> >Business Laws &amp; Taxation</option>
							<option value="saral_shikshak" <?php echo stripslashes($title) == 'saral_shikshak'?'selected':'';?> >Saral Shikshak</option>
							<option value="risk_management" <?php echo stripslashes($title) == 'risk_management'?'selected':'';?> >Risk Management</option>
							<option value="business_analytics" <?php echo stripslashes($title) == 'business_analytics'?'selected':'';?> >Business Analytics</option>
							<option value="big_data" <?php echo stripslashes($title) == 'big_data'?'selected':'';?> >Big Data</option>
							<option value="digital_literacy" <?php echo stripslashes($title) == 'digital_literacy'?'selected':'';?> >Digital Literacy</option>
							<option value="others" <?php echo stripslashes($title) == 'other'?'selected':'';?> >Others</option>
						</select>	
					</div>		
											
					<div class="form-group" style="width:1050px;">
						<label>Tutorial Embeded Code</label>
						<textarea name="desc" class="form-control" style="height:300px;" required><?php echo stripslashes($desc);?></textarea>						
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
        <button class="btn btn-danger" data-dismiss="modal" id="dtut">Delete</button>
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
			title:"required",
			desc: "required"
        },        
        // Specify the validation error messages
        messages: { 
            title: "Enter Title",  	
			desc: "Enter Student Comments"
        },         
        submitHandler: function(form) {		
            form.submit();
        }
    });
	
	
});  
</script>