 <tr>
        <td class="sidebox">
            <div class="tabber" id="tab1">
                <div class="tabbertab" >
                    <h2><a name="tab1"> Latest News  </a></h2>
                    <div style="clear:both;overflow:auto;height:240px;width:286px;overflow-x:hidden;" >
                        <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        	<?php
                        		$LACat = findAllCat($catid);
                        		$latest_Num = 0;
                        		if(trim($LACat) != "")
                        		{
                        			$latest_Sql = "select * from tbl_news where catid in($LACat) and activate='Yes' order by newsid desc limit 0,10";
                        		}
                        		else
                        		{
	                        		$latest_Sql = "select * from tbl_news where activate='Yes' order by newsid desc limit 0,10";
	                        	}	                        		
                        		$latest_Res = mysql_query($latest_Sql);
                        		if($latest_Res)
                        		{
                        			$latest_Num = mysql_num_rows($latest_Res);
                        			if($latest_Num > 0)
                        			{
                        				while($latest_Row = mysql_fetch_array($latest_Res))                        				
                        				{
                        					$LImg = "admin/newsphotos/thumbs/".$latest_Row['image'];
									?>
													<tr>
  														<td width="55px" style="border-bottom:1px dotted #000;padding:2px;padding-top:5px;" align="center" >
  															<a href="filmnews.php?newsid=<?php echo $latest_Row[newsid];?>&catid=<?php echo $latest_Row[catid];?>">
																<img border="0" src="<?php echo $LImg; ?>"  width="65" height="50" style="border:1px solid #000;"  />
															</a>
  														</td>
  														<td width="250px" valign="top"  style="border-bottom:1px dotted #000;">
															<div class="t-videotext1">
																<a href="filmnews.php?newsid=<?php echo $latest_Row[newsid];?>&catid=<?php echo $latest_Row[catid];?>">	
	 																<?php
	 																	$Title = $latest_Row['title'];
	 																	$Title = str_replace('\\',"",$Title);
	 																	if(strlen($Title) > 40)
	 																	{
	 																		echo substr($Title,0,40)."...";
	 																	}
	 																	else
	 																	{
	 																		echo $Title;
																		}
	 																?>
																</a>
															</div>
															<div class="t-video" style="clear:both;">
																&nbsp;&nbsp;&nbsp;Views : <?php echo getDetails($latest_Row['newsid'],"newsid","view","tbl_newsview"); ?>
															</div>
  														</td>
 													</tr>
									<?php
                        				}
                        			}
                        		}
                        	?>                                                        
                        </table>
                    </div>
                </div>
                <div class="tabbertab">
                    <h2>Top Viewed</h2>
                    <div style="clear:both;overflow:auto;height:240px;width:286px;overflow-x:hidden;" >                        
                        <table width="98%" border="0" cellspacing="0" cellpadding="0">
                            <?php
                            	$TACat = findAllCat($catid);
                        		$top_Num = 0;
                        		if(trim($TACat) != "")
                        		{
                        			$top_Sql = "select * from tbl_news tn,tbl_newsview tnv where tn.catid in($TACat) and tn.newsid=tnv.newsid and tn.activate='Yes' order by tnv.view desc limit 0,10";                        			
                        		}
                        		else
                        		{
                        			$top_Sql = "select * from tbl_news tn,tbl_newsview tnv where tn.newsid=tnv.newsid and tn.activate='Yes' order by tnv.view desc limit 0,10";
                        		}
                        		
                        		$top_Res = mysql_query($top_Sql);
                        		if($top_Res)
                        		{
                        			$top_Num = mysql_num_rows($top_Res);
                        			if($top_Num > 0)
                        			{
                        				while($top_Row = mysql_fetch_array($top_Res))                        				
                        				{
                        					$TImg = "admin/newsphotos/thumbs/".$top_Row['image'];
									?>
													<tr>
  														<td width="55px" style="border-bottom:1px dotted #000;padding:2px;padding-top:5px;" align="center" >
  															<a href="filmnews.php?newsid=<?php echo $top_Row[newsid];?>&catid=<?php echo $top_Row[catid];?>">
																<img border="0" src="<?php echo $TImg; ?>"  width="65" height="50" style="border:1px solid #000;" />
															</a>
  														</td>
  														<td width="250px" valign="top"  style="border-bottom:1px dotted #000;">
															<div class="t-videotext1">
																<a href="filmnews.php?newsid=<?php echo $top_Row[newsid];?>&catid=<?php echo $top_Row[catid];?>">
	 																<?php
	 																	$Title = $top_Row['title'];
	 																	$Title = str_replace('\\',"",$Title);
	 																	if(strlen($Title) > 40)
	 																	{
	 																		echo substr($Title,0,40)."...";
	 																	}
	 																	else
	 																	{
	 																		echo $Title;
																		}
	 																?>
																</a>	
															</div>
															<div class="t-video" style="clear:both;">
																&nbsp;&nbsp;&nbsp;Views : <?php echo getDetails($top_Row['newsid'],"newsid","view","tbl_newsview"); ?>
															</div>
  														</td>
 													</tr>
									<?php
                        				}
                        			}
                        		}
                        	?>                            
                        </table>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>           
            <div align="center" style="padding-top:2px;padding-bottom:2px;">               	
					<?php
						$Topad="select * from adv_gallery where gid=1 and activate='Yes'";
						$TopRes=mysql_query($Topad);
						$Topnum=mysql_num_rows($TopRes);						 
						if($Topnum>0)
						{
							$TopSel=mysql_fetch_array($TopRes);
							if($TopSel['googlelink']!="")
							{?>
								<a target="_blank" href="<?php echo $TopSel['links'];?>"><?php echo $TopSel['googlelink'];?></a>
							<?php 
							}
							else
							{
						$TopImg=$TopSel['image'];
						$TopSrc='admin/advertisement/'.$TopImg;																													
					?>						
							  <a target="_blank" href="<?php echo $TopSel['links'];?>"><img border="0" src="<?php echo $TopSrc;?>" width="300" height="250"></a>
					<?php
						}
					}	
					 ?>                            			  
            </div>
        </td>
    </tr>
    
    <tr>
        <td class="sidebox">    
            <div class="sidebox-hading">Photogallery</div>					       
            <div class="inner-photo-gallery-sec">
                <div class="tabs">
                    <ul class="tabNavigation">
                        <li class="first">
                            <a class="selected" id="photogallery1a" href="javascript:;" onclick="showTab(1,'photogallery');">
                                Latest Photos
                            </a>
                        </li>
                        <li class="second">
                            <a class="" id="photogallery2a" href="javascript:;" onclick="showTab(2,'photogallery');">
                                Popular
                            </a>
                        </li>
                        <li class="last">
                            <a class="" id="photogallery3a" href="javascript:;" onclick="showTab(3,'photogallery');">Wallpaper</a>
                        </li>
                    </ul>
                    <div id="photogallery1" style="display: block;">
                        <div style="display: block;" id="first">
                            <div class="new_sec">
                                <ul class="news-links">
  												<?php
													$results=excutequery("SELECT * FROM tbl_gallery_wrapper where starid!=0 and activate='Yes' order by id desc limit 6");
													if(countrows($results)>0)
													{
														$i = 1;
														while($rows=fetchdata($results))        
														{        
															$Class_Name = "";
															if($i %3 == 0)
															{
																$Class_Name = "last";
															}	                                        	
	                                        	$StarID = $rows['starid'];        
	                                       	if($StarID != 0)        
	                                        	{        
	                                        		$CatID = 0;        
	                                        	}        
	                                        	else        
	                                        	{        
	                                        		$CatID = $rows['catid'];        
	                                        	}        
	                                        	$ADate = $rows['posted_date'];        
	                                        	$imagepath = "admin/gallery_wrapper/".$rows['id']."/thumbnail/".$rows['image'];
												?>
		                                    	<li class="<?php echo $Class_Name;?>">
		                                       	<a href="photogallery.php?SID=<?php echo $StarID; ?>&ADate=<?php echo $ADate;?>" style="color:#000;">
		                                            <img border="0" src="<?php echo $imagepath; ?>" alt="Yemaindi ee vela" title="Yemaindi ee vela" border="0" width="90" height="91">
		                                            <?php
		                                            	$Title = str_replace('\\',"",$rows['title']);
		                                            	echo substr($Title,0,15); 
		                                            ?>
		                                        	</a>
		                                    	</li>
												<?php
															$i++;
														}
													}
													else 
													{
												?>
														<li><b>No records found</b></li>
												<?php		
													}	
												?>                                                                        
                                </ul>
                            </div>
                        </div>
                    </div>            
                    <div id="photogallery2" style="display: none;">
                        <div style="display: block;" id="second">
                            <div class="new_sec">
                                <ul class="news-links">
                                    <?php
													$results=excutequery("SELECT * FROM tbl_gallery_wrapper where starid!=0 and activate='Yes' order by views desc limit 6" );
													if(countrows($results)>0)
													{
														$i = 1;
														while($rows=fetchdata($results))        
														{        
															$Class_Name = "";
															if($i %3 == 0)
															{
																$Class_Name = "last";
															}	                                        	
	                                        	$StarID = $rows['starid'];        
	                                       	if($StarID != 0)        
	                                        	{        
	                                        		$CatID = 0;        
	                                        	}        
	                                        	else        
	                                        	{        
	                                        		$CatID = $rows['catid'];        
	                                        	}        
	                                        	$ADate = $rows['posted_date'];        
	                                        	$imagepath = "admin/gallery_wrapper/".$rows['id']."/thumbnail/".$rows['image'];
												?>
		                                    	<li class="<?php echo $Class_Name;?>">
		                                       	<a href="photogallery.php?SID=<?php echo $StarID; ?>&ADate=<?php echo $ADate;?>" style="color:#000;">
		                                            <img border="0" src="<?php echo $imagepath; ?>" alt="Yemaindi ee vela" title="Yemaindi ee vela" border="0" width="90" height="91">		                                            
			                                         <?php
		                                            	$Title = str_replace('\\',"",$rows['title']);
		                                            	echo substr($Title,0,15); 
		                                            ?>
		                                        	</a>
		                                    	</li>
												<?php
															$i++;
														}
													}
													else 
													{
												?>
														<li><b>No records found</b></li>
												<?php		
													}	
												?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="photogallery3" style="display: none;">
                        <div style="display: block;" id="third">
                            <div class="new_sec">
                                <ul class="news-links">
                                    <?php
													$results=excutequery("SELECT * FROM tbl_gallery_wrapper where catid=6 and starid!=0 and activate='Yes' order by id desc limit 6" );
													if(countrows($results)>0)
													{
														$i = 1;
														while($rows=fetchdata($results))        
														{        
															$Class_Name = "";
															if($i %3 == 0)
															{
																$Class_Name = "last";
															}	                                        	
	                                        	$StarID = $rows['starid'];        
	                                       	if($StarID != 0)        
	                                        	{        
	                                        		$CatID = 0;        
	                                        	}        
	                                        	else        
	                                        	{        
	                                        		$CatID = $rows['catid'];        
	                                        	}        
	                                        	$ADate = $rows['posted_date'];        
	                                        	$imagepath = "admin/gallery_wrapper/".$rows['id']."/thumbnail/".$rows['image'];
												?>
		                                    	<li class="<?php echo $Class_Name;?>">
		                                       	<a href="photogallery.php?SID=<?php echo $StarID; ?>&ADate=<?php echo $ADate;?>" style="color:#000;">
		                                            <img border="0" src="<?php echo $imagepath; ?>" alt="Yemaindi ee vela" title="Yemaindi ee vela" border="0" width="90" height="91" style="border:1px solid #000;">		                                            
		                                            <?php
		                                            	$Title = str_replace('\\',"",$rows['title']);
		                                            	echo substr($Title,0,15); 
		                                            ?>
		                                        	</a>
		                                    	</li>
												<?php
															$i++;
														}
													}
													else 
													{
												?>
														<li><b>No records found</b></li>
												<?php		
													}	
												?>
                                </ul>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>	
        </td>
    </tr>
    <tr>
        <td>
            <div align="center" style="padding-top:2px;padding-bottom:2px;">
                <?php
						$Topad="select * from adv_gallery where gid=2 and activate='Yes'";
						$TopRes=mysql_query($Topad);
						$Topnum=mysql_num_rows($TopRes);						 
						if($Topnum>0)
						{
							$TopSel=mysql_fetch_array($TopRes);
							if($TopSel['googlelink']!="")
							{?>
								<a target="_blank" href="<?php echo $TopSel['links'];?>"><?php echo $TopSel['googlelink'];?></a>
							<?php 
							}
							else
							{
						$TopImg=$TopSel['image'];
						$TopSrc='admin/advertisement/'.$TopImg;																												
						?>						
							  <a target="_blank" href="<?php echo $TopSel['links'];?>"><img border="0" src="<?php echo $TopSrc;?>" width="300" height="250"></a>
				<?php }
					}
					 ?>    
            </div>
        </td>
    </tr>
    <tr>
        <td class="sidebox">
            <div class="sidebox-hading" >
            	<?php            		
						if($catid==1 || $catid==16 || $catid==17)
           			{
           				echo "Entertainment ";	
           			}
            	?>
            	Video News
            </div>
			<div style="margin:5px;height:15px;"></div>
				<div class="tabber" id="tab4">
                <div class="tabbertab" >
                    <h2 style="width:30px;"><a name="tab4">Latest</a></h2>
                    <div style="clear:both;overflow:auto;height:240px;width:286px;overflow-x:hidden;" >
                    		<?php
                    			if($catid==1 || $catid==16 || $catid==17)
                    			{
                    				$Feature_Sql = "SELECT * FROM tbl_boxofficeview BV,tbl_boxoffice BO WHERE BO.videoid = BV.videoid and BO.activate='Yes' order by BO.videoid desc limit 0,6";
                    				$Img_Path = "admin/boxofficephotos/thumbs/";
                    				$href="boxofficevideo.php";
                    			}
                    			else 
                    			{
                    				$Feature_Sql = "SELECT * FROM tbl_video TV, tbl_videoview TVV WHERE TV.videoid=TVV.videoid and TV.activate='Yes' order by TV.videoid desc limit 0,6";
                    				$Img_Path = "admin/videoimage/thumbs/";
                    				$href="video.php";
                    			}
                    		?>
                        <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        	<?php
                        		$Feature_Num = 0;
                        		//$Feature_Sql = "SELECT * FROM tbl_video WHERE activate='Yes' order by videoid desc limit 0,6";
                        		//echo $Feature_Sql;
                        		$Feature_Res = mysql_query($Feature_Sql);
                        		if($Feature_Res)
                        		{
                        			$Feature_Num = mysql_num_rows($Feature_Res);
                        			if($Feature_Num > 0)
                        			{
                        				while($Feature_Row = mysql_fetch_array($Feature_Res))                        				
                        				{
                        					$StarID = $Feature_Row['starid'];        
                                    	if($StarID != 0)        
                                     	{        
                                     		$CatID = 0;        
                                     	}        
                                     	else        
                                     	{        
                                     		$CatID = $Feature_Row['catid'];        
                                     	}
                                     	$ADate = $Feature_Row['posted_date'];        
													$imagepath = $Img_Path.$Feature_Row['image'];                        					
									?>
													<tr>
  														<td width="55px" style="border-bottom:1px dotted #000;padding:2px;padding-top:5px;" align="center" >
  															<a href="<?php echo $href; ?>?videoid=<?php echo $Feature_Row[videoid]; ?>" style="color:#000;">
																<img border="0" src="<?php echo $imagepath; ?>"  width="65" height="50" style="border:1px solid #000;" />
															</a>
  														</td>
  														<td width="250px" valign="top"  style="border-bottom:1px dotted #000;">
															<div class="t-videotext1">
																<a href="<?php echo $href; ?>?videoid=<?php echo $Feature_Row[videoid]; ?>" style="color:#000;">
	 																<?php
	 																	$Title = $Feature_Row['title'];
	 																	$Title = str_replace('\\',"",$Title);
	 																	if(strlen($Title) > 80)
	 																	{
	 																		echo substr($Title,0,80)."...";
	 																	}
	 																	else
	 																	{
	 																		echo $Title;
																		}
	 																?>
																</a>
															</div>
															<div class="t-video" style="clear:both;">
																&nbsp;&nbsp;&nbsp;Views : <?php echo $Feature_Row['view']; ?>
															</div>
  														</td>
 													</tr>
									<?php
                        				}
                        			}
                        		}
                        	?>                                                        
                        </table>
                    </div>
                </div>                
                <div class="tabbertab">
                    <h2>Top Viewed</h2>
                    <div style="clear:both;overflow:auto;height:240px;width:286px;overflow-x:hidden;" >
                    		<?php
                    			if($catid==1 || $catid==16 || $catid==17)
                    			{
                    				$Top_Sql = "SELECT * FROM tbl_boxofficeview BV,tbl_boxoffice BO WHERE BV.videoid = BO.videoid and BO.activate='Yes' order by BV.view desc limit 0,6";
                    				$Img_Path = "admin/boxofficephotos/thumbs/";
                    				$href="boxofficevideo.php";
                    			}
                    			else 
                    			{
                    				$Top_Sql = "SELECT * FROM tbl_videoview BV,tbl_video BO WHERE BV.videoid = BO.videoid and BO.activate='Yes' order by BV.view desc limit 0,6";
                    				$Img_Path = "admin/videoimage/thumbs/";
                    				$href="video.php";
                    			}
                    		?>
                        <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        	<?php
                        		$Top_Num = 0;
                        		//$Top_Sql = "SELECT * FROM tbl_videoview BV,tbl_video BO WHERE BV.videoid = BO.videoid and BO.activate='Yes' order by BV.view desc limit 0,6";
                        		//echo $Top_Sql;
                        		$Top_Res = mysql_query($Top_Sql);
                        		if($Top_Res)
                        		{
                        			$Top_Num = mysql_num_rows($Top_Res);
                        			if($Top_Num > 0)
                        			{
                        				while($Top_Row = mysql_fetch_array($Top_Res))                        				
                        				{
                        					$StarID = $Top_Row['starid'];        
                                    	if($StarID != 0)        
                                     	{        
                                     		$CatID = 0;        
                                     	}        
                                     	else        
                                     	{        
                                     		$CatID = $Top_Row['catid'];        
                                     	}
                                     	$ADate = $Top_Row['posted_date'];        
													$imagepath = $Img_Path.$Top_Row['image'];                        					
									?>
													<tr>
  														<td width="55px" style="border-bottom:1px dotted #000;padding:2px;padding-top:5px;" align="center" >
  															<a href="<?php echo $href; ?>?videoid=<?php echo $Top_Row[videoid]; ?>" style="color:#000;">
																<img border="0" src="<?php echo $imagepath; ?>"  width="65" height="50" style="border:1px solid #000;"  />
															</a>
  														</td>
  														<td width="250px" valign="top"  style="border-bottom:1px dotted #000;">
															<div class="t-videotext1">
																<a href="<?php echo $href; ?>?videoid=<?php echo $Top_Row[videoid]; ?>" style="color:#000;">
	 																<?php
	 																	$Title = $Top_Row['title'];
	 																	$Title = str_replace('\\',"",$Title);
	 																	if(strlen($Title) > 40)
	 																	{
	 																		echo substr($Title,0,40)."...";
	 																	}
	 																	else
	 																	{
	 																		echo $Title;
																		}
	 																?>
																</a>
															</div>
															<div class="t-video" style="clear:both;">
																&nbsp;&nbsp;&nbsp;Views : <?php echo getDetails($Top_Row['videoid'],"videoid","view","tbl_videoview"); ?>
															</div>
  														</td>
 													</tr>
									<?php
                        				}
                        			}
                        		}
                        	?>                                                        
                        </table>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
           
                <div align="center" style="padding-top:2px;padding-bottom:2px;">
                <?php
						$Topad="select * from adv_gallery where gid=3 and activate='Yes'";
						$TopRes=mysql_query($Topad);
						$Topnum=mysql_num_rows($TopRes);						 
						if($Topnum>0)
						{
							$TopSel=mysql_fetch_array($TopRes);
							if($TopSel['googlelink']!="")
							{?>
								<a target="_blank" href="<?php echo $TopSel['links'];?>"><?php echo $TopSel['googlelink'];?></a>
							<?php 
							}
							else
							{
						$TopImg=$TopSel['image'];
						$TopSrc='admin/advertisement/'.$TopImg;																													
						?>						
							 <a target="_blank" href="<?php echo $TopSel['links'];?>"> <img border="0" src="<?php echo $TopSrc;?>" width="300" height="250"></a>
				<?php }
				  }
					 ?>    
            </div>                       
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>