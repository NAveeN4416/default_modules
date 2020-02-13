<style>
.crop-image{
	width: 250px;
	height: 150px;
}
table, td, th 
{
	height: 50px
}

table 
{
  border-collapse: collapse;
  width: 100%;
}

th 
{
  height: 50px;
}

</style>

<div id="content-main">
	<h3>Add Role</h3>
	<div class="row">
		<?PHP
			$this->load->view('acp_includes/response_messages');
		?>
		<div class="col-md-12">
			<form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post">
				<div class="panel white" style="padding-bottom: 50px;">
					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2">
							<label for="title_en">Role Name</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
							<input type="text" class="form-control" name="role" placeholder="e.g: Admin" required value="<?=@$user_role['Name']?>">
							<input type="hidden" name="Role_id" value="<?=@$Role_id?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2">
							<label for="title_en">Persmissions</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
							<table>
								<thead>
									<th>Content</th>
									<th style="margin-left: 10px">View</th>
									<th>Edit</th>
									<th>Delete</th>
								</thead>
								<tbody>
								<?php foreach ($pages as $key => $page) { ?>
									<tr>
										<td><?=$page->Name_en?></td>
										<td><input type="checkbox" name="view_flag[<?=$page->id?>]" <?php echo (@$permissions[$key]['view_flag']) ? 'checked' : '' ; ?>></td>
										<td><input type="checkbox" name="edit_flag[<?=$page->id?>]" <?php echo (@$permissions[$key]['edit_flag']) ? 'checked' : '' ; ?>></td>
										<td><input type="checkbox" name="delete_flag[<?=$page->id?>]" <?php echo (@$permissions[$key]['delete_flag']) ? 'checked' : '' ; ?>></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 text-right">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?PHP
	$this->load->view('acp_includes/footer');
?>

<script>
	menu_track_manual(6, 0);
</script>

</body>

</html>