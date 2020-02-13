	<div id="content-main">
		
			<div class="row">
				
								<?PHP
					$this->load->view('acp_includes/response_messages');
					
					if(!isset($question_id)){
					 ?>
					 <div class="col-md-10">
					<h1>
						 <a href="<?=base_url($__controller.'/addQuestion')?>" class="btn btn-primary btn-small pull-right" style="color:#FFF" >
							 <i class="fa fa-plus"></i> <?=getSystemString(449)?></a>
						<?=getSystemString(187)?>
					</h1>
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			         <table class="table table-hover display sortable-1 sortable-tb" id="faq_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(180)?></th>
						         <th><?=getSystemString(451)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($faq)){
							         $i = 0;
							        foreach($faq as $row){
								       $i++;
								       $dt = new DateTime($row->TimeStamp);
								       $title = 'Title_'.$__lang;
								       ?>
								       <tr id="<?=$row->Q_ID;?>">
									       <td class="hide"><?=$row->Q_ID;?></td>
									       <td class="index"><?=$dt->format('d-m-Y');?></td>
									       <td><?=$row->Username?></td>
									       <td><a href="<?=base_url('home/faq/'.$row->Slug)?>" target="_blank"><?=$row->$title?></a></td>
									       <td>
										       <div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
												</div>
									       </td>
										   <td>											   
											 <div class="btn-group">
											  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editQuestion/'.$row->Q_ID)?>">
                                                 <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                              </a>
											  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											  	<span class="fa fa-angle-down"></span>
											  </button>
											  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
												  <li>
											  		<a href="<?=base_url($__controller.'/deleteQuestion/'.$row->Q_ID)?>" onclick="return confirm('<?=getSystemString(45)?>');" style="margin: 0px 5px;" class=" dropdown-item">
												  		<i class="fa fa-trash"></i>  <?=getSystemString(44)?>
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
							          <tr><td colspan="5" class="text-center"> <?=getSystemString(450)?> </td></tr>
							          <?PHP
						         }
					         ?>
				         </tbody>
			         </table>			          
		          </div>
		          
				</div>
					 
					 <?PHP
					 }
					 if(isset($question_id)){
						 
						 ?>
						
						 <div class="col-md-10">
							 
							 <h3><?=getSystemString(453)?></h3>
							
							<?PHP
								$lang_setting['website_lang'] = $website_lang;
								//load tabs
								$this->load->view('acp_includes/lang-tabs', $lang_setting);
							?>
							
							 <form action="<?=base_url($__controller.'/updateQuestion');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
							 <div class="panel white" style="padding-bottom: 50px;">
			          
			         
							 	<input type="hidden" name="question_id" value="<?=$question_id?>">	
						  	
							  	  <div class="tab-content">
					          
					           
							  	  		<div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
							         		<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="title"><?=getSystemString(451)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<textarea class="form-control" rows="1" name="title_en" placeholder="<?=getSystemString(451)?>"><?=$question[0]->Title_en?></textarea>
													
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="title"><?=getSystemString(452)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 no-padding-left">
													<textarea class="basic-editor-en" name="editor1" id="editor3"><?=$question[0]->Answer_en?></textarea>
													
												</div>
											</div>
											
							           </div>
							           
							           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
								           <div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="title"><?=getSystemString(451)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<textarea class="form-control" 
															  rows="1" 
															  name="title_ar" 
															  placeholder="<?=getSystemString(451)?>" 
															  dir="rtl"
															  require=""
															  data-parsley-required-message="<?=getSystemString(213)?>"><?=$question[0]->Title_ar?></textarea>
													
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="title"><?=getSystemString(452)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 no-padding-left">
													<textarea class="basic-editor-ar" name="editor2" id="editor4"><?=$question[0]->Answer_ar?></textarea>
													
												</div>
											</div>
									
					           			</div>
					           
					           
									</div>
						
					 <!-- Note: Hidden by A based on email request from KQ [Remove picture from FAQ | 12:30AM | 6/11/2017] -->	
						
						<!--div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="slide_picture"><?=getSystemString(14)?></label>
								
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="file" name="faq_picture" id="fileToUpload" class="fileToUpload" >
								<br />
								<?PHP
									$float = 'left';
									if($__lang == 'ar'){
										$float = 'right';
									}
								?>
								<img id="previewHolder" class="previewImg-S" alt="" src="<?=base_url($GLOBALS['img_faq_dir']).$question[0]->Picture?>" style="width: 200px;border-radius: 2px;margin-top:10px;display: block;float:<?=$float?>">
							</div>
						</div-->
			          
			          <!-- End -->
		          </div>
		          
		          <div class="form-group">
							<div class="col-xs-12 text-right">
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
		
		$(document).on('click',"#faq_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'faq');
		});
		
		
		ChangeOrder('faq');
		
	});
	
</script>