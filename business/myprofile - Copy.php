<?php 
if(!isset($_SESSION)){session_start();}
include "common/function.php";

date_default_timezone_set('asia/kolkata');

$utype=0;
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(isset($_SESSION['rim_userid']) == '') 
{
	header('location:index.php');
	exit;
}
if(isset($_SESSION['lgtype'])) 
{
	$utype = $_SESSION['lgtype'];
}

$usrname=$profimg1=$output=$name=$email=$phone=$addr=$act='';

if(isset($_REQUEST['act']))
{
	$act=$_REQUEST['act'];	
}

$uid='';
if(isset($_SESSION['rim_userid']))
{
	$uid=$_SESSION['rim_userid'];	
}
$cur_sign='rupee';
if(isset($_SESSION['currency'])) 
{
	$cur_sign=$_SESSION['currency'];
}
if($uid !='')
{
	$teamdet=select("select * from userdet where id=$uid");			
	if($teamdet != false)
	{	
		foreach($teamdet as $tm => $data)
		{			
			$usrname=$data['username'];
			$email=$data['emailid'];
			$profimg1=$data['profimg'];
			$name=$data['name'];
			$addr=$data['address'];
			$phone=$data['phoneno'];
		}
	}
}
else
{
	header('location:index.php');
	exit;
}
function moneyFormatIndia($nums){
	$num=round($nums,0);
    $explrestunits = "" ;
	$cur_sign='rupee';
	if(isset($_SESSION['currency'])) 
	{
		$cur_sign=$_SESSION['currency'];
	}
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
		if($cur_sign == 'dollar')
		{
			 $restunits = (strlen($restunits)%3 == 1)?"0".$restunits:$restunits;
			$expunit = str_split($restunits, 3);
		}
		else
		{
			 $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits;
			$expunit = str_split($restunits, 2);
		}
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}


