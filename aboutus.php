<?php include "header.php";?> 
<style>
	.sidebar-widget-right{
	    height: 750px;
	    background: #fff none repeat scroll 0 0;
	    border: 1px solid #e0e0e0;
	    padding: 12px 25px;
    	text-align: left;
	}

    .entry-banner {
    background: url('./images/about.jpg') no-repeat scroll center;
	background-size:cover;
}

</style>
	<div id="content" class="site-content">
		<div class="entry-banner">
			<div class="container">
				<div class="entry-banner-content">
					<h1 class="entry-title" style="color:#000;">About Us</h1>
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
										<div class="wpb_column vc_column_container col-md-12">
											<div class="vc_column-inner" style="padding: 30px;  background-color: #fff;">
												<div class="wpb_wrapper">
													<div class="wpb_text_column wpb_content_element ">
														<div class="wpb_wrapper">
															
                                                           <p id="para">
<?php


$sql = "SELECT description FROM newsevents where title='About Us' ";
echo select($sql);
?> 
</p>


														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									
									
		<div class="vc_row-full-width vc_clearfix"></div>

		<!--<div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1508848182497 vc_row-has-fill">
		<div class="wpb_column vc_column_container vc_col-sm-12">
		<div class="vc_column-inner ">
		<div class="wpb_wrapper">
		<div class="rt-vc-course-slider owl-wrap rt-owl-nav-1">
		
		<div class="section-title clearfix">
		<h2 class="owl-custom-nav-title text-left" style="float:inherit">Governing Council</h2>
		</div>
		<div class="vc_row-full-width vc_clearfix"></div>
		
		<div class="wpb_column vc_column_container vc_col-sm-4">
		<div class="text-left">
		<img src="images/appu_kuttan.png" alt="Flowers in Chania" width="460" height="345" style="border-radius: 50%;width: 170px;height: 170px;margin-left: 101px;">
		
		</div>
		</div>
		<div class="wpb_column vc_column_container vc_col-sm-8">
		<div class="text-left">		
		<h3 class="rtin-title" style="margin-top: 20px;"><a href="appukuttan.php">Dr. Appu Kuttan</a></h3>
		<div class="rtin-designation">Ph.D.,founder, director, and CEO of the National Education Foundation, Washington DC, USA</div>
		</div>
		<div class="rt-vc-text-title  style3">
		<div class="rtin-btn"><a href="sadagopan.php" target="_blank" style="border-radius: 12px;color: #fff;">Read More</a></div>
		</div>
		</div>
		
		</div>
		</div>
		</div>
		</div>
		</div>-->
									
									
									
									<div class="vc_row-full-width vc_clearfix"></div>
									<?php include "skill-instructor.php";?>
									<div class="vc_row-full-width vc_clearfix"></div>
									 <?php include "counter.php";?>
									<div class="vc_row-full-width vc_clearfix"></div>
									 <!--<?php include "stud-say.php";?>-->
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