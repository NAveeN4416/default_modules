<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<style>
		.crop-image{
			width: 360px;
			height: 260px;
		}
		.invalid-form-error-message{
			display: none;
		}
		.invalid-form-error-message.filled{
			display: block;
		}
	</style>
	<div id="content-main">
		<h3><?=getSystemString(301)?></h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<div class="col-md-12">
					<?PHP
						$lang_setting['website_lang'] = $website_lang;
						//load tabs
						$this->load->view('acp_includes/lang-tabs', $lang_setting);
					?>
        			<form action="<?=base_url($__controller.'/add_company_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" id="company_form" data-parsley-validate>
			            <div class="panel white" style="padding-bottom: 50px;">
				          <div class="col-md-10">
				          <div class="tab-content">
					          
					        <div class="invalid-form-error-message alert alert-danger alert-dismissable"></div>
					          
					        <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
					          	<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString(311)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" 
											   class="form-control" 
											   name="company_name_en" 
											   placeholder="<?=getSystemString(311)?>" 
											   required
											   data-parsley-errors-messages-disabled
											   data-parsley-group="company_name"
											   data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString(312)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="description_en" class="basic-editor-en" id="en_editor"></textarea>
										
									</div>
								</div>
					        </div> <!-- end tab EN -->
					          
					        <div class="tab-pane fade w-editor <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					          	<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString(311)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" 
											   class="form-control" 
											   name="company_name_ar" 
											   placeholder="<?=getSystemString(311)?>" 
											   required
											   data-parsley-errors-messages-disabled
											   data-parsley-group="company_name"
											   data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString(312)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="description_ar" class="basic-editor-ar" id="arabic_editor"></textarea>
										
									</div>
								</div>
					        </div> <!-- end tab AR -->
				          </div>
				          
				          	<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(234)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<select class="select2" name="country_id" data-placeholder="<?=getSystemString(305)?>">
										<option value=""><?=getSystemString(305)?></option>
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
				          
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(137)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="number" 
										   class="form-control" 
										   name="company_phone" 
										   placeholder="0117654321" 
										   required
										   data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(206)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="number" 
										   class="form-control" 
										   name="company_mobile" 
										   placeholder="0557654321">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(338)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="url" 
										   class="form-control" 
										   name="company_website" 
										   placeholder="http://bundlz.com">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="service_picture"><?=getSystemString(99)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 no-padding-left">
									<div class="crop-image">
											<input type="hidden" name="image-data" id="image-data">
											<input type="hidden" id="check_chng_img" name="check_chng_img" value="-1">
											<input type="file" name="fileToUpload" class="editor-file z-10">
											<div class="ci-preview-labels">
										        <div class="text-xs-center">
											        <i class="fa fa-cloud-upload"></i>
											        <p><?=getSystemString(262)?></p>
											        <p><?=getSystemString(263)?></p>
											        <p><a href="javascript: void(0)"><?=getSystemString(264)?></a></p>
										        </div>
											</div>
											<a href="#" class="change-pic editor z-10 hide"> <i class="fa fa-pencil"></i> <?=getSystemString(171)?></a>
										</div>
									
	  							</div>
							</div>
				          </div>
			          </div>
			          
			            <div class="panel white" style="padding-bottom: 50px;">
				            <div class="col-md-10">
				          <h3><?=getSystemString(346)?></h3>
				          <br>
				          <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(1)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="email" 
											class="form-control" 
											name="email" 
											placeholder="<?=getSystemString(1)?>"
											required="" 
											data-parsley-trigger="change" 
											data-parsley-required-message="<?=getSystemString(213)?>"
											data-parsley-type-message="<?=getSystemString(183)?>">
									
								</div>
						    </div>
				          
		          			<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(2)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="password" 
										   id="psd"
										   class="form-control"
										   name="password" 
										   placeholder="******"
										   required=""
										   data-parsley-trigger="keyup"
										   data-parsley-minlength="3" 
										   data-parsley-minlength-message="<?=getSystemString(278)?>"
										   data-parsley-validation-threshold="20"
										   data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>
						
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(341)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="password" 
										   class="form-control"
										   name="confirm_password" 
										   placeholder="******"
										   required="" 
										   data-parsley-trigger="keyup"
										   data-parsley-equalto="#psd"
										   data-parsley-equalto-message="<?=getSystemString(332)?>"
						                   data-parsley-minlength="3" 
						                   data-parsley-minlength-message="<?=getSystemString(278)?>"
						                   data-parsley-validation-threshold="2"
										   data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>
							</div>
			          </div>
			          
			            <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
							</div>
						</div>
		          </form>
		          
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script>
	var _validationMsg = '<?=getSystemString(185)?>';
	$(function()
	{
		
		$('.select2').select2({
		    'theme' : 'bootstrap'
	    });
		
		$('#company_form').parsley().on('form:validate', function (formInstance) {
		    var ok = formInstance.isValid({group: 'company_name', force: true});
		    $('.invalid-form-error-message')
		      .html(ok ? '' : _validationMsg)
		      .toggleClass('filled', !ok);
		    if (!ok)
		      formInstance.validationResult = false;
		});
	});
</script>
</body>
</html>