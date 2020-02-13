<?PHP
class Crons_model extends CI_Model
{

    function Crons_model()
    {
    	parent::__construct();
    }

	function Cron_MailContent($data)
	{
		$this->db->insert('cron_mails_content',$data) ;

		return $this->db->insert_id() ;
	}

	function Cron_MailsList($data)
	{
		return $this->db->insert('cron_mails_list',$data);
	}

	function GetCronMails($content_id=0)
	{
		if($content_id!=0)
		{
			$this->db->where('id',$content_id);
		}

		$mails_content = $this->db->get('cron_mails_content')->result_array();
		
		foreach ($mails_content as $key => $mail) 
		{
			$mails_list = $this->db->where('Content_id',$mail['id'])->get('cron_mails_list')->result_array();
		
			$mails_content[$key]['Mails'] = $mails_list ;
		}

		return $mails_content;
	}

	function get_MailsList($Content_id)
	{
		return $this->db->where('Content_id',$Content_id)->where('Sent_Status',0)->get('cron_mails_list')->num_rows();
	}

	function update_MailsList($id)
	{
		return $this->db->set('Sent_Status',1)->where('id',$id)->update('cron_mails_list');
	}

	function update_MailsContent($id)
	{
		return $this->db->set('Sent_Status',1)->where('id',$id)->update('cron_mails_content');
	}

	function GetorCreate_CronMail_Limit($data)
	{
		$old_record = $this->db->where('Date',$data['Date'])->get('cron_mails_dailylimit')->row_array() ;

		if($old_record)
		{
			return $old_record ;
		}

		//else Create New Record
		$this->db->insert('cron_mails_dailylimit',$data) ;

		$insert_id = $this->db->insert_id();

		return $this->db->where('id',$insert_id)->get('cron_mails_dailylimit')->row_array() ;
	}

	function Update_MailsLimit($today,$data=[])
	{
		return $this->db->set($data)->where('Date',$today)->update('cron_mails_dailylimit');
	}
}

?>