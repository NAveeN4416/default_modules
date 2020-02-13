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
					<h3> <?=getSystemString('company_tickets')?></h3>
				
		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4></h4>
			         <table class="table table-hover sortable-tb sortable-1" id="clients_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(212)?></th>
						         <th><?=getSystemString(311)?></th>
						         <!-- <th>Email</th> -->
						         <th><?=getSystemString(244)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						        if(count($enquiries))
								{
							         $i = 0;
							        foreach($enquiries as $row){
								       $i++;
								       $dt = new DateTime($row->created_at);
								       ?>
								       <tr id="<?=$row->id;?>">
									       <td class="hide"><?=$row->id;?></td>
									       <td class="index hide"><?=$i;?></td>
									       <td><?=$dt->format('d-m-Y');?></td>
									       <td><?=$row->id;?></td>
									       <td><?=$row->Company_Name;?></td>
									      	<!-- <td><?=$row->Email;?></td> -->
									       <td><?=$row->Subject;?></td>
									       <td>
									       		<?php $btn = ($row->Status==1) ? 'badge-success' : 'badge-warning' ; ?>
									       		<?php $status = ($row->Status==1) ? ''.getSystemString('Closed') : ''.getSystemString('in_process'); ?>
												<span class="badge <?=$btn?>"><?=$status?></span>
									       </td>
									       <td>
									       		<div class="btn-group">
												  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url('acp/tickets/enquiries/companies/'.$row->id.'/')?>">
                                                     <i class="fa fa-eye"></i> <?=getSystemString(324)?>
                                                  </a>
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

</body>
</html>