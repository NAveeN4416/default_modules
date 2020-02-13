	<style>
		.panel.white{
			min-height: 150px;
		}
		table th{
			width: 200px;
		}
		body[dir="ltr"] table td, body[dir="ltr"] table th{
			text-align: left !important;
		}
		body[dir="rtl"] table td, body[dir="rtl"] table th{
			text-align: right !important;
		}
		.img-thumbs img{
			width: 150px;
		}
		.img-sm-thumbs img{
			width: 50px;
		}
		.filter-no-borders{
			background-color: #FFF;
		}
		.filter-no-borders .panel{
			border: 0px solid transparent;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
	<div id="content-main">
		
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
		</div>
		
	    <?php //print_r($customer);exit;  ?>

		<div class="row">
						
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer"><?=$customer->Fullname?></h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					<table class="table table-hover display" id="cus_table" width="100%">
						<tbody>
								<tr>
									<th><?=getSystemString(1)?></th>
									<td>
										<?=$customer->Email?>
										<?PHP if ($customer->Email_Verified){ ?>
											<label class="label label-success"><?=getSystemString(511)?></label>
										<?PHP } ?>
									</td>
								</tr>
								<tr>
									<th><?=getSystemString(137)?></th>
									<td><?=$customer->Phone?></td>
								</tr>
								<tr>
									<th><?=getSystemString(200)?></th>
									<?php if($customer->Gender){ ?>	
										<td><?=getSystemString($customer->Gender)?></td>
									<?php } ?>
								</tr>
								<tr>
									<th><?=getSystemString(210)?></th>
									<td><?=$customer->DOB?></td>
								</tr>
								<tr>
									<th><?=getSystemString(202)?></th>
									<td><?=$customer->City?></td>
								</tr>
								<tr>
									<th><?=getSystemString(234)?></th>
									<td><?=$customer->Country?></td>
								</tr>
								<tr>
									<th><?=getSystemString(371)?></th>
									<td><?=$customer->Address?></td>
								</tr>
								<tr>
									<th><?=getSystemString(416)?></th>
									<td><?=$customer->Passport_No?></td>
								</tr>
								<tr>
									<th style="padding-top: 10px;color:#3498db"><h4><?=getSystemString(439)?></h4></th>
									<td></td>
								</tr>
								<tr>
									<th><?=getSystemString(433)?></th>
									<td><?=$customer->Type?></td>
								</tr>
								<tr>
									<th><?=getSystemString(435)?></th>
									<td><?=$customer->Card_Number?></td>
								</tr>
								<tr>
									<th><?=getSystemString(436)?></th>
									<td><?=$customer->Expirey_Date?></td>
								</tr>
								<tr>
									<th><?=getSystemString(437)?></th>
									<td><?=$customer->Holder_Name?></td>
								</tr>
								<!-- <tr>
									<th style="padding-top: 10px;color:#3498db"><h4><?=getSystemString(412)?></h4></th>
									<td></td>
								</tr>
								<tr>
									<th><?=getSystemString(440)?></th>
									<td class="img-thumbs">
										<?PHP
											$base_dir = base_url($GLOBALS['img_customers_dir']);
										?>
										<a href="<?=$base_dir.$customer->NIC_Picture?>" target="_blank">
											<img src="<?=$base_dir.$customer->NIC_Picture?>">
										</a>
										<a href="<?=$base_dir.$customer->Passport_Picture?>" target="_blank">
											<img src="<?=$base_dir.$customer->Passport_Picture?>">
										</a>
										<a href="<?=$base_dir.$customer->Health_Certificate?>" target="_blank">
											<img src="<?=$base_dir.$customer->Health_Certificate?>">
										</a>
									</td>
								</tr> -->
							</tbody>
					</table>
											
				</div>			
			</div>
			
			<div class="col-xs-12">
				<ul class="nav nav-tabs">
				    <!-- <li class="active"><a data-toggle="tab" href="#family"><i class="fa fa-user"></i> <?=getSystemString(408)?></a></li> -->
				    <li class="active"><a data-toggle="tab" href="#reservations"><i class="fa fa-paper-plane"></i>
				    <?=getSystemString(310)?></a></li>
				</ul>
				
				<div class="tab-content" style="padding-top: 0px !important">
					<!-- <div class="tab-pane fade in active" id="family">
						<div class="panel white">
							<?PHP
								//$this->load->view('customers/snippets/family_members_list');
							?>
						</div>
					</div> -->
					
					<div class="tab-pane fade in active"  id="reservations">
						<?PHP
							$this->load->view('customers/reservations/reservations_list');
						?>
					</div>
					
				</div>
				
			</div>
						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>

<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
  var _customer_id = '<?=@$customer->Customer_ID?>';
  $(function(){
    
    // datatable initialization
    var dTable = $('#reservations_table').DataTable({
      columnDefs: [
        {
          orderable: false, targets: -1 }
      ],
      select: true,
      order: [[ 0, 'desc' ]],
      pageLength: 15,
      serverSide: true,
      ajax: {
        url: "<?=base_url('reservations/getReservationsList')?>",
        type: "POST",
        cache: false,
        data: function(d)
        {
			 d.customer_id = _customer_id;
			 d.r_no = $("#r_no").val();
			 d.c_campaign = $("#campaign_id").val();
			 d.c_company = $("#filter_company").val();
			 d.c_name = $("#filter_name").val();
			 d.c_type = $("#filter_type").val();
			 d.from_date = $("#filter_from").val();
			 d.to_date = $("#filter_to").val();
			 d.cp_lg = $("#cp_lg").val();
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
         $("#filter_reservations").find(".disable-btn").remove();
      }
    });
    
     // filter campaigns
     $("#filter_reservations").on("submit", function(){
	     $('#reservations_table').DataTable().draw();
	     return false;
     });
     
     var _dateFormat = "dd-mm-yy",
    from = $( ".input-from" ).datepicker({
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat: _dateFormat
          
    }).on( "change", function() {
         to.datepicker( "option", "minDate", getDate( this ) );
         
    }),
    to = $( ".input-to" ).datepicker({
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat: _dateFormat
          
    }).on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });
    
	function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( _dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
	}
                                               
});
</script>
</body>
</html>