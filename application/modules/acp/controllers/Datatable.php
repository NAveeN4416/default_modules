<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Datatable extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "datatable";
	
	function __construct()
	{
    	parent::__construct();
    	
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    	$this->load->library('parser');
    	$this->load->model('datatable_model', 'datatable');
    	
  	}
  	
  	/**---------------------------------------
	  	* Logs list *
	  	-------------------------------------**/
  	
  	public function getWebsiteLogs(){
	  	
		$list = $this->datatable->getWebsiteLogs();
		$data = array();
		$no = $_POST['start'];

		//print_r($list);
		foreach ($list as $log) {
						
			$row = array();
			$row[] = $log->Log_ID;
			$row[] = $log->TimeStamp;
			$row[] = $log->Username;
			$row[] = $log->IP_Address;
			if($log->Event_Performed != 'update' && $log->Event_Performed != 'delete') {
				$row[] = '<b>'.$log->Event_Performed.'ed</b> '.$log->Action_Table.' table';
			} else {
				$row[] = '<b>'.$log->Event_Performed.'d</b> '.$log->Action_Table.' table';
			}
			
			$data[] = $row;
			
		} // end foreach
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->logsCount_all(),
			"recordsFiltered" => $this->datatable->logsCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	  	
  	}
  	
  	/**---------------------------------------
	  	* Customers list *
	  	-------------------------------------**/
  	
  	public function getCustomersList()
  	{
		$customers = $this->datatable->getCustomersList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		//print_r($customers);exit;
		foreach ($customers as $customer) {
			$no++;
			$i++;
			
			$dt = new DateTime($customer->TimeStamp);
			$date = $dt->format('d-m-Y');
			
			$detail_url = base_url('acp/customer_details/'.$customer->Customer_ID);
			$action_data = array(
				'details_url' => $detail_url,
				'edit_url' => base_url('acp/editCustomer/'.$customer->Customer_ID),
				'delete_url' => base_url('acp/deleteCustomer/'.$customer->Customer_ID)
			);
			// actions template
			$actions = ''.$this->parser->parse('customers/snippets/action-template', $action_data, TRUE);
			
			//verified number
			$verified_label = '';
			if($customer->Phone_Verified){
				$verified_label = '<i class="fa fa-check-circle text-success"></i>';
			}
			
			//customer status template
			$status_chk = '';
			$status_not_chk = '';
			if($customer->Status) { $status_chk = 'checked'; }
			if(!$customer->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$customer->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					  </div>';	
			
			$row = array();
			$row[] = $customer->Customer_ID;
			$row[] = $date;
			$row[] = $customer->Fullname;
			$row[] = $customer->Phone;
			$row[] = $customer->Address;
			$row[] = '<a href="'.$detail_url.'">'.$customer->TotalFamilyMembers.'</a>';
			$row[] = '<a href="'.$detail_url.'">'.$customer->TotalReservations.'</a>';
			$row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
			
		} // end foreach
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->customersCount_all(),
			"recordsFiltered" => $this->datatable->customersCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	  	
  	}
  	
	
}
?>