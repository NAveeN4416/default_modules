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
      <h3>
	      <?=getSystemString(300)?>
		  <a href="<?=base_url($__controller.'/add_company')?>" class="btn btn-primary pull-right" style="color:#FFF">
			  <?=getSystemString(301)?>
		  </a>
      </h3>
    </div>
    
    <div class="col-md-12">
	    <?PHP
			$this->load->view('company/snippets/filter_companies');
		?>
    </div>
    

<div class="col-md-12">
	
  <div class="panel white" style="padding-bottom: 50px;">
	  
	<h4 class="page-title"><?=getSystemString(302)?></h4>
	<br /> 
    <table class="table table-hover" id="companies_table" style="margin-bottom: 5em">
      <thead>
        <tr>
          <th class="hide">
            <?=getSystemString(149)?>
          </th>
          <th>
            <?=getSystemString(177)?>
          </th>
          <th>
            <?=getSystemString(99)?>
          </th>
          <th>
            <?=getSystemString(311)?>
          </th>
          <th>
            <?=getSystemString(1)?>
          </th>
          <th>
            <?=getSystemString(137)?>
          </th>
          <th>
            <?=getSystemString(308)?>
          </th>
           <th>
            <?=getSystemString(33)?>
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
	       aTargets: [ 8 ] 
	    }],
      pageLength: 15,
      serverSide: true,
      ajax: {
        url: "<?=base_url('acp_company/getCompaniesList')?>",
        type: "POST",
        cache: false,
        data: function(d){
//           d.title = location.pathname.split('/').pop()
			 d.company_phone = $("#filter_phone").val();
			 d.country = $("#filter_country").val();
			 d.company_name = $("#filter_name").val();
			 d.email = $("#filter_email").val();
			 d.company_mobile = $("#filter_mobile").val();
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
