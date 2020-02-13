<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px;padding-bottom: 20px">
      <h4 class="page-title">
        <?=getSystemString(326)?>
      </h4>
      <div class="col-xs-12 no-padding">
        <form action="" method="post" id="filter_companies">
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_name" class="form-control" placeholder="<?=getSystemString(311)?>">
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_email" class="form-control" placeholder="<?=getSystemString(482)?>">
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_phone" class="form-control" placeholder="<?=getSystemString(462)?>">
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_mobile" class="form-control" placeholder="<?=getSystemString(461)?>">
	            </div>
	          </div>
	          
<!--
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<select class="select2" id="filter_country" data-placeholder="<?=getSystemString(305)?>">
						<option value="-1"><?=getSystemString(305)?></option>
						<?PHP
							foreach($countries as $country){
								?>
								<option value="<?=$country->Country_ID?>"><?=$country->Country_Name?></option>
								<?PHP
							}
						?>
					</select>
	            </div>
	          </div>
-->
				
				<div class="col-xs-12 text-center float-right-left">
					<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
				</div>

		
   		</form>
	</div>
</div>