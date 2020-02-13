<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Tickets extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/tickets";
	public $__directories = array();
	
	function __construct()
	{
    	parent::__construct();
    	
    	$this->load->model('admin_model');
    	$this->load->model('tickets_model', 'tickets');
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
  	}
	

	/* -----------------------------------------------------------
	---------------------- Enquiries from Companies & Users -------
	--------------------------------------------------------*/
	public function enquiries($from,$id=0)
	{
		$enquiries_from = ['users','companies'] ;

		if(in_array($from,$enquiries_from))
		{
			if($from=='users')
			{
				$table = TBL_USER_ENQUIRY_CONV ;

				$enquiries = $this->tickets->get_UserEnquiries($id) ;

				$template = 'enquiries/user_enquiries'  ;

				if($id)
				{
					$conversations = $this->tickets->GetConversations($table,$id) ;

					$enquiries[0]->conversations = $conversations ;

					$template = 'enquiries/view_userquery';
				}
			}
			else
			{
				$table = TBL_COMP_ENQUIRY_CONV ;

				$enquiries = $this->tickets->get_CompanyEnquiries($id) ;

				$template = 'enquiries/company_enquiries'  ;

				if($id)
				{
					$conversations = $this->tickets->GetConversations($table,$id) ;

					$enquiries[0]->conversations = $conversations ;

					$template = 'enquiries/view_companyquery';
				}
			}

			$enquiries = array_reverse($enquiries) ;

			//echo "<pre>"; print_r($enquiries);exit;

			$data['enquiries'] = $enquiries;

			$this->LoadView($template, $data);

			return  True ;
		}

		redirect('acp/dashboard');
	}

	public function Send_Reply($flag) //$flag = users or companies
	{
		$data = $this->input->post();

		$table = TBL_COMP_ENQUIRY_CONV ;

		$insert['enquiry_id'] = $data['ticket_id'] ;
		$insert['from_user']  = 'Admin'   ;
		$insert['to_user']    = 'Company' ;
		$insert['message']    = $data['message'] ;

		if($flag=='users')
		{
			$insert['to_user']  = 'User' ;

			$table = TBL_USER_ENQUIRY_CONV ;
		}

		$id = $this->tickets->Send_Reply($insert,$table);

		if($id)
		{
			redirect('acp/tickets/enquiries/'.$flag.'/'.$data['ticket_id']);
		}
	}


	public function ToggleStatus($flag) //$flag = users or companies
	{
		$table = TBL_USER_ENQUIRIES ;

		$set['Status'] = $this->input->post('status');

		$ticket_id = $this->input->post('ticket_id');

		if($flag=='companies')
		{
			$table = TBL_COMP_ENQUIRIES ;
		}

		$uflag = $this->tickets->ToggleStatus($set,$ticket_id,$table);

		if($uflag)
		{
			echo $uflag ; return ;
		}

		echo 0 ;
	}

}
?>