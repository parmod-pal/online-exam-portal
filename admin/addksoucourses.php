<?php 
include "header.php";
include "sidebar.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$title = $desc = $output = $result=$image=$success='';
$date=date('Y-m-d');
for($j = 0; $j < 6; $j++) {
	$result .= mt_rand(0, 9);
}
if($_POST){
	// collect all input and trim to remove leading and trailing whitespaces  
	$nameofskilltrainingprogram = trim($_POST['nameofskilltrainingprogram']);
	$noofcredits = trim($_POST['noofcredits']); 
	$courseduration = trim($_POST['courseduration']);
	
	$eligibilitycriteria = trim($_POST['eligibilitycriteria']);
	$feestructure = trim($_POST['feestructure']);
	$learningmodules = trim($_POST['learningmodules']);
	
	$errors = array();
	if(strlen($nameofskilltrainingprogram) == 0)
    array_push($errors, "Enter Name of the Skill Training Program");
	if (strlen($noofcredits) == 0)
    array_push($errors, "Enter No. of Credits");
	if (strlen($courseduration) == 0)
    array_push($errors, "Enter Course Duration");
    if (strlen($eligibilitycriteria) == 0)
    array_push($errors, "Enter Eligibility Criteria");
    if (strlen($feestructure) == 0)
    array_push($errors, "Enter Fee Structure");
	 $t=strtotime('now');
	if(empty($errors)){	
		
		
		$member_details_data['nameofskilltrainingprogram']=$_POST['nameofskilltrainingprogram'];
		$member_details_data['noofcredits']=addslashes($_POST['noofcredits']);		
		$member_details_data['courseduration']=addslashes($_POST['courseduration']);
		$member_details_data['eligibilitycriteria']=addslashes($_POST['eligibilitycriteria']);
		$member_details_data['feestructure']=addslashes($_POST['feestructure']);
		$member_details_data['learningmodules']=addslashes($_POST['learningmodules']);
	
		$member_details_id=insert('testimonial',$member_details_data);
		unset($_POST['submit']);		
		if ($member_details_id > 0)
		{			
			$success="<p class='outputs'>Courses Added Successfully</p>";	
			header('location:viewksoucourses.php');			
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
		<h1 class="page-title">Add KSOU Courses</h1>
		<ul class="breadcrumb">
			<li><a href="">Home</a> </li>          
			<li class="active">Add KSOU Courses</li>
		</ul>
	</div>
	<div class="main-content">            
		<ul class="nav nav-tabs">
			<li class="active"><span style="color: #555;cursor: default;background-color: #fff;border: 1px solid #ddd;border-bottom-color: transparent;padding-left:10px;padding-right:10px;padding-top:10px;"> Add KSOU Courses</span></li> 
		</ul>
<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
	<div class="tab-pane active in" id="home">
		<form name="usfrm" action="" id="cusreg" method="post" enctype="multipart/form-data"> 
			<?php echo $output; ?> 
			<?php echo $success; ?>			
			<div class="form-group">
				<label>Name of the Skill Training Program</label>
				<input type="text" value="" class="form-control" name="nameofskilltrainingprogram" required id=""></input>
			</div>	
			<div class="form-group">
				<label>No. of Credits</label>
				<input type="text" value="" class="form-control" name="noofcredits" required id=""></input>
			</div>
			<div class="form-group">
				<label>Course Duration</label>
				<input type="text" value="" class="form-control" name="courseduration" required id=""></input>
			</div>
			<div class="form-group">
				<label>Eligibility Criteria</label>
				<input type="text" value="" class="form-control" name="eligibilitycriteria" required id=""></input>
			</div>
			<div class="form-group">
				<label>Fee Structure</label>
				<input type="text" value="" class="form-control" name="feestructure" required id=""></input>
			</div>
			<div class="form-group" style="width:1050px;">
				<label>LEARNING MODULES</label>
				<textarea name="learningmodules" class="form-control" style="height:300px;" required></textarea>
			</div> 	
				
			<div class="btn-toolbar list-toolbar">
				<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;Save</button>   
			</div>
        </form>
      </div>
    </div>    
  </div>
</div>
<?php include "footer.php";?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea',
	 plugins: "link" });</script>
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
			location:"required",
			desc: "required"
        },        
        // Specify the validation error messages
        messages: { 				
           
            title: "Enter Title", 
			locaiton:"Enter Location",			
			desc: "Enter Student Comments"
        },        
        submitHandler: function(form) {		
            form.submit();
        }
    });
	
	$("#image").on('change',function(){		
		$('#imagePreview').empty();
		var myfiles = document.getElementById('image');
		var files = myfiles.files;
		var i=0;		
		for (i = 0; i < files.length; i++) {
			var readImg = new FileReader();
			var file=files[i];
			if(file.type.match('image.*')){
			
				readImg.onload = (function(file) {
					return function(e){						
						/* $('#imagePreview').append('<input type="radio" name="dimg" value="'+file.name+'" /><img src="'+this.result+'" height="100" width="100"/>'); */
						$('#imagePreview').append('<img src="'+this.result+'" height="100" width="100"/>');
					};
				})(file);
				readImg.readAsDataURL(file);
			}else{
				alert('the file '+file.name+' is not an image<br/>');
			}
		}
	});	
});  
setTimeout( "$('.outputs,.outputf').hide();", 4000);
</script>