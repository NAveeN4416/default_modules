<div id="new_category" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post" id="form_new_category" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"> <i class="fa fa-plus"></i> <?=getSystemString(96)?></h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">
	         
	           <div class="alert alert-success hide">
		           <?=getSystemString(121)?>
	           </div>
	           
		        <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?=getSystemString(49).' en *'?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						<input type="text" 
						       class="form-control" 
							   id="category_en" 
							   placeholder="<?=getSystemString(49)?>" 
							   required 
							   data-parsley-required-message="<?=getSystemString(213)?>">
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?=getSystemString(49).' ar *'?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						<input type="text" 
						       class="form-control" 
							   id="category_ar" 
							   placeholder="<?=getSystemString(49)?>" 
							   dir="rtl"
							   required 
							   data-parsley-required-message="<?=getSystemString(213)?>">
					</div>
				</div>
	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" value="<?=getSystemString(48)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>
