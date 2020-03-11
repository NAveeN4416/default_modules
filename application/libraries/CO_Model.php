<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CO_Model extends MY_Model {

	public function __construct()
	{
		parent::__construct();

		$this->database = $this->db->database ;
		$tables = $this->db->list_tables() ;

		$this->tables = array();

		foreach ($tables as $key => $table) {
			$fields = $this->db->list_fields($table,$this->database);
			$this->tables[$table] = $fields ;
		}
	}

	public function Get_Insert_Id()
	{
		return $this->db->insert_id();
	}

	public function Get_Tables()
	{
		return $this->tables ;
	}

	public function Get_Fields($table)
	{
		return @$this->tables[$table] ;
	}

	public function Forward_Table_Schema($table)
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

	//Injecting foreign key objects
	public function _query_response($data,$table,$meta_search=array())
	{
		//Backward Compatability
		$column_schemas = $this->Backward_Table_Schema($table);

		foreach ($data as $key => $record) {

			foreach ($column_schemas as $j => $schema) {

				//Reset array for every new query
				$where = array() ;

				$REFERENCED_TABLE_NAME = $schema['REFERENCED_TABLE_NAME'];
				$REFERENCED_COLUMN_NAME = $schema['REFERENCED_COLUMN_NAME'];

				if($REFERENCED_TABLE_NAME)
				{
					if(@$meta_search[$REFERENCED_TABLE_NAME])
					{
						$where = $meta_search[$REFERENCED_TABLE_NAME] ;
					}

					$where[$REFERENCED_COLUMN_NAME] = $record[$REFERENCED_COLUMN_NAME];

					$refered_object = @$this->GetData($REFERENCED_TABLE_NAME,$where)[0];

					$data[$key][$REFERENCED_TABLE_NAME] = $refered_object ;
				}
			}
		}


		///Forward Compatability
		$db_schema = $this->Forward_Table_Schema($table);

			foreach ($data as $key => $record) {

				foreach ($db_schema as $j => $table_schema) {

					//Reset array for every new query
					$where = array() ;

					//Getting referenced table and the column name(Foreign Key)
					$REFERENCED_TABLE_NAME = $table_schema['TABLE_NAME'];
					$REFERENCED_COLUMN_NAME = $table_schema['COLUMN_NAME'];


					//Searching data in reference table
					if(@$meta_search[$REFERENCED_TABLE_NAME])
					{
						$where = $meta_search[$REFERENCED_TABLE_NAME] ;
					}

					$where[$REFERENCED_COLUMN_NAME] = $record['id'];

					$refered_object = $this->GetData($REFERENCED_TABLE_NAME,$where);

					$data[$key][$REFERENCED_TABLE_NAME] = $refered_object ;
				}
			}

		return $data ;
	}

	public function GetData($table,$where='')
	{
		if($where)
			$this->db->where($where);

		return $this->db->get($table)->result_array();
	}

	public function Get_Objects($table,$where=array(),$meta_search=array())
	{
		if($where)
			$this->db->where($where);

		$objects = $this->db->get($table)->result_array();

		return $this->_query_response($objects,$table,$meta_search);
	}

	public function Get_Object($table,$where=array(),$meta_search=array())
	{
		$objects = $this->Get_Objects($table,$where,$meta_search) ;

		return ($objects[0]) ? $objects[0] : array() ;
	}

	public function Get_User($user_id)
	{
		$user = $this->db->where('id',$user_id)->get('auth_users')->row_array();
        $groups = $this->db->where('user_id',$user_id)->get('auth_user_groups')->result_array();
	
        $user['groups'] = $groups;

        return $user;
	}

	public function Delete_Objects($table,$where)
	{
		if(!$where)
			return 0;

		return $this->db->where($where)->delete($table);
	}

	public function Update_Objects($table,$set,$where)
	{
		if(!$where)
			return 0;

		return $this->db->set($set)->where($where)->update($table);
	}

	public function Set_Status($table,$status,$where)
	{
		return $this->Update_Objects($table,['status'=>$status],$where);
	}

	public function Insert_Object($table,$data)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}

}

?>






