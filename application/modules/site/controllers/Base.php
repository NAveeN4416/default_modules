<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Controller.php';

class Base extends CO_Controller {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    //Loading Models

    $this->load->model('Common_model');
    $this->site_config = $this->Common_model->Get_Site_Config();
    $this->__SetSite_ENVIRONMENT();
    $this->__Site_Status();
    $this->set_lang();
  }

  private function __SetSite_ENVIRONMENT($mode="")
  {
    //Check if explicitly calling or not
    if($mode=='')
    {
      $mode = $this->site_config['mode'];
    }

    //Setting Site Modes
    if($mode=="Development")
    {
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
    }
    elseif($mode=="Production")
    {
      error_reporting(0);
      ini_set('display_errors', 0);
    }
  }

  private function __Site_Status($status='')
  {
    //Check if explicitly calling or not
    if($status=='')
    {
      $status = $this->site_config['status'];
    }

    if($status==0)
    {
      return redirect('site/independent/index');
    }
  }

  public function set_lang()
  {
    if($this->session->userdata('lang'))
    {
      $language = $this->session->userdata('lang');
    }
    else
    {
      $this->session->set_userdata('lang','en');
      $language = 'en';
    }

    define('LANG',$language,true);
    //$this->lang->load('main', $language);
  }

}