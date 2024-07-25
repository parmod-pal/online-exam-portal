<?php
if(!isset($_SESSION)){session_start();}
$username='';
$cate='';
include "config.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!--<link rel="shortcut icon" href="images/logoicon.png"/>-->
    <title>RIMSR: Create User</title>    
	<link type="text/css" href="css/addmovie.css" rel="stylesheet"/>
	<link type="text/css" href="css/kinder.css" rel="stylesheet"/>		
	<script language="javascript">
		function deletechecked(message)
		{			
			var a=new Array();
			a=document.getElementsByName("checkbox[]");
			//alert("Length:"+a.length);
			var p=0;
			for(i=0;i<a.length;i++)
			{
				if(a[i].checked)
				{
					//alert(a[i].value);
					p=1;
				}
			}
			if (p==0)
			{
				alert('please select at least one check box');
				return false;
			}			
			else
			{
				var answer = confirm(message)
				if (answer)
				{
					document.messages.submit();
					return false; // This line added
				}
			}
			return false;  
		}		
		function deletechk(message)
		{				
			var answer = confirm(message)
			if (answer)
			{
				document.messages.submit();
				return false; // This line added
			}			
			return false;  
		}					
	</script>
</head>
<body onload="">
<div class="wrapper">	
	<div style="width:100%;border-bottom:2px solid #0A50A1; ">	
		<img src="images2/logo.jpg" style="float:left;margin-top:10px;margin-left:20px;"/>		
		<br/>
		<p style="padding-top:40px;margin-left:25px;width:600px;"><strong><font color="#0A50A1" size="4.95px" face="Verdana, Arial, Helvetica, sans-serif">Rangnekar Institute of Management Studies and Research</font></strong></p>
	</div>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="logout.php" style="text-decoration:none;color:#FF0000;">Logout</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="createuser.php" style="text-decoration:none;color:#FF0000;">Create User</a></span>
	<span style="font-weight:bold;float:right;margin-right:20px;"><a href="ques.php" style="text-decoration:none;color:#FF0000;">Home</a></span>
	<div style="width:825px;">		
		<div class="admin_panel" style="width:710px;">
			<div class="admin_form" style="width:890px;padding:10px;margin-top:45px;">
			<form name="mynewForm" method="post" action="deleteselecteduser.php">
				<table width="900" border="0">
					<tr bgcolor="#49729E" style="color:#FFF; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
						<td width="20" ></td>
						<td width="50"><div align="center">Id</div></td>
						<td width="200"><div align="center">Name</div></td>	
						<td width="150"><div align="center">Emailid</div></td>
						<td width="150"><div align="center">Username</div></td>		
						<td width="90"><div align="center">Edit</div></td>
						<td width="90"><div align="center">Delete</div></td>
					</tr>
					<?php 
					$targetpage = "viewuser.php"; 	
					$limit = 25; 								
					$sql="SELECT COUNT(*) as num FROM userdet where usertype=2";				
					$total_pages = mysqli_fetch_assoc(mysqli_query($conn,$sql));
					$total_pages = $total_pages['num'];
					$stages = 3;$page='';
					if(isset($_GET['page']))
					{
						$page = mysqli_real_escape_string($conn,$_GET['page']);
					}
					if($page)
					{
						$start = ($page - 1) * $limit; 
					}								
					else
					{
						$start = 0;	
					}									
					$query1 = "SELECT * FROM userdet where usertype=2 order by id desc LIMIT $start, $limit";
					$result = mysqli_query($conn,$query1);
					if(mysqli_num_rows($result)>0)
					{
						$i=1;
						while ($data = mysqli_fetch_assoc($result))
						{																
					?>                      
							<tr style="background-color:#F2F2F2;" >	
								<td width="20"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $data['id']; ?>"/></td>
								<td width="50"><div align="center"><?php echo $data['id'];?></div></td>
								<td width="200"><div align="center"><?php echo $data['name'];?></div></td>	
								<td width="150"><div align="center"><?php echo $data['emailid'];?></div></td>
								<td width="150"><div align="center"><?php echo $data['username'];?></div></td>	
								<td width="90"><div align="center"><a href='edituser.php?id=<?php echo $data['id'];?>' target='_parent'> Edit </a></div></td>
								<td width="90"><div align="center"><a href='deleteuser.php?id=<?php echo $data['id'];?>' target='_parent' onclick='return deletechk("Are you sure want to delete");'> Delete </a></div></td>
							</tr>					  
					<?php
						 $i++;
					}							
				}	
				?>
				<tr>
					<td colspan="7" style="text-align:center;">
				<?php
				if ($page == 0){$page = 1;}
				$prev = $page - 1;	
				$next = $page + 1;							
				$lastpage = ceil($total_pages/$limit);		
				$LastPagem1 = $lastpage - 1;
				$paginate = '';
				if($lastpage > 1)
				{
					$paginate .= "<div class='paginate'>";								
					if ($page > 1)
					{
						$paginate.= "<a href='$targetpage?page=$prev&state=$state'>previous</a>";
					}
					else
					{
						$paginate.= "<span class='disabled'>previous</span>";
					}								
					if ($lastpage < 7 + ($stages * 2))
					{	
						for ($counter = 1; $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
							{
								$paginate.= "<span class='current'>$counter</span>";
							}
							else
							{
								$paginate.= "<a href='$targetpage?page=$counter&state=$state'>$counter</a>";
							}					
						}
					}
					elseif($lastpage > 5 + ($stages * 2))	
					{
						if($page < 1 + ($stages * 2))		
						{
							for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
							{
								if ($counter == $page)
								{
									$paginate.= "<span class='current'>$counter</span>";
								}
								else
								{
									$paginate.= "<a href='$targetpage?page=$counter&state=$state'>$counter</a>";
								}					
							}
							$paginate.= "...";
							$paginate.= "<a href='$targetpage?page=$LastPagem1&state=$state'>$LastPagem1</a>";
							$paginate.= "<a href='$targetpage?page=$lastpage&state=$state'>$lastpage</a>";		
						}
						elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
						{
							$paginate.= "<a href='$targetpage?page=1&state=$state'>1</a>";
							$paginate.= "<a href='$targetpage?page=2&state=$state'>2</a>";
							$paginate.= "...";
							for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
							{
								if ($counter == $page){
									$paginate.= "<span class='current'>$counter</span>";
								}else{
									$paginate.= "<a href='$targetpage?page=$counter&state=$state'>$counter</a>";}					
							}
							$paginate.= "...";
							$paginate.= "<a href='$targetpage?page=$LastPagem1&state=$state'>$LastPagem1</a>";
							$paginate.= "<a href='$targetpage?page=$lastpage&state=$state'>$lastpage</a>";		
						}
						else
						{
							$paginate.= "<a href='$targetpage?page=1&state=$state'>1</a>";
							$paginate.= "<a href='$targetpage?page=2&state=$state'>2</a>";
							$paginate.= "...";
							for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
							{
								if ($counter == $page){
									$paginate.= "<span class='current'>$counter</span>";
								}else{
									$paginate.= "<a href='$targetpage?page=$counter&state=$state'>$counter</a>";}					
							}
						}
					}
					if ($page < $counter - 1){ 
						$paginate.= "<a href='$targetpage?page=$next&state=$state'>next</a>";
					}else{
						$paginate.= "<span class='disabled'>next</span>";
						}
						
					$paginate.= "</div>";
				}
				echo $paginate;
				?>
					</td>
					</tr>
				</table>
				<div style="clear:both; margin-left:20px; margin-top:15px; text-align:center;">	
					<input type="submit" value="Delete Selected User" name="submit" class='delete_button1' style="border:0; " onclick="return deletechecked('Are you sure want to delete the selected user');"/>
				</div>
				</form>
			</div>
		</div>
	</div>	
</div>	
<!--bottom End -->
</body>
</html>