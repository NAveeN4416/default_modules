<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px;padding-bottom: 20px">
      <h4 class="page-title">
        <?=getSystemString(130)?>
      </h4>
      <div class="col-xs-12 no-padding">
        <form action="" method="post" id="filter_campaigns">
	         <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <select class="form-control select2" 
							id="filter_company"
							data-placeholder="<?=getSystemString(313)?>">
								
							<option value="-1"><?=getSystemString(313)?></option>
						<?PHP
							foreach($companies as $row)
							{
								$cmp_nn = 'Company_Name';
								?>
								<option value="<?=$row->Company_ID?>" <?PHP if($company_id == $row->Company_ID){ echo 'selected'; } ?> ><?=$row->$cmp_nn?></option>
								<?PHP
							}
						?>
					</select>
	          </div>
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              	<input type="text" id="filter_name" class="form-control" placeholder="<?=getSystemString(128)?>">
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
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <input type="text" id="filter_city" class="form-control" placeholder="<?=getSystemString(485)?>">
	          </div>
	          
				
				<div class="col-xs-12 text-center float-right-left">
					<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
				</div>

		
   		</form>
	</div>
</div>