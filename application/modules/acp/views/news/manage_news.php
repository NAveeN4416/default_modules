<style>
	.panel.white{
		min-height: 100px;
	}
</style>
	<div id="content-main">
			
			<!-- Note: total -->
<!-- 			<div class="container col-md-3" id="totals">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center"><?=getSystemString('total_news')?></h3>
			<h4><?=$total['TotalNews']?></h4>
			<p><?=getSystemString('total_news')?></p>
		</div>
	</div>
</div>
<div class="container col-md-8" id="totals">
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-center"><?=$activeNews?></h3>
			<h4>_</h4>
			<p><?=getSystemString('active')?></p>
		</div>
		<div class="col-md-6">
			<h3 class="text-center"><?=$inActiveNews?></h3>
			<h4>_</h4>
			<p><?=getSystemString('inActive')?></p>
		</div>
	</div>
</div>	 -->
			<!-- Ends -->
			
			<div class="row">
				
								<?PHP
									
					$this->load->view('acp_includes/response_messages');

					 ?>
				<div class="col-md-12">
					
					 <?PHP
						$section = "SectionName_".$__lang;
						$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
					?>
					<h3>
						<?=getSystemString('news')?> 
						<a href="<?=base_url($__controller.'/addNews')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString('add_new_news')?>
						</a>
						
						<a href="<?=base_url($__controller.'/manageCategories')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-list"></i> <?=getSystemString('categories')?>
						</a>
			
					</h3>
		
				</div>
					 <div class="col-md-12">
		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4><?=getSystemString('news')?></h4>
			         <table class="table table-hover sortable-1 sortable-tb" id="news_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(149)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(49)?></th>
						         <th><?=getSystemString(150)?></th>
						         <th><?=getSystemString(151)?></th>
						         <th><?=getSystemString(152)?></th>
						         <th><?=getSystemString(153)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($news)){
							         $i = 0;
							        foreach($news as $row){
								       $i++;
								       $title_nn = "Title_".$__lang;
								       $cat = "Category_".$__lang;
									   $dt = new DateTime($row->TimeStamp);
								       ?>
								       <tr id="<?=$row->News_ID;?>">
									       <td class="hide"><?=$row->News_ID;?></td>
									       <td class="index hide"><?=$i?></td>
									       <td><?=$dt->format('d-m-Y')?></td>
									       <td><?=$row->$cat;?></td>
									       <td><img src="<?=base_url($GLOBALS['img_news_dir']).$row->Thumbnail;?>" alt='picture' style="width: 40px;"></td>
									       <td><?=$row->$title_nn;?></td>
									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="nstatus<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="nstatus<?=$i?>">
												</div>
											</td>
											<td>
												<div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editNews/'.$row->News_ID.'/')?>">
                                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                                      </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  <li>
														  		<a href="<?=base_url($__controller.'/editNews/'.$row->News_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
														  <li>
														  		<a href="<?=base_url($__controller.'/deleteNews/'.$row->News_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
							          echo '<tr><td colspan="7 class="text-center">No News </td></tr>';
						         }
					         ?>
				         </tbody>
			         </table>			          
		          </div>
		          
				</div>

			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script>
	$(function(){
		menu_track_manual(5,0);
		
		$(document).on('click',"#news_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'news');
		});
		
		$('#projects_table').on('click', function(){
			ChangeOrder('news');
		});
	});
</script>
</body>
</html>