<?php

$times = ["12:00 AM","12:30 AM","1:00 AM","1:30 AM","2:00 AM","2:30 AM","3:00 AM","3:30 AM","4:00 AM","4:30 AM","5:00 AM","5:30 AM","6:00 AM","6:30 AM","7:00 AM","7:30 AM","8:00 AM","8:30 AM","9:00 AM","9:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 PM","12:30 PM","1:00 PM","1:30 PM","2:00 PM","2:30 PM","3:00 PM","3:30 PM","4:00 PM","4:30 PM","5:00 PM","5:30 PM","6:00 PM","6:30 PM","7:00 PM","7:30 PM","8:00 PM","8:30 PM","9:00 PM","9:30 PM","10:00 PM","10:30 PM","11:00 PM","11:30 PM",] ;

?>



	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
	<style>
		body[dir="ltr"] .txt-right{
			text-align: left;
		}
		body[dir="rtl"] .txt-right{
			text-align: right;
		}
		#map{
			width: 100%;
			height: 350px;
		}
		.img-responsive{
			width: 50%;
			margin: auto;
		}
		#map .form-control{
			width: 50% !important;
			top: 8px !important;
		}
		.dropzone{
			min-height: 110px;
		}
		/* Note: used for services icons */
		#services .nopad {
			padding-left: 0 !important;
			padding-right: 0 !important;
			height: 100px;
		}
		/*image gallery*/
		#services .image-checkbox {
			cursor: pointer;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			border: 4px solid transparent;
			margin-bottom: 0;
			outline: 0;
		}
		#services .image-checkbox input[type="checkbox"] {
			display: none;
		}
		
		#services .image-checkbox-checked {
			border: 1px solid #e0e0e0;
			margin: 2px;
		}
		#services .image-checkbox .fa {
		  position: absolute;
		  color: #4A79A3;
		  background-color: #fff;
		  padding: 10px;
		  top: 0;
		  right: 0;
		}
		#services .image-checkbox-checked .fa {
		  display: block !important;
		}
		#services p{
		    color: #798190;
		    font-weight: 400;
		    margin-top: 10px;
		}
	</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp/acp_includes/response_messages');
				?>

				<div class="col-md-12">
					<h3><?=getSystemString(170)?></h3>
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$lang_setting['extra_targets_en'] = "#lang_en, #lang_en2";
							$lang_setting['extra_targets_ar'] = "#lang_ar, #lang_ar2";
							$this->load->view('acp/acp_includes/lang-tabs', $lang_setting);
						?>
					
					
					  <form action="<?=base_url($__controller.'/edit_campaign_POST');?>" class="form-horizontal" method="post" onsubmit="return Calculate_TimeDiff()">	
					
						  <div class="panel white" style="padding-bottom: 50px;">
							  <div class="col-md-10">
								
								<input type="hidden" name="campaign_id" id="c_campaign_id" value="<?=$campaign->Campaign_ID?>">
						  		<div class="tab-content" id="tab-cnt1">
						  			
						  			<div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						            	<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="title"><?=getSystemString(17)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<input type="text" 
														class="form-control"
														value="<?php if($campaign->Culture == 'en'){ echo $campaign->Campaign_Name; }  ?>" 
														name="name_en" 
														placeholder="<?=getSystemString(156)?>">
												
											</div>
										</div>
					
									</div> <!-- END TAB en -->
						  			
						        	<div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
						            	<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="title"><?=getSystemString(17)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<input type="text" 
														class="form-control"
														value="<?php if($campaign->Culture == 'ar'){ echo $campaign->Campaign_Name; }  ?>"
														name="name_ar" 
														placeholder="<?=getSystemString(156)?>">
												
											</div>
										</div>
					
									</div> <!-- END TAB ar -->
						  		</div><!-- END TAB Content -->

								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">Category</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<select class="form-control select" 
												name="category"												
												required
												data-parsley-required-message="<?=getSystemString(213)?>">
												<option value=""><?=getSystemString(59)?></option>
												<option value="1" <?=($campaign->Category==1) ? 'selected' : '' ;?>>Male</option>
												<option value="2" <?=($campaign->Category==2) ? 'selected' : '' ;?>>Female</option>
												<option value="3" <?=($campaign->Category==3) ? 'selected' : '' ;?>>Male & Female</option>
												<option value="4" <?=($campaign->Category==4) ? 'selected' : '' ;?>>Families</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">Is kid Allowed ?</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="checkbox" id="is_kid_allowed" onchange="HideChild()" name="is_kid_allowed" <?php if($campaign->child_allowed) { echo "checked"; } ?>> Yes
									</div>
								</div>

						  		<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(167)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<div class="input-group">
											
											<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
											<input type="number" 
												   class="form-control" 
												   name="amount_person" 
												   placeholder="800"
												   value="<?=$campaign->Amount_Person?>"
												   required="" 
												   data-parsley-required-message="<?=getSystemString(213)?>">
										</div>
										
									</div>
								</div>
						  			
						  		<div class="form-group <?php echo ($campaign->child_allowed==0) ? 'hide' : '' ;  ?>" id="hide_child">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString('child_cost')?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<div class="input-group">
											
											<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
											<input type="number" 
												   class="form-control" 
												   name="amount_child" 
												   placeholder="60"
												   value="<?=$campaign->Amount_child?>"
												   <?php echo ($campaign->child_allowed==1) ? 'required' : '' ;  ?>
												   id="child_cost"
												   data-parsley-required-message="<?=getSystemString(213)?>">
										</div>
										
									</div>
								</div>
						<!-- 		
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(138)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<div class="input-group">
									<?PHP
										$from_date = new DateTime($campaign->From_Date);
										$to_date = new DateTime($campaign->To_Date);
									?>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" 
											class="form-control input-date txt-right" 
											id="from" 
											name="fromdate" 
											placeholder="20/02/2018"
											value="<?=$from_date->format('d-m-Y')?>"
											required
											data-parsley-required-message="<?=getSystemString(213)?>">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(139)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<div class="input-group">
									
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									
									<input type="text" 
											class="form-control input-date txt-right" 
											id="to" name="todate"
											placeholder="15/03/2018"
											value="<?=$to_date->format('d-m-Y')?>"
											required
											data-parsley-required-message="<?=getSystemString(213)?>">
											
											<input type="hidden" name="duration" class="dt-duration" value="<?=$campaign->Total_Days?>">
											<input type="hidden" name="duration_type" id="duration_type" value="<?=$campaign->Duration_Type?>">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString('starttime')?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="form-control select" 
										name="start_time"
										id="start_time"													
										required
										data-parsley-required-message="<?=getSystemString(213)?>">
										<option value="<?=$campaign->Start_Time?>" onchange="set_feature_time()"><?=$campaign->Start_Time?></option>
										<?php foreach($times as $key => $time):?>
											<option value="<?=$time?>" <?php if($campaign->Start_Time == $time){echo 'selected';}?> onchange="set_feature_time()"><?=$time?></option>
										<?php endforeach ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString('endtime')?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="form-control select" 
										onchange="Calculate_TimeDiff()"
										name="end_time"
										id="end_time"													
										required
										
										data-parsley-required-message="<?=getSystemString(213)?>" onchange="set_feature_time()">
										<option value="<?=$campaign->End_Time?>" onchange="set_feature_time()"><?=$campaign->End_Time?></option>
										<?php foreach($times as $key => $time):?>
											<option value="<?=$time?>" <?php if($campaign->End_Time == $time){echo 'selected';}?> onchange="set_feature_time()"><?=$time?></option>
										<?php endforeach ?>
								</select>
							</div>
							
						</div>
						<?php $duration_type = ($campaign->Duration_Type==0) ? 'hours' : 'days' ; ?>
								<p class="text-primary"><?=getSystemString('totalDur')?> <b><span id="dt-duration"><?=$campaign->Total_Days?> <?=$duration_type?></span></b></p>
						
						 -->



								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(138)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-3 no-padding-left">
										<div class="input-group">
											<?PHP
												$from_date = new DateTime($campaign->From_Date);
												$to_date = new DateTime($campaign->To_Date);
											?>
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text"
													class="form-control input-date txt-right" 
													id="from" 
													name="fromdate" 
													placeholder="20/02/2018"
													value="<?=$from_date->format('d-m-Y')?>"
													required
													data-parsley-required-message="<?=getSystemString(213)?>">
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-<?php if($__lang == 'en') {echo '2';}else{echo '3';}?>">
											<label for="title"><?=getSystemString('starttime')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-<?php if($__lang == 'en') {echo '2';}else{echo '9';}?> no-padding-left">
											<select class="form-control select" 
													name="start_time"
													id="start_time"													
													required
													onchange="set_feature_time()"
													data-parsley-required-message="<?=getSystemString(213)?>">
													<?php foreach($times as $key => $time):?>
													<option value="<?=$time?>" <?php if($campaign->Start_Time == $time){echo 'selected';}?>><?=$time?></option>
													<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(139)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-3 no-padding-left">
										<div class="input-group">
											
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											
											<input type="text" 
													class="form-control input-date txt-right" 
													id="to" name="todate"
													placeholder="15/03/2018"
													value="<?=$to_date->format('d-m-Y')?>"
													required
													data-parsley-required-message="<?=getSystemString(213)?>">
													
													<input type="hidden" name="duration" class="dt-duration" value="<?=$campaign->Total_Days?>">
													<input type="hidden" name="duration_type" id="duration_type" value="<?=$campaign->Duration_Type?>">
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-<?php if($__lang == 'en') {echo '2';}else if($__lang == 'ar'){echo '3';}?>">
											<label for="title"><?=getSystemString('endtime')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-<?php if($__lang == 'en') {echo '2';}else if($__lang == 'ar'){echo '9';}?> no-padding-left">
											<select class="form-control select" 
													onchange="Calculate_TimeDiff()"
													name="end_time"
													id="end_time"													
													required
													data-parsley-required-message="<?=getSystemString(213)?>">
													<?php foreach($times as $key => $time):?>
													<option value="<?=$time?>" <?php if($campaign->End_Time == $time){echo 'selected';}?> onchange="set_feature_time()"><?=$time?></option>
													<?php endforeach ?>
											</select>
										</div>
										
									</div>
									<?php $duration_type = ($campaign->Duration_Type==0) ? 'hours' : 'days' ; ?>
											<p class="text-primary"><?=getSystemString('totalDur')?> <b><span id="dt-duration"><?=$campaign->Total_Days?> <?=$duration_type?></span></b></p>
								</div>
						



							<br>
								<fieldset>
  								<legend>Responsible One:</legend>
					            	<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title">Name</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" 
													class="form-control" 
													name="rp1[name]" 
													placeholder="Person Name" required value="<?=$campaign->Responsiblity[0]['name']?>">
										</div>
									</div>
					            	<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title">Mobile</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" 
													class="form-control" 
													name="rp1[mobile]" 
													placeholder="Person Mobile" required value="<?=$campaign->Responsiblity[0]['mobile']?>">
										</div>
									</div>
  								</fieldset>
  								<hr>
								<fieldset>
  								<legend>Responsible Two:</legend>
					            	<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title">Name</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" 
													class="form-control" 
													name="rp2[name]" 
													placeholder="Person Name" value="<?=$campaign->Responsiblity[1]['name']?>">
										</div>
									</div>
					            	<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title">Mobile</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" 
													class="form-control" 
													name="rp2[mobile]" 
													placeholder="Person Mobile" value="<?=$campaign->Responsiblity[1]['mobile']?>">
										</div>
									</div>
  								</fieldset>
  								<hr>


								<div class="form-group" id="services">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(144)?></label>
										<p><?=getSystemString('select_by_click')?></p>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">									
									<!-- Note: updated by A -->
									    <?php 
										    foreach($list as $row):
										    $title = 'Title_'.$__lang;
										    $img = base_url('content/services/'.$row->Icon);
										    
									    ?>
									    <div class="col-xs-4 col-sm-3 col-md-1 nopad text-center">
										    <label class="image-checkbox">
										      <img class="img-responsive" src="<?=$img?>" />
										      <p><?=$row->$title?></p>
										      <input type="checkbox" name="services[]" multiple="multiple" id="<?=$row->Service_ID?>" value="<?=$row->Service_ID?>" 
												<?php //$value = explode(", ", $campaign[0]->Services);
		
													if(in_array($row->Service_ID,$campaign->Services))
													{
														echo 'checked';
													}
												?>
												>
										      <i class="fa fa-check hidden"></i>
										    </label>
										</div>
										<?php  endforeach; ?>
									<!-- Ends -->										
									</div>
								</div>


								<!-- <div class="form-group ">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(144)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									
									Note: updated by A
									    <?php 
										
										    
										foreach($list as $row):
										    $title = 'Title_'.$__lang;
										    
									    ?>
										<input type="checkbox" name="services[]" multiple="multiple" id="<?=$row->Service_ID?>" value="<?=$row->Service_ID?>" 
										<?php //$value = explode(", ", $campaign->Services);
								
											if(in_array($row->Service_ID,$campaign->Services))
											{
												echo 'checked';
											}
										?>
										>
										<?=$row->$title?>
										<?php  endforeach; ?>
									Ends										
									</div>
								</div>
								 -->
								<?php
								
									$more_features_toggle = "" ;
									$more_features_checked = "checked" ;

									  if($campaign->more_features=='0')
									  {
									  	$more_features_toggle = "hide";
									  	$more_features_checked = "" ;
									  }
								?>

								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1">Add More Features</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="checkbox" name="more_features" id="more_features" onchange="Add_more_feautres()" <?=$more_features_checked?> >
										<?=getSystemString(374)?>
									</div>
								</div>
								
								<div class="<?=$more_features_toggle?>" id="show_more_features">
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor1"><?=getSystemString('more_features')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<textarea name="other_features" class="basic-editor-en" id="editor9"><?=$campaign->other_features?></textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor1">Other features Charges</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" class="form-control" name="other_features_charges" id="other_features_charges" value="<?=$campaign->other_features_charges?>">
										</div>
									</div>
								</div>

								<div class="tab-content" id="tab-cnt2" style="padding-top: 0px !important">
									<div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en2">
										<!-- <div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1"><?=getSystemString('more_features')?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="programs_en" class="basic-editor-en" id="editor9"><?PHP  if($campaign->Culture == 'en'){ echo $campaign->Programs;  } ?></textarea>
												
											</div>
										</div> -->
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1"><?=getSystemString(72)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="desc_en" class="basic-editor-en" id="editor5"><?PHP  if($campaign->Culture == 'en'){ echo $campaign->Campaign_Description; } ?></textarea>
												
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1"><?=getSystemString('trip_req')?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="requirements_en" class="basic-editor-en" id="editor7"><?PHP if($campaign->Culture == 'en'){ echo $campaign->Requirements; }  ?></textarea>
												
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1"><?=getSystemString('trip_term')?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="terms_en" class="basic-editor-en" id="editor11"><?PHP if($campaign->Culture == 'en'){ echo $campaign->Terms;  } ?></textarea>
												
											</div>
										</div>
									</div>
									<div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar2">
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1"><?=getSystemString(72)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="desc_ar" class="basic-editor-ar" id="editor6"><?PHP  if($campaign->Culture == 'ar'){ echo $campaign->Campaign_Description;  } ?></textarea>
												
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1">المتطلبات</label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="requirements_ar" class="basic-editor-en" id="editor8"><?PHP if($campaign->Culture == 'ar'){ echo $campaign->Requirements;  } ?></textarea>
												
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1">البرامج</label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="programs_ar" class="basic-editor-en" id="editor10"><?PHP  if($campaign->Culture == 'ar'){ echo $campaign->Programs; }  ?></textarea>
												
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="editor1">الشروط</label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<textarea name="terms_ar" class="basic-editor-en" id="editor12"><?PHP foreach($campaign as $c){ if($campaign->Culture == 'ar'){ echo $campaign->Terms; } } ?></textarea>
												
											</div>
										</div>
									</div>

									<!-- <div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString('Send Push Notification')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="push_notification" value="1">Charges 50 SAR</label>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString('featuresTrip')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="featured_trip" value="1">Charges 50 SAR</label>
											</div>
											<p><?=getSystemString('special_note')?></p>
										</div>
									</div> -->
									
								
								
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString('meeting_point')?></label>
										</div>
									</div>
									
									<?php 

										$meeting_point = [] ;

										if($campaign->Meeting_Point)
										{
											$meeting_point = $campaign->Meeting_Point ;
										}

									?>
									<div class="col-xs-12">
								          <input id="pac-input2" class="controls form-control" type="text" placeholder="<?=getSystemString(164)?>" style="top: 15px !important" value="<?=$meeting_point['address']?>"> 
										  <div id="map2" style="width: 800px;height: 300px"></div>
										  <input type="hidden" id="latitude2" name="latitude2" value="<?=$meeting_point['latitude']?>">
										  <input type="hidden" id="longitude2" name="longitude2" value="<?=$meeting_point['longitude']?>">
										  
										  <input type="hidden" id="frm_address2" name="address2" value="<?=$meeting_point['address']?>">
										  <input type="hidden" id="country2" name="country2" value="<?=$meeting_point['country']?>">
										  <input type="hidden" id="locality2" name="city2" value="<?=$meeting_point['city']?>">
										  <input type="hidden" id="administrative_area_level_12" name="region2" value="<?=$meeting_point['region']?>">
						          	</div>

								</div> <!-- END TAB Content -->
							  </div>
						  </div>
				
						  <div class="panel white" style="padding-bottom: 50px;height: 100%;overflow: hidden">
							  <div class="col-md-10 ">
							    <h3><?=getSystemString(159)?></h3>
								<br>
								
								<div class="form-group hide">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(161)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" 
												class="form-control"
												value="<?=$campaign->Building_Info?>"
												name="building_info" 
												placeholder="<?=getSystemString(463)?>">
										
									</div>
								</div>
								
					          	<div class="col-xs-12" style="padding: 0px">
			<!-- 				    <a href="#" class="add-location btn hide"><i class="fa fa-plus-circle"></i></a> -->
							          <input id="pac-input" class="controls form-control" type="text" placeholder="<?=getSystemString(164)?>" value="<?=$campaign->Address?>"> 
									  <div id="map"></div>
									  <?PHP
										  $lat = '24.7136';
										  $lng = '46.6753';
										  $put_marker = 0;
										  
										  if(strlen($campaign->Location) > 1)
										  {
											  $location = explode(",", $campaign->Location);
											  $lat = $location[0];
											  $lng = $location[1];
											  $put_marker = 1;
										  }
									  ?>
									  <input type="hidden" id="latitude" name="latitude" value="<?=$lat?>">
									  <input type="hidden" id="longitude" name="longitude" value="<?=$lng?>">
									  
									  <input type="hidden" id="frm_address" name="address" value="<?=$campaign->Address?>">
									  <input type="hidden" id="country" name="country" value="<?=$campaign->Country?>">
									  <input type="hidden" id="locality" name="city" value="<?=$campaign->City?>">
									  <input type="hidden" id="put_marker" value="<?=$put_marker?>">
									  <input type="hidden" id="administrative_area_level_1" name="region" value="<?=$campaign->Region?>">
					          	</div>
							  </div>
						    </div>
						  
						  <?PHP
							  $this->load->view('company/campaigns/snippets/pictures_list');
						  ?>
						  
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
	$this->load->view('acp/acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/dropzone.js')?>"></script>


