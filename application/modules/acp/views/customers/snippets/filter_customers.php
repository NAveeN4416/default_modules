<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px;padding-bottom: 20px">
	      <h4 class="page-title">
	        <?=getSystemString(370)?>
	      </h4>
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_customers">
		        <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
			            <div class="form-group">
			              <input type="number" id="filter_phone" placeholder="<?=getSystemString(256)?>" class="form-control" />
			            </div>
				  </div>
		          
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
			            <div class="form-group">
			              <input type="text" id="filter_name" placeholder="<?=getSystemString(81)?>" class="form-control" />
			            </div>
				  </div>
		          
					
					<div class="col-xs-12 col-sm-2 col-md-2 float-right-left <?PHP if($__lang == 'en'){ echo 'text-left'; } else { 'text-right'; } ?>">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
					</div>
	
			
	   </form>
	</div>
</div>