<?php			
	$path=$dir='';
	function newest($a,$b)
	{
		return (filemtime($a) > filemtime($b)) ? -1 : 1;
	}	
	$path='../rimsrnew/images/tutorials/';
	$dir = glob('../rimsrnew/images/tutorials/*');
	if($path != '' && $dir !='')
	{
		uasort($dir, "newest"); // sort the array by calling newest()
		$i=1;
		foreach($dir as $entry)
		{
			if (basename($entry)!= "." && basename($entry) != ".." && basename($entry)!= "Thumbs.db" && basename($entry)!= "index.html")
			{ 
		?>
				<div style="font-family:arial;font-size:12px;font-weight:normal;width:100%;">
					<ul style="margin-left:15px;">
						<li style="margin-bottom:5px;" id="rw-<?php echo $i;?>">
							<a href="<?php echo $path;?>/<?php echo basename($entry);?>" target="_blank" class="ofile" data-link="<?php echo basename($entry);?>" style="text-decoration:none;font-family:arial;font-size:14px;font-weight:bold;" target="read"><?php echo basename($entry);?></a><span data-id="<?php echo $i;?>" title="Delete" data-path="<?php echo $path;?>/<?php echo basename($entry);?>" class="remfile">X</span>
						</li>
					</ul>
				</div>
		<?php
				$i++;
			}
		}
	}
	else
	{
		echo 'empty';
	}
?>