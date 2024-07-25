<div class="vc_row wpb_row vc_row-fluid vc_custom_1508849149992">
	<div class="wpb_column vc_column_container vc_col-sm-12">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="rt-vc-title style1">
					<div class="vc_custom_1508849702754">
						<h2 style="font-size:30px;text-transform:uppercase;">What Do Our Students Say?</h2>
					</div>
				</div>
				<div class="rt-vc-testimonial">
					<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="{&quot;nav&quot;:false,&quot;dots&quot;:true,&quot;autoplay&quot;:true,&quot;autoplayTimeout&quot;:&quot;5000&quot;,&quot;autoplaySpeed&quot;:&quot;200&quot;,&quot;autoplayHoverPause&quot;:true,&quot;loop&quot;:true,&quot;margin&quot;:30,&quot;responsive&quot;:{&quot;0&quot;:{&quot;items&quot;:1},&quot;480&quot;:{&quot;items&quot;:2}}}">
						<?php
						$sql = "SELECT * FROM testimonial order by id asc limit 0,16 ";
						$res= selectall($sql);
						$c1=$c2=$c3=$c4=0;
						if(count($res)>0)
						{
							foreach($res as $data=>$val)
							{
							?>
								<div class="rt-item">
									<div class="rt-item-img"> <img width="92" height="92" src="http://www.rimsr.in/admin/images/testimg/<?php echo $val['image'];?>" class="img-circle wp-post-image" alt="" /></div>
									<div class="rt-item-content-holder">
										<h3 class="rt-item-title" style=""><?php echo $val['title'];?></h3>
										<span class="rt-item-designation" style=""><?php echo $val['location'];?></span>
										<p class="rt-item-content" style=""><?php echo strip_tags($val['description']);?></p>
									</div>
								</div>
							<?php								
							}
						}
						?>				
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>