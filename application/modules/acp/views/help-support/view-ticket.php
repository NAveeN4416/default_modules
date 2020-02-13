	<style>
		.panel.white{
			min-height: 120px;
		}
		.ft-b{
			font-weight: normal;
		    font-weight: normal;
		    font-size: 14px;
		    margin-bottom: 10px;	
		}
		.sp-message{
			width: 100%;
			display: inline-flex;
			background-color:#f5f5f5;
			padding: 10px;
			border: 1px solid #eee;
			margin-bottom: 10px;
		}
		.sp-message div:nth-child(1) img{
			width: 40px;
			margin-right: 10px;
			    margin-left: 10px;
			height: 40px;
			border-radius: 50% !important;
		}
		.sp-message div:nth-child(2) img{
			max-width: 100%;
		}
		.sp-message label{
			margin-bottom: 3px;
		}
		.sp-message span{
			display: block;
			text-align: left;
		}
	</style>
	<div id="content-main">
			<div class="row">

				<div class="col-md-10">
					<h3 class="text-left"><?=getSystemString(214)?></h3>
					<div class="panel white">
						<?PHP
							$userTimezone = new DateTimeZone('Asia/Riyadh');
							$gmtTimezone = new DateTimeZone('GMT');
							$dt = new DateTime($ticket[0]->Date, $gmtTimezone);
						?>
						
						<div class="col-xs-12">
							<h3 class="text-left"><?=getSystemString(212)?> <?=$ticket[0]->Ticket_No?></h3>

						</div>							
						<div class="col-xs-12 no-padding">
							<div class="col-xs-12 col-sm-4 fl-right col-md-2">
								<label for="title_en"><?=getSystemString(38)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
								<label for="title_en" class="text-muted ft-b"><?=$ticket[0]->Title?></label>
							</div>
						</div>
						
						<div class="col-xs-12 no-padding">
							<div class="col-xs-12 col-sm-4 fl-right col-md-2">
								<label for="title_en"><?=getSystemString(58)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
								<label for="title_en" class="text-muted ft-b"><?=$ticket[0]->Category?></label>
							</div>
						</div>
						
						<div class="col-xs-12 no-padding">
							<div class="col-xs-12 col-sm-4 col-md-2 fl-right">
								<label for="title_en"><?=getSystemString(177)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
								<label for="title_en" class="text-muted ft-b"><?=$dt->format('d-m-Y h:i:sa')?></label>
							</div>
						</div>
						
						<div class="col-xs-12 no-padding">
							<div class="col-xs-12 col-sm-4 col-md-2 fl-right">
								<label for="title_en"><?=getSystemString(33)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
								<?PHP
										$clr = 'label-warning';
										if($ticket[0]->Status == 'In Process') { $clr = 'label-info'; }
										if($ticket[0]->Status == 'Completed') { $clr = 'label-success'; }
									?>
									<label for="title_en" class="label <?=$clr?> ft-b"><?=$ticket[0]->Status?></label>
							</div>
						</div>
							
					</div>
					
					<h3 class="text-left"><?=getSystemString(215)?></h3>
					<div class="panel white" id="ticket">
						
						<div class="col-xs-12 no-padding message" style="margin-top: 20px;">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
									<span class="sp-message">
										<div>
											<img src="<?=base_url('style/acp/img/user-avatar.jpeg');?>" alt="user">
										</div>
										<div>
											<?PHP
												$dt = new DateTime($ticket[0]->Date);
											?>
											<label for="title_en" class="text-muted ft-b">
												<?=$ticket[0]->Message?>
												
												<?PHP
													if(strlen($ticket[0]->File) > 1){
												?>
												<br>
												<img src="<?=base_url($GLOBALS['img_ck_dir'].$ticket[0]->File)?>" style="max-width: 100%">
												<?PHP
													}
												?>
											</label>
											<span class="text-muted text-left"><small><?=$dt->format('d-m-Y h:i:sa')?></small></span>
										</div>										
									</span>
									
									<?PHP
										foreach($ticket as $row){
											if(strlen($row->hsMessage) > 0){
											?>
											
								    <span class="sp-message">
								    <?PHP
									    $avatar = base_url('style/acp/img/admin-avatar.png');
									    if($row->HS_Admin_Id == 0){
										    $avatar = base_url('style/acp/img/user-avatar.jpeg');
									    }
								    ?>
										<div>
											<img src="<?=$avatar?>" alt="user">
										</div>
										<div>
											<?PHP
												$userTimezone = new DateTimeZone('Asia/Riyadh');
												$gmtTimezone = new DateTimeZone('GMT');
												$dt1 = new DateTime($row->messageDate, $gmtTimezone);
											?>
											<label for="title_en" class="text-muted ft-b"><?=$row->hsMessage?></label>
											<span class="text-muted"><small><?=$dt1->format('d-m-Y h:i:sa')?></small></span>
										</div>										
									</span>
											
											<?PHP
										}
									}
									?>
									
								</div>
							</div>
						
						<div class="col-xs-12 no-padding" style="margin-top: 2em; margin-bottom: 2em">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title_en"></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-8">
										<textarea id="reply" class="form-control" rows="4" placeholder="<?=getSystemString(276)?>" style="width: 500px;display: inline-block"
										data-ticketid="<?=$ticket[0]->Ticket_No?>"
										data-count="<?=count($ticket)?>"
										data-userid="<?=$this->session->userdata($this->acp_session->userid())?>"></textarea>
										<a href="#" class="btn btn-primary reply" style="margin-left: 10px;margin-bottom: 35px;color:#fff"><?=getSystemString(277)?></a>
									</div>
								</div>
							</div>
						
					</div>
					
				</div>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	sessionStorage.ActiveMenu = null;
	$(function(){
		$('.footer-ul li:eq(3)').addClass('selected');
		$('.footer-ul li:eq(3) a').addClass('active');
		
		
		var userImg = '<?=base_url('style/acp/img/user-avatar.jpeg')?>';
		$("#ticket .reply").on("click", function(){
			var data = { 
				ticket : $('#ticket #reply').attr('data-ticketid'),
				userid : $('#ticket #reply').attr('data-userid'),
				message : $('#ticket #reply').val()
			};
			if(data.message.length == 0){
				return false;
			}
			$.ajax({
		 		url: "http://dnet.sa/hcm/help/userTicketReply",
		 		type:"POST",
                dataType:"JSON",
                data: data,
		 		success: function(result){
			 		if(result){
				 		$('#reply').val('');
				 		$('<span class="sp-message">'+
										'<div>'+
										'	<img src="'+userImg+'" alt="user">'+
										'</div>'+
										'<div>'+
										'	<label for="title_en" class="text-muted ft-b">'+data.message+'</label>'+
										'	<span class="text-muted"><small>just now</small></span>'+
										'</div>	'+		
									'</span>').insertAfter('#ticket .sp-message:last');
						$('#ticket #reply').attr('data-count', (parseInt($('#ticket #reply').attr('data-count')) + 1));
					}
			 	},
		 		error:function(err, status, xhr){
			 		console.log(err);
			 		console.log(status);
			 		console.log(xhr);
		 		}
	 		});
	 		return false;
		});
		
	setTimeout(function() {
    	getNewMessage();
  	}, 5000);
		
	});
	
	function getNewMessage(){
	  var data = { ticketid: $('#ticket #reply').attr('data-ticketid'), count: $('#ticket #reply').attr('data-count') };
        $.ajax ({
                 type: "POST",
                 url: "https://dnet.sa/hcm/help/get_new_message",
                 data: data,
				 dataType:"JSON",
                 success: function(result) {
	                 if(result.length > 0){
		                 for(var i = 0; i < result.length; i++){
			                 var avatar = '<?=base_url('style/acp/img/user-avatar.jpeg')?>';
			                 if(result[i].UserId == 0){
				                 avatar = '<?=base_url('style/acp/img/admin-avatar.png')?>';
			                 }
	                        $('<span class="sp-message">'+
											'<div>'+
											'	<img src="'+avatar+'" alt="user">'+
											'</div>'+
											'<div>'+
											'	<label for="title_en" class="text-muted ft-b">'+result[i].Message+'</label>'+
											'	<span class="text-muted"><small>'+result[i].Date+'</small></span>'+
											'</div>	'+		
										'</span>').insertAfter('#ticket .sp-message:last');
						}
						$('#ticket #reply').attr('data-count', (parseInt(data.count) + parseInt(result.length)));
					}
                 },
                 complete : function(){
                     setTimeout(function(){
                         getNewMessage();       
                     },9000);
                 }
         });
    }
</script>
</body>
</html>