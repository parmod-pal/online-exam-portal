<?php 
if(!isset($_SESSION)){session_start();}
include "common/function.php";
date_default_timezone_set('asia/kolkata');
$base_path="http://".$_SERVER['SERVER_NAME']."/business/";
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(isset($_SESSION['rim_userid']) == '') 
{
	header('location:index.php');
	exit;
}
$cur_sign='rupee';
/* if(isset($_SESSION['currency'])) 
{
	$cur_sign=$_SESSION['currency'];
} */
$payid=$vusrid='';
if(isset($_REQUEST['pid'])) 
{
	$payid=$_REQUEST['pid'];
}
else
{
	$payid=$_SESSION['payid'];
}

if(isset($_REQUEST['uid'])) 
{
	$vusrid=$_REQUEST['uid'];
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


$fname=$prof=$psize=$pactivity=$setup=$constitution=$trade=$raw=$sales=$manuprocess='';
$approxcost=$licensingfee=$promoterstake=$interest=$land=$build=$plant=$furni=$pexp=$tech=$sexp=$rd=$cmargin=$intamt=$totpc=$pequ=$eqinves=$lninves=$totinves=$eqinvesper=$lninvesper=$der=$lnnom=$lnperannum=$annualint=$annualcmt=0;
if($vusrid !='')
{
	/***** Basic Parameters ******************************************/
	
	$teamdet=select("select * from basicinfo where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($teamdet != false && $teamdet[0] != '')
	{	
		foreach($teamdet as $tm => $data)
		{
			$fname=$data['username'];
			$prof=$data['profession'];
			$psize=$data['proposed_size'];
			$pactivity=$data['proposed_activity'];
			$setup=$data['industry_type'];
			$constitution=$data['constitution'];
			$trade=$data['manufacture_details'];
			$raw=$data['rawmaterial_details'];
			$sales=$data['sales_strategy'];
			$manuprocess=$data['manufacture_process'];
			$approxcost=$data['estimate_cost'];	
			$licensingfee=$data['licensing_fee']; 			
			$promoterstake=$data['promoter_stake']; 
			$interest=$data['termloan_interest']; 			
			$lnnom=$data['termloan_nom']; 
			$cur_sign=$data['currency'];
			$land=$data['land']; 
			$build=$data['build']; 
			$plant=$data['plant']; 
			$furni=$data['furniture']; 
			$pexp=$data['preexp']; 
			$tech=$data['techfee']; 
			$sexp=$data['sexp']; 
			$rd=$data['rd']; 
		}
	}
	
	$cmargin=($approxcost/100)*10;
		
	$totpc=$land+$build+$plant+$furni+$pexp+$tech+$sexp+$rd+$cmargin+$licensingfee;
	
	$eqinvesper=$promoterstake;
	$lninvesper= (100 - $promoterstake);
	for($i=1;$i<=3;$i++)
	{
		$pequ=($totpc/100)*$promoterstake;
		$eqinves=$pequ;
		$lninves=($totpc - $pequ);
		
		
		if($eqinves>0)
		{
			$der = ($lninves/$eqinves);
		}
		if($lnnom>0)
		{
		$lnperannum = ($lninves/$lnnom)*12;
		}

		$annualint=($lninves/100)*$interest;//interest per annum
		
		$intamt = ($annualint/12)*9;//for 3 quarters	
		
		$totpc = ($land+$build+$plant+$furni+$pexp+$tech+$sexp+$rd+$cmargin+$licensingfee+$intamt); // total investment
	}
	$totinves=$totpc;
	$annualcmt=$lnperannum+$annualint;
	
	/***** Product Parameters ******************************************/
	$prod1=$prod2=$prod3=$prod4=$prod5=$prod6=$prod7=$prod8=$prod9=$prod10=$prod11=$prod12=$prod13=0;
	$proddet=select("select * from prodinfo where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($proddet != false && $proddet[0] != '')
	{	
		foreach($proddet as $tm => $prod)
		{
			$prod1=$prod['installed_capacity'];
			$prod2=$prod['capacity_utiliz'];
			$prod3=$prod['nofday_perprod'];
			$prod7=$prod['work_in_progress'];
			$prod9=$prod['finishedprod_wip'];
		}
		$prod12=($prod1/100)*30;
		$prod4=($prod3/30);
		if($prod4>0)
		{
			$prod5=round(12/$prod4);
			
			$prod6=round(($prod1*($prod2/100))/$prod4);
		}
		$prod8=($prod1/100)*$prod7;
		$prod10=($prod8/100)*$prod9;
		$prod11=($prod6 + $prod10);
		if($prod11>0)
		{
			$prod13=($prod12/$prod11);
		}		
	}
	
	/***** Manpower Cost ******************************************/
	$r1c1=$r1c2=$r1c3=$r1c4=$r1c5=$r2c1=$r2c2=$r2c3=$r2c4=$r2c5=$r5c1=$r5c2=$r5c3=$r5c4=$r5c5=$r7c1=$r7c2=$r7c3=$r7c4=$r7c5=$r9c1=$r9c2=$r9c3=$r9c4=$r9c5=0;
	$cate=array('Managerial Personnel','Sales Personnel','Admin Staff','Skilled Personnel','Unskilled Personnel');
	$s=1;
	foreach($cate as $cat)
	{		
		$mdet=select("select * from manpowerdet where userid='".$vusrid."' and category='".$cat."' and payment_id='".$payid."' order by id desc limit 1"); 			
		if($mdet != false && $mdet[0] != '')
		{	
			foreach($mdet as $tm => $mp)
			{
				if($s==1)
				{
					$r1c1=$mp['manpower'];
					$r2c1=$mp['salary'];
					$r5c1=$mp['welfarecost'];
					$r7c1=$mp['incentive'];
					$r9c1=$mp['bonus'];
				}
				if($s==2)
				{
					$r1c2=$mp['manpower'];
					$r2c2=$mp['salary'];
					$r5c2=$mp['welfarecost'];
					$r7c2=$mp['incentive'];
					$r9c2=$mp['bonus'];
				}
				if($s==3)
				{
					$r1c3=$mp['manpower'];
					$r2c3=$mp['salary'];
					$r5c3=$mp['welfarecost'];
					$r7c3=$mp['incentive'];
					$r9c3=$mp['bonus'];
				}
				if($s==4)
				{
					$r1c4=$mp['manpower'];
					$r2c4=$mp['salary'];
					$r5c4=$mp['welfarecost'];
					$r7c4=$mp['incentive'];
					$r9c4=$mp['bonus'];
				}
				if($s==5)
				{
					$r1c5=$mp['manpower'];
					$r2c5=$mp['salary'];
					$r5c5=$mp['welfarecost'];
					$r7c5=$mp['incentive'];
					$r9c5=$mp['bonus'];
				}
			}					
		}
		$s++;
	}
	
	/****************** Inventory Details **********************/
	
	$rawmaterial=$rmnou=$crm=$fgoods=$fgnou=$cfg=$totinvcost=0;
	$invendet=select("select * from inventory where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($invendet != false && $invendet[0] != '')
	{	
		foreach($invendet as $tm => $inv)
		{				
			$rawmaterial=$inv['rawmaterial'];
			$fgoods=$inv['finishedgoods'];			
		}
		
		$rmnou = ($prod1/100)*$rawmaterial;
		$crm=$rmnou*(($prod13*30)/100);
		$fgnou=($prod1/100)*$fgoods;
		$cfg=$fgnou*$prod13;
		$totinvcost=$crm+$cfg;			
	}
	
	/****************** Direct Cost Details **********************/
	
	$rmdc=$wagesdc=$pidc=$welfaredc=$bonusdc=$power=$water=$training=$transport=$totdc=0;
	$dcdet=select("select * from directcost where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($dcdet != false && $dcdet[0] != '')
	{	
		foreach($dcdet as $tm => $dc)
		{				
			$power=$dc['power'];
			$water=$dc['water'];
			$training=$dc['training'];
			$transport=$dc['transport'];			
		}	
		$totdc=	$rmdc+$wagesdc+$pidc+$welfaredc+$bonusdc+$power+$water+$training+$transport;	
	}
	
	/****************** Indirect Cost Details **********************/
	
	$indc1=$indc2=$indc3=$indc4=$indc5=$indc6=$indc7=$advertise=$salesexp=$add_incentive=$add_salesexp=$godown=$campus_cleaning=$business_insurance=$technology_cost=$food_charges=$entertainment_charges=$training_cost=$legal_cost=$consultant_cost=$postal_charges=$stationery=$telephone_costs=$printing_costs=$website_costs=$transport_costs=$packaging=$maintenance_exp=$miscellaneous=$totindc=0;
	$indcdet=select("select * from indirectcost where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($indcdet != false && $indcdet[0] != '')
	{	
		foreach($indcdet as $tm => $indc)
		{				
			$advertise=$indc['advertise'];$salesexp=$indc['salesexp'];$add_incentive=$indc['add_incentive'];$add_salesexp=$indc['add_salesexp'];$godown=$indc['godown'];$campus_cleaning=$indc['campus_cleaning'];$business_insurance=$indc['business_insurance'];$technology_cost=$indc['technology_cost'];$food_charges=$indc['food_charges'];$entertainment_charges=$indc['entertainment_charges'];$training_cost=$indc['training_cost'];$legal_cost=$indc['legal_cost'];$consultant_cost=$indc['consultant_cost'];$postal_charges=$indc['postal_charges'];$stationery=$indc['stationery'];$telephone_costs=$indc['telephone_costs'];$printing_costs=$indc['printing_costs'];$website_costs=$indc['website_costs'];$transport_costs=$indc['transport_costs'];$packaging=$indc['packaging'];$maintenance_exp=$indc['maintenance_exp'];$miscellaneous=$indc['miscellaneous'];			
		}	
		$totindc = $indc1+$indc2+$indc3+$indc4+$indc5+$indc6+$indc7+$advertise+$salesexp+$add_incentive+$add_salesexp+$godown+$campus_cleaning+$business_insurance+$technology_cost+$food_charges+$entertainment_charges+$training_cost+$legal_cost+$consultant_cost+$postal_charges+$stationery+$telephone_costs+$printing_costs+$website_costs+$transport_costs+$packaging+$maintenance_exp+$miscellaneous;	
	}
	/****************** Financial & Deposit Cost Details **********************/
	
	$fincost1=$fincost2=$fincost3=$fincost4=$fincost5=$fincost6=$fincost7=$fincost9=$fincost10=$fincost11=$fincost13=$fincost14=$wc_loan_interest=$interest_free=$fd_bank=$deptot=0;
	$fincostdet=select("select * from 	finance_deposit_investment where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($fincostdet != false && $fincostdet[0] != '')
	{	
		foreach($fincostdet as $tm => $fcd)
		{				
			$wc_loan_interest=$fcd['wc_loan_interest'];
			$interest_free=$fcd['interest_free'];
			$fd_bank=$fcd['fd_bank'];			
		}			
	}
	$deptot=$fd_bank +($godown*20);	
	
	/****************** Particulars of Product & Sales Cost Details **********************/
	
	$profit_margin=$sales_discount=0;
	$pdsdet=select("select profit_margin, sales_discount from prod_sales_cost where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($pdsdet != false && $pdsdet[0] != '')
	{	
		foreach($pdsdet as $tm => $pds)
		{				
			$profit_margin=$pds['profit_margin'];
			$sales_discount=$pds['sales_discount'];
		}			
	}
	
	/****************** Sales Particulars **********************/
	
	$sales_target=$sales_achieved=$sales_cash=$doubtful_crsale=0;
	$salesdet=select("select * from salesparticular where userid='".$vusrid."' and payment_id='".$payid."' order by id desc limit 1"); 			
	if($salesdet != false && $salesdet[0] != '')
	{	
		foreach($salesdet as $tm => $salesd)
		{				
			$sales_target=$salesd['sales_target'];
			$sales_achieved=$salesd['sales_achieved'];
			$sales_cash=$salesd['sales_cash'];
			$doubtful_crsale=$salesd['doubtful_crsale'];
		}			
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>RIMSR My Business - My Strategies</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />	
	<link rel="stylesheet" href="js/iCheck/square/blue.css" >
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/fav.png" sizes="32x32" />
</head>
<body>	

	<div class="maincontent">
	<div class="col-lg-12" style="text-align:right;margin-top:10px;"><a href="myprofile.php" style="margin-right:40px;padding-left:10px;" class="btn btn-white title">Go Home</a></div>
		<div class="container" id="printdiv">
			<div>
				<h2 class="main-head">My Business - My Strategies</h2>
			</div>
			<hr/>			
			<div id="sec1">		
				<h3 class="title" id="t1">Project Basic Details</h3>
				<form action="" method="post" name="reg" id="reg">
					<input type="hidden" name="tbl" value="basicinfo">
					<div class="">	
						<div class="col-md-5 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label">Name of Your Firm 
								<input type="text" class="form-control" id="username" name="username" value="<?php echo $fname;?>" readonly>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">Your Specialization 
								<input type="text" class="form-control" id="profession" value="<?php echo $prof;?>" name="profession" readonly>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">What do you want to setup? 				
								<div class="col-sm-12">
									<div class="col-md-6">									
										<input type="radio" disabled name="industry_type" id="manu" <?php echo $setup == 'Manufacturing'?'checked':'';?> class="industry_type" value="Manufacturing" >
										<label for="manu" >Manufacturing</label>
									</div>
									<div class="col-md-6">									
										<input type="radio" disabled name="industry_type" <?php echo $setup == 'Data Center'?'checked':'';?> id="dcenter" class="industry_type" value="Data Center" >
										<label for="dcenter" >Data Center</label>
									</div>	
								</div><br/>
								<div class="col-sm-12">	
									<div class="col-md-6">	
										<input type="radio" disabled name="industry_type" id="tech" <?php echo $setup == 'Technology'?'checked':'';?> class="industry_type" value="Technology">
										<label for="tech">Technology</label>								
									</div>
									<div class="col-md-6">	
										<input type="radio" disabled name="industry_type" <?php echo $setup == 'Services'?'checked':'';?> id="services" class="industry_type" value="Services">
										<label for="services">Services</label>								
									</div>																
								</div>
							</div>
						</div>
						<div class="col-md-1 col-sm-12 col-xs-12"></div>
						<div class="col-md-5 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label">Proposed size for your business 
								<div class="col-sm-12">
									<div class="col-md-6">									
										<input type="radio" name="proposed_size" id="tiny" <?php echo $psize == 'Tiny'?'checked':'';?> disabled class="proposed_size" value="Tiny" >
										<label for="tiny">Tiny</label>
									</div>
									<div class="col-md-6">									
										<input type="radio" disabled name="proposed_size" <?php echo $psize == 'Small'?'checked':'';?> id="small" class="proposed_size" value="Small" >
										<label for="small">Small</label>
									</div>	
								</div><br/>
								<div class="col-sm-12">
									<div class="col-md-6">	
										<input type="radio" disabled name="proposed_size" <?php echo $psize == 'Medium'?'checked':'';?> id="medium" class="proposed_size" value="Medium">
										<label for="medium">Medium</label>								
									</div>
									<div class="col-md-6">	
										<input type="radio" disabled name="proposed_size" <?php echo $psize == 'Large'?'checked':'';?> id="large" class="proposed_size" value="Large">
										<label for="large">Large</label>								
									</div>																
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">Proposed activity 
								<input type="text" class="form-control" id="proposed_activity" value="<?php echo $pactivity;?>" name="proposed_activity" readonly>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">Constitution 
								<div class="col-sm-12">
									<div class="col-md-6">									
										<input type="radio" disabled name="constitution" id="proprietary" <?php echo $constitution == 'Proprietary'?'checked':'';?> class="constitution" value="Proprietary" >
										<label for="proprietary">Proprietary</label>
									</div>
									<div class="col-md-6">									
										<input type="radio" disabled name="constitution" id="partnership" <?php echo $constitution == 'Partnership'?'checked':'';?> class="constitution" value="Partnership" >
										<label for="partnership">Partnership</label>
									</div>		
								</div><br/>
								<div class="col-sm-12">							
									<div class="col-md-6">	
										<input type="radio" disabled name="constitution" id="private" <?php echo $constitution == 'Private Limited'?'checked':'';?> class="constitution" value="Private Limited">
										<label for="private">Private Limited</label>								
									</div>
									<div class="col-md-6">	
										<input type="radio" disabled name="constitution" id="public" <?php echo $constitution == 'Public Limited'?'checked':'';?> class="constitution" value="Public Limited">
										<label for="public">Public Limited</label>								
									</div>																
								</div>
							</div>					
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">Describe the product that you intend manufacturing or trading 
							<textarea class="form-control" id="manufacture_details" name="manufacture_details" ><?php echo $trade;?></textarea>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">What are the raw materials needed and how do you mobilize? 
							<textarea class="form-control" id="rawmaterial_details" name="rawmaterial_details" ><?php echo $raw;?></textarea>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">What is the marketing/sales strategy?  
							<textarea class="form-control" id="sales_strategy" name="sales_strategy" ><?php echo $sales;?></textarea>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">What is the manufacturing process? 
							<textarea class="form-control" id="manufacture_process" name="manufacture_process" readonly ><?php echo $manuprocess;?></textarea>
						</div>
					</div>
			</div>	
<div class="hr-line-dashed"></div>
			<div id="sec2">
				<h3 class="title" id="t2">Project Cost Details</h3>	
			<?php	
				$dataPoints = array(
					array("y" => number_format($land,2,'.',''), "label" => "1"),
					array("y" => number_format($build,2,'.',''), "label" => "2"),
					array("y" => number_format($plant,2,'.',''), "label" => "3"),
					array("y" => number_format($furni,2,'.',''), "label" => "4"),
					array("y" => number_format($pexp,2,'.',''), "label" => "5"),
					array("y" => number_format($tech,2,'.',''), "label" => "6"),
					array("y" => number_format($sexp,2,'.',''), "label" => "7"),
					array("y" => number_format($rd,2,'.',''), "label" => "8"),
					array("y" => number_format($intamt,2,'.',''), "label" => "9"),
					array("y" => number_format($cmargin,2,'.',''), "label" => "10"),
					array("y" => number_format($licensingfee,2,'.',''), "label" => "11")
				);
			?>				
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="cost" id="cost" autocomplete="off">
						<input type="hidden" name="tbl" value="basicinfo">
					</form>
					<div class="table-responsive"><table class="table table-stripped">
						<tr>
							<td><strong>Approximate Project Cost *</strong></td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" value="<?php echo moneyFormatIndia($approxcost);?>"  id="estimate_cost" name="estimate_cost" readonly></td>
							<td><strong>Rule of Thumb</strong></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Land</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="land" value="<?php echo moneyFormatIndia($land);?>" readonly name="land"></td>
							<td>10% of PC</td>
						</tr>
						<tr>
							<td>02. Building Cost</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="build" value="<?php echo moneyFormatIndia($build);?>" readonly name="build"></td>
							<td>15% of PC</td>
						</tr>
						<tr>
							<td>03. Plant &amp; Machinery</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="plant" value="<?php echo moneyFormatIndia($plant);?>" readonly name="plant"></td>
							<td>30% of PC</td>
						</tr>
						<tr>
							<td>04. Furniture &amp; Fittings</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="furniture" readonly value="<?php echo moneyFormatIndia($furni);?>" name="furniture"></td>
							<td>5% of PC</td>
						</tr>
						<tr>
							<td>05. Preliminary Expenses</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="preexp" value="<?php echo moneyFormatIndia($pexp);?>" readonly name="preexp"></td>
							<td>5% of PC</td>
						</tr>
						<tr>
							<td>06. Fee For Technical Know-How </td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="techfee" value="<?php echo moneyFormatIndia($tech);?>" readonly name="techfee"></td>
							<td>8% of PC</td>
						</tr>
						<tr>
							<td>07. Start-Up Expenses</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="sexp" value="<?php echo moneyFormatIndia($sexp);?>" readonly name="sexp"></td>
							<td>6% of PC</td>
						</tr>
						<tr>
							<td>08. R &amp; D / Innovation</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="rd" value="<?php echo moneyFormatIndia($rd);?>" readonly name="rd"></td>
							<td>6% of PC</td>
						</tr>
						<tr>
							<td>09. Interest During Implementation</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="interest" readonly value="<?php echo moneyFormatIndia($intamt);?>" name="interest"></td>
							<td>For 3 Quarters</td>
						</tr>
						<tr>
							<td>10. Working Capital Margin</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="cmargin" value="<?php echo moneyFormatIndia($cmargin);?>" readonly name="cmargin"></td>
							<td>10% of PC</td>
						</tr>
						<tr>
							<td>11. Royalty/Licensing Fee *</td>
							<td width="150"><input type="text" readonly class="form-control <?php echo $cur_sign;?>" id="licensing_fee" readonly  value="<?php echo moneyFormatIndia($licensingfee);?>" name="licensing_fee"></td>
							<td>5% of PC</td>
						</tr>
						<tr>
							<td><strong>Total Project Cost</strong></td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="tot" name="tot" value="<?php echo moneyFormatIndia($totpc);?>"readonly ></td>
							<td></td>
						</tr>
					</table></div>
				</div>
				<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-5 col-sm-12 col-xs-12" id="barchart" >
				
				
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			<div id="sec3">
				<h3 class="title" id="t3">Promoter's Stack in the Project</h3>			
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="mfin" id="mfin">
						<input type="hidden" name="tbl" value="basicinfo">
					</form>
					<div class="table-responsive"><table class="table table-stripped">					
						<tr>
							<td>01. Promoter's Equity in % of Project Cost *</td>
							<td width="200"><input type="text" class="form-control numeric percentage" id="promoter_stake" form="mfin" value="<?php echo moneyFormatIndia($promoterstake);?>" readonly name="promoter_stake"></td>
						</tr>
						<tr>
							<td>02. Promoter's Equity</td>
							<td width="200"><input type="text" class="form-control <?php echo $cur_sign;?>" id="pequ" value="<?php echo moneyFormatIndia($pequ);?>" readonly name="pequ"></td>
						</tr>						
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
				
				</div>				
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">
				<h3 class="title">Means of Finance</h3>		
				<div class="col-md-12 col-sm-12 col-xs-12">								
					<div class="table-responsive"><table class="table table-stripped">
						<thead>
							<th></th>
							<th>Equity</th>
							<th>Term Loan</th>
							<th>Total Investment</th>
						</thead>
						<tbody>
							<tr>
								<td>01. Investment In Rupees</td>
								<td width="200"><input type="text" class="form-control <?php echo $cur_sign;?>" id="eqinves" value="<?php echo moneyFormatIndia($eqinves);?>" readonly name="eqinves"></td>
								<td width="200"><input type="text" class="form-control <?php echo $cur_sign;?>" id="lninves" value="<?php echo moneyFormatIndia($lninves);?>" readonly name="lninves"></td>
								<td width="200"><input type="text" class="form-control <?php echo $cur_sign;?>" id="totinves" value="<?php echo moneyFormatIndia($totinves);?>" readonly name="totinves"></td>
							</tr>
							<tr>
								<td>02. Investment in Percentage</td>
								<td width="200"><input type="text" class="form-control percentage" id="eqinvesper" value="<?php echo number_format($eqinvesper,2,'.','');?>" readonly name="eqinvesper"></td>
								<td width="200" ><input type="text" class="form-control percentage" id="lninvesper" value="<?php echo number_format($lninvesper,2,'.','');?>" readonly name="lninvesper"></td>
								<td></td>
							</tr>
							<tr>
								<td>03. DEBT -  EQUITY RATIO- (DER)</td>
								<td width="200">&nbsp;</td>
								<td width="200" ><input type="text" class="form-control" readonly id="der" value="<?php echo number_format($der,2,'.','');?>" name="der"></td>
								<td></td>
							</tr>
							<tr>
								<td>04. Repayment of Term Loan in No of Months *</td>
								<td width="200" ><input type="text" class="form-control numeric" id="termloan_nom" form="mfin" value="<?php echo moneyFormatIndia($lnnom);?>" readonly name="termloan_nom"></td>								
							</tr>
							<tr>
								<td>05. Principal Repayment of Term Loan Per Annum</td>
								<td width="200" ><input type="text" class="form-control <?php echo $cur_sign;?>" id="lnperannum" value="<?php echo moneyFormatIndia($lnperannum);?>" readonly name="lnperannum"></td>	
								<td></td>
								<td></td>								
							</tr>
							<tr>
								<td>06. Interest On Term Loan *</td>
								<td width="200" ><input type="text" class="form-control numeric percentage" id="termloan_interest" value="<?php echo moneyFormatIndia($interest);?>" readonly form="mfin" name="termloan_interest"></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>07. Annual Interest Payment On Term Loan</td>
								<td width="200" ><input type="text" class="form-control <?php echo $cur_sign;?>" id="aninterest" value="<?php echo moneyFormatIndia($annualint);?>" readonly name="aninterest"></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>08. Annual Commitment For Servicing The Term Loan</td>
								<td width="200" ><input type="text" class="form-control <?php echo $cur_sign;?>" id="ancommit" value="<?php echo moneyFormatIndia($annualcmt);?>" readonly name="ancommit"></td>	
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table></div>
					</div>
					
				</div>	
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">
					<div class="col-md-3 col-sm-12 col-xs-12"></div>
					<div class="col-md-6 col-sm-12 col-xs-12" id="equity_chart">
					
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12"></div>				
				</div>
				<div class="hr-line-dashed"></div>
				
			
			
			</div>
			
			<div id="sec4">
				<h3 class="title" id="t4">Production &amp; Production Costs</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="prodparam" id="prodparam"  autocomplete="off">
						<input type="hidden" name="tbl" value="prodinfo">
					</form>
					<?php	
					$datapts = array(
						array("y" => 0, "label" => ""),
						array("y" => number_format($prod13,2,'.',','), "label" => "")						
					);
					
				?>		
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Installed Capacity Per Production Cycle *</td>
							<td width="150"><input type="text" class="form-control numeric" id="installed_capacity" form="prodparam" value="<?php echo moneyFormatIndia($prod1);?>" readonly name="installed_capacity"></td>
						</tr>
						<tr>
							<td>02. Projected Capacity Utilization in % *</td>
							<td width="150"><input type="text" class="form-control numeric percentage" id="capacity_utiliz" form="prodparam" value="<?php echo moneyFormatIndia($prod2);?>" readonly name="capacity_utiliz"></td>
						</tr>
						<tr>
							<td>03. No. of Days Per Production Cycle *</td>
							<td width="150"><input type="text" class="form-control numeric" id="nofday_perprod" form="prodparam" value="<?php echo moneyFormatIndia($prod3);?>" readonly name="nofday_perprod"></td>
						</tr>
						<tr>
							<td>04. Production Cycle in Number of Months</td>
							<td width="150"><input type="text" class="form-control" id="prodcycle_nom" readonly value="<?php echo moneyFormatIndia($prod4);?>" name="prodcycle_nom"></td>
						</tr>
						<tr>
							<td>05. No. of Production Cycle/s Per Annum</td>
							<td width="150"><input type="text" class="form-control" id="nop_perannum" value="<?php echo moneyFormatIndia($prod5);?>" readonly name="nop_perannum"></td>
						</tr>
						<tr>
							<td>06. Units Produced in the Current Production Cycle </td>
							<td width="150"><input type="text" class="form-control" id="up_cprodcyle" value="<?php echo moneyFormatIndia($prod6);?>" readonly name="up_cprodcyle"></td>
						</tr>
						<tr>
							<td>07. % of Work-In-Progress (Opening Stock) *</td>
							<td width="150"><input type="text" class="form-control numeric percentage" id="work_in_progress" form="prodparam" value="<?php echo moneyFormatIndia($prod7);?>" readonly name="work_in_progress"></td>
						</tr>
						<tr>
							<td>08. WIP in No. of Units (Opening Stock)</td>
							<td width="150"><input type="text" class="form-control" id="wip_nou" value="<?php echo moneyFormatIndia($prod8);?>" readonly name="wip_nou"></td>
						</tr>
						<tr>
							<td>09. % of Finished Product Out of WIP *</td>
							<td width="150"><input type="text" class="form-control numeric percentage" form="prodparam" id="finishedprod_wip" readonly value="<?php echo moneyFormatIndia($prod9);?>" name="finishedprod_wip"></td>
						</tr>
						<tr>
							<td>10. No. of Units Produced out of WIP Per Cycle</td>
							<td width="150"><input type="text" class="form-control" id="nouproduced" value="<?php echo moneyFormatIndia($prod10);?>" readonly name="nouproduced"></td>
						</tr>
						<tr>
							<td>11. Total Production (Inclusive of Production out of WIP)</td>
							<td width="150"><input type="text" class="form-control" id="totprod_wip" readonly value="<?php echo moneyFormatIndia($prod11);?>" name="totprod_wip"></td>
						</tr>
						<tr>
							<td>12. Direct Cost</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="directcost" name="directcost" value="<?php echo moneyFormatIndia($prod12);?>" readonly ></td>
						</tr>
						<tr>
							<td>13. Production Cost Per Unit</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="cost_perunit"  value="<?php echo moneyFormatIndia($prod13);?>" readonly name="cost_perunit"></td>
						</tr>
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart" id="pp_profchart"></div>
					<div class="hr-line-dashed"></div>
					<div id="prodchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			<div id="sec5">
				<h3 class="title" id="t5">Manpower Particulars &amp; Costs</h3>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<form action="" method="post" name="manpower" id="manpower"  autocomplete="off">
						<input type="hidden" name="tbl" value="manpowerdet">
					</form>
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="7">&nbsp;</td></tr>
						<tr>
							<th>Category</th>
							<th>Managerial Personnel</th>
							<th>Sales Personnel</th>
							<th>Admin Staff</th>
							<th>Skilled Personnel</th>
							<th>Unskilled Personnel</th>
							<th>Total</th>
						</tr>
						<tr>
							<td>Manpower Strength *</td>
							<td><input type="text" class="form-control rows numeric" data-cate="Managerial Personnel" id="r1c1" form="manpower" value="<?php echo moneyFormatIndia($r1c1);?>" readonly name="r1c1"></td>
							<td><input type="text" class="form-control rows numeric" data-cate="Sales Personnel" id="r1c2" form="manpower" value="<?php echo moneyFormatIndia($r1c2);?>" readonly name="r1c2"></td>
							<td><input type="text" class="form-control rows numeric" data-cate="Admin Staff" id="r1c3" form="manpower" value="<?php echo moneyFormatIndia($r1c3);?>" readonly name="r1c3"></td>
							<td><input type="text" class="form-control rows numeric" data-cate="Skilled Personnel" id="r1c4" form="manpower" value="<?php echo moneyFormatIndia($r1c4);?>" readonly name="r1c4"></td>
							<td><input type="text" class="form-control rows numeric" data-cate="Unskilled Personnel" id="r1c5" form="manpower" value="<?php echo moneyFormatIndia($r1c5);?>" readonly name="r1c5"></td>
							<td><input type="text" class="form-control rows numeric"  id="r1c6" form="manpower" value="<?php echo '';?>" readonly name="r1c6"></td>
						</tr>
						<tr>
							<td>Monthly Salary Per Employee *</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r2c1" form="manpower" value="<?php echo moneyFormatIndia($r2c1);?>" readonly name="r2c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r2c2" form="manpower" value="<?php echo moneyFormatIndia($r2c2);?>" readonly name="r2c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r2c3" form="manpower" value="<?php echo moneyFormatIndia($r2c3);?>" readonly name="r2c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r2c4" form="manpower" value="<?php echo moneyFormatIndia($r2c4);?>" readonly name="r2c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r2c5" form="manpower" value="<?php echo moneyFormatIndia($r2c5);?>" readonly name="r2c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r2c6" form="manpower" value="<?php echo '';?>" readonly name="r2c6"></td>
						</tr>
						<tr>
							<td>Salary Per Employee Per Production Cycle</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r3c1" form="manpower" value="<?php echo '';?>" readonly name="r3c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r3c2" form="manpower" value="<?php echo '';?>" readonly name="r3c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r3c3" form="manpower" value="<?php echo '';?>" readonly name="r3c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r3c4" form="manpower" value="<?php echo '';?>" readonly name="r3c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r3c5" form="manpower" value="<?php echo '';?>" readonly name="r3c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r3c6" form="manpower" value="<?php echo '';?>" readonly name="r3c6"></td>
						</tr>
						<tr>
							<td>Gross Salary Expenses</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r4c1" form="manpower" value="<?php echo '';?>" readonly name="r4c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r4c2" form="manpower" value="<?php echo '';?>" readonly name="r4c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r4c3" form="manpower" value="<?php echo '';?>" readonly name="r4c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r4c4" form="manpower" value="<?php echo '';?>" readonly name="r4c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r4c5" form="manpower" value="<?php echo '';?>" readonly name="r4c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r4c6" form="manpower" value="<?php echo '';?>" readonly name="r4c6"></td>
						</tr>
						<tr>
							<td>Welfare Cost Per Employee Per Production Cycle *</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r5c1" form="manpower" value="<?php echo moneyFormatIndia($r5c1);?>" readonly name="r5c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r5c2" form="manpower" value="<?php echo moneyFormatIndia($r5c2);?>" readonly name="r5c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r5c3" form="manpower" value="<?php echo moneyFormatIndia($r5c3);?>" readonly name="r5c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r5c4" form="manpower" value="<?php echo moneyFormatIndia($r5c4);?>" readonly name="r5c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r5c5" form="manpower" value="<?php echo moneyFormatIndia($r5c5);?>" readonly name="r5c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r5c6" form="manpower" value="<?php echo '';?>" readonly name="r5c6"></td>
						</tr>
						<tr>
							<td>Gross Employee Welfare Costs</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r6c1" form="manpower" value="<?php echo '';?>" readonly name="r6c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r6c2" form="manpower" value="<?php echo '';?>" readonly name="r6c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r6c3" form="manpower" value="<?php echo '';?>" readonly name="r6c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r6c4" form="manpower" value="<?php echo '';?>" readonly name="r6c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r6c5" form="manpower" value="<?php echo '';?>" readonly name="r6c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r6c6" form="manpower" value="<?php echo '';?>" readonly name="r6c6"></td>
						</tr>
						<tr>
							<td>Performance Incentive Per Employee Per Production Cycle *</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r7c1" form="manpower" value="<?php echo moneyFormatIndia($r7c1);?>" readonly name="r7c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r7c2" form="manpower" value="<?php echo moneyFormatIndia($r7c2);?>" readonly name="r7c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r7c3" form="manpower" value="<?php echo moneyFormatIndia($r7c3);?>" readonly name="r7c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r7c4" form="manpower" value="<?php echo moneyFormatIndia($r7c4);?>" readonly name="r7c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r7c5" form="manpower" value="<?php echo moneyFormatIndia($r7c5);?>" readonly name="r7c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r7c6" form="manpower" value="<?php echo '';?>" readonly name="r7c6"></td>
						</tr>
						<tr>
							<td>Gross Performance Incentive</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r8c1" form="manpower" value="<?php echo '';?>" readonly name="r8c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r8c2" form="manpower" value="<?php echo '';?>" readonly name="r8c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r8c3" form="manpower" value="<?php echo '';?>" readonly name="r8c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r8c4" form="manpower" value="<?php echo '';?>" readonly name="r8c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r8c5" form="manpower" value="<?php echo '';?>" readonly name="r8c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r8c6" form="manpower" value="<?php echo '';?>" readonly name="r8c6"></td>
						</tr>
						<tr>
							<td>Bonus Per Employee Per Production Cycle *</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r9c1" form="manpower" value="<?php echo moneyFormatIndia($r9c1);?>" readonly name="r9c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r9c2" form="manpower" value="<?php echo moneyFormatIndia($r9c2);?>" readonly name="r9c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r9c3" form="manpower" value="<?php echo moneyFormatIndia($r9c3);?>" readonly name="r9c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r9c4" form="manpower" value="<?php echo moneyFormatIndia($r9c4);?>" readonly name="r9c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r9c5" form="manpower" value="<?php echo moneyFormatIndia($r9c5);?>" readonly name="r9c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r9c6" form="manpower" value="<?php echo '';?>" readonly name="r9c6"></td>
						</tr>
						<tr>
							<td>Gross Bonus For Employees</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r10c1" form="manpower" value="<?php echo '';?>" readonly name="r10c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r10c2" form="manpower" value="<?php echo '';?>" readonly name="r10c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r10c3" form="manpower" value="<?php echo '';?>" readonly name="r10c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r10c4" form="manpower" value="<?php echo '';?>" readonly name="r10c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r10c5" form="manpower" value="<?php echo '';?>" readonly name="r10c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r10c6" form="manpower" value="<?php echo '';?>" readonly name="r10c6"></td>
						</tr>
						<tr>
							<td>Gross Employee Costs Per Production Cycle</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r11c1" form="manpower" value="<?php echo '';?>" readonly name="r11c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r11c2" form="manpower" value="<?php echo '';?>" readonly name="r11c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r11c3" form="manpower" value="<?php echo '';?>" readonly name="r11c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r11c4" form="manpower" value="<?php echo '';?>" readonly name="r11c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r11c5" form="manpower" value="<?php echo '';?>" readonly name="r11c5"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?>" id="r11c6" form="manpower" value="<?php echo '';?>" readonly name="r11c6"></td>
						</tr>
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12"></div>
				<div class="hr-line-dashed"></div>
				
			</div>
		
			<div id="sec6">
				<h3 class="title" id="t6">Inventory</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="inventory" id="inventory"  autocomplete="off">
						<input type="hidden" name="tbl" value="inventory">
					</form>				
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. % of Raw Material in Stock (As % of Installed Capacity) *</td>
							<td width="150"><input type="text" class="form-control numeric percentage" id="rawmaterial" form="inventory" value="<?php echo moneyFormatIndia($rawmaterial);?>" readonly name="rawmaterial"></td>
						</tr>
						<tr>
							<td>02. Raw Material in Stock for No. of Units</td>
							<td width="150"><input type="text" class="form-control numeric" id="rmnou" value="<?php echo moneyFormatIndia($rmnou);?>" readonly name="rmnou"></td>
						</tr>
						<tr>
							<td>03. Cost of Raw Material in Stock</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="crm" value="<?php echo moneyFormatIndia($crm);?>" readonly name="crm"></td>
						</tr>
						<tr>
							<td>04. % of Finished Goods in Stock (As % of Installed Capacity) *</td>
							<td width="150"><input type="text" class="form-control percentage" id="finishedgoods" readonly value="<?php echo moneyFormatIndia($fgoods);?>" form="inventory" name="finishedgoods"></td>
						</tr>
						<tr>
							<td>05. Finished Goods in Stock in No. of Units</td>
							<td width="150"><input type="text" class="form-control" id="fgnou" value="<?php echo moneyFormatIndia($fgnou);?>" readonly name="fgnou"></td>
						</tr>
						<tr>
							<td>06. Cost of Finished Goods in Stock </td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="cfg" value="<?php echo moneyFormatIndia($cfg);?>" readonly name="cfg"></td>
						</tr>
						<tr>
							<td>07. Total Inventory Cost</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="totinvcost" value="<?php echo moneyFormatIndia($totinvcost);?>" readonly name="totinvcost"></td>
						</tr>						
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart" id="inv_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			
			<div id="sec7">
				<h3 class="title" id="t7">Direct Costs Per Production Cycle</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="dcfrm" id="dcfrm"  autocomplete="off">
						<input type="hidden" name="tbl" value="directcost">
					</form>				
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><th>Direct Costs - Heads of Account</th><th>Costs</th></tr>
						<tr>
							<td>01. Raw Material</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rmdc" value="<?php echo moneyFormatIndia($rmdc);?>" readonly name="rmdc"></td>
						</tr>
						<tr>
							<td>02. Wages For Production Staff</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="wagesdc" value="<?php echo moneyFormatIndia($wagesdc);?>" readonly name="wagesdc"></td>
						</tr>
						<tr>
							<td>03. Performance Incentive For Production Staff</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="pidc" value="<?php echo moneyFormatIndia($pidc);?>" readonly name="pidc"></td>
						</tr>
						<tr>
							<td>04. Welfare Costs For Production Staff</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="welfaredc" readonly value="<?php echo moneyFormatIndia($welfaredc);?>" name="welfaredc"></td>
						</tr>
						<tr>
							<td>05. Bonus For Production Staff</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="bonusdc" value="<?php echo moneyFormatIndia($bonusdc);?>" readonly name="bonusdc"></td>
						</tr>
						<tr>
							<td>06. Power Charges *</td>
							<td width="150"><input type="text" class="form-control numeric dc <?php echo $cur_sign;?>" form="dcfrm" id="power" value="<?php echo moneyFormatIndia($power);?>" readonly name="power"></td>
						</tr>
						<tr>
							<td>07. Water Charges *</td>
							<td width="150"><input type="text" class="form-control numeric dc <?php echo $cur_sign;?>" id="water" form="dcfrm" value="<?php echo moneyFormatIndia($water);?>" readonly name="water"></td>
						</tr>
						<tr>
							<td>08. Training of Skilled Personnel *</td>
							<td width="150"><input type="text" class="form-control numeric dc <?php echo $cur_sign;?>" id="training" form="dcfrm" value="<?php echo moneyFormatIndia($training);?>" readonly name="training"></td>
						</tr>
						<tr>
							<td>09. Freight Inward Transportation Costs *</td>
							<td width="150"><input type="text" class="form-control numeric dc <?php echo $cur_sign;?>" id="transport" form="dcfrm" value="<?php echo moneyFormatIndia($transport);?>" readonly name="transport"></td>
						</tr>
						<tr>
							<td>Total of Direct Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="totdc" value="<?php echo moneyFormatIndia($totdc);?>" readonly name="totdc"></td>
						</tr>
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart" id="dc_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			
			<div id="sec8">
				<h3 class="title" id="t8">Indirect Costs Per Production Cycle</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="indcfrm" id="indcfrm"  autocomplete="off">
						<input type="hidden" name="tbl" value="indirectcost">
					</form>				
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><th>Indirect Costs - Heads of Account</th><th>Costs</th></tr>
						<tr>
							<td>01. Salary to Managers</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc1" value="<?php echo moneyFormatIndia($indc1);?>" readonly name="indc1"></td>
						</tr>
						<tr>
							<td>02. Salary to Sales Personnel</td>
							<td width="150"><input type="text" class="form-control numeric" id="indc2" value="<?php echo moneyFormatIndia($indc2);?>" readonly name="indc2"></td>
						</tr>
						<tr>
							<td>03. Salary to Admin Staff</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc3" value="<?php echo moneyFormatIndia($indc3);?>" readonly name="indc3"></td>
						</tr>
						<tr>
							<td>04. Salary to Unskilled Staff</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="indc4" readonly value="<?php echo moneyFormatIndia($indc4);?>" name="indc4"></td>
						</tr>
						<tr>
							<td>05. Employee Welfare Costs</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="indc5" value="<?php echo moneyFormatIndia($indc5);?>" readonly name="indc5"></td>
						</tr>
						<tr>
							<td>06. Performance Incentive to Employees Other Than Skilled </td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc6" value="<?php echo moneyFormatIndia($indc6);?>" readonly name="indc6"></td>
						</tr>
						<tr>
							<td>07. Annual Bonus to Employees Other Than Skilled</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc7" value="<?php echo moneyFormatIndia($indc7);?>" readonly name="indc7"></td>
						</tr>
						<tr>
							<td>08. Advertisement Expenses *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="advertise" form="indcfrm" value="<?php echo moneyFormatIndia($advertise);?>" readonly name="advertise"></td>
						</tr>
						<tr>
							<td>09. Regular Sales Expenses *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="salesexp" form="indcfrm" value="<?php echo moneyFormatIndia($salesexp);?>" readonly name="salesexp"></td>
						</tr>
							<tr>
							<td>10. Additional Incentive For Salesmen(per salesman) *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" form="indcfrm" id="add_incentive" value="<?php echo moneyFormatIndia($add_incentive);?>" readonly name="add_incentive"></td>
						</tr>
						<tr>
							<td>11. Additional Sales Expenses *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="add_salesexp" form="indcfrm" value="<?php echo moneyFormatIndia($add_salesexp);?>" readonly name="add_salesexp"></td>
						</tr>
						<tr>
							<td>12. Go-Down Rent *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="godown" form="indcfrm" value="<?php echo moneyFormatIndia($godown);?>" readonly name="godown"></td>
						</tr>
						<tr>
							<td>13. Campus Cleaning Expenses *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="campus_cleaning" form="indcfrm" value="<?php echo moneyFormatIndia($campus_cleaning);?>" readonly name="campus_cleaning"></td>
						</tr>
							<tr>
							<td>14. Business Insurance *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" form="indcfrm" id="business_insurance" value="<?php echo moneyFormatIndia($business_insurance);?>" readonly name="business_insurance"></td>
						</tr>
						<tr>
							<td>15 Technology Costs *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="technology_cost" form="indcfrm" value="<?php echo moneyFormatIndia($technology_cost);?>" readonly name="technology_cost"></td>
						</tr>
						<tr>
							<td>16 Food Charges (For all Employees) *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="food_charges" form="indcfrm" value="<?php echo moneyFormatIndia($food_charges);?>" readonly name="food_charges"></td>
						</tr>
						<tr>
							<td>17. Entertainment Charges(For Managers) *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="entertainment_charges" form="indcfrm" value="<?php echo moneyFormatIndia($entertainment_charges);?>" readonly name="entertainment_charges"></td>
						</tr>
							<tr>
							<td>18. Managerial/Admin Training Cost(PP) *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" form="indcfrm" id="training_cost" value="<?php echo moneyFormatIndia($training_cost);?>" readonly name="training_cost"></td>
						</tr>
						<tr>
							<td>19. Legal Costs (Retention Fee) *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="legal_cost" form="indcfrm" value="<?php echo moneyFormatIndia($legal_cost);?>" readonly name="legal_cost"></td>
						</tr>
						<tr>
							<td>20. Consultant Costs *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="consultant_cost" form="indcfrm" value="<?php echo moneyFormatIndia($consultant_cost);?>" readonly name="consultant_cost"></td>
						</tr>
						<tr>
							<td>21. Postal Charges *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="postal_charges" form="indcfrm" value="<?php echo moneyFormatIndia($postal_charges);?>" readonly name="postal_charges"></td>
						</tr>
						<tr>
							<td>22. Stationery *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" form="indcfrm" id="stationery" value="<?php echo moneyFormatIndia($stationery);?>" readonly name="stationery"></td>
						</tr>
						<tr>
							<td>23. Telephone Costs *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="telephone_costs" form="indcfrm" value="<?php echo moneyFormatIndia($telephone_costs);?>" readonly name="telephone_costs"></td>
						</tr>
						<tr>
							<td>24. Printing Costs *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="printing_costs" form="indcfrm" value="<?php echo moneyFormatIndia($printing_costs);?>" readonly name="printing_costs"></td>
						</tr>
						<tr>
							<td>25. Website Costs *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="website_costs" form="indcfrm" value="<?php echo moneyFormatIndia($website_costs);?>" readonly name="website_costs"></td>
						</tr>
						<tr>
							<td>26. Transport Costs *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" form="indcfrm" id="transport_costs" value="<?php echo moneyFormatIndia($transport_costs);?>" readonly name="transport_costs"></td>
						</tr>
						<tr>
							<td>27. Packaging Costs *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="packaging" form="indcfrm" value="<?php echo moneyFormatIndia($packaging);?>" readonly name="packaging"></td>
						</tr>
						<tr>
							<td>28. Plant Maintenance Expenses *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="maintenance_exp" form="indcfrm" value="<?php echo moneyFormatIndia($maintenance_exp);?>" readonly name="maintenance_exp"></td>
						</tr>
						<tr>
							<td>29. Miscellaneous *</td>
							<td width="150"><input type="text" class="form-control numeric indc <?php echo $cur_sign;?>" id="miscellaneous" form="indcfrm" value="<?php echo moneyFormatIndia($miscellaneous);?>" readonly name="miscellaneous"></td>
						</tr>
						<tr>
							<td>Total of Indirect Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="totindc" value="<?php echo moneyFormatIndia($totindc);?>" readonly name="totindc"></td>
						</tr>
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart" id="indc_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			<div id="sec9">
				<h3 class="title" id="t9">Required Working Capital</h3>
				
				<div class="col-md-6 col-sm-12 col-xs-12">							
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Direct Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rwc_dc" value="" readonly name="rwc_dc"></td>
						</tr>
						<tr>
							<td>02. Indirect Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rwc_indc" value="" readonly name="rwc_indc"></td>
						</tr>
						<tr>
							<td>03. Inventory Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rwc_inv" value="" readonly name="rwc_inv"></td>
						</tr>
						<tr>
							<td>Total Required Working Capital</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="rwc_tot" readonly value="" name="rwc_tot"></td>
						</tr>											
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="rwc_chart" id="rwc_chart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			<div id="sec10">				
				<div class="col-md-6 col-sm-12 col-xs-12">
					<h3 class="title" id="t10">Financial Costs</h3>
					<form action="" method="post" name="findep" id="findep"  autocomplete="off">
						<input type="hidden" name="tbl" value="finance_deposit_investment">
					</form>				
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Total Term Loan</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost1" value="<?php echo moneyFormatIndia($fincost1);?>" readonly name="fincost1"></td>
						</tr>
						<tr>
							<td>02. Rate of Interest on Term Loan</td>
							<td width="150"><input type="text" class="form-control numeric percentage" id="fincost2" value="<?php echo moneyFormatIndia($fincost2);?>" readonly name="fincost2"></td>
						</tr>
						<tr>
							<td>03. Commitment on Principal Repayment of Term Loan</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost3" value="<?php echo moneyFormatIndia($fincost3);?>" readonly name="fincost3"></td>
						</tr>
						<tr>
							<td>04. Commitment on Interest Payment of Term Loan</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="fincost4" readonly value="<?php echo moneyFormatIndia($fincost4);?>" name="fincost4"></td>
						</tr>
						<tr>
							<td>05. Total Commitment on Term Loan</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="fincost5" value="<?php echo moneyFormatIndia($fincost5);?>" readonly name="fincost5"></td>
						</tr>
						<tr>
							<td>06. Working Capital Required </td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost6" value="<?php echo moneyFormatIndia($fincost6);?>" readonly name="fincost6"></td>
						</tr>
						<tr>
							<td>07. Bank Loans Towards Working Capital</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost7" value="<?php echo moneyFormatIndia($fincost7);?>" readonly name="fincost7"></td>
						</tr>
						<tr>
							<td>08. Rate of Interest on Working Capital Loan *</td>
							<td width="150"><input type="text" class="form-control numeric fincost percentage" id="wc_loan_interest" form="findep" value="<?php echo moneyFormatIndia($wc_loan_interest);?>" readonly name="wc_loan_interest"></td>
						</tr>
						<tr>
							<td>09. Interest Payment on Working Capital Loan</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost9" value="<?php echo moneyFormatIndia($fincost9);?>" readonly name="fincost9"></td>
						</tr>
							<tr>
							<td>10. Promoter's Stake Towards Working Capital</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost10" value="<?php echo moneyFormatIndia($fincost10);?>" readonly name="fincost10"></td>
						</tr>
						<tr>
							<td>11. Value of Required Raw Material</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost11" value="<?php echo moneyFormatIndia($fincost11);?>" readonly name="fincost11"></td>
						</tr>
						<tr>
							<td>12. % of Market Credit on Raw Material - Interest Free</td>
							<td width="150"><input type="text" class="form-control numeric indc percentage" id="interest_free" form="findep" value="<?php echo moneyFormatIndia($interest_free);?>" readonly name="interest_free"></td>
						</tr>
						<tr>
							<td>13. Market Credit in Value</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost13"  value="<?php echo moneyFormatIndia($fincost13);?>" readonly name="fincost13"></td>
						</tr>	
						<tr>
							<td>14. Commitment on TL, WCL, &amp; Sundry Creditors</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost14"  value="<?php echo moneyFormatIndia($fincost14);?>" readonly name="fincost14"></td>
						</tr>
					</table></div>
				</div>
				<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-5 col-sm-12 col-xs-12">
					<h3 class="title" id="t10">Deposits &amp; Investments</h3>								
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>						
						<tr>
							<td>01. Rental Deposit For Go-Down</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rent_deposit" value="<?php echo moneyFormatIndia($godown*20);?>" readonly name="rent_deposit"></td>
						</tr>
						<tr>
							<td>02. Fixed Deposits in Banks</td>
							<td width="150"><input type="text" class="form-control numeric fincost <?php echo $cur_sign;?>" readonly id="fd_bank" value="<?php echo moneyFormatIndia($fd_bank);?>" name="fd_bank" form="findep"></td>
						</tr>
						<tr>
							<td>Total</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="deptot" value="<?php echo moneyFormatIndia($deptot);?>" readonly name="deptot"></td>
						</tr>
					</table></div>
					<div class="prof_chart" id="dpin_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			<div id="sec11">
				<div class="col-md-12 col-sm-12 col-xs-12">			
				<div class="col-md-6 col-sm-12 col-xs-12">
					<h3 class="title" id="t11">Sales &amp; Marketing Costs</h3>								
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Advertisement Expenses Per Cycle</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost1" value="" readonly name="smcost1"></td>
						</tr>
						<tr>
							<td>02. Regular Sales Expenses Per Cycle</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost2" value="" readonly name="smcost2"></td>
						</tr>
						<tr>
							<td>03. Regular Incentive to Salesmen Per Cycle</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost3" value="" readonly name="smcost3"></td>
						</tr>
						<tr>
							<td>04. Additional Incentive to Salesmen Per Cycle</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="smcost4" readonly value="" name="smcost4"></td>
						</tr>
						<tr>
							<td>05. Additional Sales Expenses Per Cycle</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="smcost5" value="" readonly name="smcost5"></td>
						</tr>
						<tr>
							<td>Total Sales &amp; Marketing Costs Per Cycle</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost6" value="" readonly name="smcost6"></td>
						</tr>						
					</table></div>
				</div>
				<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-5 col-sm-12 col-xs-12">
					<h3 class="title" id="t10">Summary of Costs</h3>								
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>						
						<tr>
							<td>Capital Investment Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary1" value="" readonly name="summary1"></td>
							<td width="150"><input type="text" class="form-control numeric " id="summaryper1" value="" readonly name="summaryper1"></td>
						</tr>
						<tr>
							<td>Direct Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary2" value="" readonly name="summary2" ></td>
							<td width="150"><input type="text" class="form-control numeric " id="summaryper2" value="" readonly name="summaryper2"></td>
						</tr>
						<tr>
							<td>Indirect Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary3" value="" readonly name="summary3"></td>
							<td width="150"><input type="text" class="form-control numeric " id="summaryper3" value="" readonly name="summaryper3"></td>
						</tr>
						<tr>
							<td>Marketing Costs</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="summary4" readonly value="" name="summary4"></td>
							<td width="150"><input type="text" class="form-control numeric " id="summaryper4" value="" readonly name="summaryper4"></td>
						</tr>
						<tr>
							<td>Financial Costs</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="summary5" value="" readonly name="summary5"></td>
							<td width="150"><input type="text" class="form-control numeric " id="summaryper5" value="" readonly name="summaryper5"></td>
						</tr>
						<tr>
							<td>Total Costs</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary6" value="" readonly name="summary6"></td>
							<td width="150"><input type="text" class="form-control numeric " id="summaryper6" value="" readonly name="summaryper6"></td>
						</tr>						
					</table></div>
				</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12" id="sumry">	
					<div class="col-md-6 col-sm-12 col-xs-12" id="distri_chart" >
					
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="prof_chart" id="sc_profchart"></div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			<div id="sec12">				
				<div class="col-md-6 col-sm-12 col-xs-12">				
					<h3 class="title" id="t12">Particulars of Product &amp; Sales Costs</h3>
					<form action="" method="post" name="prodsalescost" id="prodsalescost"  autocomplete="off">
						<input type="hidden" name="tbl" value="prod_sales_cost">
					</form>		
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Cost of the Product (Inclusive of All Costs)</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="psc1" value="" readonly name="psc1"></td>
						</tr>
						<tr>
							<td>02. Break-Even Point</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="psc2" value="" readonly name="psc2"></td>
						</tr>
						<tr>
							<td>03. Profit Margin on the Cost of the Product</td>
							<td width="150"><input type="text" class="form-control numeric percentage" form="prodsalescost" id="profit_margin" value="<?php echo moneyFormatIndia($profit_margin);?>" readonly name="profit_margin"></td>
						</tr>
						<tr>
							<td>04. Cost of the Product + Profit Margin</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="psc4" readonly value="" name="psc4"></td>
						</tr>
						<tr>
							<td>05. Sales Discount</td>
							<td width="150"><input type="text" class="form-control numeric percentage " id="sales_discount" value="<?php echo moneyFormatIndia($sales_discount);?>" readonly name="sales_discount" form="prodsalescost" ></td>
						</tr>
						<tr>
							<td>06. Gross Sale Price</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="psc6" value="" readonly name="psc6"></td>
						</tr>						
					</table></div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart" id="psc_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			<div id="sec13">				
				<div class="col-md-12 col-sm-12 col-xs-12">				
					<h3 class="title" id="t13">Sales Particulars</h3>
					<div class="col-md-7 col-sm-12 col-xs-12">	
					<form action="" method="post" name="salesparticular" id="salesparticular"  autocomplete="off">
						<input type="hidden" name="tbl" value="salesparticular">
					</form>		
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Total Number of Units Available for Sale</td>
							<td width="150"><input type="text" class="form-control numeric" id="salesp1" value="" readonly name="salesp1"></td>
						</tr>
						<tr>
							<td>02. Sales Target in Percentage</td>
							<td width="150"><input type="text" class="form-control numeric percentage" form="salesparticular" id="sales_target" value="<?php echo moneyFormatIndia($sales_target);?>" readonly name="sales_target"></td>
						</tr>
						<tr>
							<td>03. Sales Target in Number of Units</td>
							<td width="150"><input type="text" class="form-control numeric" id="salesp3" value="" readonly name="salesp3"></td>
						</tr>
						<tr>
							<td>04. Sales Achieved Against Sales Target in %</td>
							<td width="150"><input type="text" class="form-control numeric percentage" form="salesparticular" id="sales_achieved" value="<?php echo moneyFormatIndia($sales_achieved);?>" readonly name="sales_achieved"></td>
						</tr>
						<tr>
							<td>05. Sales Achieved Against Sales Target in No. of Units</td>
							<td width="150"><input type="text" class="form-control" id="salesp5" readonly value="" name="salesp5"></td>
						</tr>
						<tr>
							<td>06. Additional Sales Because of Additional Incentive to Sales Personnel</td>
							<td width="150"><input type="text" class="form-control numeric " id="salesp6" value="" readonly name="salesp6" ></td>
						</tr>
						<tr>
							<td>07. Additional Sales Because of Additional Sales Expenses</td>
							<td width="150"><input type="text" class="form-control numeric" id="salesp7" value="" readonly name="salesp7"></td>
						</tr>
						
						<tr>
							<td>08. Additional Sales Because of Discount Offered</td>
							<td width="150"><input type="text" class="form-control numeric" id="salesp8" value="" readonly name="salesp8"></td>
						</tr>
						<tr>
							<td>09. Additional Sales Because of R&amp;D/Product Improvement/Training</td>
							<td width="150"><input type="text" class="form-control" id="salesp9" readonly value="" name="salesp9"></td>
						</tr>
						<tr>
							<td>10. Total Sales in Number of Units</td>
							<td width="150"><input type="text" class="form-control numeric" id="salesp10" value="" readonly name="salesp10"></td>
						</tr>
						<tr>
							<td>11. Percentage of Sales to Target</td>
							<td width="150"><input type="text" class="form-control percentage" id="salesp11" readonly value="" name="salesp11"></td>
						</tr>
						<tr>
							<td>12. Percentage of Sales on Cash</td>
							<td width="150"><input type="text" class="form-control numeric percentage" form="salesparticular" id="sales_cash" value="<?php echo moneyFormatIndia($sales_cash);?>" readonly name="sales_cash"></td>
							
						</tr>
						<tr>
							<td>13. Percentage of Sales on Credit</td>
							<td width="150"><input type="text" class="form-control numeric percentage " id="salesp13" value="" readonly name="salesp13" ></td>
						</tr>
						<tr>
							<td>14. Total Sales on Cash in Number of Units</td>
							<td width="150"><input type="text" class="form-control numeric" id="salesp14" value="" readonly name="salesp14"></td>
						</tr>
						<tr>
							<td>15. Sales on Credit in Number of Units</td>
							<td width="150"><input type="text" class="form-control" id="salesp15" readonly value="" name="salesp15"></td>
						</tr>
						<tr>
							<td>16. Expected Doubtful Credit Sales - In %</td>
							<td width="150"><input type="text" class="form-control numeric percentage" form="salesparticular" id="doubtful_crsale" value="<?php echo moneyFormatIndia($doubtful_crsale);?>" readonly name="doubtful_crsale"></td>
						</tr>
						<tr>
							<td>17. Expected Doubtful Credit Sales - In Number of Units</td>
							<td width="150"><input type="text" class="form-control numeric" id="salesp17" value="" readonly name="salesp17"></td>
						</tr>
					</table></div>
					</div>
					<div class="col-md-5 col-sm-12 col-xs-12">
						
						<div class="prof_chart" id="salp_profchart"></div>
					
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				
			</div>
			
			<div id="sec14">				
				<div class="col-md-12 col-sm-12 col-xs-12">				
					<h3 class="title" id="t14">Revenue Analysis</h3>
					<div class="col-md-7 col-sm-12 col-xs-12">						
					<div class="table-responsive"><table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Turnover</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven1" value="" readonly name="reven1"></td>
						</tr>
						<tr>
							<td>02. Revenue Out of Cash Sales</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven2" value="" readonly name="reven2"></td>
						</tr>
						<tr>
							<td>03. Expected Revenue Out of Sales on Credit (Bill Receivable)</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven3" value="" readonly name="reven3"></td>
						</tr>
						<tr>
							<td>04. Expected Revenue Out of Doubtful Debt(Sundry Debtors)</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven4" value="" readonly name="reven4"></td>
						</tr>
						<tr>
							<td>05. Net Sales Revenue</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="reven5" readonly value="" name="reven5"></td>
						</tr>
						<tr>
							<td>06. Net Expenses</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="reven6" value="" readonly name="reven6" ></td>
						</tr>
						<tr>
							<td>07. Net Sales Revenue Less Net Expenses</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven7" value="" readonly name="reven7"></td>
						</tr>
						
						<tr>
							<td>08. Cash on Hand</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven8" value="" readonly name="reven8"></td>
						</tr>
						<tr>
							<td>09. Cash at Bank</td>
							<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="reven9" readonly value="" name="reven9"></td>
						</tr>
						<tr>
							<td>10. Sundry Debtors</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven10" value="" readonly name="reven10"></td>
						</tr>
						<tr>
							<td>11. Sundry Debtors as a Percentage of Turnover</td>
							<td width="150"><input type="text" class="form-control percentage" id="reven11" readonly value="" name="reven11"></td>
						</tr>
						<tr>
							<td>12. Sundry Creditors</td>
							<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven12" value="" readonly name="reven12"></td>							
						</tr>
						<tr>
							<td>13. Sundry Creditors as a Percentage of Turnover</td>
							<td width="150"><input type="text" class="form-control numeric percentage" id="reven13" value="" readonly name="reven13" ></td>
						</tr>						
					</table></div>
					</div>
					<div class="col-md-5 col-sm-12 col-xs-12">	
						<div class="prof_chart" id="reven_profchart"></div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>				
			</div>			
			<div id="sec15">				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-6 col-sm-12 col-xs-12">
						<h3 class="title" id="t15">Cash Flow Analysis</h3>					
						<div class="table-responsive"><table class="table table-stripped">
							<tr><td colspan="2"><h4>Cash Outflow</h4></td></tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>01. Net Direct Expenses</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow1" value="" readonly name="cflow1"></td>
							</tr>
							<tr>
								<td>02. Net Indirect Expenses</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow2" value="" readonly name="cflow2"></td>
							</tr>
							<tr>
								<td>03. Net Marketing/Sales Expenses</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow3" value="" readonly name="cflow3"></td>
							</tr>
							<tr>
								<td>04. Net Financial Expenses</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow4" value="" readonly name="cflow4"></td>
							</tr>
							<tr>
								<td>05. Depreciation (15% on P&amp;M +3% on Building + 30% on Funiture)</td>
								<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="cflow5" readonly value="" name="cflow5"></td>
							</tr>
							<tr>
								<td>06. Taxes</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="cflow6" value="" readonly name="cflow6" ></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Net Cash Outflow</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow7" value="" readonly name="cflow7"></td>
							</tr>
						</table></div>
						<div class="table-responsive"><table class="table table-stripped">
							<tr><td colspan="2"><h4>Cash Inflow</h4></td></tr>
							<tr>
								<td>01. Net Revenue From Sales</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow8" value="" readonly name="cflow8"></td>
							</tr>
							<tr>
								<td>02. Miscellaneous Income (Sale of Scrab &amp; Waste, etc.)</td>
								<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="cflow9" readonly value="" name="cflow9"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Net Cash Inflow</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow10" value="" readonly name="cflow10"></td>
							</tr>												
						</table></div>
					</div>
					<div class="col-md-1 col-sm-12 col-xs-12"></div>
					<div class="col-md-5 col-sm-12 col-xs-12">
						<h3 class="title">Profitability</h3>
						<div class="table-responsive"><table class="table table-stripped">
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Profit Before Tax</td>
								<td width="150"><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="profitbt" value="" readonly name="profitbt"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Profit After Tax</td>
								<td width="150"><input type="text" class="form-control <?php echo $cur_sign;?>" id="profitat" readonly value="" name="profitat"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>											
						</table></div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="prof_chart" id="prof_profchart"></div>
						</div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
			</div>
			
		</div>
	</div>
	
</body>


		<!-- iCheck -->
<script src="js/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
	localStorage.setItem('cursign','<?php echo $cur_sign;?>');
  });
</script>
<script src="js/jquery.validate.js"></script>
<!--<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>-->
<script src="js/canvas.js"></script>
<script src="js/script.js"></script>
<script src="js/accounting.js"></script>
<script>

var cursign=localStorage.getItem('cursign');
function formatNumber(num) {
	var n1, n2;
	num = num + '' || '';
	// works for integer and floating as well
	n1 = num.split('.');
	n2 = n1[1] || null;
	if(cursign == 'dollar')
	{
		n1 = n1[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
	}
	else
	{
		n1 = n1[0].replace(/(\d)(?=(\d\d)+\d$)/g, "$1,");
	}
	num = n2 ? n1 + '.' + n2.substring(0,2) : n1;
	return num;
}
function calc(){
	var ec=accounting.unformat($('#estimate_cost').val());
	var tp=((parseFloat(ec)/100)*10).toFixed(2);	
	$('#cmargin').val(formatNumber(tp));
	var land=0,build=0,plant=0,furni=0,pexp=0,tfee=0,sexp=0,rd=0,lfee=0,cmargin=0,interest=0;
	if($('#interest').val() != '')
	{
		interest=accounting.unformat($('#interest').val());
	}
	land=accounting.unformat($('#land').val());
	build=accounting.unformat($('#build').val());
	plant=accounting.unformat($('#plant').val());
	furni=accounting.unformat($('#furniture').val());
	pexp=accounting.unformat($('#preexp').val());
	tfee=accounting.unformat($('#techfee').val());
	sexp=accounting.unformat($('#sexp').val());
	rd=accounting.unformat($('#rd').val()) ;
	lfee=accounting.unformat($('#licensing_fee').val());
	cmargin=accounting.unformat($('#cmargin').val());
	
	var tot=0;
	$('.apc').each(function(){
		if($(this).val() != '')
		{
			tot = parseFloat(tot)+parseFloat(accounting.unformat($(this).val()));
		}
	});
	
	$('#tot').val(formatNumber(tot));
	$('#summary1').val(formatNumber(parseFloat(land)+parseFloat(build)+parseFloat(plant)));
	
}

function calc_2()
{
	var tot=parseFloat(accounting.unformat($('#land').val()))+
	parseFloat(accounting.unformat($('#build').val()))+
	parseFloat(accounting.unformat($('#plant').val()))+
	parseFloat(accounting.unformat($('#furniture').val()))+
	parseFloat(accounting.unformat($('#preexp').val()))+
	parseFloat(accounting.unformat($('#techfee').val()))+
	parseFloat(accounting.unformat($('#sexp').val()))+
	parseFloat(accounting.unformat($('#rd').val()))+			
	parseFloat(accounting.unformat($('#cmargin').val()))+parseFloat(accounting.unformat($('#interest').val()))+parseFloat(accounting.unformat($('#licensing_fee').val()));
	$('#tot').val(formatNumber(tot));			
	
	
	var peq=0;
	if($('#promoter_stake').val() != '')
	{
		peq=((parseFloat(tot)/100) * parseFloat(accounting.unformat($('#promoter_stake').val())));
	}
	$('#pequ').val(formatNumber(peq));
	$('#eqinves').val(formatNumber(peq));
	$('#lninves').val(formatNumber(parseFloat(tot)-parseFloat(peq)));	
	$('#totinves').val(formatNumber(parseFloat(tot)));
	$('#eqinvesper').val(formatNumber(accounting.unformat($('#promoter_stake').val())));
	$('#lninvesper').val(formatNumber(100-parseFloat(accounting.unformat($('#promoter_stake').val()))));
	$('#der').val(formatNumber((parseFloat(tot)-parseFloat(peq))/parseFloat(peq)));
	
	var lnom=0,lpa=0,lint=0,aint=0;
	
	lnom = accounting.unformat($('#termloan_nom').val());
	lint = accounting.unformat($('#termloan_interest').val());
	if(parseInt(lnom) > 0)
	{		
		lpa=(((parseFloat(tot)-parseFloat(peq))/parseFloat(lnom))*12);		
	}
	if(parseFloat(lint) > 0)
	{
		aint=(((parseFloat(tot)-parseFloat(peq))/100)*parseFloat(lint));
	}
	$('#lnperannum').val(formatNumber(lpa));
	$('#aninterest').val(formatNumber(aint));
	$('#ancommit').val(formatNumber(parseFloat(aint)+parseFloat(lpa)));
	$('#interest').val(formatNumber((parseFloat(aint)/12)*9));	
	$('#fincost1').val(formatNumber(parseFloat(tot)-parseFloat(peq)));
	$('#fincost2').val(formatNumber(lint));
	$('#fincost5').val(formatNumber(parseFloat(aint)+parseFloat(lpa)));
}

function prod_cost_cal()
{
	var nod=accounting.unformat($('#nofday_perprod').val());
	var cu=accounting.unformat($('#capacity_utiliz').val());
	var ic=accounting.unformat($('#installed_capacity').val());
	var nom=0,ppa=0,cpc=0,nou=0,wip=0,ostock=0,fp=0,totp=0,dc=0,ppu=0;
	dc=accounting.unformat($('#directcost').val());
	wip=accounting.unformat($('#work_in_progress').val());
	fp=accounting.unformat($('#finishedprod_wip').val());
	if(cu != '' && nod !='')
	{
		nom=(parseFloat(nod)/30).toFixed(2);
		ppa=(12/parseFloat(nom)).toFixed(0);
		cpc=((parseFloat(ic)*(parseFloat(cu)/100))/parseFloat(nom)).toFixed(2);
		if(wip != '')
		{
			ostock=((parseFloat(ic)/100)*parseFloat(wip)).toFixed(0);
		}
		nou=((parseFloat(ostock)/100)*parseFloat(fp)).toFixed(0);
		totp=(parseFloat(cpc)+parseFloat(nou)).toFixed(0);
		ppu=(parseFloat(dc)/parseFloat(totp)).toFixed(2);
	}		
	$('#prodcycle_nom').val(nom);
	$('#nop_perannum').val(ppa);
	$('#up_cprodcyle').val(cpc);
	$('#wip_nou').val(ostock);
	$('#nouproduced').val(nou);
	$('#totprod_wip').val(totp);
	$('#cost_perunit').val(formatNumber(ppu));	
	$('#fincost3').val(formatNumber(parseFloat(accounting.unformat($('#lnperannum').val()))*parseFloat(nom)));
	$('#fincost4').val(formatNumber(parseFloat(accounting.unformat($('#aninterest').val()))*parseFloat(nom)));
	
}
function manpower_cal()
{	
	for(var j=1;j<=5;j++)
	{		
		if($('#r2c'+j).val() != '')
		{
			var t = (accounting.unformat($('#r2c'+j).val()))*parseFloat(accounting.unformat($('#prodcycle_nom').val()));
			$('#r3c'+j).val(formatNumber(t));			
			$('#r4c'+j).val(formatNumber(parseFloat(t)*parseFloat(accounting.unformat($('#r1c'+j).val()))));
		}
		
		if($('#r5c'+j).val() != '')
		{
			$('#r6c'+j).val(formatNumber((accounting.unformat($('#r5c'+j).val()))*parseFloat(accounting.unformat($('#r1c'+j).val()))));			
		}
		if($('#r7c'+j).val() != '')
		{
			$('#r8c'+j).val(formatNumber((accounting.unformat($('#r7c'+j).val()))*parseFloat(accounting.unformat($('#r1c'+j).val()))));			
		}
		if($('#r9c'+j).val() != '')
		{
			$('#r10c'+j).val(formatNumber((accounting.unformat($('#r9c'+j).val()))*parseFloat(accounting.unformat($('#r1c'+j).val()))));			
		}
		
		if($('#r4c'+j).val() == '')
			$('#r4c'+j).val(0);
		if($('#r6c'+j).val() == '')
			$('#r6c'+j).val(0);
		if($('#r8c'+j).val() == '')
			$('#r8c'+j).val(0);
		if($('#r10c'+j).val() == '')
			$('#r10c'+j).val(0);
		
		$('#r11c'+j).val(formatNumber((accounting.unformat($('#r4c'+j).val()))+(accounting.unformat($('#r6c'+j).val()))+(accounting.unformat($('#r8c'+j).val()))+(accounting.unformat($('#r10c'+j).val()))));
	}	
	
	for(var i=1;i<=11;i++)
	{
		var tot=0;
		for(var j=1;j<=5;j++)
		{
			if($('#r'+i+'c'+j).val() != '')
			{
				tot += (accounting.unformat($('#r'+i+'c'+j).val())) ;
			}
		}		
		$('#r'+i+'c6').val(formatNumber(tot));
	}	
}

function inventory_cal()
{	
	var cu=accounting.unformat($('#cost_perunit').val());
	var ic=accounting.unformat($('#installed_capacity').val());
	var rm=accounting.unformat($('#rawmaterial').val());
	var fg=accounting.unformat($('#finishedgoods').val());
	var rmnou=0,crm=0,fgnou=0,cfg=0,totinvcost=0;
	if(rm != '' && ic != '')
	{
		rmnou = (parseFloat(ic)/100) * parseFloat(rm);
		crm = parseFloat(rmnou) * ((parseFloat(cu)*30)/100);
		fgnou = (parseFloat(ic)/100) * parseFloat(fg);
		cfg = parseFloat(fgnou) * parseFloat(cu);
		totinvcost = parseFloat(crm) + parseFloat(cfg);		
	}
	$('#rmnou').val((rmnou).toFixed(0));
	$('#crm').val(formatNumber(crm));
	$('#fgnou').val((fgnou).toFixed(0));
	$('#cfg').val(formatNumber(cfg));
	$('#totinvcost').val(formatNumber(totinvcost));
	$('#rwc_inv').val(formatNumber(totinvcost));
	req_working_capital();
}

function directcost_cal()
{
	var rmdc=0,wagesdc=0,pidc=0,welfaredc=0,bonusdc=0,power=0,water=0,training=0,transport=0,totdc=0;	
	rmdc = (parseFloat(accounting.unformat($('#installed_capacity').val()))*30)/100;
	wagesdc = parseFloat(accounting.unformat($('#r4c4').val())) ;
	pidc = parseFloat(accounting.unformat($('#r8c4').val()));
	welfaredc = parseFloat(accounting.unformat($('#r6c4').val()));
	bonusdc = parseFloat(accounting.unformat($('#r10c4').val()));		
	power=accounting.unformat($('#power').val());
	water=accounting.unformat($('#water').val());
	training=accounting.unformat($('#training').val());
	transport=accounting.unformat($('#transport').val());
	
	totdc= parseFloat(rmdc)+parseFloat(wagesdc)+parseFloat(pidc)+parseFloat(welfaredc)+parseFloat(bonusdc)+parseFloat(power)+parseFloat(water)+parseFloat(training)+parseFloat(transport);
	
	$('#rmdc').val(formatNumber(rmdc));
	$('#wagesdc').val(formatNumber(wagesdc));
	$('#pidc').val(formatNumber(pidc));
	$('#welfaredc').val(formatNumber(welfaredc));
	$('#bonusdc').val(formatNumber(bonusdc));
	$('#totdc').val(formatNumber(totdc));
	$('#directcost').val(formatNumber(totdc));
	$('#rwc_dc').val(formatNumber(totdc));	
	$('#summary2').val(formatNumber(totdc));
	prod_cost_cal();
	inventory_cal();
	req_working_capital();
	prod_cost_chart();
	
}
function indirectcost_cal()
{	
	var indc1=0,indc2=0,indc3=0,indc4=0,indc5=0,indc6=0,indc7=0,totindc=0;	
	indc1 = (parseFloat(accounting.unformat($('#r4c1').val()))/12);
	indc2 = (parseFloat(accounting.unformat($('#r4c2').val()))/12);
	indc3 = (parseFloat(accounting.unformat($('#r4c3').val()))/12);
	indc4 = (parseFloat(accounting.unformat($('#r4c5').val()))/12);
	indc5 = ((parseFloat(accounting.unformat($('#r6c6').val())) - parseFloat(accounting.unformat($('#r6c4').val()))) / 12);
	indc6 = ((parseFloat(accounting.unformat($('#r8c6').val())) - parseFloat(accounting.unformat($('#r8c4').val()))) / 12);
	indc7 = ((parseFloat(accounting.unformat($('#r10c6').val())) - parseFloat(accounting.unformat($('#r10c4').val()))) / 12);	
	
	$('.indc').each(function(){
		if($(this).val() != '')
		{
			totindc = parseFloat(totindc) + parseFloat($(this).val());
		}
	});	
	totindc = parseFloat(totindc) + parseFloat(indc1)+parseFloat(indc2)+parseFloat(indc3)+parseFloat(indc4)+parseFloat(indc5)+parseFloat(indc6)+parseFloat(indc7);
	
	$('#indc1').val(formatNumber(indc1));
	$('#indc2').val(formatNumber(indc2));
	$('#indc3').val(formatNumber(indc3));
	$('#indc4').val(formatNumber(indc4));
	$('#indc5').val(formatNumber(indc5));
	$('#indc6').val(formatNumber(indc6));
	$('#indc7').val(formatNumber(indc7));	
	$('#totindc').val(formatNumber(totindc));
	$('#rwc_indc').val(formatNumber(totindc));
	$('#summary3').val(formatNumber(totindc));
	req_working_capital();
	
	
}
function req_working_capital()
{
	$('#rwc_tot').val(formatNumber(parseFloat(accounting.unformat($('#rwc_dc').val()))+parseFloat(accounting.unformat($('#rwc_indc').val()))+parseFloat(accounting.unformat($('#rwc_inv').val()))));
	$('#fincost6').val(formatNumber(parseFloat(accounting.unformat($('#rwc_dc').val()))+parseFloat(accounting.unformat($('#rwc_indc').val()))+parseFloat(accounting.unformat($('#rwc_inv').val()))));
}
function deposit_cal()
{
	var rent_dep=0,fd_bank=0,totdep=0;		
	rent_dep = parseFloat(accounting.unformat($('#rent_deposit').val())) ;
	fd_bank = parseFloat(accounting.unformat($('#fd_bank').val()));
	/* if(rent_dep != '' && fd_bank != '')
	{
		
	} */
	totdep= parseFloat(rent_dep)+parseFloat(fd_bank);
	$('#deptot').val(formatNumber(totdep));	
}
function finance_cal()
{
	var findep1=0,findep2=0,findep3=0,findep4=0,findep5=0,findep6=0,findep7=0,findep8=0,findep9=0,findep10=0,findep11=0,findep12=0,findep13=0,findep14=0;
	findep1=accounting.unformat($('#lninves').val());
	findep2=accounting.unformat($('#termloan_interest').val());
	findep3=parseFloat(accounting.unformat($('#lnperannum').val()))*parseFloat(accounting.unformat($('#prodcycle_nom').val()));
	findep4=parseFloat(accounting.unformat($('#aninterest').val()))*parseFloat(accounting.unformat($('#prodcycle_nom').val()));
	findep5=accounting.unformat($('#ancommit').val());
	findep6=accounting.unformat($('#rwc_tot').val());
	findep7=((parseFloat(accounting.unformat($('#rwc_tot').val()))-parseFloat(accounting.unformat($('#fincost13').val())))*90)/100;
	if($('#wc_loan_interest').val() != '')
	{
		findep8 = accounting.unformat($('#wc_loan_interest').val());
	}
	findep9= parseFloat(accounting.unformat($('#aninterest').val()))*parseFloat(accounting.unformat($('#prodcycle_nom').val()));
	findep10=parseFloat(findep6)-parseFloat(findep7);
	findep11=accounting.unformat($('#wagesdc').val());
	if($('#interest_free').val() != '')
	{
		findep12 = accounting.unformat($('#interest_free').val());
	}
	findep13=((parseFloat(findep11)/100)*findep12) ;
	findep14=parseFloat(findep5)+parseFloat(findep9)+parseFloat(findep13);
	
	$('#fincost1').val(formatNumber(findep1));
	$('#fincost2').val(parseFloat(findep2).toFixed(2));
	$('#fincost3').val(formatNumber(findep3));
	$('#fincost4').val(formatNumber(findep4));
	$('#fincost5').val(formatNumber(findep5));
	$('#fincost6').val(formatNumber(findep6));
	$('#fincost7').val(formatNumber(findep7));
	$('#fincost9').val(formatNumber(findep9));
	$('#fincost10').val(formatNumber(findep10));
	$('#fincost11').val(formatNumber(findep11));
	$('#fincost13').val(formatNumber(findep13));
	$('#fincost14').val(formatNumber(findep14));
	$('#summary5').val(formatNumber(findep14));
	
	
}

function sale_mark_cal()
{
	var s1=0,s2=0,s3=0,s4=0,s5=0,tots=0,sc1=0,sc2=0,sc3=0,sc4=0,sc5=0,totsc=0;
	s1=accounting.unformat($('#advertise').val());
	s2=accounting.unformat($('#salesexp').val());
	s3=accounting.unformat($('#r8c2').val());
	s4=accounting.unformat($('#add_incentive').val())*accounting.unformat($('#r1c2').val());
	s5=accounting.unformat($('#add_salesexp').val());
	tots=parseFloat(s1)+parseFloat(s2)+parseFloat(s3)+parseFloat(s4)+parseFloat(s5);
	
	sc1 = accounting.unformat($('#land').val())+accounting.unformat($('#build').val())+accounting.unformat($('#plant').val());
	sc2 = accounting.unformat($('#totdc').val());
	sc3 = accounting.unformat($('#totindc').val());
	sc4 = tots;
	sc5 = accounting.unformat($('#fincost14').val());
	totsc=parseFloat(sc1)+parseFloat(sc2)+parseFloat(sc3)+parseFloat(sc4)+parseFloat(sc5);
	
	$('#smcost1').val(formatNumber(s1));
	$('#smcost2').val(formatNumber(s2));
	$('#smcost3').val(formatNumber(s3));
	$('#smcost4').val(formatNumber(s4));
	$('#smcost5').val(formatNumber(s5));
	$('#smcost6').val(formatNumber(tots));
	
	$('#summary1').val(formatNumber(sc1));
	$('#summary2').val(formatNumber(sc2));
	$('#summary3').val(formatNumber(sc3));
	$('#summary4').val(formatNumber(sc4));
	$('#summary5').val(formatNumber(sc5));
	$('#summary6').val(formatNumber(totsc));
	
	$('#summaryper1').val(((parseFloat(sc1)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper2').val(((parseFloat(sc2)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper3').val(((parseFloat(sc3)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper4').val(((parseFloat(sc4)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper5').val(((parseFloat(sc5)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper6').val(((parseFloat(totsc)/parseFloat(totsc))*100).toFixed(2) + '%');
	
}

function prod_sales_cost_cal()
{	
	var ps1=0,ps2=0,ps3=0;
	ps1=parseFloat(accounting.unformat($('#summary6').val()))/parseFloat(accounting.unformat($('#totprod_wip').val()));
	ps2=parseFloat(ps1)+((parseFloat(ps1)/100)*parseFloat(accounting.unformat($('#profit_margin').val())));
	ps3=parseFloat(ps2)-((parseFloat(ps2)/100)*parseFloat(accounting.unformat($('#sales_discount').val())));
	
	$('#psc1').val(formatNumber(ps1));
	$('#psc2').val(formatNumber(ps1));
	$('#psc4').val(formatNumber(ps2));
	$('#psc6').val(formatNumber(ps3));	
}

function sales_particular_cal()
{	
	var salesp1=0,salesp2=0,salesp3=0,salesp4=0,salesp5=0,salesp6=0,salesp7=0,salesp8=0,salesp9=0,salesp10=0,salesp11=0,salesp12=0,salesp13=0,salesp14=0;
	
	salesp1=parseFloat(accounting.unformat($('#totprod_wip').val()))+parseFloat(accounting.unformat($('#fgnou').val()));
	salesp2=accounting.unformat($('#sales_target').val());
	salesp3=(parseFloat(salesp1)/100)*parseFloat(salesp2);
	salesp4=accounting.unformat($('#sales_achieved').val());
	salesp5=(parseFloat(salesp3)/100)*parseFloat(salesp4);
	salesp6=((parseFloat(salesp5)*4)/100);
	salesp7=((parseFloat(salesp5)*4)/100);
	salesp8=((parseFloat(salesp5)*4)/100);
	salesp9=((parseFloat(salesp5)*2)/100)+((parseFloat(accounting.unformat($('#training').val()))*2)/100);
	salesp10=parseFloat(salesp5)+parseFloat(salesp6)+parseFloat(salesp7)+parseFloat(salesp8)+parseFloat(salesp9);
	if(salesp3 > 0)
	{
		salesp11=(parseFloat(salesp10)/parseFloat(salesp3))*100;
	}
	salesp12=accounting.unformat($('#sales_cash').val());	
	salesp14=(parseFloat(salesp10)/100)*parseFloat(salesp12);
	salesp13=((parseFloat(salesp10) - parseFloat(salesp14))/parseFloat(salesp10))*100;
	salesp15=(parseFloat(salesp10) - parseFloat(salesp14));
	salesp16=accounting.unformat($('#doubtful_crsale').val());
	salesp17=(parseFloat(salesp15)/100)*parseFloat(salesp16);	
	
	$('#salesp1').val(formatNumber(salesp1));
	$('#salesp3').val(formatNumber(salesp3));	
	$('#salesp5').val(formatNumber(salesp5));
	$('#salesp6').val(formatNumber(salesp6));
	$('#salesp7').val(formatNumber(salesp7));
	$('#salesp8').val(formatNumber(salesp8));
	$('#salesp9').val(formatNumber(salesp9));
	$('#salesp10').val(formatNumber(salesp10));
	$('#salesp11').val(formatNumber(salesp11));
	$('#salesp13').val(formatNumber(salesp13));
	$('#salesp14').val(formatNumber(salesp14));
	$('#salesp15').val(formatNumber(salesp15));
	$('#salesp17').val(formatNumber(salesp17));
}

function revenue_cal()
{
	var rev1=0,rev2=0,rev3=0,rev4=0,rev5=0,rev6=0,rev7=0,rev8=0,rev9=0,rev10=0,rev11=0,rev12=0,rev13=0;
	rev1=(parseFloat(accounting.unformat($('#salesp10').val())) * parseFloat(accounting.unformat($('#psc6').val())));
	rev2=(parseFloat(accounting.unformat($('#salesp14').val())) * parseFloat(accounting.unformat($('#psc6').val())));
	rev3=((parseFloat(accounting.unformat($('#salesp15').val())) - parseFloat(accounting.unformat($('#salesp17').val())))*parseFloat(accounting.unformat($('#psc6').val())));
	rev4=(parseFloat(accounting.unformat($('#salesp17').val())) * parseFloat(accounting.unformat($('#psc6').val())));
	rev5=(parseFloat(rev2) + parseFloat(rev3) + parseFloat(rev4));
	rev6=(parseFloat(accounting.unformat($('#summary6').val())) - parseFloat(accounting.unformat($('#summary1').val())));	
	rev7=parseFloat(rev5) - parseFloat(rev6);
	if(parseFloat(rev7)>0)
	{
		rev8=(parseFloat(rev7)/100)*5;
		rev9=(parseFloat(rev7)/100)*95;
	}
	
	rev10=parseFloat(rev4);	
	rev11=(parseFloat(rev10) / parseFloat(rev1))*100;
	rev12=parseFloat(accounting.unformat($('#fincost13').val()));	
	rev13=(parseFloat(rev12) / parseFloat(rev1))*100;	
	
	$('#reven1').val(formatNumber(rev1));$('#reven2').val(formatNumber(rev2));$('#reven3').val(formatNumber(rev3));$('#reven4').val(formatNumber(rev4));$('#reven5').val(formatNumber(rev5));$('#reven6').val(formatNumber(rev6));$('#reven7').val(formatNumber(rev7));$('#reven8').val(formatNumber(rev8));$('#reven9').val(formatNumber(rev9));$('#reven10').val(formatNumber(rev10));$('#reven11').val(parseFloat(rev11).toFixed(2));$('#reven12').val(formatNumber(rev12));$('#reven13').val(parseFloat(rev13).toFixed(2));
	
}


function cashflow_cal()
{
	var cflow1=0,cflow2=0,cflow3=0,cflow4=0,cflow5=0,cflow6=0,cflow7=0,cflow8=0,cflow9=0,cflow10=0,prf_at=0,prf_bt=0;
	cflow1 = accounting.unformat($('#summary2').val());
	cflow2 = accounting.unformat($('#summary3').val());
	cflow3 = accounting.unformat($('#summary4').val());
	cflow4 = accounting.unformat($('#summary5').val());	
	cflow5 = ((accounting.unformat($('#plant').val())/100)*15) + ((accounting.unformat($('#build').val())/100)*3) + ((accounting.unformat($('#furniture').val())/100)*30);
	cflow6 = (accounting.unformat($('#reven1').val())/100)*4;
	
	cflow7 = parseFloat(cflow1) + parseFloat(cflow2) + parseFloat(cflow3) + parseFloat(cflow4) + parseFloat(cflow5) + parseFloat(cflow6);
	
	cflow8 = accounting.unformat($('#reven5').val());
	cflow9 = (parseFloat(cflow8)/100)*5;
	cflow10 = parseFloat(cflow8)+parseFloat(cflow9);	
		
	prf_bt = parseFloat(cflow10) - (parseFloat(cflow1) + parseFloat(cflow2) + parseFloat(cflow3) + parseFloat(cflow4) + parseFloat(cflow5));
	prf_at = parseFloat(cflow10) - parseFloat(cflow7);
	
	$('#cflow1').val(formatNumber(cflow1));$('#cflow2').val(formatNumber(cflow2));$('#cflow3').val(formatNumber(cflow3));$('#cflow4').val(formatNumber(cflow4));$('#cflow5').val(formatNumber(cflow5));$('#cflow6').val(formatNumber(cflow6));$('#cflow7').val(formatNumber(cflow7));$('#cflow8').val(formatNumber(cflow8));$('#cflow9').val(formatNumber(cflow9));$('#cflow10').val(formatNumber(cflow10));
	$('#profitbt').val(formatNumber(prf_bt));
	$('#profitat').val(formatNumber(prf_at));
	if(prf_at > 0)
	{
		$('.v_loss').hide();
		$('.v_profit').show();
	}
	else
	{
		$('.v_loss').show();
		$('.v_profit').hide();
	}
}
/************************* Charts ******************************/


function debt_chart()
{
	if(cursign=='dollar')
	{
		var means = new CanvasJS.Chart("equity_chart", {
			title: {
				text: "DEBT - EQUITY"
			},
			animationEnabled: true,
			legend: {
				verticalAlign: "center",
				horizontalAlign: "left",
				fontSize: 16,
				fontFamily: "Helvetica"
			},
			theme: "light2",
			data: [
			{			
				type: "pie",
				showInLegend: true,
				toolTipContent: "{name}",
				indexLabelFontFamily: "Garamond",
				indexLabelFontSize: 16,
				indexLabelFontColor: "#fff",
				indexLabel: "${y}",
				legendText: "${y} ",
				indexLabelPlacement: "inside",
				dataPoints: [
					{ y: accounting.unformat($('#lninves').val()), name: "DEBT",legendText: "DEBT",exploded: true },
					{ y: accounting.unformat($('#pequ').val()), name: "EQUITY",legendText: "EQUITY",exploded: true }
					
				]
			}
			]
		});
	}
	else
	{
		var means = new CanvasJS.Chart("equity_chart", {
		title: {
			text: "DEBT - EQUITY"
		},
		animationEnabled: true,
		legend: {
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 16,
			fontFamily: "Helvetica"
		},
		theme: "light2",
		data: [
		{			
			type: "pie",
			showInLegend: true,
			toolTipContent: "{name}",
			indexLabelFontFamily: "Garamond",
			indexLabelFontSize: 16,
			indexLabelFontColor: "#fff",
			indexLabel: "₹{y}",
			legendText: "₹{y} ",
			indexLabelPlacement: "inside",
			dataPoints: [
				{ y: accounting.unformat($('#lninves').val()), name: "DEBT",legendText: "DEBT",exploded: true },
				{ y: accounting.unformat($('#pequ').val()), name: "EQUITY",legendText: "EQUITY",exploded: true }
				
			]
		}
		]
	});
	}
	means.render();
}
function profit_chart()
{
	$('.prof_chart').each(function(){
		var id=$(this).attr('id');
		if(cursign=='dollar')
		{
			var profit = new CanvasJS.Chart(id, {
				title: {
					text: "PROFITABILITY"
				},
				animationEnabled: true,
				legend: {
					verticalAlign: "center",
					horizontalAlign: "left",
					fontSize: 16,
					fontFamily: "Helvetica"
				},
				theme: "light2",
				data: [
				{			
					type: "pie",
					showInLegend: true,
					toolTipContent: "{name}",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 16,
					indexLabelFontColor: "#fff",
					indexLabel: "${y}",
					legendText: "${y} ",
					indexLabelPlacement: "inside",
					dataPoints: [
						{ y: accounting.unformat($('#profitbt').val()), name: "BEFORE TAX",legendText: "BEFORE TAX",exploded: true},
						{ y: accounting.unformat($('#profitat').val()), name: "AFTER TAX",legendText: "AFTER TAX" ,exploded: true}					
					]
				}
				]
			});
		}
		else
		{
			var profit = new CanvasJS.Chart(id, {
				title: {
					text: "PROFITABILITY"
				},
				animationEnabled: true,
				legend: {
					verticalAlign: "center",
					horizontalAlign: "left",
					fontSize: 16,
					fontFamily: "Helvetica"
				},
				theme: "light2",
				data: [
				{			
					type: "pie",
					showInLegend: true,
					toolTipContent: "{name}",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 16,
					indexLabelFontColor: "#fff",
					indexLabel: "₹{y}",
					legendText: "₹{y} ",
					indexLabelPlacement: "inside",
					dataPoints: [
						{ y: accounting.unformat($('#profitbt').val()), name: "BEFORE TAX",legendText: "BEFORE TAX",exploded: true},
						{ y: accounting.unformat($('#profitat').val()), name: "AFTER TAX",legendText: "AFTER TAX" ,exploded: true}						
					]
				}
				]
			});
		}
		profit.render();
	});
}
function distri_chart()
{
	var sum1=0;sum2=0;sum3=0;sum4=0;sum5=0;
	sum1=($('#summaryper1').val()).slice(0, ($('#summaryper1').val()).indexOf('%'));
	sum2=($('#summaryper2').val()).slice(0, ($('#summaryper2').val()).indexOf('%'));
	sum3=($('#summaryper3').val()).slice(0, ($('#summaryper3').val()).indexOf('%'));
	sum4=($('#summaryper4').val()).slice(0, ($('#summaryper4').val()).indexOf('%'));
	sum5=($('#summaryper5').val()).slice(0, ($('#summaryper5').val()).indexOf('%'));
	var dischart = new CanvasJS.Chart("distri_chart", {
		title: {
			text: "DISTRIBUTION OF COST"
		},
		animationEnabled: true,
		legend: {
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 16,
			fontFamily: "Helvetica"
		},
		theme: "light2",
		data: [
		{			
			type: "pie",
			showInLegend: true,
			toolTipContent: "{name}",
			indexLabelFontFamily: "Garamond",
			indexLabelFontSize: 16,
			indexLabelFontColor: "#fff",
			indexLabel: "{y} %",
			legendText: "{y} %",
			indexLabelPlacement: "inside",
			dataPoints: [
				{ y: accounting.unformat(sum1), name: "CAPITAL COSTS",legendText: "CAPITAL COSTS",exploded: true},
				{ y: accounting.unformat(sum2), name: "DIRECT COSTS",legendText: "DIRECT COSTS" ,exploded: true},
				{ y: accounting.unformat(sum3), name: "INDIRECT COSTS",legendText: "INDIRECT COSTS",exploded: true },
				{ y: accounting.unformat(sum4), name: "MARKETING COSTS",legendText: "MARKETING COSTS",exploded: true },
				{ y: accounting.unformat(sum5), name: "FINANCIAL COSTS",legendText: "FINANCIAL COSTS",exploded: true }
			]
		}
		]
	});
	dischart.render();
	
}

function prod_cost_chart()
{
	
	var cpu = accounting.unformat($('#cost_perunit').val());	
	if(cursign=='dollar')
	{
		var prod_cost = new CanvasJS.Chart("prodchart", {		
			animationEnabled: true,
			theme: "light2", 
			title:{
				text: "PRODUCTION COST"
			},	
			axisX:{
				labelFontColor:"#FFFFFF"
			},	
			axisY: {
				prefix: "$"				
			},
			data: [{        
				type: "column",  
				showInLegend: true, 
				yValueFormatString: "#,##0.00",
				toolTipContent: "${y}",
				indexLabel: "${y}",
				legendText: "PRODUCTION COST PER UNIT",
				dataPoints: [  
					{ y: parseFloat(cpu), name: "PRODUCTION COST PER UNIT" }				
				]
			}]
		});
	}
	else
	{
		var prod_cost = new CanvasJS.Chart("prodchart", {		
			animationEnabled: true,
			theme: "light2", 
			title:{
				text: "PRODUCTION COST"
			},	
			axisX:{
				labelFontColor:"#FFFFFF"
			},	
			axisY: {				
				prefix:"₹"		
			},
			data: [{        
				type: "column",  
				showInLegend: true, 
				yValueFormatString: "#,##0.00",
				toolTipContent: "₹{y}",
				indexLabel: "₹{y}",
				legendText: "PRODUCTION COST PER UNIT",
				dataPoints: [  
					{ y: parseFloat(cpu), name: "PRODUCTION COST PER UNIT" }				
				]
			}]
		});
	}
	prod_cost.render();
}


function proj_chart()
{
	if(cursign=='dollar')
	{
		var proj_cost = new CanvasJS.Chart("barchart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: "Project Cost"
			},
			axisY: {				
				prefix: "$"				
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "${y}",			
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}
			]
		});
	}
	else
	{
		
		var proj_cost = new CanvasJS.Chart("barchart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: "Project Cost"
			},
			axisY: {				
				prefix:"₹"		
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "₹{y}",			
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}
			]
		});
	}
	
	proj_cost.render();
}

function req_work_capital_chart()
{
	var cursign=localStorage.getItem('cursign');
	if(cursign=='dollar')
	{
		var req_work = new CanvasJS.Chart("rwc_chart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: ""
			},
			axisY: {				
				prefix: "$"				
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "${y}",	
				dataPoints: [
					{ y: parseFloat(accounting.unformat($('#rwc_dc').val())), label: "Direct Costs"},
					{ y: parseFloat(accounting.unformat($('#rwc_indc').val())), label: "Indirect Costs"},
					{ y: parseFloat(accounting.unformat($('#rwc_inv').val())), label: "Inventory Costs"}
				]
			}
			]
		});
	}
	else
	{
		var req_work = new CanvasJS.Chart("rwc_chart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: ""
			},
			axisY: {				
				prefix:"₹"		
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "₹{y}",
				dataPoints: [
						{ y: parseFloat(accounting.unformat($('#rwc_dc').val())), label: "Direct Costs"},
						{ y: parseFloat(accounting.unformat($('#rwc_indc').val())), label: "Indirect Costs"},
						{ y: parseFloat(accounting.unformat($('#rwc_inv').val())), label: "Inventory Costs"}
					]
			}
			]
		});
	}	
	req_work.render();
}

// When the browser is ready...
$(function() { 
	calc_2();
	calc();
	calc_2();	
	prod_cost_cal(); manpower_cal(); inventory_cal(); directcost_cal();indirectcost_cal();finance_cal();req_working_capital();sale_mark_cal();distri_chart();prod_sales_cost_cal();sales_particular_cal();revenue_cal();cashflow_cal();
	proj_chart(); debt_chart();prod_cost_chart();profit_chart();req_work_capital_chart();	
});  


</script>
</html>