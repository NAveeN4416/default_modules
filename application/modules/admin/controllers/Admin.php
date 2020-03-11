<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/admin/controllers/Base.php');
class Admin extends Base {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/admin
	 *	- or -
	 * 		http://example.com/admin/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

  public $extra_session_vars = array() ; 

	public function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->controller = 'admin/' ;
    $this->controller_path = ADMIN_CONTROLLER_PATH;

    $this->Check_Authentication();

    $this->role = 'admin' ;
  }

  public function Check_Authentication()
  {
    if(!$this->is_authenticated){
      redirect(AUTH_CONTROLLER_PATH);
    }

    if(!$this->is_superuser){
      redirect('settings/base');
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


  public function check()
  {
    echo $this->username ;
  }

  public function modal($value='')
  {
  	 $data 			= array();
  	$data['id'] 	= $this->input->post('id');
  	if($data['id'])
  	{
  		$data['value'] = $this->admin_m->getservicedata($data['id']);
  	}
  	else
  	{
  		$data['value'] = '' ;
  	}

  	$this->load->view('admin/add_services',$data);
  }


	public  function RandomString($size=50)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randstring = '';
	    for ($i = 0; $i < $size; $i++)
	    {
	     $randstring = $randstring.$characters[rand(0, strlen($characters)-2)];
	    }
	    return $randstring;
	}


//=========================Language Maintenanace START==================================================


//Language Management
  public function language($page_id)
  {
    $page_details = $this->db->where('id',$page_id)->get('lang_manage')->row_array();

    $this->data['page_id']        = $page_id ;
    $this->data['page']           = $page_details['param_name'] ;
    $this->data['main_page_name'] = 'language' ;
    $this->data['page_name']      = $page_details['param_name'] ;
    $this->data['mode']           = (ENVIRONMENT=='development') ? '' : 'readonly' ;

    $data_en = ($page_details['data_en']) ? json_decode($page_details['data_en'],TRUE) : array();

    $data_ar = json_decode($page_details['data_ar'],TRUE);

    foreach ($data_en as $param => $value_en)
    {
      $data[$param] =  [
                        'en' => $value_en,
                        'ar' => $data_ar[$param],
                       ] ;
    }

    $this->data['data'] = (@$data) ? $data : array() ;
    //echo "<pre>"; print_r($this->data['page'] );exit;

    $this->load->view('admin/includes/header',$this->data);
    $this->load->view('admin/includes/footer',$this->data);
    $this->load->view('admin/set_lang',$this->data);
  }


//Save Language
  public function save_language()
  {
    $en = $this->input->post('data')['en'];
    $ar = $this->input->post('data')['ar'];
    $page_id = $this->input->post('data')['id'];

      $iar = array();

      foreach ($ar as $param => $value)
      {
        $iar[$param] = $value ;
      }

      $data_ar = json_encode($iar);

      $this->db->set('data_ar',$data_ar)->where('id',$page_id)->update('lang_manage');
  }


//Adding Param
  public function add_param()
  {
    $this->data['pages'] = $this->db->get('lang_manage')->result_array();

    $this->data['main_page_name'] = 'language' ;
    $this->data['page_name']      = "add_param" ;

    $this->load->view('admin/includes/header',$this->data);
    $this->load->view('admin/includes/footer',$this->data);
    $this->load->view('admin/add_param',$this->data);
  }


//SAVING Params
  public function save_params()
  {
    $data = $this->input->post('data');

    $page_id      = $data['page_id'] ;
    $param_names  = $data['params']  ;
    $en           = $data['en']      ;
    $ar           = $data['ar']      ;

    unset($data);

    $new_en = array();
    $new_ar = array();

    if($page_id)
    {
      $old_data = $this->db->where('id',$page_id)->get('lang_manage')->row_array();

      $new_en   = json_decode($old_data['data_en'],TRUE);
      $new_ar   = json_decode($old_data['data_ar'],TRUE);
    }

    foreach ($param_names as $key => $param)
    {
      if($param!='')
      {
        $new_en[$param] = $en[$key] ;
        $new_ar[$param] = $ar[$key] ;
      }
    }

    $new_en = json_encode($new_en);
    $new_ar = json_encode($new_ar);

    $data = ['data_en'=>$new_en,'data_ar'=>$new_ar];

    if($page_id)
    {
      $flag =$this->db->set($data)->where('id',$page_id)->update('lang_manage');
    }
    else
    {
      $flag = $this->db->insert('lang_manage',$data);
    }

    echo $flag ;
  }


//Remove Param from Page
  public function remove_param($page_id,$param_name)
  {
    $old_data = $this->db->where('id',$page_id)->get('lang_manage')->row_array();

    $new_en  = json_decode($old_data['data_en'],TRUE);
    $new_ar  = json_decode($old_data['data_ar'],TRUE);

    unset($new_en[$param_name]);
    unset($new_ar[$param_name]);

    $new_en = json_encode($new_en);
    $new_ar = json_encode($new_ar);

    $data = ['data_en'=>$new_en,'data_ar'=>$new_ar];

    $this->db->set($data)->where('page_id',$page_id)->update('lang_manage');

    redirect('admin/language/'.$page_id);
  }

//=========================Language Maintenanace START==================================================

//mazhar code

//change user status
	public function  change_status()
	{
	    $user_id = $this->input->post('user_id');
	    $status = $this->input->post('status');

	    if($status == 1)
	    {
	     $this->db->where('id',$user_id);
		$this->db->update('users',array('approval_status'=>0));

		//echo 1;
		//$this->session->set_flashdata('success','User De Activate ');
		echo json_encode(["status"=>"success","message"=>"User De Activate"]);

	    }
	    else
	    {
	      $this->db->where('id',$user_id);
		$this->db->update('users',array('approval_status'=>1));

		//echo 1;
		//$this->session->set_flashdata('success','User Activated');
		echo json_encode(["status"=>"success","message"=>"User Activated"]);
	    }
	}

}

function delete_files($array_of_files,$type="")
{
	$type = ($type) ? $type : 'image' ;

	foreach ($array_of_files as $key => $file)
	{
		$file = $file[$type] ;

		unlink($file);
	}
}
