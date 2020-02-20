<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Database extends Base {



	public function __construct()
  {
      // Construct the parent class
   	parent::__construct();
   	$this->load->model('DB_model');

   	$this->controller = "database";
  	$this->controller_path = "settings/database";
  }

  public function index()
  {
    $this->data['page_name'] = 'dashboard';

    $this->Load_View('index',$this->data);
  }

  public function mobile_config()
  {
    $this->data['page_name'] = 'mobile_config' ;

    $this->Load_View('mobile/mobile_config',$this->data);
  }


  public function Get_Device_Form()
  {
    $this->data['device'] = [] ;

    $this->load->view("mobile/add_device",$this->data);
  }


  public function Add_Device()
  {
    print_r($_POST);
  }


  public function db_constants()
  {
  	$this->data['tables'] = $this->DB_model->get_db_tables();
    $this->data['page_name'] = 'db_constants' ;

    $this->load->view('includes/header',$this->data);
    $this->load->view('includes/side_menu',$this->data);
    $this->load->view('db/constants',$this->data);
    $this->load->view('includes/footer',$this->data);
  }



}
