	<style>
		.panel.white{
			min-height: 220px;
		}
		table tr th, table td{
			text-align: left !important;
			padding-left: 20px !important;
		}
	</style>
	<div id="content-main">
			<h1><?=getSystemString(395)?></h1>
			
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
<div class="col-md-10">
						<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
								<table class="table table-hover display" id="sms" width="100%">
									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
											<th><?=getSystemString(396)?></th>
											<th><?=getSystemString(390)?></th>
											<th><?=getSystemString(245)?></th>
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
<script>
	menu_track_manual(10, 0);
	$(function(){
		var dTable = $('#sms').DataTable({
	        processing: true,
	        filter:false,
	        responsive: true,
	        autoWidth:false,
	        lengthMenu: [ [15, 100, 500, 1000, -1], [15, 100, 500, 1000, "All"] ],
			pageLength: 15,
	        serverSide: true,
	        ajax: {
	            url: "<?=base_url('datatable/getSMSLogs')?>",
	            type: "POST"
	        },
			language: {
	           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
			},
			drawCallback:function(){
				$("#applications_filter input").addClass('form-control').css({
					    "width": "180px",
						"display": "inline-block"
				});
			}
		});
	});
</script>
</body>
</html>