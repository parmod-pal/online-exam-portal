<?php
include "function.php";
$pid='';
	if(isset($_REQUEST['pid']))
	{
		$pid=$_REQUEST['pid'];
	}	
?>
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
		$studlist=selstudbyprog($pid);			
		if(count($studlist)>0)
		{
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