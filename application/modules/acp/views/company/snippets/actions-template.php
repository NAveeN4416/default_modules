
<div class="btn-group">
	  <a class="btn btn-default dropdown-toggle" type="button" href="<?=$edit_url?>">
	        <i class="fa fa-edit"></i> <?=getSystemString(43)?>
	  </a>
	  <button type="button" 
	  		  class="btn btn-default dropdown-toggle dropdown-toggle-split" 
	  		  data-toggle="dropdown" 
	  		  aria-haspopup="true" 
	  		  aria-expanded="false">
	  		  
	  		  <span class="fa fa-angle-down"></span>
	</button>
	
	<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
	    <li>
	  		<a href="<?=$edit_url?>" style="margin: 0px 5px;" class="dropdown-item">
		  		<i class="fa fa-edit"></i> <?=getSystemString(43)?>
		  	</a>
	    </li>
	    <li>
	  		<a href="<?=$login_url?>" style="margin: 0px 5px;" class="dropdown-item" target="_blank">
		  		<i class="fa fa-sign-in"></i> <?=getSystemString(293)?>
		  	</a>
	    </li>
	    <li>
	  		<a href="<?=$campaigns_url?>" style="margin: 0px 5px;" class="dropdown-item">
		  		<i class="fa fa-calendar"></i> <?=getSystemString(303)?>
		  	</a>
	    </li>
	    <?php
			if($this->session->userdata($this->acp_session->role()) == 'super_admin' || $this->session->userdata($this->acp_session->role()) == 'admin') {
		?>
	    <li>
	  		<a href="<?=@$payments?>" style="margin: 0px 5px;" class="dropdown-item">
		  		<i class="fa fa-money"></i> <?=getSystemString('Transactions')?>
		  	</a>
	    </li>
		<?php } ?>
	    <li>
	  		<a href="<?=$delete_url?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
		  		<i class="fa fa-trash"></i> <?=getSystemString(314)?>
		  	</a>
	    </li>
	</ul>
</div>