<script>

var overall_hours = parseInt("<?=$campaign->Total_Days?>") ;

function calculate() 
{
	var duration_string = '' ;

    var d1 = $('#from').datepicker('getDate');
    var d2 = $('#to').datepicker('getDate');
    var diff = 0;

    if (d1 && d2) 
    {
    	if(d2.getTime() == d1.getTime())
    	{
    		diff = overall_hours ;

    		duration_string =  overall_hours + ' hours' ;

    		$("#duration_type").val(0) ;
    	}
    	else
    	{
    		diff = diff + Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day

    		duration_string = diff + ' days' ;

    		$("#duration_type").val(1) ;
    	}
    }

    $('.dt-duration').val(diff);
    $('#dt-duration').text(duration_string);
}


function getDate( element ) {
  var date;
  try {
    date = $.datepicker.parseDate( _dateFormat, element.value );
  } catch( error ) {
    date = null;
  }

  return date;
}


function set_feature_time()
{
	var start_time = $("#start_time").val();

	if(start_time)
	{
		$("#end_time").removeClass('disabled');	
		$("#end_time").removeAttr('disabled');	
		//$("#end_time").attr('min',start_time)
		$("#end_time").html('');

		var times = ["12:00 AM","12:30 AM","1:00 AM","1:30 AM","2:00 AM","2:30 AM","3:00 AM","3:30 AM","4:00 AM","4:30 AM","5:00 AM","5:30 AM","6:00 AM","6:30 AM","7:00 AM","7:30 AM","8:00 AM","8:30 AM","9:00 AM","9:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 PM","12:30 PM","1:00 PM","1:30 PM","2:00 PM","2:30 PM","3:00 PM","3:30 PM","4:00 PM","4:30 PM","5:00 PM","5:30 PM","6:00 PM","6:30 PM","7:00 PM","7:30 PM","8:00 PM","8:30 PM","9:00 PM","9:30 PM","10:00 PM","10:30 PM","11:00 PM","11:30 PM"] ;

		var flag = 0 ;
		var string = "<option value='' selected><?=getSystemString(59)?></option>" ;


		for (i in times)
		{
			if(flag==0 && times[i]==start_time)
			{
				flag = 1 ;
			}

			if(flag==1)
			{
				string += "<option value='"+times[i]+"'>"+times[i]+"</option>" ;
			}
		}

		$("#end_time").html(string);
	}

	Calculate_TimeDiff();
}

