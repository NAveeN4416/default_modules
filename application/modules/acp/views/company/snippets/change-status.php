<div class="btn-group status-group" data-picture-id="<?=$picture_id?>">
	<button class="btn btn-<?=$label?> dropdown-toggle btn-mini" data-toggle="dropdown" data-current-class="btn-<?=$label?>"><span class="btn-text"><?=$status?></span> <span class="caret"></span></button>
	<ul class="dropdown-menu">
	  	<li><a href="javascript:void(0)" class="change-status" data-status="In Process"><?=getSystemString(490)?></a></li>
	    <li><a href="javascript:void(0)" class="change-status" data-status="Active"><?=getSystemString(491)?></a></li>
	    <li><a href="javascript:void(0)" class="change-status" data-status="Rejected"><?=getSystemString(485)?></a></li>
	</ul>
</div>