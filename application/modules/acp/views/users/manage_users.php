	<style>
		.panel.white{
			min-height: 100px;
		}
	</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
					
					if(!isset($user_id))
					{
					 ?>
					 
				<div class="col-md-12">
					<h1><?=getSystemString(86)?>
					<a class="btn btn-primary pull-right" href="<?=base_url('acp/createUser')?>" style="color:#FFF;margin: 0px 10px "> <?=getSystemString(110)?></a>
					<!-- <a class="btn btn-primary pull-right" href="<?=base_url('acp/menu/rolesManagement')?>" style="color:#FFF;margin: 0px 10px ">Roles & permissions</a> -->
					<a class="btn btn-primary pull-right" href="<?=base_url('acp/roles/listall')?>" style="color:#FFF">Permissions & Groups</a>
					</h1>
		          <div class="panel white" style="padding-bottom: 50px;">

			         <table class="table table-hover sortable-1 sortable-tb" id="categories_table">
				         <thead>
					         <tr>
						         <th><?=getSystemString(41)?></th>
						         <th><?=getSystemString(81)?></th>
						         <th><?=getSystemString(82)?></th>
						         <th><?=getSystemString(285)?></th>
						         <th colspan="2"><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($users)){
							         $i = 0;
							        foreach($users as $row){ if($row->Username=='admin@dnet.sa') { continue ;}
								       $i++;
								       ?>
								       <tr id="<?=$row->User_ID;?>">
									       <td class=""><?=$row->User_ID;?></td>
									       <td><?=$row->Fullname;?></td>
									       <td><?=$row->Username;?></td>
									       <td><?=$row->Name?></td>
<!--
									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
												</div>
											</td>
-->
											<td>
												<div class="btn-group">
													 <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editUser/'.$row->User_ID.'/')?>">
													     <i class="fa fa-edit"></i> <?=getSystemString(43)?>
													  </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
													
														  <li>
														  		<a href="<?=base_url($__controller.'/deleteUser/'.$row->User_ID.'/')?>" onclick="return confirm('<?=getSystemString(45)?>');" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
							          echo '<tr><td colspan="5" class="text-center">No users </td></tr>';
						         }
					         ?>
				         </tbody>
			         </table>			          
		          </div>
		          
				</div>
					<?PHP
					}
						
					if(isset($user_id))
					{
					?>
					
				<div class="col-md-10">
					<h3><?=getSystemString(406)?></h3>
					
					 <form action="<?=base_url($__controller.'/updateUser');?>" class="form-horizontal" method="post">	
						 <div class="panel white" style="padding-bottom: 50px;">
			          
					          <input type="hidden" name="target_page" value="manageUsers">
					          <input type="hidden" name="user_id" value="<?=$user_id?>">				         
					         <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="name"><?=getSystemString(81)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="name" placeholder="<?=getSystemString(81)?>" required="" value="<?=$user[0]->Fullname?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="name"><?=getSystemString(82)?></label>
								</div>
								<input type="hidden" name="old_email" value="<?=$user[0]->Username?>">
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="email" class="form-control" name="username" placeholder="<?=getSystemString(82)?>" required="" value="<?=$user[0]->Username?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="name"><?=getSystemString(83)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="password" class="form-control" name="password" placeholder="<?=getSystemString(83)?>" value="">
								</div>
							</div>

							<?PHP
								foreach($roles as $role):
							?>
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2"></div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<div class="radio">
												<label><input type="radio" name="role" value="<?=$role->Role_ID?>" <?PHP if($user[0]->Role_ID == $role->Role_ID) { echo 'checked'; } ?> style="top:9px"><?=$role->Name?></label>
											</div>
										</div>
									</div>
							<?PHP
								endforeach;
							?>

<!--
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(285)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<div class="checkbox">
									<label><input type="checkbox" name="role" value="1" style="top:9px" 
									<?PHP
										if($user[0]->Role == 'admin'){
											echo 'checked';
										}
									?>
									><?=getSystemString(286)?></label>
								</div>
								
							</div>
						</div>
-->
			          
		          		</div>
		          
			            <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
							</div>
						</div>
					          
				          
				          
			        </form>
		          
				</div>
					
				<?PHP
					}
				?>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
		
		$(document).on('click',"#categories_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'categories');
		});
		
		ChangeOrder('categories');
	});
</script>
</body>
</html>