<?php include "header.php";
$uid=isset($_SESSION['rim_usid'])?isset($_SESSION['rim_usid']):'';
if($uid == '')
{
	header('location:index.php');
	exit; 
}


?> 
<style>
	.sidebar-widget-right{
	    height: 430px;
	    background: #fff none repeat scroll 0 0;
	    border: 1px solid #e0e0e0;
	    padding: 12px 25px;
    	text-align: left;
	}
.entry-banner {
    background: url('./images/moto.jpg') no-repeat scroll center;
	background-size:cover;
}
.mt-10{margin-top:10px;}
.pl-20{padding-left:20px;}
</style>
	<div id="content" class="site-content">
		<div class="entry-banner">
			<div class="container">
				<div class="entry-banner-content">
					<h1 class="entry-title">RIMSR’S LEARNING CENTER</h1>					
				</div>
			</div>
		</div>
		<div id="primary" class="content-area pt-100" style="background-color: #f5f5f5;">
			<div class="container abtus">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<main id="main" class="site-main">
							<article id="post-1225" class="post-1225 page type-page status-publish hentry">
								<div class="entry-content">
									<div class="vc_row wpb_row vc_row-fluid vc_custom_1510748400939">
										<div class="wpb_column vc_column_container col-md-12">
											<div class="vc_column-inner" style="padding: 30px;  background-color: #fff;">
												<div class="wpb_wrapper">
													<div class="wpb_text_column wpb_content_element ">
														<div class="wpb_wrapper content">						
															<h3 class="mt-10 text-center">Welcome to RIMSR’s Learning Center. </h3>
															
															<p>Congratulations on your selection to the program of your choice.  NEF and RIMSR have great pleasure in inviting you to the student's community of RIMSR.</p><p>
 
You are provided with the id, and password to login to the Learning Centre.  You can now access the e-tutorials, e-library, assignments, case studies, quizzes, exercises, and webcasts/webinars. </p><p>
 
The program that you are about to take is on E-Platform.  It is a useful program and adds value to your scholastic accomplishments.  In short, it is a "career-multiplier," providing you with the required capacities to perform better on your job.

</p>	<hr/>														
															<div class="col-md-12" id="category">
																<ul style="font-size:20px;">
																    <?php if(@$_SESSION['saral'] == 'saral'){ ?>
																            <li class="col-md-4"><a href="e-tutorial.php" class="btn btn-primary lnk lh" data-link="Tutorials">Saral Shikshak</a></li>
																  <?php  }else{ ?>
																	<li class="col-md-4"><a href="" class="qlink lnk btn lh" data-key="el" data-link="reference_books">E-Library</a></li>
																	<li class="col-md-4"><a href="e-tutorial.php" class="btn btn-primary lnk lh" data-link="Tutorials">Tutorials</a></li>
																	<li class="col-md-4"><a href="" class="qlink lnk btn lh" data-key="as" data-link="assignments">Assignments</a></li>
																	<li class="col-md-4"><a href="" class="qlink lnk btn lh" data-key="cs" data-link="case-studies">Case-Studies</a></li>
																	<li class="col-md-4"><a href="" class="qlink lnk btn lh" data-key="qz" data-link="quiz">Exercises/Quizes</a></li>
																	<li class="col-md-4"><a href="" class="qlink lnk btn lh" data-key="wc" data-link="webcast">Webinars/Webcasts</a></li>
															    <?php } ?>
																</ul>
															</div>															
														</div>
													</div>
												</div>
											</div>
										</div>										
									</div>									
								</div>
							</article>
						</main>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php";?>    
    <?php include "js-script.php";?>
	<script type="text/javascript">
	$(function(){
		
		/* $('.content').on('click','.ofile',function(e){
			e.preventDefault();
			var link=$(this).attr('data-link');
			var ref=$(this).attr('data-ref');
			var title=$(this).text().split('.');
			if(ref=='refbook')
			{
				var omyFrame = document.getElementById("myFrame");
				omyFrame.style.display="block";		
				omyFrame.src = "images/"+link;
			}
			else
			{
				var vid = document.getElementById("myVideo");				
				vid.src = "images/"+link;				
				vid.load();
			}
			$('.content #pg-title').text(title[0].split('_').join(' '));
		}); */
		$('.qlink').on('click',function(e){
			e.preventDefault();
			var link=$(this).attr('data-link');
			var key=$(this).attr('data-key');
			localStorage.setItem('f',link);
			localStorage.setItem('k',key);
			window.location.href = "e-tutorialcommon.php";			
		});
		/* $('.qlink').on('click',function(e){
			e.preventDefault();
			var link=$(this).attr('data-link');
			$('.entry-title').text(link.toUpperCase());
			if(link=='Tutorials'||link=='Webinars/Webcasts')
			{
				$.ajax({
					type:'POST',
					url:'getfile.php',
					data:'t=v&title='+link,
					success:function(res){
						$('.content').html(res);
					}
				});
			}
			else
			{
				$.ajax({
					type:'POST',
					url:'getfile.php',
					data:'t=r&title='+link,
					success:function(res){
						$('.content').html(res);
					}
				});
			}
		}); */
	
	});
	</script>
</body>
</html>