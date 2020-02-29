
<div class="btn-group">
    <a class="btn btn-secondary" type="button" href="#">
        <i class="fa fa-eye"></i> View
    </a>
    <button type="button" class="btn btn-primary dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="fa fa-angle-down"></span>
	</button>
  	<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
 	  	<li>
  			<a target="_blank" href="<?=base_url('settings/user_groups/Get_GroupUsers/')?><?=$group_id?>"  class="dropdown-item">
	  		<i class="fa fa-users"></i> Manage Users
	  		</a>
	  	</li>
 	  	<li>
  			<a href="<?=base_url('settings/user_permissions/edit_permissions/')?><?=$group_id?>"  class="dropdown-item">
	  		<i class="fa fa-lock"></i> Manage Permissions
	  		</a>
	  	</li>
	  	<li>
  			<a href="javascript:"  class="dropdown-item <?=@$edit_class?>" data-id="<?=$group_id?>">
	  		<i class="fa fa-edit"></i> Edit
	  		</a>
	  	</li>
	  	<li>
  			<a href="javascript:"  class="dropdown-item <?=@$delete_class?>" data-id="<?=$group_id?>">
	  		<i class="fa fa-trash"></i> Delete
	  		</a>
	  	</li>
		<!-- <?php if(@$company_url){ ?>  
			  	<li>
		  			<a href="#" style="margin: 0px 5px;" class=" dropdown-item">
			  		<i class="fa fa-copy"></i> Copy Link
			  		</a>
			  	</li>
		<?php } ?> -->
	</ul>
</div>
