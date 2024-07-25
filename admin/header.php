<?php
ob_start();
session_start();
/* if(!isset($_SESSION)){session_start();} */

include "function.php";
$title=$cat=$des=$imgpath=$storagename=$output =$rmcat=$norm=$ppn=$aroom='';
date_default_timezone_set("asia/singapore");
$date=date('Y-m-d');
$pagtitle=array('t1'=>'GD & T','t2'=>'Stack-up Tolerance','t3'=>'DFMEA','c1'=>'Consumer Electronic Products','c2'=>'Industry Products','c3'=>'Plastic Design','c4'=>'Sheet Metal Design','c5'=>'FEA','c6'=>'Logo Design','c7'=>'Packaging & Label Design','c8'=>'Industrial Design','c9'=>'Design Concepts','m1'=>'Prototyping','m2'=>'CNC Machining','m3'=>'Plastic Components','m4'=>'Machined Parts','m5'=>'Stamping Parts');
if(isset($_REQUEST['pg']))
{
	$title=$pagtitle[$_REQUEST['pg']];
}
if(isset($_REQUEST['cat']))
{
	$cat=$_REQUEST['cat'];
}
$hid=$rmid=$bkid=$status='';
if(isset($_REQUEST['q']))
{
	$rmid=$_REQUEST['q'];
}
if(isset($_REQUEST['h']))
{
	$hid=$_REQUEST['h'];
}
if(isset($_REQUEST['id']))
{
	$bkid=$_REQUEST['id'];	
}
$get_page=select("select * from latestnews where id='".$rmid."' and title='".$hid."'");
if($get_page != false && $get_page[0] != '')
{
	if(!empty($get_page))
	{									
		foreach($get_page as $page => $data)
		{	
			$rmcat=$data['desc'];			
		}
	}
}

$get_hotel=select("select * from latestnews ");

?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>RIMSR</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
  
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/premium.css"> 
	<link rel="stylesheet" href="stylesheets/screen.css" />
	<script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>  
	<link rel="shortcut icon" href="../icon.png">

</head>
<body class="theme-blue">
    <!-- Demo page code -->
    <script type="text/javascript">
        $(function() {
            var match = document.cookie.match(new RegExp('color=([^;]+)'));
            if(match) var color = match[1];
            if(color) {
                $('body').removeClass(function (index, css) {
                    return (css.match (/\btheme-\S+/g) || []).join(' ')
                })
                $('body').addClass('theme-' + color);
            }
            $('[data-popover="true"]').popover({html: true});            
        });
    </script>
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
    </style>
    <script type="text/javascript">
		$(document).ready(function(){
			var actid=localStorage.getItem('actlink');			
			$('li').removeClass('active');
			$('ul').removeClass('in');				
			$('#'+actid).parent('li').addClass('active');
			$('.active').parent('ul').addClass('in');
			$('.in').parent('li').prev().find('.collapsed').removeClass('collapsed');			
			$('.sidebar-nav a').on('click',function(){			
				var id=$(this).attr('id');
				localStorage.setItem('actlink',id);				
			});	
		});
        $(function() {			
			var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone()); 
        });
		
    </script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le fav and touch icons -->   
	
  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
   
  <!--<![endif]-->

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.php"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> Rangnekar Institute of Management Studies and Research</span></a></div> 
		  <?php
		if(isset($_SESSION['usid'])) 
		{
			if($_SESSION['usid'] !='') 
			{
			?>
			<div class="navbar-collapse collapse" style="height: 1px;">
				<ul id="main-menu" class="nav navbar-nav navbar-right">
					<li class="dropdown hidden-xs">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="Ionicons icon-476 padding-right-small" style="position:relative;top: 3px;"></span> <?php echo $_SESSION['fullname'];?>
							<i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="user.php?urid=<?php echo $_SESSION['usid'];?>">My Account</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Admin Panel</li>
							<li><a href="users.php">Users</a></li>               
							<li class="divider"></li>
							<li><a tabindex="-1" href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<?php
			}
		}
		?>			
      </div>	  