$date=date('Y-m-d H:i:s');
$rndnum=randomNum();
$error='';$enb="lgn";
if(isset($_REQUEST['submit']))
{
	$usname=trim($_POST['fname']);
	$emailid=trim($_POST['email']);
	
	$errors=array();
	if(strlen($usname) == 0)
	array_push($errors,"Enter Name");
	if(strlen($emailid) == 0)
	array_push($errors,"Enter Email id");
	
	if(empty($errors)){
		if($_FILES['profimg'])
		{
			if($profimg1 == "")
			{
				$profimg1=$rndnum.$_FILES["profimg"]["name"];
			}
			$allowExts=array("jpg", "jpeg", "gif", "png","pjpeg");
			
			$extension=explode(".",$_FILES["profimg"]["name"]);
			$len=count($extension)-1;
			$extension=strtolower($extension[$len]);
			if(($_FILES["profimg"]["type"]=="image/gif" || $_FILES["profimg"]["type"]=="image/jpeg" || $_FILES["profimg"]["type"]=="image/png" || $_FILES["profimg"]["type"]=="image/pjpeg") && in_array($extension,$allowExts)){
				move_uploaded_file($_FILES["profimg"]["tmp_name"],"images/userimg/".$profimg1);
			}			
		}

			
		$team_det['name']=$_POST['fname'];
		$team_det['emailid']=$_POST['email'];
		$team_det['phoneno']=$_POST['phone'];
		$team_det['address']=$_POST['addr'];
		$team_det['profimg']=$profimg1;
		$team_det['dateofupdation']=$date;
		$team_det_id=update('userdet',$team_det,array('id' => $uid));
		
		unset($_POST);
		if($team_det_id > 0)
		{
			$success="<p class='outputs'>User Updated Successfully</p>";
			//header('location:index.php');
		}
		else
		{
			array_push($errors,'Process Failed');
		}
	}
	//Prepare errors for output
	$output = '';
	foreach($errors as $val) {
		$output .= "<p class='outputf'>$val</p>";
	}
	$enb="lgn";
} 
?>
<?php include 'common/header.php';include 'common/topnav.php';?>	
<div class="maincontent">
	<div class="container">	
		<div>
			<h2 class="main-head">My Business - My Strategies</h2>
		</div>	
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<ul class="lftmenu">
					<li class="text-center"><img src="<?php echo $profimg1 != '' ? 'images/userimg/'.$profimg1 : 'images/default.png';?>" class="circle"><br/><p class="text-center"><?php echo $name;?></p></li>
					<li><a href="#myprof" class="tabs">My Profile</a></li>
					<?php
					if($utype==0)
					{
					?>						
						<li><a href="#sgame" class="tabs">Start Business Game</a><br/></li>
						<li><a href="#ogame" class="tabs">Game History</a></li>
					<?php
					}
					else
					{
					?>
						<li><a href="#viewusr" class="tabs">View User</a></li>
						<li><a href="#ugame" class="tabs">Game History</a></li>
					<?php
					}
					?>					
				</ul>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="panel panel-default itab" id="default_img">
					<div class="panel-body">
						<img src="images/banner3.jpg" class="img-responsive"/>
					</div>
				</div>
				<div class="panel panel-default itab" id="myprof">
					<form action="" method="post" name="reg" id="reg" enctype="multipart/form-data">
						<div class="panel-heading">
							<p class="login-box-msg">My Profile</p>
						</div>
						<div class="col-md-6 col-xs-12">					
							<div class="panel-body">						
								<div class="form-group has-feedback">
									<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $name;?>" placeholder="Enter Your Name" required >
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
								</div>      
								<div class="form-group has-feedback">
									<input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>" placeholder="Enter Your Email Id" required >
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>" placeholder="Enter Contact Number" required >
									<span class="glyphicon glyphicon-phone form-control-feedback"></span>
								</div>				
							</div>
						</div>
						<div class="col-md-6  col-xs-12">					
							<div class="panel-body">
								<div class="form-group has-feedback">
									<textarea id="addr" name="addr" row="5" class="form-control" placeholder="Enter Address"><?php echo $addr;?></textarea>
									<span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
								</div>      
								<div class="form-group has-feedback">
								<a href="#" id="upimg" class="form-label">Change Profile Image</a>
								<div class="pimg">
									<label>Update Profile Image <a href="#" id="clsimg" class="form-label">Cancel</a></label>									
									<input type="file" class="form-control" id="profimg" name="profimg" placeholder="Profile Image">
								</div>
								</div>	
								<div class="form-group has-feedback">
									<a href="#chgpass" class="tabs form-label">Change Password</a>
								</div> 
							</div>
						</div>				
						<div class="row">       
							<!-- /.col -->
							<div class="col-xs-12 text-center">
							<button type="submit" name="submit" class="btn btn-primary">Update</button>
							</div>
						<!-- /.col -->
						</div><br/>
					</form> 
				</div>
				<div class="panel panel-default itab" id="chgpass">
					<form action="" method="post" name="frmpswd" id="frmpswd">
						<div class="panel-heading">
							<p class="login-box-msg">Change Password</p>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="panel-body">
								<div class="form-group has-feedback">
									<input type="password" class="form-control" id="cpass" name="cpass" placeholder="Current Password" required >
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>      
								<div class="form-group has-feedback">
									<input type="password" class="form-control" id="password" name="password" placeholder="New Password" required >
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Retype New password" required >
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="row"> 
							<div class="col-xs-12 text-center">
								<button type="submit" name="submit" class="btn btn-primary">Update</button>
							</div>
						</div><br/>
					</form>
				</div>	
				<div class="panel panel-default itab" id="sgame">
					<div class="panel-body">
						<img src="images/banner3.jpg" class="img-responsive"/><br/>
						<div class="col-xs-12 text-center">
						<?php
						$gstat=$payment=$p_status=$repeat=0;
						$pstat=$expiry='';
						$teamdet=select("select * from userdet where id='".$_SESSION['rim_userid']."'"); 			
						if($teamdet != '' && $teamdet[0] != false)
						{	
							foreach($teamdet as $tm => $data)
							{
								$gstat=$data['game_status'];
								$payment=$data['payment'];
								$expiry=$data['expiry'];
							}
						}
						$teamd=select("select payment_status from payment where userid='".$_SESSION['rim_userid']."' and id='".$payment."'"); 			
						if($teamd != '' && $teamd[0] != false)
						{	
							foreach($teamd as $tm => $dat)
							{
								$pstat=$dat['payment_status'];	
							}
						}
						$pteamd=select("select id from basicinfo where userid='".$_SESSION['rim_userid']."' and payment_id='".$payment."'"); 			
						if($pteamd != false && $pteamd[0] != '')
						{							
							$repeat=1;	
						}
						if($pstat == 'Completed')
						{
							$p_status = 1;
						}
						$chkexp=0;
						$curdate=strtotime($expiry);
						$expdate=strtotime(date('Y-m-d H:i:s',strtotime("+3 hours")));
						if($expiry != '0000-00-00 00:00:00')
						{
							if($curdate > $expdate)
							{
								$chkexp=1;
							}
							else
							{
								$_SESSION['expiry']='';
							}
						}	
						if($gstat == 0 && $chkexp == 0 && $p_status > 0)
						{
						?>
							<input type='hidden' name='repeat' id="repeat" value='<?php echo $repeat;?>'>
							<button type="button" name="stgame" id="stgame" class="btn btn-primary">Play Now</button>
						<?php
						}
						else
						{ 
						?>								
							<input type="submit" value="Pay Now" form="pay_form" border="0" id="paygame" class="btn btn-primary" name="submit" >
						<?php
						 } 
						?>
							<form action="https://rimsr.in/business/business.php" method="post" id="pay_form" name="pay_form" target="_top">
																
							</form>
						</div>
					</div>
				</div>	
				<div class="panel panel-default itab" id="ogame">
					<div class="panel-heading">
						<p class="login-box-msg">View Played Games</p>
					</div>
					<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-stripped" data-page-size="150">
							<thead>
								<tr>
									<th>S.No.</th>
									<th>Firm Name</th>
									<th>Estimate Cost</th>
									<th>Promoter's Stack</th>	
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php								
								$tmdet=select("select * from basicinfo where userid='".$_SESSION['rim_userid']."' order by id desc ");									
								if($tmdet != false && $tmdet[0] !='')
								{		
									$i=1;				
									foreach($tmdet as $team => $tm)
									{
									?>
								<tr id="rw-<?php echo $tm['id'];?>">
									<td>
									  <?php echo $i;?>
									</td>
									<td>
									   <?php echo $tm['username'];?>
									</td>
									<td>
									   <?php echo '₹'.moneyFormatIndia($tm['estimate_cost']);?>
									</td>
									<td>
										<?php echo round($tm['promoter_stake']).'%';?>
									</td>						
									<td class="text-right">
										<div class="btn-group">
										 <a id="<?php echo $tm['id'];?>" data-id="<?php echo $tm['payment_id'];?>" class="edituser"><i class="fa fa-eye"></i></a>
										<!--<a href="#delmodal" role="button" data-toggle="modal"  id="<?php //echo $tm['id'];?>" class="deluser"><i class="fa fa-trash"></i></a>-->
										</div>
									</td>
								</tr>
								<?php
								$i++;
								}
							}
							else
							{
							?>
								<tr>
									<td colspan="5" style="text-align:center;">No Data Found</td>
								</tr>
							<?php
							}
							?>	                              
							</tbody>
						</table>
						</div>
					</div>
				</div>
				<div class="panel panel-default itab" id="ugame">
					<div class="panel-heading">
						<p class="login-box-msg">User Game History</p>
					</div>
					<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-stripped" data-page-size="150">
							<thead>
								<tr>
									<th>S.No.</th>
									<th>User Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Firm Name</th>
									<th>Estimate Cost</th>
									<th>Promoter's Stack</th>	
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody id="uglist">
							<?php	
								$targetpage='myprofile.php';
								$limit = 50;
								$allquote=select("select count(Id) as tot from basicinfo where payment_id in (select payment from userdet where game_status = 1) order by id desc ");
								if($allquote != false && $allquote[0] !='')
								{
									$total_pages = $allquote[0]['tot'];
								}
								else
								{
									$total_pages =0;
								}
								$stages = 3;$page='';
								if(isset($_REQUEST['page']))
								{
									$page = array_map_callback($_REQUEST['page']);
								}
								if($page)
								{
									$start = ($page - 1) * $limit;
								}
								else
								{
									$start = 0;
								}
								$tmdet=select("select * from basicinfo where payment_id in (select payment from userdet where game_status = 1) order by id desc limit $start,$limit");									
								if($tmdet != false && $tmdet[0] !='')
								{		
									$i=1;				
									foreach($tmdet as $team => $tm)
									{
										$uteamd=select("select name,emailid,phoneno from userdet where id='".$tm['userid']."'"); 			
										if($uteamd != false && $uteamd[0] != '')
										{							
											$name=$uteamd[0]['name'];
											$emailid=$uteamd[0]['emailid'];
											$phone=$uteamd[0]['phoneno'];
										}
									?>
								<tr id="rw-<?php echo $tm['id'];?>">
									<td>
										<?php echo $i;?>
									</td>
									<td>
										<?php echo $name;?>
									</td>
									<td>
										<?php echo $emailid;?>
									</td>
									<td>
										<?php echo $phone;?>
									</td>
									<td>
										<?php echo $tm['username'];?>
									</td>
									<td>
										<?php echo '₹'.moneyFormatIndia($tm['estimate_cost']);?>
									</td>
									<td>
										<?php echo round($tm['promoter_stake']).'%';?>
									</td>						
									<td class="text-right">
										<div class="btn-group">
										 <a id="<?php echo $tm['id'];?>" data-id="<?php echo $tm['payment_id'];?>" data-uid="<?php echo $tm['userid'];?>" class="viewrep"><i class="fa fa-eye"></i></a>
										<!--<a href="#delmodal" role="button" data-toggle="modal"  id="<?php //echo $tm['id'];?>" class="deluser"><i class="fa fa-trash"></i></a>-->
										</div>
									</td>
								</tr>
								<?php
								$i++;
								}
								if ($page == 0){$page = 1;}
								$prev = $page - 1;
								$next = $page + 1;
								$lastpage = ceil($total_pages/$limit);
								$LastPagem1 = $lastpage - 1;
								$paginate = '';
								if($lastpage > 1)
								{
									$paginate .= "<ul class='pagination'>";
									if ($page > 1)
									{
										$paginate.= "<li><a href='$targetpage?page=$prev' class='pagenav' id='$prev'>previous</a></li>";
									}
									else
									{
										$paginate.= "<li><span class='disabled'>previous</span></li>";
									}
									if ($lastpage < 7 + ($stages * 2))
									{
										for ($counter = 1; $counter <= $lastpage; $counter++)
										{
											if ($counter == $page)
											{
												$paginate.= "<li><span class='current'>$counter</span></li>";
											}
											else
											{
												$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";
											}
										}
									}
									else if($lastpage > 5 + ($stages * 2))
									{
										if($page < 1 + ($stages * 2))
										{
											for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
											{
												if ($counter == $page)
												{
													$paginate.= "<li><span class='current'>$counter</span></li>";
												}
												else
												{
													$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";
												}
											}
											$paginate.= "<li>...</li>";
											$paginate.= "<li><a href='$targetpage?page=$LastPagem1' class='pagenav' id='$LastPagem1'>$LastPagem1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=$lastpage' class='pagenav' id='$lastpage'>$lastpage</a></li>";
										}
										elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
										{
											$paginate.= "<li><a href='$targetpage?page=1' class='pagenav' id='1'>1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=2' class='pagenav' id='2'>2</a></li>";
											$paginate.= "<li>...</li>";
											for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
											{
												if ($counter == $page){
													$paginate.= "<li><span class='current'>$counter</span></li>";
												}else{
													$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";}
											}
											$paginate.= "<li>...</li>";
											$paginate.= "<li><a href='$targetpage?page=$LastPagem1' class='pagenav' id='$LastPagem1'>$LastPagem1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=$lastpage' class='pagenav' id='$lastpage'>$lastpage</a></li>";
										}
										else
										{
											$paginate.= "<li><a href='$targetpage?page=1' class='pagenav' id='1'>1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=2' class='pagenav' id='2'>2</a></li>";
											$paginate.= "<li>...</li>";
											for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
											{
												if ($counter == $page){
													$paginate.= "<li><span class='current'>$counter</span></li>";
												}else{
													$paginate.= "<li><a href='$targetpage?page=$counter' class='pagenav' id='$counter'>$counter</a></li>";}
											}
										}
									}
									if ($page < $counter - 1){
										$paginate.= "<li><a href='$targetpage?page=$next' class='pagenav' id='$next'>next</a></li>";
									}else{
										$paginate.= "<li><span class='disabled'>next</span></li>";
										}
									$paginate.= "</ul>";
								}
							}
							else
							{
							?>
								<tr>
									<td colspan="8" style="text-align:center;">No Data Found</td>
								</tr>
							<?php
							}
							?>									
							<tr>
								<td colspan="8" style="text-align:center;"><?php echo $paginate;?></td>
							</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
				<div class="panel panel-default itab" id="viewusr">
					<div class="panel-heading">
						<p class="login-box-msg">View User List</p>
					</div>
					<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-stripped" data-page-size="150">
							<thead>
								<tr>
									<th>S.No.</th>
									<th>User Name</th>
									<th>Email</th>
									<th>Phone</th>									
									<!--<th class="text-right">Action</th>-->
								</tr>
							</thead>
							<tbody id="uslist">
							<?php	
								$targetpage='myprofile.php';
								$limit = 50;
								$allquote=select("select count(Id) as tot from userdet where usrtype=0 order by id desc ");
								if($allquote != false && $allquote[0] !='')
								{
									$total_pages = $allquote[0]['tot'];
								}
								else
								{
									$total_pages =0;
								}
								$stages = 3;$page='';
								if(isset($_REQUEST['page']))
								{
									$page = array_map_callback($_REQUEST['page']);
								}
								if($page)
								{
									$start = ($page - 1) * $limit;
								}
								else
								{
									$start = 0;
								}
								$tmdet=select("select * from userdet where usrtype=0 order by id desc limit $start,$limit");									
								if($tmdet != false && $tmdet[0] !='')
								{		
									$i=1;				
									foreach($tmdet as $team => $tm)
									{										
										
										$name=$tm['name'];
										$emailid=$tm['emailid'];
										$phone=$tm['phoneno'];
										
									?>
								<tr id="rw-<?php echo $tm['id'];?>">
									<td>
										<?php echo $i;?>
									</td>
									<td>
										<?php echo $name;?>
									</td>
									<td>
										<?php echo $emailid;?>
									</td>
									<td>
										<?php echo $phone;?>
									</td>															
									<!--<td class="text-right">
										<div class="btn-group">
										 <a id="<?php //echo $tm['id'];?>" data-id="<?php //echo $tm['payment_id'];?>" class="edituser"><i class="fa fa-eye"></i></a>
										<a href="#delmodal" role="button" data-toggle="modal" id="<?php //echo $tm['id'];?>" class="deluser"><i class="fa fa-trash"></i></a>
										</div>
									</td>-->
								</tr>
								<?php
								$i++;
								}
								if ($page == 0){$page = 1;}
								$prev = $page - 1;
								$next = $page + 1;
								$lastpage = ceil($total_pages/$limit);
								$LastPagem1 = $lastpage - 1;
								$paginate = '';
								if($lastpage > 1)
								{
									$paginate .= "<ul class='pagination'>";
									if ($page > 1)
									{
										$paginate.= "<li><a href='$targetpage?page=$prev' class='upagenav' id='$prev'>previous</a></li>";
									}
									else
									{
										$paginate.= "<li><span class='disabled'>previous</span></li>";
									}
									if ($lastpage < 7 + ($stages * 2))
									{
										for ($counter = 1; $counter <= $lastpage; $counter++)
										{
											if ($counter == $page)
											{
												$paginate.= "<li><span class='current'>$counter</span></li>";
											}
											else
											{
												$paginate.= "<li><a href='$targetpage?page=$counter' class='upagenav' id='$counter'>$counter</a></li>";
											}
										}
									}
									else if($lastpage > 5 + ($stages * 2))
									{
										if($page < 1 + ($stages * 2))
										{
											for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
											{
												if ($counter == $page)
												{
													$paginate.= "<li><span class='current'>$counter</span></li>";
												}
												else
												{
													$paginate.= "<li><a href='$targetpage?page=$counter' class='upagenav' id='$counter'>$counter</a></li>";
												}
											}
											$paginate.= "<li>...</li>";
											$paginate.= "<li><a href='$targetpage?page=$LastPagem1' class='upagenav' id='$LastPagem1'>$LastPagem1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=$lastpage' class='upagenav' id='$lastpage'>$lastpage</a></li>";
										}
										elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
										{
											$paginate.= "<li><a href='$targetpage?page=1' class='upagenav' id='1'>1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=2' class='upagenav' id='2'>2</a></li>";
											$paginate.= "<li>...</li>";
											for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
											{
												if ($counter == $page){
													$paginate.= "<li><span class='current'>$counter</span></li>";
												}else{
													$paginate.= "<li><a href='$targetpage?page=$counter' class='upagenav' id='$counter'>$counter</a></li>";}
											}
											$paginate.= "<li>...</li>";
											$paginate.= "<li><a href='$targetpage?page=$LastPagem1' class='upagenav' id='$LastPagem1'>$LastPagem1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=$lastpage' class='upagenav' id='$lastpage'>$lastpage</a></li>";
										}
										else
										{
											$paginate.= "<li><a href='$targetpage?page=1' class='upagenav' id='1'>1</a></li>";
											$paginate.= "<li><a href='$targetpage?page=2' class='upagenav' id='2'>2</a></li>";
											$paginate.= "<li>...</li>";
											for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
											{
												if ($counter == $page){
													$paginate.= "<li><span class='current'>$counter</span></li>";
												}else{
													$paginate.= "<li><a href='$targetpage?page=$counter' class='upagenav' id='$counter'>$counter</a></li>";}
											}
										}
									}
									if ($page < $counter - 1){
										$paginate.= "<li><a href='$targetpage?page=$next' class='upagenav' id='$next'>next</a></li>";
									}else{
										$paginate.= "<li><span class='disabled'>next</span></li>";
										}
									$paginate.= "</ul>";
								}
							}
							else
							{
							?>
								<tr>
									<td colspan="8" style="text-align:center;">No Data Found</td>
								</tr>
							<?php
							}
							?>	
								
							<tr>
								<td colspan="8" style="text-align:center;"><?php echo $paginate;?></td>
							</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php include 'common/footscript.php';?>
<div class="modal video-modal fade" id="regfail" tabindex="-1" role="dialog" aria-labelledby="regfail" style="width:50%;margin:0 auto;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="text-center poptitle">Warning<button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
			</div>
			<div class="modal-body">	
				<div class="alert-default instruc text-center">					
					<h2 class="error">Sorry !! Session Expired.<br/> To continue the game after the duration START afresh and Pay the fee.</h2>					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal video-modal fade" id="payinfo" tabindex="-1" role="dialog" aria-labelledby="payinfo" style="width:50%;margin:0 auto;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="text-center poptitle">Payment Information<button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
			</div>
			<div class="modal-body">	
				<div class="alert-default text-center">					
					<p class="error" style="font-size:24px;">PAY &amp; PLAY - <?php echo $cur_sign=='rupee'?'INR 499/-':'US$ 19.99/-';?> FOR A GAME SESSION OF 3 HOURS</p>				
				</div>
			</div>
		</div>
	</div>
</div>
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
  });
