<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Menu extends Base {

	public $auth_classes = ["Auth_Class"];

	public function __construct()
	{
      // Construct the parent class
	   	parent::__construct();
	    $this->load->model('DB_model');
	    $this->load->model('Menu_model');

	  	$this->controller_path = "settings/menu";
	  	$this->controller = "menu";
	  	$this->data = [] ;
	}

	public function index()
	{
		$this->Load_View('menu/manage_menu');
	}

	public function add_edit_menu()
	{
		$menu_id = $this->input->post('id');
		$menu = [] ;

		if($menu_id)
		{
			$menu = @$this->Menu_model->get_menu($menu_id);
			$menu['parents'] = [] ;
		}

		$menu['parents'] = $this->Menu_model->Get_ParentMenu();

		$this->load->view('menu/add_edit_menu',$menu);
	}

	public function save_menu()
	{
		$this->Ajax['status'] = 0;
		$this->Ajax['message'] = "Something went wrong !";

		$menu = $this->input->post();

		$flag = $this->Menu_model->save_menu($menu);

		if($flag)
		{
			$this->Ajax['status'] = 1;
			$this->Ajax['message'] = "Success";
		}

		echo  $this->AjaxResponse();
	}

	public function MenuActivity()
	{
		$this->Ajax['status'] = 0;
		$this->Ajax['message'] = "Something went wrong !";


		$postdata = $this->input->post();

		$set['status'] = $postdata['status'];
		$where['id'] = $postdata['menu_id'];
		
		$uflag = $this->Menu_model->update_menu($set,$where);

		if($uflag)
		{
			$this->Ajax['status'] = 1;
			$this->Ajax['message'] = "Success";
		}

		echo $this->AjaxResponse();
	}


	public function getmenu()
	{
		$menus = $this->Menu_model->Get_menu();

		$data = [] ;

		foreach ($menus as $key => $menu) {

			$this->load->library('parser');

			$actions = [
							"edit_class" => "add_menu",
							"menu_id"=> $menu['id'],
							"delete_class" => "delete_menu" 
						] ;

			$actions = $this->parser->parse('menu/snippets/actions',$actions,TRUE);
			$status = ($menu['status']==1) ? 'checked' : '' ;

			$row = [] ;

			$row['name'] = $menu['name'];
			$row['type'] = ($menu['parent_id']) ? 'Child' : 'Not Child' ;
			$row['link'] = "<a target='_blank' href='".base_url($menu['link'])."'>".$menu['link']."</a>";
			$row['status'] =  "<input onchange='MenuActivity(".$menu['id'].")' id='menu_status".$menu['id']."' type='checkbox' ".$status." name='my-checkbox' data-bootstrap-switch data-toggle='toggle' data-on-text='On' data-off-color='warning' data-on-color='success' data-off-text='Off' data-handle-width='10'>"  ; //$group['status'];
			$row['created_at'] = $menu['created_at'];
			$row['actions'] = $actions;

			$data[] = $row ;
		}

		$this->Ajax['data'] = $data ;
		$this->Ajax['recordsTotal'] = 10 ;
		$this->Ajax['recordsFiltered'] = 10 ;

		echo $this->AjaxResponse();
	}

}
