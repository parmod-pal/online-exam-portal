<?php include 'innerheader.php';
if(!isset($_SESSION['user']))
{
	include "index.php";
	exit();
}
	$sql="SELECT * FROM institutegeninfo WHERE Id='".$_SESSION['user']."'";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while ($data = mysql_fetch_array($result))
		{
			$id=$data['Id'];			
			$Institutename=$data['Institutename'];
			$State=$data['State'];
			$City=$data['City'];
			$Address=$data['Address'];
			$Category=$data['Category'];
			$Pincode=$data['Pincode']; 
		}
			
	}	
	if(isset($_POST['submit']))
	{ 
		$postdate=date("Y/m/d");
		$Institute_id=$_SESSION['user'];
		$imag=$_FILES["photo"]["name"];
		$imag= str_replace(' ','',$imag);
		$sql="INSERT INTO institutepicture(Institute_id,postdate) VALUES('" . $Institute_id . "','" . $postdate . "')";
		$result=mysql_query($sql);
		if(($result)>0)
		{			
			$sql1="SELECT Id FROM institutepicture order by Id desc limit 0,1";
			$result1=mysql_query($sql1);
			if(($result1)>0)
			{
				while ($data = mysql_fetch_array($result1))
				{
					$id1=$data['Id'];
				}
				$ext=getExtension($imag);
				$imag=$id1.".".$ext;
				move_uploaded_file($_FILES["photo"]["tmp_name"],"Institutepic/" . $imag);							 
				$f_width=THUMB_IMAGE_WIDTH;         
				$f_height=THUMB_IMAGE_HEIGHT;
				$thumimg=make_thumb("Institutepic/".$imag, "Institutepic/thumbs/".$imag,$f_width,$f_height);
				$update="UPDATE institutepicture SET image='".$imag."' WHERE Id='".$id1."'";
				$result3=mysql_query($update);				
				if(($result3)>0)
				{						
					msg( "Image added");
				}
			}
		}
	}
	if(isset($_POST['submitnew']))
	{ 
		$postdate=date("Y/m/d");
		$Institute_id=$_SESSION['user'];
		$imag=$_FILES["photonew"]["name"];
		$imag= str_replace(' ','',$imag);				
		$ext=getExtension($imag);
		$imag=$Institute_id.".".$ext;
		move_uploaded_file($_FILES["photonew"]["tmp_name"],"Institutepros/" . $imag);
		$update="UPDATE institutegeninfo SET prospector='".$imag."' WHERE Id='".$Institute_id."'";
		$result3=mysql_query($update);				
		if(($result3)>0)
		{					
			msg( "Prospector added");
		}
	}
?>
<?php
function msg($msg)
{?>
<script type="text/javascript">
alert("<?php echo $msg;?>");
window.location="mymedia.php";
</script>
<?php } ?>
<style>
.backgr4
{
background-color:#3399cc;
}
</style>
<div style="clear:both"></div>
<br /><br /><br /><br />
<div class="content_wrapper">
	<div class="profile_left_container">
		<div class="inistituteprofile_picture"><img src="images/inistitueprofileimage.jpg" width="155" height="148" /></div>
		<?php include "insleftmenu.php";?>
		
	</div><!------ left container---close---------->
	<div class="rigt_container"> 
		<div class="profilediting_container">
			<div class="announcemnet_header"><div class="mycampusannouncement">My Media</div> </div>
			<div class="profile_collegename"><?php echo $Institutename; ?></div> 
			<div class="view_profile"><b><</b> <a href="instituteprofile.php"> View Profile</a></div>
			<div class="profile_collge_place"><?php echo $City.",".$State; ?></div>
			<div class="about_div">Add Picture</div><div style="clear:both"></div>
		   <form method="post" enctype="multipart/form-data" name="myform" id="myform">
				<div class="accountedit_label">Add Image</div>
				<div class="accountedit_textbox">
					<label>
						<input type="file" name="photo" id="addimage" style="width:200px; height:25px;" />
					</label>
				</div>
				<div style="clear:both"></div>
				<div class="savechanges">
					<input name="submit" type="submit" value="Add Image" style="width:125px; height:25px;cursor:pointer; background-color:#528fc7; border:none; color:#FFF;"/>
				</div>
		   </form>
			<div class="from_linecross2"></div>
			<div class="about_div">Add Prospectus</div><div style="clear:both"></div>
			<form method="post" enctype="multipart/form-data" name="myformnew" id="myformnew">
				<div class="accountedit_label">Add Prospectus</div>
				<div class="accountedit_textbox">
					<label>
						<input type="file" name="photonew" id="addimage" style="width:200px; height:25px;" />
					</label>
				</div>
				<div style="clear:both"></div>
				<div class="savechanges">
					<input name="submitnew" type="submit" value="Add Prospectus" style="width:125px; height:25px; cursor:pointer;background-color:#528fc7; border:none; color:#FFF;"/>
				</div>
			</form>
			<div style="clear:both"></div>
			<br/><br/>
		</div> 
			<div class="collegeprofile_addspace_container">
				<div class="notice_board_head"><div class="noticeboard"></div></div>
			</div>
	</div><!--- close right container---------->
</div>
<div style="clear:both"></div>
</div>
<?php include "footer.php";?>
<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
  var frmvalidator  = new Validator("myform");
  frmvalidator.addValidation("photo","file_extn=jpg;gif;png;jpeg","Allowed files types are: jpg;gif;png;jpeg");
  frmvalidator.addValidation("photo","req_file","Image is required");  
  </script>
<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
  var frmvalidator  = new Validator("myformnew"); 
  frmvalidator.addValidation("photonew","req_file","Prospector is required");  
  </script>
</body>
</html>