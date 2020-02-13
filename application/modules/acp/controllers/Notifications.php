<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Notifications extends Base_Controller
{
	// define controller
	protected $thisCtrl = "acp/notifications";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
		$this->load->vars( array('__controller' => $this->thisCtrl));
		$this->load->model('customers_model', 'customers');
		$this->load->model('crons_model', 'crons');
  	}
  	
  	
	public function sms()
	{
		$this->load->library('curl');

		$post = ['domain' => $_SERVER['HTTP_HOST']];
				
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://dnet.sa/hcm/sms/Get_MessagesCount");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$Messages_Count = curl_exec ($ch);
		
		curl_close ($ch);

		$Messages_Count = json_decode($Messages_Count,true) ;

		if($Messages_Count=='No Bundle Found')
		{
			$result['Sms_Count'] = 1 ; //Bundle Not Found
		}
		elseif($Messages_Count=='Site not found')
		{
			$result['Sms_Count'] = 0 ; //Domain Not Found
		}
		else
		{
			$result = $Messages_Count ; //SMS Count found
		}

		$this->LoadView('sms/send_sms',$result);
	}
	
	public function getMobileNumbers()
	{
		$string  = $this->input->get('q');
		$numbers = $this->admin_model->getMobileNumbers($string);
		$json = [];
		
		foreach($numbers as $no)
		{
			$json[] = ['id' => $no->Phone, 'text' => $no->Phone];
		}

		echo json_encode($json);
	}
	
	public function sms_log()
	{
		$this->LoadView('sms/sms_log');
	}
	
	public function sms_package()
	{
		$this->load->library('curl');

		$post = ['domain' => $_SERVER['HTTP_HOST']];
				
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://dnet.sa/hcm/sms/Get_SMS_RenewalPackagedetails");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$Renewal_details = curl_exec ($ch);
		
		curl_close ($ch);


		$Renewal_details = json_decode($Renewal_details,true) ;

		if($Renewal_details=='No Package Found')
		{
			$result['Packages'] = 1 ; //Package Not Found
		}
		elseif($Renewal_details=='Site not found')
		{
			$result['Packages'] = 0 ; //Domain Not Found
		}
		else
		{
			$result['Packages'] = $Renewal_details ; //SMS Count found
		}

		//echo "<pre>"; print_r($result);exit;

		$this->LoadView('sms/sms_package',$result);
	}
	
	public function sendSMS()
	{
		if($this->input->post('submit'))
		{
			$message = $this->input->post('message') ;
			$numbers = $this->input->post('numbers') ;
			$send_nos = '' ;
			$all_flag = 0  ;

			if(count($numbers) > 0)
			{
				$send_nos = implode(",", $numbers);
			}
			
			if($this->input->post('send_all_customers'))
			{
				$c_nos = $this->admin_model->getCustomerNumbers();
				$send_nos .= ' all customers ';
				$all_flag = 1;
				
				$numbers = (object) array_merge((array) $c_nos, (array) $numbers);
			}
			
			if($this->input->post('send_all_companies'))
			{

				$c_nos     = $this->admin_model->getCompaniesNumbers();
				$send_nos .= ' all companies ';
				$all_flag  = 1;
				
				$numbers = (object) array_merge((array) $c_nos, (array) $numbers);
			}

			$data = array(
							'Number'  =>  $send_nos,
							'Message' => $message,
							'User_ID' => $this->session->userdata($this->acp_session->userid())
						);
			

			$sms_result = '';
			$sendPhoneNosArray = array();

			if(count($numbers) > 0)
			{
				foreach($numbers as $no)
				{
					if($all_flag)
					{
						if(is_object($no))
						{
							if(strlen($no->Phone) == 10 && substr($no->Phone, 0, 2) == 05)
							{
								$sendPhoneNosArray[] = $no->Phone;
							}
						}
					} 
					else 
					{
						$sendPhoneNosArray[] = $no;
					}
					
				}
			}
			
			$sms_result = sendSMSTo(implode(",", $sendPhoneNosArray), $message);
			$sms_result = json_decode($sms_result);
			
/*
			print_r($sms_result);
			die();
*/
							
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
	---------------------- Send Message To All members -----------------
	--------------------------------------------------------*/
	
	public function sendMessage()
	{
		$data['members']   = $this->customers->getCustomers();
		$data['companies'] = $this->admin_model->getCompanies();

		$this->LoadView('notifications/send-message', $data);
	}
	
	public function sendMessageToMembers()
	{
		$this->load->helper('utilities');

		if($this->input->post('submit'))
		{
			$all_customers = @$this->input->post('all_customers') ;
			$all_companies = @$this->input->post('all_companies') ;

			if(isset($all_customers))
			{
				$members   =  $this->input->post('total_members');
			}
			else
			{
				$members   = (array) $this->input->post('members');
			}

			if(isset($all_companies))
			{
				$companies   =  $this->input->post('total_companies');
			}
			else
			{
				$companies   = (array) $this->input->post('companies');
			}

			$data = array(
							"userid"      => $this->session->userdata($this->acp_session->userid()),
							"subject"     => $this->input->post('subject'),
							"message"     => $this->input->post('message'),
							"postmembers" => $this->input->post('members')
						);

			if(strlen(trim($data['message'])) == 0)
			{
				$this->session->set_flashdata('requestMsgErr', 318);
				$data['members']   = $this->customers->getCustomers();
				$data['companies'] = $this->admin_model->getCompanies();
				$this->LoadView('notifications/send-message', $data);
			}

			$result = '';
			
			//upload attachment
			$config['upload_path']   = './'.$GLOBALS['img_dir'].'/';
			$config['allowed_types'] = '*';
			$config['max_size']      = 2048;
			$config['encrypt_name']	 = true;
			
			$attach = false;
			$this->load->library('upload', $config);

	        if (!$this->upload->do_upload('attach_file'))
	        {
	            //echo $this->upload->display_errors();
	        }
	        else
	        {
	            $upload_data = $this->upload->data();

	            if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
	            {
					$attach = $upload_data['full_path'];
					$data['attachment'] = $attach;
					$send['attach'] = $attach ;
				}
	        }

	        $emails = array_merge($members,$companies);

	        $send['subject'] = $data['subject'];
	        $send['message'] = $data['message'];

	        $unique_emails = [] ;

			foreach ($emails as $key => $email) 
			{
				if(!in_array($email, $unique_emails))
				{
					array_push($unique_emails,$email);
				}
			}

	        if($unique_emails)
        	{
	        	$cron_content = [] ;

	        	$cron_content['user_id'] = $this->session->userdata($this->acp_session->userid()) ;
	        	$cron_content['Subject'] = $send['subject'] ;
	        	$cron_content['Message'] = ($send['message']) ? $send['message'] : ''  ;
	        	$cron_content['File']    = ($send['attach'])  ? $send['attach']  : ''  ;

	        	$content_id = $this->crons->Cron_MailContent($cron_content);

	        	$mails_list = [] ;

	        	if($content_id)
	        	{
	        		$mails_list['Content_id'] = $content_id ;

	        		foreach ($emails as $key => $mail)
	        		{
	        			$mails_list['Mail'] = $mail ;

	        			$this->crons->Cron_MailsList($mails_list) ;
	        		}
	        	}

	        	$this->session->set_flashdata('requestMsgSucc', 677);
        	}
        	else
        	{
        		$this->session->set_flashdata('requestMsgErr', 119);
        	}
		}

		redirect($this->thisCtrl.'/sendMessage');
	}
	
	/*-----------------------------------------------------------
	---------------------- Send Notifications To All members -----------------
	--------------------------------------------------------*/
	
	public function pushNotifications()
	{
		$data['emails'] = $this->customers->getCustomers();
		$this->LoadView('notifications/send-notifications', $data);
	}

	public function sendPushNotification()
	{

		if($this->input->post('submit'))
		{	
			$result = 0;
			
			$subject = $this->input->post('subject') ;
			$message = $this->input->post('message') ;

			$data['title'] = $subject ;
			$data['body']  = $message ;

			$customers = $this->customers->getAllCustomers();

			$this->load->helper('notification') ;

	        foreach($customers as $row)
	        {
	        	if($row->device_type!=NULL && $row->device_type!='')
	        	{
	        		if($row->device_type=='Android')
	        		{
	        			$result = send_notification_android($row->device_token,$data) ;
	        		}
	        		else
	        		{
	        			$result = send_notification_ios($row->device_token,$data) ;
	        		}
	        	}

	        	//$result = $this->_sendPushNotification($this->input->post('subject'), $this->input->post('message'), $row->Mobile_ID);
	        }
							
			if($result)
			{
				//$email_id = $this->admin_model->addEmailMessage($data);
	            $this->session->set_flashdata('requestMsgSucc', 679);
	        } 
	        else 
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		
		redirect($this->thisCtrl.'/pushNotifications');
	}
	
	
	
	protected function _sendPushNotification($title = '', $body = '', $id = '')
    {
		
		//if(strlen($id) <= 0){ return FALSE; }
			
		define( 'API_ACCESS_KEY', 'AAAAeoxIlSA:APA91bEqWJ_vlNx_kVsXYh6moc-dfxNoBu8RdX0eSmAymQmpIfkqkvAbvaVk18Kq9vnDkAovL5lZsBDMQbvV0KIn00-oWAzNorAasreNYAfmRQB5pPOf2CQXbeYnbEcN3OWPAE5z7V0d' );
		
		$id = "cK_DRS0iOc8:APA91bEW6TejNvYbcRvefeLV8c2B9w5acljMzFw6s4eJUwyPwOXo-uX41v23HWCrSm6SHe14yXBCNEO8Wy6i4aoIlUWk2LJDAlh6llU2YjKrmkK9qJFk7_M1tR2qwv6PN50_5DKFgUaL";
		
		$registrationIds = array($id);

		$msg = array(
	        'body'  => $body,
	        'title'     => $title,
	        'vibrate'   => 1,
	        'sound'     => 1,
		);
		$fields = array(
            'registration_ids'  => $registrationIds,
            'notification'      => $msg
        );

		$headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
		
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		
		return 1;
		//echo $result;
    }
}