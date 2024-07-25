<?php include "header.php";
include "sidebar.php";

?>  
    <div class="content">
        <div class="header">            
            <h1 class="page-title">View Comments</h1>
                    <ul class="breadcrumb">
            <li><a href="viewnews.php">Home</a> </li>
            <li class="active">View Comments</li>
        </ul>
        </div>
        <div class="main-content">            
		
		<table class="table">
		  <thead>
			<tr>				
				<th>Blog Id</th>
				<th>Comment By</th>
				<th>Email id</th>
				<th>Comment</th>
				<th>Status</th>
				<th>Date</th>
				<th style="width: 5.5em;"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			$targetpage = "viewcomments.php";
			$limit = 25;
			$allquote=select("select * from blogcomment order by status desc");
			$total_pages = count($allquote);
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
			
			$quotes=select("select * from blogcomment order by status desc limit $start,$limit");			
			if(count($quotes)>0 && $allquote[0] !='')
			{
				
				foreach($quotes as $pages => $fquote)
				{
				?>
				<tr>					
					<td><a href="editnews.php?urid=<?php echo $fquote['blogid'];?>"><?php echo $fquote['blogid'];?></a></td>
					<td><?php echo $fquote['cusname'];?></td>
					<td><?php echo $fquote['cusemail'];?></td>
					<td><?php echo $fquote['review'];?></td>														
					<td><?php echo $fquote['status'];?></td>
					<td><?php echo $fquote['dateofpost'];?></td>
					<td>
					<?php 
					if($fquote['status'] == 'active')
					{
						?>
						<a href="#" class="apprvcm" id="cmid-<?php echo $fquote['id'];?>-u" title="unapprove" ><i class="fa fa-star"></i></a>
						<?php
					}
					else
					{
						?>
						<a href="#" class="apprvcm" id="cmid-<?php echo $fquote['id'];?>-a" title="approve"><i class="fa fa-star-o"></i></a>
						<?php
					}
					?>
						
						<a href="#myModal" role="button" data-toggle="modal" class="delus" title="remove" id="udel-<?php echo $fquote['id'];?>"><i class="fa fa-trash-o"></i></a>
						<!--<a href="commentdets.php?id=<?php echo $fquote['id'];?>&bid=<?php echo $fquote['blogid'];?>" title="view" role="button"><i class="fa fa-arrow-right"></i></a>-->
					</td>
				</tr>
				<?php
					
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
						$paginate.= "<li><a href='$targetpage?page=$prev' id='$prev'>previous</a></li>";
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
								$paginate.= "<li><a href='$targetpage?page=$counter' id='$counter'>$counter</a></li>";
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
									$paginate.= "<li><a href='$targetpage?page=$counter' id='$counter'>$counter</a></li>";
								}
							}
							$paginate.= "<li>...</li>";
							$paginate.= "<li><a href='$targetpage?page=$LastPagem1' id='$LastPagem1'>$LastPagem1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=$lastpage' id='$lastpage'>$lastpage</a></li>";
						}
						elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
						{
							$paginate.= "<li><a href='$targetpage?page=1' id='1'>1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=2' id='2'>2</a></li>";
							$paginate.= "<li>...</li>";
							for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
							{
								if ($counter == $page){
									$paginate.= "<li><span class='current'>$counter</span></li>";
								}else{
									$paginate.= "<li><a href='$targetpage?page=$counter' id='$counter'>$counter</a></li>";}
							}
							$paginate.= "<li>...</li>";
							$paginate.= "<li><a href='$targetpage?page=$LastPagem1' id='$LastPagem1'>$LastPagem1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=$lastpage' id='$lastpage'>$lastpage</a></li>";
						}
						else
						{
							$paginate.= "<li><a href='$targetpage?page=1' id='1'>1</a></li>";
							$paginate.= "<li><a href='$targetpage?page=2' id='2'>2</a></li>";
							$paginate.= "<li>...</li>";
							for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
							{
								if ($counter == $page){
									$paginate.= "<li><span class='current'>$counter</span></li>";
								}else{
									$paginate.= "<li><a href='$targetpage?page=$counter' id='$counter'>$counter</a></li>";}
							}
						}
					}
					if ($page < $counter - 1){
						$paginate.= "<li><a href='$targetpage?page=$next' id='$next'>next</a></li>";
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
            <button class="btn btn-danger" data-dismiss="modal" id="delcm">Delete</button>
        </div>
      </div>
    </div>
</div><?php include "footer.php";?>