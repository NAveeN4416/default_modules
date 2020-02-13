<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
		.message
		{
			height: 400px;
  			overflow: scroll;
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
	<style>
	.crop-image{
		width: 250px;
		height: 150px;
	}
	</style>
	<div id="content-main">
		<h1><?=getSystemString(214)?> #<?=$enquiries[0]->id?></h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url('acp/dashboard')?>"><?=getSystemString(90)?></a></li>
		    <li class="breadcrumb-item"><a href="<?=base_url('acp/enquiries')?>"><?=getSystemString('tickets')?></a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?=getSystemString(214)?></li>
		  </ol>
		</nav>
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
			<div class="col-md-12">
			    <form action="#" class="form-horizontal">
	          		<div class="panel white">
	          			<fieldset>
    					<legend>Company Details</legend>
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en">ID</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<span><?=$enquiries[0]->Company_Id?></span>
								</div>
							</div>
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(311)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<span>
										<?=$enquiries[0]->Company_Name?>
										<a title="View Company Trips" href="<?=base_url().'acp_company/campaigns_list/'.$enquiries[0]->Company_Id?>" style="color: white" target="blank" class="btn btn-sm btn-primary">View Trips</a>
										<a title="View Company Transactions" href="<?=base_url().'acp_company/Payments_List/'.$enquiries[0]->Company_Id?>" style="color: white" target="blank" class="btn btn-sm btn-primary">View Transactions</a>
									</span>
								</div>
							</div>
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(1)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<span><?=$enquiries[0]->Email?></span>
								</div>
							</div>
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(137)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<span><?=$enquiries[0]->Company_Mobile.', '.$enquiries[0]->Company_Phone?></span>
								</div>
							</div>
						</fieldset>
						<br>
						<fieldset>
    					<legend>Query</legend>
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(244)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<span><?=$enquiries[0]->Subject?></span>
								</div>
							</div>
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en">Customer Query</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<span><?=$enquiries[0]->Description?></span>
								</div>
							</div>
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(33)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<span>
										<input id="toggle-event" type="checkbox" data-on="Closed" data-off="In Process" data-toggle="toggle" data-width="100" data-height="20" data-onstyle="success" data-offstyle="warning" <?php echo ($enquiries[0]->Status==1)? 'checked' : '' ; ?> onchange="ToggleStatus(this)" data-enquiry_id="<?=$enquiries[0]->id?>">
									</span>
									<div id="console-event"></div>
								</div>
							</div>
						</fieldset>
			        </div>
		     	</form>
			</div>
			<?php
				$avatar = base_url('style/acp/img/admin-avatar.png');
			?>
			<?php if($enquiries[0]->conversations){ ?>
		     	<div class="col-xs-12 no-padding message" style="margin-top: 20px;">
					<div class="col-xs-12 col-sm-4 col-md-2">
						<label for="title_en"></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
					<?php foreach ($enquiries[0]->conversations as $key => $conv) { if($conv->from_user=='Admin'){ ?>	
						<span class="sp-message">
							<div>
								<img src="<?=$avatar?>" alt="user">
							</div>
							<div>
								<?php
										$dt = new DateTime($conv->created_at);
								?>
								<label for="title_en" class="text-muted ft-b">
									<?=$conv->message?>
								</label>
								<span class="text-muted text-left"><small><?=$dt->format('d-m-Y h:i:sa')?></small></span>
							</div>										
						</span>
						<?php }else{ ?>

					    <span class="sp-message">
					    	<div>
								<img src="<?=base_url('style/acp/img/user-avatar.jpeg');?>" alt="user">
							</div>
							
							<div>
								<?PHP
									$userTimezone = new DateTimeZone('Asia/Riyadh');
									$gmtTimezone = new DateTimeZone('GMT');
									$dt1 = new DateTime($conv->created_at, $gmtTimezone);
								?>
								<label for="title_en" class="text-muted ft-b"><?=$conv->message?></label>
								<span class="text-muted"><small><?=$dt1->format('d-m-Y h:i:sa')?></small></span>
							</div>										
						</span>
						<?php } } ?>
					</div>
				</div>
			<?php } ?>

	     	<div class="col-md-12" id="reply_div">
    			<form action="<?=base_url('acp/tickets/Send_Reply/companies');?>" class="form-horizontal" method="post" id="company_form" data-parsley-validate>
    				<input type="hidden" name="ticket_id" value="<?=$enquiries[0]->id?>">
		            <div class="panel white" style="min-height: 150px !important;">
			            <div class="col-md-10">
				           <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(277)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<textarea class="form-control" 
											name="message"
											placeholder="Your Description"
											required="" 
											data-parsley-trigger="change"
											rows="5"
											data-parsley-required-message="<?=getSystemString(213)?>"
											data-parsley-type-message="<?=getSystemString(183)?>" style="width: 200% !important;"></textarea>		
								</div>
						    </div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="Send"/>
							</div>
						</div>
		          </div>
	          </form>
			</div>
		</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>

<script type="text/javascript">

var status = "<?=$enquiries[0]->Status?>" ;

if(status=='1')
{
	$("#reply_div").hide();
}

function ToggleStatus(obj)
{
	var status = 0 ;

	if($(obj).is(':checked'))
	{
		status = 1 ;
	}

	var enquiry_id = $(obj).data('enquiry_id') ;

	$.ajax({
	 		url: "<?php echo base_url('acp/tickets/ToggleStatus/companies'); ?>",
	 		type:"POST",
	 		data:{'ticket_id':enquiry_id,'status':status},
	 		success: function(result)
	 		{
	 			if(status=='1')
	 			{
	 				alert("Ticket has been closed") ;

	 				$("#reply_div").hide();
	 			}
	 			else
	 			{
	 				alert("Ticket is in Process") ;
	 				$("#reply_div").show();
	 			}
		 	},
		 	error: function(err, status, xhr)
		 	{
		 		console.log(err);
		 		console.log(status);
		 		console.log(xhr);
		 	}
		});
}


</script>

</body>
</html>