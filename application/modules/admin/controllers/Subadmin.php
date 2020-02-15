<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/admin/controllers/Base.php');

class Subadmin extends Base {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->controller = "subadmin";
    $this->controller_path = "admin/subadmin/";

    if(!$this->is_authenticated || $this->is_superuser){
      redirect('admin/base/login_page');
    }
  }

  public function index()
  {
    $this->data['page_name'] = 'dashboard' ;

    $this->load->view('includes/header',$this->data);
    $this->load->view('includes/side_menu',$this->data);
    $this->load->view('index',$this->data);
    $this->load->view('includes/footer',$this->data);
  }
}