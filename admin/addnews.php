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
	//$cate = trim($_POST['catename']);
	$title = trim($_POST['title']); 
	$desc = trim($_POST['desc']);
	
	$errors = array();
	// Validate the input 
	/* if (strlen($cate) == 0)
    array_push($errors, "Select Category"); */
	if (strlen($title) == 0)
    array_push($errors, "Enter Title");
	if (strlen($desc) == 0)
    array_push($errors, "Enter Description");	
	 $t=strtotime('now');
	if(empty($errors)){	
		if($_FILES['img']){
			$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg");
			if($_FILES['img']["name"][0] != '')
			{
				$image = $result.$t;
				mkdir("images/blogimg/$image");
			}
			for($i=0;$i<count($_FILES['img']["name"]);$i++)
			{
				$extension = explode(".", $_FILES["img"]["name"][$i]);
				$len=count($extension)-1;			
				$extension = $extension[$len];
				$extension=strtolower($extension);
				if ((($_FILES["img"]["type"][$i] == "image/gif")
					|| ($_FILES["img"]["type"][$i] == "image/jpeg")
					|| ($_FILES["img"]["type"][$i] == "image/png")
					|| ($_FILES["img"]["type"][$i] == "image/pjpeg"))
					&& in_array($extension, $allowedExts)){
					move_uploaded_file($_FILES["img"]["tmp_name"][$i],
							"images/blogimg/$image/" .$_FILES["img"]["name"][$i]);
				}
			}
		}
		if(!is_dir("images/blogimg/".$image))
		{
			$image='';
		}
		/* $member_details_data['category']=$_POST['catename'];			
		$member_details_data['tags']=$_POST['tag'];	 */	
		$member_details_data['title']=addslashes($_POST['title']);		
		$member_details_data['image']=$image;
		$member_details_data['description']=addslashes($_POST['desc']);
		$member_details_data['dateofpost']=$date;			
		$member_details_data['postedon']=$date;
		$member_details_id=insert('latestnews',$member_details_data);
		unset($_POST['submit']);		
		if ($member_details_id > 0)
		{			
			$success="<p class='outputs'>News Posted Successfully</p>";	
			header('location:viewnews.php');			
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
		<h1 class="page-title">Add News</h1>
		<ul class="breadcrumb">
			<li><a href="">Home</a> </li>          
			<li class="active">Add News</li>
		</ul>
	</div>
	<div class="main-content">            
		<ul class="nav nav-tabs">
			<li class="active"><span style="color: #555;cursor: default;background-color: #fff;border: 1px solid #ddd;border-bottom-color: transparent;padding-left:10px;padding-right:10px;padding-top:10px;"> Add News</span></li> 
		</ul>
<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      <form name="usfrm" action="" id="cusreg" method="post" enctype="multipart/form-data"> 
		<?php echo $output; ?> 
		<?php echo $success; ?>	
			<!--<div class="form-group">
				<label>Category</label>
				<select name="catename" required class="form-control">
					<option value="">Select Type</option>
					<?php
					/* $userdet=select("select * from category where Category_type = 'News' order by categoryname asc");	echo count($userdet);		
					if(count($userdet)>0 && $userdet[0] !='')
					{	
						foreach($userdet as $user => $data)
						{
							echo '<option value="'.$data['categoryname'].'">'.$data['categoryname'].'</option>';
						}
					} */
					?>
				</select>				
			</div>  -->
			<div class="form-group">
				<label>Title</label>
				<input type="text" value="" class="form-control" name="title" id=""></input>
			</div>			     
			<div class="form-group" style="width:1050px;">
				<label>Description</label>
				<textarea name="desc" class="form-control" style="height:300px;" required></textarea>
			</div> 	
			<div class="form-group">
				<label>Image</label>
				<div id="imagePreview">			
				</div>
				<input type="file" name="img[]" multiple class="form-control" id="image"></input><br/>
				<!--<span style="color:#ff4400;">Image size should be 820x400 </span>-->
			</div>	
			<!--<div class="form-group">
				<label>Tags</label>
				<input type="text" value="" name="tag" class="form-control" id=""></input>
			</div>	-->
			<div class="btn-toolbar list-toolbar">
				<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>   
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
			desc: "required"
        },        
        // Specify the validation error messages
        messages: { 				
           
            title: "Enter Title",           
			desc: "Enter a News Details"
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