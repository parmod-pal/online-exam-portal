<?php
include "dbconnect.php";
$type=isset($_REQUEST['t'])?$_REQUEST['t']:'';
$title=isset($_REQUEST['title'])?$_REQUEST['title']:'';
$typ='refbook';
$file = strtolower($title);

if($type=='v')
{
	$typ='video';
}
?>
<a href="e-tutorial.php" class="btn btn-primary" style="float:right;color:#fff;">Home</a>
<!--<a href="#" onclick="window.history.back();" class="btn btn-primary" style="float:right;color:#fff;">Back</a>-->
<h2 class="text-center mt-10" id="pg-title"> </h2>

<?php

/* if($file == 'supply_chain_management' || $file == 'saral_shikshak' || $file == 'others' || $file == 'financial_management' || $file == 'health_care')
{
	$sql = "SELECT description FROM tutorial where title='$file' ";
	echo stripslashes(select($sql));
}
else
{ */
?> 
<video id="myVideo" width="100%" controls autoplay style="border:1px solid #ddd;">
	<source id="mp4_src" src="" type="video/mp4">
</video>
<br/>

<h3 class="mt-10 pl-20"><u><b>List of <?php echo ucfirst(str_replace('_',' ',$title));?> :</b></u></h3>
<div style="font-family:arial;font-size:12px;font-weight:normal;width:100%;">
	<ul class="columns" data-columns="2" >
		<?php															
		function newest($a,$b)
		{
			return (filemtime($a) > filemtime($b)) ? -1 : 1;
		}
		$dir = glob("images/tutorials/$file/*"); // put all files in an array
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
/* } */
?>