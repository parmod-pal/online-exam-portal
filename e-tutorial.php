<?php include "header.php";
$uid=isset($_SESSION['rim_usid'])?isset($_SESSION['rim_usid']):'';
if($uid == '')
{
	header('location:index.php');
	exit; 
}


?> 
	<style>
		.sidebar-widget-right{
			height: 430px;
			background: #fff none repeat scroll 0 0;
			border: 1px solid #e0e0e0;
			padding: 12px 25px;
			text-align: left;
		}
		.entry-banner {
			background: url('./images/moto.jpg') no-repeat scroll center;
			background-size:cover;
		}
		.mt-10{margin-top:10px;}
		.pl-20{padding-left:20px;}
	</style>
	<div id="content" class="site-content">
		<div class="entry-banner">
			<div class="container">
				<div class="entry-banner-content">
					<h1 class="entry-title">RIMSR’S LEARNING CENTER</h1>					
				</div>
			</div>
		</div>
		<div id="primary" class="content-area pt-100" style="background-color: #f5f5f5;">
			<div class="container abtus">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<main id="main" class="site-main">
							<article id="post-1225" class="post-1225 page type-page status-publish hentry">
								<div class="entry-content">
									<div class="vc_row wpb_row vc_row-fluid vc_custom_1510748400939">
										<div class="wpb_column vc_column_container col-md-12">
											<div class="vc_column-inner" style="padding: 30px;  background-color: #fff;">
												<div class="wpb_wrapper">
													<div class="wpb_text_column wpb_content_element ">
														<div class="wpb_wrapper content">	
															<a href="e-learning.php" class="btn btn-primary" style="float:right;color:#fff;">Home</a>
															<h3 class="mt-10 text-center">TUTORIALS</h3>
															<?php if(@$_SESSION['saral'] == 'saral'){ ?>
															
															    	<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal1" data-target="#chkpass1" data-key="c3M=" data-link="saral_shikshak"><img src="images/8.png" alt=""></a>
															</div>
															
															<?php }else{ ?> 
															    
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal1" data-target="#chkpass1" data-key="ZGw=" data-link="digital_literacy"><img src="images/d1.jpg" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="https://nefuniversity.skillport.com/skillportfe/login.action"target="_blank" ><img src="images/d2.jpg" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="https://nefuniversity.skillport.com/skillportfe/login.action"target="_blank" ><img src="images/d3.jpg" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="https://nefuniversity.skillport.com/skillportfe/login.action"target="_blank" ><img src="images/d4.jpg" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="https://nefuniversity.skillport.com/skillportfe/login.action"target="_blank" ><img src="images/d5.jpg" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="https://nefuniversity.skillport.com/skillportfe/login.action"target="_blank" ><img src="images/d6.jpg" alt=""></a>
															</div>
															<!--<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="ZGw=" data-link="digital_literacy"><img src="images/11.png" alt=""></a>
															</div>
															
															<!--<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="cHJt" data-link="project_management"><img src="images/1.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="cGRt" data-link="production_management"><img src="images/2.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="Zm0=" data-link="financial_management"><img src="images/3.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="aHI=" data-link="human_resources"><img src="images/4.png" alt=""></a>
															</div>
															<div class="clearfix"></div><br/>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="c2Nt" data-link="supply_chain_management"><img src="images/5.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="aGM=" data-link="health_care"><img src="images/6.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="Ymx0" data-link="business_laws_and_taxation"><img src="images/7.png" alt=""></a>
															</div>
														
															<div class="clearfix"></div><br/>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="cm0=" data-link="risk_management"><img src="images/9.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="YmE=" data-link="business_analytics"><img src="images/13.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="Ymdk" data-link="big_data"><img src="images/10.png" alt=""></a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="ZGw=" data-link="digital_literacy"><img src="images/11.png" alt=""></a>
															</div>
															<div class="clearfix"></div><br/>
															<div class="col-md-3 text-center">
															<a href="" class="qlink" data-toggle="modal" data-target="#chkpass" data-key="b3RoZXI=" data-link="others"><img src="images/12.png" alt=""></a>
															</div>	-->
															
															<?php } ?>
														</div>
													</div>
												</div>
											</div>
										</div>										
									</div>									
								</div>
							</article>
						</main>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="chkpass" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Folder Permission</h4>
				</div>
				<div class="modal-body">
					<form name="afold" action="" method="post" id="afold">			
						<div class="form-group">
							<label class="form-label" for="blname">Enter Password *</label>
							<input type="password" id="pswd" name="pswd" class="form-control" required value="">
							<input type="hidden" id="hashval" name="hashval" class="form-control" value="">
							<input type="hidden" id="fname" name="fname" class="form-control" value="">
						</div>				
						<input type="button" class="btn btn-primary" id="fsubmit" value="submit">
						<input class="btn btn-default" type="button" id="fcancel" data-dismiss="modal" value="cancel">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php";?>    
    <?php include "js-script.php";?>
	<script type="text/javascript">
	$(function(){
		
		$('.content').on('click','.ofile',function(e){
			e.preventDefault();
			var link=$(this).attr('data-link');
			var ref=$(this).attr('data-ref');
			var title=$(this).text().split('.');			
			var vid = document.getElementById("myVideo");				
			vid.src = "images/tutorials/"+link;				
			vid.load();
			
			$('.content #pg-title').text(title[0].split('_').join(' '));
		});
		$('.qlink').on('click',function(e){
			e.preventDefault();
			var link=$(this).attr('data-link');
			var skey=$(this).attr('data-key');
			$('#fname').val(link);
			$('#hashval').val(skey);					
		});		
		$('body #afold').submit(function(e){
			e.preventDefault();
			$('#fsubmit').click();
		});
		$('.qlink').on('click',function(e){			
			e.preventDefault();
			
			
			
			//alert();
			var link=$('#fname').val();
			var skey=$('#hashval').val();
			var pswd=$('#pswd').val();
			
			
            $('#fcancel').click();
            $('.entry-title').text(link.toUpperCase());			
            $.ajax({
            type:'POST',
            url:'gettutorial.php',
            data:'t=v&title='+link,
            success:function(res){								
            $('.content').html(res);
            }
            });
			
			return false;
			
			$.ajax({
				type:'POST',
				url:'chkpass.php',
				data:'p='+pswd+'&k='+skey,
				success:function(res){
					if(res > 0)
					{
						$('#fcancel').click();
						$('.entry-title').text(link.toUpperCase());			
						$.ajax({
							type:'POST',
							url:'gettutorial.php',
							data:'t=v&title='+link,
							success:function(res){								
								$('.content').html(res);
							}
						});
					}
					else
					{
						alert('Incorrect Password.');
					}
				}
			});
		});
	});
	</script>
</body>
</html>