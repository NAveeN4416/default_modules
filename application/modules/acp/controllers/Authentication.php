<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Authentication extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "authentication";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    	
    	$this->load->model('authentication_model', 'auth');
    	
    }

/*-----------------------------------------------------------
		---------------------- #Authentication -----------------
		--------------------------------------------------------*/
	
	// #Login Function  	
	public function userLogin()
	{ 
		$log = array(
						'row_id'       => 0,
						'action_table' => 'login',
						'content'      => $_POST,
						'event'        => 'select'
					);
		
		$this->logs->add_log($log);
		
		$ctrl = 'acp';
		
		if($this->input->post('username')){
			if($this->session->userdata('site__auth') >= 3){
				$response = $this->input->post('g-recaptcha-response');
				$secret = '6LebFBkUAAAAANhN9w4F8TtQFu-B0scWm5P8R3Ig';
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
				$res = json_decode($rsp, TRUE);
				if($res['success'] != 1){
					// recaptcha failed show error message 
					$this->session->set_flashdata('loginFailed', 181);
					redirect($ctrl.'/login');
				}
			}
		
			$user_pass = $this->input->post('password');
			
			$data['Username'] = $this->input->post('username');
			$data['Password'] = $user_pass;	
			
			$result = $this->auth->login_m($data);
			
			//print_r($result);exit;

			$this->load->library('bcrypt');
			$password = $result != 0 ? $result[0]->Password : '';
			
			if($this->bcrypt->check_password($user_pass, $password))
			{
				$userdata = array(
									$this->acp_session->userid()   => $result[0]->User_ID,
									$this->acp_session->username() => $result[0]->Fullname,
									$this->acp_session->email()    => $result[0]->Username,
									$this->acp_session->role()     => $result[0]->Role,
									$this->acp_session->role_id()  => $result[0]->Role_ID,
									$this->acp_session->picture()  => $result[0]->Picture
								);

				$this->session->set_userdata($userdata);

				$this->session->set_userdata('site__auth', 0);

				$this->load->model('Roles_model','roles');

				$_SESSION['permissions'] = $this->roles->user_permissions($result[0]->Role_ID) ;
				$_SESSION['Role_ID']     = $result[0]->Role_ID ;

				if(strlen($_SESSION['redirect_url_ref']) > 0)
				{
					$redirect_url = $_SESSION['redirect_url_ref'];
					$_SESSION['redirect_url_ref'] = '';
					redirect($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$redirect_url);
				}
				
				redirect($ctrl.'/dashboard');
			}
			else
			{
				if(array_key_exists('site__auth',$_SESSION) && !empty($_SESSION['site__auth'])) 
				{
					$auth_tries = $this->session->userdata('site__auth');
					$this->session->set_userdata('site__auth', $auth_tries + 1);
				} 
				else 
				{
					$this->session->set_userdata('site__auth', 1);
				}

			   $result = array('result' => 181);

			   $this->load->view('login', $result);
			}
		} 
		else 
		{
			redirect($ctrl.'/login');
		}
	}
	
	/*-----------------------------------------------------------
		---------------------- #Authentication Forgot Password -----------------
		--------------------------------------------------------*/
	
	// #password reset function 
	public function passwordReset(){
		$log = array(
			'row_id' => 0,
			'action_table' => 'login',
			'content' => $_POST,
			'event' => 'update'
		);
		$this->logs->add_log($log);
		$email = $this->input->post('email');
		
		// this method will check the username with specified role, if found it will give us a token to sent in email
		$result = $this->auth->checkUser(array('Username' => $email, 'Role_ID' => $this->session->userdata('role_login')));
		
		if(is_array($result) && $result['info'] == 1){
			if($this->PasswordResetEmailTemplate($email, $result['reset_token'])){
				
				echo json_encode(array('info' => '1', 'msg' => getSystemString(284)));	
			} else {
				
				echo json_encode(array('info' => '0', 'msg' => getSystemString(255)));
			}
		} else {
			echo $result;
		}
	}
	
	// email template
	public function PasswordResetEmailTemplate($email = '', $reset_token = ''){
		
		$role = $this->session->userdata('role_login');
		$ctrl = 'acp';
		
		if($role == COMPANY_ROLE){
			$ctrl = 'cp';
		}
		
		$data = array(
			'controller' => $ctrl,
			'username' => $email,
			'reset_token' => $reset_token
		);
		$this->load->library('parser');
		$message = $this->parser->parse('acp_includes/email/password-reset', $data, TRUE);
		
		//send email
		$options = array(
			'to' => $email,
			'subject' => getSystemString(487),
			'message' => $message,
		);
		
		return SendEmail($options);
	}
	
	public function changePassword_Request(){
		
		$role = $this->session->userdata('role_login');
		$ctrl = 'acp';
		
		if($role == COMPANY_ROLE){
			$ctrl = 'cp';
		}
		
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|required|xss_clean');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]|xss_clean');
        
        $reset_token = $this->input->post('reset_token');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());
			
			redirect($ctrl.'/resetPasswordRequest/'.$reset_token);
        }
      
	      //update user password
	    $this->load->library('bcrypt');
	    $data = array(
	        'Reset_Token' => '',
	        'Password' => $this->bcrypt->hash_password($this->input->post('password'))
	    );
	      
	    $result = $this->auth->updateUserPassword($data, $reset_token);
	    if($result){
	        $this->session->set_flashdata('passwordChanged', 434);
	    }
        
        redirect($ctrl.'/login');
        
	} // end function
	
}