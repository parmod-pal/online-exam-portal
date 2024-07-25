<?php		
	require "includes/viewmenu.php";	
?>
<div id="wrap2" class="wrap2" style="height:600px;overflow-y:scroll;overflow-x:hidden;">
	<input type="hidden" value="" id="delusr" name="delusr"/>
	<div style="float:left;font-size:14px;font-weight:bold;padding:15px;">View Student List</div>
	<div id="admin" class="admin">		
		<form method="post" action="" name="frm">
			<label style="float:left;">Admission no:</label>
			<input type="hidden" class="search" value="srch" name="hdval" placeholder="Search" />
			<input type="text" class="search" name="srch" placeholder="Search" />
			<input type="submit" class="submit" value="Search" name="submit" />
		</form>
	</div>
	<div style="clear:both;"></div>
	<div id="display" class="display">
		<table width="857">
			<tbody>
				<tr class="top">
					<td width="115" style="text-align:center;">Admission No.</td>
					<td width="136" style="text-align:center;">Name</td>
					<td width="120" style="text-align:center;">Mobile</td>
					<td width="164" style="text-align:center;">Email Id</td>
					<td width="90" style="text-align:center;">Gender</td>
					<td width="100" style="text-align:center;">Edit/Delete</td>
				</tr>
				<?php	
				$i=1;
				$studlist=selstudlist();		
				foreach($studlist as $slist)
				{						
				?>
				<tr >
					<td><?php echo $slist['admissionno'];?></td>
					<td><?php echo $slist['firstname'].' '.$slist['middlename'].' '.$slist['lastname'];?></td>
					<td><?php echo $slist['mobile'];?></td>
					<td><?php echo $slist['emailid'];?></td>
					<td><?php echo $slist['gender'];?></td>
					<td style="text-align:center;"><a href="index.php?m=edit&a=template&id=<?php echo $slist['id'];?>&pid=<?php echo $slist['admittedfor'];?>"><img src="images/edit1.png"/></a>&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $slist['id'];?>" onclick="return delstd(this.id);"><img src="images/delete1.png"  /></a></td>
				</tr>
				<?php
				}
				?>		
			</tbody>
		</table>
	</div>
</div>
<div style="width:300px;" id="ps3">						
	<label style="font-size:14px;font-weight:bold;padding-top:5px;margin-bottom:5px; color:#0163BC;">Enter Password</label><br/>
	<input type="password" class="inpt" style="width:185px;margin-right:5px;" name="ss3" id="ss3" value=""/>
	<input type="button" value="submit" name="login" class="next" onclick='return delusr();' style="margin-top: 0; padding: 5px 12px;" />		
</div>