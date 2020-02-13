<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Company extends Base_Controller 
{
	
	// define controller
	protected $__ctrl = "acp_company";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->__ctrl));
    	
    	$this->load->model('company_model', 'company');
    	$this->load->model('admin_model', 'admin_model');
  	}
  	
  	/*-----------------------------------------------------------
		---------------------- Company -----------------
	--------------------------------------------------------*/
  	public function add_company($_data = array())
  	{
	  	$_data['countries'] = $this->company->getCountries();
	  	$this->LoadView('company/add_company', $_data);
  	}
  	
  	public function add_company_POST()
  	{
	  	if($this->input->post('submit'))
	  	{
		  	$this->load->library('form_validation');
            $result = '';
            
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|xss_clean|is_unique['.TBL_COMPANIES.'.Email]',
            array('is_unique' => 287));
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|required|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) 
            {
                $this->session->set_flashdata('requestMsgErr', validation_errors());
                $data['post'] = $_POST;
                $this->add_company($data);
                return true;
            }
            
            // validation success
            date_default_timezone_set('Asia/Riyadh');
			$this->load->library('bcrypt');
			$company = array(
				'Email' => $this->input->post('email'),
				'Password' => $this->bcrypt->hash_password($this->input->post('password')),
				'Company_Phone' => $this->input->post('company_phone'),
				'Company_Mobile' => $this->input->post('company_mobile'),
				'Company_Website' => $this->input->post('company_website'),
				'Country_ID' => $this->input->post('country_id'),
				'Registered_At' => date('Y-m-d H:i:s')
			);
			
			$check_chng_img = $this->input->post('check_chng_img');
			if ($check_chng_img >= 0) 
			{
                    //upload logo
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_companies_dir']);
                if ($file) 
                {
                    $company['Company_Logo'] = substr($file, strrpos($file, '/') + 1);
                }
            }
			
			$company_id = $this->company->addCompany($company);
			
			if($company_id)
			{
				$this->company->updateCompany(['Company_ID'=>$company_id,'sub_user_CompanyID'=>$company_id]) ;
			}

			//add localization to table
			$localized_company = array(
				array(
					'Company_ID' => $company_id,
					'Company_Name' => $this->input->post('company_name_en'),
					'Company_Description' => $this->input->post('description_en'),
					'Culture' => 'en'
				),
				array(
					'Company_ID' => $company_id,
					'Company_Name' => $this->input->post('company_name_ar'),
					'Company_Description' => $this->input->post('description_en'),
					'Culture' => 'ar'
				)
			);
			$l_insert = $this->company->addCompany_Localized($localized_company, $company_id);
			
			
			if($company_id)
			{
	            $this->session->set_flashdata('requestMsgSucc', 121);
	            
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
				
		} // if submitted
	
	  	redirect($this->__ctrl.'/companies_list');
  	}
  	
  	/* 
	  * Companies LIST
	*/
	public function companies_list()
	{
		$data['countries'] = $this->company->getCountries();
		$this->LoadView('company/companies_list', $data);
	}
	
	/* 
	  * Edit Company
	*/
	public function edit_company($company_id = 0)
	{
		$data['company'] = $this->company->getCompanyByID($company_id);

		$this->LoadView('company/edit_company', $data);
	}
	
	public function edit_company_POST()
	{
		if($this->input->post('submit'))
	  	{
		  	$this->load->library('form_validation');

		  	//echo "<pre>"; print_r($_POST);exit;
            
            $company_id = $this->input->post('company_id');
            $password   = $this->input->post('password');
            
            $company = array(
				                'Company_ID' => $company_id
				            );
            
            //Check if both email or phone is change check availability
            $field_email 	= $this->input->post('email');
            $old_email   	= $this->input->post('old_email');
            $run_validation = 0;
            
            // check email
            if($field_email != $old_email)
            {
	            
	            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|xss_clean|is_unique['.TBL_COMPANIES.'.Email]',array('is_unique' => 287));
            
            	$run_validation = 1;
            }
            
            // check password
            if(strlen($password) > 1)
            {
	            $this->form_validation->set_rules('password', 'New Password', 'required|trim|min_length[3]|max_length[20]');
	            
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
                
                $run_validation = 1;
            }

            // Run validation if any of above condition is true
            if($run_validation)
            {
	            if ($this->form_validation->run() == FALSE) 
	            {
                    $this->session->set_flashdata('requestMsgErr', validation_errors());
                    redirect($this->__ctrl . '/edit_company/'.$company_id);
                }
            }
         
            // check if password field length is change then update password
            if (strlen($password) > 1) 
            {
	            $this->load->library('bcrypt');
				$company['Password'] = $this->bcrypt->hash_password($password);
            }
            
            $check_chng_img = $this->input->post('check_chng_img');

			if ($check_chng_img >= 0)
			{
                //upload logo
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_companies_dir']);
                if ($file)
                {
                    $company['Company_Logo'] = substr($file, strrpos($file, '/') + 1);
                    $subuser['Company_Logo'] = substr($file, strrpos($file, '/') + 1);
                }
            }

            if($_FILES['Commercial_Certificate']['error']==0)
            {
    			$image_options = array(
										'file'          => 'Commercial_Certificate',
										'directory'     => $GLOBALS['img_companies_cr_dir'],
										'allowed_types' => '*',
										'file_name'     => 'Commercial_Certificate'
									);

				$upload = UploadFile($image_options);

				$company['Commercial_Certificate'] = $upload['file_name'] ;
				$subuser['Commercial_Certificate'] = $upload['file_name'] ;

				$company['CR'] = $upload['file_name'] ;
				$subuser['CR'] = $upload['file_name'] ;

				if($company['Commercial_Certificate'])
				{
					@ unlink($GLOBALS['img_companies_cc_dir'].$this->input->post('old_certificate')) ;
					@ unlink($GLOBALS['img_companies_cr_dir'].$this->input->post('old_certificate')) ;
				}
            }
            else
            {
            	if($this->input->post('old_certificate'))
            	{
            		$company['Commercial_Certificate'] = $this->input->post('old_certificate') ;
            		$subuser['Commercial_Certificate'] = $this->input->post('old_certificate') ;
            	}
            }

            $expiry_date = $this->input->post('expiry_date');
            $expiry_date = date('Y-m-d',strtotime($expiry_date));

            //Depend both expiry_date and status when expiry date updated
            $expiry_stamp = strtotime($expiry_date);
            $today_stamp  = strtotime(date('Y-m-d'));

            $subuser['Status']  = $this->input->post('Status');
			$company['Status'] 	= $this->input->post('Status');

            if($expiry_stamp<=$today_stamp)
            {
				$subuser['Status']  = 0 ; //$this->input->post('Status');
				$company['Status'] 	= 0 ; //$this->input->post('Status');
            }

			$company['Email'] 			 = $this->input->post('email');
			$company['Company_Phone']    = $this->input->post('company_phone');
			$company['Company_Mobile']   = $this->input->post('company_mobile');
			$company['Company_Website']  = $this->input->post('company_website');
			$company['expiry_date']  	 = $expiry_date ;
			$company['Country_ID'] 	     = $this->input->post('country_id');

			$subuser['Company_Website'] = $this->input->post('company_website');
			$subuser['expiry_date']     = $expiry_date ;

            $result  = $this->company->updateCompany($company);
            
            if($result)
            {
            	//Sending Email after trip is saved in database
            	$integrate['status'] = $company['Status'] ;
            	$integrate['email']  = $company['Email']  ;

            	$send['subject'] = 'Account Activation' ;

		        $send['message'] = $this->load->view('accountactivation_email_template',$integrate,True) ;

		        $send['to']   = $integrate['email'] ;

		        SendEmail($send); 
            }

            //add localization to table
			$localized_company = array(
				array(
					'Company_ID' => $company_id,
					'Company_Name' => $this->input->post('company_name_en'),
					'Company_Description' => $this->input->post('description_en'),
					'Culture' => 'en'
				),
				array(
					'Company_ID' => $company_id,
					'Company_Name' => $this->input->post('company_name_ar'),
					'Company_Description' => $this->input->post('description_en'),
					'Culture' => 'ar'
				)
			);
			$l_insert = $this->company->addCompany_Localized($localized_company, $company_id);

			//Update all these data to subusers
			if($result)
			{
				$where['sub_user_CompanyID'] = $company_id ;
				$where['sub_userflag'] = 1 ;

				$subusers = $this->company->getSubUsers($where);

				$update_flag = $this->company->updateSubUser($subuser,$where) ;
			}

		  	if($result)
			{
	            $this->session->set_flashdata('requestMsgSucc', 120);
	        } 
	        else 
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		  	
	  	}
	  	redirect($this->__ctrl.'/companies_list');
	}
	
	/* 
	  * Delete Company
	*/
	public function delete_company($company_id = 0)
	{
		//$company = $this->company->getCompanyImages($company_id);
		$company = $this->company->getCompany($company_id);

		//foreach($company as $cmp)
		//{
	       @ unlink('./'.$GLOBALS['img_companies_dir'].$cmp->Company_Logo);
	       @ unlink('./'.$GLOBALS['img_companies_cc_dir'].$cmp->Commercial_Certificate);
	       @ unlink('./'.$GLOBALS['img_companies_cc_dir'].$cmp->Commercial_Certificate);
	       @ unlink('./'.$GLOBALS['img_companies_cr_dir'].$cmp->CR);
        //}
		
		$result = $this->company->deleteCompany($company_id);
		if($result)
		{
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->__ctrl.'/companies_list');
	}
	
	public function login_to_company($company_id = 0)
	{
		// set `CP` SESSION here
		$this->load->library('Cmp_Session');
		$company = $this->company->getCompanyByID($company_id);
		
		//echo "<pre>";print_r($company);exit;

		$company_name = '';
		foreach($company as $c)
		{
			if($c->Culture == $this->session->userdata($this->acp_session->__lang())) { $company_name = $c->Company_Name; }
		}

		if(count($company))
		{
			$sess_data = array(
								$this->cmp_session->userid() 	=> $company[0]->Company_ID,
								$this->cmp_session->username() 	=> $company_name,
								$this->cmp_session->company_sub_user()      => $company[0]->sub_user_CompanyID,
								$this->cmp_session->company_subuser_flag()  => $company[0]->sub_userflag,
								$this->cmp_session->email() 	=> $company[0]->Email,
								$this->cmp_session->role() 	  	=> $company[0]->Role,
								$this->cmp_session->role_id() 	=> $company[0]->Role_ID,
								$this->cmp_session->picture() 	=> $company[0]->Picture
							);

			$this->session->set_userdata($sess_data);
			redirect('cp/dashboard');
		}
		
		redirect($this->__ctrl.'/companies_list');
	}
	
	/**------------------------------------------------------
	  ---------------- Companies List Datatable ------------
	 -----------------------------------------------------**/
  	
  	public function getCompaniesList()
  	{
	  	$this->load->library('parser');
	  	
	  	$culture = $this->session->userdata($this->acp_session->__lang());
	  	
		$companies = $this->company->getCompaniesList($culture);

		$data = array();
		$no   = $_POST['start'];
		$i    = 0;
		
		foreach ($companies as $company) 
		{
			$no++;
			$i++;
			
			$dt = new DateTime($company->Registered_At);
			$date = $dt->format('d-m-Y');
			
			//image
			$company_logo = '';
			if(strlen($company->Company_Logo) > 0)
			{
				$company_logo = '<img src="'.base_url($GLOBALS['img_companies_dir'].$company->Company_Logo).'" style="width: 60px">';
			} else {
				$company_logo = '<img src="'.base_url('style/acp/img/placeholder.png').'" style="width: 60px">';
			}
			
			
			$campaigns_url = base_url($this->__ctrl.'/campaigns_list/'.$company->Company_ID);
			$action_data = array(
									'edit_url' => base_url($this->__ctrl.'/edit_company/'.$company->Company_ID),
									'login_url' => base_url($this->__ctrl.'/login_to_company/'.$company->Company_ID),
									'campaigns_url' => $campaigns_url,
									'bookings_url' => base_url($this->__ctrl.'/company_campaigns_bookings/'.$company->Company_ID),
									'payments' => base_url($this->__ctrl.'/Payments_List/'.$company->Company_ID),
									'delete_url' => base_url($this->__ctrl.'/delete_company/'.$company->Company_ID)
								);
			
			// actions template
			$actions = ''.$this->parser->parse('company/snippets/actions-template', $action_data, TRUE);
			
			//customer status template
			$status_chk = '';
			$status_not_chk = '';
			if($company->Status) { $status_chk = 'checked'; }
			if(!$company->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$company->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					  </div>';
			
			$row = array();
			$row[] = $company->Company_ID;
			$row[] = $date;
			$row[] = $company_logo;
			$row[] = $company->Company_Name;
			$row[] = $company->Email;
			$row[] = $company->Company_Mobile;
			$row[] = '<a href="'.$campaigns_url.'" style="display:block">'.$company->TotalCampaigns.'</a>';
			$row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
			
		} // end foreach
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->company->companiesCount_all(),
			"recordsFiltered" => $this->company->companiesCount_filtered($culture),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
  	}
	
	/*-----------------------------------------------------------
	---------------------- Campaigns List -----------------
	--------------------------------------------------------*/
	
	public function campaigns_list($company_id = 0)
	{
		$data['companies'] = $this->company->getCompanies();
		$data['company_id'] = $company_id;
		$this->LoadView('company/campaigns/campaigns_list', $data);
	}
	
	public function campaign_details($campaign_id = 0)
	{
		$culture = $this->session->userdata($this->acp_session->__lang());
		$data['campaign'] = $this->company->getCampaignByID($campaign_id, $culture);
		$data['pictures'] = $this->company->getCampaignPictures($campaign_id);

		//echo "<pre>"; print_r($data);exit;

		$this->LoadView('company/campaigns/campaign_details', $data);
	}
	
	public function getCampaignsList()
  	{
	  	$this->load->library('parser');
	  	
	  	$culture = $this->session->userdata($this->acp_session->__lang());
	  	
		$campaigns = $this->company->getCampaignsList($culture);
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		$cities = $this->getCities();
		
		foreach ($campaigns as $campaign) 
		{
			$no++ ;
			$i++  ;
			
			$dt = new DateTime($campaign->Created_At);
			$date = $dt->format('d-m-Y');
			
			$bookings_url = base_url('acp/reservations/reservations_list/'.$campaign->Campaign_ID);
			$action_data = array(
				'details_url' => base_url($this->__ctrl.'/campaign_details/'.$campaign->Campaign_ID),
				'bookings_url' => $bookings_url,
				'edit_trip' => base_url($this->__ctrl.'/edit_campaign/'.$campaign->Campaign_ID),
				'login_url' => base_url($this->__ctrl.'/login_to_company/'.$campaign->Company_ID)
			);
			
			// actions template
			$actions = ''.$this->parser->parse('company/campaigns/snippets/actions-template', $action_data, TRUE);
			
			//customer status template
			$status_chk = '';
			$status_not_chk = '';
			if($campaign->Status) { $status_chk = 'checked'; }
			if(!$campaign->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$campaign->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					  </div>';	
			
			$from_date = new DateTime($campaign->From_Date);
            $to_date = new DateTime($campaign->To_Date);
			
			$row = array();
			$row[] = $campaign->Campaign_ID;
			$row[] = $date;
			$row[] = $campaign->Campaign_Name;
			$row[] = $campaign->Company_Name;
			//$row[] = getSystemString("{$campaign->Campaign_Type}");
			$row[] = $campaign->City;
			$row[] = $from_date->format('d-m-Y');
			$row[] = $to_date->format('d-m-Y');
			$row[] = '<a href="'.$bookings_url.'" style="display:block">'.$campaign->Total_Reservations.'</a>';
			$row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
			
		} // end foreach
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->company->campaignsCount_all(),
			"recordsFiltered" => $this->company->campaignsCount_filtered($culture),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
  	}

	public function edit_campaign($campaign_id = 0)
	{
		// note: added by A to display the list of servies added by Admin
        $data['list'] = $this->admin_model->getAllServciesList();

		$data['pictures'] = $this->company->getCampaignPictures($campaign_id);
		$data['campaign'] = $this->company->getCampaignByID($campaign_id);

	    $data['campaign']->Services = explode(',',$data['campaign']->Services);
	    $data['campaign']->Responsiblity = json_decode($data['campaign']->Responsiblity,True);
		$data['campaign']->Meeting_Point = json_decode($data['campaign']->Meeting_Point,True);

		//echo "<pre>"; print_r($data);exit;

		$this->LoadView('company/campaigns/edit_campaign', $data);
		
	}

	public function edit_campaign_POST()
	{
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id' => 0,
				'action_table' => 'campaign',
				'content' => $_POST,
				'event' => 'add'
			);
			$this->logs->add_log($log);
			
			// extra check for campaign
			$campaign_id = $this->input->post('campaign_id');
			$campaign = $this->company->getCampaignByID($campaign_id);


			//echo "<pre>";print_r($campaign);exit;            

            //Charges For Push Notification
			$pushnotfication_flag = (@$this->input->post('push_notification')) ? 1 : 0 ;
			$notif_charges = ($pushnotfication_flag) ? 50 : 0 ;

			//Charges for Featured Trips
			$featured_trip = (@$this->input->post('featured_trip')) ? 1 : 0 ;
			$featured_charges = ($featured_trip) ? 50 : 0 ;

			//More Features
			$more_features  = (@$this->input->post('more_features')) ? 1 : 0 ;
			$other_features = $this->input->post('other_features');
			$other_features_charges = $this->input->post('other_features_charges');

			//Responsible Persons
			$Responsiblity = json_encode([$this->input->post('rp1'),$this->input->post('rp2')]);

            $from_date = new DateTime($this->input->post('fromdate'));
            $to_date = new DateTime($this->input->post('todate'));

	        //Create Meeting Point
	            $m_address   = $this->input->post('address2') ;
	            $m_country   = $this->input->post('country2') ;
	            $m_city      = $this->input->post('city2') ;
	            $m_region    = $this->input->post('region2') ;
	            $m_latitude  = $this->input->post('latitude2') ;
	            $m_longitude = $this->input->post('longitude2') ;


	            $Meeting_Point = json_encode([
	            								'address'   => $m_address,
	            								'country'   => $m_country,
	            								'city'      => $m_city,
	            								'region'    => $m_region,
	            								'latitude'  => $m_latitude,
	            								'longitude' => $m_longitude,
	            							]);	


            $campaign = array(
					            'Campaign_ID' 	=> $campaign_id,
				                'Campaign_Type' => 'empty' , //$this->input->post('type'),
				                'Country' 		=> $this->input->post('country'),
				                'City' 			=> $this->input->post('city'),
				                'Region' 		=> $this->input->post('region'),
				                'Address' 		=> $this->input->post('address'),
				                'Building_Info' => $this->input->post('building_info'),
				                'Location'      => $this->input->post('latitude').','.$this->input->post('longitude'),
				                'Meeting_Point' => $Meeting_Point,
				                'From_Date' 	=> $from_date->format('Y-m-d'),
				                'To_Date' 		=> $to_date->format('Y-m-d'),
								'Start_Time' 	=> $this->input->post('start_time'),
								'End_Time' 		=> $this->input->post('end_time'),
				                'Total_Days' 	=> $this->input->post('duration'),
				                'Duration_Type' => $this->input->post('duration_type'),
				                'Amount_Person' => $this->input->post('amount_person'),
				                'Amount_child'  => $this->input->post('amount_child'),
				                'Category'  	=> $this->input->post('category'),
				                'child_allowed' => ($this->input->post('is_kid_allowed')) ? 1 : 0 ,
				           		'more_features' => $more_features,
				                'other_features' => $other_features,
				                'other_features_charges' => $other_features_charges,
				                'Responsiblity' => $Responsiblity,
				                'Services'      => implode(",", $this->input->post('services')), // Note: added by A (7 Oct) to store multi services
				                //'PushNotification_flag' => $pushnotfication_flag,
				                //'FeaturedTrip_flag' => $featured_trip,
				                //'Charges_ForNotification' => $notif_charges,
				                //'FeaturedTrip_Charges' => $featured_charges,
				                'Created_At' 	=> date('Y-m-d H:i:s')
				            );
            
            $campaign['To_Medina'] = 0;

            if($this->input->post('to_medina')){ $campaign['To_Medina'] = 1; }
            
            // tags
            $feature_ids = $this->company->modifyCampaignFeatures($this->input->post('features'));
            $campaign['Features_ID'] = $feature_ids;
            
            // add campaign
            $result = $this->company->updateCampaign($campaign);
            
            //add localization to table
			$localized_campaign = array(
				array(
					'Campaign_ID' 		   => $campaign_id,
					'Campaign_Name' 	   => $this->input->post('name_en'),
					'Campaign_Description' => $this->input->post('desc_en'),
					'Requirements' 		   => $this->input->post('requirements_en'),
					'Programs' 			   => $this->input->post('programs_en'),
					'Terms' 			   => $this->input->post('terms_en'),
					'Culture' => 'en'
				),
				array(
					'Campaign_ID' 		   => $campaign_id,
					'Campaign_Name' 	   => $this->input->post('name_ar'),
					'Campaign_Description' => $this->input->post('desc_ar'),
					'Requirements' 		   => $this->input->post('requirements_ar'),
					'Programs' 			   => $this->input->post('programs_ar'),
					'Terms' 			   => $this->input->post('terms_ar'),
					'Culture' => 'ar'
				)
			);
			$l_insert = $this->company->addCampaign_Localized($localized_campaign, $campaign_id);
            
            if ($result) {
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
            
		}
		redirect($this->__ctrl.'/campaigns_list');
	}	

	// #delete service function
	public function delete_campaign_picture($picture_id = 0, $campaign_id = 0)
	{
		$log = array(
			'row_id' => 0,
			'action_table' => 'campaign_pictures',
			'content' => $picture_id,
			'event' => 'delete'
		);
		$this->logs->add_log($log);
		
		$picture = $this->company->getCampaignPictureByID($picture_id);
		
		$result = $this->company->deleteCampaignPicture($picture_id);
		if($result)
		{
			@unlink('./'.$GLOBALS['img_camp_pics_dir'].$picture->Picture);
			
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->__ctrl.'/edit_campaign/'.$campaign_id);
	}

	// Dropzone image upload function
	public function campaignImagesUpload()
	{
		if($this->input->post('campaign_id'))
		{
			/*
				Pictures limit for each campaign is 10
			*/
			$campaign_id = $this->input->post('campaign_id');
			
			// check pictures limit
			$pictures = $this->company->getCampaignPictures($campaign_id);
			if(count($pictures) >= 10) { echo 0; exit(); }
		}
		
		if (empty($_FILES)) 
		{
			exit();
        }
        $dir = $GLOBALS['img_camp_pics_dir'];
        
        // image options
		$image_options = array(
			'file' => 'file',
			'directory' => $GLOBALS['img_camp_pics_dir'],
			'max_width' => 1920,
			'file_name' => 'campaign'
		);
		$upload = UploadFile($image_options);
        if (!is_array($upload) && !array_key_exists('file_name', $upload)) 
        {
		    exit();
	    }
	   
		$picture = array(
			'Title_en' => '',
			'Title_ar' => '',
			'Picture' => $upload['file_name'],
			'Created_At' => date('Y-m-d H:i:s')
		);
		if($this->input->post('campaign_id'))
		{
			$campaign_id = $this->input->post('campaign_id');
			
			$picture['Campaign_ID'] = $campaign_id;
		}
		
	    echo $this->company->addCampaignPicture($picture);
	}

  	public function Company_Payment($Campaign_ID)
  	{
  		$campaign_details = $this->company->getCampaignByID($Campaign_ID) ;

  		$company_details = $this->company->getCompanyByID($campaign_details->Company_ID);

  		//echo "<pre>"; print_r($company_details);exit;

  		//$Company_Trips = $this->company->get_CompanyCampaigns($company_id);

  		$Company_Orders = [] ;

  		//foreach($Company_Trips as $key => $trip) 
  		//{
  			$orders = $this->company->GetCompany_SuccessOrders($Campaign_ID) ;

  			if($orders)
  			{
  				$Company_Orders[$Campaign_ID] = $orders ;
  			}
  		//}

  		$filtered_orders = [] ;

  		if($Company_Orders)
  		{
  			$total['amount']  			= 0 ;
  			$total['notif_charges'] 	= 0 ;
  			$total['featured_charges']  = 0 ;
  			$total['charges'] 		    = 0 ;
  			$total['already_paid'] 		= 0 ;

  			$pending_amount = 0 ;

  			foreach($Company_Orders as $campaign_id => $orders) 
  			{
  				if($campaign_id!=$Campaign_ID)
  				{
  					continue ;
  				}

  				$campaign_details = (array) $this->company->getCampaignByID($campaign_id) ;

  				$credit_amount = 0 ; 
  				$already_paid  = 0 ; 


  				$record[$campaign_id]['campaign_details'] = $campaign_details ;

  				foreach($orders as $key => $order) 
  				{
  					$order = (array) $order ;
  					
  					$record[$campaign_id]['campaign_details']['order_details'][] = $order ;

  					$credit = $order['Amount_Paid'] ;   

  					$record[$campaign_id]['campaign_details']['credits'][] = $credit ;

  					$credit_amount += $order['Amount_Paid'] ;
  				}

  				//Check for Transaction made by Admin for this trip
  				$where['Campaign_ID'] = $campaign_id  ;

  				$older_transactions = $this->company->Get_CompanyTransactions($where);

  				$already_credited = 0 ;

  				if($older_transactions)
  				{
  					foreach ($older_transactions as $key => $transaction) 
  					{	
  						$already_credited += $transaction->Amount_Paid ;

  						$already_paid += $transaction->Amount_Paid ;
  					}

  					$record[$campaign_id]['campaign_details']['older_transactions'] = $older_transactions ;
  				}

  				//Already Credited Amount
  				$record[$campaign_id]['campaign_details']['already_credited'] = $already_credited ;
  				$record[$campaign_id]['campaign_details']['pending_amount']   = $credit_amount - $already_credited - ($campaign_details['Charges_ForNotification'] + $campaign_details['FeaturedTrip_Charges']) ;

  				if($record[$campaign_id]['campaign_details']['pending_amount']!=0)
  				{
  					$pending_amount = $record[$campaign_id]['campaign_details']['pending_amount'] ;
  				}

  				//echo $credit_amount - $already_credited; exit;

  				//Credits
  				$record[$campaign_id]['campaign_details']['total_credit_amount'] = $credit_amount ;


  				//Debits
				$record[$campaign_id]['campaign_details']['debits']['Notification']  = $campaign_details['Charges_ForNotification'] ;
				$record[$campaign_id]['campaign_details']['debits']['Featured_Trip'] = $campaign_details['FeaturedTrip_Charges'] ;
				$record[$campaign_id]['campaign_details']['total_debit_amount']      = $campaign_details['Charges_ForNotification'] + $campaign_details['FeaturedTrip_Charges'] ;

				//Total Single Trip Amount
				$record[$campaign_id]['campaign_details']['total_trip_amount'] = $credit_amount - $campaign_details['Charges_ForNotification'] - $campaign_details['FeaturedTrip_Charges']   ;


  				$filtered_orders = $record ; //Push each Trip Payments into an array


				//Overall Trips AMOUNT
	  			$total['amount']  			+= $credit_amount ;
	  			$total['already_paid']  	+= $already_paid ;
	  			$total['notif_charges'] 	+= $campaign_details['Charges_ForNotification'] ;
	  			$total['featured_charges']  += $campaign_details['FeaturedTrip_Charges'] ;
	  			$total['charges'] 		    += $campaign_details['Charges_ForNotification'] + $campaign_details['FeaturedTrip_Charges'] ;
  			}
  		}

  		$data['data']   = $filtered_orders ;
  		$data['totals'] = $total ;
  		$data['company_id'] = $company_details[0]->Company_ID ;
  		$data['pending_amount'] = $pending_amount ;
  		$data['campaign_id'] = $Campaign_ID ;
  		$data['company_details'] = (array) $company_details[0] ;
  		$data['campaign_details'] = (array) $campaign_details ;

  		//echo "<pre>"; print_r($data);exit;

  		$this->LoadView('company/payments',$data);
  	}

  	public function Payments($company_id)
  	{
	  	$this->load->library('parser');
	  	
	  	$culture = $this->session->userdata($this->acp_session->__lang());
	  	
		$Company_Trips = $this->company->getCampaignsList($culture);

		//print_r($Company_Trips);exit;

		$data = array();
		$no   = $_POST['start'];
		$i    = 0;

		foreach ($Company_Trips as $campaign)
		{
			//Check Campaign is completed or not, if not skip this campaign
			if($campaign->To_Date)
			{
				$end_date_time = ($campaign->End_Time!=0) ? $campaign->To_Date.' '.$campaign->End_Time : $campaign->To_Date ;

				$timestamp = strtotime($end_date_time) ;

				$today_timestamp = strtotime(date('Y-m-d H:i:s')) ;

				if($today_timestamp<$timestamp)
				{
					continue ;
				}
			}

			$no++ ;
			$i++  ;

  			$amount  			= 0 ;
  			$notif_charges 	    = 0 ;
  			$featured_charges   = 0 ;
  			$charges 		    = 0 ;
  			$already_paid 		= 0 ;

  			$Company_Orders = $this->company->GetCompany_SuccessOrders($campaign->Campaign_ID) ;
  			$campaign_details = (array) $this->company->getCampaignByID($campaign->Campaign_ID) ;

  			$credit_amount = 0 ; 
  			$already_paid  = 0 ; 

			foreach($Company_Orders as $key => $order) 
			{
				$order = (array) $order ;

				$credit = $order['Amount_Paid'] ;   

				$credit_amount += $order['Amount_Paid'] ;
			}

  			//Check for Transaction made by Admin for this trip
			$where['Campaign_ID'] = $campaign->Campaign_ID  ;

			$older_transactions = $this->company->Get_CompanyTransactions($where);
			$already_credited = 0 ;
			if($older_transactions)
			{
				foreach($older_transactions as $key => $transaction) 
				{	
					$already_credited += $transaction->Amount_Paid ;

					$already_paid += $transaction->Amount_Paid ;
				}
			}

			//Overall Trips AMOUNT
			$amount 		   += $credit_amount ;
			$notif_charges	   += $campaign_details['Charges_ForNotification'] ;
			$featured_charges  += $campaign_details['FeaturedTrip_Charges'] ;
			$charges		   += $campaign_details['Charges_ForNotification'] + $campaign_details['FeaturedTrip_Charges'] ;

			$url = base_url($this->__ctrl.'/Company_Payment/'.$campaign->Campaign_ID) ;

			$actions = '<div class="btn-group"><a class="btn btn-default dropdown-toggle" type="button" href="'.$url.'"><i class="fa fa-eye"></i>'.getSystemString(324).'</a>' ;

			$row   = array();

			$row[] = $i;
			$row[] = date('Y-m-d',$timestamp);
			$row[] = $campaign->Campaign_Name;
			$row[] = (string)$amount;
			$row[] = (string)$already_paid;
			$row[] = (string)$charges;
			$row[] = $actions;
			//$row[] = $actions;
			
			$data[] = $row;
			
		}
		
		$output = array(
						"draw" 			  => $_POST['draw'],
						"recordsTotal"    => $this->company->campaignsCount_filtered($culture),
						"recordsFiltered" => count($data),
						"data" 			  => $data,
					);

		//output to json format
		echo json_encode($output);
  	}


  	public function Record_Payments()
  	{
  		$data = $this->input->post();

  		if($_FILES['file']['error']==0)
  		{
			$image_options = array(
									'file'          => 'file',
									'directory'     => $GLOBALS['img_companies_tr_dir'],
									'allowed_types' => '*',
									'file_name'     => 'file'
								);

			$upload = UploadFile($image_options);

			$data['Transaction_File'] = $upload['file_name'] ;

			$id = $this->company->Insert_Transactions($data);
  		
			if($id)
			{
				echo $id ; return ;
			}

			echo 1 ; return ;
  		}
  	}

  	public function Payments_History($company_id,$campaign_id)
  	{
  		if(!$company_id || !$campaign_id)
  		{
  			redirect(base_url('acp/dashboard'));
  		}

  		$where['Company_ID']  = $company_id  ;
  		$where['Campaign_ID'] = $campaign_id ;

  		$data['transactions'] 	  = (array) $this->company->Get_CompanyTransactions($where);
  		$data['company']          = (array) $this->company->getCompanyByID($company_id)[0];
  		$data['campaign_details'] = (array) $this->company->getCampaignByID($campaign_id);

  		//echo "<pre>"; print_r($data['transactions']);exit;

  		$this->LoadView('company/payments_history',$data);
  	}

  	public function Payments_List($company_id)
  	{
  		$company_details = $this->company->getCompanyByID($company_id);

  		$data['company_id'] = $company_id ;
  		$data['company_details'] = (array) $company_details[0] ;

  		//echo "<pre>";print_r($data);exit;

  		$this->LoadView('company/payments_list',$data);
  	}


  	//Financial PART - Payments
  	public function Financial_Menu()
  	{
  		$this->LoadView('company/financial_part/trip_wise');
  	}



  	public function Transactions_Trip_Wise()
  	{
	  	$this->load->library('parser');

	  	$culture = $this->session->userdata($this->acp_session->__lang());

		$Company_Trips = $this->company->getCampaignsList($culture);

		//print_r($Company_Trips);exit;

		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($Company_Trips as $campaign) 
		{
			//Check Campaign is completed or not, if not skip this campaign
			if($campaign->To_Date)
			{
				$end_date_time = ($campaign->End_Time!=0) ? $campaign->To_Date.' '.$campaign->End_Time : $campaign->To_Date ;

				$timestamp = strtotime($end_date_time) ;

				$today_timestamp = strtotime(date('Y-m-d H:i:s')) ;

				if($today_timestamp<$timestamp)
				{
					continue ;
				}
			}

			$no++ ;
			$i++  ;

  			$amount  			= 0 ;
  			$notif_charges 	    = 0 ;
  			$featured_charges   = 0 ;
  			$charges 		    = 0 ;
  			$already_paid 		= 0 ;

  			$Company_Orders = $this->company->GetCompany_SuccessOrders($campaign->Campaign_ID) ;

  			$campaign_details = (array) $this->company->getCampaignByID($campaign->Campaign_ID) ;

  			$credit_amount = 0 ; 
  			$already_paid  = 0 ; 

			foreach($Company_Orders as $key => $order) 
			{
				$order = (array) $order ;

				$credit = $order['Amount_Paid'] ;   

				$credit_amount += $order['Amount_Paid'] ;
			}

  			//Check for Transaction made by Admin for this trip
			$where['Campaign_ID'] = $campaign->Campaign_ID  ;

			$older_transactions = $this->company->Get_CompanyTransactions($where);
			$already_credited = 0 ;
			if($older_transactions)
			{
				foreach($older_transactions as $key => $transaction) 
				{	
					$already_credited += $transaction->Amount_Paid ;

					$already_paid += $transaction->Amount_Paid ;
				}
			}

			//Overall Trips AMOUNT
			$amount 		   += $credit_amount ;
			$notif_charges	   += $campaign_details['Charges_ForNotification'] ;
			$featured_charges  += $campaign_details['FeaturedTrip_Charges'] ;
			$charges		   += $campaign_details['Charges_ForNotification'] + $campaign_details['FeaturedTrip_Charges'] ;

			$url = base_url($this->__ctrl.'/Company_Payment/'.$campaign->Campaign_ID) ;

			$actions = '<div class="btn-group"><a class="btn btn-default dropdown-toggle" type="button" href="'.$url.'"><i class="fa fa-eye"></i> '.getSystemString(324).'</a>' ;

			$row   = array();

			$row[] = $i;
			$row[] = date('Y-m-d',$timestamp);
			$row[] = $campaign->Campaign_Name;
			$row[] = count($Company_Orders);
			$row[] = (string)$amount;
			$row[] = (string)$already_paid;
			$row[] = (string)$charges;
			$row[] = $actions;
			//$row[] = $actions;
			
			$data[] = $row;
			
		}
		
		$output = array(
						"draw" 			  => $_POST['draw'],
						"recordsTotal"    => $this->company->campaignsCount_filtered($culture),
						"recordsFiltered" => count($data),
						"data" 			  => $data,
					);

		//output to json format
		echo json_encode($output);
  	}

  	public function Financial_Payments($company_id,$campaign_id)
  	{
  		if(!$company_id || !$campaign_id)
  		{
  			redirect(base_url('acp/dashboard'));
  		}

  		$where['Company_ID']  = $company_id  ;
  		$where['Campaign_ID'] = $campaign_id ;

  		$transactions 	  		  = (array) $this->company->Get_CompanyTransactions($where);
  		$data['company']          = (array) $this->company->getCompanyByID($company_id)[0];
  		$data['campaign_details'] = (array) $this->company->getCampaignByID($campaign_id);

		$data = array();

		//print_r($transactions);exit;

		$length = $_POST['length'] ;
		$start  = $_POST['start']  ;

		$record = 0 ;

		foreach ($transactions as $key => $transaction)
		{
			$row = array();

			if($record<$start || count($data)>$length)
			{
				continue;
			}

			$record++ ;

			$timestamp = strtotime($transaction->Created_At) ;
			$url = "<a href=".base_url($GLOBALS['img_companies_tr_dir'].$transaction->Transaction_File)." target='_blank' class='btn btn-sm btn-warning' style='color:white'>View file</a>";

			$row[] = $record;
			$row[] = date('Y-m-d',$timestamp);
			$row[] = $transaction->id;
			$row[] = $transaction->Reference_ID;
			$row[] = $transaction->Amount_Paid;
			$row[] = $transaction->Comments;
			$row[] = $url;
			
			$data[] = $row;	
		}
		
		$output = array(
						"draw" 			  => $_POST['draw'],
						"recordsTotal"    => count($transactions),
						"recordsFiltered" => count($data),
						"data" 			  => $data,
					);

		//output to json format
		echo json_encode($output);
  	}

}
  	