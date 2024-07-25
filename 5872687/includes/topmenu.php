<body>
<div id="layout" class="layout">
	<div id="header" class="header">
		<div id="logo" class="logo"><img src="images/logo.jpg" /><br/>
			<strong><font size="4.95px" face="Verdana, Arial, Helvetica, sans-serif" color="#0A50A1">Rangnekar Institute of Management Studies and Research</font></strong>
		</div>
		<!--<div id="unilogo" class="unilogo"><img src="images/unilogo.jpeg" style="float:right; margin-right:20px;" /></div>-->
	</div>
</div>
<div id="icon" class="icon">
	<div id="layout" class="layout">
		<div id="head" class="head"><img src="images/sips.jpg"></div>
		<?php
		/* if (session_id =="") {
		  session_start();
		} */
		if (!isset($_SESSION)) session_start();
		if(isset($_SESSION['login'])==1)
		{
		?>
		<div id="set" class="set">
			<a href="index.php?m=viewprofile&a=template" title="User Settings"><img src="images/edituser.png" /></a>
			<a href="index.php?m=main&a=template" title="Add New"><img src="images/add.png" /></a>
			<a href="index.php?m=view&a=template" title="View Student List"><img src="images/report1.png" /></a>
			<a href="index.php?m=rpt1&a=template" title="View Report"><img src="images/edit.png" /></a>			
			<a href="index.php?act=logout" title="Logout"><img src="images/logout.png" /></a>
			<?php
			/* if(isset($_SESSION['usrtyp'])=='Super Admin')
			{
			?>
				<a href="process/download.php" title="Backup"><img src="images/backup.png" /></a>
			<?php
			} */
		?>
		</div>
		<?php
		}
		?>
	</div>
</div>
<div id="layout" class="layout">