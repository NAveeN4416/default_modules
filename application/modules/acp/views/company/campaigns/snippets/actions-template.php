
<div class="btn-group">
	  <a class="btn btn-default dropdown-toggle" type="button" href="<?=$details_url?>">
	        <i class="fa fa-eye"></i> <?=getSystemString(324)?>
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
		  		<a href="<?=$details_url?>" style="margin: 0px 5px;" class="dropdown-item">
			  		<i class="fa fa-eye"></i> <?=getSystemString(324)?>
			  	</a>
		  </li>
		  <li>
		  		<a href="<?=$bookings_url?>" style="margin: 0px 5px;" class="dropdown-item">
			  		<i class="fa fa-bookmark"></i> <?=getSystemString(307)?>
			  	</a>
		  </li>
		  <li>
		  		<a href="<?=$edit_trip?>" style="margin: 0px 5px;" class="dropdown-item">
			  		<i class="fa fa-edit"></i> Edit Trip
			  	</a>
		  </li>
		  <li>
		  		<a href="<?=$login_url?>" style="margin: 0px 5px;" class="dropdown-item" target="_blank">
			  		<i class="fa fa-sign-in"></i> <?=getSystemString(293)?>
			  	</a>
		  </li>
		</ul>
</div>