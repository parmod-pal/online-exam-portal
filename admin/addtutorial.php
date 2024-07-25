<?php 
include "header.php";
include "sidebar.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$title = $desc = $output = $result=$success='';
$date=date('Y-m-d');
for($j = 0; $j < 6; $j++) {
	$result .= mt_rand(0, 9);
}
if($_POST){
	// collect all input and trim to remove leading and trailing whitespaces 
	$title = trim($_POST['title']); 
	$desc = trim($_POST['desc']);
	
	$errors = array();
	if (strlen($title) == 0)
    array_push($errors, "Enter Title");
	if (strlen($desc) == 0)
    array_push($errors, "Enter Description");	
	 $t=strtotime('now');
	if(empty($errors)){	
		
		$member_details_data['title']=addslashes($_POST['title']);
		$member_details_data['description']=addslashes($_POST['desc']);
		$member_details_data['dateofpost']=$date;	
		$member_details_id=insert('tutorial',$member_details_data);
		unset($_POST['submit']);		
		if ($member_details_id > 0)
		{			
			$success="<p class='outputs'>Tutorial Added Successfully</p>";	
			header('location:viewtutorial.php');			
		}
		else
		{
			array_push($errors,$member_details_id);
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
		<h1 class="page-title">Add Tutorial</h1>
		<ul class="breadcrumb">
			<li><a href="">Home</a> </li>          
			<li class="active">Add Tutorial</li>
		</ul>
	</div>
	<div class="main-content">            
		<ul class="nav nav-tabs">
			<li class="active"><span style="color: #555;cursor: default;background-color: #fff;border: 1px solid #ddd;border-bottom-color: transparent;padding-left:10px;padding-right:10px;padding-top:10px;"> Add Tutorial</span></li> 
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
				<label>Select Folder</label>
				<select name="title" id="title" required class="form-control">
					<option value="">Select Folder</option>
					<option value="project_management" >Project Management</option>
					<option value="production_management" >Production Management</option>
					<option value="financial_management" >Financial Management</option>
					<option value="human_resources" >Human Resources</option>
					<option value="supply_chain_management" >Supply Chain Management</option>
					<option value="health_care" >Health Care</option>
					<option value="business_laws_and_taxation" >Business Laws &amp; Taxation</option>
					<option value="saral_shikshak" >Saral Shikshak</option>
					<option value="risk_management" >Risk Management</option>
					<option value="business_analytics" >Business Analytics</option>
					<option value="big_data" >Big Data</option>
					<option value="digital_literacy" >Digital Literacy</option>
					<option value="others" >Others</option>
				</select>	
			</div>	
			
			<div class="form-group" style="width:1050px;">
				<label>Tutorial Embeded Code</label>
				<textarea name="desc" class="form-control" style="height:300px;" required></textarea>
			</div> 	
					
			<div class="btn-toolbar list-toolbar">
				<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>Save</button>   
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
setTimeout( "$('.outputs,.outputf').hide();", 4000);
</script>