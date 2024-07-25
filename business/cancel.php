<?php 
if(!isset($_SESSION)){session_start();}
include "common/function.php";
date_default_timezone_set('asia/kolkata');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if(isset($_SESSION['rim_userid']) == '') 
{
	header('location:index.php');
	exit;
}

if(isset($_SESSION['rim_userid']))
{
	$uid=$_SESSION['rim_userid'];	
}
$date=date('Y-m-d H:i:s');
 
?>
<?php include 'common/header.php';include 'common/topnav.php';?>	
<div class="maincontent">
	<div class="container">	
		<div>
			<h2 class="main-head">My Business - My Strategies</h2>
		</div>	
		<div class="clearfix"></div>
		<div class="row">			
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default itab" id="default_img">
					<div class="panel-body">
						
						<h1>Your payment has been cancelled.</h1>
							
						
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php include 'common/footscript.php';?>
</body>
<link rel="stylesheet" href="css/jquery.ui.css" >
    <script src="js/jquery.ui.js"></script>
		<!-- iCheck -->
<script src="js/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
	window.setTimeout(function(){window.location.href="http://www.rimsr.in/business/myprofile.php?act=g";}, 20000);
  });
</script>

</html>
