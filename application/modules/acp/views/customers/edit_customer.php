		<style>
		input[type='range'], .cropit-image-preview{
			width: 250px;
		}
		.cropit-image-preview{
			height: 150px;
		}
		    .ci-preview-labels div{
	    padding-top: calc(100% - 225px);
    }

	</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-10">
					<h1><?=getSystemString(372)?></h1>
					
					 <form action="<?=base_url($__controller.'/updateCustomer');?>" class="form-horizontal" method="post" data-parsley-validate>
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			         	<input type="hidden" name="customer_id" value="<?=$customer_id?>">
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="editor1"><?=getSystemString(81)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								
								<input type="text" 
										class="form-control" 
										name="name" 
										placeholder="<?=getSystemString(206)?>" 
										value="<?=$customer[0]->Fullname?>"
										required="" 
										data-parsley-trigger="change" 
										data-parsley-required-message="<?=getSystemString(213)?>">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="editor1"><?=getSystemString(371)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								
								<input type="text" 
										class="form-control" 
										name="address" 
										placeholder="<?=getSystemString(371)?>" 
										value="<?=$customer[0]->Address?>"
										data-parsley-trigger="change" 
										data-parsley-required-message="<?=getSystemString(213)?>">
								
							</div>
						</div>
						
						<div class="col-xs-12">
							<hr />
						</div>
						<div class="col-xs-12">
							<h4 class="section-title-secondary">Change Password</h4>
						</div>
						<!-- <div class="form-group">
						    <div class="col-xs-12 col-sm-4 col-md-2">
						        <label for="name">
						            <?=getSystemString(339)?>
						        </label>
						    </div>
						    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
						        <input type="password" 
						        	   class="form-control" 
						        	   name="oldPassword" 
						        	   placeholder="<?=getSystemString(339)?>" 
						        	   value="" 
						        	   data-parsley-trigger="keyup" 
						        	   data-parsley-minlength="3" 
						        	   data-parsley-maxlength="20" 
						        	   data-parsley-minlength-message="<?=getSystemString(224)?>" 
						        	   data-parsley-maxlength-message="<?=getSystemString(230)?>" 
						        	   data-parsley-validation-threshold="9">
						    </div>
						</div> -->
	
	
						<div class="form-group">
						    <div class="col-xs-12 col-sm-4 col-md-2">
						        <label for="name">
						            <?=getSystemString(340)?>
						        </label>
						    </div>
						    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
						        <input type="password" 
						        	   class="form-control" 
						        	   name="newPassword" 
						        	   placeholder="<?=getSystemString(340)?>" 
						        	   id="psd" 
						        	   data-parsley-trigger="keyup"
						               data-parsley-minlength="3" 
						               data-parsley-minlength-message="<?=getSystemString(224)?>"
						               data-parsley-maxlength="20" 
						               data-parsley-maxlength-message="<?=getSystemString(230)?>"
						               data-parsley-validation-threshold="20">
						
						        <small class="text-muted" style="font-size: 10px; padding-top: 5px;display:inline-block"><?=getSystemString(84)?></small>
						    </div>
						</div>
						
						<div class="form-group">
						    <div class="col-xs-12 col-sm-4 col-md-2">
						        <label for="name">
						            <?=getSystemString(341)?>
						        </label>
						    </div>
						    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
						        <input type="password" 
						        	   class="form-control" 
						        	   name="confirmPassword" 
						        	   placeholder="<?=getSystemString(341)?>" 
						        	   value="" 
						        	   data-parsley-trigger="keyup" 
						        	   data-parsley-equalto="#psd"
									   data-parsley-equalto-message="<?=getSystemString(232)?>"
					                   data-parsley-minlength="3" 
						               data-parsley-minlength-message="<?=getSystemString(224)?>"
						               data-parsley-maxlength="20" 
						               data-parsley-maxlength-message="<?=getSystemString(230)?>"
					                   data-parsley-validation-threshold="20">
						
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
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
</body>
</html>