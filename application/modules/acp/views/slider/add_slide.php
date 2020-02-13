	<div id="content-main">
		<h1><?=getSystemString(78)?></h1>
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
					
					<form action="<?=base_url($__controller.'/addNewSlide');?>" class="form-horizontal" method="post" enctype="multipart/form-data">	
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          				         
				          <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(77)?>" >
										
									</div>
								</div>
						         
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(271)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="caption_en" rows="5" class="form-control" placeholder="<?=getSystemString(272)?>"></textarea>
										
									</div>
								</div>
						         
				           </div>
				           
				           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					           <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(77)?>" dir="rtl">
										
									</div>
								</div>
					           
					           <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(271)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="caption_ar" rows="5" class="form-control" placeholder="<?=getSystemString(272)?>" dir="rtl"></textarea>
										
									</div>
								</div>
					           
				           </div>
				           
				          </div>
						
						<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(273)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="url" class="form-control" name="link" placeholder="<?=getSystemString(274)?>">
										
									</div>
								</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="slide_picture"><?=getSystemString(14)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="file" name="slide_picture" id="fileToUpload" class="fileToUpload" required="">
								<small>width: 1920px & height: 900px</small>
								<img id="previewHolder" class="previewImg-S" alt="" src="" style="width: 200px;border-radius: 2px;margin-top:10px">
							</div>
						</div>
						
						
			          
		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-center">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(79)?>" name="submit" />
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
	$(function(){
		menu_track_manual(8,0);
	});
</script>
</body>
</html>