function Calculate_TimeDiff()
{
	var start_time = $("#start_time").val();
	var end_time = $("#end_time").val();

	if(start_time && end_time)
	{
		//12hrs format change into 24hrs format
		start_time = start_time.split(" ");  //Array of Time(2:00) & format (AM or PM)
		end_time   = end_time.split(" "); //Array of Time(12:00) & format (AM or PM)

		var starttime_format = start_time[1];  //AM or PM
		var endtime_format = end_time[1];  //AM or PM

		start_time = start_time[0]; //like 12:00
		end_time = end_time[0]; //like 2:00

		start_time = start_time.split(":"); //Array of hours & Time => [hours,minutes]
	    end_time   = end_time.split(":"); //Array of hours & Time => [hours,minutes]

	    if(starttime_format=='PM'){ start_time[0] = String(parseInt(start_time[0])+12); };
	    if(endtime_format=='PM'){ end_time[0] = String(parseInt(end_time[0])+12); };


	    start_time = parseFloat(start_time[0]+'.'+start_time[1]);
	    end_time = parseFloat(end_time[0]+'.'+end_time[1]);

	    //alert(start_time+' '+end_time);

	    if(starttime_format=='AM' && (start_time==12.3 || start_time==12))
	    {
	    	if(start_time==12.3)
	    	{
	    		start_time = 0.3 ;
	    	}
	    	else
	    	{
	    		start_time = 0 ;
	    	}
	    }

	    if(starttime_format=='PM' && (start_time==24 || start_time==24.3))
	    {
	    	if(start_time==24)
	    	{
	    		start_time = 12 ;
	    	}
	    	else
	    	{
	    		start_time = 12.3 ;
	    	}
	    }

	    if(endtime_format=='AM' && (end_time==12.3 || end_time==12))
	    {
	    	if(end_time==12)
	    	{
	    		end_time = 0 ;
	    	}
	    	else
	    	{
	    		end_time = 0.3 ;
	    	}
	    }

	    if(endtime_format=='PM' && (end_time==24 || end_time==24.3))
	    {
	    	if(end_time==24)
	    	{
	    		end_time = 12 ;
	    	}
	    	else
	    	{
	    		end_time = 12.3 ;
	    	}
	    }


	    //alert(start_time+' '+end_time);

	    var diff = end_time - start_time ; 	

    	if(diff<1)
    	{
	    	alert("Time atleast 1 hour gap needed") ;
	    	$("#end_time").val('');
	    	return false;
	    }

	    diff = parseInt(diff);

	    overall_hours = diff ;

	    calculate();
	    //alert(diff);
	   

/*	    var start_time = new Date(0, 0, 0, start_time[0], start_time[1], 0);
	    var end_time = new Date(0, 0, 0, end_time[0], end_time[1], 0);

	    var diff = end_time.getTime() - start_time.getTime();

	    var diff = new Date(diff);
	    alert(diff.getHours());

	    var hours = Math.floor(diff / 1000 / 60 / 60);
	    diff -= hours * 1000 * 60 * 60;
	    var minutes = Math.floor(diff / 1000 / 60);*/

/*	    hours = parseInt(hours);

	    //alert(hours);

	    if(hours<=0)
	    {
	    	alert("Time atleast 1 hour gap needed") ;

	    	return false
	    }

	    if(hours < 24)
	    {
	    	//alert(hours)
	    	overall_hours = hours ;
	    }

	    calculate();*/
	}
}
	$(function(){
		
		$(".features-tokenizer").select2({
		    tags: true,
		    tokenSeparators: [','],
		    placeholder: "<?=getSystemString(168)?>",
		    ajax: {
	          url: '<?=base_url($__controller.'/getFeatures')?>',
	          dataType: 'json',
	          delay: 50,
	          processResults: function (data) {
	            return {
	              results: data
	            };
	          },
	          cache: true
	        }
		});
		
		var dateToday = new Date();
		var _dateFormat = "dd-mm-yy",
	    from = $( "#from" ).datepicker({
	          changeMonth: true,
	          numberOfMonths: 1,
	          minDate: dateToday,
	          dateFormat: _dateFormat
	          
	    }).on( "change", function() {
	         to.datepicker( "option", "minDate", getDate( this ) );
	         
	    }),
        to = $( "#to" ).datepicker({
	          changeMonth: true,
	          numberOfMonths: 1,
	          dateFormat: _dateFormat
	          
        }).on( "change", function() {
          from.datepicker( "option", "maxDate", getDate( this ) );
        });
        
        
        //get duration
        $('#from').datepicker().bind("change", function () {
		    var minValue = $(this).val();
		    minValue = $.datepicker.parseDate(_dateFormat, minValue);
		    $('#to').datepicker("option", "minDate", minValue);
		    calculate();
		});
		$('#to').datepicker().bind("change", function () {
		    var maxValue = $(this).val();
		    maxValue = $.datepicker.parseDate(_dateFormat, maxValue);
		    $('#from').datepicker("option", "maxDate", maxValue);
		    calculate();
		});
		
		// initializing dropzone
		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone("div#img-dropzone", 
			{ 
				url: '<?=base_url($__controller.'/campaignImagesUpload')?>',
				maxFiles: 10,
				sending: function(file, xhr, formData){
					formData.append('campaign_id', $('#c_campaign_id').val());
				},
				success: function(file, result)
				{
					file.previewElement.id = result;
				},
				dictCancelUpload: 'x',
				dictRemoveFile: 'x',
				addRemoveLinks: true,
				removedfile: function(file) 
				{
					var id = file.previewElement.id;
					$.ajax({
						 url: "<?=base_url($__controller.'/unlinkCampaignImage')?>",
						 data: { imageid: id},
						 type: 'post',
						 success: function (data) 
						 {
							console.log(data);
						 }
					});
	
					var _ref;
					return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
				}
			});  // End Dropzone
		
	});


