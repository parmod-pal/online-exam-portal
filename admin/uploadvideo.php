<?php 
include "header.php";
include "sidebar.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$output = $image=$success='';
$date=date('Y-m-d');$errors = array();$cate = 'fc';
if($_POST){
	// collect all input and trim to remove leading and trailing whitespaces  
	
	$img=$_FILES['img']["name"][0];
	$fname=$_POST['fname'];	
	// Validate the input 	
	if(strlen($img) == 0)
    array_push($errors, "Select File To Upload");	
	
	if(empty($errors)){	
		if($_FILES['img']){
			$allowedExts = array("mp4");			
			for($i=0;$i<count($_FILES['img']["name"]);$i++)
			{
				$extension = explode(".", $_FILES["img"]["name"][$i]);
				$len=count($extension)-1;			
				$extension = $extension[$len];
				$extension=strtolower($extension);
				if (in_array($extension, $allowedExts)){					
					move_uploaded_file($_FILES["img"]["tmp_name"][$i],
							"../images/tutorials/".$fname.'/' .$_FILES["img"]["name"][$i]);
					$err=0;
				}
				else
				{
					$err=1;
				}
			}
			if($err==0)
				$success="<p class='outputs'>File Uploaded Successfully</p>";	
			else
				 array_push($errors, "Invalid File.");	
		}	
		
	}
	unset($_POST['submit']);
	
}
//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='outputf'>$val</p>";
	}
?> 
<div class="content">
	<div class="header">            
		<h1 class="page-title">Upload Tutorial</h1>
		<ul class="breadcrumb">
			<li><a href="">Home</a> </li>          
			<li class="active">Upload Tutorial</li>
		</ul>
	</div>
	<div class="main-content">            
		<ul class="nav nav-tabs">
			<li class="active"><span style="color: #555;cursor: default;background-color: #fff;border: 1px solid #ddd;border-bottom-color: transparent;padding-left:10px;padding-right:10px;padding-top:10px;"> Upload Tutorial</span></li> 
		</ul>
<div class="row">
  <div class="col-md-8">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      <form name="usfrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="cusreg" method="post" enctype="multipart/form-data"> 
			<?php echo $output; ?> 
			<?php echo $success; ?>	
			<div class="form-group" style="display:none;">
				<label>Select Course</label>
				<select name="catename" id="catename" required class="form-control">
					<option value="">Select Course</option>
					<option value="fc" <?php echo $cate == 'fc'?'selected':'';?>>Foundation Courses</option>
					<option value="cc" <?php echo $cate == 'cc'?'selected':'';?>>Concentration Courses</option>
				</select>				
			</div>	
			<div class="form-group">
				<label>Select Folder</label>
				<select name="fname" id="fname" required class="form-control">
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
			<div class="form-group">
				<label>Upload Tutorial</label>
				<div id="imagePreview">			
				</div>
				<input type="file" name="img[]" multiple class="form-control" id="image"></input><br/>
				<span style="color:#ff4400;">Only .mp4 files allowed.</span><br/>
				<span style="color:#ff0000;">Make sure no <strong>"special characters"</strong> exists in the file name.</span>
			</div>				
			<div class="btn-toolbar list-toolbar">
				<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Upload</button>   
			</div>
        </form>
		
      </div>
    </div>    
  </div>
</div>
<hr/>
<h2 class="title">Click on the relevant folder to get the tutorials. </h2>
<hr/>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="project_management"><img src="images/folder.png" alt=""><br/>Project Management</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="production_management"><img src="images/folder.png" alt=""><br/>Production Management</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="financial_management"><img src="images/folder.png" alt=""><br/>Financial Management</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="human_resources"><img src="images/folder.png" alt=""><br/>Human Resources</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="supply_chain_management"><img src="images/folder.png" alt=""><br/>Supply Chain Management</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="health_care"><img src="images/folder.png" alt=""><br/>Health Care</a>
</div>
<div class="clearfix"></div><br/>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="business_laws_and_taxation"><img src="images/folder.png" alt=""><br/>Business Laws &amp; Taxation</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="saral_shikshak"><img src="images/folder.png" alt=""><br/>Saral Shikshak</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="risk_management"><img src="images/folder.png" alt=""><br/>Risk Management</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="business_analytics"><img src="images/folder.png" alt=""><br/>Business Analytics</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="big_data"><img src="images/folder.png" alt=""><br/>Big Data</a>
</div>
<div class="col-md-2 text-center">
	<a href="" class="qlink" data-link="digital_literacy"><img src="images/folder.png" alt=""><br/>Digital Literacy</a>
</div>
<div class="clearfix"></div><br/>
<div class="col-md-2 text-center">
<a href="" class="qlink" data-link="others"><img src="images/folder.png" alt=""><br/>Others</a>
</div>
<div class="clearfix"></div><hr/>
<div class="viewfiles">

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
			img:"required"
        },        
        // Specify the validation error messages
        messages: {	
            img: "Select File to Upload"
        },        
        submitHandler: function(form) {		
		form.submit();
        }
    });
	$('.qlink').on('click',function(e){
		e.preventDefault();
		var link=$(this).attr('data-link');		
		$.ajax({
			type:'POST',
			url:'gettutorials.php',
			data:'f=tutorials&t='+link,
			success:function(res)
			{				
				if(res=='empty')
				{
					
					$('.viewfiles').html('');
				}
				else
				{
					
					$('.viewfiles').html(res);
				}
			},
			error:function()
			{
				alert('error');
			}
		});		
	});
	$('.viewfiles').on('click','.remfile',function(){
		var path=$(this).attr('data-path');
		var id=$(this).attr('data-id');
		 $.ajax({
			url:"delimage.php",
			type:"POST",
			data:"p="+path,
			success:function()
			{				
				$('#rw-'+id).remove();
			},
			error:function()
			{
				alert('error');
			}
		});
	});	
});  
setTimeout( "$('.outputs,.outputf').hide();", 4000);
</script>