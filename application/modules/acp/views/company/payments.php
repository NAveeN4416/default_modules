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
  .breadcrumb{
	    padding: 20px 15px;
	    margin-bottom: 20px;
	    list-style: none;
	    background-color: #f5f5f5;
	    border-radius: 4px;
	    line-height: 0.1;
  }
  body[dir="rtl"] .breadcrumb > li{
	  float: right;
  }
  body[dir="ltr"] .breadcrumb > li{
	  float: left;
  }
</style>
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
  .breadcrumb{
	    padding: 20px 15px;
	    margin-bottom: 20px;
	    list-style: none;
	    background-color: #f5f5f5;
	    border-radius: 4px;
	    line-height: 0.1;
  }
  body[dir="rtl"] .breadcrumb > li{
	  float: right;
	  direction: rtl;
  }
  body[dir="ltr"] .breadcrumb > li{
	  float: left;
	  direction: ltr;
  }
</style>
<div id="content-main">
   <div class="row">
	    <?PHP
			$this->load->view('acp_includes/response_messages');
		?>
	    <div class="col-md-12">
	    	<nav aria-label="breadcrumb">
		      <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="<?=base_url('acp/dashboard')?>"><?=getSystemString(90)?></a></li>
			    <li class="breadcrumb-item"><a href="<?=base_url('acp_company/companies_list')?>"><?=getSystemString(299)?></a></li>
			    <li class="breadcrumb-item"><a href="<?=base_url('acp_company/Payments_List/'.$company_details['Company_ID'])?>"> <?=getSystemString('Transactions')?> </a></li>
			    <li class="breadcrumb-item active" aria-current="page"> <?=$campaign_details['Campaign_Name']?></li>
			  </ol>
			</nav>
		    <!-- <?=$campaign_details['Campaign_Name']?> - Trip Payments -->
	      	<?php if($pending_amount!='0'){ ?>
				<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#exampleModalCenter" onclick="Set_CampaignId('<?=$campaign_id?>')"><?=getSystemString('payment_record')?></button>
			<?php } ?>
			<!-- <a class="btn btn-success btn-sm pull-right" href="<?php echo base_url('acp_company/Payments_History/'.$company_details['Company_ID'].'/'.$campaign_id);?>" target="_blank" style="color: white;margin-right:10px;margin-bottom: 15px;"><?=getSystemString('payment_history')?></a> -->
	    </div>

		<div class="col-md-12">
		  <div class="panel white" style="padding-bottom: 50px;">
			<br/>
			<?php if(!$data){ ?>
					<p class="text-center">No Payments found !</p>
			<?php }else{ ?>	

			<?php foreach ($data as $campaign_id => $details) { ?>
				<a title="View Trip Details" href="<?php echo base_url('acp_company/campaign_details/'.$campaign_id); ?>" target="blank"><p style="font-size:15px;">
					<u><?=$details['campaign_details']['Campaign_Name']?></u>
				</p></a>
				<table class="table table-hover" style="margin-bottom: 5em">
					<thead>
						<th> ID</th>
						<th> <?=getSystemString('payment_type')?></th>
						<th> <?=getSystemString('issued_on')?></th>
						<th> <?=getSystemString('updated_at')?></th>
						<th> <?=getSystemString('amount_paid')?></th>
					</thead>
					<tbody>
					<?php foreach($details['campaign_details']['order_details'] as $key => $order) { ?>
						<tr>
							<td><?=$order['Reservation_ID']?></td>
							<td><?=$order['Reservation_ID']?> <a style="color: white" class="btn btn-sm btn-primary" href="<?=base_url()?>reservations/reservations_details/<?=$order['Reservation_ID']?>" target="_blank"><li class="fa fa-eye"> <?=getSystemString('324')?> </li></a></td>
							<td><?=$order['Payment_Type']?></td>
							<td><?=date('d M, Y H:i:s',strtotime($order['Reserved_At']))?></td>
							<td><?=date('d M, Y H:i:s',strtotime($order['Last_UpdatedAt']))?></td>
							<td>+ <?=$order['Amount_Paid']?></td>
						</tr>
					<?php } ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td style="font-weight: bold"><?=getSystemString('Transactions')?></td>
							<td style="font-size: 15px"> <?=$details['campaign_details']['total_credit_amount']?> SAR</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td style="font-weight: bold"><?=getSystemString('Notification Charges')?></td>
							<td style="color: red"> - <?=$details['campaign_details']['debits']['Notification']?> </td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td style="font-weight: bold"><?=getSystemString('Feature Trip Charges')?></td>
							<td style="color: red"> - <?=$details['campaign_details']['debits']['Featured_Trip']?> </td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td style="font-weight: bold"><?=getSystemString('Total')?></td>
							<td style="font-size: 18px;font-weight: bold"><?=number_format($details['campaign_details']['total_trip_amount'],2)?> SAR</td>
						</tr>
						<?php if($details['campaign_details']['already_credited']!='0'){ ?>
						    <?php foreach ($details['campaign_details']['older_transactions'] as $key => $transaction) {  ?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td style="font-weight: bold"><?=getSystemString('Transactions')?> <?=$key+1?> (<?=getSystemString('amount_paid')?>)</td>
									<td style="font-size: 18px;font-weight: bold;color: red"> - <?=number_format($transaction->Amount_Paid,2)?> SAR</td>
								</tr>
							<?php } ?>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td style="font-weight: bold">Pending</td>
								<td style="font-size: 18px;font-weight: bold"><?=number_format($details['campaign_details']['total_trip_amount']-$details['campaign_details']['already_credited'],2)?> SAR</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
				<!-- <hr>
				<div>
					<h3>OverAll Payments</h3>
					<table class="table table-hover" style="margin-bottom: 5em">
					<thead>
						<th> (+) Total Credits</th>
						<th> (-) Total Charged</th>
						<th> (-) Already Paid</th>
						<th> Sub Total (SAR)</th>
						<th> Grand Total (SAR)</th>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td style="font-size: 15px;color: green"><?=$totals['amount']?></td>
							<td style="font-size: 15px;color: red"><?=$totals['charges']?></td>
							<td style="font-size: 15px;color: red"><?=$totals['already_paid']?></td>
							<td style="font-size: 15px"><?=$totals['amount']-$totals['notif_charges']-$totals['featured_charges']-$totals['already_paid']?></td>
							<td style="font-size: 25px;font-weight: bold"><?=number_format($totals['amount']-$totals['charges']-$totals['already_paid'],2)?></td>
						</tr>
					</tbody>
					</table>
				</div> -->
			<?php } ?>

		  </div>

		  <div class="panel white" style="padding-bottom: 50px;">
			<h4 class="page-title"><?=getSystemString('Transactions')?></h4>
			<br /> 
		    <table class="table table-hover" id="companies_table" style="margin-bottom: 5em">
		      <thead>
		        <tr>
		          <th>
		            <?=getSystemString(177)?>
		          </th>      
		          <th>
		            <?=getSystemString('Transaction_ID')?>
		          </th>
		          <th>
		           	<?=getSystemString('reference_id')?>
		          </th>  
		          <th>
		            <?=getSystemString('amount_paid').' ('.getSystemString(480).')'?>
		          </th>
		          <th>
		            <?=getSystemString('Notes')?>
		          </th>
		          <th>
		            <?=getSystemString('attach_receipt')?>
		          </th>
		        </tr>
		      </thead>
		      <tbody>
		      </tbody>
		    </table>			          
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
	        <h5 class="modal-title text-center" style="font-size: 20px" id="exampleModalLongTitle">Please Enter Transaction Details</h5>
	      </div>
	      <div class="modal-body">
	        <form action="#" onsubmit="return Submit_Data()" id="Transaction_details">
	          <input type="hidden" name="Campaign_ID" value="0" id="send_campaignid">
	          <input type="hidden" name="Company_ID" value="<?=$company_details['Company_ID']?>" id="send_campaignid">
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Reference Id</label>
	            <input type="text" class="form-control" name="Reference_ID" id="reference_number" required>
	          </div>
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Amount Paid</label>
	            <input type="number" class="form-control" name="Amount_Paid" id="amountpaid" required>
	          </div>
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Attach File</label>
	            <input type="file" class="form-control" name="file">
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">Comments</label>
	            <textarea class="form-control" id="message-text" rows="5" name="Comments"></textarea>
	          </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary" id="savebtn">Save changes</button>
		      </div>
	        </form>
	        <div id="success_message" style="color: green;display: none">Transaction Successfully :)</div>
	      </div>
	    </div>
	  </div>
	</div>

</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>

<script>
  $(function(){
    
    $('.select2').select2({
		    'theme' : 'bootstrap'
	    });
    
    // datatable initialization
    var dTable = $('#companies_table').DataTable({
      columnDefs: [
        {
          orderable: false, targets: -1 }
      ],
      select: true,
      order: [[ 0, 'desc' ]],
	    aoColumnDefs: [{
	       bSortable: false,
	       aTargets: [ 6 ] 
	    }],
      pageLength: 15,
      serverSide: true,
      ajax: {
        url: "<?=base_url('acp_company/Financial_Payments/'.$company_id.'/'.$campaign_id)?>",
        type: "POST",
        cache: false,
        data: function(d){
       //d.title = location.pathname.split('/').pop()
			d.c_company = -1;
       		d.c_type    = -1 ;
       		d.c_status  = 1 ;
        }
      },
      processing: true,
      filter: true,
      responsive: true,
      autoWidth:false,
      dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      lengthMenu: [
        [ 15, 25, 50, 100, 1000, -1 ],
        [ '15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all' ]
      ],
      language: {
        url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
        sLengthMenu: "_MENU_"
      },
      drawCallback: function(settings){
        $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
         $("#filter_companies").find(".disable-btn").remove();
        $(document).find('[data-toggle="hurkanSwitch"]').each(function(){
          $(this).hurkanSwitch({
            'on':function(r){
              alert(r);
            }
            ,
            'off':function(r){
              alert(r);
            }
            ,
            'onTitle':'<i class="fa fa-check"></i>',
            'offTitle':'<i class="fa fa-times"></i>',
            'width':60
          });
        });
      }
    });
    
     // filter companies
     $("#filter_companies").on("submit", function(){
	     $('#companies_table').DataTable().draw();
	     return false;
     });
     
     $(document).on('click',"#companies_table tr td .hurkanSwitch", function(){
      	ChangeStatusFor($(this), 'company');
    });
                                               
});
</script>

<script type="text/javascript">

function Set_CampaignId(campaign_id)
{
	$("#send_campaignid").val(campaign_id) ;
}


function Submit_Data()
{
    var data = new FormData($('#Transaction_details')[0]);   

    $("#savebtn").attr('disabled',true);
    $('.modal').css('cursor','wait');

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
        	$('.modal').css('cursor','pointer');

        	if(result!=0)
        	{
        		$("#success_message").css('display','block');

        		setTimeout(function(){ location.reload(); }, 2000);
        	}

        	return false ;
        }
    });

    return false ;
}

</script>

</body>
</html>
