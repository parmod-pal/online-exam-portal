<?php include "header.php";?> 
<style>
	.sidebar-widget-right{
	    height: 430px;
	    background: #fff none repeat scroll 0 0;
	    border: 1px solid #e0e0e0;
	    padding: 12px 25px;
    	text-align: left;
	}

   .entry-banner {
    background: url('./images/activities.jpg') no-repeat scroll center;
	background-size:cover;
}


</style>
	<div id="content" class="site-content">
		<div class="entry-banner">
			<div class="container">
				<div class="entry-banner-content">
					<h1 class="entry-title">Activities of RIMSR</h1>
					<div class="breadcrumb-area">
						<div class="entry-breadcrumb"> <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Rimsr." href="#" class="home"><span property="name"></span></a>
							
							<meta property="position" content="1">
							</span><span class="breadcrumb-seperator"> - </span><span property="itemListElement" typeof="ListItem"><span property="name"></span>
							<meta property="position" content="2">
							</span>
						</div>
					</div>
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
										<div class="wpb_column vc_column_container col-md-8">
											<div class="vc_column-inner" style="padding: 30px;  background-color: #fff;">
												<div class="wpb_wrapper">
													<div class="wpb_text_column wpb_content_element ">
														<div class="wpb_wrapper">
															
                                                           <p id="para">
<?php


$sql = "SELECT description FROM newsevents where title='Activities of RIMSR' ";
echo select($sql);
?> 
</p>


														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="sidebar-widget-right"><br><br>
											<h2> &emsp; &nbsp; &nbsp; &nbsp;CATEGORIES</h2>


											<div class="col-md-12" id="category">
  <br>
<ul>
<li><a href="our_motto.php">&emsp;&emsp;&nbsp;Our Motto</a></li><br>
<li><a href="objectives.php">&emsp;&emsp;&nbsp;Objectivies</a></li><br>

<li><a href="facilities.php">&emsp;&emsp;&nbsp;Facilities </a></li><br>

<li><a href="mentors.php">&emsp;&emsp;&nbsp;Faculty Profile</a></li><br>

<li><a href="activities.php">&emsp;&emsp;&nbsp;Activities of RIMSR</a></li><br>


</ul>
</div>



											</div>
											<!-- <div class="vc_column-inner ">
												<div class="wpb_wrapper">
													<div class="wpb_single_image wpb_content_element vc_align_left">
														<figure class="wpb_wrapper vc_figure">
															<div class="vc_single_image-wrapper   vc_box_border_grey">
																<img width="599" height="385" src="images/abt1.jpg" class="vc_single_image-img attachment-full" alt="" /></div>
														</figure>
													</div>
												</div>
											</div> -->
										</div>
									</div>
									
									
									<div class="vc_row-full-width vc_clearfix"></div>
									 <?php include "counter.php";?>
									<div class="vc_row-full-width vc_clearfix"></div>
									 <?php include "stud-say.php";?>
									 <div class="vc_row-full-width hr"></div>
									 <?php include "clients.php";?>
									<div class="vc_row-full-width vc_clearfix"></div>
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
</body>
</html>