<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Controller.php';

class Base extends CO_Controller {

  public function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->load->library('session');
    $this->load->model('DB_model');

    $this->controller = "base";
    $this->controller_path = "settings/base/";

    $this->Check_And_Redirect();

    //Ajax Attrs
    $this->Ajax['status'] = 1 ;
    $this->Ajax['message'] = "Success" ;
  }

  public function Check_And_Redirect()
  {
    $this->superuser = $this->session->IS_SUPERUSER;
    $this->is_authenticated = $this->session->is_authenticated;
    $this->role = $this->superuser ? 'developer' :  $this->session->GROUP_NAME;

    if(!$this->is_authenticated)
      redirect('admin');

    if($this->role!='developer')
      redirect('settings/errors/Not_Authorised');
  }


  public function index()
  {
    $this->data['page_name'] = 'settings' ;

    $this->Load_View('index',$this->data);
  }

  public function site_config()
  {
    $this->data['site_config'] = $this->DB_model->get_site_config();
    $this->data['page_name'] = 'site_config' ;
    $this->data['mobile_configs'] =  $this->DB_model->get_MobileConfig();
    $this->data['thirdparty_configs'] =  $this->DB_model->get_thirdparty_config();

    $this->Load_View('site_config',$this->data);
  }


  public function Change_SiteStatus()
  {
    $status = $this->input->post('status');

    $uflag = $this->DB_model->Update_SiteConfig(['status'=>$status]);

    $response = ['status'=>$uflag,"message"=>"Success"] ;

    echo json_encode($response);
  }

  public function Change_SiteMode()
  {
    $mode = $this->input->post('mode');

    $mode = $mode ? "Production" : "Development" ;

    $uflag = $this->DB_model->Update_SiteConfig(['mode'=>$mode]);

    $response = ['status'=>$uflag,"message"=>"Success"] ;

    echo json_encode($response);
  }

  public function Change_RestStatus()
  {
    $status = $this->input->post('rest_status');

    $uflag = $this->DB_model->Update_SiteConfig(['rest_status'=>$status]);

    $response = ['status'=>$uflag,"message"=>"Success"] ;

    echo json_encode($response);
  }

  public function Change_RestMode()
  {
    $mode = $this->input->post('rest_mode');

    $mode = $mode ? "Production" : "Development" ;

    $uflag = $this->DB_model->Update_SiteConfig(['rest_mode'=>$mode]);

    $response = ['status'=>$uflag,"message"=>"Success"] ;

    echo json_encode($response);
  }


  public function Change_MobileMode()
  {
    $mode = $this->input->post('mode');
    $config_id = $this->input->post('config_id');

    $where['id'] = $config_id;
    $set['mode'] = $mode;

    $uflag = $this->DB_model->Update_MobileConfig($where,$set);

    $response = ['status'=>$uflag,"message"=>"Success"] ;

    echo json_encode($response);
  }

  public function Change_ThirdPartyMode()
  {
    $mode = $this->input->post('mode');
    $config_id = $this->input->post('config_id');

    $where['id'] = $config_id;
    $set['mode'] = $mode;

    $uflag = $this->DB_model->Update_ThirdPartyConfig($where,$set);

    $response = ['status'=>$uflag,"message"=>"Success"] ;

    echo json_encode($response);
  }

  /*------------Overload this method as you want in your subclass--------------*/
  public function Load_View($body,$context=array())
  {
    $this->load->view('includes/header',$this->data);
    $this->load->view('includes/side_menu',$this->data);
    $this->load->view($body,$context);
    $this->load->view('includes/footer',$this->data);
  }

  public function AjaxResponse(){

    $send = $this->Ajax;

    return json_encode($send);
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