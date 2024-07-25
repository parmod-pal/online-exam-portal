<?php	
	if (!isset($_SESSION)) session_start();
	$usrtyp='';	
	if(isset($_SESSION['usrtyp']))
	{
		$usrtyp=$_SESSION['usrtyp'];
	}	
?>
<div id="wrap1" class="wrap1" style="">
	<div id='cssmenu' style="height:400px;">
		<ul>
			<li><a href="#us" class="active usrpro" id="vp"><span>View Profile</span></a></li>
			<?php
			if($usrtyp=="Super Admin")
			{
			?>
				<li><a href='#us' class="usrpro" id="cu" ><span>Create User</span></a></li>
				<li><a href='#us' class="usrpro" id="eu" ><span>View/Edit User</span></a></li>
			<?php
			}
			?>
			<li><a href='#us' class="usrpro" id="cp"><span>Change Password</span></a></li>			
		</ul>
	</div>
</div>