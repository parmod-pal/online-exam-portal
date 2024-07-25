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
/* if(isset($_SESSION['lgtype']) == 1) 
{
	header('location:index.php');
	exit;
} */
$expdate=$expdat='';
$curdate=strtotime(date('Y-m-d H:i:s'));
/*$teamdet=select("select expiry from userdet where id='".$_SESSION['rim_userid']."'"); 			
if($teamdet != '' && $teamdet[0] != false)
{	
	foreach($teamdet as $tm => $data)
	{
		$expdat=$data['expiry'];
		$expdate=strtotime($data['expiry']);
	}
}
*/
$expdat= date('Y-m-d H:i:s',strtotime('+3 hours'));
/* if($expdate < $curdate)
{
	// redirect to payment gateway
	?>
	<script>
		alert('Sorry! Session Expired. Pay and Start Again.');
		window.location.href="myprofile.php";
	</script>
	<?php
	//header('location:myprofile.php');
}  */
$cur_sign='rupee';
if(isset($_SESSION['currency'])) 
{
	$cur_sign=$_SESSION['currency'];
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
if($_SESSION['rim_userid'] !='')
{
	/***** Basic Parameters ******************************************/
	
	$teamdet=select("select * from basicinfo where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
	if($teamdet != '' && $teamdet[0] != false)
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
	$licensingfee=($approxcost/100)*5;	
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
			$der = number_format(($lninves/$eqinves),2,'.','');
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
	$proddet=select("select * from prodinfo where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
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
		$mdet=select("select * from manpowerdet where userid='".$_SESSION['rim_userid']."' and category='".$cat."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
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
	$invendet=select("select * from inventory where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
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
	$dcdet=select("select * from directcost where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
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
	$indcdet=select("select * from indirectcost where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
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
	$fincostdet=select("select * from 	finance_deposit_investment where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
	if($fincostdet != false && $fincostdet[0] != '')
	{	
		foreach($fincostdet as $tm => $fcd)
		{				
			$wc_loan_interest=$fcd['wc_loan_interest'];
			$interest_free=$fcd['interest_free'];
			$fd_bank=$fcd['fd_bank'];			
		}			
	}
	$deptot=$fd_bank+($godown*20);	
	
	/****************** Particulars of Product & Sales Cost Details **********************/
	
	$profit_margin=$sales_discount=0;
	$pdsdet=select("select profit_margin, sales_discount from prod_sales_cost where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
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
	$salesdet=select("select * from salesparticular where userid='".$_SESSION['rim_userid']."' and payment_id='".$_SESSION['payid']."' order by id desc limit 1"); 			
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
<?php include 'common/header.php';include 'common/topnav.php';?>	
	<div class="maincontent">
		<div class="container">
			<div>
				<h2 class="main-head">My Business - My Strategies<sup>&copy;</sup></h2>
				<p class="head-title">AN EXPERIENTIAL BUSINESS SIMULATION GAME</p>
			</div>
			<div class="col-md-3" id="timecount"> </div>
			<div class="col-md-push-6 col-md-3" id="tlinks"><a href="#myModal" class="btn btn-white" data-toggle="modal">TIPS</a><a class="btn btn-white" href="#myModal1" data-toggle="modal">Lincenses</a><a class="btn btn-white" href="#myModal2" data-toggle="modal">Definitions</a></div>
			<div class="clearfix"></div>
			<hr/>
			<div id="tab0">
			<ul class="alert-info instruc"><li>
			This game helps you understand the nuances of  "Business."</li><li>
Experience running your business in your own way, and build your own strategies to success. Learn about the parameters that are critical in "Business."</li><li>
The game gives you an engaging experience, closest to reality.</li><li>
Learn the easy way various parameters that impact business and how they are inter-related.</li><li>
There are certain factors that you have control upon in business environment. The game helps you know which are these parameters, and how do they impact profitability.</li><li>
Every time you change a parameter get instant feedback on the impact on profitability.</li><li>
You have 3 hours to play this simulation game, and thereafter you need to log-in afresh.</li>
<li>Before you start the game, read the following tips</li></ul>
<div class="alert-info instruc">
						<h3>TIPS - I</h3>
						<ol class="instruc">
							<li>Estimation of the Project Cost is quite a technical process. </li>
							<li>To start with, survey the market &amp; arrive at an approximate cost of the project. </li>
							<li>Enter the figure in the appropriate cell. As you go by, you can refine the figure.</li>
							<li>The other parameters of the Project Cost, get automatically calculated.</li>
							<li>But, you can over-ride the figures as they are in the yellow colored cells.</li>
							<li>It's good to provide for "interest during implementation" as it does not financially strain the project implementation.  Normally it's for 3 quarters.</li>
							<li>Working capital margin (10% of the required working capital) is included as part of the project cost, and is covered by the term-loan subject to promoter's margin.</li>
						</ol>
						<h3>TIPS - II</h3>
						<ol class="instruc">
							<li>Promoter's stake in the project is vital.</li>
							<li>Higher the promoter's stake, less is the burden on the project.</li>						
						</ol>
						<h3>TIPS - III</h3>
						<ol class="instruc">
							<li>Financial Institutions normally prefer a lower debt-equity.</li>
							<li>The more the debt, more will be the interest cost. </li>
							<li>A debt-equity of 1:1 is preferred.  But, banks do go up to 2:1.</li>
							<li>However, DER  of 1:1, though is project friendly, loads the  financials of the promoter.</li>
							<li>A term loan is normally for 3 to 5 years.  However, some projects with longer gestation-period do call for longer repayment period.</li>							
						</ol>
						<h3>TIPS - IV</h3>
						<ol class="instruc">
							<li>Market Potential normally determines the Plant Capacity.</li>
							<li>Gap in the Demand and Supply is normally the Guiding Factor.</li>
							<li>Actual Capacity Utilization could be any figure as determined by you.</li>
							<li>Production Cycle is the time taken to produce the product from the stage of raw-material to  finished product. Shorter the cycle-period, better it is.</li>
							<li>Higher the Capacity Utilization, lower will be the production cost.</li>
							<li>Look at the overall impact of Capacity Utilization on other parameters & profitability. Alter the figure accordingly.</li>							
						</ol>
						<h3>TIPS - V</h3>
						<ol class="instruc">
							<li>Capacity Utilization & Production Cost are Inversely Proportional.</li>
						</ol>
						<h3>TIPS - VI</h3>
						<ol class="instruc">
							<li>Manpower is an important element of a project.</li>
							<li>However, it's the skilled manpower that yields revenue.</li>
							<li>Cut-down non-skilled and admin staff as much as possible.</li>
							<li>Managerial/Supervisory staff too should be just adequate.</li>
						</ol>
						<h3>TIPS - VII</h3>
						<ol class="instruc">
							<li>Inventory is another name for locked-up revenue. Therefore, ensure that inventory is carefully managed.</li>
							<li>Inventory calls for three kinds of costs, first raw-material, second, value addition cost  for partially completed products, i.e., Work-In-Progress, and finally, costs towards warehouse, expenses, and manpower costs to manage inventory. </li>
							<li>Avoid over-stocking of raw material. A good rule of thumb is to stock covering one production cycle. Utilize market credit on purchase of raw material.</li>
							<li>WIP is linked to capacity utilization. Higher WIP in stock is not healthy. Because, WIP has raw-material cost plus partial conversion costs as well.</li>
							<li>Inventory of finished goods is the costliest of all. Therefore, avoid it.</li>
						</ol>
						<h3>TIPS - VIII</h3>
						<ol class="instruc">
							<li>Raw material cost is directly linked to capacity utilization.  However, ensure control on this vital cost head.</li>
							<li>Avoid over-stocking of raw material.  A good rule of thumb is to stock covering one production-cycle. Fully utilize the available market credit on purchase of raw material as it is generally interest free.</li>
							<li>Unlike salaries for admin and unskilled staff, wages to skilled personnel is productive.</li>
							<li>Training skilled personnel is good as it helps in enhancing their productivity.</li>
							<li>Minimize fixed costs, because, immaterial of the capacity utilization, fixed costs remain constant.</li>
						</ol>
						<h3>TIPS - IX</h3>
						<ol class="instruc">
							<li>While capital costs can be likened to "anatomy," working capital is similar to "physiology."  Without working capital, a unit is as good as dead.</li>
							<li>Institutional working capital loans carry higher costs than market credit. Therefore, if market credit is available, avail it.  But, be prompt in repaying, as default erodes the financial creditbility of the firm.</li>
							<li>Working capital loans carry higher interest rates as compared to term loans.  Therefore, higher promoter's stake in the working capital is good, as the financial burden on the firm is less.</li>
							<li>Technically, working capital loan is never repaid.  It is always serviced.  It's the interest portion that is serviced.  Working capital loan is a financial limit or an open-credit limit, and the quantum is dependent on the quantum of production and the anticipated sales turnover.</li>
						</ol>
						<h3>TIPS - X</h3>
						<ol class="instruc">
							<li>1. Incurring expenses on marketing & sales is vital to an enterprise. However, marketing costs and 	sales are not entirely directly proportional. Up to a point, marketing expenses increase sales volume, 	but beyond a point, the relationship is in-elastic.	</li>
							<li> Generally, incentive to sales personnel yields better sales turnover than, more than required expenses	on sales promotion.</li>
						</ol>
						<h3>TIPS - XI</h3>
						<ol class="instruc">
							<li>An ideal recipe for profitability is cost control.  Lower the costs, higher is the revenue.  Therefore, ensure that costs are carefully monitored and minimized; particularly the indirect costs.</li>
							<li>Marketing costs do not have relationship with capacity utilization, unlike direct costs.Therefore, maximize capacity-utilization, as it directly impacts product cost which in turn positively impacts sales and other financial parameters.</li>
							<li>Financial costs can be reduced by reducing the borrowings.  Higher promoter's stake, takes out the financial sting on the project.</li>
						</ol>
						<h3>TIPS - XII</h3>
						<ol class="instruc">
							<li>In Business, there is no profit, but only costs. Therefore, ensure costs are minimized as much as possible. Although, this tip is a repetition, it's worth repeating it, as it's the heart of business.</li>
							<li>Break-even point is kind of a null-point. At the break-even point, costs and revenue equal each other. This is a critical reference point in business.</li>
							<li>While determining the profit margin, go by the industry standard for reference.</li>
							<li>Go by the industry average while offering sales discount. While it may marginally increase the sales, it reduces the revenue. It's a trade-off decision.</li>
							<li>Additional sales incentive, product improvement, sales promotion do increase the sales; but, marginally. It's a trade-off between increase in costs and increase in sales.</li>
							<li>Cash sales are always better.  Therefore, go for it.</li>
							<li>Be wary of credit sales.  Apart from credit sales going bad, it carries higher collection charges. Do note, credit unrealized is loss of revenue.</li>
							<li>Ensure that credit sales do not go bad. Try to keep this as low as possible.  </li>
						</ol>
						<h3>TIPS - XIII</h3>
						<ol class="instruc">
							<li>Avoid sundry debtors as much as possible.  If it is inevitable minimize it.  Because, on the one hand an enterprise may incur cash loss, and on the other, the enterprise carries high sundry debtors, which if monetized, will avoid cash loss.</li>
							<li>While sundry creditors may provide some cushion, it is important that it is promptly serviced, if not, the rating of the enterprise in the market may decline.  The reputation of the firm too suffers in the market.</li>
						</ol>
						<h3>TIPS - XIV</h3>
						<ol class="instruc">
							<li>Every transaction of an enterprise gets reflected in the cash-flows. Be it in the form of cash-inflow or cash-outflow.</li>
						</ol>
						<h3 class="text-center">NOW YOU CAN STRAT THE GAME</h3>
</div><br/>

				<div class="col-sm-12">						
					<div class="col-md-push-5 col-xs-push-5 col-xs-2">						
						<button type="button" name="submit" id="nxt0" class="btn btn-primary">Start</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			<div id="tab1">		
				<h3 class="title" id="t1">Project Basic Details</h3>
				<form action="" method="post" name="reg" id="reg">
					<input type="hidden" name="tbl" value="basicinfo">
					<input type="hidden" name="currency" value="<?php echo $cur_sign;?>">
					<div class="">	
						<div class="col-md-5 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label">Name of Your Firm *</label>
								<input type="text" class="form-control reqtext" id="username" name="username" value="<?php echo $fname;?>" required>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">Your Specialization *</label>
								<input type="text" class="form-control reqtext" id="profession" value="<?php echo $prof;?>" name="profession" required>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">What do you want to setup? *</label>				
								<div class="col-sm-12">
									<div class="col-md-6">									
										<input type="radio" name="industry_type" id="manu" <?php echo $setup == 'Manufacturing'?'checked':'';?> class="industry_type" value="Manufacturing" >
										<label for="manu" >Manufacturing</label>
									</div>
									<div class="col-md-6">									
										<input type="radio" name="industry_type" <?php echo $setup == 'Data Center'?'checked':'';?> id="dcenter" class="industry_type" value="Data Center" >
										<label for="dcenter" >Data Center</label>
									</div>	
								</div><br/>
								<div class="col-sm-12">	
									<div class="col-md-6">	
										<input type="radio" name="industry_type" id="tech" <?php echo $setup == 'Technology'?'checked':'';?> class="industry_type" value="Technology">
										<label for="tech">Technology</label>								
									</div>
									<div class="col-md-6">	
										<input type="radio" name="industry_type" <?php echo $setup == 'Services'?'checked':'';?> id="services" class="industry_type" value="Services">
										<label for="services">Services</label>								
									</div>																
								</div>
							</div>
						</div>
						<div class="col-md-1 col-sm-12 col-xs-12"></div>
						<div class="col-md-5 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label">Proposed size for your business *</label>
								<div class="col-sm-12">
									<div class="col-md-6">									
										<input type="radio" name="proposed_size" id="tiny" <?php echo $psize == 'Tiny'?'checked':'';?> class="proposed_size" value="Tiny" >
										<label for="tiny">Tiny</label>
									</div>
									<div class="col-md-6">									
										<input type="radio" name="proposed_size" <?php echo $psize == 'Small'?'checked':'';?> id="small" class="proposed_size" value="Small" >
										<label for="small">Small</label>
									</div>	
								</div><br/>
								<div class="col-sm-12">
									<div class="col-md-6">	
										<input type="radio" name="proposed_size" <?php echo $psize == 'Medium'?'checked':'';?> id="medium" class="proposed_size" value="Medium">
										<label for="medium">Medium</label>								
									</div>
									<div class="col-md-6">	
										<input type="radio" name="proposed_size" <?php echo $psize == 'Large'?'checked':'';?> id="large" class="proposed_size" value="Large">
										<label for="large">Large</label>								
									</div>																
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">Proposed activity *</label>
								<input type="text" class="form-control reqtext" id="proposed_activity" value="<?php echo $pactivity;?>" name="proposed_activity" required>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="control-label">Constitution *</label>
								<div class="col-sm-12">
									<div class="col-md-6">									
										<input type="radio" name="constitution" id="proprietary" <?php echo $constitution == 'Proprietary'?'checked':'';?> class="constitution" value="Proprietary" >
										<label for="proprietary">Proprietary</label>
									</div>
									<div class="col-md-6">									
										<input type="radio" name="constitution" id="partnership" <?php echo $constitution == 'Partnership'?'checked':'';?> class="constitution" value="Partnership" >
										<label for="partnership">Partnership</label>
									</div>		
								</div><br/>
								<div class="col-sm-12">							
									<div class="col-md-6">	
										<input type="radio" name="constitution" id="private" <?php echo $constitution == 'Private Limited'?'checked':'';?> class="constitution" value="Private Limited">
										<label for="private">Private Limited</label>								
									</div>
									<div class="col-md-6">	
										<input type="radio" name="constitution" id="public" <?php echo $constitution == 'Public Limited'?'checked':'';?> class="constitution" value="Public Limited">
										<label for="public">Public Limited</label>								
									</div>																
								</div>
							</div>					
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">Describe the product that you intend manufacturing or trading *</label>
							<textarea class="form-control reqtext" id="manufacture_details" name="manufacture_details" ><?php echo $trade;?></textarea>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">What are the raw materials needed and how do you mobilize? *</label>
							<textarea class="form-control reqtext" id="rawmaterial_details" name="rawmaterial_details" ><?php echo $raw;?></textarea>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">What is the marketing/sales strategy?  *</label>
							<textarea class="form-control reqtext" id="sales_strategy" name="sales_strategy" ><?php echo $sales;?></textarea>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">What is the manufacturing process? *</label>
							<textarea class="form-control reqtext" id="manufacture_process" name="manufacture_process" required ><?php echo $manuprocess;?></textarea>
						</div>
					</div>
					<div class="col-sm-12">						
						
						<div class="col-md-6 col-xs-2">
							<button type="button" name="submit" id="prev0" class="btn btn-primary">Prev</button>
						</div>
						<div class="col-md-push-5 col-xs-push-7 col-xs-2">
							<button type="button" name="submit" id="nxt1" class="btn btn-primary">Next</button>
						</div>
						
						<!-- /.col -->
					</div>
				</form>	
			</div>	
			<div id="tab2">
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
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr>
							<td><strong>Approximate Project Cost *</strong></td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?> reqtext" value="<?php echo moneyFormatIndia($approxcost);?>"  form="cost" id="estimate_cost" name="estimate_cost" required></td>
							<td><strong>Rule of Thumb</strong></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Land</td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="land" value="<?php echo moneyFormatIndia($land);?>" form="cost" name="land"></td>
							<td>10% of PC</td>
						</tr>
						<tr>
							<td>02. Building Cost</td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="build" value="<?php echo moneyFormatIndia($build);?>" form="cost" name="build"></td>
							<td>15% of PC</td>
						</tr>
						<tr>
							<td>03. Plant &amp; Machinery</td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="plant" value="<?php echo moneyFormatIndia($plant);?>" form="cost" name="plant"></td>
							<td>30% of PC</td>
						</tr>
						<tr>
							<td>04. Furniture &amp; Fittings</td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="furniture"  value="<?php echo moneyFormatIndia($furni);?>" form="cost" name="furniture"></td>
							<td>5% of PC</td>
						</tr>
						<tr>
							<td>05. Preliminary Expenses</td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="preexp" value="<?php echo moneyFormatIndia($pexp);?>" form="cost" name="preexp"></td>
							<td>5% of PC</td>
						</tr>
						<tr>
							<td>06. Fee For Technical Know-How </td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="techfee" value="<?php echo moneyFormatIndia($tech);?>" form="cost" name="techfee"></td>
							<td>8% of PC</td>
						</tr>
						<tr>
							<td>07. Start-Up Expenses</td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="sexp" value="<?php echo moneyFormatIndia($sexp);?>" form="cost" name="sexp"></td>
							<td>6% of PC</td>
						</tr>
						<tr>
							<td>08. R &amp; D / Innovation</td>
							<td><input type="text" class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="rd" value="<?php echo moneyFormatIndia($rd);?>" form="cost" name="rd"></td>
							<td>6% of PC</td>
						</tr>
						<tr>
							<td>09. Interest During Implementation</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="interest" readonly value="<?php echo moneyFormatIndia($intamt);?>" name="interest"></td>
							<td>For 3 Quarters</td>
						</tr>
						<tr>
							<td>10. Working Capital Margin</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="cmargin" value="<?php echo moneyFormatIndia($cmargin);?>" readonly name="cmargin"></td>
							<td>10% of PC</td>
						</tr>
						<tr>
							<td>11. Royalty/Licensing Fee *</td>
							<td><input type="text"  class="form-control numeric apc <?php echo $cur_sign;?> reqtext" id="licensing_fee" form="cost"  value="<?php echo moneyFormatIndia($licensingfee);?>" name="licensing_fee"></td>
							<td>5% of PC</td>
						</tr>
						<tr>
							<td><strong>Total Project Cost</strong></td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="tot" name="tot" value="<?php echo moneyFormatIndia($totpc);?>"readonly ></td>
							<td></td>
						</tr>
					</table>
					</div>
				</div>
				<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-5 col-sm-12 col-xs-12 table-responsive" id="barchart" style="padding-top:30px;">
				
				
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev1" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt2" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab3">
				<h3 class="title" id="t3">Promoter's Stack in the Project</h3>			
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="mfin" id="mfin">
						<input type="hidden" name="tbl" value="basicinfo">
					</form>
					<div class="table-responsive">
					<table class="table table-stripped">					
						<tr>
							<td>01. Promoter's Equity in % of Project Cost *</td>
							<td width="200"><input type="text" class="form-control numeric percentage reqtext" id="promoter_stake" form="mfin" value="<?php echo moneyFormatIndia($promoterstake);?>" name="promoter_stake"></td>
						</tr>
						<tr>
							<td>02. Promoter's Equity</td>
							<td width="200"><input type="text" class="form-control <?php echo $cur_sign;?>" id="pequ" value="<?php echo moneyFormatIndia($pequ);?>" readonly name="pequ"></td>
						</tr>						
					</table>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
				
				</div>				
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">
				<h3 class="title">Means of Finance</h3>		
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-responsive">				
					<table class="table table-stripped">
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
								<td width="200" ><input type="text" class="form-control numeric reqtext" id="termloan_nom" form="mfin" value="<?php echo moneyFormatIndia($lnnom);?>" name="termloan_nom"></td>								
							</tr>
							<tr>
								<td>05. Principal Repayment of Term Loan Per Annum</td>
								<td width="200" ><input type="text" class="form-control <?php echo $cur_sign;?>" id="lnperannum" value="<?php echo moneyFormatIndia($lnperannum);?>" readonly name="lnperannum"></td>	
								<td></td>
								<td></td>								
							</tr>
							<tr>
								<td>06. Interest On Term Loan *</td>
								<td width="200" ><input type="text" class="form-control numeric percentage reqtext" id="termloan_interest" value="<?php echo moneyFormatIndia($interest);?>" form="mfin" name="termloan_interest"></td>
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
					</table>
					</div>
					</div>
					
				</div>	
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">
					<div class="col-md-3 col-sm-12 col-xs-12"></div>
					<div class="col-md-6 col-sm-12 col-xs-12 table-responsive" id="equity_chart">
					
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12"></div>				
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev2" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt3" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			
			
			</div>
			
			<div id="tab4">
				<h3 class="title" id="t4">Production &amp; Production Costs</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="prodparam" id="prodparam"  autocomplete="off">
						<input type="hidden" name="tbl" value="prodinfo">
					</form>
					<?php	
					$datapts = array(
						array("y" => 0, "label" => ""),
						array("y" => number_format($prod13,2,'.',''), "label" => "")						
					);
					
				?>		
				<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Installed Capacity Per Production Cycle *</td>
							<td><input type="text" class="form-control numeric reqtext" id="installed_capacity" form="prodparam" value="<?php echo moneyFormatIndia($prod1);?>" required name="installed_capacity"></td>
						</tr>
						<tr>
							<td>02. Projected Capacity Utilization in % *</td>
							<td><input type="text" class="form-control numeric percentage reqtext" id="capacity_utiliz" form="prodparam" value="<?php echo moneyFormatIndia($prod2);?>" required name="capacity_utiliz"></td>
						</tr>
						<tr>
							<td>03. No. of Days Per Production Cycle *</td>
							<td><input type="text" class="form-control numeric reqtext" id="nofday_perprod" form="prodparam" value="<?php echo moneyFormatIndia($prod3);?>" required name="nofday_perprod"></td>
						</tr>
						<tr>
							<td>04. Production Cycle in Number of Months</td>
							<td><input type="text" class="form-control" id="prodcycle_nom" readonly value="<?php echo moneyFormatIndia($prod4);?>" name="prodcycle_nom"></td>
						</tr>
						<tr>
							<td>05. No. of Production Cycle/s Per Annum</td>
							<td><input type="text" class="form-control" id="nop_perannum" value="<?php echo moneyFormatIndia($prod5);?>" readonly name="nop_perannum"></td>
						</tr>
						<tr>
							<td>06. Units Produced in the Current Production Cycle </td>
							<td><input type="text" class="form-control" id="up_cprodcyle" value="<?php echo moneyFormatIndia($prod6);?>" readonly name="up_cprodcyle"></td>
						</tr>
						<tr>
							<td>07. % of Work-In-Progress (Opening Stock) *</td>
							<td><input type="text" class="form-control numeric percentage reqtext" id="work_in_progress" form="prodparam" value="<?php echo moneyFormatIndia($prod7);?>" required name="work_in_progress"></td>
						</tr>
						<tr>
							<td>08. WIP in No. of Units (Opening Stock)</td>
							<td><input type="text" class="form-control" id="wip_nou" value="<?php echo moneyFormatIndia($prod8);?>" readonly name="wip_nou"></td>
						</tr>
						<tr>
							<td>09. % of Finished Product Out of WIP *</td>
							<td><input type="text" class="form-control numeric percentage reqtext" form="prodparam" id="finishedprod_wip" required value="<?php echo moneyFormatIndia($prod9);?>" name="finishedprod_wip"></td>
						</tr>
						<tr>
							<td>10. No. of Units Produced out of WIP Per Cycle</td>
							<td><input type="text" class="form-control" id="nouproduced" value="<?php echo moneyFormatIndia($prod10);?>" readonly name="nouproduced"></td>
						</tr>
						<tr>
							<td>11. Total Production (Inclusive of Production out of WIP)</td>
							<td><input type="text" class="form-control" id="totprod_wip" readonly value="<?php echo moneyFormatIndia($prod11);?>" name="totprod_wip"></td>
						</tr>
						<tr>
							<td>12. Direct Cost</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="directcost" name="directcost" value="<?php echo moneyFormatIndia($prod12);?>" readonly ></td>
						</tr>
						<tr>
							<td>13. Production Cost Per Unit</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="cost_perunit"  value="<?php echo moneyFormatIndia($prod13);?>" readonly name="cost_perunit"></td>
						</tr>
					</table>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart table-responsive" id="pp_profchart"></div>
					<div class="hr-line-dashed"></div>
					<div id="prodchart" class="table-responsive"></div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev3" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt4" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab5">
				<h3 class="title" id="t5">Manpower Particulars &amp; Costs</h3>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<form action="" method="post" name="manpower" id="manpower"  autocomplete="off">
						<input type="hidden" name="tbl" value="manpowerdet">
					</form>
					<div class="table-responsive">
					<table class="table table-stripped">
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
							<td><input type="text" class="form-control rows numeric reqtext" data-cate="Managerial Personnel" id="r1c1" form="manpower" value="<?php echo moneyFormatIndia($r1c1);?>" required name="r1c1"></td>
							<td><input type="text" class="form-control rows numeric reqtext" data-cate="Sales Personnel" id="r1c2" form="manpower" value="<?php echo moneyFormatIndia($r1c2);?>" required name="r1c2"></td>
							<td><input type="text" class="form-control rows numeric reqtext" data-cate="Admin Staff" id="r1c3" form="manpower" value="<?php echo moneyFormatIndia($r1c3);?>" required name="r1c3"></td>
							<td><input type="text" class="form-control rows numeric reqtext" data-cate="Skilled Personnel" id="r1c4" form="manpower" value="<?php echo moneyFormatIndia($r1c4);?>" required name="r1c4"></td>
							<td><input type="text" class="form-control rows numeric reqtext" data-cate="Unskilled Personnel" id="r1c5" form="manpower" value="<?php echo moneyFormatIndia($r1c5);?>" required name="r1c5"></td>
							<td><input type="text" class="form-control rows numeric"  id="r1c6" form="manpower" value="<?php echo '';?>" readonly name="r1c6"></td>
						</tr>
						<tr>
							<td>Monthly Salary Per Employee *</td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r2c1" form="manpower" value="<?php echo moneyFormatIndia($r2c1);?>" required name="r2c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r2c2" form="manpower" value="<?php echo moneyFormatIndia($r2c2);?>" required name="r2c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r2c3" form="manpower" value="<?php echo moneyFormatIndia($r2c3);?>" required name="r2c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r2c4" form="manpower" value="<?php echo moneyFormatIndia($r2c4);?>" required name="r2c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r2c5" form="manpower" value="<?php echo moneyFormatIndia($r2c5);?>" required name="r2c5"></td>
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
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r5c1" form="manpower" value="<?php echo moneyFormatIndia($r5c1);?>" required name="r5c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r5c2" form="manpower" value="<?php echo moneyFormatIndia($r5c2);?>" required name="r5c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r5c3" form="manpower" value="<?php echo moneyFormatIndia($r5c3);?>" required name="r5c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r5c4" form="manpower" value="<?php echo moneyFormatIndia($r5c4);?>" required name="r5c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r5c5" form="manpower" value="<?php echo moneyFormatIndia($r5c5);?>" required name="r5c5"></td>
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
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r7c1" form="manpower" value="<?php echo moneyFormatIndia($r7c1);?>" required name="r7c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r7c2" form="manpower" value="<?php echo moneyFormatIndia($r7c2);?>" required name="r7c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r7c3" form="manpower" value="<?php echo moneyFormatIndia($r7c3);?>" required name="r7c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r7c4" form="manpower" value="<?php echo moneyFormatIndia($r7c4);?>" required name="r7c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r7c5" form="manpower" value="<?php echo moneyFormatIndia($r7c5);?>" required name="r7c5"></td>
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
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r9c1" form="manpower" value="<?php echo moneyFormatIndia($r9c1);?>" required name="r9c1"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r9c2" form="manpower" value="<?php echo moneyFormatIndia($r9c2);?>" required name="r9c2"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r9c3" form="manpower" value="<?php echo moneyFormatIndia($r9c3);?>" required name="r9c3"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r9c4" form="manpower" value="<?php echo moneyFormatIndia($r9c4);?>" required name="r9c4"></td>
							<td><input type="text" class="form-control rows numeric <?php echo $cur_sign;?> reqtext" id="r9c5" form="manpower" value="<?php echo moneyFormatIndia($r9c5);?>" required name="r9c5"></td>
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
					</table>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12"></div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev4" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt5" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
		
			<div id="tab6">
				<h3 class="title" id="t6">Inventory</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="inventory" id="inventory"  autocomplete="off">
						<input type="hidden" name="tbl" value="inventory">
					</form>
				<div class="table-responsive">					
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. % of Raw Material in Stock (As % of Installed Capacity) *</td>
							<td><input type="text" class="form-control numeric percentage reqtext" id="rawmaterial" form="inventory" value="<?php echo moneyFormatIndia($rawmaterial);?>" required name="rawmaterial"></td>
						</tr>
						<tr>
							<td>02. Raw Material in Stock for No. of Units</td>
							<td><input type="text" class="form-control numeric" id="rmnou" value="<?php echo moneyFormatIndia($rmnou);?>" readonly name="rmnou"></td>
						</tr>
						<tr>
							<td>03. Cost of Raw Material in Stock</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="crm" value="<?php echo moneyFormatIndia($crm);?>" readonly name="crm"></td>
						</tr>
						<tr>
							<td>04. % of Finished Goods in Stock (As % of Installed Capacity) *</td>
							<td><input type="text" class="form-control percentage reqtext" id="finishedgoods" required value="<?php echo moneyFormatIndia($fgoods);?>" form="inventory" name="finishedgoods"></td>
						</tr>
						<tr>
							<td>05. Finished Goods in Stock in No. of Units</td>
							<td><input type="text" class="form-control" id="fgnou" value="<?php echo moneyFormatIndia($fgnou);?>" readonly name="fgnou"></td>
						</tr>
						<tr>
							<td>06. Cost of Finished Goods in Stock </td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="cfg" value="<?php echo moneyFormatIndia($cfg);?>" readonly name="cfg"></td>
						</tr>
						<tr>
							<td>07. Total Inventory Cost</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="totinvcost" value="<?php echo moneyFormatIndia($totinvcost);?>" readonly name="totinvcost"></td>
						</tr>						
					</table>
				</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart table-responsive" id="inv_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev5" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt6" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			
			<div id="tab7">
				<h3 class="title" id="t7">Direct Costs Per Production Cycle</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="dcfrm" id="dcfrm"  autocomplete="off">
						<input type="hidden" name="tbl" value="directcost">
					</form>		
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><th>Direct Costs - Heads of Account</th><th>Costs</th></tr>
						<tr>
							<td>01. Raw Material</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rmdc" value="<?php echo moneyFormatIndia($rmdc);?>" readonly name="rmdc"></td>
						</tr>
						<tr>
							<td>02. Wages For Production Staff</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="wagesdc" value="<?php echo moneyFormatIndia($wagesdc);?>" readonly name="wagesdc"></td>
						</tr>
						<tr>
							<td>03. Performance Incentive For Production Staff</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="pidc" value="<?php echo moneyFormatIndia($pidc);?>" readonly name="pidc"></td>
						</tr>
						<tr>
							<td>04. Welfare Costs For Production Staff</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="welfaredc" readonly value="<?php echo moneyFormatIndia($welfaredc);?>" name="welfaredc"></td>
						</tr>
						<tr>
							<td>05. Bonus For Production Staff</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="bonusdc" value="<?php echo moneyFormatIndia($bonusdc);?>" readonly name="bonusdc"></td>
						</tr>
						<tr>
							<td>06. Power Charges *</td>
							<td><input type="text" class="form-control numeric dc <?php echo $cur_sign;?> reqtext" form="dcfrm" id="power" value="<?php echo moneyFormatIndia($power);?>" required name="power"></td>
						</tr>
						<tr>
							<td>07. Water Charges *</td>
							<td><input type="text" class="form-control numeric dc <?php echo $cur_sign;?> reqtext" id="water" form="dcfrm" value="<?php echo moneyFormatIndia($water);?>" required name="water"></td>
						</tr>
						<tr>
							<td>08. Training of Skilled Personnel *</td>
							<td><input type="text" class="form-control numeric dc <?php echo $cur_sign;?> reqtext" id="training" form="dcfrm" value="<?php echo moneyFormatIndia($training);?>" required name="training"></td>
						</tr>
						<tr>
							<td>09. Freight Inward Transportation Costs *</td>
							<td><input type="text" class="form-control numeric dc <?php echo $cur_sign;?> reqtext" id="transport" form="dcfrm" value="<?php echo moneyFormatIndia($transport);?>" required name="transport"></td>
						</tr>
						<tr>
							<td>Total of Direct Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="totdc" value="<?php echo moneyFormatIndia($totdc);?>" readonly name="totdc"></td>
						</tr>
					</table>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart table-responsive" id="dc_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev6" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt7" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			
			<div id="tab8">
				<h3 class="title" id="t8">Indirect Costs Per Production Cycle</h3>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<form action="" method="post" name="indcfrm" id="indcfrm"  autocomplete="off">
						<input type="hidden" name="tbl" value="indirectcost">
					</form>	
					<div class="table-responsive">					
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><th>Indirect Costs - Heads of Account</th><th>Costs</th></tr>
						<tr>
							<td>01. Salary to Managers</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc1" value="<?php echo moneyFormatIndia($indc1);?>" readonly name="indc1"></td>
						</tr>
						<tr>
							<td>02. Salary to Sales Personnel</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc2" value="<?php echo moneyFormatIndia($indc2);?>" readonly name="indc2"></td>
						</tr>
						<tr>
							<td>03. Salary to Admin Staff</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc3" value="<?php echo moneyFormatIndia($indc3);?>" readonly name="indc3"></td>
						</tr>
						<tr>
							<td>04. Salary to Unskilled Staff</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="indc4" readonly value="<?php echo moneyFormatIndia($indc4);?>" name="indc4"></td>
						</tr>
						<tr>
							<td>05. Employee Welfare Costs</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="indc5" value="<?php echo moneyFormatIndia($indc5);?>" readonly name="indc5"></td>
						</tr>
						<tr>
							<td>06. Performance Incentive to Employees Other Than Skilled </td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc6" value="<?php echo moneyFormatIndia($indc6);?>" readonly name="indc6"></td>
						</tr>
						<tr>
							<td>07. Annual Bonus to Employees Other Than Skilled</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="indc7" value="<?php echo moneyFormatIndia($indc7);?>" readonly name="indc7"></td>
						</tr>
						<tr>
							<td>08. Advertisement Expenses *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="advertise" form="indcfrm" value="<?php echo moneyFormatIndia($advertise);?>" required name="advertise"></td>
						</tr>
						<tr>
							<td>09. Regular Sales Expenses *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="salesexp" form="indcfrm" value="<?php echo moneyFormatIndia($salesexp);?>" required name="salesexp"></td>
						</tr>
							<tr>
							<td>10. Additional Incentive For Salesmen(per salesman) *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" form="indcfrm" id="add_incentive" value="<?php echo moneyFormatIndia($add_incentive);?>" required name="add_incentive"></td>
						</tr>
						<tr>
							<td>11. Additional Sales Expenses *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="add_salesexp" form="indcfrm" value="<?php echo moneyFormatIndia($add_salesexp);?>" required name="add_salesexp"></td>
						</tr>
						<tr>
							<td>12. Go-Down Rent *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="godown" form="indcfrm" value="<?php echo moneyFormatIndia($godown);?>" required name="godown"></td>
						</tr>
						<tr>
							<td>13. Campus Cleaning Expenses *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="campus_cleaning" form="indcfrm" value="<?php echo moneyFormatIndia($campus_cleaning);?>" required name="campus_cleaning"></td>
						</tr>
							<tr>
							<td>14. Business Insurance *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" form="indcfrm" id="business_insurance" value="<?php echo moneyFormatIndia($business_insurance);?>" required name="business_insurance"></td>
						</tr>
						<tr>
							<td>15 Technology Costs *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="technology_cost" form="indcfrm" value="<?php echo moneyFormatIndia($technology_cost);?>" required name="technology_cost"></td>
						</tr>
						<tr>
							<td>16 Food Charges (For all Employees) *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="food_charges" form="indcfrm" value="<?php echo moneyFormatIndia($food_charges);?>" required name="food_charges"></td>
						</tr>
						<tr>
							<td>17. Entertainment Charges(For Managers) *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="entertainment_charges" form="indcfrm" value="<?php echo moneyFormatIndia($entertainment_charges);?>" required name="entertainment_charges"></td>
						</tr>
							<tr>
							<td>18. Managerial/Admin Training Cost(PP) *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" form="indcfrm" id="training_cost" value="<?php echo moneyFormatIndia($training_cost);?>" required name="training_cost"></td>
						</tr>
						<tr>
							<td>19. Legal Costs (Retention Fee) *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="legal_cost" form="indcfrm" value="<?php echo moneyFormatIndia($legal_cost);?>" required name="legal_cost"></td>
						</tr>
						<tr>
							<td>20. Consultant Costs *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="consultant_cost" form="indcfrm" value="<?php echo moneyFormatIndia($consultant_cost);?>" required name="consultant_cost"></td>
						</tr>
						<tr>
							<td>21. Postal Charges *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="postal_charges" form="indcfrm" value="<?php echo moneyFormatIndia($postal_charges);?>" required name="postal_charges"></td>
						</tr>
						<tr>
							<td>22. Stationery *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" form="indcfrm" id="stationery" value="<?php echo moneyFormatIndia($stationery);?>" required name="stationery"></td>
						</tr>
						<tr>
							<td>23. Telephone Costs *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="telephone_costs" form="indcfrm" value="<?php echo moneyFormatIndia($telephone_costs);?>" required name="telephone_costs"></td>
						</tr>
						<tr>
							<td>24. Printing Costs *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="printing_costs" form="indcfrm" value="<?php echo moneyFormatIndia($printing_costs);?>" required name="printing_costs"></td>
						</tr>
						<tr>
							<td>25. Website Costs *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="website_costs" form="indcfrm" value="<?php echo moneyFormatIndia($website_costs);?>" required name="website_costs"></td>
						</tr>
						<tr>
							<td>26. Transport Costs *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" form="indcfrm" id="transport_costs" value="<?php echo moneyFormatIndia($transport_costs);?>" required name="transport_costs"></td>
						</tr>
						<tr>
							<td>27. Packaging Costs *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="packaging" form="indcfrm" value="<?php echo moneyFormatIndia($packaging);?>" required name="packaging"></td>
						</tr>
						<tr>
							<td>28. Plant Maintenance Expenses *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="maintenance_exp" form="indcfrm" value="<?php echo moneyFormatIndia($maintenance_exp);?>" required name="maintenance_exp"></td>
						</tr>
						<tr>
							<td>29. Miscellaneous *</td>
							<td><input type="text" class="form-control numeric indc <?php echo $cur_sign;?> reqtext" id="miscellaneous" form="indcfrm" value="<?php echo moneyFormatIndia($miscellaneous);?>" required name="miscellaneous"></td>
						</tr>
						<tr>
							<td>Total of Indirect Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="totindc" value="<?php echo moneyFormatIndia($totindc);?>" readonly name="totindc"></td>
						</tr>
					</table>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart table-responsive" id="indc_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev7" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt8" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab9">
				<h3 class="title" id="t9">Required Working Capital</h3>
				
				<div class="col-md-6 col-sm-12 col-xs-12">	
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Direct Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rwc_dc" value="" readonly name="rwc_dc"></td>
						</tr>
						<tr>
							<td>02. Indirect Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rwc_indc" value="" readonly name="rwc_indc"></td>
						</tr>
						<tr>
							<td>03. Inventory Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rwc_inv" value="" readonly name="rwc_inv"></td>
						</tr>
						<tr>
							<td>Total Required Working Capital</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="rwc_tot" readonly value="" name="rwc_tot"></td>
						</tr>											
					</table>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="rwc_chart table-responsive" id="rwc_chart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev8" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt9" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab10">				
				<div class="col-md-6 col-sm-12 col-xs-12">
					<h3 class="title" id="t10">Financial Costs</h3>
					<form action="" method="post" name="findep" id="findep"  autocomplete="off">
						<input type="hidden" name="tbl" value="finance_deposit_investment">
					</form>	
				<div class="table-responsive">					
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Total Term Loan</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost1" value="<?php echo moneyFormatIndia($fincost1);?>" readonly name="fincost1"></td>
						</tr>
						<tr>
							<td>02. Rate of Interest on Term Loan</td>
							<td><input type="text" class="form-control numeric percentage" id="fincost2" value="<?php echo moneyFormatIndia($fincost2);?>" readonly name="fincost2"></td>
						</tr>
						<tr>
							<td>03. Commitment on Principal Repayment of Term Loan</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost3" value="<?php echo moneyFormatIndia($fincost3);?>" readonly name="fincost3"></td>
						</tr>
						<tr>
							<td>04. Commitment on Interest Payment of Term Loan</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="fincost4" readonly value="<?php echo moneyFormatIndia($fincost4);?>" name="fincost4"></td>
						</tr>
						<tr>
							<td>05. Total Commitment on Term Loan</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="fincost5" value="<?php echo moneyFormatIndia($fincost5);?>" readonly name="fincost5"></td>
						</tr>
						<tr>
							<td>06. Working Capital Required </td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost6" value="<?php echo moneyFormatIndia($fincost6);?>" readonly name="fincost6"></td>
						</tr>
						<tr>
							<td>07. Bank Loans Towards Working Capital</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="fincost7" value="<?php echo moneyFormatIndia($fincost7);?>" readonly name="fincost7"></td>
						</tr>
						<tr>
							<td>08. Rate of Interest on Working Capital Loan *</td>
							<td><input type="text" class="form-control numeric fincost percentage reqtext" id="wc_loan_interest" form="findep" value="<?php echo moneyFormatIndia($wc_loan_interest);?>" required name="wc_loan_interest"></td>
						</tr>
						<tr>
							<td>09. Interest Payment on Working Capital Loan</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost9" value="<?php echo moneyFormatIndia($fincost9);?>" readonly name="fincost9"></td>
						</tr>
							<tr>
							<td>10. Promoter's Stake Towards Working Capital</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost10" value="<?php echo moneyFormatIndia($fincost10);?>" readonly name="fincost10"></td>
						</tr>
						<tr>
							<td>11. Value of Required Raw Material</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost11" value="<?php echo moneyFormatIndia($fincost11);?>" readonly name="fincost11"></td>
						</tr>
						<tr>
							<td>12. % of Market Credit on Raw Material - Interest Free</td>
							<td><input type="text" class="form-control numeric indc percentage reqtext" id="interest_free" form="findep" value="<?php echo moneyFormatIndia($interest_free);?>" required name="interest_free"></td>
						</tr>
						<tr>
							<td>13. Market Credit in Value</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost13"  value="<?php echo moneyFormatIndia($fincost13);?>" readonly name="fincost13"></td>
						</tr>	
						<tr>
							<td>14. Commitment on TL, WCL, &amp; Sundry Creditors</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="fincost14"  value="<?php echo moneyFormatIndia($fincost14);?>" readonly name="fincost14"></td>
						</tr>
					</table>
				</div>
				</div>
				<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-5 col-sm-12 col-xs-12">
					<h3 class="title" id="t10">Deposits &amp; Investments</h3>	
					<div class="table-responsive">					
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>						
						<tr>
							<td>01. Rental Deposit For Go-Down</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="rent_deposit" value="<?php echo moneyFormatIndia($godown*20);?>" readonly name="rent_deposit"></td>
						</tr>
						<tr>
							<td>02. Fixed Deposits in Banks *</td>
							<td><input type="text" class="form-control numeric fincost <?php echo $cur_sign;?>  reqtext" id="fd_bank" value="<?php echo moneyFormatIndia($fd_bank);?>" name="fd_bank" form="findep"></td>
						</tr>
						<tr>
							<td>Total</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="deptot" value="<?php echo moneyFormatIndia($deptot);?>" readonly name="deptot"></td>
						</tr>
					</table>
					</div>
					<div class="prof_chart table-responsive" id="dpin_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev9" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt10" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			<div id="tab11">
				<div class="col-md-12 col-sm-12 col-xs-12">			
				<div class="col-md-6 col-sm-12 col-xs-12">
					<h3 class="title" id="t11">Sales &amp; Marketing Costs</h3>	
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Advertisement Expenses Per Cycle</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost1" value="" readonly name="smcost1"></td>
						</tr>
						<tr>
							<td>02. Regular Sales Expenses Per Cycle</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost2" value="" readonly name="smcost2"></td>
						</tr>
						<tr>
							<td>03. Regular Incentive to Salesmen Per Cycle</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost3" value="" readonly name="smcost3"></td>
						</tr>
						<tr>
							<td>04. Additional Incentive to Salesmen Per Cycle</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="smcost4" readonly value="" name="smcost4"></td>
						</tr>
						<tr>
							<td>05. Additional Sales Expenses Per Cycle</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="smcost5" value="" readonly name="smcost5"></td>
						</tr>
						<tr>
							<td>Total Sales &amp; Marketing Costs Per Cycle</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="smcost6" value="" readonly name="smcost6"></td>
						</tr>						
					</table>
					</div>
				</div>
				<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-5 col-sm-12 col-xs-12">
					<h3 class="title" id="t10">Summary of Costs</h3>	
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>						
						<tr>
							<td>Capital Investment Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary1" value="" readonly name="summary1"></td>
							<td><input type="text" class="form-control numeric " id="summaryper1" value="" readonly name="summaryper1"></td>
						</tr>
						<tr>
							<td>Direct Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary2" value="" readonly name="summary2" ></td>
							<td><input type="text" class="form-control numeric " id="summaryper2" value="" readonly name="summaryper2"></td>
						</tr>
						<tr>
							<td>Indirect Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary3" value="" readonly name="summary3"></td>
							<td><input type="text" class="form-control numeric " id="summaryper3" value="" readonly name="summaryper3"></td>
						</tr>
						<tr>
							<td>Marketing Costs</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="summary4" readonly value="" name="summary4"></td>
							<td><input type="text" class="form-control numeric " id="summaryper4" value="" readonly name="summaryper4"></td>
						</tr>
						<tr>
							<td>Financial Costs</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="summary5" value="" readonly name="summary5"></td>
							<td><input type="text" class="form-control numeric " id="summaryper5" value="" readonly name="summaryper5"></td>
						</tr>
						<tr>
							<td>Total Costs</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="summary6" value="" readonly name="summary6"></td>
							<td><input type="text" class="form-control numeric" id="summaryper6" value="" readonly name="summaryper6"></td>
						</tr>						
					</table>
					</div>
				</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12" id="sumry">	
					<div class="col-md-6 col-sm-12 col-xs-12 table-responsive" id="distri_chart">
					
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="prof_chart table-responsive" id="sc_profchart"></div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev10" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt11" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab12">				
				<div class="col-md-6 col-sm-12 col-xs-12">				
					<h3 class="title" id="t12">Particulars of Product &amp; Sales Costs</h3>
					<form action="" method="post" name="prodsalescost" id="prodsalescost"  autocomplete="off">
						<input type="hidden" name="tbl" value="prod_sales_cost">
					</form>	
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Cost of the Product (Inclusive of All Costs)</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="psc1" value="" readonly name="psc1"></td>
						</tr>
						<tr>
							<td>02. Break-Even Point</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="psc2" value="" readonly name="psc2"></td>
						</tr>
						<tr>
							<td>03. Profit Margin on the Cost of the Product</td>
							<td><input type="text" class="form-control numeric percentage reqtext" form="prodsalescost" id="profit_margin" value="<?php echo moneyFormatIndia($profit_margin);?>" required name="profit_margin"></td>
						</tr>
						<tr>
							<td>04. Cost of the Product + Profit Margin</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="psc4" readonly value="" name="psc4"></td>
						</tr>
						<tr>
							<td>05. Sales Discount</td>
							<td><input type="text" class="form-control numeric percentage reqtext" id="sales_discount" value="<?php echo moneyFormatIndia($sales_discount);?>" required name="sales_discount" form="prodsalescost" ></td>
						</tr>
						<tr>
							<td>06. Gross Sale Price</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="psc6" value="" readonly name="psc6"></td>
						</tr>						
					</table>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="prof_chart table-responsive" id="psc_profchart"></div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev11" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt12" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab13">				
				<div class="col-md-12 col-sm-12 col-xs-12">				
					<h3 class="title" id="t13">Sales Particulars</h3>
					<div class="col-md-7 col-sm-12 col-xs-12">	
					<form action="" method="post" name="salesparticular" id="salesparticular"  autocomplete="off">
						<input type="hidden" name="tbl" value="salesparticular">
					</form>
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Total Number of Units Available for Sale</td>
							<td><input type="text" class="form-control numeric" id="salesp1" value="" readonly name="salesp1"></td>
						</tr>
						<tr>
							<td>02. Sales Target in Percentage</td>
							<td><input type="text" class="form-control numeric percentage reqtext" form="salesparticular" id="sales_target" value="<?php echo moneyFormatIndia($sales_target);?>" required name="sales_target"></td>
						</tr>
						<tr>
							<td>03. Sales Target in Number of Units</td>
							<td><input type="text" class="form-control numeric" id="salesp3" value="" readonly name="salesp3"></td>
						</tr>
						<tr>
							<td>04. Sales Achieved Against Sales Target in %</td>
							<td><input type="text" class="form-control numeric percentage reqtext" form="salesparticular" id="sales_achieved" value="<?php echo moneyFormatIndia($sales_achieved);?>" required name="sales_achieved"></td>
						</tr>
						<tr>
							<td>05. Sales Achieved Against Sales Target in No. of Units</td>
							<td><input type="text" class="form-control" id="salesp5" readonly value="" name="salesp5"></td>
						</tr>
						<tr>
							<td>06. Additional Sales Because of Additional Incentive to Sales Personnel</td>
							<td><input type="text" class="form-control numeric " id="salesp6" value="" readonly name="salesp6" ></td>
						</tr>
						<tr>
							<td>07. Additional Sales Because of Additional Sales Expenses</td>
							<td><input type="text" class="form-control numeric" id="salesp7" value="" readonly name="salesp7"></td>
						</tr>
						
						<tr>
							<td>08. Additional Sales Because of Discount Offered</td>
							<td><input type="text" class="form-control numeric" id="salesp8" value="" readonly name="salesp8"></td>
						</tr>
						<tr>
							<td>09. Additional Sales Because of R&amp;D/Product Improvement/Training</td>
							<td><input type="text" class="form-control" id="salesp9" readonly value="" name="salesp9"></td>
						</tr>
						<tr>
							<td>10. Total Sales in Number of Units</td>
							<td><input type="text" class="form-control numeric" id="salesp10" value="" readonly name="salesp10"></td>
						</tr>
						<tr>
							<td>11. Percentage of Sales to Target</td>
							<td><input type="text" class="form-control percentage" id="salesp11" readonly value="" name="salesp11"></td>
						</tr>
						<tr>
							<td>12. Percentage of Sales on Cash</td>
							<td><input type="text" class="form-control numeric percentage reqtext" form="salesparticular" id="sales_cash" value="<?php echo moneyFormatIndia($sales_cash);?>" required name="sales_cash"></td>
							
						</tr>
						<tr>
							<td>13. Percentage of Sales on Credit</td>
							<td><input type="text" class="form-control numeric percentage " id="salesp13" value="" readonly name="salesp13" ></td>
						</tr>
						<tr>
							<td>14. Total Sales on Cash in Number of Units</td>
							<td><input type="text" class="form-control numeric" id="salesp14" value="" readonly name="salesp14"></td>
						</tr>
						<tr>
							<td>15. Sales on Credit in Number of Units</td>
							<td><input type="text" class="form-control" id="salesp15" readonly value="" name="salesp15"></td>
						</tr>
						<tr>
							<td>16. Expected Doubtful Credit Sales - In %</td>
							<td><input type="text" class="form-control numeric percentage reqtext" form="salesparticular" id="doubtful_crsale" value="<?php echo moneyFormatIndia($doubtful_crsale);?>" required name="doubtful_crsale"></td>
						</tr>
						<tr>
							<td>17. Expected Doubtful Credit Sales - In Number of Units</td>
							<td><input type="text" class="form-control numeric" id="salesp17" value="" readonly name="salesp17"></td>
						</tr>
					</table>
					</div>
					</div>
					<div class="col-md-5 col-sm-12 col-xs-12">
						
						<div class="prof_chart table-responsive" id="salp_profchart"></div>
					
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev12" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt13" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab14">				
				<div class="col-md-12 col-sm-12 col-xs-12">				
					<h3 class="title" id="t14">Revenue Analysis</h3>
					<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="table-responsive">
					<table class="table table-stripped">
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>01. Turnover</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven1" value="" readonly name="reven1"></td>
						</tr>
						<tr>
							<td>02. Revenue Out of Cash Sales</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven2" value="" readonly name="reven2"></td>
						</tr>
						<tr>
							<td>03. Expected Revenue Out of Sales on Credit (Bill Receivable)</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven3" value="" readonly name="reven3"></td>
						</tr>
						<tr>
							<td>04. Expected Revenue Out of Doubtful Debt(Sundry Debtors)</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven4" value="" readonly name="reven4"></td>
						</tr>
						<tr>
							<td>05. Net Sales Revenue</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="reven5" readonly value="" name="reven5"></td>
						</tr>
						<tr>
							<td>06. Net Expenses</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven6" value="" readonly name="reven6" ></td>
						</tr>
						<tr>
							<td>07. Net Sales Revenue Less Net Expenses</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven7" value="" readonly name="reven7"></td>
						</tr>
						
						<tr>
							<td>08. Cash on Hand</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven8" value="" readonly name="reven8"></td>
						</tr>
						<tr>
							<td>09. Cash at Bank</td>
							<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="reven9" readonly value="" name="reven9"></td>
						</tr>
						<tr>
							<td>10. Sundry Debtors</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven10" value="" readonly name="reven10"></td>
						</tr>
						<tr>
							<td>11. Sundry Debtors as a Percentage of Turnover</td>
							<td><input type="text" class="form-control percentage" id="reven11" readonly value="" name="reven11"></td>
						</tr>
						<tr>
							<td>12. Sundry Creditors</td>
							<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="reven12" value="" readonly name="reven12"></td>							
						</tr>
						<tr>
							<td>13. Sundry Creditors as a Percentage of Turnover</td>
							<td><input type="text" class="form-control numeric percentage" id="reven13" value="" readonly name="reven13" ></td>
						</tr>						
					</table>
					</div>
					</div>
					<div class="col-md-5 col-sm-12 col-xs-12">	
						<div class="prof_chart table-responsive" id="reven_profchart"></div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev13" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-7 col-xs-2">
						<button type="button" name="submit" id="nxt14" class="btn btn-primary">Next</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
			
			<div id="tab15">				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-6 col-sm-12 col-xs-12">
						<h3 class="title" id="t15">Cash Flow Analysis</h3>
						<div class="table-responsive">
						<table class="table table-stripped">
							<tr><td colspan="2"><h4>Cash Outflow</h4></td></tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>01. Net Direct Expenses</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow1" value="" readonly name="cflow1"></td>
							</tr>
							<tr>
								<td>02. Net Indirect Expenses</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow2" value="" readonly name="cflow2"></td>
							</tr>
							<tr>
								<td>03. Net Marketing/Sales Expenses</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow3" value="" readonly name="cflow3"></td>
							</tr>
							<tr>
								<td>04. Net Financial Expenses</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow4" value="" readonly name="cflow4"></td>
							</tr>
							<tr>
								<td>05. Depreciation (15% on P&amp;M +3% on Building + 30% on Funiture)</td>
								<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="cflow5" readonly value="" name="cflow5"></td>
							</tr>
							<tr>
								<td>06. Taxes</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?> " id="cflow6" value="" readonly name="cflow6" ></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Net Cash Outflow</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow7" value="" readonly name="cflow7"></td>
							</tr>
						</table>
						</div>
						<div class="table-responsive">
						<table class="table table-stripped">
							<tr><td colspan="2"><h4>Cash Inflow</h4></td></tr>
							<tr>
								<td>01. Net Revenue From Sales</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow8" value="" readonly name="cflow8"></td>
							</tr>
							<tr>
								<td>02. Miscellaneous Income (Sale of Scrab &amp; Waste, etc.)</td>
								<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="cflow9" readonly value="" name="cflow9"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Net Cash Inflow</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="cflow10" value="" readonly name="cflow10"></td>
							</tr>												
						</table>
						</div>
					</div>
					<div class="col-md-1 col-sm-12 col-xs-12"></div>
					<div class="col-md-5 col-sm-12 col-xs-12">
						<h3 class="title">Profitability</h3>
						<div class="table-responsive">
						<table class="table table-stripped">
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Profit Before Tax</td>
								<td><input type="text" class="form-control numeric <?php echo $cur_sign;?>" id="profitbt" value="" readonly name="profitbt"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Profit After Tax</td>
								<td><input type="text" class="form-control <?php echo $cur_sign;?>" id="profitat" readonly value="" name="profitat"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>											
						</table>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="prof_chart table-responsive" id="prof_profchart"></div>
						</div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="col-sm-12">	
					<div class="col-md-6 col-xs-2">
						<button type="button" name="submit" id="prev14" class="btn btn-primary">Prev</button>
					</div>
					<div class="col-md-push-5 col-xs-push-5 col-xs-2">
						<button type="button" name="submit" id="nxt15" class="btn btn-primary">Submit</button>
					</div>
					<!-- /.col -->
				</div>
			</div>
		</div>
	</div>
	<?php include 'common/footscript.php';?>
</body>

<!-- bootstrap-pop-up -->
	<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="text-center poptitle">TIPS<button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
				</div>
				<section>
					<div class="modal-body">	
						<div class="alert-info instruc">
						<h3>TIPS - I</h3>
						<ol class="instruc">
							<li>Estimation of the Project Cost is quite a technical process. </li>
							<li>To start with, survey the market &amp; arrive at an approximate cost of the project. </li>
							<li>Enter the figure in the appropriate cell. As you go by, you can refine the figure.</li>
							<li>The other parameters of the Project Cost, get automatically calculated.</li>
							<li>But, you can over-ride the figures as they are in the yellow colored cells.</li>
							<li>It's good to provide for "interest during implementation" as it does not financially strain the project implementation.  Normally it's for 3 quarters.</li>
							<li>Working capital margin (10% of the required working capital) is included as part of the project cost, and is covered by the term-loan subject to promoter's margin.</li>
						</ol>
						<h3>TIPS - II</h3>
						<ol class="instruc">
							<li>Promoter's stake in the project is vital.</li>
							<li>Higher the promoter's stake, less is the burden on the project.</li>						
						</ol>
						<h3>TIPS - III</h3>
						<ol class="instruc">
							<li>Financial Institutions normally prefer a lower debt-equity.</li>
							<li>The more the debt, more will be the interest cost. </li>
							<li>A debt-equity of 1:1 is preferred.  But, banks do go up to 2:1.</li>
							<li>However, DER  of 1:1, though is project friendly, loads the  financials of the promoter.</li>
							<li>A term loan is normally for 3 to 5 years.  However, some projects with longer gestation-period do call for longer repayment period.</li>							
						</ol>
						<h3>TIPS - IV</h3>
						<ol class="instruc">
							<li>Market Potential normally determines the Plant Capacity.</li>
							<li>Gap in the Demand and Supply is normally the Guiding Factor.</li>
							<li>Actual Capacity Utilization could be any figure as determined by you.</li>
							<li>Production Cycle is the time taken to produce the product from the stage of raw-material to  finished product. Shorter the cycle-period, better it is.</li>
							<li>Higher the Capacity Utilization, lower will be the production cost.</li>
							<li>Look at the overall impact of Capacity Utilization on other parameters & profitability. Alter the figure accordingly.</li>							
						</ol>
						<h3>TIPS - V</h3>
						<ol class="instruc">
							<li>Capacity Utilization & Production Cost are Inversely Proportional.</li>
						</ol>
						<h3>TIPS - VI</h3>
						<ol class="instruc">
							<li>Manpower is an important element of a project.</li>
							<li>However, it's the skilled manpower that yields revenue.</li>
							<li>Cut-down non-skilled and admin staff as much as possible.</li>
							<li>Managerial/Supervisory staff too should be just adequate.</li>
						</ol>
						<h3>TIPS - VII</h3>
						<ol class="instruc">
							<li>Inventory is another name for locked-up revenue. Therefore, ensure that inventory is carefully managed.</li>
							<li>Inventory calls for three kinds of costs, first raw-material, second, value addition cost  for partially completed products, i.e., Work-In-Progress, and finally, costs towards warehouse, expenses, and manpower costs to manage inventory. </li>
							<li>Avoid over-stocking of raw material. A good rule of thumb is to stock covering one production cycle. Utilize market credit on purchase of raw material.</li>
							<li>WIP is linked to capacity utilization. Higher WIP in stock is not healthy. Because, WIP has raw-material cost plus partial conversion costs as well.</li>
							<li>Inventory of finished goods is the costliest of all. Therefore, avoid it.</li>
						</ol>
						<h3>TIPS - VIII</h3>
						<ol class="instruc">
							<li>Raw material cost is directly linked to capacity utilization.  However, ensure control on this vital cost head.</li>
							<li>Avoid over-stocking of raw material.  A good rule of thumb is to stock covering one production-cycle. Fully utilize the available market credit on purchase of raw material as it is generally interest free.</li>
							<li>Unlike salaries for admin and unskilled staff, wages to skilled personnel is productive.</li>
							<li>Training skilled personnel is good as it helps in enhancing their productivity.</li>
							<li>Minimize fixed costs, because, immaterial of the capacity utilization, fixed costs remain constant.</li>
						</ol>
						<h3>TIPS - IX</h3>
						<ol class="instruc">
							<li>While capital costs can be likened to "anatomy," working capital is similar to "physiology."  Without working capital, a unit is as good as dead.</li>
							<li>Institutional working capital loans carry higher costs than market credit. Therefore, if market credit is available, avail it.  But, be prompt in repaying, as default erodes the financial creditbility of the firm.</li>
							<li>Working capital loans carry higher interest rates as compared to term loans.  Therefore, higher promoter's stake in the working capital is good, as the financial burden on the firm is less.</li>
							<li>Technically, working capital loan is never repaid.  It is always serviced.  It's the interest portion that is serviced.  Working capital loan is a financial limit or an open-credit limit, and the quantum is dependent on the quantum of production and the anticipated sales turnover.</li>
						</ol>
						<h3>TIPS - X</h3>
						<ol class="instruc">
							<li>1. Incurring expenses on marketing & sales is vital to an enterprise. However, marketing costs and 	sales are not entirely directly proportional. Up to a point, marketing expenses increase sales volume, 	but beyond a point, the relationship is in-elastic.	</li>
							<li> Generally, incentive to sales personnel yields better sales turnover than, more than required expenses	on sales promotion.</li>
						</ol>
						<h3>TIPS - XI</h3>
						<ol class="instruc">
							<li>An ideal recipe for profitability is cost control.  Lower the costs, higher is the revenue.  Therefore, ensure that costs are carefully monitored and minimized; particularly the indirect costs.</li>
							<li>Marketing costs do not have relationship with capacity utilization, unlike direct costs.Therefore, maximize capacity-utilization, as it directly impacts product cost which in turn positively impacts sales and other financial parameters.</li>
							<li>Financial costs can be reduced by reducing the borrowings.  Higher promoter's stake, takes out the financial sting on the project.</li>
						</ol>
						<h3>TIPS - XII</h3>
						<ol class="instruc">
							<li>In Business, there is no profit, but only costs. Therefore, ensure costs are minimized as much as possible. Although, this tip is a repetition, it's worth repeating it, as it's the heart of business.</li>
							<li>Break-even point is kind of a null-point. At the break-even point, costs and revenue equal each other. This is a critical reference point in business.</li>
							<li>While determining the profit margin, go by the industry standard for reference.</li>
							<li>Go by the industry average while offering sales discount. While it may marginally increase the sales, it reduces the revenue. It's a trade-off decision.</li>
							<li>Additional sales incentive, product improvement, sales promotion do increase the sales; but, marginally. It's a trade-off between increase in costs and increase in sales.</li>
							<li>Cash sales are always better.  Therefore, go for it.</li>
							<li>Be wary of credit sales.  Apart from credit sales going bad, it carries higher collection charges. Do note, credit unrealized is loss of revenue.</li>
							<li>Ensure that credit sales do not go bad. Try to keep this as low as possible.  </li>
						</ol>
						<h3>TIPS - XIII</h3>
						<ol class="instruc">
							<li>Avoid sundry debtors as much as possible.  If it is inevitable minimize it.  Because, on the one hand an enterprise may incur cash loss, and on the other, the enterprise carries high sundry debtors, which if monetized, will avoid cash loss.</li>
							<li>While sundry creditors may provide some cushion, it is important that it is promptly serviced, if not, the rating of the enterprise in the market may decline.  The reputation of the firm too suffers in the market.</li>
						</ol>
						<h3>TIPS - XIV</h3>
						<ol class="instruc">
							<li>Every transaction of an enterprise gets reflected in the cash-flows. Be it in the form of cash-inflow or cash-outflow.</li>
						</ol>
					</div>
				</section>
			</div>
		</div>
	</div>
	</div>
	<div class="modal video-modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="text-center poptitle">Licences<button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
				</div>
				<section>
					<div class="modal-body">	
						<div class="alert-info instruc">
							<table class="table table-bordered">
					  <tr>
						<th colspan="6">REQUIERED LICENCES/APPROVALS (Applicable Only In    The Indian Legislative System)</th>
					  </tr>
					  <tr>
						<th>Sl.No.</th>
						<th colspan="4">Required Licenses</th>
						<th>Issuing Authority</th>
					  </tr>
					  <tr>
						<td>1</td>
						<td colspan="4">Shops &amp;    Establishment Certificate</td>
						<td><a target="_blank" href="http://bbmp.gov.in/">BBMP</a></td>
					  </tr>
					  <tr>
						<td>2</td>
						<td colspan="4">Factory License/PRC</td>
						<td><a target="_blank" href="http://www.indcom.tn.gov.in/">DIC-GOK</a></td>
					  </tr>
					  <tr>
						<td>3</td>
						<td colspan="4">Health License</td>
						<td><a target="_blank" href="bbmp.gov.in/">BBMP</a></td>
					  </tr>
					  <tr>
						<td>4</td>
						<td colspan="4">PAN</td>
						<td><a target="_blank" href="https://www.incometaxindia.gov.in/Pages/tax-services/apply-for-pan.aspx">IT</a></td>
					  </tr>
					  <tr>
						<td>5</td>
						<td colspan="4">AADHAR</td>
						<td><a target="_blank" href="https://www.uidai.gov.in/">UIDAI</a></td>
					  </tr>
					  <tr>
						<td>5</td>
						<td colspan="4">GST</td>
						<td><a target="_blank" href="https://reg.gst.gov.in/registration/">Govt    of India</a></td>
					  </tr>
					  <tr>
						<td>6</td>
						<td colspan="4">State Excise</td>
						<td><a target="_blank" href="stateexcise.kar.nic.in/">GOK</a></td>
					  </tr>
					  <tr>
						<td>7</td>
						<td colspan="4">Provident Fund</td>
						<td><a target="_blank" href="https://epfindia.gov.in/site_en/OLRE.php">PF    COMMISSIONER</a></td>
					  </tr>
					  <tr>
						<td>8</td>
						<td colspan="4">Gratuity</td>
						<td><a target="_blank" href="https://epfindia.gov.in/site_en/OLRE.php">PF    COMMISSIONER</a></td>
					  </tr>
					  <tr>
						<td>9</td>
						<td colspan="4">Registration of Partnership Firm</td>
						<td><a target="_blank" href="kaverionlinefirm.karnataka.gov.in/">DISTRICT    REGISTRAR</a></td>
					  </tr>
					  <tr>
						<td>10</td>
						<td colspan="4">Company Incorporation</td>
						<td><a target="_blank" href="http://www.mca.gov.in/">REGISTRAR OF COMPANIES</a></td>
					  </tr>
					  <tr>
						<td>11</td>
						<td colspan="4">Power Sanction</td>
						<td><a target="_blank" href="https://www.bescom.co.in/SCP/Myhome.aspx">BESCOM/ELECTRICITY    AUTHORITY</a></td>
					  </tr>
					  <tr>
						<td>12</td>
						<td colspan="4">Water Sanction</td>
						<td><a target="_blank" href="https://bwssb.gov.in/">BWSSB</a></td>
					  </tr>
					  <tr>
						<td>13</td>
						<td colspan="4">Pollution Clearance</td>
						<td><a target="_blank" href="kspcb.kar.nic.in/defaulte.asp">PC BOARD</a></td>
					  </tr>
					  <tr>
						<td>14</td>
						<td colspan="4">ESI</td>
						<td><a target="_blank" href="http://www.esic.in/EmployeePortal/login.aspx">ESI COMMISSIONER</a></td>
					  </tr>
					  <tr>
						<td>15</td>
						<td colspan="4">Building Plan </td>
						<td><a target="_blank" href="bbmp.gov.in/">BBMP</a></td>
					  </tr>
					  <tr>
						<td>16</td>
						<td colspan="4">Land</td>
						<td><a target="_blank" href="http://kiadb.in/">KIADB</a></td>
					  </tr>
					  <tr>
						<td>17</td>
						<td colspan="4">Project Finance - From KSFC</td>
						<td><a target="_blank" href="http://www.ksfc.in/">KSFC</a></td>
					  </tr>
					  <tr>
						<td>18</td>
						<td colspan="4">Financial Support From Minorities Development Corporation</td>
						<td><a target="_blank" href="http://kmdc.karnataka.gov.in/nmdfc">KMDC</a></td>
					  </tr>
					  <tr>
						<td>19</td>
						<td colspan="4">Financial Support From SC &amp; ST Development Corporation</td>
						<td><a target="_blank" href="http://adcl.karnataka.gov.in/en/index.html">KSCSTDC</a></td>
					  </tr>
					  <tr>
						<td>20</td>
						<td colspan="4">For Industrial Raw Materials &amp; Industrial Sheds</td>
						<td><a target="_blank" href="http://www.kssidc.co.in/">KSSIDC</a></td>
					  </tr>
					  <tr>
						<td>21</td>
						<td colspan="4">Assistance to Women Entrepreneurs</td>
						<td><a target="_blank" href="http://202.138.105.9/kswdc/Home.php">KSWDC</a></td>
					  </tr>
					  <tr>
						<td>22</td>
						<td colspan="4">Assistance to Set-Up Small Industries and Training</td>
						<td><a target="_blank" href="laghu-udyog.gov.in/sido/sisi/5.htm">SISI</a></td>
					  </tr>
					  <tr>
						<td>23</td>
						<td colspan="4">Training &amp; Assistance to Women Entrepreneur</td>
						<td><a target="_blank" href="http://www.awakeindia.org.in/">AWAKE</a></td>
					  </tr>
					  <tr>
						<td>24</td>
						<td colspan="4">Small Industries Association - KASIA</td>
						<td><a target="_blank" href="http://www.kassia.com/">KASSIA</a></td>
					  </tr>
					</table>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	
	<div class="modal video-modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="text-center poptitle">Definitions<button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
				</div>
				<section>
					<div class="modal-body">	
						<div class="alert-info instruc">
						<table class="table table-stripped">
							  <tr>
								<th>Welcome to the RIMSR's Learning Centre. </th>
							  </tr>
							  <tr>
								<tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>INTRODUCTION</th>
							  </tr>
							  <tr>
							 <td>Business and the markets in which we operate constantly evolve. But whether you manufacture the latest wearable electronics or sell tickets to upcoming events, the essential building blocks of business – Marketing, finance and operations management – remain the same.  Through this game, you get the chance to develop a holistic understanding of basic business principles from the very beginning in an engaging learning experience. Each business discipline has its broad body of knowledge and can be mastered in theory, but experience how business works in practice can be the ideal foundation for deep and ongoing learning.</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>WHAT IS THE GAME ABOUT?</th>
							  </tr>
							  <tr>
							 <td>Get introduced to the basics of business. Know the various business parameters and how they relate to each other. Get exposed to business lexicon, and understand the business terminologies.   Observe the intricacies that you confront in a real-life business situation. </td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>The game allows you to establish and successfully run a simulated company that manufactures, and markets "bottled-water."  What is applicable in the simulated environment is near true of real-life business situation.  The interactive interface provides you with experience in building a profitable, sustainable business.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>By running a whole business, you not only get a practical introduction to individual disciplines, but develop a realistic context as the basis for a more complete understanding.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Key concepts include making essential decisions in financial investment, estimation of project cost, what are the means of finance, implementation of the project, working out fixed and variable costs, capacity utilization and its impact on profitability, break-even point, investing on marketing and sales and the consequential impact.  Last but not the least you get information as to how to setup your business, the licenses required, and the authorities to be contacted.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>However, note that the take-away from this business simulation experience at Level I is the foundation of any business house, be it mega or micro.  While you get to know the most basic business concepts in Level I of the game, in higher levels you get to know cost control techniques, concepts of supply-chain management, inventory management, and fundamentals of preparing financial statements. In the advanced level you get to understand analysis of financial statements, financial ratios, risk assessment and mitigation, and exposure to an ERP solution through TALLY software.  </td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>WHY USE THE BUSINESS GAME?</th>
							  </tr>
							  <tr>
							 <td>Establishing a solid understanding of the basics of business is critical. Research shows people learn best by doing. The simulation game allows you to experience the inevitable compromises and trade-offs inherent in the decisions managers make every day in finance, operations, marketing and other areas.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>To grasp how the individual parts of a business impact the entire organization, nothing beats the experience of running a business in a competitive marketplace.  "MY BUSINESS – MY STRATEGIES" provides that experience—without the real-world risk—along with the opportunity to build a product portfolio, manage costs, analyze the market, and develop forecasts, all with an eye on cash flow and balance sheet management.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>TIPS &amp; BUSINESS TERMINOLOGIES-EXPLAINED </th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>PROJECT COST</th>
							  </tr>
							  <tr>
							 <td>Project Cost refers to the all the costs under major-cost headings that are essential for the implementation of the project.   It encompasses several specific cost-centers.  This is the basis to work out the project budget.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Beginning with estimating, actual historical data is used to accurately plan all aspects of the project. As the project continues, job control uses data from the estimate with the information reported from the field to measure the cost and production in the project. From project initiation to completion, project cost management has an objective to simplify and cheapen the project experience. </td>
							  </tr>
							  <tr>
							 <td>The major-cost headings are:</td>
							  </tr>
							  <tr>
							 <td>01.             Land &amp; Development Expenses</td>
							  </tr>
							  <tr>
							 <td>02.             Building and Civil Works</td>
							  </tr>
							  <tr>
							 <td>03.             Plant &amp; Machinery</td>
							  </tr>
							  <tr>
							 <td>04.             Miscellaneous Assts</td>
							  </tr>
							  <tr>
							 <td>05.             Margin for Contingencies</td>
							  </tr>
							  <tr>
							 <td>06.             Preliminary and Pre-operative Expenses</td>
							  </tr>
							  <tr>
							 <td>07.             Interest During Implementation</td>
							  </tr>
							  <tr>
							 <td>08.             Start-up Expenses</td>
							  </tr>
							  <tr>
							 <td>09.             Deposits</td>
							  </tr>
							  <tr>
							 <td>10.             Working Capital Margin</td>
							  </tr>
							  <tr>
							 <td>11.             Technical Know-How and Engineering Fee Expenses.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Estimation of the project-cost after project-implementation is key to the success of the project.  One-can know before-hand, whether the project is within his reach or not. Importantly, be realistic in the estimation of project cost, because if it is understated, it will seriously hurt at the implementation stage, leading to time, and cost escalation. It's not a bad idea to provide for cash losses in the project cost, although it is not common practice.</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>TECHNICAL KNOW-HOW</th>
							  </tr>
							  <tr>
							 <td>"Technical Know-how" is a term for practical knowledge on how to accomplish something, as opposed to 'know-what' (facts), 'know-why' (science), or 'know-who' (communication). Know-how is often tacit knowledge, which means that it is difficult to transfer to another person by means of writing it down or verbalizing it. </td>
							  </tr>
							  <tr>
							 <td>In the context of industrial property (now generally viewed as intellectual property - IP), know-how is a component in the transfer of technology in national and international environments, co-existing with or separate from other IP rights such as patents, trademarks and copyright and is an economic asset.  When it is transferred by itself, know-how should be converted into a trade secret before transfer in a legal agreement.</td>
							  </tr>
							  <tr>
							 <td>Know-how can be defined as confidentially held, or better, 'closely held' information in the form of unpatented inventions, formulae, designs, drawings, procedures and methods, together with accumulated skills and experience in the hands of a licensor firm's professional personnel which could assist a transferee/licensee of the object product in its manufacture and use and bring to it a competitive advantage. It can be further supported with privately maintained expert knowledge on the operation, maintenance, use/application of the object product and of its sale, usage or disposition.</td>
							  </tr>
							  <tr>
							 <td>One should clearly know whether the product proposed for the manufacture requires high-end technology.  Note the other important factors:</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>The suitability and the source of technology are very important, and are critical to the survival of the project.</td>
							  </tr>
							  <tr>
							 <td>As always, "technical know-how" involves expenditure, and the project that the promoter intends promoting should do a "cost-benefit analysis" before the "technical know-how" is bought out.</td>
							  </tr>
							  <tr>
							 <td>The promoter should have the necessary technical background and experience to run the unit proposed successfully.</td>
							  </tr>
							  <tr>
							 <td>If the promoter does not have the necessary technical background or expertise, then he should explore the possibility of hiring a technical-expert, and here again the promoter should be aware of the costs involved.</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>PRE-OPERATIVE COSTS</th>
							  </tr>
							  <tr>
							 <td>Preliminary and pre-operative expenses, constitute a distinct component in the project cost.  This covers a number of items of expenditure many of which have to be incurred before the unit can go on stream.  Expenditure on this account is generally more in respect of long gestation projects`.</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>WORKING-CAPITAL </th>
							  </tr>
							  <tr>
							 <td>Working capital (abbreviated WC) is a financial metric which represents operating liquidity available to a business, organization or other entity, including governmental entity. Along with fixed assets such as plant and equipment, working capital is considered a part of operating capital. Gross working capital is equal to current assets. Working capital is calculated as current assets minus current liabilities.  If current assets are less than current liabilities, an entity has a working capital deficiency, also called a working capital deficit.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>A company can be endowed with assets and profitability but short of liquidity if its assets cannot readily be converted into cash. Positive working capital is required to ensure that a firm is able to continue its operations and that it has sufficient funds to satisfy both maturing short-term debt and upcoming operational expenses. The management of working capital involves managing inventories, accounts receivable and payable, and cash.</td>
							  </tr>
							  <tr>
							 <td>If land, building, and plant&amp; machinery are the bones and muscles of an enterprise, working-capital constitutes its blood.  It is the working-capital which turns the wheels and makes the enterprise "GO."  Therefore, it is highly advisable that promoters make adequate provision for working-capital.  "Fist-Generation Promoters," often tend to under estimate the importance of working capital, which is catastrophic.  Without adequate working-capital, an enterprise will come to a grinding-halt.  </td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>INTEREST PAYABLE DURING IMPLEMENTATION</th>
							  </tr>
							  <tr>
							 <td>Many times a promoter tends to grossly under estimate this element in the cost of the project and sometimes even ignore it altogether.  The linkage is simple, a project takes certain period of time for implementation.  This is also referred to as "gestation-period." During this period, the promoter has to bear the interest cost on the borrowings.  If a portion of this is not provided for in the Project Cost, then the promoter will not be able to service the interest-component and tends to default on the payment of interest amount to the lending institution.  This means delayed implementation, loss of banker's confidence, and stressed financials.</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>ESCALATION/CONTINGENCY</th>
							  </tr>
							  <tr>
							 <td>We live in inflationary times, marked by continuous upward movement of all prices.  In a situation like this where prices are constantly rising, escalation become an everyday affair.  Therefore, it is a good idea to provide for this contingency which ensures smooth implementation of the project.</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>PLANT AND MACHINERY</th>
							  </tr>
							  <tr>
							 <td>Proper selection of plant and machinery is of crucial importance. The machinery selected must not only be suitable for the operations intended to be performed but must also be the most economical machinery that can perform the task in question.  The foremost thing you should bear in mind is whether the plant and machinery selected are suitable for the purpose intended and whether they constitute the most economical way of performing the operations envisaged.  </td>
							  </tr>
							  <tr>
							 <td>Whenever more than one machine is planned, it has to be ensured that the capacities of the machines match each other and there is no mismatch and should be balanced.  </td>
							  </tr>
							  <tr>
							 <td>Generally, there is a tendency to carry out all the operations in-house (that is by yourself).  Avoid this.  If any particular operation or group of operations can be got done by an outside agency more economically, there is no reason as to why they should be done in-house.  </td>
							  </tr>
							  <tr>
							 <td>Most importantly, note that capacity utilization of the plant and machinery is critical and directly impacts the profitability of the firm.  Therefore, watch out at the stage of selection of plant and machinery.  Selecting machines purely based on their price, may lead to problems.  Often, these machines may break-down and thus impacting capacity utilization.  Note the relationship; higher the capacity utilization is higher the production; higher the production, higher will be the effort to market more; higher the marketing higher will be sales revenue; and higher the sales revenue, higher will be firm's profitability.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>NET-WORTH</th>
							  </tr>
							  <tr>
							 <td>Net worth is a concept applicable to individuals and businesses as a key measure of how much an entity is worth. A consistent increase in net worth indicates good financial health; conversely, net worth may be depleted by annual operating losses or a substantial decrease in asset values relative to liabilities.</td>
							  </tr>
							  <tr>
							 <td>Basically net worth is the value of all assets, minus the total of all liabilities. Put another way, net worth is what is owned minus what is owed.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>LEASED PROPERTY</th>
							  </tr>
							  <tr>
							 <td>A lease is a contract outlining the terms under which one party agrees to rent property owned by another party. It guarantees the lessee, the tenant, use of an asset and guarantees the lessor, the property owner or landlord, regular payments from the lessee for a specified number of months or years. Thus, a lease is a contractual arrangement calling for the lessee to pay the lessor (owner) for use of an asset. Renting, also known as hiring or letting, is an agreement where a payment is made for the temporary use of a good, service or property owned by another.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>MEANS OF FINANCE</th>
							  </tr>
							  <tr>
							 <td>After the cost of the project has been determined, the next question that arises is how the cost of the project is going to be met, who are the persons who are going to subscribe to the capital and what are the other sources from which the funds are likely to come.</td>
							  </tr>
							  <tr>
							 <td>While raising the resources to meet the cost of the project proper financial planning is an imperative.  You need to carefully map-out the different sources of finance, and the cost of availing the required finance.  Obviously your investment in the project is most critical.  Higher is your investment, lower will be the expenditure towards servicing of loans.  Ideally, a ratio of 1 : 1, that is 50% of your own investment, and 50% of loan will not burden the project much.  However, banks and financial institutions do go up to a ratio of 2 : 1, which means 33% of the project cost will be met by your personal investment, 66% of the project cost will be met out of loans.  However, some of the banks and financial institutions do go up to 3 : 1, which means 25% of the project cost will be met by your own investment and 75% will be met out of the loans which you raise.   The loans could be institutional loans or loans availed from your friend and relatives. Generally, the loans availed by your from friends and relatives is kept out of picture while calculating the ratio of either 2 : 1 or 3 : 1.  But, it is prudent, although harsher, to take all the loans into cognizance, because, at the end of the day you need to repay the loans, be it that of an institution or a friend.  The bottom line is that the revenue generated by your business should be capable of fully meeting the interest cost and the repayment of the loan installments.    </td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>PROMOTERS' CAPITAL/EQUITY</th>
							  </tr>
							  <tr>
							 <td>The first obvious of funds for any project is the capital contributed by the persons promoting the project.  They are the persons who have conceived the project, intend launching it and are likely to be its beneficiaries.</td>
							  </tr>
							  <tr>
							 <td>The capital contributed by the promoters is termed differently in financial parlance depending on the constitution of the industrial enterprise.  It is called, the case of proprietary concerns.  "Proprietor's Capital," in the case of "Hindu </td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Undivided Families, it is called "Capital Contributed By HUF." And, in the case of partnership, "Partners' Capital."  On the other hand, in the case of limited companies, public or private, it is referred to as equity and/or preference shares subscribed to by promoters.</td>
							  </tr>
							  <tr>
							 <td>Proprietor's capital is the capital contributed by the proprietor as his share in financing the project, of which he is the sole beneficiary.  As Proprietor's capital being the substratum on which the edifice of industrial project is built, it is not allowed by the lending agencies to be withdrawn during the period of the loan is in currency.  By definition, the proprietor's capital will not be eligible for payment of any interest.  </td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>DEBT</th>
							  </tr>
							  <tr>
							 <th>WHAT IS 'DEBT?'</th>
							  </tr>
							  <tr>
							 <td>Debt is an amount of money borrowed by one party from another. Debt is used by many corporations and individuals as a method of making large purchases that they could not afford under normal circumstances. A debt arrangement gives the borrowing party permission to borrow money under the condition that it is to be paid back at a later date, usually with interest.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>BREAKING DOWN 'Debt'</th>
							  </tr>
							  <tr>
							 <td>The most common forms of debt are loans, including mortgages and auto loans, and credit card debt. Under the terms of a loan, the borrower is required to repay the balance of the loan by a certain date, typically several years in the future. The terms of the loan also stipulate the amount of interest that the borrower is required to pay annually, expressed as a percentage of the loan amount. Interest is used as a way to ensure that the lender is compensated for taking on the risk of the loan while also encouraging the borrower to repay the loan quickly in order to limit his total interest expense.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>CORPORATE DEBT</th>
							  </tr>
							  <tr>
							 <td>In addition to loans and credit card debt, companies that need to borrow funds have other debt options. Bonds and commercial paper are common types of corporate debt that are not available to individuals.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Bonds are a type of debt instrument that allow a company to generate funds by selling the promise of repayment to investors. Both individuals and institutional investment firms can purchase bonds, which typically carry a set interest, or coupon, rate. If a company needs to raise ₹1 million to fund the purchase of new equipment, for example, it can issue 1,000 bonds with a face value of ₹1,000 each. Bondholders are promised repayment of the face value of the bond at a certain date in the future, called the maturity date, in addition to the promise of regular interest payments throughout the intervening years. Bonds work just like loans, except the company is the borrower, and the investors are the lenders, or creditors.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Commercial paper is simply short-term corporate debt with a maturity of 270 days or less.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>GOOD DEBT VS. BAD DEBT</th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>In corporate finance, there is a lot of attention paid to the amount of debt a company has. A company that has a large amount of debt may not be able to make its interest payments if sales drop, putting the business in danger of bankruptcy. Conversely, a company that uses no debt may be missing out on important expansion opportunities.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Different industries use debt differently, so the 'right' amount of debt varies from business to business. When assessing the financial standing of a give company, therefore, various metrics are used to determine if the level of debt, or leverage, the company uses to fund operations is within a healthy range.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Bad Debt is referred to as "Non-Performing Asset (NPA),' and Good Debt is expressed as "Standard Asset."</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <th>UNSECURED DEBT</th>
							  </tr>
							  <tr>
							 <td>A debt (also referred to as a loan) that is not backed by any security, either primary or collateral is called an "unsecured debt or loan."  This is also called "signature loan."</td>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <th>SECURED DEBT</th>
							  </tr>
							  <tr>
							 <td>Secured loans are those loans that are protected by an asset or collateral of some sort. The item purchased, such as a home or a car, can be used as collateral, and a lien is placed on such item. The finance company or bank will hold the deed or title until the loan has been paid in full, including interest and all applicable fees. Other items such as stocks, bonds, or personal property can be put up to secure a loan as well. </td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Secured loans are usually the best (and only) way to obtain large amounts of money. A lender is not likely to loan a large amount with assurance that the money will be repaid. Putting your home or other property on the line is a fairly safe guarantee that you will do everything in your power to repay the loan. </td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Secured loans are not just for new purchases either. Secured loans can also be home equity loans or home equity lines of credit. Such loans are based on the amount of home equity, which is simply the current market value of your home minus the amount still owed. Your home is used as collateral and failure to make timely payments could result in losing your home.  Secured loans usually offer lower rates, higher borrowing limits and longer repayment terms than unsecured loans. As the term implies, a secured loan means you are providing 'security' that your loan will be repaid according to the agreed terms and conditions. It's important to remember, if you are unable to repay a secured loan, the lender has recourse to the collateral you have pledged and may be able to sell it to pay off the loan. </td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td></td>
							  </tr>
							  <tr>
							 <th>DEBT EQUITY RATIO (DER)</th>
							  </tr>
							  <tr>
							 <td>This is one of the important financial ratios. It indicates the relationship between the loan capital and the capital raised by way of equity. </td>
							  </tr>
							  <tr>
							 <td>A good equity base always places the unit in a comfortable position, while a large loan portfolio will make the financial commitment of the firm precarious.  </td>
							  </tr>
							  <tr>
							 <td>A debt equity ratio of 1:1 represents an ideal situation.  This is the "high-point" of the financial comfort of the firm. </td>
							  </tr>
							  <tr>
							 <td>On the other hand, a debt equity ratio of 5:1 gives a very narrow equity base making the incidence of interest unduly high. This is the "low-point" of the financial comfort of the firm.</td>
							  </tr>
							  <tr>
							 <td>However, a debt equity ratio of 2:1 would meet the cannons of financial propriety. </td>
							  </tr>
							  <tr>
							 <td>The formula for calculation the DER is D/E=DER, where D refers to Debt, E refers to Equity, and DER refers to Debt Equity Ratio. </td>
							  </tr>
							  <tr>
							 <td>It's prudent to keep the debt portion as low as possible, because, higher the debt, higher will be the interest costs, which directly impacts the profitability.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>WORKING CAPITAL</th>
							  </tr>
							  <tr>
							 <td>Working capital (abbreviated WC) is a financial metric which represents operating liquidity available to a business, organization or other entity, including governmental entity. Along with fixed assets such as plant and equipment, working capital is considered a part of operating capital. Gross working capital is equal to current assets. Working capital is calculated as current assets minus current liabilities.  If current assets are less than current liabilities, an </td>
							  </tr>
							  <tr>
							 <td>entity has a working capital deficiency, also called a working capital deficit.  In the Indian situation 40% of the turnover is considered as working capital margin.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>PROFIT MARGIN</th>
							  </tr>
							  <tr>
							 <td>It is the amount by which revenue from sales exceeds costs in a business.</td>
							  </tr>
							  <tr>
							 <td>Profit margin is calculated with selling price (or revenue) taken as base times 100. It is the percentage of selling price that is turned into profit, whereas 'profit percentage' or 'markup' is the percentage of cost price that one gets as profit on top of cost price. While selling something one should know what percentage of profit one will get on a particular investment, so companies calculate profit percentage to find the ratio of profit to cost.</td>
							  </tr>
							  <tr>
							 <td>The profit margin is used mostly for internal comparison. It is difficult to accurately compare the net profit ratio for different entities. Individual businesses' operating and financing arrangements vary so much that different entities are bound to have different levels of expenditure, so that comparison of one with another can have little meaning. A low profit margin indicates a low margin of safety: higher risk that a decline in sales will erase profits and result in a net loss, or a negative margin.</td>
							  </tr>
							  <tr>
							 <td>Profit margin is an indicator of a company's pricing strategies and how well it controls costs. Differences in competitive strategy and product mix cause the profit margin to vary among different companies.</td>
							  </tr>
							  <tr>
							 <td> If an investor makes ₹10 revenue and it cost him ₹1 to earn it, when he takes his cost away he is left with 90% margin. He made 900% profit on his $1 investment.</td>
							  </tr>
							  <tr>
							 <td> If an investor makes ₹10 revenue and it cost him ₹5 to earn it, when he takes his cost away he is left with 50% margin. He made 100% profit on his $5 investment.</td>
							  </tr>
							  <tr>
							 <td> If an investor makes ₹10 revenue and it cost him ₹9 to earn it, when he takes his cost away he is left with 10% margin. He made 11.11% profit on his ₹9 investment.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>TURNOVER</th>
							  </tr>
							  <tr>
							 <td>Business turnover is a numeric value representing total sales. It is essentially the value of sales you make in a set period. It is generally measured over a year's period, whether that's the calendar year, tax year or fiscal year.  In other words, the annual sales volume net of all discounts and sales taxes. It indicates the number of times an asset (such as cash, inventory, raw materials) is replaced or revolves during an accounting period. Turnover is an accounting term that calculates how quickly a business collects cash from accounts receivable or how fast the company sells its inventory.</td>
							  </tr>
							  <tr>
							 <th>BREAKING DOWN 'TURNOVER'</th>
							  </tr>
							  <tr>
							 <td>Two of the largest assets owned by a business are accounts receivable and inventory. Both of these accounts require a large cash investment, and it is important to measure how quickly a business collects cash. Turnover ratios calculate how quickly a business collects cash from its accounts receivable and inventory investments.</td>
							  </tr>
							  <tr>
							 <th>How Accounts Receivable Turnover Is Calculated?</th>
							  </tr>
							  <tr>
							 <td>Accounts receivable represents the total amount of unpaid customer invoices at any point in time. Assuming that credit sales are sales not immediately paid in cash, the accounts receivable turnover formula is credit sales divided by average accounts receivable. The average accounts receivable is simply the average of the beginning and ending accounts receivable balances for a particular time period, such as a month or year.</td>
							  </tr>
							  <tr>
							 <td>The accounts receivable turnover formula tells you how quickly you are collecting payments, as compared to your credit sales. If credit sales for the month total ₹300,000 and the account receivable balance is ₹50,000, for example, the turnover rate is six. The goal is to maximize sales, minimize the receivable balance, and generate a large turnover rate.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>BREAK-EVEN POINT</th>
							  </tr>
							  <tr>
							 <td>This is the most important parameter to know the level of production/sales at which the enterprise breaks even, that is, neither makes profits nor incurs losses.  </td>
							  </tr>
							  <tr>
							 <td>There are two ways to go about calculating the break-even point.  First, where the enterprise breaks even taking only the variable costs into consideration.  Second, at which the enterprise breaks even taking both the variable and the fixed costs into consideration.</td>
							  </tr>
							  <tr>
							 <td>The formula for calculating the break-even point is as below:</td>
							  </tr>
							  <tr>
							 <td>1.     Variable Costs / Total Sales (per annum)</td>
							  </tr>
							  <tr>
							 <td>2.     Fixed Costs + Variable Costs / Total Sales (per annum)</td>
							  </tr>
							  <tr>
							 <td>It is financially prudent to calculate the break-even point based on the second formula since it covers all the costs and there is chance of the enterprise incurring a loss, so long as the break-even point is met.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>PRODUCT COSTING</th>
							  </tr>
							  <tr>
							 <td>Production cost refers to the cost incurred by a business when manufacturing a good or providing a service. Production costs include a variety of expenses including, but not limited to, labor, raw materials, consumable manufacturing supplies and general overhead. Additionally, any taxes levied by the government or royalties owed by natural resource extracting companies are also considered production costs.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>BREAKING DOWN 'PRODUCTION COST'</th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Also referred to as the cost of production, production costs include expenditures relating to the manufacturing or creation of goods or services. For a cost to </td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>qualify as a production cost it must be directly tied to the generation of revenue for the company. Manufacturers experience product costs relating to both the materials required to create an item as well as the labor need to create it. Service industries experience production costs in regards to the labor required to provide the service as well as any materials costs involved in providing the aforementioned service.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>In production, there are direct costs and indirect costs. For example, direct costs for manufacturing an automobile are materials such as the plastic and metal materials used as well as the labor required to produce the finished product. Indirect costs include overhead such as rent, administrative salaries or utility expenses.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>DERIVING UNIT COSTS FOR PRODUCT PRICING</th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>To figure out the cost of production per unit, the cost of production is divided by the number of units produced. Once the cost per unit is determined, the information can be used to help develop an appropriate sales price for the completed item. In order to break even, the sales price must cover the cost per unit. Amounts above the cost per unit are often seen as profit while amounts below the cost per unit result in losses.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>If the cost of producing a product outweighs the price that is paid for it, this may lead producers to consider temporarily ceasing operations. For example, in January 2017, the selling price of a barrel of oil fell to ₹40 a barrel. With product costs varying from ₹20 to ₹50 a barrel, a cash negative situation occurs for those with production costs on the higher end. Those producers may choose to cease production efforts until sale prices return to profitable levels which lowers the amount of supply available within the market and may encourage oil prices to rise based on the shifting supply and demand models.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>PRODUCTION COSTS AND ASSET RECORDING</th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Once a product is complete, it can be recorded as a company asset until the product is sold. This allows the value of the product to be accounted for within financial statements and other accounting documents, and provides a way to keep shareholders informed and reporting requirements to be met.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>CASH FLOW</th>
							  </tr>
							  <tr>
							 <td>Cash flow is the net amount of cash and cash-equivalents moving into and out of a business. Positive cash flow indicates that a company's liquid assets are increasing, enabling it to settle debts, reinvest in its business, return money to shareholders, pay expenses and provide a buffer against future financial challenges. Negative cash flow indicates that a company's liquid assets are decreasing. Net cash flow is distinguished from net income, which includes accounts receivable and other items for which payment has not actually been received. Cash flow is used to assess the quality of a company's income, that is, how liquid it is, which can indicate whether the company is positioned to remain solvent.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>BREAKING DOWN 'CASH FLOW'</th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>The accrual accounting method allows companies to count their chickens before they hatch, so to speak, by considering credit as part of a company's income. 'Accounts receivable' and 'settlement due from customers' can appear as line items in the assets portion of a company's balance sheet, but these items do not represent completed transactions, for which payment has been received. They do not, therefore, count as cash. (Note that the credit vs. cash distinction is not the same as it is in everyday terminology; proceeds from credit card transactions are considered cash once they are transferred.)</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>The opposite can also be true. A company may be receiving massive inflows of cash, but only because it is selling off its long-term assets. A company that is selling itself for parts may be building up liquidity, but it is limiting its potential for growth in the long term, and perhaps setting itself up to fail. In the same vein, a company may be taking in cash by issuing bonds and taking on unsustainable levels of debt. For these reasons it is necessary to view a company's cash flow statement, balance sheet and income statement together.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>DEPRECIATION</th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Depreciation is an accounting method of allocating the cost of a tangible asset over its useful life. Businesses depreciate long-term assets for both tax and accounting purposes.  For tax purposes, businesses can deduct the cost of the tangible assets they purchase as business expenses; however, businesses must depreciate these assets in accordance with AS (Accounting Standards) rules about how and when the deduction may be taken.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>BREAKING DOWN 'DEPRECIATION'</th>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>Depreciation is often a difficult concept for accounting students as it does not represent real cash flow. Depreciation is an accounting convention that allows a company to write-off the value of an asset over time, but it is considered a non-cash transaction.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <th>DEPRECIATION EXAMPLE</th>
							  </tr>
							  
							  <tr>
							 <td>For accounting purposes, depreciation expense does not represent a cash transaction, but it indicates how much of an asset's value has been used up over time. For example, if a company buys a piece of equipment for ₹50,000, it can either write the entire cost of the asset off in year one, or it can write the value of the asset off over the life of the asset, which is 10 years. This is why business owners like depreciation. Most business owners prefer to expense only a portion of the cost, which artificially boosts net income. In addition, the equipment can be scrapped for ₹10,000, which means it has a salvage value of ₹10,000. Using these variables the analyst calculates depreciation expense as the difference between the cost of the asset and the salvage value, divided by the useful life of the asset. The calculation in this example is: (₹50,000 - ₹10,000) / 10, which is ₹4,000.</td>
							  </tr>
							  <tr>
							 <tr><td><br/></td></tr>
							  </tr>
							  <tr>
							 <td>This means the company's accountant does not have to write off the entire ₹50,000, even though it paid out that amount in cash. Instead, the company only has to expense ₹4,000 against net income. The company expenses another ₹4,000 next year, and another ₹4,000 the year after that, and so on, until the value of the equipment is completely written off in year 10.</td>
							  </tr>
							  <tr><td><br/></td></tr>
							  <tr>
							 <th>GOODS AND SERVICES TAX (GST)</th>
							  </tr>
							  <tr>
							 <td>Goods and Services Tax (GST) is an indirect tax which was introduced in India on 1 July 2017 and was applicable throughout India which replaced multiple cascading taxes levied by the central and state governments. It was introduced as The Constitution (One Hundred and First Amendment) Act 2017,  following the passage of Constitution 122nd Amendment Act Bill. The GST is governed by a GST Council and its Chairman is the Finance Minister of India. Under GST, goods and services are taxed at the following rates, 0%, 5%, 12% ,18% and 28%. There is a special rate of 0.25% on rough precious and semi-precious stones and 3% on gold.  In addition a cess of 22% or other rates on top of 28% GST applies on few items like aerated drinks, luxury cars and tobacco products.  GST replaced a slew of indirect taxes with a unified tax and is therefore set to dramatically reshape the country's 2 trillion dollar economy.</td>
							  </tr>
							  <tr>
							 <td><br/></td>
							  </tr>
							 
							  <tr>
							 <th>PROFIT BEFORE TAX</th>
							  </tr>
							  <tr>
							 <td>Profit before tax (PBT) is a profitability measure that looks at a company's profits before the company has to pay corporate income tax by deducting all expenses from revenue including interest expenses and operating expenses except for income tax. Also referred to as 'earnings before tax' or 'pretax profit', this measure combines all of the company's profits before tax, including operating, non-operating, continuing operations and non-continuing operations. PBT exists because tax expense is constantly changing, and taking it out helps give an investor a good idea of changes in a company's profits or earnings from year to year.</td>
							  </tr>
							  <tr>
							<td><br/></td>
							  </tr>
							  <tr>
							 <th>BREAKING DOWN 'PROFIT BEFORE TAX' - PBT</th>
							  </tr>
							  <tr>
							 <td>PBT (also referred to as 'Earnings Before Tax') may be listed on a company's income statement. It is typically the third to last line on the income statement as the second to last line is the total income tax expense followed by total net income displayed at the bottom.</td>
							  </tr>
							  <tr>
							<td><br/></td>
							  </tr>
							  <tr>
							 <th>CALCULATION OF PBT</th>
							  </tr>
							  
							  <tr>
							 <td>PBT encompasses all income earned regardless of source. This includes sales, commissions, service revenue and interest. All expenses are subsequently deducted except for corporate income tax. Additionally, EBT may be calculated by taking the net income of an organization and adding the corporate income tax.</td>
							  </tr>
							  <tr>
							 <td><br/></td>
							  </tr>
							  
							  <tr>
							 <th>PROFIT AFTER TAX</th>
							  </tr>
							  <tr>
							 <td>Profit After Tax is the total amount that a business earns after all tax deductions have taken place. It is used as a barometer to determine how much a business really earns and how much it can utilize for it's day to day activities. Profit after tax is also seen as a measure of a company's profitability after all its expenses have been deducted and can be fully utilized by the company to conduct its business. Shareholders are also paid dividends from this amount.  Profit after tax is often a better assessment of what a business is really earning and hence can use in its operations than its total revenues.</td>
							  </tr>
							 
							  <tr>
							 <td><br/></td>
							  </tr>
							  <tr>
							 <th>SUNDRY DEBTORS</th>
							  </tr>
							  <tr>
							 <td><br/></td>
							  </tr>
							  <tr>
							 <td>When a business firm supplies goods or provides services to its customers on credit basis then those customers are called as sundry debtors. These customers are supposed to pay the outstanding amount on a particular date. They are also referred to as "accounts receivables" or "trade debtors."</td>
							  </tr>
							  <tr>
							 <td><br/></td>
							  </tr>
							  <tr>
							 <th>What is Accounts Receivables? </th>
							  </tr>
							  <tr>
							 <td>"Accounts receivable" means the dues from the customers. "Accounts receivable" is also known as Sundry Debtor Account or Customers Account.  Almost all business firms sell their goods on credit basis. No business firm can survive if they do not provide credit facilities to the customers keeping in view the competition in the market. So, at a particular point of time what is to be received from the customers against the sale of goods or services, is called as accounts receivables.</td>
							  </tr>
							  <tr>
							 <td>The collection department must be efficient, regular, and punctual in the collection of dues.  But, the reality one should be conscious of is that it is easy to sell, and provide goods and services, respectively, on credit; but, it is difficult to collect the dues from the customers on time.</td>
							  </tr>
							 
							  <tr>
							 <td><br/></td>
							  </tr>
							  <tr>
							 <th>SUNDRY CREDITORS</th>
							  </tr>
							  <tr>
							 <td>Any firm/person who supplies or provides goods and services, respectively, or consumable items to a business firm on credit basis, is referred to as sundry creditor by the firm who avails this facility. The suppliers of various items relating to expenses on credit, are also called sundry creditors.</td>
							  </tr>
							  <tr>
							 <td>Sundry creditors are the liabilities of the firm because the firm is supposed to pay the outstanding amount in future as per the terms and conditions agreed upon by both the parties.  They are also referred to as &lsquo;trade creditors." But at the time of preparing the final accounts, the amount payable to the creditor is shown as sundry creditors.</td>
							  </tr>
							</table>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
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
  setInterval(function(){ 
      var exp='<?php echo $expdat;?>';
		$.ajax({
			type:'POST',
			url:'chksession.php',
			data:'exp='+exp,
			success:function(res){
				if(res == 0)
				{
					alert('Sorry! Session Expired. Pay and Start Again.');
					window.location.href="myprofile.php";
				}
			}
		});
	}, 300000);
	 setInterval(function(){ 
	 var exp='<?php echo $expdat;?>';
		$.ajax({
			type:'POST',
			url:'gettime.php',
			data:'exp='+exp,
			success:function(res){
				$('#timecount').text('Time Left : '+res);
			}
		});
	}, 1000);
</script>
<script src="js/jquery.validate.js"></script>
<!--<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>-->
<script src="js/canvas.js"></script>
<script src="js/script.js"></script>
<script src="js/accounting.js"></script>
<script>
function proj_chart()
{	
	var cursign=localStorage.getItem('cursign');
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
</script>
</html>