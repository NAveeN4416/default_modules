<style>
  .panel.white{
    min-height: 150px ;
  }
</style>
<div id="content-main">
  <div class="row">
    <?PHP
		$this->load->view('acp_includes/response_messages');
	?>
    <div class="col-md-12">
      <h3>Menu List
        <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary pull-right" style="color:#fff">
            <i class="fa fa-plus"></i> Add Menu
        </a>
      </h3>
    </div>
    

    <div class="col-md-12">
      <div class="panel white" style="padding-bottom: 50px;">
      <table class="table table-hover sortable-1 sortable-tb" id="categories_table">
				         <thead>
					         <tr>
                      <th>Menu</th>
                      <th>Action Name</th>
                      <th>Link</th>
                      <th>Is Sidebar Menu</th>
                      <th>Actions</th>
					         </tr>
				         </thead>
                  <tbody>
                  <?PHP
                    foreach($menus as $m):
                  ?>
                      <tr>
                        <td><?=$m->Menu_Key?></td>
                        <td><?=$m->Action_Key?></td>
                        <td><?=$m->Menu_Key?></td>
                        <td><?=$m->Is_SideBar_Menu?></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$m->Id)?>">
                                    <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                  </a>
                                  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="fa fa-angle-down"></span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                      <li>
                                        <a href="<?=base_url($__controller.'/edit/'.$m->Id)?>" style="margin: 0px 5px;" class="dropdown-item">
                                          <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url($__controller.'/delete/'.$m->Id)?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
                                          <i class="fa fa-trash"></i>  <?=getSystemString(314)?>
                                        </a>
                                    </li>
                                  </ul>
                              </div>
                        </td>
                      </tr>
                  <?PHP
                    endforeach;
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
