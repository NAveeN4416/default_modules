<?PHP
	
	class Authentication_model extends CI_Model{
		
		//table names defined in constants.php
		
		
		// #Login Function 		
		public function login_m($data = array())
		{
			$where = array('Username' => $data['Username']);
			
			$this->db->where($where);
			$dt = $this->db
						->select('u.*, r.Role')
						->from(TBL_USERS.' as u')
						->join(TBL_USER_ROLES.' as r', 'r.Role_ID = u.Role_ID')
						->get();
			
			//echo $this->db->last_query(); die();
			
			if($dt->num_rows() == 1)
			{
				return $dt->result();
			} else {
				return 0;
			}
		}
		
		public function isLoggedIn_check($data = array()){
			$where = array('User_ID' => $data['user_id'], 'Username' => $data['email']);
			
			$this->db->where($where);
			$dt = $this->db->get(TBL_USERS);
			//print_r($dt);
			if($dt->num_rows() == 1){
				return $dt->num_rows();
			} else {
				return 0;
			}
		}
		
		//password reset @check user if exists then send email
		public function checkUser($data = array()){
			header('Content-Type: application/json');
			 $this->db->where($data);
			 $result = $this->db->get(TBL_USERS);
			 $dt = $result->result();
			 if($result->num_rows() == 1 && $dt[0]->Username != 'admin@dnet.sa'){
				 
				 //generate reset token
				 $reset_token = urlencode(md5(time().'qz'.rand(1000, 99999).rand(100, 999)));
				 
				 $upd = array('Reset_Token' => $reset_token);
				 $this->db->where(array('User_ID' => $dt[0]->User_ID));
				 $q = $this->db->update(TBL_USERS, $upd);
				 
				 if($q){
					 return array('info' => '1', 'reset_token' => $reset_token);
				 } else {
					 return json_encode(array('info' => '0', 'msg' => getSystemString(188)));
				 }
			 } else {
				 return json_encode(array('info' => '0', 'msg' =>  getSystemString(188)));
			 }
		}
		
		public function updateUserPassword($data = array(), $reset_token = ''){
			return $this->db->where('Reset_Token', $reset_token)->update(TBL_USERS, $data);
		}
		
	}
	
?>