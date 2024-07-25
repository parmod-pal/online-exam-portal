<?php
if(!isset($_SESSION['usid'])) 
{	
	header('location:index.php');
	exit;	
}
?>
<div class="sidebar-nav">
    <ul>
		<li><a href="#" data-target=".dashboard-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
		<li><ul class="dashboard-menu nav nav-list collapse ">            
				<li class="active"><a href="users.php" id="acct1"><span class="fa fa-caret-right"></span> User List</a></li>
				<li><a href="user.php?urid=<?php echo isset($_SESSION['usid']) !='' ? $_SESSION['usid']:'';?>" id="acct2"><span class="fa fa-caret-right"></span> User Profile</a></li>           
		</ul></li>
		<li><a href="viewpages.php" class="nav-header"><i class="fa fa-fw fa-file-o"></i> Pages</a></li>	
		<li><a href="viewnews.php" class="nav-header"><i class="fa fa-fw fa-edit"></i> News</a></li>	
		<li><a href="editcounter.php" class="nav-header"><i class="fa fa-fw fa-university"></i> Update Counter</a></li>		
		<li><a href="viewtestimonial.php" class="nav-header"><i class="fa fa-fw fa-quote-left"></i> Testimonials</a></li>	
		<li><a href="uploadbooks.php" class="nav-header"><i class="fa fa-fw fa-book"></i>E-Library</a></li>
		<li><a href="uploadvideo.php" class="nav-header"><i class="fa fa-fw fa-video-camera"></i>Tutorials</a></li>
		<!--<li><a href="viewtutorial.php" class="nav-header"><i class="fa fa-fw fa-video-camera"></i>Tutorials Embed Code</a></li>-->
		<li><a href="uploadassign.php" class="nav-header"><i class="fa fa-fw fa-tasks"></i>Assignments</a></li>
		<li><a href="uploadcase.php" class="nav-header"><i class="fa fa-fw fa-briefcase"></i>Case-Studies</a></li>
		<li><a href="uploadquiz.php" class="nav-header"><i class="fa fa-fw fa-question-circle"></i>Exercises/Quizes</a></li>
		<li><a href="uploadwebcast.php" class="nav-header"><i class="fa fa-fw fa-video-camera"></i>Webinars/Webcasts</a></li>
		<!--<li><a href="viewportfolio.php"  class="nav-header " ><i class="fa fa-fw fa-file-o"></i> Portfolio</a></li>-->
		<li><a href="viewksoucourses.php" class="nav-header"><i class="fa fa-fw fa-video-camera"></i>KSOU Courses</a></li>
				
    </ul>
</div>