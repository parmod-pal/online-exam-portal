<?php include "header.php";
include "sidebar.php";

/* error_reporting(E_ALL);
ini_set('display_errors', 'On');
$re='';
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['usid']))
{
	header('location:index.php');
	exit;
}*/
?>
    <div class="content">
        <div class="header">
            <h1 class="page-title">View KSOU Courses</h1>
                    <ul class="breadcrumb">
            <li><a href="viewtestimonial.php">Home</a> </li>
            <li class="active">View KSOU Courses</li>
        </ul>
        </div>
        <div class="main-content">

<div class="btn-toolbar list-toolbar">
    <a href="addksoucourses.php" style="color:#fff;"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add KSOU Courses</button></a>
	<div class="btn-group">
	</div>
</div>
		<table class="table">
		  <thead>
			<tr>
				<th> Id</th>

				<th>Name of the Skill Training Program</th>
				<th>No. of Credits</th>
				<th>Course Duration</th>
				<th>Eligibility Criteria</th>
				<th>Fee Structure</th>
				<th style="width: 3.5em;"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			$targetpage = "viewtestimonial.php";
			$limit = 25;
			$allquote=select("select count(id) as tot from testimonial order by id desc");
			if($allquote != false && $allquote[0] !='')
			{
				$total_pages = $allquote[0]['tot'];
			}
			else
			{
				$total_pages =0;
			}
			$stages = 3;$page=0;
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

			$quotes=select("select * from testimonial order by id desc limit $start,$limit");
			if($quotes != false && $allquote[0] !='')
			{
				$i=1;
				foreach($quotes as $pages => $fquote)
				{
				?>
				<tr>
					<td><?php echo $fquote['id'];?></td>

					<td><?php echo $fquote['title'];?></td>
					<td><?php echo $fquote['location'];?></td>
					<td><?php echo substr(strip_tags($fquote['description']),0,250);?></td>
					<td><?php echo $fquote['title'];?></td>
					<td><?php echo $fquote['title'];?></td>
					<td>
						<a href="addksoucourses.php?id=<?php echo $fquote['id'];?>"><i class="fa fa-pencil"></i></a>
						<a href="#myModal" role="button" data-toggle="modal" class="delus" id="udel-<?php echo $fquote['id'];?>-<?php echo $fquote['image'];?>"><i class="fa fa-trash-o"></i></a>
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
					<td colspan="5" style="text-align:center;"><?php echo $paginate;?></td>
				</tr>
			<?php
			}
			else
			{
			?>
				<tr>
					<td colspan="5" style="text-align:center;">No Record Found</td>
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
            <button class="btn btn-danger" data-dismiss="modal" id="dtesti">Delete</button>
        </div>
      </div>
    </div>
</div>
<?php include "footer.php";?>
