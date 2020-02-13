  <div class="panel white" style="padding-bottom: 50px;">
      
    <h3>
	  <?=getSystemString(67)?>
  	</h3>
      
     <table class="table table-hover sortable-tb sortable-1" id="pictures_table">
         <thead>
	         <tr>
		         <th class="hide"><?=getSystemString(41)?></th>
		         <th><?=getSystemString(177)?></th>
		         <th><?=getSystemString(14)?></th>
		         <th><?=getSystemString(33)?></th>
		         <th><?=getSystemString(42)?></th>
	         </tr>
         </thead>
         <tbody>
	         <?PHP
		         if(count($pictures)){
			         $i = 0;
			        foreach($pictures as $picture){
				       $i++;
				       $dt = new DateTime($picture->Created_At);
				       ?>
				       <tr id="<?=$picture->Picture_ID;?>">
					       <td class="hide"><?=$picture->Picture_ID;?></td>
					       <td class="index hide"><?=$i;?></td>
					       <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
					       <td>
						       <img src="<?=base_url($GLOBALS['img_camp_pics_dir']).$picture->Picture;?>" style="width: 40px;">
					       </td>
					       
					       <td>
								<div data-toggle="hurkanSwitch" data-status="<?=$picture->Status?>">
								  <input data-on="true" type="radio" <?PHP if($picture->Status) { echo 'checked'; } ?> name="status<?=$i?>">
								  <input data-off="true" type="radio" <?PHP if(!$picture->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
								</div>
							</td>
					       
					       <td><div class="btn-group">
									  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/delete_campaign_picture/'.$picture->Picture_ID.'/'.$picture->Campaign_ID)?>">
                                         <i class="fa fa-trash"></i> <?=getSystemString(314)?>
                                      </a>
									  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									  	<span class="fa fa-angle-down"></span>
									  </button>
									  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
										  <li>
										  		<a href="<?=base_url($__controller.'/delete_campaign_picture/'.$picture->Picture_ID.'/'.$picture->Campaign_ID)?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
			          echo '<tr><td colspan="6" class="text-center"> '.getSystemString(65).' </td></tr>';
		         }
	         ?>
         </tbody>
     </table>
     
     <div class="col-xs-12 details images-d" style="padding: 0px;">
			<div class="col-xs-12">
				<div class="dropzone dz-clickable" id="img-dropzone">
                     <div class="dz-message needsclick">
					    <?=getSystemString(169)?>
						 </div>
				</div>
			</div>
	 </div>
     		          
  </div>

</body>
</html>