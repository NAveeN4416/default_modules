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
					<h3>
						Groups
						<a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">Add new Group</a>
					</h3>
		            <div class="panel white" style="padding-bottom: 50px;">
			          
			            <table class="table table-hover" id="clients_table">
				            <thead>
					            <tr>
						         <th><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString('Role Name')?></th>
						         <th><?=getSystemString(44)?></th>
					            </tr>
				            </thead>
				            <tbody>
					        <?PHP
						         if(count($roles)){
							         $i = 0;
							        foreach($roles as $row){
								       $i++;
								       $dt = new DateTime($row->Timestamp);
								       ?>
								        <tr>
									       <td><?=$i?></td>
									       <td><?=$dt->format('d-m-Y');?></td>
									       <td><?=$row->Name?></td>
										   <td>
										   		<a href="<?=base_url($__controller."/add/".$row->Role_ID)?>" class="btn btn-info btn-xs text-danger" style="color:#FFF">
													<i class="fa fa-edit"></i> Edit
												</a>
												<a href="<?=base_url($__controller."/delete/".$row->Role_ID)?>" class="btn btn-danger btn-xs text-danger" style="color:#FFF">
													<i class="fa fa-trash"></i> <?=getSystemString(44)?>
												</a>
										   </td>
									    </tr>
								       <?PHP
							        }
						         } else {
							          echo '<tr><td colspan="5" class="text-center">No Roles </td></tr>';
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
</body>
</html>