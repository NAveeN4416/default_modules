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
						Join As Partners
					</h3>
				
		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4><?=@$clients[0]->$section?></h4>
			         <table class="table table-hover sortable-tb sortable-1" id="clients_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th>Company Name</th>
						         <th>Message</th>
						         <th>Action</th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						        if(count($join_as_partners))
								{
							         $i = 0;
							        foreach($join_as_partners as $row){
								       $i++;
								       $dt = new DateTime($row->created_at);
								       ?>
								       <tr id="<?=$row->id;?>">
									       <td class="hide"><?=$row->id;?></td>
									       <td class="index hide"><?=$i;?></td>
									       <td><?=$dt->format('d-m-Y');?></td>
									       <td><?=$row->Company_name;?></td>
									       <td><?=substr($row->Message,0,50);?>.....<a href="<?=base_url('acp/view_partner/'.$row->id.'/')?>">Read More</a></td>
									       <td>
									       		<div class="btn-group">
												  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url('acp/view_partner/'.$row->id.'/')?>">
                                                     <i class="fa fa-eye"></i> View details
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