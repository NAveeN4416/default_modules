<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Controller.php';

class Base extends CO_Controller {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->load->model('Admin_model');
    $this->site_config = $this->Admin_model->Get_Site_Config();

    $this->initilize_session();
    $this->set_lang();
    $this->Load_Menu();
  }

  public function initilize_session()
  {
    $this->is_authenticated = ($this->session->is_authenticated) ? true : false ;
    $this->is_superuser = ($this->session->IS_SUPERUSER) ? true : false ;
    $this->is_active = ($this->session->IS_ACTIVE) ? true : false ;
    $this->role = ($this->session->GROUP_NAME) ? $this->session->GROUP_NAME : '' ;
    $this->username = ($this->session->USERNAME) ? $this->session->USERNAME : NULL ;
  }

  public function set_lang($lang="")
  {
    if($lang!="")
    {
      $this->session->set_userdata('lang',$lang);
    }
    else
    {
      if($this->session->userdata('lang'))
      {
        $language = $this->session->userdata('lang');
      }
      else
      {
        $language = 'en';
        $this->session->set_userdata('lang','en');
      }
    }

    define('LANG',$language,true);

    return True ;
  }

  public function Load_Menu()
  {
    $this->menu = $this->Admin_model->Get_Menu();
  }

  public function _remap($method, $args = array())
  {
    $exception_classes = ['base','auth'];

    if(!in_array($this->controller, $exception_classes))
    {
      $exception_methods = ['login','login_page','logout'] ;

      //Bypass checking permissions for some pages(Permissions not required)
      if(!in_array($method, $exception_methods))
      {
        //Allow only if authenticated
        if($this->is_authenticated)
        {
          //Methods of this Class (including Parent Class)
          $controllerMethods = get_class_methods($this);

          if(in_array($method, $controllerMethods))
          {
            if(!$this->is_superuser)
            {
              $actions = ['get','post','update','delete'] ;

              return call_user_func_array(array($this, $method), $args);
            }
          }
          else
          {
            show_404();
          }
        }
        else
        {
          $this->logout();
        }
      }
    }

    return call_user_func_array(array($this, $method), $args);
  }

}