<?PHP
    class Customers_model extends CI_Model{
		
		// totals
		public function getActiveCusMale()
		{
			return $this->db->where('Status', 1)->get(TBL_CUSTOMERS)->num_rows();
		}
		public function getInActiveCusFemale()
		{
			return $this->db->where('Status', 0)->get(TBL_CUSTOMERS)->num_rows();
		}
		public function getCustomerVerify()
		{
			return $this->db->where('Email_Verified', 1)->get(TBL_CUSTOMERS)->num_rows();
		}
		public function getCustomerVerifyStatus()
		{
			return $this->db->where('Verified_Status', 'Verified')->get(TBL_CUSTOMERS)->num_rows();
		}
		public function getCustomerPendingStatus()
		{
			return $this->db->where('Verified_Status', 'Pending')->get(TBL_CUSTOMERS)->num_rows();
		}
		
		// ends
        public function getCustomerByID($customer_id = 0)
        {
			return $this->db
							->where('Customer_ID', $customer_id)
							->get(TBL_CUSTOMERS)
							->result();
		}
        
        public function getCustomerMembers($customer_id = 0)
        {
            return $this->db->where('Customer_ID', $customer_id)->get(TBL_CUST_MEMBERS)->result();
		}
		
		public function getAllCustomers()
		{
			return $this->db->distinct('Mobile_ID')->get(TBL_CUSTOMERS)->result();
		}
        
		public function updateCustomer($data = array())
		{
			$upd = $this->db->where('Customer_ID', $data['Customer_ID'])->update(TBL_CUSTOMERS, $data);
			return $upd;
		}
		
		public function check_customer_password($data = array())
		{
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
    	
    	public function getCustomers()
    	{
	    	return $this->db
							->get(TBL_CUSTOMERS)
							->result();
    	}
    	
    	// Insert admin-member email message to database
		public function addEmailMessage($data = array()){
			$arr = array(
				'Admin_ID' => $data['userid'],
				'Email_Subject' => $data['subject'],
				'Email_Message' => $data['message'],
				'Attachment' => $data['attachment'],
				'In_Process_For_Members' => 1
			);
			return $this->db->insert(TBL_CRON_MEMBEREMAILS, $arr);
		}
		
		public function updateSelectedCustomers($data = array()){
			$result = '';
			foreach($data as $id){
				$result = $this->db->where("Customer_ID", $id)->update(TBL_CUSTOMERS, array("Cron_Email_Flag" => 1));
			}
			return $result;
		}
		
		public function updateCustomersUsingRoles($role1 = 0, $role2 = 0){
			$where = "Role_ID = $role1";
			if($role2 != 0){
				$where = "Role_ID >= $role1";
			}
			return $this->db->where($where)->update(TBL_CUSTOMERS, array("Cron_Email_Flag" => 1));
			
		}
		
		public function getCronedMembers($limit = 0)
		{
			return $this->db->where('Cron_Email_Flag', 1)->limit($limit)->get(TBL_CUSTOMERS)->result();
		}
		
		public function getInProcessEmail()
		{
			return $this->db->where('In_Process_For_Members', 1)->get(TBL_CRON_MEMBEREMAILS)->result();
		}
		
		public function updateMemberCronStatus($id = 0)
		{
			$where = "Customer_ID = $id";
			return $this->db->where($where)->update(TBL_CUSTOMERS, array("Cron_Email_Flag" => 0));
		}
		
		public function updateEmailProcessStatus()
		{
			$where = "In_Process_For_Members = 1";
			return $this->db->where($where)->update(TBL_CRON_MEMBEREMAILS, array("In_Process_For_Members" => 0));
		}
		
		//cron email daily limit
		public function getTodayCronEmailLimit($date = '')
		{
			return $this->db->where('Date', $date)->get(TBL_CRON_EMAILLOGS)->result();
		}
		
		public function createCronEmailLimitFlag($data = array())
		{
			return $this->db->insert(TBL_CRON_EMAILLOGS, $data);
		}
		
		public function updateCronEmailLimitStatus($date = '')
		{
			return $this->db->where('Date', $date)->update(TBL_CRON_EMAILLOGS, array("Limit_Exceeded" => 1));
        }
        

        /**
            *------- Customers List *---------
        **/

        var $order_columns_2  = array('c.Customer_ID', 'c.TimeStamp', 'c.Fullname', 'c.Phone', 'c.Address', 'TotalOrders', 'TotalSales', 'c.Status');
        private function _get_customers_query()
        {
            
            $where_phone = '';
            $where_name = '';
            $where_email = '';
            $where_status = '';
            
            if(!empty($_POST['phone'])){
                $phone = $_POST['phone'];
                $where_phone = "c.Phone LIKE '%$phone%' AND";
            }
            
            if(!empty($_POST['name'])){
                $name = $_POST['name'];
                $where_name = "c.Fullname LIKE '%$name%' AND";
            }
            
            if(!empty($_POST['email'])){
                $email = $_POST['email'];
                $where_email = "c.Email LIKE '%$email%' AND";
            }
            
            if(!empty($_POST['status'])){
                $status = $_POST['status'];
                $where_status = "c.Verified_Status = '$status' AND";
            }
            
            $where = "{$where_name} {$where_email} {$where_phone} {$where_status} c.Customer_ID > 0";
            
            $this->db->distinct();
            $this->db->select('c.*, COUNT(oh.Customer_ID) as TotalOrders, SUM(od.Price) as TotalSales'); 
            $this->db->from(TBL_CUSTOMERS.' AS c');
            $this->db->join(TBL_ORDERS_HEAD.' as oh', 'oh.Customer_ID = c.Customer_ID');
            $this->db->join(TBL_ORDER_DETAILS.' as od', 'od.Order_ID = oh.Order_ID');
            $this->db->where($where);
            $this->db->group_by('c.Customer_ID');
            
            //print_r($_POST['order']);
            if(isset($_POST['order'])){
                $ind = $_POST['order'][0]['column'];
                $oColumn = $this->order_columns_2[$ind];
                $direction = $_POST['order'][0]['dir'];
                $where_order = "$oColumn $direction";
                $this->db->order_by($where_order);
            } else {
                $this->db->order_by("c.TimeStamp", "DESC");
            }
        }
    
        function getCustomersList()
        {
            $this->_get_customers_query();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
    
        function customersCount_filtered()
        {
            $this->_get_customers_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function customersCount_all()
        {
            $this->_get_customers_query();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function save_credit_history($data,$id=0)
        {
        	if($id!=0)
        	{
        		return  $this->db->set($data)->where('id',$id)->update('credits_history');
        	}

        	$this->db->insert('credits_history',$data);

        	return $this->db->insert_id();
        }


        public function getCreditsHistory($Customer_id)
        {
        	return $this->db->where('Customer_ID',$Customer_id)->order_by('id','desc')->get('credits_history')->result_array();
        }

    }
?>