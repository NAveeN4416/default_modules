<style>
	.panel.white{
		min-height: 100px;
	}
	.input-group-addon {
	    padding: .4rem .75rem;
	    min-width: 47px;
    }
    .input-group .fa-twitter{
		color:#55acee;
	}
	.input-group .fa-instagram{
		color:#e4405f;
	}
	.input-group .fa-facebook{
		color:#3b5999;
	}
	.input-group .fa-google-plus{
		color:#dd4b39;
	}
	.input-group .fa-linkedin{
		color:#007bb5;
	}
	.input-group .fa-snapchat{
		color: #e9c350;
	}
	.input-group .fa-youtube{
		color: #bb0000;
	}
	.sm-upd-cnt small{
		font-size: 11px;
		color: #c2c2c2;
	}
	body[dir='rtl'] .radio-inline input[type="radio"]{
		margin-left: 0px;
		margin-right: -20px;
	}
	body[dir='rtl'] .radio-inline{
		padding-right: 20px;
	}
</style>
<div id="content-main">
		<h1><?=getSystemString(19)?></h1>
			<div class="row">
				
								<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
					         <form action="<?=base_url($__controller.'/updateSettings');?>" class="form-horizontal" method="post">
				<div class="col-md-10 rtl-right">
					
					<!-- ~~~~~~~~~~~~~~~~ General Website Details ~~~~~~~~~~~~~~~~~~~ -->
					 
						<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>

						         <div class="panel white" style="padding-bottom: 50px;">
								          <h3><?=getSystemString(20)?></h3>
										  <div class="tab-content" style="padding-top: 0px !important">
					           <div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
							        
								         					         
									         <div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_en"><?=getSystemString(21)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<input type="text" name="website_title_en" class="form-control" value="<?=$wbs[0]->Website_Title_en?>" placeholder="Website Title">
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_desc_en"><?=getSystemString(22)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<textarea class="form-control" name="website_desc_en" rows="4" placeholder="Website Description"><?=$wbs[0]->Website_Desc_en?></textarea>								
												</div>
											</div> 
											
											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_en"><?=getSystemString(141)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<input type="text" name="seo_keyword_en" class="form-control" value="<?=$wbs[0]->SEO_Keyword_en?>" placeholder="SEO Keyword">
													<p><small><?=getSystemString(320)?></small></p>
												</div>
											</div>
					           	</div>     
							   <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">

								      <div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_ar"><?=getSystemString(21)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<input type="text" name="website_title_ar" class="form-control" value="<?=$wbs[0]->Website_Title_ar?>" placeholder="Website Title" dir="rtl">
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_desc_ar"><?=getSystemString(22)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<textarea class="form-control" name="website_desc_ar" rows="4" placeholder="Website Description" dir="rtl"><?=$wbs[0]->Website_Desc_ar?></textarea>								
												</div>
											</div> 
											
											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_en"><?=getSystemString(141)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<input type="text" name="seo_keyword_ar" class="form-control" value="<?=$wbs[0]->SEO_Keyword_ar?>" placeholder="SEO Keyword" dir="rtl">
													<p><small><?=getSystemString(320)?></small></p>
												</div>
											</div>
											
							     </div>     
							     
							     <div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_email"><?=getSystemString(23)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													<input type="email" name="website_email" class="form-control" value="<?=$wbs[0]->Website_Email?>" placeholder="Website email">
													<br>
													<p><small><?=getSystemString(24)?></small></p>
												</div>
											</div>
							     
							     			
							     </div>
							   </div>
					    
					   <!-- ~~~~~~~~~~~~~~~~ END General ..... ~~~~~~~~~~~~~~~~~~~ -->
					   
					   <!-- Note: SMTP Credentials -->
					   
					    <div class="panel white" style="padding-bottom: 50px;">
							<h3><?=getSystemString(656)?></h3>
							<p><?=getSystemString('smtp_note')?></p>
							<input id="username" style="display:none" type="text" name="fakeusernameremembered">
							<input id="password" style="display:none" type="password" name="fakepasswordremembered"> 
							     
						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString(1)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="email" id="real-email" name="smtp_email" class="form-control" value="<?=$wbs[0]->SMTP_Email?>" placeholder="info@example.com" autocomplete="<?=$wbs[0]->SMTP_Email?>">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString(2)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="password" id="real-password" name="smtp_password" class="form-control" value="<?=$wbs[0]->SMTP_Password?>" placeholder="******" autocomplete="new-password">
								</div>
							</div>
						</div>
					   
						<div class="panel white" style="padding-bottom: 50px;">
							<h3><?=getSystemString('app_link')?></h3>  
						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString('ios')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="text" id="ios" name="ios" class="form-control" value="<?=$wbs[0]->IOS_link?>" placeholder="https://itunes.apple.com/us/app/dnetsa?mt=8">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString('android')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="text" id="android" name="android" class="form-control" value="<?=$wbs[0]->Android_link?>"  placeholder="https://play.google.com/store/apps/details?id=">
								</div>
							</div>
						</div>
						
					   <!-- Ends -->
					   
					    <!-- ~~~~~~~~~~~~~~~~ Start Social links ..... ~~~~~~~~~~~~~~~~~~~ -->
					    
					    <div class="panel white" style="padding-bottom: 50px;">
							          <h3><?=getSystemString(25)?></h3>
									          
								           <div class="form-group">										  		
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(26)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-twitter"></i></span>
														<input type="text" name="Twitter" class="form-control lv-prev twitter" value="<?=substr($cc[0]->Twitter, strrpos($cc[0]->Twitter, '/') + 1)?>" aria-describedby="basic-addon2">										  		
										  		
													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://twitter.com/<span class="sm-upd"><?=substr($cc[0]->Twitter, strrpos($cc[0]->Twitter, '/') + 1)?></span></small>
													</div>
												</div>
										  </div>
										  
										  <div class="form-group">										  		
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(27)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-instagram"></i></span>
														<input type="text" name="Instagram" class="form-control lv-prev instagram" value="<?=substr($cc[0]->Instagram, strrpos(trim($cc[0]->Instagram), '/') + 1)?>" >
										  		
										  		
													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://instagram.com/<span class="sm-upd"><?=substr($cc[0]->Instagram, strrpos(trim($cc[0]->Instagram), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>
										  
										  <div class="form-group">										  		
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(28)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-facebook"></i></span>
														<input type="text" name="Facebook" class="form-control lv-prev facebook" value="<?=substr($cc[0]->Facebook, strrpos(trim($cc[0]->Facebook), '/') + 1)?>">
										  		
										  		
													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://facebook.com/<span class="sm-upd"><?=substr($cc[0]->Facebook, strrpos(trim($cc[0]->Facebook), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>
										  
										  <div class="form-group">										  		
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-google-plus"></i></span>
														<input type="text" name="GooglePlus" class="form-control lv-prev google-plus" value="<?=substr($cc[0]->GooglePlus, strrpos(trim($cc[0]->GooglePlus), '/') + 1)?>">
										  		
										  		
													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://plus.google.com/<span class="sm-upd"><?=substr($cc[0]->GooglePlus, strrpos(trim($cc[0]->GooglePlus), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>
										  
								    <div class="form-group">										  		
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-linkedin"></i></span>
														<input type="text" name="LinkedIn" class="form-control lv-prev linked-in" value="<?=substr($cc[0]->LinkedIn, strrpos(trim($cc[0]->LinkedIn), '/') + 1)?>">
										  		
										  		
													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://linkedin.com/<span class="sm-upd"><?=substr($cc[0]->LinkedIn, strrpos(trim($cc[0]->LinkedIn), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>
										  
										  <div class="form-group">										  		
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-snapchat"></i></span>
														<input type="text" name="Snapchat" class="form-control lv-prev snapchat" value="<?=substr($cc[0]->Snapchat, strrpos(trim($cc[0]->Snapchat), '/') + 1)?>">
										  		
										  		
													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://snapchat.com/add/<span class="sm-upd"><?=substr($cc[0]->Snapchat, strrpos(trim($cc[0]->Snapchat), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>
										  
										   <div class="form-group">										  		
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-youtube"></i></span>
														<input type="text" name="Youtube" class="form-control lv-prev youtube" value="<?=substr($cc[0]->Youtube, strrpos(trim($cc[0]->Youtube), '/') + 1)?>">
										  		
										  		
													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://youtube.com/channel/<span class="sm-upd"><?=substr($cc[0]->Youtube, strrpos(trim($cc[0]->Youtube), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>
										  
							          
						          </div>
					    
						<!-- ~~~~~~~~~~~~~~~~ End Social links ..... ~~~~~~~~~~~~~~~~~~~ -->    
						
						<!-- ~~~~~~~~~~~~~~~~ Start Default languages ..... ~~~~~~~~~~~~~~~~~~~ -->
						<?PHP
				if($this->session->userdata($this->acp_session->role()) == 'super_admin') {
			?>
				          <div class="panel white" style="padding-bottom: 50px;">
					          <h3><?=getSystemString(334)?></h3>
			         
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="website_title"><?=getSystemString(334)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										
										<label class="radio-inline" style="text-align: center">
											<input type="radio" name="website_language" value="en" class="radio" <?PHP if($wbs[0]->Website_Language == "en"){ echo 'checked'; }?>> <?=getSystemString(336)?>
										</label>
										
										<label class="radio-inline" style="text-align: center">
											<input type="radio" name="website_language" value="ar" class="radio" <?PHP if($wbs[0]->Website_Language == "ar"){ echo 'checked'; } ?>> <?=getSystemString(337)?>
										</label>
										
										<label class="radio-inline" style="text-align: center">
											<input type="radio" name="website_language" value="en-ar" class="radio" <?PHP if($wbs[0]->Website_Language == "en-ar"){ echo 'checked'; } ?>> <?=getSystemString(335)?>
										</label>
								
									</div>
								</div>
						   </div>
						   <?PHP
							   }
						   ?>
						  <!-- ~~~~~~~~~~~~~~~~ End Default languages  ..... ~~~~~~~~~~~~~~~~~~~ -->
						   
						  <!-- ~~~~~~~~~~~~~~~~ Start website status ..... ~~~~~~~~~~~~~~~~~~~ -->
						          
						  <div class="panel white" style="padding-bottom: 50px;">
							          <h3><?=getSystemString(279)?></h3>
					         
								         <div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="website_title"><?=getSystemString(33)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												
												<label class="radio-inline" style="text-align: center">
													<input type="radio" name="Status" value="0" class="radio" <?PHP if(!$wbs[0]->Website_Status){ echo 'checked'; }?>> <?=getSystemString(34)?>
												</label>
												
												<label class="radio-inline" style="text-align: center">
													<input type="radio" name="Status" value="1" class="radio" <?PHP if($wbs[0]->Website_Status){ echo 'checked'; } ?>> <?=getSystemString(35)?>
												</label>
												
												<p><small><?=getSystemString(36)?></small></p>
											</div>
										</div>
								          
								          
							        
							          
						          </div>
						          
						  <!-- ~~~~~~~~~~~~~~~~ End Website Status ..... ~~~~~~~~~~~~~~~~~~~ -->        
					</div>
		        <div class="col-md-10 rtl-right">
			          <div class="form-group">
							<div class="col-xs-12 text-center">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
							</div>
					</div>
		          </div>
					         </form>
					         
					         
					         <!-- ~~~~~~~~~~~~~~~~ Website Logs ~~~~~~~~~~~~~~~~~~~ -->
					         <?PHP
				if($this->session->userdata($this->acp_session->role()) == 'super_admin' || $this->session->userdata($this->acp_session->role()) == 'admin') {
			?>
					         
						<div class="col-md-10">
							<h1><?=getSystemString(297)?></h1>
							<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
								<table class="table table-hover display" id="applications" width="100%">
									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
											<th><?=getSystemString(1)?></th>
											<th><?=getSystemString(298)?></th>
											<th><?=getSystemString(42)?></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
	
						</div>
						<?PHP
							}
						?>
							
						</div>
					         
				</div>
			</div>
	</div>
	<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	menu_track_manual(10, 0);
	$(function(){
		if($('#applications').length > 0){
			var dTable = $('#applications').DataTable({
		        processing: true,
		        filter:false,
		        responsive: true,
		        autoWidth:false,
		        lengthMenu: [ [15, 100, 500, 1000, -1], [15, 100, 500, 1000, "All"] ],
				pageLength: 15,
		        serverSide: true,
		        ajax: {
		            url: "<?=base_url('datatable/getWebsiteLogs')?>",
		            type: "POST"
		        },
				language: {
		           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
				},
				drawCallback:function(){
					$("#applications_filter input").addClass('form-control').css({
						    "width": "180px",
							"display": "inline-block"
					});
				}
			});
		}
	});
</script>
</body>
</html>