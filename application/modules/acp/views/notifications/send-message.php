<link href="<?=base_url('style/acp/css/select2.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('style/acp/css/select2-bootstrap.min.css')?>" rel="stylesheet" />

<style type="text/css">
.select2-container--bootstrap .select2-selection--multiple .select2-selection__rendered {
    overflow-y: scroll;
    max-height: 80px;
}
</style>

<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<form action="<?=base_url($__controller.'/sendMessageToMembers');?>" class="form-horizontal" method="post" data-parsley-validate enctype="multipart/form-data">
					<div class="col-md-10">
						<h3> <?=getSystemString('send_email')?></h3>
						
						
			          <div class="panel white" style="padding-bottom: 50px;">
				          
				          			<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"><?=getSystemString(368).' '.getSystemString(1)?></label>
										</div>
										<?php foreach($members as  $row) { ?>
											<input type="hidden" name="total_members[]" value="<?=$row->Email?>">
										<?php } ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<select class="form-control select2" name="members[]" multiple="" data-placeholder="<?=getSystemString('select_email')?>" id="Customers">
												<?PHP
													foreach($members as $row)
													{
														?>
														<option value="<?=$row->Email?>"
														<?PHP
															if(isset($postmembers))
															{
																foreach($postmembers as $m)
																{
																	if($m == $row->Customer_ID)
																	{
																		echo 'selected';
																	}
																}
															}
														?>
														><?=$row->Email?></option>
														<?PHP
													}
												?>
											</select>											
										</div>
									</div>

				          			<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"><?=getSystemString(299).' '.getSystemString(1)?></label>
										</div>
										<?php foreach($companies as  $row) { ?>
											<input type="hidden" name="total_companies[]" value="<?=$row->Email?>">
										<?php } ?>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<select class="form-control select2" name="companies[]" multiple="" data-placeholder="<?=getSystemString('select_email')?>" id="Companies">
												<?PHP
													foreach($companies as $row)
													{
														?>
														<option value="<?=$row->Email?>"
														<?PHP
															if(isset($postmembers))
															{
																foreach($postmembers as $m)
																{
																	if($m == $row->Company_ID)
																	{
																		echo 'selected';
																	}
																}
															}
														?>
														><?=$row->Email?></option>
														<?PHP
													}
												?>
											</select>											
										</div>
									</div>

									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<label><?=getSystemString(676)?></label>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"><?=getSystemString(497)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="checkbox" id="c7" class="control rounded block" name="all_customers" onclick="check_all_cu(this)" />
											<label for="c7"><span></span><?=getSystemString(495)?></label>
											<input type="checkbox" id="c8" class="control rounded block" name="all_companies" onclick="check_all_co(this)"/>
											<label for="c8"><span></span><?=getSystemString(496)?></label>
										</div>
									</div>
				          
				          			<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"><?=getSystemString(244)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" name="subject" class="form-control" value="<?=@$subject?>" placeholder="<?=getSystemString(675)?>" required data-parsley-trigger="change" data-parsley-required-message="<?=getSystemString(213)?>">
										</div>
									</div>
				          
						           	<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"><?=getSystemString(13)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
											<textarea name="message" id="editor2" rows="12" class="margin-bottom basic-editor-en" cols="40" ><?=@$message?></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"><?=getSystemString(678)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
											<input type="file" name="attach_file">
										</div>
									</div>
						
				          
			          </div>
					</div>
					
								<div class="col-xs-12 col-md-10 no-padding">
									<div class="form-group text-right" style="width: 100%">
										<input type="submit" class="btn btn-primary" value="<?=getSystemString(246)?>" name="submit" />
									</div>
								</div>
						        
					
		          </form>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url('style/acp/js/select2.min.js')?>"></script>
<script>
	$(function(){
		$('.select2').select2({
			theme: 'bootstrap',
			placeholder: '<?=getSystemString(426)?>'
		});
	});
</script>

<script>
function check_all_cu($this)
{
	if($($this).is(':checked'))
	{
		//$("#Customers").find('option').prop("selected",true); // updated by A to false | to uncheck selected
        //$("#Customers").trigger('change');
	}
	else
	{
		//$("#Customers").find('option').prop("selected",false);
        //$("#Customers").trigger('change');
	}
}

function check_all_co($this)
{
	if($($this).is(':checked'))
	{
		//$("#Companies").find('option').prop("selected",true);
        //$("#Companies").trigger('change');
	}
	else
	{
		$("#Companies").find('option').prop("selected",false);
        $("#Companies").trigger('change');
	}
}
</script>