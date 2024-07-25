<?php include "header.php";
include "sidebar.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$uid=$title = $cate=$tags=$desc = $output = $img= $result='';
if(isset($_REQUEST['urid']))
{
	$uid=$_REQUEST['urid'];	
}
if($uid !='')
{
	$userdet=select("select * from newsevents where id=$uid");			
	if(count($userdet)>0)
	{	
		foreach ((array)$userdet as $user => $data)
		{
			$title=$data['title'];
			$desc=$data['description'];
			
		}
	}
}
else
{
	header('location:viewpages.php');
	exit;
}
for($j = 0; $j < 6; $j++) {
	$result .= mt_rand(0, 9);
}
$t=strtotime('now');
$date=date('Y-m-d');
if(isset($_POST['submit'])) {
	// collect all input and trim to remove leading and trailing whitespaces  
	
	 
	$desc = trim($_POST['desc']);
	
	$errors = array();
	// Validate the input 
	
	if (strlen($desc) == 0)
    array_push($errors, "Enter Description"); 
	
	if(empty($errors)){	
		 	
			
		
		$member_details_data['description']=addslashes($_POST['desc']);	
		
		$member_details_data['dateofpost']=$date;			
		$member_details_id=update('newsevents',$member_details_data,array('id' => $_POST['uid']));
		unset($_POST['submit']);
		if ($member_details_id > 0)
		{			
			header('location:viewpages.php');			
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
            <h1 class="page-title">Edit Page</h1>
			<ul class="breadcrumb">
				<li><a href="viewpages.php">Home</a> </li>
				<li><a href="">Edit Page</a> </li>
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
						<label><strong>Page Name</strong></label>
						<label value="" class="form-control" disabled><?php echo $data['title'];?></label>
					</div>						
					<div class="form-group" style="width:1050px;">
						<label><strong>Content</strong></label>
						<textarea name="desc" class="form-control" style="height:300px;" required><?php echo stripslashes($desc);?></textarea>						
					</div> 
										
					<div class="btn-toolbar list-toolbar">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
						
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
        <button class="btn btn-danger" data-dismiss="modal" id="dnews">Delete</button>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php";?>
 <script src="https://cdn.tiny.cloud/1/89kaoyzdhy227jhpbbm1rp9xzb3j6ywsd2n85ov6gpmjzbhj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
  tinymce.init({
	selector:'textarea',
	 plugins: "link"  

  });
  </script>
<script src="lib/jquery.validate.js"></script>
<!-- jQuery Form Validation code -->
<script>  
// When the browser is ready...
$(function() { 	
    // Setup form validation on the #register-form element	
	
    $(".cusreg").validate({    
        // Specify the validation rules
        rules: {
			catename:"required",
			title:"required",
			desc: "required"
        },        
        // Specify the validation error messages
        messages: { 
			catename: "Select Category", 
            title: "Enter Title",           
			desc: "Enter a Blog Details"
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
	$('.delimg').on('click',function(){
		var path=$(this).attr('id');
		$(this).hide();
		$(this).prevUntil('span').hide();
		
		 $.ajax({
			url:"delimage.php",
			type:"POST",
			data:"p="+path,
			success:function()
			{				
				//alert('Removed');
			},
			error:function()
			{
				alert('error');
			}
		}); 
	});
});  
</script>