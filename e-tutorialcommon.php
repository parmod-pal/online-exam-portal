	<?php 
	ob_start();
		include "header.php";
		$uid=isset($_SESSION['rim_usid'])?isset($_SESSION['rim_usid']):'';
		if($uid == '')
		{
			header('location:index.php');
			exit;
		} 
		/* $folder=isset($_REQUEST['f'])?$_REQUEST['f']:'';
		$title='';		
		if($folder == 'reference_books')
		{
			$title='E-Library';
		}
		else if($folder == 'quiz')
		{
			$title='Exercises/Quizes';
		}
		else if($folder == 'webcast')
		{
			$title='Webinars/Webcasts';
		}
		else
		{
			$title=ucfirst($folder);
		} */
		/* 
		password for each folder
		echo base64_encode('prm').'<br/>'.base64_encode('pdm').'<br/>'.base64_encode('fm').'<br/>'.base64_encode('hr').'<br/>'.base64_encode('scm').'<br/>'.base64_encode('hc').'<br/>'.base64_encode('blt').'<br/>'.base64_encode('bgd').base64_encode('other'); 
		echo base64_encode('ib').'<br/>'.base64_encode('gm').'<br/>'.base64_encode('bf');*/
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
															<h3 class="mt-10 text-center ftitle"></h3>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="Z20=" data-link="general_management">General<br/> Management</a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="YmY=" data-link="business_finance">Business<br/> Finance</a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn lh" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="Ymdk" data-link="big_data">Big-Data</a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="YmE=" data-link="business_analytics">Business <br/>Analytics</a>
															</div>
															<div class="clearfix"></div><br/>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="c2Nt" data-link="supply_chain_management">Supply-Chain<br/> Management</a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="cHJt" data-link="project_management">Project <br/>Management</a>
															</div>															
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="aWI=" data-link="international_business">International<br/> Business</a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="cm0=" data-link="risk_management">Risk <br/>Management</a>
															</div>
															<div class="clearfix"></div><br/>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="c3M=" data-link="saral_shikshak">Saral <br/>Shikshak</a>
															</div>
															
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="ZGw=" data-link="digital_literacy">Digital<br/> Literacy</a>
															</div>
															
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="cGRt" data-link="production_management">Production<br/> Management</a>
															</div>
															<div class="col-md-3 text-center">
																<a href="" class="qlink lnk btn" data-shortkey="" data-toggle="modal" data-target="#chkpass" data-key="b3RoZXI=" data-link="others">Self Development <br/>&amp; Others</a>
															</div>
															
																								
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
							<input type="hidden" id="skey" name="skey" class="form-control" value="">
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
		var f=localStorage.getItem('f');
		var k=localStorage.getItem('k');
		if(f == 'reference_books')
		{
			$('.ftitle').text("RIMSR's E-Library");
		}
		else if(f == 'quiz')
		{
			$('.ftitle').text("RIMSR's Exercises/Quizes");			
		}
		else if(f == 'webcast')
		{
			$('.ftitle').text("RIMSR's Webinars/Webcasts");			
		}
		else
		{
			$('.ftitle').text("RIMSR's "+ f.charAt(0).toUpperCase() + f.slice(1));
		}
		$('.qlink').attr('data-shortkey',k);
		
		$('.content').on('click','.ofile',function(e){
			e.preventDefault();
			var link=$(this).attr('data-link');
			var ref=$(this).attr('data-ref');
			var title=$(this).text().split('.');
			if(ref=='refbook')
			{
				var omyFrame = document.getElementById("myFrame");
				omyFrame.style.display="block";		
				omyFrame.src = "images/"+link;
			}
			else
			{
				var vid = document.getElementById("myVideo");				
				vid.src = "images/"+link;				
				vid.load();
			}
			$('.content #pg-title').text(title[0].split('_').join(' '));
		});
		
		$('.qlink').on('click',function(e){
			e.preventDefault();
			var link=$(this).attr('data-link');
			var skey=$(this).attr('data-key');
			var shkey=$(this).attr('data-shortkey');
			$('#fname').val(link);
			$('#hashval').val(skey);					
			$('#skey').val(shkey);
		});		
		$('body #afold').submit(function(e){
			e.preventDefault();
			$('#fsubmit').click();
		});
		$('#fsubmit').on('click',function(e){			
			e.preventDefault();
			var link=$('#fname').val();
			var skey=$('#hashval').val();
			var shkey=$('#skey').val();
			var pswd=$('#pswd').val();
			var typ='r';
			if(shkey=='wc')
			{
				typ='v';
			}
			$.ajax({
				type:'POST',
				url:'chkpass.php',
				data:'p='+pswd+'&k='+skey+'&sk='+shkey,
				success:function(res){
					if(res > 0)
					{
						$('#fcancel').click();
						$('.entry-title').text(link.toUpperCase());			
						$.ajax({
							type:'POST',
							url:'getfile.php',
							data:'t='+typ+'&title='+link+'&shkey='+shkey,
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