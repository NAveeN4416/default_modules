	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
					if(!isset($slide_id))
					{
				?>
				<div class="col-md-10">
					<h1><?=getSystemString(75)?>
					<a href="<?=base_url('acp/new_slide')?>" class="btn btn-primary btn-small pull-right" style="color:#FFF" ><?=getSystemString(78)?></a>
					</h1>
		          <div class="panel white" style="padding-bottom: 50px;">
			         <table class="table table-hover sortable-tb sortable-1" id="slider_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(38)?></th>
<!-- 						         <th><?=getSystemString(271)?></th> -->
						         <th><?=getSystemString(14)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th colspan="2"><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($slides)){
							         $i = 0;
							        foreach($slides as $row){
								       $i++;
								       $dt = new DateTime($row->Date);
								       ?>
								       <tr id="<?=$row->Slide_ID;?>">
									       <td class="hide"><?=$row->Slide_ID;?></td>
									       <td class="index hide"><?=$i;?></td>
									       <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
									       <?PHP $tit_nn = 'Title_'.$__lang; ?>
									       <td><?=$row->$tit_nn;?></td>
									       
<!--
									        <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Caption_Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Caption_Status) { echo 'checked'; } ?> name="scstatus<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Caption_Status) { echo 'checked'; } ?>  name="scstatus<?=$i?>">
												</div>
											</td>
-->
									       
									       <td><img src="<?=base_url($GLOBALS['img_slides_dir']).$row->Slide_Image;?>" alt='slide image' style="width: 40px;"></td>
									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
												</div>
											</td>
											<td>
												<div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editSlide/'.$row->Slide_ID.'/')?>">
                                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                                      </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  <li>
														  		<a href="<?=base_url($__controller.'/deleteSlide/'.$row->Slide_ID.'/')?>" onclick="return confirm('<?=getSystemString(45)?>');" style="margin: 0px 5px;" class="delete-record dropdown-item">
															  		<i class="fa fa-trash"></i>  <?=getSystemString(314)?>
															  	</a>
														  </li>
														</ul>
			   									</div>
											</td>
								       </tr>
								       <?PHP
							        }
						         } else {
							          ?>
							         <tr><td colspan='5' class='text-center'><?=getSystemString(46)?></td></tr>
							         <?PHP
						         }
					         ?>
				         </tbody>
			         </table>			          
		          </div>
		          
				</div>
				<?PHP
					} 
					if(isset($slide_id)) {
						?>
						
				<div class="col-md-10">
					<h1><?=getSystemString(76)?></h1>
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
					
					<form action="<?=base_url($__controller.'/updateSlide');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          
				          <input type="hidden" name="slide_id" value="<?=$slide_id?>">	
				          
				          <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">				         
					         <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(38)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(77)?>" value="<?=$slide[0]->Title_en?>">
									
								</div>
							</div>
					         
					         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(271)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="caption_en" rows="5" class="form-control" placeholder="<?=getSystemString(272)?>"><?=$slide[0]->Slide_Caption_en?></textarea>
										
									</div>
								</div>
					         
				           </div>
				           
				            <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					            <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(38)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(77)?>" value="<?=$slide[0]->Title_ar?>" dir="rtl">
									
								</div>
							</div>
					            
					            
					            <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(271)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="caption_ar" dir="rtl" rows="5" class="form-control" placeholder="<?=getSystemString(272)?>"><?=$slide[0]->Slide_Caption_ar?></textarea>
										
									</div>
								</div>
					            
				            </div>
				           
				          </div>
						
						
						<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(273)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="url" class="form-control" name="link" placeholder="<?=getSystemString(274)?>" value="<?=$slide[0]->Target_Link?>">
										
									</div>
								</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="slide_picture"><?=getSystemString(14)?></label>
								
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="file" name="slide_picture" id="fileToUpload" class="fileToUpload" >
								<small>width: 1920px & height: 900px</small>
								<img id="previewHolder" class="previewImg-S" alt="" src="<?=base_url($GLOBALS['img_slides_dir']).$slide[0]->Slide_Image?>" style="width: 200px;border-radius: 2px;margin-top:10px;display: block">
							</div>
						</div>
						
						
			          
		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-center">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
							</div>
						</div>
					          
				          
				          
			          </form>
				</div>
						
						<?PHP
					}
				?>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
		
		$(document).on('click',"#slider_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'slide');
		});
		
/*
		$(document).on('click',"#slider_table tr td:eq(3) .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'caption');
		});
*/
		
		ChangeOrder('slides');
	});
	
</script>
</body>
</html>