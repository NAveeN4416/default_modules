<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Clients extends Base_Controller
{
	
	// define controller
	protected $thisCtrl = "acp/clients";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
		$this->load->vars( array('__controller' => $this->thisCtrl));
		
		$this->load->model('clients_model', 'clients');
  	}
	
	public function add()
	{
		$this->LoadView('clients/add');
	}
	
	public function add_POST()
	{
		if($this->input->post('submit'))
		{
			$file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_clients_dir']);
			$result = '';
	        if (!$file)
	        {
				$this->session->set_flashdata('requestMsgErr', 'Image has not been uploaded, please try again.');
				redirect($this->thisCtrl.'/listall');
	        }
	        
			$data = array(
				'Title_en' => $this->input->post('title_en'),
				'Title_ar' => $this->input->post('title_ar'),
				'Client_Link' => $this->input->post('url'),
				'Picture' => substr($file, strrpos($file, '/') + 1),
			);
			
			$result = $this->clients->add($data);
	        
		    if($result)
		    {
		    	$clientID = $this->db->insert_id();

				$log = array(
								'row_id' 	   => $clientID,
								'action_table' => 'clients',
								'content'      => $_POST,
								'event'        => 'add'
							);

				$this->logs->add_log($log);

	            $this->session->set_flashdata('requestMsgSucc', 121);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
			
		}
		redirect($this->thisCtrl.'/listall');
	}
		
	public function listall()
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'clients',
						'content'      => 0,
						'event'        => 'select'
					);

		$this->logs->add_log($log);

		$data['clients'] = $this->clients->listall();
		$this->LoadView('clients/list', $data);
	}
	
		// #edit clients
	public function edit($clientID = 0)
	{
		$log = array(
						'row_id' 	   => $clientID,
						'action_table' => 'clients',
						'content'      => $clientID,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['client_id'] = $clientID;
		$data['client']    = $this->clients->getByID($data);

		$this->LoadView('clients/edit', $data);
	}
	
	// #update clients
	public function edit_POST()
	{
		if($this->input->post('submit'))
		{
			$id = $this->input->post('client_id');
			$title_en = $this->input->post('title_en');
			$title_ar = $this->input->post('title_ar');
			$link = $this->input->post('url');
			
			$result = '';
			$updateData = array(
									'Client_ID' => $id,
									'Title_en' => $title_en,
									'Title_ar' => $title_ar,
									'Client_Link' => $link
								);
			
	        if ($_FILES['fileToUpload']['size'] !== 0)
	        {
		        $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_clients_dir']);
				$updateData['Picture'] = substr($file, strrpos($file, '/') + 1);
	        }
	        
			$result = $this->clients->update($updateData);
	        
	        if($result)
	        {
	        	$log = array(
								'row_id'       => $id,
								'action_table' => 'clients',
								'content'      => $_POST,
								'event'        => 'update'
							);

				$this->logs->add_log($log);

	            $this->session->set_flashdata('requestMsgSucc', 120);
	        }
	        else 
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		redirect($this->thisCtrl.'/listall');
	}
	

	public function ChangeStatus()
	{
		$data['Client_ID'] = $this->input->post('id');
		$data['status']    = $this->input->post('status');

		$uflag = $this->clients->update($data);

		echo $uflag ; 
	}



	// #delete clients function
	public function delete($clientID = 0)
	{
		$log = array(
						'row_id' => 0,
						'action_table' => 'clients',
						'content' => $clientID,
						'event' => 'delete'
					);

		$this->logs->add_log($log);
		
		$data['client_id'] = $clientID;
		
		$result = $this->clients->delete($data);
		
		if($result)
		{
        	$log = array(
							'row_id'       => $clientID,
							'action_table' => 'clients',
							'content'      => $clientID,
							'event'        => 'delete'
						);

			$this->logs->add_log($log);

            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

		redirect($this->thisCtrl.'/listall');
	}

	public function join_as_partners()
	{
		$data['join_as_partners'] = $this->clients->join_as_partners();

		$this->LoadView('clients/join_as_partners', $data);
	}


	public function view_partner($id)
	{
		$data['partner'] = $this->clients->get_joinas_partner($id);

		$this->LoadView('clients/view_partner', $data);
	}

}