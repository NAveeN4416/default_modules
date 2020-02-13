	<div id="content-main">
		<h3>
			<?=getSystemString(449)?>
		</h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-10">
					
					<?PHP
						$lang_setting['website_lang'] = $website_lang;
						//load tabs
						$this->load->view('acp_includes/lang-tabs', $lang_setting);
					?>
						
					<form action="<?=base_url($__controller.'/addNewQuestion');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		          <div class="panel white" style="padding-bottom: 50px;">
			           <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
				         		<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(451)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea class="form-control" rows="1" name="title_en" placeholder="<?=getSystemString(451)?>"><?=@$post['title_en']?></textarea>
										
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(452)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 no-padding-left">
										<textarea class="basic-editor-en" name="editor1" id="editor3"><?=@$post['editor1']?></textarea>
										
									</div>
								</div>
								
				           </div>
				           
				           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					           <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(451)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea class="form-control" 
												  rows="1" 
												  name="title_ar" 
												  placeholder="<?=getSystemString(451)?>" 
												  dir="rtl"
												  require=""
												  data-parsley-required-message="<?=getSystemString(213)?>"><?=@$post['title_ar']?></textarea>
										
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(452)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 no-padding-left">
										<textarea class="basic-editor-ar" name="editor2" id="editor4"><?=@$post['editor2']?></textarea>
										
									</div>
								</div>
				           </div>
				           
			           </div>
			           
			           <!--
<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="slide_picture"><?=getSystemString(14)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="file" name="faq_picture" id="fileToUpload" class="fileToUpload" required="">
								<img id="previewHolder" class="previewImg-S" alt="" src="" style="width: 200px;border-radius: 2px;margin-top:10px">
							</div>
						</div>
-->								                 
									
			          
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
</body></html>