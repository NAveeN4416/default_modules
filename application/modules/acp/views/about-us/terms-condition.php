<style>
	.cke_contents{
		min-height: 350px !important;
	}
</style>
<div id="content-main">
		<h3><?=getSystemString(384)?></h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<form action="<?=base_url($__controller.'/updateTermsCondition');?>" class="form-horizontal" method="post">
					<div class="col-md-10">
						
						<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
						 <div class="panel white" style="padding-bottom: 50px;">
							   <div class="tab-content">
							         <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
							          					         
										
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1"><?=getSystemString(13)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
												<textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1" cols="40" >
													<?=$wbs[0]->Terms_Conditions_en?>
												</textarea>
												<br>
												
											</div>
										</div>
						          
						            </div>
						          
									 <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">				         
										
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1"><?=getSystemString(13)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
												<textarea name="editor2" id="editor2" rows="12" class="margin-bottom editors2" cols="40" >
												<?=$wbs[0]->Terms_Conditions_ar?>
												</textarea>
												<br>
												
											</div>
										</div>
									          
		                          </div>
							   </div>        
								          
							        
							          
						    </div>
						
					</div>
					
					<div class="col-md-10 rtl-right">
			          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
							</div>
					</div>
		          </div>
					
				</form>
			</div>
</div>
	<?PHP
	$this->load->view('acp_includes/footer');
?>