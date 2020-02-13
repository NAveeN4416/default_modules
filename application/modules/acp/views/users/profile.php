<style>
	.crop-image{
		width: 120px;
		height: 120px;
	}
</style>
	<div id="content-main">
			<div class="row">
				
								<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-10">
					<div class="col-xs-12 no-padding">
						<h1><?=getSystemString(87)?></h1>
					</div>
				<form action="<?=base_url($__controller.'/updateProfile');?>" class="form-horizontal" method="post">	
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          				         
				         <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(81)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="hidden" value="<?=$user[0]->User_ID?>" name="user_id">
								<input type="text" class="form-control" name="name" placeholder="<?=getSystemString(81)?>" required="" value="<?=$user[0]->Fullname?>">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(82)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="hidden" value="<?=$user[0]->Username?>" name="old_email">
								<input type="email" class="form-control" name="username" placeholder="<?=getSystemString(82)?>" required="" value="<?=$user[0]->Username?>">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(83)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="password" class="form-control" name="password" placeholder="Password" value="">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="service_picture"><?=getSystemString(14)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								    <input type="hidden" class="crop_img_url" value="<?=$user[0]->Picture?>">
									<div class="crop-image">
										<input type="hidden" name="image-data" id="image-data">
										<input type="hidden" id="check_chng_img" name="check_chng_img" value="-2">
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
	$(function(){
		if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){
			
			imageEditor.croppie('bind', {
				url: '<?=base_url($GLOBALS['img_users_dir'])?>'+$('.crop_img_url').val()
			});
			
			cropImageActive();
		}
	});
</script>
</body>
</html>