</script>
<script src="js/jquery.validate.js"></script>
<!-- jQuery Form Validation code -->
<script>  
// When the browser is ready...
$(function() { 

if('<?php echo $act;?>'=='g')
{
	$('.itab').hide();
	$('#sgame').slideDown('slow');
}
$('#uglist').on('click','.pagenav',function(e){
	e.preventDefault();
	var n=$(this).attr('id');
	$.ajax({
		type:'POST',
		url:'getgamelist.php',
		data:'page='+n,
		success:function(res){
			$('#uglist').html(res);
		}
	});	
});
$('#uslist').on('click','.upagenav',function(e){	
	e.preventDefault();
	var n=$(this).attr('id');
	$.ajax({
		type:'POST',
		url:'getuserlist.php',
		data:'page='+n,
		success:function(res){
			$('#uslist').html(res);
		}
	});	
});
    // Setup form validation on the #register-form element		
    $("#reg").validate({    
        // Specify the validation rules
        rules: {
			fname:"required",
			email:{required:true,email:true},
			password:"required"	,
			cpassword: {
				required:true,
				equalTo: "#password"
			},
			rem:"required"
        },        
        // Specify the validation error messages
        messages: { 				
            fname: "Enter Name",	
			email:{required:"Enter Email Id",email:"Enter Valid Email Id"},
			password: "Enter password",
			cpassword: {
				required:"Enter Confirm Password",
				equalTo: "Enter Confirm Password Same as Password"
			},
			rem:"Accept Terms and Conditions"
        },        
        submitHandler: function(form) {	
            form.submit();
        }
    }); 
	$('#stgame').on('click',function(){
		var rep=$('#repeat').val();		
		$.ajax({
			type:'POST',
			url:'chkstatus.php',
			data:'r='+rep,
			success:function(res){
				var p=res.split(',');				
				if(parseInt(p[0]) == 0)
				{
					if(parseInt(p[1]) > 0)
					{
						$.ajax({
							type:'POST',
							url:'chksession.php',
							success:function(res1){
								if(res1 == 0)
								{
									$('#regfail').modal('show');
									/* alert('Sorry! Session Expired. TO CONTINUE THE GAME AFTER THE DURATION START AFRESH AND PAY THE FEE.'); */
									
								}
								else
								{
									window.location.href="business.php";
								}
							}
						});
					}
					else
					{
						alert('Sorry! Payment is pending');	
						$('#pay_form').submit();
					}
				}
				else
				{
					
					ConfirmDialog('Would you like to play game again? If yes, Submit your request.');
					/* var r=confirm('');
					if(r == false)
					{
						window.location.href='common/logout.php?r=m';
					} */
					
				}
			}
		});
		
	});
	
	
	$('.edituser').on('click',function(e){
		var id=$(this).attr('data-id');
		window.location.href="viewall.php?pid="+id;
	});
	$('.viewrep').on('click',function(e){
		var id=$(this).attr('data-id');
		var uid=$(this).attr('data-uid');
		window.open("viewrep.php?pid="+id+"&uid="+uid,"_blank");
	});
	$('.tabs').on('click',function(e){
		e.preventDefault();
		var tab=$(this).attr('href');
		$('.itab').hide();
		$(tab).slideDown('slow');
		
	});
	$('#upimg').on('click',function(e){
		e.preventDefault();
		$('.pimg').slideDown('slow');
		$(this).hide();
	});
	$('#clsimg').on('click',function(e){
		e.preventDefault();
		$('#profimg').val('');
		$('.pimg').slideUp('slow');
		$('#upimg').show();
	});
	$('.b_game').on('click',function(){
		$('#payinfo').modal('show');
	});
	$('.b_game').on('mouseleave',function(){
		//$('#payinfo').modal('hide');
	});
	
});  



function ConfirmDialog(message){
	$('<div></div>').appendTo('body')
		.html('<div><h6>'+message+'?</h6></div>')
		.dialog({
			modal: true, title: 'Confirmation', zIndex: 10000, autoOpen: true,
			width: 'auto', resizable: false,
			buttons: {
				Yes: function () { 
					$(this).dialog("close");
				},
				No: function () {
					$(this).dialog("close");
					window.location.href="common/logout.php?r=m";
				}
			},
			close: function (event, ui) {
				$(this).remove();
			}
		});
}

setTimeout( "$('.outputs,.outputf').hide();", 4000);
</script>
</html>
