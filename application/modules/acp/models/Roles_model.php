<?PHP
	class Roles_model extends CI_Model
	{
		public function add($role = array())
		{
			$this->db->insert("users_roles", $role);
			return $this->db->insert_id();
		}
		

		public function update($data,$roleid)
		{
			return $this->db->set($data)->where('Role_ID',$roleid)->update('users_roles') ;
		}


		public function listAll()
		{
			return $this->db->where("Type", "admin")->get("users_roles")->result();
		}
		
		public function delete($roleid = '')
		{
			return $this->db->where("Role_ID", $roleid)->delete("users_roles");
		}

		public function get_menus($page_id=0)
		{
			return $this->db->get('rbac_menus')->result();
		}

		public function save_permissions($data)
		{
			return $this->db->insert('user_permissions',$data);
		}

		public function update_permissions($data,$permission_id)
		{
			return $this->db->set($data)->where('id',$permission_id)->update('user_permissions') ;
		}

		public function user_permissions($Role_id)
		{
			return $this->db->where('Role_id',$Role_id)->get('user_permissions')->result_array();
		}

		public function delete_permissions($Role_id)
		{
			return $this->db->where('Role_id',$Role_id)->delete('user_permissions');
		}

		public function get_userroles($Role_id)
		{
			return $this->db->where('Role_ID',$Role_id)->get('users_roles')->row_array();
		}

	}
	
?>