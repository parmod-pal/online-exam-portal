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
			<div class="site-section">
		    <div class="container">
			<div class="row">
			                <div class="tophead-right">  
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
								<a class="topbar-btn" href="#slogin" data-toggle="modal">Student Login</a>
							<?php
							}
							?>
							</div>
				<div class="col-md-6">
					<a href="photogrammetry.html"><img src="images/a1.jpg" alt="Image" class="img-responsive img-rounded"></a>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<a href="photogrammetry.html"><img src="images/a1.jpg" alt="Image" class="img-responsive img-rounded"></a>
				</div>
			</div>
		    </div>
	       </div>
		</div>
	</div>
	<?php include "footer.php";?>    
    <?php include "js-script.php";?>
</body>
</html>