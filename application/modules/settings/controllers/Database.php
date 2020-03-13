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
    $meta_search = [
                      MOBILE_CONFIG => [
                                          'DATE(modified_at)' => '2020-02-15',
                                        ],
                  ];


    $data = $this->DB_model->Get_Objects(MOBILE_DEVICES,[],$meta_search);

    echo "<pre>"; print_r($data);

    exit;


    $this->data['page_name'] = 'dashboard';

    $this->Load_View('index',$this->data);
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
