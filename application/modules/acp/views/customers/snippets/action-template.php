<?PHP
		
	// 	$actions .=' <a href="#" class="archive-app"><i class="fa fa-file-archive-o"></i></a>';
		?>
	<div class="btn-group">
				  <a class="btn btn-default dropdown-toggle" type="button" href="<?=$details_url?>">
                        <i class="fa fa-eye"></i> <?=getSystemString(324)?>
                  </a>
				  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="fa fa-angle-down"></span>
  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
					  <li>
						   <a href="<?=$details_url?>" style="margin: 0px 5px;" class="dropdown-item">
		                        <i class="fa fa-eye"></i> <?=getSystemString(324)?>
		                   </a>
					   </li>
					  <li>
					  	<a href="<?=$edit_url?>" style="margin: 0px 5px;" class="dropdown-item">
						  		<i class="fa fa-edit"></i> <?=getSystemString(43)?>
						</a>
					  </li>
					  <li>
					  		<a href="<?=$delete_url?>" style="margin: 0px 5px;" class="dropdown-item">
						  		<i class="fa fa-trash"></i> <?=getSystemString(314)?>
						  	</a>
					  </li>
					</ul>
			   </div>