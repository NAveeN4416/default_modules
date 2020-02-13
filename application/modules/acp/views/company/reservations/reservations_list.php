<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
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
  #campaigns_table td:first-child{
	  display: none;
  }
  #campaigns_table th:last-child{
	 width: 200px; 
  }
</style>
<div id="content-main">
  <div class="row">
    <?PHP
		$this->load->view('acp_includes/response_messages');
	?>
    <div class="col-md-12">
      <h3><?=getSystemString(62)?></h3>
    </div>
    
    <div class="col-md-12">
	    <?PHP
			$this->load->view('acp/company/reservations/snippets/filter_reservations');
		?>
    </div>
    

<div class="col-md-12">
	
  <div class="panel white" style="padding-bottom: 50px;">
	  
	<h4 class="page-title"><?=getSystemString(310)?></h4>
	<br /> 
    <table class="table table-hover" id="reservations_table" style="margin-bottom: 5em">
      <thead>
        <tr>
          <th>
            <?=getSystemString(81)?>
          </th>
          <th>
            <?=getSystemString(177)?>
          </th>
          <?PHP
		    if(!isset($cp_login_id))
		    {
	       ?>
	          <th>
	            <?=getSystemString(311)?>
	          </th>
          <?PHP
	        }
          ?>
          <th>
            <?=getSystemString(17)?>
          </th>
          <th>
            <?=getSystemString(158)?>
          </th>
          <th>
            <?=getSystemString(202)?>
          </th>
          <th>
            <?=getSystemString(138).' - '.getSystemString(139)?>
          </th>
          <th>
            <?=getSystemString(432)?>
          </th>
          <th>
            <?=getSystemString(42)?>
          </th>
          
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>			          
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
        url: "<?=base_url('acp/reservations/getReservationsList')?>",
        type: "POST",
        cache: false,
        data: function(d)
        {
			 // d.title = location.pathname.split('/').pop()
			 d.c_campaign = $("#campaign_id").val();
			 d.c_company = $("#filter_company").val();
			 d.c_name = $("#filter_name").val();
			 d.c_type = $("#filter_type").val();
			 d.from_date = $("#filter_from").val();
			 d.to_date = $("#filter_to").val();
			 d.cp_lg = $("#cp_lg").val();
        }
      },
      drawCallback: function(settings){
        $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
         $("#filter_products").find(".disable-btn").remove();
        $(document).find('[data-toggle="hurkanSwitch"]').each(function(){
          $(this).hurkanSwitch({
            'on':function(r){
              alert(r);
            },
            'off':function(r){
              alert(r);
            },
            'onTitle':'<i class="fa fa-check"></i>',
            'offTitle':'<i class="fa fa-times"></i>',
            'width':60
          });
        });
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
        $(document).find('[data-toggle="hurkanSwitch"]').each(function(){
          $(this).hurkanSwitch({
            'on':function(r){
              alert(r);
            },
            'off':function(r){
              alert(r);
            },
            'onTitle':'<i class="fa fa-check"></i>',
            'offTitle':'<i class="fa fa-times"></i>',
            'width':60
          });
        });
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
    
    
    //get duration
    $('.input-from').datepicker().bind("change", function () {
	    var minValue = $(this).val();
	    minValue = $.datepicker.parseDate(_dateFormat, minValue);
	    $('.input-to').datepicker("option", "minDate", minValue);
	    calculate();
	});
	$('.input-to').datepicker().bind("change", function () {
	    var maxValue = $(this).val();
	    maxValue = $.datepicker.parseDate(_dateFormat, maxValue);
	    $('.input-from').datepicker("option", "maxDate", maxValue);
	    calculate();
	});

	function calculate() {
	    var d1 = $('.input-from').datepicker('getDate');
	    var d2 = $('.input-to').datepicker('getDate');
	    var diff = 1;
	    if (d1 && d2) {
	        diff = diff + Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
	    }
	    //$('.dt-duration').val(diff);
	    //$('#dt-duration').text(diff);
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
                                               
});
</script>
</body>
</html>
