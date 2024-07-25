<?php include "header.php";
include "sidebar.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$title='';
$c1=$c2=$c3=$c4=0;
$errors=array();
$userdet=select("SELECT * FROM counter order by id asc limit 0,4");			
if(count($userdet)>0)
{	
	foreach($userdet as $user => $val)
	{
		$title=$val['title'];
		if($title=='Instructor')
		{
			$c1=$val['value'];
		}
		if($title=='New Courses')
		{
			$c2=$val['value'];
		}
		if($title=='Live Sessions')
		{
			$c3=$val['value'];
		}
		if($title=='Students')
		{
			$c4=$val['value'];
		}
	}
}

$date=date('Y-m-d');
if(isset($_POST['submit'])) {
// collect all input and trim to remove leading and trailing whitespaces  

	for($i=1;$i<=4;$i++)
	{
		$member_details_data['value']=$_POST['v'.$i];		
		$member_details_data['dateofupdate']=$date;			
		$member_details_id=update('counter',$member_details_data,array('id' => $i));
	}
	unset($_POST['submit']);
	if ($member_details_id > 0)
	{			
		array_push($errors,'Updated Successfully');
			?>
			<script>
			alert('Updated Successfully');
				window.location.href="editcounter.php";
			</script>
			<?php
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


?> 
    <div class="content">
        <div class="header">            
            <h1 class="page-title">Edit Counter Values</h1>
			<ul class="breadcrumb">
				<li><a href="viewnews.php">Home</a> </li>
				<li><a href="">Edit  Counter Values</a> </li>
			</ul>
        </div>
        <div class="main-content">            

<div class="row">
	<div class="col-md-4">
		<br>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<form name="usfrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="tab" class="cusreg" method="post" > 
					<?php echo $output; ?> 	
					<div class="form-group">
						<label>PROFESSIONAL INSTRUCTORS</label>
						<input type="number" min=0 value="<?php echo $c1;?>" class="form-control" name="v1" id=""></input>
					</div>						
					<div class="form-group">
						<label>NEW COURSES</label>
						<input type="number" min=0 value="<?php echo $c2;?>" class="form-control" name="v2" id=""></input>			
					</div> 
					<div class="form-group">
						<label>LIVE SESSIONS </label><br/>
						<input type="number" min=0 value="<?php echo $c3;?>" class="form-control" name="v3" id=""></input>
					</div>	
					<div class="form-group">
						<label>REGISTERED STUDENTS</label>
						<input type="number" min=0 value="<?php echo $c4;?>" class="form-control" name="v4" id=""></input>
					</div>
									
					<div class="btn-toolbar list-toolbar">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
						
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
	
    $(".cusreg").validate({    
        // Specify the validation rules
        rules: {
			v1:"required",
			v2:"required",
			v3:"required",
			v4:"required"
        },        
        // Specify the validation error messages
        messages: { 
           v1:"Enter all the rquired values",
			v2:"Enter all the rquired values",
			v3:"Enter all the rquired values",
			v4:"Enter all the rquired values"
        },         
        submitHandler: function(form) {		
            form.submit();
        }
    });
	
});  
</script>