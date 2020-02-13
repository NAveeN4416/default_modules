<?php
class Tickets_model extends CI_Model
{
	
	public function get_UserEnquiries($id=0)
    {
    	if($id) { $this->db->where('q.id',$id); }
        $this->db->select('q.*,c.Email,c.Fullname,c.Phone');
        $this->db->from('user_enquiries as q');
        $this->db->join('customers as c','c.Customer_ID=q.User_Id');
        return $this->db->get()->result();
    }


   	public function get_CompanyEnquiries($id=0)
    {
    	if($id) { $this->db->where('q.id',$id); }
        $this->db->select('q.*,c.Email,c.Company_Phone,c.Company_Mobile,Company_Logo,c.Company_Website,lc.Company_Name');
        $this->db->from('company_enquiries as q');
        $this->db->join('companies as c','c.Company_ID=q.Company_Id');
        $this->db->join('localized_companies as lc','lc.Company_ID=q.Company_Id');
        $this->db->where('lc.Culture','en');
        return $this->db->get()->result();
    }


    public function Send_Reply($data,$table)
    {
    	$this->db->insert($table,$data);

    	return $this->db->insert_id();
    }


    public function GetConversations($table,$enquiry_id)
    {
    	return $this->db->where('enquiry_id',$enquiry_id)->get($table)->result();
    }

    public function ToggleStatus($set,$enquiry_id,$table)
    {
        return $this->db->set($set)->where('id',$enquiry_id)->update($table);
    }

}
?>