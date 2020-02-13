	<style>
	.panel.white{
		min-height: 150px;
	}
</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
					
					if(!isset($category_id))
					{
					 ?>
				<div class="col-md-12">
					<h1><?=getSystemString(441)?>
						<a href="<?=base_url($__controller.'/categories')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString(96)?>
						</a>
					</h1>
		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4><?=getSystemString(50)?></h4>
			         <table class="table table-hover sortable-2 sortable-tb" id="categories_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(49)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($categories)){
							         $i = 0;
							        foreach($categories as $row){
								       $i++;
								       $dt = new DateTime($row->TimeStamp);
								       ?>
								       <tr id="<?=$row->Category_ID;?>">
									       <td class="hide"><?=$row->Category_ID;?></td>
									       <td class="index hide"><?=$i;?></td>
									       <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
									       <?PHP $category_nn = 'Category_'.$__lang; ?>
									       <td><?=$row->$category_nn;?></td>
									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
												</div>
											</td>
											<td>
												<div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editCategory/'.$row->Category_ID.'/')?>">
                                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                                      </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  
														  <li>
														  		<a href="<?=base_url($__controller.'/editCategory/'.$row->Category_ID.'/')?>" style="margin: 0px 5px;" class=" dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
														  <li>
														  		<a href="<?=base_url($__controller.'/deleteCategory/'.$row->Category_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
					
					if(isset($category_id))
					{
					?>

				<div class="col-md-12">
					<h1><?=getSystemString(51)?></h1>
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        			
        			<form action="<?=base_url($__controller.'/updateCategory');?>" class="form-horizontal" method="post" data-parsley-validate>
        			
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          <input type="hidden" name="category_id" value="<?=$category_id?>">
			          
			          <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(49)?> en</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_en" placeholder="<?=getSystemString(49)?> en" value="<?=$category[0]->Category_en?>" required data-parsley-required-message="<?=getSystemString(213)?>">
										<br>
										
									</div>
								</div>
				           </div>
				           
				          <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					          <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(49)?> ar</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_ar" placeholder="<?=getSystemString(49)?> ar" value="<?=$category[0]->Category_ar?>" dir="rtl" required data-parsley-required-message="<?=getSystemString(213)?>">
										<br>
										
									</div>
								</div>
				          </div>  
				           
			          </div>
						
						
					          
				          
				          
			         
			          
		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
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
		
		$(document).on('click',"#categories_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'news_categories');
		});
		
		ChangeOrder('news_categories');
	});
</script>
</body>
</html>