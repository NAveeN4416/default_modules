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

    $this->Check_Authentication();
  }

  public function Check_Authentication()
  {
    if(!$this->is_authenticated || $this->role!="HR")
      redirect(AUTH_CONTROLLER_PATH);
  }

  public function index()
  {
    $this->data['page_name'] = 'dashboard' ;

    //echo "Welcom to subadmin Dashboard" ; exit;

    $this->load->view('includes/header',$this->data);
    $this->load->view('includes/side_menu',$this->data);
    $this->load->view('index',$this->data);
    $this->load->view('includes/footer',$this->data);
  }
}