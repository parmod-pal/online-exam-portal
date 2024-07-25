<?php 
ob_start();
ini_set('display_errors',0);
if(!isset($_SESSION)){session_start();}
$s_usid='';
include "dbconnect.php";?>
<!doctype html>
<html lang="en-US">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link type="text/css" media="all" href="css/style.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="css/flickr.css" rel="stylesheet" />
    <link type="text/css" media="only screen and (max-width: 767px)" href="css/woocommerce.css" rel="stylesheet" />
	<link rel="shortcut icon" type="image/x-icon" href="images/fav.png" />
    <title>Rimsr | for quality management education</title>
    <script>
        /* You can add more configuration options to webfontloader by previously defining the WebFontConfig with your options */
        if (typeof WebFontConfig === "undefined") {
            WebFontConfig = new Object();
        }
        WebFontConfig['google'] = {
            families: ['Roboto:500,400']
        };

        (function() {
            var wf = document.createElement('script');
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.3/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <noscript>
        <style>
            #preloader {
                display: none;
            }
        </style>
    </noscript>   
    <link rel='stylesheet' id='dashicons-css' href='css/dashicons.css' type='text/css' media='all' />
    <link rel='stylesheet' id='eikra-gfonts-css' href='//fonts.googleapis.com/css?family=Roboto%3A400%2C400i%2C500%2C500i%2C700%2C700i%26subset%3Dlatin%2Clatin-ext&#038;ver=1524824333' type='text/css' media='all' />
    <script type='text/javascript' src='js/jquery-1.11.1.min.js'></script>
    <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript> 
	
	
	
</head>
<body class="home page-template-default page page-id-54 non-stick header-style-1 has-topbar topbar-style-4">
    <div id="preloader" style="background-image:url(images/preloader.gif);"></div>
    <div id="page" class="site"> <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
        <header id="masthead" class="site-header">
            <div id="tophead">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="tophead-contact">
                                <ul>
                                    <!--<li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+91">+91-9999999999</a></li>
                                    <li class="topbar-icon-seperator">|</li>-->
                                    <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:registrar@rimsr.in">registrar@rimsr.in</a></li>
                                </ul>
                            </div>
                            <div class="tophead-right">
							<!--<a class="topbar-btn" href="http://www.rimsr.in/business" target="_blank">Business Game</a>-->
							<a class="topbar-btn" href="https://rimsr.in/exam/">Exam/Test Login</a>  <a class="topbar-btn" href="https://nefuniversity.skillport.com/skillportfe/login.action" target="_blank">SUNY's Courses</a>  
							<?php
							if(isset($_SESSION['rim_usid']))
							{
								$s_usid=$_SESSION['rim_usid'];
							}
							if($s_usid != '')
							{
							?>
								<a class="topbar-btn" href="logout.php">Logout</a>
							<?php
							}
							else
							{
							?>
								<!--<a class="topbar-btn" href="#slogin" data-toggle="modal">Saral Sikshak</a>-->
							<?php
							}
							?>
							<!--<a class="topbar-btn" href="KSOU.php" target="_blank">KSOU Courses</a>-->
							</div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container masthead-container">
                <div class="row">
                    <div class="col-sm-2 col-xs-12">
                        <div class="site-branding">
                            <a class="dark-logo" href="index.php"><img src="images/logo.jpg" alt="Rimsr" style="max-width: 225px;   height: auto;"></a>
                            <a class="light-logo" href="index.php"><img src="images/logo.jpg" alt="Rimsr" style="max-width: 225px;   height: auto;"></a>
                            
                        </div>
                    
                    </div>
                    <div class="col-sm-10 col-xs-12">
                     
                        <div id="site-navigation" class="main-navigation">
                            <nav class="menu-main-menu-container">
                                <ul id="menu-main-menu" class="menu">
                                    <li class="menu-item current-menu-ancestor"><a href="index.php">Home</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children"><a href="#">Rimsr</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="aboutus.php">About Us</a></li>
                                            <li class="menu-item "><a href="our_motto.php">Our Motto</a></li>
                                            <!--<li class="menu-item"><a href="objectives.php">Objectives</a></li>
                                            <li class="menu-item"><a href="facilities.php">Facilities</a></li>
											<li class="menu-item"><a href="mentors.php">Mentors</a></li>
											<li class="menu-item"><a href="activities.php">Activities of Rimsr</a></li>-->
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children"><a href="#">Programs</a>
                                         <ul class="sub-menu">
                                            
											<li class="menu-item"><a href="nef_courses.php">JOB READY COURSES</a></li>
											<!--<li class="menu-item"><a href="ats.php">Academic Testing Services</a></li>-->
                                            <!--<li class="menu-item "><a href="ecp.php">Expert Certificate Programs</a></li>-->
                                            <!--<li class="menu-item"><a href="cp.php">Certificate Programs</a></li>-->
                                            <!--<li class="menu-item"><a href="secr.php">Skill Enhancement Courses - Regulations</a></li>-->
											<!--<li class="menu-item"><a href="saf.php">Study Abroad Facilitation Program</a></li>-->
											<li class="menu-item"><a href="bg.php">Business Game</a></li>
											<li class="menu-item"><a href="saral.php">Saral Shikshak</a></li>
											<!--<li class="menu-item"><a href="#slogin" data-toggle="modal">RIMSR'S Courses</a></li>-->
											<li class="menu-item"><a href="dbl.php">Digital Literacy</a></li>
											<!--<li class="menu-item"><a href="saral_ganith.php">Saral Ganith</a></li>-->
                                        </ul>
                                    </li>
                                    <!--<li class="menu-item menu-item-has-children"><a href="#">Reference</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="http://www.mba.com/india" target="_blank">GMAT</a></li>
                                            <li class="menu-item "><a href="http://www.ets.org/gre" target="_blank">GRE</a></li>
                                            <li class="menu-item"><a href="http://www.ets.org/toefl/" target="_blank">TOEFL</a></li>
                                            <li class="menu-item"><a href="https://www.ieltsidpindia.com//home.aspx" target="_blank">IELTS</a></li>
                                        </ul>
                                    </li>-->
									 <li class="menu-item menu-item-has-children"><a href="applicationgen.php">Online Application</a>
                                        <ul class="sub-menu" id="oapp">
                                            <!--<li class="menu-item"><a href="applicationnew.php" target="_blank">Certificate Programs</a></li>-->
											 <!--<li class="menu-item menu-item-has-children"><a href="#">Skills Training</a>
                                                <ul class="sub-menu">
													<li class="menu-item menu-item-has-children"><a href="#" >Business Skills</a>
													<ul class="sub-menu">
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Business Analysis</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Communications Skills</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Corporate Social Responsibility</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Customer Service</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Finance and Accounting</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Global Business</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Human Resources</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Industry Overviews</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Leadership</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Management</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Marketing</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Operations Management</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Professional Effectiveness</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Project Management</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Sales</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Strategy and Innovation</a></li>
														<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Technology in Business</a></li>
													</ul>
													</li>
													<li class="menu-item menu-item-has-children"><a href="#" >Productivity Tools</a>
														<ul class="sub-menu">
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Business Applications</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Google</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Graphics and Design</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Internet</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Microsoft Office 2007</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Microsoft Office 2010</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Microsoft Office 2013</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Microsoft Office 2016</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Microsoft Office 365</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Microsoft Office for Mac 2011</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Mobile Devices and Computer Skills</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Operating Systems</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Productivity Tools</a></li>
														</ul>
													</li>
													<li class="menu-item menu-item-has-children"><a href="#" >IT Skills</a>
														<ul class="sub-menu">
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Business Skills for IT Professionals</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Cloud Computing and Virtualization</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Data and Databases</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Enterprise Resource Planning(ERP)</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Networks and Telecommunications</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Operating Systems and Servers</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Project Management</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Security</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Software Design and Development</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Web Development and Graphic Design</a></li>		
														</ul>
													</li>
													<li class="menu-item menu-item-has-children"><a href="#" >Certifications</a>
														<ul class="sub-menu">
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">(ISC)2</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Amazon</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">American Society for Quality (ASQ)</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">BCS Professional Certification</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Cisco</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">CompTIA</a></li>
															<li class="menu-item"><a href="applicationgen.php" title="International Software Testing Qualification Board" target="_blank" class="course">ISTQB</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">ITIL® 4</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Juniper</a></li>
															<li class="menu-item"><a href="applicationgen.php" title="Linux Professional Institute" target="_blank" class="course">LPI</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Microsoft</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Oracle</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">Red Hat</a></li>										
															<li class="menu-item"><a href="applicationgen.php" title="Society for Human Resource Management" target="_blank" class="course">SHRM</a></li>
															<li class="menu-item"><a href="applicationgen.php" target="_blank" class="course">TOGAF</a></li>											
														</ul>
													</li>
                                                </ul>
                                            </li>-->
                                           
                                            <!--<li class="menu-item"><a href="applicationnew.php" target="_blank">Global Exposure</a></li>-->
                                            <!--<li class="menu-item"><a href="applicationmba.php" target="_blank">MBA Application</a></li>-->
											<!--<li class="menu-item"><a href="applicationgen.php" target="_blank">Application for Indian Students</a></li>
											<li class="menu-item"><a href="applicationint.php" target="_blank">Application for International Students</a></li>-->
                                        </ul>
                                    </li>
                                    <!--<li class="menu-item menu-item-has-children"><a href="#">Downloads</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item menu-item-has-children"><a href="#">Certificate Programs</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="brochure/dpmbrochure.pdf"  target="_blank">Project Management</a></li>
                                                    <li class="menu-item"><a href="brochure/program.pdf"  target="_blank">Program Management</a></li>
													<li class="menu-item"><a href="brochure/business.pdf" target="_blank">Business Finance</a></li>
                                                    <li class="menu-item"><a href="brochure/health_care_management.pdf" target="_blank">Health Care Management</a></li>
													<li class="menu-item"><a href="brochure/msme.pdf" target="_blank">MSME</a></li>	
													<li class="menu-item"><a href="brochure/business_analytics.pdf" target="_blank">BUSINESS ANALYTICS</a></li>
													<li class="menu-item"><a href="brochure/bigdata.pdf" target="_blank">BIG DATA</a></li>														
                                                </ul>
                                            </li>
                                            <li class="menu-item"><a href="brochure/Global_Exposure.pdf" target="_blank">Global Exposure</a> </li>
                                            <li class="menu-item menu-item-has-children"><a href="#">Expert Certifications</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="brochure/expert_program.pdf" target="_blank">Project Management</a></li>
                                                    <li class="menu-item"><a href="brochure/product_mgmt.pdf" target="_blank">Product Management</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item"><a href="brochure/blue_print.pdf" target="_blank">Blue-Print Journal</a> </li>
											<li class="menu-item"><a href="brochure/syallabi.pdf" target="_blank">Syllabi</a> </li>
											<li class="menu-item"><a href="notification.php">Notification</a> </li>
											<li class="menu-item"><a href="brochure/saf.pdf" target="_blank">Study Abroad</a> </li>
											<!--<li class="menu-item"><a href="rimsr_video.php">RIMSR'S Video</a> </li>-->
											<!--<li class="menu-item"><a href="brochure/SKILLENHANCEMENTCOURSES.pdf" target="_blank">Skill Enhancement Courses</a> </li>
											<!--<li class="menu-item"><a href="sample_tutorial.php">Sample Tutorial</a> </li>
											<li class="menu-item"><a href="brochure/business_game.pdf" target="_blank">Business Game</a> </li>
											<li class="menu-item"><a href="brochure/saral_shikshak_program.pdf" target="_blank">Saral Shikshak</a></li>
                                        </ul>
                                    </li>-->
                                   
									
									<li class="menu-item"><a href="payment.php">Payment</a></li>
									<li class="menu-item "><a href="contactus.php">Contact Us</a></li>
									<li class="menu-item "><a href="images/COURSE_MODULES.pdf" download>Catalog</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!--<div class="col-sm-12">
                        <span style="font-size:14px;color:blue;position: absolute;margin-top:-20px;"><b>RANGNEKAR INSTITUTE OF MANAGEMENT STUDIES AND RESEARCH</b></span><br/>
                        <span style="font-size:12px;color:maroon;position: absolute;margin-top:-28px;"><b>PARTNER/AFFILIATE OF THE NATIONAL EDUCATION FOUNDATION, WASHINGTON DC, USA</b></span>
                    </div>-->
                </div>
            </div>
        </header>
		<div id="meanmenu"></div>