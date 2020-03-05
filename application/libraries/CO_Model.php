<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CO_Model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function Get_User($user_id)
	{
		$user = $this->db->where('id',$user_id)->get('auth_users')->row_array();
        $groups = $this->db->where('user_id',$user_id)->get('auth_user_groups')->result_array();
	
        $user['groups'] = $groups;

        return $user;
	}

	public function Database_Schema($table)
	{
		$this->db->select("*")
			     ->from('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
			     ->where('CONSTRAINT_SCHEMA',$this->db->database)
			     ->where('REFERENCED_TABLE_NAME',$table);

		return $this->db->get()->result_array();
	}

	public function Backward_Table_Schema($table)
	{
		$this->db->select("*")
			     ->from('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
			     ->where('CONSTRAINT_SCHEMA',$this->db->database)
			     ->where('TABLE_NAME',$table);

		return $this->db->get()->result_array();
	}

	public function _query_response($data,$table=NULL)
	{
		//Backward Compatability
		$column_schemas = $this->Backward_Table_Schema($table);

		foreach ($data as $key => $record) {

			foreach ($column_schemas as $j => $schema) {

				$REFERENCED_TABLE_NAME = $schema['REFERENCED_TABLE_NAME'];
				$REFERENCED_COLUMN_NAME = $schema['REFERENCED_COLUMN_NAME'];

				if($REFERENCED_TABLE_NAME)
				{
					$where[$REFERENCED_COLUMN_NAME] = $record[$REFERENCED_COLUMN_NAME];

					$refered_object = $this->GetData($REFERENCED_TABLE_NAME,$where)[0];

					$data[$key][$REFERENCED_TABLE_NAME] = $refered_object ;
				}
			}
		}


		///Forward Compatability
		$db_schema = $this->Database_Schema($table);

			foreach ($data as $key => $record) {

				foreach ($db_schema as $j => $table_schema) {

					$REFERENCED_TABLE_NAME = $table_schema['TABLE_NAME'];
					$REFERENCED_COLUMN_NAME = $table_schema['COLUMN_NAME'];

					$where[$REFERENCED_COLUMN_NAME] = $record['id'];

					$refered_object = $this->GetData($REFERENCED_TABLE_NAME,$where);

					$data[$key][$REFERENCED_TABLE_NAME] = $refered_object ;
				}
			}

		return $data ;
	}

}
?>