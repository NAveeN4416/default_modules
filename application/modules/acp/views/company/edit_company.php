<style>
	.crop-image
	{
		width: 360px;
		height: 260px;
	}

	.invalid-form-error-message
	{
		display: none;
	}

	.invalid-form-error-message.filled
	{
		display: block;
	}

	#ui-datepicker-div
	{
		z-index: 4 !important;
	}
</style>

<div id="content-main">
		<h3><?PHP
			if(isset($cp_profile))
			{
				echo getSystemString(92);
				
			} else {
				
				echo getSystemString(306).' ('.$company[0]->Company_Name.')';
			}
		?></h3>
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
    			<form action="<?=base_url($__controller.'/edit_company_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" id="company_form" data-parsley-validate>
		            <div class="panel white" style="padding-bottom: 50px;">
			          <div class="col-md-10">
			          <div class="tab-content">
				          
				        <div class="invalid-form-error-message alert alert-danger alert-dismissable"></div>
				        <input type="hidden" name="company_id" value="<?=$company[0]->Company_ID?>">
				        
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
										   value="<?PHP foreach($company as $c){ if($c->Culture == 'en'){ echo $c->Company_Name; } } ?>"
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
									<textarea name="description_en" class="basic-editor-en" id="en_editor"><?PHP foreach($company as $c){ if($c->Culture == 'en'){ echo $c->Company_Description; } } ?></textarea>
									
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
										   value="<?PHP foreach($company as $c){ if($c->Culture == 'ar'){ echo $c->Company_Name; } } ?>"
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
									<textarea name="description_ar" class="basic-editor-ar" id="arabic_editor"><?PHP foreach($company as $c){ if($c->Culture == 'ar'){ echo $c->Company_Description; } } ?></textarea>
									
								</div>
							</div>
				        </div> <!-- end tab AR -->
			          </div>

						<?php

							$image_flag = getimagesize($GLOBALS['img_companies_cr_dir'].$company[0]->CR) ;
							$image_flag = ($image_flag) ? 1 : 0 ;
							$required_flag = ($company[0]->CR) ? '' : 'required' ;
						?>

						<?php if($_SESSION['role_dcart']!='admin'){ ?>
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString('certificate_commercial')?><span style="color: red">*</span></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" 
										   class="form-control" 
										   name="CR"
										   <?=$required_flag?>>
								</div>
								<?php if($company[0]->CR!='0'){ ?>
									<input type="hidden" name="old_CR" value="<?=$company[0]->CR?>">
									<?php if($image_flag){ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_cr_dir'].$company[0]->CR ; ?>" target="_blank"><img src="<?php echo base_url().$GLOBALS['img_companies_cr_dir'].$company[0]->CR; ?>" height="100"></a>
										</div>
									<?php }else{ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_cr_dir'].$company[0]->CR ; ?>" target="_blank">
												<?=getSystemString('view_certificate')?>
											</a>
										</div>
									<?php } ?>
									<?php if($company[0]->expiry_date){ ?><br>
										<!-- <div><?=date($company[0]->expiry_date)?></div> -->
									<?php } ?>
								<?php } ?>
							</div>

							<?php 
								$lc_flag = getimagesize($GLOBALS['img_companies_lcr_dir'].$company[0]->License_Certificate) ;
								$lc_flag = ($lc_flag) ? 1 : 0 ;
								$required_flag = ($company[0]->License_Certificate) ? '' : 'required' ;
							?>
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title">License Certificate<span style="color: red">*</span></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" 
										   class="form-control" 
										   name="license"
										   <?=$required_flag?>>
								</div>
								<?php if($company[0]->License_Certificate!=''){ ?>
									<input type="hidden" name="old_license" value="<?=$company[0]->License_Certificate?>">
									<?php if($lc_flag){ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_lcr_dir'].$company[0]->License_Certificate ; ?>" target="_blank"><img src="<?php echo base_url().$GLOBALS['img_companies_lcr_dir'].$company[0]->License_Certificate; ?>" height="100"></a>
										</div>
									<?php }else{ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_lcr_dir'].$company[0]->License_Certificate ; ?>" target="_blank">
												<?=getSystemString('view_certificate')?>
											</a>
										</div>
									<?php } ?>
									<?php if($company[0]->License_expiry_date){ ?>
										<!-- <div><?=date($company[0]->License_expiry_date)?></div> -->
									<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>

				        <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-3">
								<label for="title"><?=getSystemString(137)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="number" 
									   class="form-control" 
									   name="company_phone" 
									   placeholder="0117654321"
									   value="<?=$company[0]->Company_Phone?>"
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
									   placeholder="0557654321"
									   value="<?=$company[0]->Company_Mobile?>">
								
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
									   placeholder="http://bundlz.com"
									   value="<?=$company[0]->Company_Website?>">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-3">
								<label for="title"><?=getSystemString('certificate_commercial')?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="file" 
									   class="form-control" 
									   name="Commercial_Certificate">
							</div>
						</div>

					<hr>

						<?php if($_SESSION['role_dcart']=='admin'){ ?>
							<?php if($company[0]->CR!='0'){ ?>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString('certificate_commercial')?></label>
									</div>
									<?php if($image_flag){ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_cr_dir'].$company[0]->CR ; ?>" target="_blank"><img src="<?php echo base_url().$GLOBALS['img_companies_cr_dir'].$company[0]->CR ?>" height="100"></a>
										</div>
									<?php }else{ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_cr_dir'].$company[0]->CR ; ?>" target="_blank">
												<?=getSystemString('view_certificate')?>
											</a>
										</div>
									<?php } ?>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString('certifi_expire_date')?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="date"
											   id="expir_date"
											   class="form-control" 
											   name="expiry_date"
											   value="<?=$company[0]->expiry_date?>" 
											   required>
									</div>
								</div>
							<?php } ?>
							<hr>
							<?php if($company[0]->License_Certificate!=''){ ?>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title">License Certificate</label>
									</div>
									<?php if($image_flag){ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_lcr_dir'].$company[0]->License_Certificate ; ?>" target="_blank"><img src="<?php echo base_url().$GLOBALS['img_companies_lcr_dir'].$company[0]->License_Certificate ?>" height="100"></a>
										</div>
									<?php }else{ ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<a href="<?php echo base_url().$GLOBALS['img_companies_lcr_dir'].$company[0]->License_Certificate ; ?>" target="_blank">
												<?=getSystemString('view_certificate')?>
											</a>
										</div>
									<?php } ?>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title">License expire date</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="date"
											   id="license_expire_date"
											   class="form-control" 
											   name="license_expiry_date"
											   value="<?=$company[0]->expiry_date?>" 
											   required>
									</div>
								</div>
							<?php } ?>


						<?php } ?>
					
					<hr>




						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-3">
								<label for="service_picture"><?=getSystemString(99)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="hidden" class="crop_img_url" value="<?=$company[0]->Company_Logo?>">
								<div class="crop-image">
										<input type="hidden" name="image-data" id="image-data">
									<?php if($company[0]->Company_Logo){ ?>
										<input type="hidden" id="check_chng_img" name="check_chng_img" value="-2">
									<?php }else{ ?>
										<input type="hidden" id="check_chng_img" name="check_chng_img" value="-1">
									<?php } ?>
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
								<input type="hidden" name="old_email" value="<?=$company[0]->Email?>">
								<input type="email" 
										class="form-control" 
										name="email"
										value="<?=$company[0]->Email?>"
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
<script>
	var _validationMsg = '<?=getSystemString(185)?>';
	$(function()
	{
		$('#company_form').parsley().on('form:validate', function (formInstance) {
		    var ok = formInstance.isValid({group: 'company_name', force: true});
		    $('.invalid-form-error-message')
		      .html(ok ? '' : _validationMsg)
		      .toggleClass('filled', !ok);
		    if (!ok)
		      formInstance.validationResult = false;
		});
		
		if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){
			
			imageEditor.croppie('bind', {
				url: '<?=base_url($GLOBALS['img_companies_dir'])?>'+$('.crop_img_url').val()
			});
			
			cropImageActive();
		}
	});
</script>
<script type="text/javascript">
	var dateToday = new Date();
	var _dateFormat = "yy-mm-dd",

    expire_date = $( "#expire_date" ).datepicker({
          changeMonth: true,
          numberOfMonths: 1,
          minDate: dateToday,
          dateFormat: _dateFormat
          
    });
</script>

</body>
</html>