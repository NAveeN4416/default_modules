	<style>
		body[dir="ltr"] table th, body[dir="ltr"] table td{
			text-align: left !important;
		}
		body[dir="rtl"] table th, body[dir="rtl"] table td{
			text-align: right !important;
		}
		table th{
			    padding: 9px !important;
		}
	</style>
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
	<div id="content-main">
		<h1><?=getSystemString(257)?></h1>
			<div class="row">				

				<div class="col-md-10">
					<?PHP
						if($this->session->flashdata('success')){
					?>
					<div class="alert alert-success alert-dismissable">
					  <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
					  <?=getSystemString(265)?>
					</div>
					<?PHP
						}
					?>
				
					<?PHP
						if($this->session->flashdata('error')){
					?>
					<div class="alert alert-danger alert-dismissable">
					  <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
					 <?=getSystemString(266)?>
					</div>
					<?PHP
						}
					?>
					
					<ul class="nav nav-tabs hide">
			          <li class="<?PHP if ($__lang == 'en') { echo 'active'; } ?>"><a data-toggle="tab" href="#lang_en">English</a></li>
			          <li class="<?PHP if ($__lang == 'ar') { echo 'active'; } ?>"><a data-toggle="tab" href="#lang_ar">العربي</a></li>
        			</ul>
					
				<form class="form-horizontal" method="post" data-parsley-validate enctype="multipart/form-data" action="<?=base_url($__controller."/submitTicket")?>">	
		          <div class="panel white" style="padding-bottom: 50px;">								          
				          
				         <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title_en"><?=getSystemString(38)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="text" 
										class="form-control" 
										name="title" placeholder="<?=getSystemString(258)?>"
										required
										data-parsley-trigger="change"
										data-parsley-required-message="<?=getSystemString(213)?>">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title_en"><?=getSystemString(259)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="form-control" name="category" required data-parsley-trigger="change" data-parsley-required-message="<?=getSystemString(213)?>">
									<option value=""><?=getSystemString(59)?></option>
									<option value="Marketing and sales"><?=getSystemString(267)?></option>
									<option value="Accounting and finance"><?=getSystemString(268)?></option>
									<option value="Support"><?=getSystemString(269)?></option>
									<option value="Others"><?=getSystemString(270)?></option>
								</select>
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="editor1"><?=getSystemString(260)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<textarea name="message" rows="5" class="form-control" placeholder="<?=getSystemString(260)?>" required data-parsley-trigger="change" data-parsley-required-message="<?=getSystemString(213)?>"></textarea>
							</div>
						</div>			
			              
			            <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="slide_picture"><?=getSystemString(14)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="file" name="help_support_file" id="fileToUpload" class="fileToUpload">
								<img id="previewHolder" class="previewImg-S" alt="" src="" style="width: 200px;border-radius: 2px;margin-top:10px">
							</div>
						</div>
			              
				    </div>
				  
				   
		   			<div class="form-group">
						<div class="col-xs-12 text-center">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(261)?>" name="submit" />
						</div>
					</div>
				   
		          </form>
				</div>
				
				<div class="col-md-10">
					<h3><?=getSystemString(211)?></h3>
					<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
							<table class="table table-hover display" id="applications" width="100%">
								<thead>
									<tr>
										<th><?=getSystemString(212)?></th>
										<th width="300px"><?=getSystemString(38)?></th>
										<th><?=getSystemString(49)?></th>
										<th><?=getSystemString(33)?></th>
										<th><?=getSystemString(177)?></th>
										<th><?=getSystemString(42)?></th>
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
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script>
	$(function(){
		$('.footer-ul li:eq(3)').addClass('selected');
		$('.footer-ul li:eq(3) a').addClass('active');
		sessionStorage.ActiveMenu = null;
		
		var table = $("#applications").DataTable({
			"searching": false,
			"ordering": false
		});
		
		//get user tickets
		get_tickets(table);
		
		/*
setInterval( function () {
			table.ajax.reload();
		}, 30000 );
*/
		
		$("form").on("submit", function(){
			var valid = $(this).parsley().validate();
			if(!valid) {
				return false;
			}
		});
	});
	var url = '<?=base_url($__controller.'/view_ticket/')?>';
	function get_tickets(table){
		$.ajax({
	 		url: "http://dnet.sa/hcm/help/get_tickets/<?=$this->session->userdata($this->acp_session->userid()).'/'.$_SERVER['HTTP_HOST']?>",
	 		type:"GET",
            dataType:"JSON",
	 		success: function(result){
		 		table.destroy();
		 		console.log(result);
		 		$("#applications tbody").empty();
		 		for(var i = 0; i < result.length; i++){
			 		var status = 'label-warning';
			 		if(result[i].Status == 'In Process') { status = 'label-info'; }
					if(result[i].Status == 'Completed') { status = 'label-success'; }
			 		$("#applications tbody").append('<tr>'+
										'<td>'+result[i].Ticket_No+'</td>'+
										'<td>'+result[i].Title+'</td>'+
										'<td>'+result[i].Category+'</td>'+
										'<td><label class="label '+status+' ft-b">'+result[i].Status+'</label></td>'+
										'<td>'+result[i].Date+'</td>'+
										'<td><a href="'+url+result[i].Ticket_No+'"><i class="fa fa-eye"></i></a></td>'+
									'</tr>');
		 		}
		 		
		 		$("#applications").DataTable({
		 			"searching": false,
		 			"ordering": false
		 		});
		 	},
		 	error: function(err, status, xhr){
		 		
		 		console.log(err);
		 		console.log(status);
		 		console.log(xhr);
		 	}
		 });
	}
</script>
</body>
</html>