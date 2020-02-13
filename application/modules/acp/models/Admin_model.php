<?PHP
	class Admin_model extends CI_Model{
		
		//table names defined in constants
		
		public function GetWebsitetLanguage(){
			$query = $this->db->query('select Website_Language from '.TBL_WEBSITE_SETTINGS)->result()[0]->Website_Language;
			return $query;
		}
		
		public function changeLanguage($data = array()){
			return $this->db->update(TBL_WEBSITE_SETTINGS, $data);
			
		}
		
		public function add_log($log = array()){
			return $this->db->insert(TBL_LOGS_OPERATIONS, $log);
		}		
		/*-----------------------------------------------------------
		---------------------- User Section -----------------
		--------------------------------------------------------*/
		
		// #get user function
		public function getUser($data = array()){
			$where = array('User_ID' => $data['user_id']);
			$this->db->where($where);
			$dt = $this->db->get(TBL_USERS);
			return $dt->result();
		}
		
		public function updateUser($data = array())
		{
			$where = array('User_ID' => $data['User_ID']);
			$this->db->where($where);
			return $this->db->update(TBL_USERS, $data);
		}

		
		public function getTotals(){
			
			$companies = $this->db->where('Is_Deleted', 0)->get(TBL_COMPANIES)->num_rows();
			$campaigns = $this->db->where('Is_Deleted', 0)->get(TBL_CAMPAIGNS)->num_rows();
			$news = $this->db->get('news')->num_rows();
			$clients = $this->db->get('clients')->num_rows();
			$news = $this->db->get('news')->num_rows();
			$userTicket = $this->db->get('user_enquiries')->num_rows();
			$companyTicket = $this->db->get('company_enquiries')->num_rows();
			
			$reservations = $this->db
									->where('Is_Deleted', 0)
									->where('Reservation_Confirmed', 1)
									->where('Payment_Verified', 1)
									->get(TBL_RESERVATIONS)
									->num_rows();
			$customers = $this->db->where('Is_Deleted', 0)->get(TBL_CUSTOMERS)->num_rows();
			
			return array('TotalCompanies' => $companies, 'TotalCampaigns' => $campaigns, 'TotalReservations' => $reservations, 'TotalCustomers' => $customers, 'TotalNews' => $news, 'TotalClients' => $clients, 'TotalUserTicket' => $userTicket, 'TotalCompTicket' => $companyTicket);
		}
		
/*
		public function getNewOrders(){
			return $this->db->where('Order_Status', 'Pending')->get(TBL_ORDERS_HEAD)->num_rows();
		}
*/

		public function getTotalSales($company_id=0)
		{	
			if($company_id!=0){
				$where['c.Company_ID'] = $company_id ;
			}

			
			$where['r.Payment_Verified'] = 1;
			$where['r.Reservation_Confirmed'] = 1;
			$where['r.Is_Deleted'] = 0;
			$where['r.Amount_Paid !='] = 0;

			return $this->db->select('r.*')
							->from('reservations as r')
							->join('campaigns as c','c.Campaign_ID=r.Campaign_ID')
							->where($where)
							->get()->num_rows();
		}

		
		public function getReports()
		{
			$newOrders = $this->getNewOrders();
			$deliveredOrders = $this->db->where('Order_Status', 'Delivered')->get(TBL_ORDERS_HEAD)->num_rows();
			$storeWorth = $this->db
									->select('SUM(ppu.Price * p.Quantity) as StoreWorth')
									->from(TBL_PRODUCTS.' as p')
									->join(TBL_PRODUCT_PRICE_PERUNIT.' as ppu', 'ppu.Product_ID = p.Product_ID')
									->get()
									->result();
									
			$totalSales = $this->db
									->select('SUM(OrderTotal_Price) as TotalSales')
									->from(TBL_ORDERS_HEAD)
									->get()
									->result();
									
			$totalIncome = $this->db
									->select('SUM(oh.OrderTotal_Price) as TotalIncome')
									->from(TBL_ORDERS_HEAD.' as oh')
									->where("oh.Order_Status != 'Returned'")
									->get()
									->result();
			
			return array(
				'newOrders' => $newOrders,
				'deliveredOrders' => $deliveredOrders,
				'storeWorth' => $storeWorth,
				'totalSales' => $totalSales,
				'totalIncome' => $totalIncome
			);
		}
		
		public function getStoreTotalIncome()
		{
			$this->db->select("DATE_FORMAT(Reserved_At, '%Y-%m-%d') as date, SUM(Amount_Paid) as value");
			//->from(TBL_ORDERS_HEAD)
			$this->db->from(TBL_RESERVATIONS);

			//if(isset($_SESSION['month_flag']))
			//{
				$this->db->group_by('DAY(Reserved_At)');
			//}
			//else
			//{
			//	$this->db->group_by('DAY(Reserved_At)');
			//}
			
			if(isset($_SESSION['from_date']))
			{
				$this->db->where('DATE(Reserved_At) >=',$_SESSION['from_date']);
				$this->db->where('DATE(Reserved_At) <=',$_SESSION['to_date']);
			}

			//$this->db->get()->result() ;

			//return $this->db->last_query();

			return $this->db->get()->result() ;
		}
		
		public function getMostOrderedProducts()
		{
			return $this->db
							->select('count(*) as reservations, lc.Campaign_Name as ProductTitle')
							->from(TBL_RESERVATIONS.' as r')
							->join(TBL_CAMPAIGNS.' as c', 'c.Campaign_ID = r.Campaign_ID')
							->join(TBL_LOCALIZED_CAMPAIGNS.' as lc', 'lc.Campaign_ID = r.Campaign_ID')
							->group_by('r.Campaign_ID')
							->order_by('r.Reservation_ID', 'DESC')
							->where('lc.Culture', 'en')
							->limit(10)
							->get()
							->result();
		}
		
		public function getHighTripCompanies()
		{
			return $this->db
							->select('count(*) as trips, lcmp.Company_Name as Company')
							->from(TBL_CAMPAIGNS.' as c')
							->join(TBL_COMPANIES.' as cmp', 'cmp.Company_ID = c.Company_ID')
							->join(TBL_LOCALIZED_COMPANIES.' as lcmp', 'lcmp.Company_ID = c.Company_ID')
							->group_by('c.Company_ID')
							->order_by('c.Campaign_ID', 'DESC')
							->where('lcmp.Culture', 'en')
							->limit(10)
							->get()
							->result();
		}
		
		
			/*-----------------------------------------------------------
		---------------------- ABOUT US Section -----------------
		--------------------------------------------------------*/
	
		
		// #get Company details function
		public function getCompanyDetails(){
			$query = $this->db->select("a.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
								->from(TBL_ABOUTUS." as a")
								->join(TBL_SECTIONS." as s", "s.Section_ID = a.Section_ID")
								->get();
			return $query->result();
		}
		
		// #Edit Company details function 
		public function editCompanyDetails($data = array()){
			$query = $this->db->update(TBL_ABOUTUS, $data);
			return $query;
		}
		
		
		/*-----------------------------------------------------------
		---------------------- customers -----------------
		--------------------------------------------------------*/
		
		public function getCustomerByID($customer_id = 0){
			return $this->db
							->where('Customer_ID', $customer_id)
							->get(TBL_CUSTOMERS)
							->result();
		}
		
		public function updateCustomer($data = array()){
			$upd = $this->db->where('Customer_ID', $data['Customer_ID'])->update(TBL_CUSTOMERS, $data);
			return $upd;
		}
		
		public function check_customer_password($data = array()){
		    // AND `Verified` != 0 removed on client request
	        $id = $data['Customer_ID'];
	        $dt    = $this->db->query("SELECT * FROM `".TBL_CUSTOMERS."` WHERE `Customer_ID` = '$id' AND `Status` = 1");
	        
	        if ($dt->num_rows() == 1) {
	            return $dt->result();
	        } else {
	            return array(
	                'result' => 'Invalid username or password, Please try again'
	            );
	        }
    	}
    	
    	public function getCustomerDetailsByID($customer_id = 0)
    	{
	    	$customer = $this->db
	    						->select('c.*, b.*')
	    						->from(TBL_CUSTOMERS.' as c')
	    						->join(TBL_CUSTOMER_BANKINFO.' as b', 'b.Customer_ID = c.Customer_ID', 'LEFT')
	    						->where('c.Customer_ID', $customer_id)
	    						->get();
	    						
	    	return $customer->row();
    	}
    	
    	public function getCustomerFamilyMembers($customer_id = 0)
    	{
	    	return $this->db->where('Customer_ID', $customer_id)->get(TBL_CUSTOMER_FAMILY)->result();
    	}
    	
    	public function deleteCustomer($customer_id = 0)
    	{
	    	$delete = array('Is_Deleted' => 1);
	    	return $this->db->where('Customer_ID', $customer_id)->update(TBL_CUSTOMERS, $delete);
    	}
		
		/*-----------------------------------------------------------
		---------------------- Faq -----------------
		--------------------------------------------------------*/
		
		public function getFaqs(){
			return $this->db
							->select('q.*, a.Username')
							->from(TBL_QUESTIONS.' as q')
							->join(TBL_USERS.' as a', 'a.User_ID = q.User_ID')
							->order_by('q.Order_In_List', 'asc')
							->get()
							->result();
		}
		
		public function addQuestion($data = array()){
			return $this->db->insert(TBL_QUESTIONS, $data);
		}
		
		public function getQuestionByID($id = 0){
			return $this->db
					->where('Q_ID', $id)
					->get(TBL_QUESTIONS)
					->result();
		}
		
		public function updateQuestion($data = array()){
			return $this->db
					->where('Q_ID', $data['Q_ID'])
					->update(TBL_QUESTIONS, $data);
		}
		
		public function deleteQuestion($data = array()){			
			return $this->db
					->where('Q_ID', $data['Q_ID'])
					->delete(TBL_QUESTIONS);
		}
			
			
			/*-----------------------------------------------------------
		---------------------- WEBSITE SETTINGS -----------------
		--------------------------------------------------------*/
			
			// #settings
			public function getSettings(){
				$query = $this->db->get(TBL_WEBSITE_SETTINGS);
				return $query->result();
			}

			
			public function getContacts(){
				$query = $this->db
							 ->select("c.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
							 ->from(TBL_WEBSITE_CONTACTS." as c")
							 ->join(TBL_SECTIONS." as s", "s.Section_ID = c.Section_ID")
							 ->get();
			    return $query->result();
			}
			
			public function getMarkers(){
				$this->db->select('lat, lng, Address');
				$query = $this->db->get(TBL_WEBSITE_MAPLOCATIONS);
				return $query->result();
			}
			
			public function updateSettings($data = array()){
				$where = array("ID" => 1);
				$this->db->where($where);
				$query = $this->db->update(TBL_WEBSITE_SETTINGS, $data);
				return $query;
			}
			
			public function updateContactus($data = array()){
				$where = array("ID" => 1);
				$this->db->where($where);
				$query = $this->db->update(TBL_WEBSITE_CONTACTS, $data);
				return $query;
			}
			
			public function saveLocation($data = array()){
				$query = $this->db->insert(TBL_WEBSITE_MAPLOCATIONS, $data);
				return $query;
			}
			
			public function deleteLocation($data = array()){
				$query = $this->db
								->where('lat', $data['lat'])
								->where('lng', $data['lng'])
								->delete(TBL_WEBSITE_MAPLOCATIONS);
				return $query;
			}

/*-----------------------------------------------------------
		---------------------- Background Slider function -----------------
		--------------------------------------------------------*/

		public function getSlides(){
			return $this->db->order_by('Order_In_List', 'asc')->get(TBL_WEBSITE_SLIDER)->result();
		}
		
		public function addSlide($data = array()){
			$query = $this->db->insert(TBL_WEBSITE_SLIDER, $data);
			return $query;
		}
		
		public function getSlideByID($data = ''){
			$this->db->where(array('Slide_ID' => $data['slide_id']));
			return $this->db->get(TBL_WEBSITE_SLIDER)->result();
			
		}
		
		public function deleteSlide($data = array()){
			$this->db->where('Slide_ID', $data['Slide_ID']);
			return $this->db->delete(TBL_WEBSITE_SLIDER);
		}
		
		public function updateSlide($data = array()){
			$this->db->where(array('Slide_ID' => $data['Slide_ID']));
			$query = $this->db->update(TBL_WEBSITE_SLIDER, $data);
			return $query;
		}

		/*-----------------------------------------------------------
		---------------------- users management -----------------
		--------------------------------------------------------*/

		public function addUser($data = array()){
			$query = $this->db->insert(TBL_USERS, $data);
			return $query;
		}
		
		public function getAllUsers(){
			//return $this->getAllUsers_ADM();
			return $this->db->query("SELECT * FROM ".TBL_USERS." as u JOIN ".TBL_USER_ROLES." as r ON r.Role_ID = u.Role_ID")->result();
		}
		
		// for super admin
		public function getAllUsers_ADM(){
			return $this->db->query("SELECT * FROM ".TBL_USERS." as u JOIN ".TBL_USER_ROLES." as r ON r.Role_ID = u.Role_ID WHERE Role = 'admin' OR Role = 'user'")->result();
		}
		
		public function deleteUser($data = array()){
			$this->db->where('User_ID', $data['User_ID']);
			return $this->db->delete(TBL_USERS);
		}

		public function getRoles()
		{
			return $this->db->where("Type", 'admin')->get('users_roles')->result();
		}
		
		/*-----------------------------------------------------------
		---------------------- #SMS -----------------
		--------------------------------------------------------*/
		
		public function sendSMS($data = array()){
			return $this->db->insert(TBL_LOGS_SMS, $data);
		}

		
		public function getMobileNumbers($string)
		{
			$customer_nos = $this->db->select('Phone')->like('Phone', $string, 'both')->get(TBL_CUSTOMERS)->result();
			//$rest_nos     = $this->db->select('Phone')->like('Phone', $string, 'both')->get(TBL_RESTURANTS)->result();
			$comp_nos     = $this->db->select('Company_Mobile as Phone')->like('Company_Mobile', $string, 'both')->get(TBL_COMPANIES)->result();
			
			$numbers = (object) array_merge((array) $customer_nos, (array) $comp_nos);
			return $numbers;
		}

		public function getCompaniesNumbers()
		{
			$comp_nos = $this->db->select('Company_Mobile as Phone')->where('Company_Mobile!=', NULL)->get(TBL_COMPANIES)->result();

			return $comp_nos ;
		}
		
		public function getCustomerNumbers()
		{
			return $this->db
							->select('Phone')
							->where('Phone!=', NULL)
							->from(TBL_CUSTOMERS)
							->get()
							->result();
		}
		
		public function getCompanies()
		{
			return $this->db->get('companies')->result();
		}
		
			/*-----------------------------------------------------------
		---------------------- SERVICES Section -----------------
		--------------------------------------------------------*/
		// totals
		public function getServiceMale()
		{
			return $this->db->where('Status', 1)->get(TBL_SERVICES)->num_rows();
		}
		public function getServiceFemale()
		{
			return $this->db->where('Status', 0)->get(TBL_SERVICES)->num_rows();
		}
		
		// #Add Service function
		public function addService($data = array()){
			$query = $this->db->insert(TBL_SERVICES, $data);
			return  $query;
		}
		
		// #get services function
		public function getServices(){
			$query = $this->db
							 ->select("ser.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
							 ->from(TBL_SERVICES." as ser")
							 ->join(TBL_SECTIONS." as s", "s.Section_ID = ser.Section_ID")
							 ->order_by('Order_In_List', 'asc')
							 ->get();
			return $query->result();
		}
		
		public function getAllServciesList()
		{
			$query = $this->db->select('*')
					          ->from(TBL_SERVICES)
					          ->get()
					          ->result();
					          
			return $query;
		}
		// #get service By ID function
		public function getServiceByID($data = null){
			$where = array('Service_ID' => $data['service_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_SERVICES);
			return $query->result();
		}
		
		// #update service function 
		public function updateService($data = null){
			$where = array('Service_ID' => $data['Service_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_SERVICES, $data);
			return $query;

		}
		
		// #delete service function 
		public function deleteService($data = null){
			$where = array('Service_ID' => $data['service_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_SERVICES);
			return $query;

		}
		
/*-----------------------------------------------------------
		---------------------- Change Status function -----------------
		--------------------------------------------------------*/
		public function ChangeNewsStatus($data)
		{
			return $this->db->set('Status',$data['status'])->where('News_ID',$data['id'])->update('news');
		}

		public function ChangeServiceStatus($data)
		{
			return $this->db->set('Status',$data['status'])->where('Service_ID',$data['id'])->update('services');
		}


		public function ChangeStatus($data = array()){
			header('Content-Type: application/json');
			$column = '';
			$cl_name = 'Status';
			$tbl = $data['tb_loc'];
			$status = $data['status'];
			$id = $data['id'];
			
			$trigger_Arr = array(
				'company' => array('Company_ID', TBL_COMPANIES),
				'slide' => array('Slide_ID', TBL_WEBSITE_SLIDER),
				'slide_slide' => array('Slide_ID', TBL_WEBSITE_SLIDER),
				'faq' => array('Q_ID', TBL_QUESTIONS),
				'caption' => array('Slide_ID', TBL_WEBSITE_SLIDER),
				'campaign' => array('Campaign_ID', TBL_CAMPAIGNS),
				'customers' => array('Customer_ID', TBL_CUSTOMERS),
				'pictures' => array('Picture_ID', TBL_CAMPAIGN_PICTURES)
			);
			
			$trig_column = $trigger_Arr[$tbl][0]; // will get table column name
			$target_tbl = $trigger_Arr[$tbl][1]; // will get table name
			if($tbl == 'caption'){
				$cl_name = 'Caption_Status';
			}
			$query = $this->db->query("UPDATE `$target_tbl` SET `$cl_name` = $status WHERE `$trig_column` = $id");
			if($query){
			   return json_encode(array('result'=>1));	
			} else {
			   return json_encode(array('result'=>$query));	
			}
			
		}
		
				
/*-----------------------------------------------------------
		---------------------- Change Order function -----------------
		--------------------------------------------------------*/
		
		public function ChangeOrder($postkey = ''){
			/*
				* e.g $postkey = services
					- get data using that key using $_POST[$postkey]
					- we will get data as an object e.g: {1: 1, 4: 2, 2: 3, 3: 4}
					- in this object the key act as row id, and value is the order of the column.
			*/
			header('Content-Type: application/json');
			$column = '';
			$cl_name = 'Order_In_List';
			$tbl = $postkey;
			$order = json_decode(($this->input->post($postkey)));

			$trigger_Arr = array(
				'pictures' => array('Picture_ID', TBL_CAMPAIGN_PICTURES),
				'slides' => array('Slide_ID', TBL_WEBSITE_SLIDER),
				'faq' => array('Q_ID', TBL_QUESTIONS),
				'pictures' => array('Picture_ID', TBL_CAMPAIGN_PICTURES)
			);
			
			$trig_column = $trigger_Arr[$tbl][0]; // will get table column name
			$target_tbl = $trigger_Arr[$tbl][1]; // will get table name
			
			$arr = array();
			foreach($order as $key=>$value){
				$query = $this->db->query("UPDATE `$target_tbl` SET `Order_In_List` = $value WHERE `$trig_column` = $key");
				$arr = array("result"=> "Rearranged!");
			}
			return json_encode($arr);
			
		}

	}
?>