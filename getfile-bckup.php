<?php
$type=isset($_REQUEST['t'])?$_REQUEST['t']:'';
$title=isset($_REQUEST['title'])?$_REQUEST['title']:'';
$typ='refbook';
$file = ($title=='Tutorials'?'tutorials':($title=='Webinars/Webcasts'?'webcast':($title=='E-Library'?'reference_books':($title=='Assignments'?'assignments':($title=='Case-Studies'?'case-studies':($title=='Exercises/Quiz'?'quizs':''))))));

if($type=='v')
{
	$typ='video';
}
?>
<a href="e-learning.php" class="btn btn-primary" style="float:right;color:#fff;">Home</a>
<!--<a href="#" onclick="window.history.back();" class="btn btn-primary" style="float:right;color:#fff;">Back</a>-->
<h2 class="text-center mt-10" id="pg-title"> </h2>
<?php
if($title=='Tutorials' || $title=='Webinars/Webcasts')
{
?>
	<video id="myVideo" width="100%" controls autoplay style="border:1px solid #ddd;">
		<source id="mp4_src" src="" type="video/mp4">
	</video>
	<br/>
<?php
}
else
{
?>
	<iframe id="myFrame" style="display:none" width="100%" height="450"></iframe><br/>
<?php
}
?>
<h3 class="mt-10 pl-20"><u><b>List of <?php echo ucfirst(str_replace('_',' ',$title));?> :</b></u></h3>
<div style="font-family:arial;font-size:12px;font-weight:normal;width:100%;">
	<ul class="columns" data-columns="2" >
		<?php															
		function newest($a,$b)
		{
			return (filemtime($a) > filemtime($b)) ? -1 : 1;
		}
		$dir = glob("images/$file/*"); // put all files in an array
		$k=1;
		//uasort($dir, "newest"); // sort the array by calling newest()
		natsort($dir);
		foreach($dir as $entry)
		{
			if (basename($entry)!= "." && basename($entry) != ".." && basename($entry)!= "Thumbs.db" && basename($entry)!= "index.html" && is_dir($entry) == false)
			{ 				
			?>
				<li style="margin-bottom:5px;">
					<?php echo $k.'. ';?><a href="#" class="ofile" data-ref="<?php echo $typ;?>" data-link="<?php echo $file.'/'.basename($entry);?>" style="text-decoration:none;font-family:arial;font-size:14px;font-weight:bold;" target="read"><?php echo basename($entry);?></a>
				</li>			
			<?php
				$k++;
				
			}
		}
		?>
	</ul>
</div>
<?php
if($title=='Assignments' || $title=='Case-Studies' || $title == 'Exercises/Quiz')
{
	$ft = ($title=='Assignments'?'a':($title=='Case-Studies'?'cs':($title=='Exercises/Quiz'?'q':'')));
?>
	<br/><br/><hr/>   
	<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>
	<form method="post" action="http://www.rimsr.in/uploadassign.php?t=<?php echo $ft;?>" class="form_sty" name="frm1" enctype="multipart/form-data">
		<div style="max-width:700px;margin:0 auto;">
			<h3><b><u>Submit Your <?php echo $title;?> Here:</u></b></h3><br/>
			<div style="max-width:300px !important;float:left;"><label>Enter Student Id:</label></div>
			<input type="text" name="studid" required class="form-control" value="" style="max-width:250px !important;" />&nbsp;&nbsp;<br/>
			<div style="max-width:300px !important;float:left;"><label>Upload Your <?php echo $title;?> File:</label></div>
			<input type="file" required class="form-control" name="assignment" value="" style="max-width:250px !important;"/>&nbsp;&nbsp;<br/>
			<div style="text-align:center;max-width:400px;">
				<input type="submit" name="submit" value="SUBMIT" class="submit" ></input>
			</div>
		</div>
	</form>
	<script language="JavaScript" type="text/javascript"
		xml:space="preserve">//<![CDATA[
		//You should create the validator only after the definition of the HTML form
		var frmvalidator  = new Validator("frm1"); 
		frmvalidator.addValidation("studid","req","Enter Student Id");   	
		frmvalidator.addValidation("assignment","req","Upload file"); 						
	//]]>
	</script>
<?php
}
?>