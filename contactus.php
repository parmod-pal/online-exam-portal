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
    background: url('./images/contact.jpg') no-repeat scroll center;
	background-size:cover;
}
</style>
        <div id="content" class="site-content">
            <div class="entry-banner">
                <div class="container">
                    <div class="entry-banner-content">
                        <h1 class="entry-title">Contact Us</h1>
                       <!-- <div class="breadcrumb-area">
                            <div class="entry-breadcrumb"> <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Rimsr." href="#" class="home"><span property="name">Rimsr</span></a>
                                <meta property="position" content="1">
                                </span><span class="breadcrumb-seperator"> - </span><span property="itemListElement" typeof="ListItem"><span property="name">Contact Us</span>
                                <meta property="position" content="2">
                                </span>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
            <div id="primary" class="content-area pt-100">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <main id="main" class="site-main">
                                <article id="post-1111" class="post-1111 page type-page status-publish hentry">
                                    <div class="entry-content">
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner vc_custom_1509100691886">
                                                    <div class="wpb_wrapper">
                                                        <div class="rt-vc-contact-1 ">
                                                            <ul class="rtin-item">
                                                                <li><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                    <h3>Address</h3>
                                                                    <p>MS. MAMATA<br/>
																		Deputy Registrar<br/>
																		35, III Floor, JC Plaza,
																		42nd Cross,<br/> 12th Main,
																		III Block, Rajajinagar,<br/>
																		Bangalore 560 010<br/>
																		Karnataka, India.</p>
                                                                </li>
																<li> <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                                    <h3>E-mail</h3>
                                                                    <p>registrar@rimsr.in</p>
                                                                </li>
																<!--<li> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                    <h3>Overseas Center</h3>
                                                                    <p>MR. ERNIE BAKER<br/>HEAD-OVERSEAS CENTER<br/>3739, Ashford-Dunwoody Road,<br/>
																		Brookhaven, Atlanta,<br/>
																		GA 30319, USA.</p>
                                                                </li>
                                                                <li> <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                                    <h3>E-mail</h3>
                                                                    <p>head-ocusa@rimsr.in</p>
                                                                </li>
                                                                <li> 
                                                                    <h3>Trust Regd No:</h3>
                                                                    <p>BOOK IV/59/10-11/31-05-2010</p>
                                                                </li>-->
                                                                <li>
                                                                    <h3>Find Us On</h3>
                                                                    <ul class="contact-social">
																		<li><a href="https://www.facebook.com/RIMSR-1925697324185250" target="_blank"><i class="fa fa-facebook"></i></a></li>
																		<li><a href="https://www.linkedin.com/company/rimsr/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-8">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <h2 style="font-size: 30px;color: #002147;line-height: 1.5;text-align: justify" class="vc_custom_heading">To Contact Us:</h2>
                                                        <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_10 vc_sep_border_width_3 vc_sep_pos_align_left vc_separator_no_text"><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:#fdc800;" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:#fdc800;" class="vc_sep_line"></span></span>
                                                        </div>
                                                        <div role="form" class="wpcf7" id="wpcf7-f7-p1111-o1" lang="en-US" dir="ltr">
                                                            <form action="enquiry.php" method="post" name="enq" class="wpcf7-form" novalidate="novalidate"> 
																<input name="chk" value="c" type="hidden" />
                                                                <div class="contact-us-form">
																	<div class="error"><?php echo $error;?></div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                            <div class="form-group"><span class="wpcf7-form-control-wrap text-215"><input type="text" name="name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" required placeholder="Name*" /></span></div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                            <div class="form-group"><span class="wpcf7-form-control-wrap email-788"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control" required placeholder="Email*" /></span></div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                            <div class="form-group"><span class="wpcf7-form-control-wrap text-216"><input type="text" name="subject" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"  placeholder="Subject" /></span></div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                            <div class="form-group"><span class="wpcf7-form-control-wrap tel-871"><input type="tel" name="mobile" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel form-control" required placeholder="Phone*" /></span></div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group"><span class="wpcf7-form-control-wrap textarea-349"><textarea name="msg" cols="20" rows="7" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required textarea form-control"  placeholder="Message"></textarea></span></div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <input type="submit" name="send" value="SUBMIT" class="wpcf7-form-control wpcf7-submit rdtheme-button-2" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
														<br/>
														<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.723395191493!2d77.55244191430458!3d12.989535318000238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3d8ceb0c3589%3A0xf4ff7876b4a8b26e!2sRIMSR!5e0!3m2!1sen!2sin!4v1537879636624" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
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
	  <script>
  setTimeout( "$('.error').hide();", 4000);
  </script>
	<script src="js/gen_validatorv4.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript"
//    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("enq");
  frmvalidator.addValidation("name","req","Please enter your Name");   
  frmvalidator.addValidation("email","req","Please enter your Email");
  frmvalidator.addValidation("email","email","Please enter Valid Email");
  frmvalidator.addValidation("mobile","req","Phone No. Is Required");
 frmvalidator.addValidation("mobile","minlen=10","Enter a valid Phone No.");
  frmvalidator.addValidation("mobile","numeric","Enter a valid Phone No.");

////]]></script>
</body>
</html>