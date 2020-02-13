
	<div id="content-main">
		<?PHP
			$section = "SectionName_".$__lang;
			$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
		?>
		
<!-- 		<h3><?=getSystemString(15)?></h3> -->
			<div class="row">
				<div class="col-md-10">
					<h1>
						<?=$company[0]->$section?> 
			<!-- Note: Hiden by A -->			
<!--
						<div class="dropdown d-inline-block float-left-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url($__controller."/editSection/".$company[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
						    </ul>
						</div>
-->
			
					</h1>
				</div>
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-10">
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        			 <form action="<?=base_url($__controller.'/aboutCompanyDetails');?>" class="form-horizontal" method="post" enctype="multipart/form-data"> 
		          <div class="panel white" style="padding-bottom: 50px;">
					    <div class="tab-content">
				          <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
					          					         
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1" cols="40" >
											<?=$company[0]->Content_en?>
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
										<?=$company[0]->Content_ar?>
										</textarea>
										<br>
										
									</div>
								</div>
							          
                          </div>
                          
                          		<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(407)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" id="showreel" class="form-control" value="<?=$company[0]->Video_Link?>" placeholder="http://youtube.com/fjdaj343dfja"> <i class="fa fa-spinner fa-spin hide"></i>
										<input type="hidden" name="showreel" id="embed_showreel" value="<?=$company[0]->Video_Link?>" >
										<br>
										<div class="<?PHP if(strlen($company[0]->Video_Link) == 0){ echo 'hide'; }  ?>" id="video_frame">
											<iframe width="560" height="315" src="<?=$company[0]->Video_Link?>" frameborder="0" allowfullscreen></iframe>
										</div>
										
									</div>
									<!-- Note: used to hide/show youtube video -->
									<input type="checkbox" name="show" value="1" <?php if($company[0]->Status == 1) { echo 'checked'; } else { echo ''; } ?>> <?=getSystemString('showYoutube')?>
									<!-- Ends -->
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
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
		$("#showreel").on("paste change blur focusout", function(){
			var input = $(this);
			$(".fa-spin").removeClass('hide');
			$("input[type='submit']").attr("disabled", "disabled");
			setTimeout(function () { 
				var video_id = getYoutubeId($(input).val());
				if(video_id){
					var embed_url = "//www.youtube.com/embed/" + video_id;
					$("#embed_showreel").val(embed_url);
					$('#video_frame iframe').attr("src", embed_url);
					$("#video_frame").removeClass('hide');
				}
			}, 100);
			$(".fa-spin").addClass('hide');
			$("input[type='submit']").removeAttr("disabled");
		});
	});
</script>
</body>
</html>