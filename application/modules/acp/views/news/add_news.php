	<style>
		    .ci-preview-labels div{
	    padding-top: calc(100% - 250px);
    }
	input[type="range"], .cropit-image-preview{
			width: 312px;
		}
		.cropit-image-preview{
			height: 194px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
	<div id="content-main">
		<h3><?=getSystemString('add_new_news')?></h3>
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
        			<form action="<?=base_url($__controller.'/addNews_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data">	
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          	
				          <div class="tab-content">			         
							
							<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(58)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<select class="form-control select" 
												name="category"
												id="select_category"
												data-placeholder="<?=getSystemString(59)?>" 
												required 
												data-parsley-required-message="<?=getSystemString(213)?>"
												data-create-link="#new_category"
												data-create-text="<?=getSystemString(96)?>">
											<option value=""><?=getSystemString(59)?></option>
									<?PHP
										
										foreach($categories as $row){
											$cat_nn = 'Category_'.$__lang;
											?>
											<option value="<?=$row->Category_ID?>" <?PHP if(@$postback[0]->category == $row->Category_ID) { echo 'selected'; } ?>><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>
										
									</div>
								</div>
							
							<div class="tab-pane fade  <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
							
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(145).' en *'?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" id="title_en" placeholder="<?=getSystemString(497)?>" required 
												data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="content_en" class="editors1" id="editor1"></textarea>
									</div>
								</div>
								
							</div>
							
							<div class="tab-pane fade  <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
							
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(145).' ar *'?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="<?=getSystemString(497)?>" dir="rtl" 												required 
												data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="content_ar" class="editors2" id="editor2"></textarea>
									</div>
								</div>
								
							</div>
							
						
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(14)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" class="fileToUpload" name="news_picture" data-thumb-width="650" data-thumb-height="450">
									<small>Image Dimensions (min-width: 650px and min-height:450px)</small>
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
	$this->load->view('news/snippets/add_modal');
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
<script>
	var _lang = '<?=$__lang?>';
	var _postCategoryURL = '<?=base_url($__controller.'/addCategory_HTTP')?>';
	
	$(function(){
		
		$(".select2").select2({
			theme:'bootstrap'
		}).on('select2:open', function (e) {
			
		  createSelect2Button(e);
		});
		
		var options = {
			formId        : "form_new_category",
			ENNameId      : "category_en",
			ARNameId 	  : "category_ar",
			selectFieldId : "select_category",
			postURL 	  : _postCategoryURL
		};
		Select2Options.init(options);
		
	}); 			
 			

</script>
</body>
</html>