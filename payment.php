<?php include "header.php";
$error=$e='';
if(isset($_REQUEST['e']))
{
	$e=$_REQUEST['e'];
}
if($e==1)
{
	$error='<div class="gen alert alert-info">Process failed. Try after some time</div>';
}

if($e==3)
{
	$error='<div class="gen alert alert-success">Mail has been sent successfully</div>';
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
    background: url('./images/payment.jpg') no-repeat scroll center;
	background-size:cover;
}



</style>
	<div id="content" class="site-content">
		<div class="entry-banner">
			<div class="container">
				<div class="entry-banner-content">
					<h1 class="entry-title">Payment</h1>
					
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
															
															<div style="width: 400px;overflow: hidden;clear: both;">
															  <h3 style="margin-left: 10px;">PAY THROUGH QR CODE OF RAZORPAY </h3> 
															  <img src="https://rimsr.in/images/QrCode-RAZORPAY.png"alt = "rimsr" />
															</div>
															
															
															<div style="width: 400px;overflow: hidden;clear: both;">
															  <h3 style="margin-left: 10px;">PAY THROUGH QR CODE OF PAYTM</h3> 
															  <img src="https://rimsr.in/images/rimsr-payment-scanner.png"alt = "rimsr" />
															</div>
															  
															 <div></div> 
															  
                                                           <p id="para">
<?php


$sql = "SELECT description FROM newsevents where title='Payment' ";
echo select($sql);
?> 
</p>


														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="sidebar-widget-right">
											<h2 class="entry-title text-center">Enquire Now</h2>
												<div role="form" class="wpcf7" id="wpcf7-f7-p1111-o1" lang="en-US" dir="ltr">
													<div class="screen-reader-response"></div>
													<form action="enquiry.php" method="post" name="enquiry" id="enquiry"  class="wpcf7-form">
														<input name="chk" value="p" type="hidden" />
														<div class="contact-us-form">
															<div class="error"><?php echo $error;?></div>
															<div class="row">											
																<div class="form-group"><input type="text" name="name" value="" size="40" class="form-control" required placeholder="Name*" /></div>												
																<div class="form-group"><input type="email" name="email" value="" size="40" class="form-control" required placeholder="Email*" /></div>
																<div class="form-group"><input type="tel" name="mobile" value="" size="40" class="form-control" required placeholder="Phone *" /></div>
															<div class="form-group"><input type="text" name="subject" value="" size="40" class="form-control" placeholder="Subject" /></div>
																<div class="form-group"><textarea name="msg" cols="20" rows="4" class="form-control" placeholder="Message"></textarea></div>
																
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<input type="submit" name="send" value="SEND MESSAGE" class="rdtheme-button-2" />
																</div>
															</div>
														</div>
													</form>
												</div>



											</div>
											
										</div>
									</div>
									
									
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