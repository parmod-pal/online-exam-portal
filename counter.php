<?php
$sql = "SELECT * FROM counter order by id asc limit 0,4 ";
$res= selectall($sql);
$c1=$c2=$c3=$c4=0;
if(count($res)>0)
{
	foreach($res as $data=>$val)
	{
		$title=$val['title'];
		if($title=='Instructor')
		{
			$c1=$val['value'];
		}
		if($title=='New Courses')
		{
			$c2=$val['value'];
		}
		if($title=='Live Sessions')
		{
			$c3=$val['value'];
		}
		if($title=='Students')
		{
			$c4=$val['value'];
		}
	}
}
?>
<!--<div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1508848968428 vc_row-has-fill">
	<div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="rt-vc-counter ">
					<div class="rtin-left">
						<div class="rtin-counter" style="color:#ffffff;"><span class="rtin-counter-num" data-num="<?php echo $c1;?>" data-rtSpeed="5000" data-rtSteps="10"><?php echo $c1;?></span></div>
					</div>
					<div class="rtin-right">
						<div class="rtin-title" style="color:#ffffff;">PROFESSIONAL INSTRUCTORS</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="rt-vc-counter ">
					<div class="rtin-left">
						<div class="rtin-counter" style="color:#ffffff;"><span class="rtin-counter-num" data-num="<?php echo $c2;?>" data-rtSpeed="5000" data-rtSteps="10"><?php echo $c2;?></span></div>
					</div>
					<div class="rtin-right">
						<div class="rtin-title" style="color:#ffffff;">NEW COURSES EVERY YEAR</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="rt-vc-counter ">
					<div class="rtin-left">
						<div class="rtin-counter" style="color:#ffffff;"><span class="rtin-counter-num" data-num="<?php echo $c3;?>" data-rtSpeed="5000" data-rtSteps="10"><?php echo $c3;?></span></div>
					</div>
					<div class="rtin-right">
						<div class="rtin-title" style="color:#ffffff;">LIVE SESSIONS EVERY MONTH</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="rt-vc-counter ">
					<div class="rtin-left">
						<div class="rtin-counter" style="color:#ffffff;"><span class="rtin-counter-num" data-num="<?php echo $c4;?>" data-rtSpeed="5000" data-rtSteps="10"><?php echo $c4;?></span></div>
					</div>
					<div class="rtin-right">
						<div class="rtin-title" style="color:#ffffff;">REGISTERED STUDENTS</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>-->