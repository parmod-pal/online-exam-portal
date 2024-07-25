<?php	
include "common/function.php";
	$targetpage='myprofile.php';
	$limit = 50;
	$allquote=select("select * from basicinfo where payment_id in (select payment from userdet where game_status = 1) order by id desc ");
	if($allquote != false && $allquote[0] !='')
	{
		$total_pages = $allquote[0]['tot'];
	}
	else
	{
		$total_pages =0;
	}
	$stages = 3;$page='';
	if(isset($_REQUEST['page']))
	{
		$page = array_map_callback($_REQUEST['page']);
	}
	if($page)
	{
		$start = ($page - 1) * $limit;
	}
	else
	{
		$start = 0;
	}
	$tmdet=select("select * from basicinfo where payment_id in (select payment from userdet where game_status = 1) order by id desc limit $start,$limit");									
	if($tmdet != false && $tmdet[0] !='')
	{		
		$i=1;				
		foreach($tmdet as $team => $tm)
		{
			$uteamd=select("select name,emailid,phoneno from userdet where userid='".$tm['userid']."'"); 			
			if($uteamd != false && $uteamd[0] != '')
			{							
				$name=$uteamd[0]['name'];
				$emailid=$uteamd[0]['emailid'];
				$phone=$uteamd[0]['phoneno'];
			}
		?>
	<tr id="rw-<?php echo $tm['id'];?>">
		<td>
			<?php echo $i;?>
		</td>
		<td>
			<?php echo $name;?>
		</td>
		<td>
			<?php echo $emailid;?>
		</td>
		<td>
			<?php echo $phone;?>
		</td>
		<td>
			<?php echo $tm['username'];?>
		</td>
		<td>
			<?php echo '₹'.moneyFormatIndia($tm['estimate_cost']);?>
		</td>
		<td>
			<?php echo round($tm['promoter_stake']).'%';?>
		</td>						
		<td class="text-right">
			<div class="btn-group">
			 <a id="<?php echo $tm['id'];?>" data-id="<?php echo $tm['payment_id'];?>" class="edituser"><i class="fa fa-eye"></i></a>
			<!--<a href="#delmodal" role="button" data-toggle="modal"  id="<?php //echo $tm['id'];?>" class="deluser"><i class="fa fa-trash"></i></a>-->
			</div>
		</td>
	</tr>
	<?php
		$i++;
	}
	if ($page == 0){$page = 1;}
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$LastPagem1 = $lastpage - 1;
	$paginate = '';
	if($lastpage > 1)
	{
		$paginate .= "<ul class='pagination'>";
		if ($page > 1)
		{
			$paginate.= "<li><a href='$targetpage?page=$prev' class='pagenav' id='$prev'>previous</a></li>";
		}
		else
		{
			$paginate.= "<li><span class='disabled'>previous</span></li>";
		}
		if ($lastpage < 7 + ($stages * 2))
		{
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
				{
					$paginate.= "<li><span class='current'>$counter</span></li>";
				}
				else
				{
					$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";
				}
			}
		}
		else if($lastpage > 5 + ($stages * 2))
		{
			if($page < 1 + ($stages * 2))
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page)
					{
						$paginate.= "<li><span class='current'>$counter</span></li>";
					}
					else
					{
						$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";
					}
				}
				$paginate.= "<li>...</li>";
				$paginate.= "<li><a href='$targetpage?page=$LastPagem1' class='pagenav' id='$LastPagem1'>$LastPagem1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$lastpage' class='pagenav' id='$lastpage'>$lastpage</a></li>";
			}
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<li><a href='$targetpage?page=1' class='pagenav' id='1'>1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=2' class='pagenav' id='2'>2</a></li>";
				$paginate.= "<li>...</li>";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li><span class='current'>$counter</span></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";}
				}
				$paginate.= "<li>...</li>";
				$paginate.= "<li><a href='$targetpage?page=$LastPagem1' class='pagenav' id='$LastPagem1'>$LastPagem1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$lastpage' class='pagenav' id='$lastpage'>$lastpage</a></li>";
			}
			else
			{
				$paginate.= "<li><a href='$targetpage?page=1' class='pagenav' id='1'>1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=2' class='pagenav' id='2'>2</a></li>";
				$paginate.= "<li>...</li>";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li><span class='current'>$counter</span></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";}
				}
			}
		}
		if ($page < $counter - 1){
			$paginate.= "<li><a href='$targetpage?page=$next' class='pagenav' id='$next'>next</a></li>";
		}else{
			$paginate.= "<li><span class='disabled'>next</span></li>";
			}
		$paginate.= "</ul>";
	}
}
else
{
?>
	<tr>
		<td colspan="8" style="text-align:center;">No Data Found</td>
	</tr>
<?php
}
?>
	
<tr>
	<td colspan="8" style="text-align:center;"><?php echo $paginate;?></td>
</tr>