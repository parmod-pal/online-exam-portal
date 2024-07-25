<?php include "header.php";
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['usid'])) 
{	
	header('location:index.php');
	exit;	
}
include "sidebar.php";
$date=date('Y-m-d');
if(isset($_REQUEST['hid']))
	$hid=$_REQUEST['hid'];
else
	$hid=1;
?> 
<div class="content">
	<div class="header">            
		<h1 class="page-title">View Rooms</h1>
		<ul class="breadcrumb">
			<li><a href="#">Home Pages</a> </li>
			<li>Rooms </li>            
		</ul>
		<div style="float:right;margin-top:-35px;">
			<label for="hname" style="font-weight:bold;padding-right:10px;">Select Hotel</label>
			<select name="hname" id="hname" style="">
			<?php
			if(count($get_hotel)>0)
			{
				if(!empty($get_hotel))
				{									
					foreach($get_hotel as $page => $data)
					{	
						?>
						<option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option>
						<?php
					}
				}
			}
			?>						
			</select>
		</div>
	</div>
	<div class="main-content">           
			<div class="btn-toolbar list-toolbar">
    <a href="addrooms.php" style="color:#fff;"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Rooms</button></a>  
  <div class="btn-group">
  </div>
</div>
<div id="rmcnt">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Room Type</th>
					<th>Total Rooms</th> 
					<th>Available Rooms</th> 
					<th>Price per Night</th> 					
					<th style="width: 3.5em;"></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$targetpage = "rooms.php";
			$limit = 25;
			$allrm=select("select * from roomtypes where hotelid='".$hid."' order by id asc");
			$total_pages = count($allrm);
			$stages = 3;$page='';
			if(isset($_REQUEST['page']))
			{
				$page = mysql_escape_string($_REQUEST['page']);
			}
			if($page)
			{
				$start = ($page - 1) * $limit;
			}
			else
			{
				$start = 0;
			}			
			$rms=select("select * from roomtypes where hotelid='".$hid."' order by id asc limit $start,$limit");
			if(count($rms)>0 && $allrm[0] !='')
			{
				$i=1;$booked=0;
				foreach($rms as $pages => $fquote)
				{
					/* $avarm=select("select sum(noofrooms) as booked from booking where roomtype='".$fquote['roomtype']."' and (status='Booked' or status='Processing') and ((checkout >= '".$date."' AND checkin <= '".$date."') )");
					
					if(count($avarm) > 0 && !empty($avarm))
					{
						foreach($avarm as $rp => $rprice)
						{
							$booked=$rprice['booked'];
						}	
					}
					$avrm=$fquote['noofrooms'] - $booked; */
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $fquote['roomtype'];?></td>
					<td><?php echo $fquote['noofrooms'];?></td>
					<td><?php echo $fquote['available'];?></td>
					<td><?php echo $fquote['pricepernight'];?></td>					
					<td>
						<a href="editrooms.php?q=<?php echo $fquote['id'];?>&h=<?php echo $fquote['hotelid'];?>"><i class="fa fa-pencil"></i></a>
						<a href="#myModal" role="button" data-toggle="modal" class="delqt" id="del-<?php echo $fquote['id'];?>"><i class="fa fa-trash-o"></i></a>
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
						$paginate.= "<li><a href='$targetpage?page=$prev&hid=$hid' id='$prev'>previous</a></li>";
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
								$paginate.= "<li><a href='$targetpage?page=$counter&hid=$hid' id='$counter'>$counter</a></li>";
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
									$paginate.= "<li><a href='$targetpage?page=$counter&hid=$hid' id='$counter'>$counter</a></li>";
								}
							}
							$paginate.= "<li>...</li>";
							$paginate.= "<li><a href='$targetpage?page=$LastPagem1&hid=$hid' id='$LastPagem1'>$LastPagem1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=$lastpage&hid=$hid' id='$lastpage'>$lastpage</a></li>";
						}
						elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
						{
							$paginate.= "<li><a href='$targetpage?page=1&hid=$hid' id='1'>1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=2&hid=$hid' id='2'>2</a></li>";
							$paginate.= "<li>...</li>";
							for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
							{
								if ($counter == $page){
									$paginate.= "<li><span class='current'>$counter</span></li>";
								}else{
									$paginate.= "<li><a href='$targetpage?page=$counter&hid=$hid' id='$counter'>$counter</a></li>";}
							}
							$paginate.= "<li>...</li>";
							$paginate.= "<li><a href='$targetpage?page=$LastPagem1&hid=$hid' id='$LastPagem1'>$LastPagem1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=$lastpage&hid=$hid' id='$lastpage'>$lastpage</a></li>";
						}
						else
						{
							$paginate.= "<li><a href='$targetpage?page=1&hid=$hid' id='1'>1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=2&hid=$hid' id='2'>2</a></li>";
							$paginate.= "<li>...</li>";
							for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
							{
								if ($counter == $page){
									$paginate.= "<li><span class='current'>$counter</span></li>";
								}else{
									$paginate.= "<li><a href='$targetpage?page=$counter&hid=$hid' id='$counter'>$counter</a></li>";}
							}
						}
					}
					if ($page < $counter - 1){
						$paginate.= "<li><a href='$targetpage?page=$next&hid=$hid' id='$next'>next</a></li>";
					}else{
						$paginate.= "<li><span class='disabled'>next</span></li>";
					}
					$paginate.= "</ul>";
				}
				?>
				<tr>
					<td colspan="7" style="text-align:center;"><?php echo $paginate;?></td>
				</tr>
			<?php
			}
			else
			{
			?>
				<tr>
					<td colspan="7" style="text-align:center;">No Record Found</td>
				</tr>
			<?php
			}
			?>			
		</tbody>
	</table>
	<script>
		$('.delqt').on('click',function(){	
			var id=$(this).attr('id');
			localStorage.setItem('qid',id);			
		});
	</script>
	</div>
		<!--<ul class="pagination">
			<li><a href="#">&laquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul>-->
		<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Delete Confirmation</h3>
					</div>
					<div class="modal-body">
						<p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure you want to delete?<br>This cannot be undone.</p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<button class="btn btn-danger" data-dismiss="modal" id="delconf">Delete</button>
					</div>
				</div>
			</div>
		</div>
		<?php include "footer.php";?>
		