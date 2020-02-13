<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Acp extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));

    	$this->load->model('company_model', 'company');
    	$this->load->model('customers_model', 'customer');
  	}


	/*-----------------------------------------------------------
		---------------------- #Password reset request function -----------------
		--------------------------------------------------------*/
	
	// change password request form
	public function resetPasswordRequest($reset_token = '')
	{
		if($reset_token == '')
		{
			show_404();
			die();
		}
		
		$ctrl = strtolower($this->router->fetch_class());
		$role_login = '';
		if($ctrl == 'cp'){
			$role_login = COMPANY_ROLE;
		} else {
			$role_login = ADMIN_ROLE;
		}
		$this->session->set_userdata('role_login', $role_login);
		
		$data['reset_token'] = urldecode($reset_token);
		$this->load->view('reset_password', $data);
	}
	
	/*-----------------------------------------------------------
		---------------------- #User Profile + language change function -----------------
		--------------------------------------------------------*/
	
	public function commingSoon1()
	{
		$this->LoadView('commingsoon', '');
	}
	
/*
	public function websiteLogs($value = ''){
		$this->LoadView('logs/logs', '');
	}
*/
	
	// #profile function
	public function profile()
	{
		$userid = $this->session->userdata($this->acp_session->userid());
		if($userid != 1)
		{
			$data['user_id'] = $userid;
			$data['user'] = $this->admin_model->getUser($data);
			$this->LoadView('users/profile', $data);
		} else {
			redirect($this->thisCtrl.'/dashboard');
		}
	}
	
	// #update profile function 
	public function updateProfile()
	{
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id' => 0,
				'action_table' => 'login',
				'content' => $_POST,
				'event' => 'update'
			);
			$this->logs->add_log($log);
			
			$this->load->library('form_validation');
			
			$userid = $this->session->userdata($this->acp_session->userid());
            $password = $this->input->post('password');
            $current_email = $this->input->post('old_email');
            $field_email = $this->input->post('username');
            
            $run_validation = 0;
            $email_change_request = 0;
            if($field_email != $current_email)
            {
	            $this->form_validation->set_rules('username', 'Email Address', 'required|valid_email|xss_clean|is_unique['.TBL_USERS.'.Username]',
            array('is_unique' => 287));
            
            	$run_validation = 1;
				$email_change_request = 1;
            }
            
            // check password
            if(strlen($password) > 1)
            {
	            $this->form_validation->set_rules('password', 'New Password', 'required|trim|min_length[3]|max_length[20]');
                
                $this->load->library('bcrypt');
                $data['Password'] = $this->bcrypt->hash_password($password);
                $run_validation = 1;
            }
            
            // Run validation if any of above condition is true
            if($run_validation)
            {
	            if ($this->form_validation->run() == FALSE) 
	            {
                    $this->session->set_flashdata('requestMsgErr', validation_errors());

                    redirect($this->thisCtrl . '/profile');
                }
            }
            
            $data = array(
			   'User_ID' => $userid,
               'Fullname' => $this->input->post('name')
			);
			
			if ($check_chng_img >= 0) 
            {
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_users_dir']);
                if ($file) 
                {
                    $data['Picture'] = substr($file, strrpos($file, '/') + 1);
                    $this->session->set_userdata($this->acp_session->picture(), $data['Picture']);
                }
            }
            
	        $result = $this->admin_model->updateUser($data);
		            
		    if($result){
	            $this->session->set_flashdata('requestMsgSucc',126);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		
		redirect($this->thisCtrl.'/profile');
	}
	
	// #dashboard function
	public function dashboard()
	{
		foreach($_SESSION['permissions'] as $key => $permission) 
		{ 
			//echo "<pre>"; print_r($permission);exit;

			if($permission['Page_id']==1) 
			{
				$_SESSION['pages_flags'] = $permission;
			}

			if($permission['Page_id']==2) 
			{
				$_SESSION['customers_flags'] = $permission;
			}

			if($permission['Page_id']==3) 
			{
				$_SESSION['trips_flags'] = $permission;
			}

			if($permission['Page_id']==4) 
			{
				$_SESSION['reservations_flags'] = $permission;
			}

			if($permission['Page_id']==5) 
			{
				$_SESSION['companies_flags'] = $permission ;
			}

			if($permission['Page_id']==6) 
			{
				$_SESSION['partners_flags'] = $permission ;
			}

			if($permission['Page_id']==7) 
			{
				$_SESSION['joinpartners_flags'] = $permission ;
			}

			if($permission['Page_id']==8) 
			{
				$_SESSION['notifications_flags'] = $permission ;
			}		
		}

		$data['total'] = $this->admin_model->getTotals();
		$this->LoadView('dashboard', $data);
	}
	
	// #reports function
	public function reports()
	{
		$data = $this->input->post() ;


		if($data)
		{
			$_SESSION['from_date'] = $data['from_date'] ;
			$_SESSION['to_date']   = $data['to_date']   ;
		}
		else
		{
			$_SESSION['from_date'] = date('Y-m').'-01'  ;
			$_SESSION['to_date']   = date('Y-m').'-31'  ;
		}

		$datetime1 = new DateTime($_SESSION['from_date']) ;
		$datetime2 = new DateTime($_SESSION['to_date'])   ;

		$difference = $datetime1->diff($datetime2);

		//echo $difference->m;exit;

		if($difference->m>=1)
		{
			$_SESSION['month_flag'] = 1 ; 
		}
		else
		{
			unset($_SESSION['month_flag']) ;
		}

		$data['total_sales'] = $this->admin_model->getTotalSales();

		$this->LoadView('reports', $data);
	}
	
	public function getStoreTotalIncome()
	{
		$data = $this->admin_model->getStoreTotalIncome() ;
		echo json_encode($data);
	}
	
	public function getMostOrderedProducts()
	{
		$data = $this->admin_model->getMostOrderedProducts();
		echo json_encode($data);
	}
	
	public function getHighTripCompanies()
	{
		$data = $this->admin_model->getHighTripCompanies();
		echo json_encode($data);
	}
	
	public function styles()
	{
		$this->LoadView('styles', '');
	}
	
	/*-----------------------------------------------------------
		---------------------- ABOUT US Section -----------------
		--------------------------------------------------------*/
	
	// #aboutus function
	public function aboutus($data = null){
		$data['company'] = $this->admin_model->getCompanyDetails();
		$this->LoadView('about-us/section_aboutus', $data);
	}
	
	// #aboutus-details function
	public function aboutCompanyDetails()
	{
		if($this->input->post('submit')){
			$content_en = $this->input->post('editor1');
			$content_ar = $this->input->post('editor2');

			$result = '';
            $insertData = array(
				'Content_en' => $content_en,
				'Content_ar' => $content_ar,
				'Video_Link' => $this->input->post('showreel'),
				'Status'	 => $this->input->post('show') // to show/hide youtube video
			);
			$result = $this->admin_model->editCompanyDetails($insertData);

	         if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
	        
	    }
	    
	    redirect($this->thisCtrl.'/aboutus');
	}
	
	public function terms_conditions(){
		$data['wbs'] = $this->admin_model->getSettings();
		$this->LoadView('about-us/terms-condition', $data);
	}
	
	public function updateTermsCondition(){
		if($this->input->post('submit')){
			$terms_en = $this->input->post('editor1');
			$terms_ar = $this->input->post('editor2');
			$data = array(
				'Terms_Conditions_en' => $terms_en,
				'Terms_Conditions_ar' => $terms_ar
			);
			$result = $this->admin_model->updateSettings($data);
			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		redirect($this->thisCtrl.'/terms_conditions');
	}
	
	public function privacy_policy(){
		$data['wbs'] = $this->admin_model->getSettings();
		$this->LoadView('about-us/privacy-policy', $data);
	}
	
	public function updatePrivacyPolicy(){
		if($this->input->post('submit')){
			$terms_en = $this->input->post('editor1');
			$terms_ar = $this->input->post('editor2');
			$data = array(
				'Privacy_Policy_en' => $terms_en,
				'Privacy_Policy_ar' => $terms_ar
			);
			$result = $this->admin_model->updateSettings($data);
			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		redirect($this->thisCtrl.'/privacy_policy');
	}
	
	public function productReviews(){
		$this->LoadView('products/product_reviews');
	}
	
	/*-----------------------------------------------------------
		---------------------- SERVICES Section -----------------
		--------------------------------------------------------*/
	
	// #service-view function
	public function services()
	{
		$this->LoadView('services/section_services', '');
	}
	
	// #add-service function
	public function addService(){
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id' => 0,
				'action_table' => 'service',
				'content' => $_POST,
				'event' => 'add'
			);

			$this->logs->add_log($log);
			
			$title_en   = $this->input->post('title_en');
			$content_en = $this->input->post('editor1');
			$title_ar   = $this->input->post('title_ar');
			$content_ar = $this->input->post('editor2');
			
			$check_chng_img = $this->input->post('check_chng_img');
			$s_icon = '' ;
			
			if ($check_chng_img >= 0) 
			{
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_services_dir']);
                if ($file) 
                {
                    $s_icon = substr($file, strrpos($file, '/') + 1) ;
                }
             }
							
			$insertData = array(
				'Title_en'   => $title_en,
				'Title_ar'   => $title_ar,
				'Content_en' => $content_en,
				'Content_ar' => $content_ar,
				'Icon' 		 => $s_icon
			);
		
			$result = $this->admin_model->addService($insertData);
	        
	         if($result){
	             $this->session->set_flashdata('requestMsgSucc', 121);
	         }
		}
		
		redirect($this->thisCtrl.'/manageServices');
	}
	
	// #manage-Services function
	public function manageServices(){
		$data['services'] = $this->admin_model->getServices();
		$this->LoadView('services/manage_services', $data);
	}
	
	// #edit service
	public function editService($servieID = null){
		$log = array(
			'row_id' => 0,
			'action_table' => 'service',
			'content' => $servieID,
			'event' => 'edit'
		);
		$this->logs->add_log($log);
		$data['service_id'] = $servieID;
		$data['service'] = $this->admin_model->getServiceByID($data);
		$this->LoadView('services/manage_services', $data);
	}
	
	// #update service
	public function updateService(){
		if($this->input->post('submit')){
			$log = array(
			'row_id' => 0,
			'action_table' => 'service',
			'content' => $_POST,
			'event' => 'update'
		);
		$this->logs->add_log($log);
			$id = $this->input->post('service_id');
			$title_en = $this->input->post('title_en');
			$content_en = $this->input->post('editor1');
			$title_ar = $this->input->post('title_ar');
			$content_ar = $this->input->post('editor2');
			
			$check_chng_img = $this->input->post('check_chng_img');
			$result = '';
			
			$updateData = array(
				'Service_ID' => $id,
				'Title_en' => $title_en,
				'Title_ar' => $title_ar,
				'Content_en' => $content_en,
				'Content_ar' => $content_ar
			);
			
			if ($check_chng_img >= 0) 
			{
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_services_dir']);
                if ($file) {
                    $updateData['Icon'] = substr($file, strrpos($file, '/') + 1);
                }
            }
							
			
				
			$result = $this->admin_model->updateService($updateData);
	         if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
		}
		redirect($this->thisCtrl.'/manageServices');
	}
	
	// #delete service function
	public function deleteService($servieID = null){
		$log = array(
			'row_id' => 0,
			'action_table' => 'service',
			'content' => $servieID,
			'event' => 'delete'
		);
		$this->logs->add_log($log);
		$data['service_id'] = $servieID;
		$result = $this->admin_model->deleteService($data);
		if($result){
	             $this->session->set_flashdata('requestMsgSucc', 122);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
			redirect($this->thisCtrl.'/manageServices');
	}
	
	/*-----------------------------------------------------------
		---------------------- Customers -----------------
		--------------------------------------------------------*/
		public function customers_list(){
			$this->LoadView('customers/customers_list');
		}
		
		public function customer_details($customer_id = 0)
		{
			$culture = $this->session->userdata($this->acp_session->__lang());
			$data['companies'] = $this->company->getCompanies($culture);
			
			$data['customer_id']    = $customer_id;
			$data['customer']       = $this->admin_model->getCustomerDetailsByID($customer_id);
			$data['family_members'] = $this->admin_model->getCustomerFamilyMembers($customer_id);

			$data['customer']->Customer_ID = $customer_id ;

			//echo "<pre>";print_r($data);exit;

			$this->LoadView('customers/customer_details', $data);
		}
		
		public function editCustomer($customer_id = 0){
			$data['customer_id'] = $customer_id;
			$data['customer'] = $this->admin_model->getCustomerByID($customer_id);
			$this->LoadView('customers/edit_customer', $data);
		}
		
		public function updateCustomer(){
			if ($this->input->post('submit')) {
	            $this->load->library('form_validation');
	            
	            //$oldPass = $this->input->post('oldPassword');
	            $password = $this->input->post('newPassword');
	            $customer_id = $this->input->post('customer_id');
	            
	            $data = array(
	                'Customer_ID' => $customer_id
	            );
	                    
	            
	            if (strlen($password) > 1) {
	                $this->form_validation->set_rules('newPassword', 'New Password', 'required|trim|min_length[3]|max_length[20]');
	                $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[newPassword]',
	                array('matches' => 232));
	                
	                if ($this->form_validation->run() == FALSE) {
	                    $this->session->set_flashdata('requestMsgErr', validation_errors());
	                    redirect($this->thisCtrl . '/editCustomer/'.$customer_id.'/');
	                } else {
		                
		                //check for old password
	                    $this->load->library('bcrypt');
	                    $result = $this->admin_model->check_customer_password($data);
						$password_ret = $result[0]->Password;
			            /*if (!$this->bcrypt->check_password($oldPass, $password_ret)) {
				            $this->session->set_flashdata('requestMsgErr', 333);
							redirect($this->thisCtrl . '/editCustomer/'.$customer_id.'/');
			            } */                   
						
						$data['Password'] = $this->bcrypt->hash_password($password);
	                }
	            }
	            
	            $result = '';     
	            $data['Fullname'] = $this->input->post('name');
	            $data['Address']  = $this->input->post('address');
	                          
	            $result  = $this->admin_model->updateCustomer($data);
	            
	            if ($result) {
	                $this->session->set_flashdata('requestMsgSucc', 123);
	            } else {
	                $this->session->set_flashdata('requestMsgErr', 119);
	            }
	            //} // END else validation 
	            
	        }
	       redirect($this->thisCtrl . '/editCustomer/'.$customer_id.'/');
		}
		
		public function deleteCustomer($customer_id = 0)
		{
			$result = $this->admin_model->deleteCustomer($customer_id);
			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 122);
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
			redirect($this->thisCtrl.'/manageServices');
		}
	
	/*-----------------------------------------------------------
		---------------------- #Faq -----------------
		--------------------------------------------------------*/
	public function faq(){
		$data['faq'] = $this->admin_model->getFaqs();
		$this->LoadView('faq/faq', $data);
	}
	
	public function addQuestion(){
		$this->LoadView('faq/add_question', '');
	}
	
	public function addNewQuestion(){
		if($this->input->post('submit')){
			$slug = url_title($this->input->post('title_ar'), '-', true);
	            
            $data = array(
	            'User_ID' => $this->session->userdata($this->acp_session->userid()),
	            'Title_en' => $this->input->post('title_en'),
	            'Answer_en' => $this->input->post('editor1'),
	            'Title_ar' => $this->input->post('title_ar'),
	            'Answer_ar' => $this->input->post('editor2'),
	            'Slug' => $slug
            );
            
/*
            $upload = $this->ImageUpload('faq_picture', $GLOBALS['img_faq_dir'], 800, 500);
            
	        if (is_array($upload) && array_key_exists('file_name', $upload))
	        {
				$file_name = $upload['file_name'];
				$data['Picture'] = $file_name;
	        }
*/
            
            $result = $this->admin_model->addQuestion($data);
            if($result){
				$this->session->set_flashdata('requestMsgSucc', 121);
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
            
		}
		 redirect($this->thisCtrl.'/faq');
	}

	public function editQuestion($id = 0){
		$data['question_id'] = $id;
		$data['question'] = $this->admin_model->getQuestionByID($id);
		$this->LoadView('faq/faq', $data);
	}
	
	public function updateQuestion(){
		if($this->input->post('submit')){
			$slug = url_title($this->input->post('title'), '-', true);
	            
            $data = array(
	            'Q_ID' => $this->input->post('question_id'),
	            'Title_en' => $this->input->post('title_en'),
	            'Answer_en' => $this->input->post('editor1'),
	            'Title_ar' => $this->input->post('title_ar'),
	            'Answer_ar' => $this->input->post('editor2'),
	            'Slug' => $slug
            );
            
/*
            $upload = $this->ImageUpload('faq_picture', $GLOBALS['img_faq_dir'], 800, 500);
	        if (is_array($upload) && array_key_exists('file_name', $upload))
	        {
				$file_name = $upload['file_name'];
				$data['Picture'] = $file_name;
	        }
*/
            
            $result = $this->admin_model->updateQuestion($data);
            if($result){
				$this->session->set_flashdata('requestMsgSucc', 120);
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
            
		}
		redirect($this->thisCtrl.'/faq');
	}
	
	

	public function deleteQuestion($id = null)
	{
		$data['Q_ID'] = $id;
		$result = $this->admin_model->deleteQuestion($data);
		if($result)
		{
	         $this->session->set_flashdata('requestMsgSucc', 122);
         } else {
             $this->session->set_flashdata('requestMsgErr', 119);
         }
		redirect($this->thisCtrl.'/faq');
	}
	
	
	/*-----------------------------------------------------------
		---------------------- WEBSITE SETTINGS -----------------
		--------------------------------------------------------*/
	//#settings
	
	public function settings(){
		$data['wbs'] = $this->admin_model->getSettings();
		$data['cc'] = $this->admin_model->getContacts();
		$this->LoadView('settings', $data);
	}
	
	public function updateSettings(){
		if($this->input->post('submit')){
			$log = array(
			'row_id' => 0,
			'action_table' => 'settings social media',
			'content' => $_POST,
			'event' => 'update'
		);
		$this->logs->add_log($log);
			$data = array(
				'Website_Title_en' => $this->input->post('website_title_en'),
				'Website_Title_ar' => $this->input->post('website_title_ar'),
				'Website_Desc_en' => $this->input->post('website_desc_en'),
				'Website_Desc_ar' => $this->input->post('website_desc_ar'),
				'SEO_Keyword_en' => $this->input->post('seo_keyword_en'),
				'SEO_Keyword_ar' => $this->input->post('seo_keyword_ar'),
				'Website_Email' => $this->input->post('website_email'),
				'Website_Status' => $this->input->post('Status'),
				'Website_Message_en' => $this->input->post('editor1'),
				'Website_Message_ar' => $this->input->post('editor2'),
				'SMTP_Email' => $this->input->post('smtp_email'),
				'SMTP_Password' => $this->input->post('smtp_password'),
				'IOS_link' => $this->input->post('ios'),
				'Android_link' => $this->input->post('android')
			);
			
			//update only when available #SENSITIVE
			if($this->input->post('website_language')){
				$data['Website_Language'] = $this->input->post('website_language');
			}
			
			$result = $this->admin_model->updateSettings($data);
			
			
		    $tw = $this->input->post('Twitter');
            $fb = $this->input->post('Facebook');
            $inst = $this->input->post('Instagram');
            $gp = $this->input->post('GooglePlus');
            $sc = $this->input->post('Snapchat');
            $ln = $this->input->post('LinkedIn');
            $yt = $this->input->post('Youtube');
            
            if(strlen($tw) > 1){
                $tw = 'https://twitter.com/'.$tw;
            }
            if(strlen($fb) > 1){
                $fb = 'https://facebook.com/'.$fb;
            }
            if(strlen($inst) > 1){
                $inst = 'https://instagram.com/'.$inst;
            }
            if(strlen($gp) > 1){
                $gp = 'https://plus.google.com/'.$gp;
            }
            if(strlen($sc) > 1){
                $sc = 'https://snapchat.com/add/'.$sc;
            }
            if(strlen($ln) > 1){
                $ln = 'https://linkedin.com/'.$ln;
            }
            if(strlen($yt) > 1){
                $yt = 'https://youtube.com/channel/'.$yt;
            }
            
            // update social links
            $social  = array(
                'Twitter' => $tw,
                'Facebook' => $fb,
                'Instagram' => $inst,
                'Snapchat' => $sc,
                'GooglePlus' => $gp,
                'LinkedIn' => $ln,
                'Youtube' => $yt
            );
			
			$result = $this->admin_model->updateContactus($social);
			
			 if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
		}
		redirect($this->thisCtrl.'/settings');
	}
	
	
	/*-----------------------------------------------------------
		---------------------- Company Address -----------------
		--------------------------------------------------------*/
	// #Company Address
	public function contactus(){
		$data['wbs'] = $this->admin_model->getContacts();
		$data['markers'] = $this->admin_model->getMarkers();
		$this->LoadView('contact-us/section_contactus', $data);
	}
	
	public function updateAddress(){
		if($this->input->post('submit')){
			
			$log = array(
			'row_id' => 0,
			'action_table' => 'contact',
			'content' => $_POST,
			'event' => 'update'
		);
		$this->logs->add_log($log);
			
			$data = array(
				'Company_Address_en' => $this->input->post('editor1'),
				'Company_Address_ar' => $this->input->post('editor2')
			);
			 $result = $this->admin_model->updateContactus($data);
			 if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	
		}
		redirect($this->thisCtrl.'/contactus');
	}
	
	public function saveLocation(){
		$data = array(
			'Address' => $this->input->post('address'),
			'lat' => $this->input->post('latitude'),
			'lng' => $this->input->post('longitude')
		);
		echo $this->admin_model->saveLocation($data);
	}
	
	public function deleteLocation(){
		$data = array(
			'lat' => $this->input->post('lat'),
			'lng' => $this->input->post('lng')
		);
		echo $this->admin_model->deleteLocation($data);
	}
	
	/* -----------------------------------------------------------
		---------------------- Background Slider Section -------
		--------------------------------------------------------*/
	public function slider(){
		$data['slides'] = $this->admin_model->getSlides();
		$this->LoadView('slider/home_slider', $data);
	}
	
	public function new_slide()
	{
		$this->LoadView('slider/add_slide');
	}
	
	public function editSlide($slideid = 0){
		$log = array(
			'row_id' => 0,
			'action_table' => 'slide',
			'content' => $slideid,
			'event' => 'edit'
		);
		$this->logs->add_log($log);
		$data['slide_id'] = $slideid;
		$data['slide'] = $this->admin_model->getSlideByID($data);
		$this->LoadView('slider/home_slider', $data);
	}
	
	public function addNewSlide()
	{
		if($this->input->post('submit')){
			$log = array(
				'row_id' => 0,
				'action_table' => 'slide',
				'content' => $_POST,
				'event' => 'add'
			);
			$this->logs->add_log($log);
			
			// image options
			$image_options = array(
				'file' => 'slide_picture',
				'directory' => $GLOBALS['img_slides_dir'],
				'max_width' => 1920,
				'file_name' => date('Y-m-d H-i-s').'-slider'
			);
			
			$upload = UploadFile($image_options);
			if(!is_array($upload) && !array_key_exists('file_name', $upload)){
				 $this->session->set_flashdata('requestMsgErr', $upload);
				 redirect($this->thisCtrl.'/addNewSlide');
				 
			} else {
				
				$file_name = $upload['file_name'];
				$data = array(
					'Title_en' => $this->input->post('title_en'),
					'Title_ar' => $this->input->post('title_ar'),
					'Slide_Caption_en' => $this->input->post('caption_en'),
					'Slide_Caption_ar' => $this->input->post('caption_ar'),
					'Slide_Image' => $file_name,
					'Target_Link' => $this->input->post('link')
				);
				
				$result = $this->admin_model->addSlide($data);
				if($result){
		             $this->session->set_flashdata('requestMsgSucc', 121);
		         } else {
		             $this->session->set_flashdata('requestMsgErr', 119);
		         }
		         
			} // end else
			
		}
		redirect($this->thisCtrl.'/slider');
	}
	
	public function updateSlide(){
		if($this->input->post('submit')){
			$log = array(
				'row_id' => 0,
				'action_table' => 'slide',
				'content' => $_POST,
				'event' => 'update'
			);
		$this->logs->add_log($log);
			$id = $this->input->post('slide_id');
			$title_en = $this->input->post('title_en');
			$title_ar = $this->input->post('title_ar');
			
			// image options
			$image_options = array(
				'file' => 'slide_picture',
				'directory' => $GLOBALS['img_slides_dir'],
				'max_width' => 1920,
				'file_name' => date('Y-m-d H-i-s').'-slider'
			);
			
			$upload = UploadFile($image_options);
			$updateData = array(
				'Slide_ID' => $id,
				'Title_en' => $title_en,
				'Title_ar' => $title_ar,
				'Slide_Caption_en' => $this->input->post('caption_en'),
				'Slide_Caption_ar' => $this->input->post('caption_ar'),
				'Target_Link' => $this->input->post('link')
			);
			
	        if (is_array($upload) && array_key_exists('file_name', $upload))
	        {
				$file_name = $upload['file_name'];
				$updateData['Slide_Image'] = $file_name;
	        }
	        
	        $result = $this->admin_model->updateSlide($updateData);
	        
	         if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
		}
		
		redirect($this->thisCtrl.'/slider');
	}	
	
	public function deleteSlide($slideid = 0){
		$log = array(
			'row_id' => 0,
			'action_table' => 'slide',
			'content' => $slideid,
			'event' => 'delete'
		);
		$this->logs->add_log($log);
		$data['Slide_ID'] = $slideid;
		$result = $this->admin_model->deleteSlide($data);
		if($result){
             $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
             $this->session->set_flashdata('requestMsgErr', 119);
        }
	    redirect($this->thisCtrl.'/slider');
	}
		
			/*-----------------------------------------------------------
		---------------------- USER MANAGEMENT -----------------
		--------------------------------------------------------*/
		
	public function createUser(){
		$data['roles'] = $this->admin_model->getRoles();
		$this->LoadView('users/create_user', $data);
		}
		
	public function addUser()
	{
		if($this->input->post('submit'))
		{
			$log = array(
							'row_id' => 0,
							'action_table' => 'user',
							'content' => $_POST,
							'event' => 'add'
						);

			$this->logs->add_log($log);
			$this->load->library('form_validation');
			$result = '';
			
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|max_length[20]|required', array('min_length' => 278));
            $this->form_validation->set_rules('username', 'Email', 'trim|valid_email|is_unique['.TBL_USERS.'.Username]|required',array('is_unique' => 287));
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('requestMsgErr', validation_errors());
				redirect($this->thisCtrl.'/createUser');
			}
				
			$password = $this->input->post('password');
			$this->load->library('bcrypt');
		 	
		 	$data = array(
						 	'Fullname' => $this->input->post('name'),
						 	'Username' => $this->input->post('username'),
						 	'Password' => $this->bcrypt->hash_password($password)
					 	);
		 	
		 	if($this->input->post('role')){
			 	$data['Role_ID'] = $this->input->post('role');
		 	}
		 	
		 	$result = $this->admin_model->addUser($data);

			if($result)
			{
	            $this->session->set_flashdata('requestMsgSucc', 123);
	        } 
	        else 
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
			
		}
		redirect($this->thisCtrl.'/manageUsers');
	}

	public function manageUsers()
	{
		/*if($this->session->userdata($this->acp_session->role()) == 'super_admin')
		{
			$data['users'] = $this->admin_model->getAllUsers_ADM();
		} 
		else 
		{*/
			$data['users'] = $this->admin_model->getAllUsers();
		/*}*/

		//echo "<pre>"; print_r($data);exit;

		$this->LoadView('users/manage_users', $data);
	}
	
	public function editUser($userId = 0){
		$log = array(
			'row_id' => 0,
			'action_table' => 'user',
			'content' => $userId,
			'event' => 'edit'
		);
		$this->logs->add_log($log);
		$data['user_id'] = $userId;
		$data['user']  = $this->admin_model->getUser($data);
		$data['roles'] = $this->admin_model->getRoles();
		$this->LoadView('users/manage_users', $data);
	}
		
	// #update user function 
	public function updateUser()
	{
		if($this->input->post('submit'))
		{
				$log = array(
				'row_id' => 0,
				'action_table' => 'user',
				'content' => $_POST,
				'event' => 'update'
			);
			$this->logs->add_log($log);
			
			$this->load->library('form_validation');
			
			$userid        = $this->input->post('user_id');
            $password      = $this->input->post('password');
            $current_email = $this->input->post('old_email');
            $field_email   = $this->input->post('username');
            $role          = $this->input->post('role');
            
            $run_validation = 0;
            $email_change_request = 0;
            if($field_email != $current_email)
            {
	            
	            $this->form_validation->set_rules('username', 'Email Address', 'required|valid_email|xss_clean|is_unique['.TBL_USERS.'.Username]',
            array('is_unique' => 287));
            
            	$run_validation = 1;
				$email_change_request = 1;
            }
            
            // check password
            if(strlen($password) > 1)
            {
	            $this->form_validation->set_rules('password', 'New Password', 'required|trim|min_length[3]|max_length[20]');
                
                $this->load->library('bcrypt');
                $data['Password'] = $this->bcrypt->hash_password($password);
                $run_validation = 1;
            }
            
            // Run validation if any of above condition is true
            if($run_validation)
            {
	            if ($this->form_validation->run() == FALSE) 
	            {
                    $this->session->set_flashdata('requestMsgErr', validation_errors());

                    redirect($this->thisCtrl . '/editUser/'.$userid);
                }
            }
            

            $data['User_ID']   = $userid ;
            $data['Fullname']  = $this->input->post('name') ;
            $data['Role_ID']   = $role ;
            
            $result = $this->admin_model->updateUser($data);
       
		     if($result)
		     {
	             $this->session->set_flashdata('requestMsgSucc',126);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
			 
		}
		
		redirect($this->thisCtrl.'/manageUsers');
	}	
		
	public function deleteUser($userid){
		$log = array(
			'row_id' => 0,
			'action_table' => 'user',
			'content' => $userid,
			'event' => 'delete'
		);
		$this->logs->add_log($log);
			$data['User_ID'] = $userid;
			$result = $this->admin_model->deleteUser($data);
			 if($result){
	             $this->session->set_flashdata('requestMsgSucc', 122);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
		         redirect($this->thisCtrl.'/manageUsers');
		}
		
			/*-----------------------------------------------------------
		---------------------- SHOWREEL -----------------
		--------------------------------------------------------*/
		
	public function showreel(){
		$data['showreel'] = $this->admin_model->getShowreel();
		$this->LoadView("showreel/section_showreel", $data);
	}
	
	public function updateShowreel(){
		if($this->input->post('submit')){
			$data = array(
				'Video_Url' => $this->input->post('showreel')
			);
			$result = $this->admin_model->updateShowreel($data);
			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 176);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
		}
		redirect($this->thisCtrl.'/showreel');
	}
	
	/*-----------------------------------------------------------
		---------------------- #Appointments -----------------
		--------------------------------------------------------*/
	
	public function filterAppointments(){
		if($this->input->post('submit')){
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'no' => $this->input->post('no'),
				'date' => $this->input->post('date'),
				'status' => $this->input->post('app_status')
			);
			
			$result['appointments'] = $this->admin_model->filterAppointments($data);
			$this->SearchAppointments($result);
		} else {
			redirect($this->thisCtrl.'/viewAllAppointments');
		}
	}
	public function SearchAppointments($data = ''){
		$data['section_detail'] = $this->admin_model->getAppointmentsSection();
		$this->LoadView('view_all_appointments', $data);
	}
	
	public function viewAllBookings(){
		$data['section_detail'] = $this->admin_model->getAppointmentsSection();
		$data['appointments'] = $this->admin_model->getAllAppointments();
		$this->LoadView('view_all_appointments', $data);
	}
	
	public function ChangeAppointmentStatus(){
		$data = array(
			'Id' => $this->input->post('id'),
			'Status' => $this->input->post('status')
		);
		
		$user = $this->admin_model->getRequestedUserEmail($data);
		
		$email = $user[0]->Email;
		$name = $user[0]->Name;
		$status = $this->input->post('status');
		
		// send email
		$this->SendEmailAppointmentStatus($email, $name, $status);
		
		echo $this->admin_model->changeAppointmentStatus($data);
	}
	
	// email template
	public function SendEmailAppointmentStatus($email = '', $name = '', $status = ''){
		$subject = 'Appointment Status';
		$temp = array(
			'name' => $user[0]->Name,
			'status' => $this->input->post('status')
		);
		$this->load->library('parser');
		$message = $this->parser->parse('admin/acp_includes/email/appointment-status', $temp, TRUE);
		
		return $this->SendEmail($email, $message, $subject);
	}
	
	/*-----------------------------------------------------------
		---------------------- #SMS -----------------
		--------------------------------------------------------*/
		public function sms(){
			$this->LoadView('sms/send_sms', '');
		}
		
		public function sms_log(){
			$this->LoadView('sms/sms_log', '');
		}
		
		public function sendSMS(){
			if($this->input->post('submit')){
				
				$number = $this->input->post('number');
				$message = $this->input->post('message');
				
				$data = array(
					'Number' => $number,
					'Message' => $message,
					'User_ID' => $this->session->userdata($this->sessObj->userid)
				);
				
				$sms_result = $this->sendsmsTo($number, $message);
				$sms_result = json_decode($sms_result);
				
				//print_r($sms_result);
				//die();
								
				$a1 = explode('|', $sms_result->Status);
				$status = explode(':', $a1[1]);
				
				// if sms sent then update in database
				if(strtolower(trim($status[1])) == 'success'){
				
					$result = $this->admin_model->sendSMS($data);
					if($result){
			             $this->session->set_flashdata('requestMsgSucc', 394);
			         } else {
			             $this->session->set_flashdata('requestMsgErr', 119);
			         }
		        } else {
			         $this->session->set_flashdata('requestMsgErr', 119);
		        }
			}
			redirect($this->thisCtrl.'/sms');
		}
		
	
	/*-----------------------------------------------------------
		---------------------- Help and support -----------------
		--------------------------------------------------------*/
	
	public function helpAndSupport()
	{
		$this->LoadView('help-support/help-support', '');
	}
	
	public function submitTicket()
	{
		$this->load->library('curl');
		$file_name = '';
		$upload = $this->ImageUpload('help_support_file', $GLOBALS['img_ck_dir'], 0, 0, 1000); // upload image
        if (is_array($upload) && array_key_exists('file_name', $upload)) {
	        $file_name = $upload['file_name'];
        }

		$post = [
			'user' => $this->session->userdata($this->acp_session->username()),
			'email' => $this->session->userdata($this->acp_session->email()),
			'userid' => $this->session->userdata($this->acp_session->userid()),
			'host' => $_SERVER['HTTP_HOST'],
			'title' => $this->input->post('title'),
			'category' => $this->input->post('category'),
			'message' => $this->input->post('message'),
			'file' => $file_name
		];
		//echo "<pre>"; print_r($post);exit;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://dnet.sa/hcm/help/helpSupport");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$server_output = curl_exec ($ch);
		
		curl_close ($ch);
		
		// further processing ....
		if ($server_output) { 
			$this->session->set_flashdata('success', 1);
		} else { 
			$this->session->set_flashdata('error', 1);
		}
		redirect($this->thisCtrl."/helpAndSupport");
	}
	
	public function view_ticket($ticket = 0){
		$this->load->library('curl'); 
		$result['ticket'] = json_decode($this->curl->simple_get('https://dnet.sa/hcm/help/view_ticket/'.$ticket));
		$this->LoadView('help-support/view-ticket', $result);
	}
	
	private function sendsmsTo($number = 0, $message = ''){
		$this->load->library("curl");
			
		$key ='966';
		$number = substr($number, -9);
		
		$number = $key.$number;
		
		$message = 'test message';
		
		$domain = preg_replace('/www\./i', '', $_SERVER['SERVER_NAME']);
		
		//for dnet.so we will use domain = DNet.sa
		$domain = 'dnet.sa';
		
		$url = 'https://dnet.sa/hcm/home/sendsms/';
		
		$data = array(
		    'domain' => $domain,
		    'number' => $number,
		    'message' => $message,
		    'sender' => 'DNet.sa'
		);

		$this->curl->create($url);			
		$this->curl->post($data);
				
		// Execute 
		$result = $this->curl->execute();
		return $result;
	}

}


?>