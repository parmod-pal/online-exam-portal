<?php			
$t=$path=$dir=$s='';
	if(isset($_REQUEST['s']))
	{
		$s=$_REQUEST['s'];
	} 
	if(isset($_REQUEST['t']))
	{
		$t=$_REQUEST['t'];
	} 	
	function newest($a,$b)
	{
		return (filemtime($a) > filemtime($b)) ? -1 : 1;
	}
	
	$path="../images/$t/";
	$dir = glob("../images/$t/*");
	if($path != '' && $dir !='' && $t != '')
	{
		//uasort($dir, "newest"); // sort the array by calling newest()
		natsort($dir);
		$i=1;
		?>
		<div style="font-family:arial;font-size:12px;font-weight:normal;width:100%;">
			<ul class="columns" style="margin-left:15px;" data-columns="3">
		<?php
		
		foreach($dir as $entry)
		{
			if (basename($entry)!= "." && basename($entry) != ".." && basename($entry)!= "Thumbs.db" && basename($entry)!= "index.html")
			{ 		
				if($s != '')
				{
					
					if(stripos(basename($entry),$s) !== false)
					{						
					?>						
					<li style="margin-bottom:5px;" id="rw-<?php echo $i;?>">
						<?php echo $i;?>.  <a href="<?php echo $path;?>/<?php echo basename($entry);?>" target="_blank" class="ofile" data-link="<?php echo basename($entry);?>" style="text-decoration:none;font-family:arial;font-size:14px;font-weight:bold;" target="read"><?php echo basename($entry);?></a><span data-id="<?php echo $i;?>" title="Delete" data-path="<?php echo $path;?>/<?php echo basename($entry);?>" class="remfile">X</span>
					</li>							
					<?php
						$i++;
					}
				}
				else
				{
				?>
						
					<li style="margin-bottom:5px;" id="rw-<?php echo $i;?>">
						<?php echo $i;?>.  <a href="<?php echo $path;?>/<?php echo basename($entry);?>" target="_blank" class="ofile" data-link="<?php echo basename($entry);?>" style="text-decoration:none;font-family:arial;font-size:14px;font-weight:bold;" target="read"><?php echo basename($entry);?></a><span data-id="<?php echo $i;?>" title="Delete" data-path="<?php echo $path;?>/<?php echo basename($entry);?>" class="remfile">X</span>
					</li>
							
				<?php
					$i++;
				}
				
			}
		}
		?>
		</ul>
				</div>
				<?php
	}
	else
	{
		echo 'empty';
	}
?>