function HideChild()
{
	if($('#is_kid_allowed').is(":checked"))
	{
		$("#hide_child").removeClass('hide');
		$("#child_cost").prop('required',true);
		return true;
	}

	$("#child_cost").val('');
	$("#child_cost").prop('required',false);
	$("#hide_child").addClass('hide');
}


function Add_more_feautres()
{
	if($("#more_features").is(":checked"))
	{
		$("#show_more_features").removeClass('hide');
		//$("#editor9").prop('required',true);
		//$("#other_features_charges").prop('required',true);
		return;
	}

	$("#show_more_features").addClass('hide');
	$("#editor9").prop('required',false);
	$("#other_features_charges").prop('required',false);
}

</script>
<script>
 	var uniqueId = 1;
 	var mp_markers = {};
	function initAutocomplete() {
		var myLatLng1 = {
							lat: parseFloat(document.getElementById("latitude").value), 
							lng: parseFloat(document.getElementById("longitude").value)
						};

		var myLatLng2 = {
							lat: parseFloat(document.getElementById("latitude2").value), 
							lng: parseFloat(document.getElementById("longitude2").value)
						};

        var map = new google.maps.Map(document.getElementById('map'), {
															          center: myLatLng1,
															          zoom: 6,
															          mapTypeId: 'roadmap'
															        });

        var map2 = new google.maps.Map(document.getElementById('map2'), {
														          center: myLatLng2,
														          zoom: 6,
														          mapTypeId: 'roadmap'
															    });

		// google map search box manipulation
		googleSearch(map);
		googleSearch2(map2);
		
		if($("#put_marker") == 1)
		{
			var marker = new google.maps.Marker({
	          position: myLatLng,
	          map: map,
	          draggable: false, 
			  animation: google.maps.Animation.DROP,
	        });	
		}
        
        google.maps.event.addListenerOnce(map, 'idle', function(){
			$('#pac-input').after($('.add-location'));
			$('.add-location').removeClass('hide');
			$('body[dir="ltr"] .add-location').css({
				'z-index': '1',
				'position': 'absolute',
				'top': '2px',
				'left': (parseInt($('#pac-input').width()) + 96) + "px"
			});
			
			$('body[dir="rtl"] .add-location').css({
				'z-index': '1',
				'position': 'absolute',
				'top': '-7px',
				'left': '110px'
			});
		});

        google.maps.event.addListenerOnce(map2, 'idle', function()
        {
			$('#pac-input2').after($('.add-location'));

			$('#pac-input2').css({'width':"400px",'top':"15"});

			$('.add-location').removeClass('hide');
			$('body[dir="ltr"] .add-location').css({
				'z-index': '1',
				'position': 'absolute',
				'top': '2px',
				'left': (parseInt($('#pac-input2').width()) + 96) + "px"
			});
			
			$('body[dir="rtl"] .add-location').css({
													'z-index': '1',
													'position': 'absolute',
													'top': '-7px',
													'left': '110px'
												});
		});
      
      // Note: added by A (7 OCt)
		google.maps.event.addListener(map, 'click', function(event) {
		   placeMarker(event.latLng);
		});
		
		function placeMarker(location) {
		    var marker = new google.maps.Marker({
		        position: location, 
		        map: map
		    });
		}
		
		// Ends  
      }
      
    function updateInput(lat, lng) {
	    document.getElementById("latitude").value = lat ;
      	document.getElementById("longitude").value = lng;
    }
	
	window.onload = initAutocomplete;

