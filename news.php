<?php include "header.php";
$id="";
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
?> 
<style>
	.sidebar-widget-right{
	    height: 486px;
	    background: #fff none repeat scroll 0 0;
	    border: 1px solid #e0e0e0;
	    padding: 12px 25px;
    	text-align: left;
	}
   .entry-banner {
    background: url('./images/exp10.jpg') no-repeat scroll center;
	background-size:cover;
}



</style>
	<div id="content" class="site-content">
		<div class="entry-banner">
			<div class="container">
				<div class="entry-banner-content">
					<h1 class="entry-title">News</h1>
					
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
															$sql = "SELECT * FROM latestnews where id='".$id."' ";
															$res= selectall($sql);
															
															if(count($res)>0)
															{
																foreach($res as $val)
																{
																	echo '<h2><strong>'.$val['title'].'</strong></h2>';
																	echo $val['description'];
																}
															}
															?> 
															</p>
														</div>
													</div>
												</div>
											</div>
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