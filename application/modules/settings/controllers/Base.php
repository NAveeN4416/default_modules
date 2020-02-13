<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Controller.php';

class Base extends CO_Controller {

  public function __construct()
  {
    // Construct the parent class
    parent::__construct();
    
    $this->controller = "base";
    $this->controller_path = "settings/base/";

  }


  public function index()
  {
    $this->data['page_name'] = 'dashboard' ;

    $this->load->view('includes/header',$this->data);
    $this->load->view('includes/side_menu',$this->data);
    $this->load->view('index',$this->data);
    $this->load->view('includes/footer',$this->data);
  }


  /*------------Overload this method as you want in your subclass--------------*/
  public function Load_View($body,$context=array())
  {
  	#$this->load->view('includes/header',$context);
    $this->load->view('index',$context);
    #$this->load->view('includes/footer',$context);
  }

  public function _remap($method, $args = array())
  {
    //Methods of this Class
    $controllerMethods = get_class_methods($this);

    if(in_array($method, $controllerMethods))
    {
      $actions = ['get','post','update','delete'] ;

      return call_user_func_array(array($this, $method), $args);
    }
    else
    {
      show_404();
    }
  }

}