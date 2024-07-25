<?php
if(!isset($_SESSION))
{
session_start();
}
include "function.php";
?>
<div id="wrap2" class="wrap2">
<div id="perinfo">
<h2><label>View User Details</label></h2><br/>
<table width="850">
	<tbody>
		<tr class="top">
			<td style="text-align:center;">Username</td>
			<td style="text-align:center;">Email id</td>
			<td style="text-align:center;">Usertype</td>			
			<td width="100" style="text-align:center;">Edit/Delete</td>
		</tr>
		<?php	
		$usrname='';				
		$studlist=selusr();			
		if(count($studlist)>0)
		{
			foreach($studlist as $slist)
			{	
				if(isset($_SESSION['usrname']))
				{
					$usrname=$_SESSION['usrname'];
				}
				if($usrname !=$slist['username'])
				{
			?>
					<tr >
						<td><?php echo $slist['username'];?></td>
						<td><?php echo $slist['email'];?></td>				
						<td><?php echo $slist['usrtype'];?></td>			
						<td style="text-align:center;"><a href="index.php?m=editusr&a=template&id=<?php echo $slist['id'];?>"><img src="images/edit1.png"/></a>&nbsp;&nbsp;&nbsp;<a href="process/deleteusr.php?id=<?php echo $slist['id'];?>" id="delstud" onclick="return chkdel('Are you sure want to delete?');"><img src="images/delete1.png"  /></a></td>
					</tr>
			<?php
				}
			}
		}
		else
		{
		?>
			<tr>
				<td colspan="6" style="text-align:center;">No Result Found</td>				
			</tr>
		<?php
		}
		
		
		?>		
	</tbody>
</table>
</div>
</div>