<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends MY_Controller {
	
	public $sessObj;
	
	function __construct()
	{
    	parent::__construct();
    	
    	// load acp session
    	$this->load->library('Acp_Session');
    	
    	$this->load->model('admin_model');
    	
    	// Load user log library
        $this->load->library('logs');
        
        
        // load helper
        $this->load->helper('utilities_helper');
        $this->load->helper('image_helper');
    	
    	// User authentication and authorization
        $this->load->library('authentication_hr');
        $userid = $this->session->userdata($this->acp_session->userid());
        $email  = $this->session->userdata($this->acp_session->email());
        
        //set default language if not set
        if(strlen($this->session->userdata($this->acp_session->__lang())) <= 1 ){
			$this->session->set_userdata($this->acp_session->__lang(), 'en');
		}
        
		$ctrl = $this->router->fetch_class();
		$module = $this->router->fetch_module();
        $this->authentication_hr->IsLoggedIn($userid, $email, $module);
    	
        //echo "<pre>"; print_r($_SESSION);exit;

  	}
  	
  	
  	public function index()
	{	
		if($this->IsLoggedIn())
		{
			redirect('acp/dashboard');
		} else {
			redirect('authentication/login');
		}
	}
	
	// Login view
	public function login(){
		
		$lang = $this->session->userdata($this->acp_session->__lang());
		$data[$this->acp_session->__lang()] = $lang;
		
		if($this->IsLoggedIn()){
			redirect('acp/dashboard');
		}
		
		$this->load->view('login', $data);
	}
  	
  	public function IsLoggedIn()
  	{
		if($this->session->userdata($this->acp_session->userid())){
			$data['email'] = $this->session->userdata($this->acp_session->email());
			$data['user_id'] = $this->session->userdata($this->acp_session->userid());
			$result = $this->auth->isLoggedIn_check($data);
			return $result;
		}
	}
	
		//#logout function
	public function logout()
	{
		$this->session->unset_userdata($this->acp_session->userid());
		$this->session->unset_userdata($this->acp_session->username());
    	$this->session->unset_userdata($this->acp_session->email());
    	$this->session->unset_userdata($this->acp_session->role());
    	$this->session->unset_userdata($this->acp_session->picture());
// 		$this->session->sess_destroy();
		redirect('acp/login');
		
	}
	
	// Change language function
	public function changeLanguage($lang = ''){
		$website_lang = $this->admin_model->GetWebsitetLanguage();
		if($website_lang == 'en-ar'){
			$this->session->set_userdata($this->acp_session->__lang(), $lang);
		}
		//if request sent by client
		if(isset($_SERVER['HTTP_REFERER'])) {
			$path = rtrim($_SERVER["HTTP_REFERER"], '/');
			$segments = explode("/", $path);
			$url = $path;
			header('Location: ' . $url);
		}
		
	}
	
	
	/*-----------------------------------------------------------
		---------------------- #Functions -----------------
		--------------------------------------------------------*/
		
	// #generalLoadView function
	public function LoadView($view = null, $data = null)
	{
		
		// get website language
		$website_lang = $this->admin_model->GetWebsitetLanguage();
		// check for language from database if set to specific language
		$data['website_lang'] = $website_lang == 'en-ar' ? true : false; // means that if its multilangauge don't hide the tabs else hide in view
		
		if($website_lang == 'en-ar'){ // if website has both language then select lang from session
			if(empty($this->session->userdata($this->acp_session->__lang())))
			{
				$this->session->set_userdata($this->acp_session->__lang(), 'en');
			}
			$data[$this->acp_session->__lang()] = $this->session->userdata($this->acp_session->__lang());
		} else {
			$data[$this->acp_session->__lang()] = $website_lang; // it will be either `en` or `ar`
			$this->session->set_userdata($this->acp_session->__lang(), $website_lang);
		}

		/* print_r($data);
		die(); */

		$this->load->view('acp_includes/header', $data);
		$this->load->view($view, $data);
	}
	
	// #change Status
	public function ChangeStatus()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'status' => $this->input->post('status'),
			'tb_loc' => $this->input->post('tb_loc')
		);

		if($data['tb_loc']=='news')
		{
			$result = $this->admin_model->ChangeNewsStatus($data);
			echo $result ; exit;
		}

		if($data['tb_loc']=='services')
		{
			$result = $this->admin_model->ChangeServiceStatus($data);
			echo $result ; exit;
		}

		$result = $this->admin_model->ChangeStatus($data);

		if($result && $data['tb_loc']=='company')
		{
			$this->load->model('company_model', 'company');

			$integrate['company'] = $this->company->getCompanyByID($data['id'])[0];

			$integrate['status']  = $data['status'];

			$send['subject'] = 'Account Activation' ;
	        $send['message'] = $this->load->view('accountactivation_email_template',$integrate,True) ;
	        $send['to']      = $integrate['company']->Email ;

	        SendEmail($send); 
		}

		echo $result;
	}
	
	// #change Order @it will be better to make the structure same as changing status function
	public function ChangeOrder(){
		// get the post key #which is fixed and its length will be equal to 1
		$result = $this->admin_model->ChangeOrder(array_keys($_POST)[0]);
		echo $result;
	}
	
	public function ckeditor(){
	    $this->load->view('browse', $_GET);
	}
	
	public function CKUpload(){
 
	    $upload = $this->ImageUpload('upload', $GLOBALS['img_ck_dir'], 0, 0, 1000); // upload image
        if (!is_array($upload) && !array_key_exists('file_name', $upload)) {
	        echo $upload;
		    exit();
	    }
	    
	    $upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];
	 
	    $funcNum = $this->input->get('CKEditorFuncNum'); //$_GET['CKEditorFuncNum']
	    $this->upload->initialize($config);
		$url = base_url($GLOBALS['img_ck_dir'].$file_name);	         
	 
	    $message = 'Upload success!';
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
	}
	
	public function getCities()
	{
		$this->load->library('curl');
        return json_decode($this->curl->simple_get('http://api.dnet.so/api/cities/all_cities'));
	}
 
	public function ImageUpload($file, $dir, $minWidth, $minHeight, $maxWidth){
		$config['upload_path']          = './'.$dir.'/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name']			= true;
        $config['overwrite']            = true;
        $config['min_width']			= $minWidth;
        $config['min_height']			= $minHeight;
        
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file))
        {
            return $this->upload->display_errors();
        }
        else
        {
		    $upload_data = $this->upload->data();
			$this->load->library('image_lib');
	        $config = array(
	           'image_library' => 'gd2',
	           'source_image'=> './'.$dir.'/'.$upload_data['file_name'],
	           'maintain_ratio'=> TRUE,
	           'quality' => '65%',
	           'width'=> $maxWidth,
	           'height'=> $maxWidth
	        );
	        $this->image_lib->initialize($config);
	        if(!$this->image_lib->resize()){
	             echo $this->image_lib->display_errors();
	        }
	        return $upload_data;		
        }
	}

}