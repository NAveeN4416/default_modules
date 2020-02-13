<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Database extends Base {

	/**
	 * All About User Groups
	 *
	 * Maps to the following URL
	 * 		http://example.com/settings/database
	 */

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
    $this->data['page_name'] = 'dashboard' ;

    $this->load->view('includes/header',$this->data);
    $this->load->view('includes/side_menu',$this->data);
    $this->load->view('index',$this->data);
    $this->load->view('includes/footer',$this->data);
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

  public function site_config()
  {
  	$this->data['site_config'] = $this->DB_model->get_site_config();
    $this->data['page_name'] = 'site_config' ;

    $this->load->view('includes/header',$this->data);
    $this->load->view('includes/side_menu',$this->data);
    $this->load->view('site_config',$this->data);
    $this->load->view('includes/footer',$this->data);
  }

}
