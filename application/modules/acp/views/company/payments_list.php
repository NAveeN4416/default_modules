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
<div id="content-main">
  <div class="row">
    <?PHP
		$this->load->view('acp_includes/response_messages');
	?>
    
	<div class="col-md-12">
      <h3><?=getSystemString('Transactions')?></h3>
       <nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url('acp')?>"><?=getSystemString(90)?></a></li>
		    <li class="breadcrumb-item"><a href="<?=base_url('acp_company/companies_list')?>"><?=getSystemString(299)?></a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?=getSystemString('Transactions')?></li>
		  </ol>
		</nav>
    </div>
    
    <div class="col-md-12">
	   
    </div> 
   


<div class="col-md-12">
  
	
  <div class="panel white" style="padding-bottom: 50px;">
	  
	<h4 class="page-title"><?=getSystemString('Transactions')?></h4>
	<br /> 
    <table class="table table-hover" id="companies_table" style="margin-bottom: 5em">
      <thead>
        <tr>
          <th>
            <?=getSystemString('expire_date')?>
          </th>
          <th>
            <?=getSystemString(17)?>
          </th>
          <th>
            (+) <?=getSystemString('total_amount')?> SAR
          </th>
          <th>
            (-) <?=getSystemString('total_Paid_amount')?> SAR
          </th>
          <th>
            (-) <?=getSystemString('charges')?> SAR
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
        url: "<?=base_url('acp_company/Payments/'.$company_id)?>",
        type: "POST",
        cache: false,
        data: function(d){
       //d.title = location.pathname.split('/').pop()
			 d.c_company = "<?=$company_id?>";
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
</body>
</html>
