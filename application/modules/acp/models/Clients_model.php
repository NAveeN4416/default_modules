<?PHP
class Clients_model extends CI_Model
{
    public function add($data = array()){
        $query = $this->db->insert(TBL_CLIENTS, $data);
        return  $query;
    }
    
    public function listall(){
        $query = $this->db
                     ->select("c.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
                     ->from(TBL_CLIENTS." as c")
                     ->join(TBL_SECTIONS." as s", "s.Section_ID = c.Section_ID")
                     ->order_by('Order_In_List', 'asc')
                     ->get();
        return $query->result();
    }
    
    public function getByID($data = array()){
        $this->db->where('Client_ID', $data['client_id']);
        return $this->db->order_by('Order_In_List', 'asc')->get(TBL_CLIENTS)->result();
    }
    
    public function update($data = array()){
        $this->db->where('Client_ID', $data['Client_ID']);
        $query = $this->db->update(TBL_CLIENTS, $data);
        return  $query;
    }
    
    public function delete($data = array()){
        $this->db->where('Client_ID', $data['client_id']);
        $query = $this->db->delete(TBL_CLIENTS, $data);
        return $query;
    }

    public function join_as_partners()
    {
        return $this->db->order_by('id','desc')->get(TBL_JOINAS_PARTNERS)->result();
    }

    public function get_joinas_partner($id)
    {
        return $this->db->where('id',$id)->get(TBL_JOINAS_PARTNERS)->row();
    }
}
?>