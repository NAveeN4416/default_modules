<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px;padding-bottom: 20px">
      <h4 class="page-title">
        <?=getSystemString(61)?>
      </h4>
      <div class="col-xs-12 no-padding">
        <form action="" method="post" id="filter_reservations">
	         <input type="hidden" id="campaign_id" value="<?PHP if(isset($campaign_id)) { echo $campaign_id; } else { echo ''; } ?>">
	         <?PHP
		         if(!isset($cp_login_id))
		         {
	         ?>
	         <input type="hidden" id="cp_lg" value="0">
	         <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <select class="form-control select2" 
							id="filter_company"
							data-placeholder="<?=getSystemString(313)?>">
								
							<option value="-1"><?=getSystemString(313)?></option>
						<?PHP
							foreach($companies as $row)
							{
								?>
								<option value="<?=$row->Company_ID?>"><?=$row->Company_Name?></option>
								<?PHP
							}
						?>
					</select>
	          </div>
	          <?PHP
					} else {
						
						?>
							<input type="hidden" id="filter_company" value="<?=$cp_login_id?>">
							<input type="hidden" id="cp_lg" value="1">
						<?PHP
						
					}
			  ?>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_name" class="form-control" placeholder="<?=getSystemString(128)?>">
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<select id="filter_type" class="form-control select2" data-placeholder="<?=getSystemString(132)?>">
		              	<option value="-1"><?=getSystemString(132)?></option>
		              	<option value="umrah"><?=getSystemString('umrah')?></option>
		              	<option value="hajj"><?=getSystemString('hajj')?></option>
	              	</select>
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_from" class="form-control input-from" placeholder="<?=getSystemString(483)?>">
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_to" class="form-control input-to" placeholder="<?=getSystemString(484)?>">
	            </div>
	          </div>
	          
				
				<div class="col-xs-12 text-center float-right-left">
					<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
				</div>

		
   		</form>
	</div>
</div>