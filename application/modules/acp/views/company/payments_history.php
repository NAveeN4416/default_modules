<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
  .panel.white{
    min-height: 150px ;
  }
  .dropzone .dz-message{
    margin: 0px;
    font-size: 13px;
  }
  .dropzone{
    min-height: 0px;
  }
  .select2{
    width: 100% !important;
  }
  .dataTables_wrapper .row:first-child{
	  top: -55px;
  }
  body[dir="rtl"] .pl-0{
	  padding-right: 0px;
  }
  body[dir="ltr"] .pl-0{
	  padding-left: 0px;
  }
  table td:first-child{
	  display: none;
  }
  table th:last-child{
	 width: 200px; 
  }
</style>
<div id="content-main">
   <div class="row">
	    <?PHP
			$this->load->view('acp_includes/response_messages');
		?>
	    <div class="col-md-12">
	      <h2>
		      <?=getSystemString('payment_history')?>
	      </h2>
	    </div>

		<div class="col-md-12">
		  <div class="panel white" style="padding-bottom: 50px;">
			<h3 class="page-title"><?=$company['Company_Name']?> - <?=$campaign_details['Campaign_Name']?></h3>
			<br/>
			
			<?php if(!$transactions){ ?>
					<p class="text-center"><?=getSystemString('payment_history_note')?></p>
			<?php }else{ ?>	
					<?php foreach($transactions as $key => $transaction) { ?>
						<h4><?=getSystemString('Transactions')?> #<?=$key+1?></h4>
					<div>
						<p>
							<span><?=getSystemString('reference_id')?> : </span>
							<span><?=$transaction->Reference_ID?></span>
						</p>
						<p>
							<span><?=getSystemString('amount_paid')?> : </span>
							<span style="font-size: 15px;font-weight: 450"><?=$transaction->Amount_Paid?> SAR</span>
						</p>
						<p>
							<span><?=getSystemString('Notes')?> : </span>
							<span><?=$transaction->Comments?></span>
						</p>
						<?php if($transaction->Transaction_File){ ?>
						<p>
							<span><?=getSystemString('attach_receipt')?> : </span>
							<span><a target="_blank" href="<?php echo base_url($GLOBALS['img_companies_tr_dir'].$transaction->Transaction_File) ?>">View</a></span>
						</p>
						<?php } ?>
						<p>
							<span><?=getSystemString('issued_on')?> : </span>
							<span><?=date('d M, Y h:i:s a',strtotime($transaction->Created_At))?></span>
						</p>
					</div>	
						<hr>
					<?php } ?>
			<?php } ?>

		  </div>
		</div>

	</div>

	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">X</span>
	        </button>
	        <h5 class="modal-title text-center" style="font-size: 20px" id="exampleModalLongTitle"><?=getSystemString('new_transaction_details')?></h5>
	      </div>
	      <div class="modal-body">
	        <form action="#" onsubmit="return Submit_Data()" id="Transaction_details">
	          <input type="hidden" name="Campaign_ID" value="0" id="send_campaignid">
	          <input type="hidden" name="Company_ID" value="<?=$company_id?>" id="send_campaignid">
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label"><?=getSystemString('reference_id')?></label>
	            <input type="text" class="form-control" name="Reference_ID" id="reference_number" required>
	          </div>
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label"><?=getSystemString('amount_paid')?></label>
	            <input type="number" class="form-control" name="Amount_Paid" id="amountpaid" required>
	          </div>
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label"><?=getSystemString('attach_receipt')?></label>
	            <input type="file" class="form-control" name="file">
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label"><?=getSystemString('Notes')?></label>
	            <textarea class="form-control" id="message-text" rows="5" name="Comments"></textarea>
	          </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">X</button>
		        <button type="submit" class="btn btn-primary"><?=getSystemString(16)?></button>
		      </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>


<script type="text/javascript">

function Set_CampaignId(campaign_id)
{
	$("#send_campaignid").val(campaign_id) ;
}


function Submit_Data()
{
    var data = new FormData($('#Transaction_details')[0]);   

    $.ajax({                
        url: "<?php echo base_url('acp_company/Record_Payments');?>",
        type: "POST",
        data: data,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
        error:function(request,response)
        {
            console.log(request);
        },                  
        success: function(result)
        {

        	alert(result);

        	return false ;

            if (result) 
            {
   				

                location.reload();
            } 
        }
    });

    return false ;
}

</script>

</body>
</html>
