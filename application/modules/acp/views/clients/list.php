	<style>
		.crop-image{
			width: 250px;
			height: 150px;
		}
	</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<div class="col-md-12">
					
					 <?PHP
						$section = "SectionName_".$__lang;
						$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
					?>
					<h3>
						<?=getSystemString('partner_list')?> 
						<a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF"><?=getSystemString('add_new_partner')?></a>
						
					</h3>
				
		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4><?=getSystemString('partner_list')?></h4>
			         <table class="table table-hover sortable-tb sortable-1" id="clients_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString('logo')?></th>
						         <th><?=getSystemString(38)?></th>
						         <th><?=getSystemString(273)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($clients)){
							         $i = 0;
							        foreach($clients as $row){
								       $i++;
								       $dt = new DateTime($row->Date);
								       ?>
								       <tr id="<?=$row->Client_ID;?>">
									       <td class="hide"><?=$row->Client_ID;?></td>
									       <td class="index hide"><?=$i;?></td>
									       <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
									       <td><a href="<?=$row->Client_Link;?>" target="_blank">
										   	<img src="<?=base_url($GLOBALS['img_clients_dir']).$row->Picture;?>" alt='client icon' style="width: 40px;"></a></td>
									       <?PHP $title = 'Title_'.$__lang; ?>
									       <td><?=$row->$title;?></td>
									       <td><a href="<?=$row->Client_Link;?>" target="_blank"><i class="fa fa-link"></i></a></td>
									       
									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
												</div>
											</td>
									       
									       <td><div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$row->Client_ID.'/')?>">
                                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                                      </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  <li>
														  		<a href="<?=base_url($__controller.'/edit/'.$row->Client_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
														  <li>
														  		<a href="<?=base_url($__controller.'/delete/'.$row->Client_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
															  		<i class="fa fa-trash"></i>  <?=getSystemString(314)?>
															  	</a>
														  </li>
														</ul>
			   									</div>
									       
									       </td>
								       </tr>
								       <?PHP
							        }
						         } else {
							          echo '<tr><td colspan="5" class="text-center">No Clients </td></tr>';
						         }
					         ?>
				         </tbody>
			         </table>			          
		          </div>
		          
				</div>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){	
		$(document).on('click',"#clients_table tr td .hurkanSwitch", function(){
			ChangeClientStatusFor($(this), 'clients');
		});
			
		ChangeOrder('clients');
	});

// change status for post,article,slider,service, project etc
function ChangeClientStatusFor(currentTb, tb_loc) {
    var status = 1;
    var hurkan = $(currentTb).prev('div');
    var get_Status = $(hurkan).attr('data-status');
    if (get_Status == 1) {
        status = 0;
        $(hurkan).attr('data-status', 0);
    } else {
        status = 1;
        $(hurkan).attr('data-status', 1);
    }
    var id = $(currentTb).closest('tr').find('td:eq(0)').text();

    // trigger the targeted location
    ChangeClientStatus(id, status, tb_loc);
}

function ChangeClientStatus(id, status, tb_loc) {
    var data = {
        id: id,
        status: status,
        tb_loc: tb_loc
    };
    return $.ajax({
        url: __base_url + "acp/clients/ChangeStatus",
        type: "POST",
        dataType: "JSON",
        data: data,
        success: function(result) {
            console.log(result);
        },
        error: function(err, status, xhr) {
            console.log(err);
            console.log(status);
            console.log(xhr);
        }
    });
}


</script>
</body>
</html>