var componentForm = {
    //street_number: 'short_name',
    //route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    //postal_code: 'short_name'
};

function googleSearch(map){
	    var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

		// searching in map and add marker to google map after search
        var markers = [];
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          places.forEach(function(place) {
	          document.getElementById("frm_address").value = place.formatted_address;
	          document.getElementById("latitude").value = place.geometry.location.lat();
	          document.getElementById("longitude").value = place.geometry.location.lng();
	          
	          for (var i = 0; i < place.address_components.length; i++) 
	          {
		          var addressType = place.address_components[i].types[0];
		          if (componentForm[addressType]) 
		          {
		            var val = place.address_components[i][componentForm[addressType]];
		            document.getElementById(addressType).value = val;
		            console.log(addressType +' : ' +val);
		          }
		      }
		      
          });
          
          if (places.length == 0) 
          {
            return;
          }
		  
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          var bounds = new google.maps.LatLngBounds();
          //Create marker for the address returned
          createMakerForSearchResult(map, places, bounds);
          
          map.fitBounds(bounds);
        });
}

	function googleSearch2(map)
	{
	    var input = document.getElementById('pac-input2');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

		// searching in map and add marker to google map after search
        var markers = [];
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          places.forEach(function(place) {
	          //console.log(place);
	          document.getElementById("frm_address2").value = place.formatted_address;
	          document.getElementById("latitude2").value = place.geometry.location.lat();
	          document.getElementById("longitude2").value = place.geometry.location.lng();
	          
	          for (var i = 0; i < place.address_components.length; i++) 
	          {
		          var addressType = place.address_components[i].types[0];
		          if (componentForm[addressType]) 
		          {
		            var val = place.address_components[i][componentForm[addressType]];
		            document.getElementById(addressType+'2').value = val;
		            console.log(addressType +' : ' +val);
		          }
		      }
	          
          });
          
          if (places.length == 0) {
            return;
          }
		  
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          var bounds = new google.maps.LatLngBounds();
          //Create marker for the address returned
          createMakerForSearchResult(map, places, bounds);
          
          map.fitBounds(bounds);
        });
	}

function createMakerForSearchResult(map, places, bounds){
	places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            var marker_srch = new google.maps.Marker({
              map: map,
              draggable: true,
              title: place.name,
              position: place.geometry.location
            });
            
             google.maps.event.addListener(marker_srch, 'dragend', function() {
			 	updateInput(this.position.lat(), this.position.lng());
        	 });

            if (place.geometry.viewport) {
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC88G_-I2GZl8sVDs95qoxcuqBy9_q36nQ&libraries=places"
         async defer></script>
<!-- Note: added by A (25 Nov 2019) -->
<script>
	// services icons
	$(".image-checkbox").each(function () {
	  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
	    $(this).addClass('image-checkbox-checked');
	  }
	  else {
	    $(this).removeClass('image-checkbox-checked');
	  }
	});
	
	// sync the state to the input
	$(".image-checkbox").on("click", function (e) {
	  $(this).toggleClass('image-checkbox-checked');
	  var $checkbox = $(this).find('input[type="checkbox"]');
	  $checkbox.prop("checked",!$checkbox.prop("checked"))
	
	  e.preventDefault();
	});
</script>
</body>
</html>