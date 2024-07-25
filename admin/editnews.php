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
	$userdet=select("select * from latestnews where id=$uid");			
	if(count($userdet)>0)
	{	
		foreach($userdet as $user => $data)
		{
			$title=$data['title'];
			$desc=$data['description'];
			$tags=$data['tags'];
			$cate=$data['category'];
			$img=$data['image'];
		}
	}
}
else
{
	header('location:viewnews.php');
	exit;
}
for($j = 0; $j < 6; $j++) {
	$result .= mt_rand(0, 9);
}
$t=strtotime('now');
$date=date('Y-m-d');
if(isset($_POST['submit'])) {
	// collect all input and trim to remove leading and trailing whitespaces  
	//$cate = trim($_POST['catename']);
	$title = trim($_POST['title']); 
	$desc = trim($_POST['desc']);
	$tags=trim($_POST['tag']);
	$img=trim($_POST['imgfile']);
	$errors = array();
	// Validate the input 
	/* if (strlen($cate) == 0)
    array_push($errors, "Select Category"); */
	if (strlen($title) == 0)
    array_push($errors, "Enter Title");
	if (strlen($desc) == 0)
    array_push($errors, "Enter Description"); 
	
	if(empty($errors)){	
		 if($_FILES){
			$allowedExts = array("jpg", "jpeg", "gif", "png","pjpeg");
			if($img == "")
			{
				$img = $result.$t;
				mkdir('images/blogimg/'.$img);
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
							"images/blogimg/$img/" .$_FILES["img"]["name"][$i]);
				}
			}
		}	
		//$member_details_data['category']=$_POST['catename'];	
		$member_details_data['title']=addslashes($_POST['title']);
		$member_details_data['description']=addslashes($_POST['desc']);	
		$member_details_data['image']=$img;
		//$member_details_data['tags']=$_POST['tag'];
		$member_details_data['dateofpost']=$date;			
		$member_details_id=update('latestnews',$member_details_data,array('id' => $_POST['uid']));
		unset($_POST['submit']);
		if ($member_details_id > 0)
		{			
			header('location:viewnews.php');			
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
            <h1 class="page-title">Edit News</h1>
			<ul class="breadcrumb">
				<li><a href="viewnews.php">Home</a> </li>
				<li><a href="">Edit News</a> </li>
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
					<!--<div class="form-group">
						<label>Category</label>
						<select name="catename" required class="form-control">
							<option value="">Select Category</option>
							<?php
							/* $userdet=select("select * from category where Category_type='News' order by categoryname asc");			
							if(count($userdet)>0)
							{	
								foreach($userdet as $user => $data)
								{
									if($data['categoryname'] == $cate)
									{
										echo '<option value="'.$data['categoryname'].'" selected>'.$data['categoryname'].'</option>';
									}
									else
									{
										echo '<option value="'.$data['categoryname'].'">'.$data['categoryname'].'</option>';
									}
								}
							} */
							?>						
						</select>						
					</div> -->
					<div class="form-group">
						<label>Title</label>
						<input type="text" value="<?php echo stripslashes($title);?>" class="form-control" name="title" id=""></input>
					</div>						
					<div class="form-group" style="width:1050px;">
						<label>Description</label>
						<textarea name="desc" class="form-control" style="height:300px;" required><?php echo stripslashes($desc);?></textarea>						
					</div> 
					<div class="form-group">
						<label>Image</label><br/>
						<input type="hidden" value="<?php echo $img;?>" name="imgfile" multiple class="form-control" ></input>
						<?php
						if(is_dir("images/blogimg/".$img))
						{
							$imgfiles=array_diff(scandir("images/blogimg/".$img),array('..','.'));				
							foreach($imgfiles as $key => $file)
							{	
								if($file != "temp")
								{
									 
							?>
							<img src="<?php echo "images/blogimg/".$img."/".$file;?>" height="100" width="100"/>
							<span id="<?php echo "images/blogimg/".$img."/".$file;?>" style="cursor:pointer;color:#ff4400;font-weight:bold;vertical-align:top;" class="delimg" title="remove">X</span>
							<?php	
								}
							}
						}
						?>
						<div id="imagePreview">
				
						</div>
						<input type="file" value="" name="img[]" multiple class="form-control" id="image"></input><br/>
						<!--<span style="color:#ff4400;">Image size should be 820x400 </span>-->
					</div>	
					<!--<div class="form-group">
						<label>Tags</label>
						<input type="text" value="<?php //echo $tags;?>" name="tag" class="form-control" id=""></input>
					</div>	-->					
					<div class="btn-toolbar list-toolbar">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
						<a href="#myModal" data-toggle="modal" class="btn btn-danger delus" id="udel-<?php echo $uid;?>-<?php echo $img;?>">Delete</a>
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
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
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